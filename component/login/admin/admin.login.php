<?php
/**
 * Created by PhpStorm.
 * User: marjani,ahmadloo
 * Date: 4/07/2016
 * Time: 9:21 AM
 */
include_once("../../../server.inc.php");
include_once(ROOT_DIR . "common/db.inc.php");
include_once(ROOT_DIR . "admin/init.inc.php");
include_once(ROOT_DIR . "common/func.inc.php");
include_once(ROOT_DIR . "/common/validators.php");
include_once(dirname(__FILE__) . "/model/admin.login.controller.php");
include_once(dirname(__FILE__) . "/model/loginAs.model.php");


global $admin_info;

$loginController = new adminLoginController();
if (isset($exportType)) {
    $loginController->exportType = $exportType;
}

if ($_REQUEST['action'] == 'logout') {

    $loginController->callLogout();
}

if ($_POST['action'] == 'login') {
    if ($admin_info != -1) {
        header('Location: ' . RELA_DIR . 'admin/');
        die();
    }
    $loginController->callLogin($_POST);
} else if ($_REQUEST['action'] == 'loginAs') {
    $loginController->loginAs($_GET['id']);
} else {
    $loginController->showLoginform();
}
