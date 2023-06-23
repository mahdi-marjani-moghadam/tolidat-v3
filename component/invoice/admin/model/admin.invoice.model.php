<?php

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
class adminInvoiceModel extends looeic
{
    public function news()

    {
        $componenetAdress = ROOT_DIR . "component/news2/model/news2.model.php";
        return $this->belongTo('adminnews2Model', 'company_id', $componenetAdress);
    }

    public static function getComoanyInfo($status)
    {
        $invoice = static::getAll()
            ->leftJoin('company', 'invoice.company_id', '=', 'company.Company_id')
            ->where('invoice.status', '=', $status)
            ->where('company.company_name', '!=', '')
            ->getList();
        return $invoice;
    }
}