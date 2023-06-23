<?php
/**
 * Created by PhpStorm.
 * User: vahed
 * Date: 4/15/2017
 * Time: 10:35 AM.
 */
include_once ROOT_DIR . '/common/validators.php';

class adminc_licencesModel extends looeic
{
    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`parent_id` =' . $this->parent_id . ' AND `Licence_id` < ' . $this->Licence_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        self::update($fields, $where);
        $fields['status'] = 1;
        $where = '`parent_id` =' . $this->parent_id . ' AND `Licence_id` < ' . $this->Licence_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1 AND `status` = 2';
        self::update($fields, $where);
        return;
    }
}

class adminlicence_listModel extends looeic
{

}
