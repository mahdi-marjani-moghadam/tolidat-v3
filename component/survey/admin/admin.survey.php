<?php

/**
 * Created by PhpStorm.
 * User: baahdovic
 * Date: 6/14/2022
 * Time: 11:23 AM.
 */
include_once dirname(__FILE__).'/model/admin.survey.controller.php';

global $admin_info,$PARAM;

$companyLogoController = new adminSurveyController();
if (isset($exportType)) {
    $companyLogoController->exportType = $exportType;
}


switch ($_GET['action']) {
    case 'accept':
        $companyLogoController->accept($_GET['id']);
        break;
    case 'delete':
        $companyLogoController->delete($_GET['id']);
        break;

    default:
        $companyLogoController->showList();
        break;

}
