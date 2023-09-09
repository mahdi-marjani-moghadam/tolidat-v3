<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/styleprice.css">
<script                 src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.animateNumber.min.js"></script>
<script                 src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/priceList.js"></script>

<?php $notification = getNotification();
$information_company = getInformation(); ?>

<div class="container mx-auto py-8 px-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>"> <i class="fa fa-home" aria-hidden="true"></i> </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>تغییر پکیج</span></a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 mb-8">
    <form action="/invoice/add" method="post">
        <section class="container noPadding container-register">
            <div class="whiteBg boxBorder roundCorner clear fullWidth center-block">
                <input class="packageType" name="package_type" type="hidden" value="">

                <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-<?php echo count($list['packages'])?> items-center md:gap-y-16 gap-x-4">
                    <?php
                        foreach ($list['packages'] as $package) {
                        if($package['englishTitle'] == 'bronze') {
                            $bgColor1 = 'yellow-600';
                            $bgColor2 = 'yellow-500';
                        } else if($package['englishTitle'] == 'gold'){
                            $bgColor1 = 'yellow-300';
                            $bgColor2 = 'yellow-200';
                        }else if($package['englishTitle'] == 'silver'){
                            $bgColor1 = 'gray-300';
                            $bgColor2 = 'gray-200';
                        }else{
                            $bgColor1 = 'gray-100';
                            $bgColor2 = 'gray-50';
                        }

                    ?>

                        <div class="w-full px-4 py-4 mt-6 shadow-lg bg- rounded-lg bg-gradient-to-r from-<?php echo $bgColor1 ?> via-<?php echo $bgColor2?> to-<?php echo $bgColor1?>">
                            <div class="px-4 pt-6 pb-6">
                                <div class="flex justify-center">
                                    <span class="inline-flex px-4 py-1 rounded-full text-xl leading-5 font-semibold tracking-wide uppercase">
                                        <?php echo $package['packagetype']; ?>
                                    </span>
                                </div>
                                <div class="mt-4 flex justify-center text-4xl leading-none font-extrabold">
                                    <?php echo number_format((int)$package['price'], 0); ?>
                                    <span class="pt-5 text-sm leading-8 font-medium text-gray-600">
                                        <span>تومان / سالیانه</span>
                                    </span>
                                </div>
                            </div>
                            <p class="text-md mt-4">
                                امکانات:
                            </p>
                            <ul class="text-sm w-full mt-6 mb-6">
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    پروفایل شخصی
                                </li>
                                <li class="mb-3 flex items-center">
                                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7"><?php echo $package['category']; ?></span>
                                    دسته بندی
                                </li>
                                <li class="mb-3 flex items-center ">
                                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7"><?php echo $package['product']; ?></span>
                                    ماژول محصول / خدمات
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول سوابق و مشتریان
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول نام تجاری
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول افتخارات
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول اخبار و رویداد
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول نمایندگی / شعبه
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول فرصت های شغلی
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول آگهی ها
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    ماژول فرم تماس
                                </li>
                                <li class="mb-3 flex items-center">
                                    <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                        <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                        </path>
                                    </svg>
                                    کلمات کلیدی
                                </li>
                            </ul>

                            <div class="choose-button">
                               <button type="submit" 
                                data-id="<?php echo $package['Package_id']; ?>" 
                                class="block text-center btn btn-block choosePkg <?php echo $package['englishTitle']; ?> w-full px-3 py-3 text-sm shadow rounded-lg text-white bg-tolidatColor hover:bg-orange-600 transition-colors duration-700 transform">انتخاب پکیج <?php echo $package['packagetype']; ?></button> 
                            </div>
                            
                        </div>

                    <?php
                    }
                    ?>   
                </div>
            </div>
        </section>
    </form>
</div>