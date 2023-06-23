<?php

include_once dirname(__FILE__) . '/model/admin.branch.controller.php';
global $admin_info, $PARAM;

$branch = new branchController();
$branchObject = new branchController();

if (isset($exportType)) {
    $branch->exportType = $exportType;

}

switch ($_GET['action']) {
    case 'addbranch':
        if (isset($_POST['action']) & $_POST['action'] == 'add') {

            $branch->addBranch($_POST);
        } else {
            $input['company_id'] = $_GET['company_id'];


            $branch->showBranchAddForm($input, '');
        }
        break;

    case 'editbranch':

        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $branch->editbranch($_POST);
        } else {
            $input['company_id'] = $_GET['company_id'];
            $input['branch_id'] = $_GET['branch_id'];
            $branch->showBranchEditForm($input, '');
        }
        break;

    case 'deletebranch':
        //checkPermissions('deleteblackWhite','blackWhite');
        $input['branch_id'] = $_GET['branch_id'];
        $input['company_id'] = $_GET['company_id'];
        $branch->deleteBranch($input);
////Draft
    case 'showDraftBranch':
        $input['company_id'] = $_GET['id'];
        $branchObject->showDraftBranch($input['company_id']);
        break;
    case 'editDraftBranch':
        checkPermissions('editDraftCompanyPhones', 'companyPhones');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $branchObject->editDraftBranch($_POST, $_FILES['companyPhone']);
        } else {
            $fields['branch_id'] = $_GET['id'];
            $branchObject->editDraftBranchForm($fields);
        }
        break;
////End Draft
    default:
        //$fields['order']['branch'] = 'DESC';
        $fields['company_id'] = $_GET['company_id'];
        $branch->showList($fields);
        break;
}
