<?php

class adminAdvertiseModel extends looeic
{
    protected $rules = [
        'category_id' => 'required',
        'title' => 'required',
        'image' => 'required',
        'url' => 'required'
    ];
}