<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companyPhones.controller.php';
include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';

global $admin_info,$PARAM;

$companyPhoneController = new admincompany_phonesController();
$packageUsageController = new adminPackageUsageController();

if (isset($exportType)) {
    $companyPhoneController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyPhoneController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyPhones','companyPhones');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyPhoneController->add($_POST,$_FILES['companyPhone']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyPhoneController->showCompanyPhoneAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyPhones','companyPhones');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyPhoneController->edit($_POST,$_FILES['companyLogo']);
        } else {
            $input['phone_id'] = $_GET['id'];
            $input['company_id']=$_GET['company_id'];
            $input['branch_id']=$_GET['branch_id'];
            $companyPhoneController->showCompanyPhoneEditForm($input, '');
        }
        break;
    case 'deleteCompanyPhone':
        checkPermissions('deleteCompanyPhones','companyPhones');
        $input['company_id']=$_GET['company_id'];
        $input['phone_id']=$_GET['id'];
        $input['branch_id']=$_GET['branch_id'];
        $companyPhoneController->delete($input);
        break;

////Draft
    case 'showDraftCompanyPhone':
        checkPermissions('showDraftCompanyPhones','companyPhones');
        $input['company_id']=$_GET['id'];
        $companyPhoneController->showDraftCompanyPhone($input['company_id']);
        break;
    case 'editDraftCompanyPhone':
        checkPermissions('editDraftCompanyPhones','companyPhones');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyPhoneController->editDraftCompanyPhone($_POST,$_FILES['companyPhone']);
        } else {
            $fields['draft_id']  = $_GET['id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyPhoneController->editDraftCompanyPhoneForm($fields);
        }
        break;
////End Draft

////Wiki
    case 'showWikiCompanyPhone':
        //checkPermissions('showWikiCompanyPhones','companyPhones');
        $input['company_id']=$_GET['id'];
        $companyPhoneController->showWikiCompanyPhone($input['company_id']);
        break;
    case 'editWikiCompanyPhone':
        //checkPermissions('editWikiCompanyPhones','companyPhones');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyPhoneController->editWikiCompanyPhone($_POST,$_FILES['companyPhone']);
        }else{
            $fields['wiki_id']=$_GET['id'];
            $companyPhoneController->editWikiCompanyPhoneForm($fields);
        }
        break;
////End Wiki
    default:
        checkPermissions('showList','companyPhones');
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companyPhoneController->showList($fields);
        break;
}
