<?php

include_once(dirname(__FILE__) . "/model/honour.controller.php");
global $admin_info, $PARAM;
global $company_info;
$honourController = new honourController();
if (isset($exportType)) {
    $honourController->exportType = $exportType;
}

switch ($PARAM[1]) {

    case 'add':
        $honourController->addHonour($_POST);
        break;
    case 'editAjax': {
        if (isset($_POST['id'])) {
            $honourController->getHonourByidAjax($_POST['id']);
        }
    }
        break;
    case 'edit':
        $honourController->editHonour($_POST);
        break;
    case 'delete':
        if (isset($_POST['id'])) {
            $honourController->deleteHonour($_POST['id']);
        }
        break;

    default:
        $honourController->showList();
        break;
}

?>
