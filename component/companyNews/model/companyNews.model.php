<?php
class c_news_d extends looeic
{
    // protected $TABLE_NAME = 'c_news_d';
    protected $rules = array(
        'title' => 'required',
        'description' => 'required',
    );
}

class News extends looeic
{
    protected $TABLE_NAME = 'c_news';
    protected $rules = array();
}
