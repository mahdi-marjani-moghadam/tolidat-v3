<?php

include_once ROOT_DIR . "services/crm/LeadTaskService.php";
include_once ROOT_DIR . "services/crm/LeadService.php";
include_once ROOT_DIR . "component/crm/leadController.php";


global $admin_info, $PARAM;




$leadController = new leadController(new LeadService(), new LeadTaskService());
$leadController->store($_POST);
