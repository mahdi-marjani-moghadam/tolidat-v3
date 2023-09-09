<link rel="stylesheet" type="text/css" href="<?php   ?><?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css" />

<style>
    .slick-track {
        display: flex !important;
    }

    .slick-slide {
        height: inherit !important;
    }

    .nextArrow {
        left: -30px;
        font-size: 12px;
        line-height: 0;
        position: absolute;
        top: calc(50% - 20px);
        z-index: 1;
        display: block;
        width: 40px;
        height: 40px;
        cursor: pointer;
        background-color: #ff710d30;
    }

    .prevArrow {
        right: -30px;
        font-size: 12px;
        line-height: 0;
        position: absolute;
        top: calc(50% - 20px);
        z-index: 1;
        display: block;
        width: 40px;
        height: 40px;
        cursor: pointer;
        background-color: #ff710d30;
    }

    @media screen and (max-width: 767px) {
        .nextArrow {
            left: -11px;
        }

        .prevArrow {
            right: -11px;
        }
    }

    video::-webkit-media-controls-fullscreen-button {
        display: none;
    }
</style>

<!-- slider -->
<div class="">
    <div class="items-center pb-10 pt-4 md:py-10 px-5 bg-gray-500s bg-pattern-05 bgs-cover">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-10  items-center container mx-auto">

            <div>
                <div class="md:max-w-md mx-auto">
                    <p class="text-xl mt-4 py-5 text-gray-700 rounded-lg text-center md:text-right leading-relaxed">پلتفرم تولیدات خانه ی دوم کسب و کار شماست و گام به گام در مسیر رشد و دریافت سهم بیشتر بازار در کنار شما خواهد بود.</p>

                    <div class="flex justify-center md:justify-start">
                        <a href="<?php echo RELA_DIR ?>register" class="group relative w-50 py-2 px-4 border border-transparent text-md font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            همین الان ثبت نام کنید
                        </a>
                    </div>

                </div>
            </div>

            <div>
                <video preload="none" onclick="playPause(this)" controls controlsList="nodownload nofullscreen " poster="<?php echo TEMPLATE_DIR ?>assets/image/video-cover.jpg" class="max-h-96 mx-auto rounded-md">
                    <source src="<?php echo TEMPLATE_DIR ?>assets/video/tolidat_intro.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

        </div>
    </div>
</div>

<!-- icons -->
<div class="relative">
    <div class="items-center py-10 bg-white text-gray-700">
        <div class="grid items-center gap-y-16 gap-x-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 container mx-auto">

            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-full text-center">
                        <div class="justify-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 150 150" xmlns:v="https://vecta.io/nano">
                                <circle cx="75" cy="75" r="74.75" fill="#fff" />
                                <g fill="#ff720e">
                                    <circle cx="68.43" cy="57.74" r="16.55" />
                                    <path d="M99.38 25.75l-15.34-4.19a58.61 58.61 0 0 0-30.96.02l-16.29 4.47A16.04 16.04 0 0 0 25 41.52v35.73c0 5.86 2.14 11.52 6.03 15.91l26.8 30.27c5.36 6.05 14.67 6.45 20.53.88l10.8-10.27L82 107.7l4.25-5.19 7.76 6.9 9.71-9.23a23.98 23.98 0 0 0 7.46-17.39V41.22c.01-7.23-4.83-13.56-11.8-15.47zm-1.1 58.05c-.08-1.6-.39-3.19-.96-4.72-3.31-8.95-13.04-6.03-17.13-2.72s-10.12 2.72-10.12 2.72h-3.05s-6.03.58-10.12-2.72c-4.09-3.31-13.82-6.23-17.13 2.72a36.11 36.11 0 0 0-1.25 4.16 33.61 33.61 0 0 1-3.82-15.61c0-18.69 15.15-33.83 33.83-33.83 18.69 0 33.83 15.15 33.83 33.83a33.32 33.32 0 0 1-4.08 16.17z" />
                                </g>
                                <path d="M99.84 80.2c-13.89 0-25.16 11.26-25.16 25.16s11.26 25.16 25.16 25.16S125 119.26 125 105.36 113.74 80.2 99.84 80.2zm-3.62 40.09L82 107.7l4.25-5.19 9.15 8.13 17.98-18.3 4.9 4.74-22.06 23.21z" fill="#5fb769" />
                            </svg>
                            <!-- <img class="mx-auto h-14" src="< ?php echo TEMPLATE_DIR ?>assets/image/ehraz-hoviat.svg" alt=""> -->
                        </div>
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-lg font-semibold mt-5">احراز هویت</h3>
                    </div>
                    <div class="w-full text-center mt-3">
                        <span>کارشناسان تولیدات شخصیت های حقوقی و حقیقی متقاضی خدمات این پلتفرم را اعتبار سنجی می کنند و بر اساس امتیاز کسب شده توسط متقاضی، و سبب جلب اعتماد هر چه بیشتر مخاطبان می گردند.</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-full flex  justify-center">
                        <!-- <img class="mx-auto h-14" src="< ?php echo TEMPLATE_DIR ?>assets/image/jaygah-behtar.svg" alt=""> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 150 150" xmlns:v="https://vecta.io/nano">
                            <circle cx="75" cy="75" r="74.75" fill="#fff" />
                            <g fill="none" stroke-width="7.124" stroke-linejoin="round">
                                <ellipse cx="75" cy="53.32" rx="46.69" ry="26.08" stroke="#ff720e" />
                                <path d="M121.69 75c0 14.4-20.91 26.08-46.69 26.08S28.31 89.4 28.31 75m93.38 21.68c0 14.4-20.91 26.08-46.69 26.08s-46.69-11.68-46.69-26.08" stroke="#5fb769" stroke-linecap="round" stroke-miterlimit="10" />
                            </g>
                        </svg>
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-lg font-semibold mt-5">جایگاه بهتر</h3>
                    </div>
                    <div class="w-full text-center mt-3">
                        <span>متقاضیان بهره مندی از خدمات پلتفرم تولیدات که شامل خدمات سئو، کسب سهم بالاتر از بازار، جذب مشتری و ...می باشد، می توانند با تکمیل هر چه بیشتر اطلاعات کمپانی خود، به رتبه ی بالاتری در فروش، نسبت به رقبای خود، دست پیدا کنند.</span>
                    </div>
                </div>
            </div>

            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-full flex justify-center">
                        <!-- <img class="mx-auto h-14" src="< ?php echo TEMPLATE_DIR ?>assets/image/tik.svg" alt=""> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 150 150" xmlns:v="https://vecta.io/nano">
                            <circle cx="75" cy="75" r="74.75" fill="#fff" />
                            <path d="M49.51 60.79l21.57 18.48 42.39-41.63 11.56 10.78-52.02 52.79-33.53-28.63z" fill="#5fb769" />
                            <path d="M92.66 38.01H39.1c-6.17 0-11.18 4.83-11.18 10.78v52.41c0 5.95 5 10.78 11.18 10.78h53.56c6.17 0 11.18-4.83 11.18-10.78V77.1" fill="none" stroke="#ff720e" stroke-width="5.9" stroke-miterlimit="10" />
                        </svg>
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-lg font-semibold mt-5">تیک سبز رنگ</h3>
                    </div>
                    <div class="w-full text-center mt-3">
                        <span>مشترکین پلتفرم تولیدات، پس از احراز هویت و نیز تکمیل اطلاعات مربوط به کسب و کار آنها، یک تیک سبز رنگ در پروفایل خود دریافت می کنند که به منزله ی صحت سنجی و تایید اطلاعات ارائه شده، توسط تیم تولیدات، می باشد.</span>
                    </div>
                </div>
            </div>

            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-full justify-center flex">
                        <!-- <img class="mx-auto h-14" src="< ?php echo TEMPLATE_DIR ?>assets/image/poshtibani.svg" alt=""> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 150 150" xmlns:v="https://vecta.io/nano">
                            <circle cx="75" cy="74" r="74.75" fill="#fff" />
                            <path d="M75 28.25C49.4 28.25 28.66 49 28.66 74.6c0 11.96 4.53 22.86 11.97 31.08" fill="none" stroke="#ff720e" stroke-width="7.791" stroke-miterlimit="10" />
                            <path d="M73.81 17.07v25.77l20.61-13.4z" fill="#ff720e" />
                            <path d="M75 120.94c25.6 0 46.34-20.75 46.34-46.34 0-13.41-5.7-25.5-14.81-33.96" fill="none" stroke="#ff720e" stroke-width="7.791" stroke-miterlimit="10" />
                            <path d="M74.84 132.93v-25.77l-20.62 13.4z" fill="#ff720e" />
                            <path d="M44.99 89.95v-.32c0-6.17 2.69-10.7 11.04-15.92 5.33-3.32 6.75-4.22 6.75-6.79 0-2.2-1.16-4.05-4.78-4.05-3.52 0-4.8 2.12-5.25 5.02h-7.62c.48-6.55 5.33-11.08 13.13-11.08 7.59 0 12.37 4.21 12.37 10.06 0 4.85-2.02 7.19-8.71 11.07-3.85 2.23-6.39 4.05-7.35 5.82h17.39L71 89.95H44.99zm48.19 0v-7.06H76.63v-6.46l14.94-18.94h8.97V76.6h4.51l-.62 6.29h-3.89v7.06h-7.36zm0-18.42l.1-7.02c-1.36 2.03-4.21 5.98-8.92 12.09h8.82v-5.07z" fill="#5fb769" />
                        </svg>
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-lg font-semibold mt-5">پشتیبانی 24 ساعته</h3>
                    </div>
                    <div class="w-full text-center mt-3">
                        <span>پلتفرم تولیدات از طریق ایجاد امکانات لازم برای پشتیبانی آنلاین، امکان ارتباط دائمی مشترکین با کارشناسان خود را فراهم نموده است. ما همیشه در کنار شما خواهیم بود</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- contact us -->
<div class="relative" id="fast-register">
    <div class="items-center py-10 bg-gray-50 fast-register-bg">
        <div class="grid items-center gap-y-16 gap-x-8 grid-cols-1 md:grid-cols-2 container mx-auto px-4">

            <div>
                <div class="flex items-center justify-center text-white">
                    <div class="max-w-xl w-full">

                        <h2 class="mt-0 md:mt-3 text-2xl md:text-3xl text-center md:text-right font-extrabold  md:!leading-10">
                            سرعت پیشرفت خود را افزایش دهید، <br>مشاورین ما در انتظار شما هستند
                        </h2>

                        <div class="mt-6">
                            <div class="flex ">
                                <div class="flex-shrink-0 text-tolidatColor">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <div class="text-sm  leading-relaxed mb-2">
                                    پلتفرم تولیدات با بهره مندی از کارشناسان متخصص و مجرب در زمینه خدمات SEO و با تسلط بر قوانین و دانش جدید مربوط به معرفی کسب و کار در بازارهای جدید دیجیتال امروزی، به هر چه بهتر دیده شدن شما به مخاطبین خود، کمک خواهد کرد.                                     </div>
                                </div>
                            </div>
                        </div>


                  <!-- <div>
                            <img class="mx-auto" width="300" height="300" src="< ?php echo TEMPLATE_DIR ?>assets/image/circle-color.svg" alt="">
                        </div> -->


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- company -->
<div class="container mx-auto px-4 mt-10 ">
    <h3 class="text-xl md:text-2xl text-center md:text-right font-extrabold tracking-tight text-gray-700">نمونه ای از شرکت های فعال در تولیدات</h3>
</div>

<div class="container mx-auto px-4 mt-6 mb-10 ">
    <div class="container-carousel-company" dir="ltr">
        <?php if ($list['higher_company']) : ?>
            <?php foreach ($list['higher_company'] as $item => $value) : ?>
                <div dir="rtl" class="items-stretch">
                    <div class="h-full relative border-2 border-gray-200 rounded-lg overflow-hidden">
                        <div class="grid grid-cols-2 items-center">
                            <a href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>" class="p-2">
                                <img class="h-32  rounded-md" src="<?php echo ((isset($value['image']) && file_exists(ROOT_DIR . 'statics/images/company/' . $value['Company_id'] . "/logo/" . $value['image'])) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' محصول ' . $fields['brif_description'] ?>">
                            </a>
                            <div class="flex items-center justify-center">
                                <div class="" role="progressbar" aria-valuenow="<?php echo $value['priority'] ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo $value['priority'] ?>; --size:5rem; --fg:hsl(<?php echo $value['priority'] ?>deg,70%,50%)"></div>
                            </div>
                        </div>

                        <div class="pt-5 pb-3 px-3 bg-gray-50 flex flex-col h-40">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo $value['information']['personality_type'] ?></h2>
                            <a href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>" class="">
                                <h1 class="text-lg font-semibold text-gray-900 mb-3 truncate"><?php echo $value['company_name'] ?></h1>
                            </a>
                            <p class="leading-relaxed mb-3 truncate "><?php echo  $value['meta_keyword'] ?></p>
                            <div class="flex self-end flex-wrap w-full mt-auto mb-0">
                                <a href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
                                    <svg class="w-4 h-4 ml-1" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                    مشاهده جزئیات
                                </a>
                                <span class="text-gray-600 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-300">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>0
                                </span>
                                <span class="text-gray-600  items-center leading-none text-sm hidden">
                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                    </svg>0
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<!-- about tolidat -->
<div class="relative">
    <div class="bg-gray-50">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 lg:gap-y-16 items-center container mx-auto px-4">

            <div>
                <div class="flex items-center justify-center">
                    <div class="w-full">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 750 500">
                                <defs>
                                    <style>
                                        .cls-1 {
                                            fill: #fff;
                                        }

                                        .cls-11,
                                        .cls-12,
                                        .cls-15,
                                        .cls-16,
                                        .cls-2,
                                        .cls-22,
                                        .cls-24,
                                        .cls-33,
                                        .cls-38,
                                        .cls-47,
                                        .cls-49,
                                        .cls-53,
                                        .cls-60,
                                        .cls-63,
                                        .cls-67 {
                                            fill: none;
                                            stroke-miterlimit: 10;
                                        }

                                        .cls-2 {
                                            stroke: #cedbed;
                                            stroke-width: 2.12px;
                                        }

                                        .cls-3 {
                                            fill: #cedbed;
                                        }

                                        .cls-4 {
                                            fill: url(#linear-gradient);
                                        }

                                        .cls-5 {
                                            fill: url(#linear-gradient-2);
                                        }

                                        .cls-6 {
                                            fill: url(#linear-gradient-3);
                                        }

                                        .cls-7 {
                                            fill: url(#linear-gradient-4);
                                        }

                                        .cls-8 {
                                            fill: url(#linear-gradient-5);
                                        }

                                        .cls-9 {
                                            fill: url(#linear-gradient-6);
                                        }

                                        .cls-10 {
                                            fill: url(#linear-gradient-7);
                                        }

                                        .cls-11,
                                        .cls-33,
                                        .cls-47,
                                        .cls-63 {
                                            stroke: #0c3069;
                                        }

                                        .cls-11 {
                                            stroke-width: 1.1px;
                                        }

                                        .cls-12,
                                        .cls-22 {
                                            stroke: #fff;
                                        }

                                        .cls-12 {
                                            stroke-width: 2.11px;
                                        }

                                        .cls-13 {
                                            fill: url(#linear-gradient-8);
                                        }

                                        .cls-14 {
                                            fill: url(#linear-gradient-9);
                                        }

                                        .cls-15,
                                        .cls-16 {
                                            stroke: #1656bd;
                                        }

                                        .cls-15 {
                                            stroke-width: 3.17px;
                                        }

                                        .cls-16 {
                                            stroke-width: 3.34px;
                                        }

                                        .cls-17 {
                                            fill: #0c3069;
                                        }

                                        .cls-18 {
                                            fill: #ff6d6d;
                                        }

                                        .cls-19 {
                                            fill: #103f8a;
                                        }

                                        .cls-20 {
                                            fill: #08224a;
                                        }

                                        .cls-21 {
                                            fill: #ffa526;
                                        }

                                        .cls-22,
                                        .cls-24,
                                        .cls-47,
                                        .cls-49 {
                                            stroke-width: 0.72px;
                                        }

                                        .cls-23 {
                                            fill: #80371d;
                                        }

                                        .cls-24 {
                                            stroke: #ffa526;
                                        }

                                        .cls-25 {
                                            fill: url(#linear-gradient-10);
                                        }

                                        .cls-26 {
                                            fill: #d92727;
                                        }

                                        .cls-27 {
                                            fill: #a1c1ed;
                                        }

                                        .cls-28 {
                                            fill: #16a3bd;
                                        }

                                        .cls-29 {
                                            fill: #0f3d85;
                                        }

                                        .cls-30 {
                                            fill: url(#linear-gradient-11);
                                        }

                                        .cls-31 {
                                            fill: #1656bd;
                                        }

                                        .cls-32 {
                                            fill: url(#linear-gradient-12);
                                        }

                                        .cls-33,
                                        .cls-38 {
                                            stroke-width: 0.89px;
                                        }

                                        .cls-34 {
                                            fill: url(#linear-gradient-13);
                                        }

                                        .cls-35 {
                                            fill: url(#linear-gradient-14);
                                        }

                                        .cls-36 {
                                            fill: url(#linear-gradient-15);
                                        }

                                        .cls-37 {
                                            fill: url(#linear-gradient-16);
                                        }

                                        .cls-38,
                                        .cls-53 {
                                            stroke: #d92727;
                                        }

                                        .cls-39 {
                                            fill: url(#linear-gradient-17);
                                        }

                                        .cls-40 {
                                            fill: url(#linear-gradient-18);
                                        }

                                        .cls-41 {
                                            fill: url(#linear-gradient-19);
                                        }

                                        .cls-42 {
                                            fill: #f04f4f;
                                        }

                                        .cls-43 {
                                            fill: url(#linear-gradient-20);
                                        }

                                        .cls-44 {
                                            fill: url(#linear-gradient-21);
                                        }

                                        .cls-45 {
                                            fill: url(#linear-gradient-22);
                                        }

                                        .cls-46 {
                                            fill: url(#linear-gradient-23);
                                        }

                                        .cls-48 {
                                            fill: #456b4b;
                                        }

                                        .cls-49 {
                                            stroke: #38573d;
                                        }

                                        .cls-50,
                                        .cls-55 {
                                            opacity: 0.5;
                                        }

                                        .cls-50 {
                                            fill: url(#linear-gradient-24);
                                        }

                                        .cls-51 {
                                            fill: url(#linear-gradient-25);
                                        }

                                        .cls-52 {
                                            opacity: 0.57;
                                            fill: url(#linear-gradient-26);
                                        }

                                        .cls-53 {
                                            stroke-width: 0.53px;
                                        }

                                        .cls-54 {
                                            fill: url(#linear-gradient-27);
                                        }

                                        .cls-55 {
                                            fill: url(#linear-gradient-28);
                                        }

                                        .cls-56 {
                                            fill: url(#linear-gradient-29);
                                        }

                                        .cls-57 {
                                            fill: url(#linear-gradient-30);
                                        }

                                        .cls-58 {
                                            fill: #967c45;
                                        }

                                        .cls-59 {
                                            fill: #786337;
                                        }

                                        .cls-60 {
                                            stroke: #4f4124;
                                            stroke-width: 0.84px;
                                        }

                                        .cls-61,
                                        .cls-65,
                                        .cls-66 {
                                            opacity: 0.4;
                                        }

                                        .cls-61 {
                                            fill: url(#linear-gradient-31);
                                        }

                                        .cls-62 {
                                            fill: url(#linear-gradient-32);
                                        }

                                        .cls-63 {
                                            stroke-width: 1.09px;
                                        }

                                        .cls-64 {
                                            fill: url(#linear-gradient-33);
                                        }

                                        .cls-65 {
                                            fill: url(#linear-gradient-34);
                                        }

                                        .cls-66 {
                                            fill: url(#linear-gradient-35);
                                        }

                                        .cls-67 {
                                            stroke: #5d94de;
                                            stroke-width: 0.76px;
                                        }
                                    </style>
                                    <linearGradient id="linear-gradient" x1="335.51" y1="233.9" x2="239.32" y2="424.9" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.05" stop-color="#a1c1ed" />
                                        <stop offset="1" stop-color="#a1c1ed" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-2" x1="527.79" y1="123.82" x2="557.42" y2="325.44" xlink:href="#linear-gradient" />
                                    <linearGradient id="linear-gradient-3" x1="32.59" y1="237.48" x2="70.72" y2="237.48" gradientTransform="matrix(-1, -0.09, -0.09, 1, 149.04, 67.55)" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.04" stop-color="#ffa526" />
                                        <stop offset="1" stop-color="#ff6026" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-4" x1="0.82" y1="224.02" x2="24.01" y2="224.02" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-5" x1="21.39" y1="272.13" x2="59.5" y2="272.13" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-6" x1="-13.1" y1="249.76" x2="8.89" y2="249.76" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-7" x1="26.94" y1="199.95" x2="60.79" y2="199.95" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-8" x1="588.05" y1="395.75" x2="588.05" y2="232.7" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#6ab883" />
                                        <stop offset="1" stop-color="#dbb883" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-9" x1="193.34" y1="398.89" x2="193.34" y2="283.73" gradientTransform="matrix(-1, 0, 0, 1, 366.93, 0)" xlink:href="#linear-gradient-8" />
                                    <linearGradient id="linear-gradient-10" x1="384.56" y1="219.52" x2="396.35" y2="219.52" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#f04f4f" />
                                        <stop offset="0.15" stop-color="#f04f4f" stop-opacity="0.99" />
                                        <stop offset="0.28" stop-color="#f04f4f" stop-opacity="0.94" />
                                        <stop offset="0.4" stop-color="#f04f4f" stop-opacity="0.86" />
                                        <stop offset="0.53" stop-color="#f04f4f" stop-opacity="0.76" />
                                        <stop offset="0.65" stop-color="#f04f4f" stop-opacity="0.62" />
                                        <stop offset="0.76" stop-color="#f04f4f" stop-opacity="0.45" />
                                        <stop offset="0.88" stop-color="#f04f4f" stop-opacity="0.25" />
                                        <stop offset="0.99" stop-color="#f04f4f" stop-opacity="0.02" />
                                        <stop offset="1" stop-color="#f04f4f" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-11" x1="180.78" y1="231.34" x2="180.78" y2="277.78" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.03" stop-color="#0c3069" />
                                        <stop offset="1" stop-color="#0c3069" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-12" x1="204.92" y1="197.69" x2="229.52" y2="231.06" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#0c3069" />
                                        <stop offset="1" stop-color="#0c3069" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-13" x1="155.09" y1="196.82" x2="129.9" y2="227.47" xlink:href="#linear-gradient-12" />
                                    <linearGradient id="linear-gradient-14" x1="176.42" y1="164.46" x2="188.41" y2="164.46" xlink:href="#linear-gradient-10" />
                                    <linearGradient id="linear-gradient-15" x1="307.03" y1="326.76" x2="300.68" y2="385.42" xlink:href="#linear-gradient-12" />
                                    <linearGradient id="linear-gradient-16" x1="243.56" y1="255.25" x2="333.99" y2="255.25" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-17" x1="275.34" y1="265.21" x2="258.16" y2="245.59" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#80371d" stop-opacity="0.89" />
                                        <stop offset="0.07" stop-color="#80371d" />
                                        <stop offset="1" stop-color="#80371d" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-18" x1="275.93" y1="276.75" x2="257.17" y2="257.59" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#80371d" />
                                        <stop offset="1" stop-color="#80371d" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-19" x1="319.43" y1="280.37" x2="311.15" y2="242.85" xlink:href="#linear-gradient-18" />
                                    <linearGradient id="linear-gradient-20" x1="298.97" y1="207.57" x2="296.92" y2="223.75" xlink:href="#linear-gradient-10" />
                                    <linearGradient id="linear-gradient-21" x1="239.99" y1="268.17" x2="260.4" y2="268.17" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-22" x1="359.78" y1="258.81" x2="314.68" y2="259.16" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-23" x1="356.04" y1="299.56" x2="356.04" y2="255.56" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.04" stop-color="#87b2ed" />
                                        <stop offset="1" stop-color="#fff" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-24" x1="490.82" y1="243.01" x2="490.82" y2="268.74" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.03" />
                                        <stop offset="1" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-25" x1="452.61" y1="196.71" x2="476.67" y2="196.71" xlink:href="#linear-gradient-10" />
                                    <linearGradient id="linear-gradient-26" x1="505.39" y1="174.97" x2="494.81" y2="261.55" xlink:href="#linear-gradient-12" />
                                    <linearGradient id="linear-gradient-27" x1="431.83" y1="199.43" x2="443.75" y2="199.43" xlink:href="#linear-gradient-10" />
                                    <linearGradient id="linear-gradient-28" x1="508.29" y1="286.37" x2="451.21" y2="371.99" xlink:href="#linear-gradient-24" />
                                    <linearGradient id="linear-gradient-29" x1="418.79" y1="177.53" x2="420.64" y2="110.68" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.05" stop-color="#fff" />
                                        <stop offset="1" stop-color="#fff" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-30" x1="483.01" y1="169.68" x2="494.98" y2="169.68" xlink:href="#linear-gradient-10" />
                                    <linearGradient id="linear-gradient-31" x1="576.03" y1="296.46" x2="540.62" y2="467.43" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" />
                                        <stop offset="0.93" stop-opacity="0" />
                                    </linearGradient>
                                    <linearGradient id="linear-gradient-32" x1="555.9" y1="247.82" x2="580.85" y2="247.82" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-33" x1="574.44" y1="257.27" x2="601.61" y2="257.27" gradientTransform="matrix(1, 0, 0, 1, 0, 0)" xlink:href="#linear-gradient-3" />
                                    <linearGradient id="linear-gradient-34" x1="390.24" y1="259.53" x2="390.24" y2="395.45" xlink:href="#linear-gradient-31" />
                                    <linearGradient id="linear-gradient-35" x1="532.66" y1="118.71" x2="546.41" y2="187.81" xlink:href="#linear-gradient-31" />
                                </defs>

                                <g id="OBJECTS">
                                    <path class="cls-2" d="M671.65,191.41a187.21,187.21,0,0,1,7.14,41.07c3.65,53.42-11,100.5-23.89,130.59a317.69,317.69,0,0,1-20.38,39.66" />
                                    <path class="cls-2" d="M105.75,400.18C90.39,323.93,87.89,262.41,98.1,212.33a229,229,0,0,1,17.73-53.61" />
                                    <path class="cls-2" d="M662.73,183.82c5.53,14.56,8.89,30.9,10.13,49.12C676.42,285,662.12,331,649.49,360.43a307.18,307.18,0,0,1-21.88,42" />
                                    <path class="cls-2" d="M111.83,400.18c-15.42-76-18-137-7.92-186.5,5-24.68,13.36-46.9,24.8-66.28" />
                                    <path class="cls-2" d="M652.89,176.24c7.9,16.35,12.55,35.34,14,57.16,3.47,50.74-10.51,95.65-22.84,124.39a296.08,296.08,0,0,1-23.55,44.42" />
                                    <path class="cls-2" d="M117.92,400.18c-15.48-75.68-18.16-136.3-8.2-185.15,6.21-30.43,17.54-57,33.67-78.84" />
                                    <path class="cls-3" d="M125,404.71H611.46S667.54,329.49,661,233.86,586.8,114.39,501.61,98.76,316.67,38.49,216.9,85.12C97.08,141.13,97.06,272.6,125,404.71Z" />
                                    <path class="cls-4" d="M384,306.09c-8.94-89.3-114.55-86.86-114.55-86.86-37.4-56-104.32-56.78-137.06-53.29C100.33,231,106.58,317.72,125,404.71H486.82C474.53,310.48,384,306.09,384,306.09Z" />
                                    <path class="cls-5" d="M611.46,404.71S667.54,329.49,661,233.86c-1.83-26.79-8.46-47.94-18.93-64.86-33.35,7.12-86.39,27.88-124.09,88.27a614.47,614.47,0,0,0-66.54,147.44Z" />
                                    <path class="cls-6" d="M93.56,312.08s-9.2-16.84-13.73-22.26c-6.2-7.4-17.28-8.61-22,3.2-4.39,10.86,3.89,18.38,12.65,20.07S93.56,312.08,93.56,312.08Z" />
                                    <path class="cls-7" d="M106.79,307.82s-2.68-19.51-1.52-28.73,9.46-10.26,15-7.63,9.74,8.57,7,17.5S106.79,307.82,106.79,307.82Z" />
                                    <path class="cls-8" d="M102.39,338.1S88.79,325.18,82.2,322s-16.13-.92-17.35,8.42,2.37,16,12.74,17.28S102.39,338.1,102.39,338.1Z" />
                                    <path class="cls-9" d="M115.93,331.33s.19-14.17,2.76-22.91,9.83-9.75,15.12-5.79,7.38,12.43,3.25,17.88S115.93,331.33,115.93,331.33Z" />
                                    <path class="cls-10" d="M94.45,288.35A158.1,158.1,0,0,1,76,270.4c-9.28-10.66-6.86-30.41,8.62-32.56,14-2,19.93,11.42,19.41,22.1S94.45,288.35,94.45,288.35Z" />
                                    <path class="cls-11" d="M87.27,249.92s5.24,56.53,39.91,130.25" />
                                    <path class="cls-11" d="M66.51,298.38C79.09,305.67,102.17,316,102.17,316s10.75-19.64,14.21-31.39" />
                                    <path class="cls-11" d="M75.71,334.13c15.39,2.48,34.31,5,34.31,5s13.1-16.9,19.9-28" />
                                    <rect class="cls-12" x="230.82" y="136.81" width="316.21" height="128.15" />
                                    <path class="cls-13" d="M496.84,405.45H679.36s-2.11-39.3-19-26.62c0,0,5.29-38.91,1.59-39s-13.74,10.47-13.74,10.47,5.28-36.84-3.17-34.8-7.93,9.36-7.93,9.36,5.29-38.24.53-60.57,1.06-42.67-8.46-44.66-21.66,58.26-21.66,58.26-7.93-3.69-11.63,23.79c0,0-17.9-12.68-18.46,27.48,0,0-29.81-3.6-34.22,28.33,0,0-18.8-1.51-23.95,12.09S495.32,387,496.84,405.45Z" />
                                    <path class="cls-14" d="M271.46,405.45H75.4s6-7.27,12.75-9.19c0,0,2.88-26.58,19.23-27.29,0,0,26.35-75.51,39.12-28.64,0,0-1.5-55.59,23.36-28.2,0,0,4.72-48,15-48.79S200,316.48,200,316.48s13.13-.36,20.07,9.16c0,0-1.32-55.58,9.12-55.75S242.64,324,242.64,324s29.92-18.64,17.15,59.75C259.79,383.77,274,382.36,271.46,405.45Z" />
                                    <line class="cls-15" x1="378.26" y1="316.76" x2="368.8" y2="414.82" />
                                    <line class="cls-15" x1="408.62" y1="316.76" x2="418.08" y2="414.82" />
                                    <line class="cls-15" x1="375.91" y1="341.2" x2="411.13" y2="341.2" />
                                    <line class="cls-16" x1="373.97" y1="362.84" x2="413.06" y2="362.84" />
                                    <rect class="cls-17" x="368.8" y="308.91" width="49.27" height="10.66" rx="3.4" />
                                    <line class="cls-15" x1="456.65" y1="316.76" x2="447.19" y2="414.82" />
                                    <line class="cls-15" x1="487" y1="316.76" x2="496.46" y2="414.82" />
                                    <line class="cls-15" x1="454.29" y1="341.2" x2="489.51" y2="341.2" />
                                    <line class="cls-16" x1="452.35" y1="362.84" x2="491.44" y2="362.84" />
                                    <rect class="cls-17" x="447.19" y="308.91" width="49.27" height="10.66" rx="3.4" />
                                    <ellipse class="cls-3" cx="386.35" cy="423.43" rx="6.9" ry="3.75" />
                                    <path class="cls-18" d="M386.87,383.77l.21,19.58a17.12,17.12,0,0,1,1,6c0,3.43,3.05,8.74.32,11.2s-5.92.41-6.15-3,0-6.79-.94-8.67-1.07-4.95.21-6.33l-3.3-18.45Z" />
                                    <path class="cls-17" d="M385.73,410l-1,.12a1.66,1.66,0,0,1-1.85-1.29l-1.36-6.28c-1.28,1.38-1.12,4.45-.21,6.33s.7,5.22.94,8.67,3.42,5.49,6.15,3-.35-7.77-.32-11.2a17.12,17.12,0,0,0-1-6l.18,4.88A1.71,1.71,0,0,1,385.73,410Z" />
                                    <path class="cls-18" d="M429.94,376.94l2.82,19.37a17,17,0,0,1,1.83,5.83c.43,3.41,4.19,8.26,1.81,11.06s-5.81,1.21-6.5-2.18-.94-6.72-2.09-8.46-1.71-4.76-.63-6.3l-5.74-17.85Z" />
                                    <path class="cls-17" d="M432.31,403.08l-.94.24a1.66,1.66,0,0,1-2-1l-2.18-6c-1.08,1.54-.52,4.55.63,6.3s1.4,5.08,2.09,8.46,4.13,5,6.5,2.18-1.38-7.65-1.81-11.06a17,17,0,0,0-1.83-5.83l.83,4.81A1.7,1.7,0,0,1,432.31,403.08Z" />
                                    <path class="cls-17" d="M378.05,225.38s11.7,9.66,24.78,3.56c0,0-.05-1.52,1.27-1.52s6.56,1,13.83,4.41c10.22,4.84,33.56,31,32.59,44.3-.7,9.69-7.75,12.86-14.09,12.6s-5.81-11-5.81-11L410.71,261,407,288.73H364.55l-6-43.42-14.44-61.75a17.55,17.55,0,0,1,5.07-8.37,7.66,7.66,0,0,1,8.14-1.23Z" />
                                    <path class="cls-19" d="M378.05,225.38,357.33,174a7.66,7.66,0,0,0-8.14,1.23,17.55,17.55,0,0,0-5.07,8.37l14.44,61.74C372.57,256.05,378.05,225.38,378.05,225.38Z" />
                                    <path class="cls-19" d="M436.43,288.73c6.34.26,13.39-2.91,14.09-12.6,1-13.25-22.37-39.46-32.59-44.3-1.58-.75-3.07-1.38-4.44-1.91h0c-9.31,15.21-2.78,31.06-2.78,31.06l19.91,16.74S430.09,288.47,436.43,288.73Z" />
                                    <path class="cls-20" d="M441,278.42c.12,6.41-1.8,10.77-5.52,10.32s-5.53-6.46-4.88-11Z" />
                                    <polygon class="cls-21" points="422.6 287.24 394.52 287.24 400.83 248.56 428.91 248.56 422.6 287.24" />
                                    <polygon class="cls-22" points="418.97 251.74 409.73 251.74 410.52 246.89 419.76 246.89 418.97 251.74" />
                                    <path class="cls-23" d="M375.83,304.14c15.32.47,13.74,81.74,13.74,81.74H373.89s-3.67-6.92-3.7-13c0-6.29-3-12.86-3.87-19.56S352.57,303.44,375.83,304.14Z" />
                                    <line class="cls-24" x1="389.61" y1="380.06" x2="371.5" y2="380.06" />
                                    <path class="cls-23" d="M408.36,299.5c15.24-1.59,24.54,79.17,24.54,79.17l-15.54,2.09s-4.56-6.37-5.41-12.42c-.87-6.23-4.69-12.35-6.45-18.86S385.22,301.9,408.36,299.5Z" />
                                    <line class="cls-24" x1="432.26" y1="373.56" x2="414.86" y2="375.98" />
                                    <path class="cls-18" d="M384.86,214.94l-.78,9.58a1.69,1.69,0,0,1-2,1.54l-4.06-.68s2.38,13.54,12.62,15.46,12.16-11.9,12.16-11.9l-5.62-1-2.91-13Z" />
                                    <path class="cls-25" d="M394.3,214.94h-9.44l-.3,3.72a16.18,16.18,0,0,0,11.79,5.44Z" />
                                    <path class="cls-26" d="M381.2,208.88s-5-9.42.62-13c2.9-6.3,15.41-5.33,18.36,1.63a9.67,9.67,0,0,1-2.2,11.23Z" />
                                    <circle class="cls-26" cx="385.81" cy="189.44" r="5.88" />
                                    <path class="cls-18" d="M399.31,208.13a1.65,1.65,0,0,0-1.63-.09c.25-1.83.43-3.34.43-3.34s-8.19,1.14-13.3-4c0,0-.61,4.58-3,6.25,0,0,0,.42.06,1.06a1.72,1.72,0,0,0-1.45.17c-1.06.6-.44,3.26,1.89,3.35.34,1.84.89,3.71,1.79,4.49,2,1.77,4.75,3.26,6.25,3.17s5.73-3.52,6.26-5a22.44,22.44,0,0,0,.55-2.66l.25,0C399.76,211.39,400.37,208.73,399.31,208.13Z" />
                                    <path class="cls-18" d="M438.1,274.06l-31.58-7.13s-5.41-7.27-7-7.6.66,2.47.66,2.47-2.26-1.61-2.85-.55a3.4,3.4,0,0,0,0,2.51s-.71,1.09,1.14,2.92,6.87,3,6.87,3,23.59,14.75,29.06,16.78S444.18,276.84,438.1,274.06Z" />
                                    <path class="cls-20" d="M357.33,174a7.66,7.66,0,0,0-8.14,1.23,17.55,17.55,0,0,0-5.07,8.37C349.05,187.43,357,178.27,357.33,174Z" />
                                    <path class="cls-18" d="M357.14,175l-5.91-19.15s2.18-4.49,1.85-5.81-1.85-.93-1.85-.93a7.5,7.5,0,0,0-.51-1.65c-.22-.26-5.63,2.25-5.63,2.25s-1,3,.39,3.76a2.44,2.44,0,0,0,1.92,3l5,25.45A15.55,15.55,0,0,0,357.14,175Z" />
                                    <line class="cls-15" x1="291.24" y1="316.76" x2="281.78" y2="414.82" />
                                    <line class="cls-15" x1="321.59" y1="316.76" x2="331.05" y2="414.82" />
                                    <line class="cls-15" x1="288.88" y1="341.2" x2="324.1" y2="341.2" />
                                    <line class="cls-16" x1="286.95" y1="362.84" x2="326.04" y2="362.84" />
                                    <rect class="cls-17" x="281.78" y="308.91" width="49.27" height="10.66" rx="3.4" />
                                    <path class="cls-27" d="M263.62,114H169.73c-19,0-10.57-15.85,0-18.67s8.1-19.73,27.13-26.42c10.56-3.72,21.49,7,21.49,7s12-3.87,22.55,3.88c7.1,5.21,12.46,16.7,22.72,16.91C280.53,97,287.75,114,263.62,114Z" />
                                    <path class="cls-27" d="M338.34,106.09s-5.25-7.55-13.72,0c0,0,12-1.8,13.72,7.24,1.72-9,13.73-7.24,13.73-7.24C343.6,98.54,338.34,106.09,338.34,106.09Z" />
                                    <path class="cls-27" d="M596.26,162.91s-3.9-5.6-10.17,0c0,0,8.9-1.34,10.17,5.36,1.27-6.7,10.17-5.36,10.17-5.36C600.15,157.31,596.26,162.91,596.26,162.91Z" />
                                    <path class="cls-3" d="M169.6,426.6c1.19,2.58-4.4,7.71-12.49,11.46s-15.62,4.69-16.81,2.1,4.39-7.71,12.48-11.45S168.4,424,169.6,426.6Z" />
                                    <path class="cls-3" d="M216.24,425.25c-1.19,2.58,4.4,7.71,12.49,11.46s15.62,4.68,16.81,2.1-4.39-7.71-12.48-11.45S217.44,422.67,216.24,425.25Z" />
                                    <path class="cls-17" d="M219.22,410.11l1.58,11.27s-1.76,5.38,0,7.22,8.63,4.41,8.63,4.41,11.19,5.46,12.95,4.31-9.69-12.86-9.69-12.86l-3.78-8.63-.86-5.46Z" />
                                    <path class="cls-28" d="M230.22,418.83a5.43,5.43,0,0,0-3.54,5l-5.88-2.42s-1.76,5.38,0,7.22,8.63,4.41,8.63,4.41,11.19,5.46,12.95,4.31-9.69-12.86-9.69-12.86Z" />
                                    <path class="cls-17" d="M166.59,410.11v11.27a8.93,8.93,0,0,1,0,7.4c-1.85,3.7-22.86,10.7-23.92,9.78s10-11.23,10-11.23l4.89-8.5.27-8.72Z" />
                                    <path class="cls-28" d="M156.78,420.26l-4.07,7.07s-11.09,10.3-10,11.23,22.07-6.08,23.92-9.78a8.27,8.27,0,0,0,.69-5.08L161.71,425A6.79,6.79,0,0,0,156.78,420.26Z" />
                                    <path class="cls-29" d="M207.68,252.79l3.43,28.54s4.76,19,5.82,32.24S232,411.87,232,411.87H216.4s-2.38-5-1.85-9.51-5-8.46-4.23-13.48-5.55-14.53-6.87-23.78-21.67-73.73-21.67-73.73l-9.51,76.9s1.58,13.47,0,19.29-.53,14-3.17,24.31H153.68s-2-60.78-2.29-75.58-.12-65,6-83.5Z" />
                                    <path class="cls-30" d="M153,279.68c16.65-11,45.33-17.64,55.52-19.75l-.86-7.14H157.34C155.3,259,153.93,268.84,153,279.68Z" />
                                    <path class="cls-31" d="M168.83,169.64s12.53-16.73,29.35,0c0,0,22-.35,27.2,16.83l12.16,34.17,39.81,13.21-1.58,7s-30.3,2.93-43.34,0S210.76,221,210.76,221L209,248.83s2.47,3.35,1.76,5.28-6.14,2.29-12.58,2.29H156.33l-9.16-80.15A86.23,86.23,0,0,1,168.83,169.64Z" />
                                    <path class="cls-18" d="M148.86,252.8s3.08,1.86,5.22,1,3.72-2.93,7.3-3.43,4.29-.15,4.29.35-4.86.93-6.72,2.29c0,0,8-1.44,8.15.07.08.72-6.72.86-8.3,1.86,0,0,7.73-.64,7.8,0s-6.72,1-7.8,2c0,0,5.58,0,5.23,1.17s-3.44-.35-5.8.79-4.15,1.57-6.65,0a16.36,16.36,0,0,0-4-2Z" />
                                    <path class="cls-32" d="M226.78,238.62s-4.69-10.06-7.18-14.7.5-11.29,1.33-17.1S214.39,196,214.39,196l-3.63,25S217,233.13,226.78,238.62Z" />
                                    <path class="cls-31" d="M147.17,176.25c5.21-2.28,9.32,28.72,4.06,35.59s-18.73,22.32-18.73,22.32,2.64.8,0,3.17l19.29,15.46L150,259.2s-20.95-4.69-34.82-12.09S110,223,113,217.17s17.67-22.38,17.67-22.38S136.07,181.09,147.17,176.25Z" />
                                    <path class="cls-33" d="M142.06,193.34s.51,6,8.88,16" />
                                    <path class="cls-34" d="M144.27,199.54s-4.65,10.87-2.21,13.24c2.13,2.08-4.8,10.37-4,15,4.34-5.07,10.14-11.93,13.18-15.9a7,7,0,0,0,.78-1.36C150,208.1,145.58,202.67,144.27,199.54Z" />
                                    <line class="cls-33" x1="230.82" y1="404.71" x2="214.51" y2="404.71" />
                                    <line class="cls-33" x1="169.86" y1="404.71" x2="153.56" y2="404.71" />
                                    <line class="cls-33" x1="181.67" y1="292.28" x2="181.67" y2="256.4" />
                                    <path class="cls-33" d="M187.2,256.4v14.49c0,7-5.53,9-5.53,9" />
                                    <path class="cls-33" d="M198.18,256.4s-.6,10.65,11.92,16.47" />
                                    <path class="cls-33" d="M164.18,255.65s-4.56,18-10.72,19.22" />
                                    <path class="cls-33" d="M205.65,331.45a11.51,11.51,0,0,0,6,3.35" />
                                    <path class="cls-33" d="M168.48,332.33s-5.76,4.05-9.66,5.46" />
                                    <path class="cls-29" d="M175.81,154.48,169,144.93s-6.29-4.6-2.66-10.89,15.23-2.78,20.67-1.21c0,0,11.13.61,11.13,8.23s-8.59,13.42-8.59,13.42Z" />
                                    <path class="cls-18" d="M178.08,158.72l-1.65,11.06a3,3,0,0,0,1.1,2.84,8.18,8.18,0,0,0,5.24,1.56,8.38,8.38,0,0,0,5.16-1.61,3.07,3.07,0,0,0,1.16-2.91l-1.63-10.94Z" />
                                    <path class="cls-35" d="M176.43,170.19c5-.06,9.45-3,12-5.13l-.95-6.34h-9.38l-1.65,11.06A2.8,2.8,0,0,0,176.43,170.19Z" />
                                    <path class="cls-18" d="M185.74,136.81a15.49,15.49,0,0,1-11.54,8.08S173.81,163,182.28,163s10-15.77,10-15.77S185.48,141.81,185.74,136.81Z" />
                                    <path class="cls-28" d="M149.84,199.67s5.43-6.69,15.47,0c0,0,8.13-8.28,17.45,0,0,0,9.86-8.28,19,0,0,0,7.75-3.88,12.07,0l-2.48,14.68H151.64Z" />
                                    <path class="cls-33" d="M215.34,187.79s-.26,3.3-1.06,9-3.69,22.07-3.69,22.07" />
                                    <path class="cls-33" d="M218.51,196.51s-1.8,7.92-6.25,12.15" />
                                    <path class="cls-33" d="M151.64,214.35s-2.22-18.36-1.8-25.72" />
                                    <path class="cls-3" d="M313.15,423.43c0,3.32-5,6-11.07,6s-11.08-2.7-11.08-6,5-6,11.08-6S313.15,420.1,313.15,423.43Z" />
                                    <path class="cls-18" d="M297.49,402.66l-.29,10.25s-3,7.61-1.49,7.78,3.9.26,2.88,2-2.19,4,4,4.44,7.26-1.57,6.49-4c-.62-1.94-4.07-7.53-5.36-9.6a2.8,2.8,0,0,1-.43-1.73l.85-11.63Z" />
                                    <path class="cls-17" d="M295.71,420.69c1.52.17,3.9.26,2.88,2s-2.19,4,4,4.44,7.26-1.57,6.49-4c-.53-1.65-3.13-6-4.68-8.5-1.89.44-4.49,1.3-5.45,2.83-.84,1.34-2,.16-2.9-1.25C295.4,418.3,294.88,420.6,295.71,420.69Z" />
                                    <path class="cls-29" d="M293,326.87l1.59,77.84h15.85s3.17-4.38,2.82-14.24,3.52-11.63,3.88-20.09,4.05-46.51,4.05-46.51Z" />
                                    <path class="cls-36" d="M320.41,332.33s-3.24,6.34-8.18,7.05-5.63,6.52-10.39,12-2.81,10.56-8,14.62l-.8-39.11,28.19-3Z" />
                                    <path class="cls-18" d="M322.45,321.5l11.92-1a3.82,3.82,0,0,1,2.93,1,15.32,15.32,0,0,1,4.09,6.19c1.94,5.29,2,8.19,4.05,8.46s-1.06-25.55-1.06-25.55l-24.22-1.93Z" />
                                    <path class="cls-17" d="M339.83,310.21l1.29,10.1-2.78,2.21a15.93,15.93,0,0,1,3.05,5.14c1.94,5.29,2,8.19,4.05,8.46s-1.06-25.55-1.06-25.55Z" />
                                    <path class="cls-37" d="M303.9,219.12c-21.13,3-31.39,9.51-33.55,11h0l-.44.32h0c-16,11.79-27.28,49.57-26.29,54.65,1.76,9.07,12.42,6.69,14.88,2.82,1.94-3,12.43-18.12,16.87-24.47,1.73,13.42,3,25.39,3,25.39h52.72L334,230.73C324.87,219.5,303.9,219.12,303.9,219.12Z" />
                                    <line class="cls-38" x1="275.37" y1="263.47" x2="271.77" y2="238.62" />
                                    <path class="cls-38" d="M267.47,246s0,8.86,7.32,13.46" />
                                    <path class="cls-18" d="M258.47,253.48,260,222.94a10.48,10.48,0,0,0,1.77-3.71c.5-2.11,4.29-3.91,3.76-5.26s-3.27,1.89-4.05,1.59-.62-.89-.88-4.94.05-7.93-.75-7.9-1.31,9.33-1.31,9.33-.72-11-2.06-10.75-.49,10.27-.49,10.27-2-9-3-9,.53,9.55.53,9.55-3.48-6-4.09-5.68,3.16,7.22,3.16,7.22-1.15,6,1.48,8.94L247.56,253Z" />
                                    <polygon class="cls-39" points="275.64 265.56 275.64 265.56 275.64 265.55 275.64 265.56" />
                                    <path class="cls-40" d="M275.34,263.51l-3-20.85s-5.07,3.77-4.88,12.59-6.68,7.51-7.07,12.92-5.25,9.37-5.25,9.37l2.71,11.19a5,5,0,0,0,.64-.79C260.43,284.9,270.89,269.88,275.34,263.51Z" />
                                    <path class="cls-41" d="M299,288.86h32.1l2.32-46.39-12.82-3c-5.68,4.36-7.27,9.58-7.14,13.21s-5.94,6.87-6.67,12C306.2,268.75,301.1,283,299,288.86Z" />
                                    <path class="cls-42" d="M312.58,278.75l-22.72,6.35s-9.05,0-10.17,3.76H314.5Z" />
                                    <path class="cls-29" d="M237.2,327.13c-3.28-12.33,6.36-23.69,36.37-23.69,36.41,0,50.82,2.11,50.82,2.11v19.38S241.94,345,237.2,327.13Z" />
                                    <path class="cls-18" d="M302.91,208.81l3.36,10.8a3.11,3.11,0,0,1-.9,3.27c-2.88,2.56-9,7.7-10.59,6.3-2-1.85-2.25-14.07-2.25-14.07Z" />
                                    <path class="cls-43" d="M303.9,212l-1-3.18-10.38,6.3a83.56,83.56,0,0,0,.73,9.43C298.77,222.16,302.33,215.53,303.9,212Z" />
                                    <path class="cls-18" d="M285.94,205.73s1.22,11.39,3.8,12.61,11.7-5.23,13.6-9c0,0,4.92-3,2.46-7.07l-11.12-9.5-9.8,3.27Z" />
                                    <path class="cls-17" d="M291.44,196.68s2.91-2,4.32,1.06,1.76,6.08,6.87,6c0,0,.53-2.29,3.17-1.5a60.78,60.78,0,0,0,1.06-7.22c.26-3.52-5.81-13-16.12-3.7,0,0-5.73-2.11-8.1,3.35s-.53,11.54-.53,11.54,2.64,1.85,7.66,0C289.77,206.2,285.72,194.92,291.44,196.68Z" />
                                    <path class="cls-44" d="M260.4,249.83,259,287.24H244.27s-4.88-1.81-4.22-13.84,5.68-24.31,5.68-24.31Z" />
                                    <path class="cls-45" d="M334,230.73c4.76,6,12.93,27.45,15.15,48a9,9,0,0,1-9,10h-29.4s-2.38-7.13-1.19-12l12.28-2.38s-.92-2.91,1.72-3.17c0,0-1.32-6.49-4.62-18.44S328.84,224.25,334,230.73Z" />
                                    <path class="cls-38" d="M322.49,236s-6.21,6.06-2.87,19.28" />
                                    <polygon class="cls-46" points="379.98 287.24 325.37 287.24 332.11 249.83 386.72 249.83 379.98 287.24" />
                                    <ellipse class="cls-17" cx="356.04" cy="268.53" rx="7.37" ry="6.16" transform="translate(-87.93 310.54) rotate(-42.43)" />
                                    <path class="cls-47" d="M434.74,273.3s2.66-3,7.5-.29" />
                                    <path class="cls-3" d="M464.4,420.66c.19,2.06-4.82,4.19-11.17,4.74s-11.66-.66-11.84-2.73,4.83-4.19,11.18-4.75S464.22,418.59,464.4,420.66Z" />
                                    <path class="cls-3" d="M516.34,420.66c.18,2.06-4.83,4.19-11.18,4.74s-11.65-.66-11.83-2.73,4.82-4.19,11.18-4.75S516.16,418.59,516.34,420.66Z" />
                                    <path class="cls-18" d="M460.67,378.1l-3.94,35-7,4.9s-7.25,1.06-7.22,2.52,15.32-.3,19-.37.61-2.66.95-5.57,8.8-36.65,8.8-36.65Z" />
                                    <path class="cls-18" d="M503.51,378.1l5.15,35-7,4.9s-7.24,1.06-7.22,2.52,15.33-.3,19-.37.6-2.66.94-5.57-.3-36.65-.3-36.65Z" />
                                    <path class="cls-48" d="M508,244.25s7.67,11.31,7.36,42.47l1.63,94H499.37L486,291.38l-7.93,48.74s3.84,11.56-4.78,40.64H457.64L460.55,333a347.45,347.45,0,0,1,9.07-88.79Z" />
                                    <path class="cls-49" d="M486,291.38S481.42,265,482.66,243" />
                                    <path class="cls-49" d="M478,243S476.73,266,483,266.25" />
                                    <path class="cls-50" d="M508,244.25h-38.4q-1.06,4.45-2,8.84a24.35,24.35,0,0,0,10.42.36c8.39-1.31,25.75,10.94,35.92,10.81C511.86,249.92,508,244.25,508,244.25Z" />
                                    <path class="cls-18" d="M468.12,188.28,445,204.78l-9.53-12,1-.64L433,183.82l-4.7,2.94a2.87,2.87,0,0,0-1.28,3.11c.56,2.26,1.88,5.58,4.83,5.76,0,0,3,19.48,11.1,22S476.67,198,476.67,198Z" />
                                    <path class="cls-51" d="M468.12,188.28l-15.51,11.05c5.17.13,13.71,1.07,15.16,5.81,5.11-3.88,8.9-7.14,8.9-7.14Z" />
                                    <path class="cls-31" d="M479.69,178.59l-12.08,8.61a1.65,1.65,0,0,0-.26,2.46L476.84,200Z" />
                                    <path class="cls-21" d="M483.71,177.66c-4.84,2.73-13.39,16.29-13.39,16.29a27.1,27.1,0,0,1,2.12-12.68s-6-.09-6.7-1.5c-2.3-4.62,4.94-15,4.94-15-9.78-2.29-13.3-8.19-6.87-12.07s13.74-7.31,13.74-7.31,3.84-6,11.44-.88c4.85,3.26,4.31,9.34,6,11.54s6.53,5.11,4.76,6.34c0,0,7.93,2.73,9.6,10,0,0-8-1.49-12.5,1.33Z" />
                                    <path class="cls-31" d="M496.84,173.79c5.11-4.24,12.86-4.85,16.38-1.07S517,189.37,517,189.37h-4.94s-5.81,18.41-6,26.34,6.51,29.42,6.51,29.42c.93,3.17-3.17,3.43-9.91,3.43h-32.5c-6.6,0-3.57-5.55-2.24-11.23s5.9-23.12,6-26.82-6.66-9.33-3.62-16.56,8.28-16.91,13.39-16.29Z" />
                                    <path class="cls-47" d="M497.41,183.82,496.22,191s1.45,1.65,4.95,1.78" />
                                    <path class="cls-47" d="M492.39,186.66s-.73,7.73,7.86,9.52" />
                                    <path class="cls-52" d="M506.09,215.71a45.29,45.29,0,0,1,.94-7.15l-8.16-16.17L496.22,191l.72-4.3c-4.05,1.52-2.11,6.74-1.38,10.11s-.53,5-5.55,4.76-4.89.26-2,5,4.68,11.06,3.52,20.48c-.68,5.48-3.8,16.94-5.44,21.53h16.58c6.74,0,10.84-.26,9.91-3.43C512.6,245.13,505.91,223.64,506.09,215.71Z" />
                                    <path class="cls-53" d="M445,204.78a4.45,4.45,0,0,1,2.1,3.32" />
                                    <path class="cls-54" d="M438,195.93c-1.68,0-4.31-.13-6.14-.3a67.62,67.62,0,0,0,1.49,6.72c3.2-1.43,7.94,0,10.43.88Z" />
                                    <path class="cls-55" d="M459.94,343.1l-2.3,37.66H473.3c8.62-29.08,4.77-40.64,4.77-40.64L486,291.38l-1.59-11.12C480.9,294.36,467.86,325,459.94,343.1Z" />
                                    <path class="cls-17" d="M442.47,420.48c0,1.45,15.32-.3,19-.37,3.08-.06,1.46-1.87,1-4.16-6.41,3.29-3.57-2.85-5.78-2.89l-7,4.9S442.44,419,442.47,420.48Z" />
                                    <path class="cls-17" d="M494.4,420.48c0,1.45,15.33-.3,19-.37,3.08-.06,1.45-1.87,1-4.16-6.42,3.29-3.58-2.85-5.79-2.89l-7,4.9S494.38,419,494.4,420.48Z" />
                                    <path class="cls-56" d="M443.75,183.82s-8.25-3.56-5.11-13.6,15.17-8.06,14.51-17.31-10.12-7-14.51-9.65-.25-10.17-6.81-13.34-13,1.58-22,3.17-16.78,3-16.51,0,4.62-3.44,3.17-7.14-8.86-3.7-9.91-2.64c0,0,8.06,0,8.32,2.78s-6,4.09-5.69,9.11,11.24,4,21.94,3.3,9.74,3.57,8.9,8.86.88,8.85,7.88,9.77,10.26,1.8,6.34,9.52c-3.37,6.65-.69,12.81,5.62,17.17Z" />
                                    <path class="cls-18" d="M473.94,162.51s.7,1.23,2.2,4.58,3.26,4.84,6.87,4.49l.7,6.08s-7,5.65-3.17,7.4,9.25-6.16,16.3-11.27c0,0-5.6-2.63-7.23-7.5-2.81-8.45-7.13-6.16-9.24-15.06C480.37,151.23,477.81,160,473.94,162.51Z" />
                                    <path class="cls-57" d="M489.61,166.29c-.11-.34-.23-.67-.35-1-1.33,2.87-4.17,6-6.25,6.27l.28,2.47L495,172.7A13.41,13.41,0,0,1,489.61,166.29Z" />
                                    <path class="cls-18" d="M515.38,189.37s-8.19-4.23-16.25,1.19l-12.95,93.55s-1.85,2.17-.66,3.13,4,.56,7.13.56h8.72s-5.68-3.82-7.13-4.55-2-3-2-3,12.15-29.33,11-45.58A313.39,313.39,0,0,0,515.38,189.37Z" />
                                    <path class="cls-58" d="M430.89,183.24a24.56,24.56,0,0,0,3.59,10.83,2.09,2.09,0,0,0,1.77,1h7.25a2.11,2.11,0,0,0,1.77-1,24.56,24.56,0,0,0,3.59-10.83,1,1,0,0,0-1-1.13H431.92A1,1,0,0,0,430.89,183.24Z" />
                                    <ellipse class="cls-3" cx="577.4" cy="416.76" rx="28.98" ry="3.12" />
                                    <rect class="cls-59" x="554.44" y="302.83" width="45.91" height="113.93" />
                                    <line class="cls-60" x1="600.35" y1="340.26" x2="554.44" y2="340.26" />
                                    <line class="cls-60" x1="600.35" y1="378.74" x2="554.44" y2="378.74" />
                                    <line class="cls-60" x1="600.35" y1="343.52" x2="554.44" y2="343.52" />
                                    <line class="cls-60" x1="600.35" y1="306.09" x2="554.44" y2="306.09" />
                                    <line class="cls-60" x1="600.35" y1="382" x2="554.44" y2="382" />
                                    <path class="cls-1" d="M580.4,312.73a3,3,0,1,1-3-2.92A3,3,0,0,1,580.4,312.73Z" />
                                    <path class="cls-1" d="M580.4,350.86a3,3,0,1,1-3-2.92A3,3,0,0,1,580.4,350.86Z" />
                                    <path class="cls-1" d="M580.4,389a3,3,0,1,1-3-2.92A3,3,0,0,1,580.4,389Z" />
                                    <polygon class="cls-61" points="554.44 321.36 554.44 416.76 567.55 416.76 554.44 321.36" />
                                    <path class="cls-62" d="M568.38,282.94a20.47,20.47,0,0,1-5.56-19.15s-12.29-12-4.1-19.29c0,0-4.76-30,5-31.84S574.57,238,574.57,238s5.55-1,2,17.12c0,0,7.66.72,2.51,27.94Z" />
                                    <path class="cls-63" d="M563.74,212.66s2.55,40.12,10.13,70.35" />
                                    <path class="cls-64" d="M574.44,283H587s14-22.13,10-30.32c0,0,8.06-18.37,2.77-20.88s-11.89,12.69-11.89,12.69S575.75,244.1,574.44,283Z" />
                                    <path class="cls-63" d="M599.81,231.81s-14.14,25.6-19,51.2" />
                                    <path class="cls-17" d="M577.4,279.88c-6.73,0-12.1.8-12,1.79l2.08,21.16h19.83l2.09-21.16C589.49,280.68,584.12,279.88,577.4,279.88Z" />
                                    <ellipse class="cls-3" cx="536.67" cy="429.97" rx="7" ry="2.38" />
                                    <ellipse class="cls-3" cx="243.56" cy="429.97" rx="7" ry="2.38" />
                                    <rect class="cls-58" x="255.15" y="294.28" width="269.46" height="22.2" />
                                    <polygon class="cls-59" points="248.71 294.28 241.26 429.45 246.22 429.45 264.68 294.28 248.71 294.28" />
                                    <polygon class="cls-59" points="531.07 294.28 538.51 429.45 533.55 429.45 515.09 294.28 531.07 294.28" />
                                    <polygon class="cls-65" points="248.42 299.47 532.07 312.5 531.07 294.28 248.71 294.28 248.42 299.47" />
                                    <rect class="cls-58" x="236.59" y="286.72" width="306.6" height="9.67" />
                                    <circle class="cls-66" cx="538.51" cy="148.13" r="23.64" />
                                    <circle class="cls-31" cx="537.12" cy="146.68" r="23.64" transform="translate(286.24 643.75) rotate(-78.49)" />
                                    <circle class="cls-1" cx="537.12" cy="146.68" r="17.66" transform="translate(271.82 636.2) rotate(-76.82)" />
                                    <polyline class="cls-67" points="537.12 132.25 537.12 147.43 547.03 139.76" />
                                </g>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>

            <div>
                <div class="mx-auto">
                    <div class="min-h-full flex items-center justify-center pb-10 lg:py-10 sm:px-6 lg:px-8">
                        <div class="w-full">
                            <div class="mx-auto">

                                <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700">ارزش های تولیدات</h2>

                                <p class="mt-4 text-gray-500">
                                پلتفرم تولیدات به کاربران خود این امکان را می دهد که تمامی اطلاعات کسب و کار خود را در فضایی اختصاصی و مناسب درج کنند. صاحبان کسب و کار می توانند محصولات و خدمات خود را به همراه عکس و توضیحات لازم به مخاطبین خود معرفی کنند.                                 </p>

                                <div class="grid items-center gap-x-4 md:gap-x-8 grid-cols-3">

                                    <div>
                                        <div class="flex items-center justify-center flex-col">
                                            <div class="w-full text-center">
                                                <h3 class="text-2xl md:text-3xl font-semibold mt-5 text-tolidatColor"><?php echo number_format($list['registerCount']) ?></h3>
                                            </div>
                                            <div class="w-full text-center mt-3 text-sm md:text-base">
                                                <span class="text-tolidatColor">کمپانی های ثبت شده</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-center flex-col">
                                            <div class="w-full text-center">
                                                <h3 class="text-2xl md:text-3xl font-semibold mt-5 text-tolidatColor"><?php echo number_format($list['productsCount']) ?></h3>
                                            </div>
                                            <div class="w-full text-center mt-3 text-sm md:text-base">
                                                <span class="text-tolidatColor">محصولات ثبت شده</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-center flex-col">
                                            <div class="w-full text-center">
                                                <h3 class="text-2xl md:text-3xl font-semibold mt-5 text-tolidatColor"><?php echo number_format($list['registerCount']) ?></h3>
                                            </div>
                                            <div class="w-full text-center mt-3 text-sm md:text-base">
                                                <span class="text-tolidatColor">کمپانی های ثبت شده</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <p class="mt-4 text-gray-500">
                                دسترسی راحت مشتریان به اطلاعات شما، ارتباط میان شما و آنها را بهتر و متداوم تر خواهد کرد.                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 items-center mt-6">

                                    <div>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 text-tolidatColor">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="px-3">
                                                <div class="text-sm text-gray-500">
                                                دست یابی به رتبه بالاتر در گوگل و تقویت SEO
<<<<<<< HEAD

=======
>>>>>>> a53305a (edit page)
                                                                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 text-tolidatColor">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="px-3">
                                                <div class="text-sm text-gray-500">
                                                کسب سهم بالاتری از بازار و جذب مشتریان بیشتر و نیل به پیروزی در بازار رقابتی
                                                                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 text-tolidatColor">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="px-3">
                                                <div class="text-sm text-gray-500">
                                                صرف هزینه کمتر و دریافت بازدهی بالاتر
                                                                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 text-tolidatColor">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div class="px-3">
                                                <div class="text-sm text-gray-500">
                                                پشتیبانی سریع و آسان و درج اطلاعات کمپانی در قسمت ادمین توسط مشترک
                                                                                            </div>
                                            </div>
                                        </div>
                                    </div>

<<<<<<< HEAD
=======


>>>>>>> a53305a (edit page)
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- blog -->
<div class="container mx-auto mt-10 px-4 text-center">
    <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700">مطالب اخیر وبلاگ</h3>
    <p class="mt-4 text-gray-500">
    پلتفرم تولیدات علاوه بر اینکه گام به گام تا پیشرفت کسب و کارتان همراه با شماست، سعی بر آن دارد تا اطلاعات تخصصی را که هر مدیر و دارنده ی کسب و کاری باید بداند، در اختیار شما بگذارد و علاوه بر ساختن حرفه ای مجموعه تان، مدیران حرفه ای نیز پرورش دهد.
    </p>
</div>

<div class="container mx-auto mt-6 px-4">
    <?php if (isset($list['articles_list'])) : ?>
        <div class="container-carousel-blog " dir="ltr">
            <?php foreach ($list['articles_list'] as $id => $field) : ?>
                <div dir="rtl">
                    <div class="h-full  grid grid-cols-3 rounded-lg  border-2">
                        <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] ?>" class="flex p-2">
                            <img class="w-28 object-center self-center rounded-md" src="<?php echo ((isset($field['image']) && file_exists(STATIC_ROOT_DIR . '/images/article/90.90.' . $field['image'])) ? STATIC_RELA_DIR . '/images/article/90.90.' . $field['image'] : DEFULT_PRODUCT_ADDRESS) ?>" alt="<?php echo  $field['brif_description'] ?>">
                        </a>
                        <div class="px-3 py-2 col-span-2">
                            <div class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo convertDate($field['date']) ?></div>
                            <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] ?>" class="">
                                <h3 class="text-md  font-semibold text-gray-900 mb-3 truncate"><?php echo $field['title'] ?></h3>
                            </a>
                            <p class="leading-relaxed mb-3 text-xs truncate"><?php echo  $field['brif_description'] ?></p>
                            <div class="flex items-center flex-wrap ">
                                <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
                                    <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5l7 7-7 7"></path>
                                    </svg>
                                    مشاهده جزئیات
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript" src="<?php echo TEMPLATE_DIR ?>assets/js/slick.min.js"></script>

<script>
    $('.container-carousel-company').slick({
        nextArrow:'<button type="button" class=" nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow:'<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
        // autoplay: true,
        autoplaySpeed: 3000,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        // adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1280,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.container-carousel-blog').slick({
        nextArrow:'<button type="button" class="nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow:'<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 640,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
</script>
