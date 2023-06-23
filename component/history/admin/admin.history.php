<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__) . '/model/admin.history.controller.php';

global $admin_info, $PARAM;

$historyController = new adminHistoryController();
if (isset($exportType)) {
    $honourController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $historyController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addHistory','history');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $historyController->add($_POST, $_FILES['history']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $historyController->showHistoryAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editHistory','history');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $historyController->edit($_POST, $_FILES['history']);
        } else {
            $input['history_id'] = $_GET['id'];
            $historyController->showHistoryEditForm($input, '');
        }
        break;
    case 'deleteHistory':
        checkPermissions('deleteHistory','history');
        $historyController->delete($_GET['id']);
        break;
////Draft
    case 'showDraftHistory':
        checkPermissions('showDraftHistory','history');
        $input['company_id'] = $_GET['id'];
        $historyController->showDraftHistory($input['company_id']);
        break;
    case 'editDraftHistory':
        checkPermissions('editDraftHistory','history');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $historyController->editDraftHistory($_POST, $_FILES['history']);
        } else {
            $fields['draft_id'] = $_GET['id'];
            $historyController->editDraftHistoryForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','history');
        $fields['company_id'] = $_GET['id'];
        $historyController->showList($fields);
        break;
}
