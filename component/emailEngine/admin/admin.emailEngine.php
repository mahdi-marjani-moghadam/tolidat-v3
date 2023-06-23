<?php

require_once "Controllers/EmailEngineController.php";
require_once ROOT_DIR . "component/company/admin/model/admin.company.controller.php";
include_once ROOT_DIR . "services/compareRealWithDraftCompany/Compare.php";

$company = new adminCompanyController();

$companyList = $company->getData(1);
//dd($companyList);
$path = ROOT_DIR . 'templates/admin/compareCompanyEmailTemplate.php';
include $path;
die();
$contacts = [
    'email' => 'fardin.saadati90@gmail.com',
    'subject' => 'This is the Subject',
    'body' => ['path' => $path, 'data' => compact('companyList')],
];


// $path = ROOT_DIR . 'templates/template_fa/resetPassword.php';
// $link = RELA_DIR . 'getNewPassword/' . uniqid();
//
// $contacts = [
//     'email' => 'arash.nykbakht@gmail.com',
//     'subject' => 'لینک رمزعبور جدید',
//     'body' => ['path' => $path, 'data' => compact('link')],
// ];

if ($result = EmailEngineController::forceSend($contacts)) {
    echo "success";
} else {
    echo 'Failed to Send Email <br>' . $result;
}

//
//$result = EmailEngineController::sendToAll();
//
//if ($result == 1) {
//    echo "success";
//} else {
//    echo "<pre>";
//    print_r_debug($result['error']);
//    echo "</pre>";
//}
