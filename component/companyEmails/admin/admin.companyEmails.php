<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyEmails.controller.php';

global $admin_info,$PARAM;


$companyEmailController = new admincompany_emailsController();
if (isset($exportType)) {
    $companyEmailController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyEmailController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyEmails','companyEmails');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyEmailController->add($_POST,$_FILES['companyEmail']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyEmailController->showCompanyEmailAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyEmails','companyEmails');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyEmailController->edit($_POST,$_FILES['companyEmail']);
        } else {
            $fields['email_id'] = $_GET['id'];
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyEmailController->showCompanyEmailEditForm($fields, '');
        }
        break;
    case 'deleteCompanyEmails':
        checkPermissions('deleteCompanyEmails','companyEmails');
        $fields['id'] = $_GET['id'];
        $fields['company_id']=$_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companyEmailController->delete($fields);
        break;

////Draft
    case 'showDraftCompanyEmail':
        checkPermissions('showDraftCompanyEmail','companyEmails');
        $input['company_id']=$_GET['id'];
        $companyEmailController->showDraftCompanyEmail($input['company_id']);
        break;
    case 'editDraftCompanyEmail':
        checkPermissions('editDraftCompanyEmail','companyEmails');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyEmailController->editDraftCompanyEmail($_POST,$_FILES['companyEmail']);
        }else{
            $fields['draft_id']=$_GET['id'];
            $companyEmailController->editDraftCompanyEmailForm($fields);
        }
        break;
////End Draft

    default:
        checkPermissions('showList','companyEmails');

        $fields['company_id']=$_GET['company_id'];

        $fields['branch_id']= $_GET['branch_id'];
        $companyEmailController->showList($fields);
        break;
}
