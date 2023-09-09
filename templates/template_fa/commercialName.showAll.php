<?php include_once 'companyDetail_top.php'; ?>

<?php if (isset($list['side']['commercialName_list']) && count($list['side']['commercialName_list'])) : ?>
    <!---------------------- نام تجاری ---------------------->
    <div class="lg:col-span-2 ">
        <div id="products" class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?php
                foreach ($list['side']['commercialName_list'] as $value) :
                ?>
                    <div class="border-2 my-4 rounded bg-gray-50 ">
                        <div class="whiteBg boxBorder roundCorner box-cont">
                            <h2 class="p-3 border-b bg-gray-200">
                                <?php echo $value['title'] ?>
                            </h2>
                            <div class=" innerContent  ">
                                <div class="logoContainer-img ">
                                    <img class="  " src="<?php echo (strlen($value['image']) > 0  && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/commercialName/' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' نام تجاری ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>">
                                </div>
                                <article class=" title-detail  flex-grow">
                                    <p class="text-justify p-2"><?php echo $value['description'] ?></p>
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
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>