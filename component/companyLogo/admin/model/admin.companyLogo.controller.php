<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.companyLogo.model.php");
include_once(dirname(__FILE__) . "/admin.companyLogoDraft.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class registerController
 */
class admincompany_logoController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     * registerController constructor.
     */
    public function __construct()
    {


//        $history=admincompany_historyModel::find(4);
//        echo '<br/>********************<br/>';
//       //print_r($history);
//        //$history->title='ee';
//        $history->save();
//       // print_r_debug($history);
//
//
//        //company_history::create($fields);
//        /*$history = new company_history();
//        $history->title='aa';
//        $history->description='bbb';
//        $history->save();*/
//
//        $attributes = array('title' => 'My first blog post!!', 'description' => '5');
//        $company_history=admincompany_historyModel::create($attributes);
//        print_r_debug($company_history);
//
//
//        print_r_debug($history);
//
//        $result =$history->setFields($fields);
//        print_r_debug($history);


        $this->exportType = 'html';

    }

    /**
     * call template
     *
     * @param string $list
     * @param $msg
     * @return string
     */
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

    public function addCompanyLogo($fields, $files)
    {

        $companyLogo = admincompanyModel::find($fields['company_id']);
        if (is_object($companyLogo)) {
            if ($fields['remove_image'] == 'on') {
                fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", $companyLogo->logo);
            } else {
                if ($files['name'] != '') {
                    $Property = array('type' => 'jpg,png',
                        'new_name' => $files['name'],
                        'max_size' => '2048000',
                        'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/",
                        'height' => '',
                        'wight' => '',
                        'error_msg' => '',
                        'success_msg' => '',
                    );

                    fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", $companyLogo->fields['logo']);
                    $result_uploader = fileUploader($Property, $files);
                    $companyLogo->logo = $result_uploader['image_name'];
                    $companyLogo->save();
                } else {
                    $field['image'] = $companyLogo->fields['logo'];
                    $companyLogo->logo = $companyLogo->fields['logo'];
                    //$companyLogo->setFields($field);
                    $companyLogo->save();
                    $msg = 'عملیات با موفقیت انجام شد';
                }
            }
        } else {
            $msg = 'عملیات با موفقیت انجام نشد';
        }
        redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo&id=' . $fields['company_id'], $msg);
        die();


    }

    public function showCompanyLogoAddForm($fields, $msg)
    {
        $result = adminc_logo_dModel::getBy_company_id_and_isActive_and_status($fields['company_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }


        $logoObject = adminc_logoModel::getBy_company_id($fields['company_id'])->getList();
        if ($logoObject['export']['recordsCount'] > 1) {
            $msg = "وجود چند رکورد برای کمپانی ";
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $input = $logoObject['export']['list']['0'];
        $input['recordsCount'] = $logoObject['export']['recordsCount'];
        $input['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.companyLogo.addForm.php';
        $this->template($input, $msg);
        die();
    }

    public function add($fields, $files)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_logo_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyLogo";
        $imageAddress = str_replace("company", "", strtolower($componentName));

        ////////////////////////////////////find company record in table
        $logoObject = $mainModel::getBy_company_id($fields['company_id'])->first();
        ////////////////////////////////////Add new record
        $field['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $field['image'] = '';
        $field['status'] = '1';
        $fields['Logo_id'] = '';

        if ($fields['remove_image'] == 'on') {
            $field['image'] = '';
            $logoObject = $mainModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($logoObject)) {
                $logoObject->delete();
            }
        } else {
            if ($files['name'] != '') {
                $file['name'] = $files['name'];
                $file['type'] = $files['type'];
                $file['tmp_name'] = $files['tmp_name'];
                $file['error'] = $files['error'];
                $file['size'] = $files['size'];
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $file['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $imageAddress . "/"
                );

                $logoObject = $mainModel::getBy_company_id($fields['company_id'])->first();
                if (is_object($logoObject)) {
                    $logoObject->delete();
                }
                $result_uploader = fileUploader($Property, $file);
                $field['image'] = $result_uploader['image_name'];
            } else {
                $field['image'] = $logoObject->image;
            }
        }
        $field['title'] = $fields['title'];
        $field['description'] = $fields['description'];
        $field['company_id'] = $fields['company_id'];

        if (is_object($logoObject)) {
            $logoObject->setFields($field);
            $logoObject->save();

        } else {
            $logoObject = new $mainModel();
            $logoObject->setFields($field);
            $logoObject->save();

        }

        ////////////////////////////////////Save to Draft

        //////////////////////update all draft record
        $fields['isActive'] = 0;
        $where = '`company_id` = ' . $fields['company_id'] . ' AND `isActive` = 1';
        $result = $draftModel::update($fields, $where);

        //////////////////////add new record in draft table
        $newDraftObject = new $draftModel();
        $newDraftObject->setFields($logoObject->fields);
        $newDraftObject->$draft_f_key = $logoObject->$main_p_key;
        $newDraftObject->company_id = $fields['company_id'];
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->status = 1;
        $newDraftObject->editor_id = $editor_id;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->save();

        $msg = "لوگو با موفقیت اضافه شد.";
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        die();
    }

    public function getByCompanyId($company_id)
    {

        $logoObject = adminc_logoModel::getBy_company_id($company_id)->getList();
        return $logoObject ;

    }


    //---------------------------------------draft CompanyLogo----------
    public function showDraftCompanyLogo($id)
    {

        $result = adminc_logo_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Logo_d_id', 'DESC')->getList();

        if ($result['result'] != 1) {
            $this->fileName = 'admin.companyLogoDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.companyLogoDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftCompanyLogoForm($fields)
    {
        $result = adminc_logo_dModel::find($fields['draft_id']);
        if (is_object($result)) {
            $export = $result->fields;
            $export['category_id'] = tagToArray($result->category_id)['export']['list'];
            $export['date'] = convertDate($result->date);
            //print_r_debug($export);
            include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
            $category = new adminCategoryModel();
            $resultCategory = $category->getCategoryOption();
            if ($resultCategory['result'] == 1) {
                $export['category'] = $category->list;
            }
            $this->fileName = 'admin.companyLogoDraft.editForm.php';
            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=companyLogo", $msg);
        }
    }

    public function editDraftCompanyLogo($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_logo_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyLogo";
        $imageAddress = "logo";
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

        //set fields var
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        /////////////////////////////////////

        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['files'] = $files;
        $fields['draftModel'] = $draftModel;
        $fields['mainModel'] = $mainModel;
        $fields['draft_p_key'] = $draft_p_key;
        $fields['draft_f_key'] = $draft_f_key;
        $fields['main_p_key'] = $main_p_key;
        $fields['componentName'] = $componentName;
        $fields['imageAddress'] = $imageAddress;

        //find draft record
        $draftObject = $draftModel::find($fields['draft_id']);
        $fields['company_id'] = $draftObject->company_id;

        if (!is_object($draftObject)) {
            $msg = "رکورد ویرایش شده یافت نشد! ";
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showDraft' . ucfirst($componentName) . '&id=' . $draftModel->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } else if ($fields['process'] == -1) {
            $this->rejectDraft($draftObject, $fields);
        }
        //print_r_debug($draftObject);
        $countObject = $fields['draftModel']::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy($fields['draft_p_key'], 'DESC')->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = $fields['componentName'];
        $item['countItem'] = $countObject['export']['recordsCount'];
        calculateScoreCompany($fields['company_id']);
        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showDraft' . ucfirst($componentName) . '&id=' . $draftObject->company_id, $msg);

    }

    public function acceptDraft($draftObject, $fields)
    {


        $fields[$fields['draft_f_key']] = $draftObject->$fields['main_p_key'];
        $fields['company_id'] = $draftObject->company_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';


        if ($fields['remove_image'] != 'on') {
            if (!empty($fields['companyLogo'])) {
                $uploader = new Uploader();

                $property = [
                    'image' => $fields['companyLogo'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'logo'
                ];

                $sizes = [
                    'size1' => ['width' => '122', 'height' => '125'],
                    'size2' => ['width' => '140', 'height' => '140'],
                    'size3' => ['width' => '150', 'height' => '150']
                ];

                $result = $uploader->cropAndCompressImage($property, $sizes);
                $fields['image'] = $result['image'];
            } else {
                $fields['image'] = $draftObject->image;
            }

        } else {
            $fields['image'] = '';
        }


        if (isset($fields['files']['name'])) {
            if ($fields['remove_image'] == 'on') {
                $fields['image'] = '';
            } else {
                if ($fields['files']['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg',
                        'new_name' => $fields['files']['name'],
                        'max_size' => '2048000',
                        'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $fields['imageAddress'] . "/",
                        'height' => '',
                        'wight' => '',
                        'error_msg' => '',
                        'success_msg' => '',
                    );

                    $result_uploader = fileUploader($Property, $fields['files']);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $draftObject->image;
                }
            }
        }

        //draft to Main
        $mainObject = $fields['mainModel']::find($draftObject->logo_id);// when main row is edit

        if (!is_object($mainObject)) {
            $logo = new $fields['mainModel'];// when add new row
            $logo->setFields($fields);
            $logo->save();
        } else {
            $mainObject->setFields($fields);
            $mainObject->save();
        }

        //if new record add main save to draft
        $newDraftObject = new $fields['draftModel'];
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        $newDraftObject->logo_id = $mainObject->Logo_id;
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();


        //update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {  //if add new object
            $draftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        }
        $draftObject->logo_id = $mainObject->Logo_id;
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();


        // add New Notification
        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به لگو شما با موفقیت اعمال شد",
            'messageType' => 2
        ];
        $this->sendSMS($draftObject->company_id, "accept");
        $notification->addNotification($Items);

    }

    public function rejectDraft($draftObject, $fields)
    {
        //Previous Draft
        if ($draftObject->$fields['draft_f_key'] != 0) {

            $a = "getBy_" . $fields['draft_f_key'] . "_and_company_id_and_isActive";
            $p_productDraftObject = $fields['draftModel']::$a($draftObject->$fields['draft_f_key'], $draftObject->company_id, 0)->orderBy($fields['draft_p_key'], 'DESC')->first();
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
            'msg' => "تغییرات مربوط به لگو شما با موفقیت اعمال نشد",
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


    // ----------*****************  Edit Logo By FARDIN  ******************------------ //

    public function editLogo($fields)
    {
        if ($fields['remove_image'] == 'on') {
            $deleteMainLogo = $this->DeleteLogoFromMainTable($fields);
            $deleteDraftLogo = $this->DeleteLogoFromDraftTable($fields);
            calculateScoreCompany($fields['company_id']);
        }

        if ($deleteMainLogo['result'] == 1 & $deleteDraftLogo['result'] == 1) {
            $msg = "لوگو با موفقیت حذف شد.";
            calculateScoreCompany($fields['company_id']);
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $mainLogo = adminc_logoModel::getBy_company_id($fields['company_id'])->first();
        $draftLogo = adminc_logo_dModel::getBy_company_id($fields['company_id'])->first();

        if (is_object($mainLogo)) {
            $fields['image'] = $mainLogo->image;
        }

        if (!empty($fields['companyLogo'])) {
            $result = $this->uploadImage($fields);
            $fields['image'] = $result['image'];
        }

        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo&action=add&id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $result['msg']);
        }

        if (!is_object($mainLogo)) {
            $resultMainLogo = $this->addLogoToMainTable($fields);
        } else {
            $resultMainLogo = $this->EditLogoInMainTable($fields, $mainLogo);
        }

        if (!is_object($resultMainLogo)) {
            $msg = "ذخیره لوگو با مشکل مواجه شد";
            redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo&action=add&id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        }

        $fields['logo_id'] = $resultMainLogo->Logo_id;
        if (!is_object($draftLogo)) {
            $resultDraftLogo = $this->addLogoToDraftTable($fields);
        } else {
            $resultDraftLogo = $this->EditLogoInDraftTable($fields, $mainLogo);
        }

        if (!is_object($resultDraftLogo)) {
            $msg = "ذخیره لوگو با مشکل مواجه شد";
            redirectPage(RELA_DIR . 'admin/index.php?component=companyLogo&action=add&id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        }
        calculateScoreCompany($fields['company_id']);
        $msg = "لوگو با موفقیت اضافه شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    public function uploadImage($fields)
    {
        $uploader = new Uploader();

        $property = [
            'image' => $fields['companyLogo'],
            'company_id' => $fields['company_id'],
            'folder_name' => 'logo'
        ];

        $sizes = [
            'size1' => ['width' => '122', 'height' => '125'],
            'size2' => ['width' => '140', 'height' => '140'],
            'size3' => ['width' => '150', 'height' => '150']
        ];

        return $uploader->cropAndCompressImage($property, $sizes);
    }

    public function addLogoToMainTable($fields)
    {
        $fields['title'] = '';
        $fields['description'] = '';
        $mainLogo = new adminc_logoModel($fields);
        $result = $mainLogo->save();

        if ($result['result'] != 1) {
            return false;
        }

        return $mainLogo;
    }

    public function addLogoToDraftTable($fields)
    {
        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['isAdmin'] = 1;
        $fields['admin_description'] = '';
        $fields['status'] = 1;
        $fields['isActive'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['title'] = ''; // todo: to be fixed
        $fields['description'] = ''; // todo: to be fixed

        $draftLogo = new adminc_logo_dModel($fields);
        $result = $draftLogo->save();

        if ($result['result'] != 1) {
            return false;
        }

        return $draftLogo;
    }

    public function EditLogoInMainTable($fields, $mainLogo)
    {
        $mainLogo->image = $fields['image'];
        $result = $mainLogo->save();

        if ($result['result'] != 1) {
            return false;
        }

        return $mainLogo;
    }

    public function EditLogoInDraftTable($fields)
    {
        $this->updateAll($fields);
        return $this->addLogoToDraftTable($fields);

    }

    public function DeleteLogoFromMainTable($fields)
    {
        $mainLogo = adminc_logoModel::getBy_company_id($fields['company_id'])->first();

        if (!is_object($mainLogo)) {
            return false;
        }

        return $mainLogo->delete();
    }

    public function DeleteLogoFromDraftTable($fields)
    {
        $draftLogos = adminc_logo_dModel::getBy_company_id($fields['company_id'])->get();

        if ($draftLogos['export']['recordsCount'] > 0) {
            foreach ($draftLogos['export']['list'] as $draftLogo) {
                if (is_object($draftLogo)) {
                    $draftLogo->delete();
                }
            }
        }

        $result['result'] = 1;
        return $result;
    }

    public function updateAll($fields)
    {
        $inputs['isActive'] = 0;
        $where = '`company_id` =' . $fields['company_id'] . ' AND `isActive` = 1';
        return adminc_logo_dModel::update($inputs, $where);
    }

    // ----------*****************  End Edit Logo By FARDIN  ******************------------//

    public function deleteAllLogoByCompanyId($company_id)
    {
        //delete from main table
        $logos = adminc_logoModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($logos['export']['recordsCount'] > 0) {
            foreach ($logos['export']['list'] as $logo) {
                $logo->delete();
            }
        }

        //delete from draft table
        $logos = adminc_logo_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($logos['export']['recordsCount'] > 0) {
            foreach ($logos['export']['list'] as $logo) {
                $logo->delete();
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
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر لگو را تایید نمودند.";
        }else{
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر لگو رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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

