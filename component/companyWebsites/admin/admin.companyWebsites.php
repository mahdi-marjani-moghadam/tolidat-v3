<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyWebsites.controller.php';

global $admin_info,$PARAM;

$companyWebsiteController = new admincompany_websitesController();
if (isset($exportType)) {
    $companyWebsiteController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyWebsiteController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyWebsites','companyWebsites');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyWebsiteController->add($_POST,$_FILES['companyWebsite']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id']= $_GET['branch_id'];

            $companyWebsiteController->showCompanyWebsiteAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyWebsites','companyWebsites');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $companyWebsiteController->edit($_POST,$_FILES['companyWebsite']);
        } else {
            $fields['Websites_id'] = $_GET['id'];
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id']= $_GET['branch_id'];
            $companyWebsiteController->showCompanyWebsiteEditForm($fields, '');
        }
        break;
    case 'deleteCompanyWebsite':
        checkPermissions('deleteCompanyWebsites','companyWebsites');
        $fields['Websites_id'] = $_GET['id'];
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id']= $_GET['branch_id'];
        $companyWebsiteController->delete($fields);
        break;

////Draft
    case 'showDraftCompanyWebsite':
        checkPermissions('showDraftCompanyWebsites','companyWebsites');
        $input['company_id']=$_GET['id'];
        $companyWebsiteController->showDraftCompanyWebsite($input['company_id']);
        break;
    case 'editDraftCompanyWebsite':
        checkPermissions('editDraftCompanyWebsites','companyWebsites');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyWebsiteController->editDraftCompanyWebsite($_POST,$_FILES['companyWebsite']);
        }else{

            $fields['draft_id']=$_GET['id'];
            $companyWebsiteController->editDraftCompanyWebsiteForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','companyWebsites');
        $fields['company_id'] = $_GET['id'];
        $fields['company_id']=$_GET['company_id'];
        $fields['branch_id']= $_GET['branch_id'];
        $companyWebsiteController->showList($fields);
        break;
}
