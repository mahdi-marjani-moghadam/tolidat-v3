<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 2/27/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/model/admin.certification.controller.php';

global $admin_info, $PARAM;

$certificationController = new adminCertificationController();
if (isset($exportType)) {
    $certificationController->exportType = $exportType;
}
switch ($_GET['action']) {
    case 'showMore':
        $newsController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCertification','certification');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $certificationController->addCertification($_POST,$_FILES['image']);
        } else {
            $certificationController->showCertificationAddForm('', '');
        }
        break;
    case 'edit':
        checkPermissions('editCertification','certification');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $certificationController->editCertification($_POST,$_FILES['image']);
        } else {
            $input['Certification_list_id'] = $_GET['id'];
            $certificationController->showCertificationEditForm($input, '');
        }
        break;
    case 'delete':
        checkPermissions('deleteCertification','certification');
        $certificationController->deleteCertification($_GET['id']);
        break;
    ////Company
    case 'addCompanyCertification':
        checkPermissions('addCompanyCertification','certification');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $certificationController->addCompanyCertification($_POST);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $certificationController->showCompanyCertificationAddForm($fields, '');
        }
        break;
    case 'editCompanyCertification':
        checkPermissions('editCompanyCertification','certification');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $certificationController->editCompanyCertification($_POST);
        } else {
            $input['Certification_id'] = $_GET['id'];
            $input['company_id'] = $_GET['company_id'];
            $certificationController->showCompanyCertificationEditForm($input, '');
        }
        break;
    case 'deleteCompanyCertification':
        checkPermissions('deleteCompanyCertification','certification');
        $certificationController->deleteCompanyCertification($_GET['id']);
        break;
    case 'showCompanyCertification':
        checkPermissions('showCompanyCertification','certification');
        $input['company_id'] = $_GET['id'];
        $certificationController->showCompanyCertification($input['company_id']);
        break;
    ////Draft
    case 'showDraftCertification':
        checkPermissions('showDraftCertification','certification');
        $input['company_id'] = $_GET['id'];
        $certificationController->showDraftCertification($input['company_id']);
        break;
    case 'editDraftCertification':
        checkPermissions('editDraftCertification','certification');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $certificationController->editDraftCertification($_POST, $_FILES['certification']);
        } else {
            $fields['draft_id'] = $_GET['id'];
            $certificationController->editDraftCertificationForm($fields);
        }
        break;
    default:
        checkPermissions('showList','certification');
        $fields['company_id'] = $_GET['id'];
        $certificationController->showList($fields);
        break;
}
