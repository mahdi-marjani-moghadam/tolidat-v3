<!-- boxContainer -->
<div class="boxContainer">
    <!-- breadcrumb -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>
    <!-- /end of breadcrumb -->
    <div class="fullWidth noPadding">
        <div class="content ltr">
            <?php
            if(isset($msg) && strlen($msg))
            {
            ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php echo $msg; ?>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="row">
            <?php
                if(isset($list) && count($list['list']))
                {
                    foreach($list['list'] as $id => $fields)
                    {
                        $url = RELA_DIR . "news/" . $fields['News_id'] . "/" . urlencode(str_replace(' ','-',$fields['title']));
                    ?>
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 pull-right boxA">
                            <div class="news whiteBg boxBorder roundCorner fullWidth">
                                <div class="item text-center" data-newsID="<?=$fields['News_id'];?>">
                                    <div class="logoContainer pull-right">
                                        <a class="img-link" href="<?=$url;?>">
                                            <?php
                                                $file = ROOT_DIR.ltrim($fields['image'], '/');
                                            ?>
                                            <img class="roundCorner fullWidth" src="<?php echo (strlen($fields['image'])  ? $fields['image'] : '/templates/'.CURRENT_SKIN.'/assets/images/placeholder.png'); ?>" alt="<?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?>">
                                        </a>
                                    </div>

                                    <div class="content pull-right">
                                        <h2 class="text-right fullWidth" title="<?= $fields['title']?>">
                                            <a href="<?=$url;?>" class="displayBlock fullWidth">
                                                <?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?>
                                            </a>
                                        </h2>

                                        <footer class="fullWidth">
                                            <article class="fullWidth text-right text-justify">
                                                <?php echo (strlen($fields['brif_description']) ? $fields['brif_description'] : "-"); ?>
                                            </article>
                                            <div class="calender pull-right rtl">
                                                <i class="fa fa-calendar"></i>
                                                <?php echo (strlen($fields['date']) ? $fields['date'] : "-"); ?>
                                            </div>
                                        </footer>
                                    </div>
                                </div>
                                <a href="<?=$url;?>" class="btn button-default">نمایش</a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 mt">
                        <nav class="pull-right">
                            <ul class="pagination">
                                <li>
                                    <a class="transition">
                                        موارد یافت شده: <span class="text-ultralight text-danger"><?php echo $list['recordsCount']; ?></span>
                                    </a>
                                </li>
                                <?php
                                foreach ($list['pagination'] as $key => $href)
                                {
                                    ?>
                                    <li>
                                        <a class="transition" href="<?=RELA_DIR . $href?>"><?=$key + 1?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                    <?php
                }
                else
                {
                    ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 boxA">
                        <div class="article whiteBg boxBorder roundCorner">
                            <div class="alert alert-warning text-center alertMaxWidth center-block mt" role="alert">هیچ اطلاعاتی موجود نیست</div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /end of boxContainer -->


