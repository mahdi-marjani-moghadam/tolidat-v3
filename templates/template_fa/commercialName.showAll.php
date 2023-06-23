<?php include_once 'companyDetail_top.php'; ?>

<?php if (isset($list['side']['commercialName_list']) && count($list['side']['commercialName_list'])) : ?>
    <!---------------------- نام تجاری ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3 noPadding">
        <div id="products" class="text-header searchBox1 bestProduct  fullWidth container-product-Grouping productGrid">
            <div class="content ltr content-single">
                <?php
                foreach ($list['side']['commercialName_list'] as $value) :
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb ">
                        <div class="whiteBg boxBorder roundCorner box-cont">
                            <header class="rtl">
                                <?php echo $value['title'] ?>
                            </header>
                            <div class="pull-right innerContent">
                                <div class="logoContainer-img logoContainer pull-right">
                                    <img class="width transition roundCorner boxBorder lazy" data-src="<?php echo(strlen($value['image']) > 0 ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?= ' نام تجاری ' . $value['title'] ?>" title="<?= $value['title'] ?>">
                                </div>
                                <article class="text-light pull-right title-detail">
                                    <p class="text-right text-justify"><?php echo $value['description'] ?></p>
                                </article>
                                <a class="displayBlock pr"></a>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>