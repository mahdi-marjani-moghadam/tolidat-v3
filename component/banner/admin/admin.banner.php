<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/06/2016
 * Time: 12:08 AM
 */
include_once(dirname(__FILE__). "/model/admin.banner.controller.php");

global $admin_info,$PARAM;

$bannerController = new adminBannerController();
if(isset($exportType))
{
    $bannerController->exportType=$exportType;
}




switch ($_GET['action'])
{
    case 'showMore':
        $bannerController->showMore($_GET['id']);
        break;
    case 'addBanner':
        checkPermissions('addBanner','banner');
        if(isset($_POST['action']) & $_POST['action']=='add')
        {
            $bannerController->addBanner($_POST);
        }
        else
        {
            $bannerController->showBannerAddForm('','');
        }
        break;
    case 'editBanner':
        checkPermissions('editBanner','banner');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {

            $bannerController->editBanner($_POST);
        }
        else
        {
            $input['Banner_id']=$_GET['id'];
            $bannerController->showBannerEditForm($input, '');
        }
        break;
    case 'deleteBanner':
        checkPermissions('deleteBanner','banner');
        $input['Banner_id']=$_GET['id'];
        $bannerController->deleteBanner($input);

        break;
    default:
        checkPermissions('showList','banner');
        //$fields['order']['Banner_id'] = 'DESC';
        $bannerController->showList($fields);
        break;
}

?>