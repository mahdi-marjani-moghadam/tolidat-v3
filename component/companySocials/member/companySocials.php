<?php
include_once(dirname(__FILE__) . "/model/companySocials.controller.php");

global $PARAM;

$controller = new socialController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addSocial($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getSocialByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editSocial($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteSocial($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}