<?php

class c_advertise extends looeic
{
    protected $TABLE_NAME = 'c_advertise';

    protected $rules = array(
        'title' => 'required*' . VALIDATE_01,
        'startDate' => 'required*' . PACKAGE_09,
        'description' => 'required*' . VALIDATE_04,
        'expireDate' => 'required*' . PACKAGE_10,
       );
    public function updateAll()
    {
        $fields['isActive'] = 0;
        $fields['status'] = 1;
        $where = '`parent_id` =' . $this->parent_id . ' AND `Advertise_id` < ' . $this->Advertise_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
}
