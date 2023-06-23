<?php
class c_branch extends looeic{
    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`parent_id`=' . $this->parent_id . ' AND `Branch_id` < ' . $this->Branch_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;

    }
}