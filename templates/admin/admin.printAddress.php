<link rel="stylesheet"
      href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/font-awesome.min.css"
      xmlns="http://www.w3.org/1999/html">

<style type="text/css">
    .spinnerContainer, .header, footer, .flot-tooltip, .side-left, .content-control, button {
        display: none;
        visibility: hidden;
    }

    @font-face {
        font-family: 'BNazanin';
        src: url('<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/fonts/BNazanin.eot?#') format('eot'),
        url('<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/fonts/BNazanin.woff') format('woff'),
        url('<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/fonts/BNazanin.ttf') format('truetype');
    }

    /* css reset */
    html {
        font-size: 100%;
    }

    a[href]:after {
        content: none !important;
    }

    body {
        font-family: 'BNazanin', sans-serif;
        background: none;
        padding: 0;
        height: 842px;
        width: 595px;
        margin-top: 50px;
        margin-right: auto;
        margin-left: auto;
        /* to centre page on screen*/
        line-height: 1.4;
        font-size: 15px;
    }

    strong {
        display: block;
        width: 40px;
    }

    .section {
        background: none;
    }

    .content {
        margin: 0;
    }

    .main-content {
        line-height: 1.5;
        text-align: justify;
    }

    .ltr {
        direction: ltr;
    }

    .rtl {
        direction: rtl;
    }

    .rotatedTitle {
        text-align: center;
        height: 20px;
        width: 250%;
        font-weight: bold;
        font-size: 13px;
        display: block;
        transform: translate(28px, 0px) rotate(-90deg);
    }

    table {
        width: 100%;
        /* border-right: solid 1px #888;
         border-top: solid 1px #888;
         border-collapse: collapse;
         border-spacing: 0;*/
    }

    table td {
        position: relative;
        vertical-align: middle;
        padding: 0 3px;
        /* border-left: solid 1px #888;
         border-bottom: solid 1px #888;*/
        font-weight: normal !important;
        white-space: normal;
        font-size: 13px;
        line-height: 1.3;
        max-height: 170px !important;
        overflow: hidden;
    }

    .table-heading {
        background-color: #ddd;
        padding: 0;
    }

    .row-title {
        padding: 1px 0 !important;
        /*width: 105px;*/
        text-align: center;
        /* background-color: #f5f5f5;*/
    }

    .desc {
        min-height: 50px;
        max-height: 180px;
        overflow: hidden;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    .check-container {
        width: 50%;
        text-align: right;
    }

    .pull-right {
        float: right;
    }

    .pull-left {
        float: left;
    }

    .attach-container {
        width: 100%;
        line-height: .8;
        display: table;
        margin-top: -10px;
    }

    .attach-container p {
        float: left;
        display: block;
        margin-top: 0;
        margin-bottom: 15px;
        width: 150px;
        clear: both;
    }

    .attach-container .dotted {
        font-size: 14px;
    }

    .attach-container .dotted:before {
        bottom: 2px;
    }

    .link {
        position: relative;
        font-family: Sans-Serif;
    }

    .link:before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 0;
        border-bottom: solid 1px #555;
    }

    .dotted {
        display: inline-block;
        position: relative;
        text-align: center;
        font-weight: bold;
    }

    .dotted:before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 6px;
        width: 100%;
        height: 0;
        border-bottom: dotted 1px #aaa;
    }

    button {
        position: absolute;
        background: #FF9800;
        border: solid 1px #c30;
        height: 40px;
        left: 30px;
        top: 20px;
        line-height: 35px;
        border-radius: 5px;
        color: #FFF;
        font-size: 16px;
    }

    .fa {
        position: relative;
        top: 2px;
    }

    @page {
        size: A4;   /* auto is the initial value */
        direction: rtl;
    }

    @page :right {
        margin-left: 5cm;
    }

    @page :left {
        margin-right: 1.5cm;
    }

</style>

<?php

$curDate = convertDate(date('Y-m-d'));
$curDate = explode('/', $curDate);

$paperType = $list['list']['typePaper'];

$no = $list['list']['company']['Company_id'] . ' - ' . $paperType . ' - ' . $curDate[1] . ' - ' . str_replace("13", "", $curDate[0]);
$product = $list['list']['product']['export']['recordsCount'];


$email = count($list['list']['email']['export']) ? $list['list']['email']['export']['list'][0]['email'] : 0;
$website = count($list['list']['websites']['export']) ? $list['list']['websites']['export']['list'][0]['url'] : 0;
$address = count($list['list']['address']['export']) ? $list['list']['address']['export']['list'][0]['address'] : 0;


//$phoneTmp = substr_replace($list['list']['phone']['export']['list'][0]['number'], '-', 3, 0);
//$phone = count($list['list']['phone']['export']) ? $phoneTmp . ' ' . $list['list']['phone']['export']['list'][0]['state'] . ' ' . $list['list']['phone']['export']['list'][0]['value'] : 0;

$postCode = strlen($list['list']['address']['export']['list']['0']['postal_code']) ? $list['list']['address']['export']['list']['0']['postal_code'] : 0;

$national_id = $list['list']['company']['national_id'];

$count = strlen($national_id);
$count = $count - 3;
for ($i = 0; $i < $count; $i++) {
    $national_id[$i] = "*";
}

$registration_number = $list['list']['company']['registration_number'];
$count = strlen($registration_number);
$count = $count - 3;
for ($i = 0; $i < $count; $i++) {
    $registration_number[$i] = "*";
}


//print_r_debug($national_id);

$commercialName = count($list['list']['commercialName']['export']['list']);

$branch = count($list['list']['branch']['export']['list']);
$representation = count($list['list']['representation']['export']['list']);

if ($branch > 0 or $representation > 0) {
    $branch = 1;
} else {
    $branch = 0;
}

$logo = count($list['list']['logo']['export']['list']);
$banner = count($list['list']['banner']['export']['list']);

$companyNews = count($list['list']['companyNews']['export']['list']);


$honor = count($list['list']['honor']['export']['list']);
$licence = count($list['list']['licence']['export']['list']);
if ($honor > 0 or $licence > 0) {
    $honor = 1;
} else {
    $honor = 0;
}

$advertise = count($list['list']['advertise']['export']['list']);
$employment = count($list['list']['employment']['export']['list']);
if ($advertise > 0 or $employment > 0) {
    $advertise = 1;
} else {
    $advertise = 0;
}

?>

<button onclick="window.location.replace('<?php echo RELA_DIR . 'admin/?component=company' ?>')">بازگشت به صفحه قبل
</button>

<div class="main-content">
    <div class="attach-container"></div>
    <?php foreach ($list as $compId => $companyInfo) {

        if (trim($companyInfo['phone'][0]['code']) <> '') {
            $phone = $companyInfo['phone'][0]['code'] . "" .        $companyInfo['phone'][0]['number'];
        } else {
            $phone = $companyInfo['phone'][0]['number'];
        } ?>

        <p>
            حضور محترم شرکت
            <span class="" ><b><?php echo $companyInfo['company']['company_name']; ?></b></span>
            &nbsp;&nbsp;
            سرکار خانم / جناب آقای
            <span class="" ><b><?php echo $companyInfo['company']['maneger_name']; ?></b></span>
        </p>
        <table border="0" class="rtl">
            <tr>
               
                <td>آدرس: <?php echo $companyInfo['address']['0']['address']; ?></td>


                <td style="width: 130px;direction: rtl; text-align: left">تلفن: <?php echo $phone; ?></td>
            </tr>
        </table>
        <hr>
    <?php } ?>
    <p class="pull-left"
       style="margin-top: 30px; padding-left: 60px; text-align: center; font-size: 16px; width: 100px; font-weight: bold;">

    </p>
</div>

<script>
    $(function () {
        $('html head').html('<meta charset="utf-8"/>\n' +
            '    <title> تولیدات || دابا سنتر </title>\n' +
            '    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n' +
            '    <meta name="description" content="">\n' +
            '    <meta name="author" content="campaign">');
    });
</script>
<?php /*<br>
<br>
<br>
<br>
<br>

<div class="code">
    <?php print_r_debug($list) ?>
</div>*/ ?>