<?php

class c_contacts extends looeic
{
    protected $rules = array(
        'name' => 'required*فیلد نام ضروری است',
        'email' => 'required*فیلد ایمیل ضروری است|valid_email*ایمیل به درستی وارد نشده است',
        'subject' => 'required*فیلد موضوع ضروری است',
        'message' => 'required*فیلد پیام ضروری است'
    );
}
