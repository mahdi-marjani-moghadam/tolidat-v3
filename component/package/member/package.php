<?php

include_once ROOT_DIR . "component/package/member/model/package.controller.php";

global $PARAM;

$controller = new memberPackageController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {
    case 'upgrade' :
        $controller->showPackageList();
        break;
}
