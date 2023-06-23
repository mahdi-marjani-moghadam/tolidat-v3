<?php

include_once dirname(__FILE__) . '/companyBanner.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.controller.php';
include_once ROOT_DIR . 'component/categoryBanner/member/model/categoryBanner.controller.php';

class bannerController
{

    /**
     * @var string
     */
    public $exportType;


    /**
     * @var
     */
    public $fileName;

    /**
     * @var int|mixed
     */
    private $company_info;

    /**
     * bannerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
    function template($list = [], $msg)
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
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

    /**
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0000000000100000000000000';
        $result = $company->save();
        return $result;
    }

    /**
     * @param $image
     * @internal param $fields
     */
    public function addBanner($image)
    {
        $fields['banner_id'] = 0;
        $fields['status'] = -1;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = $image;

        $banner = new c_banner_d();
        $banner->setFields($fields);
        $result = $banner->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add banner');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added banner but not sended notification';
            echo json_encode($result);
            die();
        }

        $result['image'] = COMPANY_ADDRESS . $this->company_info['company_id'] ."/banner/". $image;
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    /**
     * @param $msg
     * @return mixed
     */
    public function sendNotification($msg)
    {
        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info,
            'to' => 3,
            'msg' => $msg,
            'messageType' => 1
        ];
        $result = $notification->addNotification($fields);
        return $result;
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showBannerAddForm($fields, $msg)
    {
        $this->fileName = 'banner.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editBanner($fields)
    {
        if (empty($fields['image'])) {
            $result['result'] = -1;
            $result['msg'] = "لطفا بنر را انتخاب کنید";
            echo json_encode($result);
            die();
        }

        $result = $this->uploadImage($fields['image']);
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $banner = c_banner_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->first();
        if (!is_object($banner)) {
            $this->addBanner($result['image']);
        }

        $fields['banner_id'] = $banner->banner_id;
        $fields['company_id'] = $banner->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = $result['image'];

        if ($banner->status == 1) {
            $result = $this->addNewAndUpdate($fields, $banner);
            echo json_encode($result);
            die();
        }
        fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/banner/", $banner->image);
        $result = $this->onlyUpdate($fields, $banner);
        echo json_encode($result);
        die();

    }

    /**
     * @param $fields
     * @param $banner
     * @return mixed
     */
    public function addNewAndUpdate($fields, $banner)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['banner_id'] = $banner->banner_id;

        $newBanner = new c_banner_d();
        $newBanner->setFields($fields);
        $result = $newBanner->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }

        $result = $newBanner->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add banner');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo, Update old banner';
            return $result;
        }

        $result['image'] = COMPANY_ADDRESS . $this->company_info['company_id'] ."/banner/". $fields['image'];
        $result['result'] = 1;
        return $result;
    }

    /**
     * @param $fields
     * @param $banner
     * @return mixed
     */
    public function onlyUpdate($fields, $banner)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $banner->setFields($fields);
        $result = $banner->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }

        $result['image'] = COMPANY_ADDRESS . $this->company_info['company_id'] ."/banner/". $fields['image'];
        $result['result'] = 1;
        return $result;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getBannerByid($id)
    {
        $banner = c_banner_d::find($id);
        if (is_object($banner)) {
            $result['result'] = 1;
            $result['fields'] = $banner->fields;
            $result['fields']['image_tmp'] = COMPANY_ADDRESS . $this->company_info['company_id'] . "/banner/" . $result['fields']['image'];
            return $result;
        }
        return $banner;
        die();
    }

    /**
     * @param $id
     */
    public function getBannerByidAjax($id)
    {
        $json = $this->getBannerByid($id);
        echo json_encode($json);
        die();
    }


    public function showList()
    {

        $banner = new c_banner_d();
        $result = $banner::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $this->fileName = 'member.banner.showList.php';
        $this->template($export);
        die();
    }


    public function deleteBanner()
    {

        if (!isset($this->company_info['company_id'])) {
            redirectPage(RELA_DIR . '404');
        }
        $company_id = $this->company_info['company_id'];
        $this->deleteDir(COMPANY_ADDRESS_ROOT . $company_id . "/banner");

        $banners = c_banner_d::getBy_company_id($company_id)->get();
        $input['component'] = "banner";
        $input['company_id'] = $company_id;
        $input['image'] = $banners->image;
        if ($banners['export']['recordsCount'] > 0) {
            foreach ($banners['export']['list'] as $banner) {
                if (is_object($banner)) {
                    removeFiles($input);
                    $banner->delete();
                }
            }
        }

        $banner = c_banner::getBy_company_id($company_id)->first();

        if (is_object($banner)) {
            $banner->delete();
        }
        $this->deleteDir(COMPANY_ADDRESS_ROOT . $company_id . "/banner");

        $fields['result'] = 1;
        $fields['msg'] = "بنر شما با موفقیت حذف شد";
        $fields['src'] = DEFULT_LOGO_ADDRESS;
        echo json_encode($fields);
        die();
    }

    public function deleteDir($dirPath)
    {
        if (is_dir($dirPath)) {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            array_map('unlink', glob("$dirPath/*.*"));
            rmdir($dirPath);
        }
        return;
    }

    /**
     * @param $banner
     * @return mixed
     */
    public function deleteAll($banner)
    {
        $banner = c_banner_d::getBy_banner_id($banner->banner_id)->get();
        $input['component'] = "banner";
        foreach ($banner['export']['list'] as $banner) {
            $input['image'] = $banner->image;
            $result = $banner->delete();
            removeFiles($input);
            if ($result['result'] == -1) {
                $result['msg'] = 'بنر مورد نظر حذف نشد';
                return $result;
            }
        }
        $bannerMain = c_banner::find($banner->banner_id);

        if (is_object($bannerMain)) {
            $result = $bannerMain->delete();
            return $result;
        }
        return $result;
    }

    /**
     * @param $fields
     * @return string
     */
    public function uploadImage($image)
    {
        if (!empty($image)) {

            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'banner'
            ];
            $sizes = [
                'size1' => ['width' => 1260, 'height' => 210]
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
    }

    /**
     * @param $company_id
     * @return mixed
     */
    public function getCompanyBanner($company_id)
    {
        $banner = c_banner::getBy_company_id($company_id)->getList();
        if ($banner ['export']['recordsCount'] > 0) {
            return $banner['export']['list']['0']['image'];
        }
    }

    public function getCompanyBannerDraft($company_id)
    {
        $banner = c_banner_d::getBy_company_id_and_isActive($company_id, 1)->getList();
        if ($banner['export']['recordsCount'] > 0) {

            return $banner['export']['list']['0']['image'];
        }

        return null;
    }

}


