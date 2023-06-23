<?php

include_once dirname(__FILE__) . '/model/index.controller.php';
require_once ROOT_DIR . "component/package/member/model/package.controller.php";

global $admin_info, $PARAM;
$indexController = new indexController;

if (isset($exportType)) {
    $indexController->exportType = $exportType;
}

if ($PARAM['1'] == "event") {
    $indexController->showAllEvent();
} else if ($PARAM['1'] == "news") {
    $indexController->showAllNews();
}else {
    $indexController->showALL($fields);
}