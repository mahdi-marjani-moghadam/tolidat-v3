<?php
include_once(dirname(__FILE__) . "/model/invoice.controller.php");

global $PARAM;

$controller = new MemberInvoiceController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {
    case 'payment' :
        if (isset($PARAM[2])) {
            $controller->payment($PARAM[2]);
            break;
        }
    case 'invoices' :
            $controller->showCompanyInvoices();
            break;
    case 'exportation' :
        $controller->invoiceExportation($_POST['package_type']);
            break;

    case 'show':
        $controller->showInvoice($PARAM[2]);
        break;

}

