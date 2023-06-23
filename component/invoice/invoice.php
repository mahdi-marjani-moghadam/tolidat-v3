<?php

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 06-Nov-16
 * Time: 1:51 PM
 */

include_once(dirname(__FILE__) . "/InvoiceController.php");

global $PARAM;

$controller = new InvoiceController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {

    case 'add':
        if (isset($_POST['package_type'])) {
            $controller->add($_POST['package_type']);
            break;
        }
    case 'edit':
        if (isset($PARAM[2])) {
            $controller->edit($PARAM[2]);
            break;
        }
    case 'payment':
        if (isset($PARAM[2])) {
            $controller->payment($PARAM[2]);
            break;
        }
    case 'exportation':
        if (isset($PARAM[2])) {
            $controller->invoiceExportation($PARAM[2]);
            break;
        }
    case 'show':
        $controller->showInvoice($PARAM[2]);
        break;

    default:
        dd('Error: Call incorrect url');
        break;
}
