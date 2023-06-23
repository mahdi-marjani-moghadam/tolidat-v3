<?php
include_once(dirname(__FILE__) . "/model/companyEmails.controller.php");

global $PARAM;

$controller = new emailController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :

        $controller->addEmail($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getEmailByidAjax($_POST['id']);
        }
        break;

    case 'edit' :

        $controller->editEmail($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteEmail($_POST['id']);
        }
        break;

    case '' :

        $controller->showList();
        die();
}

