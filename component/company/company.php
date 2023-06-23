<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 3/16/2016
 * Time: 3:21 AM.
 */
include_once dirname(__FILE__) . '/model/company.controller.php';
/*
global $admin_info,$PARAM;
$companyController = new companyController();
if (isset($exportType)) {
    $companyController->exportType = $exportType;
}


unset($_SESSION['companyBreadcrumb']);
unset($_SESSION['productBreadcrumb']);

$typeIndex = array_search('type', $PARAM);
if ($typeIndex) {
    $fields['type'] = $PARAM[$typeIndex + 1];
}

$qIndex = array_search('q', $PARAM);
if ($qIndex) {
    $fields['q'] = $PARAM[$qIndex + 1];
}

//hamid
$provinceIndex = array_search('province', $PARAM);
if ($provinceIndex) {
    $fields['province'] = $PARAM[$provinceIndex + 1];
}
//end hamid


$cityIndex = array_search('city', $PARAM);
if ($cityIndex) {
    $fields['city'] = $PARAM[$cityIndex + 1];
}

$categoryIndex = array_search('category', $PARAM);
if ($categoryIndex) {
    $fields['category'] = $PARAM[$categoryIndex + 1];
}

$orderIndex = array_search('order', $PARAM);
if ($orderIndex) {
    $fields['order'] = $PARAM[$orderIndex + 1];
}
//print_r_debug($page);

$fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
$fields['limit']['length'] = PAGE_SIZE;
// print_r_debug("2");


$companyController->showALL($fields);
die();*/

global $admin_info, $PARAM;
$companyController = new companyController();

if (isset($exportType)) {
    $companyController->exportType = $exportType;
}

if (isset($PARAM[0]) and $PARAM[1] == 'ajaxSearch') {
    $companyController->suggest($_POST);
}

if (is_numeric($PARAM[1])) {
    //short link 
    $companyController->showDetail($PARAM[1], true);
    
} else if (isset($PARAM[0]) and $PARAM[0] == $_SESSION['city'] and empty($_POST)) {
    // doesnt use
    dd('Error Not found 80!');
    $fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
    $fields['limit']['length'] = PAGE_SIZE;
    $fields['order']['company_id'] = 'DESC';
    $fields['chose']['category_id'] = $PARAM[2];

    include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';
    $cities = adminCityModelDb::getAll()['export']['list'];
    $city = $_SESSION['city'];
    foreach ($cities as $key => $c) {
        if ($city == $c['name']) {
            $fields['chose']['city_id'] = $c['City_id'];
        }
    }
    $companyController->showALL($fields);
} elseif ($PARAM[1] != 'Detail' and empty($_POST) and $PARAM[3] != 'all') {

    // Landing page 
    

    unset($_SESSION['companyBreadcrumb']);
    unset($_SESSION['productBreadcrumb']);

    $typeIndex = array_search('type', $PARAM);
    if ($typeIndex) {
        $fields['type'] = $PARAM[$typeIndex + 1];
    }

    // $qIndex = array_search('q', $PARAM);
    $qIndex = $_GET['q'];
    if ($qIndex) {
        $fields['q'] = $qIndex;
    }


    $provinceIndex = array_search('province', $PARAM);
    if ($provinceIndex) {
        $fields['province'] = $PARAM[$provinceIndex + 1];
    }

    $cityIndex = array_search('city', $PARAM);
    if ($cityIndex) {
        $fields['city'] = $PARAM[$cityIndex + 1];
    }



    // redirect 301 old category url
    $oldCategory = array_search('category', $PARAM);
    if($oldCategory){
        $catSlug = (new category)->getCategorySlug($PARAM[$oldCategory + 1]);
        
        header("Location: /company/c/".$catSlug , 301);
    }

    // convert slug to id
    $categoryIndex = array_search('c', $PARAM);
    if ($categoryIndex) {
        $category_ids = getCategoriyIds($PARAM[$categoryIndex + 1]);
        $fields['c'] = $PARAM[$categoryIndex + 1];
        $fields['category'] = $category_ids;
    }




    $orderIndex = array_search('order', $PARAM);
    if ($orderIndex) {
        $fields['order'] = $PARAM[$orderIndex + 1];
    }
    $fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
    $fields['limit']['length'] = PAGE_SIZE;
    
    
    $companyController->showALL($fields);
    
} elseif (isset($PARAM[2]) and $PARAM[1] == 'Detail' and empty($_POST)) {
    $companyController->showDetail($PARAM[2]);
} elseif (isset($PARAM[0]) and $PARAM[1] == 'editWikiAjax' and $PARAM[2] == 'address' and !empty($_POST)) {
    $companyController->getCompanyAddress($_POST['address_id']);
} elseif (isset($PARAM[0]) and $PARAM[1] == 'editWiki' and $PARAM[2] == 'address' and !empty($_POST)) {

    $companyController->eidtCompanyAddress($_POST);
} elseif (isset($PARAM[0]) and $PARAM[1] == 'editWikiAjax' and $PARAM[2] == 'phone' and !empty($_POST)) {
    $companyController->getCompanyPhone($_POST['phone_id']);
} elseif (isset($PARAM[0]) and $PARAM[1] == 'editWiki' and $PARAM[2] == 'phone' and !empty($_POST)) {
    $companyController->eidtCompanyPhone($_POST);
} elseif (isset($PARAM[1]) and $PARAM[3] == "all") {
    
    $companyController->showALLFeature($PARAM[1], $PARAM[2]);
}
