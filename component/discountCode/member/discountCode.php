<?php
include_once(dirname(__FILE__) . "/model/member.discountCode.controller.php");

global $PARAM;

$controller = new discountCodeController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}



