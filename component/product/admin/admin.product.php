<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM
 */
include_once(dirname(__FILE__) . "/model/admin.product.controller.php");
global $admin_info, $PARAM;

$productController = new adminProductController();
if (isset($exportType)) {
    $productController->exportType = $exportType;
}
$productController->getProductCategory($fields);
switch ($_GET['action']) {
    case 'showMore':
        $productController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addProduct', 'product');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $productController->add($_POST, $_FILES['product']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $productController->showProductAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editProduct', 'product');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $productController->edit($_POST, $_FILES['companyProduct']);
        } else {
            $input['product_id'] = $_GET['id'];
            $productController->showProductEditForm($input, '');
        }
        break;
    case 'getProductCategory':
        checkPermissions('deleteProduct', 'product');
        $productController->getProductCategory($fields);
        break;
    case 'delete':
        checkPermissions('deleteProduct', 'product');
        $productController->delete($_GET['id']);
        break;

////Draft
    case 'showDraftProduct':
        checkPermissions('showDraftProduct', 'product');
        $input['company_id'] = $_GET['id'];
        $productController->showDraftProduct($input['company_id']);
        break;
    case 'editDraftProduct':
        checkPermissions('editDraftProduct', 'product');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $productController->editDraftProduct($_POST, $_FILES['companyProduct']);
        } else {
            $fields['draft_id'] = $_GET['draft_id'];
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = 0;
            $productController->editDraftProductForm($fields);
        }
        break;
////End Draft

    case 'showDraftGalleryProduct':
        checkPermissions('showDraftProduct', 'product');
        $input['company_id'] = $_GET['id'];
        $productController->showDraftGalleryProduct($input['company_id']);
        break;

    case 'editDraftGalleryProduct':
        checkPermissions('editDraftProduct', 'product');

        if (isset($_POST['action'])) {
            $_POST['company_id'] = $_GET['company_id'];
            $_POST['product_gallery_id'] = $_GET['product_gallery_id'];
            $productController->editDraftGalleryProduct($_POST);
        } else {
            $productController->editDraftGalleryProductForm($_GET);
        }
        break;

    default:
        checkPermissions('showList', 'product');
        $fields['choose']['company_id'] = $_GET['id'];
        $productController->showList($fields);
        break;
}

?>