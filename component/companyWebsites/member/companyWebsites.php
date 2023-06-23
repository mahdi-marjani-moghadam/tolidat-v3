<?php
include_once(dirname(__FILE__) . "/model/companyWebsites.controller.php");

global $PARAM;

$controller = new websiteController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :

        $controller->addWebsite($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getWebsiteByidAjax($_POST['id']);
        }
        break;

    case 'edit' :

        $controller->editWebsite($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteWebsite($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}