<?php
include_once("server.inc.php");
include_once(ROOT_DIR . "common/db.inc.php");
include_once(ROOT_DIR . "common/init.inc.php");
include_once(ROOT_DIR . "common/func.inc.php");
include_once(ROOT_DIR . "model/db.inc.class.php");
include_once(ROOT_DIR . "model/admin_members.p.php");

global $admin_info;

$member = new admin_member_presentation();

echo '<pre/>';
print_r($PARAM);
switch ($PARAM[1])
{
    case 'more':
    {
		die('hi more');
        print_r($_SERVER);
        
		print_r($_POST);
		die();
        break;
    }
    default:

        $member->test();
        die();

        break;
}
