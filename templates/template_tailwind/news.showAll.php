<?php include_once 'companyDetail_top.php'; ?>

<?php if (isset($list['side']['news_list']) && count($list['side']['news_list'])) : ?>
    <!---------------------- اخبار ---------------------->
    <div class="lg:col-span-2">
        <div id="products" class="my-4">
            <div class="content ltr content-single">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php
                    foreach ($list['side']['news_list'] as $value) :
                    ?>
                        <div class="border-2 bg-gray-50 rounded">
                            <div class="whiteBg boxBorder roundCorner box-cont">
                                <header class="bg-gray-200 p-3 ">
                                    <?php echo $value['title'] ?>
                                </header>
                                <div class="pull-right innerContent p-2 text-sm leading-relaxed">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="width transition roundCorner boxBorder lazy" src="<?php echo (strlen($value['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/news/' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/news/' . $value['image'] : DEFULT_PRODUCT_ADDRESS); ?>" alt="<?php echo  ' نام تجاری ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <p class=" text-justify"><?php echo $value['brief_description'] ?></p>

                                    </article>

                                </div>
                            </div>
                            <div class="product-group p-3 rounded text-center  bg-white ">
                                <a href="<?php echo RELA_DIR ?>companyNews/show/<?php echo $value['News_id'] ?>" class="displayBlock bg-tolidatColor text-white px-3 rounded-full">مشاهده بیشتر
                                </a>
                            </div>
                        </div>

                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>