<?php


class Employment extends looeic
{
    protected $TABLE_NAME = 'c_employment';

    protected $rules = array(
        'title' => 'required*' . VALIDATE_01,
        'startDate' => 'required*' . PACKAGE_09,
        'description' => 'required*' . VALIDATE_04,
        'expireDate' => 'required*' . PACKAGE_10,
        'code' => 'required*' . PHONE_07 . '|numeric*' . PHONE_08,
        'contactPhone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_10 . '|min_len,5*' . PHONE_11,
        'contactEmail' => 'required*' . MEMBER_03 . '|valid_email*' . REGISTER_06,
    );

    public function getAllEmployment()
    {
        $employments = $this
            ->select('*')
            ->leftJoin('graduate', 'graduate.Graduate_id', '=', 'c_employment.graduate_id')
            ->getList();

        if ($employments['result'] != -1) {
            return $employments['export']['list'];
        } else {
            return -1;
        }
    }

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $fields['status'] = 1;
        $where = '`parent_id` =' . $this->parent_id . ' AND `Employment_id` < ' . $this->Employment_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }

}

class graduate extends looeic
{

}