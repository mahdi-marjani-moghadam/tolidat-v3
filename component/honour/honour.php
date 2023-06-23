<?php

include_once ROOT_DIR . "component/honour/model/honour.controller.php";
global $PARAM;

$honourController = new HonourController();
if (isset($exportType)) {
    $honourController->exportType = $exportType;
}

switch ($PARAM['1']) {

    case 'all':
        $honourController->index($PARAM['2']);
        break;

    case 'show':
        $honourController->show($PARAM['2']);
        break;
}
