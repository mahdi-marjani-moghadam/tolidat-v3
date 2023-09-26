<?php include_once 'companyDetail_top.php'; ?>

<div class="lg:col-span-2">
    
    <div class="boxContainer breadcrumb-product">
        <div class="row fullPadding slick-slider-new">
            <div class="">
                <!------------------------ محصول  -------------------------->
                <div class="contentProduct border-2 mt-4 rounded bg-gray-50">
                    <div class="tab-content tabProduct text-header searchBox1 bestProduct panel-body">
                        <div class="flex flex-col sm:flex-row justify-between p-3 border-b bg-gray-200 items-center">

                            <h2 class="font-bold text-lg mb-2 sm:mb-0"><?php echo $list['list']['title'] ?></h2>

                            <?php if (count($list['category_list'])) : ?>
                                <div class="text-sm">
                                    <?php $count = count($list['category_list']);
                                    $i = 0; ?>
                                    دسته بندی:
                                    <?php foreach ($list['category_list'] as $category) {
                                        $i++ ?>
                                        <a class="link-show-category bg-white border border-tolidatColor text-xs rounded-full px-3" href="<?php echo RELA_DIR . 'company/type/تولیدی/category/' . $category['Category_id'] ?>"><?php echo ($category['title'] != "" ? $category['title'] : "-"); ?><?php echo ($i != $count ? " ," : "") ?></a>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>

                        </div>
                        
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="col-xs-12 col-sm-7 col-md-6 pull-right">
                                    <p class="product-span leading-relaxed p-4 text-justify">
                                        <?php echo ($list['list']['description'] != "" ? $list['list']['description'] : "-"); ?>
                                    </p>
                                </div>

                                <div class="p-4">
                                    
                                    <div class="slider-hover">
                                        <div class="slider-for">

                                            <img class="mx-auto" src="<?php echo (isset($list['list']['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $list['list']['company_id'] . '/product/' . $list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/product/' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS) ?>">

                                            <?php
                                            foreach ($list['list']['gallery'] as $item) :
                                            ?>
                                                <img class="roundCorner fullWidth boxBorder" src="<?php echo $item['src']; ?>">
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    </div>

                                    <?php
                                        if (count($list['list']['gallery']) > 0) {
                                    ?>
                                        <div class="slider-nav pt" style="border-top: solid 1px #DDD;">
                                            <div class="content-sliderNav pull-right">
                                                <img class="boxBorder transition roundCorner pull-left width" src="<?php echo (isset($list['list']['image']) && file_exists(COMPANY_ADDRESS_ROOT . $list['list']['company_id'] . '/product/' . $list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/product/' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS) ?>" data-original="" alt="<?php echo  $list['list']['title'] ?>">
                                            </div>
                                            <?php
                                            foreach ($list['list']['gallery'] as $item) :
                                            ?>
                                                <div class="content-sliderNav pull-right">
                                                    <img class="roundCorner fullWidth boxBorder" src="<?php echo $item['src']; ?>">
                                                </div>
                                            <?php
                                            endforeach;
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                        <?php if (count($list['metaKeyword_list']) > 0) : ?>
                            <div class="panel-footer tag p-4 flex flex-wrap gap-2">
                                <?php foreach ($list['metaKeyword_list'] as $meta) { ?>
                                    <a class="border border-tolidatColor px-3 text-sm rounded-full" href="<?php echo  RELA_DIR . "search/type/تولیدی/q/" . $meta ?>">#<?php echo $meta ?></a>
                                <?php } ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="">
                <!-------------------------  سایر محصولات   ------------------------------>
                <div class="border-2 my-4 rounded bg-gray-50          text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth other-products mb-double product-detail-side">

                    <div class="flex p-3 border-b bg-gray-200 items-center">
                        <h2 class="">سایر محصولات/خدمات</h2>
                    </div>

                    <div class="content rtl carousel-vertical content-min-height more-product">

                        <?php if (count($list['other_product_list']) > 0) : ?>
                            <?php foreach ($list['other_product_list'] as $id => $fields) : ?>
                                <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                    <a class="single block" href="<?php echo  RELA_DIR . 'product/show/' . $fields['Product_id'] . '/' . cleanUrl($fields['title']); ?>">
                                        <div class="p-2">
                                            <div class="flex gap-x-2 overflow-hidden         innerContent pull-left">

                                                <!-- <div class="flex-grow         logoContainer pull-right"> -->
                                                <img class="w-32 h-32      transition roundCorner boxBorder width" src="<?php echo (isset($fields['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/product/90.90.' . $fields['image'])) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/90.90.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS ?> " alt="<?php echo  $fields['title'] ?>">
                                                <!-- </div> -->

                                                <div>
                                                    <!-- <div class="product-title" title="<?php echo $fields['title'] ?>"> -->
                                                        <h3><?php echo (strlen($fields['title']) ? $fields['title'] : '-'); ?></h3>

                                                        <!-- <div class="        text-light pull-right article"> -->
                                                        <!--     -->
                                                            <p class="text-sm text-gray-700 leading-relaxed    block overflow-hidden whitespace-nowrap text-ellipsis w-full md:max-w-lg">
                                                                <?php echo (strlen($fields['description']) ? $fields['description'] : '-'); ?>
                                                            </p>
                                                        <!-- </div> -->
                                                    <!-- </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (count($list['other_product_list']) <= 0) : ?>
                        <div class="notRecord flex  items-center p-4 flex-col ">
                            <img class=" w-20" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png">
                            <p class="empty-text">اطلاعاتی موجود نیست!</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!----------------------  محصولات مرتبط  --------------------------->
                <div class="border-2 my-4 rounded bg-gray-50 text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth other-products mb-double product-detail-side">

                    <div class="flex p-3 border-b bg-gray-200 items-center">
                        <h2 class="">محصولات/خدمات مرتبط</h2>
                    </div>

                    <div class="content rtl grid more-product">

                        <?php if (count($list['related_products_list']) > 0) : ?>
                            <?php foreach ($list['related_products_list'] as $id => $fields) : ?>
                                <a class="single" href="<?php echo  RELA_DIR . 'product/show/' . $fields['Product_id'] . '/' . cleanUrl($fields['title']); ?>">
                                    <div class="flex gap-x-2 p-2">
                                        <img class="w-32 h-32" src="<?php echo (isset($fields['image']) && file_exists(COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/product/90.90.' . $fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/90.90.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS) ?>" alt="<?php echo  $fields['title'] ?>">

                                        <div>
                                            <h3 title="<?php echo $fields['title'] ?>">
                                                <?php echo (strlen($fields['title']) ? $fields['title'] : '-'); ?>
                                            </h3>
                                            <p class="text-sm text-gray-700 leading-relaxed"><?php echo (strlen($fields['description']) ? $fields['description'] : '-'); ?></p>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (count($list['related_products_list']) <= 0) : ?>
                        <div class="notRecord">
                            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png">
                            <p class="empty-text">اطلاعاتی موجود نیست!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once 'companyDetail_bottom.php'; ?>