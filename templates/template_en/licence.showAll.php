<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list['side']['licence_list'])?>
<?php if (isset($list['licences']) && count($list['licences'])) : ?>
    <!---------------------- مجوزها ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3">
        <div id="products" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
            <header class="rtl">
                مجوزها
            </header>
            <div class="content ltr">
                <ul class="product-list list-view text-center">
                    <?php
                    foreach ($list['side']['licence_list'] as $value) :
                        ?>
                        <li class="pull-right">
                            <div class="product-group transition">
                                <a class="displayBlock pr">
                                    <div class="product-item-img pull-right">
                                        <img class="width transition roundCorner boxBorder lazy" data-src="<?php echo(strlen($value['image']) > 0 ? COMPANY_ADDRESS . $value['company_id'] . '/licence/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' مجوز ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">

                                        <span class="product-overlay transition"></span>
                                    </div>

                                    <div class="product-content pull-right rtl">
                                        <h5 class="text-right displayBlock" title="<?php echo $value['licence_name'] ?>"><?php echo $value['licence_name'] ?></h5>
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