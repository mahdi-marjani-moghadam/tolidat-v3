<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companySocials.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';

/**
 * Class registerController.
 */
class socialController
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
            $company->edit | '0000000000000010000000000' :
            $company->edit & '1111111111111101111111111';
        $result = $company->save();
        return $result;
    }

    /**
     * add social.
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addSocial($fields)
    {

        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['socials_id'] = 0;
        $social = new c_socials_d();
        $branch = c_branch::find($fields['branch_id']);
        $fields['branch_id'] = $branch->parent_id;
        $social->setFields($fields);

        $social_type = social_type::find($social->fields['social_type_id']);

        if (is_object($social_type)) {
            $result['fields']['social_type'] = $social_type->type;
        } else {
            $social->social_type_id = '';
        }
        $validate = $social->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $social->save();

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
        $result = $this->sendNotification('Add social');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added social but not sended notification';
            echo json_encode($result);
            die();
        }
        $social_type = social_type::find($social->fields['social_type_id']);
        $social->social_type_id = $social_type->type;
        $result['fields'] = $social->fields;
        $result['fields']['date'] = convertDate(substr($social->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'شبکه اجتماعی مورد نظر اضافه شد';
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
    public function editSocial($fields)
    {
        $social = c_socials_d::find($fields['Socials_d_id']);
        $fields['socials_id'] = $social->socials_id;
        $fields['company_id'] = $social->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];

        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (!is_object($social)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $social->company_id) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }

        $social_d_id_oldest = 0;
        if ($social->status == 1 && $social->socials_id != 0) {
            $social_d_id_oldest = $social->Socials_d_id;
            $social = c_socials_d::getBy_socials_id_and_isActive($social->socials_id, 1)->first();
        }

        if ($social->status == 1) {
            $result = $this->addNewAndUpdate($fields, $social);
            $result['fields']['Socials_d_id_oldest'] = $social_d_id_oldest;
            $social_type = social_type::find($result['fields']['social_type_id']);
            if (is_object($social_type)) {
                $result['fields']['social_type_id'] = $social_type->type;
            }
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $social);
        $social_type = social_type::find($result['fields']['social_type_id']);
        if (is_object($social_type)) {
            $result['fields']['social_type_id'] = $social_type->type;
        }
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $history
     * @return string
     */
    public function addNewAndUpdate($fields, $social)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['socials_id'] = $social->socials_id;

        $newSocial = new c_socials_d();
        $newSocial->setFields($fields);
        $validate = $newSocial->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newSocial->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newSocial->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new social';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add social');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new social, Update old social';
            return $result;
        }
        $result['fields'] = $newSocial->fields;
        $result['fields']['Socials_d_id_old'] = $social->Socials_d_id;
        $result['fields']['date'] = convertDate(substr($newSocial->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات شبکه اجتماعی مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $social)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $social->setFields($fields);
        $validate = $social->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $social->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update social');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $social->fields;
        $result['fields']['Socials_d_id_old'] = $social->Socials_d_id;
        $result['fields']['date'] = convertDate(substr($social->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات شبکه اجتماعی مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $fields
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getSocialByid($id)
    {
        $social_fields = c_socials_d::find($id);
        if (is_object($social_fields)) {
            $result['result'] = 1;
            $result['fields'] = $social_fields->fields;
            return $result;
        }
        return $social_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getSocialByidAjax($id)
    {
        $json = $this->getSocialByid($id);
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
        $socials = c_socials_d::getBy_company_id_and_Branch_id_and_isActive($this->company_info['company_id'], $id, 1)->getList;
        if (($socials['export']['recordsCount'] >= 1)) {
            return $socials['export']['list'];
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
    public function deleteSocial($id)
    {
        $social = c_socials_d::find($id);
        if (!is_object($social)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($social->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($social->socials_id == 0) {
            $result = $social->delete();
        } else {
            $result = $this->deleteAll($social);
        }
        if ($result['result'] == -1) {
            $result['msg'] = 'Undeleted social';
            echo json_encode($result);
            die();
        }
        if ($social->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedSocials = c_socials_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedSocials['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $social->fields;
        $result['msg'] = "شبکه های اجتماعی مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($social)
    {
        $socials = c_socials_d::getBy_socials_id($social->socials_id)->get();
        foreach ($socials['export']['list'] as $social) {
            $social->delete();
        }
        $result = $this->deleteMain($social);
        return $result;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($social)
    {
        $socialMain = c_socials::find($social->socials_id);
        if (is_object($socialMain)) {
            $result = $socialMain->delete();
        }
        return $result;
    }
}
