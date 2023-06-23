<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/businessLicence.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class businesslicenceController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
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
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '00010000000000';
        $result = $company->save();
        return $result;
    }

    /**
     * add Certification.
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2016
     * @version 01.01.01
     */
    public function addBusinessLicence($fields)
    {
        $businessLicence = new c_business_licence_d();
        $businessLicence->setFields($fields);
        $validate = $businessLicence->validator();

        if ($validate['result'] == -1) {
            print_r_debug($validate);
        }
        $result = $businessLicence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            print_r_debug($result);
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
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
     * @return mixed
     * @author malekloo
     * @date 14/03/2016
     * @version 01.01.01
     */
    public function showBusinessLicenceAddForm($fields)
    {
        $this->addBusinessLicence($fields);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editBusinessLicence($fields)
    {
        $businessLicence = c_business_licence_d::find($fields['Business_licence_d_id']);

        if (!is_object($businessLicence)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }

        if ($fields['editor_id'] != $businessLicence->editor_id & $businessLicence->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }

        if ($businessLicence->status == 1) {
            $result = $this->addNewAndUpdate($fields, $businessLicence);
            
            if ($result['result'] == -1) {
                $result['msg'] = 'Not update';
                print_r_debug($result);
            }
            $result = $this->updateCompany($fields['editor_id']);

            if ($result['result'] == -1) {
                $result['msg'] = 'not update company';
                print_r_debug($result);
            }
        }
        $result = $this->onlyUpdate($fields, $businessLicence);
        if ($result['result'] == -1) {
            $result['msg'] = 'Not update';
            print_r_debug($result);
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            print_r_debug($result);
        }
    }

    /**
     * @param $fields
     * @param $businessLicence
     * @return array|mixed|null
     */
    public function addNewAndUpdate($fields, $businessLicence)
    {
        $fields['isActive'] = 1;
        $fields['business_licence_id'] = $businessLicence->business_licence_id;
        $newBusiness = new c_business_licence_d();
        $newBusiness->setFields($fields);
        $validate = $newBusiness->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $newBusiness->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $businessLicence->isActive = 0;
        $result = $businessLicence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new business Licence';
            return $result;
        }
        $result = $this->sendNotification('Add business Licence');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new business Licence, Update old business Licence';
            return $result;
        }
        $result['msg'] = 'Add new business Licence, Update old business Licence and send notification';
        return $result;
    }


    /**
     * @param $fields
     * @param $businessLicence
     * @return mixed
     */
    public function onlyUpdate($fields, $businessLicence)
    {
        $businessLicence->setFields($fields);
        $validate = $businessLicence->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $businessLicence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->sendNotification('Update business Licence');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['msg'] = 'Update and send notification';
        return $result;

    }


    /**
     * @param $msg
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
        $result = $notification->addNotification($fields);
        return $result;
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function showBusinessLicenceEditForm($fields)
    {
        $this->editBusinessLicence($fields);
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function showList()
    {
        global $company_info;
        $businesslicence = c_business_licence_d::getBy_editor_id_and_isActive($company_info['company_id'], 1)->getList();
        print_r_debug($businesslicence);
    }

    /**
     * delete deleteCertification by certification_id.
     *
     * @param $id
     *
     * @author malekloo
     * @date 2/24/2015
     *
     * @version 01.01.01
     */
    public function deleteBusinessLicence($id)
    {
        global $company_info;
        $businessLicence = c_business_licence_d::find($id);
        if (is_object($businessLicence)) {

            if ($businessLicence->editor_id == $company_info['company_id'] & $businessLicence->isActive == 1) {
                $result = $businessLicence->delete();

                if ($result['result'] == 1) {
                    die('Deleted Business Licence');
                }
            }
        }
    }
}
