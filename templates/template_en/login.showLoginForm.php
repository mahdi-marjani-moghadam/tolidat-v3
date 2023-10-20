<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/select2.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>

<style>
    .container-login .container-login-img {
        background: url('<?php echo TEMPLATE_DIR ?>assets/image/login-img.png') no-repeat center/cover;
        height: auto;
        min-height: 600px;
    }
</style>

<div class="container mx-auto py-8 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 items-center  border-2 rounded-md overflow-hidden                      container-login shadow-normal center-block registerPage container-floatinglabel">

        <div class="lg:col-span-2 xl:col-span-1 container-logo-validator pull-right">
            <div class="flex flex-col p-6         container-login-validator">

                <div class="container-logo">
                    <img class="w-36 mx-auto" src="<?php echo TEMPLATE_DIR ?>assets/image/tolidat-logo.png" alt="لوگوی سایت تولیدات">
                </div>

                <div class="mt-16 container-logo-input container-Legal">
                    <form class="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">

                        <div class="relative">
                            <label for="username" class="block text-sm font-medium text-gray-700          validation">Username</label>
                            <input name="username" id="username" type="text" value="<?php echo  $list['data']['company_name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" placeholder="" data-error="نام کاربری را وارد کنید" tabindex="1" autofocus required>
                        </div>

                        <div class="relative mt-4">
                            <label for="password" class="block text-sm font-medium text-gray-700          validation">Password</label>
                            <input name="password" id="password" type="password" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" placeholder="" data-error="گذرواژه را وارد کنید" tabindex="2" required>
                        </div>

                        <button type="submit" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600                       btn btn-success btn-sm register-button reg-btn-n show-more">
                            Login </button>

                        <input type="hidden" name="action" value="login">
                    </form>

                    <a class="link-forget block text-center mt-8" href="<?php echo RELA_DIR . "login/getUsername" ?>">Forgot password? </a>
                </div>
            </div>
        </div>

        <div class="hidden lg:col-span-2 xl:col-span-3 md:flex content-end items-end justify-center          container-login-img pull-right">
            <div class="container-account">
                <span class="text-white text-center block       msg-account">آیا ثبت نام کرده اید؟</span>

                <div class="mt-4 mb-10          form-group">
                    <a class="w-52 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tolidatColor           btn btn-default btn-block btn-account" href="<?php echo RELA_DIR . "register" ?>">
                        ثبت نام
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(function() {
        $('footer').addClass('loginFooter');
    });
</script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/select2.min.js"></script>