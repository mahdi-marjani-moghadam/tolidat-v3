<?
function send_sms_register($number, $msg)
{

    $msg = "کاربر گرامی \n ثبت نام شما با موفقیت انجام شد. \n
	www.decornama.com
	";
    send_sms($number, $msg);
}

function send_sms_expire($number, $day)
{

    $msg = "کاربر گرامی \n جهت تمدید آگهی خود به سایت دکورنما مراجعه نمایید. \n
	www.decornama.com
	";
    $res = send_sms($number, $msg);
    echo '<pre/>';
    echo '<br/>' . $number;
    print_r($res);


}


function arrayToTag($input)
{
    $export = '';
    if (count($input) > 0) {
        $export = implode(',', $input);
        //$export = ',' . $export . ',';
    }
    //$sql=substr($sql,0,-1);
    return $export;
}

function tagToArray($input)
{
    $export = explode(',', $input);
    $export = array_filter($export, 'strlen');
    return $export;
}

function create_thumb($image1_path, $address = '', $with_box = 300, $heghit_box = 200)
{
    // get image size and type
    //echo '<br/> base='.$image1_path.'<br/> ';
    list($width1, $height1, $image1_type) = getimagesize($image1_path);

    if ($width1 == '') {
        return;

    }
    // prepare thumb name in the same directory with prefix 'tn'

    if ($address == '') {
        $image2_path = dirname($image1_path) . '/tumb/tn_' . basename($image1_path);
    } else {
        $image2_path = $address;
    }

    // make image smaller if doesn't fit to the with_box
    if ($width1 > $with_box || $height1 > $heghit_box) {
        // set the largest dimension


        // calculate smaller thumb dimension (proportional)
        if ($width1 < $height1) {
            $width2 = $height2 = $heghit_box;
            $width2 = round(($heghit_box / $height1) * $width1);
        } else {
            $width2 = $height2 = $with_box;
            $height2 = round(($with_box / $width1) * $height1);
        }

        // set image type, blending and set functions for gif, jpeg and png
        switch ($image1_type) {
            case IMAGETYPE_PNG:
                $img = 'png';
                $blending = false;
                break;
            case IMAGETYPE_GIF:
                $img = 'gif';
                $blending = true;
                break;
            case IMAGETYPE_JPEG:
                $img = 'jpeg';
                break;
        }
        $imagecreate = "imagecreatefrom$img";
        $imagesave = "image$img";

        // initialize image from the file
        $image1 = $imagecreate($image1_path);

        // create a new true color image with dimensions $width2 and $height2
        $image2 = imagecreatetruecolor($width2, $height2);

        // preserve transparency for PNG and GIF images
        if ($img == 'png' || $img == 'gif') {
            // allocate a color for thumbnail
            $background = imagecolorallocate($image2, 0, 0, 0);
            // define a color as transparent
            imagecolortransparent($image2, $background);
            // set the blending mode for thumbnail
            imagealphablending($image2, $blending);
            // set the flag to save alpha channel
            imagesavealpha($image2, true);
        }

        // save thumbnail image to the file
        imagecopyresampled($image2, $image1, 0, 0, 0, 0, $width2, $height2, $width1, $height1);
        $imagesave($image2, $image2_path);
        //echo '***<br/>'.$image2_path.'<br/>' ;

    } else {
        echo 'else';
        switch ($image1_type) {
            case IMAGETYPE_PNG:
                $img = 'png';
                $blending = false;
                break;
            case IMAGETYPE_GIF:
                $img = 'gif';
                $blending = true;
                break;
            case IMAGETYPE_JPEG:
                $img = 'jpeg';
                break;
        }
        $imagecreate = "imagecreatefrom$img";
        $imagesave = "image$img";

        // initialize image from the file
        $image1 = $imagecreate($image1_path);

        // create a new true color image with dimensions $width2 and $height2
        $image2 = imagecreatetruecolor($width1, $height1);
        echo 'else1';

        // preserve transparency for PNG and GIF images
        if ($img == 'png' || $img == 'gif') {
            // allocate a color for thumbnail
            $background = imagecolorallocate($image2, 0, 0, 0);
            // define a color as transparent
            imagecolortransparent($image2, $background);
            // set the blending mode for thumbnail
            imagealphablending($image2, $blending);
            // set the flag to save alpha channel
            imagesavealpha($image2, true);
        }
        //echo 'else2';

        // save thumbnail image to the file
        imagecopyresampled($image2, $image1, 0, 0, 0, 0, $width1, $height1, $width1, $height1);
        //echo 'else3';

        $imagesave($image2, $image2_path);
        //echo 'else4***<br/>'.$image2_path.'else4<br/>' ;
        //copy($image1_path, $image2_path);
    }
}

function shortText($text, $size)
{
    $temp = substr($text, 0, $size);
    $temp1 = strrpos($temp, ' ', 1);
    $post = substr($text, 0, $temp1);
    return $post . '...';
}
function adminShortText($text, $size)
{
    $temp = substr($text, 0, $size);

    $temp1 = strrpos($temp, ' ', 1);
    if(!$temp1=== true )
    {
        return $temp;
    }
    $post = substr($text, 0, $temp1);

    return $post;
}
function site($link)
{
    if (strpos($link, 'http://') === false) {
        return 'http://' . $link;
    }
    return $link;
}


function send_sms($number, $msg)
{
    try {
        $client = new \SoapClient('http://sms-webservice.ir/v1/v1.asmx?WSDL');

        $parameters['Username'] = "09357300455";
        $parameters['PassWord'] = "1163740";
        $parameters['SenderNumber'] = '500020307300';
        $parameters['RecipientNumbers'] = array($number);
        $parameters['MessageBodie'] = "$msg";
        $parameters['Type'] = 1;
        $parameters['AllowedDelay'] = 0;

        $res = $client->GeCredit($parameters);

        //echo $res->GeCreditResult;
        //echo '<pre/>';
        //echo '<br/>';
        //print_r($res);

        $res = $client->SendMessage($parameters);
        return $res;
        print_r($res);
        die();
        foreach ($res->SendMessageResult as $r)
            echo $r;
    } catch (SoapFault $ex) {
        echo $ex->faultstring;
    }
    return;
    die();
    //echo '<pre/>';
    $options = array(
        'login' => SMS_USER,
        'password' => SMS_PASSWORD
    );
    $client = new SoapClient('http://sms.ako.ir/webservice/?WSDL', $options);
    $messageId = $client->send($number, $msg, '44285822');
    sleep(2);
    //print ($client->deliveryStatus($messageId));
    //var_dump($client->accountInfo());
    return;
}

class clsLinkOut
{

    public $mainMenu = '';

    function get_parent($index)
    {
        global $conn;

        $sql = "
					SELECT
						`link`.*
					FROM link
					WHERE
						`link`.`id` = '$index' ";
        $tree_rs = $conn->Execute($sql);
        if (!$tree_rs) {
            showErrorMsg($conn->ErrorMsg());
        }

        if (!$tree_rs->RecordCount()) {
            return;
        }
        while (!$tree_rs->EOF) {
            $this->mainMenu[$tree_rs->fields['id']] = $tree_rs->fields;
            //$actionLink =	'index.php?component=content&action=showList&category='.$tree_rs->fields['id'];
            ///$this->mainMenu[$tree_rs->fields['id']]['actionLink']=$actionLink;

            if ($tree_rs->fields['parent_id'] != 0) {
                $this->get_parent($tree_rs->fields['parent_id']);
            }

            $tree_rs->MoveNext();

        }
        return $this->mainMenu;

    }

}


function meta_keyword_addUnderline($key)
{
    $key = str_replace(' ', '-', $key);
    return $key;
}

function meta_keyword_removeUnderline($key)
{
    $key = str_replace('-', ' ', $key);
    return $key;
}

function linkIn($link)
{
    global $conn, $VENUS;
    $surceLink = $link;
    //echo '<pre/>';
    //print_r($link);
    $sql = "
				SELECT
				`link`.*
				FROM
				`link`
				WHERE
				 `link`.`link` = '$link' or  `link`.`link` = '" . $link . "/' ";

    $rs = $conn->Execute($sql);
    if (!$rs) {
        showErrorMsg($conn->ErrorMsg());
    }


    if ($rs->RecordCount()) {

        $VENUS['component']['parent_id'] = $rs->fields['parent_id'];
        $VENUS['component']['id'] = $rs->fields['id'];

        $VENUS['component']['meta_keyword'] = $rs->fields['meta_keywords'];
        $VENUS['component']['ads_category'] = $rs->fields['ads_category'];

        //echo '<pre/>';
        if ($rs->fields['meta_keywords'] == '') {
            $VENUS['component']['meta_keyword'] = META_KEYWORDS;
        }
        $VENUS['component']['meta_keyword'] = str_replace("\n", ',', $VENUS['component']['meta_keyword']);
        $VENUS['component']['meta_keyword'] = $VENUS['component']['meta_keyword'];
        $VENUS['component']['date'] = $rs->fields['date'];

        $VENUS['component']['browser_title'] = $rs->fields['browser_title'];
        $VENUS['component']['keywords'] = $rs->fields['keywords'];
        $VENUS['component']['bread_crumb'] = $rs->fields['bread_crumb'];

        //$VENUS['component']['keywords']=explode("\n",$rs->fields['keywords']);
        //print_r($VENUS['component']['keywords']);
        //die();

        if ($rs->fields['browser_title'] == '') {
            $VENUS['component']['browser_title'] = BROWSER_TITLE . '-' . $rs->fields['title'];
        }
        $VENUS['component']['meta_description'] = trim($rs->fields['meta_description']);
        if ($rs->fields['meta_description'] == '') {
            $VENUS['component']['meta_description'] = META_DESCRIPTION;
        }


        $VENUS['link_id'] = $rs->fields['id'];

        return $rs->fields['component'] . $rs->fields['action'];
    } else {
        return $surceLink;
    }


    /*

        global $conn ,$VENUS , $PARAM;
        $surceLink=$link;



        $sql	= "
                    SELECT
                    `link`.*
                    FROM
                    `link`
                    WHERE
                     `link`.`link` = '$link' ";

        $rs= $conn->Execute($sql);
        if(!$rs)
        {
            showErrorMsg($conn->ErrorMsg());
        }


        if($rs->RecordCount()){

            $VENUS['link_id']=$rs->fields['id'];

            return $rs->fields['component'].$rs->fields['action'];
        }else
        {


            $linkList=explode('/',$link);
            $linkList=array_filter($linkList,'strlen');
            $linkList=implode('/',$linkList);
            $linkList=explode('/',$linkList);
            $slash='';
            if(substr($surceLink,-1,1)=='/')
            {
                $slash='/';
            }

            $link=$linkList[count($linkList)-1].$slash;
            $sql	= "
                        SELECT
                        `link`.*
                        FROM
                        `link`
                        WHERE
                         `link`.`link` = '$link' ";

            $rs= $conn->Execute($sql);
            if(!$rs)
            {
                showErrorMsg($conn->ErrorMsg());
            }
            if($rs->RecordCount()){

            $VENUS['link_id']=$rs->fields['id'];
            return $rs->fields['component'].$rs->fields['action'];



            }
            return  $surceLink;
        }

        */


}

//************************************************************
function linkOut($link)
{

    global $conn, $VENUS;
    //echo '<pre/>';
    //echo $action;
    //print_r($link);
    /*$slash='';
    if(substr($link,-1)=='/')
    {
        $slash='/';
    }*/

    $linkList = explode('/', $link);
    //print_r($linkList);
    $action = '';
    if (count($linkList) > 1) {

        $action = substr($link, strlen($linkList[0]) + 1);
    }
    $sql = "
				SELECT
				`link`.*
				FROM
				`link`
				WHERE
				`link`.`component` = '{$linkList['0']}/'	AND action='$action' ";

    $rs = $conn->Execute($sql);
    if (!$rs) {
        showErrorMsg($conn->ErrorMsg());
    }

    if ($rs->RecordCount()) {

        if ($rs->fields['type'] == 1) {
            $linkOut = new clsLinkOut();
            $linkOut->mainMenu = '';
            $linkOut->get_parent($rs->fields['id']);
            //echo '<pre/>';
            foreach ($linkOut->mainMenu as $key => $menu) {
                $seo_action = $menu['link'] . $seo_action;
            }
        } else {
            $seo_action = $rs->fields['link'];

        }
        if ($seo_action == INDEX_URL) {
            //echo $seo_action.'<br/>'.INDEX_URL;

            $seo_action = '';
        }
        return $seo_action;
    } else {
        return $link;
    }

}

//
function VENUS_TEMPLATES($component, $action)
{
//------------------------------component template makhsos darad ya khir---------------------------------

    global $PARAM, $conn, $VENUS;


    $sql = "
					SELECT
						`template`.* FROM`template`
					WHERE
						`template`.`component_name` =  '" . $component . "'
					AND	`template`.`action` =  '" . $action . "'";

    $VENUS['TEMPLATE_RS'] = $conn->Execute($sql);

    if (!$VENUS['TEMPLATE_RS']) {
        showErrorMsg($conn->ErrorMsg());
    }
}

function VENUS_TEMPLATES_BOX($component, $action)
{
//------------------------------component template makhsos darad ya khir---------------------------------
    global $PARAM, $conn, $VENUS;

    $sql = "
					SELECT
						`template_box`.* FROM`template_box`
					WHERE
						`template_box`.`component_name` =  '" . $component . "'
					AND	`template_box`.`action` =  '" . $action . "'";

    $VENUS['TEMPLATE_BOX_RS'] = $conn->Execute($sql);

    if (!$VENUS['TEMPLATE_BOX_RS']) {
        showErrorMsg($conn->ErrorMsg());
    }
}

function VENUS_MODULS($id)
{
    global $PARAM, $conn, $VENUS;

    //print_r($VENUS['component']['name']);
    //die();
    if ($VENUS['component']['module'] != '-1') {
        $sql = "
					SELECT
					  `module_component`.*
					FROM
					  `module_component`
					WHERE
					  `module_component`.`status` = '1' AND component LIKE '%,{$VENUS['component']['name']},%' AND
					 (`module_component`.`linke_id` = '*' OR linke_id LIKE '%,$id,%') AND disable_linke_id NOT LIKE '%,$id,%' ORDER BY sort";


        $VENUS['MODULS_RS'] = $conn->Execute($sql);
        if (!$VENUS['MODULS_RS']) {
            showErrorMsg($conn->ErrorMsg());
        }


    } else {

        $VENUS['MODULS_RS'] = '-1';

    }
    //return;
    //*********************
    //echo $VENUS['MODULS_RS']->EOF;
    if ($VENUS['MODULS_RS']->EOF != -1) {
        while (!$VENUS['MODULS_RS']->EOF) {

            //ECHO $VENUS['MODULS_RS']->fields[positions];
            //$VENUS['module']['TITLE']='';
            //$VENUS['MODULS_RS']->fields[action]
            if (file_exists(MODULE_DIR . $VENUS['MODULS_RS']->fields['module_type'] . "/index.php")) {

                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['id'] = $VENUS['MODULS_RS']->fields['id'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['module_name'] = $VENUS['MODULS_RS']->fields['module_name'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['module_type'] = $VENUS['MODULS_RS']->fields['module_type'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['box'] = $VENUS['MODULS_RS']->fields['box'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['sort'] = $VENUS['MODULS_RS']->fields['sort'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['positions'] = $VENUS['MODULS_RS']->fields['positions'];
                $VENUS['MODULS'][$VENUS['MODULS_RS']->fields[positions]][$VENUS['MODULS_RS']->fields['id']]['title'] = $VENUS['MODULS_RS']->fields['title'];

            } else {
                //echo 'no module';
            }

            $VENUS['MODULS_RS']->MoveNext();
        }
        return;

    }


}

//

function attachment($storeFileName, $formName, $path, $MAX_SIZ = 100000)
{
    global $conn, $member_info;

    define("MAX_SIZE", "$MAX_SIZ");

    $file = $_FILES[$formName]['name'];
    if ($file) {
        $filename = stripslashes($_FILES[$formName]['name']);
        $extension = GetPicExtension($filename);
        $extension = strtolower($extension);

        $size = filesize($_FILES['$formName']['tmp_name']);

        /*if (($size > MAX_SIZE*1024) )
        {
            return('حجم فایل ارسالی مجاز نمی باشد');
            //$this->showForm("حجم عکس زیاد است");
            die();
        }	*/
        $newname = $path . $storeFileName . $extension;
        if (file_exists($newname)) {
            $err = 'عکس با نام ' . $storeFileName . ' قبلا در سیستم ذخیره شده است لطفا نام جدید انتخاب نمایید.';
            return ($err);
            die();
        }

        if (!move_uploaded_file($_FILES[$formName]['tmp_name'], $newname)) {
            return ('ارسال  با شکست مواجه شد');
            die();
        } else {
            return 1;
        }

    } else {
        //if($_REQUEST['action'] == 'addExtraPic')
        //{
        //redirectPage($_SERVER['PHP_SELF'] . "?action=show&id=".$cat_id  ,"عملیات ناتمام");
        return ('لطفا فایل را وارد نمایید.');
        //}
    }
    die();
}

//
//

function attachmentEXT($storeFileName, $formName, $path, $MAX_SIZ = 100000)
{
    global $conn, $member_info;

    define("MAX_SIZE", "$MAX_SIZ");

    $file = $_FILES[$formName]['name'];
    if ($file) {
        $filename = stripslashes($_FILES[$formName]['name']);
        //$extension  = GetPicExtension($filename);
        //$extension  = strtolower($extension);

        $size = filesize($_FILES['$formName']['tmp_name']);

        /*if (($size > MAX_SIZE*1024) )
        {
            return('حجم فایل ارسالی مجاز نمی باشد');
            //$this->showForm("حجم عکس زیاد است");
            die();
        }	*/
        $newname = $path . $storeFileName;
        if (file_exists($newname)) {
            $err = 'عکس با نام ' . $storeFileName . ' قبلا در سیستم ذخیره شده است لطفا نام جدید انتخاب نمایید.';
            return ($err);
            die();
        }

        if (!move_uploaded_file($_FILES[$formName]['tmp_name'], $newname)) {
            return ('ارسال  با شکست مواجه شد');
            die();
        } else {
            return 1;
        }

    } else {
        //if($_REQUEST['action'] == 'addExtraPic')
        //{
        //redirectPage($_SERVER['PHP_SELF'] . "?action=show&id=".$cat_id  ,"عملیات ناتمام");
        return ('لطفا فایل را وارد نمایید.');
        //}
    }
    die();
}

//
function CoursesList()
{

    global $conn, $member_info;

    $member_id = $member_info['member_id'];

    $sql = "
					SELECT
					  `r_m_c_l`.*, `courses`.`name`
					FROM
					  `r_m_c_l` LEFT JOIN
					  `courses` ON `r_m_c_l`.`courses_id` = `courses`.`id`
					WHERE
					  `r_m_c_l`.`member_id` = '$member_id'
					GROUP BY
					  `r_m_c_l`.`courses_id`, `courses`.`date`
					ORDER BY
					  `courses`.`date` DESC";

    $GetAll_rs = $conn->Execute($sql);
    if (!$GetAll_rs) {
        showErrorMsg($conn->ErrorMsg());
    }
    return $GetAll_rs;

    die();
}

function display_filesize($filesize)
{


    if (is_numeric($filesize)) {

        $decr = 1024;
        $step = 0;

        $prefix = array('بایت', 'کیلو بایت', 'مگا بایت', 'گیگا بایت', 'ترا بایت', 'پارا بایت');


        while (($filesize / $decr) > 0.9) {
            $filesize = $filesize / $decr;
            $step++;
        }
        return round($filesize, 2) . ' ' . $prefix[$step];
    } else {

        return 'NaN';

    }

}

function GetSiteHelper()
{
    global $conn;

    $sql = "SELECT * FROM site_helper";
    $sitehelper_rs = $conn->Execute($sql);

    if (!$sitehelper_rs) {
        showErrorMsg($conn->ErrorMsg());
    }
    $sitehelper_rs->Move(0);
    $i = 1;
    while (!$sitehelper_rs->EOF) {

        $sitehelper[$i] = $sitehelper_rs->fields['id'];
        $i++;
        $sitehelper_rs->MoveNext();
    }
    $i = mt_rand(1, $i - 1);

    return ($sitehelper[$i]);
}

function generatePassword($length = 9)

{

    // start with a blank password
    $password = "";
    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it

    $possible = "BCDFGHJKLMNPQRTVWXYZ";
    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;
    // add random characters to $password until $length is reached
    while ($i < $length) {
        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength - 1), 1);
        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }
    // done!
    return $password;
}

function generatePasswordNumber($length = 9)
{
    // start with a blank password
    $password = "";
    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "21346789";
    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);
    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }
    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {
        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength - 1), 1);
        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }

    // done!

    return $password;

}

function redirectPage($page, $message)
{

    global $conn, $messageStack;

    ?>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script language="javascript">

            setTimeout("window.location='<?=$page ?>'", 1500);
        </script>
        <style>
            body {
                font-family: Tahoma, Arial, Verdana, Helvetica, sans-serif;
                background: url(<?=TEMPLATE_DIR?>images/background.png);
                line-height: 30px;
                font-size: 12px
            }

            .a {
                background: url(<?=TEMPLATE_DIR?>images/back_light.png) bottom repeat-x #fff;
                border: 3px solid #ccc;
                width: 500px;
                margin-top: 10%;
                position: relative;
                padding-left: 200px;
                text-align: left;
                border-radius: 5px;
                -moz-border-radius: 5px;
                -o-border-radius: 5px;
                -webkit-border-radius: 5px;
            }

            a {
                color: #903;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
    <center>
        <div class="a"><br/>
            <?
            //if ($messageStack->size('redirect') > 0) {
            //echo $messageStack->output('redirect');
            //}
            //else
            //{

            //}
            ?>
            <img src="<?php echo RELA_DIR . 'templates/images/logo.png' ?>" align="left"
                 style="position:absolute; left:0; padding-left:40px;">

            <div style="direction:rtl; text-align:right;padding-right:100px;">
                <?
                echo $message;
                ?>
            </div>
            <div style="clear:both"></div>
            <div style="direction:rtl;text-align:right;padding-right:100px;"><a href="<?= $page ?>">در صورتی که به طور
                    اتوماتیک هدایت نشدید اینجا کلیک نمایید.</a> <img
                    src="<?php echo RELA_DIR . 'templates/images/ajax-loader.gif' ?> "></div>
            <div style="clear:both"></div>
            <br>
        </div>
    </center>
    </body>
    </html>
    <?php
    die();
}


function GetExtension($str)

{

    $i = strrpos($str, ".");

    if (!$i) {
        return "";
    }

    $l = strlen($str) - $i;

    $ext = substr($str, $i + 1, $l);

    return $ext;

}


function sendmail($email, $subject, $body, $header = '')

{

    include_once(ROOT_DIR . "common/phpmailer/class.phpmailer.php");

    //set_time_limit(3000);

    $headers = "MIME-Version: 1.0\r\n";

    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    $headers .= "$header\r\n" . "Reply-To: " . SMTP_USERNAME . "\r\n" . "X-Mailer: PHP/" . phpversion();


    $mail = new PHPMailer();


    $mail->IsSMTP();

    $mail->Host = SMTP_SERVER;

    $mail->SMTPAuth = true;     // turn on SMTP authentication


    $mail->Username = SMTP_USERNAME;  // SMTP username

    $mail->Password = SMTP_PASSWORD; // SMTP password

    $mail->From = SMTP_USERNAME;

    $mail->FromName = SMTP_SENDER;

    $mail->IsHTML(true);

    $mail->SetLanguage("en", ROOT_DIR . "common/phpmailer/");

    $mail->Subject = $subject;

    $mail->Body = $body;

    $mail->AltBody = $body;

    $mail->ClearAddresses();

    $mail->AddAddress($email);


    if (!$mail->Send()) {
        echo "<div class='fadeout'>Message was not sent";
        echo "Mailer Error: " . $mail->ErrorInfo . "</div>";
        // print_r($mail);
        return 0;
    }
    //echo '<pre/>';
    //print_r($mail);

    return 1;

}

////here convert to  number in persian
function Convertnumber2persian($srting)
{
    $num0 = "&#1776;";
    $num1 = "&#1777;";
    $num2 = "&#1778;";
    $num3 = "&#1779;";
    $num4 = "&#1780;";
    $num5 = "&#1781;";
    $num6 = "&#1782;";
    $num7 = "&#1783;";
    $num8 = "&#1784;";
    $num9 = "&#1785;";

    $stringtemp = "";
    $len = strlen($srting);
    for ($sub = 0; $sub < $len; $sub++) {
        if (substr($srting, $sub, 1) == "0") $stringtemp .= $num0;
        elseif (substr($srting, $sub, 1) == "1") $stringtemp .= $num1;
        elseif (substr($srting, $sub, 1) == "2") $stringtemp .= $num2;
        elseif (substr($srting, $sub, 1) == "3") $stringtemp .= $num3;
        elseif (substr($srting, $sub, 1) == "4") $stringtemp .= $num4;
        elseif (substr($srting, $sub, 1) == "5") $stringtemp .= $num5;
        elseif (substr($srting, $sub, 1) == "6") $stringtemp .= $num6;
        elseif (substr($srting, $sub, 1) == "7") $stringtemp .= $num7;
        elseif (substr($srting, $sub, 1) == "8") $stringtemp .= $num8;
        elseif (substr($srting, $sub, 1) == "9") $stringtemp .= $num9;
        else $stringtemp .= substr($srting, $sub, 1);

    }
    return $stringtemp;

}///end conver to number in persian

function convertDateToItem($date)
{

    list($date, $time) = explode(" ", $date);
    $ret = $date . 'T' . $time . '+03:30';
    return $ret;
}

function convertDate($date)
{

    include_once("jdf.php");


    list($date, $time) = explode(" ", $date);


    list($g_y, $g_m, $g_d) = explode("-", $date);

    list($j_y, $j_m, $j_d) = gregorian_to_jalali($g_y, $g_m, $g_d);

    list($h, $m, $s) = explode(":", $time);


    if (strlen($time = 0)) {
        $date = "$j_y/$j_m/$j_d";

    } else {
        $date = "$j_y/$j_m/$j_d   $h : $m : $s";
    }

    //$date = "$j_d-$j_m-$j_y";

    return Convertnumber2farsi($date);
}

function decodDate($date)
{

    include_once("jdf.php");

    //echo $date;
    //die();
    list($date, $time) = explode(" ", $date);


    list($g_y, $g_m, $g_d) = explode("-", $date);

    list($j_y, $j_m, $j_d) = jalali_to_gregorian($g_y, $g_m, $g_d);


    list($h, $m, $s) = explode(":", $time);

    //echo 'time='.$time;
    //die();
    if (strlen($time = 0)) {
        $date = "$j_y-$j_m-$j_d";

    } else {
        $date = "$j_y-$j_m-$j_d   $h : $m : $s";
    }
    //$date = "$j_d-$j_m-$j_y";

    return $date;

}


function round_func($x)

{

    //echo $x ."<BR>";

    $len = strlen($x);

    //echo $length."<BR>";

    //echo substr($x,$len-($len-1),1);

    if (substr($x, $len - ($len - 1), 1) < 5) {

        return (substr($x, 0, $len - ($len - 1)) . 5) * pow(10, $len - 2);

    } else {

        //return 1000;

        return round($x, ((strlen($x)) * -1));

    }

}

function handleSql($theValue)
{
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    return $theValue;

}

function handleData($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
    // echo htmlentities($row_Recordset1['priority'], ENT_COMPAT, 'utf-8');
    //function test_input($data) {
    /* $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;*/
}

function handleCommentsql($theValue)
{

    $theValue = str_replace('<script', '', $theValue);
    $theValue = str_replace("'", '', $theValue);
    $theValue = str_replace("<", ' ', $theValue);
    $theValue = str_replace(">", ' ', $theValue);
    $theValue = str_replace("chr", ' ', $theValue);
    $theValue = str_replace("ord", ' ', $theValue);
    return handleSql($theValue);

}


function checkSite($site)

{

    if (eregi("^[a-z\-\.]+[a-z0-9_\-]+\.[a-z0-9_\-\.]+$", $site)) {

        return 0;

    } else {

        return 1;

    }

}


function handleSQLData($data)
{
    $myData = str_replace("'", "''", $data);
    if (DB_TYPE == "mysql") {
        $myData = str_replace("\\", "\\\\", $myData);
    }
    return $myData;
}


function checkSystemStatus()

{

    if (SYSTEM_STATUS == 1) {

        include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.stop.php");

        die();

    }

}


function checkMail1($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 0;
    } else {
        return 1;
    }
}

function checkMail($email)
{

    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
        return 0;
    } else {
        return 1;
    }
}


function checkAscii($ascii)

{

    if (ereg("^[a-zA-Z0-9\.\,\+\!\@\#\$\%\^\&\*\(\)\:\~\/]+$", $ascii)) {

        return 0;


    } else {

        return 1;

    }

}


function checkUser($ascii)

{

    return 0;

    if (ereg("^[a-zA-Z0-9\-\_]+$", $ascii)) {
        return 0;

    } else {

        return 1;

    }

}


function checkAlpha($alpha)

{

    if (ereg("^[a-zA-Z ]+$", $alpha)) {

        return 0;

    } else {

        return 1;

    }

}

function checkComment($pa = NULL)
{
    //return 1;
    str_replace('chr', '', $p);
    if (strlen($pa) == 0) return 1;
    //if(preg_match("/^([ا آ ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ؟ ه ی . ، - ! ( ) 0-9 a-z A-Z `| ? :  \" \[ \] ])+$/",$pa))
    //$t="ا آ ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ؟ ه ی . ، - ! ؟ \ a-z A-Z ()0-9\"\'\.\,\|\!\&\*\+\-\:\=\?\_\(\)\£\s";
    $t = "ا آ ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ؟ ه یa-zA-Z0-9\"\'\.\,\|\!\&\*\+\-\=\?\_\(\)\£\s:";

    //check for illegal characters - if none add the char to the finished profile
    $regmatchex = "/[^a-zA-Z0-9\"\'\.\,\!\&\*\+\-\=\?\_\(\)\£\s]/";
    if (preg_match("/^([$t])+$/", $pa)) {

        //if(preg_match("/^([آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]/", $_POST['name']))
        return 1;
    } else {
        return 0;
    }
}

function checkLength($str, $length)

{

    if (strlen($str) > $length) {

        return -1;

    }


    return 0;

}


function checkNumeric($num)

{

    if (ereg("^[0-9]+$", $num)) {

        return 0;

    } else {

        return 1;

    }

}


function checkDigit($digit)

{

    /*if(ereg("^[0-9]+$", $digit))

    {

        return 0;

    }else {

        return 1;

    }

    */

    return 0;

}


function getDatetime()

{

    return date("Y-m-d H:i:s");

}


function getDateo()

{

    return date("Y-m-d");

}


function generate_password()

{

    $fillers = "1234567890!@#$%&*-_=+^";

    $fillers .= date('h-i-s, j-m-y, it is w Day z ');

    $fillers .= "123!@#$%&*-_4567!@#$%&*-_890=+^";

    $temp = md5($fillers);

    $temp = substr($temp, 5, 10);


    return $temp;

}


/**************************************************************************************************/

/*  Interface operation																			  */

/**************************************************************************************************/


function initPage($rs, $pageSize, &$currentPage, &$pageCount, &$totalRecord)

{

    $totalRecord = $rs->RecordCount();

    $pageCount = $totalRecord / $pageSize;

    if (!is_int($pageCount)) {

        $pageCount = intval($pageCount);

        $pageCount += 1;

    }


    $currentPage = intval($currentPage);

    if ($currentPage < 1) {

        $currentPage = 1;

    }

    if ($currentPage > $pageCount)

        $currentPage = $pageCount;

}


function showPageButton($currentPage, $pageCount, $totalRecord, $webaddress)

{

    ?>
    <div class="pagination">
        <? if ($currentPage > 1) {
            if ($currentPage < $pageCount) { ?>
                <a href="<?= $webaddress ?>&currentPage=1" title="ابتدا">&laquo; ابتدا</a><a
                    href="<?= $webaddress ?>&currentPage=<?= $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه
                    قبلی</a>
                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="<?= $webaddress ?>&currentPage=<?= $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>
                <a href="<?= $webaddress ?>&currentPage=<?= $pageCount ?>" title="انتها">انتها &raquo;</a>
            <?php } else { ?>
                <a href="<?= $webaddress ?>&currentPage=1" title="ابتدا">&laquo; ابتدا</a><a
                    href="<?= $webaddress ?>&currentPage=<?= $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه
                    قبلی</a>
                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a><a href="javascript:;"
                                                                                 title="انتها">انتها &raquo;</a>
            <?php }
        } else {
            if ($currentPage < $pageCount) { ?>
                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a><a href="javascript:;" title="صفحه قبلی">&laquo;
                    صفحه قبلی</a>
                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="<?= $webaddress ?>&currentPage=<?= $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>
                <a href="<?= $webaddress ?>&currentPage=<?= $pageCount ?>" title="انتها">انتها &raquo;</a>
            <?php } else { ?>
                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a><a href="javascript:;" title="صفحه قبلی">&laquo;
                    صفحه قبلی</a>
                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a><a href="javascript:;"
                                                                                 title="انتها">انتها &raquo;</a>
            <?php }
        }   //echo $currentPage . "/" . $pageCount . "صفحه مجموع: " . $totalRecord . " رکورد";
        ?>
    </div>
    <div class="clear"></div>
<? }

function showPageButton1($currentPage, $pageCount, $totalRecord, $webaddress)
{ ?>
    <div class="pagination">
        <? if ($currentPage > 1) {
            if ($currentPage < $pageCount) { ?>
                <a href="<?= $webaddress ?>&currentPage=1" title="ابتدا">&laquo; ابتدا</a><a
                    href="<?= $webaddress ?>&currentPage=<?= $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه
                    قبلی</a>
                <? for ($i = $currentPage - 2; $i < $currentPage + 3; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="<?= $webaddress ?>&currentPage=<?= $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>
                <a href="<?= $webaddress ?>&currentPage=<?= $pageCount ?>" title="انتها">انتها &raquo;</a>
            <?php } else { ?>
                <a href="<?= $webaddress ?>&currentPage=1" title="ابتدا">&laquo; ابتدا</a><a
                    href="<?= $webaddress ?>&currentPage=<?= $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه
                    قبلی</a>
                <? for ($i = $currentPage - 2; $i < $currentPage + 3; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a><a href="javascript:;"
                                                                                 title="انتها">انتها &raquo;</a>
            <?php }
        } else {
            if ($currentPage < $pageCount) { ?>
                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a><a href="javascript:;" title="صفحه قبلی">&laquo;
                    صفحه قبلی</a>
                <? for ($i = $currentPage - 2; $i < $currentPage + 3; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="<?= $webaddress ?>&currentPage=<?= $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>
                <a href="<?= $webaddress ?>&currentPage=<?= $pageCount ?>" title="انتها">انتها &raquo;</a>
            <?php } else { ?>
                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a><a href="javascript:;" title="صفحه قبلی">&laquo;
                    صفحه قبلی</a>
                <? for ($i = $currentPage - 2; $i < $currentPage + 3; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <a href="<?= ($i != $currentPage ? $webaddress . '&currentPage=' . $i : 'javascript:;') ?>"
                       class="number <?= ($i != $currentPage ? '' : 'current') ?>" title="<?= $i ?>">
                        <?= $i ?>
                    </a>
                <? } ?>
                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a><a href="javascript:;"
                                                                                 title="انتها">انتها &raquo;</a>
            <?php }
        }
        ?>
    </div>
    <div class="clear"></div>
<? }

function get_current_page(&$param, $url_main)
{

    $key = array_search('PAGE', $param);

    if (strlen($key) > 0) {
        $_GET['currentPage'] = $param[$key + 1];
        unset($param[$key]);
        unset($param[$key + 1]);
        $param = array_values($param);
    }

}

function showPageButtonSeo($currentPage, $pageCount, $totalRecord, $webaddress)
{
 /*
   <div class="row">
    <div class="col-sm-12 text-center">
      <ul class="pagination">


        <li class="active"><span>1</span></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">6</a></li>
        <li><a href="#">7</a></li>
        <li><a href="#">8</a></li>
        <li><a href="#">9</a></li>
        <li><a href="#">10</a></li>
        <li><a href="#">&gt;</a></li>
        <li><a href="#">&gt;|</a></li>
      </ul>
    </div>

  </div>
 */
    ?>
        <div class="row">
    <div class="col-sm-12 text-center">
      <ul class="pagination">
        <? if ($currentPage > 1) {
            if ($currentPage < $pageCount) { ?>

                <li>
                    <a href="<?= $webaddress ?>"><?="| &lt;";?></a>
                </li>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="<?= $webaddress ?>PAGE/<?= $currentPage - 1 ?>/"><?="&lt;";?></a>
                </li>

                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>

                    <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                        <a href="<?= ($i != $currentPage ? $webaddress . 'PAGE/' . $i . '/' : 'javascript:;') ?>"><?= $i ?></a>
                    </li>

                <? } ?>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="<?= $webaddress ?>PAGE/<?= $currentPage + 1 ?>/"><?="&gt;";?></a>
                </li>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="<?=$webaddress; ?>PAGE/<?= $pageCount ?>/"><?="&gt;|";?></a>
                </li>

            <?php } else { ?>

                <li>
                    <a href="<?=$webaddress; ?>"><?="| &lt;";?></a>
                </li>
                <li>
                    <a href="<?=$webaddress; ?>PAGE/<?= $currentPage - 1 ?>/"><?="&lt;";?></a>
                </li>

                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>

                    <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                        <a href="<?= ($i != $currentPage ? $webaddress . 'PAGE/' . $i . '/' : 'javascript:;') ?>"><?= $i ?></a>
                    </li>

                <? } ?>


                <li>
                    <a href="javascript:;"><?="&gt;";?></a>
                </li>

                <li>
                    <a href="javascript:;"><?="&gt;|";?></a>
                </li>


            <?php }
        } else {
            if ($currentPage < $pageCount) { ?>

                <li>
                    <a href="javascript:;"><?="| &lt;";?></a>
                </li>

                <li>
                    <a href="javascript:;"><?="&lt;";?></a>
                </li>

                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                    <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                        <a href="<?= ($i != $currentPage ? $webaddress . 'PAGE/' . $i . '/' : 'javascript:;') ?>"><?= $i ?></a>
                    </li>

                <? } ?>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="<?= $webaddress ?>PAGE/<?= $currentPage + 1 ?>/"><?="&gt;";?></a>
                </li>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="<?= $webaddress ?>PAGE/<?= $pageCount ?>/"><?="&gt;|";?></a>
                </li>

            <?php } else { ?>


                <li>
                    <a href="javascript:;"><?="| &lt;";?></a>
                </li>

                <li>
                    <a href="javascript:;"><?="&lt;";?></a>
                </li>


                <? for ($i = 1; $i < $pageCount + 1; $i++) {
                    if ($i < 1 || $i > $pageCount) continue; ?>
                      <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                          <a href="<?= ($i != $currentPage ? $webaddress . 'PAGE/' . $i . '/' : 'javascript:;') ?>"><?= $i ?></a>
                      </li>

                <? } ?>
                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="javascript:;"><?="&gt;";?></a>
                </li>

                <li class="<?=($i != $currentPage ? '' : 'active') ?>">
                    <a href="javascript:;"><?="&gt;|";?></a>
                </li>

            <?php }
        }
        ?>
        </ul>
    </div>
    </div>
<? }


function showErrorMsg($msg)

{

    global $conn;


    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");

    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");

    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");


    die();

}


function showAdminErrorMsg($msg)

{

    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.title.inc.php");

    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/system.error.php");

    include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/admin.tail.inc.php");


    die();

}


function showAlertMsg($msg)

{

    if ($msg != "") {

        ?>
        <script language="javascript">

            alert("<?=$msg ?>");

        </script>
        <?php

    }

}


function showWarningMsg($msg)

{

    if ($msg) {

        ?>
        <div class="notification png_bg">
            <div class="error"><a href="#" class="close"><img
                        src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/assets/img/cross_grey_small.png"
                        title="Close this notification" alt="close"/></a>

                <div>
                    <?= $msg ?>
                </div>
            </div>
        </div>
        <?php

    }

}


function banner($component_name)
{
    global $conn, $lang;

    $sql = "SELECT * FROM gallery_banner_component WHERE component_name='$component_name' ";
    $banner_rs = $conn->Execute($sql);
    if (!$banner_rs) {
        showErrorMsg($conn->ErrorMsg());
    }
    return $banner_rs->fields['pic_name'];

}


function GetPicExtension($str)
{
    return strrchr($str, '.');
}

function showWarningMsg1($msg)

{

    if ($msg) {

        ?>
        <div class="fadeout"><?php echo $msg ?></div>
        <?php

    }

}
$Persian_Number = str_replace(
array('0','1','2','3','4','5','6','7','8','9'),
array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'),
$English_Number
);

?>