<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/AdminEmploymentController.php';

global $admin_info, $PARAM;

$emoploymentController = new AdminEmploymentController();

if (isset($exportType)) {
    $emoploymentController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showDraftList':
        checkPermissions('showDraftList', 'employment');
        $fields['company_id'] = $_GET['id'];
        $emoploymentController->showDarftList($fields);
        break;
    case 'editDraftEmployment':
        checkPermissions('editDraftEmployment', 'employment');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $emoploymentController->editDraftEmployment($_POST);
        } else {
            $emoploymentController->editDraftEmploymentForm($_GET);
        }
        break;

    case 'showList' :
        checkPermissions('showList', 'employment');
        $emoploymentController->showList($_GET['id']);
        break;

    case 'add' :
        checkPermissions('addEmployment', 'employment');
        if (isset($_POST) & !empty($_POST)) {
            $emoploymentController->store($_POST);
        } else {
            $emoploymentController->create($_GET['company_id']);
        }
        break;

    case 'edit' :
        checkPermissions('editEmployment', 'employment');
        if (isset($_POST) & !empty($_POST)) {
            $emoploymentController->update($_POST);
        } else {
            $emoploymentController->edit($_GET);
        }
        break;

    case 'delete' :
        checkPermissions('deleteEmployment', 'employment');
        $emoploymentController->delete($_GET);
        break;
}
