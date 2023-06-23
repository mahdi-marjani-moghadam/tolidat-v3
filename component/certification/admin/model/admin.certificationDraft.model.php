<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 3/6/2015
 * Time: 10:35 AM
 */

include_once(ROOT_DIR . "/common/validators.php");

class adminc_certification_dModel extends looeic
{
    public function getCertification($company_id)
    {
        $sql = "SELECT c_certification_d.*,certification_list.*
                FROM c_certification_d 
                LEFT JOIN  certification_list
                ON certification_list.Certification_list_id = c_certification_d.certification_list_id
                WHERE status='0' AND company_id='". $company_id ."' AND isActive='1'";
        $certification = $this->query($sql);
        return $certification->getList();

    }

}
