<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 06-Nov-16
 * Time: 1:50 PM
 */
class memberonlinepaymentModel extends looeic
{
    protected $TABLE_NAME='online_payment';

    public function addInvoiceToOnlinePayment($invoice)
    {
        $fields['invoice_id'] = $invoice->Invoice_id;
        $fields['price'] = $invoice->total_price;
        $fields['status'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $invoice->company_id;
        $fields['RefNum'] = '';
        $fields['ResNum'] = '';
        $fields['TRACENO'] = '';
        $fields['RRN'] = '';
        $fields['MID'] = '';
        $fields['SecurePan'] = '';

        $this->setFields($fields);
        return $this->save();
    }

    public function updateTokenOnlinePayment($token)
    {
        $this->token = $token;
        return $this->save();
    }
    
}
