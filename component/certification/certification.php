<?php

include_once(dirname(__FILE__) . "/model/certification.controller.php");

global $company_info, $PARAM;

$controller = new CertificationController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM['1']) {
    case 'all':
        $controller->showAllCertification($PARAM['2']);
        break;
//    case 'show':
//        $controller->showCertificationDetail($PARAM['2']);
//        break;
}

