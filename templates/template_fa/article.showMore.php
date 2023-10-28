<link rel="stylesheet" type="text/css" href="<?php   ?><?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/slick.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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

    /* .rate,
    .comment label {
        float: right;
        color: #c8c8c8;
        display: flex;
        align-items: center;
        height: 23px;
    }

    .rate,
    .comment label:before {
        content: "★";
        display: inline-block;
        font-size: 1.5em;
        color: #ffc107;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    } */
    .article-content {
        line-height: 2em;
    }

    .article-content a {
        color: #ff710d;
        font-weight: bold;
    }

    h1 {
        font-size: 2em;
    }

    h2 {
        font-size: 1.6em;
        padding: 1em 0 .5em 0;
    }

    h3 {
        font-size: 1.3em;
    }

    h4 {
        font-size: 1.2em;
    }
    .article-content ol, .article-content ul{
        list-style: decimal;
        margin-block-end: 1em;
        margin-block-start: 1em;
        padding: 0 40px 0 0 ;
    }
    .article-content ul{
        list-style: circle;
    }
    
</style>

<!-- breadcrumb -->
<?php include_once("breadcrumb.php"); ?>


<!-- boxContainer -->
<div class="boxContainer whiteBg boxBorder roundCorner container mx-auto px-4 ">
    <div class="">


        <div class="detailNews border-2 my-4 bg-gray-50 rounded ">

            <h1 class="bg-gray-200 p-3" title="<?php echo  $list['list']['Article_id'] ?>" data-articleID="<?php echo (strlen($list['list']['Article_id']) ? $list['list']['Article_id'] : '-'); ?>">
                <?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>
            </h1>

            <div class="row p-4 article-content">
                <div class="">

                    <div class="flex justify-center m-2 items-start">
                        <?php
                        $file = ROOT_DIR . ltrim($list['list']['image'], '/');
                        ?>
                        <img class="rounded-md object-contain" src="<?php echo (strlen($list['list']['image']) ? STATIC_RELA_DIR . '/images/article/' . $list['list']['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="<?php echo (strlen($list['list']['title']) ? $list['list']['title'] : '-'); ?>">
                    </div>

                    <div class="col-span-2">
                        <?php $content = tableOfContent($list['list']['description']); ?>
                        <ul class="mb-3">
                            <?php
                            foreach ($content['list'] as $key => $item) :
                            ?>
                                <li class="pb-1">
                                    <a href="#<?php echo $item['anchor'] ?>"><?php echo $item['label'] ?></a>
                                </li>
                            <?php
                            endforeach;
                            ?>

                        </ul>
                        <article class="text-justify">
                            <?php //echo (strlen($list['list']['description']) ? $list['list']['description'] : '-'); 
                            ?>
                            <?php echo $content['content']; ?>
                        </article>

                    </div>

                </div>
            </div>

            <div class="border-b-2 mb-2"></div>

            <div class="w-full p-4 show-comment">
                <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700 mb-6">دیدگاه ها</h2>

                <?php if (isset($list['comment_list'])) :
                    if (is_array($list['comment_list'])) {
                ?>

                        <?php foreach ($list['comment_list'] as $date => $value) : ?>
                            <div>
                                <div class="rating">
                                    <span>امتیاز: </span>
                                    <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st1<?php echo $value['Survey_id'] ?>" value="5" <?php echo ($value['rate'] == 5) ?  "checked" : "" ?> />
                                    <label for="st1<?php echo $value['Survey_id'] ?>" title="عالی"></label>
                                    <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st2<?php echo $value['Survey_id'] ?>" value="4" <?php echo ($value['rate'] == 4) ?  "checked" : "" ?> />
                                    <label for="st2<?php echo $value['Survey_id'] ?>" title="خوب"></label>
                                    <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st3<?php echo $value['Survey_id'] ?>" value="3" <?php echo ($value['rate'] == 3) ?  "checked" : "" ?> />
                                    <label for="st3<?php echo $value['survey_id'] ?>" title="معمولی"></label>
                                    <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st4<?php echo $value['Survey_id'] ?>" value="2" <?php echo ($value['rate'] == 2) ?  "checked" : "" ?> />
                                    <label for="st4<?php echo $value['Survey_id'] ?>" title="ضعیف"></label>
                                    <input name="rate<?php echo $value['Survey_id'] ?>" type="radio" id="st5<?php echo $value['Survey_id'] ?>" value="1" <?php echo ($value['rate'] == 1) ?  "checked" : "" ?> />
                                    <label for="st5<?php echo $value['Survey_id'] ?>" title="بد"></label>
                                    <span id="rating-hover-label"></span>
                                </div>

                                <div class="d-flex pb-3 text-xs text-gray-400">
                                    <span><?php echo $value['date'] ?></span>،
                                    <span> <?php echo $value['user_name'] ?> </span>
                                </div>

                                <div class="my-4">
                                    <p><?php echo $value['comment'] ?></p>
                                </div>

                                <div class="border-b pb-4 flex mt-4 mb-4 justify-end">
                                    <p class="text-sm text-gray-600 ml-4">آیا این دیدگاه مفید بود؟</p>

                                    <div class="flex text-gray-400 text-base gap-2">
                                        <span class="flex items-center like" data-surveyid="<?php echo $value['Survey_id'] ?>">
                                            <span class="like"><?php echo  $value['like'] ?></span>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                </svg>
                                            </div>
                                        </span>
                                        <span class="flex items-center dis_like" data-surveyid="<?php echo $value['Survey_id'] ?>">
                                            <span class="dis_like"><?php echo $value['dis_like'] ?></span>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z" />
                                                </svg>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php
                    } else { ?>
                        <div class="container mx-auto mt-10 px-4 text-center">
                            <div class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['comment_list'] ?></div>
                        </div>
                <?php  }
                endif;
                ?>
            </div>

            <div class="border-b-2"></div>

            <div class="w-full p-4 set-comment">
                <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700 mb-6">دیدگاه خود را ثبت کنید</h2>

                <form action="" class="w-full px-6">



                    <div class="rating">
                        <span>امتیاز: </span>
                        <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }} value="5" />
                        <label for="st5" title="عالی"></label>
                        <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }} value="4" />
                        <label for="st4" title="خوب"></label>
                        <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }} value="3" />
                        <label for="st3" title="معمولی"></label>
                        <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }} value="2" />
                        <label for="st2" title="ضعیف"></label>
                        <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }} value="1" />
                        <label for="st1" title="بد"></label>
                        <span id="rating-hover-label"></span>
                    </div>

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام</label>
                        <input name="user_name" type="text" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none" id="name" minlength="1" tabindex="1" required>
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">ایمیل</label>
                        <input name="user_email" type="email" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none" id="email" minlength="1" tabindex="2" placeholder="test@test.com" required>
                    </div>

                    <div class="mb-5">
                        <label for="msg" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">دیدگاه</label>
                        <textarea name="comment" type="text" value="" class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none" id="msg" minlength="1" tabindex="3" placeholder="test@test.com" rows="3" required>
                    </textarea>
                    </div>
                    <input type="hidden" name="type" value="article">
                    <input type="hidden" name="type_id" value="<?php echo $list['list']['Article_id'] ?>">
                    <button class="group relative w-50 py-2 px-4 border border-transparent text-md font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">ارسال</button>
                </form>
            </div>

            <div class="noPadding bg-gray-100 p-2">
                <div class="flex justify-between">

                    <?php /*
                if (strlen($list['list']['meta_keyword'])) { ?>
                    <span class="badge tag"><?php echo (strlen($list['list']['meta_keyword']) ? $list['list']['meta_keyword'] : '-'); ?></span>

                <?php } */ ?>

                    <div class="">
                        <?php echo (strlen($list['list']['date']) ? convertDate($list['list']['date']) : '-'); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php /*
        <div class="container mx-auto px-4 mt-4 mb-10">
            <?php if (isset($list['articles_list'])) :
                if (is_array($list['articles_list'])) {
            ?>
                    <div class=" grid grid-cols-1" dir="ltr">
                        <?php foreach ($list['articles_list'] as $id => $field) : ?>
                            <div dir="rtl" class="mb-1">
                                <div class="h-full   rounded-lg  border-2">
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

                <?php
                } else { ?>
                    <div class="container mx-auto mt-10 px-4 text-center">
                        <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['articles_list'] ?></h3>
                    </div>
            <?php  }
            endif;
            ?>
        </div>
        */?>


    </div>
    <div>
        <!-- blog -->
        <div class="container mx-auto mt-10 px-4 text-center">
            <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700">مطالب مرتبط</h3>
            <p class="mt-4 text-gray-500">
                پلتفرم تولیدات علاوه بر اینکه گام به گام تا پیشرفت کسب و کارتان همراه با شماست، سعی بر آن دارد تا اطلاعات تخصصی را که هر مدیر و دارنده ی کسب و کاری باید بداند، در اختیار شما بگذارد و علاوه بر ساختن حرفه ای مجموعه تان، مدیران حرفه ای نیز پرورش دهد.
            </p>
        </div>

        <div class="container mx-auto px-4 mt-6 mb-10">
            <?php if (isset($list['articles_list'])) :
                if (is_array($list['articles_list'])) {
            ?>
                    <div class="container-carousel-blog" dir="ltr">
                        <?php foreach ($list['articles_list'] as $id => $field) : ?>
                            <div dir="rtl" class="items-stretch">
                                <div class="h-full  grid grid-cols-3 rounded-lg  border-2">
                                    <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . '/' .urlencode($fields['title'])?>" class="flex p-2">
                                        <img class="w-28 object-center self-center rounded-md" src="<?php echo ((isset($field['image']) && file_exists(STATIC_ROOT_DIR . '/images/article/90.90.' . $field['image'])) ? STATIC_RELA_DIR . '/images/article/90.90.' . $field['image'] : DEFULT_PRODUCT_ADDRESS) ?>" alt="<?php echo  $field['brif_description'] ?>">
                                    </a>
                                    <div class="px-3 py-2 col-span-2">
                                        <div class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo convertDate($field['date']) ?></div>
                                        <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . '/' . urlencode($fields['title']) ?>" class="">
                                            <h3 class="text-md  font-semibold text-gray-900 mb-3 truncate"><?php echo $field['title'] ?></h3>
                                        </a>
                                        <p class="leading-relaxed mb-3 text-xs truncate"><?php echo  $field['brif_description'] ?></p>
                                        <div class="flex items-center flex-wrap ">
                                            <a href="<?php echo RELA_DIR . 'article/' . $field['Article_id'] . '/' .  urlencode($fields['title']) ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
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

                <?php
                } else { ?>
                    <div class="container mx-auto mt-10 px-4 text-center">
                        <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['articles_list'] ?></h3>
                    </div>
            <?php  }
            endif;
            ?>
        </div>
    </div>


    <div>
        <!-- company -->
        <div class="container mx-auto mt-10 px-4 text-center">
            <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700">کمپانی مرتبط</h3>
        </div>

        <div class="container mx-auto px-4 mt-6 mb-10">
            <?php if (isset($list['companies_list'])) :
                if (is_array($list['companies_list'])) {
            ?>
                    <div class="container-carousel-blog" dir="ltr">
                        <?php foreach ($list['companies_list'] as $id => $field) : ?>
                            <div dir="rtl" class="items-stretch">
                                <div class="h-full  grid grid-cols-3 rounded-lg  border-2">

                                    <div class="px-3 py-2 col-span-2">
                                        <div class="tracking-widest text-xs title-font font-medium text-gray-500 mb-1"><?php echo convertDate($field['register_date']) ?></div>
                                        <a href="<?php echo RELA_DIR . 'company/Detail/' . $field['Company_id'] . '/' . cleanUrl($field['company_name']) ?>" class="">
                                            <h3 class="text-md  font-semibold text-gray-900 mb-3 truncate"><?php echo $field['company_name'] ?></h3>
                                        </a>
                                        <div class="flex items-center flex-wrap ">
                                            <a href="<?php echo RELA_DIR . 'company/Detail/' . $field['Company_id'] . '/' . cleanUrl($field['company_name']) ?>" class="text-tolidatColor inline-flex items-center md:mb-2 lg:mb-0">
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

                <?php
                } else { ?>
                    <div class="container mx-auto mt-10 px-4 text-center">
                        <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['articles_list'] ?></h3>
                    </div>
            <?php  }
            endif;
            ?>
        </div>
    </div>

</div>

<script type="text/javascript" src="<?php echo TEMPLATE_DIR ?>assets/js/slick.min.js"></script>

<script>
    // document.getElementsByClassName(".show-comment .show-comment-input").disabled = true;

    $('.show-comment input').attr("disabled", true);

    $('.container-carousel-company').slick({
        nextArrow: '<button type="button" class=" nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow: '<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
        // autoplay: true,
        autoplaySpeed: 3000,
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        // adaptiveHeight: true,
        responsive: [{
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
        nextArrow: '<button type="button" class="nextArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></button>',
        prevArrow: '<button type="button" class="prevArrow text-tolidatColor rounded"><svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /> </svg></button>',
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


    $(function() {

        $('form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/add',
                data: $('form').serialize(),
                success: function(result) {
                    result = JSON.parse(result)
                    console.log(result)
                    alert(result.msg);
                }
            });

        });

        $('.like').on('click', function(e) {

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/likeOrDislike',
                data: {
                    id: $(this).data('surveyid'),
                    status: 1
                },
                success: function() {
                    console.log("result")
                }
            });

        });

        $('.dis_like').on('click', function(e) {

            $.ajax({
                type: 'post',
                url: '<?php echo RELA_DIR ?>survey/likeOrDislike',
                data: {
                    id: $(this).data('surveyid'),
                    status: -1
                },
                success: function() {
                    console.log("result")

                }
            });

        });


    });
</script>