<?php

include_once ROOT_DIR . "component/representation/model/RepresentationController.php";
global $PARAM;

$controller = new RepresentationController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM['1']) {

    case 'all':
        $controller->index($PARAM['2']);
        break;

    case 'show':
        $controller->show($PARAM['2']);
        break;
}

