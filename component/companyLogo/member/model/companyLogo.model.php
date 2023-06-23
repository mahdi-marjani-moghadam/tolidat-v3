<?php

class c_logo extends looeic {

}

/////////////////////////////////

class c_logo_d extends looeic
{
    
    protected $rules = array(
        'image' => 'max_len,100*'.VALIDATE_02
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`logo_id` =' . $this->logo_id . ' AND `Logo_d_id` < ' . $this->Logo_d_id .' AND `company_id` = '.  $this->company_id. ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
    
}