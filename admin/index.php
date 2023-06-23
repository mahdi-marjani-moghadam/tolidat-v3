<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET');


include_once("../server.inc.php");
include_once(ROOT_DIR . "common/db.inc.php");
include_once(ROOT_DIR . "common/func.inc.php");
include_once(ROOT_DIR . "admin/init.inc.php");
include_once(ROOT_DIR."/common/validators.php");
include_once ROOT_DIR . 'common/chainquerybuilder.class.php';
include_once ROOT_DIR.'common/looeic.php';


//include_once(ROOT_DIR . "model/admin.index.php");


if($admin_info ==-1)
{
	include_once (ROOT_DIR . "component/login/admin/admin.login.php");

	//include_once (ROOT_DIR . "model/login/admin/admin.login.php");
	//redirectPage(RELA_DIR."model/login/admin/admin.login.php");
}

		if(isset($_GET['component']))
		{
			$component=$_GET['component'];
			$component_name=$_GET['component_name'];
		}else
		{
			$component='index';
			$component_name='index';
		}
		
		include_once (ROOT_DIR . "component/$component/admin/admin.$component.php");

?>
