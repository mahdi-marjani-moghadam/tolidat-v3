<?php
include_once ROOT_DIR . 'component/discountCode/model/DiscountCode.php';
include_once ROOT_DIR . 'component/invoice/model/Invoice.php';

class DiscountCodeController
{
    private $company_info;

    /**
     * discountCodeController constructor.
     * @param $company_info
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
    }

    /**
     * @param $discount_code
     */
    public function applyDiscount($discount_code)
    {
        $invoiceModel = new invoice();
        $discountCodeModel = new DiscountCode();

        $invoice = $invoiceModel->invoiceExist($this->company_info['company_id']);

        if (!is_object($invoice)) {
            $result = [
                'result' => -1,
                'msg' => 'فاکتوری با این مشخصات وجود ندارد'
            ];
            echo  json_encode($result);
            die();
        }

        $result = $discountCodeModel->applyDiscount($invoice, $discount_code);

        echo  json_encode($result);
        die();
    }
}
