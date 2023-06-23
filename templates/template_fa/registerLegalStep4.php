<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>

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
                    <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                        <span>ثبت نام</span></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-destination"><span>مرحله : 3</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">اطلاعات درخواستی را با دقت وارد نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#">
                    <div class="badge">3 از 6</div>
                </a>
            </header>

            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate"
                      data-toggle="validator">
                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover"
                                   data-toggle="popover" title="" data-content=" لطفا نام کامل ثبتی مجموعه خود را وارد نمائید"
                                   data-original-title="نام مجموعه"></i>
                                <label for="company_name">نام مجموعه</label>
                                <input name="company_name" type="text" value="<?= $list['data']['company_name'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition"
                                       id="company_name" data-minlength="1" data-error="لطفا نام کامل ثبتی مجموعه خود را وارد نمائید."
                                       tabindex="1" required>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-registered" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover"
                                   data-toggle="popover" title="" data-content="لطفا شماره ثبت مربوط به مجموعه خود را وارد نمائید."
                                   data-original-title="شماره ثبت مجموعه"></i>
                                <label for="registration_number">شماره ثبت مجموعه</label>
                                <input name="registration_number" type="number"
                                       value="<?= $list['data']['registration_number'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="registration_number" data-minlength="1"
                                       data-error="لطفاشماره ثبت مربوط به مجموعه خود را وارد نمائید." tabindex="2" autofocus required>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <label for="registration_date">تاریخ تأسیس مجموعه</label>
                                <input name="registration_date" value="<?= $list['data']['registration_date'] ?>"
                                       type="text"
                                       class="form-control datePicker fullWidth displayBlock noRadius noPadding transition"
                                       id="registration_date" data-error="لطفا تاریخ تأسیس مجموعه را انتخاب نمایید"
                                       required tabindex="3">
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover"
                                   data-toggle="popover" title="" data-content="نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید."
                                   data-original-title="نام مدیر"></i>
                                <label for="coordinator_name">نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید.</label>
                                <input name="maneger_name" type="text" value="<?= $list['data']['maneger_name'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition"
                                       id="coordinator_name" data-minlength="3"
                                       data-error="نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید." tabindex="4" required>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block textarea">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover"
                                   data-toggle="popover" title=""
                                   data-content="زمینه فعالیت خود را جهت استفاده از امکانات SEO و جستجوی بهتر در موتورهای جستجو به صورت جامع بنویسید."
                                   data-original-title="زمینه فعالیت شرکت"></i>
                                <label for="description">زمینه فعالیت مجموعه</label>
                                <textarea name="description" type="text"
                                          class="form-control fullWidth displayBlock noRadius noPadding transition"
                                          id="description" data-minlength="2"
                                          data-error="لطفا فعالیت مجموعه را وارد نمایید" tabindex="5"
                                          required><?= $list['data']['description'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <div class="row xxxsmallSpace"></div>
                                <div class="form-group has-feedback center-block">
                                    <label for="personality_type">نوع شخصیت حقوقی را انتخاب نمایید</label>
                                    <select name="personality_type" id="personality_type" class="form-control"
                                            tabindex="6" data-error="لطفا نوع شخصیت حقوقی را انتخاب نمایید" required>
                                        <option value="">نوع شخصیت حقوقی</option>
                                        <?php foreach ($list['personalityType'] as $personalityType) { ?>
                                            <option value="<?php echo $personalityType['Personality_type_id'] ?>"
                                                <?php if ($list['data']['personality_type'] == $personalityType['Personality_type_id']) {
                                                    echo "selected";
                                                } ?> >
                                                <?php echo $personalityType['type'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block text-center">
                            <div class="checkbox">
                                <label for="toggleLicense">
                               
                                
                                    <input id="toggleLicense" <?php echo ($list['licence'] ? 'checked' : ''); ?> tabindex="7" type="checkbox">آیا دارای مجوز می باشید؟
                                    
                                </label>
                                <i class="fa fa-question-circle" style="left: auto;" aria-hidden="true" data-placement="top" data-trigger="hover"
                                   data-toggle="popover" title="" data-content=" اگر هر نوع مجوزی دارید تیک بزنید."
                                   data-original-title="نام مجموعه"></i>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row <?php echo ($list['licence'] ? '' : 'hidden'); ?>" data-toggle="toggleLicense">
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
                                <ul class="selected-category paddingRl ptb">
                                    <?php if ($list['licence']) { ?>
                                    <li class="text-center">
                                        <div class="row noMargin">
                                            <div class="col-xs-4 col-sm-4 col-md-4 pull-right">
                                                <img class="roundCorner fullWidth boxBorder" src="<?= $list['licence']['imageCropped']; ?>" alt="">
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

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mb">

                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <button name="step_4" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span
                                class="fa fa-angle-left"></span>
                    </button>
                    <input name="step" type="hidden" value="5">
                    <input name="company_type" type="hidden" value="1">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate"
                      data-toggle="validator">
                    <input name="step" type="hidden" value="3">
                    <input name="company_type" type="hidden" value="1">
                    <button name="step2" type="submit" class="btn btn-danger btn-sm reg-btn-p">مرحله قبل<span
                                class="fa fa-angle-right"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

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
                                    <input name="name" type="text" class="form-control" tabindex="8" id="name" required
                                           data-error="لطفا نام صاحب جواز را وارد کنید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="family">نام خانوادگی صاحب جواز</label>
                                    <input name="family" type="text" class="form-control" id="family" tabindex="9"
                                           required data-error="لطفا نام خانوادگی صاحب جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="national_code">کد ملی صاحب جواز</label>
                                    <input name="national_code"
                                           type="text"
                                           pattern="^[0-9۰-۹]{10,}$"
                                           maxlength="10"
                                           tabindex="10"
                                           class="form-control set-font-latin"
                                           id="national_code"
                                           required data-error="لطفا کد ملی صاحب جواز وارد کنید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="licence_number">شماره جواز</label>
                                    <input name="licence_number" type="text" tabindex="11"
                                           class="form-control set-font-latin" id="licence_number" required
                                           data-error="لطفا شماره جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="licence_type">انتخاب نوع جواز</label>
                                    <select name="licence_type" id="licence_type" tabindex="13"
                                            class="form-control"></select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right" id="div-licence_type">
                                <div class="form-group">
                                    <label for="licence_type_name">نوع جواز</label>
                                    <input name="licence_type_name" type="text" tabindex="12" class="form-control"
                                           id="licence_type_name" required data-error="لطفا نوع جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group">
                                    <label for="exporter_refrence">مرجع تایید جواز</label>
                                    <input name="exporter_refrence" type="text" class="form-control" tabindex="14"
                                           id="exporter_refrence" required
                                           data-error="لطفا مرجع تأیید جواز را وارد کنید">
                                </div>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group full-date-picker">
                                    <label for="issuence_date">تاریخ صدور جواز</label>
                                    <input name="issuence_date" type="text" tabindex="15"
                                           class="form-control datePicker set-font-latin" id="issuence_date" required
                                           data-error="لطفا تاریخ صدور جواز را وارد کنید">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group full-date-picker">
                                    <label for="expiration_date">تاریخ انقضا جواز</label>
                                    <input name="expiration_date" type="text" tabindex="16"
                                           class="form-control datePicker set-font-latin" id="expiration_date" required
                                           data-error="لطفا تاریخ انقضا جواز را انتخاب کنید">
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
                                    <textarea name="description" class="form-control" rows="3" tabindex="17"
                                              id="description" required
                                              data-error="لطفا زمینه فعالیت را وارد نمایید"></textarea>
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
                                        <img class="width image-javaz img-cropper" id="imageLicence"
                                             src="<?= RELA_DIR . 'templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'; ?>"
                                             alt="Picture">
                                    </div>
                                    <div class="btn-block mt">
                                        <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb"
                                               for="inputImage" title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage" name="file"
                                                   accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                            <span class="docs-tooltip" data-animation="false"
                                                  title="Import image with Blob URLs">
                                                <span>
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </span>
                                                <span>انتخاب تصویر</span>
                                            </span>
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

<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script>
    $(function () {
        var $body = $('body'),
            $delLicense = '<a class="btn btn-danger btn-sm pull-right center-block delete-licence" style="margin-top: 7px;">حذف مجوز</a>',
            $addLicense = '<button type="button" class="btn btn-primary btn-sm pull-right center-block addLicenseCompany" style="margin-top: 7px;">افزودن مجوز</button>';

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

            $.post('/register/addLicence/', function (data) {
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
                url: '/register/addLicenceByAjax/',
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
                                                '<img class="roundCorner fullWidth boxBorder" src="'+response.data.imageCropped+'" alt="">'+
                                            '</div>'+
                                            '<div class="col-xs-8 col-sm-8 col-md-8 pull-right">'+
                                                '<h3 class="text-right">'+response.data.name+' '+response.data.family+'</h3>'+
                                                '<p class="text-right">به شماره جواز '+response.data.licence_number+'</p>'+
                                            '</div>'+
                                        '</div>'+
                                    '</li>';

                        $('.selected-category').find('.emptyLabel').remove();
                        $('.selected-category').append(html);

                        $('#myModal3').modal('hide');

                        $body.find('.addLicenseCompany').remove();
                        $body.find('.license-container').prepend($delLicense);

                        $.iziToastSuccess(response.msg, '.content .izi-container');
                    }
                }
            });
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        function emptyModal() {
            $('#myModal3').find('input[type="text"], input[type="hidden"], input[type="file"], textarea').each(function () {
                $(this).val("");
                $(this).siblings('.requiredIcon').empty().text('*');
                $(this).parent().removeClass('has-error has-success typing');
            });

            $('#myModal3').find('#imageLicence').attr("src", '<?php echo RELA_DIR . "templates/template_fa/assets/images/placeholder.png" ?>');

            $('#myModal3').find('#div-licence_type').hide();
        }

        $body.on('click', '.delete-licence', function () {
            var $this = $(this);

            if (confirm("از حذف مجوز اطمینان دارید")) {

                $.get('/register/deleteLicenceByAjax/', function (data) {
                    var response = $.parseJSON(data);

                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.content .izi-container');
                        return;
                    }

                    /*$.iziToastSuccess(response.msg, '.content .izi-container');
                    $('.show-added-licence').empty();
                    emptyModal();

                    $this.remove();

                    $('.selected-category').html('<li class="text-center emptyLabel">هیچ آیتمی موجود نیست</li>');

                    $body.find('.license-container').prepend($addLicense);*/

                    window.location.reload();
                });
            }
        });

        $body.on('click', '#toggleLicense', function () {
            if($(this).is(':checked')) {
                $body.find('[data-toggle="toggleLicense"]').removeClass('hidden');
            } else {
                $body.find('[data-toggle="toggleLicense"]').addClass('hidden');
            }
        });
    });

</script>
