<link rel="Stylesheet" type="text/css" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<section class="container noPadding">
    <!-- boxContainer -->
    <div class="boxContainer reg-container crop">
        <!-- separator -->
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>مرحله : 4</span></a>
        </div>
        <div class="registerPage container-floatinglabel registerPage-lg center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="center-block">لطفا با دقت اطلاعات لازم دار تکمیل نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">4 از 7</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator" enctype="multipart/form-data">
                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row xxsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نام صاحب جواز" data-content="لطفا نام صاحب جواز را وارد نمایید"></i>
                                <label for="name">نام صاحب جواز</label>
                                <input name="name" type="text" value="<?= $list['data']['name'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="name" data-minlength="3" data-error="لطفا نام صاحب جواز را وارد نمایید" tabindex="1" autofocus required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-id-card-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نام خانوادگی صاحب جواز" data-content="لطفا نام خانوادگی صاحب جواز را وارد نمایید"></i>
                                <label for="family">نام خانوادگی صاحب جواز</label>
                                <input name="family" type="text" value="<?= $list['data']['family'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="family" data-minlength="2" data-error="لطفا نام خانوادگی صاحب جواز را وارد نمایید" tabindex="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-briefcase" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نام مجموعه" data-content="لطفا نام شرکت را وارد نمایید"></i>
                                <label for="company_name">نام مجموعه</label>
                                <input name="company_name" type="text" value="<?= $list['data']['company_name'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="company_name" data-minlength="2" data-error="لطفا نام مجموعه را وارد نمایید" tabindex="3" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="کد ملی صاحب جواز" data-content="لطفا کد ملی صاحب جواز را وارد نمایید"></i>
                                <label for="national_code">کد ملی صاحب جواز</label>
                                <input name="national_code"
                                       type="text"
                                       value="<?= $list['data']['national_code'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="national_code"
                                       pattern="^[0-9]{10,}$"
                                       maxlength="10"
                                       data-error="لطفا کد ملی را وارد نمایید"
                                       tabindex="4" required>
                            </div>
                        </div>
                    </div>

                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-trophy" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="مرجع تایید جواز" data-content="لطفا مرجع تایید جواز خود را مشخص نمایید"></i>
                                <label for="exporter_refrence">مرجع تایید جواز</label>
                                <input name="exporter_refrence" type="text" value="<?= $list['data']['exporter_refrence'] ?>" class="form-control" id="exporter_refrence" data-error="لطفا مرجع تایید جواز خود را وارد نمایید" tabindex="5" required>
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block textarea">
                                <i class="fa fa-trophy" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="زمینه فعالیت" data-content="لطفا زمینه فعالیت خود را مشخص نمایید"></i>
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description" type="text" class="form-control fullWidth displayBlock noRadius noPadding transition" id="description" data-minlength="2" required data-error="لطفا زمینه فعالیت را وارد نمایید" tabindex="6"><?= $list['data']['description'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace"></div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <label for="expiration_date">تاریخ انقضا جواز</label>
                                <input name="expiration_date" value="<?= $list['data']['expiration_date'] ? convertDate($list['data']['expiration_date']) : '' ?>" type="text" class="form-control datePicker" id="expiration_date" required data-error="لطفا نام تجاری خود را وارد کنید">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <label for="issuence_date">تاریخ صدور جواز</label>
                                <input name="issuence_date" value="<?= $list['data']['issuence_date'] ? convertDate($list['data']['issuence_date']) : '' ?>" type="text" class="form-control datePicker" id="issuence_date" required data-error="لطفا نام تجاری خود را وارد کنید">
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 center-block">
                            <div class="reg-alert-r text-center"><span class="requiredIcon text-danger">*</span> تصویر مجوز خود را انتخاب نمایید</div>
                            <div class="row xxxsmallSpace"></div>
                            <div class="docs-buttons modal-body">
                                <div class="img-container upload-msg register-crop">
                                    <img class="width image-crop img-cropper" src="<?php echo(isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                                </div>

                                <!-- separator -->
                                <div class="row xxxsmallSpace"></div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="btn-block mt">
                                            <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>  بارگذاری تصویر مجوز
                                            </label>
                                            <input class="result-crop" type="hidden" name="imageCropped" value="">
                                        </div>
                                    </div>
                                </div>
                                <!-- Show the cropped image in modal -->
                                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
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
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <input name="company_id" type="hidden" value="<?= $list['data']['company_id'] ?>">
                    <button name="step_4" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="5">
                    <input  name="company_type" type="hidden" value="1">
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate"
                      data-toggle="validator">
                    <input name="step" type="hidden" value="3">
                    <input name="company_type" type="hidden" value="1">
                    <button name="step2" type="submit" class="btn btn-danger btn-sm reg-btn-p">مرحله قبل<span class="fa fa-angle-right"></span></button>
                </form>
            </div>
        </div>
    </div>
    <!-- /end of boxContainer -->
    <!-- validator plugin js -->
</section>
<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script>
 $(function () {
     $('.reg-btn-n').on('click', function () {
         $('.image_name').val($('#img').attr('src'));
     });

     if ($('p.error').text().length != 0) {
         $.iziToastError($('p.error').text(), '.content .izi-container');
     }
 });
</script>


