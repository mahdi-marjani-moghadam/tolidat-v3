<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<div class="container mx-auto py-8 px-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="Breadcrumb">
            <a class="home-icon" href="<?php echo RELA_DIR ?>">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
                <span>بازیابی گذرواژه</span></a>
            <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
            <!-- <a class="container-destination"><span>مرحله : 1</span></a>-->
        </div>
    </div>
</div>


<div class="container mx-auto py-8 px-4">
    <section class="noPadding mainContainer mainContainer-forgtForm">
        <div class="shadow rounded-md overflow-hidden">
            <div class="boxContainer main-login-container forgot-email boxBorder relative">

                <div class="flex items-center px-6 py-2 shadow">
                    <span class="">بازیابی گذر واژه</span>
                </div>

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <div class="w-full flex justify-center mt-12">
                        <div class="w-full max-w-md          login-container login-border registerPage container-floatinglabel">
                            <div class="login-edit">
                                <span class="block text-center mb-8">لطفا نام کاربری را برای بازیابی گذرواژه خود وارد نمایید.</span>

                                <?php if ($msg['error'] == 1) { ?>
                                    <div class="msgError"><?php echo $msg['msg']; ?></div>
                                <?php } ?>
                                <?php if (!empty($msg) & $msg['error'] == 0) { ?>
                                    <div class="msgSuccess"><?php echo $msg['msg']; ?></div>
                                <?php } ?>

                                <form action="/login/sendEmail" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                                    <div class="relative">
                                        <label for="name" class="block text-sm font-medium text-gray-700">نام کاربری</label>
                                        <input name="username" id="username" type="text" value="<?php echo $list['username'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" data-error="نام کاربری را وارد نمایید" autofocus required>
                                    </div>

                                    <button type="submit" class="mx-auto mt-4 w-40 flex justify-center py-1 px-3 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           successClick reg-active disabled">
                                        ثبت
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="bg-gray-50 h-14 mt-16"></div>
            </div>
        </div>
    </section>
</div>




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
        if ($('.msgSuccess').text().length) {
            $.iziToastSuccess($('.msgSuccess').text(), '.izi-container');
        }
        if ($('.msgError').text().length) {
            $.iziToastError($('.msgError').text(), '.izi-container');
        }
    });
</script>