<?php
include_once(dirname(__FILE__) . "/model/companyPosition.controller.php");

global $PARAM;

$controller = new positionController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    
    case 'edit' :
        $controller->editPosition($_POST);
        break;

}

