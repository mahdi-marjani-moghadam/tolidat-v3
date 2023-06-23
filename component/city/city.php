<?php

include_once(dirname(__FILE__) . "/model/city.controller.php");

global $company_info, $PARAM;

$controller = new cityController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {

    case 'getCityByProvinceID' :
        $controller->getCityByProvinceID($_POST['province_id']);
}


