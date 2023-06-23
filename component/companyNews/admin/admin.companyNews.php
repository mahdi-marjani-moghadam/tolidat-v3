<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyNews.controller.php';

global $admin_info,$PARAM;

$companyNewsController = new admincompany_newsController();
if (isset($exportType)) {
    $companyNewsController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyNewsController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyNews','companyNews');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyNewsController->add($_POST,$_FILES['companyNews']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $companyNewsController->showCompanyNewsAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyNews','companyNews');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyNewsController->edit($_POST,$_FILES['companyNews']);
        } else {
            $input['news_id'] = $_GET['id'];
            $companyNewsController->showCompanyNewsEditForm($input, '');
        }
        break;
    case 'deleteCompanyNews':
        checkPermissions('deleteCompanyNews','companyNews');
        $companyNewsController->delete($_GET['id']);
        break;
    ////Draft
    case 'showDraftCompanyNews':
        checkPermissions('showDraftCompanyNews','companyNews');
        $input['company_id']=$_GET['id'];
        $companyNewsController->showDraftCompanyNews($input['company_id']);
        break;
    case 'editDraftCompanyNews':
        checkPermissions('editDraftCompanyNews','companyNews');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyNewsController->editDraftCompanyNews($_POST,$_FILES['companyNews']);
        }else{
            $fields['draft_id']=$_GET['id'];
            $companyNewsController->editDraftCompanyNewsForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','companyNews');
        $fields['company_id'] = $_GET['id'];
        $companyNewsController->showList($fields);
        break;
}
