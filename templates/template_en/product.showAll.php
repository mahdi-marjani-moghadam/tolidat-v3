<?php include_once 'companyDetail_top.php'; ?>


<?php if (isset($list['products']) && count($list['products'])) : ?>
    <!---------------------- محصولات ---------------------->
    <div class="lg:col-span-2 leading-relaxed">
        <div class="border-2 my-4 rounded bg-gray-50">
            <div id="products" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
                <h2 class="p-3 border-b bg-gray-200">
                Products/services (<?php echo  count($list['products']); ?> items)
                    <a class="productList-grid transition active pull-left text-center"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                    <a class="productList-list transition pull-left text-center"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
                </h2>
                <div class="content ltr">
                    <ul class="product-list grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-3 text-center ">
                        <?php
                        foreach ($list['products'] as $fields) :
                        ?>
                            <li class="group ">
                                <div class="product-group border p-3 rounded  bg-white ">
                                    <div class="product-item-img flex h-40 justify-center">
                                        <img data-title="محصولات" class="" loading='lazy' src="<?php echo (strlen($fields['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/product/150.150.' . $fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/150.150.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>">

                                    </div>

                                    <div class="product-content pull-right ">
                                        <div class="text-left displayBlock displayBlock-content">
                                            <h3 class="text-tolidatColor">
                                                <?php echo $fields['title'] ?>
                                            </h3>
                                        </div>

                                        <p class="text-right truncate text-sm text-gray-700 mb-2"><?php echo $fields['description'] ?></p>

                                        <div class="tag  text-left  text-xs px-2 -mx-3 bg-gray-200 p-2 mb-2 leading-7 truncate "> Category: <span class="bg-white border-tolidatColor border rounded-full px-2">
                                                <?php echo  $fields['category_name'] ?>
                                            </span></div>

                                        <a class="displayBlock bg-tolidatColor text-white px-3 rounded-full" href="<?php echo  RELA_DIR . 'product/show/' . $fields['Product_id'] . "/" . cleanUrl($fields['title']) ?>">
                                        View more 
                                        </a>
                                        <!-- <button class="show-more bg-tolidatColor text-white px-3 rounded-full"></button> -->
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