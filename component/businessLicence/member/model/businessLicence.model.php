<?php

class c_business_licence extends looeic {

}

////////////////////////////////////////

class c_business_licence_d extends looeic
{
    
    protected $rules = [
        'title' => 'required*'.VALIDATE_01
    ];


    public function updateAll()
    {
        $where = '`business_licence_id` =' . $this->business_licence_id . ' AND `Business_licence_d_id` < ' . $this->Business_licence_d_id . ' AND `company_id` = ' .  $this->company_id. ' AND `isActive` <> -1' ;
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }
}
