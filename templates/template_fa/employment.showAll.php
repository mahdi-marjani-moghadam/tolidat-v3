<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list) ?>
<div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3 ">
    <div class="row">
        <!---------------------- فرصت های شغلی ---------------------->
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
                    <div class="content ltr content-single">
                        <?php if (isset($list['side']['employment_list']) && count($list['side']['employment_list'])) : ?>
                            <div class="product-list list-view text-center">
                                <?php foreach ($list['side']['employment_list'] as $value) : ?>
                                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                        <div class="whiteBg boxBorder roundCorner box-cont">
                                            <header class="rtl">
                                                <?php echo $value['title'] ?>
                                                <a href="<?php echo RELA_DIR . "employment/show/" . $value['Employment_id'] . '/'. cleanUrl($value['title']) ?>" class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                                            </header>
                                            <div class="pull-right innerContent">
                                                <div class="logoContainer-img logoContainer pull-right">
                                                    <img class="width transition roundCorner boxBorder lazy" data-src="<?php echo(strlen($value['image']) > 0 ? COMPANY_ADDRESS . $value['company_id'] . '/employment/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?= ' آگهی ' . $value['title'] ?>" title="<?= $value['title'] ?>">
                                                </div>
                                                <article class="text-light pull-right title-detail">
                                                    <p class="text-right text-justify"><?php echo $value['description'] ?></p>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'companyDetail_bottom.php'; ?>
