<?php

include_once ROOT_DIR . "component/package/model/PackageController.php";

global $PARAM;

$controller = new PackageController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {
    case 'all' :
        $controller->showAll();
        break;
    case '' :
        $controller->showList();
        break;
}
