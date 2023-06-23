<?php
include_once(dirname(__FILE__) . "/model/member.product.controller.php");
global $admin_info, $PARAM;
global $company_info;
$productController = new memberProductController();
if (isset($exportType)) {
    $productController->exportType = $exportType;
}

switch ($PARAM[1]) {

    case 'add':
//        $_POST['img']=$_FILES['imageCropped'];
        $productController->addProduct($_POST);
        break;

    case 'editAjax':
        if (isset($_POST['id'])) {
            $productController->getProductByidAjax($_POST['id']);
        }
        break;

    case 'edit':
        $_POST['img'] = $_FILES['image_tmp'];
        $productController->editProduct($_POST);
        break;

    case 'delete':
        if (isset($_POST['id'])) {
            $productController->deleteProduct($_POST['id']);
        }
        break;

    case 'getKey':
        $productController->getKey();
        break;

    case 'showGallery' :
        $productController->showProductGallery($_POST);
        break;

    case 'addGallery' :
        $productController->addProductGallery($_POST);
        break;

    case 'deleteGallery' :
        $productController->deleteProductGallery($_POST);
        break;

    default:
        $productController->showList();
        break;
}
