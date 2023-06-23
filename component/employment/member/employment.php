<?php
include_once(dirname(__FILE__) . "/MemberEmploymentController.php");

global $PARAM;
$controller = new MemberEmploymentController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addEmployment($_POST);
        break;
    case 'addAjax' :
        $controller->getAddFormByAjax();
        break;
    case 'editAjax' :
        if (isset($_POST['id'])) {
            $controller->getEmploymentByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editEmployment($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteEmployment($_POST['id']);
        }
        break;

    case '' :

        $controller->showList();
        die();
}

