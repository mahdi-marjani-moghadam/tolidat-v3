<?php
include_once ROOT_DIR . 'common/chainquerybuilder.class.php';
include_once(ROOT_DIR . "common/looeic.php");

/**
 * Class sessions_member
 */
class sessions_member extends looeic
{

    protected $TABLE_NAME = 'sessions_admin';

    public function getHash()
    {
        return "dfdf46";
    }

    /**
     * @param $string
     * @param $key
     * @return string
     */
    function decrypt($string, $key)
    {
        $result = '';
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

    /**
     * @param $string
     * @param $key
     * @return string
     */
    function encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode($result);
    }


    /**
     * @return int|mixed
     */
    public function checkLogin()
    {
        if (!isset($_SESSION["sessionMemberID"])) {
            if (!isset($_COOKIE["sessionMemberID"])) {
                return -1;
            } else {
                $sessionMemberID = $this->decrypt($_COOKIE["sessionMemberID"], $this->getHash());
            }
        } else {
            $sessionMemberID = $this->decrypt($_SESSION["sessionMemberID"], $this->getHash());
        }
        $sessionMember = sessions_member::find($sessionMemberID);

        if (!is_object($sessionMember)) {
            return $sessionMember;
        }
        $company = company::find($sessionMember->company_id);
        if (!is_object($company)) {
            return $company;
        }
        $member = members::getBy_company_id($company->Company_id)->getList();
        $fields['company_id'] = $company->Company_id;
        $fields['company_name'] = $company->company_name;
        $fields['member_id'] = $member['export']['list']['0']['Members_id'];
        return $fields;
    }


    /**
     * @return mixed
     */

    public function logout()
    {

        if (isset($_SESSION["sessionMemberID"])) {

            $sessionMemberID = $this->decrypt($_SESSION["sessionMemberID"], $this->getHash());
            setcookie("sessionMemberID", $sessionMemberID, time() - 10000, "/", $_SERVER['HTTP_HOST']);

        } elseif (isset($_COOKIE["sessionMemberID"])) {

            $sessionMemberID = $this->decrypt($_COOKIE["sessionMemberID"], $this->getHash());
            setcookie("sessionMemberID", $sessionMemberID, time() - 10000, "/", $_SERVER['HTTP_HOST']);
        }

        unset($_SESSION['sessionMemberID']);
//        session_unset();
        return;
    }

}

class members extends looeic {
    
}
