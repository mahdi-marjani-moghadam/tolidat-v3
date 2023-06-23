<?php
include_once(dirname(__FILE__) . "/model/companyAddresses.controller.php");

global $company_info, $PARAM;

$controller = new addressController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {

    case 'add' :

        $controller->addAddress($_POST);
        break;

    case 'edit' :
        
        $controller->editAddress($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getAddressByidAjax($_POST['id']);
        }
        break;

    case 'delete' :
        if (isset($_POST['id'])) {
            $controller->deleteAddress($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();

}

