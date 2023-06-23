<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once ROOT_DIR . 'component/emailEngine/admin/Controllers/EmailEngineController.php';
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';
include_once(dirname(__FILE__) . "/login.model.php");
include_once ROOT_DIR . '/model/mail.class.php';


/**
 * Class newsController.
 */
class loginController
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
     * @var
     */
    public $company_info;

    /**
     * newsController constructor.
     */
    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';
    }

    /**
     * call tempate.
     * @param array|string $list
     * @param $msg
     * @return string
     */
    public function template($list = [], $msg='')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
                break;

            case 'json':
                $list['msg'] = $msg;
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
     * @internal param $fields
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function showLoginForm()
    {
        $this->fileName = 'login.showLoginForm.php';
        $this->template();
        die();
    }

    /**
     * show login form
     */
    public function callLoginForm()
    {
        if (isset($this->company_info['company_id'])) {
            redirectPage(RELA_DIR . "profile");
        }
        $this->showLoginForm();
    }

    /**
     * @param $fields
     */
    public function login($fields)
    {
        $user = members::getBy_username_and_password_and_status(strtolower($fields['username']), md5($fields['password']), 1)->first();
        if (!is_object($user)) {
            $msg = "نام کاربری یا رمز ورود اشتباه است";
            redirectPage(RELA_DIR . "login", $msg);
        }
        $member = $this->addSessionMember($user);
        if (!is_object($member)) {
            $msg = "ورود با مشکل مواجه شد لطفا دوباره امتحان نمایید";
            redirectPage(RELA_DIR . "login", $msg);
        }
        $session_member = new sessions_member();
        $user->last_login = strftime('%Y-%m-%d %H:%M:%S', time());
        $user->save();
        $_SESSION['sessionMemberID'] = encrypt($member->Sessions_id, $session_member->getHash());
        redirectPage(RELA_DIR . "profile");
        
    }


    /**
     * @param $user
     * @param string $token
     * @return mixed|sessions_member
     */
    public function addSessionMember($user, $token = '')
    {
        $fields['remote_addr'] = $_SERVER['REMOTE_ADDR'];
        $fields['last_access_time'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $user->company_id;
        $fields['remember_me'] = $token;
        $fields['admin_id'] = 0;
        $sessionMember = new sessions_member();
        $sessionMember->setFields($fields);
        $result = $sessionMember->save();
        if ($result['result'] == -1) {
            return $result;
        }
        return $sessionMember;
    }

    public function logout()
    {
        $sessionMember = new sessions_member();
        $sessionMember->logout();
        redirectPage(RELA_DIR);
    }

    /**
     * @param array $fields
     * @param string $msg
     */
    public function getUsernameForm($fields = [], $msg = '')
    {
        $this->fileName = "login.getUsernameForm.php";
        $this->template($fields, $msg);
        die();
    }

    /**
     * @param $username
     */
    public function sendEmail($username)
    {
        $member = members::getBy_username($username)->first();
        if (!is_object($member)) {
            $msg['error'] = 1;
            $msg['msg'] = 'نام کاربری وارد شده وجود ندارد';
            $fields['username'] = $username;
            $this->getUsernameForm($fields, $msg);
        }

        $token = uniqid();
        $sessionMember = $this->addSessionMember($member, $token);

        if (!is_object($sessionMember)) {
            $msg['error'] = 1;
            $msg['msg'] = 'ارسال ایمیل با مشکل مواجه شد لطفا دوباره امتحان نمایید';
            $this->getEmailForm($fields, $msg);
        }

        $path = ROOT_DIR . 'templates/' . CURRENT_SKIN . '/resetPassword.php';
        $link = RELA_DIR . 'login/getNewPassword/' . $token;

        $contacts = [
            'email' => $member->email,
            'subject' => 'لینک رمزعبور جدید',
            'body' => ['path' => $path, 'data' => compact('link')],
        ];

        if (EmailEngineController::forceSend($contacts)) {
            $msg['error'] = 0;
            $msg['msg'] = 'لینک فعالسازی به ایمیل شما ارسال شد';
            $this->getUsernameForm($fields = '', $msg);
        } else {
            $msg['error'] = 1;
            $msg['msg'] = 'ایمیل ارسال نشد، لظفا مجددا تلاش فرمایید';
            $this->getUsernameForm($fields = '', $msg);
        }
    }

    /**
     * @param $email
     * @param $code
     * @return mixed
     * @internal param $token
     */
    public function mail($email, $code)
    {
        $mail = new clsEmail();
        $inputList['code'] = $code;
        $inputList['link'] = 'getNewPassword/' . $code;
        $inputList['title'] = 'لینک رمزعبور جدید';
        $inputList['footer'] = RELA_DIR;
        $mail->variable = $inputList;
        $body = $mail->parse(ROOT_DIR . 'templates/' . CURRENT_SKIN . "/compareCompanyEmailTemplate.php");
        $r = newSendMails($email, 'لینک رمزعبور جدید', $body);
        return $r;
    }

    /**
     * @param $token
     */
    public function getNewPasswordForm($token)
    {
        $session_member = sessions_member::getBy_remember_me($token)->first();
        if (!is_object($session_member)) {
            redirectPage(RELA_DIR . '404');
        }

        $fields['company_id'] = $session_member->company_id;
        $fields['token'] = $token;
        $this->showNewPasswordForm($fields);
    }


    public function showNewPasswordForm($fields)
    {
        $this->fileName = "login.newPasswordForm.php";
        $this->template($fields);
        die();
    }

    /**
     * @param $fields
     */
    public function savePassword($fields)
    {
        if ($fields['password'] != $fields['re_password']) {
            $fields['msg'] = "فیلد پسورد با تکرار پسورد برابر نیست";
            $this->showNewPasswordForm($fields);
        }
        $session_member = sessions_member::getBy_company_id_and_remember_me($fields['company_id'], $fields['token'])->first();

        if (!is_object($session_member)) {
            $msg = "صفحه مورد نظر یافت نشد";
            redirectPage(RELA_DIR . '404', $msg);
        }

        $member = members::getBy_company_id($fields['company_id'])->first();

        if (is_object($member)) {
            $member->password = md5($fields['password']);
            $result = $member->save();
        }

        if ($result['result'] == 1) {
            $session_member->delete();
        }

        $msg = 'پسورد با موفقیت تغییر یافت';
        redirectPage(RELA_DIR . 'login', $msg);
    }

    public function LoginAs($company_id)
    {

        global $admin_info;
        $company = company::find($company_id);
        if (!is_object($company)) {
            $msg = 'تولیدی موجود نیست';
            redirectPage(RELA_DIR . 'login/getNewPassword', $msg);
        }
        $fields = $company->fields;
        $fields['admin_id'] = $admin_info['admin_id'];
        $fields['remote_addr'] = $_SERVER["REMOTE_ADDR"];

        //* $operation=new loginAs_operation();
        // *include_once(ROOT_DIR . "model/company.operation.class.php");
        //*$operation_company=new company_operation();
        //*$result=$operation_company->getCompanyListById($fields['CompID']);

        //*$fields['comp_id']=$company_info['comp_id'] ;
        //*$fields['admin_id']=$admin_info['admin_id'];
        //*$fields['remote_addr']=$_SERVER["REMOTE_ADDR"];
        include_once(ROOT_DIR . "model/admin.class.php");
        $admin = new admin();
        $session = $admin->getSession_id();
        $fields['session_id'] = $session['decrypt'];
        $fields['last_access_time'] = date("Y-m-d H:i:s");
        $result = $operation->set_loginAsInfo($fields);

        if ($result['result'] != 1) {
            $this->LoginAsForm($fields, $result['msg']);
        }

        $result = $operation->insertLoginAs();

        if ($result == -1) {
            return $result['msg'];
        } else {
            $subName = $operation_company->companyInfo['Comp_Name'];
            $arrayList = explode('.', RELA_DIR);
            $arrayList[0] = 'http://' . $subName;
            $newAddress = implode('.', $arrayList);
            $msg = "successfully added.";
            redirectPage($newAddress . "loginAs.php?action=loginas&s=" . $session['encrypt'], $msg);
        }

        die();
    }

    public function deleteAllMemberByCompanyId($company_id)
    {
        //delete from main table
        $members = members::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($members['export']['recordsCount'] > 0) {
            foreach ($members['export']['list'] as $member) {
                $member->delete();
            }
        }

        return;

    }

}



