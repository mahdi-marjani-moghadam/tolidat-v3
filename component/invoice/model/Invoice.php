<?php

class invoice extends looeic
{
    public function getInvoice($invoice_id)
    {
        $sql = "SELECT *
                FROM invoice
                LEFT JOIN  package
                ON invoice.package_id = package.Package_id
                WHERE invoice.Invoice_id =" . $invoice_id;
        $invoice = $this->query($sql);
        return $invoice->getList();
    }

    public function invoiceExist($company_id)
    {
        $invoice = invoice::getAll()->where('company_id', '=', $company_id)
            ->where('status', '=', 0)->first();

        if (is_object($invoice)) {
            return $invoice;
        }

        return false;
    }

    public function checkInvoice($invoice_id, $company_id)
    {
        $invoice = invoice::getAll()
            ->where('Invoice_id', '=', $invoice_id)
            ->where('company_id', '=', $company_id)
            ->where('status', '=', 0)->first();

        if (is_object($invoice)) {
            return $invoice;
        }

        return false;
    }

    public function payment()
    {
        $this->status = 5;
        return $this->save();
    }

    public function exportation($package, $price, $company_id, $type)
    {
        $this->company_id = $company_id;
        $this->package_id = $package->Package_id;
        $this->price = $price;
        $this->total_price = $price;
        $this->status = 0;
        $this->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $this->discount_code_id = 0;
        $this->percent = 0;
        $this->invoice_detail = serialize($package->fields);
        $this->type = $type;
        $result = $this->save();

        if ($result['result'] == 1) {
            return $this;
        }

        return null;
    }

    /**
     * @param $invoice
     * @param $discount
     * @return array
     */
    public function applyDiscountOnInvoice($discount)
    {
        $total_price = floor($this->price - (($discount->percent * $this->price) / 100));
        if ($total_price < 0) {
            $total_price = 0;
        }
        $this->total_price = $total_price;
        $this->percent = $discount->percent;
        $this->discount_code_id = $discount->Discount_code_id;
        $result = $this->save();

        if ($result['result'] != 1) {
            $result = [
                'result' => -1,
                'msg' => 'اعمال کد تخفیف با مشکل مواجه شد لطفا دوباره تلاش کنید'
            ];
            return $result;
        }

        return $this;
    }
}
