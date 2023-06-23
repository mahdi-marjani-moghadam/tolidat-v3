<link rel="stylesheet" href="<?php echo RELA_DIR; ?>templates/template_fa/assets/css/styleprice.css">
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo RELA_DIR; ?>templates/template_fa/assets/js/priceList.js"></script>
<?php $notification = getNotification();
$information_company = getInformation(); ?>
<div class="row noMargin">
    <div class="col-xs-12 col-sm-12 col-md-12 mb noPadding">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>"> <i class="fa fa-home" aria-hidden="true"></i> </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>لیست تعرفه پکیج ها</span></a>
        </div>
    </div>
</div>
<!-- boxContainer -->
<div class="boxContainer reg-container containerNew whiteBg boxBorder roundCorner pack ">
    <input type="hidden" class="packagesList" value='<?php echo json_encode($list['packages']); ?>'>

    <?php /*<div class="container boxPriceContainer" style="max-width: 700px !important;">
        <!-- separator -->
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
                            <i class="fa fa-cubes green-color pull-right text-center"></i> محصولات / خدمات
                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-list green-color pull-right text-center"></i> دسته بندی
                            <span class="pull-left cat">1</span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-search-plus green-color pull-right text-center"></i> کلمات کلیدی
                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-sitemap green-color pull-right text-center"></i> شعبه
                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-building green-color pull-right text-center"></i> نمایندگی
                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-briefcase green-color pull-right text-center"></i> فرصت های شغلی
                            <span class="pull-left"><i class="fa fa-times text-danger"></i></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb3">
                <div class="boxPrice bronze">
                    <div class="tab-container">
                        <ul>
                            <li class="pull-right active">
                                <a data-id="<?php echo($list['packages'][1]['Package_id']) ?>" data-type="bronze" class="text-center white-color bronze">برنز</a>
                            </li>
                            <li class="pull-right">
                                <a data-id="<?php echo($list['packages'][2]['Package_id']) ?>" data-type="silver" class="text-center white-color silver">نقره ای</a>
                            </li>
                            <li class="pull-right">
                                <a data-id="<?php echo($list['packages'][3]['Package_id']) ?>" data-type="gold" class="text-center white-color gold">طلایی</a>
                            </li>
                            <li class="pull-right">
                                <a data-id="<?php echo($list['packages'][4]['Package_id']) ?>" data-type="platinum" class="text-center white-color platinum">پلاتینیوم</a>
                            </li>
                        </ul>
                    </div>
                    <div class="box-title">
                        <h3 class="white-color text-center rtl">پکیج <span class="package-type">برنز</span></h3>

                        <div class="white-color price-container rtl text-center">
                            <span class="price-holder"><?php echo $list['packages'][1]['price']; ?></span> ریال / سالیانه
                        </div>
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
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 pull-right mb3">
                <div class="boxPrice eydaneh">
                    <div class="box-title">
                        <h3 class="white-color text-center rtl">پکیج
                            <span class="package-type"><?php echo($list['extra_packages'][0]['packagetype']) ?></span>
                        </h3>

                        <div class="white-color price-container rtl text-center">
                            <span class="price-holder"><?php echo number_format($list['extra_packages'][0]['price']) ?></span> ریال / سالیانه
                        </div>
                    </div>
                    <ul class="price-list">
                        <li class="empty"></li>
                        <li class="rtl text-right">
                            <i class="fa fa-cubes green-color pull-right text-center"></i> محصولات / خدمات
                            <span class="pull-left text-right cat"><?php echo($list['extra_packages'][0]['product']) ?></span>
                        </li>
                        <li class="rtl text-right">
                            <i class="fa fa-list green-color pull-right text-center"></i> دسته بندی
                            <span class="pull-left text-right cat"><?php echo($list['extra_packages'][0]['category']) ?></span>
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
                    </ul>
                </div>
            </div>
        </div>

        <!-- separator -->
        <div class="row xsmallSpace"></div>
    </div>*/?>

    <!-- separator -->
    <div class="row xxsmallSpace"></div>

    <h3 class="text-center">پکیج های تجاری تولیدات</h3>

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
                <th class="package text-white text-center <?php echo $package['englishTitle'] ?>"><?php echo $package['packagetype']; ?></th>
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
                    <a href="<?php echo RELA_DIR.'register'; ?>" data-id="0" type="submit" class="btn btn-default btn-block free choosePkg">انتخاب پکیج رایگان</a>
                </td>
            <?php
            foreach ($list['packages'] as $package) {
                ?>
                <td class="text-center">
                    <a href="<?php echo RELA_DIR.'register'; ?>" data-id="<?php echo $package['Package_id']; ?>" class="btn btn-block white-color choosePkg <?php echo $package['englishTitle']; ?>">انتخاب پکیج <?php echo $package['packagetype']; ?></a>
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
</div>

<script>
    $(function() {
        $('.choosePkg').on('click', function(e) {
            e.preventDefault();

            var dataId = $(this).data('id');

            window.localStorage.setItem("packageType", dataId);

            window.location.replace("<?php echo RELA_DIR; ?>register");
        });
    });
</script>