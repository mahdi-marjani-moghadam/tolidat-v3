<?php
include_once(dirname(__FILE__) . "/model/companyLogo.controller.php");

global $PARAM;

$controller = new logoController();
if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'add' :

        $_POST['img'] = $_FILES['image'];
        $controller->addLogo($_POST);
        break;

    case 'editAjax' :

        if (isset($_POST['id'])) {
            $controller->getLogoByidAjax($_POST['id']);
        }
        break;

    case 'edit' :
        //$_POST['img'] = $_FILES['image_tmp'];
        $controller->editLogo($_POST);
        break;

    case 'delete' :
        $controller->deleteLogo();
        break;

    case '' :
        $controller->showList();
        die();

}

