<?php

class c_position extends looeic {

    public function updateAll()
    {
        $where = '`parent_id` =' . $this->parent_id . ' AND `Position_id` < ' . $this->Position_id . ' AND `company_id` = ' .  $this->company_id. ' AND `isActive` <> -1' ;
        $fields['isActive'] = 0;
        $result = self::update($fields, $where);
        return $result;
    }
}
