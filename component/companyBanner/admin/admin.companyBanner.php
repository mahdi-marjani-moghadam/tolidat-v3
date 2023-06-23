<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/model/admin.companyBanner.controller.php';

global $admin_info, $PARAM;

$companyBannerController = new admincompany_bannerController();
if ( isset($exportType) ) {
    $companyBannerController->exportType = $exportType;
}


switch ($_GET['action']) {
    case 'showMore':
        $companyBannerController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyBanner','companyBanner');
        if ( isset($_POST['action']) & $_POST['action'] == 'add' ) {
            $companyBannerController->add($_POST, $_FILES['companyBanner']);
        } else {
            $fields['company_id'] = $_GET['id'];
            $companyBannerController->showCompanyBannerAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyBanner','companyBanner');
        if ( isset($_POST['action']) & $_POST['action'] == 'edit' ) {
           
            $companyBannerController->edit($_POST, $_FILES['companyBanner']);
        } else {
            $input['banner_id'] = $_GET['id'];
            $companyBannerController->showCompanyBannerEditForm($input, '');
        }
        break;
    case 'deleteCompanyBanner':
        checkPermissions('deleteCompanyBanner','companyBanner');
        $companyBannerController->delete($_GET['id']);
        break;
    ////Draft
    case 'showDraftCompanyBanner':
        checkPermissions('showDraftCompanyBanner','companyBanner');
        $input['company_id'] = $_GET['id'];
        $companyBannerController->showDraftCompanyBanner($input['company_id']);
        break;
    case 'editDraftCompanyBanner':
        checkPermissions('editDraftCompanyBanner','companyBanner');
        if ( isset($_POST['action']) & $_POST['action'] == 'edit' ) {
            $companyBannerController->editDraftCompanyBanner($_POST, $_FILES['companyBanner']);
        } else {
            $fields['draft_id'] = $_GET['id'];
            $companyBannerController->editDraftCompanyBannerForm($fields);
        }
        break;
    ////End Draft
    default:


        break;
}
