<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companyAddresses.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class addressController
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
    public function template($list = [], $msg = '')
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
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0000001000000000000000000';
        $result = $company->save();
        return $result;
    }

    /**
     * add History.
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addAddress($fields)
    {
        $address = new c_addresses_d();
        $address->setFields($fields);
        $validate = $address->validator();

        if ($validate['result'] == -1) {
            print_r_debug($validate);
        }
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            print_r_debug($result);
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            print_r_debug($result);
        }
        $result = $this->sendNotification('Add Address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Address but not sended notification';
            print_r_debug($result);
        }
        $result['msg'] = 'Added Address and sended notification';
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
    public function showAddressAddForm($fields)
    {
        $this->addAddress($fields);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editAddress($fields)
    {
        $address = c_addresses_d::find($fields['addresses_d_id']);

        if (!is_object($address)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
        }
        if ($fields['editor_id'] != $address->editor_id || $address->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            print_r_debug($result);
        }
        if ($address->status == 1) {
            $result = $this->addNewAndUpdate($fields, $address);
            print_r_debug($result);
        }
        $result = $this->onlyUpdate($fields, $address);
        print_r_debug($result);
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showAddressEditForm($fields)
    {
        $this->editAddress($fields);
    }

    /**
     * @param $fields
     * @param $history
     * @return string
     */
    public function addNewAndUpdate($fields, $address)
    {
        $fields['isActive'] = 1;
        $fields['addresses_id'] = $address->addresses_id;
        $newAddress = new c_addresses_d();
        $newAddress->setFields($fields);
        $validate = $newAddress->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $newAddress->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $address->isActive = 0;
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new address';
            return $result;
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            print_r_debug($result);
        }
        $result = $this->sendNotiifcation('Add address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new address, Update old address';
            return $result;
        }
        $result['msg'] = 'Add new address, Update old address and send notification';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $address)
    {
        $address->setFields($fields);
        $validate = $address->validator();

        if ($validate['result'] == -1) {
            return $validate;
        }
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            print_r_debug($result);
        }
        $result = $this->sendNotification('Update address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['msg'] = 'Update and send notification';
        return $result;

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
        $address = c_addresses_d::getBy_editor_id_and_isActive($company_info['company_id'], 1)->getList();
        if ($address['export']['recordsCount'] > 0) {
            return $address['export']['list'];
        }
        return null;
    }

    /**
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteAddress($id)
    {
        global $company_info;
        $address = c_addresses_d::find($id);
        if (is_object($address)) {

            if ($address->editor_id == $company_info['company_id'] & $address->isActive == 1) {
                $result = $address->delete();

                if ($result['result'] == 1) {
                    $result['msg'] = 'Deleted address';
                    print_r_debug($result);
                }
            }
        }
    }

    public function getAddressByCompanyID($company_id)
    {
        $address = c_addresses_d::getBy_company_id_and_status_and_isActive_and_isMain($company_id, 1, 1, 1)->first();
        return $address->address;
    }

}
