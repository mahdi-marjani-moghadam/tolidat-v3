<?php
/**
 * Created by PhpStorm.
 * User: marjani,ahmadloo
 * Date: 4/07/2016
 * Time: 9:21 AM
 */

include_once(dirname(__FILE__) . "/admin.login.model.php");
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';


/**
 * Class loginController
 */
class adminLoginController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * @param array $list
     * @param $msg
     * @return string
     */
    function template($list = [], $msg='')
    {
        // global $conn, $lang;
        global $messageStack,$admin_info;

        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                //include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
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
     *
     */
    public function showLoginform()
    {
        $this->fileName = 'admin.login.form.php';
        $this->template();
        die();
    }


    /**
     * @param $fields
     * @return mixed
     */
    public function callLogin($fields)
    {
        $login = new adminLoginModel();

        $result = $login->login($fields);

        if ($result['result'] != '1') {
            $this->fileName = 'admin.login.form.php';
            $this->template('', $result['msg']);
        }

        redirectPage(RELA_DIR . "admin/", $result['msg']);
        die();
    }

    public function callLogout()
    {
        $login = new adminLoginModel();

        $result = $login->logout();

        if ($result['result'] != '1') {
            $this->fileName = 'admin.login.form.php';
            $this->template('', $result['msg']);
        }

        redirectPage(RELA_DIR . "admin/", $result['msg']);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function loginAs($company_id)
    {
        include_once(ROOT_DIR . "component/login/model/login.model.php");
        //$sessions_member = new sessions_member();
        $adminLogin = new adminLoginModel();

        //Admin sessionID
        $sessionID = $adminLogin->decrypt($_SESSION["sessionID"], $adminLogin->GetHash());

        $sessions_member = sessions_member::find($sessionID);
        if (!is_object($sessions_member)) {
            $msg = "عملیات با مشکل مواحه شد لطفا دوباره تلاش نمایید";
            redirectPage(RELA_DIR . "admin/component=company", $msg);
        }

        $_SESSION['sessionMemberID'] = encrypt($sessionID, $sessions_member->getHash());

        //echo dirname(__FILE__) . "../model/login.model.php";

        $sessions_member->company_id = $company_id;
        $sessions_member->save();

        $member_info = $sessions_member->checkLogin();


        redirectPage(RELA_DIR . "member/product", $result['msg']);
        die();
    }

    public function getMember($input)
    {

        if ($input == "all") {
            $resultMember = adminMembersModel::getAll()->getList();
        } else {
            $resultMember = adminMembersModel::getBy_company_id($input)->first();
            $resultMember = $resultMember->fields;
        }

        return $resultMember;

    }

    public function getMemberObject($input)
    {
        $resultMember = adminMembersModel::getBy_company_id($input)->first();
        return $resultMember;
    }


}

