<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">

<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<style>
    .container-login .container-login-img {
        background: url('<?php echo TEMPLATE_DIR ?>assets/image/login-img.png') no-repeat center/cover;
        height: auto;
        min-height: 600px;
    }
</style>

<?php $stepFrom = unserialize($_SESSION['step']); ?>

<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-center  border-2 rounded-md overflow-hidden                      container-login shadow-normal center-block registerPage container-floatinglabel">

        <div class="lg:col-span-2 xl:col-span-1 container-logo-validator pull-right">
            <div class="flex flex-col p-6         container-login-validator">

                <div class="container-logo">
                    <img class="w-36 mx-auto" src="<?php echo TEMPLATE_DIR ?>assets/image/tolidat-logo.png" alt="لوگوی سایت تولیدات">

                    <span class="block text-center mt-4">ثبت نام در مرجع کسب و کار تولیدات</span>
                </div>

                <div class="mt-16 container-logo-input container-Legal">
                    <form class="" action="/register/?b=selectcompanytype" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                        <div class="izi-container"></div>

                        <div class="form-group has-feedback center-block noPadding">
                            <label class="block text-sm text-tolidatColor" for="company_type">نوع شخصیت را انتخاب نمایید</label>

                            <select name="company_type" id="company_type" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" required>
                                <option value="1" <?php if ($stepFrom->data['1']['company_type'] == 1) {
                                                        echo "selected";
                                                    } ?>>حقوقی</option>
                                <option value="2" <?php if ($stepFrom->data['1']['company_type'] == 2) {
                                                        echo "selected";
                                                    } ?>> حقیقی</option>
                            </select>

                            <div class="mt-4        legal mt text-justify" data-value="1">
                                <span class="text-tolidatColor">نکته: </span>
                                <span>شخص حقوقی به شخصی گفته می شود که دارای سازمانی دارای شماره ثبت و شناسه ملی می باشد.</span>
                            </div>

                            <div class="mt-4        legal hidden mt text-justify" data-value="2">
                                <span class="text-tolidatColor">نکته: </span>
                                <span>شخص حقیقی به شخصی گفته می شود که دارای هر یک از انواع جواز، پروانه کسب یا بهره برداری، برگه رسمی نمایندگی، کارت بازرگانی، کارت عضویت نظام مهندسی و ... می باشد</span>
                            </div>
                        </div>

                        <button name="step_1" type="submit" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600                       btn btn-success btn-sm register-button reg-btn-n">
                            شروع
                        </button>
                        <input name="step" type="hidden" value="2">
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden lg:col-span-2 xl:col-span-3 md:flex content-end items-end justify-center          container-login-img pull-right">
            <div class="container-account">
                <span class="text-white text-center block       msg-account">از این قسمت وارد شوید!</span>

                <div class="mt-4 mb-10          form-group">
                    <a class="w-52 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tolidatColor           btn btn-default btn-block btn-account" href="<?php echo RELA_DIR . "login" ?>">
                        ورود
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<p class="error"><?php echo $list['validate']['msg'] ?></p>

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
            $.iziToastError($('p.error').text(), '.izi-container');
        }
    });

    $(".container-Legal .form-control").change(function() {
        var value = $(this).val();

        $('.legal').addClass('hidden');
        $('.legal[data-value="' + value + '"]').removeClass('hidden');
    });
</script>