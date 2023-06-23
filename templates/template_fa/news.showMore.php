

<!-- boxContainer -->
<div class="boxContainer">
    <div class="row">
        <!-- breadcrumb -->
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding ">
            <?php include_once("breadcrumb.php"); ?>
        </div>
        <!-- /end of breadcrumb -->
    </div>

    <!-- separator -->
    <div class="row xxxsmallSpace"></div>

    <div class=" whiteBg boxBorder roundCorner container noPadding">
        <div class="detailNews">
            <h2 class="text-right text-ultralight text-bold fullWidth" data-newsID="<?php echo (strlen($list['list']['News_id']) ? $list['list']['News_id'] : '-'); ?>" title="<?= $list['list']['News_id']?>">
                <?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>
            </h2>
            <div class="row">
                <div class="content fullWidth">
                    <div class="col-xs-12  col-sm-12 col-md-4 col-lg-4 text-center">
                        <?php $file = ROOT_DIR.ltrim($list['list']['image'], '/'); ?>
                        <img class="roundCorner" src="<?php echo (strlen($list['list']['image'])  > 0 ? RELA_DIR . "/templates/images/company/" . $list['list']['company_id'] . "/news/" . $list['list']['image'] :  RELA_DIR . '/templates/'.CURRENT_SKIN.'/assets/images/placeholder.png') ?>" alt="<?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>">
                    </div>
                    <div class="col-xs-12  col-sm-12 col-md-8">
                        <article class="text-right text-justify">
                            <?php echo (strlen($list['list']['brif_description']) ? $list['list']['brif_description'] : '-'); ?>
                        </article>
                        <div class="xsmallSpace"></div>
                        <article class="text-right text-justify">
                            <?php echo (strlen($list['list']['description']) ? $list['list']['description'] : '-'); ?>
                        </article>

                        <!-- separator -->
                        <div class="xsmallSpace"></div>

                        <div class="calender rtl pull-right">
                            <i class="fa fa-calendar"></i>
                            <?php echo (strlen($list['list']['date']) ? convertDate($list['list']['date']) : '-'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of boxContainer -->
