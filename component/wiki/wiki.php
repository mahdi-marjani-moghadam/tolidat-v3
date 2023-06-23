<?php
include_once dirname(__FILE__) . '/model/wiki.controller.php';
global $admin_info, $PARAM;
$controller = new wikiController();
//session_unset();
//print_r_debug(unserialize($_SESSION['step']));

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM['1']) {
    case 'deleteLicenceByAjax' :
        $controller->deleteLicenceByAjax();
        break;

    case 'showLicenceModal' :
        $controller->showLicenceModal($_POST);
        break;

    case 'addLicenceByAjax' :
        $controller->addLicenceByAjax($_POST);
        break;

    case 'final' :
        $controller->showStepFianl();
        break;

    case 'sendCodeAgain' :
        $controller->sendTokenAgain($_SESSION['wiki']);
        break;

    default:
        $controller->wiki($_POST, $PARAM[1]);
        break;
}

