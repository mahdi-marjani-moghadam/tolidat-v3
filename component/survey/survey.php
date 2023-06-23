<?php


include_once(dirname(__FILE__) . "/model/survey.controller.php");

global  $PARAM;

$controller = new surveyController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {

    case 'all':
        $controller->showAll($PARAM['2']);
        break;

    case 'add' :
        $result = $controller->add($_POST);

        echo json_encode($result);
        die();
        break;

    case 'likeOrDislike' :

       $controller->likeOrDislike($_POST['id'],$_POST['status']);

        break;




}

