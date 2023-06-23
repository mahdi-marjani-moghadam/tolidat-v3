<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once ROOT_DIR . 'component/companyAddresses/model/companyAddresses.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';

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
    public function template($list = [],$msg = '')
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
     * @param $msg
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
        $result = $notification->addNotification($fields);
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000001000000000000000000' :
            $company->edit & '1111110111111111111111111';
        $result = $company->save();
        return $result;
    }

    public function updateCompanyWikiAddress($id)
    {
        $company = company::find($id);
        $company->edit_wiki = $company->edit_wiki | '10';
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
        $fields['isActive'] = 1;
        $fields['isWiki'] = 0;
        $fields['status'] = -1;
        $fields['addresses_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];

        $address = new c_addresses_d();
        $branch = c_branch::find($fields['branch_id']);
        $fields['branch_id'] = $branch->parent_id;
        $address->setFields($fields);

        $validate = $address->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();

        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add Address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Address but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $address->fields;
        $result['fields']['date'] = convertDate(substr($address->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'آدرس مورد نظر اضافه شد';
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
    public function editAddress($fields)
    {
        $address = c_addresses_d::find($fields['Addresses_d_id']);
        $fields['addresses_id'] = $address->addresses_id;
        $fields['company_id'] = $address->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($address)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $address->company_id || $address->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($address->status == 1) {
            $result = $this->addNewAndUpdate($fields, $address);
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $address);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $history
     * @return string
     */
    public function addNewAndUpdate($fields, $address)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['addresses_id'] = $address->addresses_id;

        $newAddress = new c_addresses_d();
        $newAddress->setFields($fields);
        $validate = $newAddress->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newAddress->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newAddress->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new address';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new address, Update old address';
            return $result;
        }
        $result['fields'] = $newAddress->fields;
        $result['fields']['Addresses_d_id_old'] = $address->Addresses_d_id;
        $result['fields']['date'] = convertDate(substr($newAddress->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات آدرس مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $history
     */
    public function onlyUpdate($fields, $address)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $address->setFields($fields);
        $validate = $address->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update address');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $address->fields;
        $result['fields']['Addresses_d_id_old'] = $address->Addresses_d_id;
        $result['fields']['date'] = convertDate(substr($address->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات آدرس مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $fields
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getAddressByid($id)
    {
        $address_fields = c_addresses_d::find($id);
        if (is_object($address_fields)) {
            $result['result'] = 1;
            $result['fields'] = $address_fields->fields;
            return $result;
        }
        return $address_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getAddressByidAjax($id)
    {
        $json = $this->getAddressByid($id);
        echo json_encode($json);
        die();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCompanyAddressWiki($id)
    {
        $address_fields = c_addresses::find($id);
        if (is_object($address_fields)) {
            $result['result'] = 1;
            $result['fields'] = $address_fields->fields;
            return $result;
        }
        return $address_fields;
    }

    /**
     * @param $fields
     */
    public function editCompanyAddressWiki($fields)
    {
        $address = c_addresses::find($fields['Addresses_id']);

        if (!is_object($address)) {
            $result['msg'] = 'Not found address';
            echo json_encode($result);
            die();
        }
        $company = company::find($address->company_id);
        if (!is_object($company)) {
            $result['msg'] = 'Not found company';
            echo json_encode($result);
            die();
        }
        if ($company->username != null) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        $fields['isActive'] = 1;
        $fields['isWiki'] = 1;
        $fields['status'] = 0;
        $fields['addresses_id'] = $address->Addresses_id;
        $fields['company_id'] = $address->company_id;
        $fields['editor_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $address = new c_addresses_d();
        $address->setFields($fields);
        $validate = $address->validator();

        if ($validate['result'] == -1) {
            echo json_encode($validate);
            die();
        }
        $result = $address->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();

        }
        $result = $this->updateCompanyWikiAddress($address->company_id);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            print_r_debug($result);
        }
        $result = $this->sendNotification('آدرس به صورت ویکی ویرایش شد');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Address but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $address->fields;
        $result['result'] = 1;
        $result['msg'] = 'آدرس به صورت ویکی ویرایش شد';
        echo json_encode($result);
        die();
    }

    /**
     * @return mixe
     * @internal param $fields
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList($id)
    {
        $address = c_addresses_d::getBy_company_id_and_Branch_id_and_isActive($this->company_info['company_id'], $id, 1)->getList();
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
        $address = c_addresses_d::find($id);

        if (!is_object($address)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($address->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($address->isMain == 0){
            if ($address->phones_id == 0) {
                $result = $address->delete();
            } else {
                $result = $this->deleteAll($address);
            }
            if ($result['result'] == -1) {
                echo json_encode($result);
                die();
            }

            if ($address->status == 1) {
                calculateScoreCompany($this->company_info['company_id']);
            }

            $unconfirmedAddresses = c_addresses_d::getAll()
                ->where('company_id', '=', $this->company_info['company_id'])
                ->where('status', '=', -1)
                ->where('isActive', '=', 1)
                ->getList();

            if ($unconfirmedAddresses['export']['recordsCount'] <= 0){
                $this->updateCompany($this->company_info['company_id'], 'disable');
            }

            $result['fields'] = $address->fields;
            $result['msg'] = "آدرس مورد نظر حذف گردید";
            $result['result'] = 1;
            echo json_encode($result);
            die();
        } else{

            $result['msg'] = "آدرس مورد نظر به عنوان آدرس اصلی ثبت گردیده است و قابل حذف نمی باشد";
            $result['result'] = -1;
            echo json_encode($result);
        }
    }






    /**
     * @param $address
     * @return mixed
     */
    public function deleteAll($address)
    {
        $addresses = c_addresses_d::getBy_addresses_id($address->addresses_id)->get();
        foreach ($addresses['export']['list'] as $addres) {
            $addres->delete();
        }
        $result = $this->deleteMain($address);
        return $result;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($address)
    {
        $addressMain = c_addresses::find($address->addresses_id);
        if (is_object($addressMain)) {
            $result = $addressMain->delete();
        }
        return $result;
    }
}
