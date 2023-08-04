<?php

require_once "ckeditor/ckeditor.php";
require_once "ckfinder/ckfinder.php";

if (!function_exists('CKEditor')) {
    function CKEditor()
    {
        $CKEditor = new CKEditor();
        //print_r_debug($CKEditor);
        $CKEditor->returnOutput = true;
        $CKEditor->config['language'] = "fa";
        $CKEditor->config['width'] = 560;
        $CKEditor->basePath = '../common/ckeditor/';
        CKFinder::SetupCKEditor($CKEditor, '../common/ckfinder/');
        $CKEditor->textareaAttributes = array("cols" => 40, "rows" => 10);
        return $CKEditor;
    }
}

if (!function_exists('view')) {
    function view($view = null, $data = [])
    {
        extract($data);
        if (is_array($data)) {
            extract($data);
        }

        return require ROOT_DIR . 'templates/' . CURRENT_SKIN . "/{$view}.php";
    }
}

if (!function_exists('dd')) {
    function dd($val, $die = true)
    {
        echo '<pre style="direction: ltr !important; text-align:left; background:black; color:greenyellow;  margin-bottom:1em;" >';
        print_r($val);
        echo '</pre>';



        if ($die)
            die();
    }
}

if (!function_exists('parseHtml')) {
    function parseHtml($path, $companyList)
    {
        ob_start();
        include $path;
        $email_html = ob_get_contents();
        ob_clean();
        flush();

        return $email_html;
    }
}

if (!function_exists('adminShortText')) {
    function  minimizeText($text, $size, $replacement)
    {
        $length = count($text);
        if ($length > 50) {
            $replacement = ' ' . $replacement;

            return substr_replace($text, $replacement, $size, $length);
        }

        return $text;
    }
}

function checkUppercase($string)
{
    if (preg_match('/[A-Z]/', $string) === 0) {
        return 0;
    }

    return 1;
}

function checkDateFormat($date)
{
    //match the format of the date
    if (preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $date, $parts)) {
        //check weather the date is valid of not
        if (checkdate($parts[2], $parts[3], $parts[1])) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function isValidDateTime($dateTime)
{
    if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) {
        if (checkdate($matches[2], $matches[3], $matches[1])) {

            return true;
        }
    }

    return false;
}

function checkBoxValue($value)
{
    if ($value == 'on') {
        $value = 1;
    } else {
        $value = 0;
    }

    return $value;
}

function serialNoCreator($prefix_serial_number)
{
    $serial_number = $prefix_serial_number . uniqid();

    return $serial_number;
}

function dateCreator()
{
    $creation_date = getdate();
    $creation_date = $creation_date['year'] . '-' . $creation_date['mon'] . '-' . $creation_date['mday'] . ' ' . $creation_date['hours'] . ':' . $creation_date['minutes'] . ':' . $creation_date['seconds'];

    return $creation_date;
}

function voucherCodeCreator()
{
    //$chars = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 16))

    $guid = '';
    $uid = uniqid('', true);
    $data = '';
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    if (substr($hash, 0, 1) == '0') {
        voucherCodeCreator();
    }
    $guid = substr($hash, 0, 4) .
        substr($hash, 8, 4) .
        substr($hash, 24, 4) .
        substr($hash, 20, 4);

    return $guid;
}

function display_filesize($filesize)
{
    if (is_numeric($filesize)) {
        $decr = 1024;
        $step = 0;

        $prefix = array('بایت', 'کیلو بایت', 'مگا بایت', 'گیگا بایت', 'ترا بایت', 'پارا بایت');

        while (($filesize / $decr) > 0.9) {
            $filesize = $filesize / $decr;

            ++$step;
        }

        return round($filesize, 2) . ' ' . $prefix[$step];
    } else {
        return 'NaN';
    }
}

function generatePassword($length = 9)
{
    // start with a blank password

    $password = '';
    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = 'BCDFGHJKLMNPQRTVWXYZ';
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
            ++$i;
        }
    }

    // done!
    return $password;
}

function generatePasswordNumber($length = 9)
{

    // start with a blank password

    $password = '';

    // define possible characters - any character in this string can be

    // picked for use in the password, so if you want to put vowels back in

    // or add special characters such as exclamation marks, this is where

    // you should do it

    $possible = '21346789';

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

            ++$i;
        }
    }

    // done!

    return $password;
}

function redirectPage($page, $message = '', $die = false)
{
    global $conn, $messageStack;

?>
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php if (!$die) : ?>
            <script language="javascript">
                setTimeout("window.location='<?php echo $page ?>'", 1500);
            </script>
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo RELA_DIR ?>/templates/template_tailwind/assets/css/style.css">
        <style>
            body {
                font-family: sans-serif;
                background: url('<?php echo TEMPLATE_DIR ?>images/background.png');
                background: #ccc;
                display: flex;
                direction: rtl;
                line-height: 30px;
            }

            .a {
                display: flex;
                align-items: center;
                justify-content: space-around;
                background: #ffffff;
                position: relative;
                text-align: right;
                margin: auto;
                max-width: 70%;
                padding: 1em 2em;
                border-radius: 5px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            a {
                color: #990033;
                font-size: 14px;
            }

            img {
                max-width: 150px;
            }

            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 80px;
                height: 9px;
            }

            .lds-ellipsis div {
                position: absolute;
                top: 0px;
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: black;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
            }

            .lds-ellipsis div:nth-child(1) {
                left: 8px;
                animation: lds-ellipsis1 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(2) {
                left: 8px;
                animation: lds-ellipsis2 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(3) {
                left: 32px;
                animation: lds-ellipsis2 0.6s infinite;
            }

            .lds-ellipsis div:nth-child(4) {
                left: 56px;
                animation: lds-ellipsis3 0.6s infinite;
            }

            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }

                100% {
                    transform: scale(1);
                }
            }

            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(0);
                }
            }

            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }

                100% {
                    transform: translate(24px, 0);
                }
            }
        </style>
    </head>

    <body>

        <div class="a">

            <img src="<?php echo RELA_DIR . 'templates/images/logo.png' ?>">

            <div style="padding-right:1em ;">


                <div style="font-weight: bold;">
                    <?php echo $message ?>
                </div>

                <?php if (!$die) : ?>
                    <small> در حال انتقال <div class="lds-ellipsis">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div></small>
                <?php endif; ?>
                <a href="<?php echo $page ?>">در صورت عدم انتقال خودکار به صفحه اصلی، روی این لینک کلیک کنید</a>

            </div>
        </div>
    </body>

    </html>

<?php
    die();
}

function GetExtension($str)
{
    $i = strrpos($str, '.');

    if (!$i) {
        return '';
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);

    return $ext;
}

function newSendMails($email = "", $subject, $body, $header = '')
{
    global $admin_info;
    require "PHPMailer-master/PHPMailerAutoload.php";

    //set_time_limit(3000);
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "$header\r\n" . "Reply-To: " . SMTP_USERNAME . "\r\n" . "X-Mailer: PHP/" . phpversion();

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = "mail.dabacenter.ir";
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;          // turn on SMTP authentication
    $mail->Username = 'projects@dabacenter.ir'; // SMTP username
    $mail->Password = "Daba123123Daba"; // SMTP password

    $mail->From = "projects@dabacenter.ir";

    $mail->CharSet = "utf-8";

    // $mail->FromName = $admin_info[ 'name' ] . " " . $admin_info[ 'family' ];
    $mail->FromName = 'Arash Nikbakht';
    $mail->IsHTML(true);
    $mail->SetLanguage("fa", ROOT_DIR . "common/PHPMailer-master/");
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->ClearAddresses();

    if ($email != "") {
        $mail->AddAddress($email);
    } else {
        $mail->AddAddress('arash.nykbakht@gmail.com');
    }

    $mail->AddBCC('arash.nykbakht@gmail.com');

    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}

function convertDate($date)
{
    include_once 'jdf.php';
    list($date, $time) = explode(' ', $date);
    list($g_y, $g_m, $g_d) = explode('-', $date);
    list($j_y, $j_m, $j_d) = gregorian_to_jalali($g_y, $g_m, $g_d);
    list($h, $m, $s) = explode(':', $time);
    $date = "$j_y/$j_m/$j_d";

    return $date;
}

function convertJToGDate($date)
{
    include_once 'jdf.php';
    $dateTime = explode('/', $date);
    $g_y = $dateTime[0];
    $g_m = $dateTime[1];
    $g_d = $dateTime[2];
    list($j_y, $j_m, $j_d) = jalali_to_gregorian($g_y, $g_m, $g_d);
    $j_m = $j_m < 10 ? '0' . $j_m : $j_m;
    $j_d = $j_d < 10 ? '0' . $j_d : $j_d;
    $date = "$j_y-$j_m-$j_d";

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

function handleData($data)
{
    return handleSQLData(trim(stripslashes($data)));
}

function checkSite($site)
{
    if (preg_match("^[a-z\-\.]+[a-z0-9_\-]+\.[a-z0-9_\-\.]+$", $site)) {
        return 0;
    } else {
        return 1;
    }
}

function handleSQLData($data)
{
    $myData = str_replace("'", "''", $data);
    if (DB_TYPE == 'mysql') {
        $myData = str_replace('\\', '\\\\', $myData);
    }

    return $myData;
}

function handleSql($theValue)
{
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists('mysql_real_escape_string') ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    return $theValue;
}

function checkSystemStatus()
{
    if (SYSTEM_STATUS == 1) {
        include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/system.stop.php';
        die();
    }
}

function checkMail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 0;
    } else {
        return 1;
    }
}

function inputCheckNumericId($ascii)
{
    if (preg_match('/^[0-9,]+$/i', $ascii)) {
        //^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+[\.a-zA-Z0-9]+$------>>>>/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/

        return 1;
    } else {
        return 0;
    }
}

function inputCheckEmails($ascii)
{
    if (preg_match("/^[a-zA-Z0-9@_.,\-]+$/i", $ascii)) {
        //^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+[\.a-zA-Z0-9]+$------>>>>/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/

        return 1;
    } else {
        return 0;
    }
}

function checkJoinMail($email)
{
    if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i", $email)) {
        //^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+[\.a-zA-Z0-9]+$------>>>>/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/

        return 0;
    } else {
        return 1;
    }
}

function checkAscii($ascii)
{
    if (preg_match("^[a-zA-Z0-9\.\,\+\!\@\#\$\%\^\&\*\(\)\:\~\/]+$", $ascii)) {
        return 0;
    } else {
        return 1;
    }
}

function checkUser($ascii)
{
    if (ereg("^[a-zA-Z0-9\-\_]+$", $ascii)) {
        return 0;
    } else {
        return 1;
    }
}

function checkDescription($alpha)
{
    if (preg_match("^[a-zA-Z0-9\s ]+$", $alpha)) {
        return 1;
    } else {
        return 0;
    }
}

function checkAlpha($alpha)
{
    if (preg_match('^[a-zA-Z ]+$', $alpha)) {
        return 0;
    } else {
        return 1;
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
    if (ereg('^[0-9]+$', $num)) {
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
    return date('Y-m-d H:i:s');
}

function getDateo()
{
    return date('Y-m-d');
}

function generate_password()
{
    $fillers = '1234567890!@#$%&*-_=+^';
    $fillers .= date('h-i-s, j-m-y, it is w Day z ');
    $fillers .= '123!@#$%&*-_4567!@#$%&*-_890=+^';
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
    if ($currentPage > $pageCount) {
        $currentPage = $pageCount;
    }
}

function showPageButton($currentPage, $pageCount, $totalRecord, $webaddress, $n = '')
{
?>
    <div class="pagination">
        <?php
        if ($currentPage > 1) {
            if ($currentPage < $pageCount) {
        ?>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=1" title="">&laquo; First</a>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $currentPage - 1 ?>" title="">&laquo; pre</a>
                <?php
                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }
                ?>
                    <a href="<?php echo ($i != $currentPage ? $webaddress . '&currentPage' . $n . '=' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>"><?php echo  $i ?></a>
                <?php

                }
                ?>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $currentPage + 1 ?>" title="">Next Page &raquo;</a>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $pageCount ?>" title="">Last &raquo;</a>
            <?php

            } else {
            ?>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=1" title="">&laquo; First</a>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $currentPage - 1 ?>" title="">&laquo; Previous Page</a>

                <?php
                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }
                ?>
                    <a href="<?php echo ($i != $currentPage ? $webaddress . '&currentPage' . $n . '=' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>" title=""><?php echo  $i ?></a>
                <?php

                }
                ?>
                <a href="javascript:;" title="">Next Page &raquo;</a>
                <a href="javascript:;" title="">Last &raquo;</a>
            <?php

            }
        } else {
            if ($currentPage < $pageCount) {
            ?>
                <a href="javascript:;" title="">&laquo; First</a>
                <a href="javascript:;" title="">&laquo; Previous Page</a>
                <?php
                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    //die('1');
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }
                ?>
                    <a href="<?php echo ($i != $currentPage ? $webaddress . '&currentPage' . $n . '=' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>"><?php echo  $i ?></a>
                <?php

                }
                ?>
                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $currentPage + 1 ?>" title="">Next Page &raquo;</a>

                <a href="<?php echo  $webaddress ?>&currentPage<?php echo  $n ?>=<?php echo  $pageCount ?>" title="">Last &raquo;</a>
            <?php

            } else {
            ?>
                <a href="javascript:;" title="">&laquo; First</a>
                <a href="javascript:;" title="">&laquo; Previous Page</a>
                <?php
                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }
                ?>
                    <a href="<?php echo ($i != $currentPage ? $webaddress . '&currentPage' . $n . '=' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>"><?php echo  $i ?></a>
                <?php

                }
                ?>
                <a href="javascript:;" title="">Next Page &raquo;</a>
                <a href="javascript:;" title="">Last &raquo;</a>
        <?php

            }
        }

        //echo $currentPage . "/" . $pageCount . "صفحه مجموع: " . $totalRecord . " رکورد";

        ?>

    </div> <!-- End .pagination -->

    <div class="clear"></div>

<?php

}

function showPageButtonSeo($currentPage, $pageCount, $totalRecord, $webaddress)
{
?>

    <div class="pagination">

        <?php

        if ($currentPage > 1) {
            if ($currentPage < $pageCount) {
        ?>

                <a href="<?php echo  $webaddress ?>PG-1" title="ابتدا">&laquo; ابتدا</a>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه قبلی</a>

                <?php

                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }

                ?>

                    <a href="<?php echo ($i != $currentPage ? $webaddress . 'PG-' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>" title="<?php echo  $i ?>"><?php echo  $i ?></a>

                <?php

                }

                ?>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $pageCount ?>" title="انتها">انتها &raquo;</a>

            <?php

            } else {
            ?>

                <a href="<?php echo  $webaddress ?>PG-1" title="ابتدا">&laquo; ابتدا</a>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $currentPage - 1 ?>" title="صفحه قبلی">&laquo; صفحه قبلی</a>

                <?php

                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }

                ?>

                    <a href="<?php echo ($i != $currentPage ? $webaddress . 'PG-' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>" title="<?php echo  $i ?>"><?php echo  $i ?></a>

                <?php

                }

                ?>

                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a>

                <a href="javascript:;" title="انتها">انتها &raquo;</a>

            <?php

            }
        } else {
            if ($currentPage < $pageCount) {
            ?>

                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a>

                <a href="javascript:;" title="صفحه قبلی">&laquo; صفحه قبلی</a>

                <?php

                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }

                ?>

                    <a href="<?php echo ($i != $currentPage ? $webaddress . 'PG-' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>" title="<?php echo  $i ?>"><?php echo  $i ?></a>

                <?php

                }

                ?>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $currentPage + 1 ?>" title="صفحه بعدی">صفحه بعدی &raquo;</a>

                <a href="<?php echo  $webaddress ?>PG-<?php echo  $pageCount ?>" title="انتها">انتها &raquo;</a>

            <?php

            } else {
            ?>

                <a href="javascript:;" title="ابتدا">&laquo; ابتدا</a>

                <a href="javascript:;" title="صفحه قبلی">&laquo; صفحه قبلی</a>

                <?php

                for ($i = $currentPage - 2; $i < $currentPage + 3; ++$i) {
                    if ($i < 1 || $i > $pageCount) {
                        continue;
                    }

                ?>

                    <a href="<?php echo ($i != $currentPage ? $webaddress . 'PG-' . $i : 'javascript:;') ?>" class="number <?php echo ($i != $currentPage ? '' : 'current') ?>" title="<?php echo  $i ?>"><?php echo  $i ?></a>

                <?php

                }

                ?>

                <a href="javascript:;" title="صفحه بعدی">صفحه بعدی &raquo;</a>

                <a href="javascript:;" title="انتها">انتها &raquo;</a>

        <?php

            }
        }

        //echo $currentPage . "/" . $pageCount . "صفحه مجموع: " . $totalRecord . " رکورد";

        ?>

    </div> <!-- End .pagination -->

    <div class="clear"></div>

    <?php

}

function showErrorMsg($msg)
{
    global $conn;

    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';

    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/system.error.php';

    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';

    die();
}

function showAdminErrorMsg($msg)
{
    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/admin.title.inc.php';

    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/system.error.php';

    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/admin.tail.inc.php';

    die();
}

function showAlertMsg($msg)
{
    if ($msg != '') {
    ?>
        <div class="alert border">
            <a href="#" class="close" style="display:block"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/images/alert.png" align="left" title="Close this notification" alt="close" /></a> <span><?php echo  $msg ?></span>
        </div>

    <?php

    }
}

function showWarningMsg($msg)
{
    if ($msg) {
    ?>
        <div class="notification error png_bg">
            <a class="close" href="#"><img alt="close" title="Close this notification" src="<?php echo  TEMPLATE_DIR ?>admin/images/cross_grey_small.png"></a>
            <div>
                <?php echo  $msg ?>
            </div>
        </div>

    <?php

    }
}

function showMsg($redirect)
{
    if ($redirect) {
    ?>
        <div class="notification png_bg">
            <div class="success">
                <a href="#" class="close"><img src="<?php echo RELA_DIR ?>templates/<?php echo CURRENT_SKIN ?>/admin/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    <?php echo  $redirect ?>
                </div>
            </div>
        </div>
    <?php

    }
}

function showWarningMsg1($msg)
{
    if ($msg) {
    ?>

        <div class="fadeout"><?php echo $msg ?></div>

    <?php

    }
}

//*********************************************Alizadeh***************************************************************
function monthToYear($month)
{
    if ($month >= 12) {
        $year = intval($month / 12);
        $month = $month % 12;
        $result = $year . ' Year ';
        if ($month != 0) {
            $result = $result . ' .  ' . $month . ' Month ';
        }
    } else {
        $result = $month . ' Month ';
    }

    return $result;
}

function mobileChecker($prefix, $number)
{
    if ($prefix == '+964') {
        if (strlen($number) != 10) {
            $return['result'] = -1;
            $return['msg'] = 'Please enter your mobile number correctly.';
        }
    } else {
        $return['result'] = 1;
        $return['msg'] = 'ok';
    }

    return $return;
}

function ipChecker($ip)
{
    if (!filter_var($ip, FILTER_VALIDATE_IP)) {
        $return['result'] = -1;
        $return['msg'] = 'IP is not valid.';
    } else {
        $return['result'] = 1;
        $return['msg'] = 'IP is valid';
    }

    return $return;
}

//************************************************************************************************************
function encrypt($string, $key)
{
    $result = '';
    for ($i = 0; $i < strlen($string); ++$i) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, $i % strlen($key) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}

function decrypt($string, $key)
{
    $result = '';
    $string = base64_decode($string);

    for ($i = 0; $i < strlen($string); ++$i) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;
}

function showAccessError()
{
    //$path=$_SERVER['HTTP_REFERER'];
    $path = RELA_DIR . 'admin';
    ?>

    <script type="text/javascript">
        alert('you dont have proper permissions');
        window.location = '<?php echo $path ?>';
    </script>

<?php
    die();
}

function checkPermissions($action, $component)
{
    global $admin_info;
    // $admin_permission=$admin_info['permission'];
    include_once ROOT_DIR . 'model/admin.permission.class.php';
    $PagePermission = getAllPermisssion();
    //echo "<pre>";print_r($PagePermission);die();
    //$script = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);
    $admin_permission = $admin_info['permission'];
    //$newObj=unserialize($PagePermission[$script]);
    $newObj = $PagePermission[$component];

    unset($PagePermission);
    $return = $newObj->check($action, $admin_permission);

    if ($return['result'] != 1) {
        showAccessError();
    }

    return 1;
}

function checkPermissionsUI($pageName, $action)
{
    global $admin_info;
    //print_r($admin_info);die('sevjppeml;');
    $admin_permission = $admin_info['permission'];
    ///print_r($admin_info);die('ftyftg');
    ///echo $pageName,$action;die('wefopk;wef');
    include_once ROOT_DIR . 'model/admin.permission.class.php';

    $PagePermission = getAllPermisssion();

    $newObj = $PagePermission[$pageName];

    unset($PagePermission);

    $return = $newObj->check($action, $admin_permission);
    //print_r($return);die('iiiiiiiiiuj');
    if ($return['result'] != 1) {
        return 0;
    }

    return 1;
}

function get_group_info_date($p_id)
{
    global $conn, $member_info, $lang;
    $sql = "select * from  internet_detail  where product_id ='$p_id' ";

    $internet_detail_rs = $conn->Execute($sql);
    if (!$internet_detail_rs) {
        $return['result'] = 0;
        $return['err'] = '400';
        $return['msg'] = 'DB Error';

        return $return;
    }

    $return['result'] = 1;
    $return['err'] = '0';
    $return['msg'] = 'successful';
    $return['rs'] = $internet_detail_rs->fields;
    //echo '<pre/>';
    //print_r($return);
    //die();
    return $return;
}

function print_r_debug($data)
{
    echo '<pre style="direction: ltr">';
    print_r($data);
    die();
}




function get_cities()
{
    include_once ROOT_DIR . 'component/city/model/city.model.db.php';
    $cities = cityModelDb::getCities()['export']['list'];

    return $cities;
}

function get_Provinces()
{
    include_once ROOT_DIR . 'component/province/model/province.model.db.php';
    $provinces = provinceModelDb::getProvinces()['export']['list'];

    return $provinces;
}


//*********************************************vahed***************************************************************

function paginationButtom($recordCount = 0, $countButtom = 10, $pageSize = PAGE_SIZE)
{
    global $page, $PARAM;

    if ((settype($pageSize, "integer")) <= 0) {
        $pageSize = 10;
    }

    if ($pageSize <= 0 || trim($pageSize) == '') {
        return $result['result'] = 1;
    }
    if (($countButtom != 0) and ($recordCount != 0)) {
        $pageCount = ceil($recordCount / PAGE_SIZE);
        $pagination = array();
        $pAddress = implode('/', $PARAM);
        $pAddress .= '/';

        if (!isset($page)) {
            $page = 1;
        }

        $fPagination = 0;
        $lPagination = 0;

        $num = $countButtom;
        if ($pageCount < $num) {
            $fPagination = 1;
            $lPagination = $pageCount;
            $nPage = false;
            $pPage = false;
        } elseif ($page == 1) {
            $fPagination = 1;
            $lPagination = $num;
            $nPage = true;
            $pPage = false;
        } elseif (($pageCount == $page)) {
            $fPagination = $pageCount - ($num - 1);
            $lPagination = $pageCount;
            $nPage = false;
            $pPage = true;
        } else {
            $fPagination = $page - floor($num / 2);
            if (($num % 2) == 0) {
                $lPagination = $page + ((floor($num / 2)) - 1);
            } else {
                $lPagination = $page + ((floor($num / 2)));
            }
            $nPage = true;
            $pPage = true;
            if ($fPagination <= 0) {
                $fPagination = 1;
                $lPagination = $num;
            } elseif ($pageCount < $lPagination) {
                $fPagination = $pageCount - (($num - 1));
                $lPagination = $pageCount;
            }
        }

        for ($i = $fPagination; $i <= $lPagination; $i++) {
            if (($i == $fPagination) and ($pPage == true)) {
                $pagination[] = [address => $pAddress . 'page/' . ($page - 1), label => ">", number => $i];
                $pPage == false;
            }
            if ($page == $i) {
                $activePage = " activePage";
            } else {
                $activePage = "";
            }
            $pagination[] = [address => $pAddress . 'page/' . $i, number => $i, label => $i, "activePage" => $activePage];
            if (($i == $lPagination) and ($nPage == true)) {
                $pagination[] = [address => $pAddress . 'page/' . ($page + 1), label => "<", number => $i];
                $pPage == false;
            }
        }
    } else {
        $result['result'] = -1;
        $result['export']['list'] = '';

        return $result;
    }
    $result['result'] = 1;
    $result['export']['list'] = $pagination;
    $result['export']['pageCount'] = $pageCount;
    $result['export']['rowCount'] = $recordCount;

    //print_r_debug($pageCount);
    return $result;
}

function fileUploader($input = array(), $file = array())
{

    $msg = "";
    //check type of Image
    $new_name = '';
    if (isset($input['new_name'])) {
        $new_name = $input['new_name'];
    } else {
        $new_name = basename($file["name"]);
    }

    //check type of Image
    if (isset($input['type'])) {
        $input['type'] = strtolower($input['type']);
        $type = explode(',', $input['type']);
    } else {
        $type = array('jpg', 'jpeg', 'mp4', 'mp3');
    }

    //check size of Image
    if (isset($input['max_size'])) {
        $maxSize = $input['max_size'];
    } else {
        $maxSize = '2048000';  //max size is 2 MB
    }

    //check size of Image
    if (isset($input['upload_dir'])) {
        $target_dir = $input['upload_dir'];
    } else {
        $target_dir = $input['upload_dir'];
    }


    //Create directory
    $dirs = "";
    if (!(is_dir($target_dir))) {

        // $dir = explode("/", $target_dir);

        mkdir($target_dir, 0777, true);
        // foreach ($dir as $value) {


        //     //if($value != ""){
        //     if ((is_dir($dirs . $value)) != 1) {

        //         mkdir($dirs . $value,0777,true);

        //         $dirs .= $value . "/";
        //     } else {

        //         $dirs .= $value . "/";
        //     }
        //     //}
        // }
    }

    if (isset($input['height'])) {
        $height = $input['height'];
    } else {
        $height = '';
    }

    if (isset($input['wight'])) {
        $wight = $input['wight'];
    } else {
        $wight = '';
    }

    if (isset($input['error_msg'])) {
        $error_msg = $input['error_msg'];
    } else {
        $error_msg = "بارگذاری فایل با مشکل مواجه شد";
    }

    if (isset($input['success_msg'])) {
        $success_msg = $input['success_msg'];
    } else {
        $success_msg = "The file " . basename($file["name"]) . " has been uploaded.";
    }

    $target_file = $target_dir . (strtotime("now") . "._" . $new_name);


    $result['image_name'] = (strtotime("now") . "._" . $new_name);

    $uploadOk = 1;

    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $nameFile = ((str_ireplace("." . $fileType, "", $file["name"])) . "._" . strtotime("now") . "." . $fileType);
    $check = getimagesize($file["tmp_name"]);

    //Check if file already exists
    if (file_exists($target_file)) {
        $result['msg']['error'] = "این فایل از قبل وجود دارد";
        $uploadOk = 0;
    }

    // Check file size
    if ($file["size"] > $maxSize) {
        $result['msg']['error'] = "حجم عکس مورد نظر حداکثر باید ۲ مگابایت باشد";
        $uploadOk = 0;
    }

    if (!in_array($fileType, $type)) {
        $result['msg']['error'] = "پسوند عکس نامعتبر است";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $result['msg']['error_msg'] = $error_msg;
        $result['result'] = "-1";
    } else {

        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $result['msg']['success_msg'] = $success_msg;
            $result['result'] = "1";
        } else {
            $result['msg']['error_msg'] = $error_msg;
            $result['result'] = "-1";
        }
    }

    return $result;
}

if (isset($_FILES['galery_image'])) {

    $Property = array(
        'type' => 'jpg,png,jpeg',
        'new_name' => $_FILES['galery_image']['name'],
        'max_size' => '2048000',
        'upload_dir' => GALARY_IMAGE_ROOT . "/galary/",
        'height' => '',
        'wight' => '',
        'error_msg' => '',
        'success_msg' => '',
    );


    $result_uploader = fileUploader($Property, $_FILES['galery_image']);
}

function fileRemover($dir, $fileName)
{
    if (trim($fileName) != '') {
        if (file_exists($dir . $fileName)) {
            unlink($dir . $fileName);
            $result['result'] = "1";
            $result['msg'] = "file removed.";
        } else {
            $result['result'] = "-1";
            $result['msg'] = "Sorry, file not exists.";
        }
    } else {
        $result['result'] = "-1";
        $result['msg'] = "Sorry, file name is empety.";
    }
}

function getPackageUsage($company_id)
{

    include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
    $packageObject = new adminPackageUsageController();
    $package = $packageObject->getPackageByCompanyID($company_id);

    return $package;
}

//end vahed

function arrayToTag($input)
{
    $export = '';
    if (count($input) > 0) {
        $export = implode(',', $input);
        $export = ',' . $export . ',';
    }
    $result['export']['list'] = $export;
    $result['result'] = '1';

    return $result;
}

function tagToArray($input)
{
    $export = explode(',', $input);
    $export = array_filter($export, 'strlen');
    $result['export']['list'] = $export;
    $result['result'] = '1';

    return $result;
}

function getNotification()
{
    include_once ROOT_DIR . 'component/notification/member/model/notification.controller.php';
    global $company_info;
    $result = notificationController::getAllUnread($company_info['company_id']);

    return $result['export'];
}

function getInformation()
{
    // get package type
    include_once ROOT_DIR . 'component/package/member/model/package.model.php';
    global $company_info;
    if ($company_info == -1) {
        $information_company = null;

        return $information_company;
    }
    $company_id = $company_info['company_id'];
    $obj = new package();
    $company = company::find($company_id);

    if (!is_object($company)) {
        $information_company = null;

        return $information_company;
    }

    $package = $obj->getCompanyPackage($company_id);
    $information_company['companyId'] = $company_id;
    $information_company['packageType'] = $package['packagetype'];
    $package['product'] == '1000' ? $information_company['packageProductCount'] = 'نامحدود' : $information_company['packageProductCount'] = $package['product'];
    $information_company['packageCategoryCount'] = $package['category'];
    $information_company['usageCategoryCount'] = $package['category_Usage'];
    $information_company['priority_details'] = $company->priority_details;
    //-----------------

    // get product count
    include_once ROOT_DIR . 'component/product/member/model/product.model.php';
    $information_company['productCount'] = c_product::getProductCount($company_id);
    //------------------

    // get company name
    include_once ROOT_DIR . 'component/company/member/model/member.company.controller.php';
    $information_company['companyName'] = $company->company_name;
    $information_company['category'] = $company->category_id;
    //-----------------

    // get company logo from main table
    include_once ROOT_DIR . 'component/companyLogo/member/model/companyLogo.controller.php';
    $logo = new logoController();
    $information_company['companyLogo'] = $logo->getCompanyLogo($company_id);

    // get company logo from draft table
    $information_company['companyLogoDraft'] = $logo->getCompanyLogoDraft($company_id);

    //-----------------

    return $information_company;
}

function getBanner($company_id)
{

    // get company
    include_once ROOT_DIR . 'component/company/member/model/member.company.controller.php';
    $company = memberCompanyController::getCompanyById($company_id);
    //-----------------

    // get company banner
    include_once ROOT_DIR . 'component/companyBanner/member/model/companyBanner.controller.php';
    $banner = new bannerController();
    $companyBanner['companyBanner'] = $banner->getCompanyBanner($company_id);
    //-----------------

    // get company banner draft
    $companyBanner['companyBannerDraft'] = $banner->getCompanyBannerDraft($company_id);
    //------------------------

    // get category_banner
    include_once ROOT_DIR . 'component/company/model/company.model.php';
    $bannerCategoryID = tagToArray($company->category_id)['export']['list'];
    $result = companyModel::getCategoryBanner($bannerCategoryID['1']);
    $export['category_banner'] = $result['export']['list']['0']['image'];
    if (empty($companyBanner['companyBanner'])) {
        $companyBanner['companyBanner'] = COMPANY_ADDRESS . 'banner/' . $export['category_banner'];
    } else {
        $companyBanner['companyBanner'] = COMPANY_ADDRESS . $company_id . '/banner/' . $companyBanner['companyBanner'];
    }

    return $companyBanner;
    //------------
}

function setColorPackage($type)
{
    switch ($type) {
        case "برنز":
            return "backgroundBoronz";
        case "نقره ای":
            return "backgroundSilver";
        case "طلایی":
            return "backgroundGold";
        case "پلاتینیوم":
            return "backgroundPlatinum";
    }
}

function setFontColorPackage($type)
{
    switch ($type) {
        case "برنز":
            return "colorBoronz";
        case "نقره ای":
            return "colorSilver";
        case "طلایی":
            return "colorGold";
    }
}

function is_user($company_id)
{
    include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';
    $company = admincompanyModel::find($company_id);
    if (($company->username == '') | ($company->password) == '') {
        return -1;
    } else {
        return 1;
    }
}

function sendSMS($username = '', $code)
{
    // dd($username);
    $URL = 'https://api.payamak-panel.com/post/send.asmx?wsdl';
    $userName = 'dabacenter.ir';
    $Password = 'DABA@22435200';
    $senderNumber = '10000022435200';
    $val = $username;
    $Note = $code;

    ini_set("soap.wsdl_cache_enabled", "0");

    $parameters['username'] = $userName;
    $parameters['password'] = $Password;
    $parameters['to'] = $val;
    $parameters['from'] = $senderNumber;
    $parameters['text'] = $Note."\n لغو11";
    $parameters['isflash'] = false;

    // dd($parameters);
    // dd($sms_client);
    // dd($sms_client->SendSimpleSMS2($parameters));

    try {
        $sms_client = new SoapClient($URL, array('encoding' => 'UTF-8'));
        $sent = $sms_client->SendSimpleSMS2($parameters);
        $res = $sent->SendSimpleSMS2Result;
        // dd($res);
        
    } catch (Exception $e) {
        dd($e);
    }


    // dd($res);
    return $res;
}

function oldSendSMS($username, $code)
{
    $code = rawurlencode($code);
    $ktiSmsUrlAdv = "http://www.sms20.ir/send_via_get/send_sms.php?username=farivar&password=7676125&sender_number=30004722435200";
    $result = file_get_contents($ktiSmsUrlAdv . "&receiver_number=" . $username . "&note=" . $code);
    if (is_numeric($result)) {
        $res['msg'] = 'کد فعالسازی دوباره ارسال شد';
        $res['result'] = 1;
    } else {
        $res['msg'] = 'در حال حاضر امکان ارسال کد فعالسازی وجود ندارد';
        $res['result'] = -1;
    }

    return $res;
}


function call($phone, $code)
{
    // phpinfo();

    $CallService = new SoapClient("http://172.31.0.10/services/CallService.php?wsdl", array("cache_wsdl" => WSDL_CACHE_NONE));
    // dd($CallService);
    $username = "hotspot";
    $password = "HgnFu3v38rQx";
    $apiKey = "551263";
    $sid = $CallService->authenticate($apiKey, $username, $password);
    $result = $CallService->CallAndSayDigits($sid, $phone, $code);
    if (is_numeric($result)) {
        $res['msg'] = 'کد فعالسازی دوباره ارسال شد';
        $res['result'] = 1;
    } else {
        $res['msg'] = 'در حال حاضر امکان ارسال کد فعالسازی وجود ندارد';
        $res['result'] = -1;
    }
    return $res;
}

/**
 * @param $input
 * @return mixed
 */
function convertToEnglish($input)
{
    $persian = array('۰', '۱', '۲', '۳', '٤', '٥', '٦', '۷', '۸', '۹');
    $arabic = array('٠', '١', '٢', '٣', '۴', '۵', '۶', '٧', '٨', '٩');
    $english = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    $str = str_replace($persian, $english, $input);
    $string = str_replace($arabic, $english, $str);

    return $string;
}

function calculateScoreCompany($company_id)
{
    require_once ROOT_DIR . "model/Rate.php";
    $company = company::find($company_id);

    if (is_object($company)) {
        $rate = new Rate($company);

        $rate->calculation();
    }
}


function isImage($pathToFile)
{
    return TRUE;

    if (false === exif_imagetype($pathToFile))
        return FALSE;

    return TRUE;
}

function clearSpace($type)
{
    $type = str_replace(' ', '-', $type);
    return $type;
}

function clearHtml($input)
{

    //$input= strip_tags(trim($input));
    //$input = filter_var($input, FILTER_SANITIZE_STRING);
    //return $input;
    // echo $input;

    //echo "<br/>********************<br/>";
    // $input=preg_replace('/\s+/', ' ', $input);
    $input = strip_tags(trim($input));
    //$input=strip_tags(trim(preg_replace('/\s+/', ' ',$input)));
    // $input = str_replace("&nbsp;", '', $input);
    // echo $input;
    $input = str_replace("\r\n\r\n\r\n", "\r\n", $input);

    $input = str_replace("\r\n\r\n", "\r\n", $input);

    //$input = str_replace("\t", ' ', $input);

    // echo "<br/>********anjam shod********<br/>";
    $input = decode_entities_full($input, ENT_COMPAT, "utf-8");

    return $input;
}


/**
 * Helper function for drupal_html_to_text().
 *
 * Calls helper function for HTML 4 entity decoding.
 * Per: http://www.lazycat.org/software/html_entity_decode_full.phps
 */
function decode_entities_full($string, $quotes = ENT_COMPAT, $charset = 'ISO-8859-1')
{
    return html_entity_decode(preg_replace_callback('/&([a-zA-Z][a-zA-Z0-9]+);/', 'convert_entity', $string), $quotes, $charset);
}

/**
 * Helper function for decode_entities_full().
 *
 * This contains the full HTML 4 Recommendation listing of entities, so the default to discard
 * entities not in the table is generally good. Pass false to the second argument to return
 * the faulty entity unmodified, if you're ill or something.
 * Per: http://www.lazycat.org/software/html_entity_decode_full.phps
 */
function convert_entity($matches, $destroy = true)
{
    static $table = array(
        'quot' => '&#34;', 'amp' => '&#38;', 'lt' => '&#60;', 'gt' => '&#62;', 'OElig' => '&#338;', 'oelig' => '&#339;', 'Scaron' => '&#352;', 'scaron' => '&#353;', 'Yuml' => '&#376;', 'circ' => '&#710;', 'tilde' => '&#732;', 'ensp' => '&#8194;', 'emsp' => '&#8195;', 'thinsp' => '&#8201;', 'zwnj' => '&#8204;', 'zwj' => '&#8205;', 'lrm' => '&#8206;', 'rlm' => '&#8207;', 'ndash' => '&#8211;', 'mdash' => '&#8212;', 'lsquo' => '&#8216;', 'rsquo' => '&#8217;', 'sbquo' => '&#8218;', 'ldquo' => '&#8220;', 'rdquo' => '&#8221;', 'bdquo' => '&#8222;', 'dagger' => '&#8224;', 'Dagger' => '&#8225;', 'permil' => '&#8240;', 'lsaquo' => '&#8249;', 'rsaquo' => '&#8250;', 'euro' => '&#8364;', 'fnof' => '&#402;', 'Alpha' => '&#913;', 'Beta' => '&#914;', 'Gamma' => '&#915;', 'Delta' => '&#916;', 'Epsilon' => '&#917;', 'Zeta' => '&#918;', 'Eta' => '&#919;', 'Theta' => '&#920;', 'Iota' => '&#921;', 'Kappa' => '&#922;', 'Lambda' => '&#923;', 'Mu' => '&#924;', 'Nu' => '&#925;', 'Xi' => '&#926;', 'Omicron' => '&#927;', 'Pi' => '&#928;', 'Rho' => '&#929;', 'Sigma' => '&#931;', 'Tau' => '&#932;', 'Upsilon' => '&#933;', 'Phi' => '&#934;', 'Chi' => '&#935;', 'Psi' => '&#936;', 'Omega' => '&#937;', 'alpha' => '&#945;', 'beta' => '&#946;', 'gamma' => '&#947;', 'delta' => '&#948;', 'epsilon' => '&#949;', 'zeta' => '&#950;', 'eta' => '&#951;', 'theta' => '&#952;', 'iota' => '&#953;', 'kappa' => '&#954;', 'lambda' => '&#955;', 'mu' => '&#956;', 'nu' => '&#957;', 'xi' => '&#958;', 'omicron' => '&#959;', 'pi' => '&#960;', 'rho' => '&#961;', 'sigmaf' => '&#962;', 'sigma' => '&#963;', 'tau' => '&#964;', 'upsilon' => '&#965;', 'phi' => '&#966;', 'chi' => '&#967;', 'psi' => '&#968;', 'omega' => '&#969;', 'thetasym' => '&#977;', 'upsih' => '&#978;', 'piv' => '&#982;', 'bull' => '&#8226;', 'hellip' => '&#8230;', 'prime' => '&#8242;', 'Prime' => '&#8243;', 'oline' => '&#8254;', 'frasl' => '&#8260;', 'weierp' => '&#8472;', 'image' => '&#8465;', 'real' => '&#8476;', 'trade' => '&#8482;', 'alefsym' => '&#8501;', 'larr' => '&#8592;', 'uarr' => '&#8593;', 'rarr' => '&#8594;', 'darr' => '&#8595;', 'harr' => '&#8596;', 'crarr' => '&#8629;', 'lArr' => '&#8656;', 'uArr' => '&#8657;', 'rArr' => '&#8658;', 'dArr' => '&#8659;', 'hArr' => '&#8660;', 'forall' => '&#8704;', 'part' => '&#8706;', 'exist' => '&#8707;', 'empty' => '&#8709;', 'nabla' => '&#8711;', 'isin' => '&#8712;', 'notin' => '&#8713;', 'ni' => '&#8715;', 'prod' => '&#8719;', 'sum' => '&#8721;', 'minus' => '&#8722;', 'lowast' => '&#8727;', 'radic' => '&#8730;', 'prop' => '&#8733;', 'infin' => '&#8734;', 'ang' => '&#8736;', 'and' => '&#8743;', 'or' => '&#8744;', 'cap' => '&#8745;', 'cup' => '&#8746;', 'int' => '&#8747;', 'there4' => '&#8756;', 'sim' => '&#8764;', 'cong' => '&#8773;', 'asymp' => '&#8776;', 'ne' => '&#8800;', 'equiv' => '&#8801;', 'le' => '&#8804;', 'ge' => '&#8805;', 'sub' => '&#8834;', 'sup' => '&#8835;', 'nsub' => '&#8836;', 'sube' => '&#8838;', 'supe' => '&#8839;', 'oplus' => '&#8853;', 'otimes' => '&#8855;', 'perp' => '&#8869;', 'sdot' => '&#8901;', 'lceil' => '&#8968;', 'rceil' => '&#8969;', 'lfloor' => '&#8970;', 'rfloor' => '&#8971;', 'lang' => '&#9001;', 'rang' => '&#9002;', 'loz' => '&#9674;', 'spades' => '&#9824;', 'clubs' => '&#9827;', 'hearts' => '&#9829;', 'diams' => '&#9830;', 'nbsp' => '&#160;', 'iexcl' => '&#161;', 'cent' => '&#162;', 'pound' => '&#163;', 'curren' => '&#164;', 'yen' => '&#165;', 'brvbar' => '&#166;', 'sect' => '&#167;', 'uml' => '&#168;', 'copy' => '&#169;', 'ordf' => '&#170;', 'laquo' => '&#171;', 'not' => '&#172;', 'shy' => '&#173;', 'reg' => '&#174;', 'macr' => '&#175;', 'deg' => '&#176;', 'plusmn' => '&#177;', 'sup2' => '&#178;', 'sup3' => '&#179;', 'acute' => '&#180;', 'micro' => '&#181;', 'para' => '&#182;', 'middot' => '&#183;', 'cedil' => '&#184;', 'sup1' => '&#185;', 'ordm' => '&#186;', 'raquo' => '&#187;', 'frac14' => '&#188;', 'frac12' => '&#189;', 'frac34' => '&#190;', 'iquest' => '&#191;', 'Agrave' => '&#192;', 'Aacute' => '&#193;', 'Acirc' => '&#194;', 'Atilde' => '&#195;', 'Auml' => '&#196;', 'Aring' => '&#197;', 'AElig' => '&#198;', 'Ccedil' => '&#199;', 'Egrave' => '&#200;', 'Eacute' => '&#201;', 'Ecirc' => '&#202;', 'Euml' => '&#203;', 'Igrave' => '&#204;', 'Iacute' => '&#205;', 'Icirc' => '&#206;', 'Iuml' => '&#207;', 'ETH' => '&#208;', 'Ntilde' => '&#209;', 'Ograve' => '&#210;', 'Oacute' => '&#211;', 'Ocirc' => '&#212;', 'Otilde' => '&#213;', 'Ouml' => '&#214;', 'times' => '&#215;', 'Oslash' => '&#216;', 'Ugrave' => '&#217;', 'Uacute' => '&#218;', 'Ucirc' => '&#219;', 'Uuml' => '&#220;', 'Yacute' => '&#221;', 'THORN' => '&#222;', 'szlig' => '&#223;', 'agrave' => '&#224;', 'aacute' => '&#225;', 'acirc' => '&#226;', 'atilde' => '&#227;', 'auml' => '&#228;', 'aring' => '&#229;', 'aelig' => '&#230;', 'ccedil' => '&#231;', 'egrave' => '&#232;', 'eacute' => '&#233;', 'ecirc' => '&#234;', 'euml' => '&#235;', 'igrave' => '&#236;', 'iacute' => '&#237;', 'icirc' => '&#238;', 'iuml' => '&#239;', 'eth' => '&#240;', 'ntilde' => '&#241;', 'ograve' => '&#242;', 'oacute' => '&#243;', 'ocirc' => '&#244;', 'otilde' => '&#245;', 'ouml' => '&#246;', 'divide' => '&#247;', 'oslash' => '&#248;', 'ugrave' => '&#249;', 'uacute' => '&#250;', 'ucirc' => '&#251;', 'uuml' => '&#252;', 'yacute' => '&#253;', 'thorn' => '&#254;', 'yuml' => '&#255;'
    );
    if (isset($table[$matches[1]])) return $table[$matches[1]];
    // else
    return $destroy ? '' : $matches[0];
}



function clearText($input)
{
    //$input= strip_tags(trim($input));
    //$input = filter_var($input, FILTER_SANITIZE_STRING);
    //return $input;
    $input = strip_tags(trim(preg_replace('/\s+/', ' ', $input)));
    $input = str_replace("&nbsp;", '', $input);

    return $input;
}
function removeFiles($input)
{
    $size = array(
        "product" => array('100.100', '90.90', '150.150', '200.200'),
        "logo" => array('122.125', '140.140', '150.150'),
        "event" => array('90.90'),
        "article" => array('90.90'),
        "banner" => array('1260.210')
    );
    if (isset($input['company_id'])) {
        foreach ($size[$input['component']] as $key => $value) {
            fileRemover(COMPANY_ADDRESS_ROOT . $input['company_id'] . "/" . $input['component'] . "/", $value . '.' . $input['image']);
        }
        fileRemover(COMPANY_ADDRESS_ROOT . $input['company_id'] . "/" . $input['component'] . "/", $input['image']);
    } else {
        foreach ($size[$input['component']] as $key => $value) {
            fileRemover(IMAGES_ROOT_DIR . $input['component'] . "/", $value . '.' . $input['image']);
        }
        fileRemover(IMAGES_ROOT_DIR . $input['component'] . "/", $input['image']);
    }
}

function cleanUrl($input)
{
    $url = str_replace(" ", "-", trim($input));
    $url = str_replace(" ", ".", trim($url));
    return htmlentities($url);
}

function videoUrl($script)
{
    $start = strpos($script, 'src') + 5;
    $end = strpos($script, '?');
    $url = substr($script, $start, $end - $start);
    return str_replace('embed', 'v', $url);
}

function getTaskCount()
{
    include_once ROOT_DIR . 'services/crm/LetterTaskService.php';

    $task = new LetterTaskService();
    return $task->getTaskCount();
}

function get_caller($function = NULL, $use_stack = NULL)
{
    echo "<pre>";
    if (is_array($use_stack)) {
        // If a function stack has been provided, used that.
        $stack = $use_stack;
    } else {
        // Otherwise create a fresh one.
        $stack = debug_backtrace();
        echo "\nPrintout of Function Stack: \n\n";
        print_r($stack);
        echo "\n";
    }

    if ($function == NULL) {
        // We need $function to be a function name to retrieve its caller. If it is omitted, then
        // we need to first find what function called get_caller(), and substitute that as the
        // default $function. Remember that invoking get_caller() recursively will add another
        // instance of it to the function stack, so tell get_caller() to use the current stack.
        $function = get_caller(__FUNCTION__, $stack);
    }

    if (is_string($function) && $function != "") {
        // If we are given a function name as a string, go through the function stack and find
        // it's caller.
        for ($i = 0; $i < count($stack); $i++) {
            $curr_function = $stack[$i];
            // Make sure that a caller exists, a function being called within the main script
            // won't have a caller.
            if ($curr_function["function"] == $function && ($i + 1) < count($stack)) {
                return $stack[$i + 1]["function"];
            }
        }
    }

    // At this stage, no caller has been found, bummer.
    return "";
}

function readMore($text, $limit = 100, $noLink = 0)
{
    $string = strip_tags($text);
    //$string = $text;

    if (strlen($string) > $limit) {

        // truncate string
        $stringCut = substr($string, 0, $limit);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
        if ($noLink == 1) {
            //            $string .= ' <a  data-text="' . $text . '" data-title="' . $title . '" class="readMore" href="">ادامه</a>';
            $string .= ' <a  data-text="' . $text . '" data-title="' . "  " . '" class="readMore" href="">ادامه</a>';
        }
    }

    return $string;
}


if (!function_exists('getCategoriyIds')) {
    function getCategoriyIds($category_str)
    {

        include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
        $cats = category::getAll();

        $first = true;
        foreach (explode(',', $category_str) as $category_url) {
            if ($first) {
                $first = false;
                $cats->where('url', '=', $category_url);
            } else {
                $cats->orWhere('url', '=', $category_url);
            }
        }
        $cats = $cats->get();


        if ($cats['export']['recordsCount'] == 0) redirectPage(RELA_DIR, 'Not found');

        $category_ids = '';

        foreach ($cats['export']['list'] as $cat) {
            $category_ids .= $cat->Category_id . ',';
        }
        $category_ids = trim($category_ids, ',');

        return $category_ids;
    }
}


if (!function_exists('cleanSlug')) {
    function cleanSlug($url)
    {
        return trim(str_replace(str_split('\\/:*?"<>|. )(,'), '-', clearHtml($url, '')), '-');
    }
}



if (!function_exists('updatecategory')) {
    function updatecategory()
    {
        include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';



        foreach (category::getAll()->get()['export']['list'] as $cat) {
            $cat->url = cleanSlug($cat->title);
            if ($cat->alt == '') {
                $cat->alt = $cat->title;
            }

            if ($cat->group == Null) {
                $cat->group = 0;
            }
            if ($cat->group_sub == Null) {
                $cat->group_sub = 0;
            }
            if ($cat->parent_id_copy == Null) {
                $cat->parent_id_copy = 0;
            }
            $cat->save();
            if ($cat->Category_id == '4950000dd') {
                dd($cat);
            }
        }

        dd('Reset all url category !!!');
    }
}

// uniqueCategoryUrl();
if (!function_exists('tableOfContent')) {
    function tableOfContent($content)
    {


        //preg_match_all( '|<h[^>]+>(.*)</h[^>]+>|iU',$detail->description, $matches );
        //echo '<pre/>';
        //print_r($matches);
        //$tag = $matches[1];
        // dd($matches);
        $depth = 3;
        $pattern = '/<h2[^>]*>(.*?)<\/h2>/s';
        $content = str_replace('&nbsp;', ' ', $content);

        $whocares = preg_match_all($pattern, $content, $winners);
        // dd($content);
        // dd($winners[0],$winners[1]);
        //dd(Request::url());
        //dd(url()->current());

        //reformat the results to be more usable
        $heads = implode("\n", $winners[0]);
        //$replace='<a href="'.url()->current().'/';
        //$heads = str_replace('<a href="',$replace,$heads);
        //$heads = str_replace('</a>','',$heads);
        //$heads = preg_replace('/<h([1-'.$depth.'])>/','<li class="toc$1">',$heads);
        //$heads = preg_replace('/<\/h[1-'.$depth.']>/','</a></li>',$heads);

        //dd($detail->description);
        function cleareText($val)
        {
            return trim(clearHtml(str_replace('&nbsp;', ' ', $val)));
        }

        //$table=$winners;
        $table_of_content = '';
        $count = 0;
        $list['list'] = array();
        foreach ($winners[1] as $key => $val) {
            $item = str_replace(' ', '-', $val);
            $label = cleareText($val);
            $anchor = cleareText($item);
            if (strlen($anchor) == 0) {
                continue;
            }
            $list['list'][$count]['label'] = $label;
            $list['list'][$count]['anchor'] = $anchor;
            $table_of_content = '';
            //dd($val);

            $anchor = '<a id="' . str_replace(' ', '-', cleareText($val)) . '" href="#' . str_replace(' ', '-', cleareText($val)) . '">' . cleareText($val) . '</a>';

            $anchor = str_replace($winners[1][$key], $anchor, $winners[0][$key]);
            // echo ($anchor);die();
            //<h2 id="meet-laravel"><a href="#meet-laravel">Meet Laravel</a></h2>
            //"<h2 style="text-align:justify"><a name="آشنایی-با-درب-ضد-سرقت">آشنایی با درب ضد سرقت</a></h2>"
            $content = str_replace($winners[0][$key], $anchor, $content);

            $count++;
        }
        //echo '<pre/>';
        //print_r($list);
        //dd();

        // print_r($winners[0]);
        // die();
        //foreach ()
        $list['content'] = $content;
        //echo $contents;
        //echo '<pre/>';
        //print_r($heads);
        //die();
        // dd($list);
        // dd($heads);
        return $list;
    }
}

if (!function_exists('recaptcha')) {
    function recaptcha($action, $token)
    {
        $site_key = '6LdmjDsmAAAAANswKgj3737SohuPSA7AIhSxMfNm';
        $secretKey = '6LdmjDsmAAAAACNDvwxwDhezA0psFux3yhhslJOp';
        
        // call curl to POST request
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => $secretKey, 'response' => $token)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $arrResponse = json_decode($response, true);
        
        // verify the response
        if ($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
            // valid submission
            // go ahead and do necessary stuff
            return $arrResponse;
        } else {
            // spam submission
            // show error message
            dd($arrResponse);
            return $arrResponse['error-codes'];
        }
    }
}
