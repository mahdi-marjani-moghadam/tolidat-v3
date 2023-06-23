<?php

include_once(dirname(__FILE__). "/model/companyBanner.controller.php");
global $admin_info,$PARAM;
global $company_info;
$bannerController = new bannerController();
if(isset($exportType))
{
    $bannerController->exportType=$exportType;
}


switch ($PARAM[1])
{

    case 'add':
        $_POST['img']=$_FILES['image'];
        $bannerController->addBanner($_POST);
        break;
    case 'editAjax': {
        if (isset($_POST['id']))
        {
            $bannerController->getBannerByidAjax($_POST['id']);
        }
    }
        break;
    case 'edit':

        $_POST['img']=$_FILES['image_tmp'];
        $bannerController->editBanner($_POST);

        break;
    case 'delete':
        if (isset($_POST['id'])) {
            $bannerController->deleteBanner($_POST['id']);
        }
        break;

    default:
        $bannerController->showList();
        break;
}

?>