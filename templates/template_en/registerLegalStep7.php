<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<div class="container mx-auto py-8 px-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>"><i class="fa fa-home" aria-hidden="true"></i></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>"><span>ثبت نام</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-destination"><span>مرحله : 7</span></a>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="noPadding">
        <div class="shadow rounded-md overflow-hidden         boxContainer reg-container">
            <div class="registerPage registerPage-lg container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 7 از 7 </div>
                    </a>
                </div>

                <div class="p-6         content">

                    <div class="izi-container"></div>

                    <form action="/register/?step=final" method="post" name="form1" id="form1" role="form">

                        <div class="mt-4 w-full">
                            <span class="block text-center">اطلاعات مربوط به نماینده رابط بین شما و تولیدات</span>
                        </div>

                        <div class="mt-8">
                            <div class="grid grid-cols-12 gap-6">

                                <input name="name" type="hidden" value="<?php echo ($list['data']['name'] ? $list['data']['name'] : unserialize($_SESSION['step'])->data['2']['name']) ?>"  >
                                <input name="family" type="hidden" value="<?php echo ($list['data']['family'] ? $list['data']['family'] : unserialize($_SESSION['step'])->data['2']['family']) ?>"  >
                                <input name="mobile" type="hidden" value="<?php echo ($list['data']['mobile'] ? $list['data']['mobile'] : unserialize($_SESSION['step'])->data['2']['phone']) ?>"  >
                                <input name="email" type="hidden" value="<?php echo ($list['data']['email'] ? $list['data']['email'] : unserialize($_SESSION['step'])->data['5']['email']) ?>"  >
                               

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="username" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام کاربری</label>
                                        <input name="username" id="username" type="text" value="<?php echo  $list['data']['username'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" data-minlength="2" tabindex="5" oninvalid="setCustomValidity('لطفا نام کاربری را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="password" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">رمز عبور</label>
                                        <input name="password" id="password" type="password" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="8" tabindex="6" oninvalid="setCustomValidity('رمز عبور شما باید حداقل شامل 8 کاراکتر باشد')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="retype_password" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تکرار رمز عبور</label>
                                        <input name="retype_password" id="retype_password" type="password" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="8" tabindex="7" oninvalid="setCustomValidity('لطفا رمز عبور خود را مجددا وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button name="finish" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            ثبت نهایی
                        </button>
                        <input name="step" type="hidden" value="8">
                        <input name="company_type" type="hidden" value="1">

                    </form>
                    <form action="/register/?step=6" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="6">
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
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        $('#form1').on('submit', function() {
            $(this).prop('disabled', true);
        });

        if (window.localStorage.getItem('packageType') !== null) {
            window.localStorage.removeItem('packageType');
        }
    });
</script>