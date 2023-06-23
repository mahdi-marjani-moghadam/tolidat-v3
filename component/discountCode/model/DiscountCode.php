<?php

class DiscountCode extends looeic
{
    protected $TABLE_NAME = "discount_code";

    public function disableDiscountCode($discount_code_id)
    {
        $discount_code = DiscountCode::find($discount_code_id);
        if (is_object($discount_code)) {
            if ($discount_code->type == 1) {
                $discount_code->status = 1;
                $discount_code->save();
            }
        }

        return;
    }

    /**
     * @param $discount_code
     */
    public function applyDiscount($invoice, $discount_code)
    {
        $discount = $this->checkCode($invoice, $discount_code);

        if (!is_object($discount)) {
            return $discount;
        }

        $result = $invoice->applyDiscountOnInvoice($discount);

        if (!is_object($result)) {
            return $result;
        }

        $result = [
            'result' => '1',
            'percent' => $result->percent,
            'total_price' => number_format($result->total_price)
        ];

        return $result;
    }

    public static function checkCode($invoice, $code)
    {
        $discount_code = DiscountCode::getAll()->where('code', '=', $code)->first();
        if (!is_object($discount_code)) {
            $result = [
                'result' => -1,
                'msg' => 'کد تخفیف اشتباه است'
            ];
            return $result;
        }

        if ($discount_code->status == 1) {
            $result = [
                'result' => -1,
                'msg' => 'کد تخفیف قبلا استفاده شده است'
            ];
            return $result;
        }

        $today_date = strftime('%Y-%m-%d', time());
        if ($today_date < $discount_code->start_date || $today_date > $discount_code->expire_date) {
            $result = [
                'result' => -1,
                'msg' => 'تاریخ انقضا کد تخفیف تمام شده است'
            ];
            return $result;
        }

        if ($discount_code->package_id != 0 & $invoice->package_id != $discount_code->package_id) {
            $result = [
                'result' => -1,
                'msg' => 'این کد تخفیف برای این پکیج تعریف نشده است'
            ];
            return $result;
        }

        return $discount_code;
    }
}
