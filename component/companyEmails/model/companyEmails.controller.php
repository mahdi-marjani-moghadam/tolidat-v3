<?php


include_once dirname(__FILE__) . '/companyEmails.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';


class emailController
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
        $company->edit = $company->edit | '0000000010000000000000000';
        $result = $company->save();
        return $result;
    }


    public function addEmail($fields)
    {
print_r_debug("gfre");
        $email = new c_emails_d();
        $email->setFields($fields);
        $validate = $email->validator();

        if ($validate['result'] != 1) {
            print_r_debug($validate);
        }
        $result = $email->save();

        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }

        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            print_r_debug('کمپانی مورد نظر آپدیت نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyEmails', $msg);

    }

    public function sendNotification($fields)
    {
        global $company_info;
        $notification = new adminNotificationController();
        $fields = [
            'from' => $company_info['company_id'],
            'to' => 3,
            'msg' => 'email',
            'messageType' => 1
        ];
        $res = $notification->addNotification($fields);

    }

    public function showEmailAddForm($fields)
    {
       
        $this->addEmail($fields);
    }


    public function editEmail($fields)
    {

        $email = c_emails_d::find($fields['Emails_d_id']);
        $fields['isActive'] = 1;
        
        if (!is_object($email)) {
            print_r_debug('یافت نشد');
        }

        if ($fields['editor_id'] != $email->editor_id || $fields['isActive'] != 1) {
            print_r_debug('کمپانی مورد نظر یافت نشد');
        }

        if ($email->status == 1) {
            $this->addAndUpdateNewEmail($fields, $email);
        }

        if ($email->status != 1) {

            $this->UpdateNewEmail($fields, $email);
        }
    }


    public function UpdateNewEmail($fields, $email)
    {

        $email->setFields($fields);
        $validate = $email->validator();

        if ($validate['result'] == 1)
        {
            $result = $email->save();
        }
        if($result['result']!=1)
        {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyEmails', $msg);
    }


    public function addAndUpdateNewEmail($fields, $email)
    {

        $fields['emails_id'] = $email->emails_id;
        $newEmail = new c_emails_d();
            $newEmail->setFields($fields);
            $validate = $newEmail->validator();

            if ($validate['result'] != 1) {
                print_r_debug('اطلاعات به درستی وارد نشده است');

            }
            $result = $newEmail->save();

            if ($result['result'] != 1) {
                print_r_debug('اطلاعات ذخیره نشد');
            }
            $email->isActive = 0;
            $result = $email->save();
            if ($result['result'] != 1) {
                print_r_debug('اطلاعات به درستی ذخیره نشد');
            }
            $msg = 'عملیات با موفقیت انجام شد';
            $this->sendNotification($msg);
        $this->sendNotification($msg);
        redirectPage(RELA_DIR . 'companyEmails', $msg);
    }

    public function showEmailEditForm($fields)
    {

        $this->editEmail($fields);
    }

    public function showList($fields)
    {

        $email = new c_emails_d();
        $result = $email::getBy_editor_id($fields['editor_id'])->getList();
       print_r_debug($result);
    }

    public function deleteEmail($id)
    {
        $email = c_emails_d::find($id);
        $company_id = $email->fields['editor_id'];
        if (is_object($email)) {
            fileRemover(COMPANY_ADDRESS_ROOT . $email->fields['editor_id'] . "/email/", $email->fields['image']);
            $result = $email->delete();
            if ($result['result'] != '1') {
                $this->showEmailEditForm($id, $result['msg']);
            }
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'email', $msg);
            die();
        } else {
            $msg = 'عملیات با موفقیت انجام نشد';
            redirectPage(RELA_DIR . 'email', $msg);
            die();
        }
    }


}

?>