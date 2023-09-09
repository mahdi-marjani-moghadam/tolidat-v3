<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css" />
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
                <a class="container-badge" href="#">
                    <div class="badge">4 از 4</div>
                </a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="row xsmallSpace hidden-xs"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="company_name">نام مجموعه</label>
                                <input value="<?php echo $list['company_name'] ?>" name="company_name" type="text" class="form-control" id="company_name" required data-error="لطفا نام تولیدی را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="maneger_name">نام مدیر</label>
                                <input value="<?php echo $list['maneger_name'] ?>" name="maneger_name" class="form-control" type="text" id="maneger_name" required data-error="لطفا نام مدیر را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="name">نام صاحب جواز</label>
                                <input value="<?php echo $list['licence']['name'] ?>" name="name" type="text" id="name" class="form-control" required data-error="لطفا نام صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="family">نام خانوادگی صاحب جواز</label>
                                <input value="<?php echo $list['licence']['family'] ?>" name="family" type="text" class="form-control" id="family" required data-error="لطفا نام خانوادگی صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description" type="text" id="description" class="form-control" required data-error="لطفا زمینه فعالیت  را وارد نمایید"><?php echo $list['licence']['description'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="licence_type">نوع جواز</label>
                                <select name="licence_type" id="licence_type" class="licence_type form-control">
                                    <?php foreach ($list['licence_list'] as $licence) : ?>
                                        <option value="<?php echo $licence['Licence_list_id'] ?>" <?php echo  $licence['Licence_list_id'] == $list['licence']['licence_type'] ? 'selected' : '' ?>>
                                            <?php echo $licence['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <option value="0">غیره</option>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group div-licence_type" id="div-licence_type">
                                <label for="licence_type_name">نوع جواز</label>
                                <input value="<?php echo $list['licence']['licence_type'] ?>" name="licence_type_name" type="text" class="form-control" id="licence_type_name" data-error="لطفا نوع جواز خود را وارد کنید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="licence_number">شماره جواز</label>
                                <input value="<?php echo $list['licence']['licence_number'] ?>" name="licence_number" type="text" class="form-control" id="licence_number" data-error="لطفا شماره جواز خود را وارد کنید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="national_code">کد ملی صاحب جواز</label>
                                <input value="<?php echo $list['licence']['national_code'] ?>" name="national_code" maxlength="10" type="text" class="form-control" pattern="^[0-9]{10,}$" id="national_code" required data-error="لطفا کد ملی صاحب جواز را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="issuence_date">تاریخ صدور جواز:</label>
                                <input value="<?php echo  $list['licence']['issuence_date'] ? convertDate($list['licence']['issuence_date']) : '' ?>" type="text" name="issuence_date" class="form-control datePicker" readonly id="issuence_date" data-error="لطفا تاریخ صدور جواز خود را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="expiration_date">تاریخ انقضا جواز</label>
                                <input value="<?php echo  $list['licence']['issuence_date'] ? convertDate($list['licence']['expiration_date']) : '' ?>" type="text" name="expiration_date" class="form-control datePicker" readonly id="expiration_date" data-error="لطفا تاریخ انقضا جواز خود را وارد کنید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="exporter_refrence">مرجع صادرکننده</label>
                                <input value="<?php echo $list['licence']['exporter_refrence'] ?>" name="exporter_refrence" type="text" class="form-control" id="exporter_refrence" data-error="لطفا مرجع صادرکننده را وارد نمایید">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 center-block modal-body">
                            <div class="reg-alert-r text-center">تصویر جواز خود را انتخاب نمایید</div>
                            <div class="row xxxsmallSpace"></div>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg register-crop">
                                    <img class="width image-crop img-cropper" id="imageLicence" src="<?php echo  $list['licence']['image'] ?>" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        انتخاب تصویر
                                    </label>
                                    <input class="result-crop" type="hidden" name="imageCropped" value="">
                                </div>

                                <!-- separator -->
                                <div class="row xxxsmallSpace"></div>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback">
                                <i class="fa fa-question question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="کد پستی خود را وارد نمایید" data-original-title="کد پستی"></i>
                                <label for="postal_code">کد پستی</label>
                                <input name="postal_code" id="postal_code" type="text" class="form-control set-font-latin" value="<?php echo  $list['postal_code'] ?>" tabindex="10" maxlength="10" max="9999999999" pattern="^[0-9]{3,}$" data-error="کد کد پستی خود وارد شود" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="address">آدرس</label>
                                <textarea name="address" id="address" type="text" required data-error="لطفا آدرس را وارد نمایید"><?php echo $list['address'] ?></textarea>
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
                                        <option value="<?php echo $province['province_id'] ?>" <?php echo  $province['province_id'] == $list['state_id'] ? 'selected' : '' ?>>
                                            <?php echo $province['name'] ?></option>
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
                                        <option value="<?php echo $city['City_id'] ?>" <?php echo  $city['City_id'] == $list['city_id'] ? 'selected' : '' ?>>
                                            <?php echo $city['name'] ?></option>
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
                                <label for="number">تلفن</label>
                                <input value="<?php echo $list['number'] ?>" name="number" id="number" type="text" class="form-control" pattern="^[0-9]{3,}$" maxlength="8" required data-error="لطفا تلفن را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="code">کد پیش شماره</label>
                                <input value="<?php echo $list['code'] ?>" name="code" id="code" type="text" class="form-control" maxlength="3" max="999" pattern="^[0-9]{3,3}$" required data-error="لطفا کد پیش شماره را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input value="<?php echo $list['email'] ?>" name="email" id="email" type="text" class="form-control" data-error="لطفا ایمیل  را وارد نمایید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <label for="url">وب سایت</label>
                                <input value="<?php echo $list['url'] ?>" name="url" id="url" type="text" class="form-control" data-error="لطفا وب سایت  را وارد نمایید">
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
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?php echo  $list['category']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="container-view boxBorder mt">
                                <header>دسته انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>

                            <input type="hidden" class="maxCanSelected" value="1">
                            <input type="hidden" class="selectedCategories">
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
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb" for="inputImage1" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage1" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        انتخاب تصویر

                                    </label>
                                    <input class="result-crop" type="hidden" name="logo" value="<?php echo $list['logo'] ?>">
                                </div>

                                <!-- separator -->
                                <div class="row xxxsmallSpace"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace nextLoading hidden-xs"></div>
                    <button name="step_3" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="5">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <button name="step1" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                    <input name="step" type="hidden" value="3">
                </form>
            </div>
        </div>
    </div>
</section>

<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
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
        var $body = $('body');

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        $('body #div-licence_type').hide();
        $body.on('change', '#licence_type', function() {
            if ($(this).val() == 0) {
                $('#div-licence_type').show();
            } else {
                $('#div-licence_type').hide();
            }
        });

    });
</script>