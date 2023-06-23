<?php
include_once(dirname(__FILE__) . "/model/branch.controller.php");
global $admin_info, $PARAM;
$controller = new branchController();
if (isset($exportType)) {
    $controller->exportType = $exportType;
}
if ($PARAM['0'] == 'branch' and $PARAM['1'] == 'add') {
    $controller->addBranch($_POST);
}
if ($PARAM['0'] == 'branch' and $PARAM['1'] == 'getProvince') {
    $controller->getProvince($_POST);
}
if ($PARAM['0'] == 'branch' and $PARAM['1'] == 'editBranch') {
    $controller->editBranch($_POST);
}
if ($PARAM['0'] == 'branch' and $PARAM['1'] == 'getBranchByidAjax') {
    $controller->getBranchByidAjax($_POST);
}if ($PARAM['0'] == 'branch' and $PARAM['1'] == 'delete') {
    $controller->deleteBranch($_POST);
}