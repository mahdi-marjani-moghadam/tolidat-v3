<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.companyEmails.model.php");
include_once(dirname(__FILE__) . "/admin.companyEmailsDraft.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
include_once ROOT_DIR . 'component/branch/admin/model/admin.branch.model.php';

/**
 * Class registerController
 */
class admincompany_EmailsController
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


    /* -----------------------------------------------------------------------
     * --------------------------- Main Item --------------------------
     * -----------------------------------------------------------------------
    */

    public function getAllEmail($id)
    {
        $result = admincompany_emailsModel::getBy_company_id($id)->getList();

        if ($result['result'] != '1') {
            $result['msg'] = 'اطلاعات به درستی ذخیره نشد';
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $export['company_id'] = $id;

        return $export;
    }

    /**
     * showCompanyEmailAddForm
     *
     * @param $fields
     * @param $msg
     * @author
     * @copyright 2017 The daba Group
     * @method function showCompanyEmailAddForm($fields, $msg)
     * @version 1.0.1
     */
    public function showCompanyEmailAddForm($fields, $msg)
    {

        $this->fileName = 'admin.companyEmail.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * showCompanyEmailEditForm
     *
     * @param $fields
     * @param $msg
     * @author
     * @copyright 2017 The daba Group
     * @method function showCompanyEmailEditForm($fields, $msg)
     * @version 1.0.1
     */
    public function showCompanyEmailEditForm($fields, $msg)
    {
        $result = adminc_Emails_dModel::getBy_emails_id_and_isActive_and_status($fields['email_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }

        $emailObject = adminc_emailsModel::find($fields['email_id']);

        if (!is_object($emailObject)) {
            $msg = "رکورد اصلی یافت نشد!";
            redirectPage(RELA_DIR . 'admin/index.php?component= companyEmails', $msg);
            die();
        }
        $export = $emailObject->fields;
        $export['Emails_id'] = $emailObject->Emails_id;
        $export['branch_id'] = $fields['branch_id'];
        $export['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.companyEmail.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * showList
     *
     * @param $fields
     * @author
     * @copyright 2017 The daba Group
     * @method function showList($fields)
     * @version 1.0.1
     */
    public function showList($fields)
    {
        $this->fileName = 'admin.companyEmail.showList.php';
        $emailObject = adminc_emailsModel::getBy_company_id_and_branch_id($fields['company_id'], $fields['branch_id'])->getList();
        if ($emailObject['result'] != '1') {
            $this->template('', $emailObject['msg']);
            die();
        }
        $export['list'] = $emailObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $export['branch_id'] = $fields['branch_id'];
        $this->template($export);
        die();
    }

    /**
     * add companyEmails
     *
     * @param $fields
     * @author
     * @copyright 2017 The daba Group
     * @method function showList($fields, $files)
     * @version 1.0.1
     */
    public function add($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_emails_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "companyEmails";

        ////////////////////////////////////Add new record

        for ($i = 0; $i < count($fields['company_email']['subject']); $i++) {
            $field['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
            $field['image'] = '';
            $field['status'] = '1';

            if (isset($files['name'])) {
                if ($files['name'][$i] != '') {
                    $file['name'] = $files['name'][$i];
                    $file['type'] = $files['type'][$i];
                    $file['tmp_name'] = $files['tmp_name'][$i];
                    $file['error'] = $files['error'][$i];
                    $file['size'] = $files['size'][$i];
                    $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $componentName . "/", 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => '',);
                    $result_uploader = fileUploader($Property, $file);
                    $field['image'] = $result_uploader['image_name'];
                }
            }

            $field['subject'] = $fields['company_email']['subject'][$i];
            $field['email'] = $fields['company_email']['email'][$i];
            $field['company_id'] = $fields['company_id'];
            $field['branch_id'] = $fields['branch_id'];


            if (trim($field['subject']) != '') {
                $newMainObject = new $mainModel();
                $newMainObject->setFields($field);
                $newMainObject->save();

                ////////////////////////////////////Save to Darft
                $newDraftObject = new $draftModel();
                $newDraftObject->setFields($newMainObject->fields);
                $newDraftObject->$draft_f_key = $newMainObject->$main_p_key;
                $newDraftObject->company_id = $newMainObject->company_id;
                $newDraftObject->isActive = 1;
                $newDraftObject->isAdmin = 1;
                $newDraftObject->status = 1;
                $newDraftObject->editor_id = $editor_id;
                $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
                $newDraftObject->save();
            }

        }
        $msg = "پست الکترونیک با موفقیت اضافه شد.";
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function addWithoutDraft($fields)
    {
        if (is_array($fields)) {
            $phoneObject = new adminc_emailsModel();
            $phoneObject->setField($fields);
            $result = $phoneObject->save();
            return $result;
        }
        $result['result'] = -1;
        return $result;
    }

    public function edit($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_emails_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "companyEmails";

        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';
        $fields['company_id'] = $fields['company_id'];
        $fields['branch_id'] = $fields['branch_id'];

        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields[$main_p_key]);
        if (is_object($MainObject)) {
            if ($fields['remove_image'] != 'on') {
                if ($files['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $files['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $componentName . "/", 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => '',);
                    $result_uploader = fileUploader($Property, $files);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $MainObject->image;
                }
            } else {
                $fields['image'] = '';
            }

            $MainObject->setFields($fields);
            $MainObject->save();

            ////////////////////////////////////update pervious record of draft
            $getBy = "getBy_" . $draft_f_key . "_and_company_id_and_isActive";
            $perviousDraftObject = $draftModel::$getBy($MainObject->$main_p_key, $MainObject->company_id, 1)->orderBy($draft_p_key, 'DESC')->first();

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

            ////////////////////////////////////Add new record in draft
            $draftObject = new $draftModel();
            $draftObject->setFields($MainObject->fields);
            $draftObject->$draft_f_key = $MainObject->$main_p_key;
            $draftObject->company_id = $MainObject->company_id;
            $draftObject->isActive = 1;
            $draftObject->isAdmin = 1;
            $draftObject->status = 1;
            $draftObject->editor_id = $editor_id;
            $draftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $draftObject->save();
            $msg = "عملیات با موفقیت انجام شد";
        } else {
            $msg = "رکورد اصلی یافت نشد!";
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function delete($fields)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_emails_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "companyEmails";

        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($fields['id']);
        if (is_object($mainObject)) {
            $company_id = $mainObject->company_id;
            $getBy = "getBy_" . $draft_f_key;
            $draftObject = $draftModel::$getBy($mainObject->$main_p_key)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $draftRecord->delete();
            }

            $mainObject->delete();
            $msg = "پست الکترونیک با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $company_id . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function deleteWithCompanyId($company_id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_emails_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "companyPhones";

        ////////////////////////////////////delete Record

        //delete a phone from main table
        $mainObject = $mainModel::getBy_company_id($company_id)->get();
        if ($mainObject['export']['recordsCount'] != 0) {
            foreach ($mainObject['export']['st'] as $mainRecord) {
                // fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $result = $mainRecord->delete();
            }

        }

        //delete a phone from draft table
        if ($result['result'] == 1) {
            $draftObject = $draftModel::getBy_company_id($company_id)->get();
            if ($draftObject['export']['recordsCount'] != 0) {
                foreach ($draftObject['export']['list'] as $draftRecord) {
                    // fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                    $result = $draftRecord->delete();
                }
            }
        }

        return $result;
    }

    public function getEmailByCompanyId($company_id)
    {
        $emailResult = adminc_emailsModel::getBy_company_id($company_id)->getList();
        return $emailResult;
    }

    public function getEmailById($email_id)
    {
        $emailResult = adminc_emailsModel::find($email_id);
        return $emailResult;
    }

    /* -----------------------------------------------------------------------
     * --------------------------- Draft Item --------------------------
     * -----------------------------------------------------------------------
    */

    public function showDraftCompanyEmail($id)
    {
        //$result = adminc_Phones_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Phones_d_id', 'DESC')->getList();
        //$result = adminc_Phones_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Phones_d_id', 'DESC')->getList();
        $company = new adminc_Emails_dModel();
        $result = $company->findCompanyEmailBranchObject($id);
        //print_r_debug($result);

        $phonesReal = adminc_Emails_dModel::getBy_status_and_company_id_and_isActive_and_branch_id(-1, $id, 1, 0)->getList();
        foreach ($phonesReal['export']['list'] as $key => $fildes) {
            $result[] = $fildes;
        }
        $this->fileName = 'admin.companyEmailDraft.showList.php';
        $this->template($result);
    }

    public function checkBranch($branch_id)
    {
        $branch = adminc_branchModel::getBy_parent_id_and_status($branch_id, 2)->getList();
//        print_r_debug($branch);
        if ($branch['export']['recordsCount'] <= 0 & $branch_id != 0) {
            return false;
        }
        return true;
    }

    public function editDraftCompanyEmailForm($fields)
    {
        $result = adminc_Emails_dModel::find($fields['draft_id']);
        if (!$this->checkBranch($result->fields['branch_id'])) {
            $msg = "لطفا اول شعبه تایید شود";
            redirectPage(RELA_DIR . "admin/index.php?component=company&action=showDraftCompany", $msg);
        }
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
            $this->fileName = 'admin.companyEmailDraft.editForm.php';
            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=companyEmail", $msg);
        }
    }

    public function editDraftCompanyEmail($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_emails_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyEmails";
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
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

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

        $countObject = $fields['draftModel']::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy($fields['draft_p_key'], 'DESC')->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = $fields['componentName'];
        $item['countItem'] = $countObject['export']['recordsCount'];
        calculateScoreCompany($fields['company_id']);


        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/?component=' . $componentName . '&action=showDraftCompanyEmail&id=' . $draftObject->company_id, $msg);

    }

    public function acceptDraft($draftObject, $fields)
    {

        $fields[$fields['draft_f_key']] = $draftObject->$fields['main_p_key'];
        $fields['company_id'] = $draftObject->company_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 1;
        $fields['branch_id'] = $draftObject->branch_id;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';

        if (isset($fields['files']['name'])) {
            if ($fields['remove_image'] == 'on') {
                $fields['image'] = '';
            } else {
                if ($fields['files']['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $fields['files']['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $fields['componentName'] . "/", 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => '',);
                    $result_uploader = fileUploader($Property, $fields['files']);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $draftObject->image;
                }
            }

        }
        ///draft to Main
        if ($draftObject->$fields['draft_f_key'] == 0) {
            $mainObject = new $fields['mainModel'];// when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];

        } else {

            $mainObject = $fields['mainModel']::find($draftObject->$fields['draft_f_key']);// when main row is edit
            if (!is_object($mainObject)) {
                $msg = "رکورد اصلی یافت نشد! ";
                redirectPage(RELA_DIR . 'admin/index.php?component=' . $fields['componentName'] . '&action=showDraft' . ucfirst($fields['componentName']) . '&id=' . $fields['draftModel']->company_id, $msg);
            }
        }

        $mainObject->setFields($fields);

        $mainObject->save();

//if new record add main save to draft

        $newDraftObject = new $fields['draftModel'];
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());;
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();


//update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {  //if add new object
            $draftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        }
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        //$draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['company_id'];;
        $draftObject->save();
        // add New Notification


        $notification = new adminNotificationController();
        $Items = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => "تغییرات مربوط به پست الکترونیک شما با موفقیت اعمال شد", 'messageType' => 2];
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
        $fields = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => "تغییرات مربوط به پست الکترونیک شما با موفقیت اعمال نشد", 'messageType' => 2];
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

        $item = array("product" => "0", "certification" => "1", "honour" => "2", "businessLicence" => "3", "history" => "4", "companyNews" => "5", "companyAddresses" => "6", "companyPhones" => "7", "companyEmails" => "8", "companyWebsites" => "9", "companyBanner" => "10", "companyLogo" => "11", "companyCommercialName" => "12", "licences" => "13", "companySocials" => "14", "companyPositions" => "15", "branch" => "16", "wiki" => "17");
        $editField = $companyObject->edit;

        if ($items['countItem'] < 1) {
            $editField[$item[$items["componentName"]]] = 0;
            $companyObject->edit = $editField;
            $companyObject->save();
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
            die();
        }
    }

    public function deleteAllEmailByCompanyId($company_id)
    {
        //delete from main table
        $emails = adminc_emailsModel::getAll()->where('company_id', '=', $company_id)->get();

        if ($emails['export']['recordsCount'] > 0) {
            foreach ($emails['export']['list'] as $email) {
                $email->delete();
            }
        }

        //delete from draft table
        $emails = adminc_emails_dModel::getAll()->where('company_id', '=', $company_id)->get();

        if ($emails['export']['recordsCount'] > 0) {
            foreach ($emails['export']['list'] as $email) {
                $email->delete();
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
            $smsText = "کاربر محترم  \n کارشناسان سایت تولیدات تغییرات اعمال شده بر ایمیل را تایید نمودند .";
        }else{
            $smsText =  " کاربر محترم\n  تغییرات اعمال شده بر ایمیل رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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

