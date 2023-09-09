<?php include_once 'companyDetail_top.php'; ?>

<?php if (isset($list['side']['history_list']) && count($list['side']['history_list'])) : ?>
    <!---------------------- سوابق و مشتریان ما ---------------------->
    <div class="lg:col-span-2 ">
        <div id="products" class=" my-4">
            <div class="content ltr content-single">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                    foreach ($list['side']['history_list'] as $value) :
                    ?>
                        <div class=" bg-gray-50 border-2 rounded text-sm">
                            <div class="whiteBg boxBorder roundCorner box-cont">
                                <h3 class="p-3 bg-gray-200 ">
                                    <?php echo $value['title'] ?>
                                </h3>
                                <div class="pull-right innerContent p-2 leading-relaxed">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="سوابق و مشتریان ما" class="width transition roundCorner boxBorder lazy" data-src="<?php echo (strlen($value['image']) > 0 ? COMPANY_ADDRESS . $value['company_id'] . '/history/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="">
                                    </div>
                                    <article class="text-light pull-right title-detail">

                                        <p class="text-right text-justify"><?php echo $value['description'] ?></p>
                                    </article>
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