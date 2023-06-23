<?php

include_once(dirname(__FILE__). "/model/companyContacts.controller.php");
include_once ROOT_DIR . 'component/company/model/company.model.php';
include_once ROOT_DIR . 'component/company/model/company.controller.php';
global $admin_info,$PARAM;
global $company_info;
$contactController = new contactController();
if(isset($exportType))
{
    $contactsController->exportType=$exportType;
}

elseif ($PARAM[1] == 'add' and !empty($_POST)) {
    $contactController->addContacts($_POST);
}
else{

    $contactController->showSideBarMenu($PARAM[1]);
}