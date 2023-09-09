<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css" />

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/search.js"></script>

<style>
    .is-active {
        display: block !important;
    }

    /* .search-box {
        font-size: 12px;
        direction: ltr;
        text-align: right;
        position: relative;
        background-color: #fff;
        width: 100%;
        height: auto;
        max-height: 340px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    } */
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

    /* .search-box-header {
        width: 100%;
        height: 42px;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        position: relative;
        z-index: 10;
        line-height: 40px;
    } */

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

    /* [type=email],
    [type=name],
    [type=password] .container-floatinglabel .form-group textarea,
    [type=phone],
    [type=text] {
        border-radius: 0;
        background-color: transparent;
        border: none;
        border-bottom: solid 1px #e3e3e3;
        height: 35px;
        width: 100%;
    } */

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
</style>

<?php include_once("breadcrumb.php"); ?>

<div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-x-4  container mx-auto py-8 px-4">

    <div class="filter-category">
        <!-- دسته بندی -->
        <div class="search-box boxBorder categoryContainer mb-double key-search relative">

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
        <div class="search-box boxBorder categoryContainer mb-double3 relative">
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
                                    <a data-toggle="tooltip" data-placement="top" title="<?php echo $value['name'] ?>" class="company-name">
                                        <span><?php echo $value['count'] ?></span>
                                        <label for="province-<?php echo $value['province_id'] ?>" class="company-name"><?php echo $value['name'] ?>
                                            <input type="checkbox" name="province[]" id="province-<?php echo $value['province_id'] ?>" value="<?php echo $value['name'] ?>">
                                        </label>
                                    </a>
                                    <ul>
                                        <?php
                                        foreach ($value['cities'] as $city_id => $cityFields) {
                                        ?>
                                            <li>
                                                <a data-toggle="tooltip" data-placement="top" title="<?php echo $cityFields['name'] ?>" class="company-name">
                                                    <span>(<?php echo $cityFields['count'] ?>)</span>
                                                    <label for="city-<?php echo $cityFields['City_id'] ?>" class="company-name">
                                                        <?php echo $cityFields['name'] ?>
                                                        <input type="checkbox" name="city[]" id="<?php echo $cityFields['City_id'] ?>" value="<?php echo $cityFields['name'] ?>"> </label>
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

    <!-------------------------------- showGrid and listView -------------------------------->
    <div class="lg:col-span-3">

        
        <h1 class="mt-4 lg:mt-0">جستجوگر تولیدات</h1>
        <p class="text-sm text-gray-600 mb-2">عبارت مورد نظر را در فیلد زیر جستجو نمایید.</p>

        <!-- search bar -->
        <?php include __DIR__ . '/search.template.php'; ?>


        <div class="text-center container m-auto bg-gray-200 my-4 p-2 roundCorner rounded-md">

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
                                                <a href="#" name="a_category" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                    <i class="fa text-red-700 font-bold" name="category[]" id="<?php echo $list['list']['searchItem']['category'][$a]['Category_id'] ?>" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">X</i>
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
                                    <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                        <?php echo $list['list']['searchItem']['category'][$a]['title'] ?>
                                    </span>
                                    <span class="close-filter-container">
                                        <a href="#" name="b_category" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                            <i class="fa text-red-700 font-bold" name="category[]" id="<?php echo $list['list']['searchItem']['category'][$a]['Category_id'] ?>" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">X</i>
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
                                            <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                <?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                            </span>
                                            <span class="close-filter-container">
                                                <a href="#" name="province" title="<?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                                    <i class="fa font-bold text-red-700" name="province[]" id="<?php echo $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>">X</i>
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
                                    <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>">
                                        <?php echo $list['list']['searchItem']['province']['list'][$a]['name'] ?>
                                    </span>
                                    <span class="close-filter-container">
                                        <a href="#" name="province_a" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                            <i class="fa font-bold text-red-700" name="province[]" id="<?php echo $list['list']['searchItem']['province']['list'][$a]['province_id'] ?>">X</i>
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
                                            <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                                <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                            </span>
                                            <span class="close-filter-container">
                                                <a href="#" name="city_id" title="<?php echo $list['list']['searchItem']['category'][$a]['title'] ?>">
                                                    <i class="fa font-bold text-red-700" name="city[]" id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>">X</i>
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
                                    <span class="product-filter-container" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>">
                                        <?php echo $list['list']['searchItem']['city']['list'][$a]['name'] ?>
                                    </span>
                                    <span class="close-filter-container">
                                        <a href="#">
                                            <i class="fa font-bold text-red-700" name="city[]" id="<?php echo $list['list']['searchItem']['city']['list'][$a]['City_id'] ?>">X</i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                <?php }
                    }
                } ?>
            </div>
        </div>

        <?php if (!isset($list['type']) || $list['type'] == 'تولیدی') { ?>
            <?php foreach ($list['list']['company'] as $key => $value) { ?>


                <div class="w-full rounded-md pt-4 bg-gray-50 mb-4 border-gray-200 border-2">

                    <h3 class="text-xl font-bold text-gray-700 px-4 block"><?php echo ($value['company_name'] != "" ? $value['company_name'] : "-"); ?></h3>

                    <div class="px-4">
                        <div class="pt-3 border-b-2 border-tolidatColor opacity-25"></div>
                    </div>

                    <div class="px-4">
                        <div class="grid grid-cols-1 md:grid-cols-9 lg:grid-cols-9 gap-y-4 mt-4">

                            <div class="md:col-span-2 lg:col-span-2">
                                <img src="<?php echo (($value['logo']['image']['0'] && file_exists(COMPANY_ADDRESS_ROOT . $key . "/logo/140.140." . $value['logo']['image']['0'])) ? COMPANY_ADDRESS . $key . "/logo/140.140." . $value['logo']['image']['0'] :  DEFULT_LOGO_ADDRESS); ?>" alt="" class="w-full border-2 rounded-md border-gray-200">
                            </div>

                            <div class="md:col-span-7 lg:col-span-6 px-4 justify-between flex flex-col">
                                <p class="max-h-36 leading-7  overflow-hidden text-sm  mb-2	">
                                    <?php echo ($value['description'] != "" ? $value['description'] : "-"); ?>
                                </p>

                                <div class="">
                                    <a class="w-40 mt-4   py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                        مشاهده بیشتر
                                    </a>
                                </div>
                            </div>

                            <div class="md:col-span-12 lg:col-span-1 flex justify-center">

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
                            <a class="" href="<?php echo RELA_DIR . "search/type/تولیدی/province/" . $list['list']['searchProvince'][$value['state_id']]['name'] ?>"><?php echo $list['list']['searchProvince'][$value['state_id']]['name'] ?></a>
                        </p>

                        <p class="flex flex-wrap text-sm items-center justify-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-tolidatColor" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <?php $count = count($value['category_title']) ?>
                            <?php foreach ($value['category_title'] as $cat_id => $category) : ?>
                                <a class="border border-tolidatColor m-1 text-xs rounded-full px-2" href="<?php echo RELA_DIR . "company/type/تولیدی/category/" . $cat_id ?>">
                                    <?php echo $category;
                                    echo ($count > 1 ? " , " : "");
                                    $count-- ?>
                                </a>
                            <?php endforeach; ?>


                        </p>

                    </div>

                </div>
            <?php } ?>
        <?php } else { ?>
            <?php foreach ($list['list']['c_products'] as $key => $value) { ?>


            <?php } ?>
        <?php } ?>

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
                                    <a class="text-right transition" href="<?php echo RELA_DIR ?>search/type/<?php echo (($list['searchSuggestion']['type'] == '0') ? 'تولیدی' : 'محصولات'); ?>/q/<?php echo $value; ?>" name="<?php echo $value; ?>" title="<?php echo $value; ?>">
                                        <?php echo $value ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 bg-gray-100 items-center">
                <div class="col-span-3        pagination-search pagination-search1">
                    <div class="Pagination flex w-full justify-between items-center flex-wrap p-2">

                        <ul class="pagination center-block flex flex-wrap gap-2 mb-2 xl:mb-0">
                            <?php
                            foreach ($list['pagination']['company']['list'] as $href) {
                                if ($href['label'] == ">") {
                                    $href['label'] = "<";
                                } elseif ($href['label'] == "<") {
                                    $href['label'] = ">";
                                }
                            ?>
                                <li class="w-8 h-8">
                                    <a class="border border-tolidatColor rounded-full block text-center h-full w-full leading-8 <?php echo $href['activePage'] == ' activePage' ? ' bg-tolidatColor text-white ' : '' ?>" href="<?php echo RELA_DIR . $href['address'] ?>" name="<?php echo $href['label'] ?>" title="<?php echo $href['label'] ?>">
                                        <?php echo $href['label'] ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>

                        <div class="input-group center-block">
                            <input type="text" class=" input-search" id="input-search" placeholder="شماره صفحه ...">
                            <span class="input-group-btn btn-arrow">
                                <a class="btn btn-default button-search" id="button-search" type="button">
                                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-span-1         pagination-search">
                    <div class="p-2         Pagination">

                        <!-------------------------------- تعداد صفحه -------------------------------->
                        <div class="center-block pull-left">
                            <span>تعداد صفحه :</span>
                            <?php echo $list['pagination']['company']['pageCount'] . "<br>" ?>
                        </div>
                        <!-------------------------------- تعداد رکورد -------------------------------->

                        <div class=" center-block">
                            <span>تعداد رکورد :</span>
                            <?php echo $list['pagination']['company']['rowCount'] . "<br>" ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>


<script>
    $(document).ready(function() {

        $('.search-box .search-box-header').click(function(){
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
        //     text: "<?php echo $list['list']['phone_main'] ?>",
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
</script>