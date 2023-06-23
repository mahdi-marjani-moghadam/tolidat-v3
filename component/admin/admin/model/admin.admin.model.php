<?php

class adminadminModel extends looeic
{
    function showSetTask($message = "")
    {
        $conn = parent::getConnection();

        global $admin_info, $messageStack;

        $admin_id = handleData($_REQUEST["admin_id"]);
        $admin_id = intval($admin_id);
        if ($admin_id == 0) {
            $messageStack->add_session('admin.list', ModelADMIN_18, 'error');
            redirectPage(RELA_DIR . "admin.list.php");
        }
        if ($admin_id == 100) {
            $messageStack->add_session('admin.list', ModelADMIN_18, 'error');
            redirectPage(RELA_DIR . "admin.list.php");
        }

        $sql = "select name, username,permission from admin where admin_id=" . $admin_id;
        $rs = $conn->query($sql);
        if (!$rs) {
            $messageStack->add_session('admin.list', ModelADMIN_20, 'error');
            redirectPage(RELA_DIR . "admin.list.php", "");
        }

        if ($rs->rowCount() != 1) {
            $messageStack->add_session('admin.list', ModelADMIN_21, 'error');
            redirectPage(RELA_DIR . "admin.list.php", "");
        }

        $result = $rs->fetch(PDO::FETCH_ASSOC);

        $adminPermission['admin_name'] = $result['name'];
        $adminPermission['admin_username'] = $result['username'];
        $adminPermission['admin_permission'] = $result['permission'];

        include_once(ROOT_DIR . "model/admin.permission.class.php");
        $adminPermission['PagePermission'] = getAllPermisssion();
        //echo "<pre>";
        // print_r($adminPermission);
        //die('asdfo');
        return $adminPermission;

    }

    function setAdminTask()
    {
        $conn = parent::getConnection();
        global $admin_info, $messageStack;


        $admin_id = $_REQUEST["admin_id"];

        include_once(ROOT_DIR . "model/admin.permission.class.php");
        $PagePermission = getAllPermisssion();
        $permissionCode = '';
        $countAllPermission = count($PagePermission) * Count_Permission;

        for ($i = 0; $i <= $countAllPermission; $i++) {
            $permissionCode = $permissionCode . '0';
        }

        foreach ($_POST['permission'] as $no) {

            $permissionCode[$no - 1] = '1';
        }

        $admin_id = intval($admin_id);
        if ($admin_id == 0) {
            $messageStack->add_session('admin.list', ModelADMIN_22, 'error');
            redirectPage(RELA_DIR . "admin.list.php", "");

        }
        if ($admin_id == 100) {
            $messageStack->add_session('admin.list', ModelADMIN_22, 'error');
            redirectPage(RELA_DIR . "admin.list.php", "");
        }


        $admin_id = $_REQUEST['admin_id'];
        $sql = "update admin set permission= :permissionCode WHERE admin_id='$admin_id' ";
        $q = $conn->prepare($sql);
        $q->bindParam(':permissionCode',$permissionCode, PDO::PARAM_STR);
        if ($q->execute())
        {
            //echo 'saved';
        }else{
            print_r($conn->errorInfo());

        }

        $messageStack->add_session('admin.list', ModelADMIN_24, 'success');
        redirectPage(RELA_DIR . "admin.list.php", "");

        die();
    }

}