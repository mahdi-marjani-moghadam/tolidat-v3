<?php
include_once dirname(__FILE__) . '/personalityType.model.php';

class personalityTypeController
{
    public static function getPersonalityType()
    {
        return personality_type::getAll()->getList();
    }

    public static function find($personality_type_id) {
        return personality_type::find($personality_type_id);
    }
}
