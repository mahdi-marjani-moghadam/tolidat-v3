<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css"/>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>


<section class="container noPadding">
    <!-- boxContainer -->
    <div class="boxContainer reg-container crop">
        <div class="row noMargin">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="Breadcrumb">
                    <a class="home-icon" href="<?php echo RELA_DIR ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-address" href="<?php echo RELA_DIR . "register" ?>"><span>ثبت نام</span></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-destination"><span> مرحله: 4</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel registerPage-lg center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">اطلاعات درخواستی را با دقت وارد نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">4 از 6</div></a>
            </header>
            <div class="content modal-body">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row xxsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback typing">
                                <label for="province">لطفا استان را انتخاب نمایید</label>
                                <select name="state_id" id="province" class="form-control" tabindex="1" required data-error="لطفا استان را انتخاب نمایید">
                                    <option value="0">انتخاب استان</option>
                                    <?php foreach ($list['province'] as $province) { ?>
                                        <option value="<?php echo $province['province_id'] ?>" <?php if ($list['data']['state_id'] == $province['province_id']) {
                                            echo "selected";
                                        } ?> >
                                            <?php echo $province['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback typing">
                                <label for="city">لطفا شهرستان را انتخاب نمایید</label>
                                <select name="city_id" id="city" class="form-control" tabindex="2" autofocus required data-error="لطفا شهرستان را انتخاب نمایید">
                                    <option value="0">انتخاب شهرستان</option>
                                    <?php foreach ($list['city'] as $city) { ?>
                                        <option value="<?php echo $city['City_id'] ?>" <?php if ($list['data']['city_id'] == $city['City_id']) {
                                            echo "selected";
                                        } ?> >
                                            <?php echo $city['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block textarea">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="آدرس خود را به صورت دقیق و کامل وارد نمایید" data-original-title="آدرس" tabindex="3"></i>
                                <label for="address" >آدرس</label>
                                <textarea name="address" id="address" class="form-control" required data-error="لطفا آدرس را وارد نمایید"><?php echo $list['data']['address'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="شماره تلفن خود را وارد نمایید" data-original-title="شماره تلفن ثابت"></i>
                                <label for="phone" >شماره تلفن ثابت</label>
                                <input name="phone" id="phone" type="text" class="form-control set-font-latin" value="<?php echo ($list['data']['phone']) ?>" tabindex="4" pattern="^[0-9۰-۹]{3,}$" maxlength="8" data-error="لطفا شماره تلفن ثابت را وارد نمایید" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-2 col-md-2 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-question question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="کد شهر خود را وارد نمایید" data-original-title="کد شهر"></i>
                                <label for="code" >کد شهر</label>
                                <input name="code" id="code" type="text" class="form-control set-font-latin" value="<?php echo ($list['data']['code']) ?>" tabindex="5" maxlength="5" max="99999" pattern="^[0-9۰-۹]{3,}$" data-error="کد کد شهر خود وارد شود" required>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-2 col-md-2 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-question question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="کد پستی خود را وارد نمایید" data-original-title="کد پستی"></i>
                                <label for="postal_code" >کد پستی</label>
                                <input name="postal_code" id="postal_code" type="text" class="form-control set-font-latin" value="<?php echo ($list['data']['postal_code']) ?>" tabindex="10" maxlength="10" max="9999999999" pattern="^[0-9۰-۹]{3,}$" data-error="کد کد پستی خود وارد شود" required>
                            </div>
                        </div>
                    </div>
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="آدرس وب سایت خود را وارد نمایید، برای مثال: http://www.tolidat.ir" data-original-title="آدرس وب سایت"></i>
                                <label for="website">آدرس وب سایت</label>
                                <input name="website" id="website" type="text" class="form-control set-font-latin ltr text-left" value="<?php echo ($list['data']['website']) ?>" data-error="آدرس وب سایت خود را وارد نمایید" tabindex="6">
                            </div>
                            <p class="grayColor">برای مثال:  www.tolidat.ir</p>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="لطفا ایمیل معتبر مجموعه خود را جهت ارتباط مستقیم مشتری وارد نمائید." data-original-title="ایمیل"></i>
                                <label for="email" >ایمیل</label>
                                <input name="email" id="email" type="email" class="form-control set-font-latin ltr text-leftn ltr text-left" value="<?php echo ($list['data']['email']) ?>" data-error="ایمیل خود را وارد نمایید" tabindex="7">
                            </div>
                            <p class="grayColor">برای مثال: info@tolidat.ir  </p>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div  class="col-xs-12 col-sm-6 col-md-6 center-block modal-body">
                            <p class="text-center">لطفا لوگوی مجموعه خود را از این قسمت بارگذاری نمایید</p>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <div class="img-container upload-msg register-crop">
                                        <img  class="width image-crop img-cropper" src="<?php echo(isset($list['logo']) ? $list['logo'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                                    </div>
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right text-center" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>  بارگذاری لوگو مجموعه
                                    </label>
                                    <input class="result-crop" type="hidden" name="imageCropped" value="">
                                </div>
                                <!-- Show the cropped image in modal -->
                                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog">
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
                                </div>
                            </div>
                            <div class="row xxxsmallSpace"></div>
                        </div>
                    </div>
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
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?= $list['category']; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="container-view boxBorder">
                                <header>دسته انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>

                            <input type="hidden" class="maxCanSelected" value="1">
                            <input type="hidden" class="selectedCategories" value="<?= trim($list['data']['category_id'], ',') ?>">
                        </div>
                    </div>
                    <!-- separator -->
                    <div class="row xsmallSpace nextLoading"></div>
                    <button name="step_3" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="6">
                    <input name="company_type" type="hidden" value="1">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <input name="step" type="hidden" value="4">
                    <input name="company_type" type="hidden" value="<?php echo unserialize($_SESSION['step'])->data['1']['company_type'] ?>">
                    <button name="step1" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                </form>
            </div>
        </div>
    </div>
</section>

<p class="error"><?php echo $list['validate']['msg'] ?></p>
<script>

    $(function () {
        $('#province').on('change', function () {
            var province_id = $(this).val();
            $('#city').empty();
            $.post('/city/getCityByProvinceID', {province_id: province_id}, function (data) {
                var result = $.parseJSON(data);
                $('#city').append('<option value="0">شهرستان را انتخاب نمایید...</option>');
                $.each(result, function (key, value) {
                    $('#city').append($('<option>', {
                        value: value.City_id,
                        text: value.name
                    }));
                });
            });
        });

        // category
        var categoryCheckBoxes = $('input[name="category_id[]"]');
        var category_id = "<?php echo(unserialize($_SESSION['step'])->data['5']['category_id']['0'] ? unserialize($_SESSION['step'])->data['5']['category_id']['0'] : $list['data']['category_id']) ?>";
        var categoriesArray = category_id.split(',');
        for (var i = 0; i < categoryCheckBoxes.length; i++) {
            if (categoriesArray.indexOf(categoryCheckBoxes[i].value) != -1) {
                categoryCheckBoxes[i].checked = true;
            }
        }
        // -------

        $('.uploadFile').on('change', function () {
            setTimeout(function(){ $('.image-logo').val($('body #img-logo').attr('src')); }, 1000);
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }
    });

</script>
