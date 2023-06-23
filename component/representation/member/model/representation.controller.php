<?php
include_once dirname(__FILE__) . '/representation.model.php';

class representationController
{

    public $exportType;


    public $fileName;

    private $company_info;

    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }


    function template($list = [], $msg = '')
    {
        global $messageStack;

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;

            default:
                break;
        }

    }

    public function showList()
    {
        $result = c_representation::getBy_company_id_and_not_confirm($this->company_info['company_id'], -1)->getList();
        $export['send']['list'] = $result['export']['list'];
        $export['send']['recordsCount'] = $result['export']['recordsCount'];

        for ($i = 0; $i < $export['send']['recordsCount']; $i++) {
            $company = company::getBy_company_id($export['send']['list'][$i]['representation_company'])->first();
            $export['send']['list'][$i]['company_name'] = $company->company_name;
        }

        $result = c_representation::getBy_representation_company($this->company_info['company_id'])->getList();

        $export['request']['list'] = $result['export']['list'];
        $export['request']['recordsCount'] = $result['export']['recordsCount'];

        for ($i = 0; $i < $export['request']['recordsCount']; $i++) {
            $company = company::getBy_company_id($export['request']['list'][$i]['company_id'])->first();
            $export['request']['list'][$i]['name'] = $company->company_name;
        }
        $this->fileName = 'member.representation.showList.php';

        $this->template($export);
        die();
    }

    public function addCode($fields)
    {
        $company_id = company::find($fields['representation_company']);
        if (!is_object($company_id)) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        } else if ($fields['representation_company'] != $this->company_info['company_id']) {
            $representation = new c_representation();
            $representation->representation_company = $this->company_info['company_id'];
            $representation->representation_name = $fields['representation_name'];
            $representation->company_id = $fields['representation_company'];
            $representation->company_name = '';
            $representation->confirm = 0;
            $representation->date_request = strftime('%Y-%m-%d %H:%M:%S', time());
            $representation->date_confirm = strftime('%Y-%m-%d %H:%M:%S', time());
            $representation->save();
            $result['result'] = 1;
            echo json_encode($result);
            die();
        } else {
            $result['msg'] = 'شماره کمپانی و نمایندگی یکسان می باشد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
    }

    public function confirmRepresentation($id)
    {
        $representation = c_representation::find($id['id']);
        $representation->confirm = 1;
        $representation->date_confirm = strftime('%Y-%m-%d %H:%M:%S', time());
        $result = $representation->save();
        if ($result['result'] == 1) {
            $result['msg'] = 'عملیات با موفقیت انجام شد';
            $result['result'] = 1;
            calculateScoreCompany($representation->company_id);
            echo json_encode($result);
            die();
        } else {
            $result['msg'] = 'عملیات انجام نشد';
            $result['result'] = 1;
            echo json_encode($result);
            die();
        }
    }

    public function rejectRepresentation($id)
    {
        $representation = c_representation::find($id['id']);
        if (!is_object($representation)) {
            $result['result'] = -1;
            $result['message'] = "نمایندگی مورد نظر یافت نشد";
            echo json_encode($result);
            die();
        }
        $representation->confirm = -1;
        $result = $representation->save();
        if ($result['result'] == 1) {
            $result['msg'] = 'عملیات با موفقیت انجام شد';
            $result['result'] = 1;
            if ($representation->confirm == 1) {
                calculateScoreCompany($representation->company_id);
            }
            echo json_encode($result);
            die();
        } else {
            $result['msg'] = 'عملیات انجام نشد';
            $result['result'] = 1;
            echo json_encode($result);
            die();
        }
    }

    public function deleteRepresentation($id)
    {
        $representation = c_representation::find($id['id']);

        if (!is_object($representation)) {
            $result['result'] = -1;
            $result['message'] = "نمایندگی مورد نظر یافت نشد";
            echo json_encode($result);
            die();
        }
        $result = $representation->delete();

        if ($result['result'] != 1) {
            $result['result'] = -1;
            $result['message'] = "نمایندگی مورد نظر حذف نشد دوباره تلاش نمایید";
            echo json_encode($result);
            die();
        }
        $result['message'] = "نمایندگی مورد نظر حذف شد";
        echo json_encode($result);
        die();
    }

    public function deleteAllRepresentationByCompanyId($company_id)
    {
        //delete from main table
        $representations = c_representation::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($representations['export']['recordsCount'] > 0) {
            foreach ($representations['export']['list'] as $representation) {
                $representation->delete();
            }
        }

        return;

    }


    public function getByCompanyId($company_id)
    {
        $representation = c_representation::getBy_company_id($company_id)->getList();
        return $representation;
    }
}
