<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.companyNews.model.php");
include_once(dirname(__FILE__) . "/admin.companyNewsDraft.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class registerController
 */
class admincompany_newsController
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

    public function showCompanyNewsAddForm($fields, $msg)
    {
        $this->fileName = 'admin.companyNews.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    public function showCompanyNewsEditForm($fields, $msg)
    {

        $result = adminc_news_dModel::getBy_news_id_and_isActive_and_status($fields['news_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }

        $companyNews = adminc_newsModel::find($fields['news_id']);
        $export = $companyNews->fields;
        $export['date'] = convertDate($export['date']);
        $export['date_news'] = convertDate($export['date_news']);
        $export['news_id'] = $fields['news_id'];
        $this->fileName = 'admin.companyNews.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function showList($fields)
    {
        $this->fileName = 'admin.companyNews.showList.php';
        $honourObject = adminc_newsModel::getBy_company_id($fields['company_id'])->getList();
        if ($honourObject['result'] != '1') {

            $this->template('', $honourObject['msg']);
            die();
        }
        $export['list'] = $honourObject['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $this->template($export);
        die();
    }

    public function add($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_news_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyNews";
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $imageAddress = str_replace("company", "", $componentName);

        ////////////////////////////////////Add new record
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        
        $fields['date_news'] = ($fields['date_news'] != '')?convertJToGDate($fields['date_news']):date('Y-m-d');
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';
        $fields['status'] = '1';
        
        if (!empty($fields['newsImage'])) {
            $uploader = new Uploader();

            $property = [
                'image' => $fields['newsImage'],
                'company_id' => $fields['company_id'],
                'folder_name' => 'news'
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
        $newDraftObject->admin_description = ($newDraftObject->admin_description == '') ? '' : $newDraftObject->admin_description;
        $newDraftObject->save();
        $msg = "خبر با موفقیت اضافه شد.";
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function edit($fields, $files)
    {

        global $admin_info;

        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_news_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyNews";
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $imageAddress = str_replace("company", "", $componentName);

        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['date_news'] = convertJToGDate($fields['date_news']);
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';

        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields[$main_p_key]);
        if (is_object($MainObject)) {
            if ($fields['remove_image'] != 'on') {
                if (!empty($fields['newsImage'])) {
                    $uploader = new Uploader();
                    $property = [
                        'image' => $fields['newsImage'],
                        'company_id' => $fields['company_id'],
                        'folder_name' => 'news'
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
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function delete($id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_news_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyNews";
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
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
            $msg = "خبر با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }
        calculateScoreCompany($company_id);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $company_id, $msg);
        die();
    }

    public function getByCompanyId($company_id)
    {

        $newsObject = adminc_newsModel::getBy_company_id($company_id)->getList();
        return $newsObject;
    }

    //---------------------------------------draft CompanyNews----------
    public function showDraftCompanyNews($id)
    {
        $result = adminc_news_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('News_d_id', 'DESC')->getList();

        if ($result['result'] != 1) {
            $this->fileName = 'admin.companyNewsDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.companyNewsDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftCompanyNewsForm($fields)
    {
        $result = adminc_news_dModel::find($fields['draft_id']);
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

            $this->fileName = 'admin.companyNewsDraft.editForm.php';
            $this->template($export, $msg);
            die();
        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=companyNews", $msg);
        }
    }

    public function editDraftCompanyNews($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_news_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyNews";
        $imageAddress = "news";
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
        $fields['date_news'] = convertJToGDate($fields['date_news']);
        $fields['image'] = '';


        if ($fields['remove_image'] != 'on') {
            if (!empty($fields['newsImage'])) {
                $uploader = new Uploader();
                $property = [
                    'image' => $fields['newsImage'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'news'
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


        if ($fields['remove_image'] != 'on') {
            if (!empty($fields['newsImage'])) {
                $uploader = new Uploader();
                $result = $uploader->cropAndCompressImage([
                    'image' => $fields['newsImage'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'news'
                ]);
                $fields['image'] = $result['image'];
            } else {
                $fields['image'] = $draftObject->image;
            }
        } else {
            $fields['image'] = '';
        }


        ///draft to Main

        if ($draftObject->$fields['draft_f_key'] == 0) {
            $mainObject = new $fields['mainModel']; // when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];
        } else {
            $mainObject = $fields['mainModel']::find($draftObject->$fields['draft_f_key']); // when main row is edit
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
            'msg' => "تغییرات مربوط به اخبار شما با موفقیت اعمال شد",
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
            'msg' => "تغییرات مربوط به  اخبار شما با موفقیت اعمال نشد",
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
        $item = array(
            "product" => "0",
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

    public function deleteAllNewsByCompanyId($company_id)
    {
        //delete from main table
        $newss = adminc_newsModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($newss['export']['recordsCount'] > 0) {
            foreach ($newss['export']['list'] as $news) {
                $news->delete();
            }
        }

        //delete from draft table
        $newss = adminc_news_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($newss['export']['recordsCount'] > 0) {
            foreach ($newss['export']['list'] as $news) {
                $news->delete();
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
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر اخبار را تایید نمودند.";
        } else {
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر اخبار رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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
