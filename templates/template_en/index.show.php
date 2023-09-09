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

    body {
        background-image: url('<?php echo TEMPLATE_DIR ?>assets/image/back/back2.jpg');
        background-repeat: round;
        background-size: contain;
    }

    .input-register {
        outline: turquoise !important;
    }

    .hidden-style {
        display: none;
    }

    .block-style {
        display: block;
    }

    @media screen and (max-width: 568px) {
        .hidden-style {
            display: block !important;
        }

        .block-style {
            display: none !important;
        }
    }
</style>

<!-- slider -->
<div class="bgs-cover">
    <div class="items-center px-5 bg-gray-500s">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-5  items-center container mx-auto">
            <h1 class="hidden-style text-2xl relative py-5 pr-4 font-semibold rounded-lg text-center md:text-right leading-relaxed after:content-[''] after:right-0 after:top-8  after:w-2 after:absolute after:bg-teal-100 after:h-52">
            We help your company to be seen better through products
            </h1>
            <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/template1.jpg" alt="">
            <div class="max-w-lg mx-auto">
                <h1 class="block-style text-5xl relative py-5 pr-4 font-semibold rounded-lg text-center md:text-right leading-relaxed after:content-[''] after:right-0 after:top-8  after:w-2 after:absolute after:bg-teal-100 after:h-52">
                We help your company to be seen better through products
                </h1>

                <div class="justify-center flex  md:justify-start p-1   mr-5 mt-14 h-10 relative">
                    <?php if($information_company == null):?>
                    <a href="<?php echo RELA_DIR ?>register" class="cta-home-register w-40 py-0 px-4 text-center border border-transparent   rounded text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none">
                        Register
                    </a>
                    <?php else: ?>
                        <a href="<?php echo RELA_DIR ?>profile" class="cta-home-register w-40 py-0 px-4 text-center border border-transparent   rounded text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none">
                         My Account
                    </a>
                    <?php endif; ?>
                </div>
                <div class="grid items-center gap-y-16  grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 container mx-auto mt-9 mb-8">

                    <div class="flex items-center justify-center flex-col px-2">
                        <div class="w-full flex  sm:text-xl  justify-center md:text-3xl lg:text-3xl  font-medium text-orange-400">
                            % 99 </div>
                        <div class="w-full text-center text-orange-400">
                            <h3 class="text-sm"> Customer retention </h3>
                        </div>
                    </div>

                    <div class="h-full">
                        <div class="flex items-center justify-center flex-col px-2">
                            <div class="w-full flex  sm:text-xl  justify-center md:text-3xl lg:text-3xl  font-medium	 text-blue-300">
                                12 +
                            </div>
                            <div class="w-full text-center text-blue-300">
                                <h3 class="text-sm"> Year of service</h3>
                            </div>
                        </div>
                    </div>

                    <div class="h-full">
                        <div class="flex items-center justify-center flex-col px-2">
                            <div class="w-full  sm:text-xl  justify-center md:text-3xl lg:text-3xl flex font-medium	 text-red-400">
                                50 + </div>
                            <div class="w-full text-center text-red-500">
                                <h3 class="text-sm"> professionals</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- icons -->
<div class="relative bottom-3">
    <div class="items-center mt-10 mb-4">
        <div class="grid items-center gap-y-16 gap-x-8 grid-cols-2 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-4 max-w-2xl mx-auto">

            <div>
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-10 flex  justify-center">
                        <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/icon_homepage/jaygah_behtar.svg" alt="">
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-sm font-medium mt-5"> better place</h3>
                    </div>
                </div>
            </div>
            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-10 text-center">
                        <div class="justify-center flex">
                            <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/icon_homepage/pardakht.svg" alt="">
                        </div>
                    </div>
                    <div class="w-full text-center">
                        <h3 class="text-sm font-medium mt-5">  Automatic payments</h3>
                    </div>

                </div>
            </div>

            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-10 flex justify-center">
                        <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/icon_homepage/stratejy.svg" alt="">
                    </div>

                </div>
                <div class="w-full text-center">
                    <h3 class="text-sm font-medium mt-5"> The best strategy</h3>
                </div>

            </div>

            <div class="h-full">
                <div class="flex items-center justify-center flex-col px-4">
                    <div class="w-10 justify-center flex">
                        <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/icon_homepage/poshtibani.svg" alt="">
                    </div>

                </div>
                <div class="w-full text-center">
                    <h3 class="text-sm font-medium mt-5">Support</h3>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- contact us -->
<div class="relative" id="">
    <div class="items-center">
        <div class="grid items-center gap-x-8 grid-cols-1 md:grid-cols-2 container mx-auto px-4">
            <div>
                <div class="flex items-center justify-center text-slate-800">
                    <div class="max-w-md w-full">
                        <div class="mt-6">
                            <h3 class="text-3xl font-semibold mb-8">Why register in productions? </h3>
                            <div class="px-3 relative">
                                <div class="text-sm font-medium	text-slate-600 leading-relaxed mb-5 after:content-[''] after:right-0 after:top-3  after:w-2 after:absolute after:bg-teal-100 after:h-10">
                                Introduction of different businesses in large dimensions and optimized cost in the whole country, in such a way that with the lowest cost of advertising and SEO, many customers will know you.

                                </div>
                            </div>
                            <div class="px-3 relative">
                                <div class="text-sm font-medium	text-slate-600 leading-relaxed mb-5 after:content-[''] after:right-0 after:top-3  after:w-2 after:absolute after:bg-orange-400 after:h-10">
                                Having specific and SEO profiles of each business on the production site, which can be shown to the audience with a simple Google search. In such a way that there is no longer a need for a dedicated site for each business, and your business profile is loaded on the production site with all the details and a complete description of the services.
                                </div>
                            </div>
                            <div class="px-3 relative">
                                <div class="text-sm font-medium	text-slate-600 leading-relaxed mb-5 after:content-[''] after:right-0 after:top-3  after:w-2 after:absolute after:bg-red-400 after:h-10">
                                The products site is the only dedicated platform that houses all Iranian businesses, and thus has its own target audience. The purpose of this is to connect customers directly to manufacturers and business owners and take advantage of their benefits and services.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                </div>

            </div>
            <div class="mt-6">
                <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/template2.jpg" alt="">
            </div>
        </div>
    </div>

    <!-- company -->
    <div class="container mx-auto px-4 mt-10 ">
        <h3 class="text-xl md:text-2xl text-center md:text-right font-extrabold tracking-tight text-gray-700">
            کمپانی های فعال </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4 gap-x-8 items-center mt-6">

            <?php if ($list['higher_company']) : ?>
                <?php $border_color = ['teal', 'red', 'slate', 'orange']; ?>
                <?php foreach ($list['higher_company'] as $item => $value) : $i = random_int(0, 3); ?>

                    <a href="<?php echo RELA_DIR . 'company/Detail/' . $value['Company_id'] . '/' . cleanUrl($value['company_name']); ?>">
                        <div class="relative">
                            <div class="pt-3 pb-3 px-3 flex flex-col h-30 border border-slate-300 bg-white shadow-lg rounded-xl
after:content-[''] after:-right-2 after:top-0 after:w-full  after:absolute after:rounded-xl after:-z-50
               <?php echo 'after:bg-' . $border_color[$i] . '-400' ?> after:h-full">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-tolidatColor w-20">
                                        <img class="object-center self-center rounded-md" src="<?php echo ((isset($value['image']) && file_exists(ROOT_DIR . 'statics/images/company/' . $value['Company_id'] . "/logo/" . $value['image'])) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : DEFULT_LOGO_ADDRESS); ?>" alt="<?php echo  ' محصول ' . $fields['brif_description'] ?>">
                                    </div>
                                    <div class="px-3">
                                        <div class="text-sm font-semibold text-gray-500">
                                            <h2 class="truncate">
                                                <?php echo $value['company_name'] ?>
                                            </h2>
                                            <p class="font-normal text-gray-500 mt-2 h-16	overflow-y-hidden">
                                                <?php echo  $value['meta_keyword'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>








            <a href="<?php echo RELA_DIR ?>company">
                <div class="relative">
                    <div class="pt-3 pb-3  flex-row h-28  shadow-lg rounded-xl after:content-[''] after:-right-2
                after:top-0 after:w-full  after:absolute after:rounded-xl after:-z-50
              after:bg-slate-200 after:h-full bg-orange-400">
                        <p class="font-normal text-white  mr-auto ml-auto mb-0 mt-0 h-full text-center">
                             See more
                            <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="mr-auto ml-auto mb-0 mt-0 bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" fill="white"></path>
                            </svg>
                        </p>
                    </div>
                </div>
            </a>

        </div>
    </div>
    <div class="max-w-sm mx-auto shadow-lg  rounded-xl bg-teal-50 mt-10 lg:mt-32">
        <div class="min-h-full flex items-center justify-center p-6">
            <div class="max-w-md w-full">
                <div class="mb-4">
                    <h2 class="text-center text-xl md:text-2xl font-extrabold text-gray-700">
                    Fast communication with us
                    </h2>
                </div>
                <div data-class="messageStackSuccess"></div>
                <?php
                $msg = (strlen($messageStack->output('message')) ? $messageStack->output('message') : "");
                if (isset($msg) && !empty($msg)) : ?>
                    <?php echo $msg; ?>
                <?php endif ?>

                <form action="crm" method="post" class="fastform" id="fast-register" role="form">
                    <!-- <input type="hidden" name="fastform" value="1"> -->
                    <div class="izi-container"></div>

                    <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">  First name and last name
</label>
                    <input class="mt-1  block w-full shadow-sm sm:text-sm border border-gray-300 rounded px-3 py-2" type="text" name="name" required oninvalid="setCustomValidity('نام و نام خانوادگی را وارد نمایید')" oninput="setCustomValidity('')">


                    <label for="email" class="block text-sm font-medium text-gray-700 mt-3 after:content-['*'] after:ml-0.5 after:text-red-500">Email</label>
                    <input class="mt-1  block w-full shadow-sm sm:text-sm border border-gray-300 rounded px-3 py-2" type="text" name="email" required oninvalid="setCustomValidity('ایمیل را وارد نمایید')" oninput="setCustomValidity('')">

                    <label for="mobile" class="block text-sm font-medium text-gray-700 mt-3 after:content-['*'] after:ml-0.5 after:text-red-500"> Phone number
</label>
                    <input class="mt-1  block w-full shadow-sm sm:text-sm border border-gray-300 rounded px-3 py-2" type="text" required name="mobile" oninvalid="setCustomValidity('شماره موبایل را وارد نمایید')" oninput="setCustomValidity('')">


                    <script src="https://www.google.com/recaptcha/api.js?render=6LdmjDsmAAAAANswKgj3737SohuPSA7AIhSxMfNm"></script>
                        <script>
                            $('#fast-register').submit(function(event) {
                                event.preventDefault();
                                grecaptcha.ready(function() {
                                    grecaptcha.execute('6LdmjDsmAAAAANswKgj3737SohuPSA7AIhSxMfNm', {
                                        action: 'submit'
                                    }).then(function(token) {
                                        // $('.recaptcha-btn').show();
                                        $('#fast-register').prepend('<input type="hidden" name="token" value="' + token + '">');
                                        $('#fast-register').prepend('<input type="hidden" name="fastform" value="1">');
                                        $('#fast-register').prepend('<input type="hidden" name="action" value="submit">');
                                        $('#fast-register').unbind('submit').submit();
                                    });;
                                });
                            });
                        </script>
                    <button type="submit"  class="recaptcha-btn mt-4 group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        </span>
                        Request
                    </button>


                </form>

            </div>
        </div>
    </div>
</div>

<!-- article -->
<div class="container mx-auto px-4 mt-10 ">
    <h3 class="text-xl md:text-2xl text-center md:text-center font-extrabold tracking-tight text-gray-700">
    Articles</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-y-3 gap-x-8 items-center mt-6">


        <?php if (isset($list['articles_list'])) : ?>
            <?php foreach ($list['articles_list'] as $id => $field) : ?>
                <div class="pt-3 pb-3 px-3 flex flex-col h-30 border border-slate-300 shadow-lg rounded-xl   bg-white">
                    <div class="flex items-center">
                        <div class="text-sm font-semibold text-gray-500 w-full">
                            <h2 class="truncate">
                                <?php echo $field['title'] ?>
                            </h2>
                            <p class="p font-normal text-gray-500 mt-2 truncate">
                                <?php echo  $field['brif_description'] ?>
                            </p>
                            <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . '/' .  urlencode($field['title']) ?>" class="text-small font-normal text-teal-500	mt-2 block"> Let's read more</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>



        <a href="<?php echo RELA_DIR . 'article' ?>">
            <div class="pt-3 pb-3  flex-row   shadow-lg rounded-xl bg-orange-400 text-sm font-semibold text-white text-center">
                <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="80" height="100%" fill="currentColor" class=" mr-auto ml-auto mb-0 mt-0 bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" fill="white"></path>
                </svg>

            </div>
        </a>
    </div>

</div>
<div class="mt-14">
    <img class="object-center self-center rounded-md" src="<?php echo TEMPLATE_DIR ?>assets/image/back/back1.jpg" alt="">
</div>