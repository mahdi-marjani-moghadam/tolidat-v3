<?php

class certification_list extends looeic
{


}

///////////////////////////////

class c_certification extends looeic
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

///////////////////////////////

class c_certification_d extends looeic
{

    public function updateAll()
    {
        $where = '`certification_id` =' . $this->certification_id . ' AND `Certification_d_id` < ' . $this->Certification_d_id . ' AND `isActive` <> -1';
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }

    public function certifications()
    {
        return $this->hasMany('certification_list', 'certification_list_id');
    }


    public function getCertification($company_id)
    {
        $sql = "SELECT *
                FROM c_certification_d 
                LEFT JOIN  certification_list
                ON certification_list.Certification_list_id = c_certification_d.certification_list_id
                WHERE c_certification_d.isActive = 1 AND c_certification_d.company_id =" . $company_id;
        $certification = $this->query($sql);

        return $certification->getList();
    }

    public function getCertificationById($company_id, $certification_d_id)
    {
        $sql = "SELECT *
                FROM c_certification_d 
                LEFT JOIN  certification_list
                ON certification_list.Certification_list_id = c_certification_d.certification_list_id
                WHERE c_certification_d.isActive = 1 AND c_certification_d.company_id =" . $company_id . " AND Certification_d_id =" . $certification_d_id;
        $certification = $this->query($sql);

        return $certification->getList()['export']['list']['0'];
    }

}
