<div class="boxContainer mt">

    <!-- breadcrumb -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding ">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>
    <!-- /end of breadcrumb -->

    <div class="fullWidth noPadding">
        <div class="content ltr">
            <?php if (isset($message)) { ?>
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo  $message ?></strong>
                </div>
            <?php } ?>
            <div class="row">
            <?php if (isset($events) && count($events)) {
                    foreach ($events as $event) {
                        $url = RELA_DIR . "event/" . $event['event_id'];
            ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 pull-right boxA">
                            <div class="news whiteBg boxBorder roundCorner fullWidth news-event">
                                <div class="item text-center" data-newsID="<?php echo  $event['event_id'] ?>">

                                    <div class="logoContainer pull-right">
                                        <a href="<?php echo  $url ?>" name="<?php echo  $url ?>" title="<?php echo  (strlen($event['title']) ? $event['title'] : "-") ?>">
                                            <?php $file = ROOT_DIR.ltrim($event['icon'], '/'); ?>
                                            <img class="roundCorner fullWidth" src="<?php echo  (strlen($event['icon'])  ? $event['icon'] : '/templates/'.CURRENT_SKIN.'/assets/images/placeholder.png') ?>" alt="<?php echo  (strlen($event['title']) ? $event['title'] : "-") ?>">
                                        </a>
                                    </div>

                                    <div class="content pull-right">

                                        <a href="<?php echo  $url ?>" class="displayBlock fullWidth">
                                            <div class="text-right fullWidth title-event" title="<?php echo  $event['title']?>">
                                                <span>
                                                <?php echo  (strlen($event['title']) ? $event['title'] : "-") ?>
                                                </span>
                                            </div>
                                        </a>

                                        <br>

                                        <footer class="fullWidth">
                                            <div class="fullWidth text-right text-justify article">
                                                <span>
                                                <?php echo  (strlen($event['brief_description']) ? $event['brief_description'] : "-") ?>
                                                </span>
                                            </div>

                                            <br>
                                            <br>
                                            <div class="calender pull-left rtl">
                                                <i class="fa fa-calendar"></i>
                                                <?php echo  (strlen($event['date']) ? $event['date'] : "-") ?>
                                            </div>

                                            <br>
                                        </footer>

                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php } else { ?>
                    <div class="col-xs-12 col-sm-12 col-md-12 boxA">
                        <div class="article whiteBg boxBorder roundCorner">
                            <div class="alert alert-warning text-center alertMaxWidth center-block mt" role="alert">هیچ اطلاعاتی موجود نیست</div>
                        </div>
                    </div>
                    <?php } ?>

                <div class="col-xs-12 col-sm-12 col-md-12 mt">
                    <nav class="pull-right">
                        <ul class="pagination">
                            <li>
                                <a class="transition">موارد یافت شده:
                                    <span class="text-ultralight text-danger"><?php echo  $events['recordsCount']; ?></span>
                                </a>
                            </li>
                            <?php foreach ($events['pagination'] as $key => $href) { ?>
                                <li>
                                    <a class="transition" href="<?php echo  RELA_DIR . $href ?>"><?php echo  $key + 1 ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>














</div>


