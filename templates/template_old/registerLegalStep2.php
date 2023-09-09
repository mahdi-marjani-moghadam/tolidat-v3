<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<section class="container noPadding">
    <!-- boxContainer -->

    <div class="boxContainer reg-container">
        <!-- separator -->
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
                    <a class="container-destination"><span>مرحله : 1</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="center-block">اطلاعات درخواستی را با دقت وارد نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">1 از 6</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نام نماینده" data-content="نماینده فردی است که پیگیری امور عضویت در سایت را انجام می دهد."></i>
                                <label for="name" >نام نماینده</label>
                                <input name="name" type="text" value="<?php echo $list['data']['name'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin" id="name" maxlength="50" data-minlength="1" data-error="لطفا نام نماینده را وارد نمایید" tabindex="1" autofocus required>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="نام خانوادگی نماینده" data-content="لطفا نام خانوادگی نماینده را وارد نمایید"></i>
                                <label for="family" >نام خانوادگی نماینده</label>
                                <input name="family" type="text" value="<?php echo $list['data']['family'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin" id="family" maxlength="50" data-minlength="1" data-error="لطفا نام خانوادگی را وارد نمایید" tabindex="2" required>
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="شماره تلفن همراه" data-content="لطفا شماره موبایل صحیح جهت دریافت کد فعال سازی وارد کنید."></i>
                                <label for="phone" >شماره تلفن همراه نماینده</label>
                                <input name="phone"
                                       type="text"
                                       value="<?= $list['data']['phone'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="phone"
                                       pattern="^[0-9۰-۹]{11,}$"
                                       maxlength="11"
                                       data-error="لطفا شماره موبایل صحیح جهت دریافت کد فعال سازی وارد کنید." tabindex="3" required>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="شناسه ملی شرکت" data-content="شناسه ملی مربوط به شرکت و یک کد 11 رقمی می باشد"></i>
                                <label for="national_id" >شناسه ملی شرکت</label>
                                <input name="national_id"
                                       type="text"
                                       value="<?php echo $list['data']['national_id'] ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="national_id"
                                       pattern="^[0-9۰-۹]{11,}$"
                                       required
                                       maxlength="11"
                                       data-error="لطفا شناسه ملی را وارد نمایید" tabindex="4">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="col-xs-12  col-sm-12 col-md-12">
                        <?php if (strlen($error['companyRecorded']['0'])) { ?>
                            <div class="errorHandler alert alert-danger" style="color: red ;"><?php echo $error['companyRecorded']['0'] ?></div>
                        <?php } ?>
                    </div>
                    <div class="row xsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12">
                            <div class="reg-alert">جهت دریافت کد فعالسازی، یکی از روش های زیر را انتخاب نموده و دکمه مرحله بعد را بزنید یا "به مرحله بعدی بروید"</div>
                        </div>
                    </div>
                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                    <div class="row center-block" style="max-width: 400px;">
                        
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner center-block">
                                <a class="roundCorner sms" data-type="1">
                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i>
                                    <span>پیامک</span>
                                </a>
                            </div>
                        </div>    
                    
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner center-block">
                                <a class="roundCorner call" data-type="0">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                                    <span>تماس صوتی</span>
                                </a>
                            </div>
                        </div>
                        
                        <input type="hidden" name="methodType" value="<?php echo(unserialize($_SESSION['step'])->data[2]['methodType']) ?>" class="methodType" aria-label="">
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <button name="step_2" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="3">
                    <input name="company_type" type="hidden" value="1">
                </form>

                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <input name="step" type="hidden" value="1">
                    <input name="company_type" type="hidden" value="1">
                    <button name="step_2" type="submit" id="step2" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                </form>
            </div>
        </div>
    </div>
</section>

<p class="error"><?php echo $list['validate']['msg'] ?></p>

<script>
    $(function () {
        $('.reg-radio a').on('click', function (e) {
            e.preventDefault();
            $('.methodType').val($(this).attr('data-type'));
            $('.reg-radio a').removeClass('reg-active');
            $(this).addClass('reg-active');
        });

        var x = $('.methodType').val();
        $('.reg-radio a').removeClass('reg-active');
        $('.reg-container').find('.reg-radio:eq(' + x + ') a').addClass('reg-active');

        $('.reg-container input:nth-child(1)').focus();

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        if ($('.call').hasClass('reg-active')) {
            $("input[name='methodType']").val('0');
        } else {
            $("input[name='methodType']").val('1');
        }

        $('.call').on('click', function () {
            $("input[name='methodType']").val('0');
        });

        $('.sms').on('click', function () {
            $("input[name='methodType']").val('1');
        });

    });
</script>
