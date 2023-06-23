<?php

class c_phones_d extends looeic
{
    protected $rules = array(
        'subject' => 'required*'.VALIDATE_01,
        'number' => 'required*'.PHONE_01 .'|numeric*' . PHONE_04,
        'code' => 'required*'.PHONE_07 .'|numeric*' . PHONE_08,
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`phones_id` =' . $this->phones_id . ' AND `Phones_d_id` < ' . $this->Phones_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
}

class c_phones extends looeic
{

}
