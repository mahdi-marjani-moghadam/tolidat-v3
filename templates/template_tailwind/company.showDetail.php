    <?php include_once 'companyDetail_top.php'; ?>
    <div class="lg:col-span-2">
        <!---------------------- توضیحات ---------------------->
        <div class="leading-relaxed">
            <div class="border-2 my-4 rounded bg-gray-50">
                <h2 class="p-3 border-b bg-gray-200"><i class="fa fa-info-circle"></i> درباره <?php echo $list['side']['list']['company_name'] ?></h2>
                <div class="detail p-3  text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth company-information">
                    <p class="text-regular text"><?php echo $list['side']['list']['description'] ?></p>

                    <?php
                    $cnt = 0;
                    foreach ($list['side']['branch_list'] as $branch) {
                        if ($cnt == 0) {
                    ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2  gap-1 mt-4">
                                <div class="border rounded p-2 bg-white ">
                                    <h2 class="text-tolidatColor" title="ایمیل">ایمیل</h2>
                                    <?php
                                    if (count($branch['emails'])) {
                                    ?>
                                        <ul>
                                            <?php foreach ($branch['emails'] as $email) { ?>
                                                <li>
                                                    <a href="mailto:<?php echo $email['email'] ?>"><?php echo $email['email'] ?></a>
                                                    <?php //echo(count($branch['emails']) > 1 ? '<hr>' : ''); 
                                                    ?>
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
                                <div class="border rounded p-2 bg-white">
                                    <h2 class="text-tolidatColor" title="آدرس">آدرس</h2>
                                    <?php
                                    if (count($branch['addresses'])) {
                                    ?>
                                        <ul class="address-contact">
                                            <?php
                                            foreach ($branch['addresses'] as $address) {
                                            ?>
                                                <li>
                                                    <?php echo $list['side']['province'] . ' - ' . $address['address']; ?>
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
                                <div class="border rounded p-2 bg-white">
                                    <h2 class="text-tolidatColor" title="آدرس اینترنتی">آدرس اینترنتی</h2>
                                    <?php
                                    if (count($branch['websites'])) {
                                    ?>
                                        <ul>
                                            <?php foreach ($branch['websites'] as $website) { ?>
                                                <li>
                                                    <a class="border border-tolidatColor rounded-full px-4 " rel="nofollow" target="_blank" href="<?php echo 'http://' . $website['url'] ?>"><?php echo $website['url'] ?> </a>
                                                    <?php //echo(count($branch['websites']) > 1 ? '<hr>' : ''); 
                                                    ?>
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
                                <div class="border rounded p-2 bg-white ">
                                    <h2 class="text-tolidatColor" title="تلفن">تلفن</h2>
                                    <?php
                                    if (count($branch['phones'])) {
                                    ?>
                                        <ul>
                                            <?php foreach ($branch['phones'] as $phone) { ?>
                                                <li>
                                                    <?php echo $phone['code'] . $phone['number'] . " " . $phone['state'] . "  " . $phone['value'] ?>
                                                    <?php //echo(count($branch['phones']) > 1 ? '<hr>' : ''); 
                                                    ?>
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
                    <?php
                            $cnt++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php if (isset($list['side']['product_list'])) : ?>
            <!---------------------- محصولات ---------------------->
            <div class="border-2 my-4 rounded bg-gray-50">
                <h2 class="border-b p-3 bg-gray-200 ">محصولات/خدمات</h2>

                <div id="products" class="px-3 pt-3 pb-2 text-header searchBox1 bestProduct  fullWidth container-product-Grouping productGrid">
                    <div class="content">
                        <ul class="product-list grid-view text-center grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <?php
                            foreach ($list['side']['product_list'] as $id => $fields) :
                            ?>
                                <li class="group ">
                                    <div class="product-group border p-2 rounded  bg-white ">

                                        <div class="product-item-img flex h-24 justify-center">
                                            <img data-title="محصولات" class="" loading='lazy' src="<?php echo (strlen($fields['image']) > 0 && file_exists(COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/product/150.150.' . $fields['image']) ? COMPANY_ADDRESS . $fields['company_id'] . '/product/150.150.' . $fields['image'] : DEFULT_PRODUCT_ADDRESS); ?>">
                                        </div>

                                        <div class="product-content pull-right rtl">
                                            <div class="text-right displayBlock displayBlock-content">
                                                <h3 class="text-tolidatColor">
                                                    <?php echo $fields['title'] ?>
                                                </h3>
                                            </div>

                                            <div class="tag rtl text-right  text-xs px-2 -mx-2 bg-gray-200 p-1 mb-2 leading-7 truncate ">
                                                دسته بندی: <span class="bg-white border-tolidatColor border rounded-full px-2"><?php echo  $fields['category_name'] ?></span>
                                            </div>

                                            <a href="<?php echo  RELA_DIR . 'product/show/' . $fields['Product_id'] . "/" . cleanUrl($fields['title']) ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0       ">
                                                <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5l7 7-7 7"></path>
                                                </svg>
                                                مشاهده بیشتر
                                            </a>

                                            <!-- <button class="show-more bg-tolidatColor text-white px-3 rounded-full">مشاهده بیشتر</button> -->
                                        </div>

                                    </div>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>

                        <a href="<?php echo RELA_DIR . "product/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block mt-2 py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">تمام محصولات</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!---------------------- فیچر ها ---------------------->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!---------------------- سوابق مشتریان ---------------------->
            <?php if (isset($list['side']['history_list'])) : ?>
                <?php if (count($list['side']['history_list']) > 1) : ?>
                    <div id="history" class="bg-gray-50 border-2 rounded">
                        <h2 class="p-3 border-b bg-gray-200">سوابق و مشتریان</h2>
                        <div class="p-3              content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['history_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/history/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/history/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' سابقه ' . $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "history/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="history" class="bg-gray-50 border-2 rounded             text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">سوابق و مشتریان </h2>
                        <div class="p-3               content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['history_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4        innerContent pull-left">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/history/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/history/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' سابقه ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' سابقه ' . $value['title'] ?>" class="w-20 h-20">

                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- نام تجاری ---------------------->
            <?php if (isset($list['side']['commercialName_list'])) : ?>
                <?php if (count($list['side']['commercialName_list']) > 1) : ?>
                    <div id="commercialName" class="bg-gray-50 border-2 rounded">
                        <h2 class="p-3 border-b bg-gray-200" <?php echo $list['list']['Company_id']; ?>> نام تجاری</h2>
                        <div class="p-3">
                            <?php foreach ($list['side']['commercialName_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/commercialName/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' نام تجاری ' . $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "companyCommercialName/all/" . $list['side']['list']['Company_id']; ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="commercialName" class="bg-gray-50 border-2 rounded           text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200" <?php echo $list['list']['Company_id']; ?>>نام تجاری</h2>
                        <div class="p-3        content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['commercialName_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/commercialName/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/commercialName/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' نام تجاری ' . $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- افتخارات ---------------------->
            <?php if (isset($list['side']['honour_list'])) : ?>
                <?php if (count($list['side']['honour_list']) > 1) : ?>
                    <div id="honours" class="bg-gray-50 border-2 rounded">
                        <h2 class="p-3 border-b bg-gray-200">افتخارات</h2>
                        <div class="p-3             content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['honour_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/honour/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/honour/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' افتخار ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "honour/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="border-2">
                        <div id="honours" class="bg-gray-50 border-2 rounded              text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                            <h2 class="p-3 border-b bg-gray-200">افتخارات</h2>
                            <div class="p-3         content ltr content-detailP content-single carousel-vertical">
                                <?php foreach ($list['side']['honour_list'] as $key => $value) : ?>
                                    <div class="flex gap-2 mb-4            innerContent pull-left">
                                        <img src="<?php echo (!empty($value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/honour/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' افتخار ' . $value['title'] ?>" title="<?php echo  $value['title'] ?>" class="w-20 h-20">
                                        <div class="text-light pull-right title-detail">
                                            <h3 class="font-bold mb-1 text-sm">
                                                <?php echo  $value['title'] ?>
                                            </h3>
                                            <p class="text-xs text-gray-700 text-justify">
                                                <?php echo  $value['description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- اخبار ---------------------->
            <?php if (isset($list['side']['news_list'])) : ?>
                <?php if (count($list['side']['news_list']) > 1) : ?>
                    <div id="news" class="bg-gray-50 border-2 rounded          text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">اخبار</h2>
                        <div class="p-3            leading-relaxed content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['news_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4              innerContent pull-right">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/news/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/news/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' خبر ' . $value['title'] ?>" class="w-20 h-20">

                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  readMore($value['description'], 160)  ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "companyNews/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="news" class="bg-gray-50 border-2 rounded       text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">اخبار</h2>
                        <div class="p-3            content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['news_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4            innerContent pull-right">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/news/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/news/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' خبر ' . $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- نمایندگی ---------------------->
            <?php if (isset($list['side']['representation_list'])) : ?>
                <?php if (count($list['side']['representation_list']) > 1) : ?>
                    <div id="representation" class="bg-gray-50 border-2 rounded      text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">نمایندگی</h2>
                        <div class="p-3         content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['representation_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4       innerContent pull-right">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['representation_name'] ?>
                                        </h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "representation/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="representation" class="bg-gray-50 border-2 rounded         text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">نمایندگی</h2>
                        <div class="p-3           content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['representation_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4        innerContent pull-right">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['representation_name'] ?>
                                        </h3>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php // print_r_debug($list['side']);
            ?>

            <!---------------------- شعب ---------------------->
            <?php if (isset($list['side']['branchs'])) : ?>
                <?php if (count($list['side']['branchs']) > 1) : ?>
                    <div id="employment" class="bg-gray-50 border-2 rounded        text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">شعب</h2>
                        <div class="p-3              content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['branchs'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['branch_name'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['maneger_name'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "representation/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="employment" class="bg-gray-50 border-2 rounded           text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">شعب</h2>
                        <div class="p-3          content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['branchs'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <a class="single" href="<?php echo  RELA_DIR . "branch/show/" . $value['Branch_id'] ?>">
                                        <div class="">
                                            <h3 class="font-bold mb-1 text-sm">
                                                <?php echo  $value['branch_name'] ?>
                                            </h3>
                                            <p class="text-xs text-gray-700 text-justify">
                                                <?php echo  $value['maneger_name'] ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- فرصت های شغلی ---------------------->
            <?php if (isset($list['side']['employment_list'])) : ?>
                <?php if (count($list['side']['employment_list']) > 1) : ?>
                    <div id="employment" class="bg-gray-50 border-2 rounded        text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">فرصت های شغلی</h2>
                        <div class="p-3              content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['employment_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <a class="single" href="<?php echo  RELA_DIR . "employment/show/" . $value['Employment_id'] ?>">
                                        <div class="">
                                            <h3 class="font-bold mb-1 text-sm">
                                                <?php echo  $value['title'] ?>
                                            </h3>
                                            <p class="text-xs text-gray-700 text-justify">
                                                <?php echo  $value['description'] ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "employment/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="employment" class="bg-gray-50 border-2 rounded           text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">فرصت های شغلی</h2>
                        <div class="p-3          content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['employment_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4">
                                    <div class="">
                                        <h3>
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!---------------------- آگهی ها ---------------------->
            <?php if (isset($list['side']['advertise_list'])) : ?>
                <?php if (count($list['side']['advertise_list']) > 1) : ?>
                    <div id="commercialName" class="bg-gray-50 border-2 rounded             text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">آگهی ها</h2>
                        <div class="p-3          content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['advertise_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4       innerContent pull-right">
                                    <a class="p-2   single" href="<?php echo RELA_DIR . "companyAdvertise/show/" . $value['Advertise_id'] ?>">
                                        <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT . $value['company_id'] . '/advertise/90.90.' . $value['image']) ? COMPANY_ADDRESS . $value['company_id'] . '/advertise/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' آگهی ' . $value['title'] ?>" class="w-20 h-20">
                                        <div class="">
                                            <h3 class="font-bold mb-1 text-sm">
                                                <?php echo  $value['title'] ?>
                                            </h3>
                                            <p class="text-xs text-gray-700 text-justify">
                                                <?php echo  $value['description'] ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="px-3 pb-2">
                            <a href="<?php echo RELA_DIR . "companyAdvertise/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div id="commercialName" class="bg-gray-50 border-2 rounded           text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                        <h2 class="p-3 border-b bg-gray-200">آگهی ها</h2>
                        <div class="p-3           content ltr content-detailP content-single carousel-vertical">
                            <?php foreach ($list['side']['advertise_list'] as $key => $value) : ?>
                                <div class="flex gap-2 mb-4       innerContent pull-right">
                                    <img src="<?php echo (!empty($value['image']) && file_exists(COMPANY_ADDRESS_ROOT .  $value['company_id'] . '/advertise/90.90.' . $value['image']) ? COMPANY_ADDRESS .  $value['company_id'] . '/advertise/90.90.' . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" title="<?php echo  $value['title'] ?>" alt="<?php echo  ' آگهی ' . $value['title'] ?>" class="w-20 h-20">
                                    <div class="">
                                        <h3 class="font-bold mb-1 text-sm">
                                            <?php echo  $value['title'] ?>
                                        </h3>
                                        <p class="text-xs text-gray-700 text-justify">
                                            <?php echo  $value['description'] ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <style>
            .rating {
                display: flex;
                align-items: center;
            }

            .rating input {
                border: 0;
                width: 1px;
                height: 1px;
                overflow: hidden;
                position: absolute !important;
                clip: rect(1px 1px 1px 1px);
                clip: rect(1px, 1px, 1px, 1px);
                opacity: 0;
            }

            .rating label {
                float: right;
                color: #c8c8c8;
            }

            .rating label:before {
                content: "★";
                display: inline-block;
                font-size: 2em;
                color: #ccc;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            .rating input:checked~label:before {
                color: #ffc107;
            }

            .set-comment .rating label:hover~label:before {
                color: #ffdb70;
            }

            .set-comment .rating label:hover:before {
                color: #ffc107;
            }
        </style>
        <div class="border-2 my-4 rounded bg-gray-50">
            <h2 class="border-b p-3 bg-gray-200 ">نظرات</h2>
            <div class="content ltr">

                <div class="w-full p-4 show-comment">


                    <?php if (isset($list['side']['comment_list'])) :
                        if (is_array($list['side']['comment_list'])) {
                    ?>

                            <?php foreach ($list['side']['comment_list'] as $date => $value) : ?>
                                <div class="border-b mb-2">


                                    <div class="d-flex flex justify-between pb-3 text-xs text-gray-400">
                                        <span> 
                                            <?php echo convertDate($value['date']) ?>, 
                                            <?php echo $value['user_name'] ?> 
                                        </span>
                                        <span class="inline-block">
                                            <div class="rating">
                                                <span>امتیاز: </span>
                                                <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st1<?php echo $value['Survey_id'] ?>" value="5" <?php echo ($value['rate'] == 5) ? "checked" : "" ?> />
                                                <label for="st1<?php echo $value['Survey_id'] ?>" title="عالی"></label>
                                                <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st2<?php echo $value['Survey_id'] ?>" value="4" <?php echo ($value['rate'] == 4) ? "checked" : "" ?> />
                                                <label for="st2<?php echo $value['Survey_id'] ?>" title="خوب"></label>
                                                <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st3<?php echo $value['Survey_id'] ?>" value="3" <?php echo ($value['rate'] == 3) ? "checked" : "" ?> />
                                                <label for="st3<?php echo $value['survey_id'] ?>" title="معمولی"></label>
                                                <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st4<?php echo $value['Survey_id'] ?>" value="2" <?php echo ($value['rate'] == 2) ? "checked" : "" ?> />
                                                <label for="st4<?php echo $value['Survey_id'] ?>" title="ضعیف"></label>
                                                <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st5<?php echo $value['Survey_id'] ?>" value="1" <?php echo ($value['rate'] == 1) ? "checked" : "" ?> />
                                                <label for="st5<?php echo $value['Survey_id'] ?>" title="بد"></label>
                                                <span id="rating-hover-label"></span>
                                            </div>
                                        </span>
                                    </div>

                                    <div class="text-sm">
                                        <p><?php echo $value['comment'] ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php
                        } else { ?>
                            <div class="container mx-auto mt-10 px-4 text-center">
                                <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['comment_list'] ?></h3>
                            </div>
                    <?php }
                    endif;
                    ?>
                <a href="<?php echo RELA_DIR . "survey/all/" . $list['side']['list']['Company_id'] ?>" class="inline-block mt-2 py-1 px-2 border border-transparent text-sm font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">ارسال نظر</a>
                </div>
            </div>

        </div>
    </div>
    </div>

    <!--------------------- کلمات کلیدی --------------------->
    <?php if (isset($list['side']['meta_keyword']) && count($list['side']['meta_keyword'])) { ?>
        <div class="container mx-auto my-3 py-3 px-4">
            <div class="  border-t pt-3  overlayCompany keywords-container">
                <div class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth">
                    <header>کلمات کلیدی</header>
                    <div class="content rtl content-detailP content-single mt-2">
                        <div class="tag flex gap-2 flex-wrap">
                            <?php foreach ($list['side']['meta_keyword'] as $meta_keyword) { ?>
                                <a class="border border-tolidatColor px-2 text-sm  rounded-full" href="<?php echo  $meta_keyword['link'] ?>">#<?php echo $meta_keyword['keyword'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php include_once 'companyDetail_bottom.php'; ?>