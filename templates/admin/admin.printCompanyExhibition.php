<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/<?php echo CURRENT_SKIN; ?>/assets/css/font-awesome.min.css">

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
        font-size: 16px;
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
        width: 280%;
        font-weight: bold;
        font-size: 14px;
        display: block;
        transform: translate(28px, 0px) rotate(-90deg);
    }

    table {
        width: 100%;
        border-right: solid 1px #888;
        border-top: solid 1px #888;
        border-collapse: collapse;
        border-spacing: 0;
    }

    table td {
        position: relative;
        vertical-align: middle;
        padding: 0 3px;
        border-left: solid 1px #888;
        border-bottom: solid 1px #888;
        font-weight: normal !important;
        white-space: normal;
        font-size: 14px;
        line-height: 1.3;
        max-height: 170px !important;
        overflow: hidden;
        word-break: break-word;
    }

    .table-heading {
        background-color: #ddd;
        padding: 0;
    }

    .row-title {
        padding: 1px 0 !important;
        width: 105px;
        text-align: center;
        background-color: #f5f5f5;
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
        display: inline;
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

if (trim($list['list']['phone']['export']['list'][0]['code']) <> '') {
    $phone = $list['list']['phone']['export']['list'][0]['code'] . "-" . $list['list']['phone']['export']['list'][0]['number'];
} else {
    $phone = $list['list']['phone']['export']['list'][0]['number'];
}

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

$companySocials = count($list['list']['social']['export']['list']);

$companyPosition = count($list['list']['position']['export']['list']);

$catalog = $list['list']['company']['catalog'];

$video = $list['list']['company']['video_script'];

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

<button onclick="window.location.replace('<?php echo RELA_DIR . 'admin/?component=company' ?>')">بازگشت به صفحه قبل</button>

<div class="main-content">
    <div class="attach-container">
        <p style="font-size: 13px;">
            <strong style="font-weight: normal" class="pull-right">شماره: </strong><span class="dotted pull-left rtl" style="width: 105px;font-weight: normal"><?php echo $no; ?></span>
        </p>
        <p style="font-size: 13px;">
            <strong style="font-weight: normal" class="pull-right">تاریخ: </strong><span class="dotted pull-left" style="width: 105px;font-weight: normal"><?php echo convertDate(date('Y-m-d')); ?></span>
        </p>
        <p style="font-size: 13px;">
            <strong style="font-weight: normal" class="pull-right">پیوست: </strong><span class="dotted pull-left" style="width: 105px;font-weight: normal">دارد</span>
        </p>
    </div>

    <p style="margin: 0px">موضوع: اطلاع رسانی در خصوص ثبت شرکت
        <span class="" style="width: 250px;"><b><?php echo $list['list']['company']['company_name']; ?></b></span></p>

    <p style="margin: 0px"> در مرجع اطلاعات تولیدات
        حضور محترم سرکار خانم / جناب آقای
        <span class="" style="width: 110px;"><b><?php echo $list['list']['company']['maneger_name']; ?></b></span>
    </p>

    <p style="margin: 0px">
        با سلام و احترام
    </p>
<?php //print_r_debug($list)?>
    <p style="margin-top: 5px; margin-bottom: 10px">
        &nbsp;&nbsp; سایت تولیدات
        <span class="link ltr">( www.tolidat.ir )</span> مرجع جستجوی اطلاعات مشاغل و ارائه دهنده اطلاعات صحیح و معتبر تمام واحد های کسب و کار کشور می باشد.
        <br> کارشناسان تیم تولیدات به صورت مستمر در حال به روز رسانی اطلاعات موجود در این مرجع می باشند. در همین راستا پیرو مذاکره حضوری با سرکار خانم / جناب آقای
        <span class="dotted" style="width: 110px;"><?php echo (!empty($list['list']['memberInfo']['name'] . $list['list']['memberInfo']['family'])) ? $list['list']['memberInfo']['name'] . " " . $list['list']['memberInfo']['family'] : $list['list']['company']['maneger_name'] ?></span> در محل نمایشگاه
        <span class="dotted" style="width: 200px;"><?php echo $list['list']['exhibition_name']['name'] ?></span> اطلاعات مجموعه شما دریافت و در پروفایل اختصاصی شرکت
        <span class="dotted" style="160px"><?php echo $list['list']['company']['company_name']; ?></span> ثبت شد. اطلاعات دریافتی به شرح زیر می باشد که از طریق لینک <?php echo '<span class=" ltr">  www.tolidat.ir/c/<span style="font-family:Arial;font-size: 12px">' . $list['list']['company']['Company_id'] . '</span></span>'; ?>
        قابل مشاهده است.
    </p>

    <table class="rtl">
        <tr>
            <td class="table-heading" width="30" rowspan="3"><span class="rotatedTitle">اطلاعات پایه</span></td>
            <td class="row-title">نام مجموعه</td>
            <td colspan="2"><?php echo $list['list']['company']['company_name']; ?></td>
            <td class="row-title">کد اختصاصی مجموعه</td>
            <td><?php echo $list['list']['company']['Company_id']; ?></td>
        </tr>
        <tr>
            <td class="row-title">شماره ثبت</td>
            <td class="ltr text-right" colspan="2"><?php echo $registration_number; ?></td>
            <td class="row-title ">شناسه ملی</td>
            <td class="ltr text-right"><?php echo $national_id; ?></td>
        </tr>
        <tr>
            <td class="row-title">توضیح فعالیت شرکت</td>
            <td colspan="4">
                <div class="desc"><?php echo $list['list']['company']['description']; ?></div>
            </td>
        </tr>
        <tr>
            <td class="table-heading" width="30" rowspan="7"><span class="rotatedTitle">اطلاعات تماس</span></td>
            <td class="row-title">آدرس</td>
            <td colspan="4"><?php echo($address ? $address : '-') ?></td>
        </tr>
        <tr>
            <td class="row-title">شماره تماس</td>
            <td><?php echo($phone ? $phone : '-') ?></td>
            <td class="table-heading" width="30" rowspan="11">
                <span class="rotatedTitle" style="transform: translate(28px, 0px) rotate(-90deg);">ماژول های تکمیلی</span>
            </td>
            <td class="row-title">ماژول محصول/خدمات</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($product ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">کد پستی</td>
            <td><?php echo($postCode ? $postCode : '-'); ?></td>
            <td class="row-title">ماژول سوابق و مشتریان</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($commercialName ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">ایمیل</td>
            <td><span class=""><?php echo($email ? $email : '') ?></span></td>
            <td class="row-title">ماژول نام تجاری</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($commercialName ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">وب سایت</td>
            <td><span class=""><?php echo($website ? $website : ''); ?></span></td>
            <td class="row-title">ماژول افتخارات</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($honor ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">آدرس بر روی نقشه</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($companyPosition ? 'check' : 'times'); ?>"></i>
            </td>
            <td class="row-title">ماژول کاتالوگ</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($catalog ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">شبکه های اجتماعی</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($companySocials ? 'check' : 'times'); ?>"></i>
            </td>
            <td class="row-title">ماژول تیزر تبلیغاتی</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($video ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="table-heading" width="30" rowspan="2"><span class="rotatedTitle">گرافیک</span></td>
            <td class="row-title">لوگو</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($logo ? 'check' : 'times'); ?>"></i>
            </td>
            <td class="row-title">ماژول اخبار و رویداد</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($companyNews ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">بنر</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($banner ? 'check' : 'times'); ?>"></i>
            </td>
            <td class="row-title">ماژول نمایندگی / شعبه</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($representation ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="table-heading text-center" width="30" rowspan="3">SEO</td>
            <td class="row-title" rowspan="3">کلمات کلیدی</td>
            <td class="text-center" rowspan="3">
                <?php //echo(count(explode(',', $list['list']['company']['meta_keyword'])) > 1 ? implode(' - ', explode(',', $list['list']['company']['meta_keyword'])) : '-'); ?>
                <i class="fa fa-<?php echo('times'); ?>"></i>
            </td>
            <td class="row-title">ماژول فرصت های شغلی</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($employment ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">ماژول آگهی ها</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($advertise ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
        <tr>
            <td class="row-title">ماژول فرم تماس</td>
            <td class="text-center">
                <i class="fa fa-<?php echo($advertise ? 'check' : 'times'); ?>"></i>
            </td>
        </tr>
    </table>

    <p> خواهشمند است اطلاعات پروفایل اختصاصی خود را بررسی نموده و در صورت مشاهده مغایرت جهت ویرایش و یا تکمیل آن به کمک یکی از روش های زیر اقدام نمایید:<span style="padding-right: 87px; display: block;">
                    1- از طریق شماره تماس ۲۲۴۳۵۲۰۰-۰۲۱ با واحد فروش ارتباط برقرار کرده و تغییرات لازم را به کارشناسان تولیدات اطلاع دهید.
        <br>
         2- از طریق لینک <?php echo '<span class=" ltr">   www.tolidat.ir/c/<span style="font-family:Arial;font-size: 12px">' . $list['list']['company']['Company_id'] . ' </span>  </span>'; ?>وارد پروفایل خود شده و با زدن دکمه ویرایش، اقدام به اصلاح اطلاعات مربوطه نمایید.</span>
    </p>

    <p class="pull-left" style="margin-top: 30px; padding-left: 60px; text-align: center; font-size: 16px; width: 100px; font-weight: bold;">
        با تشکر <br> تولیدات
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