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
        checkPermissions('addCompanyLogo','companyLogo');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
//            $companyLogoController->add($_POST,$_FILES['companyLogo']);
            $_POST['image_file'] = $_FILES['companyLogo'];
            $companyLogoController->editLogo($_POST);
        } else {
            $fields['company_id'] = $_GET['id'];
            $companyLogoController->showCompanyLogoAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyLogo','companyLogo');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyLogoController->editCompanyLogo($_POST,$_FILES['companyLogo']);
        } else {
            $input['logo_id'] = $_GET['id'];
            $companyLogoController->showCompanyLogoEditForm($input, '');
        }
        break;
    case 'deleteCompanyLogo':
        checkPermissions('deleteCompanyLogo','companyLogo');
        $companyLogoController->deleteCompanyLogo($_GET['id']);
        break;

    ////Draft
    case 'showDraftCompanyLogo':
        checkPermissions('showDraftCompanyLogo','companyLogo');
        $input['company_id']=$_GET['id'];
        $companyLogoController->showDraftCompanyLogo($input['company_id']);
        break;
    case 'editDraftCompanyLogo':
        checkPermissions('editDraftCompanyLogo','companyLogo');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyLogoController->editDraftCompanyLogo($_POST,$_FILES['companyLogo']);
        }else{

            $fields['draft_id']=$_GET['id'];
            $companyLogoController->editDraftCompanyLogoForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','companyLogo');
        $fields['company_id'] = $_GET['id'];
        $companyLogoController->showList($fields);
        break;
}
