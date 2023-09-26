<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">

<script src='<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/script.js'></script>
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
                <a class="container-destination"><span>مرحله : 3</span></a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="container">
        <div class="shadow rounded-md overflow-hidden                boxContainer reg-container">
            <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 3 از 7 </div>
                    </a>
                </div>

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <form action="/register/?step=4" method="post" name="form1" id="form1" role="form">

                        <div class="w-full text-center mt-8 sm:mt-28 text-yellow-600">
                            <?php echo unserialize($_SESSION['step'])->data['2']['phone'] ?>
                        </div>
                        <div class="w-full text-center  ">
                            کد فعالسازی دریافتی را در این قسمت وارد نمایید و به مرحله بعدی بروید
                        </div>

                        <div class="w-full flex justify-center mt-4">
                            <div class="w-full max-w-md">
                                <div class="relative">
                                    <label for="registration_number" class="block text-sm font-medium text-gray-700">کد فعالسازی</label>
                                    <input name="registration_number" name="token" type="text" class="xt-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" value="<?php echo $list['data']['token'] ?>" id="registration_number" maxlength="50" minlength="3" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا کد فعالسازی را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                </div>
                            </div>
                        </div>

                        <div class="w-full text-center mt-10">
                            <div class="reg-alert">
                                <span class="text-tolidatColor">توجه:</span>
                                <span>در صورت عدم دریافت کد بر روی دکمه ارسال مجدد کلیک کنید،ارسال کد تا سه مرتبه امکان پذیر است</span>
                            </div>

                            <div class="flex justify-center mt-4">
                                <button type="button" id="sendCodeAgain" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600           reg-btn-refresh">
                                    <img class="hidden absolute h-5" id="loading" src="<?php echo RELA_DIR ?>templates/template_fa/assets/images/loading1.gif">
                                    ارسال مجدد
                                </button>
                            </div>
                        </div>

                        <div class="row xxsmallSpace nextLoading hidden-xs"></div>

                        <button name="step_3" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="step" type="hidden" value="4">
                        <input name="company_type" type="hidden" value="<?php echo unserialize($_SESSION['step'])->data['1']['company_type'] ?>">
                    </form>

                    <form action="/register/?step=2" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <button name="step1" type="submit" id="step1" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
                            مرحله قبل
                        </button>
                        <input name="step" type="hidden" value="2">
                        <input name="company_type" type="hidden" value="<?php echo unserialize($_SESSION['step'])->data['1']['company_type'] ?>">
                    </form>
                </div>

                <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>
            </div>
        </div>
    </section>
</div>
<p class="error"><?php echo $msg; ?></p>

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
        $('#sendCodeAgain').click(function() {
            $.iziToastSuccess('تا لحظاتی دیگر کد دوباره برای شما ارسال می گردد', '.content .izi-container');
            $(this).attr('disabled', 'disabled').find('span.fa-refresh').hide();
            $(this).find('#loading').show();
            $.ajax({
                url: '/register/sendCodeAgain/',
                type: 'post',
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response) {
                        $.iziToastSuccess(response.msg, '.content .izi-container');
                        $('#sendCodeAgain').removeAttr('disabled');
                        $('#sendCodeAgain').find('span.fa-refresh').show();
                        $('#sendCodeAgain').find('#loading').hide();
                    }
                    if (response == -1) {
                        $.iziToastError(response.msg, '.content .izi-container');
                        $('#sendCodeAgain').attr('disabled', 'disabled');
                        $('#sendCodeAgain').find('span.fa-refresh').show();
                        $('#sendCodeAgain').find('#loading').hide();
                    }
                }
            });
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        $('#registration_number').on('change keyup', function() {
            var code = this.value;
            var form = $('#form1')[0];

            if (code.length == 5) {
                $.ajax({
                    url: '/register/checkCode/',
                    type: 'post',
                    data: {
                        'code': code
                    },
                    success: function(data) {
                        try {
                            var response = $.parseJSON(data);
                            if (response.result == 1) {
                                form.submit();
                            }
                        } catch (e) {
                            console.log(e);
                        }
                    }
                });
            }
        });

    });
</script>