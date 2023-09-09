<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<div class="container mx-auto py-8 px-4 hidden">
    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="Breadcrumb">
                <a class="home-icon" href="<?php echo RELA_DIR ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                <!-- <a class="container-address" href="< ?php echo RELA_DIR . "register" ?>">
                    <span>ثبت نام</span></a> -->
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                <a class="container-destination"><span>مرحله : 2</span></a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="container noPadding">

        <div class="shadow rounded-md overflow-hidden              boxContainer reg-container">

            <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer relative">

                <!-- <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 2 از 7 </div>
                    </a>
                </div> -->

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <form action="/register/?step=3" method="post" name="form1" id="form1" role="form">
                    
                    <input name="national_id" type="hidden" value="<?php echo random_int(00000000000,99999999999) ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="national_id" tabindex="4" maxlength="11" oninvalid="setCustomValidity('لطفا شناسه ملی را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>



                        <div>
                            <div class="grid grid-cols-12 gap-6">
                                <!-- <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="name" class="block text-sm font-medium text-gray-700">نام نماینده</label>
                                        <input name="name" 
                                            type="text" 
                                            value="< ?php echo $list['data']['name'] ?>" 
                                            class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" 
                                            id="name" 
                                            maxlength="50" 
                                            minlength="1" 
                                            tabindex="1" 
                                            autofocus 
                                            oninvalid="setCustomValidity('لطفا نام نماینده را وارد نمایید')"
                                            oninput="setCustomValidity('')"
                                            required>
                                    </div>
                                </div> -->


                                <div class="col-span-12 sm:col-span-6 hidden">
                                    <select name="company_type" id="company_type" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" required>
                                        <option value="1" <?php if ($stepFrom->data['1']['company_type'] == 1) {
                                                                echo "selected";
                                                            } ?>>حقوقی</option>
                                        <option value="2" <?php if ($stepFrom->data['1']['company_type'] == 2) {
                                                                echo "selected";
                                                            } ?>> حقیقی</option>
                                    </select>
                                </div>


                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام نماینده</label>
                                        <input name="name" type="text" value="<?php echo $list['data']['name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="name" maxlength="50" minlength="1" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا نام نماینده را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="family" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام خانوادگی نماینده</label>
                                        <input name="family" type="text" value="<?php echo $list['data']['family'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="family" maxlength="50" minlength="1" oninvalid="setCustomValidity('لطفا نام خانوادگی را وارد نمایید')" oninput="setCustomValidity('')" tabindex="2" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره تلفن همراه نماینده</label>
                                        <input name="phone" type="text" value="<?php echo  $list['data']['phone'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="phone" pattern="^[0-9۰-۹]{11,}$" maxlength="11" tabindex="3" oninvalid="setCustomValidity('لطفا شماره موبایل صحیح جهت دریافت کد فعال سازی وارد کنید.')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>

                                <!-- <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="national_id" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شناسه ملی شرکت</label>
                                        <input name="national_id" 
                                            type="text" 
                                            value="< ?php echo $list['data']['national_id'] ?>" 
                                            class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" 
                                            id="national_id" 
                                            tabindex="4"
                                            maxlength="11"
                                            oninvalid="setCustomValidity('لطفا شناسه ملی را وارد نمایید')"
                                            oninput="setCustomValidity('')"
                                            dir="ltr"
                                            required>
                                    </div>
                                </div> -->






                  


                            </div>

                            <div class="w-full">
                                <?php if (strlen($error['companyRecorded']['0'])) { ?>
                                    <div class="errorHandler alert alert-danger" style="color: red ;"><?php echo $error['companyRecorded']['0'] ?></div>
                                <?php } ?>
                            </div>

                            <!-- <div class="w-full text-center mt-14">
                                جهت دریافت کد فعالسازی، یکی از روش های زیر را انتخاب نموده و دکمه مرحله بعد را بزنید یا "به مرحله بعدی بروید"
                            </div> -->

                            <div class="w-full flex justify-center mt-6">
                                <div class="max-w-sm flex">

                                    <div class="flex items-center reg-radio px-3 hidden">
                                        <input id="by-sms" data-type="1" name="radio" type="radio" checked class="focus:ring-tolidatColor h-4 w-4 text-tolidatColor border-gray-300">
                                        <label for="by-sms" class="mr-1 block text-sm font-medium text-gray-700">
                                            پیامک
                                        </label>
                                    </div>

                                    <!-- <div class="flex items-center reg-radio px-3">
                                        <input id="by-call" data-type="0" name="radio" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                        <label for="by-call" class="mr-1 block text-sm font-medium text-gray-700">
                                            تماس صوتی
                                        </label>
                                    </div> -->

                                    <input type="hidden" name="methodType" value="<?php echo (unserialize($_SESSION['step'])->data[2]['methodType']) ?>" class="methodType" aria-label="">
                                </div>
                            </div>
                        </div>

                        <button name="step_2" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="step" type="hidden" value="3">
                        <input name="company_type" type="hidden" value="1">
                    </form>

                    <!-- <form action="/register" method="post" name="" id="" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="1">
                        <input name="company_type" type="hidden" value="1">
                        <button name="step_2" type="submit" id="step2" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
                            مرحله قبل
                        </button>
                    </form> -->

                </div>

                <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>

            </div>
        </div>
    </section>
</div>


<p class="error hidden"><?php echo $list['validate']['msg'] ?></p>

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
    $(document).ready(function() {
        $("input[name='methodType']").val($("input[type='radio']:checked").data('type').toString());

        $("input[name='radio']").click(function() {
            $("input[name='methodType']").val($("input[type='radio']:checked").data('type').toString());
        });

        if ($('p.error').text().length != 0) {

            $.iziToastError($('p.error').text(), '.content .izi-container');
        }
    });
</script>