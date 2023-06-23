<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companyPosition.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class positionController
{
    /**
     * Contains file type.
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     * @var
     */
    public $fileName;

    /**
     * @var int|mixed
     */
    private $company_info;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
    public function template($list = [], $msg)
    {
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


    /**
     * @param $fields
     */
    public function addPosition($fields)
    {

        $fields['company_id'] = $this->company_info['company_id'];
        $fields['isActive'] = 1;
        $fields['status'] = 1;
        $fields['isAdmin'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $position = new c_position();
        $position->setFields($fields);
        $result = $position->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'موقعیت مورد نظر ذخیره نشد';
            echo json_encode($result);
            die();
        }

        $position->parent_id = $position->Position_id;
        $position->save();
        $result['msg'] = 'موقعیت مورد نظر ذخیره شد';
        $result['fields'] = $position->fields;
        $result['result'] = 1;
        calculateScoreCompany($fields['company_id']);
        json_encode($result);
        die();
    }


    /**
     * @param $fields
     */
    public function editPosition($fields)
    {
        $position = c_position::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('branch_id', '=', $fields['branch_id'])
            ->first();
        if (!is_object($position)) {
            $this->addPosition($fields);
        }

        $fields['company_id'] = $position->company_id;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $result = $this->onlyUpdate($fields, $position);
        calculateScoreCompany($this->company_info['company_id']);
        echo json_encode($result);
        die();
    }

    public function addNewAndUpdate($fields, $position)
    {
        $fields['parent_id'] = $position->parent_id;
        $fields['isActive'] = 1;
        $fields['status'] = 1;
        $fields['isAdmin'] = 0;

        $newPosition = new c_position();
        $newPosition->setFields($fields);
        $result = $newPosition->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }

        $result = $newPosition->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Update All';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add position');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new position, Update old banner';
            return $result;
        }
        $result['fields'] = $newPosition->fields;
        $result['result'] = 1;
        $result['msg'] = 'تغییرات مورد نظر انجام شد';
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        //$company = company::find($id);
        //$company->edit = $company->edit | '0000000000000001000000000';
        //$result = $company->save();
       // return $result;
    }

    /**
     * @param $fields
     * @param $position
     * @return mixed
     */
    public function onlyUpdate($fields, $position)
    {
        $position->setFields($fields);
        $result = $position->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'موقعیت مورد نظر ذخیره نشد';
            return $result;
        }

        //$result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update position');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }

        $result['fields'] = $position->fields;
        $result['result'] = 1;

        $result['msg'] = 'موقعیت مورد نظر ذخیره شد';
        return $result;
    }

    public function sendNotification($msg)
    {
        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info['company_id'],
            'to' => 1,
            'msg' => $msg,
            'messageType' => 1
        ];
        return $notification->addNotification($fields);
    }

    /**
     * @param $company_id
     * @return null
     */
    public static function getCompanyPosition($company_id)
    {
        $position = c_position::getBy_company_id_and_status_and_isActive($company_id,1,1)->getList();
        if ($position['export']['recordsCount'] > 0) {
            return $position['export']['list'];
        }
        /*$positions['x'] = 35.689389;
        $positions['y'] = 51.388686;
        return $positions;*/

    }

}
