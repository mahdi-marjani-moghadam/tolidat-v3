<?php
include_once(dirname(__FILE__) . "/model/admin.companyPosition.controller.php");

$controllerPosition = new positionController();

if (isset($exportType)) {
    $controllerPosition->exportType = $exportType;
}

switch ($_GET['action']) {

    case 'add':
        checkPermissions('addCompany', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $controllerPosition->addPosition($_POST, $_FILES['companyLicence']);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $controllerPosition->showPositionAddForm($fields);

        }
        break;

    case 'edit' :
        checkPermissions('editCompanyAddresses', 'companyAddresses');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $controllerPosition->showList($fields);
        } else {

            $fields['company_id'] = $_GET['company_id'];
            $fields['branch_id'] = $_GET['branch_id'];
            $controllerPosition->editPosition($_POST);
        }


        break;
    default:
        //checkPermissions('showList','companyPositions');
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $controllerPosition->showList($fields);
        break;

}

