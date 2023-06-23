<?php

class adminc_logo_dModel extends looeic
{
    
    protected $rules = array(
        'title' => 'required',
        'description' => 'required',
        'image' => 'required'
    );
    
}