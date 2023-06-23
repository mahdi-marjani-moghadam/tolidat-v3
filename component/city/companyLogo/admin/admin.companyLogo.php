<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyLogo.controller.php';

global $admin_info,$PARAM;

$companyLogoController = new admincompany_logoController();
if (isset($exportType)) {
    $companyLogoController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyLogoController->showMore($_GET['id']);
        break;
    case 'add':
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyLogoController->addCompanyLogo($_POST,$_FILES['companyLogo']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $companyLogoController->showCompanyLogoAddForm($fields, '');
        }
        break;
    case 'edit':
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $companyLogoController->editCompanyLogo($_POST,$_FILES['companyLogo']);
        } else {
            $input['logo_id'] = $_GET['id'];
            $companyLogoController->showCompanyLogoEditForm($input, '');
        }
        break;
    case 'deleteCompanyLogo':
        $companyLogoController->deleteCompanyLogo($_GET['id']);
        break;
    default:
        $fields['choose']['company_id'] = $_GET['id'];
        $companyLogoController->showList($fields);
        break;
}
