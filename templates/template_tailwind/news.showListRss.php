<div class="boxContainer">
    <?php include_once("breadcrumb.php"); ?>
    <!-- separator -->
    <div class="fullWidth noPadding">
        <div class="content ltr">
            <?php if (isset($msg) && strlen($msg)) { ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <?php echo $msg; ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <?php if (isset($list) && count($list['list'])) {
                    foreach ($list['list'] as $id => $fields) {
                        $url = $fields['link']; ?>
                        <div class="col-xs-6 col-sm-6 col-md-6 pull-right boxA">
                            <a class="single" href="<?php echo $url; ?>">
                                <div class="news whiteBg boxBorder roundCorner fullWidth">
                                    <header class="text-right">
                                        <?php echo(strlen($fields['title']) ? $fields['title'] : "-"); ?>
                                    </header>
                                    <div class="item text-center pull-right">
                                        <div class="logoContainer pull-right">
                                            <img class="roundCorner fullWidth" src="<?php echo $fields['image'] ?>">
                                        </div>
                                        <div class="content pull-right">
                                            <footer class="fullWidth">
                                                <article class="fullWidth text-right text-justify">
                                                    <?php echo(strlen($fields['description']) ? $fields['description'] : "-"); ?>
                                                </article>
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 boxA">
                        <div class="article whiteBg boxBorder roundCorner">
                            <div class="row xsmallSpace"></div>
                            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                            <p class="empty-text">اطلاعاتی موجود نیست!</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /end of boxContainer -->
