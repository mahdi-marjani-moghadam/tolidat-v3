<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<?php $stepFrom = unserialize($_SESSION['step']); ?>

<div class="container-login shadow-normal center-block registerPage container-floatinglabel">
    <div class="col-xs-12 col-sm-4 col-md-4 container-logo-validator pull-right">
        <div class="container-login-validator center-block">
            <!-- login -->
            <div class="container-logo">
                <img class="center-block" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/tolidat-logo.png" alt="لوگوی سایت تولیدات">
                <span>ثبت نام در مرجع کسب و کار تولیدات</span>
                <div class="row xxxsmallSpace"></div>
            </div>
            <!-- Separator -->
            <div class="row xsmallSpace"></div>
            <div class="container-logo-input container-Legal">
                <form class="text-center" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                    <div class="izi-container"></div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                    <div class="form-group has-feedback center-block noPadding">
                        <label for="company_type">نوع شخصیت را انتخاب نمایید</label>
                        <select name="company_type" id="company_type" class="form-control" required>
                            <option value="1" <?php if ($stepFrom->data['1']['company_type'] == 1) {echo "selected";} ?>>حقوقی</option>
                            <option value="2" <?php if ($stepFrom->data['1']['company_type'] == 2) {echo "selected";} ?>> حقیقی</option>
                        </select>
                        <i class="fa fa-angle-down transition"></i>
                        <div class="legal mt text-justify" data-value="1"><span class="text-danger">نکته: </span><span>شخص حقوقی به شخصی گفته می شود که دارای سازمانی دارای شماره ثبت و شناسه ملی می باشد.</span></div>
                        <div class="legal hidden mt text-justify" data-value="2"><span class="text-danger">نکته: </span><span>شخص حقیقی به شخصی گفته می شود که دارای هر یک از انواع جواز، پروانه کسب یا بهره برداری، برگه رسمی نمایندگی، کارت بازرگانی، کارت عضویت نظام مهندسی و ... می باشد</span></div>
                    </div>

                    <button name="step_1" type="submit" class="btn btn-success btn-sm register-button reg-btn-n">شروع<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="2">
                </form>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 container-login-img pull-right">
        <div class="container-account center-block">
            <span class="msg-account">از این قسمت وارد شوید!</span>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>

            <div class="form-group">
                <a class="btn btn-default btn-block btn-account" href="<?php echo RELA_DIR . "login" ?>">ورود</a>
            </div>
        </div>
    </div>
</div>
<div class="row xxxsmallSpace"></div>

<p class="error"><?php echo $list['validate']['msg'] ?></p>
<script>
    $(function () {
        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.izi-container');
        }
    });
</script>
