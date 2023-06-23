<?php

include_once(dirname(__FILE__) . "/model/companyCommercialName.controller.php");
global $admin_info, $PARAM;
global $company_info;
$commercialNameController = new commercialNameController();
if (isset($exportType)) {
    $commercialNameController->exportType = $exportType;
}


switch ($PARAM[1]) {
    case 'add':
        $commercialNameController->addCommercialName($_POST);
        break;
    case 'editAjax': {
        if (isset($_POST['id'])) {
            $commercialNameController->getCommercialNameByidAjax($_POST['id']);
        }
    }
        break;
    case 'edit':
        $commercialNameController->editCommercialName($_POST);
        break;
    case 'delete':
        if (isset($_POST['id'])) {
            $commercialNameController->deleteCommercialName($_POST['id']);
        }
        break;
    default:
        $commercialNameController->showList();
        break;
}

?>
