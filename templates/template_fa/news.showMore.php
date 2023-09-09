<?php include_once 'companyDetail_top.php'; ?>

<div class="lg:col-span-2">

    <div class="boxContainer breadcrumb-product">
        <div class="row fullPadding slick-slider-new">
            <div class="">
                <!------------------------ محصول  -------------------------->
                <div class="contentProduct border-2 mt-4 rounded bg-gray-50">
                    <div class="tab-content tabProduct text-header searchBox1 bestProduct panel-body">
                        <div class="flex flex-col sm:flex-row justify-between p-3 border-b bg-gray-200 items-center">
                            <div class="row fullPadding slick-slider-new">
                                <div class="detailNews">
                                    <h2 class="font-bold text-lg mb-2 sm:mb-0">
                                        <?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>
                                    </h2>

                                </div>
                            </div>
                        </div>
                        <div class="row leading-relaxed p-4">
                            <div class="content fullWidth">
                                <div class="col-xs-12  col-sm-12 col-md-4 col-lg-4 text-center">
                                    <?php $file = ROOT_DIR . ltrim($list['list']['image'], '/'); ?>
                                    <img class="roundCorner" 
                                    src="<?php echo (strlen($list['list']['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $list['list']['company_id'] . '/news/' . $list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/news/' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS); ?>" 
                                    alt="<?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>">
                                </div>
                                <div class="col-xs-12  col-sm-12 col-md-8">
                                    <article class="text-right text-justify">
                                        <?php echo (strlen($list['list']['brif_description']) ? $list['list']['brif_description'] : '-'); ?>
                                    </article>
                                    <div class="xsmallSpace"></div>
                                    <article class="text-right text-justify">
                                        <?php echo (strlen($list['list']['description']) ? $list['list']['description'] : '-'); ?>
                                    </article>

                                    <!-- separator -->
                                    <div class="xsmallSpace"></div>

                                    <div class="calender rtl pull-right">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo (strlen($list['list']['date']) ? convertDate($list['list']['date']) : '-'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'companyDetail_bottom.php'; ?>