<?php

class c_socials extends looeic {

}
class social_type extends looeic {

}

/////////////////////////////////

class c_socials_d extends looeic
{
    
    protected $rules = array(
        'social_type_id' => 'required*'.SOCIAL_01,
        'url' => 'required*'.SOCIAL_02,
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`socials_id` =' . $this->socials_id . ' AND `Socials_d_id` < ' . $this->Socials_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
    
}