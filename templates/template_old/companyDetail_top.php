<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick-theme.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/jquery.mmenu.all.css"/>
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/bower_components/izitoast/dist/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/slick.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.qrcode.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.stickit.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.mmenu.all.min.js"></script>
<style>
    .popoverContainer span {
        width: 100%;
        text-align: center;
        display: block;
        font-family: 'Samim', tahoma, sans-serif !important;
    }
    .popoverContainer span i{
        font-size: 50px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .popover-content {
        padding: 0;
        width: 230px;
        height: auto;
        font-family: 'Samim', tahoma, sans-serif !important;
    }

    .popover-title {
        text-align: center;
    }

    .popoverContainer h3 {
        background-color: #5cb85c;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }
    .popoverContainer h4 {
        background-color: #68b5e2;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }
    .popoverContainer h5 {
        background-color: #ddd ;
        color: #fff;
        text-align: center;
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        border-bottom: 1px solid #ebebeb;
        border-radius: 5px 5px 0 0;
    }

    .popover{
        padding: 0;
    }
    .popoverContainer .fa-exclamation-circle {
        color: #68b5e2;
    }
    .popoverContainer .fa-cubes {
        color: #5cb85c;
    }
    .popoverContainer .fa-trophy {
        color: #ddd;
    }

</style>

<!-- boxContainer -->
<div class="row fullPadding">
    <div class="col-xs-12 col-sm-12 col-md-12 noPadding container-company-showDetail">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once 'breadcrumb.php'; ?>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 detail-company1 noPadding">
            <div class="row noMargin">
                <!---------------------- تاریخ آخرین بروزرسانی ---------------------->
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="contBaner mb">

                        <div class="imgContentProduct roundCorner boxBorder" style="background:url('<?php echo $list['side']['banner_list']; ?>') no-repeat center / cover">

                            <p class="date">
                                <span><i class="fa fa-calendar" aria-hidden="true"></i> </span> تاریخ آخرین به روز رسانی:
                                <span><?php echo($list['side']['list']['refresh_date'] == '0000-00-00 00:00:00' ? '00-00-0000' : convertDate($list['side']['list']['refresh_date'])); ?></span>
                            </p>
                            <a class="logoNew roundCorner">
                                <img alt="<?= " لوگوی " . $list['side']['list']['company_name'] ?>" title="<?= $list['side']['list']['company_name'] ?>" id="img" name="image" class="boxBorder roundCorner" src="<?php echo(isset($list['side']['logo_list']['0']['image']) ? COMPANY_ADDRESS . $list['side']['list']['Company_id'] . '/logo/150.150.' . $list['side']['logo_list']['0']['image'] : DEFULT_LOGO_ADDRESS) ?>">
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxsmallSpace"></div>

            <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                <?php include_once 'companyDetail_menu.php';?>
            </div>

            <!-- separator -->
            <div class="row xxsmallSpace"></div>

            <div class="row noMargin">
                <!---------------------- ساید بار ---------------------->
                <div class="col-xs-12 col-sm-4 col-md-3 pull-right side-bar1">
                    <?php include_once 'companyDetail_sidebar.php'; ?>
                </div>