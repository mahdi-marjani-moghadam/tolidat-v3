<?php


class c_emails extends  looeic
{

}

class c_emails_d extends looeic
{
    protected  $rules=array(
        'subject' => 'required*'.VALIDATE_01,
        'email' => 'valid_email*'.REGISTER_06
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`emails_id` =' . $this->emails_id . ' AND `Emails_d_id` < ' . $this->Emails_d_id .' AND `company_id` = '.  $this->company_id. ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }

}
