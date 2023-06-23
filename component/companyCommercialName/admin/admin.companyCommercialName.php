<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 06-Oct-16
 * Time: 11:26 AM
 */

include_once dirname(__FILE__).'/model/admin.companyCommercialName.controller.php';

global $admin_info,$PARAM;
$companyCommercialNameController = new admincompany_commercial_nameController();

if (isset($exportType))
{
    $companyCommercialNameController->exportType = $exportType;
}

switch ($_GET['action'])
{
    case 'addCompanyCommercialName':
        checkPermissions('addCompanyCommercialName','companyCommercialName');
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $companyCommercialNameController->addCompanyCommercialName($_POST,$_FILES['companyCommercialName']);
        }
        else
        {
            $companyCommercialNameController->showCompanyCommercialNameAddForm( $_GET['company_id'], '');
        }
        break;
    case 'editCompanyCommercialName':
        checkPermissions('editCompanyCommercialName','companyCommercialName');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyCommercialNameController->editCompanyCommercialName($_POST,$_FILES['companyCommercialName']);
        }
        else
        {
            $companyCommercialNameController->showCompanyCommercialNameEditForm($_GET['id'], '');
        }
        break;
    case 'deleteCompanyCommercialName':
        checkPermissions('deleteCompanyCommercialName','companyCommercialName');
        $companyCommercialNameController->deleteCompanyCommercialName($_GET['id']);
////Draft
    case 'showDraftCompanyCommercialName':
        checkPermissions('showDraftCompanyCommercialName','companyCommercialName');
        $input['company_id']=$_GET['id'];
        $companyCommercialNameController->showDraftCompanyCommercialName($input['company_id']);
        break;
    case 'editDraftCompanyCommercialName':
        checkPermissions('editDraftCompanyCommercialName','companyCommercialName');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companyCommercialNameController->editDraftCompanyCommercialName($_POST,$_FILES['image']);
        }else{
            $fields['draft_id']=$_GET['id'];
            $companyCommercialNameController->editDraftCompanyCommercialNameForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','companyCommercialName');
        $fields['choose']['company_id'] = $_GET['id'];
        $companyCommercialNameController->showList($fields);
        break;
}
