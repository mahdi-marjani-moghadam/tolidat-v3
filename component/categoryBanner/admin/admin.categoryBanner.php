<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/model/admin.categoryBanner.controller.php';

global $admin_info, $PARAM;

$categoryBannerController = new admincategory_bannerController();
if ( isset($exportType) ) {
    $categoryBannerController->exportType = $exportType;
}


switch ($_GET['action']) {
    case 'showMore':
        $categoryBannerController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCategoryBanner', 'categoryBanner');
        if ( isset($_POST['action']) & $_POST['action'] == 'add' ) {
            $categoryBannerController->add($_POST, $_FILES['image']);
        } else {
            //$fields['company_id'] = $_GET['id'];
            $categoryBannerController->showCategoryBannerAddForm($fields, '');
        }
        break;
    case 'edit':

        checkPermissions('editCompanyBanner', 'companyBanner');
        if ( isset($_POST['action']) & $_POST['action'] == 'edit' ) {
            
            $categoryBannerController->edit($_POST, $_FILES['image']);
        } else {
            $input['id'] = $_GET['id'];
            $categoryBannerController->showCategoryBannerEditForm($input, '');
        }
        break;
    case 'delete':
        checkPermissions('deleteCompanyBanner', 'companyBanner');
        $categoryBannerController->delete($_GET['id']);
        break;

    default:

        checkPermissions('showList','categoryBanner');
        $categoryBannerController->showList();
        break;
}
