<!-- <link rel="stylesheet" href="< ?php echo RELA_DIR . 'templates/template_fa'; ?>/bower_components/font-awesome/css/font-awesome.min.css"> -->

<div class="row noMargin bg-gray-100 text-gray-500 text-sm p-1">
    <div class="container mx-auto px-4">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>"> <i class="fa fa-home" aria-hidden="true"></i> </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>لیست تعرفه پکیج ها</span></a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4">

    <!-- <link rel="stylesheet" href="< ?php echo RELA_DIR; ?>templates/template_fa/assets/css/styleprice.css"> -->
    <!-- <script src="< ?php echo RELA_DIR; ?>templates/template_fa/assets/js/jquery.animateNumber.min.js"></script> -->
    <!-- <script src="< ? php echo RELA_DIR; ?>templates/template_fa/assets/js/priceList.js"></script> -->
    <!-- < ?php $notification = getNotification(); -->
    <!-- $information_company = getInformation(); ?> -->

    <div class="boxContainer reg-container containerNew whiteBg boxBorder roundCorner pack ">
        <div class="table-responsive center-block paddingRl no-border" style="max-width: 950px !important;">
            <?php /* <table class="table table-bordered table-striped table-price">
                <thead>
                    <tr style="height: 70px;">
                       
                        <?php
                        foreach ($list['packages'] as $package) {
                        ?>
                            <th class="package text-white text-center <?php echo $package['englishTitle'] ?>"><?php echo $package['packagetype']; ?></th>
                        <?php
                        }
                        ?>  
                    </tr>
                </thead>
                <tbody>
                   
                  
                    <tr>
                        <td rowspan="2" class="text-right text-danger text-bold" style="vertical-align: middle">قیمت نهایی (ریال)</td>
                        <?php
                        foreach ($list['packages'] as $package) {
                        ?>
                            <td class="text-center text-danger text-bold"><?php echo number_format((int)$package['price'], 0); ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr class="choose-button">
                        <td class="text-center">
                            <a href="<?php echo RELA_DIR . 'register'; ?>" data-id="0" type="submit" class="btn btn-default btn-block free choosePkg">انتخاب پکیج رایگان</a>
                        </td>
                        <?php
                        foreach ($list['packages'] as $package) {
                        ?>
                            <td class="text-center">
                                <a href="<?php echo RELA_DIR . 'register'; ?>" data-id="<?php echo $package['Package_id']; ?>" class="btn btn-block white-color choosePkg <?php echo $package['englishTitle']; ?>">انتخاب پکیج <?php echo $package['packagetype']; ?></a>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            */ ?>
        </div>
    </div>
</div>


<input type="hidden" class="packagesList" value='<?php echo json_encode($list['packages']); ?>'>

<div class="bg-white">
    <div class="container mx-auto px-4 mt-10">
        <h1 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700">پکیج های تجاری تولیدات</h1>
        <p class="mt-1">
              اصلی ترین محور کاری این پلتفرم بر پایه ی تقویت هر چه بیشتر 
              SEO (Search engine optimization)
               می باشد.
               پکیج های غیر رایگان امکان نمایش بیشتر کمپانی شما در لیست دسته بندی ها و ورودی تماس بیشتر با شرکت شما فراهم می کنند.
        </p>
    </div>
    <div class="container mx-auto px-4 mt-6 gap-4 grid leading-relaxed">
       
        <h2 class="text-xl md:text-xl font-extrabold tracking-tight text-gray-700">پنل کمپانی</h2>
        <p>
            پلتفرم تولیدات یک پنل ادمین در اختیار شما قرار می دهد
             تا شما امکان درج هر گونه اطلاعاتی که میخواهید مشتریان شما از آن آگاهی داشته باشند را، به آسانی و در کمترین زمان، در پروفایل خود بارگزاری نمایید.
            تکمیل هر چه بیشتر اطلاعات درج شده توسط شما این امکان را به متخصصین تولیدات می دهد تا جایگاه بالاتری در موتورهای جستجویی مانند گوگل برای شما فراهم آورند.
             کارشناسان تولیدات در مسیر درج اطلاعات در پروفایل شما، در هر لحظه در کنارتان خواهند بود و راهنمایی های لازم را ارائه می دهند.
        </p>

        <h2 class="text-xl md:text-xl font-extrabold tracking-tight text-gray-700">انتخاب پکیج</h2>
        <p>
            مشترکین گرامی شما می توانید با توجه به نوع مجموعه ی خود و اطلاعاتی که برای بارگزاری در اختیار دارید
             و همچنین با توجه به سیاست های تعیین شده در سازمانتان و امکانات مورد نیاز خود، یکی از پلن های ارائه شده را خریداری کنید.
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-<?php echo count($list['packages']) ?> items-center md:gap-y-16 gap-x-4 container mx-auto px-4 ">

        <?php
        foreach ($list['packages'] as $package) {
            if ($package['englishTitle'] == 'bronze') {
                $bgColor1 = 'yellow-600';
                $bgColor2 = 'yellow-500';
            } else if ($package['englishTitle'] == 'gold') {
                $bgColor1 = 'yellow-300';
                $bgColor2 = 'yellow-200';
            } else if ($package['englishTitle'] == 'silver') {
                $bgColor1 = 'gray-300';
                $bgColor2 = 'gray-200';
            } else {
                $bgColor1 = 'gray-100';
                $bgColor2 = 'gray-50';
            }

        ?>

            <!-- from-yellow-600
            via-yellow-500

            from-yellow-300
            via-yellow-200

            from-gray-300
            via-gray-200

            from-gray-100
            via-gray-50
            to-yellow-600
            to-yellow-300
            to-gray-300
            to-gray-100 -->

            <div class="w-full px-4 py-4 mt-6 shadow-lg bg- rounded-lg bg-gradient-to-r from-<?php echo $bgColor1 ?> via-<?php echo $bgColor2 ?> to-<?php echo $bgColor1 ?>">
                <div class="px-4 pt-6 pb-6">
                    <div class="flex justify-center">
                        <span class="inline-flex px-4 py-1 rounded-full text-xl leading-5 font-semibold tracking-wide uppercase">
                            <?php echo ($package['packagetype'] == 'رایگان')?'تست یک ماهه رایگان':$package['packagetype']; ?>
                        </span>
                    </div>
                    <div class="mt-4 flex justify-center text-4xl leading-none font-extrabold">
                        <?php echo number_format((int)$package['price'], 0); ?>
                        <span class="pt-5 text-sm leading-8 font-medium text-gray-600">
                            <span>تومان /  <?php echo $package['period'] ?> ماهه</span>
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
                   
                </ul>
                <a href="<?php echo RELA_DIR . 'register'; ?>" data-id="<?php echo $package['Package_id']; ?>" class="block text-center choosePkg <?php echo $package['englishTitle']; ?> w-full px-3 py-3 text-sm shadow rounded-lg text-white bg-tolidatColor hover:bg-orange-600 transition-colors duration-700 transform">انتخاب پکیج <?php echo $package['packagetype']; ?></a>
            </div>

        <?php
        }
        ?>
        <!-- <div class="w-full px-4 py-4 mt-6 shadow-lg rounded-lg bg-gradient-to-r from-yellow-300 via-yellow-100 to-yellow-300">
            <div class="px-6 pt-6 pb-6">
                <div class="flex justify-center">
                    <span class="inline-flex px-4 py-1 rounded-full text-xl leading-5 font-semibold tracking-wide uppercase">
                        طلایی
                    </span>
                </div>
                <div class="mt-4 flex justify-center text-5xl leading-none font-extrabold">
                    10,000,000
                    <span class="pt-5 text-xl leading-8 font-medium text-gray-500">
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
                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7">12</span>
                    دسته بندی
                </li>
                <li class="mb-3 flex items-center ">
                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7">30</span>
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
            <button type="button" class="w-full px-3 py-3 text-sm shadow rounded-lg text-white bg-tolidatColor hover:bg-orange-600 transition-colors duration-700 transform">
                انتخاب پکیج طلایی
            </button>
        </div>

        <div class="w-full px-4 py-4 mt-6 shadow-lg rounded-lg bg-gradient-to-r from-pl via-gray-200 to-gray-300">
            <div class="px-6 pt-6 pb-6">
                <div class="flex justify-center">
                    <span class="inline-flex px-4 py-1 rounded-full text-xl leading-5 font-semibold tracking-wide uppercase">
                        پلاتینیوم
                    </span>
                </div>
                <div class="mt-4 flex justify-center text-5xl leading-none font-extrabold">
                    15,000,000
                    <span class="pt-5 text-xl leading-8 font-medium text-gray-500">
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
                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7">24</span>
                    دسته بندی
                </li>
                <li class="mb-3 flex items-center ">
                    <span class="h-6 w-6 ml-2 text-center text-white  rounded-full bg-red-400 leading-7">200</span>
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
            <button type="button" class="w-full px-3 py-3 text-sm shadow rounded-lg text-white bg-tolidatColor hover:bg-orange-600 transition-colors duration-700 transform">
                انتخاب پکیج پلاتینیوم
            </button>
        </div> -->
    </div>



    <script>
        $(function() {
            $('.choosePkg').on('click', function(e) {
                e.preventDefault();

                var dataId = $(this).data('id');

                window.localStorage.setItem("packageType", dataId);

                window.location.replace("<?php echo RELA_DIR; ?>register");
            });
        });
    </script>
</div>