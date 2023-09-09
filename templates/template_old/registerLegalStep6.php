<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/priceList.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/template_fa/assets/css/styleprice.css">

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>تعرفه پکیج ها</span></a>
        </div>
    </div>
</div>
<section class="container noPadding container-register" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div class="boxContainer reg-container">
        <div class="registerPage center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">لطفا پکیج مورد نظر را انتخاب نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">5 از 6</div></a>
            </header>
            <div class="content">
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <input class="packageType" name="package_type" type="hidden" value="<?php echo($list['packages'][1]['Package_id']) ?>">
                    <input type="hidden" class="packagesList" value='<?php echo json_encode($list['packages']); ?>'>

                    <?php /*<div class="container boxPriceContainer" style="max-width: 700px !important;">
                        <div class="row xsmallSpace"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb3">
                                <div class="boxPrice free">
                                    <div class="box-title">
                                        <h3 class="text-center rtl">پکیج <span>رایگان</span></h3>
                                    </div>
                                    <ul class="price-list">
                                        <li class="empty"></li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-cubes green-color pull-right text-center"></i>
                                            محصولات / خدمات
                                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-list green-color pull-right text-center"></i>
                                            دسته بندی
                                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-search-plus green-color pull-right text-center"></i>
                                            کلمات کلیدی
                                            <span class="pull-left text-right cat">1</span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-sitemap green-color pull-right text-center"></i>
                                            شعبه
                                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-building green-color pull-right text-center"></i>
                                            نمایندگی
                                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-briefcase green-color pull-right text-center"></i>
                                            فرصت های شغلی
                                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                                        </li>
                                        <li class="rtl text-center choose-button">
                                            <button data-id="0" type="submit" class="btn btn-default btn-block free choosePkg">انتخاب</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb3">
                                <div class="boxPrice bronze">
                                    <div class="tab-container">
                                        <ul></ul>
                                    </div>
                                    <div class="box-title">
                                        <h3 class="white-color text-center rtl">پکیج <span class="package-type">برنز</span></h3>

                                        <div class="white-color price-container rtl text-center"><span class="price-holder"><?php echo $list['packages'][1]['price']; ?></span> ریال / سالیانه</div>
                                    </div>
                                    <ul class="price-list">
                                        <li class="counter-holder">
                                            <div class="category pull-right">
                                                <h6 class="text-center text-danger">دسته بندی</h6>
                                                <span class="cat count-holder text-center pull-left"><?php echo $list['packages'][1]['category']; ?></span>
                                                <button type="button" class="plus text-center pull-right"></button>
                                            </div>

                                            <div class="product pull-left">
                                                <h6 class="text-center text-danger">محصولات / خدمات</h6>
                                                <span class="prod count-holder text-center pull-left"><?php echo $list['packages'][1]['product']; ?></span>
                                                <button type="button" class="minus text-center pull-left" disabled></button>
                                            </div>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-search-plus green-color pull-right text-center"></i>
                                            کلمات کلیدی
                                            <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-sitemap green-color pull-right text-center"></i>
                                            شعبه
                                            <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-building green-color pull-right text-center"></i>
                                            نمایندگی
                                            <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                                        </li>
                                        <li class="rtl text-right">
                                            <i class="fa fa-briefcase green-color pull-right text-center"></i>
                                            فرصت های شغلی
                                            <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                                        </li>
                                        <li class="rtl text-center choose-button">
                                            <button type="submit" data-id="<?php echo($list['packages'][1]['Package_id']) ?>" class="btn btn-default btn-block bronze white-color choosePkg">انتخاب</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row xsmallSpace"></div>
                    </div>*/?>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="packageHolder hidden">
                        <h4 class="text-center">پکیح انتخابی شما : <span></span></h4>
                        <h5 class="text-center text-danger">در صورت مورد تأیید بودن پکیج مورد نظر، بر روی دکمه انتخاب کلیک نمایید</h5>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="table-responsive center-block paddingRl no-border" style="max-width: 950px !important;">
                        <table class="table table-bordered table-striped table-price">
                            <thead>
                            <tr style="height: 70px;">
                                <th class="package">
                                    <span class="tablePackageNames">پکیج (سالیانه)</span>
                                    <hr>
                                    <span class="tableFeatures">امکانات</span>
                                </th>
                                <th class="package text-center free">رایگان</th>
                                <?php
                                foreach ($list['packages'] as $package) {
                                    ?>
                                    <th data-packagefa="<?php echo $package['packagetype']; ?>" data-packagename="<?php echo $package['englishTitle'] ?>" class="package text-white text-center <?php echo $package['englishTitle'] ?>"><?php echo $package['packagetype']; ?></th>
                                    <?php
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-right" style="width: 200px;">پروفایل شخصی</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">دسته بندی</td>
                                <td class="text-center text-bold text-danger">1</td>
                                <?php
                                foreach ($list['packages'] as $package) {
                                    ?>
                                    <td class="text-center text-bold text-danger"><?php echo $package['category']; ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول محصول / خدمات</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <?php
                                foreach ($list['packages'] as $package) {
                                    ?>
                                    <td class="text-center text-bold text-danger"><?php echo $package['product']; ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول سوابق و مشتریان</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول نام تجاری</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول افتخارات</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول اخبار و رویداد</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول نمایندگی / شعبه</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول فرصت های شغلی</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول آگهی ها</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">ماژول فرم تماس</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td class="text-right">کلمات کلیدی</td>
                                <td class="text-center text-danger"><i class="fa fa-times"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                                <td class="text-center text-success"><i class="fa fa-check"></i></td>
                            </tr>
                            <tr>
                                <td rowspan="2" class="text-right text-danger text-bold" style="vertical-align: middle">قیمت نهایی (ریال)</td>
                                <td class="text-center">رایگان</td>
                                <?php
                                foreach ($list['packages'] as $package) {
                                    ?>
                                    <td class="text-center text-danger text-bold"><?php echo number_format((int)$package['price'], 0); ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <tr class="choose-button">
                                <td class="text-center">
                                    <button data-id="0" type="submit" class="btn btn-default btn-block free choosePkg">انتخاب پکیج رایگان</button>
                                </td>
                                <?php
                                foreach ($list['packages'] as $package) {
                                    ?>
                                    <td class="text-center">
                                        <button type="submit" data-id="<?php echo $package['Package_id']; ?>" class="btn btn-block white-color choosePkg <?php echo $package['englishTitle']; ?>">انتخاب پکیج <?php echo $package['packagetype']; ?></button>
                                    </td>
                                    <?php
                                }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <input name="step" type="hidden" value="7">
                    <input  name="company_type" type="hidden" value="1">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate"
                        data-toggle="validator">
                    <input name="step" type="hidden" value="5">
                    <input name="company_type" type="hidden" value="1">
                    <button name="step2" type="submit" class="btn btn-danger btn-sm reg-btn-p">مرحله قبل
                        <span class="fa fa-angle-right"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script>
    $(function () {
        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content');
        }
    });

    $('.cart a').on('click', function () {
        var id = $(this).data('id');
        if (id == '0') {
            $('.reg-btn-n').empty().html('ثبت<span class="fa fa-angle-left"></span>');
        } else {
            $('.reg-btn-n').empty().html('مرحله بعد<span class="fa fa-angle-left"></span>');
        }
    });

    var packageType = parseInt(window.localStorage.getItem('packageType')) + 2,
        activePackageColor = $('.table-price thead th:nth-child('+packageType+')').data('packagename'),
        activePackagefa = $('.table-price thead th:nth-child('+packageType+')').data('packagefa');

    if(packageType !== null) {
        $('.packageHolder').removeClass('hidden');
        $('.packageHolder').find('span').html(activePackagefa).addClass(activePackageColor);


        $('.table-price tbody tr').each(function() {
            $(this).find('td:nth-child('+packageType+')').addClass('active '+activePackageColor);
        });
    }

</script>

