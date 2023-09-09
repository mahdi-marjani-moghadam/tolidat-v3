<?php
global $company_info;
if ($company_info != -1) {
    $information_company = getInformation($list['company_id']);
    //print_r_debug($list['seo']['meta_keyword']);
    $banner = getBanner($list['company_id']);
}
?>

<!DOCTYPE html>
<html lang="fa-IR" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <title><?php echo (strlen($list['seo']['title']) > 0 ? $list['seo']['title'] : 'سایت اجتماعی تولیدات'); ?></title>
    <meta name="keywords" http-equiv="keywords" content="<?php echo ($list['seo']['meta_keyword']) ?>">
    <meta name="description" http-equiv="description" content="<?php echo ($list['seo']['description']); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <link rel="alternate" href="<?php echo RELA_DIR ?>" hreflang="fa" />

    <!-- meta viewport for initial scale in all device -->
    <?php /*<link rel="alternate" href="http://tolidat.ir/" hreflang="fa-ir"/>*/ ?>
    <?php if (strlen($list['canonical']) > 0) { ?>
        <link rel="canonical" href="<?php echo $list['canonical']; ?>"><?php } ?>

    <link rel="icon" type="image/png" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/favicon.png">
    <!-- normalize css -->
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/normalize.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- bootstrap core -->
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <?php
    if (isset($_COOKIE['has_keyboard']) && $_COOKIE['has_keyboard'] == 'yes') {
    ?>
        <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/Keyboard-master/dist/css/keyboard.min.css">
    <?php
    }
    ?>
    <!-- custom css style -->
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/style.css?v=13961212">
    <!-- custom responsive css style -->
    <link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/responsive.css">
    <!-- auto-complete css -->
    <link rel='stylesheet' href="<?= RELA_DIR ?>templates/assets/js/search/jquery.auto-complete.css">

    <script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/modernizr.custom.js"></script>
    <script src='<?php echo RELA_DIR . 'templates/'; ?>assets/js/search/jquery.auto-complete.min.js'></script>
    <!--<script src="https://gotoo.ga/google"></script>-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3DNW76V5VK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3DNW76V5VK');
    </script>

    <script>
        var baseURL = "<?php echo RELA_DIR; ?>";
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-210017835-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-210017835-1');
    </script>

</head>
<!-- <div class="overWhite"> -->

<body>
    <input type="hidden" id="BASE_URL" data-url="<?php echo RELA_DIR; ?>">
    <!-- header that contains logo and socials icon and navigation menus -->

    <header class="pageHeader transition">
        <!-- navbar that contains navigation menus -->
        <div class="topNav center-block transition">

            <div class="logoContainer center-block noSelect logo1 pull-right">
                <a href="<?php echo RELA_DIR; ?>" name="logo" title="لوگوی سایت تولیدات">
                    <img class="center-block" src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/images/tolidat-logo.png" alt="لوگوی سایت تولیدات">
                </a>
            </div>

            <div class="total center-block pull-left">
                <div class="plus transition">
                    <?php if ($information_company != null) : ?>
                        <a class="marker" title="درخواست ثبت مجموعه" name="marker"><i class="fa fa-user" aria-hidden="true"></i>
                            <i class="angle fa fa-angle-down angle-up-arrow transition " aria-hidden="true"></i> </a>
                        <div class="title-login">
                            <span data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $information_company['companyName'] ?>" class="tit"><?php echo $information_company['companyName'] ?></span>
                        </div>
                    <?php else : ?>
                        <a class="marker" name="marker_new" title="درخواست ثبت مجموعه"><i class="fa fa-user" aria-hidden="true"></i></a>
                        <a class="profile3" href="<?php echo RELA_DIR . "login" ?>" name="login" title="ورود">ورود</a>
                        <a class="register" href="<?php echo RELA_DIR . "register" ?>" name="register" title="ثبت نام">ثبت نام</a>
                    <?php endif; ?>
                    <!-- <a class="business" href="">
                    <span class="icon">
                        <i class="fa fa-briefcase" aria-hidden="true"></i>
                    </span>
                   <span class="title">
                        فرصت های شغلی
                   </span>
                </a> -->
                </div>
                <?php if ($information_company != null) : ?>
                    <div class="profile boxBorder roundCorner">
                        <header>
                            <div class="logoProfile">
                                <img src="<?php echo ($information_company['companyLogo'] ? COMPANY_ADDRESS . $information_company['companyId'] . '/logo/' . $information_company['companyLogo'] : DEFULT_LOGO_ADDRESS); ?>" class="boxBorder roundCorner" alt="<?php echo (strlen($value['title']) ? $value['title'] : '-'); ?>">
                            </div>
                            <div class="title-profile">
                                <span><?php echo $information_company['companyName'] ?></span>
                            </div>
                        </header>
                        <div class="content">
                            <?php if ($list['show_profile_menu'] == 0) { ?>
                                <ul>
                                    <li class="<?php echo setColorPackage($information_company['packageType']) ?>">
                                        <div class="details-pro1">
                                            <span class="title-pro1">نوع پکیج:</span>
                                            <span class="title-pro2 <?php echo ($information_company['packageType']) ?>"><?php echo $information_company['packageType'] ?></span>
                                            <i class="fa fa-trophy i-icon" aria-hidden="true"></i>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="details">
                                            <span class="title">تعداد محصولات:</span>
                                            <b class="title2"><?php echo ($information_company['packageProductCount'] > 100 ? $information_company['productCount'] . "/" . "نامحدود" : $information_company['productCount'] . "/" . $information_company['packageProductCount']) ?></b>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="btn link-show-detail btn-block show-more button-default" href="<?php echo RELA_DIR . 'company/Detail/' . $information_company['companyId'] . '/' . cleanUrl($information_company['companyName']); ?>" name="information_company" title="پنل کاربری" style="margin: 1em 0 0 !important;">نمایش جزئیات مجموعه</a>
                                    </li>
                                </ul>
                            <?php } ?>
                            <div class="footer">
                                <a class="plus1 transition pull-right" href="<?php echo RELA_DIR . "profile"; ?>" name="profile" title="پنل کاربری"> پنل کاربری </a>
                                <a class="plus2 transition pull-right" href="<?php echo RELA_DIR . "login/logout"; ?> " name="logout" title="خروج"> خروج </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Hamburger Menu -->
                <div id="js-hamburger" class="hamburger transition">
                    <span class="first"></span> <span class="second"></span> <span class="third"></span>
                </div>

                <div class="menu-content boxBorder roundCorner transition">
                    <ul class="nav-menu">
                        <li>
                            <a class=" text-ultralight transition active" href="<?php echo RELA_DIR; ?><?= isset($_SESSION['city']) ? $_SESSION['city'] : '' ?>" name="home" title="خانه">خانه</a>
                        </li>
                        <li>
                            <a class=" text-ultralight transition" href="<?php echo RELA_DIR; ?>package/all">لیست تعرفه ها</a>
                        </li>
                        <li>
                            <a class=" text-ultralight transition" href="<?php echo RELA_DIR; ?>news">اخبار</a>
                        </li>
                        <li>
                            <a class=" text-ultralight transition" href="<?php echo RELA_DIR; ?>laws">قوانین و مقررات</a>
                        </li>
                        <li>
                            <a class=" text-ultralight transition" href="<?php echo RELA_DIR; ?>aboutus">درباره تولیدات</a>
                        </li>
                        <li>
                            <a class=" text-ultralight transition" href="<?php echo RELA_DIR; ?>contactus">ارتباط با تولیدات</a>
                        </li>
                    </ul>
                </div>
                <!--end of hamburger menu-->
            </div>
            <?php include __DIR__ . '/search.template.php'; ?>
        </div>
    </header><!-- /end of header -->
    <section class="container  mainContainer">