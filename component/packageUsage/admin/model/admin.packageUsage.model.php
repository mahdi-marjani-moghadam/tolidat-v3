<?php

class adminpackageusageModel extends looeic
{
    protected $rules;

    public static function checkPackageUsage($company_id, $action, $option = '')
    {
        $model = adminpackageusageModel::getBy_company_id($company_id)->first();
        if ($option == 'product') {
            if ($action == 'add') {
                $model->product_Usage++;

            } elseif ($action == 'delete') {
                $model->product_Usage--;
                return $model;

            } elseif ($action == 'edit') {

            } else {
                $result['result'] = -1;
                $result['msg'] = 'action not found';
                return $result;
            }
            $msg_product = 'تعداد مجاز برای افزودن محصول ' . $model->product . ' میباشد. ';

            $model->rules = array(
                'product_Usage' => 'max_numeric,' . $model->product . '*' . $msg_product,
            );
        }
        elseif ($option == 'branch') {
            if ($action == 'add') {
                $model->branch_Usage++;

            } elseif ($action == 'delete') {
                $model->branch_Usage--;
                return $model;

            } elseif ($action == 'edit') {

            } else {
                $result['result'] = -1;
                $result['msg'] = 'action not found';
                return $result;
            }
            $msg_branch = 'تعداد مجاز برای افزودن شعبه ' . $model->branch . ' میباشد. ';
            $model->rules = array(
                'branch_Usage' => 'max_numeric,' . $model->branch . '*' . $msg_branch,
            );
        }
        else {
            if ($action == 'add') {
                $model->representation_Usage++;

            } elseif ($action == 'delete') {
                $model->representation_Usage--;
                return $model;

            } elseif ($action == 'edit') {

            } else {
                $result['result'] = -1;
                $result['msg'] = 'action not found';
                return $result;
            }
            $msg_representation = 'تعداد مجاز برای افزودن نمایندگی ' . $model->product . ' میباشد. ';

            $model->rules = array(
                'representation_Usage' => 'max_numeric,' . $model->representation . '*' . $msg_representation,
            );
        }
        $validate = $model->validator();
        if ($validate['result'] == -1) {
            return $validate;
        }

        return $model;

    }
}