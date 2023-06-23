<?php
include_once(dirname(__FILE__) . "/model/licence.controller.php");

global $PARAM;

$controller = new licenceController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addLicence($_POST);
        break;

    case 'addAjax' :
        $controller->getAddFormByAjax();
        break;

    case 'editAjax' :
        if (isset($_POST['id'])) {
            $controller->getLicenceByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editLicence($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteLicence($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        break;

}

