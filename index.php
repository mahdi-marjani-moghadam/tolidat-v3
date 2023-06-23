<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET');

// phpinfo();

//error_reporting(0);
error_reporting(E_ALL);
ini_set('display_errors', 'on');

include_once 'server.inc.php';
include_once ROOT_DIR . 'common/db.inc.php';
include_once ROOT_DIR . 'common/init.inc.php';

include_once ROOT_DIR . 'common/func.inc.php';
include_once ROOT_DIR . 'model/db.inc.class.php';
//include_once ROOT_DIR . 'common/chainquerybuilder.class.php';
include_once ROOT_DIR . 'common/looeic.php';



$_SERVER['REQUEST_URI'] = str_replace(array('ي', 'ك'), array('ی', 'ک'), $_SERVER['REQUEST_URI']);
$_POST = str_replace(array('ي', 'ك'), array('ی', 'ک'), $_POST);



global $admin_info, $PARAM;

$url_main = substr($_SERVER['REQUEST_URI'], strlen(SUB_FOLDER) + 1);
$url_main = urldecode($url_main);

if (strlen($url_main) == 0) {
    $url_main = INDEX_URL;
}
$PARAM = explode('/', $url_main);
$PARAM = array_filter($PARAM, 'strlen');
if($PARAM[0]=='c' and isset($PARAM[1]))
{
    $id=$PARAM[1];
    $PARAM[0]='company';
    $PARAM[2]=$PARAM[1];
    $PARAM[1]='Detail';


}

if($PARAM[0] == 'updatecategory'){
    updatecategory();   
}
//http://tolidat.local/company/Detail/21153/%DA%A9%DB%8C%D8%A7%D9%BE%D8%B1%D8%AF%D8%A7%D8%B2%D8%B4
if (array_search('exportType', $PARAM)) {
    die("What?");
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

// city
if (isset($PARAM['0']) && $PARAM['0'] != 'index') {
    include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';
    $city = adminCityModelDb::getCityByNameArray($PARAM['0']);
    if ($city['result'] == '1') {

        $_SESSION['city'] = $PARAM['0'];
        
    }
}

if (isset($_SESSION['city'])) {

    if ($PARAM['0'] == 'index') {
        unset($_SESSION['city']);
    }
    if (isset($PARAM['1'])) {
        if ($PARAM['0'] == $_SESSION['city']) {
            $componenetAdress = ROOT_DIR . "component/{$PARAM['1']}/{$PARAM['1']}.php";
        } else {
            $componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/{$PARAM['0']}.php";
        }
    } else {
        if ($PARAM['0'] == $_SESSION['city']) {
            $componenetAdress = ROOT_DIR . 'component/index/index.php';
        } else {
            $componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/{$PARAM['0']}.php";
        }
    }
} else {

    // short link router
    if(is_numeric($PARAM[0])){
        $PARAM[1] = $PARAM[0];
        $PARAM[0] = 'company';
    }
    // All component
    $componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/{$PARAM['0']}.php";

}


if (!file_exists($componenetAdress)) {
    http_response_code(404);
    $componenetAdress = ROOT_DIR . 'component/404/404.php';
}

include_once $componenetAdress;
