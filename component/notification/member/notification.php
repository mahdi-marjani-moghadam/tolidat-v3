<?php

include_once(dirname(__FILE__) . "/model/notification.controller.php");

global $PARAM;

$notificationController = new notificationController();

if (isset($exportType)) {
    $notificationController->exportType = $exportType;
}

if ($PARAM['0'] == 'notification') {

    switch ($PARAM['1']) {

        case "delete" :
            $notificationController->deleteNotification($_POST['id']);
            break;
    }
}

