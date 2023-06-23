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
                    <a class="container-address">
                        <span>ویکی</span></a>
                    <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                    <a class="container-destination"><span>مرحله : 1</span></a>
                </div>
            </div>
        </div>
        <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer">
            <header>
                <div class="center-block">ویکی مجموعه</div>
                <span class="title-badge">مرحله</span>
                <a class="container-badge" href="#"><div class="badge">1 از 4</div></a>
            </header>
            <div class="content">
                <div class="izi-container"></div>
                <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                    <div class="row xxsmallSpace"></div>
                    <p>
                        <strong>توجه: </strong>
                        کاربر گرامی، ویکی به معنی اطلاعات غیر تأیید شده و قابل تغییر می باشد. در صورتی که اطلاعات مندرج این مجموعه ناقص و یا اینکه این اطلاعات متعلق به مجموعه شما می باشد، سایت تولیدات امکانی را برای شما به ارمغان آورده است که بتوانید به طور خیلی ساده هویت مجموعه خود را در تولیدات تصحیح و یا تأیید نمایید. با توجه به اینکه اپراتور های تولیدات پس از ثبت اطلاعات درخواستی شما، به آن رسیدگی می نمایند، لذا می بایست نام و نام خانوادگی و شماره تلفن خود را به طور صحیح وارد نمایید تا در اسرع وقت به درخواست شما رسیدگی نماییم
                        <br>
                        در صورت موافقت با شرایط مذکور، گزینه زیر را فعال نمایید.
                    </p>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input <?= $list['approvePrivacy'] == 'on' ? 'checked' : '' ?> name="approvePrivacy" id="approvePrivacy" type="checkbox">شرایط را قبول دارم
                                </label>
                            </div>
                        </div>
                    </div>

                    <button name="step_2" type="submit" class="btn btn-success btn-sm reg-btn-n">مرحله بعد<span class="fa fa-angle-left"></span></button>
                    <input name="step" type="hidden" value="2">
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
    });
</script>
