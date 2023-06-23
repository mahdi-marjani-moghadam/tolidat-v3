<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
include_once dirname(__FILE__) . '/model/admin.invoice.controller.php';

global $admin_info, $PARAM;

$invoiceController = new adminInvoiceController();

if (isset($exportType)) {
    $invoiceController->exportType = $exportType;
}
switch ($_GET['action']) {
    case 'editInvoice':
        checkPermissions('editInvoice','invoice');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $invoiceController->editInvoice($_POST);
        } else {
            $input['Invoice_id'] = $_GET['id'];
            $invoiceController->showInvoiceEditForm($input, '');
        }
        break;

    case 'assignInvoice':
        $input['Invoice_id'] = $_GET['id'];
        $invoiceController->invoiceAssignForm($input);
        break;
    case 'showInvoiceErrorForm':
        $invoiceController->showInvoiceErrorForm();
        break;
    case 'showInvoiceSuccessForm':
        $invoiceController->showInvoiceSuccessForm();
        break;

    default:
        checkPermissions('showList','invoice');
        $fields['order']['Invoice_id'] = 'DESC';
        $invoiceController->showList();
        break;
}
