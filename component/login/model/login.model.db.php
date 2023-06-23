<?php

/**
 * Created by PhpStorm.
 * User: marjani and ahmadloo
 * Date: 04/07/2016
 * Time: 12 AM
 */
class loginModelDb
{

    static function insertSession($id)
    {

        $conn = dbConn::getConnection();
        $sql = "
					  insert into sessions(member_id,remote_addr,last_access_time)
			  values
			  		  (" . $id . ", '". $_SERVER["REMOTE_ADDR"] . "', '" .getDateTime(). "')";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['export']['insert_id']=$conn->lastInsertId();
        $result['result'] = 1;
        return $result;
    }

    static function getSession($sessionID)
    {
        //global $lang;
        $conn = dbConn::getConnection();
        $sql="SELECT member_id FROM sessions WHERE Sessions_member_id = '$sessionID'";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }


    static function deleteSessions()
    {

        $conn = dbConn::getConnection();

        $sql = "DELETE FROM sessions_member WHERE last_access_time < (NOW()-3000000)";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }
    static function deleteSessionWithSession_id($id)
    {

        $conn = dbConn::getConnection();

        $sql = "delete from sessions_member where Sessions_member_id='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }
        $result['result'] = 1;
        return $result;
    }



    static function getMemberByUsername($fields)
    {
        //global $lang;
        $conn = dbConn::getConnection();
        /*$sql = "SELECT
                    *
                FROM
                    company
                WHERE
                    Login_id= '$id'";*/
        $sql = "SELECT `Company_id` , `company_name` FROM `company` where  `username` = '".$fields['username']."' AND password = '".$fields['password']."'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }

    static function getMemberByAdmin_id($id)
    {

        $conn = dbConn::getConnection();

        $sql = "SELECT * FROM `admin` where  `admin_id` = '$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt)
        {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        if (!$stmt->rowCount())
        {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

        $row = $stmt->fetch();

        $result['result'] = 1;
        $result['export']['list'] = $row;

        return $result;

    }

}