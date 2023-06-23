<?php

class c_certification_d extends looeic
{

    protected $rules = array(
        'title' => 'required',
        'description' => 'required',
        'image' => 'required'
    );

}

class Certification extends looeic
{
    protected $TABLE_NAME = 'c_certification';
}