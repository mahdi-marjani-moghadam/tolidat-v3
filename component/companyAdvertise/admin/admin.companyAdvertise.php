<?php

include_once dirname(__FILE__) . '/AdminAdvertiseController.php';

global $admin_info, $PARAM;

$advertiseController = new AdminAdvertiseController();

if (isset($exportType)) {
    $advertiseController->exportType = $exportType;
}


switch ($_GET['action']) {

    case 'add' :
        if (isset($_POST) & !empty($_POST)) {
            $advertiseController->store($_POST);
        } else {
            $advertiseController->create($_GET['company_id']);
        }
        break;

    case 'edit' :
        if (isset($_POST) & !empty($_POST)) {
            $advertiseController->update($_POST);
        } else {
            $advertiseController->edit($_GET);
        }
        break;

    case 'delete' :
        $advertiseController->delete($_GET);
        break;

    case 'editDraftAdvertise':
        //checkPermissions('editDraftAdvertise', 'advertise');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $advertiseController->editDraftAdvertise($_POST);
        } else {
            $fields['company_id'] = $_GET['id'];
            $advertiseController->editDraftAdvertiseForm($fields['company_id']);
        }
        break;
////Draft
    case 'showDraftCompanyAdvertise':

        //checkPermissions('showDraftCompanyAdvertise','companyAdvertise');
        $input['company_id'] = $_GET['id'];
        $advertiseController->showDraftCompanyAdvertise($input['company_id']);
        break;
    case 'editDraftCompanyAdvertise':
        //checkPermissions('editDraftCompanyEmail','companyEmails');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $advertiseController->editDraftCompanyAdvertise($_POST, $_FILES['companyAdvertise']);
        } else {
            $fields['draft_id'] = $_GET['id'];
            $advertiseController->editDraftCompanyAdvertiseForm($fields);
        }
        break;
////End Draft

    default:
        //checkPermissions('showList', 'advertise');
        $fields['company_id'] = $_GET['id'];
        $advertiseController->showList($fields);
        break;
}
