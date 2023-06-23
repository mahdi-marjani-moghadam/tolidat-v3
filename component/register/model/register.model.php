<?php

class company_d extends looeic
{


//    protected $GUARDED = array(
//        'national_id',
//        'registration_number',
//        'company_id',
//    );

    public function noGuarded()
    {
        $this->GUARDED = array();
    }

    public function updateAll()
    {
        $where = '`company_id` =' . $this->company_id . ' AND `Company_d_id` < ' . $this->Company_d_id . ' AND `isActive` <> -1';
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }

}
