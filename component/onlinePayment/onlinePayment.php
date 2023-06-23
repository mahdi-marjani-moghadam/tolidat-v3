<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 06-Nov-16
 * Time: 1:51 PM
 */
include_once(dirname(__FILE__) . "/model/member.onlinePayment.controller.php");

global $PARAM;

$controller = new onlinePaymentController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($PARAM[1]) {
    case 'returnbank':
        $controller->returnBank($_POST);
        break;
}










//
//
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//echo '<pre/>';
//$merchantID = "10370175";
//$merchantPass = "5128755";
//$amount=1000;
//
//$uniqueID=rand(100000,100);
//$context = stream_context_create([
//    'ssl' => [
//        // set some SSL/TLS specific options
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    ]
//]);
//
//$soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL', array('stream_context' => $context));
//
//$tokenResult =  $soapClient->RequestToken("$merchantID","$uniqueID","$amount");
//
//
//print_r_debug($tokenResult);
//
//
//
//
//
////echo file_get_contents('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',$arrContextOptions);
//
///*$client = new SoapClient(
//    "https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',$arrContextOptions");
//print_r($client);
//$fcs = $client->__getFunctions();
//var_dump($fcs);
////echo $client->Hello("Hello from client.");
//die();*/
//
//
////********************sample 1***************
//
///*include(ROOT_DIR."common/payLib/nusoap.php");
//$client = new nusoap_client('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL', true);
////$namespace='http://interfaces.core.sw.bps.com/';
//$str = NULL;
//$err = $client->getError();
//
//$localDate = date('Ymd');
//$localTime = date('His');
//$parameters = array(
//    'TermID' => $merchantID,
//    'ResNum' => $uniqueID,
//    'TotalAmount' => 30000,
//    );
//
////print_r($client);
//$resultStr = $client->call('RequestToken', $parameters);
//print_r_debug($resultStr);*/
//
////********************sample 1***************
//
//
////********************sample 2***************
//
//$context = stream_context_create([
//    'ssl' => [
//        // set some SSL/TLS specific options
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    ]
//]);
//
///*$client  = new SoapClient(null, [
//    'location' => 'https://...',
//    'uri' => '...',
//    'stream_context' => $context
//]);*/
//
////$sslContext = stream_context_create($contextOptions);
//
//$soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL', array('stream_context' => $context));
//$tokenResult =  $soapClient->RequestToken("$merchantID","$uniqueID","$amount");
//$fcs = $soapClient->__getFunctions();
//var_dump($fcs);
//
//print_r_debug($tokenResult);
//
//$fcs = $soapClient->__getFunctions();
//
//
//$soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',array(
//    'stream_context' => $sslContext,));
//$tokenResult =  $soapClient->RequestToken("$merchantID","$uniqueID","$amount");
//
//
//$fcs = $soapClient->__getFunctions();
//var_dump($fcs);
//
//
////echo file_get_contents('https://www.sep.shaparak.ir/Payments/InitPayment.asmx?WSDL');
////die();
////array('trace'=> true,'exceptions' => true);
//
////print_r_debug($soapClient);
//
//$tokenResult =  $soapClient->RequestToken("$merchantID","$uniqueID","$amount",array('trace'=> true,'exceptions' => true));
//
//print_r_debug($tokenResult);
//die();
//
////********************sample 2***************
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//global $lang,$conn;
//echo '<pre/>';
//$merchantID = "10370175";
//$merchantPass = "5128755";
//$amount=1000;
//$uniqueID=rand(100000,100);
//
//$soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL');
//print_r_debug($soapClient);
//
//
//
//
//
//
////********************sample 1***************
//
///*include(ROOT_DIR."common/payLib/nusoap.php");
//$client = new nusoap_client('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL',true);
////$namespace='http://interfaces.core.sw.bps.com/';
//$str = NULL;
//$err = $client->getError();
//
//$localDate = date('Ymd');
//$localTime = date('His');
//$parameters = array(
//    'TermID' => $merchantID,
//    'ResNum' => $uniqueID,
//    'TotalAmount' => 30000,
//    );
//
//print_r($client);
//$resultStr = $client->call('RequestToken', $parameters);
//print_r_debug($resultStr);*/
//
////********************sample 1***************
//
//
////********************sample 2***************
//
//
//$soapClient = new SoapClient('https://sep.shaparak.ir/Payments/InitPayment.asmx?WSDL');
////echo file_get_contents('https://www.sep.shaparak.ir/Payments/InitPayment.asmx?WSDL');
////die();
////array('trace'=> true,'exceptions' => true);
//
////print_r_debug($soapClient);
//
//$tokenResult =  $soapClient->RequestToken("$merchantID","$uniqueID","$amount",array('trace'=> true,'exceptions' => true));
//
//print_r_debug($tokenResult);
//die();
//
////********************sample 2***************
//
//
//
//
//
//
//
//
//
//
//if( in_array($tokenResult,array_keys($this->errorVerify)) )
//{
//    $result['msg'] = $tokenResult;
//    $result['result'] = -1 ;
//    $result['no'] = $tokenResult;
//    print_r_debug($result);
//    return $result;
//}
//
//$result['result'] = 1 ;
//$result['tokenResult'] = $tokenResult;
//print_r_debug($result);
//
//return $result;
//
//
//die("hamid vahed");
//include_once(dirname(__FILE__) . "/model/invoice.controller.php");
//
//global $PARAM;
//
//$controller = new invoiceController();
//
//if (isset($exportType)) {
//    $controller->exportType = $exportType;
//}
//switch ($PARAM[1]) {
//
//    case 'add' :
//
//        if (isset($PARAM[2])) {
//            $controller->invoiceExportation($PARAM[2]);
//            break;
//        }
//
//    case 'edit' :
//        if (isset($PARAM[2])) {
//            $controller->edit($PARAM[2]);
//            break;
//        }
//    case 'delete' :
//        if (isset($PARAM[2])) {
//            $controller->deleteInvoice($PARAM[2]);
//            break;
//        }
//    case 'payment' :
//        if (isset($PARAM[2])) {
//            $controller->payment($PARAM[2]);
//            break;
//        }
//
//}
//
