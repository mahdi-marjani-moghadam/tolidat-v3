<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<section class="container noPadding mainContainer mainContainer-forgtForm">
    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="Breadcrumb">
                <a class="home-icon" href="<?php echo RELA_DIR ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                    <span>بازیابی گذرواژه</span></a>
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
               <!-- <a class="container-destination"><span>مرحله : 1</span></a>-->
            </div>
        </div>
    </div>
    <div class="boxContainer main-login-container forgot-email boxBorder">

        <header>
            <div class="center-block text-right">
بازیابی گذر واژه
            </div>
        </header>
        <div class="content">

            <div class="izi-container"></div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>

            <p class="text-center"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> لطفا نام کاربری را برای بازیابی گذرواژه خود وارد نمایید.</p>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3 login-container login-border registerPage container-floatinglabel ">
                    <div class="login-edit mt">
                        <?php if ($msg['error'] == 1) { ?>
                            <div class="msgError"><?php echo $msg['msg']; ?></div>
                        <?php } ?>
                        <?php if (!empty($msg) & $msg['error'] == 0) { ?>
                            <div class="msgSuccess"><?php echo $msg['msg']; ?></div>
                        <?php } ?>
                        <form action="/login/sendEmail" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                            <div class="form-group has-feedback center-block">
                                <label for="name" >نام کاربری</label>
                                <input value="<?php echo $list['username'] ?>" name="username" id="username" type="text" class=" form-control center-block noPadding" required data-error="نام کاربری را وارد نمایید"  autofocus>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <button type="submit" class="successClick reg-active btn btn-default btn-success text-center text-ultralight text-white center-block mt1 roundCorner disabled"> ثبت</button>
                        </form>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row smallSpace"></div>
<div class="row smallSpace"></div>

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/js/iziToast.min.js"></script>

<script>
    $(function () {
       if ($('.msgSuccess').text().length) {
           $.iziToastSuccess($('.msgSuccess').text(), '.izi-container');
       }
       if ($('.msgError').text().length) {
           $.iziToastError($('.msgError').text(), '.izi-container');
       }
    });
</script>
