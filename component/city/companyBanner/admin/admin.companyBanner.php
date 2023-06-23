<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyBanner.controller.php';

global $admin_info,$PARAM;

$companyBannerController = new admincompany_bannerController();
if (isset($exportType)) {
    $companyBannerController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyBannerController->showMore($_GET['id']);
        break;
    case 'add':
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyBannerController->addCompanyBanner($_POST,$_FILES['companyBanner']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            
            $companyBannerController->showCompanyBannerAddForm($fields, '');
        }
        break;
    case 'edit':
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyBannerController->editCompanyBanner($_POST,$_FILES['companyBanner']);
        } else {
            $input['banner_id'] = $_GET['id'];
            $companyBannerController->showCompanyBannerEditForm($input, '');
        }
        break;
    case 'deleteCompanyBanner':

        $companyBannerController->deleteCompanyBanner($_GET['id']);
        break;
    default:
        $fields['choose']['company_id'] = $_GET['id'];
        $companyBannerController->showList($fields);
        break;
}
