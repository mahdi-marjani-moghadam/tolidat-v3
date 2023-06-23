<?php

include_once(dirname(__FILE__) . "/model/companyNews.controller.php");

global $company_info, $PARAM;

$controller = new companyNewsController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :
        $controller->addNews($_POST);
        break;

    case 'editAjax' :
        if (isset($_POST['id'])) {
            $controller->getNewsByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        $controller->editNews($_POST);
        break;

    case 'delete' :

        if (isset($_POST['id'])) {
            $controller->deleteNews($_POST['id']);
        }
        break;

    case '' :
        $controller->showList();
        die();
}
?>
