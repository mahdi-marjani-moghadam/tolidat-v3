<?php

include(dirname(__FILE__) . "/model/register.controller.php");
global $PARAM;
$registerController = new registerController();
//session_unset();
//print_r_debug(unserialize($_SESSION['step']));

if (isset($exportType)) {
    $registerController->exportType = $exportType;
}

switch ($PARAM[0]) {

    case 'register' :

        if ($PARAM[1] == 'checkCode' & !empty($_POST)) {
            $registerController->checkCode($_POST['code']);
            break;
        }

        if ($PARAM[1] == 'getCompanyByAjax' & !empty($_POST)) {
            $registerController->getCompanyByAjax($_POST['national_id']);
            break;
        }

        if ($PARAM[1] == 'sendCodeAgain') {
            $registerController->sendTokenAgain($_SESSION['step']);
            break;
        }

        if ($PARAM[1] == "addLicence") {
            $registerController->addLicence();
            break;
        }

        if ($PARAM[1] == 'addLicenceByAjax' & !empty($_POST)) {
            $registerController->addLicenceByAjax($_POST);
            break;
        }

        if ($PARAM[1] == 'deleteLicenceByAjax') {
            $registerController->deleteLicenceByAjax();
            break;
        }

        if ($PARAM[1] == 'final') {
            $registerController->showRegisterStepFinal();
        }

        if (!empty($_FILES)) {
            $_POST['image'] = $_FILES['image'];
        }
        
        $registerController->showRegisterForm($_POST);
        break;


}





