<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companyLogo.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

/**
 * Class registerController.
 */
class logoController
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
     * registerController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
    public function template($list = [],$msg = '')
    {
        switch ($this->exportType) {
            case 'html':

                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
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
     * add History.
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addLogo($fields)
    {
        $logo = new c_logo_d();
        $logo->setFields($fields);
        $validate = $logo->validator();

        if ($validate['result'] == -1) {
            print_r_debug($validate);
        }
        $result = $logo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            print_r_debug($result);
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added logo but not sended notification';
            print_r_debug($result);
        }
        $result['msg'] = 'Added logo and sended notification';
        print_r_debug($result);
    }

    /**
     * call register form.
     * @param $fields
     * @param $msg
     * @return mixed
     * @author malekloo
     * @date 14/03/2016
     * @version 01.01.01
     */
    public function showLogoAddForm($fields)
    {
        $this->addLogo($fields);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editLogo($fields)
    {
        $logo = c_logo_d::find($fields['logo_d_id']);

        if (!is_object($logo)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }
        if ($fields['editor_id'] != $logo->editor_id || $logo->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }
        if ($logo->status == 1) {
            $result = $this->addNewAndUpdate($fields, $logo);
            print_r_debug($result);
        }
        $result = $this->onlyUpdate($fields, $logo);
        print_r_debug($result);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showLogoEditForm($fields)
    {
        $this->editLogo($fields);
    }

    /**
     * @param $fields
     * @param $history
     * @return string
     */
    public function addNewAndUpdate($fields, $logo)
    {
        $fields['isActive'] = 1;
        $fields['logo_id'] = $logo->logo_id;
        $newLogo = new c_logo_d();
        $newLogo->setFields($fields);
        $validate = $newLogo->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $newLogo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $logo->isActive = 0;
        $result = $logo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo';
            return $result;
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo, Update old logo';
            return $result;
        }
        $result['msg'] = 'Add new logo, Update old logo and send notification';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $logo)
    {
        $logo->setFields($fields);
        $validate = $logo->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $logo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->sendNotification('Update logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['msg'] = 'Update and send notification';
        return $result;

    }


    /**
     * @return mixed
     */
    public function sendNotification($msg)
    {
        global $company_info;
        $notification = new adminNotificationController();
        $fields = [
            'from' => $company_info['company_id'],
            'to' => 2,
            'msg' => $msg,
            'messageType' => 1
        ];
        return $notification->addNotification($fields);
    }

    /**
     * @param $fields
     * @return mixe
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        global $company_info;
        $website = c_logo_d::getBy_editor_id_and_isActive($company_info['company_id'], 1)->getList();
        print_r_debug($website);
    }

    /**
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteLogo($id)
    {
        global $company_info;
        $logo = c_logo_d::find($id);
        if (!is_object($logo)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }
        if ($logo->editor_id != $company_info['company_id'] || $logo->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }
        $result = $logo->delete();

        if ($result['result'] == -1) {
            $result['msg'] = 'Undeleted logo';
            print_r_debug($result);
        }
        $result['msg'] = 'Deleted logo';
        print_r_debug($result);
    }
}
