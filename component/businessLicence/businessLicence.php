<?php
include_once(dirname(__FILE__) . "/model/businessLicence.controller.php");

global $company_info, $PARAM;

$controller = new businesslicenceController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    
    case 'add' :
        $_POST['isActive'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['title'] = "Eroup";
        $_POST['description'] = "best business licence";
        $_POST['image'] = "licen.jpg";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $controller->addBusinessLicence($_POST);
        } else {
            $controller->showBusinessLicenceAddForm($_POST);
        }
        break;

    case 'edit' :
        
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['Business_licence_d_id'] = $PARAM[2];
        $_POST['title'] = "Iran";
        $_POST['description'] = "very good business licence";
        $_POST['image'] = "licen.png";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($PARAM[2])) {
            if (isset($_POST['action']) && $_POST['action'] == 'edit') {
                $controller->editBusinessLicence($_POST);
            } else {
                $controller->showBusinessLicenceEditForm($_POST);
            }
        }
        break;

    case 'delete' :
        
        if (isset($PARAM[2])) {
            $controller->deleteBusinessLicence($PARAM[2]);
        }
        break;

    case '' :
        $controller->showList();
        die();

}

