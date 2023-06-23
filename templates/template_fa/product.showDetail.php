<?php include_once 'companyDetail_top.php'; ?>

<style type="text/css">
    .slick-track {
        transform: translate3d(0, 0, 0) !important;
    }
    .slider-nav .content-sliderNav {
        height: 90px;
    }
    .slick-slider-new .slider-hover {
        height: auto !important;
    }
</style>

<div class="row fullPadding noMargin">
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left">
        <div class="boxContainer breadcrumb-product">

            <?php include_once("breadcrumb.php"); ?>
            <div class="row fullPadding slick-slider-new">
                <div class="col-xs-12 col-sm-12 col-md-12 pull-left mb-double3">
                    <!------------------------ دسته بندی  -------------------------->
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding mb">
                        <div class="contentProduct contentProduct-body whiteBg boxBorder roundCorner pull-left transition mb overlayCompany">
                            <!-- Tab panes -->
                            <div class="tab-content tabProduct text-header searchBox1 bestProduct panel-body">
                                <header><?= $list['list']['title'] ?></header>
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-7 col-md-6 pull-right">
                                            <?php if(count($list['category_list'])) : ?>
                                            <div>
                                                <i class="fa fa-bars pull-right" style="margin-top: .2em;"></i>
                                                <?php $count = count($list['category_list']); $i = 0; ?>
                                                <?php foreach ($list['category_list'] as $category) { $i++ ?>
                                                    <a class="link-show-category pull-right" href="<?php echo RELA_DIR . 'company/type/تولیدی/category/' . $category['Category_id'] ?>"><?php echo($category['title'] != "" ? $category['title'] : "-"); ?><?php echo($i != $count ? " ," : "") ?></a>
                                                <?php } ?>
                                            </div>
                                            <?php endif; ?>
                                            <p class="product-span">
                                                <?php echo($list['list']['description'] != "" ? $list['list']['description'] : "-"); ?>
                                            </p>
                                        </div>
                                        <div class="col-xs-12 col-sm-5 col-md-6 size pull-left name-products">
                                            <div class="detailNews detailNews1 noPadding" style="outline: solid 1px #DDD;">
                                                <a data-toggle="modal" data-target="#myModal1" class="expand">
                                                    <i class="fa fa-expand" aria-hidden="true"></i>
                                                </a>

                                                <div class="slider-hover">
                                                    <div class="slider-for">
                                                        <img class="boxBorder transition roundCorner pull-left width lazy" data-src="<?php echo(isset($list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/product/457.457.' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS) ?>" data-original="" alt="<?= $list['list']['title'] ?>">
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
                                                if(count($list['list']['gallery']) > 0) {
                                                ?>
                                                <div class="slider-nav pt" style="border-top: solid 1px #DDD;">
                                                    <div class="content-sliderNav pull-right">
                                                        <img class="boxBorder transition roundCorner pull-left width" data-lazy="<?php echo(isset($list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/product/' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS) ?>" data-original="" alt="<?= $list['list']['title'] ?>">
                                                    </div>
                                                    <?php
                                                    foreach ($list['list']['gallery'] as $item) :
                                                        ?>
                                                        <div class="content-sliderNav pull-right">
                                                            <img class="roundCorner fullWidth boxBorder" data-lazy="<?php echo $item['src']; ?>">
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
                                </div>
                                <?php if (count($list['metaKeyword_list']) > 0) : ?>
                                <div class="panel-footer tag">
                                    <?php foreach ($list['metaKeyword_list'] as $meta) { ?>
                                        <a href="<?= RELA_DIR . "search/type/تولیدی/q/" . $meta ?>">#<?php echo $meta ?></a>
                                    <?php } ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double3">
                    <!-------------------------  سایر محصولات   ------------------------------>
                    <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth other-products mb-double product-detail-side">
                        <header>
                            <div class="center-block text-right">سایر محصولات/خدمات </div>
                        </header>
                        <div class="content rtl carousel-vertical content-min-height more-product">
                    <?php if (count($list['other_product_list']) > 0) : ?>
                        <?php foreach ($list['other_product_list'] as $id => $fields): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <a class="single" href="<?= RELA_DIR . 'product/show/' . $fields['Product_id'] . '/' . cleanUrl($fields['title']); ?>">
                                    <div class="innerContent pull-left">
                                        <div class="logoContainer pull-right">
                                            <img class="transition roundCorner boxBorder width" data-lazy="<?php echo(isset($fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/90.90.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS) ?> " alt="<?= $fields['title'] ?>">
                                        </div>
                                        <div class="product-title" title="<?php echo $fields['title']?>">
                                    <span>
                                    <?= (strlen($fields['title']) ? $fields['title'] : '-'); ?>
                                    </span>
                                        </div>
                                        <div class="text-light pull-right article">
                                            <p>
                                                <?= (strlen($fields['description']) ? $fields['description'] : '-'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </div>
                    <?php if (count($list['other_product_list']) <= 0) : ?>
                        <div class="notRecord">
                            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png">
                            <p class="empty-text">اطلاعاتی موجود نیست!</p>
                        </div>
                    <?php endif; ?>
                    </div>

                    <!----------------------  محصولات مرتبط  --------------------------->
                    <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth other-products mb-double product-detail-side">
                        <header>
                            <div class="center-block text-right">محصولات/خدمات مرتبط</div>
                        </header>
                        <div class="content rtl carousel-vertical content-min-height more-product">
                            <?php if (count($list['related_products_list']) > 0) : ?>
                                <?php foreach ($list['related_products_list'] as $id => $fields): ?>
                                    <a class="single" href="<?= RELA_DIR . 'product/show/' . $fields['Product_id'] . '/' . cleanUrl($fields['title']); ?>">
                                        <div class="innerContent pull-left">
                                            <div class="logoContainer pull-right">
                                                <img class="transition roundCorner boxBorder width" data-lazy="<?php echo(isset($fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/90.90.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS) ?>" alt="<?= $fields['title'] ?>">
                                            </div>
                                            <h2 title="<?php echo $fields['title']?>">

                                                <?= (strlen($fields['title']) ? $fields['title'] : '-'); ?>
                                            </h2>
                                            <article><?= (strlen($fields['description']) ? $fields['description'] : '-'); ?></article>
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

            <!-- show big image of product -->
            <div class="showBigImg modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title"></h4>
                        </div>

                        <div class="modal-body">
                            <img class="center-block" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/placeholder.png" alt=""/>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>

<div id="myModal1" class="holder-modal modal fade holder-modal1" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <img id="detailGalleryImg" style="height: 80vh;" src="<?php echo(isset($list['list']['image']) ? COMPANY_ADDRESS . $list['list']['company_id'] . '/product/' . $list['list']['image'] : DEFULT_PRODUCT_ADDRESS) ?>">
            </div>
        </div>

    </div>
</div>

<script>
    try {
        $('.more-product').slick({
            rtl: true,
            speed: 2000,
            autoplay: true,
            dots: false,
            infinite: false,
            slidesToShow: 2,
            slidesToScroll: 2,
            lazyLoad: 'ondemand',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

    } catch(e) {}

    $('#myModal1').on('show.bs.modal', function() {
        var img = $('.slider-hover .slick-active'),
            src = img.attr('src'),
            alt = img.attr('alt');



        $('#detailGalleryImg').attr({
            src: src,
            alt: alt
        });
    });

    /*$('.name-products img').on('click', function() {
        var $modal = $('.showBigImg'),
            src = $(this).data('src');

        $modal.find('img').attr('src', src);
        $modal.modal('show');
    });*/

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        lazyLoad: 'ondemand',
        asNavFor: '.slider-nav'
        // autoplay: true,
        // speedAutoplay: 3000

    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
        // autoplay: true,
        // speedAutoplay: 3000
    });

</script>
<?php include_once 'companyDetail_bottom.php'; ?>
