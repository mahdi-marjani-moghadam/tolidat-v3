<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/select2.min.css">
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<div class="container-login shadow-normal center-block container-floatinglabel">
    <div class="col-xs-12 col-sm-4 col-md-4 container-logo-validator pull-right">
        <div class="container-login-validator center-block">
            <!-- login -->
            <div class="container-logo">
                <img class="center-block" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/tolidat-logo.png" alt="لوگوی سایت تولیدات">
            </div>
            <!-- Separator -->
            <div class="row xsmallSpace"></div>
            <div class="container-logo-input">
                <form action="login" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="form-group">
                        <i class="fa fa-user icon" aria-hidden="true"></i>
                        <input name="username" type="text" class="form-control" placeholder="" id="username" data-error="نام کاربری را وارد کنید" required autofocus>
                        <label class="validation" for="username">نام کاربری</label>
                    </div>

                    <!-- separator -->
                    <div class="row xxxsmallSpace"></div>
                    <div class="form-group">
                        <i class="fa fa-lock icon" aria-hidden="true"></i>
                        <input name="password" type="password" class="form-control" placeholder="" id="password" data-error="گذرواژه را وارد کنید" required >
                        <label class="validation" for="password">گذرواژه</label>
                    </div>
                    <div class="form-group">
                        <!-- separator -->
                        <div class="row xxxsmallSpace"></div>

                        <button type="submit" class="btn button-default btn-block btn-submit show-more">ورود به سیستم</button>
                    </div>
                    <input type="hidden" name="action" value="login">
                </form>
                <!-- select language -->
                <!--<div class="form-group">
                    <select class="select2" data-placeholder="انتخاب زیر ویژگی">
                        <option value="AL">زیر ویژگی 1</option>
                        <option value="WY">زیر ویژگی 2</option>
                    </select>
                </div>-->
                <!-- Separator -->
                <div class="row xxxsmallSpace"></div>
                <a class="link-forget" href="<?php echo RELA_DIR . "login/getUsername"?>">رمز خود را فراموش کرده اید؟</a>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-md-8 container-login-img pull-right">
        <div class="container-account center-block">
            <span class="msg-account">آیا ثبت نام کرده اید؟</span>
            <div class="row xxxsmallSpace"></div>
            <div class="form-group">
                <a type="submit" class="btn btn-default btn-block btn-account" href="<?php echo RELA_DIR . "register" ?>">ثبت نام</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(function (){
        $('footer').addClass('loginFooter');
    });
</script>
<script src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/js/select2.min.js"></script>
