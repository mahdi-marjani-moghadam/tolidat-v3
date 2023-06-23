
<?php

class c_addresses_d extends looeic
{
    protected $rules = array(
        'subject' => 'required*'.VALIDATE_01
    );

    public function updateAll()
    {
        $where = '`addresses_id` =' . $this->addresses_id . ' AND `Addresses_d_id` < ' . $this->Addresses_d_id .' AND `company_id` = '.  $this->company_id. ' AND `isActive` <> -1 ';
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }
}

class c_addresses extends looeic {


    public function company()
    {
        $componenetAdress = ROOT_DIR."component/news2/model/news2.model.php";
        //return $this->hasOne('c_addresses','company_id',$componenetAdress);
        return $this->belongTo('adminnews2Model','company_id',$componenetAdress);
    }
}
