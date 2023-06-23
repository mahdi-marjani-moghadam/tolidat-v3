<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.licence.model.php");
include_once(dirname(__FILE__) . "/admin.licenceDraft.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . "component/licence/member/model/licence.controller.php";
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class registerController
 */
class adminlicenceController
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

    //--------------------------------------- Licence----------

    public function showLicenceAddForm($fields, $msg)
    {
        $fields['licence'] = licenceController::getLicenceList()['export']['list'];
        $this->fileName = 'admin.licence.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    public function showLicenceEditForm($fields, $msg)
    {
        $result = adminc_licences_dModel::getBy_licence_id_and_isActive_and_status($fields['Licence_id'], 2, 1)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }
        $licence = adminc_licencesModel::find($fields['Licence_id']);
        $licence->issuence_date = convertDate($licence->issuence_date);
        $licence->expiration_date = convertDate($licence->expiration_date);
        $export = $licence->fields;
        $export['Licence_id'] = $fields['Licence_id'];
        $export['licence'] = licenceController::getLicenceList()['export']['list'];
        $this->fileName = 'admin.licence.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function showList($fields)
    {
        $this->fileName = 'admin.licence.showList.php';
        $licenceObject = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], 1)->getList();
        if ($licenceObject['result'] != '1') {
            $this->template('', $licenceObject['msg']);
            die();
        }
        $export['list'] = $licenceObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export);
        die();
    }

    public function add($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_licences_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "licence";
        ////////////////////////////////////Add new record
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';
        $fields['status'] = '1';

        if (!empty($fields['licenceImage'])) {
            $uploader = new Uploader();

            $property = [
                'image' => $fields['licenceImage'],
                'company_id' => $fields['company_id'],
                'folder_name' => 'licence'
            ];

            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];
        } else {
            $fields['image'] = '';
        }

        $newMainObject = new $mainModel();
        $newMainObject->setFields($fields);
        $newMainObject->parent_id = 1;
        $newMainObject->isActive = 1;
        $newMainObject->isAdmin = 1;
        $newMainObject->status = 2;
        $newMainObject->editor_id = $editor_id;
        $newMainObject->issuence_date = convertJToGDate($newMainObject->issuence_date);
        $newMainObject->expiration_date = convertJToGDate($newMainObject->expiration_date);
        $newMainObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newMainObject->save();
        if ($newMainObject->licence_type == 0) {
            $licence_list = new licence_list();
            $licence_list->name = $fields['licenceTypeName'];
            $licence_list->status = 1;
            $licence_list->save();
        }
        $newMainObject->parent_id = $newMainObject->Licence_id;
        $newMainObject->save();

        $msg = "مجوز با موفقیت اضافه شد.";
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function edit($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_licencesModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "licence";
        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['issuence_date'] = convertJToGDate($fields['issuence_date']);
        $fields['expiration_date'] = convertJToGDate($fields['expiration_date']);
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';
        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields['Licence_id']);
        if (is_object($MainObject)) {

            if ($fields['remove_image'] != 'on') {
                if (!empty($fields['licenceImage'])) {
                    $uploader = new Uploader();
                    $property = [
                        'image' => $fields['licenceImage'],
                        'company_id' => $fields['company_id'],
                        'folder_name' => 'licence'
                    ];

                    $sizes = [
                        'size1' => ['width' => '90', 'height' => '90']
                    ];

                    $result = $uploader->cropAndCompressImage($property, $sizes);
                    $fields['image'] = $result['image'];

                } else {
                    $fields['image'] = $MainObject->image;
                }

            } else {
                // $MainObject->delete();
                $fields['image'] = '';

            }


            $perviousDraftObject = adminc_licencesModel::getBy_Licence_id_and_company_id_and_isActive($MainObject->Licence_id, $MainObject->company_id, 1)->first();
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
            $draftObject = new adminc_licencesModel();
            $draftObject->setFields($fields);
            $draftObject->company_id = $MainObject->company_id;
            $draftObject->parent_id = $MainObject->parent_id;
            $draftObject->isActive = 1;
            $draftObject->isAdmin = 1;
            $draftObject->isMain = $MainObject->isMain;
            $draftObject->status = 2;
            $draftObject->editor_id = $editor_id;
            $draftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $draftObject->save();
            $draftObject->updateAll();

            $msg = "عملیات با موفقیت انجام شد";
        } else {
            $msg = "رکورد اصلی یافت نشد!";
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function delete($id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_licencesModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "licence";

        ////////////////////////////////////delete Record
        $mainObject = adminc_licencesModel::find($id);
        if (is_object($mainObject)) {
            $company_id = $mainObject->company_id;
            $draftObject = adminc_licencesModel::getBy_Licence_id($mainObject->Licence_id)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $draftRecord->delete();
            }
            $mainObject->delete();
            $licences = adminc_licencesModel::getBy_parent_id($mainObject->parent_id)->get();
            foreach ($licences['export']['list'] as $licence) {
                $licence->delete();
            }

            $msg = "مجوز با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }
        calculateScoreCompany($id);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $company_id, $msg);
        die();
    }

    public function deleteWithCompanyId($company_id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_websites_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "licence";

        ////////////////////////////////////delete Record

        //delete a phone from main table
        $mainObject = $mainModel::getBy_company_id($company_id)->get();
        if ($mainObject['export']['recordsCount'] != 0) {
            foreach ($mainObject['export']['list'] as $mainRecord) {
                // fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $result = $mainRecord->delete();
            }

        }

        return $result;
    }

    public function getLicenceAjax($type = 'notAll')
    {
        $result = '';
        if ($type == 'all') {
            $result = adminlicence_listModel::getAll()->getList('PRI');

        } else {
            $result = adminlicence_listModel::getBy_not_status('0')->getList('PRI');
        }

        return $result;

    }

    public function getLicenceByCompanyId($company_id)
    {
        $result = adminc_licencesModel::getBy_company_id_and_isMain_and_isActive($company_id, '1', '1')->getList();

        return $result;
    }


    public function getByCompanyId($company_id)
    {

        $licencesObject = adminc_licencesModel::getBy_company_id_and_status_and_is_Active($company_id,2,1)->getList();
        return $licencesObject ;

    }
    //---------------------------------------draft Licence----------
    public function showDraftLicence($id)
    {

        $result = adminc_licencesModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Licence_id', 'DESC')->getList();

        if ($result['result'] != 1) {
            $this->fileName = 'admin.licenceDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }

        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.licenceDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftLicenceForm($fields)
    {
        $result = adminc_licencesModel::find($fields['Licence_id']);
        if (is_object($result)) {
            $export = $result->fields;
            $export['category_id'] = tagToArray($result->category_id)['export']['list'];
            $export['date'] = convertDate($result->date);
            $export['issuence_date'] = convertDate($result->issuence_date);
            $export['expiration_date'] = convertDate($result->expiration_date);
            include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
            $category = new adminCategoryModel();
            $resultCategory = $category->getCategoryOption();
            if ($resultCategory['result'] == 1) {
                $export['category'] = $category->list;
            }
            $export['licence'] = licenceController::getLicenceList()['export']['list'];
            $this->fileName = 'admin.licenceDraft.editForm.php';
            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=licence", $msg);
        }
    }

    public function  editDraftLicence($fields, $files)
    {
        global $admin_info;


        //set fields var
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        /////////////////////////////////////

        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['files'] = $files;
        //find draft record
        $draftObject = adminc_licencesModel::find($fields['Licence_id']);

        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = "رکورد ویرایش شده یافت نشد! ";
            redirectPage(RELA_DIR . 'admin/index.php?component=licence&action=showDraftLicence&id=' . $draftObject->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } else if ($fields['process'] == -1) {
            $this->rejectDraft($draftObject, $fields);
        }

        $countObject = adminc_licencesModel::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy('Licence_id', 'DESC')->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = 'licences';
        $item['countItem'] = $countObject['export']['recordsCount'];

        $this->editCompany($item);
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=licence&action=showDraftLicence' . '&id=' . $draftObject->company_id, $msg);

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
        $fields['issuence_date'] =  convertJToGDate($fields['issuence_date']);
        $fields['expiration_date'] =  convertJToGDate($fields['expiration_date']);
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';


        if ($fields['remove_image'] != 'on') {
            if (!empty($fields['licenceImage'])) {
                $uploader = new Uploader();
                $property = [
                    'image' => $fields['licenceImage'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'licence'
                ];

                $sizes = [
                    'size1' => ['width' => '90', 'height' => '90']
                ];

                $result = $uploader->cropAndCompressImage($property, $sizes);
                $fields['image'] = $result['image'];

            } else {
                $fields['image'] = $draftObject->image;
            }

        } else {
            // $MainObject->delete();
            $fields['image'] = '';

        }


        $perviousDraftObject = adminc_licencesModel::getBy_Licence_id_and_company_id_and_isActive($draftObject->Licence_id, $draftObject->company_id, 1)->first();
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
        $mainObject = new adminc_licencesModel();
        $mainObject->setFields($fields);
        $mainObject->save();
        $mainObject->updateAll();

        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به مجوزهای شما با موفقیت اعمال شد",
            'messageType' => 2
        ];
        $this->sendSMS($draftObject->company_id, "accept");
        $notification->addNotification($Items);
    }

    public function rejectDraft($draftObject, $fields)
    {

        //Previous Draft
        if ($draftObject->parent_id != 0) {

            $p_productDraftObject = adminc_licencesModel::getBy_parent_id_and_company_id_and_isActive($draftObject->parent_id, $draftObject->company_id, 0)->orderBy('Licence_id', 'DESC')->first();

            $p_productDraftObject->isActive = 1;
            $p_productDraftObject->status = 1;
            $p_productDraftObject->isAdmin = 1;
            $p_productDraftObject->editor_id = $fields['editor_id'];
            $p_productDraftObject->save();
        }
        //reject Draft
        $draftObject->isActive = -1;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['editor_id'];
        $draftObject->save();

        $notification = new adminNotificationController();
        $fields = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به مجوزهای شما با موفقیت اعمال نشد",
            'messageType' => 2
        ];
        $this->sendSMS($draftObject->company_id, "reject");
        $notification->addNotification($fields);
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
            "wiki" => "17"
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

    public function deleteAllLicenceByCompanyId($company_id)
    {
        //delete from main table
        $licences = adminc_licencesModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($licences['export']['recordsCount'] > 0) {
            foreach ($licences['export']['list'] as $licence) {
                $licence->delete();
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
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر مجوز را تایید نمودند.";
        }else{
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر مجوز رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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

