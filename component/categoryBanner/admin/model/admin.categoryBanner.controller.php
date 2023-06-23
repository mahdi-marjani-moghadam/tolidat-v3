<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.categoryBanner.model.php");


class admincategory_bannerController
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

    function template( $list = [], $msg ='')
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

    public function showCategoryBannerAddForm( $fields, $msg )
    {
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.model.php';
        $category = new adminCategoryModel();
        $resultCategory = $category->getParentCategory();
        if ( $resultCategory['result'] == 1 ) {
            $fields['category'] = $category->list;
        }
        $input = $resultCategory['export']['list'];
        $input['recordsCount'] = $resultCategory['export']['recordsCount'];
        $input['fields'] = $fields;
        $this->fileName = 'admin.categoryBanner.addForm.php';
        $this->template($input, $msg);
        die();
    }

    public function add( $fields, $files )
    {
        global $admin_info;

        ////////////////////////////////////
        $fields['editor_id'] = $admin_info['admin_id'];
        $bannerObject = admincategory_bannerModel::getBy_category_id($fields['category_id'])->first();
        if ( is_object($bannerObject) ) {
            $msg = "این دسته دارای بنر است";
            redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
            die();
        }

        //$fields['title'] = $fields['title'];
        //$fields['description'] = $fields['description'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';

        if ( $files['name'] != '' ) {
            $file['name'] = $files['name'];
            $file['type'] = $files['type'];
            $file['tmp_name'] = $files['tmp_name'];
            $file['error'] = $files['error'];
            $file['size'] = $files['size'];
            $Property = array ('type' => 'jpg,png',
                'new_name' => $file['name'],
                'max_size' => '2048000',
                'upload_dir' => IMAGES_ROOT_DIR . "category_banner/"
            );
            $result_uploader = fileUploader($Property, $file);
            $fields['image'] = $result_uploader['image_name'];
        } else {
            $this->showCategoryBannerAddForm($fields);
        }

    

        $categoryBannerObject = new admincategory_bannerModel();
        $categoryBannerObject->setFields($fields);
        $categoryBannerObject->save();
        $msg = "عملیات با موفقیت اضافه شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
        die();
    }

    public function showCategoryBannerEditForm( $fields, $msg )
    {
        $categoryBannerObject = admincategory_bannerModel::find($fields['id']);
        if ( !is_object($categoryBannerObject) ) {
            $msg = "رکورد مورد نظر یافت نشد";
            redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
            die();
        }


        include_once ROOT_DIR . 'component/category/admin/model/admin.category.model.php';
        $category = new adminCategoryModel();
        $resultCategory = $category->getParentCategory();
        if ( $resultCategory['result'] == 1 ) {
            $fields['category'] = $category->list;
        }
        $input = $categoryBannerObject->fields;
        $input['category'] = $resultCategory['export']['list']['category'];
        $input['recordsCount'] = $resultCategory['export']['recordsCount'];
        $input['fields'] = $fields;
        $this->fileName = 'admin.categoryBanner.editForm.php';
        $this->template($input, $msg);
        die();
    }

    public function edit( $fields, $files )
    {
        global $admin_info;

        ////////////////////////////////////
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';
        //find record in category_banner
        $categoryBannerObject = admincategory_bannerModel::find($fields['Category_banner_id']);
        if ( !is_object($categoryBannerObject) ) {
            $msg = "رکورد یافت نشد";
            redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
            die();
        }

        if ( $files['name'] != '' ) {
            $Property = array ('type' => 'jpg,png',
                'new_name' => $files['name'],
                'max_size' => '2048000',
                'upload_dir' => IMAGES_ROOT_DIR . "category_banner/"
            );
            fileRemover(IMAGES_ROOT_DIR . "category_banner/",$categoryBannerObject->image);
            $result_uploader = fileUploader($Property, $files);
            $fields['image'] = $result_uploader['image_name'];
        } else {
            $fields['image'] = $categoryBannerObject->image;
        }

        $categoryBannerObject->setFields($fields);
        $categoryBannerObject->save();

        $msg = "عملیات با موفقیت اضافه شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
        die();
    }

    public function delete( $id )
    {
        $categoryBannerObject = admincategory_bannerModel::find($id);
        if ( !is_object($categoryBannerObject) ) {
            $msg = "رکورد یافت نشد";
            redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
            die();
        }


        fileRemover(IMAGES_ROOT_DIR . "category_banner/",$categoryBannerObject->image);
        $categoryBannerObject->delete();
        $msg="عملیات با موفقیت انجام شد.";
        redirectPage(RELA_DIR . 'admin/index.php?component=categoryBanner', $msg);
        die();
    }

    public function showList()
    {
        $this->fileName = 'admin.categoryBanner.showList.php';
        $categoryBannerObject = admincategory_bannerModel::getAll()->getList();
        $export['list'] = $categoryBannerObject['export']['list'];
        $this->template($export);
        die();


    }

}

?>
