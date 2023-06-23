<?php
include_once dirname(__FILE__) . '/model/admin.discountCode.controller.php';

global $admin_info, $PARAM;

$discountController = new adminDiscountCodeController();
if (isset($exportType)) {
    $discountController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'addDiscountCode':

        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $discountController->addDiscountCode($_POST);
        } else {
            $discountController->showDiscountCodeAddForm('', '');
        }
        break;

    case 'deleteDiscountCode' :
        $discountController->deleteDiscountCode($_GET['id']);
        break;

    case 'companyList' :
        $discountController->getCompanyListUseDiscount();
        break;

    default:
        $discountController->showList($fields);
        break;
}
