<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css">
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
                <header title="<?php echo  $list['advertise']['title'] ?>">
                    <?php echo  $list['advertise']['title'] ?>
                </header>
                <div class="content rtl whiteBg boxBorder">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <b class="title">توضیحات:</b>
                            <span class="detail"><?php echo  $list['advertise']['description'] ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <b class="title">تاریخ شروع:</b>
                            <span class="detail"><?php echo  convertDate($list['advertise']['startDate']) ?></span>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double">
                            <b class="title">تاریخ انقضا:</b>
                            <span class="detail"><?php echo  convertDate($list['advertise']['expireDate']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once 'companyDetail_bottom.php'; ?>

