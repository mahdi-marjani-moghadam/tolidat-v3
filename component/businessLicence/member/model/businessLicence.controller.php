<?php

include_once dirname(__FILE__) . '/businessLicence.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class businesslicenceController
{
    /*
     * @var
     */
    public $exportType;
    /*
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
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '000100000000000';
        $result = $company->save();
        return $result;
    }

    /**
     * add Certification.
     * @param $fields
     * @return int|mixed
     * @date 2/27/2016
     * @version 01.01.01
     */
    public function addBusinessLicence($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['business_licence_id'] = 0;
        $fields['image'] = $this->uploadImage($fields['img']);

        $businessLicence = new c_business_licence_d();
        $businessLicence->setFields($fields);
        $validate = $businessLicence->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $businessLicence->save();

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
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added business licence but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $businessLicence->fields;
        $result['fields']['date'] = convertDate(substr($businessLicence->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/businessLicence/' . $businessLicence->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'پروانه کسب مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editBusinessLicence($fields)
    {
        $businessLicence = c_business_licence_d::find($fields['Business_licence_d_id']);

        if (!is_object($businessLicence)) {
            $result['msg'] = 'پروانه کسب مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        $fields['business_licence_id'] = $businessLicence->business_licence_id;
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if ($fields['company_id'] != $businessLicence->company_id) {
            $result['msg'] = 'پروانه کسب مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $business_licence_id_oldest = 0;
        if ($businessLicence->status == 1 && $businessLicence->business_licence_id != 0) {
            $business_licence_id_oldest = $businessLicence->Business_licence_d_id;
            $businessLicence = c_business_licence_d::getBy_business_licence_id_and_isActive($businessLicence->business_licence_id, 1)->first();
        }

        if ($businessLicence->status == 1) {
            $result = $this->addNewAndUpdate($fields, $businessLicence);
            $result['fields']['Business_licence_id_oldest'] = $business_licence_id_oldest;
            echo json_encode($result);
            die();
        }

        $result = $this->onlyUpdate($fields, $businessLicence);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $businessLicence
     * @return array|mixed|null
     */
    public function addNewAndUpdate($fields, $businessLicence)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['business_licence_id'] = $businessLicence->business_licence_id;
        $fields['image'] = $businessLicence->image;

        if ($fields['img']['name'] != '') {
            $fields['image'] = $this->uploadImage($fields['img']);
        }
        $newBusiness = new c_business_licence_d();
        $newBusiness->setFields($fields);
        $validate = $newBusiness->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newBusiness->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newBusiness->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Old record not update';
            return $result;
        }

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add business Licence');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new business Licence, Update old business Licence';
            return $result;
        }
        $result['fields'] = $newBusiness->fields;
        $result['fields']['Business_licence_d_id_old'] = $businessLicence->Business_licence_d_id;
        $result['fields']['date'] = convertDate(substr($newBusiness->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/businessLicence/' . $newBusiness->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات پروانه کسب مورد نظر ویرایش شد';

        return $result;
    }

    /**
     * @param $fields
     * @param $businessLicence
     * @return mixed
     */
    public function onlyUpdate($fields, $businessLicence)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if ($fields['img']['name'] != '') {
            $fields['image'] = $this->uploadImage($fields['img']);
            fileRemover(COMPANY_ADDRESS_ROOT . $businessLicence->company_id . "/businessLicence/", $businessLicence->image);
        }
        $businessLicence->setFields($fields);
        $validate = $businessLicence->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $businessLicence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update business Licence');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $businessLicence->fields;
        $result['fields']['Business_licence_d_id_old'] = $businessLicence->Business_licence_d_id;
        $result['fields']['date'] = convertDate(substr($businessLicence->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/businessLicence/' . $businessLicence->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات پروانه کسب مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getBusinessLicenceByid($id)
    {
        $businessLicence_fields = c_business_licence_d::find($id);
        if (is_object($businessLicence_fields)) {
            $result['result'] = 1;
            $result['fields'] = $businessLicence_fields->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $businessLicence_fields->company_id . "/businessLicence/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $businessLicence_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getBusinessLicenceByidAjax($id)
    {
        $json = $this->getBusinessLicenceByid($id);
        echo json_encode($json);
        die();
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
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        $businesslicence = c_business_licence_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $this->fileName = "member.businessLicence.showList.php";
        $export['list'] = $businesslicence['export']['list'];
        $this->template($export);
        die();
    }

    /**
     * delete deleteCertification by certification_id.
     * @param $id
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteBusinessLicence($id)
    {
        $businessLicence = c_business_licence_d::find($id);
        if (!is_object($businessLicence)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }

        if ($businessLicence->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($businessLicence->business_licence_id == 0) {
            $result = $businessLicence->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $businessLicence->company_id . "/businessLicence/", $businessLicence->image);
        } else {
            $result = $this->deleteAll($businessLicence);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        if ($businessLicence->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $result['msg'] = 'پروانه کسب مورد نظر حذف گردید';
        $result['fields'] = $businessLicence->fields;
        echo json_encode($result);
        die();
    }

    public function deleteAll($businessLicence)
    {
        $businesses = c_business_licence_d::getBy_business_licence_id($businessLicence->business_licence_id)->get();
        foreach ($businesses['export']['list'] as $business) {
            $business->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $business->company_id . "/businessLicence/", $business->image);
        }
        $result = $this->deleteMain($businessLicence);
        return $result;
    }

    /**
     * @param $businessLicence
     * @return mixed
     * @internal param $certification
     */
    public function deleteMain($businessLicence)
    {
        $businessMain = c_business_licence::find($businessLicence->business_licence_id);
        if (is_object($businessMain)) {
            $result = $businessMain->delete();
        }
        return $result;
    }

    public function uploadImage($fields)
    {
        if ($fields['name'] != '') {
            $type = substr($fields['type'], 0, 5);
            if ($type == 'image') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $fields['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/businessLicence/"
                );
                $result_uploader = fileUploader($Property, $fields);
                return $result_uploader['image_name'];
            }
        }
        return null;
    }
}
