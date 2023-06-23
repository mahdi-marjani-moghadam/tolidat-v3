<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 3/16/2016
 * Time: 3:21 AM
 */

include_once(dirname(__FILE__) . "/model/product.controller.php");
global $PARAM;
$productController = new productController();
if (isset($exportType)) {
    $productController->exportType = $exportType;
}

switch ($PARAM['1']) {
    case 'all':
        $productController->showAllProduct($PARAM['2']);
        break;
    case 'show':
        $productController->showProductDetail($PARAM['2']);
        break;
    case 'contactUs':
        $productController->addContacts($_POST);
}



/*if ($PARAM['0'] == 'product' & isset($PARAM['1']) & $_POST['action'] != 'add') {

    $productController->showProductDetail($PARAM['1']);
} else {
    $productController->addContacts($_POST);
}*/








