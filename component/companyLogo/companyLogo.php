<?php


include_once(dirname(__FILE__) . "/model/companyLogo.controller.php");

global $company_info, $PARAM;

$controller = new logoController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    
    case 'add' :
        $_POST['isActive'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['title'] = "logo";
        $_POST['description'] = "loogoo";
        $_POST['image'] = 'logo.jpg';
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            $controller->addLogo($_POST);
        } else {
            $controller->showLogoAddForm($_POST);
        }
        break;

    case 'edit' :
        
        $_POST['logo_d_id'] = $PARAM[2];
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['title'] = "logoooo";
        $_POST['description'] = "loogooooooo";
        $_POST['image'] = 'logo.png';
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (isset($PARAM[2])) {
            if (isset($_POST['action']) && $_POST['action'] == 'edit') {
                $controller->editLogo($_POST);
                die();
            } else {
                $controller->showLogoEditForm($_POST);
              }
        }
        break;

    case 'delete' :
        
        if (isset($PARAM[2])) {
            $controller->deleteLogo($PARAM[2]);
        }
        break;

    case '' :
        $controller->showList();
        die();

}

