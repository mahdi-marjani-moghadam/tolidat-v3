<?php

class c_licences extends looeic
{
    protected $rules = array(
        'name' => 'required*' . LICENCE_04,
        'family' => 'required*' . LICENCE_05,
        'national_code' => 'required*' . LICENCE_06 . '|numeric*' . LICENCE_13 . '|min_len,10*' . LICENCE_14 . '|max_len,10*' . LICENCE_14,
        'licence_number' => 'required*' . LICENCE_01 . '|numeric*' . LICENCE_15,
        'licence_type' => 'required*' . LICENCE_03,
        'issuence_date' => 'required*' . LICENCE_16,
        'expiration_date' => 'required*' . LICENCE_17,
        'exporter_refrence' => 'required*' . LICENCE_12,
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`parent_id` =' . $this->parent_id . ' AND `Licence_id` < ' . $this->Licence_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }

    public function getLicenceByCompanyId($company_id, $isMain = 1)
    {
        $c_licences = c_licences::getAll()
            ->select('c_licences.*', 'licence_list.name as licence_name')
            ->leftJoin('licence_list', 'c_licences.licence_type', '=', 'licence_list.Licence_list_id')
            ->where('c_licences.company_id', '=', $company_id)
            ->where('c_licences.status', '=', 2);

        if ($isMain == 1) {
            $c_licences->where('c_licences.isMain', '=', 1);
        }
            return $c_licences->getList();
    }
}

/////////////////////////////////

class c_licences_d extends looeic
{

}

class licence_list extends looeic
{

}
