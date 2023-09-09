<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<div class="container mx-auto py-8 px-4">
    <div class="row noMargin">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="Breadcrumb">
                <a class="home-icon" href="<?php echo RELA_DIR ?>">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </a>
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                    <span>ثبت نام</span></a>
                <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
                <a class="container-destination"><span>مرحله : 2</span></a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="noPadding">
        <div class="shadow rounded-md overflow-hidden               boxContainer reg-container">
            <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 2 از 7 </div>
                    </a>
                </div>

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <form action="/register/?step=3" method="post" name="form1" id="form1" role="form">

                        <div>
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">

                                        <label for="licence_list_id" class="block text-sm text-tolidatColor after:content-['*'] after:ml-0.5 after:text-red-500">نوع جواز خود را انتخاب نمایید</label>
                                        <select name="licence_list_id" id="licence_list_id" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا نوع جواز خود را انتخاب نمایید')" oninput="setCustomValidity('')" required><?php foreach ($list['licenceList'] as $licence) { ?>
                                                <option value="<?php echo $licence['Licence_list_id']; ?>" <?php if ($licence['Licence_list_id'] == $list['data']['licence_list_id']) {
                                                                                                                                                                                                                                                                                                                        echo "selected";
                                                                                                                                                                                                                                                                                                                    } ?>><?php echo $licence['name']; ?></option>
                                            <?php } ?>
                                            <option value="0" <?php if (isset($list['data']['licence_list_id']) & $list['data']['licence_list_id'] == 0) {
                                                                    echo "selected";
                                                                } ?>>غیره...
                                            </option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6" id="licence_type">
                                    <div class="relative">
                                        <label for="licence_type" class="block text-sm font-medium text-gray-700">نوع جواز</label>
                                        <input name="licence_type" type="text" value="<?php echo $list['data']['licence_type'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="licence_type" maxlength="50" minlength="3" tabindex="2" oninvalid="setCustomValidity('نوع جواز خود را ذکر نمایید')" oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="licence_number" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره جواز</label>
                                        <input name="licence_number" id="licence_number" type="text" value="<?php echo $list['data']['licence_number'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="1" tabindex="3" oninvalid="setCustomValidity('لطفا شماره جواز را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره تلفن همراه</label>
                                        <input name="phone" id="phone" type="text" value="<?php echo  $list['data']['phone'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="4" pattern="^[0-9]{11,}$" maxlength="11" oninvalid="setCustomValidity('لطفا شماره تلفن را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full">
                                <?php if (strlen($error['companyRecorded']['0'])) { ?>
                                    <div class="errorHandler alert alert-danger" style="color: red ;"><?php echo $error['companyRecorded']['0'] ?></div>
                                <?php } ?>
                            </div>

                            <div class="w-full text-center mt-14">
                                جهت دریافت کد فعالسازی، یکی از روش های زیر را انتخاب نمایید
                            </div>
                        </div>

                        <div class="w-full flex justify-center mt-6">
                            <div class="max-w-sm flex">

                                <div class="flex items-center reg-radio px-3">
                                    <input id="by-sms" data-type="1" name="radio" type="radio" checked class="focus:ring-tolidatColor h-4 w-4 text-tolidatColor border-gray-300">
                                    <label for="by-sms" class="mr-1 block text-sm font-medium text-gray-700">
                                        پیامک
                                    </label>
                                </div>

                                <div class="flex items-center reg-radio px-3">
                                    <input id="by-call" data-type="0" name="radio" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="by-call" class="mr-1 block text-sm font-medium text-gray-700">
                                        تماس صوتی
                                    </label>
                                </div>

                                <input type="hidden" name="methodType" value="<?php echo (unserialize($_SESSION['step'])->data[1]['methodType']) ?>" class="methodType" aria-label="">
                            </div>
                        </div>



                        <!-- <a class="roundCorner call" data-type="0">
                                <i class="fa fa-phone fa-lg" aria-hidden="true"></i>
                                <span>تماس</span>
                            </a>
                        
                            <a class="roundCorner sms" data-type="1">
                                <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i>
                                <span>پیامک</span>
                            </a> -->

                        <button name="step_2" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="step" type="hidden" value="3">
                        <input name="company_type" type="hidden" value="1">
                    </form>

                    <form action="/register" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="1">
                        <input name="company_type" type="hidden" value="2">
                        <button name="step1" id="step1" type="submit" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
                            مرحله قبل
                        </button>
                    </form>
                </div>

                <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>
            </div>
        </div>
    </section>
</div>


<p class="error hidden"><?php echo $list['validate']['msg'] ?></p>


<script>
    $(document).ready(function() {
        $("input[name='methodType']").val($("input[type='radio']:checked").data('type').toString());

        $("input[name='radio']").click(function() {
            $("input[name='methodType']").val($("input[type='radio']:checked").data('type').toString());
        });

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

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        // show DIV licence_type
        $('#licence_type').hide();

        if ($('#licence_list_id').val() == 0) {
            $('#licence_type').show();
            $('#licence_type input').attr('required', true);
        }

        $('#licence_list_id').on('change', function() {
            var licence_list_id = $('#licence_list_id').val();
            if (licence_list_id == 0) {
                $('#licence_type').show();
                $('#licence_type input').attr('required', true);
            } else {
                $('#licence_type').hide();
                $('#licence_type input').attr('required', false);
            }
        });
        // end show DIV licence_type
    });
</script>