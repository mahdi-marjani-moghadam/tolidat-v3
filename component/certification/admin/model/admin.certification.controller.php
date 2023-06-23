<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/admin.certification.model.php';
include_once dirname(__FILE__) . '/admin.certificationDraft.model.php';
include_once dirname(__FILE__) . '/admin.certificationList.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

/**
 * Class registerController.
 */
class adminCertificationController
{
    public $exportType;

    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [],$msg = '')
    {
        global $messageStack;

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

    //--------------------------------------- Certification----------

    public function showCertificationAddForm($fields, $msg)
    {
        $companyCertificationObject = adminc_certificationModel::getBy_company_id($fields['company_id'])->getList();
        foreach ($companyCertificationObject['export']['list'] as $key => $value) {
            $companyCertification[] = $value[certification_list_id];
        }
        $CertificationObject = admincertification_listModel::getBy_not_Certification_list_id($companyCertification)->getList();
        $this->fileName = 'admin.certification.addForm.php';
        $export['list'] = $CertificationObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export, $msg);
        die();
    }

    public function showCertificationEditForm($fields, $msg)
    {
        $certificationObject = admincertification_listModel::find($fields['Certification_list_id']);
        if (!is_object($certificationObject)) {
            $msg = " رکورد در جدول اصلی موجود نیست.";
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $export['list'] = $certificationObject->fields;
        $export['Certification_list_id'] = $fields['Certification_list_id'];
        $this->fileName = 'admin.certification.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function addCertification($fields, $files)
    {
        global $admin_info;
        $componentName = "certification";
        $fields['image'] = '';
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        ////////////////////////////////////
        if (trim($fields['title']) != '') {
            if ($files['name'] != '') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $files['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . "certification/"
                );
                $result_uploader = fileUploader($Property, $files);
                $fields['image'] = $result_uploader['image_name'];
            }
            $certificationObject = new admincertification_listModel();
            $certificationObject->setFields($fields);
            $result = $certificationObject->save();
            if ($result['result'] != 1) {
                $msg = "خطا در عملیات";
                redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName, $msg);
                die();
            }
        }

        $msg = "گواهی با موفقیت اضافه شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName, $msg);
        die();
    }

    public function editCertification($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $mainModel = 'admincertification_listModel';
        $componentName = 'certification';
        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';

        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields['Certification_list_id']);
        if (!is_object($MainObject)) {
            $msg = "رکورد اصلی یافت نشد ";
            redirectPage(RELA_DIR . 'admin/index.php', $msg);
            die();
        }
        if ($fields['title']) {
            if ($fields['remove_image'] == 'on') {
                $fields['image'] = '';
                fileRemover(COMPANY_ADDRESS_ROOT . 'certification/', $MainObject->image);
            } else {
                if ($files['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg',
                        'new_name' => $files['name'],
                        'max_size' => '2048000',
                        'upload_dir' => COMPANY_ADDRESS_ROOT . "certification/"
                    );
                    fileRemover(COMPANY_ADDRESS_ROOT . 'certification/', $MainObject->image);
                    $result_uploader = fileUploader($Property, $files);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $MainObject->image;
                }
            }
            $fields['company_id'] = $MainObject->company_id;
            $MainObject->setFields($fields);
            $MainObject->save();
        } else {
            $msg = "اطلاعات به درستی وارد نشده است";
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName, $msg);
            die();
        }

        $msg = "عملیات به درستی انجام شد";

        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function deleteCertification($id)
    {
        ////////////////////////////////////
        $draftModel = 'admincertification_listModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($id);
        if (is_object($mainObject)) {
            fileRemover(COMPANY_ADDRESS_ROOT . 'certification/', $mainObject->image);
            $mainObject->delete();
            $msg = "مجوز با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }
        redirectPage(RELA_DIR . 'admin/index.php?component=certification', $msg);
        die();
    }

    public function showList($fields)
    {
        $certificationObject = new admincertification_listModel;
        $certification = $certificationObject::getAll()->getList;
        if ($certification['result'] != '1') {
            $this->fileName = 'admin.certification.showList.php';
            $this->template('', $certification['msg']);
            die();
        }
        $export['list'] = $certification['export']['list'];
        $export['recordsCount'] = $certification['export']['recordsCount'];
        $export['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.certification.showList.php';
        $this->template($export);
        die();
    }

    public function getCertification($fields)
    {
        $certificationObject = new admincertification_listModel;
        $certification = $certificationObject::getAll()->getList;
        if ($certification['result'] != '1') {
            $this->fileName = 'admin.certification.showList.php';
            $this->template('', $certification['msg']);
            die();
        }
        $export['list'] = $certification['export']['list'];
        $export['recordsCount'] = $certification['export']['recordsCount'];
        $export['company_id'] = $fields['company_id'];

        $this->fileName = 'admin.certification.showList.php';
        $this->template($export);
        die();
    }

//---------------------------------------company Certification----------

    public function showCompanyCertification($id)
    {
        //$result = adminc_certificationModel::getBy_company_id($id)->getList();
        $certificationObject = new adminc_certificationModel();
        $result = $certificationObject->getCertification($id);
        $this->fileName = 'admin.companyCertification.showList.php';
        if ($result['result'] != 1) {
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['company_id'] = $id;
        $this->template($export);
        die();
    }

    public function showCompanyCertificationAddForm($fields, $msg)
    {
        $companyCertificationObject = adminc_certificationModel::getBy_company_id($fields['company_id'])->getList();
        foreach ($companyCertificationObject['export']['list'] as $key => $value) {
            $companyCertification[] = $value[certification_list_id];
        }
        $CertificationObject = admincertification_listModel::getBy_not_Certification_list_id($companyCertification)->getList();
        $this->fileName = 'admin.companyCertification.addForm.php';
        $export['list'] = $CertificationObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export, $msg);
        die();
    }

    public function showCompanyCertificationEditForm($fields, $msg)
    {

        $result = adminc_certification_dModel::getBy_Certification_id_and_isActive_and_status($fields['Certification_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }

        $certificationObject = adminc_certificationModel::find($fields['Certification_id']);

        if (!is_object($certificationObject)) {
            $msg = " رکورد در جدول اصلی موجود نیست.";
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $fields['company_id'] = $certificationObject->company_id;

        $companyCertificationObject = adminc_certificationModel::getBy_company_id($fields['company_id'])->getList();
        foreach ($companyCertificationObject['export']['list'] as $key => $value) {
            if ($value['certification_list_id'] != $certificationObject->certification_list_id) {
                $companyCertification[] = $value['certification_list_id'];
            }
        }
        $CertificationObject = admincertification_listModel::getBy_not_Certification_list_id($companyCertification)->getList();
        $export['list'] = $CertificationObject['export']['list'];
        $export['select_id'] = $certificationObject->certification_list_id;

        $export['Certification_id'] = $fields['Certification_id'];
        $this->fileName = 'admin.companyCertification.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function addCompanyCertification($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_certification_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));


        ////////////////////////////////////check select item is in main list

        $result = admincertification_listModel::find($fields['certification_list_id']);
        if (!is_object($result)) {
            $msg = "این گواهی در جدول وجود ندارد";
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showCompanyCertification&id=' . $fields['company_id'], $msg);
        }

        ////////////////////////////////////check select item is not in company
        $result = $mainModel::getBy_certification_list_id($fields['certification_list_id'])->getList();
        if ($result['export']['recordsCount'] > 0) {
            $msg = "این گواهی قبلا درج شده است";
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showCompanyCertification&id=' . $fields['company_id'], $msg);
        }


        ////////////////////////////////////Add new record
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        // $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';
        $fields['status'] = '1';

        if (isset($files['name'])) {
            if ($files['name'] != '') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $files['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $componentName . "/",
                    'height' => '',
                    'wight' => '',
                    'error_msg' => '',
                    'success_msg' => '',
                );
                $result_uploader = fileUploader($Property, $files);
                $fields['image'] = $result_uploader['image_name'];
            }
        }
        $newMainObject = new $mainModel();
        $newMainObject->setFields($fields);
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


        ////////////////////////////////////find Draft
        $result = $draftModel::getBy_company_id_and_certification_list_id_and_status_and_isActive($newDraftObject->company_id, $newDraftObject->certification_list_id, 0, 1)->first();
        if (is_object($result)) {
            $result->status = 1;
            $result->isActive = 0;
            $result->save();
        }


        $msg = "مجوز با موفقیت اضافه شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showCompanyCertification&id=' . $fields['company_id'], $msg);
        die();
    }

    public function editCompanyCertification($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_certification_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';

        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields[$main_p_key]);
        if (is_object($MainObject)) {
            if ($fields['remove_image'] != 'on') {
                if ($files['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg',
                        'new_name' => $files['name'],
                        'max_size' => '2048000',
                        'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $componentName . "/",
                        'height' => '',
                        'wight' => '',
                        'error_msg' => '',
                        'success_msg' => '',
                    );
                    $result_uploader = fileUploader($Property, $files);
                    $fields['image'] = $result_uploader['image_name'];
                } else {
                    $fields['image'] = $MainObject->image;
                }
            } else {
                $fields['image'] = '';
            }

            $fields['company_id'] = $MainObject->company_id;
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
        redirectPage(RELA_DIR . 'admin/index.php?component=certification&action=showCompanyCertification&id=' . $fields['company_id'], $msg);
        die();
    }

    public function deleteCompanyCertification($id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_certification_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $imageAddress = str_replace("company", "", $componentName);

        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($id);
        if (is_object($mainObject)) {
            $company_id = $mainObject->company_id;
            $getBy = "getBy_" . $draft_f_key;
            $draftObject = $draftModel::$getBy($mainObject->$main_p_key)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $imageAddress . "/", $draftRecord->image);
                $draftRecord->delete();
            }
            $mainObject->delete();
            $msg = "مجوز با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }
        redirectPage(RELA_DIR . 'admin/index.php?component=certification&action=showCompanyCertification&id=' . $company_id, $msg);
        die();
    }

//---------------------------------------draft Certification----------

    public function showDraftCertification($id)
    {
        $draftObject = new adminc_certification_dModel();
        $result = $draftObject->getCertification($id);

        //$result = adminc_certification_dModel::getBy_status_and_company_id_and_isActive(0, $id, 1)->orderBy('Certification_d_id', 'DESC')->getList();

        if ($result['result'] != 1) {
            $this->fileName = 'admin.certificationDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.certificationDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftCertificationForm($fields)
    {

        $result = adminc_certification_dModel::getBy_certification_id($fields['certification_id'])->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }

        $result = adminc_certification_dModel::find($fields['draft_id']);
        if (is_object($result)) {
            $export = $result->fields;
            $k = adminc_certificationModel::getBy_company_id($result->company_id)->getlist();
            $z = '';
            foreach ($k['export']['list'] as $key => $value) {
                if ($k['export']['list'][$key]['certification_list_id'] != $result->certification_list_id) {
                    $z[] = $k['export']['list'][$key]['certification_list_id'];
                }
            }
            $y = admincertification_listModel::getBy_not_Certification_list_id($z)->getlist();
            $export['certification'] = $y['export']['list'];
            $this->fileName = 'admin.certificationDraft.editForm.php';
            $this->template($export);
            die();
        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=certification", $msg);
        }
    }

    public function editDraftCertification($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_certification_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

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
        if (isset($fields['files']['name'])) {
            if ($fields['remove_image'] == 'on') {
                $fields['image'] = '';
            } else {
                if ($fields['files']['name'] != '') {
                    $Property = array('type' => 'jpg,png,jpeg',
                        'new_name' => $fields['files']['name'],
                        'max_size' => '2048000',
                        'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/" . $fields['componentName'] . "/"
                    );
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
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();


//update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {  //if add new object
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
            'msg' => "تغییرات گواهی شما با موفقیت اعمال شد",
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
            $p_productDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
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
            'msg' => "تغییرات گواهی شما با موفقیت اعمال نشد",
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

        $item = array("product" => "0",             "certification" => "1",             "honour" => "2",             "businessLicence" => "3",             "history" => "4",             "companyNews" => "5",             "companyAddresses" => "6",             "companyPhones" => "7",             "companyEmails" => "8",             "companyWebsites" => "9",             "companyBanner" => "10",             "companyLogo" => "11",             "companyCommercialName" => "12",             "licences" => "13",             "companySocials" => "14",             "companyPositions" => "15",             "branch" => "16",             "wiki" => "17"
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

    public function deleteAllCertificationByCompanyId($company_id)
    {
        //delete from main table
        $certifications = adminc_certificationModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($certifications['export']['recordsCount'] > 0) {
            foreach ($certifications['export']['list'] as $certification) {
                $certification->delete();
            }
        }

        //delete from draft table
        $certifications = adminc_certification_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($certifications['export']['recordsCount'] > 0) {
            foreach ($certifications['export']['list'] as $certification) {
                $certification->delete();
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
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر گواهی را تایید نمودند.";
        }else{
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر گواهی رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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
