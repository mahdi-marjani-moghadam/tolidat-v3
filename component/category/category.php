<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */
include_once(dirname(__FILE__) . "/model/category.controller.php");

global $admin_info, $PARAM;

$categoryController = new categoryController();
if (isset($exportType)) {
    $categoryController->exportType = $exportType;
}

switch ($PARAM[1]) {
    case "all" :
        $categoryController->index($PARAM['2']);
        break;
    case "check":
        $categoryController->check();
        break;
    default:
        $categoryController->showList();
        break;
}
