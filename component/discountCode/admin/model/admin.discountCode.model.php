<?php

class adminDiscountCodeModel extends looeic {
    protected $TABLE_NAME = "discount_code";
    const PRECODE_01 = "فیلد پیشوند ضروری است";
    const PRECODE_02 = "فیلد پیشوند باید ";

    protected $rules = [
        'precode' => 'require*'
    ];
}
