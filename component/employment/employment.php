<?php
include_once ROOT_DIR . "component/employment/EmploymentController.php";

global $PARAM;
$controller = new EmploymentController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
//print_r_debug($PARAM);

switch ($PARAM[1]) {
    case 'all' :
        $controller->index($PARAM[2]);
        break;
    case 'show':
        $controller->show($PARAM[2]);
        break;
}
