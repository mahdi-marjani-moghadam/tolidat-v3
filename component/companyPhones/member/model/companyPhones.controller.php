<?php

include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';


class phoneController
{

    public $exportType;


    public $fileName;
    private $company_info;


    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';
    }


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

    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000100000000000000000' :
            $company->edit & '1111111011111111111111111';
        $result = $company->save();
        return $result;
    }

    public function updateCompanyWikiPhone($id)
    {
        $company = company::find($id);
        $company->edit_wiki = $company->edit_wiki | '01';
        $result = $company->save();
        return $result;
    }

    public function addPhone($fields)
    {
        $fields['isActive'] = 1;
        $fields['isWiki'] = 0;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['phones_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['company_d_id'] = 0;
        $fields['phones_id'] = 0;
        $fields['isMain'] = 0;

        if ($fields['state'] == '') {
            $fields['value'] = '';
        }

        $phone = new c_phones_d();

        if ($fields['branch_id'] != 0) {
            $branch = c_branch::find($fields['branch_id']);
            
            if (is_object($branch)) {
                $fields['branch_id'] = $branch->parent_id;
            }
        }

        $phone->setFields($fields);

        $validate = $phone->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }

        $result = $phone->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            echo json_encode($result);
            die();
        }
        $result = $this->updateCompany($this->company_info['company_id']);
        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $phone->fields;
        $result['result'] = 1;
        $result['msg'] = 'تلفن مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }


    public function editPhone($fields)
    {
        $phone = c_phones_d::find($fields['Phones_d_id']);

        if (!is_object($phone)) {
            $result['msg'] = 'تلفن مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        unset($fields['Phones_d_id']);
        $fields['phones_id'] = $phone->phones_id;
        $fields['company_id'] = $phone->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['company_d_id'] = $phone->company_d_id;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['branch_id'] = $phone->branch_id;
        $fields['isMain'] = $phone->isMain;
        $fields['isAdmin'] = 0;

        if ($fields['state'] == '') {
            $fields['value'] = '';
        }

        if ($this->company_info['company_id'] != $phone->company_id) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        $phone_d_id_oldest = 0;

        if ($phone->status == 1 && $phone->phones_id != 0) {
            $phone_d_id_oldest = $phone->Phones_d_id;
            $phone = c_phones_d::getBy_phones_id_and_isActive($phone->phones_id, 1)->first();
        }

        if ($phone->status == 1) {
            $result = $this->addNewAndUpdate($fields, $phone);
            $result['fields']['Phones_d_id_oldest'] = $phone_d_id_oldest;
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $phone);
        echo json_encode($result);
        die();
    }


    public function addNewAndUpdate($fields, $phone)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['phones_id'] = $phone->phones_id;

        $newPhone = new c_phones_d();
        $newPhone->setFields($fields);
        $validate = $newPhone->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newPhone->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات آپدیت نشد';
            return $result;
        }
        $result = $newPhone->updateAll();
        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات افزوده شد اما آپدیت نشد';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);
        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $newPhone->fields;
        $result['fields']['Phones_d_id_old'] = $phone->Phones_d_id;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات تلفن مورد نظر ویرایش شد';
        return $result;
    }


    public function onlyUpdate($fields, $phone)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $phone->setFields($fields);
        $validate = $phone->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $phone->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            return $result;
        }

        $result = $this->updateCompany($this->company_info['company_id']);
        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }

        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            return $result;
        }
        $result['fields'] = $phone->fields;
        $result['fields']['Phones_d_id_old'] = $phone->Phones_d_id;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات تلفن مورد نظر ویرایش شد';
        return $result;

    }


    public function getPhoneByid($id)
    {
        $phone_fields = c_phones_d::find($id);
        if (is_object($phone_fields)) {
            $result['result'] = 1;
            $result['fields'] = $phone_fields->fields;
            return $result;
        }
        return $phone_fields;

        die();
    }


    public function getPhoneByidAjax($id)
    {
        $json = $this->getPhoneByid($id);
        echo json_encode($json);
        die();
    }

    public function getCompanyPhoneWiki($id)
    {
        $phone_fields = c_phones::find($id);

        if (is_object($phone_fields)) {
            $result['result'] = 1;
            $result['fields'] = $phone_fields->fields;
            return $result;
        }
        return $phone_fields;
        die();
    }

    public function editCompanyPhoneWiki($fields)
    {
        $phone = c_phones::find($fields['Phones_id']);
        if (!is_object($phone)) {
            $result['msg'] = 'Not found phones';
            echo json_encode($result);
            die();
        }
        $company = company::find($phone->company_id);
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
        $fields['phones_id'] = $phone->Phones_id;
        $fields['company_id'] = $phone->company_id;
        $fields['editor_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $phone = new c_phones_d();
        $phone->setFields($fields);
        $validate = $phone->validator();

        if ($validate['result'] == -1) {
            echo json_encode($validate);
            die();
        }
        $result = $phone->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();

        }
        $result = $this->updateCompanyWikiPhone($phone->company_id);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }

        $result = $this->sendNotification('تلفن به صورت ویکی ویرایش شد');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Phone but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $phone->fields;
        $result['result'] = 1;
        $result['msg'] = 'آدرس به صورت ویکی ویرایش شد';
        echo json_encode($result);
        die();
    }


    public function showList($id)
    {
        $phones = c_phones_d::getBy_company_id_and_Branch_id_and_isActive($this->company_info['company_id'], $id, 1)->getList();
        if (($phones['export']['recordsCount'] >= 1)) {
            return $phones['export']['list'];
        }
        return null;
    }

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


    public function deletePhone($id)
    {
        $phone = c_phones_d::find($id);

        if (!is_object($phone)) {
            $result['msg'] = 'رکورد مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($phone->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($phone->isMain == 0) {
            if ($phone->phones_id == 0) {
                $result = $phone->delete();
            } else {
                $result = $this->deleteAll($phone);
            }
            if ($result['result'] == -1) {
                echo json_encode($result);
                die();
            }

            if ($phone->status == 1) {
                calculateScoreCompany($this->company_info['company_id']);
            }

            $unconfirmedPhones = c_phones_d::getAll()
                ->where('company_id', '=', $this->company_info['company_id'])
                ->where('status', '=', -1)
                ->where('isActive', '=', 1)
                ->getList();

            if ($unconfirmedPhones['export']['recordsCount'] <= 0){
                $this->updateCompany($this->company_info['company_id'], 'disable');
            }

            $result['fields'] = $phone->fields;
            $result['msg'] = "تلفن مورد نظر حذف گردید";
            $result['result'] = 1;
            echo json_encode($result);
            die();
        } else {
            $result['msg'] = "تلفن مورد نظر به عنوان تلفن اصلی ثبت گردیده است و قابل حذف نمی باشد";
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
    }

    public function deleteAll($phone)
    {
        $phones = c_phones_d::getBy_phones_id($phone->phones_id)->get();
        foreach ($phones['export']['list'] as $phone) {
            $result = $phone->delete();

            if ($result['result'] == -1) {
                $result['msg'] = 'مجوز مورد نظر حذف نشد';
                return $result;
            }
        }
        $phoneMain = c_phones::find($phone->phones_id);

        if (is_object($phoneMain)) {
            $result = $phoneMain->delete();
            return $result;
        }
        return $result;
    }
}
