<?php
include_once(dirname(__FILE__) . "/model/admin.advertise.controller.php");

global $admin_info, $PARAM;

$advertiseController = new adminAdvertiseController();
if (isset($exportType)) {
    $advertiseController->exportType = $exportType;
}

switch ($_GET['type']) {
    case 'publicAdvertise' :
        $_POST['type'] = $_GET['type'];
        break;
    case 'searchAdvertise' :
        $_POST['type'] = $_GET['type'];
        break;
    case 'directoryAdvertise' :
        $_POST['type'] = $_GET['type'];
        break;
    default :
        redirectPage(RELA_DIR . 'admin');
        break;
}

switch ($_GET['action']) {
    case 'showMore':
        $advertiseController->showMore($_GET['id']);
        break;

    case 'addAdvertise':
        checkPermissions('addAdvertise', 'advertise');

        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $advertiseController->addAdvertise($_POST);
        } else {
            $advertiseController->showAdvertiseAddForm($_POST);
        }
        break;

    case 'editAdvertise':
        checkPermissions('editAdvertise', 'advertise');

        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $advertiseController->editAdvertise($_POST);
        } else {
            $advertiseController->showAdvertiseEditForm($_POST, $_GET['id']);
        }
        break;

    case 'deleteAdvertise':
        checkPermissions('deleteAdvertise', 'advertise');
        $advertiseController->deleteAdvertise($_POST, $_GET['id']);
        break;

    default:
        checkPermissions('showList', 'advertise');
        $advertiseController->showList($_POST);
        break;
}
