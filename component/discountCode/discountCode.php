<?php
include_once ROOT_DIR . "component/discountCode/DiscountCodeController.php";

global $PARAM;

$controller = new DiscountCodeController();

if (isset($exportType)) {
    $controller->exportType = $exportType;
}

switch ($PARAM[1]) {

    case 'discount' :
        if (isset($_POST)) {
            $controller->applyDiscount($_POST['discount_code']);
            break;
        }
}

