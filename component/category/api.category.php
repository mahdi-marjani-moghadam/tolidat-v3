<?php


include_once(dirname(__FILE__). "/model/category.controller.php");
include_once(ROOT_DIR . "common/rest/rest.php");

global $admin_info,$PARAM;

$controller = new categoryController();
$postController->exportType = 'json';

switch (get_request_method()) {
    case 'DELETE':
        //$controller->delete();
        break;
    case 'POST':

        //$postController->api_getRow($_POST['ids']);
        //$postController->productCheck($_POST);

       // $controller->api_create($_POST);
        break;
    case 'GET':

        if (isset($PARAM[2]))
        {


               if ($PARAM[2]=='subCategory'){


                $controller->api_getCatByParent_id($PARAM[3]);
            }else if ($PARAM[2]=='companyByCategory'){

                    $controller->api_companyByCategory($PARAM[3]);
            }else
            {
                $controller->api_getAll($PARAM[2]);
            }

        }else
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
