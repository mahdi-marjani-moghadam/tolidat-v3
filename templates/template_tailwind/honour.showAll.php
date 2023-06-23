<?php include_once 'companyDetail_top.php'; ?>

<?php if (isset($list['honours']) && count($list['honours'])) : ?>
    <!---------------------- افتخارات ---------------------->
    <div class="lg:col-span-2">
        <div id="products" class="bg-gray-50 my-4">
            <div class="content ltr content-single">
                <div class="product-list grid gap-4 ">
                    <?php
                    foreach ($list['honours'] as $value) :
                    ?>
                        <div class="border-2 rounded">
                            <div class="whiteBg boxBorder roundCorner box-cont">
                                <h2 class="bg-gray-200 p-3">
                                    <?php echo $value['title'] ?>
                                </h2>
                                <div class="pull-right innerContent">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="width transition roundCorner boxBorder lazy" src="<?php echo (strlen($value['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/honour/' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/honour/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' افتخار ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <p class="text-right "><?php echo $value['description'] ?></p>
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
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>