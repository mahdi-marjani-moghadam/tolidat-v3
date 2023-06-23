<?php
include_once(dirname(__FILE__) . "/model/history.controller.php");

global $company_info, $PARAM;

$controller = new historyController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addHistory($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getHistoryByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editHistory($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteHistory($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}
