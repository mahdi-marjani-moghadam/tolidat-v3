<?php
include_once(dirname(__FILE__) . "/model/certification.controller.php");

global $PARAM;
$controller = new CertificationController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {
    case 'add' :
       
        $controller->addCertification($_POST[arr]);
        break;

    case 'formAjax' :

        $controller->getAllCertificationByAjax();
        break;

    case 'edit' :

        $controller->editCertification($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteCertification($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}

