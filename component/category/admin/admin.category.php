<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */
include_once(dirname(__FILE__). "/model/admin.category.controller.php");
include_once(dirname(__FILE__). "/model/category.import.model.php");


global $admin_info,$PARAM;

$categoryController = new adminCategoryController();
if(isset($exportType))
{
    $categoryController->exportType=$exportType;
}

switch ($_GET['action'])
{
    case 'showMore':
        $newsController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCategory','category');
        if(isset($_POST['action']) & $_POST['action']=='add')
        {
            $_POST['images'] = $_FILES;
            $categoryController->addCategory($_POST);
        }
        else
        {
            $categoryController->showCategoryAddForm('','');
        }
        break;
    case 'edit':
        checkPermissions('editCategory','category');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $_POST['images'] = $_FILES;
            $categoryController->editCategory($_POST);
        }
        else
        {
            $input['Category_id']=$_GET['id'];
            $categoryController->showCategoryEditForm($input,'');
        }
        break;
    case 'delete':
        checkPermissions('deleteCategory','category');
        $categoryController->deleteCategory($_GET['id']);

        break;
    default:
        checkPermissions('showList','category');
        $category_list =categoryImportModel::getCategoryList()['export']['list'];
        //print_r_debug($category_list);
        /*echo '<pre/>';
        foreach($category_list as $k => $fields)
        {
            echo $fields['Category_id'];

            $fields['new_id']=($fields['group']*100)+$fields['group_sub'];
            $fields['parent_id']=($fields['group']*100);
            if($fields['group_sub']==0)
            {
                $fields['parent_id']=0;

            }
            $update=$category_list =categoryImportModel::update($fields);

        }
        die();*/


        $categoryController->showList();
        break;
}

?>
