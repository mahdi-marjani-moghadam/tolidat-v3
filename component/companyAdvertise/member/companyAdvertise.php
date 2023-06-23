<?php

include_once(dirname(__FILE__) . "/MemberAdvertiseController.php");
global $company_info, $PARAM;
$controller = new MemberAdvertiseController();
if (isset($exportType)) {
    $controller->exportType = $exportType;
}
//print_r_debug($_POST);
switch ($PARAM[1]) {
    case 'add' :
        $controller->addAdvertise($_POST);
        break;
    case 'editAjax' :
        if (isset($_POST['id'])) {
            $controller->getAdvertiseByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editAdvertise($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteAdvertise($_POST['id']);
        }
        break;

    case '' :

        $controller->showList();
        die();
}
