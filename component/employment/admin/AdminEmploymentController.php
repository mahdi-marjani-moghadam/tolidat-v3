<?php

/**
 * Created by PhpStorm.
 * User: sakhamanesh
 * Date: 11/6/2017
 * Time: 10:59 AM
 */
include_once(ROOT_DIR . "component/employment/model/Employment.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

class AdminEmploymentController
{
    public $exportType;

    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';

    }

    function template($list = [], $msg = '')
    {
        global $messageStack;

        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;

            default:
                break;
        }

    }

    public function showDarftList($fields)
    {
        $this->fileName = 'admin.employment.showDraftList.php';

        $employment = Employment::getBy_company_id_and_isActive_and_status($fields['company_id'], 1, -1)->getList();

        if ($employment['result'] != '1') {
            $this->template('', $employment['msg']);
            die();
        }

        $export['list'] = $employment['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export);
        die();
    }


    public function getByCompanyId($company_id)
    {

        $employmentObject = Employment::getBy_company_id($company_id)->getList();
        return $employmentObject;

    }

    //---------------------------------------draft Employment----------

    public function editDraftEmploymentForm($fields)
    {
        $draftObject = Employment::find($fields['id']);

        if (!is_object($draftObject)) {
            $msg = 'رکوردی یافت نشد';
            redirectPage(RELA_DIR . "admin/company&action=showDraftCompany", $msg);

        }

        $graduates = Graduate::getAll()->getList();

        $export = $draftObject->fields;
        $export['graduates'] = $graduates['export']['list'];

        $this->fileName = 'admin.employmentDraft.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editDraftEmployment($fields)
    {
        $fields['startDate'] = convertJToGDate($fields['startDate']);
        $fields['expireDate'] = convertJToGDate($fields['expireDate']);

        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        //find draft record
        $draftObject = Employment::find($fields['Employment_id']);
        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = "رکورد ویرایش شده یافت نشد! ";
            redirectPage(RELA_DIR . 'admin/index.php?component=employment&action=showlist&id=' . $draftObject->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } else if ($fields['process'] == -1) {
            $this->rejectDraft($draftObject);
            $this->sendNotification($draftObject);
        }
        calculateScoreCompany($draftObject->company_id);

        $countObject = Employment::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy('company_id', 'DESC')->getList();
        //        print_r_debug($countObject);
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = 'employment';
        $item['countItem'] = $countObject['export']['recordsCount'];

        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=employment&action=showDraftEmployment' . '&id=' . $draftObject->company_id, $msg);

    }

    public function acceptDraft($draftObject, $fields)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $fields['company_id'] = $draftObject->company_id;
        $fields['parent_id'] = $draftObject->parent_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 2;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['history'] = 0;

        $perviousDraftObject = Employment::getBy_Employment_id_and_company_id_and_isActive($draftObject->Employment_id, $draftObject->company_id, 1)->first();
        if (is_object($perviousDraftObject)) {
            $perviousDraftObject->isActive = 0;
            $perviousDraftObject->isAdmin = 1;
            $perviousDraftObject->status = 1;
            $perviousDraftObject->editor_id = $editor_id;
            $perviousDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $perviousDraftObject->save();
        } else {
            $msg = "رکورد اصلی یافت نشد!";
        }

        $mainObject = new Employment();
        $mainObject->setFields($fields);
        $mainObject->save();
        $mainObject->updateAll();

        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به فرصت های شغلی  شما با موفقیت اعمال شد",
            'messageType' => 2
        ];
        $notification->addNotification($Items);
    }

    public function rejectDraft($draftObject)
    {
        //Previous Draft
        if ($draftObject->parent_id != 0) {
            $draftObject->isActive = -1;
            $draftObject->status = 1;
            $draftObject->isAdmin = 1;
            return $draftObject->save();
        }


    }

    public function editCompany($items)
    {

        //find company information for edit feild 'EDIT'
        include_once(ROOT_DIR . "component/company/admin/model/admin.company.model.php");
        $companyObject = admincompanyModel::find($items['id']);
        if (!is_object($companyObject)) {
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $companyObject['msg']);
            die();
        }

        $item = array("product" => "0",
            "certification" => "1",
            "honour" => "2",
            "businessLicence" => "3",
            "history" => "4",
            "companyNews" => "5",
            "companyAddresses" => "6",
            "companyPhones" => "7",
            "companyEmails" => "8",
            "companyWebsites" => "9",
            "companyBanner" => "10",
            "companyLogo" => "11",
            "companyCommercialName" => "12",
            "licences" => "13",
            "companySocials" => "14",
            "companyPositions" => "15",
            "branch" => "16",
            "wiki" => "17",
            "employment" => "18",
        );
        $editField = $companyObject->edit;

        if ($items['countItem'] < 1) {
            $editField[$item[$items["componentName"]]] = 0;
            $companyObject->edit = $editField;
            $companyObject->save();

            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
            die();
        }
    }

    public function sendNotification($draftObject)
    {
        $notification = new adminNotificationController();
        $fields = [
            'from' => $draftObject->editor_id,
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به  فرصت های شغلی شما با موفقیت اعمال نشد",
            'messageType' => 2
        ];
        return $notification->addNotification($fields);
    }

    public function deleteAllEmploymentByCompanyId($company_id)
    {
        //delete from main table
        $employments = Employment::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($employments['export']['recordsCount'] > 0) {
            foreach ($employments['export']['list'] as $employment) {
                $employment->delete();
            }
        }

        return;
    }

    public function showList($company_id)
    {
        $this->fileName = 'admin.employment.showList.php';

        $employments = Employment::getAll()
            ->where('company_id', '=', $company_id)
            ->where('isActive', '=', 1)
            ->where('status', '=', 2)
            ->getList();

        $export['list'] = $employments['export']['list'];
        $export['company_id'] = $company_id;

        $this->template($export);
        die();
    }

    public function create($company_id)
    {
        $this->fileName = 'admin.employment.addForm.php';
        $export['company_id'] = $company_id;

        $graduates = Graduate::getAll()->getList();
        $export['graduates'] = $graduates['export']['list'];

        $this->template($export);
        die();
    }

    public function store($fields)
    {
        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['status'] = 2;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['admin_description'] = null;
        $fields['startDate'] = convertJToGDate($fields['startDate']);
        $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $employment = new Employment();
        $employment->setFields($fields);
        $employment->save();

        $employment->parent_id = $employment->Employment_id;
        $employment->save();

        redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی افزوده شد');
    }

    public function edit($fields)
    {
        $employment = Employment::find($fields['employment_id']);

        if (!is_object($employment)) {
            redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی موجود نیست');
        }

        $export = $employment->fields;
        $export['company_id'] = $fields['company_id'];
        $graduates = Graduate::getAll()->getList();
        $export['graduates'] = $graduates['export']['list'];

        $this->fileName = 'admin.employment.editForm.php';
        $this->template($export);
        die();
    }

    public function update($fields)
    {
        $employment = Employment::find($fields['employment_id']);

        if (!is_object($employment)) {
            redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی موجود نیست');
        }

        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['status'] = 2;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['admin_description'] = null;
        $fields['startDate'] = convertJToGDate($fields['startDate']);
        $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $newAdvertise = new Employment();
        $newAdvertise->setFields($fields);
        $newAdvertise->save();

        $newAdvertise->parent_id = $employment->parent_id;
        $newAdvertise->save();

        $employment->status = 1;
        $employment->isActive = 0;
        $employment->save();

        redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی ویرایش شد');
    }

    public function delete($fields)
    {
        $employments = Employment::getAll()
            ->where('parent_id', '=', $fields['parent_id'])
            ->get();

        if ($employments['export']['recordsCount'] > 0) {
            foreach ($employments['export']['list'] as $employment) {
                if (is_object($employment)) {
                    $result = $employment->delete();
                }
            }
        }

        if ($result['result'] == 1) {
            redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی حذف شد');
        }

        redirectPage(RELA_DIR . 'admin/?component=employment&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی حذف نشد');

    }

}
