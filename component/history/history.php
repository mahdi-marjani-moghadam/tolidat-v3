<?php
include_once(dirname(__FILE__) . "/model/history.controller.php");

global $company_info, $PARAM;

$controller = new historyController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM['1']) {
    case 'all':
        $controller->showAllHistory($PARAM['2']);
        break;
}

