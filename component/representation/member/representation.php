<?php
include_once(dirname(__FILE__) . "/model/representation.controller.php");
global $admin_info, $PARAM;
global $company_info;
$representationController = new representationController();
if (isset($exportType)) {
    $representationController->exportType = $exportType;
}
switch ($PARAM['1']) {
    case  'add':
        $representationController->addCode($_POST);
        break;
    case 'delete' :
        $representationController->deleteRepresentation($_POST);
        break;
    case 'confirm':
        $representationController->confirmRepresentation($_POST);
        break;
    case 'reject':
        $representationController->rejectRepresentation($_POST);
        break;
    case '':
        $representationController->showList();
        die();
}