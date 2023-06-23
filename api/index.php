<?php

//error_reporting(0);
include_once '../server.inc.php';
include_once ROOT_DIR . 'common/looeic.config.php';
include_once ROOT_DIR.'common/db.inc.php';
include_once ROOT_DIR.'common/init.inc.php';
include_once ROOT_DIR.'common/func.inc.php';
include_once ROOT_DIR.'model/db.inc.class.php';
include_once ROOT_DIR . 'common/chainquerybuilder.class.php';
include_once ROOT_DIR.'common/looeic.php';
global $admin_info,$PARAM;



function applicationData()
{
    $contentType = explode(';', $_SERVER['CONTENT_TYPE']); // Check all available Content-Type
    $rawBody = file_get_contents("php://input"); // Read body
    $data = array(); // Initialize default data array

    if(in_array('application/json', $contentType)) { // Check if Content-Type is JSON

        if(get_request_method()=="POST")
        {
            $_POST = (array) json_decode($rawBody); // Then decode it
        }

    }

}

applicationData();

function get_request_method()
{
    return $_SERVER['REQUEST_METHOD'];
}

$url_main = substr($_SERVER['REQUEST_URI'], strlen(SUB_FOLDER) + 1);
$url_main = urldecode($url_main);

if(strpos($url_main,'?'))
{
    $url_main=substr($url_main,0,strpos($url_main,'?'));

}


define("INDEX_URL", 'index');
define("looeicConfig", 'api');

if (strlen($url_main) == 0) {
    $url_main = INDEX_URL;
}


$PARAM = explode('/', $url_main);
$PARAM = array_filter($PARAM, 'strlen');

if (array_search('exportType', $PARAM)) {
    $index_exportType = array_search('exportType', $PARAM);
    $exportType = $PARAM[$index_exportType + 1];
    unset($PARAM[$index_exportType]);
    unset($PARAM[$index_exportType + 1]);
    $PARAM = implode('/', $PARAM);
    $PARAM = explode('/', $PARAM);
    $PARAM = array_filter($PARAM, 'strlen');
}

if (array_search('page', $PARAM)) {
    $index_pageSize = array_search('page', $PARAM);
    $page = $PARAM[$index_pageSize + 1];
    unset($PARAM[$index_pageSize]);
    unset($PARAM[$index_pageSize + 1]);
    $PARAM = implode('/', $PARAM);
    $PARAM = explode('/', $PARAM);
    $PARAM = array_filter($PARAM, 'strlen');
}

if (isset($_SESSION['city'])) {
    if ($PARAM['0'] == 'index') {
        unset($_SESSION['city']);
    }
    if (isset($PARAM['1'])) {
        if ($PARAM['0'] == $_SESSION['city']) {
            $componenetAdress = ROOT_DIR."component/{$PARAM['1']}/{$PARAM['1']}.php";
        } else {
            $componenetAdress = ROOT_DIR."component/{$PARAM['0']}/{$PARAM['0']}.php";
        }
    } else {
        if ($PARAM['0'] == $_SESSION['city']) {
            $componenetAdress = ROOT_DIR.'component/index/app.index.php';
        } else {
            $componenetAdress = ROOT_DIR."component/{$PARAM['0']}/app.{$PARAM['0']}.php";
        }
    }
} else {
    $componenetAdress = ROOT_DIR."component/{$PARAM['1']}/api.{$PARAM['1']}.php";
}

if (!file_exists($componenetAdress)) {
    die('not found');
    $componenetAdress = ROOT_DIR.'component/404/404.php';
}
include_once $componenetAdress;
echo $componenetAdress;


if(isset($_GET['component']))
{
    $component=$_GET['component'];
    $component_name=$_GET['component_name'];
}else
{
    $component='index';
    $component_name='index';
}
$component_address=ROOT_DIR . "component/$component/admin/admin.$component.php";
if (!file_exists($component_address)) {
    $component_address=ROOT_DIR . "component/$component/admin.$component.php";
}

include_once ($component_address);














