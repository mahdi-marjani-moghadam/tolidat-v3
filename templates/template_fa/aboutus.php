<div class="boxContainer">
    <!-- breadcrumb -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>

    <!-- boxContainer -->
    <div class="aboutUs whiteBg boxBorder roundCorner clear fullWidth center-block">
        <?php if(isset($msg) && strlen($msg)) { ?>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <?php echo $msg; ?>
                </div>
            </div>
            <?php } ?>
        <!-- separator -->
        <div class="row xxsmallSpace"></div>
        <?php $key = key($list['list']); ?>
        <div class="row fullWidth center-block">
            <div class="col-xs-12 col-sm-12 col-md-6 boxImg mb pull-right">
                <img class="center-block" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/aboutUs_imac.jpg" alt="درباره تولیدات">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 box text-right mb pull-left">
                <h5 title="<?php echo $list['list'][$key]['head1']?>"><?php echo (strlen($list['list'][$key]['head1']) ? $list['list'][$key]['head1'] : ""); ?></h5>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text1']) ? nl2br($list['list'][$key]['text1']) : ""); ?></p>
            </div>
        </div>
        <!-- separator -->
        <div class="row xxsmallSpace"></div>

        <div class="row fullWidth center-block">
            <div class="col-xs-12 col-sm-12 col-md-6 box  pull-right">
                <h5 title="<?php echo $list['list'][$key]['head2']?>"><?php echo (strlen($list['list'][$key]['head2']) ? $list['list'][$key]['head2'] : ""); ?></h5>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text2']) ? nl2br($list['list'][$key]['text2']) : ""); ?></p>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 box box3 pull-left">
                <div class="row width center-block">
                    <div class="col-xs-12 col-sm-12 col-md-12 mb">
                        <div class="circle margin roundCornerFull center-block">
                            <span data-graphNum="<?php echo (strlen($list['list'][$key]['graph1']) ? $list['list'][$key]['graph1'] : ''); ?>">
                                <img class="center-block text-center roundCornerFull"  src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/aboutUs_img1.png" alt="درباره تولیدات">
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 mb">
                        <div class="circle pull-left color1 roundCornerFull center-block">
                            <span data-graphNum="<?php echo (strlen($list['list'][$key]['graph2']) ? $list['list'][$key]['graph2'] : ''); ?>">
                                <img class="center-block text-center roundCornerFull" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/aboutUs_img2.png" alt="درباره تولیدات">
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="circle pull-right color roundCornerFull center-block">
                            <span data-graphNum="<?php echo (strlen($list['list'][$key]['graph3']) ? $list['list'][$key]['graph3'] : ''); ?>">
                                <img class="center-block text-center roundCornerFull" src="<?php echo RELA_DIR.'templates/'.CURRENT_SKIN; ?>/assets/images/aboutUs_img3.png" alt="درباره تولیدات">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fullWidth center-block">
            <div class="col-xs-12 col-sm-12 col-md-12 box mb">
                <h5 title="<?php echo $list['list'][$key]['head3'] ?>"><?php echo (strlen($list['list'][$key]['head3']) ? $list['list'][$key]['head3'] : ""); ?></h5>
                <p class="text-justify"><?php echo (strlen($list['list'][$key]['text3']) ? nl2br($list['list'][$key]['text3']) : ""); ?></p>
            </div>
        </div>
        <!-- /end of boxContainer -->
    </div>
</div>
