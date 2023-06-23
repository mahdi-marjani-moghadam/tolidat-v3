<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/slider-pro/dist/css/slider-pro.min.css">
<section class="container noPadding mainContainer">
    <div class="container boxContainer main-login-container">
        <div class="row xsmallSpace">
            <div class="col-xs-12 col-sm-4 col-md-4 login-container login-border pull-right">
                <div class="login-edit">
                    <p class="msgError"><?php echo $list['msg']; ?></p>
                    <form action="/login/newPassword" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <div class="form-group errorHandler-login errorHandler eror has-feedback mt">
                            <input name="password" id="password" lang="fa" type="password" class=" form-control center-block noPadding" required data-error="رمز عبور جدید را وارد نمایید" placeholder="رمز عبور" autofocus">
                        </div>
                        <div class="form-group errorHandler-login errorHandler eror has-feedback mt">
                            <input name="re_password" id="confirm-password" lang="fa" type="password" class=" form-control center-block noPadding" required data-error="رمز عبور را دوباره وارد نمایید" placeholder="تکرار رمز عبور" autofocus">
                        </div>
                        <input name="company_id" type="hidden" value="<?php echo $list['company_id']; ?>">
                        <input name="token" type="hidden" value="<?php echo $list['token']; ?>">
                        <button type="submit" class="btn btn-default btn-success text-center text-ultralight text-white  center-block mt1 roundCorner disabled">                            تایید</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row smallSpace"></div>
<div class="row smallSpace"></div>

<script>
    $(function () {
        if ($('.msgSuccess').text().length) {
            $.iziToastSuccess($('.msgSuccess').text());
        }
        if ($('.msgError').text().length) {
            $.iziToastError($('.msgError').text());
        }
    });
</script>

