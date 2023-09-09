<?php include_once 'companyDetail_top.php'; ?>

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

    <div class="lg:col-span-2 leading-relaxed">
        <div class="border-2 my-4 rounded bg-gray-50">
            <div id="products"
                 class="text-header searchBox1 bestProduct whiteBg boxBorder roundCorner fullWidth container-product-Grouping productGrid">
                <h2 class="p-3 border-b bg-gray-200">دیدگاه ها</h2>
                <div class="content ltr">

                    <div class="w-full p-4 show-comment">


                        <?php if (isset($list['side']['comment_list'])) :
                            if (is_array($list['side']['comment_list'])) {
                                ?>

                                <?php foreach ($list['side']['comment_list'] as $date => $value) : ?>
                                    <div>
                                        <div class="rating">
                                            <span>امتیاز: </span>
                                            <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio"
                                                   id="st1<?php echo $value['Survey_id'] ?>"
                                                   value="5" <?php echo ($value['rate'] == 5) ? "checked" : "" ?> />
                                            <label for="st1<?php echo $value['Survey_id'] ?>" title="عالی"></label>
                                            <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio"
                                                   id="st2<?php echo $value['Survey_id'] ?>"
                                                   value="4" <?php echo ($value['rate'] == 4) ? "checked" : "" ?> />
                                            <label for="st2<?php echo $value['Survey_id'] ?>" title="خوب"></label>
                                            <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio"
                                                   id="st3<?php echo $value['Survey_id'] ?>"
                                                   value="3" <?php echo ($value['rate'] == 3) ? "checked" : "" ?> />
                                            <label for="st3<?php echo $value['survey_id'] ?>" title="معمولی"></label>
                                            <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio"
                                                   id="st4<?php echo $value['Survey_id'] ?>"
                                                   value="2" <?php echo ($value['rate'] == 2) ? "checked" : "" ?> />
                                            <label for="st4<?php echo $value['Survey_id'] ?>" title="ضعیف"></label>
                                            <input disabled name="rate<?php echo $value['Survey_id'] ?>" type="radio"
                                                   id="st5<?php echo $value['Survey_id'] ?>"
                                                   value="1" <?php echo ($value['rate'] == 1) ? "checked" : "" ?> />
                                            <label for="st5<?php echo $value['Survey_id'] ?>" title="بد"></label>
                                            <span id="rating-hover-label"></span>
                                        </div>

                                        <div class="d-flex pb-3 text-xs text-gray-400">
                                            <span><?php echo convertDate($value['date']) ?></span>،
                                            <span> <?php echo $value['user_name'] ?> </span>
                                        </div>

                                        <div class="my-4">
                                            <p><?php echo $value['comment'] ?></p>
                                        </div>

                                        <div class="border-b pb-4 flex mt-4 mb-4 justify-end">
                                            <p class="text-sm text-gray-600 ml-4">آیا این دیدگاه مفید بود؟</p>

                                            <div class="flex text-gray-400 text-base gap-2">
                                    <span class="flex items-center like"
                                          data-surveyid="<?php echo $value['Survey_id'] ?>">
                                        <span class="like"><?php echo $value['like'] ?></span>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                            </svg>
                                        </div>
                                    </span>
                                                <span class="flex items-center dis_like"
                                                      data-surveyid="<?php echo $value['Survey_id'] ?>">
                                        <span class="dis_like"><?php echo $value['dis_like'] ?></span>
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
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
                                    <h3 class="text-xl md:text-2xl font-extrabold tracking-tight text-gray-700"><?php echo $list['comment_list'] ?></h3>
                                </div>
                            <?php }
                        endif;
                        ?>
                    </div>

                    <div class="border-b-2"></div>

                    <div class="w-full p-4 set-comment">
                        <h2 class="text-center md:text-right text-xl md:text-2xl font-extrabold text-gray-700 mb-6">
                            دیدگاه خود را ثبت کنید</h2>

                        <form action="" class="w-full px-6">

                            <!-- <div class="rating inline-block mb-4">
                                <input type="radio" value="5" name="rating" id="rating-5"/>
                                <label for="rating-5" title="5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </label>
                                <input type="radio" value="4" name="rating" id="rating-4"/>
                                <label for="rating-4" title="4 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </label>
                                <input type="radio" value="3" name="rating" id="rating-3"/>
                                <label for="rating-3" title="3 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </label>
                                <input type="radio" value="2" name="rating" id="rating-2"/>
                                <label for="rating-2" title="2 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </label>
                                <input type="radio" value="1" name="rating" id="rating-1"/>
                                <label for="rating-1" title="1 star">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </label>
                            </div> -->

                            <div class="rating">
                                <span>امتیاز: </span>
                                <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }}
                                value="5" />
                                <label for="st5" title="عالی"></label>
                                <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }}
                                value="4" />
                                <label for="st4" title="خوب"></label>
                                <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }}
                                value="3" />
                                <label for="st3" title="معمولی"></label>
                                <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }}
                                value="2" />
                                <label for="st2" title="ضعیف"></label>
                                <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }}
                                value="1" />
                                <label for="st1" title="بد"></label>
                                <span id="rating-hover-label"></span>
                            </div>

                            <div class="mb-5">
                                <label for="name"
                                       class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام</label>
                                <input name="user_name" type="text"
                                       class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none"
                                       id="name" minlength="1" tabindex="1"  required>
                            </div>

                            <div class="mb-5">
                                <label for="email"
                                       class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">ایمیل</label>
                                <input name="user_email" type="email"
                                       class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none"
                                       id="email" minlength="1" tabindex="2" placeholder="test@test.com" required>
                            </div>

                            <div class="mb-5">
                                <label for="msg"
                                       class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">دیدگاه</label>
                                <textarea name="comment" type="text" value=""
                                          class="mt-1 shadow-sm sm:text-sm border border-gray-300 block w-full shadow-sm sm:text-sm rounded-md px-3 py-2 focus:outline-none"
                                          id="msg" minlength="1" tabindex="3" placeholder="test@test.com" rows="3"
                                          required>
                    </textarea>
                            </div>
                            <input type="hidden" name="type" value="company">
                            <input type="hidden" name="type_id"
                                   value="<?php echo $list['side']['list']['Company_id'] ?>">
                            <button class="group relative w-50 py-2 px-4 border border-transparent text-md font-medium rounded-md text-white bg-tolidatColor hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                ارسال
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

<script>
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

<?php include_once 'companyDetail_bottom.php'; ?>