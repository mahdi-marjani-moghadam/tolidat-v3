<!-- breadcrumb -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
        <?php include_once("breadcrumb.php"); ?>
    </div>
</div><!--end breadcrumb -->
<!-- separator -->
<div class="row xxxsmallSpace"></div>
<!-- boxContainer -->
<?php  dd($export['list']['description']);?>
<div class="boxContainer whiteBg boxBorder roundCorner container noPadding">
    <div class="detailNews">
        <header title="<?= $list['list']['Article_id']?>"
            data-articleID="<?php echo(strlen($list['list']['Article_id']) ? $list['list']['Article_id'] : '-'); ?>">
            <?php echo(strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>
        </header>
        <div class="row">
            <div class="content fullWidth">
                <div class="col-xs-12  col-sm-12 col-md-4 text-center">
                    <?php
                    $file = ROOT_DIR . ltrim($list['list']['image'], '/');
                    ?>
                    <img class="roundCorner" src="<?php echo(strlen($list['list']['image']) ? STATIC_RELA_DIR . '/images/article/' . $list['list']['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="<?php echo(strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>">
                </div>
                <div class="col-xs-12  col-sm-12 col-md-8">
                    <?php /*<article class="text-right text-justify">
                        <?php echo(strlen($list['list']['brif_description']) ? $list['list']['brif_description'] : '-'); ?>
                    </article> */?>
                    <div class="xsmallSpace"></div>
                    <article class=" text-justify">
                        <?php echo(strlen($list['list']['description']) ? nl2br($list['list']['description']) : '-'); ?>
                    </article>
                    <!-- separator -->
                    <div class="xsmallSpace"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                    <div class="panel-footer">
                        <div class="calender rtl pull-left">
                            <i class="fa fa-calendar"></i>
                            <?php echo(strlen($list['list']['date']) ? convertDate($list['list']['date']) : '-'); ?>
                        </div>
                        <?php
                        if (strlen($list['list']['meta_keyword'])) {
                            ?><a><span class="badge tag"># <?php echo(strlen($list['list']['meta_keyword']) ? $list['list']['meta_keyword'] : '-'); ?></span></a><?php
                        }
                       /* if (strlen($list['list']['meta_description'])) {
                            */?><!--
                               <?php /*echo(strlen($list['list']['meta_description']) ? $list['list']['meta_description'] : '-'); */?>
                            --><?php
/*                        }*/
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
