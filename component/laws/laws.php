<?php

include_once dirname(__FILE__).'/model/laws.controller.php';

global $admin_info,$PARAM;

$controller = new lawsController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

$controller->showLaws();

