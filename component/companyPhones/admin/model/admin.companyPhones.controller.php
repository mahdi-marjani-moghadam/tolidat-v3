<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once dirname(__FILE__) . '/admin.companyPhones.model.php';
include_once dirname(__FILE__) . '/admin.companyPhonesDraft.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
include_once ROOT_DIR . 'component/branch/admin/model/admin.branch.model.php';

/**
 * Class registerController
 */
class admincompany_phonesController
{
    public $exportType;

    public $fileName;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg = '')
    {
        global $messageStack, $admin_info;

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';
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

    /////////////////////

    /**
     * showCompanyPhoneAddForm for phone
     *
     * @param $fields
     * @param $msg
     * @method function showCompanyPhoneAddForm($fields, $msg)
     * @copyright 2017 The daba Group
     * @method function showCompanyPhoneEditForm($fields, $msg)
     * @version 1.0.1
     *
     */
    public function showCompanyPhoneAddForm($fields, $msg)
    {
        $this->fileName = 'admin.companyPhone.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    public function showCompanyPhoneEditForm($fields, $msg)
    {
        $result = adminc_phones_dModel::getBy_phone_id_and_isActive_and_status($fields['phone_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = 'این رکورد قبلا توسط کاربر ویرایش شده است';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $phoneObject = adminc_phonesModel::find($fields['phone_id']);
        if (!is_object($phoneObject)) {
            $msg = 'رکورد اصلی یافت نشد!';
            redirectPage(RELA_DIR . 'admin/index.php?component= companyPhones', $msg);
            die();
        }
        $export = $phoneObject->fields;
        $export['Phones_id'] = $phoneObject->Phones_id;
        $export['company_id'] = $fields['company_id'];
        $export['branch_id'] = $fields['branch_id'];
        $this->fileName = 'admin.companyPhone.editForm.php';

        $this->template($export, $msg);
        die();
    }

    public function showList($fields)
    {
        $this->fileName = 'admin.companyPhone.showList.php';
        $phoneObject = adminc_phonesModel::getBy_company_id_and_branch_id($fields['company_id'], $fields['branch_id'])->getList();

        if ($phoneObject['result'] != '1') {
            $this->template('', $phoneObject['msg']);
            die();
        }
        $export['branch_id'] = $fields['branch_id'];
        $export['list'] = $phoneObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export);
        die();
    }

    public function add($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = 'companyPhones';

        ////////////////////////////////////Add new record
        for ($i = 0; $i < count($fields['company_phone']['subject']); $i++) {
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

                    $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/' . $componentName . '/'];
                    $result_uploader = fileUploader($Property, $file);
                    $field['image'] = $result_uploader['image_name'];
                }
            }

            $field['subject'] = $fields['company_phone']['subject'][$i];
            $field['number'] = $fields['company_phone']['number'][$i];

            $field['state'] = $fields['company_phone']['state'][$i];

            if ($field['state'] == 0) {
                $field['state'] = ' ';
            }
            if ($field['state'] == 1) {
                $field['state'] = 'داخلی';
            }
            if ($field['state'] == 2) {
                $field['state'] = 'الی';
            }

            $field['value'] = $fields['company_phone']['value'][$i];
            $field['code'] = $fields['company_phone']['code'][$i];
            $field['company_id'] = $fields['company_id'];
            $field['branch_id'] = $fields['branch_id'];

            $field['isMain'] = 1;

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
                $newDraftObject->isMain = 1;
                $newDraftObject->editor_id = $editor_id;
                $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
                $newDraftObject->company_d_id = $newMainObject->company_id;
                $newDraftObject->admin_description = '';
                $newDraftObject->save();
            }
        }
        $msg = 'تلفن با موفقیت اضافه شد.';
        calculateScoreCompany($field['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function addWithoutDraft($fields)
    {
        if (is_array($fields)) {
            $phoneObject = new adminc_phonesModel();
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
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = 'companyPhones';

        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';
        $fields['code'] = $fields['code'];
        $fields['branch_id'] = $fields['branch_id'];
        $fields['company_id'] = $fields['company_id'];
        if ($fields['state'] == 0) {
            $fields['state'] = 'الی';
        }
        if ($fields['state'] == 1) {
            $fields['state'] = 'داخلی';
        }
        if ($fields['state'] == 2) {
            $fields['state'] = '';
        }
        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields[$main_p_key]);
        
        if (is_object($MainObject)) {
            if ($fields['remove_image'] != 'on') {
                if ($files['name'] != '') {
                    $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $files['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/' . $componentName . '/'];
                    $result_uploader = fileUploader($Property, $files);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $MainObject->image;
                }
            } else {
                $fields['image'] = '';
            }
            $fields['reference_type'] = ($MainObject->reference_type == '')?0:$MainObject->reference_type;
            $MainObject->setFields($fields);
            $MainObject->save();
            

            ////////////////////////////////////update pervious record of draft
            $getBy = 'getBy_' . $draft_f_key . '_and_company_id_and_isActive';
            $perviousDraftObject = $draftModel
                ::$getBy($MainObject->$main_p_key, $MainObject->company_id, 1)
                ->orderBy($draft_p_key, 'DESC')
                ->first();

            if (is_object($perviousDraftObject)) {
                $perviousDraftObject->isActive = 0;
                $perviousDraftObject->isAdmin = 1;
                $perviousDraftObject->status = 1;
                $perviousDraftObject->editor_id = $editor_id;
                $perviousDraftObject->save();
            } else {
                $msg = 'رکورد اصلی یافت نشد!';
            }

            ////////////////////////////////////Add new record in draft
            $draftObject = new $draftModel();
            $draftObject->setFields($MainObject->fields);
            $draftObject->$draft_f_key = $MainObject->$main_p_key;
            $draftObject->company_id = $MainObject->company_id;
            $draftObject->company_d_id = $draftObject->company_d_id == '' ? $MainObject->company_id : $draftObject->company_d_id;
            $draftObject->isActive = 1;
            $draftObject->isAdmin = 1;
            $draftObject->status = 1;
            $draftObject->editor_id = $editor_id;
            $draftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $draftObject->admin_description = $draftObject->admin_description == '' ? '' : $draftObject->admin_description;
            $draftObject->reference_type = ($draftObject->reference_type == '') ? 0 : $draftObject->reference_type;
            
            $draftObject->save();
            $msg = 'عملیات با موفقیت انجام شد';
        } else {
            $msg = 'رکورد اصلی یافت نشد!';
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function delete($fields)
    {
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = 'companyPhones';

        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($fields['phone_id']);

        if (is_object($mainObject)) {
            $company_id = $mainObject->company_id;
            $getBy = 'getBy_' . $draft_f_key;
            $draftObject = $draftModel::$getBy($mainObject->$main_p_key)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                //fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $draftRecord->delete();
            }

            $mainObject->delete();
            $msg = 'تلفن با موفقیت حذف گردید.';
        } else {
            $msg = 'رکورد اصلی یافت نشد.';
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&company_id=' . $company_id . '&branch_id=' . $fields['branch_id'], $msg);
        die();
    }

    public function deleteWithCompanyId($company_id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = 'companyPhones';

        ////////////////////////////////////delete Record

        //delete a phone from main table
        $mainObject = $mainModel::getBy_company_id($company_id)->get();
        if ($mainObject['export']['recordsCount'] != 0) {
            foreach ($mainObject['export']['list'] as $mainRecord) {
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

    public function getByCompanyId($company_id, $branch_id = 0)
    {
        $phone = adminc_phones_dModel::getBy_company_id_and_branch_id($company_id, $branch_id)->getList();
        return $phone;
    }

    public function getPhoneByCompanyId($company_id)
    {
        $phoneResult = adminc_phonesModel::getBy_company_id($company_id)->getList();
        return $phoneResult;
    }

    public function getPhoneById($phone_id)
    {
        $phoneResult = adminc_phonesModel::find($phone_id);
        return $phoneResult;
    }

    //---------------------------------------draft CompanyPhone----------
    public function showDraftCompanyPhone($id)
    {
        //$result = adminc_Phones_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Phones_d_id', 'DESC')->getList();

        $company = new adminc_Phones_dModel();
        $result = $company->findCompanyPhoneBranchObject($id);
        //print_r_debug($result);

        $phonesReal = adminc_Phones_dModel::getBy_status_and_company_id_and_isActive_and_branch_id(-1, $id, 1, 0)->getList();
        foreach ($phonesReal['export']['list'] as $key => $fildes) {
            $result[] = $fildes;
        }
        $this->fileName = 'admin.companyPhoneDraft.showList.php';
        $this->template($result);
    }
    public function checkBranch($branch_id)
    {
        $branch = adminc_branchModel::getBy_parent_id_and_status($branch_id, 2)->getList();
        //        print_r_debug($branch);
        if (($branch['export']['recordsCount'] <= 0) & ($branch_id != 0)) {
            return false;
        }
        return true;
    }
    public function editDraftCompanyPhoneForm($fields)
    {
        $result = adminc_Phones_dModel::find($fields['draft_id']);
        if (!$this->checkBranch($result->fields['branch_id'])) {
            $msg = 'لطفا اول شعبه تایید شود';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
        }
        if (is_object($result)) {
            $export = $result->fields;
            $export['category_id'] = tagToArray($result->category_id)['export']['list'];
            $export['date'] = convertDate($result->date);
            $export['branch_id'] = $fields['branch_id'];
            $this->fileName = 'admin.companyPhoneDraft.editForm.php';
            $this->template($export);
            die();
        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=companyPhone', $msg);
        }
    }

    public function editDraftCompanyPhone($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = 'companyPhones';
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

        if ($fields['state'] == 0) {
            $fields['state'] = 'داخلی';
        }
        if ($fields['state'] == 1) {
            $fields['state'] = 'الی';
        }

        if ($fields['state'] == 2) {
            $fields['state'] = '';
        }
        //find draft record
        $draftObject = $draftModel::find($fields['draft_id']);
        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = 'رکورد ویرایش شده یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showDraft' . ucfirst($componentName) . '&id=' . $draftModel->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } elseif ($fields['process'] == -1) {
            $this->rejectDraft($draftObject, $fields);
        }
        //print_r_debug($draftObject);
        $countObject = $fields['draftModel']
            ::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)
            ->orderBy($fields['draft_p_key'], 'DESC')
            ->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = $fields['componentName'];
        $item['countItem'] = $countObject['export']['recordsCount'];
        calculateScoreCompany($fields['company_id']);
        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/?component=companyPhones&action=showDraftCompanyPhone&id=' . $draftObject->company_id, $msg);
    }

    public function acceptDraft($draftObject, $fields)
    {
        $fields[$fields['draft_f_key']] = $draftObject->$fields['main_p_key'];
        $fields['isMain'] = $draftObject->isMain;
        $fields['company_id'] = $draftObject->company_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 1;
        $fields['branch_id'] = $draftObject->branch_id;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';

        ///draft to Main

        if ($draftObject->$fields['draft_f_key'] == 0) {
            $mainObject = new $fields['mainModel'](); // when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];
        } else {
            $mainObject = $fields['mainModel']::find($draftObject->$fields['draft_f_key']); // when main row is edit
            if (!is_object($mainObject)) {
                $msg = 'رکورد اصلی یافت نشد! ';
                redirectPage(RELA_DIR . 'admin/index.php?component=' . $fields['componentName'] . '&action=showDraft' . ucfirst($fields['componentName']) . '&id=' . $fields['draftModel']->company_id, $msg);
            }
        }

        $mainObject->setFields($fields);
        $mainObject->save();

        //if new record add main save to draft

        $newDraftObject = new $fields['draftModel']();
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();

        //update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {
            //if add new object
            $draftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        }
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        //$draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();
        // add New Notification
        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => 'تغییرات مربوط به تلفن شما با   موفقیت اعمال شد ',
            'messageType' => 2,
        ];
        $this->sendSMS($draftObject->company_id, 'accept');
        $notification->addNotification($Items);
    }

    public function rejectDraft($draftObject, $fields)
    {
        //Previous Draft
        if ($draftObject->$fields['draft_f_key'] != 0) {
            $a = 'getBy_' . $fields['draft_f_key'] . '_and_company_id_and_isActive';
            $p_productDraftObject = $fields['draftModel']
                ::$a($draftObject->$fields['draft_f_key'], $draftObject->company_id, 0)
                ->orderBy($fields['draft_p_key'], 'DESC')
                ->first();
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
            'msg' => 'تغییرات مربوط به تلفن شما با موفقیت  اعمال نشد',
            'messageType' => 2,
        ];
        $this->sendSMS($draftObject->company_id, 'reject');
        $notification->addNotification($fields);
    }

    public function editCompany($items)
    {
        //find company information for edit feild 'EDIT'
        include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
        $companyObject = admincompanyModel::find($items['id']);
        if (!is_object($companyObject)) {
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $companyObject['msg']);
            die();
        }

        $item = ['product' => '0', 'certification' => '1', 'honour' => '2', 'businessLicence' => '3', 'history' => '4', 'companyNews' => '5', 'companyAddresses' => '6', 'companyPhones' => '7', 'companyEmails' => '8', 'companyWebsites' => '9', 'companyBanner' => '10', 'companyLogo' => '11', 'companyCommercialName' => '12', 'licences' => '13', 'companySocials' => '14', 'companyPositions' => '15', 'branch' => '16', 'wiki' => '17'];
        $editField = $companyObject->edit;

        if ($items['countItem'] < 1) {
            $editField[$item[$items['componentName']]] = 0;
            $companyObject->edit = $editField;
            $companyObject->save();

            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
            die();
        }
    }

    //---------------------------------------Wiki CompanyPhone----------

    public function showWikiCompanyPhone($id)
    {
        $result = adminc_Phones_dModel::getBy_status_and_company_id_and_isWiki(0, $id, 1)
            ->orderBy('Phones_d_id', 'DESC')
            ->getList();
        //print_r_debug($result);$result['result'] = -1;
        if ($result['result'] != 1) {
            $this->fileName = 'admin.companyPhoneWiki.showList.php';
            $msg = 'خطا در عملیات';
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.companyPhoneWiki.showList.php';
        $this->template($export);
        die();
    }

    public function editWikiCompanyPhoneForm($fields)
    {
        $result = adminc_Phones_dModel::find($fields['wiki_id']);
        if (is_object($result)) {
            $export = $result->fields;
            $export['category_id'] = tagToArray($result->category_id)['export']['list'];
            $export['date'] = convertDate($result->date);
            //print_r_debug($export);
            //include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
            //$category = new adminCategoryModel();
            //$resultCategory = $category->getCategoryOption();
            ///if ($resultCategory['result'] == 1) {
            ///    $export['category'] = $category->list;
            //}
            $this->fileName = 'admin.companyPhoneWiki.editForm.php';
            $this->template($export);
            die();
        } else {
            $msg = 'رکورد یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $msg);
        }
    }

    public function editWikiCompanyPhone($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_phones_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('adminc_', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = 'companyPhones';
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

        //find draft record
        $draftObject = $draftModel::find($fields['wiki_id']);
        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = 'رکورد ویرایش شده یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showWikiCompanyPhone&id=' . $draftModel->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptWiki($draftObject, $fields);
        } elseif ($fields['process'] == -1) {
            $this->rejectWiki($draftObject, $fields);
        }
        //print_r_debug($draftObject);
        $countObject = $fields['draftModel']
            ::getBy_status_and_company_id_and_isWiki(0, $draftObject->company_id, 1)
            ->orderBy($fields['draft_p_key'], 'DESC')
            ->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = $fields['componentName'];
        $item['countItem'] = $countObject['export']['recordsCount'];

        $this->editCompanyWikiField($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showWikiCompanyPhone&id=' . $draftObject->company_id, $msg);
    }

    public function acceptWiki($draftObject, $fields)
    {
        $fields[$fields['draft_f_key']] = $draftObject->$fields['main_p_key'];
        $fields['company_id'] = $draftObject->company_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 1;
        $fields['isWiki'] = 0;

        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        ///draft to Main

        if ($draftObject->$fields['draft_f_key'] == 0) {
            $mainObject = new $fields['mainModel'](); // when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];
        } else {
            $mainObject = $fields['mainModel']::find($draftObject->$fields['draft_f_key']); // when main row is edit
            if (!is_object($mainObject)) {
                $msg = 'رکورد اصلی یافت نشد! ';
                redirectPage(RELA_DIR . 'admin/index.php?component=' . $fields['componentName'] . '&action=showWikiCompanyPhone&id=' . $fields['draftModel']->company_id, $msg);
            }
        }

        $mainObject->setFields($fields);
        $mainObject->save();

        //if new record add main save to draft

        $newDraftObject = new $fields['draftModel']();
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->isWiki = 0;
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();

        //update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {
            //if add new object
            $draftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        }
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;
        $draftObject->isWiki = 0;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();
        // add New Notification
        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => 'تغییرات مربوط به تلفن شما با موفقیت اعمال شد',
            'messageType' => 2,
        ];

        $notification->addNotification($Items);
    }

    public function rejectWiki($draftObject, $fields)
    {
        //Previous Draft
        if ($draftObject->$fields['draft_f_key'] != 0) {
            $a = 'getBy_' . $fields['draft_f_key'] . '_and_company_id_and_isActive';
            $p_productDraftObject = $fields['draftModel']
                ::$a($draftObject->$fields['draft_f_key'], $draftObject->company_id, 0)
                ->orderBy($fields['draft_p_key'], 'DESC')
                ->first();
            $p_productDraftObject->isActive = 1;
            $p_productDraftObject->status = 1;
            $p_productDraftObject->isAdmin = 1;
            $p_productDraftObject->editor_id = $fields['editor_id'];
            $p_productDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $p_productDraftObject->save();
        }
        //reject Draft
        $draftObject->isActive = -1;
        $draftObject->isWiki = 0;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;
        $draftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $draftObject->editor_id = $fields['editor_id'];
        $draftObject->save();
    }

    public function editCompanyWikiField($items)
    {
        //find company information for edit feild 'EDIT'
        include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
        $companyObject = admincompanyModel::find($items['id']);
        if (!is_object($companyObject)) {
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $companyObject['msg']);
            die();
        }
        $item = [
            'companyAddresses' => '0',
            'companyPhones' => '1',
        ];
        $editField = $companyObject->edit_wiki;
        if ($items['countItem'] < 1) {
            $editField[$item[$items['componentName']]] = 0;

            $companyObject->edit_wiki = $editField;
            $companyObject->save();
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $msg);
            die();
        }
    }

    public function deleteAllPhoneByCompanyId($company_id)
    {
        //delete from main table
        $phones = adminc_phonesModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($phones['export']['recordsCount'] > 0) {
            foreach ($phones['export']['list'] as $phone) {
                $phone->delete();
            }
        }

        //delete from draft table
        $phones = adminc_phones_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($phones['export']['recordsCount'] > 0) {
            foreach ($phones['export']['list'] as $phone) {
                $phone->delete();
            }
        }

        return;
    }

    public function sendSMS($company_id, $messageType)
    {
        include_once ROOT_DIR . 'component/login/model/login.model.php';
        $member = new members();
        $smsText = '';

        if ($messageType == 'accept') {
            $smsText = " کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر تلفن را تایید نمودند.";
        } else {
            $smsText = "  کاربر محترم\n تغییرات اعمال شده بر تلفن رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
        }

        $memberData = $member
            ::getAll()
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
