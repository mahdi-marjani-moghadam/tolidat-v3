<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/model/admin.licence.controller.php';

global $admin_info, $PARAM;
$licenceController = new adminLicenceController();
if (isset($exportType)) {
    $licenceController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $licenceController->showMore($_GET['id']);
        break;

    case 'add':
        checkPermissions('addLicence', 'licence');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $licenceController->add($_POST, $_FILES['image']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $licenceController->showLicenceAddForm($fields, '');
        }
        break;

    case 'edit':
        checkPermissions('editLicence', 'licence');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $licenceController->edit($_POST, $_FILES['image']);
        } else {
            $input['Licence_id'] = $_GET['id'];
            $licenceController->showLicenceEditForm($input, '');
        }
        break;

    case 'deleteLicence':
        checkPermissions('deleteLicence', 'licence');
        $licenceController->delete($_GET['licence_id']);
        break;

    case 'getLicenceAjax':
        $licenceController->getLicenceAjax();
        break;

    ////Draft
    case 'showDraftLicence':
        checkPermissions('showDraftLicence', 'licence');
        $input['company_id'] = $_GET['id'];
        $licenceController->showDraftLicence($input['company_id']);
        break;

    case 'editDraftLicence':
        checkPermissions('editDraftLicence', 'licence');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $licenceController->editDraftLicence($_POST, $_FILES['image']);
        } else {
            $fields['Licence_id'] = $_GET['id'];
            $licenceController->editDraftLicenceForm($fields);
        }
        break;

    ////End Draft
    default:
        checkPermissions('showList', 'licence');
        $fields['company_id'] = $_GET['id'];
        $licenceController->showList($fields);
        break;
}
