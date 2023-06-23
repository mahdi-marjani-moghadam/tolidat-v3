<?php

class c_honour extends looeic
{

}

class c_honour_d extends looeic
{
    protected $rules = array(
        'title' => 'required*' . VALIDATE_01
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`honour_id`=' . $this->honour_id . ' AND `Honour_d_id` < ' . $this->Honour_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;

    }
}
