<?php


include_once dirname(__FILE__) . '/companyPhones.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';


class phoneController
{

    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';

    }


    function template($list = [],$msg = '')
    {
        global $messageStack;

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

    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0000000100000000000000000';
        $result = $company->save();
        return $result;
    }


    public function addPhone($fields)
    {

        $phone = new c_phones_d();
        $phone->setFields($fields);

        $validate = $phone->validator();

        if ($validate['result'] != 1) {

        }

        $result = $phone->save();
        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            print_r_debug('کمپانی مورد نظر آپدیت نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyPhones', $msg);

    }

    public function sendNotification($fields)
    {
        global $company_info;
        $notification = new adminNotificationController();
        $fields = [
            'from' => $company_info['company_id'],
            'to' => 3,
            'msg' => 'phone',
            'messageType' => 1
        ];
        $res = $notification->addNotification($fields);

    }

    public function showPhoneAddForm($fields)
    {

        $this->addPhone($fields);
    }


    public function editPhone($fields)
    {

        $phone = c_phones_d::find($fields['Phones_d_id']);

        $fields['isActive'] = 1;

        if (!is_object($phone)) {
            print_r_debug('یافت نشد');
        }

        if ($fields['editor_id'] != $phone->editor_id || $fields['isActive'] != 1) {
            print_r_debug('کمپانی مورد نظر یافت نشد');
        }

        if ($phone->status == 1) {
            $this->addAndUpdateNewPhone($fields, $phone);
        }

        if ($phone->status != 1) {

            $this->UpdateNewPhone($fields, $phone);
        }
    }


    public function UpdateNewPhone($fields, $phone)
    {

        $phone->setFields($fields);
        $validate = $phone->validator();

        if ($validate['result'] == 1) {
            $result = $phone->save();
        }
        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyPhones', $msg);
    }


    public function addAndUpdateNewPhone($fields, $phone)
    {
        $fields['isActive'] = 1;
        $fields['phones_id'] = $phone->phones_id;
        $newPhone = new c_phones_d();
        $newPhone->setFields($fields);
        $validate = $newPhone->validator();

        if ($validate['result'] != 1) {
            print_r_debug('اطلاعات به درستی وارد نشده است');

        }
        $result = $newPhone->save();

        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $phone->isActive = 0;
        $result = $phone->save();
        if ($result['result'] != 1) {
            print_r_debug('اطلاعات به درستی ذخیره نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $this->sendNotification($msg);
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyPhones', $msg);
    }

    public function showPhoneEditForm($fields)
    {

        $this->editPhone($fields);
    }

    public function showList($fields)
    {

        $phone = new c_phones_d();
        $result = $phone::getBy_editor_id($fields['editor_id'])->getList();
        print_r_debug($result);
    }

    public function deletePhone($id)
    {
        $phone = c_phones_d::find($id);
        $company_id = $phone->fields['editor_id'];
        if (is_object($phone)) {
            fileRemover(COMPANY_ADDRESS_ROOT . $phone->fields['editor_id'] . "/phone/", $phone->fields['image']);
            $result = $phone->delete();
            if ($result['result'] != '1') {
                $this->showPhoneEditForm($id, $result['msg']);
            }
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'phone', $msg);
            die();
        } else {
            $msg = 'عملیات با موفقیت انجام نشد';
            redirectPage(RELA_DIR . 'phone', $msg);
            die();
        }
    }

    public function getPhoneByCompanyID($company_id)
    {
        $phone = c_phones_d::getBy_company_id_and_status_and_isActive_and_isMain($company_id, 1, 1, 1)->first();
        return $phone;
    }

}
