<?php
include_once dirname(__FILE__) . '/province.model.php';

class provinceController
{
    public static function getProvince()
    {
        $province = province::getAll()->getList();
        return $province['export']['list'];
    }

    public static function find($province_id)
    {
        return province::find($province_id);
    }
}
