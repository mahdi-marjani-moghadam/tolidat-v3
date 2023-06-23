<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.honour.controller.php';

global $admin_info,$PARAM;
$honourController = new adminHonourController();
if (isset($exportType)) {
    $honourController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $honourController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addHonour','honour');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $honourController->add($_POST,$_FILES['image']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $honourController->showHonourAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editHonour','honour');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $honourController->edit($_POST,$_FILES['honour']);
        } else {
            $input['honour_id'] = $_GET['id'];
            //$input['company_id']=
            $honourController->showHonourEditForm($input, '');
        }
        break;
    case 'deleteHonour':
        checkPermissions('deleteHonour','honour');
        $honourController->delete($_GET['id']);
        break;
////Draft
    case 'showDraftHonour':
        checkPermissions('showDraftHonour','honour');
        $input['company_id']=$_GET['id'];
        $honourController->showDraftHonour($input['company_id']);
        break;
    case 'editDraftHonour':
        checkPermissions('editDraftHonour','honour');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $honourController->editDraftHonour($_POST,$_FILES['honour']);
        }else{
            $fields['draft_id']=$_GET['id'];
            $honourController->editDraftHonourForm($fields);
        }
        break;
////EndDraft
    default:
        checkPermissions('showList','honour');
        $fields['company_id'] = $_GET['id'];
        $honourController->showList($fields);
        break;
}
