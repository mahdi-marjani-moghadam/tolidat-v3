<?php
include_once '../server.inc.php';
include_once ROOT_DIR . 'common/db.inc.php';
include_once ROOT_DIR . 'common/init.inc.php';
include_once ROOT_DIR . 'common/func.inc.php';
include_once ROOT_DIR . 'model/db.inc.class.php';
include_once ROOT_DIR . 'common/chainquerybuilder.class.php';
include_once ROOT_DIR . 'common/looeic.php';

global $admin_info, $PARAM, $company_info;


$url_main = substr($_SERVER['REQUEST_URI'], strlen(SUB_FOLDER) + 1);
$url_main = substr($url_main, strlen('member') + 1);

$url_main = urldecode($url_main);

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

include_once ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.controller.php";
$packageUsage = adminPackageUsageController::getPackageByCompanyID($company_info['company_id']);

if (!is_object($packageUsage)) {

    if ($PARAM[0] != 'invoice' AND $PARAM[0] != 'package' AND $PARAM[0] != 'companyLogo' AND $PARAM[0] != 'companyBanner') {
        redirectPage(RELA_DIR . "profile", 'اکانت شما غیر فعال می باشد');
    } else {
        $componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/member/{$PARAM['0']}.php";
    }

} else {
    $componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/member/{$PARAM['0']}.php";
}

//$componenetAdress = ROOT_DIR . "component/{$PARAM['0']}/member/{$PARAM['0']}.php";


if (!file_exists($componenetAdress)) {
    $componenetAdress = ROOT_DIR . 'component/404/404.php';
}
include_once $componenetAdress;
