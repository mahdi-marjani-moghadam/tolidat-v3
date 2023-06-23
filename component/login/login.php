<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */

include_once(dirname(__FILE__) . "/model/login.controller.php");

global $PARAM;

$loginController = new loginController();

if ( isset($exportType) ) {
    $loginController->exportType = $exportType;
}


if ( $PARAM['0'] == 'login' & $PARAM['1'] == null ) {
    if ( isset($_POST['action']) & $_POST['action'] == 'login' ) {
        $loginController->login($_POST);
        die();
        
    }
    
    $loginController->callLoginForm();
}
switch ($PARAM[1]) {

    case 'logout' :
        $loginController->logout();
        break;

    case 'sendEmail' :
        $loginController->sendEmail($_POST['username']);
        break;

    case 'getUsername' :
        $loginController->getUsernameForm();
        break;

    case 'newPassword' :
        $loginController->savePassword($_POST);
        break;
    case 'loginAs' :
        //die('a');
        //$loginController->LoginAs($_GET['company_id']);
        break;

    case 'getNewPassword' :
        $loginController->getNewPasswordForm($PARAM[2]);
        break;
}

