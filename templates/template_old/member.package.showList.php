<?php $notification = getNotification();
$information_company = getInformation();
?>

<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/template_fa/assets/css/styleprice.css">
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/priceList.js"></script>

<!-- separator -->
<div class="row xxsmallSpace"></div>

<!--container iziToast-->
<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<!--title-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="تیتر محصولات" class="title-pro">ارتقای پکیج خریداری شده</span>
        </div>
    </div>
</div>

<!-- boxContainer -->
<div class="boxContainer reg-container containerNew roundCorner pack ">
    <!-- separator -->
    <div class="row xxsmallSpace"></div>

    <form action="/member/invoice/exportation" method="post">
        <?php /*<div class="container boxPriceContainer withoutFree" style="max-width: 700px !important;">
            <input class="packageType" name="package_type" type="hidden" value="<?php echo($list['valid'][array_keys($list['valid'])[0]]['Package_id']) ?>">
            <input type="hidden" class="packagesList" value='<?php echo json_encode($list['valid']); ?>'>
            <!-- separator -->
            <div class="row xsmallSpace"></div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 center-block mb3">
                    <div class="boxPrice <?php echo($list['valid'][array_keys($list['valid'])[0]]['englishTitle']) ?>">
                        <div class="tab-container">
                            <ul>
                                                <li class="pull-right active">
                                                    <a data-id="<?php echo($list['valid'][1]['Package_id']) ?>" data-type="bronze" class="text-center white-color bronze">برنز</a>
                                                </li>
                                                <li class="pull-right">
                                                    <a data-id="<?php echo($list['valid'][2]['Package_id']) ?>" data-type="silver" class="text-center white-color silver">نقره ای</a>
                                                </li>
                                                <li class="pull-right">
                                                    <a data-id="<?php echo($list['valid'][3]['Package_id']) ?>" data-type="gold" class="text-center white-color gold">طلایی</a>
                                                </li>
                                                <li class="pull-right">
                                                    <a data-id="<?php echo($list['valid'][4]['Package_id']) ?>" data-type="platinum" class="text-center white-color platinum">پلاتینیوم</a>
                                                </li>
                            </ul>
                        </div>
                        <div class="box-title">
                            <h3 class="white-color text-center rtl">پکیج <span class="package-type">برنز</span></h3>

                            <div class="white-color price-container rtl text-center">
                                <span class="price-holder"><?php echo number_format($list['valid'][array_keys($list['valid'])[0]]['price']); ?></span> ریال / سالیانه
                            </div>
                        </div>
                        <ul class="price-list">
                            <li class="counter-holder">
                                <div class="category pull-right">
                                    <h6 class="text-center text-danger">دسته بندی</h6>
                                    <span class="cat count-holder text-center pull-left"><?php echo $list['valid'][array_keys($list['valid'])[0]]['category']; ?></span>
                                    <button type="button" class="plus text-center pull-right"></button>
                                </div>

                                <div class="product pull-left">
                                    <h6 class="text-center text-danger">محصولات / خدمات</h6>
                                    <span class="prod count-holder text-center pull-left"><?php echo $list['valid'][array_keys($list['valid'])[0]]['product']; ?></span>
                                    <button type="button" class="minus text-center pull-left" disabled></button>
                                </div>
                            </li>
                            <li class="rtl text-right">
                                <i class="fa fa-search-plus green-color pull-right text-center"></i> کلمات کلیدی
                                <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                            </li>
                            <li class="rtl text-right">
                                <i class="fa fa-sitemap green-color pull-right text-center"></i> شعبه
                                <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                            </li>
                            <li class="rtl text-right">
                                <i class="fa fa-building green-color pull-right text-center"></i> نمایندگی
                                <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                            </li>
                            <li class="rtl text-right">
                                <i class="fa fa-briefcase green-color pull-right text-center"></i> فرصت های شغلی
                                <span class="pull-left"><i class="fa fa-check text-success"></i></span>
                            </li>
                            <li class="rtl text-center choose-button">
                                <button type="submit" data-id="<?php echo($list['valid'][1]['Package_id']) ?>" class="btn btn-default btn-block bronze white-color choosePkg">انتخاب</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- separator -->
            <div class="row xsmallSpace"></div>
        </div>*/?>

        <input class="packageType" name="package_type" type="hidden" value="<?php echo($list['valid'][array_keys($list['valid'])[0]]['Package_id']) ?>">

        <div class="table-responsive center-block paddingRl no-border" style="max-width: 800px !important;">
            <table class="table table-bordered table-striped table-price">
                <thead>
                <tr style="height: 70px;">
                    <th class="package">
                        <span class="tablePackageNames">پکیج (سالیانه)</span>
                        <hr>
                        <span class="tableFeatures">امکانات</span>
                    </th>
                    <?php
                    foreach ($list['valid'] as $package) {
                        ?>
                        <th class="package text-white text-center <?php echo $package['englishTitle'] ?>"><?php echo $package['packagetype']; ?></th>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-right" style="width: 200px;">پروفایل شخصی</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">دسته بندی</td>
                    <?php
                    foreach ($list['valid'] as $package) {
                        ?>
                        <td class="text-center text-bold text-danger"><?php echo $package['category']; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td class="text-right">ماژول محصول / خدمات</td>
                    <?php
                    foreach ($list['valid'] as $package) {
                        ?>
                        <td class="text-center text-bold text-danger"><?php echo $package['product']; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td class="text-right">ماژول سوابق و مشتریان</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول نام تجاری</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول افتخارات</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول اخبار و رویداد</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول نمایندگی / شعبه</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول فرصت های شغلی</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول آگهی ها</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">ماژول فرم تماس</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td class="text-right">کلمات کلیدی</td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                    <td class="text-center text-success"><i class="fa fa-check"></i></td>
                </tr>
                <tr>
                    <td rowspan="2" class="text-right text-danger text-bold" style="vertical-align: middle">قیمت نهایی (ریال)</td>
                    <?php
                    foreach ($list['valid'] as $package) {
                        ?>
                        <td class="text-center text-danger text-bold"><?php echo number_format((int)$package['price'], 0); ?></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr class="choose-button">
                    <?php
                    foreach ($list['valid'] as $package) {
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
    </form>
</div>