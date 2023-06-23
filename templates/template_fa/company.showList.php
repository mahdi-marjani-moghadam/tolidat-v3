<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css"/>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.stickit.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.qrcode.min.js"></script>
<style>

    .popoverContainer span {
        width: 100%;
        text-align: center;
        display: block;
        font-family: 'Samim', tahoma, sans-serif !important;
    }
    .popoverContainer span i{
        font-size: 50px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .popover-content {
        padding: 0;
        width: 230px;
        height: 135px;
    }
    .popoverContainer h3 {
        background-color: #5cb85c;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }
    .popoverContainer h4 {
        background-color: #68b5e2;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }
    .popoverContainer h5 {
        background-color: #ddd ;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }

    .popover{
        padding: 0;
    }
    .popoverContainer .fa-exclamation-circle {
        color: #68b5e2;
    }
    .popoverContainer .fa-cubes {
        color: #5cb85c;
    }
    .popoverContainer .fa-trophy {
        color: #ddd;
    }

</style>
<input type="hidden" id="page_type" value="searchPage">

<div class="row fullPadding">

    <?php include_once("breadcrumb.php"); ?>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- boxContainer -->
        <div class="boxContainer">
            <?php /*if ($list['advertise_list']) { ?>
                <?php if (count($list['advertise_list']) > 3) : ?>
                    <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth mb mt advertise">
                        <header>
                            <div class="center-block text-right">
                                تبلیغات
                            </div>
                        </header>
                        <div class="content ltr carousel-slick content-detailP">
                            <?php foreach ($list['advertise_list'] as $item => $value) : ?>
                                <div class="innerContent pull-left  mb-double-slick">
                                    <div class="logoContainer pull-right boxBorder">
                                        <a href="<?php echo $value['url']; ?>">
                                            <img src="<?php echo($value['image'] ? $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>"  class=" boxBorder roundCorner" alt="<?php echo(strlen($value['title']) ? $value['title'] : '-'); ?>">
                                        </a>
                                    </div>
                                    <a href="<?php echo $value['url']; ?>">
                                        <article class="text-light pull-right">
                                        <span>
                                                <?php echo (strlen($value['brif_description']) ? $value['brif_description'] : '-') ?>
                                        </span>
                                            <p>
                                                <?php echo (strlen($value['brif_description']) ? $value['brif_description'] : '-') ?>
                                            </p>
                                        </article>
                                    </a>
                                </div>
                            <?php /*endforeach; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth mb mt advertise">
                        <header>
                            <div class="center-block text-right">
                                تبلیغات
                            </div>
                        </header>
                        <div class="content ltr content-single content-detailP">
                            <?php foreach ($list['advertise_list'] as $item => $value) : ?>
                                <div class="innerContent pull-left  mb-double-slick">
                                    <div class="logoContainer pull-right boxBorder">
                                        <a href="<?php echo $value['url']; ?>">
                                            <img src="<?php echo($value['image'] ? $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>"  class="width boxBorder roundCorner" alt="<?php echo(strlen($value['title']) ? $value['title'] : '-'); ?>">
                                        </a>
                                    </div>
                                    <a href="<?php echo $value['url']; ?>">
                                        <article class="text-light pull-right">
                                    <span>
                                            <?php echo (strlen($value['brif_description']) ? $value['brif_description'] : '-') ?>
                                    </span>
                                            <p>
                                                <?php echo (strlen($value['brif_description']) ? $value['brif_description'] : '-') ?>
                                            </p>
                                        </article>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php /*endif; ?>
            <?php }*/ ?>

            <!-- separator -->
            <div class="row filter-category">
                <!--------------------------------  دسته بندی -------------------------------->
                <div class="col-xs-12 col-sm-5 col-md-3 pull-right key-search skipCatSelection width-position section-title">
                    <?php /*<div class="search-box boxBorder categoryContainer mb-double ">
                        <div class="search-box-header header-color">
                            <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی تولیدی ها</header>
                        </div>
                        <div class="bg-color">
                            <ul class="list-group rtl">
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/10000.png" alt=""> صنعت ساخت و ساز و املاک
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/1730000.png" alt="">  ابزار، قطعات، آلیاژها و صنایع وابسته ابزار، قطعات، آلیاژها و صنایع وابسته
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/5820000.png" alt=""> صنعت،تولید، تجهیزات وابسته
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/5110000.png" alt=""> صنعت تبلیغات و ارتباطات
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/6420000.png" alt=""> صنعت چاپ، بسته بندی
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="search-box boxBorder categoryContainer mb-double ">
                        <div class="search-box-header header-color">
                            <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی تولیدی ها</header>
                        </div>
                        <div class="bg-color">
                            <ul class="list-group rtl">
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/10000.png" alt=""> صنعت ساخت و ساز و املاک
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/1730000.png" alt="">  ابزار، قطعات، آلیاژها و صنایع وابسته ابزار، قطعات، آلیاژها و صنایع وابسته
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/5820000.png" alt=""> صنعت،تولید، تجهیزات وابسته
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/5110000.png" alt=""> صنعت تبلیغات و ارتباطات
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="#">
                                        <i class="fa fa-angle-left"></i>
                                        <img class="pull-right" src="/statics/images/category/tinyCatImg/6420000.png" alt=""> صنعت چاپ، بسته بندی
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>*/?>

                    <div class="search-box boxBorder categoryContainer mb-double ">
                        <div class="overlay-click">
                            <span> لطفا منتظر بمانید...</span>
                            <div class="sk-circle">
                                <div class="sk-circle1 sk-child"></div>
                                <div class="sk-circle2 sk-child"></div>
                                <div class="sk-circle3 sk-child"></div>
                                <div class="sk-circle4 sk-child"></div>
                                <div class="sk-circle5 sk-child"></div>
                                <div class="sk-circle6 sk-child"></div>
                                <div class="sk-circle7 sk-child"></div>
                                <div class="sk-circle8 sk-child"></div>
                                <div class="sk-circle9 sk-child"></div>
                                <div class="sk-circle10 sk-child"></div>
                                <div class="sk-circle11 sk-child"></div>
                                <div class="sk-circle12 sk-child"></div>
                            </div>
                        </div>

                        <div class="search-box-header header-color">
                            <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی تولیدی ها</header>
                        </div>
                        <div class="mmenuHolder2">
                            <nav class="menu mm-opened" data-placeholder="جستجو در دسته بندی تولیدی ها"
                                 data-title="دسته بندی تولیدی ها">
                                <?php echo $list['list']['searchCategoryUlLi']; ?>
                            </nav>
                        </div>
                    </div>

                    <!--------------------------------  شهرها و استان -------------------------------->

                    <div class="search-box boxBorder categoryContainer mb-double3">
                        <div class="overlay-click">
                            <span> لطفا منتظر بمانید...</span>
                            <div class="sk-circle">
                                <div class="sk-circle1 sk-child"></div>
                                <div class="sk-circle2 sk-child"></div>
                                <div class="sk-circle3 sk-child"></div>
                                <div class="sk-circle4 sk-child"></div>
                                <div class="sk-circle5 sk-child"></div>
                                <div class="sk-circle6 sk-child"></div>
                                <div class="sk-circle7 sk-child"></div>
                                <div class="sk-circle8 sk-child"></div>
                                <div class="sk-circle9 sk-child"></div>
                                <div class="sk-circle10 sk-child"></div>
                                <div class="sk-circle11 sk-child"></div>
                                <div class="sk-circle12 sk-child"></div>
                            </div>
                        </div>

                        <div class="search-box-header header-color">
                            <header>شهرها و استان ها<i class="fa fa-map-marker"></i></header>
                        </div>
                        <div class="mmenuHolder3">
                            <nav class="menu mm-opened" data-placeholder="جستجو در شهرها و استان ها"
                                 data-title="دسته بندی شهرها و استان ها">
                                <ul>
                                    <?php foreach ($list['list']['searchProvince'] as $key => $value) { ?>
                                        <?php if ($value['count'] > 0) { ?>
                                            <li>
                                                <a data-toggle="tooltip" data-placement="top"
                                                   title="<?= $value['name'] ?>" class="company-name">
                                                    <span><?= $value['count'] ?></span>
                                                    <label for="province-<?= $value['province_id'] ?>"
                                                           class="company-name"><?= $value['name'] ?>
                                                        <input type="checkbox" name="province[]"
                                                               id="province-<?= $value['province_id'] ?>"
                                                               value="<?= $value['name'] ?>"> </label> </a>

                                                <ul>
                                                    <?php foreach ($value['cities'] as $city_id => $cityFields) { ?>
                                                        <li>
                                                            <a data-toggle="tooltip" data-placement="top"
                                                               title="<?= $cityFields['name'] ?>" class="company-name">
                                                                <span>(<?= $cityFields['count'] ?>)</span>
                                                                <label for="city-<?= $cityFields['City_id'] ?>"
                                                                       class="company-name">
                                                                    <?= $cityFields['name'] ?>
                                                                    <input type="checkbox" name="city[]"
                                                                           id="<?= $cityFields['City_id'] ?>"
                                                                           value="<?= $cityFields['name'] ?>"> </label>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-------------------------------- Tab for grid & list -------------------------------->
                <div class="col-xs-12 col-sm-7 col-md-9 -pull-left">

                    <?php if (isset($msg)) { ?>
                        <div class="whiteBg boxBorder roundCorner clear fullWidth">
                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                            <div class="row mb-double">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <div class="alert alert-warning"><strong>توجه! </strong><? echo $msg; ?> </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-------------------------------- product filter -------------------------------->
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                            <!-------------------------------- فیلتر دسته بندی -------------------------------->

                            <ul class=" filter-container">
                                <?php if (is_array($list['list']['searchItem']['category'])) {

                                    if (count($list['list']['searchItem']['category']) > 1) { ?>
                                        <li class="product-filter roundCorner boxBorder">
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-default dropdown-toggle btn-select "
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">فیلتر دسته بندی ها<span>(<b><?php echo count($list['list']['searchItem']['category']) ?></b>)</span>
                                                    <i class="fa fa-angle-down transition"></i>
                                                </button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['category'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip"
                                                                  data-placement="top"
                                                                  data-original-title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                                <?php echo $list['list']['searchItem']['category'][$a]['title'] ?>
                                                            </span>
                                                            <span class="close-filter-container">
                                                                <a href="#" name="a_category" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                                    <i class="fa" name="category[]"
                                                                       id="<?= $list['list']['searchItem']['category'][$a]['Category_id'] ?>" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>"> </i>
                                                                </a>
                                                            </span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } else {
                                        foreach ($list['list']['searchItem']['category'] as $a => $b) { ?>
                                            <li class="product-filter roundCorner boxBorder color-silver1">
                                                <span class="product-filter-container" data-toggle="tooltip"
                                                      data-placement="top"
                                                      data-original-title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                    <?php echo $list['list']['searchItem']['category'][$a]['title'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#" name="b_category" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                        <i class="fa" name="category[]"
                                                           id="<?php echo $list['list']['searchItem']['category'][$a]['Category_id'] ?>" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>"> </i>
                                                    </a>
                                                </span>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>

                            <!-------------------------------- فیلتر استان ها -------------------------------->

                            <ul class=" filter-container">
                                <?php if (is_array($list['list']['searchItem']['province'])) {
                                    if (count($list['list']['searchItem']['province']['list']) > 1) { ?>
                                        <li class="product-filter roundCorner boxBorder">
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-default dropdown-toggle btn-select "
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    استانها<i class="fa fa-angle-down transition"></i>
                                                </button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['province']['list'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip"
                                                                  data-placement="top"
                                                                  data-original-title="<?= $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                                <?= $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                                            </span> <span class="close-filter-container">
                                                                <a href="#" name="province" title="<?= $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                                    <i class="fa" name="province[]"
                                                                       id="<?= $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>"> </i>
                                                                </a>
                                                            </span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } else {
                                        foreach ($list['list']['searchItem']['province']['list'] as $a => $b) { ?>
                                            <li class="product-filter roundCorner boxBorder color-silver1">
                                                <span class="product-filter-container" data-toggle="tooltip"
                                                      data-placement="top"
                                                      data-original-title="<?= $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                    <?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                                </span> <span class="close-filter-container">
                                                    <a href="#" name="province_a" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                        <i class="fa" name="province[]"
                                                           id="<?php echo $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>"> </i>
                                                    </a>
                                                </span>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>

                            <!-------------------------------- فیلتر شهرها -------------------------------->

                            <ul class=" filter-container">
                                <?php if (is_array($list['list']['searchItem']['city'])) {
                                    if (count($list['list']['searchItem']['city']['list']) > 1) { ?>
                                        <li class="product-filter roundCorner boxBorder">
                                            <div class="btn-group">
                                                <button type="button"
                                                        class="btn btn-default dropdown-toggle btn-select "
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">شهرها<i
                                                            class="fa fa-angle-down transition"></i></button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['city']['list'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip"
                                                                  data-placement="top"
                                                                  data-original-title="<?= $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                                <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                                            </span> <span class="close-filter-container">
                                                                <a href="#" name="city_id" title="<?= $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                                    <i class="fa" name="city[]"
                                                                       id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>"> </i>
                                                                </a>
                                                            </span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } else {
                                        foreach ($list['list']['searchItem']['city']['list'] as $a => $b) { ?>
                                            <li class="product-filter roundCorner boxBorder color-silver1">
                                                <span class="product-filter-container" data-toggle="tooltip"
                                                      data-placement="top"
                                                      data-original-title="<?= $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                    <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                                </span> <span class="close-filter-container">
                                                    <a href="#">
                                                        <i class="fa" name="city[]"
                                                           id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>"> </i>
                                                    </a>
                                                </span>
                                            </li>
                                        <?php }
                                    }
                                } ?>
                            </ul>
                        </div>
                    </div>

                    <!-------------------------------- showGrid and listView -------------------------------->

                    <?php if (!isset($list['type']) || $list['type'] == 'تولیدی') { ?>
                        <?php foreach ($list['list']['company'] as $key => $value) { ?>
                            <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double contentPro contentPro-profile">
                                <a class="single" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                    <header><?php echo($value['company_name'] != "" ? $value['company_name'] : "-"); ?></header>
                                    <div class="content whiteBg roundCorner fullWidth">
                                        <div class="item text-center">
                                            <div class="row noMargin">
                                                <?php
                                                if($value['logo']['image']['0']) {
                                                    ?>
                                                    <div class="col-xs-12 col-sm-3 col-md-2 pull-right boxA">
                                                        <div class="logoContainer pull-right">
                                                            <img data-src="<?php echo($value['logo']['image']['0'] ? COMPANY_ADDRESS . $key . "/logo/140.140." . $value['logo']['image']['0'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" class="lazy boxBorder roundCorner">
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="col-xs-<?php echo($value['logo']['image']['0'] ? '12' : '12'); ?> col-sm-<?php echo($value['logo']['image']['0'] ? '5' : '8'); ?> col-md-<?php echo($value['logo']['image']['0'] ? '7' : '9'); ?> pull-right boxA noPadding">
                                                    <div class="text pull-right">
                                                        <p class="search-text"><?php echo($value['description'] != "" ? $value['description'] : "-"); ?></p>
                                                    </div>
                                                    <button class="btn link-show-detail search-btn button-default show-more pull-right">مشاهده بیشتر</button>
                                                </div>

                                                <div class="col-xs-12 col-sm-5 col-md-3 pull-right boxA noPadding">
                                                    <div class="side-bar-knob Percent-box center-block">
<!--                                                        --><?php //<div class="content-circular-process">
/*                                                            <input type="text" value="<?php echo $value['priority']; ?>" class="dial"><span class="icon-percent">%</span>*/
//                                                        </div> ?>

                                                        <div id="pieChart<?php echo $value['Company_id']; ?>" class="content-circular-process center-block roundCornerFull"></div>

                                                        <input type="hidden" class="chartDataHolder" value='<?php echo json_encode($value['priority_details']) ?>'>

                                                        <ul class="icon-side text-center">
                                                            <li>
                                                                <span data-html="true" data-trigger="hover" rel="popover" data-content="<div class='popoverContainer'><h3>تأیید شده توسط تولیدات</h3> <span><i class='fa fa-check-square-o' aria-hidden='true'></i></span><span>تأیید شده توسط تولیدات</span></div>"  data-placement="top" >
                                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                                </span>
                                                            </li>
                                                            <?php
                                                            if((int)$value['rate']['product_count']) {
                                                            ?>
                                                            <li class="<?php echo ((int)$value['rate']['product_count'] == 0 ? "disabled" : ""); ?>">
                                                                <span data-html="true" data-trigger="hover" rel="popover" data-content="<div class='popoverContainer'><h3>محصولات</h3><span><i class='fa fa-cubes' aria-hidden='true'></i></span><span><?php echo((int)$value['rate']['product_count'] != 0 ? $value['rate']['product_count'] . ' محصول معرفی شده' : 'بدون محصول'); ?></span></div>"  data-placement="top" >
                                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                                </span>
                                                            </li>
                                                            <?php
                                                            }
                                                            ?>

                                                            <?php if ($value['package_status'] == 1) { ?>
                                                            <li <?= ((int)$value['rate']['package_type'] == 0 ? 'class="disabled"' : ''); ?>>
                                                                <span data-html="true" data-trigger="hover" rel="popover" data-content="<div class='popoverContainer'><h5>پکیج <?= ((int)$value['rate']['package_type'] != 0 ? $value['rate']['package_type'] : 'رایگان'); ?></h5><span><i class='fa fa-trophy' aria-hidden='true'></i></span><span>پکیج <?= ((int)$value['rate']['package_type'] != 0 ? $value['rate']['package_type'] : 'رایگان'); ?></span></div>"  data-placement="top" >
                                                                    <i class="fa fa-trophy" aria-hidden="true"></i>
                                                                </span>
                                                            </li>
                                                            <?php } ?>
                                                            <li>
                                                                <span data-html="true" data-trigger="hover" rel="popover" data-content="<div class='popoverContainer'><h4>نوع مجموعه</h4><span><i class='fa fa-exclamation-circle' aria-hidden='true'></i></span><span><?= $value['rate']['personality_type'] ?></span></div>"  data-placement="top" >
                                                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <?php /*<div class="card" style="left: <?php echo $value['package_status'] != 1 ? '55px' : '55px'; ?>">
                                    <a class="single" data-toggle="modal" data-target="#myModal">
                                       <span   data-toggle="tooltip"  title="کارت ویزیت" data-placement="top" >
                                          <i class="fa fa-id-card" aria-hidden="true"></i>
                                       </span>
                                    </a>
                                </div>*/?>
                                <!-- Modal -->
                                <?php /*<div class="modal fade holder-modal card-panel" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="content" style="background: url('http://tolidat.ir/statics/images/company/21153/banner/1260.210.1512977614._kiapardazesh.jpg') no-repeat center / cover">
                                                </div>
                                                <div class="contBaner1">
                                                    <a class="roundCorner single">
                                                        <img class="boxBorder roundCorner width " src="http://tolidat.ir/statics/images/company/21153/logo/150.150.22975525_tmp.png">
                                                    </a>
                                                    <header class="title1">کیاپردازش</header>
                                                </div>
                                                <div class="row noMargin">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                                                        <p>
                                                            تولید مواد شیمیائی و سیستم های تصفیه آب و ساخت کیت های آنالیز آب
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer noPadding pt">
                                                <div class="row noMargin">
                                                    <div class="col-xs-12 col-sm-12 col-md-4 pull-right Description">
                                                        <span class="title2 mt"> نوع پکیج</span>
                                                        <div class="content">
                                                            <span class="icon"><i class="fa fa-trophy" aria-hidden="true"></i></span>
                                                            طلایی
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-4 pull-right Description">
                                                        <span class="title2 mt">تعداد محصول</span>
                                                        <div class="content">
                                                            <span class="title3">
                                                              28
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-4 pull-right Description">
                                                        <div class="content mt-new">
                                                            <div id="qrcode" class="center-block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>*/?>
                                <div class="container-edit-pen">
                                    <?php echo($value['package_status'] != 1 ? "<a class='" . $value['rate']['package_class'] . "' data-toggle='tooltip' data-placement='top' title='پکیج " . ((int)$value['rate']['package_type'] != 1 ? $value['rate']['package_type'] : "رایگان") . "'><i class='fa fa-trophy' aria-hidden='true'></i></a>" : "<a class='editWiki btn btn-sm btn-success'  data-companyname='".($value['company_name'] != "" ? $value['company_name'] : "-")."' data-value='" . $value['Company_id'] . "'  data-company_type='" . $value['company_type'] . "' data-toggle='tooltip' data-placement='right' title='' data-original-title='ویرایش اطلاعات'>ویرایش</a>"); ?>
                                </div>
                                <div class="panel-footer tag">
                                    <span class="pull-right"><i class="fa fa-map-marker"></i></span>
                                    <a class="pull-right" href="<?= RELA_DIR . "company/type/تولیدی/province/" . $list['list']['searchProvince'][$value['state_id']]['name'] ?>" class="city"><?= $list['list']['searchProvince'][$value['state_id']]['name'] ?></a>
                                    <span class="pull-right" style="margin: 0 5px"><i class="fa fa-bars text-center" aria-hidden="true"></i></span>
                                    <?php $count = count($value['category_title']) ?>
                                    <?php foreach ($value['category_title'] as $cat_id => $category) : ?>
                                        <a class="pull-right" href="<?= RELA_DIR . "company/type/تولیدی/category/" . $cat_id ?>"> <?php echo $category; echo($count > 1 ? " , " : ""); $count-- ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <?php foreach ($list['list']['c_products'] as $key => $value) { ?>
                            <div class="col-xs-6 col-sm-6 col-md-4 gridList BoxB boxSearch pull-right mt noPadding">
                                <div class="boxGrid-pane whiteBg boxBorder roundCorner">
                                    <div class="row margin-bottom">

                                        <div class="col-xs-12 col-sm-5 col-md-5 list1">
                                            <a href="<?php echo RELA_DIR . 'product/Detail/' . $value['Company_products_id'] . '/' . $value['title']; ?>">
                                                <img src="<?php $value['image'] ?>" alt="<?php $value['title'] ?>"> </a>
                                        </div>

                                        <div class="col-xs-12 col-sm-7 col-md-7 list2 boxLeft">
                                            <a href="<?php echo RELA_DIR . 'product/Detail/' . $value['Company_products_id'] . '/' . $value['title']; ?>">
                                                <p>
                                                    <span> <i class="fa fa-sticky-note" aria-hidden="true"></i> <b>نام تولیدی:</b> </span><span><? echo($value['title'] != "" ? $value['title'] : "-"); ?></span>
                                                </p>
                                                <p>
                                                    <span>
                                                        <i class="fa fa-file-text"
                                                           aria-hidden="true"></i> <b>توضیحات:</b>
                                                    </span><span><? echo($value['description'] != "" ? $value['description'] : "-"); ?></span>
                                                </p>
                                            </a>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 description1">

                                            <div class="row">

                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <p><b><i class="fa fa-envelope" aria-hidden="true"></i></b>
                                                        <b>ایمیل:</b>
                                                        <a href="mailto:<?php $value['company_email']['email'][0] ?>"><span><?php echo($value['company_email']['email'][0] != "" ? $value['company_email']['email'][0] : "-"); ?></span></a>
                                                    </p>
                                                </div>

                                                <div class="col-xs-12 col-sm-4 col-md-4">
                                                    <p><b><i class="fa fa-internet-explorer" aria-hidden="true"></i></b>
                                                        <b>آدرس اینترنتی:</b> <a
                                                                href="<?php $value['company_website']['url'][0] ?>"><span><?php echo($value['company_website']['url'][0] != "" ? $value['company_website']['url'][0] : "-"); ?> </span></a>
                                                    </p>
                                                </div>

                                                <div class="col-xs-12 col-sm-4 col-md-4">

                                                    <p>
                                                        <b> <i class="fa fa-phone-square" aria-hidden="true"></i> </b>
                                                        <b>شماره تلفن:</b>
                                                        <span><?php echo($value['company_phone']['number'][0] != "" ? $value['company_phone']['number'][0] : "-"); ?></span>
                                                    </p>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <a href="<?php echo RELA_DIR . 'product/Detail/' . $value['Company_products_id'] . '/' . $value['title']; ?>"
                                   class="btn btn-link btnDetail transition roundCorner" title="<?php $value['title']; ?>">نمایش</a></div>
                        <?php } ?>
                    <?php } ?>

                    <!-------------------------------- Related Results -------------------------------->

                    <div class="row">

                        <?php if ($list['searchSuggestion'] == '') { ?>
                        <?php } else { ?>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double3 contentPro contentPro-profile related-search-box">
                                    <header>
                                        <div class="text-right text-danger">
                                            نتایج مرتبط با عبارت جستجو شده
                                        </div>
                                    </header>
                                    <div class="row noMargin">
                                        <?php foreach ($list['searchSuggestion']['value'] as $key => $value) { ?>
                                            <div class="col-xs-12 col-sm-4 col-md-3 pull-right">
                                                <a class="text-right transition"
                                                   href="<?= RELA_DIR ?>search/type/<?= (($list['searchSuggestion']['type'] == '0') ? 'تولیدی' : 'محصولات'); ?>/q/<?= $value; ?>" name="<?= $value; ?>" title="<?= $value; ?>">
                                                    <?= $value ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="col-xs-12 col-sm-12 col-md-9 pagination-search pagination-search1 pull-right">
                            <div class="whiteBg boxBorder roundCorner fullWidth mb Pagination">

                                <!-------------------------------- pagination -------------------------------->

                                <ul class="pagination center-block">
                                    <?php
                                    foreach ($list['pagination']['company']['list'] as $href) {
                                        if ($href['label'] == ">") {
                                            $href['label'] = "<i class='fa fa-angle-right' aria-hidden='true'></i>";
                                        } elseif ($href['label'] == "<") {
                                            $href['label'] = "<i class='fa fa-angle-left' aria-hidden='true'></i>";
                                        }
                                        ?>
                                        <li>
                                            <a class=" transition <?php echo $href['activePage'] ?>" href="<?php echo RELA_DIR . $href['address'] ?>" name="<?php echo $href['label'] ?>" title="<?php echo $href['label'] ?>">
                                                <?php echo $href['label'] ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                                <div class="input-group center-block">
                                    <input type="text" class="form-control input-search" id="input-search"
                                           placeholder="شماره صفحه ..."> <span class="input-group-btn btn-arrow">
                                        <a class="btn btn-default button-search" id="button-search" type="button">
                                            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                </div>

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3 pagination-search">
                            <div class=" whiteBg boxBorder roundCorner fullWidth mb Pagination">

                                <!-------------------------------- تعداد صفحه -------------------------------->

                                <div class="jPager center-block  roundCorner border pull-left">
                                    <span>تعداد صفحه :</span>
                                    <?php echo $list['pagination']['company']['pageCount'] . "<br>" ?>
                                </div>

                                <!-------------------------------- تعداد رکورد -------------------------------->

                                <div class="jPager center-block  roundCorner">
                                    <span>تعداد رکورد :</span>
                                    <?php echo $list['pagination']['company']['rowCount'] . "<br>" ?>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!--  end showGrid and listView -->

        </div>
    </div>
</div>

<?php include_once "wiki.template.php"; ?>

<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/highcharts/highcharts.js"></script>

<div class="row xxsmallSpace"></div>

<script>
    $(function() {
        //------> search box
        $("#button-search").on("click", function () {

            var k = $(location).attr('href').split('/');
            var url = '';
            var result = k.indexOf('page');
            if (result == -1) {
                url = $(location).attr('href') + "/page/" + $("#input-search").val();
            } else {
                k[result + 1] = $("#input-search").val();
                url += k.join('/');
            }

            $(this).attr("href", url);
        });
        // end search box

        <?php /*function merge(a1, a2) {
            //debugger;
            var hash = {};
            var arr = [];
            for (var i = 0; i < a1.length; i++) {
                if (hash[a1[i]] !== true) {
                    hash[a1[i]] = true;
                    arr[arr.length] = a1[i];
                }
            }
            for (var i = 0; i < a2.length; i++) {
                if (hash[a2[i]] !== true) {
                    hash[a2[i]] = true;
                    arr[arr.length] = a2[i];
                }
            }
            return arr;
        }

        try {
            var locationAddr = window.location.href,
                addr = locationAddr.split('category')[1].split('/'),
                counter = 0;

            addr = addr.filter(function (n) {
                return n.length
            });

            addr = addr[0].split(",");

            var parentArr = [],
                childArr = [],
                totalArr = [];
            setTimeout(function () {
                // separate values from url address in parent and child arrays
                $.each(addr, function (i, v) {
                    var $input = $('input[value="' + v + '"]');
                    var id = $input.data('parentid').toString();

                    if (id !== "0") {
                        childArr.push($input.val());
                    } else {
                        parentArr.push($input.val());
                    }
                });

                // remove parent of exist child in parent array
                $.each(childArr, function (i, v) {
                    var parent = $('input[value="' + v + '"]').data('parentid').toString();

                    if ($.inArray(parent, parentArr) !== -1) {
                        var j = parentArr.indexOf(parent);
                        if (j !== -1) {
                            parentArr.splice(i, 1);
                        }
                    }
                });

                var mergeArrays = merge(childArr, parentArr),
                    finalValue = mergeArrays[mergeArrays.length - 1];

                // finally merge child and parent arrays
                totalArr = mergeArrays.join(',');

                locationAddr = locationAddr.split('category')[0] + 'category/' + totalArr + '/';

                window.history.pushState('', '', locationAddr);

                var finalValueParent = $('input[value="' + finalValue + '"]').data('parentid').toString();

                //
                if (finalValueParent !== '0') {
                    var finalValueRoot = $('input[value="' + finalValueParent + '"]').data('parentid').toString();

                    if (finalValueRoot !== '0') {
                        // two level open
                        goToMenu(finalValueRoot);

                        setTimeout(function () {
                            goToMenu(finalValueParent);
                        }, 500)
                    } else {
                        // on level open
                        goToMenu(finalValueParent);
                    }
                } else {
                    // just open sub level
                    goToMenu(finalValue);
                }

            }, 1000);
        } catch (e) {
            // error
        }

        function goToMenu(selector) {
            $('input[value="' + selector + '"]').parent().parent().prev().trigger('click');
        } */ ?>

        $('.section-title').stickit ({
            screenMinWidth: 768,
            scope: StickScope.Document,
            top: 115,
            zIndex: 1,
            overflowScrolling: false
        }, {
            screenMinWidth: 1200,
            top: 85
        });

        $('#qrcode').qrcode({
            text: "<?php echo $list['list']['phone_main'] ?>",
            width: 65,
            height: 65
        });

        $('[rel="popover"]').each(function() {
            var $this = $(this),
                content = $(this).data('content'),
                trigger = $(this).data('trigger');

            $this.popover({
                container: 'body',
                html: true,
                content: content,
                trigger: trigger
            })
        });

        $('.content-circular-process').each(function() {
            try {
                var pieContainer = $(this).attr('id'),
                    priorityArr = JSON.parse(JSON.parse($(this).next('.chartDataHolder').val())),
                    serie,
                    pieDataSeries = [],
                    sumPercent = 0,
                    remainPercent = 100;

                if(priorityArr) {
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

                    var pieOptions = {
                        chart: {
                            renderTo: pieContainer,
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie',
                            events: {
                                load: function() {
                                    $('#'+pieContainer).append('<div class="totalContainer transition text-center">'+sumPercent+' %</div>');
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
                            }
                        },
                        series: [{
                            data: pieDataSeries,
                            innerSize: '80%'
                        }]
                    };

                    new Highcharts.Chart(pieOptions);
                }

            } catch(e) {console.log(e)}
        });


    });

</script>