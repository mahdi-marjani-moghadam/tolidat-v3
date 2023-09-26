<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/index.css">
<div class="boxContainer home-page mainPage mt">

    <section class="row fullPadding intro">
        <div class=" col-xs-12 col-sm-12 col-md-12 mb pull-right">
            <div>
                <h1>چگونه کسب و کار خود را به مشتریانتان معرفی می نمایید؟</h1>
                <p class="bold">پلتفرم تولیدات فضای لازم و مناسبی برای صاحبان مشاغل فراهم می نماید که بتوانند خود را به بازار هدف خود معرفی کنند</p>

                <p>با وارد کردن اطلاعات محصول و یا خدمات خود(عکس، متن، ...) میتوانید علاوه بر کسب رتبه، در سایت گوگل بهتر دیده شوید</p>
                <a href="<?php echo RELA_DIR ?>register" class="btn btn-success  register-button">همین حالا شروع کنید </a>

            </div>
        </div>
    </section>

    <div class="row xsmallSpace"></div>

    <div>
        <div class=" col-xs-12 col-sm-12 col-md-12 mb pull-right">
            <h2>افزایش رتبه سایت با تولیدات</h2>
            <div>
                اگر شما جزو کسانی هستید که سایت دارید، حتما براتون این سوال پیش اومده که چطوری می­شه تو رتبه بندی گوگل رتبه ی یک رو به دست بیارید.
                ممکنه نرم­افزارهای بالا بردن رتبه­ی سایت رو امتحان کرده باشید و یا مبالغ نسبتا زیادی رو بابت این موضوع هزینه کرده باشید.
                راه­های زیادی برای بالا بردن سایتتون وجود داره که ممکنه زمان بر باشه و یا هزینه ی زیادی داشته باشه.
            </div>
            <h3>حالا راه حل چیه؟</h3>
            <div>
            خیلی ساده­ست. کافیه که شما در سایت تولیدات ثبت نام کنید و اطلاعات محصول  و خدماتتون رو وارد کنید.
            تولیدات با داشتن نیروهای متخصص سئو و استفاده از تکنیک­های خاصی رتبه ی بالایی در پیج رنک گوگل دارد و شما هم می­تونید همراه ما باشید.
             ثبت نام در سایت تولیدات رایگان است و بعد از ثبت نام شما می­تونید
              بر اساس هدفتون  با پرداخت هزینه­ی کمی پکیج­های تجاری تولیدات رو انتخاب کنید و از خدماتش استفاده کنید.
            </div>
        </div>
    </div>

    <div class="row xsmallSpace"></div>

    <div class="container-slider-main whiteBg boxBorder">
        <div class="grid-stack mb">
            <div class="grid-stack-item" data-gs-x="0" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['0']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['0']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['0']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['0']['image_1']; ?>" alt="<?php echo $list['category_list']['0']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['0']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="2" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['1']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['1']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['1']['Category_id'] . "/level/2"  ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['1']['image_1']; ?>" alt="<?php echo $list['category_list']['1']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['1']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="4" data-gs-y="0" data-gs-width="4" data-gs-height="4">
                <?php if (!isset($list['bannerExhibition'])) : ?>
                    <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['2']['image_2']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['2']['image_4']; ?>" style="background: url('<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['2']['image_4']; ?>') right center no-repeat; background-size: cover;">
                        <a style=" color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['2']['Category_id'] . "/level/2" ?>">
                            <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['2']['image_4']; ?>" alt="<?php echo $list['category_list']['2']['title']; ?>">
                            <span class="title-product">
                                <?php echo  $list['category_list']['2']['title'] ?>
                            </span>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="grid-stack-item-content" data-content="" data-replace="" style="background: url('<?php echo IMAGES_RELA_DIR . 'banner/exhibition/' . $list['bannerExhibition']['image']; ?>') right center no-repeat; background-size: cover;">
                        <a style=" color: white" href="">
                            <!--                            <img src="--><?php //echo IMAGES_RELA_DIR.'banner/exhibition/' . $list['bannerExhibition']['image'];
                                                                            ?>
                            <!--" alt="--><? //= $list['bannerExhibition']['description']
                                            ?>
                            <!--">-->
                            <span class="title-product">
                                <?php echo  $list['bannerExhibition']['description'] ?>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="grid-stack-item" data-gs-x="8" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['3']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['3']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['3']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['3']['image_1']; ?>" alt="<?php echo $list['category_list']['3']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['3']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="10" data-gs-y="0" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['4']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['4']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['4']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['4']['image_1']; ?>" alt="<?php echo $list['category_list']['4']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['4']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="0" data-gs-y="2" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['5']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['5']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['5']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['5']['image_1']; ?>" alt="<?php echo $list['category_list']['5']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['5']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="2" data-gs-y="2" data-gs-width="2" data-gs-height="4">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['6']['image_3']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['6']['image_3']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['6']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['6']['image_3']; ?>" alt="<?php echo $list['category_list']['6']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['6']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="0" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['7']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['7']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['7']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['7']['image_1']; ?>" alt="<?php echo $list['category_list']['7']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['7']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="4" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['8']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['8']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['8']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['8']['image_1']; ?>" alt="<?php echo $list['category_list']['8']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['8']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="6" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['9']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['9']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['9']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['9']['image_1']; ?>" alt="<?php echo $list['category_list']['9']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['9']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item " data-gs-x="8" data-gs-y="2" data-gs-width="4" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['10']['image_2']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['10']['image_2']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['10']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['10']['image_2']; ?>" alt="<?php echo $list['category_list']['10']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['10']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="8" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['11']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['11']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['11']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['11']['image_1']; ?>" alt="<?php echo $list['category_list']['11']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['11']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>
            <div class="grid-stack-item" data-gs-x="10" data-gs-y="4" data-gs-width="2" data-gs-height="2">
                <div class="grid-stack-item-content" data-content="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['12']['image_1']; ?>" data-replace="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['12']['image_1']; ?>">
                    <a style="color: white" href="<?php echo RELA_DIR . "category/all/" . $list['category_list']['12']['Category_id'] . "/level/2" ?>">
                        <img src="<?php echo RELA_DIR . 'statics/images/category/' . $list['category_list']['12']['image_1']; ?>" alt="<?php echo $list['category_list']['12']['title']; ?>">
                        <span class="title-product">
                            <?php echo  $list['category_list']['12']['title'] ?>
                        </span>
                    </a>
                </div>
            </div>

        </div>
        <div class="container-show-all-category-main">
            <a href="<?php echo  RELA_DIR . "category/all" ?>" class="btn btn-block button-default show-more show-all-category-main text-center">نمایش همه دسته بندی ها</a>
        </div>

        <div class="row xxxsmallSpace"></div>

    </div>

    <!-- separator -->
    <div class="row xsmallSpace"></div>

    <div class="row fullPadding">
        <div class="col-xs-12 col-sm-12 col-md-12 mb pull-right">

            <h2> چگونه بفروشیم وقتی مشتری نیست؟</h2>

            <div>
                ممکنه شما جزو افرادی باشید که مدتیه که کسب و کار خودتون رو دارید و موفق هم بوده باشید و الان تصمیم دارید مشتری­های بیشتری رو جذب کنید
                و یا شاید اصلا تازه کسب و کارتون رو راه انداختین ونگران این موضوع هستین
                که چطور محصول و خدمات خودتون رو به مشتری معرفی کنید و اونهارو به سمت خودتون جذب کنید.
                ممکنه حتی شما نسبت به بقیه رقبا مزیتی داشته باشید و دوست دارید که بقیه هم از این مساله باخبر باشند.
            </div>
            <div class="row xxxsmallSpace"></div>
            <div>
                سایت تولیدات محیطی رو براتون فراهم کرده که شما عزیزان می­تونید بدون نیاز به تخصص خاصی با عضویت در این پلتفرم،
                با داشتن پروفایل شخصی خودتون محصولتون رو معرفی کنید. با عضویت در تولیدات محصول شما در یک نمایشگاه دائمی وجود دارد که علاوه بر دیده شدن محصولتون،
                شرایط مقایسه­ی محصول و خدمات با محصول و خدمات دیگر همکاران شما، قدرت انتخاب بیشتری را نیز به مشتری می­دهد.
            </div>
        </div>
    </div>


    <div class="row xsmallSpace"></div>


    <div class="row fullPadding">
        <?php if ($list['company_list']) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 mb pull-right">
                <div class="text-right header-title mb-half">
                    <span>تولیدکنندگان برتر</span><span></span>
                </div>
                <div id="Manufacturers" class="text-header bestProduct fullWidth new-manufacturers">
                    <div class="content Manufacturers ltr">
                        <?php foreach ($list['higher_company'] as $item => $value) : ?>
                            <a class="single" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                <div class="item text-center roundCorner boxBorder">
                                    <div class="item-content whiteBg">
                                        <div class="logoContainer pull-right">
                                            <h2 class="text-right rtl"><?php echo  $value['company_name'] ?></h2>
                                        </div>
                                        <div class="content pull-right">
                                            <div class="item-Money">
                                                <span class="package-silver"><i class="fa fa-trophy" aria-hidden="true"></i> </span>
                                                <span><?php echo  $value['information']['package_type'] ?></span>
                                            </div>
                                            <?php
                                            if ((int)$value['information']['product_count']) {
                                            ?>
                                                <div class="item-product">
                                                    <span><i class="fa fa-cubes" aria-hidden="true"></i> </span>
                                                    <span>&nbsp;<?php echo  $value['information']['product_count']; ?>&nbsp;</span>
                                                    <span> محصول</span>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="item-verify">
                                                <span><i class="fa fa-check-square-o" aria-hidden="true"></i> </span>
                                                <span>تایید شده توسط تولیدات</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-Percent mt">
                                        <ul class="">
                                            <?php foreach ($value['company_product'] as $key => $fields) : ?>
                                                <li>
                                                    <img title="<?php echo  $fields['title'] ?>" alt="<?php echo  ' محصول ' . $fields['brif_description'] ?>" class="roundCorner fullWidth boxBorder" data-lazy="<?php echo ($fields['image'] ? COMPANY_ADDRESS . $fields['company_id'] . "/product/100.100." . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>">
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="content-circular-process center-block roundCornerFull">
                                            <input type="text" value="<?php echo $value['priority'] ?>" class="dial"><span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="row fullPadding">
        <?php if ($list['company_list']) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 mb pull-right">
                <div class="text-right header-title mb-half mt">
                    <span> تولیدکنندگان جدید</span> <span></span>
                </div>
                <div id="bestProduct" class="text-header bestProduct whiteBg boxBorder roundCorner fullWidth new-manufacturers new-manufacturers1 mb">
                    <div class="content carousel-slick ltr">
                        <?php foreach ($list['company_list'] as $item => $value) { ?>
                            <a class="single" href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                                <div class="item text-center">
                                    <div class="logoContainer pull-right">
                                        <?php
                                        $file = ROOT_DIR . ltrim($value['image'], '/');
                                        ?>
                                        <img data-lazy="<?php echo (isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/122.125." . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder-logo.png'); ?>" class="boxBorder roundCorner" alt="<?php echo  " لوگوی " . $value['company_name'] ?>" title="<?php echo  $value['company_name']; ?>">
                                    </div>
                                    <div class="content pull-right mt">
                                        <div class="text-right header">
                                            <h3 class="rtl">
                                                <?php echo (strlen($value['company_name']) ? $value['company_name'] : '-'); ?>
                                            </h3>
                                        </div>
                                        <footer>
                                            <p class="text-right text-justify">
                                                <?php echo (strlen($value['description']) ? $value['description'] : '-'); ?>
                                            </p>
                                        </footer>
                                    </div>
                                    <div class="footer-Percent">
                                        <ul class="">
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="تأیید شده توسط تولیدات"><i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            </li>
                                            <?php
                                            if ((int)$value['information']['product_count']) {
                                            ?>
                                                <li class="<?php echo ($value['information']['product_count'] == 0 ? 'disabled' : ''); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo ($value['information']['product_count'] != 0 ? $value['information']['product_count'] . ' محصول معرفی شده' : 'بدون محصول'); ?>">
                                                    <i class="fa fa-cubes" aria-hidden="true"></i>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($value['information']['package_type'] != 'ندارد') {
                                            ?>
                                                <li class="<?php echo (!$value['information']['package_class'] ? 'disabled' : $value['information']['package_class']); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo ($value['information']['package_type'] ? 'پکیج ' . $value['information']['package_type'] : 'رایگان'); ?>">
                                                    <i class="fa fa-trophy" aria-hidden="true"></i>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $value['information']['personality_type'] ?>">
                                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                            </li>
                                        </ul>
                                        <div class="content-circular-process center-block roundCornerFull">
                                            <input type="text" value="<?php echo $value['priority'] ?>" class="dial"><span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="row xxxsmallSpace"></div>

    <div class="row fullPadding">


        <?php if (isset($list['news_list'])) { ?>
            <div class="col-xs-12 col-sm-4 col-md-4 pull-right newsColumn">
                <div class="text-right header-title mb-half mt">
                    <a href="<?php echo  RELA_DIR . "article" ?>"><span>مقالات</span></a><span></span>
                </div>
                <div class="text-header vertical bestProduct whiteBg boxBorder roundCorner fullWidth container-article mb">
                    <div id="articles" class="content carousel-vertical news-tolidat content1 ltr slick-button">
                        <?php foreach ($list['articles_list'] as $id => $field) { ?>
                            <a class="single" href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] ?>">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer pull-right">
                                        <img class="roundCorner fullWidth boxBorder" data-lazy="<?php echo (isset($field['image']) ? STATIC_RELA_DIR . '/images/article/90.90.' . $field['image'] : DEFULT_LOGO_ADDRESS) ?>" alt="<?php echo  $field['brif_description'] ?>" title="<?php echo  $field['title']; ?>">
                                    </div>
                                    <div class="text-right rtl text-light h2" title="<?php echo  $field['title'] ?>">
                                        <h4>
                                            <?php echo (strlen($field['title']) ? $field['title'] : "") ?>
                                        </h4>
                                    </div>
                                    <div class="text-right text-light rtl article">
                                        <p>
                                            <?php echo (strlen($field['description']) ? $field['description'] : "") ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-xs-12 col-sm-4 col-md-4 pull-right newsColumn">
                <div class="supporters bestProduct Advertising newsContainer2 whiteBg boxBorder roundCorner fullWidth text-header">
                    <header>
                        <div class="center-block text-right">
                            <a class="pointer" href="<?php echo RELA_DIR; ?>news"></a>مقالات
                        </div>
                    </header>
                </div>
            </div>
        <?php } ?>

        <?php if (isset($list['events_list'])) { ?>
            <div class="col-xs-12 col-sm-4 col-md-4 pull-right newsColumn">
                <div class="text-right header-title mb-half mt">
                    <span><a href="/event" style="color: #555; font-weight: 400; font-size: 18px; display: block; float: right; height: 100%; line-height: 25px; padding-left: 20px;">رویدادها</a></span>
                    <span></span>
                </div>
                <div class="text-header vertical bestProduct whiteBg boxBorder roundCorner fullWidth container-news">
                    <div id="news" class="content carousel-vertical news-tolidat content1 ltr slick-button">
                        <?php foreach ($list['events_list'] as $id => $field) { ?>
                            <a class="single" href="<?php echo  RELA_DIR . 'event/' . $field['event_id']; ?>">
                                <div class="innerContent pull-left">
                                    <div class="logoContainer pull-right">
                                        <img class="roundCorner fullWidth boxBorder" data-lazy="<?php echo (isset($field['icon']) ? STATIC_RELA_DIR . '/images/event/90.90.' . $field['icon'] : DEFULT_LOGO_ADDRESS) ?>" alt="<?php echo  $field['brief_description'] ?>" title="<?php echo  $field['title']; ?>">
                                    </div>
                                    <div class="text-right rtl text-light h2" title="<?php echo  $field['title'] ?>">
                                        <h4>
                                            <?php echo (strlen($field['title']) ? $field['title'] : "") ?>
                                        </h4>
                                    </div>
                                    <div class="text-right text-light rtl article">
                                        <p>
                                            <?php echo (strlen($field['brief_description']) ? $field['brief_description'] : "") ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-xs-12 col-sm-4 col-md-4 pull-right newsColumn">
                <div class="supporters bestProduct Advertising newsContainer2 whiteBg boxBorder roundCorner fullWidth text-header">
                    <header>
                        <div class="center-block text-right">
                            <a class="pointer" href="<?php echo RELA_DIR; ?>news"></a>رویدادها
                        </div>
                    </header>
                </div>
            </div>
        <?php } ?>
        <div class="row xxsmallSpace"></div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt">
            <div class="text-right header-title mb">
                <p> درباره تولیدات</p> <span></span>
            </div>
            <div class="text-header whiteBg boxBorder roundCorner fullWidth supporters-box mb">
                <div class="content">
                    <p>
                        تولیدات مرجع جامع کلیه اصناف کشور است که چشم انداز کوتاه مدت فعالیت در عرصه بین الملل را دارد.
                        مرجع تولیدات برای هر کسب و کار یک پلتفرم هوشمند آماده کرده است تا بتوانند کلیه اطلاعات قابل ارائه به بازار هدف خود را در آن درج نموده و از امکانات SEO این سایت بهره مند شده و در موتور های جستجو رتبه بالاتری از طریق درگاه تولیدات کسب کنند. این پلتفرم و یا همان پروفایل اختصاصی افراد اطلاعات آنان را در منوهای جداگانه به کاربران عرضه می کند.
                        اطلاعات اعضا در دسته بندی های مجزا جهت مشاهده سایرین طبقه بندی شده است که این اطلاعات بر اساس شهر-استان و نیز زمینه فعالیت قابلیت فیلتر کردن و جستجو دارد.
                        <a class="colorBoronz" href="<?php echo RELA_DIR; ?>aboutus" name="about" title="درباره ما">بیشتر بدانید</a>
                    </p>
                </div>

            </div>
            <div class="row xxsmallSpace center-block"></div>
        </div>

    </div>

</div>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.knob.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/slick.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/lodash.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/gridstack.js"></script>
<script>
    function changeGridImage() {
        var windowWidth = $(window).width(),
            $imgHolder = $(this).find('.grid-stack-item-content');
        if (windowWidth <= 768) {
            var imgMobile = $imgHolder.data('content');

            $('.grid-stack-item').each(function() {
                $imgHolder.css('background', 'url("' + imgMobile + '") right center no-repeat');
            });
        } else {
            var imgDesktop = $imgHolder.data('replace');

            $('.grid-stack-item').each(function() {
                $imgHolder.css('background', 'url("' + imgDesktop + '") right center no-repeat');
            });
        }
    }

    $(window).on('load', function() {
        $.ajax({
            url: "/index/event/",
            type: 'get',
            success: function(data) {
                var response = $.parseJSON(data);

                if (response.title != 'no event') {
                    var html = '';
                    $.each(response, function(key, value) {
                        if (value.title !== undefined) {
                            html +=
                                '<a class="single" href="' + value.link + '">' +
                                '<div class="innerContent pull-left">' +
                                '<div class="text-right rtl text-light title-event" title="' + value.title + '">' + value.title + '</div>' +
                                '<article class="text-right text-light rtl report-event">' +

                                '</article>' +
                                '</div>' +
                                '</a>';
                        }
                    });

                    $('#events').html(html);
                } else {
                    var image = '<img src="<?php echo DEFULT_LOGO_ADDRESS ?>">';
                    $("#events").html(image);
                }

                $('#events').slick({
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    infinite: true,
                    autoplay: true,
                    vertical: true,
                    verticalSwiping: true,
                    responsive: [{
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 560,
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
            }
        });

        $('#articles,#news').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            infinite: true,
            vertical: true,
            verticalSwiping: true,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 560,
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
        // تولیدکنندگان جدید
        $('.carousel-slick').slick({
            dots: false,
            infinite: true,
            speed: 300,
            autoplay: true,
            slidesToShow: 5,
            rows: 1,
            slidesToScroll: 1,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 1115,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 560,
                    settings: {
                        slidesToShow: 2,
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

        // تولیدکنندگان برتر
        $('.Manufacturers').slick({
            dots: false,
            infinite: true,
            speed: 300,
            autoplay: true,
            slidesToShow: 4,
            rows: 1,
            slidesToScroll: 1,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 1115,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 560,
                    settings: {
                        slidesToShow: 2,
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

        $('.grid-stack').gridstack({
            disableDrag: true,
            disableResize: true
        });

        changeGridImage();
    });

    $(window).on('resize', function() {
        changeGridImage();
    });
</script>