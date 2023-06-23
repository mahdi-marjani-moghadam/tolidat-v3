<!-- boxContainer -->
<div class="boxContainer container-show-all-category">
    <!-- breadcrumb -->
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>

    <?php if ($list['topLayer']) : ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                <div class="searchBox whiteBg boxBorder roundCorner fullWidth mb-double">
                    <nav aria-label="...">
                        <ul class="pager">
                            <?php foreach ($list['category'] as $category) { ?>
                                <li>
                                    <a id="<?= $category['Category_id']; ?>" href="<?php echo RELA_DIR . $category['link'] . $category['Category_id'] ?>"><img class="pull-right" src="<?php echo RELA_DIR . "statics/images/category/tinyCatImg/" . $category['Category_id'] . ".png"; ?>" alt="<?php echo $category['title'] ?>"><?php echo $category['title'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    <?php endif; ?>



    <?php if ($list['catBanner']->image != '') : ?>
        <div class="row">
            <div class="col-md-12" style="height: 200px; margin-bottom: 1em; ">
                <div style="position: absolute;
    bottom: 10px;
    color: #000;
    line-height: 30px;
    padding: 0 10px;
    height: 30px;
    right: 30px;
    z-index: 1;
    font-size: 12px;
    background: #FFF;
    box-shadow: 0 0 3px #aaa;
    border-radius: 3px;"><?php echo $list['cat']->title;?></div>
                <img style="object-fit: cover; width: 100%; height: 100%; box-shadow: 0 3px 5px -1px #b0b1af !important;" class="fullWidth mb-double roundCorner " src="<?php echo RELA_DIR . "statics/images/category_banner/" .  $list['catBanner']->image ?>" alt="">
            </div>
        </div>
    <?php endif; ?>


    <div class="row">
        <?php foreach ($list['category'] as $category) { ?>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 pull-right" data-id="<?= $category['Category_id']; ?>">
                <div class="searchBox boxBorder roundCorner fullWidth mb-double whiteBg">
                    <header>
                        <div class="text-right text-title">
                            <a href="<?php echo RELA_DIR . $category['link'] . $category['Category_id'] ?>">
                                <?php if ($list['topLayer']) : ?>
                                    <img class="pull-right" src="<?php echo RELA_DIR . "statics/images/category/tinyCatImg/" . $category['Category_id'] . ".png"; ?>" alt="<?php echo $category['title'] ?>">
                                <?php endif; ?>
                                <?php echo $category['title'] ?>
                            </a>
                        </div>
                    </header>
                    <div class="content whiteBg roundCorner fullWidth">
                        <?php /*<div class="container-box-logo-category pull-right">
                            <img class="container-logo-category boxBorder lazy" data-src="echo RELA_DIR . "statics/images/category/" . $category['img_name']; ?>" alt="">
                        </div> */
                        if (count($list['company'][$category['Category_id']])) {
                        ?>
                            <?php foreach ($list['company'][$category['Category_id']] as $company) { ?>
                                <div class="container-category-more">
                                    <a class="container-category-more-link" href="<?php echo RELA_DIR . 'company/Detail/' . $company['Company_id'] . '/' . cleanUrl($company['company_name']); ?>">
                                        <div class="content-img">
                                            <img class="lazy container-logo-category-more boxBorder" data-src="<?php echo (!empty($company['image']) ? COMPANY_ADDRESS . $company['Company_id'] . "/logo/" . $company['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="">
                                        </div>
                                        <div class="content-text">
                                            <h2 class="text-right rtl"><?php echo $company['company_name'] ?></h2>
                                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> <span><?= $company['province_name'] ?></span></p>
                                            <p class="gold-icon <?= (!empty($company['package_class']) ? $company['package_class'] : '') ?>"> <i class="fa fa-trophy" aria-hidden="true"></i> <span><?= (!empty($company['package_name']) ? $company['package_name'] : "رایگان") ?></span></p>
                                            <? if ((int)$company['product_count']) { ?>
                                                <p class="cubes"> <i class="fa fa-cubes" aria-hidden="true"></i> <span><?= $company['product_count'] ?> محصول</span></p>
                                            <? } ?>
                                        </div>

                                    </a>
                                </div>
                            <?php }
                        } else {
                            ?>
                            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png" style="position: absolute;left: 0;right: 0;top: 2px;bottom: 0;margin: 25% auto;">
                        <?php
                        }
                        ?>
                        <a class="link-show-all-company btn btn-block show-more button-default" href="<?php echo RELA_DIR . $category['link'] . $category['Category_id'] ?>"><?= $list['buttonTitle'] ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php /*<script>
    $(function () {
        $('.pager a').on('click', function (e) {
            e.preventDefault();

            var id = $(this).attr('id'),
                $idContainer = $('[data-id="' + id + '"]');

            $('body, html').animate({scrollTop: $idContainer.offset().top - 90}, 400);

            $idContainer.addClass('highlight');

            setTimeout(function () {
                $idContainer.removeClass('highlight');
            }, 2000);
        });
    });
</script>
*/ ?>