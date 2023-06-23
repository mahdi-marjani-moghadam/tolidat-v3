<?php

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
class adminonline_paymentModel extends looeic
{

    protected $TABLE_NAME = "invoice";

    public function getQuery()
    {
        $query = "SELECT `online_payment`.*,company.company_name
                      FROM `online_payment`
                        LEFT JOIN `company` ON `online_payment`.`company_id` =`company`.`company_id` 
                        
                        GROUP BY `online_payment`.`Company_id`";


        return $query;
    }

}