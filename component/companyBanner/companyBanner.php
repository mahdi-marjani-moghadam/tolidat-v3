<?php

include_once(dirname(__FILE__). "/model/banner.controller.php");
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

        if (isset($_POST['action']) && $_POST['action']=='add' )
        {
            $_POST['isActive'] = 1;
            $_POST['Banner_d_id'] = $PARAM[3];
            $_POST['editor_id']=$company_info['company_id'];
            $_POST['company_id']=$company_info['company_id'];
            $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
            $bannerController->addBanner($_POST,$_FILES['banner']);
        }
        else
        {
            $bannerController->showBannerAddForm($company_info['company_id'],'');
        }
        break;
    case 'edit':
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
        
            $_POST['Banner_d_id'] = $PARAM[3];
            $bannerController->editBanner($_POST,$_FILES['banner']);
        }
        else
        {
     
            $bannerController->showBannerEditForm($PARAM[3],'');
        }
        break;
    case 'deleteBanner':
        $bannerController->deleteBanner($PARAM[3]);
        break;
    default:
 
        $fields['editor_id']=$company_info['company_id'];
        $bannerController->showList($fields);
        break;
}

?>