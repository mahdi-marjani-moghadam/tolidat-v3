<?php
include_once dirname(__FILE__).'/model/admin.laws.controller.php';

global $admin_info,$PARAM;

$controller = new adminLawsController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($_GET['action']) {
    case 'addLaws':
        
        if (!isset($_POST) || empty($_POST)) {
            $controller->showAddForm();
            break;
        } elseif ($_POST['action'] == 'add') {
            $_POST['image'] = $_FILES['image'];
            $controller->addLaws($_POST);
            break;
        }
    
    case 'editLaws':
        
        if (!isset($_POST) || empty($_POST)) {
            $controller->showEditForm($_GET['id']);
            break;
        } elseif ($_POST['action'] == 'edit') {
            $_POST['image'] = $_FILES['image'];
            $controller->editLaws($_POST);
            break;
        }
    
    case 'deleteLaws':
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $controller->deleteLaws($_GET['id']);
            break;
        }
    
    default:
        $controller->showList();
        break;
}
