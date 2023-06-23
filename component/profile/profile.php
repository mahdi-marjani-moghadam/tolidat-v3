<?php

include_once(dirname(__FILE__) . "/model/profile.controller.php");

global $admin_info, $PARAM;

$profileController = new profileController();

if (isset($exportType)) {
    $profileController->exportType = $exportType;
}

if ($PARAM['0'] == 'profile') {
    switch ($PARAM['1']) {

        case "notification" :
            if ($PARAM['2'] != '') {
                $profileController->readNotification($PARAM['2']);
            } else {
                $profileController->getAllNotification();
            }
            break;
        case "edit" :
            /*ini_set('upload_max_filesize', '20M');
            ini_set('post_max_size', '20M');
            ini_set('max_input_time', '300');
            ini_set('max_execution_time', '300');*/
            if (!empty($_POST)) {
                $_POST['catalog'] = $_FILES['catalog'];
                $profileController->editPrimaryInformation($_POST);
            } else {
                $profileController->showEditFormPrimaryInformation();
            }
            break;

        case 'editPassword':
            if (!empty($_POST)) {
                $profileController->editPassword($_POST);
                break;
            }
            $profileController->showEditFormPassword();
            break;

        case 'successPayment' :
            $profileController->showSuccessTemplate();
            break;
        default :
        
            $profileController->showProfileForm();
            break;
        
    }
}
