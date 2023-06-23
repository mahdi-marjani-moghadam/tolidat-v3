<?php

include_once(dirname(__FILE__). "/model/index.controller.php");
include_once(ROOT_DIR . "common/rest/rest.php");

global $admin_info,$PARAM;

$controller = new indexController();
$postController->exportType = 'json';

switch (get_request_method()) {
    case 'DELETE':
        //$controller->delete();
        break;
    case 'POST':
        //$postController->api_getRow($_POST['ids']);
        //$postController->productCheck($_POST);
        //$controller->api_create($_POST);
        break;
    case 'GET':
        if (!isset($PARAM[2]))
        {
            $controller->api_getAll($_GET);

        }
        break;
    case 'PUT':

        //$controller->api_update($PARAM[2],"php://input");
        break;
    default:
        //print_r_debug($PARAM);

        //$postController->_response(array("Error" => 'Invalid Method'), 405);
        break;
}

die();
