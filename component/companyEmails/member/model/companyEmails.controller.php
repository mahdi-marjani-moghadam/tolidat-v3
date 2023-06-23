<?php

include_once ROOT_DIR . 'component/companyEmails/model/companyEmails.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';


class emailController
{

    public $exportType;


    public $fileName;
    private $company_info;


    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR. 'login');
        }
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
            $company->edit | '0000000010000000000000000' :
            $company->edit & '1111111101111111111111111';
        $result = $company->save();
        return $result;
    }


    public function addEmail($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['emails_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];

        $email = new c_emails_d();
        $branch = c_branch::find($fields['branch_id']);
        $fields['branch_id'] = $branch->parent_id;
        $email->setFields($fields);
        $validate = $email->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $email->save();

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
        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $email->fields;
        $result['fields']['date'] = convertDate(substr($email->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'ایمیل مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }


    public function editEmail($fields)
    {
        $email = c_emails_d::find($fields['Emails_d_id']);
        $fields['emails_id'] = $email->emails_id;
        $fields['company_id'] = $email->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (!is_object($email)) {
            $result['msg'] = 'عملیات انجام نشد';
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $email->company_id) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        $email_d_id_oldest = 0;
        if ($email->status == 1 && $email->emails_id != 0) {
            $email_d_id_oldest = $email->Emails_d_id;
            $email = c_emails_d::getBy_emails_id_and_isActive($email->emails_id, 1)->first();
        }
        
        if ($email->status == 1) {
            $result = $this->addNewAndUpdate($fields, $email);
            $result['fields']['Emails_d_id_oldest'] = $email_d_id_oldest;
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $email);
        echo json_encode($result);
        die();
    }


    public function addNewAndUpdate($fields, $email)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['emails_id'] = $email->emails_id;

        $newEmail = new c_emails_d();
        $newEmail->setFields($fields);
        $validate = $newEmail->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newEmail->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات آپدیت نشد';
            return $result;
        }
        $result = $newEmail->updateAll();

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
        $result = $this->sendNotification('Add Email');

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            return $result;
        }
        $result['fields'] = $newEmail->fields;
        $result['fields']['Emails_d_id_old'] = $email->Emails_d_id;
        $result['fields']['date'] = convertDate(substr($newEmail->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات ایمیل مورد نظر ویرایش شد';
        return $result;
    }


    public function onlyUpdate($fields, $email)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $email->setFields($fields);
        $validate = $email->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $email->save();

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
        $result['fields'] = $email->fields;
        $result['fields']['Emails_d_id_old'] = $email->Emails_d_id;
        $result['fields']['date'] = convertDate(substr($email->date, 0, 10));
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات ایمیل مورد نظر ویرایش شد';
        return $result;

    }


    public function getEmailByid($id)
    {
        $email_fields = c_emails_d::find($id);
        if (is_object($email_fields)) {
            $result['result'] = 1;
            $result['fields'] = $email_fields->fields;
            return $result;
        }
        return $email_fields;
        die();
    }


    public function getEmailByidAjax($id)
    {
        $json = $this->getEmailByid($id);
        echo json_encode($json);
        die();
    }


    public function showList($id)
    {
        $emails = c_emails_d::getBy_company_id_and_Branch_id_and_isActive($this->company_info['company_id'], $id, 1, 1)->getList;
        if (($emails['export']['recordsCount'] >= 1)) {
            return $emails['export']['list'];
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


    public function deleteEmail($id)
    {
        $email = c_emails_d::find($id);

        if (!is_object($email)) {
            $result['msg'] = 'رکورد مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($email->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if  ($email->emails_id==0)
        {
            $result=$email->delete();
        }
        else 
        {
            $result = $this->deleteAll($email);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        if ($email->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedEmails = c_emails_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedEmails['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $email->fields;
        $result['msg'] = "ایمیل مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($email)
    {
        $emails = c_emails_d::getBy_emails_id($email->emails_id)->get();
        foreach ($emails['export']['list'] as $emails) {
            $result = $emails->delete();

            if ($result['result'] == -1) {
                $result['msg'] = 'ایمیل مورد نظر حذف نشد';
                return $result;
            }
        }
        $emailMain = c_emails::find($email->emails_id);

        if (is_object($emailMain)) {
            $result = $emailMain->delete();
            return $result;
        }
        return $result;
    }

    public static function getEmailByEmail($email, $company_id)
    {
        $email = c_emails::getBy_email_and_not_company_id($email, $company_id)->first();
        $email_d = c_emails_d::getBy_email_and_not_company_id($email, $company_id)->first();
        if (is_object($email) || is_object($email_d)) {
            return true;
        }
        return false;
    }
}
