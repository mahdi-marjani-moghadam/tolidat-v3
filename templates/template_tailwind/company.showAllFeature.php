<div class="col-xs-12 col-sm-12 col-md-12 noPadding">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
            <?php include_once("breadcrumb.php"); ?>
        </div>
    </div>
</div>
<?php //print_r_debug($list); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-double3 noPadding">
            <div id="products"
                 class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
                <header>
                    <?php if ($list['export']['folder_name'] == "certification") : ?>گواهی ها<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "product") : ?>محصولات
                        <a class="productList-grid transition active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a class="productList-list transition"><i class="fa fa-list-ul" aria-hidden="true"></i></a>
                    <?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "representation") : ?>نمایندگی ها<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "honour") : ?>افتخارات<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "history") : ?>سوابق و مشتریان ما<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "commercialName") : ?>نام های تجاری<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "licences") : ?>مجوزها<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "news") : ?>اخبار<?php endif; ?>
                    <?php if ($list['export']['folder_name'] == "employment") : ?> فرصت های شغلی<?php endif; ?>
                </header>
                <div class="content ltr">
                    <?php if ($list['export']['folder_name'] == "product") : ?>

                        <ul class="container-repeat-list">
                            <?php foreach ($list['export']['list'] as $value) : ?>
                                <?php if ($list['export']['folder_name'] == "product") : ?>

                                    <li class="repeat-list">
                                        <div class="product-Grouping roundCorner transition">
                                            <a class="link-product-Grouping" href="<?php echo  RELA_DIR . 'product/show/' . $value['Product_id'] ?>">
                                                <div class="detail-repeat-list">
                                                    <div class="logoContainer-img-detail">
                                                        <img data-title="محصولات" class="transition lazy" data-src="<?php echo(isset($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/' . $list['export']['folder_name'] . '/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>">
                                                    </div>
                                                </div>
                                                <div class="detail-repeat-list">
                                                    <div class="description-product-Grouping text-right pull-right">
                                                        <h5 title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></h5>
                                                        <p><?php echo $value['description'] ?></p>
                                                        <button class="link-show-detail transition" href="">مشاهده بیشتر</button>
                                                    </div>
                                                </div>
                                            </a>
                                            <span class="title-product-category transition"><?php echo $value['category_name'] ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                    <?php foreach ($list['export']['list'] as $value) : ?>
                    <?php if ($list['export']['folder_name'] == "certification") : ?>
                    <ul class="container-repeat-list">
                        <li class="repeat-list">
                            <div class="product-Grouping roundCorner transition">
                                <a class="link-product-Grouping" href="<?php echo  RELA_DIR . 'product/' . $value['Product_id'] ?>">
                                    <div class="detail-repeat-list">
                                        <div class="logoContainer-img-detail">
                                            <img data-title="گواهی ها" class="width transition roundCorner boxBorder lazy" data-src="<?php echo(isset($value['image']) ? COMPANY_ADDRESS . $list['export']['folder_name'] . '/' . $value['image'] : DEFULT_LOGO_ADDRESS);?>" alt="">
                                        </div>
                                    </div>
                                    <div class="detail-repeat-list">
                                        <div class="description-product-Grouping text-right pull-right">
                                            <h5 title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></h5>
                                            <p><?php echo $value['description']?></p>
                                        </div>
                                    </div>
                                </a>
                                <span class="title-product-category transition">گواهی ها</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php elseif ($list['export']['folder_name'] == "representation") : ?>
                    <div class="col-xs-6 col-sm-6 col-md-3 pull-right">
                        <a href="">
                            <article class="width article-product text-right pull-right mt">
                                <span><?php echo $value['company_name'] ?></span>
                                <p><?php echo $value['representation_name'] ?></p>
                            </article>
                        </a>
                    </div>
                <?php elseif ($list['export']['folder_name'] == "employment") : ?>
                    <?php foreach ($list['export']['list'] as $key => $value): ?>

                        <div class="col-xs-6 col-sm-6 col-md-4 pull-right">
                            <div class="innerContent content-detailP2 mb-double">
                                <a href="<?php echo  RELA_DIR . "employment/" . $value['Employment_id'] ?>">
                                    <article
                                            class="width article-product text-right pull-right mt  whiteBg boxBorder article-employment">
                                        <span class="mt"><?php echo $value['title'] ?></span>
                                        <p class="mt"><?php echo $value['description'] ?></p>
                                        <div class="width mb">
                                        <span class="education">

                                    تحصیلات:
                                        </span>
                                        <span>
                                        <?php echo $value['name'] ?>
                                        </span>
                                        </div>
                                        <div class="width">
                                        <span class="education">
                                    سابقه:
                                        </span>
                                        <span>
                                                 <?php echo $value['history'] ." سال "?>

                                        </span>
                                        </div>
                                        <button class="link-show-detail pull-left" href="">مشاهده بیشتر</button>
                                    </article>
                                </a>
                            </div>
                        </div>
                    <? endforeach; ?>
                <?php else: ?>
                    <div class="col-xs-6 col-sm-6 col-md-3 pull-left">
                        <div class="innerContent content-detailP mb-double-slick">
                            <div class="logoContainer-img-detail pull-right">
                                <a href="" class="single">
                                    <img class="width transition roundCorner boxBorder lazy"
                                         data-src="<?php echo(isset($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/' . $list['export']['folder_name'] . '/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                         alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-9 pull-right">
                        <a href="">
                            <article class="width article-product text-right pull-right mt">
                                <span><?php echo $value['title'] ?></span>
                                <p><?php echo $value['description'] ?></p>
                            </article>
                        </a>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
