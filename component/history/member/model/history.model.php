<?php

class c_history extends looeic {

}

/////////////////////////////////

class c_history_d extends looeic
{
    
    protected $rules = array(
        'title' => 'required*'.VALIDATE_01
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`history_id` =' . $this->history_id . ' AND `History_d_id` < ' . $this->History_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
    
}
