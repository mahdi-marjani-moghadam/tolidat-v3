<?php
include_once(dirname(__FILE__) . "/model/companyContacts.controller.php");

global $PARAM;
$controller = new contactsController();
//print_r_debug($PARAM);
if (isset($exportType)) {
    $controller->exportType = $exportType;
}
if($PARAM['1'] == 'us' & $PARAM['2']=='') {

    $controller->showListContacts();
}
if ($PARAM['1'] == 'us' & $PARAM['2']=='delete')
{
    $controller->deleteContactUs($_POST['id']);
}
if ($PARAM['0'] == 'companyContacts' & !empty($PARAM['1']))
{
    $controller->showList($PARAM['1']);
}
if ($PARAM['0'] == 'companyContacts' & empty($PARAM['1']))
{
    $controller->showList(0);
}

