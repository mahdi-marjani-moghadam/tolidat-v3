<!-- breadcrumb -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
        <?php include_once("breadcrumb.php"); ?>
    </div>
</div>

<!--  end of breadcrumb -->
<?php //print_r_debug($list);?>
<!-- boxContainer -->
<div class="boxContainer container fullWidth noPadding container-article">
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

                    foreach($list['list'] as $id =>$fields)
                    {

                        $url = RELA_DIR . "article/" . $fields['Article_id'] . "/" . urlencode($fields['title']);
            ?>
                <div class="col-xs-6 col-sm-6 col-md-3 pull-right boxA">
                    <div class="article whiteBg boxBorder roundCorner content-article">
                        <a href="<?=$url;?>" class="displayBlock fullWidth" name="display_block" title="<?=$fields['title']?>">
                            <header><?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?></header>
                        </a>


                        <div class="item text-center" data-articleID="<?=$fields['Article_id'];?>">
                            <div class="logoContainer center-block fullWidth">
                                <a href="<?=($url);?>" class="fullWidth displayBlock" name="f_display_block" title="<?=$fields['title']?>">
                                    <?php
                                        $file = ROOT_DIR.ltrim($fields['image'], '/');
                                    ?>
                                    <img class="roundCorner center-block fullWidth boxBorder" src="<?php echo (strlen($fields['image'])  ? STATIC_RELA_DIR . '/images/article/' . $fields['image'] : '/templates/'.CURRENT_SKIN.'/assets/images/placeholder.png'); ?>" alt="<?php echo (strlen($fields['title']) ? $fields['title'] : "-"); ?>">
                                </a>
                            </div>
                            <div class="content fullWidth">
                                <div class="article">
                                    <span>
                                    <?php echo (strlen($fields['brif_description']) ? $fields['brif_description'] : "-"); ?>
                                    </span>
                                </div>
                                <div class="calender pull-right rtl">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo (strlen($fields['date']) ? convertDate($fields['date']) : "-"); ?>
                                </div>
                            </div>
                            <a href="<?=$url;?>" class="btn btn-block button-default show-more" name="more_info">مشاهده بیشتر</a>
                        </div>
                    </div>
                </div>
            <?php
                    }
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 mt noPadding">
             <!--  <nav class="pull-right">
                    <ul class="pagination">
                        <li>
                            <a class="transition" name="transition" title="موارد یافت شده:">موارد یافت شده: <span class="text-ultralight text-danger"><?php /*echo $list['recordsCount']; */?></span>
                            </a>
                        </li>
                        <?php
/*                            foreach ($list['pagination'] as $key => $href)
                            {
                        */?>
                        <li>
                            <a class="transition" name="ntransition" title="موارد یافت شده:" href="<?/*=RELA_DIR . $href*/?>" title="<?/*=$key + 1*/?>"><?/*=$key + 1*/?> </a>
                        </li>
                        <?php
/*                            }
                        */?>
                    </ul>
                </nav>-->
                <div class="col-xs-12 col-sm-12 col-md-9 pagination-search pagination-search1 pull-right">
                    <div class="whiteBg boxBorder roundCorner fullWidth mb Pagination">
                        <!-------------------------------- pagination -------------------------------->
                        <ul class="pagination center-block">
                            <?php
                            foreach ($list['pagination']['company']['list'] as $href) {
                                if ($href['label'] == ">") {
                                    $href['label'] = "<i class='fa fa-angle-right' aria-hidden='true'></i>";
                                } elseif ($href['label'] == "<") {
                                    $href['label'] = "<i class='fa fa-angle-left' aria-hidden='true'></i>";
                                }
                                ?>
                                <li>
                                    <a class=" transition <?php echo $href['activePage'] ?>" href="<?php echo RELA_DIR . $href['address'] ?>"><?php echo $href['label'] ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>

                        <div class="input-group center-block rtl">
                            <input type="text" class="form-control input-search" id="input-search" placeholder="شماره صفحه ...">
                            <span class="input-group-btn btn-arrow">
                                <a class="btn btn-default button-search" id="button-search" type="button">
                                    <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                </a>
                            </span>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 pagination-search">
                    <div class=" whiteBg boxBorder roundCorner fullWidth mb Pagination">

                        <!-------------------------------- تعداد صفحه -------------------------------->

                        <div class="jPager center-block  roundCorner border pull-left rtl">
                            <span>تعداد صفحه :</span>
                            <?= $list['pagination']['company']['pageCount'] . "<br>" ?>
                        </div>

                        <!-------------------------------- تعداد رکورد -------------------------------->

                        <div class="jPager center-block  roundCorner rtl">
                            <span>تعداد رکورد :</span>
                            <?= $list['pagination']['company']['rowCount'] . "<br>" ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php
                }
                else
                {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 boxA noPadding">
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
<!-- /end of boxContainer -->
