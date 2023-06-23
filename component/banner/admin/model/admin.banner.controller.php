<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/06/2016
 * Time: 12:08 AM
 */

include_once(dirname(__FILE__) . "/admin.banner.model.php");
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class bannerController
 */
class adminBannerController
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
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list = [], $msg = '')
    {
        // global $conn, $lang;


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

    /**
     * @param $_input
     *
     */
    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->template($msg);
        }
        $banner = new adminBannerModel();
        $result = $banner->getBannerById($_input);

        if ($result['result'] != 1) {
            die();
        }

        $this->template($banner->fields);
        die();
    }


    /**
     * @param $fields
     */
    public function showList($fields)
    {
        $result = adminBannerModel::getAll()->getList();
        $export['result'] = $result['result'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $export['list'] = $result['export']['list'];
        $this->fileName = 'admin.banner.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showBannerAddForm($fields, $msg)
    {
        /////// category
        include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
        $category = new adminCategoryModel();

        $resultCategory = $category->getCategoryOption();
        if ($resultCategory['result'] == 1) {
            $fields['category'] = $category->list;
        }
        //echo "<pre>";print_r($resultCategory);die();
        ///////

        $this->fileName = 'admin.banner.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function addBanner($fields)
    {

        $banner = new adminBannerModel();

        if (!empty($fields['bannerImage'])) {

            $uploader = new Uploader();
            $property = ['image' => $fields['bannerImage'], 'folder_name' => 'banner'];
            $sizes = ['size1' => ['width' => '1260', 'height' => '210']];
            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];
            $banner->setFields($fields);
            $banner->save();

            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
            die();
        } else {
            $msg = 'عملیات با موفقیت انجام نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
            die();
        }
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showBannerEditForm($fields, $msg)
    {

        $resultObject = adminBannerModel::find($fields['Banner_id']);

        if (!is_object($resultObject) ) {
            $msg = "رکورد مورد نظر یافت نشد";
            redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
        }
        $export = $resultObject->fields;
        $this->fileName = 'admin.banner.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editBanner($fields)
    {

        $bannerObject = adminBannerModel::Find($fields['Banner_id']);

        if(!is_object($bannerObject)){
            $msg = 'رکورد مورد نظر یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
        }

        if (strlen($fields['imageCropped'])>'0') {
            $uploader = new Uploader();
            $property = ['image' => $fields['imageCropped'], 'folder_name' => 'banner'];
            $sizes = ['size1' => ['width' => '1260', 'height' => '210']];
            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];
        } else {
            $fields['image'] = $bannerObject->image;
        }




        $bannerObject->setFields($fields);
        $bannerObject->save();

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
        die();

    }

    /**
     * delete banner by banner_id
     *
     * @param $fields
     * @author marjani
     * @date 3/06/2015
     * @version 01.01.01
     */
    public function deleteBanner($fields)
    {

        $bannerObject = adminBannerModel::Find($fields['Banner_id']);

        if(!is_object($bannerObject)){
            $msg = 'رکورد مورد نظر یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
        }
        fileRemover(IMAGES_ROOT_DIR.'banner/',$bannerObject->image);
        fileRemover(IMAGES_ROOT_DIR.'banner/',"1260.210.".$bannerObject->image);
        $bannerObject->delete();
        $msg = 'رکورد مورد نظر حذف شد';
        redirectPage(RELA_DIR . "admin/index.php?component=banner", $msg);
    }


}
