<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/slick.min.js"></script>

<?php // dd($list); ?>

<input type="hidden" id="page_type" value="searchPage">

<div class="row fullPadding">
    <?php include_once("breadcrumb.php"); ?>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <!-- boxContainer -->
        <div class="boxContainer">

            <!-------------------------------- SiteMap (BreadCrumb) -------------------------------->

            <div class="row">
                <!-- breadcrumb -->
                <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                    <?php include_once("breadcrumb.php"); ?>
                </div>
                <!-- /end of breadcrumb -->
            </div>

            <div class="row filter-category">

                <!--------------------------------  tab for cityList -------------------------------->

                <div class="col-xs-12 col-sm-5 col-md-3 pull-right key-search skipCatSelection width-position">

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
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <p>دسته بندی تولیدی ها</p>
                        </div>

                        <div class="mmenuHolder2">
                            <nav class="menu mm-opened" data-placeholder="جستجو در دسته بندی تولیدی ها" data-title="دسته بندی تولیدی ها">
                                <?php echo  $list['list']['searchCategoryUlLi'] ?>
                            </nav>
                        </div>
                    </div>


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
                            <i class="fa fa-map-marker"></i>
                            <p>شهرها و استان ها</p>
                        </div>

                        <div class="mmenuHolder3">
                            <nav class="menu mm-opened" data-placeholder="جستجو در شهرها و استان ها" data-title="دسته بندی شهرها و استان ها">
                                <ul>
                                    <?php foreach ($list['list']['searchProvince'] as $key => $value) { ?>
                                        <?php if ($value['count'] > 0) { ?>
                                            <li>
                                                <a data-toggle="tooltip" data-placement="top" title="<?php echo  $value['name'] ?>" class="company-name">
                                                    <span><?php echo  $value['count'] ?></span>
                                                    <label for="province-<?php echo  $value['province_id'] ?>" class="company-name"><?php echo  $value['name'] ?>
                                                        <input type="checkbox" name="province[]" id="province-<?php echo  $value['province_id'] ?>" value="<?php echo  $value['name'] ?>">
                                                    </label>
                                                </a>

                                                <ul>
                                                    <?php foreach ($value['cities'] as $city_id => $cityFields) { ?>
                                                        <li>
                                                            <a data-toggle="tooltip" data-placement="top" title="<?php echo  $cityFields['name'] ?>" class="company-name">
                                                                <span>(<?php echo  $cityFields['count'] ?>)</span>
                                                                <label for="city-<?php echo  $cityFields['City_id'] ?>" class="company-name">
                                                                    <?php echo  $cityFields['name'] ?>
                                                                    <input type="checkbox" name="city[]" id="<?php echo  $cityFields['City_id'] ?>" value="<?php echo  $cityFields['name'] ?>">
                                                                </label>
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


                <!-------------------------------- tab for grid&list -------------------------------->
                <div class="col-xs-12 col-sm-7 col-md-9 -pull-left">

                    <?php if (isset($msg)) { ?>
                        <div class="whiteBg boxBorder roundCorner clear fullWidth">
                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                            <div class="row mb-double">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <div class="alert alert-warning"><strong>توجه! </strong><?php echo $msg; ?> </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-------------------------------- product filter -------------------------------->
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                            <!-------------------------------- فیلتر محصولات -------------------------------->

                            <ul class=" filter-container">
                                <?php if (is_array($list['list']['searchItem']['category'])) {
                                    if (count($list['list']['searchItem']['category']['list']) > 1) { ?>
                                        <li class="product-filter roundCorner boxBorder">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">فیلتر دسته بندی ها<span>(<b><?php echo count($list['list']['searchItem']['category']['list']) ?></b>)</span>
                                                    <i class="fa fa-angle-down transition"></i>
                                                </button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['category']['list'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['category']['list'][$a]['title'] ?>">
                                                                <?php echo  $list['list']['searchItem']['category']['list'][$a]['title'] ?>
                                                            </span>
                                                            <span class="close-filter-container">
                                                                <a href="#">
                                                                    <i class="fa" name="category[]"
                                                                       id="<?php echo  $list['list']['searchItem']['category']['list'][$a]['Category_id'] ?>"> </i>
                                                                </a>
                                                            </span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php } else {
                                        foreach ($list['list']['searchItem']['category']['list'] as $a => $b) { ?>
                                            <li class="product-filter roundCorner boxBorder color-silver1">
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['category']['list'][$a]['title'] ?>">
                                                    <?php echo  $list['list']['searchItem']['category']['list'][$a]['title'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#">
                                                        <i class="fa" name="category[]"
                                                           id="<?php echo  $list['list']['searchItem']['category']['list'][$a]['Category_id'] ?>"> </i>
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
                                                <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    استانها<i class="fa fa-angle-down transition"></i>
                                                </button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['province']['list'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                                <?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                                            </span>
                                                            <span class="close-filter-container">
                                                                <a href="#">
                                                                    <i class="fa" name="province[]" id="<?php echo  $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>"> </i>
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
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                    <?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#">
                                                        <i class="fa" name="province[]" id="<?php echo  $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>"> </i>
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
                                                <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">شهرها<i class="fa fa-angle-down transition"></i></button>
                                                <ul class="dropdown-menu searchType">
                                                    <?php foreach ($list['list']['searchItem']['city']['list'] as $a => $b) { ?>
                                                        <li class="color-white">
                                                            <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                                <?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                                            </span>
                                                            <span class="close-filter-container">
                                                                <a href="#">
                                                                    <i class="fa" name="city[]" id="<?php echo  $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>"> </i>
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
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                    <?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#">
                                                        <i class="fa" name="city[]" id="<?php echo  $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>">
                                                        </i>
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


                    <?php if (isset($list['type']) && $list['type'] == 'محصولات') { ?>
                        <?php foreach ($list['list']['c_product'] as $key => $value) { ?>
                            <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double3 contentPro contentPro-profile">
                                <a class="single" href="<?php echo  RELA_DIR . 'company/Detail/' . $value['company_id'] . '/' . $value['company_name']; ?>">

                                    <header>
                                        <div class="text-right text-title">
                                            <?php echo  ($value['title']) != "" ? $value['title'] : "-"; ?>
                                        </div>
                                    </header>

                                    <div class="content whiteBg roundCorner fullWidth">
                                        <div class="item text-center">
                                            <div class="row noMargin">

                                                <div class="col-xs-2 col-sm-3 col-md-2 pull-right boxA">
                                                    <div class="logoContainer pull-right">
                                                        <img src="<?php if (! empty($value['image'])) {
                                                            echo PRODUCT_ADDRESS . $key . "/logo/" . $value['image'];
                                                        } else {
                                                            echo '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'; } ?>" class="boxBorder roundCorner">
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-5 col-md-3 pull-right boxA noPadding">
                                                    <div class="text pull-right">
                                                        <p> توضیحات: <?php echo  ($value['description']) != "" ? $value['description'] : "-" ?> </p>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-5 col-md-3 pull-right boxA noPadding">
                                                    <div class="text pull-right">
                                                        <p>نام کمپانی: <?php echo  ($value['company_name']) != "" ? $value['company_name'] : "-" ?> </p>
                                                    </div>
                                                </div>

                                                <div class="col-xs-6 col-sm-5 col-md-3 pull-right boxA noPadding">
                                                    <div class="text pull-right">
                                                        <p> تاریخ: <?php echo  ($value['date']) != "" ? $value['date'] : "-" ?> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </a>

                            </div>
                        <?php } ?>
                    <?php } ?>

                    <!-------------------------------- Related Results -------------------------------->

                    <div class="row">

                        <?php if ($list['list']['searchSuggestion'] != '') { ?>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double3 contentPro contentPro-profile related-search-box">
                                    <header>
                                        <div class="text-right text-danger"> نتایج مرتبط با عبارت جستجو شده </div>
                                    </header>
                                    <div class="row noMargin">
                                        <?php foreach ($list['list']['searchSuggestion']['value'] as $key => $value) { ?>
                                            <div class="col-xs-12 col-sm-4 col-md-3 pull-right">
                                                <a class="text-right transition" href="<?php echo  RELA_DIR ?>search/type/<?php echo  (($list['list']['searchSuggestion']['type'] == '0') ? 'تولیدی' : 'محصولات'); ?>/q/<?php echo  $value; ?>" name="<?php echo  $value; ?>" title="<?php echo  $value; ?>">
                                                    <?php echo  $value ?>
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
                                    foreach ($list['pagination']['c_product']['list'] as $href) {
                                        if ($href['label'] == ">") {
                                            $href['label'] = "<i class='fa fa-angle-right' aria-hidden='true'></i>";
                                        } elseif ($href['label'] == "<") {
                                            $href['label'] = "<i class='fa fa-angle-left' aria-hidden='true'></i>";
                                        }
                                        ?>
                                        <li>
                                            <a class=" transition <?php echo  $href['activePage'] ?>" href="<?php echo  RELA_DIR . $href['address'] ?>"><?php echo  $href['label'] ?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                                <div class="input-group center-block">
                                    <input type="text" class="form-control input-search" id="input-search" placeholder="شماره صفحه ...">
                                    <span class="input-group-btn btn-arrow">
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
                                    <?php echo  $list['pagination']['c_product']['pageCount'] . "<br>" ?>
                                </div>

                                <!-------------------------------- تعداد رکورد -------------------------------->

                                <div class="jPager center-block  roundCorner">
                                    <span>تعداد رکورد :</span>
                                    <?php echo  $list['pagination']['c_product']['rowCount'] . "<br>" ?>
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


<!-------------------------------- Scripts -------------------------------->


<script src="<?php echo RELA_DIR ?>templates/template_fa/assets/js/companyWiki.js"></script>

<div class="row xxsmallSpace"></div>

<script>


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


    $('.carousel-slick').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        rows: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 560,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
</script>
