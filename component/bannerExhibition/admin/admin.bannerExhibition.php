<?php
include_once ROOT_DIR . 'component/bannerExhibition/admin/AdminBannerExhibitionController.php';

$controller = new AdminBannerExhibitionController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'addBanner' :
        if (isset($_POST) & !empty($_POST)) {
            $_POST['image'] = $_FILES['image'];
            $controller->add($_POST);
        } else {
            $controller->showAddForm();
        }
        break;

    case 'editBanner' :
        if (isset($_POST) & !empty($_POST)) {
            $_POST['image'] = $_FILES['image'];
            $controller->edit($_POST);
        } else {
            $controller->showEditForm($_GET['id']);
        }
        break;

    case 'deleteBanner' :
        $controller->delete($_GET['id']);
        break;

    default :
        $controller->showList();
        break;
}