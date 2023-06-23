<?php

class c_commercial_name extends looeic
{

}

class c_commercial_name_d extends looeic
{
    protected  $rules=array(
        'title' => 'required*' . VALIDATE_01
    );



    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`commercial_name_id` =' . $this->commercial_name_id . ' AND `Commercial_name_d_id` < ' . $this->Commercial_name_d_id .' AND `company_id` = '.  $this->company_id. ' AND `isActive` <> -1 ';
        $result = self::update($fields, $where);
        return $result;
    }
}
