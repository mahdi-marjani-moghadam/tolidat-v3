<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list)?>
<?php if (isset($list['side']['branch_list']) && count($list['side']['branch_list'])) : ?>
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3 ">
    <div class="row">
    <!---------------------- شعب  ---------------------->
    <div class="col-xs-6 col-sm-6 col-md-6 pull-left mb-double3 noPadding pull-right">

        <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
            <div class="content ltr content-single">
                <div class="product-list list-view text-center">

                    <?php
                    foreach ($list['side']['branch_list'] as $value) :
                        if ($value['Branch_id'] != '0'):
                            ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                <div class="whiteBg boxBorder roundCorner box-cont">
                                    <header class="rtl">
                                        <?php echo $value['branch_name']; ?>
                                        <a href="<?= RELA_DIR . 'companyContacts/' . $list["side"]["list"]["Company_id"] ?>" data-branchid="<?php echo $value['Branch_id']; ?>" class="cookieP show-more btn button-default pull-left">مشاهده بیشتر</a>
                                    </header>
                                    <div class="pull-right innerContent">
                                        <article class="text-light pull-right title-detail">
                                            <p class="text-right text-justify"> <?php echo $value['maneger_name']; ?></p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php //print_r_debug($list['side']['representation_list']) ?>
    <!---------------------- نمایندگی ---------------------->
<?php if (isset($list['side']['representation_list']) && count($list['side']['representation_list'])) : ?>
    <div class="col-xs-6 col-sm-6 col-md-6 pull-left mb-double3 noPadding pull-right">
        <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
            <div class="content ltr content-single">
                <ul class="product-list list-view text-center">
                    <?php
                    foreach ($list['side']['representation_list'] as $value) :
                        ?>
                        <li class="pull-right">
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                <div class="whiteBg boxBorder roundCorner box-cont">
                                    <header class="rtl">
                                        <?php echo $value['company_name'] ?>
                                    </header>
                                    <div class="pull-right innerContent">

                                        <article class="text-light pull-right title-detail">
                                            <p class="text-right text-justify"><?php echo $value['representation_name'] ?></p>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>