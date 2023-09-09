<?php include_once 'companyDetail_top.php'; ?>
<?php //print_r_debug($list)
?>
<?php if (isset($list['side']['branch_list']) && count($list['side']['branch_list'])) : ?>
    <div class="lg:col-span-2    ">
        <div class="flex">
            <!---------------------- شعب  ---------------------->
            <div class="my-4 w-full">

                <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
                    <div class="content ltr content-single">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <?php
                            foreach ($list['side']['branch_list'] as $value) :
                                if ($value['Branch_id'] != '0') :
                            ?>
                                    <div class="border-2  rounded bg-gray-50 ">
                                        <div class="">
                                            <h3 class="p-3 bg-gray-200">
                                                <?php echo $value['branch_name']; ?>
                                            </h3>
                                            <div class="p-2">
                                                <p class=" text-justify text-xs text-gray-700">مدیر: <span class="text-base text-black"><?php echo $value['maneger_name']; ?></span></p>
                                                
                                                <a href="<?php echo  RELA_DIR . 'companyContacts/' . $list["side"]["list"]["Company_id"] ?>" data-branchid="<?php echo $value['Branch_id']; ?>" class="rounded-full bg-tolidatColor px-3 mt-4 inline-block text-white text-sm">مشاهده بیشتر</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        <?php endif; ?>
        <?php //print_r_debug($list['side']['representation_list']) 
        ?>
        <!---------------------- نمایندگی ---------------------->
        <?php if (isset($list['side']['representation_list']) && count($list['side']['representation_list'])) : ?>
            <div class="w-1/2">
                <div id="products" class="text-header searchBox1 bestProduct fullWidth container-product-Grouping productGrid">
                    <div class="content ltr content-single">
                        <ul class="product-list list-view text-center">
                            <?php
                            foreach ($list['side']['representation_list'] as $value) :
                            ?>
                                <li class="pull-right">
                                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                                        <div class="whiteBg boxBorder roundCorner box-cont">
                                            <header class="rtl">
                                                <?php echo $value['company_name'] ?>
                                            </header>
                                            <div class="pull-right innerContent">

                                                <article class="text-light pull-right title-detail">
                                                    <p class="text-right text-justify"><?php echo $value['representation_name'] ?></p>
                                                </article>
                                            </div>
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
    </div>
<?php endif; ?>

<?php include_once 'companyDetail_bottom.php'; ?>