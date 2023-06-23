<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list['products']) ?>

<?php if (isset($list['products']) && count($list['products'])) : ?>
    <!---------------------- محصولات ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left noPadding mb-double3">
        <div class="col-xs-12 col-sm-12 col-md-12 nonefloat">
            <div id="products" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
                <header class="rtl">
                    محصولات/خدمات (<?=count($list['products']); ?> عدد)
                    <a class="productList-grid transition active pull-left text-center"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                    <a class="productList-list transition pull-left text-center"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
                </header>
                <div class="content ltr">
                    <ul class="product-list grid-view text-center">
                        <?php
                        foreach ($list['products'] as $fields):
                            ?>
                            <li class="pull-right">
                                <div class="product-group transition">
                                    <a class="displayBlock" href="<?= RELA_DIR . 'product/show/' . $fields['Product_id'] . "/" . cleanUrl($fields['title']) ?>">
                                        <div class="product-item-img pull-right">
                                            <img
                                                    data-title="محصولات"
                                                    class="transition lazy"
                                                    data-src="<?php echo(strlen($fields['image']) > 0 ? COMPANY_ADDRESS . $fields['company_id'] . '/product/200.200.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>">

                                            <span class="product-overlay transition"></span>
                                        </div>

                                        <div class="product-content pull-right rtl">
                                            <div class="text-right displayBlock displayBlock-content" title="<?php echo $fields['title'] ?>">
                                               <span>
                                                  <?php echo $fields['title'] ?>
                                               </span>
                                            </div>
                                            <p class="text-right text-justify"><?php echo $fields['description'] ?></p>
                                            <span class="tag rtl text-right"><i class="pull-right fa fa-bars"></i> <?= $fields['category_name'] ?></span>
                                            <button class="show-more btn button-default transition">مشاهده بیشتر</button>
                                        </div>
                                    </a>
                                    <div class="product-hash overlayCompany pull-right rtl">
                                        <div class="product-detail pull-right rtl">
                                            <span class="tag rtl text-right"><i class="pull-right fa fa-bars"></i> <?= $fields['category_name'] ?></span>
                                        </div>
                                        <div class="tag rtl text-right">
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/کیاپردازش در تکاپوی مدیریت مدرن">#کیاپردازش در تکاپوی مدیریت مدرن</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/اتوماسیون ">#اتوماسیون </a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات اداری">#تجهیزات اداری</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات فروشگاهی">#تجهیزات فروشگاهی</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات رستورانی">#تجهیزات رستورانی</a>
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
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>