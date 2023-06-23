<?php
include_once(dirname(__FILE__) . "/model/companyPhones.controller.php");

global $PARAM;

$controller = new phoneController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addPhone($_POST);
        break;

    case 'editAjax' :
        if (isset($_POST['id'])) {
            $controller->getPhoneByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editPhone($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deletePhone($_POST['id']);
        }
        break;

    case '' :

        $controller->showList();
        die();
}

