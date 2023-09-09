<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list)?>
<?php if (isset($list['branchs']) && count($list['branchs'])) : ?>
    <!---------------------- شعب ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3">
        <div id="products" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
            <header class="rtl">
                شعب
            </header>
            <div class="content ltr">
                <ul class="product-list list-view text-center">
                    <?php
                    foreach ($list['branchs'] as $value) :
                        ?>
                        <li class="pull-right">
                            <div class="product-group transition">
                                <a class="displayBlock pr">
                                    <div class="product-item-img pull-right">
                                        <img data-title="شعب" class="width transition roundCorner boxBorder lazy" data-src="<?php echo(strlen($value['image']) > 0 ? COMPANY_ADDRESS . $value['company_id'] .'/history/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="">

                                        <span class="product-overlay transition"></span>
                                    </div>

                                    <div class="product-content pull-right rtl">
                                        <h5 class="text-right displayBlock" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></h5>
                                        <p class="text-right text-justify"><?php echo $value['description'] ?></p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>