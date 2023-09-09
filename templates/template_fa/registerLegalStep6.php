<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/styleprice.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/font-awesome.min.css">


<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/priceList.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery.animateNumber.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>




<div class="container mx-auto py-8 px-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>مرحله ۶ - انتخاب پکیج  </span></a>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="container noPadding container-register" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="shadow rounded-md overflow-hidden          boxContainer reg-container">
            <div class="registerPage center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">لطفا پکیج مورد نظر را انتخاب نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 6 از 7 </div>
                    </a>
                </div>

                <div class="p-3 sm:p-6         content">
                   

                    <div class="packageHolder hidden">
                        <h4 class="text-center">پکیح انتخابی شما : <span></span></h4>
                        <h5 class="text-center text-danger">در صورت مورد تأیید بودن پکیج مورد نظر، بر روی دکمه انتخاب کلیک نمایید</h5>
                    </div>


                    

                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-<?php echo count($list['packages']) ?> items-start md:gap-y-16 gap-x-4 container mx-auto">

                        <?php

                        foreach ($list['packages'] as $package) {
                            if ($package['englishTitle'] == 'bronze') {
                                $bgColor1 = 'yellow-600';
                                $bgColor2 = 'yellow-500';
                            } else if ($package['englishTitle'] == 'gold') {
                                $bgColor1 = 'yellow-300';
                                $bgColor2 = 'yellow-100';
                            } else if ($package['englishTitle'] == 'silver') {
                                $bgColor1 = 'gray-300';
                                $bgColor2 = 'gray-200';
                            } else {
                                $bgColor1 = 'gray-100';
                                $bgColor2 = 'gray-50';
                            }
                        ?>
                            <form action="/register/?step=7" method="post" name="form1" id="form<?php echo ($package['Package_id']) ?>" data-packagetype='<?php echo ($package['Package_id']) ?>' role="form" novalidate="novalidate" data-toggle="validator">
                                <input type="hidden" class="packagesList" value='<?php echo json_encode($list['packages']); ?>'>
                                <input class="packageType" name="package_type" type="hidden" value="<?php echo ($package['Package_id']) ?>">
                                <div class="w-full px-4 py-4 mt-6 shadow-lg bg- rounded-lg bg-gradient-to-r from-<?php echo $bgColor1 ?> via-<?php echo $bgColor2 ?> to-<?php echo $bgColor1 ?>">
                                    <div class="px-4 pt-6 pb-6">
                                        <div class="flex justify-center">
                                            <span class="inline-flex px-4 py-1 rounded-full text-xl leading-5 font-semibold tracking-wide uppercase">
                                                <?php echo $package['packagetype']; ?>
                                            </span>
                                        </div>
                                        <div class="mt-4 flex justify-center text-4xl leading-none font-extrabold">
                                            <?php if ((int)$package['price']) : ?>
                                                <?php echo number_format((int)$package['price'], 0); ?>
                                                <span class="pt-5 text-sm leading-8 font-medium text-gray-600">
                                                    <span>تومان / سالیانه</span>
                                                </span>
                                            <?php else : ?>

                                            <?php endif; ?>

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
                                        <!-- <li class="mb-3 flex items-center">
                                            <svg class="h-6 w-6 ml-2" xmlns="http://www.w3.org/2000/svg" width="6" height="6" stroke="currentColor" fill="green" viewBox="0 0 1792 1792">
                                                <path d="M1412 734q0-28-18-46l-91-90q-19-19-45-19t-45 19l-408 407-226-226q-19-19-45-19t-45 19l-91 90q-18 18-18 46 0 27 18 45l362 362q19 19 45 19 27 0 46-19l543-543q18-18 18-45zm252 162q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z">
                                                </path>
                                            </svg>
                                            کلمات کلیدی
                                        </li> -->
                                    </ul>

                                    <button type="submit" data-id="<?php echo $package['Package_id']; ?>" class="block text-center choosePkg <?php echo $package['englishTitle']; ?> w-full px-3 py-3 text-sm shadow rounded-lg text-white bg-tolidatColor hover:bg-orange-600 transition-colors duration-700 transform">
                                        انتخاب پکیج <?php echo $package['packagetype']; ?>
                                    </button>





                                </div>
                                <input name="step" type="hidden" value="7">
                                <input name="company_type" type="hidden" value="1">
                            </form>
                        <?php
                        }
                        ?>
                    </div>




                    <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="5">
                        <input name="company_type" type="hidden" value="1">
                        <button name="step2" type="submit" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
                            مرحله قبل
                        </button>
                    </form>
                </div>

                <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>
            </div>
        </div>
    </section>
    <p class="error"><?php echo $list['validate']['msg'] ?></p>
</div>







<script>
    $.iziToastError = function(msg) {
        iziToast.settings({
            onOpen: function(e) {}
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };
    $(function() {
        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content');
        }


        var packageType = parseInt(window.localStorage.getItem('packageType'));
        if(packageType != undefined & packageType != ''){
            $("#form"+packageType).submit();
            // console.log(packageType);
        }
    });

    $('.cart a').on('click', function() {
        var id = $(this).data('id');
        if (id == '0') {
            $('.reg-btn-n').empty().html('ثبت<span class="fa fa-angle-left"></span>');
        } else {
            $('.reg-btn-n').empty().html('مرحله بعد<span class="fa fa-angle-left"></span>');
        }
    });

    // var packageType = parseInt(window.localStorage.getItem('packageType')) + 2,
    //     activePackageColor = $('.table-price thead th:nth-child('+packageType+')').data('packagename'),
    //     activePackagefa = $('.table-price thead th:nth-child('+packageType+')').data('packagefa');

    // if(packageType !== null) {
    //     $('.packageHolder').removeClass('hidden');
    //     $('.packageHolder').find('span').html(activePackagefa).addClass(activePackageColor);


    //     $('.table-price tbody tr').each(function() {
    //         $(this).find('td:nth-child('+packageType+')').addClass('active '+activePackageColor);
    //     });
    // }
</script>