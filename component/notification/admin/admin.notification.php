<?php
require_once "model/admin.notification.controller.php";

global $admin_info, $PARAM;

$controller = new adminNotificationController();

if (isset($exportType)) {
    $packageController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'addNotification':
        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $controller->addNotification($_POST);
        } else {
            $controller->showNotificationAddForm();
        }
        break;
    case 'editNotification':
        if (isset($_POST['action']) && $_POST['action'] == 'edit') {
            $controller->editNotification();
        } else {
            $input['notification_id'] = $_GET['id'];
            $controller->showNotificationEditForm($input);
        }
        break;
    case 'deleteNotification':
        $input['notification_id'] = $_GET['id'];
        $controller->deleteNotification($input);
        break;
    case 'showAllRecive':
        $controller->showAllRecive();
        break;
    case 'showRecive':
        $controller->showRecive();
        break;
    case 'showAllUnread':
        $controller->showAllUnread();
        break;
    case 'showMSG':
        $controller->showMSG($_POST['id']);
        break;
    case 'isRead':
        $id = $_GET['id'];
        $controller->isRead($id);
}
