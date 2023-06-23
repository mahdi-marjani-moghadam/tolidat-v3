<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companyWebsites.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

/**
 * Class registerController.
 */
class websiteController
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
    public function template($list = [], $msg)
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
    public function addWebsite($fields)
    {
        $website = new c_websites_d();
        $website->setFields($fields);
        $validate = $website->validator();

        if ($validate['result'] == -1) {
            print_r_debug($validate);
        }
        $result = $website->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            print_r_debug($result);
        }
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added website but not sended notification';
            print_r_debug($result);
        }
        $result['msg'] = 'Added website and sended notification';
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
    public function showWebsiteAddForm($fields)
    {
        $this->addWebsite($fields);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editWebsite($fields)
    {
        $website = c_websites_d::find($fields['websites_d_id']);

        if (!is_object($website)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }
        if ($fields['editor_id'] != $website->editor_id || $website->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }
        if ($website->status == 1) {
            $result = $this->addNewAndUpdate($fields, $website);
            print_r_debug($result);
        }
        $result = $this->onlyUpdate($fields, $website);
        print_r_debug($result);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showWebsiteEditForm($fields)
    {
        $this->editWebsite($fields);
    }

    /**
     * @param $fields
     * @param $history
     * @return string
     */
    public function addNewAndUpdate($fields, $website)
    {
        $fields['isActive'] = 1;
        $fields['websites_id'] = $website->websites_id;
        $newWebsite = new c_websites_d();
        $newWebsite->setFields($fields);
        $validate = $newWebsite->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $newWebsite->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $website->isActive = 0;
        $result = $website->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new website';
            return $result;
        }
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new website, Update old website';
            return $result;
        }
        $result['msg'] = 'Add new website, Update old website and send notification';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $website)
    {
        $website->setFields($fields);
        $validate = $website->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $website->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->sendNotification('Update website');

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
        $website = c_websites_d::getBy_editor_id_and_isActive($company_info['company_id'], 1)->getList();
        print_r_debug($website);
    }

    /**
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteWebsite($id)
    {
        global $company_info;
        $website = c_websites_d::find($id);
        if (!is_object($website)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }

        if ($website->editor_id != $company_info['company_id'] || $website->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }
        $result = $website->delete();

        if ($result['result'] == -1) {
            $result['msg'] = 'Undeleted website';
            print_r_debug($result);
        }
        $result['msg'] = 'Deleted website';
        print_r_debug($result);
    }
}
