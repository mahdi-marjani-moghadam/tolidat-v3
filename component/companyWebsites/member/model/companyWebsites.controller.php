<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once ROOT_DIR . 'component/companyWebsites/model/companyWebsites.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
include_once ROOT_DIR . 'component/branch/admin/model/admin.branch.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';

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
     * @param $id
     * @return mixed
     */
    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000001000000000000000' :
            $company->edit & '1111111110111111111111111';
        $result = $company->save();
        return $result;
    }

    /**
     * add Website.
     * @param $fields
     * @return int|mixed
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addWebsite($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['websites_id'] = 0;

        $website = new c_websites_d();
        $branch = c_branch::find($fields['branch_id']);
        $fields['branch_id'] = $branch->parent_id;

        $website->setFields($fields);
        $validate = $website->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $website->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added website but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $website->fields;
        $result['fields']['date'] = convertDate(substr($website->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'وب سایت مورد نظر اضافه شد';
        echo json_encode($result);
        die();
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
        $website = c_websites_d::find($fields['Websites_d_id']);
        $fields['websites_id'] = $website->websites_id;
        $fields['company_id'] = $website->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (!is_object($website)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $website->company_id) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }

        $website_d_id_oldest = 0;
        if ($website->status == 1 && $website->websites_id != 0) {
            $website_d_id_oldest = $website->Websites_d_id;
            $website = c_websites_d::getBy_websites_id_and_isActive($website->websites_id, 1)->first();
        }

        if ($website->status == 1) {
            $result = $this->addNewAndUpdate($fields, $website);
            $result['fields']['Websites_d_id_oldest'] = $website_d_id_oldest;
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $website);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $website
     * @return string
     * @internal param $history
     */
    public function addNewAndUpdate($fields, $website)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['websites_id'] = $website->websites_id;

        $newWebsite = new c_websites_d();
        $newWebsite->setFields($fields);
        $validate = $newWebsite->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newWebsite->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newWebsite->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new website';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new website, Update old website';
            return $result;
        }
        $result['fields'] = $newWebsite->fields;
        $result['fields']['Websites_d_id_old'] = $website->Websites_d_id;
        $result['fields']['date'] = convertDate(substr($newWebsite->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات وب سایت مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $website)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $website->setFields($fields);
        $validate = $website->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $website->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $website->fields;
        $result['fields']['Websites_d_id_old'] = $website->Websites_d_id;
        $result['fields']['date'] = convertDate(substr($website->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات وب سایت مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $fields
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getWebsiteByid($id)
    {
        $website_fields = c_websites_d::find($id);
        if (is_object($website_fields)) {
            $result['result'] = 1;
            $result['fields'] = $website_fields->fields;
            return $result;
        }
        return $website_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getWebsiteByidAjax($id)
    {
        $json = $this->getWebsiteByid($id);
        echo json_encode($json);
        die();
    }

    /**
     * @param $fields
     * @return mixe
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList($id)
    {
        $websites = c_websites_d::getBy_company_id_and_Branch_id_and_isActive($this->company_info['company_id'], $id, 1)->getList;
        if (($websites['export']['recordsCount'] >= 1)) {
            return $websites['export']['list'];

        }
        return null;
    }

    /**
     * @return mixed
     */
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
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteWebsite($id)
    {
        $website = c_websites_d::find($id);
        if (!is_object($website)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($website->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($website->websites_id == 0) {
            $result = $website->delete();
        } else {
            $result = $this->deleteAll($website);
        }
        if ($result['result'] == -1) {
            $result['msg'] = 'Undeleted website';
            echo json_encode($result);
            die();
        }

        if ($website->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedWebsites = c_websites_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedWebsites['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $website->fields;
        $result['msg'] = "وب سایت مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($website)
    {
        $websites = c_websites_d::getBy_websites_id($website->websites_id)->get();
        foreach ($websites['export']['list'] as $websit) {
            $websit->delete();
        }
        $result = $this->deleteMain($website);
        return $result;
    }

    /**
     * @param $website
     * @return mixed
     * @internal param $certification
     */
    public function deleteMain($website)
    {
        $websiteMain = c_websites::find($website->websites_id);
        if (is_object($websiteMain)) {
            $result = $websiteMain->delete();
        }
        return $result;
    }
}
