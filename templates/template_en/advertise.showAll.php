<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list) ?>
    <div class="ls:col-span-2">
        <div class="row">
            <!---------------------- آگهی ها ---------------------->
            <div class="border-2 my-4 rounded bg-gray-50">
                <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                    <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
                        <div class="content ltr content-single">
                        <?php if (isset($list['side']['advertise_list']) && count($list['side']['advertise_list'])) : ?>
                                <div class="product-list list-view ">
                                    <?php foreach ($list['side']['advertise_list'] as $value) : ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                            <div class="whiteBg boxBorder roundCorner box-cont">
                                                <h2 class="bg-gray-200 p-3">
                                                    <?php echo $value['title'] ?>
                                                    <a href="<?php echo RELA_DIR . "companyAdvertise/show/" . $value['Advertise_id'] . '/'. cleanUrl($value['title']) ?>" class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                                                </h2>
                                                <div class="pull-right innerContent">
                                                    <div class="logoContainer-img logoContainer pull-right">
                                                        <img class="width transition roundCorner boxBorder lazy" src="<?php echo(strlen($value['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/advertise/' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/advertise/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' آگهی ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">
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
