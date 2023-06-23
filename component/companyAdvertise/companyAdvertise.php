<?php
include_once ROOT_DIR . "component/companyAdvertise/AdvertiseController.php";

global $PARAM;

$controller = new AdvertiseController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM['1']) {
    case "all" :
        $controller->index($PARAM['2']);
        break;
    case "show" :
        $controller->show($PARAM['2']);
        break;
}
