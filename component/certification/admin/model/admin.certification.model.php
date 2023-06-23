<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM
 */

include_once(ROOT_DIR . "/common/validators.php");

class adminc_certificationModel extends looeic
{
    public function getCertification($company_id)
    {
        $sql = "SELECT *
                FROM c_certification 
                LEFT JOIN  certification_list
                ON certification_list.Certification_list_id = c_certification.certification_list_id
                WHERE c_certification.company_id =" . $company_id;
        $certification = $this->query($sql);
        return $certification->getList();

    }
}
