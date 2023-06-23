<?php


class c_banner extends looeic
{
    
}
class c_banner_d extends looeic
{
    protected  $rules=array(

        'title' => 'required*عنوان وارد نشده است',
        'description' => 'required*توضیحات وارد نشده است',
    );

    public function updateAll()
    {
        $where = '`banner_id` =' . $this->banner_id . ' AND `Banner_d_id` < ' . $this->Banner_d_id .' AND `company_id` = '.  $this->company_id. ' AND `isActive` <> -1 ';
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }
}

    