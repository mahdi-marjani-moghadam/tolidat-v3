<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css"/>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<section class="container noPadding">
    <!-- boxContainer -->
    <div class="boxContainer reg-container">
        <div class="row noMargin">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="Breadcrumb">
                    <a class="home-icon" href="<?php echo RELA_DIR ?>">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-address">
                        <span>ویکی</span></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-destination"><span>مرحله : 4</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel registerPage-lg center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">ویکی مجموعه</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">4 از 4</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="row xsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="company_name">نام تولیدی</label>
                                <input value="<?=$list['company_name']?>" name="company_name" type="text" class="form-control" id="company_name" required data-error="لطفا نام تولیدی را وارد نمایید">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="maneger_name">نام مدیر</label>
                                <input value="<?=$list['maneger_name']?>" name="maneger_name" class="form-control" type="text" id="maneger_name" required data-error="لطفا نام مدیر را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="registration_number">شماره ثبت</label>
                                <input value="<?=$list['registration_number']?>" name="registration_number" class="form-control" type="text" id="registration_number" required data-error="لطفا شماره ثبت را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="national_id">شناسه ملی</label>
                                <input value="<?=$list['national_id']?>" name="national_id" maxlength="11" type="text" class="form-control" id="national_id" required data-error="لطفا شناسه ملی مجموعه را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="personality_type">نوع شخصیت حقوقی</label>
                                <select name="personality_type" id="personality_type" class="personality_type form-control">
                                    <option value="0">نوع شخصیت را انتخاب کنید...</option>
                                    <?php foreach ($list['personality_list'] as $personality) : ?>
                                        <option value="<?=$personality['Personality_type_id']?>" <?= $personality['Personality_type_id'] == $list['personality_type'] ? 'selected' : '' ?> >
                                            <?=$personality['type']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description" type="text" id="description" class="form-control" required data-error="لطفا زمینه فعالیت  را وارد نمایید"><?=$list['description']?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback">
                                <i class="fa fa-question question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="کد پستی خود را وارد نمایید" data-original-title="کد پستی"></i>
                                <label for="postal_code" >کد پستی</label>
                                <input name="postal_code" id="postal_code" type="text" class="form-control set-font-latin" value="<?= $list['postal_code'] ?>" tabindex="10" maxlength="10" max="9999999999" pattern="^[0-9]{3,}$" data-error="کد کد پستی خود وارد شود" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="address">آدرس را وارد نمایید</label>
                                <textarea name="address" id="address" type="text" required data-error="لطفا آدرس را وارد نمایید"><?=$list['address']?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="province_id">استان</label>
                                <select name="province_id" id="province_id" class="province_id form-control">
                                    <option value="0">استان را انتخاب کنید...</option>
                                    <?php foreach ($list['province'] as $province) : ?>
                                        <option value="<?=$province['province_id']?>" <?= $province['province_id'] == $list['province_id'] ? 'selected' : '' ?> >
                                            <?=$province['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group typing">
                                <label for="city_id">شهر</label>
                                <select name="city_id" id="city_id" class="city_id form-control">
                                    <option value="0">شهر را انتخاب کنید...</option>
                                    <?php foreach ($list['city'] as $city) : ?>
                                        <option value="<?=$city['City_id']?>" <?= $city['City_id'] == $list['city_id'] ? 'selected' : '' ?> >
                                            <?=$city['name']?></option>
                                    <?php endforeach; ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="number">تلفن را وارد نمایید</label>
                                <input value="<?=$list['number']?>" name="number" id="number" type="text" class="form-control" required data-error="لطفا تلفن را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="code">کد را وارد نمایید</label>
                                <input value="<?=$list['code']?>" name="code" id="code" type="text" class="form-control" required data-error="لطفا کد را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="email">ایمیل را وارد نمایید</label>
                                <input value="<?=$list['email']?>" name="email" id="email" type="email" class="form-control" data-error="لطفا ایمیل  را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="url">وب سایت را وارد نمایید</label>
                                <input value="<?=$list['url']?>" name="url" id="url" type="text" class="form-control" data-error="لطفا وب سایت را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p class="text-center">لطفا یکی از دسته بندی ها را بر اساس نوع فعالیت مجموعه خود از این قسمت انتخاب نمایید</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="search-box search-box1 boxBorder categoryContainer">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header>دسته بندی ها<i class="fa fa-bars" aria-hidden="true"></i></header>
                                </div>
                                <div class="mmenuHolder2 mmenu-register active">
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها">
                                        <?= $list['category']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="container-view boxBorder mt">
                                <header>دسته انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>

                            <input type="hidden" class="maxCanSelected" value="1">
                            <input type="hidden" class="selectedCategories" value="<?= $list['category_id'] ?>">
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 center-block modal-body">
                            <div class="reg-alert-r text-center">در صورت دارا بودن لوگو مجموعه، از طریق قسمت پایین آن را بارگذاری نمایید.</div>
                            <div class="row xxxsmallSpace"></div>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg register-crop">
                                    <img class="width image-crop img-cropper" id="imageLogo" src="<?php echo $list['logo'] ?>" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb"
                                           for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        انتخاب تصویر
                                    </label>
                                    <input class="result-crop" type="hidden" name="logo" value="<?php echo $list['logo'] ?>">
                                </div>
                                <!-- separator -->
                                <div class="row xxxsmallSpace"></div>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row" data-toggle="toggleLicense">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block">
                            <div class="container-view boxBorder">
                                <header class="license-container">
                                    <?php
                                    if($list['licence']) {
                                        ?>
                                        <a class="btn btn-danger btn-sm pull-right center-block delete-licence" style="margin-top: 7px;">
                                             حذف مجوز
                                        </a>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary btn-sm pull-right center-block addLicenseCompany" style="margin-top: 7px;">
                                            افزودن مجوز
                                        </button>
                                    <?php } ?>

                                    <span class="addedLicense pull-left">مجوز ایجاد شده</span>
                                </header>
                                <ul class="added-licence paddingRl ptb">
                                    <?php if ($list['licence']) { ?>
                                        <li class="text-center">
                                            <div class="row noMargin">
                                                <div class="col-xs-4 col-sm-4 col-md-4 pull-right">
                                                    <img class="roundCorner fullWidth boxBorder" src="<?= $list['licence']['image'] ?>" alt="">
                                                </div>
                                                <div class="col-xs-8 col-sm-8 col-md-8 pull-right">
                                                    <h4 class="text-right"><?= $list['licence']['name']. " " .$list['licence']['family']; ?></h4>
                                                    <p class="text-right">به شماره جواز <?= $list['licence']['licence_number']; ?></p>
                                                    <a class="delete-licence"><span class="fa fa-trash text-danger"></span></a>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } else {
                                        ?>
                                        <li class="text-center emptyLabel">هیچ آیتمی موجود نیست</li>
                                        <?php
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row xsmallSpace"></div>
                    <div class="row xxsmallSpace nextLoading hidden-xs"></div>
                    <button name="step_3" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input  name="step" type="hidden" value="5">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <button name="step2" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                    <input name="step" type="hidden" value="3">
                </form>
            </div>
        </div>
    </div>

    <!-- modal add licence -->
    <div class="holder-modal modal-register modal fade container-floatinglabel crop" id="myModal3" tabindex="-1"
         role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title roundCorner" id="myModalLabel">افزودن مجوز برای مجموعه</h5>
                    <p id="message"></p>
                </div>
                <div class="modal-body">
                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="content-izi">
                        <div class="izi-container"></div>
                    </div>
                    <form class="form" enctype="multipart/form-data" method="post" data-toggle="validator"
                          novalidate="novalidate">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="name">نام صاحب جواز</label>
                                    <input name="name" type="text" class="form-control" tabindex="8" id="name" required data-error="لطفا نام صاحب جواز را وارد کنید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="family">نام خانوادگی صاحب جواز</label>
                                    <input name="family" type="text" class="form-control" id="family" tabindex="9" required data-error="لطفا نام خانوادگی صاحب جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="national_code">کد ملی صاحب جواز</label>
                                    <input name="national_code" type="text" pattern="^[0-9]{10,}$" maxlength="10" tabindex="10" class="form-control set-font-latin" id="national_code" required data-error="لطفا کد ملی صاحب جواز وارد کنید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="licence_number">شماره جواز</label>
                                    <input name="licence_number" type="text" tabindex="11" class="form-control set-font-latin" id="licence_number" required data-error="لطفا شماره جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="licence_type">انتخاب نوع جواز</label>
                                    <select name="licence_type" id="licence_type" tabindex="13" class="form-control"></select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right" id="div-licence_type">
                                <div class="form-group">
                                    <label for="licence_type_name">نوع جواز</label>
                                    <input name="licence_type_name" type="text" tabindex="12" class="form-control" id="licence_type_name" required data-error="لطفا نوع جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="exporter_refrence">مرجع تایید جواز</label>
                                    <input name="exporter_refrence" type="text" class="form-control" tabindex="14" id="exporter_refrence" required data-error="لطفا مرجع تأیید جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group full-date-picker">
                                    <label for="issuence_date">تاریخ صدور جواز</label>
                                    <input name="issuence_date" type="text" tabindex="15" class="form-control datePicker set-font-latin" id="issuence_date" required data-error="لطفا تاریخ صدور جواز را وارد کنید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group full-date-picker">
                                    <label for="expiration_date">تاریخ انقضا جواز</label>
                                    <input name="expiration_date" type="text" tabindex="16" class="form-control datePicker set-font-latin" id="expiration_date" required data-error="لطفا تاریخ انقضا جواز را انتخاب کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="description">زمینه فعالیت</label>
                                    <textarea name="description" class="form-control" rows="3" tabindex="17" id="description" required data-error="لطفا زمینه فعالیت را وارد نمایید"></textarea>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 center-block modal-body">
                                <div class="reg-alert-r text-center">تصویر جواز خود را انتخاب نمایید</div>
                                <div class="row xxxsmallSpace"></div>
                                <div class="docs-buttons">
                                    <div class="img-container upload-msg register-crop">
                                        <img class="width image-crop img-cropper" id="imageLicence"
                                             src="<?= RELA_DIR . 'templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'; ?>"
                                             alt="Picture">
                                    </div>
                                    <div class="btn-block mt">
                                        <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb"
                                               for="inputImage1" title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage1" name="file"
                                                   accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                            انتخاب تصویر

                                        </label>
                                        <input class="result-crop" type="hidden" name="imageCropped" value="">
                                    </div>

                                    <!-- separator -->
                                    <div class="row xxxsmallSpace"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer noPadding pt">
                            <button type="button" id="addLicence" class="btn btn-success btn-sm" tabindex="18">ذخیره مجوز</button>
                            <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<p class="error"><?php echo $list['validate']['msg'] ?></p>
<script>
    $(window).load(function() {

        var $body = $('body'),
            $delLicense = '<a class="btn btn-danger btn-sm pull-right center-block delete-licence" style="margin-top: 7px;">حذف مجوز</a>',
            $addLicense = '<button type="button" class="btn btn-primary btn-sm pull-right center-block addLicenseCompany" style="margin-top: 7px;">افزودن مجوز</button>';

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        var category_id = '<?=$list['category_id'];?>';
        var categoriesArray = category_id.split(',');

        categoriesArray = $.map(categoriesArray, function(item) {
            return item !== '' ? item : null
        });

        console.log(categoriesArray);

        $.each(categoriesArray, function(i, v) {
            $('.categoryContainer').find('input[value="' + v+ '"]').prop('checked', true);
        });

        $.fillSelectedCategories($obj = {});

        $body.on('click', '.delete-licence', function () {

            if (confirm("از حذف مجوز اطمینان دارید")) {

                $.get('/wiki/deleteLicenceByAjax/', function (data) {
                    var response = $.parseJSON(data);

                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.content .izi-container');
                        return;
                    }

                    window.location.reload();
                });
            }
        });

        $('body #div-licence_type').hide();
        $('body #licence-type-edit').hide();

        $body.on('change', '#licence_type', function () {
            if ($(this).val() == 0) {
                $('#div-licence_type').show();
            } else {
                $('#div-licence_type').hide();
            }
        });

        var cnt = 0;
        $body.on('click', '.addLicenseCompany', function () {

            $('#licence_type').empty();

            $.post('/wiki/showLicenceModal/', function (data) {
                console.log(data);
                var result = $.parseJSON(data);

                $body.find('#licence_type').append('<option value="">نوع جواز را انتخاب نمایید...</option>');

                $.each(result.licence_list, function (key, value) {
                    if (result.licence_prev) {
                        $('#licence_type').append('<option value="' + value.Licence_list_id + '"' + (result.licence_prev.licence_type == value.Licence_list_id ? 'selected' : '') + '>' + value.name + '</option>');
                    } else {
                        $('#licence_type').append('<option value="' + value.Licence_list_id + '">' + value.name + '</option>');
                    }
                });

                $body.find('#licence_type').append('<option value="0">غیره...</option>');

                $.each(result.licence_prev, function (key, value) {
                    $('#myModal3').find('[name="' + key + '"]').val(value);

                    if (key == 'imageCropped') {
                        $('#myModal3').find('[id="imageLicence"]').attr('src', value);
                    }
                });

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="tel"], input[type="password"], textarea').each(function () {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                $('#myModal3').modal('show');

            });
        });

        $body.on('click', '#addLicence', function () {
            $('.image_name').val($('#img').attr('src'));
            var $this = $(this),
                form = $('.form')[0],
                formData = new FormData(form);

            $this.prop('disabled', true);

            if ($('.iziToast').length) {
                var toast = document.querySelector('.iziToast');
                iziToast.hide(toast);
            }

            $.ajax({
                url: '/wiki/addLicenceByAjax/',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $this.prop('disabled', false);

                    var response = $.parseJSON(data);
                    if (response.result === -1) {
                        var validationMsg = '';

                        if (response.name !== undefined && response.name.length) {
                            validationMsg += response.name + ' <br> ';
                        }

                        if (response.description !== undefined && response.description.length) {
                            validationMsg += response.description + ' <br> ';
                        }

                        if (response.expiration_date !== undefined && response.expiration_date.length) {
                            validationMsg += response.expiration_date + ' <br> ';
                        }

                        if (response.exporter_refrence !== undefined && response.exporter_refrence.length) {
                            validationMsg += response.exporter_refrence + ' <br> ';
                        }

                        if (response.family !== undefined && response.family.length) {
                            validationMsg += response.family + ' <br> ';
                        }

                        if (response.issuence_date !== undefined && response.issuence_date.length) {
                            validationMsg += response.issuence_date + ' <br> ';
                        }

                        if (response.national_code !== undefined && response.national_code.length) {
                            validationMsg += response.national_code + ' <br> ';
                        }

                        validationMsg += response.msg;

                        $.iziToastError(validationMsg, '.content-izi .izi-container');
                    } else {

                        var html = '<li class="text-center">'+
                            '<div class="row noMargin">'+
                            '<div class="col-xs-4 col-sm-4 col-md-4 pull-right">'+
                            '<img class="roundCorner fullWidth boxBorder" src="'+response.data.image+'" alt="">'+
                            '</div>'+
                            '<div class="col-xs-8 col-sm-8 col-md-8 pull-right">'+
                            '<h3 class="text-right">'+response.data.name+' '+response.data.family+'</h3>'+
                            '<p class="text-right">به شماره جواز '+response.data.licence_number+'</p>'+
                            '</div>'+
                            '</div>'+
                            '</li>';

                        $('.added-licence').find('.emptyLabel').remove();
                        $('.added-licence').append(html);

                        $('#myModal3').modal('hide');

                        $body.find('.addLicenseCompany').remove();
                        $body.find('.license-container').prepend($delLicense);

                        $.iziToastSuccess(response.msg, '.content .izi-container');
                    }
                }
            });
        });

        function emptyModal() {
            $('#myModal3').find('input[type="text"], input[type="hidden"], input[type="file"], textarea').each(function () {
                $(this).val("");
                $(this).siblings('.requiredIcon').empty().text('*');
                $(this).parent().removeClass('has-error has-success typing');
            });

            $('#myModal3').find('#imageLicence').attr("src", '<?php echo RELA_DIR . "templates/template_fa/assets/images/placeholder.png" ?>');

            $('#myModal3').find('#div-licence_type').hide();
        }

        $('.province_id').on('change', function () {
            var province_id = $(this).val();
            $('.city_id').empty();
            $.post('/city/getCityByProvinceID', {province_id: province_id}, function (data) {
                var result = $.parseJSON(data);
                $('.city_id').append('<option value="0">شهر را انتخاب کنید...</option>');
                $.each(result, function (key, value) {
                    $('.city_id').append($('<option>', {
                        value: value.City_id,
                        text: value.name
                    }));
                });
            });

        });
    });
</script>

