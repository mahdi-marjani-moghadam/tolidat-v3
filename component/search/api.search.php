<?php
require_once ROOT_DIR . 'component/search/controllers/SearchController.php';
include_once(ROOT_DIR . "common/rest/rest.php");

global $admin_info,$PARAM;

$controller = new SearchController();
$postController->exportType = 'json';


/*$contentType = explode(';', $_SERVER['CONTENT_TYPE']); // Check all available Content-Type
$rawBody = file_get_contents("php://input"); // Read body
$data = a rray(); // Initialize default data array

if(in_array('application/json', $contentType)) { // Check if Content-Type is JSON

    if(get_request_method()=="POST")
    {
        $_POST = (array) json_decode($rawBody); // Then decode it
    }

}

print_r_debug($_POST);*/

switch (get_request_method()) {
    case 'DELETE':
        //$controller->delete();
        break;
    case 'POST':
        $controller->api_getRow($_POST,$_GET);

        //$postController->api_getRow($_POST['ids']);
        //$postController->productCheck($_POST);

        //$controller->api_create($_POST);
        break;
    case 'GET':
        if (isset($PARAM[2]))
        {

            //$controller->api_getRow($PARAM[2]);
        }else
        {

            $controller->api_getAll($_GET);

        }
        break;
    case 'PUT':

        //$controller->api_update($PARAM[2],"php://input");
        break;
    default:
       // print_r_debug($PARAM);
        //$postController->_response(array("Error" => 'Invalid Method'), 405);
        break;
}


die();
