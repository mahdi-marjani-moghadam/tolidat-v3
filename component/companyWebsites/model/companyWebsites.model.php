<?php

class c_websites_d extends looeic
{
    protected $rules = array(
        'subject' => 'required*'.VALIDATE_01.'|max_len,255*'.VALIDATE_03,
        'url' => 'required*'.VALIDATE_01,
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`websites_id` =' . $this->websites_id . ' AND `Websites_d_id` < ' . $this->Websites_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
}

class c_websites extends looeic {

}
