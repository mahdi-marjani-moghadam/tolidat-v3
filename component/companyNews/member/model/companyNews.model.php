<?php

class c_news extends looeic
{
}


/////////////////////////////////

class c_news_d extends looeic
{

    protected $rules = array(
        'title' => 'required*' . VALIDATE_01,
        'brif_description' => 'required*' . VALIDATE_04
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`news_id` =' . $this->news_id . ' AND `News_d_id` < ' . $this->News_d_id . ' AND `company_id` = ' .  $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }
}

class News extends looeic
{
    protected $TABLE_NAME = 'c_news';
    protected $rules = array();
}
