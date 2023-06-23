<?php

class survey extends looeic
{

    protected $rules = array(
        'user_email' => 'required',
        'user_name' => 'required',
        'comment' => 'required',
        'type' => 'required',
        'type_id' => 'required'
    );

}
