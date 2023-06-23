<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list) 
?>
<div class="lg:col-span-2 my-4">
    <div class="row">
        <!---------------------- فرصت های شغلی ---------------------->
        <div class="col-xs-6 col-sm-6 col-md-6 pull-right">
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <?php if (isset($list['side']['employment_list']) && count($list['side']['employment_list'])) : ?>
                            <div class="bg-gray-50 border-2 rounded">
                                <?php foreach ($list['side']['employment_list'] as $value) : ?>
                                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                        <div class="whiteBg boxBorder roundCorner box-cont">
                                            <h2 class="p-3 bg-gray-200">
                                                <?php echo $value['title'] ?>
                                                <a href="<?php echo RELA_DIR . "employment/show/" . $value['Employment_id'] . '/' . cleanUrl($value['title']) ?>" class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                                            </h2>
                                            <div class="pull-right innerContent">
                                                <div class="logoContainer-img logoContainer pull-right">
                                                    <img class="width transition roundCorner boxBorder lazy" src="<?php echo (strlen($value['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/employment/' . $value['image'] ) ? COMPANY_ADDRESS . $value['company_id'] . '/employment/' . $value['image'] : DEFULT_PRODUCT_ADDRESS); ?>" alt="<?php echo  ' آگهی ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">
                                                </div>
                                                <article class="text-light pull-right title-detail">
                                                    <p class="text-right "><?php echo $value['description'] ?></p>
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