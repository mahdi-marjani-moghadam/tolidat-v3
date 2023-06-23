<?php
include_once(dirname(__FILE__) . "/model/companyWebsites.controller.php");

global $company_info, $PARAM;

$controller = new websiteController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    
    case 'add' :
        
        $_POST['isActive'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['subject'] = "Site";
        $_POST['url'] = "Daba.com";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $controller->addWebsite($_POST);
        } else {
            $controller->showWebsiteAddForm($_POST);
        }
        break;

    case 'edit' :
        
        $_POST['websites_d_id'] = $PARAM[2];
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['subject'] = "site";
        $_POST['url'] = "daba.ir";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($PARAM[2])) {
            if (isset($_POST['action']) && $_POST['action'] == 'edit') {
                $controller->editWebsite($_POST);
            } else {
                $controller->showWebsiteEditForm($_POST);
            }
        }
        break;

    case 'delete' :
        
        if (isset($PARAM[2])) {
            $controller->deleteWebsite($PARAM[2]);
        }
        break;

    case '' :
        $controller->showList();
        die();

}

