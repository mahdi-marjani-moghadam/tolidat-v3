<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css" />

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/search.js"></script>
<link rel="stylesheet" type="text/css" href="<?php   ?><?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css" />

<style>
    .is-active {
        display: block !important;
    }

    .mm-menu.mm-offcanvas {
        max-height: none;
    }

    .boxBorder {
        border: none;
        -webkit-box-shadow: 0 3px 5px -1px #b0b1af !important;
        -moz-box-shadow: 0 3px 5px -1px #b0b1af !important;
        box-shadow: 0 3px 5px -1px #b0b1af !important;
    }

    .mb-double {
        margin-bottom: 2rem;
    }

    .header-color {
        background-color: #fafafa !important;
    }


    .mmenuHolder2,
    .mmenuHolder3 {
        position: relative;
        min-height: 210px;
        width: 100%;
        direction: ltr !important;
    }

    header {
        width: 100%;
        height: 45px;
        line-height: 45px;
        color: #555;
        border-bottom: solid 1px #ff7220 !important;
        padding-left: 10px;
        padding-right: 10px;
        background-color: #fafafa;
        overflow: hidden;
        border-radius: 3px 3px 0 0;
        font-size: 15px;
        text-align: right;
        direction: rtl;
        -webkit-transition: all .4s;
        -moz-transition: all .4s;
        -ms-transition: all .4s;
        -o-transition: all .4s;
        transition: all .4s;
    }

    .profile-editForm .container-view i,
    .search-box-header i {
        color: #ff7220 !important;
        font-size: 25px !important;
        display: block !important;
        float: right !important;
        height: 100% !important;
        line-height: 45px !important;
        margin-left: 10px !important;
        position: static !important;
    }

    .mm-search input {
        border-radius: 10px !important;
    }

    .search-box input {
        position: absolute;
        top: 6px;
        right: 4px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    input,
    textarea {
        font-family: Samim, tahoma, sans-serif !important;
    }

    .mm-search img {
        position: absolute;
        top: 14px;
        left: 17px;
        cursor: pointer;
    }

    .keyboard+img {
        position: absolute;
        cursor: pointer;
    }

    img {
        max-width: 100% !important;
    }

    .mmenuHolder2 a {
        direction: rtl;
        display: block;
        height: 44px;
        line-height: 45px;
    }

    .mm-hasnavbar-top-1 .mm-panels,
    .mm-navbar-top-2 {
        top: 40px;
    }

    .mmenuHolder2 .mm-panels>.mm-panel,
    .mmenuHolder3 .mm-panels>.mm-panel {
        height: auto;

    }

    .search-box .menu.mm-opened ul {
        overflow: hidden;
        /* height: 300px; */
        height: auto;
    }

    .mm-listview>li {
        position: relative;
        width: 100% !important;
        float: right;
    }

    .search-box .mm-listview>li>a {
        padding-right: 0;
    }

    .mm-arrow:after,
    .mm-next:after {
        border-bottom: none;
        border-right: none;
        left: 7px;
        top: -3px !important;
    }

    .mm-listview>li>a,
    .mm-listview>li>span {
        height: 35px;
        line-height: 35px;
        padding: 0;
        padding-right: 0.2em;
    }

    .search-box li span {
        width: 35px;
        height: 20px;
        float: left;
        line-height: 21px;
        font-size: .8em;
        background-color: #eee;
        text-align: center;
        margin-top: 7px;
        color: #ff660c;
        margin-left: 5px;
    }

    .search-box label {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 300;
        display: inherit;
        margin-bottom: 0;
        padding: 0 1.5em 0 0.5em;
    }

    label {
        cursor: pointer;
    }

    input[type=checkbox],
    input[type=radio] {
        margin: 4px 0 0;
        margin-top: 1px \9;
        line-height: normal;
    }

    input[type=checkbox],
    input[type=radio] {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0;
    }

    input[type="checkbox"],
    input[type="radio"] {
        box-sizing: border-box;
        padding: 0;
    }

    .overlay-click {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background-color: rgba(255, 255, 255, .8)
    }

    .overlay-click span {
        position: absolute;
        width: 150px;
        height: 40px;
        direction: rtl;
        top: 50%;
        right: 50%;
        margin-right: -75px;
        font-size: 16px;
        text-align: center
    }

    .rating {
        display: flex;
        align-items: center;
    }

    .rating input {
        border: 0;
        width: 1px;
        height: 1px;
        overflow: hidden;
        position: absolute !important;
        clip: rect(1px 1px 1px 1px);
        clip: rect(1px, 1px, 1px, 1px);
        opacity: 0;
    }

    .rating label {
        float: right;
        color: #c8c8c8;
    }

    .rating label:before {
        content: "★";
        display: inline-block;
        font-size: 2em;
        color: #ccc;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .rating input:checked~label:before {
        color: #ffc107;
    }

    .set-comment .rating label:hover~label:before {
        color: #ffdb70;
    }

    .set-comment .rating label:hover:before {
        color: #ffc107;
    }

    .slick-track {
        display: flex !important;
    }

    .slick-slide {
        height: inherit !important;
    }

    .nextArrow {
        left: -30px;
        font-size: 12px;
        line-height: 0;
        position: absolute;
        top: calc(50% - 20px);
        z-index: 1;
        display: block;
        width: 40px;
        height: 40px;
        cursor: pointer;
        background-color: #ff710d30;
    }

    .prevArrow {
        right: -30px;
        font-size: 12px;
        line-height: 0;
        position: absolute;
        top: calc(50% - 20px);
        z-index: 1;
        display: block;
        width: 40px;
        height: 40px;
        cursor: pointer;
        background-color: #ff710d30;
    }

    @media screen and (max-width: 767px) {
        .nextArrow {
            left: -11px;
        }

        .prevArrow {
            right: -11px;
        }
    }
</style>

<input type="hidden" id="page_type" value="searchPage">

<?php include_once("breadcrumb.php"); ?>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-x-4  container mx-auto py-8 px-4">

    <div class=" filter-category ">
        <!-- دسته بندی -->
        <div class="key-search skipCatSelection width-position section-title">

            <div class="search-box boxBorder categoryContainer mb-double relative">

                <div class="overlay-click">
                    <span> لطفا منتظر بمانید...</span>
                </div>

                <div class="search-box-header header-color">
                    <header class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        دسته بندی تولیدی ها
                    </header>
                </div>

                <div class="mmenuHolder2 hidden md:block">
                    <nav class="menu mm-opened" data-placeholder="جستجو در دسته بندی تولیدی ها" data-title="دسته بندی تولیدی ها">
                        <?php echo $list['list']['searchCategoryUlLi']; ?>
                    </nav>
                </div>
            </div>

            <!-- شهرها و استان -->
            <div class="search-box boxBorder categoryContainer mb-double3 relative mb-8">

                <div class="overlay-click">
                    <span> لطفا منتظر بمانید...</span>
                </div>

                <div class="search-box-header header-color">
                    <header class="flex items-center gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        شهرها و استان ها
                    </header>
                </div>

                <div class="mmenuHolder3 hidden md:block">
                    <nav class="menu mm-opened" data-placeholder="جستجو در شهرها و استان ها" data-title="دسته بندی شهرها و استان ها">
                        <ul>
                            <?php foreach ($list['list']['searchProvince'] as $key => $value) { ?>
                                <?php if ($value['count'] > 0) { ?>
                                    <li>
                                        <a data-toggle="tooltip" data-placement="top" title="<?php echo  $value['name'] ?>" class="company-name">
                                            <span><?php echo  $value['count'] ?></span>
                                            <label for="province-<?php echo  $value['province_id'] ?>" class="company-name"><?php echo  $value['name'] ?>
                                                <input type="checkbox" name="province[]" id="province-<?php echo  $value['province_id'] ?>" value="<?php echo  $value['name'] ?>"> </label> </a>

                                        <ul>
                                            <?php foreach ($value['cities'] as $city_id => $cityFields) { ?>
                                                <li>
                                                    <a data-toggle="tooltip" data-placement="top" title="<?php echo  $cityFields['name'] ?>" class="company-name">
                                                        <span>(<?php echo  $cityFields['count'] ?>)</span>
                                                        <label for="city-<?php echo  $cityFields['City_id'] ?>" class="company-name">
                                                            <?php echo  $cityFields['name'] ?>
                                                            <input type="checkbox" name="city[]" id="city-<?php echo  $cityFields['City_id'] ?>" value="<?php echo  $cityFields['name'] ?>"> </label>
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
    </div>

    <!-------------------------------- Tab for grid & list -------------------------------->
    <div class="lg:col-span-3">

        <?php if (isset($msg)) { ?>
            <div class="whiteBg boxBorder roundCorner clear fullWidth">
                <div class="row mb-double">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="alert alert-warning"><strong>توجه! </strong><? echo $msg; ?> </div>
                    </div>
                </div>
            </div>
        <?php } ?>





        <!-------------------------------- product filter -------------------------------->
        <div>
            <?php if (count($list['list']['searchItem']['category']) == 1) : ?>
                <h1 class="mb-1 text-lg font-bold"><?php echo $list['list']['searchItem']['category'][0]['title'] ?>
                    <?php if (count($list['list']['searchItem']['province']['list']) == 1) : ?>
                        در <?php echo $list['list']['searchItem']['province']['list'][0]['name'] ?>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>


            <!-- search bar -->

            <?php include __DIR__ . '/search.company.php'; ?>

            <div class="text-center container m-auto bg-gray-200 mb-4 p-2 roundCorner rounded-md">
                <!-------------------------------- فیلتر دسته بندی -------------------------------->
                <div class="filter-container">
                    <?php if (is_array($list['list']['searchItem']['category'])) {
                        if (count($list['list']['searchItem']['category']) > 1) { ?>
                            <div class="product-filter roundCorner">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">فیلتر دسته بندی ها<span>(<b><?php echo count($list['list']['searchItem']['category']) ?></b>)</span>
                                        <i class="fa fa-angle-down transition"></i>
                                    </button> -->
                                    <div class="dropdown-menu searchType flex gap-2 flex-wrap my-1">
                                        <?php foreach ($list['list']['searchItem']['category'] as $a => $b) { ?>
                                            <div class="color-white rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                    <?php echo $list['list']['searchItem']['category'][$a]['title'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#" name="a_category" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                        <i class="fa not-italic  bg-red-700 text-white inline-block w-5 h-5 rounded-full " name="category[]" id="<?php echo  $list['list']['searchItem']['category'][$a]['url'] ?>" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">X </i>
                                                    </a>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } else {
                            foreach ($list['list']['searchItem']['category'] as $a => $b) { ?>
                                <div class="flex gap-2 flex-wrap my-1">
                                    <div class="product-filter roundCorner color-silver1 rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                        <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">
                                            <?php echo $list['list']['searchItem']['category'][$a]['title'] ?>
                                        </span>
                                        <span class="close-filter-container">
                                            <a href="#" name="b_category" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                <i class="fa not-italic  bg-red-700 text-white inline-block w-5 h-5 rounded-full" name="category[]" id="<?php echo $list['list']['searchItem']['category'][$a]['url'] ?>" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>"> X</i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                    <?php }
                        }
                    } ?>
                </div>

                <!-------------------------------- فیلتر استان ها -------------------------------->
                <div class="filter-container">
                    <?php if (is_array($list['list']['searchItem']['province'])) {
                        if (count($list['list']['searchItem']['province']['list']) > 1) { ?>
                            <div class="product-filter roundCorner">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        استانها<i class="fa fa-angle-down transition"></i>
                                    </button> -->
                                    <div class="dropdown-menu searchType flex gap-2 flex-wrap my-1">
                                        <?php foreach ($list['list']['searchItem']['province']['list'] as $a => $b) { ?>
                                            <div class="color-white rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                    <?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#" name="province" title="<?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                        <i class="fa text-red-700 font-bold" name="province[]" id="<?php echo  $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>">X </i>
                                                    </a>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } else {
                            foreach ($list['list']['searchItem']['province']['list'] as $a => $b) { ?>
                                <div class="flex gap-2 flex-wrap my-1">
                                    <div class="product-filter roundCorner color-silver1 rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                        <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                            <?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                        </span>
                                        <span class="close-filter-container">
                                            <a href="#" name="province_a" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                <i class="fa text-red-700 font-bold" name="province[]" id="<?php echo $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>">X </i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                    <?php }
                        }
                    } ?>
                </div>

                <!-------------------------------- فیلتر شهرها -------------------------------->
                <div class="filter-container">
                    <?php if (is_array($list['list']['searchItem']['city'])) {
                        if (count($list['list']['searchItem']['city']['list']) > 1) { ?>
                            <div class="product-filter roundCorner">
                                <div class="btn-group">
                                    <!-- <button type="button" class="btn btn-default dropdown-toggle btn-select " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">شهرها<i class="fa fa-angle-down transition"></i>
                                    </button> -->
                                    <div class="dropdown-menu searchType flex gap-2 flex-wrap my-1">
                                        <?php foreach ($list['list']['searchItem']['city']['list'] as $a => $b) { ?>
                                            <div class="color-white rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                                <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                    <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                                </span>
                                                <span class="close-filter-container">
                                                    <a href="#" name="city_id" title="<?php echo  $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                        <i class="fa text-red-700 font-bold" name="city[]" id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>">X </i>
                                                    </a>
                                                </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } else {
                            foreach ($list['list']['searchItem']['city']['list'] as $a => $b) { ?>
                                <div class="flex gap-2 flex-wrap my-1">
                                    <div class="product-filter roundCorner color-silver1 rounded-md border-2 py-1 px-2 bg-white  border-gray-400">
                                        <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo  $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                            <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                        </span>
                                        <span class="close-filter-container">
                                            <a href="#">
                                                <i class="fa text-red-700 font-bold" name="city[]" id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>">X </i>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                    <?php }
                        }
                    } ?>
                </div>
            </div>
        </div>

        <!-------------------------------- showGrid and listView -------------------------------->
        <?php if (!isset($list['type']) || $list['type'] == 'تولیدی') {
            $i = 1;
        ?>
            <?php foreach ($list['list']['company'] as $key => $value) {



                if ($i++ == 1) :
            ?>
                    <div class="w-full rounded-md pt-4 bg-gray-50 border-4 border-b mb-4 shadow-lg  ">

                        <a class="" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                            <h3 class="text-xl font-bold text-gray-700 px-4 block"><?php echo ($value['company_name'] != "" ? $value['company_name'] : "-"); ?></h3>
                        </a>

                        <div class="px-4">
                            <div class="pt-3 border-b-2 border-tolidatColor opacity-25"></div>
                        </div>

                        <div class="px-4">
                            <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-9 gap-y-4 mt-4">

                                <div class="md:col-span-2 lg:col-span-2">
                                    <a class="w-1/2 md:w-full block float-right" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                        <img src="<?php echo (($value['logo']['image']['0'] && file_exists(COMPANY_ADDRESS_ROOT . $key . "/logo/140.140." . $value['logo']['image']['0'])) ? COMPANY_ADDRESS . $key . "/logo/140.140." . $value['logo']['image']['0'] :  DEFULT_LOGO_ADDRESS); ?>" alt="" class="w-full border-2 rounded-md border-gray-200">
                                    </a>

                                    <div class="h-full w-1/2 flex md:hidden justify-center items-center">
                                        <div class="" role="progressbar" aria-valuenow="<?php echo ($value['priority']) ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo ($value['priority']) ?>; --size:5rem; --fg:hsl(<?php echo ($value['priority']) ?>deg,70%,50%)"></div>
                                    </div>

                                </div>

                                <div class="md:col-span-7 lg:col-span-7 px-4 justify-between flex flex-col">
                                    <p class="max-h-36 leading-7  overflow-hidden text-sm  mb-7	md:mb-2">
                                        <?php echo ($value['description'] != "" ? $value['description'] : "-"); ?>
                                    </p>

                                    <div class="text-center md:text-right mb-4">
                                        <a class="w-40 mt-4 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                            مشاهده بیشتر
                                        </a>


                                    </div>
                                </div>


                            </div>
                        </div>

                        <div>

                            <?php
                            // get company products
                            $resultProduct = c_product::getBy_company_id($value['Company_id'])->where('status', '=', 1)->limit(3)->getList();
                            if ($resultProduct['export']['recordsCount'] > 0) {
                                $product_list = $resultProduct['export']['list'];
                            }


                            $addressResult = c_addresses::getBy_company_id($value['Company_id'])->first();
                            if (is_object($addressResult)) {
                                $address = $addressResult->fields;
                            }

                            $phoneResult = c_phones::getBy_company_id($value['Company_id'])->first();
                            if (is_object($phoneResult)) {
                                $phone = $phoneResult->fields;
                            }



                            if (isset($product_list)) : ?>
                                <div class=" my-4 rounded bg-gray-50">

                                    <div id="products" class="px-3 pt-3 pb-2 text-header searchBox1 bestProduct  fullWidth container-product-Grouping productGrid">
                                        <div class="content">
                                            <ul class="product-list grid-view text-center grid grid-cols-1 sm:grid-cols-3 gap-3">
                                                <?php foreach ($product_list as $pkey => $fields) : ?>
                                                    <li class="group ">
                                                        <div class="product-group border p-2 rounded  bg-white ">

                                                            <div class="product-item-img flex h-28 justify-center">
                                                                <img data-title="محصولات" class="" loading='lazy' src="<?php echo (strlen($fields['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/product/150.150.' . $fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/150.150.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>">
                                                            </div>

                                                            <div class="product-content pull-right rtl">
                                                                <div class=" displayBlock displayBlock-content">
                                                                    <h3 class="">
                                                                        <?php echo $fields['title'] ?>
                                                                    </h3>
                                                                </div>



                                                                <a href="<?php echo  RELA_DIR . 'product/show/' . $fields['Product_id'] . "/" . cleanUrl($fields['title']) ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0       ">
                                                                    <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M5 12h14"></path>
                                                                        <path d="M12 5l7 7-7 7"></path>
                                                                    </svg>
                                                                    مشاهده محصول
                                                                </a>

                                                                <!-- <button class="show-more bg-tolidatColor text-white px-3 rounded-full">مشاهده بیشتر</button> -->
                                                            </div>

                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="pb-4  mt-4 rounded-b-md  items-center px-4 gap-2 ">

                            <p class="flex  items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- <a class="" href="< ?php echo  RELA_DIR . "search/type/تولیدی/province/" . $list['list']['searchProvince'][$value['state_id']]['name'] ?>">
                                    < ?php echo  $list['list']['searchProvince'][$value['state_id']]['name'] ?>
                                </a> -->
                                <?php echo $address['address'] ?>
                            </p>

                            <p class="pt-2">
                                تلفن: <?php echo $phone['code'] . $phone['number'] ?>
                            </p>
                        </div>

                    </div>
                <?php else : ?>
                    <div class="w-full rounded-md pt-4 bg-gray-50 mb-4   ">

                        <a class="" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                            <h3 class="text-xl font-bold text-gray-700 px-4 block"><?php echo ($value['company_name'] != "" ? $value['company_name'] : "-"); ?></h3>
                        </a>

                        <div class="px-4">
                            <div class="pt-3 border-b-2 border-tolidatColor opacity-25"></div>
                        </div>

                        <div class="px-4">
                            <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-9 gap-y-4 mt-4">

                                <div class="md:col-span-2 lg:col-span-2">
                                    <a class="w-1/2 md:w-full block float-right" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                        <img src="<?php echo (($value['logo']['image']['0'] && file_exists(COMPANY_ADDRESS_ROOT . $key . "/logo/140.140." . $value['logo']['image']['0'])) ? COMPANY_ADDRESS . $key . "/logo/140.140." . $value['logo']['image']['0'] :  DEFULT_LOGO_ADDRESS); ?>" alt="" class="w-full border-2 rounded-md border-gray-200">
                                    </a>

                                    <div class="h-full w-1/2 flex md:hidden justify-center items-center">
                                        <div class="" role="progressbar" aria-valuenow="<?php echo ($value['priority']) ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo ($value['priority']) ?>; --size:5rem; --fg:hsl(<?php echo ($value['priority']) ?>deg,70%,50%)"></div>
                                    </div>

                                </div>

                                <div class="md:col-span-7 lg:col-span-6 px-4 justify-between flex flex-col">
                                    <p class="max-h-36 leading-7  overflow-hidden text-sm  mb-7	md:mb-2">
                                        <?php echo ($value['description'] != "" ? $value['description'] : "-"); ?>
                                    </p>

                                    <div class="text-center md:text-right mb-4">
                                        <a class="w-40 mt-4 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                            مشاهده بیشتر
                                        </a>
                                    </div>
                                </div>

                                <div class="md:col-span-12 lg:col-span-1 hidden md:flex justify-center">
                                    <div class="" role="progressbar" aria-valuenow="<?php echo ($value['priority']) ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo ($value['priority']) ?>; --size:5rem; --fg:hsl(<?php echo ($value['priority']) ?>deg,70%,50%)"></div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-200  mt-4 rounded-b-md flex items-center px-4 gap-2 ">

                            <p class="flex text-sm items-center justify-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <a class="" href="<?php echo  RELA_DIR . "search/province/" . $list['list']['searchProvince'][$value['state_id']]['name'] ?>">
                                    <?php echo  $list['list']['searchProvince'][$value['state_id']]['name'] ?>
                                </a>
                            </p>

                            <p class="flex flex-wrap text-sm items-center justify-start">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg> -->
                            <?php  $count = count($value['category_title']) ?>
                                
                                <?php foreach ($value['category_title'] as $cat_id => $category) :  ?>
                                    <a class="border border-tolidatColor m-1 text-xs rounded-full px-3 sm:px-2 py-1" href="<?php echo  RELA_DIR . "company/c/" . $category['url'] ?>">
                                        <?php echo $category['title'];
                                        echo ($count > 1 ? " , " : "");
                                        $count-- ?>
                                    </a>
                                <?php endforeach; ?>
                            

                            </p>

                        </div>

                    </div>
                <?php endif; ?>
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
                                        <span> <i class="fa fa-sticky-note" aria-hidden="true"></i> <b>نام تولیدی:</b> </span><span><? echo ($value['title'] != "" ? $value['title'] : "-"); ?></span>
                                    </p>
                                    <p>
                                        <span>
                                            <i class="fa fa-file-text" aria-hidden="true"></i> <b>توضیحات:</b>
                                        </span><span><? echo ($value['description'] != "" ? $value['description'] : "-"); ?></span>
                                    </p>
                                </a>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 description1">

                                <div class="row">

                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <p><b><i class="fa fa-envelope" aria-hidden="true"></i></b>
                                            <b>ایمیل:</b>
                                            <a href="mailto:<?php $value['company_email']['email'][0] ?>"><span><?php echo ($value['company_email']['email'][0] != "" ? $value['company_email']['email'][0] : "-"); ?></span></a>
                                        </p>
                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-4">
                                        <p><b><i class="fa fa-internet-explorer" aria-hidden="true"></i></b>
                                            <b>آدرس اینترنتی:</b> <a href="<?php $value['company_website']['url'][0] ?>"><span><?php echo ($value['company_website']['url'][0] != "" ? $value['company_website']['url'][0] : "-"); ?> </span></a>
                                        </p>
                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-4">

                                        <p>
                                            <b> <i class="fa fa-phone-square" aria-hidden="true"></i> </b>
                                            <b>شماره تلفن:</b>
                                            <span><?php echo ($value['company_phone']['number'][0] != "" ? $value['company_phone']['number'][0] : "-"); ?></span>
                                        </p>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <a href="<?php echo RELA_DIR . 'product/Detail/' . $value['Company_products_id'] . '/' . $value['title']; ?>" class="btn btn-link btnDetail transition roundCorner" title="<?php $value['title']; ?>">نمایش</a>
                </div>
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
                                    <a class="text-right transition" href="<?php echo  RELA_DIR ?>search/type/<?php echo (($list['searchSuggestion']['type'] == '0') ? 'تولیدی' : 'محصولات'); ?>/q/<?php echo  $value; ?>" name="<?php echo  $value; ?>" title="<?php echo  $value; ?>">
                                        <?php echo  $value ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 bg-gray-100 items-center">
                <div class="md:col-span-4">
                    <div class="Pagination flex w-full justify-between items-center flex-wrap p-2">

                        <ul class="pagination center-block flex flex-wrap gap-2 mb-5 xl:mb-0">
                            <?php
                            foreach ($list['pagination']['company']['list'] as $href) {
                                if ($href['label'] == ">") {
                                    $href['label'] = "<";
                                } elseif ($href['label'] == "<") {
                                    $href['label'] = ">";
                                }
                            ?>
                                <li class="w-8 h-8">
                                    <a class="border border-tolidatColor rounded-full block text-center h-full w-full leading-8 <?php echo $href['activePage'] ?>" href="<?php echo RELA_DIR . $href['address'] ?>" name="<?php echo $href['label'] ?>" title="<?php echo $href['label'] ?>">
                                        <?php echo $href['label'] ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>

                        <div class="input-group center-block mx-auto md:m-0">
                            <input type="text" class="form-control input-search px-2 py-1" id="input-search" placeholder="شماره صفحه ...">
                            <span class="input-group-btn btn-arrow">
                                <a class="btn btn-default button-search" id="button-search" type="button">
                                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-span-3 md:col-span-1 text-center md:text-right">
                    <div class="pagination-search p-2">
                        <div class=" whiteBg  roundCorner fullWidth mb Pagination">

                            <!-------------------------------- تعداد صفحه -------------------------------->
                            <div class="center-block pull-left">
                                <span>تعداد صفحه :</span>
                                <?php echo $list['pagination']['company']['pageCount'] . "<br>" ?>
                            </div>

                            <!-------------------------------- تعداد رکورد -------------------------------->
                            <div class="center-block">
                                <span>تعداد رکورد :</span>
                                <?php echo $list['pagination']['company']['rowCount'] . "<br>" ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-------------------------------- survey -------------------------------->
        <?php if (count($list['list']['searchItem']['category']) == 1) { ?>
            <div class="w-full rounded-md pt-4 bg-gray-50 mb-4 border-gray-200 border-2">
                <div class="border-b-2 mb-2"></div>

                <div class="w-full p-4 show-comment">
                    <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700 mb-6">دیدگاه ها</h2>

                    <?php if (isset($list['comment_list'])) :
                        if (is_array($list['comment_list'])) {
                    ?>

                            <?php foreach ($list['comment_list'] as $date => $value) : ?>
                                <div>
                                    <div class="rating">
                                        <span>امتیاز: </span>
                                        <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st1<?php echo $value['Survey_id'] ?>" value="5" <?php echo ($value['rate'] == 5) ?  "checked" : "" ?> />
                                        <label for="st1<?php echo $value['Survey_id'] ?>" title="عالی"></label>
                                        <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st2<?php echo $value['Survey_id'] ?>" value="4" <?php echo ($value['rate'] == 4) ?  "checked" : "" ?> />
                                        <label for="st2<?php echo $value['Survey_id'] ?>" title="خوب"></label>
                                        <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st3<?php echo $value['Survey_id'] ?>" value="3" <?php echo ($value['rate'] == 3) ?  "checked" : "" ?> />
                                        <label for="st3<?php echo $value['survey_id'] ?>" title="معمولی"></label>
                                        <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st4<?php echo $value['Survey_id'] ?>" value="2" <?php echo ($value['rate'] == 2) ?  "checked" : "" ?> />
                                        <label for="st4<?php echo $value['Survey_id'] ?>" title="ضعیف"></label>
                                        <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st5<?php echo $value['Survey_id'] ?>" value="1" <?php echo ($value['rate'] == 1) ?  "checked" : "" ?> />
                                        <label for="st5<?php echo $value['Survey_id'] ?>" title="بد"></label>
                                        <span id="rating-hover-label"></span>
                                    </div>

                                    <div class="d-flex pb-3 text-xs text-gray-400">
                                        <span><?php echo $value['date'] ?></span>،
                                        <span> <?php echo $value['user_name'] ?> </span>
                                    </div>

                                    <div class="my-4">
                                        <p><?php echo $value['comment'] ?></p>
                                    </div>

                                    <div class="border-b pb-4 flex mt-4 mb-4 justify-end">
                                        <p class="text-sm text-gray-600 ml-4">آیا این دیدگاه مفید بود؟</p>

                                        <div class="flex text-gray-400 text-base gap-2">
                                            <span class="flex items-center like" data-surveyid="<?php echo $value['Survey_id'] ?>">
                                                <span class="like"><?php echo  $value['like'] ?></span>
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                    </svg>
                                                </div>
                                            </span>
                                            <span class="flex items-center dis_like" data-surveyid="<?php echo $value['Survey_id'] ?>">
                                                <span class="dis_like"><?php echo $value['dis_like'] ?></span>
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                                    </svg>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php
                        } else { ?>
                            <div class="container mx-auto mt-10 px-4 text-center">
                                <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['comment_list'] ?></h3>
                            </div>
                    <?php  }
                    endif;
                    ?>
                </div>

                <div class="border-b-2"></div>

                <div class="w-full p-4 set-comment">
                    <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700 mb-6">دیدگاه خود را ثبت کنید</h2>

                    <form id="survey" class="w-full px-6">

                        <!-- <div class="rating inline-block mb-4">
                        <input type="radio" value="5" name="rating" id="rating-5"/>
                        <label for="rating-5" title="5 stars">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </label>
                        <input type="radio" value="4" name="rating" id="rating-4"/>
                        <label for="rating-4" title="4 stars">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </label>
                        <input type="radio" value="3" name="rating" id="rating-3"/>
                        <label for="rating-3" title="3 stars">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </label>
                        <input type="radio" value="2" name="rating" id="rating-2"/>
                        <label for="rating-2" title="2 stars">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </label>
                        <input type="radio" value="1" name="rating" id="rating-1"/>
                        <label for="rating-1" title="1 star">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </label>
                    </div> -->

                        <div class="rating">
                            <span>امتیاز: </span>
                            <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }} value="5" />
                            <label for="st5" title="عالی"></label>
                            <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }} value="4" />
                            <label for="st4" title="خوب"></label>
                            <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }} value="3" />
                            <label for="st3" title="معمولی"></label>
                            <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }} value="2" />
                            <label for="st2" title="ضعیف"></label>
                            <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }} value="1" />
                            <label for="st1" title="بد"></label>
                            <span id="rating-hover-label"></span>
                        </div>

                        <div class="mb-5">
                            <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام</label>
                            <input name="user_name" type="text" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full rounded-md px-3 py-2 focus:outline-none" id="name" minlength="1" tabindex="1" required>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">ایمیل</label>
                            <input name="user_email" type="email" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full  rounded-md px-3 py-2 focus:outline-none" id="email" minlength="1" tabindex="2" placeholder="example@gmail.com" required>
                        </div>

                        <div class="mb-5">
                            <label for="msg" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">دیدگاه</label>
                            <textarea name="comment" type="text" value="" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full  rounded-md px-3 py-2 focus:outline-none" id="msg" minlength="1" tabindex="3" placeholder="نظر خود را ثبت کنید" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="type" value="category">
                        <input type="hidden" name="type_id" value="<?php echo $list['list']['searchItem']['category'][0]['Category_id'] ?>">
                        <button class="group relative w-50 py-2 px-4 border border-transparent text-md font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">ارسال</button>
                    </form>
                </div>
            </div>

            <div class="container mx-auto px-4 mt-6 mb-10">
                <?php if (isset($list['articles_list'])) :
                    if (is_array($list['articles_list'])) {
                ?>
                        <div class="container-carousel-blog" dir="ltr">
                            <?php foreach ($list['articles_list'] as $id => $field) : ?>
                                <div dir="rtl" class="items-stretch">
                                    <div class="h-full  grid grid-cols-3 rounded-lg  border-2">

                                        <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . "/" . urlencode($field['title']) ?>" class="flex p-2">
                                            <img class="w-28 object-center self-center rounded-md" src="<?php echo ((isset($field['image']) && file_exists(STATIC_ROOT_DIR . '/images/article/90.90.' . $field['image'])) ? STATIC_RELA_DIR . '/images/article/90.90.' . $field['image'] : DEFULT_PRODUCT_ADDRESS) ?>" alt="<?php echo  $field['brif_description'] ?>">
                                        </a>
                                        <div class="px-3 py-2 col-span-2">
                                            <div class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo convertDate($field['date']) ?></div>
                                            <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . "/" . urlencode($field['title']) ?>" class="">
                                                <h3 class="text-md  font-semibold text-gray-900 mb-3 truncate"><?php echo $field['title'] ?></h3>
                                            </a>
                                            <p class="leading-relaxed mb-3 text-xs truncate"><?php echo  $field['brif_description'] ?></p>
                                            <div class="flex items-center flex-wrap ">
                                                <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . "/" . urlencode($field['title']) ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
                                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5l7 7-7 7"></path>
                                                    </svg>
                                                    مشاهده جزئیات
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php
                    } else { ?>
                        <div class="container mx-auto mt-10 px-4 text-center">
                            <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['articles_list'] ?></h3>
                        </div>
                <?php  }
                endif;
                ?>
            </div>

        <?php } ?>
    </div>



</div>
<?php if (count($list['list']['searchItem']['category']) == 1) : ?>
    <div class="container mx-auto py-8 px-4">
        <?php if ($list['list']['searchItem']['category'][0]['body'] != '') :  ?>
            <div class="content-show-more mt-8 text-justify category-description">
                <?php echo $list['list']['searchItem']['category'][0]['body'] ?>
            </div>

            <div class="btn-show-more cursor-pointer text-tolidatColor mt-2">
                ادامه مطلب <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        <?php endif ?>
    </div>
<?php endif ?>
</div>

<!--  end showGrid and listView -->

<script>
    $(document).ready(function() {
        var moretext = 'ادامه مطلب <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
        var lesstext = 'مشاهده کمتر <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>';

        $('.btn-show-more').click(function() {
            if ($('.content-show-more').hasClass('show-more')) {
                $('.content-show-more').removeClass('show-more');
                $(this).html(moretext);
            } else {
                $('.content-show-more').addClass('show-more');
                $(this).html(lesstext);
            }
        });
    });
</script>

<script type="text/javascript" src="<?php echo TEMPLATE_DIR ?>assets/js/slick.min.js"></script>

<script>
    $(document).ready(function() {

        $('.search-box .search-box-header').click(function() {
            $(this).parent().find('.mmenuHolder2').toggleClass('is-active');
            $(this).parent().find('.mmenuHolder3').toggleClass('is-active');
        });

        //------> search box
        $("#button-search").on("click", function() {

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
        // ta injatoye khode safhe vojood dasht

        // az inja be paein az file script.js avorde shode ke niyazi be import file script.js
        var $mmenuHolder1 = $('.mmenuHolder1'),
            $categoryContainerHeaderHamburgerIcon = $('#categoryContainer header .hamburgerIcon'),
            $categoryContainerCity = $('#categoryContainer .City'),
            $mmenuHolder = $('.mmenuHolder');


        $('nav.menu').each(function() {
            var placeholder = $(this).attr('data-placeholder');
            var title = $(this).attr('data-title');

            $(this).mmenu({
                "searchfield": {
                    "placeholder": placeholder,
                    "noResults": "جستجویی پیدا نشد",
                    "add": true,
                    "search": true,
                    "resultsPanel": true,
                    "showSubPanels": false,
                    "showTextItems": true
                },
                extensions: ['effect-slide-menu', 'pageshadow'],
                searchField: false,
                counters: true,
                navbars: [{
                    position: 'top',
                    content: ['searchfield']
                }],
                navbar: {
                    add: true,
                    title: title,
                    titleLink: "parent"
                }
            }, {
                clone: false,
                offCanvas: {
                    menuWrapperSelector: $(this).parent()
                },
                "searchfield": {
                    "clear": true
                }
            })
        });

        var timer = setInterval(function() {
            $('.filter-category nav.menu').each(function() {
                if ($(this).hasClass('mm-menu')) {
                    $(this).parent().parent().find('.overlay-click').remove();
                    $('.search-box .menu.mm-opened ul').css('overflow', 'initial');

                    clearInterval(timer);
                }
            });
            $('.new-manufacturers').css({
                'overflow': 'visible',
                'height': 'initial'
            });

            $('.boxContainer .content1').css({
                'overflow': 'visible',
                'height': 'initial'
            });
        }, 500);

        $('.key-index .mm-search').addClass('mmenu-index-container');
        $('.key-search .mm-search').addClass('mmenu-search-container');
        $('.key-product .mm-search').addClass('mmenu-product-container');


        function setCookie(key, value) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + '; path=/';
        }

        function getCookie(key) {
            var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
            return keyValue ? keyValue[2] : null;
        }


        var $cookieP = $('.cookieP');

        $cookieP.on('click', function() {
            var dataId = $(this).data("branchid");
            setCookie('test', dataId);
        });

        // $('.nav-tabs .branchName').each(function(i, v) {
        //     var Id = $(this).find('a').data("id");
        //     if (Id == getCookie("test")) {
        //         $('.nav-tabs .branchName').removeClass('active');
        //         $(this).addClass('active');
        //         setCookie('test', '');
        //     }
        // });

        // $('.mm-search input')
        //     .addClass('keyboard')
        //     .after('<img class="icon hidden-xs hidden-sm" src="/templates/template_tailwind/assets/images/keyboard.png">');



        $categoryContainerHeaderHamburgerIcon.bind('click', function() {
            var self = $(this);

            if (self.hasClass('active')) {
                self.removeClass('active');
                $mmenuHolder.removeClass('active');
            } else {
                $mmenuHolder1.removeClass('active');
                $angleUpArrow.removeClass('is-open');
                $categoryContainerCity.removeClass('active');
                self.addClass('active');
                $mmenuHolder.addClass('active');
            }
        });

        $categoryContainerCity.bind('click', function() {
            $mmenuHolder1.slideToggle('fast');
            var self = $(this);

            if (self.hasClass('active')) {
                self.removeClass('active');
                $mmenuHolder1.removeClass('active');

                $angleUpArrow.removeClass("is-open");
            } else {
                self.addClass('active');
                $categoryContainerHeaderHamburgerIcon.removeClass('active');
                $mmenuHolder1.addClass('active');

                $mmenuHolder.removeClass('active');
                $angleUpArrow.addClass("is-open");
            }
        });

        // $('.section-title').stickit({
        //     screenMinWidth: 768,
        //     scope: StickScope.Document,
        //     top: 115,
        //     zIndex: 1,
        //     overflowScrolling: false
        // }, {
        //     screenMinWidth: 1200,
        //     top: 85
        // });

        // $('#qrcode').qrcode({
        //     text: "< ?php echo $list['list']['phone_main'] ?>",
        //     width: 65,
        //     height: 65
        // });

        // $('[rel="popover"]').each(function() {
        //     var $this = $(this),
        //         content = $(this).data('content'),
        //         trigger = $(this).data('trigger');

        //     $this.popover({
        //         container: 'body',
        //         html: true,
        //         content: content,
        //         trigger: trigger
        //     })
        // });



        // $('.content-circular-process').each(function() {
        //     try {
        //         var pieContainer = $(this).attr('id'),
        //             priorityArr = JSON.parse(JSON.parse($(this).next('.chartDataHolder').val())),
        //             serie,
        //             pieDataSeries = [],
        //             sumPercent = 0,
        //             remainPercent = 100;

        //         if (priorityArr) {
        //             Object.keys(priorityArr).map(function(item) {

        //                 sumPercent += parseInt(priorityArr[item].totalScore);

        //                 serie = {
        //                     name: priorityArr[item].persian_name,
        //                     y: priorityArr[item].totalScore,
        //                     color: priorityArr[item].color,
        //                     link: priorityArr[item].link,
        //                     menuName: item
        //                 };

        //                 pieDataSeries.push(serie);
        //             });

        //             remainPercent -= sumPercent;

        //             pieDataSeries.push({
        //                 name: 'امتیاز کسب نشده',
        //                 y: remainPercent,
        //                 color: '#f9f9f9'
        //             });

        //             var pieOptions = {
        //                 chart: {
        //                     renderTo: pieContainer,
        //                     plotBackgroundColor: null,
        //                     plotBorderWidth: null,
        //                     plotShadow: false,
        //                     type: 'pie',
        //                     events: {
        //                         load: function() {
        //                             $('#' + pieContainer).append('<div class="totalContainer transition text-center">' + sumPercent + ' %</div>');
        //                         }
        //                     }
        //                 },
        //                 title: {
        //                     text: ''
        //                 },
        //                 tooltip: {
        //                     formatter: function() {
        //                         return '<strong style="color: #ff660c">' + this.point.name + ' : </strong>' + this.point.y + ' % ';
        //                     },
        //                     useHTML: true,
        //                     //pointFormat: '{series.name}: <b>{point.y}%</b>',
        //                     style: {
        //                         direction: 'rtl',
        //                         color: '#555',
        //                         fontSize: '15px',
        //                         fontWeight: 'bold',
        //                         fontFamily: 'Samim',
        //                         zIndex: 99
        //                     },
        //                     backgroundColor: 'rgba(255,255,255,1)'
        //                 },
        //                 plotOptions: {
        //                     pie: {
        //                         allowPointSelect: true,
        //                         cursor: 'pointer',
        //                         dataLabels: {
        //                             enabled: false
        //                         },
        //                         borderColor: '#eee',
        //                         borderWidth: 1
        //                     }
        //                 },
        //                 series: [{
        //                     data: pieDataSeries,
        //                     innerSize: '80%'
        //                 }]
        //             };

        //             new Highcharts.Chart(pieOptions);
        //         }

        //     } catch (e) {
        //         console.log(e)
        //     }
        // });

    });

    $('.container-carousel-company').slick({
        nextArrow: '<button type="button" class=" nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow: '<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
        // autoplay: true,
        autoplaySpeed: 3000,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        // adaptiveHeight: true,
        responsive: [{
                breakpoint: 1280,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.container-carousel-blog').slick({
        nextArrow: '<button type="button" class="nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow: '<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(function() {

        $('form#survey').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/add',
                data: $('form').serialize(),
                success: function(result) {
                    result = JSON.parse(result)
                    console.log(result)
                    alert(result.msg);
                }
            });

        });

        $('#like').on('click', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/likeOrDislike',
                data: {
                    id: $(this).attr('value'),
                    status: 1
                },
                success: function() {
                    console.log("result")

                }
            });

        });

        $('#dis_like').on('click', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/likeOrDislike',
                data: {
                    id: $(this).attr('value'),
                    status: -1
                },
                success: function() {
                    console.log("result")

                }
            });

        });



    });
</script>