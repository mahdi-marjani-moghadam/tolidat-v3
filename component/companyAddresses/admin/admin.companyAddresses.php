<?php

include_once dirname(__FILE__) . '/model/admin.companyAddresses.controller.php';

global $admin_info, $PARAM;

$companyAddressController = new admincompany_addressesController();
if (isset($exportType)) {
    $companyPhoneController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companyAddressController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanyAddresses', 'companyAddresses');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyAddressController->add($_POST, $_FILES['companyAddress']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyAddressController->showCompanyAddressAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanyAddresses', 'companyAddresses');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyAddressController->edit($_POST, $_FILES['companyAddress']);
        } else {
            $fields['Addresses_id'] = $_GET['id'];
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $companyAddressController->showCompanyAddressEditForm($fields, '');
        }
        break;
    case 'deleteCompanyAddress':
        checkPermissions('deleteCompanyAddresses', 'companyAddresses');
        $fields['Addresses_id'] = $_GET['id'];
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companyAddressController->delete($fields);
        break;

////Wiki
    case 'showWikiCompanyAddress':
        //checkPermissions('showWikiCompanyPhones','companyPhones');
        $input['company_id'] = $_GET['id'];
        $companyAddressController->showWikiCompanyAddress($input['company_id']);
        break;
    case 'editWikiCompanyAddress':
        //checkPermissions('editWikiCompanyPhones','companyPhones');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyAddressController->editWikiCompanyAddress($_POST, $_FILES['companyAddress']);
        } else {
            $fields['wiki_id'] = $_GET['id'];
            $companyAddressController->editWikiCompanyAddressForm($fields);
        }
        break;
////End Wiki

////Draft
    case 'showDraftCompanyAddress':
        checkPermissions('showDraftCompanyAddress', 'companyAddresses');
        $input['company_id'] = $_GET['id'];
        $companyAddressController->showDraftCompanyAddress($input['company_id']);
        break;
    case 'editDraftCompanyAddress':

        checkPermissions('editDraftCompanyAddress', 'companyAddresses');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyAddressController->editDraftCompanyAddress($_POST, $_FILES['companyAddress']);
        } else {
            $fields['draft_id'] = $_GET['id'];
            $companyAddressController->editDraftCompanyAddressForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList', 'companyAddresses');
        $fields['Addresses_id'] = $_GET['id'];
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companyAddressController->showList($fields);
        break;
}
