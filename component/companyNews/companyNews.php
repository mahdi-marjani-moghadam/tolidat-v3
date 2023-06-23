<?php

include_once(dirname(__FILE__) . "/model/companyNews.controller.php");

global $company_info, $PARAM;

$controller = new companyNewsController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'all' :
        $controller->index($PARAM['2']);
        break;
    case 'show' :
        $controller->show($PARAM['2']);
        break;
}

