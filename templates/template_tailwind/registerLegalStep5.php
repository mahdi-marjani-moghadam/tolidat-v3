<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css" />
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/font-awesome.min.css">

<script src='<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/script.js'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>


<style>
    .boxContainer.registerPage.registerPage-lg .container-view {
        width: 100%;
        height: 254px;
        overflow: hidden;
    }

    .boxContainer.registerPage.registerPage-lg .container-view ul {
        width: 100%;
        height: 212px;
        overflow: hidden;
        overflow-y: scroll;
        direction: ltr;
        text-align: right;
    }

    .boxContainer.registerPage.registerPage-lg .container-view ul li {
        width: 100%;
        height: 35px;
        line-height: 35px;
        border-bottom: 1px solid #e3e3e3;
        padding-right: 15px;
        padding-left: 35px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        direction: rtl;
        position: relative;
    }

    .boxContainer.registerPage.registerPage-lg .container-view ul li a {
        left: 0;
        position: absolute;
        height: 100%;
        line-height: 39px;
        color: red;
        text-align: center;
        width: 35px;
    }

    .boxContainer.registerPage.registerPage-lg .selected-category li a i {
        width: 100%;
        height: 100%;
        line-height: 36px;
        top: 0;
        text-align: center;
        left: 0;
        cursor: pointer;
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


<div class="container mx-auto py-8 px-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
        <a class="home-icon" href="<?php echo RELA_DIR ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>"><span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span> مرحله: 5 </span></a>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="noPadding">
        <div class="shadow rounded-md overflow-hidden          boxContainer reg-container crop">
            <div class="registerPage container-floatinglabel registerPage-lg center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 5 از 7 </div>
                    </a>
                </div>

                <div class="p-6         content modal-body">
                    <div class="izi-container"></div>

                    <form action="/register/?step=6" method="post" name="form1" id="form1" role="form">

                        <div>
                            <div class="grid grid-cols-12 gap-6">

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative typing">
                                        <label for="province" class="block text-sm text-tolidatColor after:content-['*'] after:ml-0.5 after:text-red-500">لطفا استان را انتخاب نمایید</label>
                                        <select name="state_id" id="province" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" tabindex="1" oninvalid="setCustomValidity('لطفا استان را انتخاب نمایید')" oninput="setCustomValidity('')" >
                                            <option value="0">انتخاب استان</option>
                                            <?php foreach ($list['personalityType'] as $personalityType) { ?>
                                                <option value="<?php echo $personalityType['Personality_type_id'] ?>" <?php foreach ($list['province'] as $province) { ?> <option value="<?php echo $province['province_id'] ?>" <?php if ($list['data']['state_id'] == $province['province_id']) {
                                                                                                                                                                                                                                        echo "selected";
                                                                                                                                                                                                                                    } ?>>
                                                    <?php echo $province['name'] ?>
                                                </option>
                                            <?php } ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative typing">
                                        <label for="city" class="block text-sm text-tolidatColor after:content-['*'] after:ml-0.5 after:text-red-500">لطفا شهرستان را انتخاب نمایید</label>
                                        <select name="city_id" id="city" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" tabindex="2" oninvalid="setCustomValidity('لطفا شهرستان را انتخاب نمایید')" oninput="setCustomValidity('')" >
                                            <option value="0">انتخاب شهرستان</option>
                                            <?php foreach ($list['city'] as $city) { ?>
                                                <option value="<?php echo $city['City_id'] ?>" <?php if ($list['data']['city_id'] == $city['City_id']) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                    <?php echo $city['name'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-12">
                                    <div class="relative textarea">
                                        <label for="address" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">آدرس</label>
                                        <textarea name="address" id="address" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="3" oninvalid="setCustomValidity('لطفا آدرس را وارد نمایید')" oninput="setCustomValidity('')" ><?php echo $list['data']['address'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره تلفن ثابت</label>
                                        <input name="phone" id="phone" type="text" value="<?php echo ($list['data']['phone']) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" maxlength="8" tabindex="4" pattern="^[0-9۰-۹]{3,}$" oninvalid="setCustomValidity('لطفا شماره تلفن ثابت را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" >
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="relative">
                                        <label for="code" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">کد شهر</label>
                                        <input name="code" id="code" type="text" value="<?php echo ($list['data']['code']) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" maxlength="5" tabindex="5" max="99999" pattern="^[0-9۰-۹]{3,}$" oninvalid="setCustomValidity('کد کد شهر خود وارد شود')" oninput="setCustomValidity('')" dir="ltr" >
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <div class="relative">
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">کد پستی</label>
                                        <input name="postal_code" id="postal_code" type="text" value="<?php echo ($list['data']['postal_code']) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" maxlength="10" tabindex="6" max="9999999999" pattern="^[0-9۰-۹]{3,}$" oninvalid="setCustomValidity('کد کد پستی خود وارد شود')" oninput="setCustomValidity('')" dir="ltr" >
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="website" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">آدرس وب سایت</label>
                                        <input name="website" id="website" type="text" value="<?php echo ($list['data']['website']) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="7" placeholder="برای مثال:  www.tolidat.ir" oninvalid="setCustomValidity('آدرس وب سایت خود را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" >
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="email" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">ایمیل</label>
                                        <input name="email" id="email" type="email" value="<?php echo ($list['data']['email']) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="8" placeholder="برای مثال: info@tolidat.ir" oninvalid="setCustomValidity('ایمیل خود را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 modal-body">
                            <p class="reg-alert-r text-center">لطفا لوگوی مجموعه خود را از این قسمت بارگذاری نمایید</p>
                        </div>

                        <div class="max-w-md mx-auto mt-2             docs-buttons">
                            <div class="shadow rounded-md             img-container upload-msg">
                                <div class="img-container upload-msg register-crop">
                                    <img class="width image-crop img-cropper" src="<?php echo (isset($list['logo']) ? $list['logo'] : '/templates/' . CURRENT_SKIN . '/assets/image/placeholder.png'); ?>" alt="Picture">
                                </div>
                            </div>

                            <div class="btn-block mt">
                                <label class="mt-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600  uploud-btnProCrop" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> بارگذاری لوگو مجموعه
                                </label>
                                <input class="result-crop" type="hidden" name="imageCropped" value="">
                            </div>



                            <!-- Show the cropped image in modal -->
                            <!-- <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog">
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
                            </div> -->



                        </div>

                        <div class="mt-10">
                            <p class="text-center">لطفا یکی از دسته بندی ها را بر اساس نوع فعالیت مجموعه خود از این قسمت انتخاب نمایید</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <div class="search-box search-box1 boxBorder categoryContainer">
                                        <div class="search-box-header edit-primary-form whiteBg">
                                            <header>دسته بندی ها<i class="fa fa-bars" aria-hidden="true"></i></header>
                                        </div>
                                        <div class="mmenuHolder2 mmenu-register active">
                                            <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?php echo  $list['category']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="container-view boxBorder">
                                        <header>دسته انتخاب شده</header>
                                        <ul class="selected-category"></ul>
                                    </div>

                                    <input type="hidden" class="package_type" name="package_type" value="1">
                                    <input type="hidden" class="maxCanSelected" name="maxCanSelected" value="1">
                                    <input type="hidden" class="selectedCategories" value="<?php echo  trim($list['data']['category_id'], ',') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row xsmallSpace nextLoading"></div>

                        <button name="step_3" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="step" type="hidden" value="6">
                        <input name="company_type" type="hidden" value="1">
                    </form>

                    <form action="/register/?step=4" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="4">
                        <input name="company_type" type="hidden" value="<?php echo unserialize($_SESSION['step'])->data['1']['company_type'] ?>">
                        <button name="step1" type="submit" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
                            مرحله قبل
                        </button>
                    </form>
                </div>

                <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>
            </div>
        </div>
    </section>
</div>


<p class="error"><?php echo $list['validate']['msg'] ?></p>
<script>
    var packageType = parseInt(window.localStorage.getItem('packageType'));
    $('.maxCanSelected').val(packageType);
    $('.package_type').val(packageType);
</script>
<script>
    $.iziToastError = function(msg) {
        iziToast.settings({
            onOpen: function(e) {}
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };
    $(function() {
        $('#province').on('change', function() {
            var province_id = $(this).val();
            $('#city').empty();
            $.post('/city/getCityByProvinceID', {
                province_id: province_id
            }, function(data) {
                var result = $.parseJSON(data);
                $('#city').append('<option value="0">شهرستان را انتخاب نمایید...</option>');
                $.each(result, function(key, value) {
                    $('#city').append($('<option>', {
                        value: value.City_id,
                        text: value.name
                    }));
                });
            });
        });

        // category
        var categoryCheckBoxes = $('input[name="category_id[]"]');
        var category_id = "<?php echo (unserialize($_SESSION['step'])->data['5']['category_id']['0'] ? unserialize($_SESSION['step'])->data['5']['category_id']['0'] : $list['data']['category_id']) ?>";
        var categoriesArray = category_id.split(',');
        for (var i = 0; i < categoryCheckBoxes.length; i++) {
            if (categoriesArray.indexOf(categoryCheckBoxes[i].value) != -1) {
                categoryCheckBoxes[i].checked = true;
            }
        }
        // -------

        $('.uploadFile').on('change', function() {
            setTimeout(function() {
                $('.image-logo').val($('body #img-logo').attr('src'));
            }, 1000);
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }
    });
</script>