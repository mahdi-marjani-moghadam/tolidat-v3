<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.companyBanner.model.php");
include_once(dirname(__FILE__) . "/admin.companyBannerDraft.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class registerController
 */
class admincompany_bannerController
{
    public $exportType;

    public $fileName;

    public function __construct()
    {


//        $banner=admincompany_bannerModel::find(4);
//        echo '<br/>********************<br/>';
//       //print_r($banner);
//        //$banner->title='ee';
//        $banner->save();
//       // print_r_debug($banner);
//
//
//        //company_banner::create($fields);
//        /*$banner = new company_banner();
//        $banner->title='aa';
//        $banner->description='bbb';
//        $banner->save();*/
//
//        $attributes = array('title' => 'My first blog post!!', 'description' => '5');
//        $company_banner=admincompany_bannerModel::create($attributes);
//        print_r_debug($company_banner);
//
//
//        print_r_debug($banner);
//
//        $result =$banner->setFields($fields);
//        print_r_debug($banner);


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

    /////////////////////

    public function showCompanyBannerAddForm($fields, $msg)
    {
        $result = adminc_banner_dModel::getBy_company_id_and_isActive_and_status($fields['company_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }


        $bannerObject = adminc_bannerModel::getBy_company_id($fields['company_id'])->getList();
        if ($bannerObject['export']['recordsCount'] > 1) {
            $msg = "وجود چند رکورد برای کمپانی ";
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $input = $bannerObject['export']['list']['0'];
        $input['recordsCount'] = $bannerObject['export']['recordsCount'];
        $input['company_id'] = $fields['company_id'];

        $this->fileName = 'admin.companyBanner.addForm.php';
        $this->template($input, $msg);
        die();
    }


    public function add($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_banner_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyBanner";

        ////////////////////////////////////Add new record
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['status'] = '1';

        $mainObject = adminc_bannerModel::getAll()->where('Company_id', "=", $fields['company_id'])->first();
        $draftObject = adminc_banner_dModel::getAll()->where('company_id', "=", $fields['company_id'])->get();
        // print_r_debug($draftObject);

        if ($fields['remove_image'] == 'on') {

            if (is_object($mainObject)) {
                $mainObject->delete();
            }
            foreach ($draftObject['export']['list'] as $key => $object) {
                $object->delete();
            }
        } else {

            if (!empty($fields['bannerImage'])) {


                if (is_object($mainObject)) {
                    $mainObject->delete();
                }
                foreach ($draftObject['export']['list'] as $key => $object) {
                    $object->status = 1;
                    $object->isActive = 0;
                    $object->save();
                }


                //------>
                $uploader = new Uploader();

                $property = [
                    'image' => $fields['bannerImage'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'banner'
                ];

                $sizes = [
                    'size1' => ['width' => '1260', 'height' => '210']
                ];

                $result = $uploader->cropAndCompressImage($property, $sizes);
                $fields['image'] = $result['image'];


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
                $newDraftObject->save() ;


            }


        }

        calculateScoreCompany($fields['company_id']);

        redirectPage(RELA_DIR . 'admin/index.php?component=company&id=' . $fields['company_id'], $msg);
        die();
    }


    public function deleteBanner($company_id)
    {
        $banners = adminc_bannerModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();
        foreach ($banners['export']['list'] as $key => $banner) {
            $banner->delete();
        }

        $banners = adminc_banner_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();
        foreach ($banners['export']['list'] as $key => $banner) {
            $banner->delete();
        }


        return;
    }

    public function delete($id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_addresses_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $componentName = "companyAddresses";

        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($id);
        if (is_object($mainObject)) {
            $company_id = $mainObject->company_id;
            $getBy = "getBy_" . $draft_f_key;
            $draftObject = $draftModel::$getBy($mainObject->$main_p_key)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $componentName . "/", $draftRecord->image);
                $draftRecord->delete();
            }

            $mainObject->delete();
            $msg = "بنر با موفقیت حذف گردید.";
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }

        calculateScoreCompany($id);

        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $company_id, $msg);
        die();
    }


    public function getByCompanyId($company_id)
    {

        $bannerObject = adminc_bannerModel::getBy_company_id($company_id)->getList();
        return $bannerObject ;

    }

    //---------------------------------------draft CompanyBanner----------
    public function showDraftCompanyBanner($id)
    {

        $result = adminc_banner_dModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->orderBy('Banner_d_id', 'DESC')->getList();
        //print_r_debug($result);$result['result'] = -1;
        if ($result['result'] != 1) {
            $this->fileName = 'admin.companyBannerDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.companyBannerDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftCompanyBannerForm($fields)
    {


        $result = adminc_banner_dModel::find($fields['draft_id']);
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

            $this->fileName = 'admin.companyBannerDraft.editForm.php';
            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=companyBanner", $msg);
        }
    }

    public function editDraftCompanyBanner($fields, $files)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_banner_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = "companyBanner";
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $imageAddress = "Banner";
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
            if (!empty($fields['bannerImage'])) {
                $uploader = new Uploader();

                $property = [
                    'image' => $fields['bannerImage'],
                    'company_id' => $fields['company_id'],
                    'folder_name' => 'banner'
                ];

                $sizes = [
                    'size1' => ['width' => '1260', 'height' => '210']
                ];

                $result = $uploader->cropAndCompressImage($property, $sizes);
                $fields['image'] = $result['image'];
            } else {
                $fields['image'] = $draftObject->image;
            }

        } else {
            $fields['image'] = '';
        }


        //------> draft to Main
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
        $newDraftObject->banner_id = $mainObject->Banner_id;
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
        $draftObject->banner_id =  $mainObject->Banner_id;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();
        // add New Notification
        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به بنر شما با موفقیت اعمال شد",
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
            'msg' => "تغییرات مربوط به بنر شما با موفقیت اعمال نشد",
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

        $item = array("product" => "0", "certification" => "1", "honour" => "2", "businessLicence" => "3", "history" => "4", "companyNews" => "5", "companyAddresses" => "6", "companyPhones" => "7", "companyEmails" => "8", "companyWebsites" => "9", "companyBanner" => "10", "companyLogo" => "11", "companyCommercialName" => "12", "licences" => "13", "companySocials" => "14", "companyPositions" => "15", "branch" => "16", "wiki" => "17"
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

    public function deleteAllBannerByCompanyId($company_id)
    {
        //delete from main table
        $banners = adminc_bannerModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($banners['export']['recordsCount'] > 0) {
            foreach ($banners['export']['list'] as $banner) {
                $banner->delete();
            }
        }

        //delete from draft table
        $banners = adminc_banner_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($banners['export']['recordsCount'] > 0) {
            foreach ($banners['export']['list'] as $banner) {
                $banner->delete();
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
            $smsText = "کاربر محترم  \nکارشناسان سایت تولیدات تغییرات اعمال شده بر بنر را تایید نمودند.";
        }else{
            $smsText =  " کاربر محترم\n تغییرات اعمال شده بر بنر رد شد. جهت کسب اطلاعات بیشتر با کارشناسان تولیدات تماس حاصل فرمایید.\n ۰۲۱-۲۲۴۳۵۲۰۰";
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

