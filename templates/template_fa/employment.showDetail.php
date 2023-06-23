
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick-theme.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/slick.min.js"></script>
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCAMmGmVr-Gh7hJ9obZCR8nll2U2eaiaGA&libraries=places'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/locationpicker.jquery.js"></script>
<?php include_once("breadcrumb.php"); ?>
<div class="row fullPadding detail-employment">
    <div class="boxContainer">
        <?php include_once 'companyDetail_top.php'; ?>
        <?php //print_r_debug($list) ?>
        <div class="col-xs-9 col-sm-9 col-md-9 pull-left mb-double3">
            <!------------------------- فرصت های شغلی   ------------------------------>
            <div class="text-header searchBox1  whiteBg boxBorder roundCorner fullWidth  mb-double ">
                <header title="<?= $list['advertise']['title'] ?>">
                    <?= $list['advertise']['title'] ?>
                </header>
                <div class="content rtl whiteBg boxBorder">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <h6 title="<?= $list['employment']['skill'] ?>">
                                <?= $list['employment']['skill'] ?>
                            </h6></div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <div class="titr">
                                <b class="title"><span class="icon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                                    <span>حداقل حقوق:</span></b> <span><?= $list['employment']['minSallary'] ?></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <div class="titr">
                                <b class="title"><span class="icon"><i class="fa fa-usd" aria-hidden="true"> </i></span>
                                    <span>حداکثر حقوق:</span></b> <span><?= $list['employment']['maxSallary'] ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <div class="titr">
                                <b class="title"><span class="icon"> <i class="fa fa-university" aria-hidden="true"></i></span></b>
                                <span> تحصیلات:</span> <span><?= $list['employment']['name'] ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <div class="titr">
                                <b class="title"><span class="icon"><i class="fa fa-mobile" aria-hidden="true"></i></span></b>
                                <span><?= $list['employment']['contactPhone'] ?></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <b class="title"> <span class="icon"> <i class="fa fa-cogs" aria-hidden="true"></i></span>
                            </b><span>مهارت ها:</span> <span class="skill"><?= $list['employment']['skill'] ?></span>
                        </div>
                        <div class="col-xs-6 col-sm-12 col-md-3 pull-right mb-double">
                            <b class="title"><span class="icon"> <i class="fa fa-briefcase" aria-hidden="true"></i>  </span>
                                <span>سابقه کاری:</span> </b>
                            <span><?= $list['employment']['history'] . " سال " ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <b class="title">توضیحات:</b>
                            <span class="detail"><?= $list['employment']['description'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'companyDetail_bottom.php'; ?>

