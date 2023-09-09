<?php $notification = getNotification();
$information_company = getInformation();
$banner = getBanner($information_company['companyId']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>سایت اجتماعی تولیدات</title>
    <!-- meta viewport for initial scale in all device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <link rel="shortcut icon" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/favicon.png">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/bootstrap-tagsinput.min.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css"/>
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/introjs.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/introjs-rtl.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/style.css?v=13961212">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/responsive.css">
    <link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/main.css">
    <link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/styleprice.css">
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">

    <script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/modernizr.custom.js"></script>
    <script> var baseURL = "<?php echo RELA_DIR;?>"; </script>
</head>
<body class="bg-color modal-overlay">
<input type="hidden" id="BASE_URL" data-url="<?php echo RELA_DIR; ?>">
<!-- header that contains logo and socials icon and navigation menus -->
<nav class=" transition header-title-inc">
    <div class="tabProfile transition">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar first2"></span>
                        <span class="icon-bar second2"></span> <span class="icon-bar third2"></span>
                    </button>
                    <div class="navbar-brand">
                        <div class="profile-logo">
                            <a href="<?php echo RELA_DIR; ?>" name="logo" title="لوگوی پروفایل تولیدات">
                                <img data-step="1" data-intro="لوگو" src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/tolidat-logo.png" alt="لوگوی پروفایل تولیدات">
                            </a>
                        </div>
                        <div class="con-icon-pro">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <i class="angle fa fa-angle-down angle-up-arrow transition  is-open" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu profile">
                                        <li class="con-headerHeight">
                                            <div class="con-header">
                                                <div class="logoProfile">
                                                    <img src="<?php echo($information_company['companyLogo'] ? COMPANY_ADDRESS . $information_company['companyId'] . '/logo/' . $information_company['companyLogo'] : DEFULT_LOGO_ADDRESS); ?>" class="boxBorder roundCorner" alt="<?php echo(strlen($value['title']) ? $value['title'] : '-'); ?>">
                                                </div>
                                                <div class="title-profile">
                                                    <span><?php echo $information_company['companyName'] ?></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="<?php echo setColorPackage($information_company['packageType']) ?>">
                                            <div class="details-pro1">
                                                <span class="title-pro1">نوع پکیج:</span>
                                                <span class="title-pro2"><?php echo $information_company['packageType'] ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="details-pro2">
                                                <span class="title-pro3">تعداد محصولات:</span>
                                                <span class="title-pro4"><?php echo $information_company['productCount'] . "/" . $information_company['packageProductCount'] ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="btn link-show-detail btn-block show-more button-default" href="<?php echo RELA_DIR . 'company/Detail/' . $information_company['companyId'] . '/' . cleanUrl($information_company['companyName']); ?>" name="information_company" title="پنل کاربری" style="margin: 1em 0 0 !important;">نمایش جزئیات مجموعه</a>
                                        </li>
                                        <li class="footer">
                                            <div class="con-footer">
                                               <a href="<?php echo RELA_DIR . 'login/logout' ?>" class=" plus2 transition pull-right">خروج</a>
                                                <a class="transition pull-right" id="flexi_form_start" href="#">راهنما</a>
                                            </div>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </div>
                        <div class="con-icon-not" data-step="2" data-intro="لیست اعلان ها">
                            <div class="container-notifications">
                                <div class="click">
                                    <a> <i class="fa fa-bell-o" aria-hidden="true"></i> </a>
                                    <?php if ($notification['recordsCount'] != 0): ?>
                                        <div class="notifications-count"><?php echo $notification['recordsCount'] ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="notifications">
                                    <header>
                                        <div class="text-right">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i> اعلان ها
                                        </div>
                                    </header>
                                    <div class="content">
                                        <ul>
                                            <?php foreach ($notification['list'] as $key => $value) : ?>
                                                <li>
                                                    <div class="details">
                                                        <a href="/profile/notification/<?php echo $value['Notification_id']; ?>">
                                                        <span class="title"><?php echo $value['msg'] ?>
                                                            <span
                                                                    class="date"><?php echo convertDate(substr($value['date'], 0, 10)) ?></span>
                                                        </span> </a>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="footer">
                                        <div class="text-right">
                                            <a href="/profile/notification">نشان دادن تمامی اعلان ها</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse transition" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav center-block transition">
                        <li id="profile" data-step="3" data-intro="پروفایل" class=""><a href="<?php echo RELA_DIR ?>profile">پروفایل</a></li>
                        <li id="product" data-step="4" data-intro="محصولات/خدمات" class=""><a href="<?php echo RELA_DIR ?>member/product">محصولات/خدمات</a></li>
                        <li id="history" data-step="6" data-intro="سوابق و مشتریان" class=""><a href="<?php echo RELA_DIR ?>member/history">سوابق و مشتریان ما</a></li>
                        <li id="companyCommercialName" data-step="7" data-intro=" نام تجاری" class=""><a href="<?php echo RELA_DIR ?>member/companyCommercialName">نام تجاری</a></li>
                        <li id="honour" data-step="10" data-intro="ثبت افتخارات" class=""><a href="<?php echo RELA_DIR ?>member/honour">افتخارات و گواهی ها</a></li>
                        <li id="companyNews" data-step="11" data-intro="ارسال اخبار " class=""><a href="<?php echo RELA_DIR ?>member/companyNews">اخبار و رویداد</a></li>
                        <li id="representation" data-step="12" data-intro="نمایندگی" class=""><a href="<?php echo RELA_DIR ?>member/representation">نمایندگی</a></li>
                        <li id="companyAdvertise" data-step="14" data-intro="آگهی ها" class=""><a href="<?php echo RELA_DIR ?>member/companyAdvertise">آگهی ها</a></li>
                        <li id="employment" data-step="13" data-intro="فرصت های شغلی" class=""><a href="<?php echo RELA_DIR ?>member/employment">فرصت های شغلی</a></li>
                        <li id="companyContacts" data-step="5" data-intro="اطلاعات تماس" class=""><a href="<?php echo RELA_DIR ?>member/companyContacts">اطلاعات تماس</a></li>
                        <li id="licence" data-step="8" data-intro="ثبت مجوزها" class=""><a href="<?php echo RELA_DIR ?>member/licence">مجوزها</a></li>
                        <li id="us" data-step="15" data-intro="پیام های کاربران " class=""><a href="<?php echo RELA_DIR ?>member/companyContacts/us">پیام های کاربران</a></li>
                        <li id="invoices" data-step="16" data-intro="اطلاعات پرداخت " class=""><a href="<?php echo RELA_DIR ?>member/invoice/invoices">اطلاعات پرداخت </a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

    <div class="con-title-inc">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-10 pull-right">
                <div class="cont-banerPro mt center-block boxBorder">
                    <!--banner-->
                    <div class="img-banerPro roundCorner Baner" style="background: url('<?= $banner['companyBanner'] ?>')  no-repeat center / cover   ;">
                        <div class="container-banner-crop roundCorner transition">
                            <img class="roundCorner image-banner my-imgcrop-banner" src="<?= (!empty($banner['companyBannerDraft'])) ? (COMPANY_ADDRESS . $information_company['companyId'] . '/banner/' . $banner['companyBannerDraft']) : ($banner['companyBanner']) ?>">
                            <button data-position='right' data-intro="افزودن عکس بنر" type="button" class="btn btn-primary btn-sm uploud-btnPro hidden-xs" data-toggle="modal" data-target="#myModal-banner" data-backdrop="static">
                                <div class="kebabMenu">
                                    <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                                    <ul class="kebab-menu-content kebab-menu-content-upload-baner roundCorner boxBorder">
                                        <li>
                                            <a class="" id="delete-banner"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف بنر</span></a>
                                        </li>
                                    </ul>
                                </div>
                                <i class="fa fa-camera-retro" aria-hidden="true"></i>
                                <span class="transition title-uploud-btnPro">افزودن عکس بنر</span>
                            </button>
                            <span class="holder-pro-title"><?php echo $information_company['companyName'] ?></span>
                            <div class="modal fade myModal-upload" id="myModal-banner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h5 class="modal-title" id="myModalLabel">انتخاب بنر برای پروفایل</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="demo-wrap upload-demo upload-demo-banner mb5">
                                                <div class="grid">
                                                    <div class="upload-demo-wrap">
                                                        <div id="upload-demo"></div>
                                                    </div>
                                                    <div class="docs-buttons">
                                                        <div class="img-container">
                                                            <img class="width image-banner img-cropper" src="<?php echo(isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder1.png'); ?>" alt="Picture">
                                                        </div>
                                                        <div class="btn-block mt">
                                                            <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage-banner" title="Upload image file">
                                                                <input type="file" class="sr-only" id="inputImage-banner" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                                <i class="fa fa-pencil"></i> انتخاب تصویر
                                                            </label>
                                                            <input class="result-cropBanner result-crop" type="hidden" name="imageCropped" value="">
                                                        </div>
                                                        <!-- Show the cropped image in modal -->
                                                        <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                                                    </div>
                                                                    <div class="modal-body"></div>
                                                                    <div class="modal-footer noPadding pt">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="description-crop">
                                                <h5>لطفا هنگام بارگذاری تصویر به موارد زیر توجا فرمایید:</h5>
                                                <ul>
                                                    <li>سایز مجاز بنر: 230 * 1400 پیکسل</li>
                                                    <li>حجم مجاز بنر: کمتر از 1 مگابایت</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="edit" class="btn btn-success btn-sm upload-result-banner">بارگذاری تصویر</button>
                                            <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--logo-->
                    <div class="holder-pic roundCorner transition crop" id="crop-avatar">
                        <div class="my-imgcrop-profile">
                            <div class="my-imgcrop-logo">
                                <img src="<?php echo($information_company['companyLogoDraft'] ? COMPANY_ADDRESS . $information_company['companyId'] . '/logo/' . $information_company['companyLogoDraft'] : DEFULT_LOGO_ADDRESS); ?>" class="boxBorder roundCorner" alt="<?php echo(strlen($value['title']) ? $value['title'] : '-'); ?>">
                            </div>
                        </div>
                        <div class="kebabMenu kebabMenu-upload-logo">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content kebab-menu-content-upload-logo roundCorner boxBorder">
                                <li>
                                    <a class="" id="delete-logo"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف لوگو</span></a>
                                </li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-primary btn-sm uploud-btnPro" data-toggle="modal" data-target="#avatar-modal" data-backdrop="static">
                            <i class="fa fa-pencil i-upload" aria-hidden="true"></i>
                        </button>
                        <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h5 class="modal-title" id="myModalLabel">بارگذاری تصویر لوگوی مجموعه</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="docs-buttons">
                                            <div class="img-container upload-msg register-crop">
                                                <img class="width image-crop img-cropper" src="<?php echo(isset($information_company['companyLogoDraft']) ? COMPANY_ADDRESS . $value['Company_id'] . "logo/" . $information_company['companyLogoDraft'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                                            </div>
                                            <div class="btn-block">
                                                <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImageLogo" title="Upload image file">
                                                    <input type="file" class="sr-only" id="inputImageLogo" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                    <i class="fa fa-pencil"></i> انتخاب تصویر
                                                </label>
                                                <input class="result-cropLogo result-crop" type="hidden" name="imageCropped" value="">
                                            </div>
                                            <!-- Show the cropped image in modal -->
                                            <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                                        </div>
                                                        <div class="modal-body"></div>
                                                        <div class="modal-footer noPadding pt">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- separator -->
                                            <div class="row xxxsmallSpace"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="edit" class="btn btn-success btn-sm saveLogo">بارگذاری تصویر</button>
                                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                                    </div>
                                </div>

                            </div><!-- /.modal -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-md-2 pull-left">
                <div class="whiteBg roundCorner boxBorder chart-container">
                    <header class="text-center">درصد تکمیل بودن پروفایل</header>
                    <div id="pieContainer" class="center-block profileChart"></div>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    $(function () {
        var deleteAction = {
            "deleteBanner": function () {
                $.get(baseURL + 'member/companyBanner/delete', function (data) {
                    var response = $.parseJSON(data);

                    if (response.result != 1) {
                        $.iziToastError('حذف بنر با مشکل مواجه شد', '.izi-container');
                    }
                    $('.my-imgcrop-banner').attr('src', baseURL+'templates/template_fa/assets/images/placeholder1.png');
                    $.iziToastSuccess(response.msg, '.izi-container');
                });
            },
            "deleteLogo": function() {
                $.get(baseURL + 'member/companyLogo/delete', function (data) {
                    var response = $.parseJSON(data);

                    if (response.result != 1) {
                        $.iziToastError('حذف لوگو با مشکل مواجه شد', '.izi-container');
                    }
                    $('.img-cropper, .my-imgcrop-logo img').attr('src', response.src);
                    $.iziToastSuccess(response.msg, '.izi-container');
                });
            }
        };

        $("#flexi_form_start").click(function (e) {
            e.preventDefault();

            introJs().setOptions(
                {
                    'nextLabel': 'بعدی',
                    'prevLabel': 'قبلی',
                    'skipLabel': 'انصراف',
                    'doneLabel': 'اتمام'
                }
            ).start()
                .onexit(function () {
                    $('.catMenu').removeClass('pinned');
                })
                .oncomplete(function () {
                    $('.catMenu').removeClass('pinned');

                    $('.con-icon-pro .dropdown .angle').removeClass('fa-rotate-180');

                }).onchange(function (el) {
                if (el.id == 'step2') {
                    $('.introjs-helperNumberLayer').css({'top': '-16px', 'right': '-16px', 'left': 'initial'});
                }
                else {
                    $('.introjs-helperNumberLayer').css({'top': '8px', 'right': 'initial', 'left': '-16px'});
                }

            });
            $('.container-banner-crop').addClass('active');
            $('.con-icon-pro .dropdown-menu').css('display', 'none');
            $('body').addClass('reactive');
            $('body.sticky.bg-color').addClass('reactive');
        });

        $('#delete-banner').on('click', function () {
            $.removeAction("آیا از حذف بنر مطمئن هستید‍‍‍", 'deleteBanner');
        });

        $('#delete-logo').on('click', function () {
            $.removeAction("آیا از حذف لوگو مطمئن هستید‍‍‍", 'deleteLogo');
        });

        $('.saveLogo').on('click', function () {
            var imageLogo = $('.result-cropLogo').val();
            var modal_logo = $('#avatar-modal');
            $.post('/member/companyLogo/edit/', {image: imageLogo}, function (data) {
                var response = $.parseJSON(data);
                if (response.result == -1) {
                    $.iziToastError(response.msg, '.izi-container');
                    return;
                } else {
                    $('.my-imgcrop-logo').find('img').attr('src', response.image);
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
                modal_logo.modal('hide');
            });
        });

        $('.upload-result-banner').on('click', function (e) {
            var image = $('.result-cropBanner').val();
            var modal_banner = $('#myModal-banner');
            $.post('/member/companyBanner/edit/', {image: image}, function (data) {
                var response = $.parseJSON(data);

                if (response.result == -1) {
                    modal_banner.modal('hide');
                    $.iziToastError(response.msg, '.izi-container');
                    return;
                } else {
                    $('.my-imgcrop-banner, .image-banner').attr('src', response.image);
                    $.iziToastSuccess('بنر با موفقیت بروز گردید', '.izi-container');
                }
                modal_banner.modal('hide');
            });
        });

        $.removeAction = function (msg, action) {
            iziToast.question({
                title: msg,
                close: false,
                backgroundColor: '#FFF',
                messageColor: 'red',
                color: 'green',
                icon: 'fa fa-question',
                iconColor: 'gray',
                rtl: true,
                closeOnEscape: false,
                toastOnce: true,
                overlay: true,
                overlayClose: true,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                drag: false,
                timeout: false,
                position: 'center',
                message: "با حذف کردن این آیتم امتیاز مرتبط با آن از امتیاز کل شما کسر خواهد شد",
                buttons: [
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        deleteAction[action]();

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ]
            });
        };

        // highchart
        try {
            var priorityArr = JSON.parse('<?php echo $information_company['priority_details'] ?>'),
                serie,
                pieDataSeries = [],
                sumPercent = 0,
                remainPercent = 100;

            Object.keys(priorityArr).map(function(item) {

                sumPercent += parseInt(priorityArr[item].totalScore);

                serie = {
                    name: priorityArr[item].persian_name,
                    y: priorityArr[item].totalScore,
                    color: priorityArr[item].color,
                    link: priorityArr[item].link,
                    menuName: item
                };

                pieDataSeries.push(serie);
            });

            remainPercent -= sumPercent;

            pieDataSeries.push({name: 'امتیاز کسب نشده', y: remainPercent, color: '#f9f9f9'});

            Highcharts.chart('pieContainer', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    events: {
                        load: function() {
                            $('#pieContainer').append('<div class="totalContainer transition text-center">'+sumPercent+' %</div>');
                        }
                    }
                },
                title: {
                    text: ''
                },
                tooltip: {
                    formatter: function() {
                        return '<strong style="color: #ff660c">' + this.point.name  + ' : </strong>'+ this.point.y + ' % ';
                    },
                    useHTML: true,
                    //pointFormat: '{series.name}: <b>{point.y}%</b>',
                    style: {
                        direction: 'rtl',
                        color: '#555',
                        fontSize: '15px',
                        fontWeight: 'bold',
                        fontFamily: 'Samim',
                        zIndex: 99
                    },
                    backgroundColor: 'rgba(255,255,255,1)'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        borderColor: '#eee',
                        borderWidth: 1
                    },
                    series: {
                        events: {
                            click: function(event) {
                                var link = event.point.link;
                                if(link !== '' && link !== undefined)
                                    window.location.replace(link);
                            }
                        }
                    }
                },
                series: [{
                    data: pieDataSeries,
                    innerSize: '80%'
                }]
            });

        } catch(e) {}
    });
</script>
<!-- /end of header -->
<div class="boxContainer profileContainer">
    <div class="profilePage container roundCorner center-block transition noPadding">