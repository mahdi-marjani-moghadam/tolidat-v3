<?php include_once 'companyDetail_top.php'; ?>

<!---------------------- توضیحات ---------------------->
<div class="col-xs-12 col-sm-8 col-md-9 pull-left mb-double3">
    <div class="detail text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth company-information">
        <header><i class="fa fa-info-circle"></i> درباره <?php echo $list['side']['list']['company_name'] ?></header>
        <p class="text-regular text"><?php echo $list['side']['list']['description'] ?></p>

        <div class="row xxsmallSpace"></div>

        <?php
        $cnt = 0;
        foreach ($list['side']['branch_list'] as $branch) {
            if($cnt == 0) {
        ?>
            <div class="row noMargin">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <hr>

                    <div class="row xxxsmallSpace"></div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3 pull-right Border-contact">
                    <h2 title="ایمیل">ایمیل</h2>
                    <?php
                    if (count($branch['emails'])) {
                        ?>
                        <ul>
                            <?php foreach ($branch['emails'] as $email) { ?>
                                <li>
                                    <a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a>
                                    <?php //echo(count($branch['emails']) > 1 ? '<hr>' : ''); ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                        -
                        <?php
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3 pull-right Border-contact">
                    <h2 title="آدرس">آدرس</h2>
                    <?php
                    if (count($branch['addresses'])) {
                        ?>
                        <ul class="address-contact">
                            <?php
                            foreach ($branch['addresses'] as $address) {
                                ?>
                                <li>
                                    <?php echo $list['side']['province'].' - '.$address['address']; ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                        -
                        <?php
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3  pull-right Border-contact">
                    <h2 title="آدرس اینترنتی">آدرس اینترنتی</h2>
                    <?php
                    if (count($branch['websites'])) {
                        ?>
                        <ul>
                            <?php foreach ($branch['websites'] as $website) { ?>
                                <li>
                                    <a rel="nofollow" target="_blank"
                                       href="<?php echo 'http://' . $website['url'] ?>"><?php echo $website['url'] ?></a>
                                    <?php //echo(count($branch['websites']) > 1 ? '<hr>' : ''); ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                        -
                        <?php
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3  pull-right Border-contact">
                    <h2 title="تلفن">تلفن</h2>
                    <?php
                    if (count($branch['phones'])) {
                        ?>
                        <ul>
                            <?php foreach ($branch['phones'] as $phone) { ?>
                                <li>
                                    <?php echo $phone['code'] . $phone['number'] . " " . $phone['state'] . "  " . $phone['value'] ?>
                                    <?php //echo(count($branch['phones']) > 1 ? '<hr>' : ''); ?>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                        -
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row xxsmallSpace"></div>
        <?php
            $cnt++;
            }
        }
        ?>
    </div>
</div>

<?php if (isset($list['side']['product_list'])) : ?>
    <!---------------------- محصولات ---------------------->
    <div class="col-xs-12 col-sm-8 col-md-9 pull-left noPadding mb-double3">
        <div class="col-xs-12 col-sm-12 col-md-12 nonefloat">
            <div id="products"
                    class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
                <header><i class="fa fa-cubes"></i> محصولات/خدمات
                    <a href="<?php echo RELA_DIR . "product/all/" . $list['side']['list']['Company_id'] ?>"
                            class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    <a class="productList-grid transition displayBlock text-center active pull-left hidden-sm"><i
                                class="fa fa-th-large" aria-hidden="true"></i></a>
                    <a class="productList-list transition displayBlock text-center pull-left hidden-sm"><i
                                class="fa fa-list-ul" aria-hidden="true"></i></a>
                </header>
                <div class="content ltr">
                    <ul class="product-list grid-view text-center">
                        <?php
                        foreach ($list['side']['product_list'] as $id => $fields):
                            ?>
                            <li class="pull-right">
                                <div class="product-group transition">
                                    <a class="displayBlock"
                                            href="<?= RELA_DIR . 'product/show/' . $fields['Product_id'] . "/" . cleanUrl($fields['title']) ?>">
                                        <div class="product-item-img pull-right">
                                            <img data-title="محصولات"
                                                    class="transition lazy"
                                                    data-src="<?php echo(!empty($fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/150.150.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>"
                                                    alt="<?= " محصول " . $fields['brif_description']; ?>"
                                                    title="<?= $fields['title']; ?>">

                                            <span class="product-overlay transition"></span>
                                        </div>

                                        <div class="product-content pull-right rtl">
                                            <div class="text-right displayBlock displayBlock-content" title="<?php echo $fields['title'] ?>">
                                               <h2>
                                                  <?php echo $fields['title'] ?>
                                               </h2>
                                            </div>
                                            <p class="text-right text-justify"><?php echo $fields['brif_description'] ?></p>
                                            <span class="tag rtl text-right"><i class="pull-right fa fa-bars"></i><?= $fields['category_name'] ?></span>
                                            <button class="show-more btn button-default pull-left transition">توضیحات بیشتر
                                            </button>
                                        </div>
                                    </a>
                                    <div class="product-hash overlayCompany pull-right rtl">
                                        <div class="product-detail pull-right rtl">
                                            <span class="tag rtl text-right"><i
                                                        class="pull-right fa fa-bars"></i> <?= $fields['category_name'] ?></span>
                                        </div>
                                        <div class="tag rtl text-right">
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/کیاپردازش در تکاپوی مدیریت مدرن">#کیاپردازش در تکاپوی مدیریت مدرن</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/اتوماسیون ">#اتوماسیون </a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات اداری">#تجهیزات اداری</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات فروشگاهی">#تجهیزات فروشگاهی</a>
                                            <a href="<?php echo RELA_DIR ?>/search/type/تولیدی/q/تجهیزات رستورانی">#تجهیزات رستورانی</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                        endforeach;
                        ?>
                    </ul>

                    <br>

                    <a class="btn btn-link pull-left text-danger rtl btn-block text-left"
                            href="<?php echo RELA_DIR . "product/all/" . $list['side']['list']['Company_id'] ?>"><i
                                class="fa fa-external-link"></i> ادامه ... </a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!---------------------- فیچر ها ---------------------->
<div class="col-xs-12 col-sm-8 col-md-9 pull-left noPadding">
    <!---------------------- گواهی ها ---------------------->
    <?php /*if (isset($list['side']['certification_list'])) : ?>
        <?php if (count($list['certification_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double3">
                <div id="certifications"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-credit-card"></i> گواهی ها
                        <a href="<?php echo RELA_DIR . "certification/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['certification_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="گواهی ها"
                                             data-src="<?php echo(!empty($value['image']) ? IMAGES_RELA_DIR . '/certification/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' گواهی ' . $value['title']; ?>"
                                             title="<?= $value['title']; ?>">
                                    </div>
                                    <article class="text-light pull-right">
                                        <h4><?= $value['title'] ?></h4>
                                        <p class="text-justify"><?= $value['description'] ?></p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb-double3">
                <div id="certifications"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-credit-card"></i> گواهی ها
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['certification_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="گواهی ها" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? IMAGES_RELA_DIR . '/certification/' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' گواهی ' . $value['title']; ?>"
                                             title="<?= $value['title']; ?>">
                                    </div>
                                    <article class="text-light pull-right">
                                        <h4><?= $value['title'] ?></h4>
                                        <p class="text-justify"><?= $value['description'] ?></p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; */?>

    <!---------------------- سوابق مشتریان ---------------------->
    <?php if (isset($list['side']['history_list'])) : ?>
        <?php if (count($list['side']['history_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="history" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-users"></i> سوابق و مشتریان ما
                        <a href="<?php echo RELA_DIR . "history/all/" . $list['side']['list']['Company_id'] ?>"
                           class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['history_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/history/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' سابقه ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="history" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-users"></i> سوابق و مشتریان ما
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['history_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/history/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' سابقه ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- نام تجاری ---------------------->
    <?php if (isset($list['side']['commercialName_list'])) : ?>
        <?php if (count($list['side']['commercialName_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="commercialName"
                     class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header <?php echo $list['list']['Company_id']; ?>><i class="fa fa-briefcase"></i> نام تجاری
                        <a href="<?php echo RELA_DIR . "companyCommercialName/all/" . $list['side']['list']['Company_id']; ?>"
                           class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['commercialName_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' نام تجاری ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="commercialName"
                     class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header <?php echo $list['list']['Company_id']; ?>><i class="fa fa-briefcase"></i> نام تجاری
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['commercialName_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' نام تجاری ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- افتخارات ---------------------->
    <?php if (isset($list['side']['honour_list'])) : ?>
        <?php if (count($list['side']['honour_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="honours" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-trophy"></i> افتخارات
                        <a href="<?php echo RELA_DIR . "honour/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['honour_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy " data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/honour/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' افتخار ' . $value['title'] ?>"
                                             title="<?= $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="honours" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-trophy"></i> افتخارات
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['honour_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS .$value['company_id'] . '/honour/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' افتخار ' . $value['title'] ?>"
                                             title="<?= $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- مجوز ---------------------->
    <?php /*if (isset($list['side']['licence_list'])) : ?>
        <?php if (count($list['side']['licence_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="license" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-certificate"></i> مجوز
                        <a href="<?php echo RELA_DIR . "licence/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['licence_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS
                                                 . $value['company_id'] . '/licence/90.90.' . $value['image'] :
                                                 DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' مجوز ' . $value['title'] ?>" title="<?= $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="license" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-certificate"></i> مجوز
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['licence_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS
                                                 . $value['company_id'] . '/licence/90.90.' . $value['image'] :
                                                 DEFULT_LOGO_ADDRESS); ?>"
                                             alt="<?= ' مجوز ' . $value['title'] ?>" title="<?= $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif;*/ ?>

    <!---------------------- اخبار ---------------------->
    <?php if (isset($list['side']['news_list'])) : ?>
        <?php if (count($list['side']['news_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="news" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-rss"></i>اخبار <a href="<?php echo RELA_DIR . "companyNews/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['news_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/news/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>" alt="<?= ' خبر ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="news" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-rss"></i> اخبار
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['news_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/news/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>" alt="<?= ' خبر ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- نمایندگی ---------------------->
    <?php if (isset($list['side']['representation_list'])) : ?>
        <?php if (count($list['side']['representation_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="representation"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-building-o"></i>  نمایندگی
                        <a href="<?php echo RELA_DIR . "representation/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['representation_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                           <?= $value['representation_name'] ?>
                                            </h3>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="representation"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-building-o"></i>  نمایندگی
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['representation_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                           <?= $value['representation_name'] ?>
                                            </h3>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php// print_r_debug($list['side']);?>

    <!---------------------- شعب ---------------------->
    <?php if (isset($list['side']['branchs'])) : ?>
        <?php if (count($list['side']['branchs']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="employment" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-handshake-o"></i>شعب
                        <a href="<?php echo RELA_DIR . "representation/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['branchs'] as $key => $value): ?>
                            <div class="innerContent pull-right">
                                <article class="text-light pull-right title-detail">
                                    <div class="h4">
                                        <h3>
                                            <?= $value['branch_name'] ?>
                                        </h3>
                                    </div>
                                    <p class="text-justify">
                                        <span>
                                        <?= $value['maneger_name'] ?>
                                        </span>
                                    </p>
                                </article>
                             </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="employment" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-handshake-o"></i> شعب
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['branchs'] as $key => $value): ?>
                            <div class="innerContent pull-right">
                                <a class="single" href="<?= RELA_DIR . "branch/show/" . $value['Branch_id'] ?>">
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['branch_name'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['maneger_name'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- فرصت های شغلی ---------------------->
    <?php if (isset($list['side']['employment_list'])) : ?>
        <?php if (count($list['side']['employment_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="employment" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-handshake-o"></i> فرصت های شغلی
                        <a href="<?php echo RELA_DIR . "employment/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['employment_list'] as $key => $value): ?>
                            <div class="innerContent pull-right">
                                <a class="single" href="<?= RELA_DIR . "employment/show/" . $value['Employment_id'] ?>">
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="employment" class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-handshake-o"></i> فرصت های شغلی
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['employment_list'] as $key => $value): ?>
                            <div class="innerContent pull-right">
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!---------------------- آگهی ها ---------------------->
    <?php if (isset($list['side']['advertise_list'])) : ?>
        <?php if (count($list['side']['advertise_list']) > 1) : ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="commercialName"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-file-text-o"></i> آگهی ها
                        <a href="<?php echo RELA_DIR . "companyAdvertise/all/" . $list['side']['list']['Company_id'] ?>"
                                class="show-more btn button-default pull-left">مشاهده بیشتر</a>
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['advertise_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img class="boxBorder lazy" data-title="<?= $value['title'] ?>"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/advertise/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' آگهی ' . $value['title'] ?>">
                                    </div>
                                    <a class="single" href="<?php echo RELA_DIR . "companyAdvertise/show/" . $value['Advertise_id'] ?>">
                                        <article class="text-light pull-right title-detail">
                                            <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                            </div>
                                            <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                            </p>
                                        </article>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-6 pull-right mb-double3">
                <div id="commercialName"
                        class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header><i class="fa fa-file-text-o"></i> آگهی ها
                    </header>
                    <div class="content ltr content-detailP content-single carousel-vertical">
                        <?php foreach ($list['side']['advertise_list'] as $key => $value): ?>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-right noPadding">
                                <div class="innerContent pull-right">
                                    <div class="logoContainer-img logoContainer pull-right">
                                        <img data-title="<?= $value['title'] ?>" class="width boxBorder lazy"
                                             data-src="<?php echo(!empty($value['image']) ? COMPANY_ADDRESS .  $value['company_id'] . '/advertise/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>"
                                             title="<?= $value['title'] ?>"
                                             alt="<?= ' آگهی ' . $value['title'] ?>">
                                    </div>
                                    <article class="text-light pull-right title-detail">
                                        <div class="h4">
                                            <h3>
                                                <?= $value['title'] ?>
                                            </h3>
                                        </div>
                                        <p class="text-justify">
                                            <span>
                                            <?= $value['description'] ?>
                                            </span>
                                        </p>
                                    </article>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</div>

<!--------------------- کلمات کلیدی --------------------->
<?php if (isset($list['side']['meta_keyword']) && count($list['side']['meta_keyword'])) { ?>
    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12 overlayCompany keywords-container">
            <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                <header>کلمات کلیدی</header>
                <div class="content rtl content-detailP content-single" style="padding: .5em;">
                    <div class="tag">
                        <?php foreach ($list['side']['meta_keyword'] as $meta_keyword) { ?>
                            <a href="<?= $meta_keyword['link'] ?>">#<?php echo $meta_keyword['keyword'] ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- separator -->
            <div class="row xxxsmallSpace"></div>
        </div>
    </div>
<?php } ?>

<?php include_once 'companyDetail_bottom.php'; ?>
