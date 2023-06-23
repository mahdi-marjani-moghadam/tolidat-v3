<?php
include_once(dirname(__FILE__) . "/model/businessLicence.controller.php");

global $company_info, $PARAM;

$controller = new businesslicenceController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $_POST['img'] = $_FILES['image'];
        $controller->addBusinessLicence($_POST);
        break;

    case 'editAjax' :
        
        if (isset($_POST['id'])) {
            $controller->getBusinessLicenceByidAjax($_POST['id']);
        }
        break;

    case 'edit' :

        $_POST['img'] = $_FILES['image_tmp'];
        $controller->editBusinessLicence($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteBusinessLicence($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}

