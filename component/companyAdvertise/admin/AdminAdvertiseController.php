<?php

/**
 * Created by PhpStorm.
 * User: sakhamanesh
 * Date: 11/6/2017
 * Time: 10:59 AM
 */
include_once(ROOT_DIR . "component/companyAdvertise/model/Advertise.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'services/uploader/Uploader.php';

class AdminAdvertiseController
{
    public $exportType;

    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';

    }

    function template($list = [], $msg = "")
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

    public function showList($fields)
    {
        $this->fileName = 'admin.companyAdvertise.showList.php';

        $advertise = c_advertise::getAll()
            ->where('company_id', '=', $fields['company_id'])
            ->where('isActive', '=', 1)
            ->where('status', '=', 2)
            ->getList();

        if ($advertise['result'] != '1') {
            $this->template('', $advertise['msg']);
            die();
        }

        $export['list'] = $advertise['export']['list'];
        $export['company_id'] = $fields['company_id'];

        $this->template($export);
        die();
    }

    public function create($company_id)
    {
        $this->fileName = 'admin.companyAdvertise.addForm.php';
        $export['company_id'] = $company_id;

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

        $result = $this->uploadImage($fields['AdvertiseImage'], $fields['company_id']);
        $fields['image'] = $result['image'];

        $advertise = new c_advertise();
        $advertise->setFields($fields);
        $advertise->save();

        $advertise->parent_id = $advertise->Advertise_id;
        $advertise->save();

        redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی افزوده شد');
    }

    public function edit($fields)
    {
        $advertise = c_advertise::find($fields['advertise_id']);

        if (!is_object($advertise)) {
            redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی موجود نیست');
        }

        $export = $advertise->fields;
        $export['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.companyAdvertise.editForm.php';
        $this->template($export);
        die();
    }

    public function update($fields)
    {
        $advertise = c_advertise::find($fields['Advertise_id']);

        if (!is_object($advertise)) {
            redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی موجود نیست');
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
        $fields['image'] = $advertise->image;

        if (!empty($fields['AdvertiseImage'])) {
            $result = $this->uploadImage($fields['AdvertiseImage'], $fields['company_id']);
            $fields['image'] = $result['image'];
        }

        $newAdvertise = new c_advertise();
        $newAdvertise->setFields($fields);
        $newAdvertise->save();

        $newAdvertise->parent_id = $advertise->parent_id;
        $newAdvertise->save();

        $advertise->status = 1;
        $advertise->isActive = 0;
        $advertise->save();

        redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی ویرایش شد');
    }

    public function delete($fields)
    {
        $advertises = c_advertise::getAll()
            ->where('parent_id', '=', $fields['parent_id'])
            ->get();

        if ($advertises['export']['recordsCount'] > 0) {
            foreach ($advertises['export']['list'] as $advertise) {
                if (is_object($advertise)) {
                    $result = $advertise->delete();
                }
            }
        }

        if ($result['result'] == 1) {
            redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی حذف شد');
        }

        redirectPage(RELA_DIR . 'admin/?component=companyAdvertise&action=showList&id=' . $fields['company_id'] . '&branch_id=0', 'آگهی حذف نشد');

    }

    public function uploadImage($image, $company_id)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $company_id,
                'folder_name' => 'advertise'
            ];
            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
    }

    public function getByCompanyId($company_id)
    {
        $advertise = c_advertise::getBy_company_id($company_id)->getList();
        return $advertise;
    }

    //---------------------------------------draft Advertise----------


    public function showDraftCompanyAdvertise($fields)
    {

        $company_id = $fields;
        $advertiseResult = c_advertise::getBy_status_and_company_id_and_isActive(-1, $company_id, 1)->getList();

        $result = $advertiseResult['export']['list'];


        $this->fileName = 'admin.companyAdvertiseDraft.showList.php';
        $this->template($result);
    }

    public function editDraftCompanyAdvertiseForm($fields)
    {
        $result = c_advertise::find($fields['draft_id']);
        if (is_object($result)) {
            $export = $result->fields;
            $export['date'] = convertDate($result->date);
            $export['startDate'] = convertDate($result->startDate);
            $export['expireDate'] = convertDate($result->expireDate);
            $this->fileName = 'admin.companyAdvertiseDraft.editForm.php';

            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=companyAdvertise", $msg);
        }
    }

    public function editDraftCompanyAdvertise($fields)
    {

        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        //find draft record
        $draftObject = c_advertise::find($fields['draft_id']);


        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = "رکورد ویرایش شده یافت نشد! ";
            redirectPage(RELA_DIR . 'admin/index.php?component=advertise&action=showlist&id=' . $draftObject->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } else if ($fields['process'] == -1) {
            $this->rejectDraft($draftObject);
            $this->sendNotification($draftObject);
        }

        $countObject = c_advertise::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy('company_id', 'DESC')->getList();
        //        print_r_debug($countObject);
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = 'companyAdvertise';
        $item['countItem'] = $countObject['export']['recordsCount'];

        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=advertise&action=showDraftAdvertise' . '&id=' . $draftObject->company_id, $msg);

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

        $perviousDraftObject = c_advertise::getBy_Advertise_id_and_company_id_and_isActive($draftObject->Advertise_id, $draftObject->company_id, 1)->first();


        if (!empty($fields['image'])) {

            $uploader = new Uploader();

            $property = [
                'image' => $fields['image'],
                'company_id' => $fields['company_id'],
                'folder_name' => 'advertise'
            ];

            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];
        } else {

            $fields['image'] = $draftObject->image;
        }


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

        $mainObject = new c_advertise();
        $mainObject->setFields($fields);
        $mainObject->startDate = convertJToGDate($fields['startDate']);
        $mainObject->expireDate = convertJToGDate($fields['expireDate']);
        $mainObject->save();
        $mainObject->updateAll();


        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به آگهی های شما با موفقیت اعمال شد",
            'messageType' => 2
        ];

        $this->sendSMS($draftObject->company_id, "accept");
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
            "companyAdvertise" => "19",
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
            'msg' => "تغییرات مربوط به مجوزهای شما با موفقیت اعمال نشد",
            'messageType' => 2
        ];
        $this->sendSMS($draftObject->company_id, "reject");
        return $notification->addNotification($fields);
    }

    public function deleteAllAdvertiseByCompanyId($company_id)
    {
        //delete from main table
        $advertises = c_advertise::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($advertises['export']['recordsCount'] > 0) {
            foreach ($advertises['export']['list'] as $advertise) {
                $advertise->delete();
            }
        }

        return;
    }


    public function sendSMS($company_id, $messageType)
    {

        include_once ROOT_DIR . 'component/login/model/login.model.php';
        $member = new members();
        $smsText = "";

        if ($messageType == "accept") {
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر تبلیغات را تایید نمودند.";
        }else{
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر تبلیغات رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
        }

        $memberData = $member::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($memberData['export']['recordsCount'] > 0) {
            $memberFields = $memberData['export']['list']['0'];
            if ($memberFields->mobile != '') {
                $result = sendSMS($memberFields->mobile, $smsText);
                return $result;
            }
        }


        $result = -1;
        return $result;
    }

}
