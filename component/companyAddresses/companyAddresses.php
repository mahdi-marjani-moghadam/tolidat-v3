<?php
include_once(dirname(__FILE__) . "/model/companyAddresses.controller.php");

global $company_info, $PARAM;

$controller = new addressController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    
    case 'add' :
        
        $_POST['isActive'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['subject'] = "Address";
        $_POST['address'] = "Daba";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (isset($_POST['action']) && $_POST['action'] == 'add') {

            $controller->addAddress($_POST);
        } else {
            $controller->showAddressAddForm($_POST);
        }
        break;

    case 'edit' :
        
        $_POST['addresses_d_id'] = $PARAM[2];
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['subject'] = "hiiss";
        $_POST['address'] = "Eroup";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($PARAM[2])) {
            if (isset($_POST['action']) && $_POST['action'] == 'edit') {
                $controller->editAddress($_POST);
            } else {
                $controller->showAddressEditForm($_POST);
            }
        }
        break;

    case 'delete' :
        
        if (isset($PARAM[2])) {
            $controller->deleteAddress($PARAM[2]);
        }
        break;
    case 'import' :

        include_once(dirname(__FILE__) . "/model/importExcel.php");

        break;
    case '' :
        $controller->showList();
        die();

}

