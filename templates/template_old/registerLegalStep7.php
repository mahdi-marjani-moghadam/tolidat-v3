<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<section class="container noPadding">
    <!-- boxContainer -->
    <div class="boxContainer reg-container">
        <!-- separator -->
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>مرحله : 6</span></a>
        </div>        <div class="registerPage registerPage-lg container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="">اطلاعات درخواستی را با دقت وارد نمایید</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">6 از 6</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>

                <div class="row xsmallSpace hidden-xs"></div>

                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <!-- separator -->
                    <div class="row xxsmallSpace"></div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="reg-alert">اطلاعات مربوط به نماینده رابط بین شما و تولیدات</div>
                        </div>
                    </div>
                    <div class="row xxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-registered" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="نام نماینده پیگیر امور را وارد نمایید" data-original-title="نام نماینده"></i>
                                <label for="name" >نام نماینده</label>
                                <input required name="name" type="text" value="<?php echo ($list['data']['name'] ? $list['data']['name'] : unserialize($_SESSION['step'])->data['2']['name']) ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="name" data-minlength="3" data-error="لطفا نام نماینده را وارد نمایید" tabindex="1" autofocus>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="لطفا نام خانوادگی نماینده را وارد نمایید" data-original-title="نام خانوادگی"></i>
                                <label for="family" >نام خانوادگی نماینده</label>
                                <input required name="family" type="text" value="<?php echo ($list['data']['family'] ? $list['data']['family'] : unserialize($_SESSION['step'])->data['2']['family']) ?>" class="form-control fullWidth displayBlock noRadius noPadding transition" id="family" data-minlength="1" data-error="لطفا نام خانوادگی نماینده را وارد نمایید" tabindex="2">
                            </div>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="شماره موبایل نماینده را وارد نمایید" data-original-title="شماره موبایل"></i>
                                <label for="mobile">شماره موبایل</label>
                                <input required name="mobile"
                                       type="text"
                                       value="<?php echo ($list['data']['mobile'] ? $list['data']['mobile'] : unserialize($_SESSION['step'])->data['2']['phone']) ?>"
                                       class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin"
                                       id="mobile"
                                       pattern="^[0-9]{11,}$"
                                       maxlength="11"
                                       data-minlength="2"
                                       data-error="لطفا شماره موبایل را وارد نمایید" tabindex="3">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="یک ایمیل معتبر جهت ارسال و دریافت اطلاعات لازم درج نمایید مانند: info@dabacenter.ir" data-original-title="ایمیل"></i>
                                <label for="email">ایمیل</label>
                                <input required name="email" type="email" value="<?= $list['data']['email'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin ltr" id="email" data-minlength="3" data-error="لطفا ایمیل را وارد نمایید"  tabindex="4">
                            </div>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="نام کاربری مورد نظر خود را فقط با حروف لاتین وارد نمایید" data-original-title="نام کاربری"></i>
                                <label for="username">نام کاربری</label>
                                <input required name="username" type="text" value="<?= $list['data']['username'] ?>" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin ltr" id="username" data-minlength="2" data-error="لطفا نام کاربری را وارد نمایید" tabindex="4">
                            </div>
                        </div>
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="لطفا رمز عبور خود را مجددا وارد نمایید" data-original-title="تکرار رمز عبور"></i>
                                <label for="retype_password">تکرار رمز عبور</label>
                                <input required name="retype_password" type="password" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin ltr" id="retype_password" data-minlength="8" data-error="لطفا رمز عبور خود را مجددا وارد نمایید" tabindex="6">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group has-feedback center-block">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <i class="fa fa-question" aria-hidden="true" data-placement="top" data-trigger="hover" data-toggle="popover" title="" data-content="رمز عبور مورد نظر خود را وارد نمایید" data-original-title="رمز عبور"></i>
                                <label for="password">رمز عبور</label>
                                <input required name="password" type="password" class="form-control fullWidth displayBlock noRadius noPadding transition set-font-latin ltr" id="password" data-minlength="8" data-error="رمز عبور شما باید حداقل شامل 8 کاراکتر باشد" tabindex="5">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row xsmallSpace"></div>
                            <button name="finish" type="submit" class="btn btn-success btn-sm reg-btn-n">ثبت نهایی<span class="fa fa-angle-left"></span></button>
                            <input name="step" type="hidden" value="8">
                            <input  name="company_type" type="hidden" value="1">
                        </div>
                    </div>
                </form>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <input name="step" type="hidden" value="6">
                    <input name="company_type" type="hidden" value="1">
                    <button name="step2" type="submit" class="btn btn-danger btn-sm reg-btn-p">مرحله قبل<span class="fa fa-angle-right"></span></button>
                </form>
            </div>
        </div>
    </div>
</section>
<p class="error"><?php echo $list['validate']['msg'] ?></p>
<script>
    $(function () {
        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        $('#form1').on('submit', function() {
            $(this).prop('disabled', true);
        });

        if(window.localStorage.getItem('packageType') !== null) {
            window.localStorage.removeItem('packageType');
        }
    });
</script>
