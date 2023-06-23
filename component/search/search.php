<?php

require_once ROOT_DIR . 'component/search/controllers/SearchController.php';

global $admin_info,$PARAM;
$searchController = new SearchController();
if (isset($exportType)) {
    $searchController->exportType = $exportType;
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

$fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
$fields['limit']['length'] = PAGE_SIZE;

// require_once ROOT_DIR . "component/product/admin/model/admin.product.model.php";
// $product = new adminc_productModel;
// $result = $product->syncProductWithCompany();


$searchController->showALL($fields);
die();
