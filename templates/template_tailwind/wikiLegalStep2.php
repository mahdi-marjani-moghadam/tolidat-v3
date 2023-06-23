<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

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
                    <a class="container-address">
                        <span>ویکی</span></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-destination"><span>مرحله : 2</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="center-block">ویکی مجموعه</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#">
                    <div class="badge">2 از 4</div>
                </a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="row xxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input value="<?php echo  $list['name'] ?>" required name="name" type="text" class="form-control" id="name" data-error="لطفا نام را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="family">نام خانوادگی</label>
                                <input value="<?php echo  $list['family'] ?>" required name="family" type="text" class="form-control" id="family" data-error="لطفا نام خانوادگی را وارد نمایید">
                            </div>
                        </div>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block no-float">
                            <div class="form-group">
                                <label for="phone">شماره تلفن</label>
                                <input value="<?php echo  $list['phone'] ?>" type="text" name="phone" id="phone" class="form-control set-font" pattern="^[0-9]{11,}$" maxlength="11" required data-error="لطفا تلفن را وارد نمایید">
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
                                <a class="roundCorner call" data-type="0">
                                    <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                                    <span>تماس صوتی</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 mb">
                            <div class="reg-radio roundCorner center-block">
                                <a class="roundCorner sms" data-type="1">
                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i>
                                    <span>پیامک</span>
                                </a>
                            </div>
                        </div>
                        <input type="hidden" name="methodType" value="<?php echo (unserialize($_SESSION['step'])->data[2]['methodType']) ?>" class="methodType" aria-label="">
                    </div>

                    <!-- separator -->
                    <div class="row xsmallSpace"></div>

                    <button name="step_2" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="3">
                </form>
                <form action="" method="post" name="form2" id="form2" role="form" novalidate="novalidate" data-toggle="validator">
                    <button name="step1" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                    <input name="step" type="hidden" value="1">
                </form>
            </div>
        </div>
    </div>
</section>

<p class="error"><?php echo $list['validate']['msg'] ?></p>

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
        $('.reg-radio a').on('click', function(e) {
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

        $('.call').on('click', function() {
            $("input[name='methodType']").val('0');
        });

        $('.sms').on('click', function() {
            $("input[name='methodType']").val('1');
        });

    });
</script>