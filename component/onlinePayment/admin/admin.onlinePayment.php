<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/model/admin.onlinePayment.controller.php';

global $admin_info, $PARAM;

$onlinePaymentController = new adminOnlinePaymentController();

if (isset($exportType)) {
    $onlinePaymentController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'editInvoice':
        checkPermissions('editInvoice','invoice');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $onlinePaymentController->editInvoice($_POST);
        } else {
            $input['Invoice_id'] = $_GET['id'];
            $onlinePaymentController->showInvoiceEditForm($input, '');
        }
        break;

    case 'assignInvoice':
        $input['Invoice_id'] = $_GET['id'];
        $onlinePaymentController->invoiceAssignForm($input);
        break;
    case 'invoiceError':
        $input['Invoice_id'] = $_GET['id'];
        $onlinePaymentController->showInvoiceErrorForm($input);
        break; 
    case 'showAllPay':
        $input['Invoice_id'] = $_GET['id'];
        $onlinePaymentController->showAllPay($input);
        break;
    case 'searchAllPay':
        $onlinePaymentController->searchAllPay($_GET);
        break;
    case 'invoiceSuccess':
        $input['Invoice_id'] = $_GET['id'];
        $onlinePaymentController->showInvoiceSuccessForm($input);
        break;

    default:
        checkPermissions('showList','invoice');
        $fields['order']['Invoice_id'] = 'DESC';
        $onlinePaymentController->showAllPay();
        break;
}
