<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

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
                    <a class="container-destination"><span>مرحله : 3</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">ویکی مجموعه</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#">
                    <div class="badge">3 از 4</div>
                </a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                    <!-- separator -->
                    <div class="row xsmallSpace hidden-xs"></div>

                    <div class="row xsmallSpace"></div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="reg-alert">کد فعالسازی دریافتی را در این قسمت وارد نمایید و به مرحله بعدی بروید</div>
                        </div>
                    </div>
                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="کد ارسال شده از طریق پیامک و یا تماس صوتی را وارد نمایید" data-original-title="کد فعالسازی"></i>
                                <label for="registration_number">کد فعالسازی</label>
                                <input name="token" type="text" value="<?php echo $list['token'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="registration_number" data-minlength="3" data-error="لطفا کد فعالسازی را وارد نمایید" tabindex="1" autofocus required>
                            </div>
                        </div>
                    </div>
                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12  col-sm-12 col-md-12 mb ">
                            <div class="reg-alert"><span class="text-danger">توجه:</span> در صورت عدم دریافت کد بر روی دکمه ارسال مجدد کلیک کنید،ارسال کد تا سه مرتبه امکان پذیر است</div>
                            <div class="row xxxsmallSpace"></div>
                            <button type="button" id="sendCodeAgain" class="btn btn-primary dropdown-toggle reg-btn-refresh center-block text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-refresh"></span><img style="display: none" id="loading" src="<?php echo RELA_DIR ?>templates/template_tailwind/assets/images/loading1.gif"> ارسال مجدد
                            </button>
                        </div>
                    </div>
                    <div class="row xsmallSpace"></div>
                    <div class="row xxsmallSpace nextLoading hidden-xs"></div>
                    <button name="step_3" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="4">
                </form>
                <form action="" method="post" name="form2" id="form2" role="form" novalidate="novalidate" data-toggle="validator">
                    <button name="step1" type="submit" id="step1" class="btn btn-danger btn-sm reg-btn-p"><span class="fa fa-angle-right"></span>مرحله قبل</button>
                    <input name="step" type="hidden" value="2">
                </form>
            </div>
        </div>
    </div>
    <!-- /end of boxContainer -->
    <!-- validator plugin js -->
</section>
<p class="error"><?php echo $msg; ?></p>
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
        $('#sendCodeAgain').click(function() {
            $.iziToastSuccess("تا لحظاتی دیگر کد دوباره برای شما ارسال می گردد", '.content .izi-container');
            $(this).attr('disabled', 'disabled').find('span.fa-refresh').hide();
            $(this).find('#loading').show();
            $.ajax({
                url: '/wiki/sendCodeAgain/',
                type: 'post',
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        $.iziToastSuccess(response.msg, '.content .izi-container');
                        $('#sendCodeAgain').removeAttr('disabled');
                        $('#sendCodeAgain').find('span.fa-refresh').show();
                        $('#sendCodeAgain').find('#loading').hide();
                    }
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.content .izi-container');
                        $('#sendCodeAgain').attr('disabled', 'disabled');
                        $('#sendCodeAgain').find('span.fa-refresh').show();
                        $('#sendCodeAgain').find('#loading').hide();
                    }
                }
            });
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

    });
</script>