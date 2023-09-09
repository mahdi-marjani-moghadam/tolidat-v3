<link rel="Stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/cropper.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/iziToast.min.css">

<script src='<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/script.js'></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/cropper.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/jquery-ui.js"></script>

<style>
    .pdp-default {
        top: 48px !important;
        right: 0 !important;
        left: inherit !important;
    }

    .pdp-default {
        max-width: 250px;
    }
</style>

<div class="container mx-auto py-8 px-4">
    <div class="Breadcrumb">
        <a class="home-icon" href="<?php echo RELA_DIR ?>">
            <i class="fa fa-home" aria-hidden="true"></i>
        </a>
        <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
        <a class="container-address" href="<?php echo RELA_DIR . "register" ?>">
            <span>ثبت نام</span></a>
        <i class="fa slash-left fa-angle-left" aria-hidden="true"></i>
        <a class="container-destination"><span>مرحله : 4</span></a>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <section class="noPadding">
        <div class="shadow rounded-md overflow-hidden               boxContainer reg-container crop">
            <div class="registerPage container-floatinglabel registerPage-lg center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">لطفا با دقت اطلاعات لازم دار تکمیل نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 4 از 7 </div>
                    </a>
                </div>

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <form action="" method="post" name="form1" id="form1" role="form" enctype="multipart/form-data">

                        <div>
                            <div class="grid grid-cols-12 gap-6">
                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام صاحب جواز</label>
                                        <input name="name" id="name" type="text" value="<?php echo  $list['data']['name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="3" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا نام صاحب جواز را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="family" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام خانوادگی صاحب جواز</label>
                                        <input name="family" id="family" type="text" value="<?php echo  $list['data']['family'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="2" tabindex="2" oninvalid="setCustomValidity('لطفا نام خانوادگی صاحب جواز را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="company_name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام مجموعه</label>
                                        <input name="company_name" id="company_name" type="text" value="<?php echo  $list['data']['company_name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="2" tabindex="3" oninvalid="setCustomValidity('لطفا نام مجموعه را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="national_code" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">کد ملی صاحب جواز</label>
                                        <input name="national_code" id="national_code" type="text" value="<?php echo  $list['data']['national_code'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" pattern="^[0-9]{10,}$" maxlength="10" tabindex="4" oninvalid="setCustomValidity('لطفا کد ملی را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="exporter_refrence" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">مرجع تایید جواز</label>
                                        <input name="exporter_refrence" id="exporter_refrence" type="text" value="<?php echo  $list['data']['exporter_refrence'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="5" oninvalid="setCustomValidity('لطفا مرجع تایید جواز خود را وارد نمایید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12">
                                    <div class="relative">
                                        <label for="description" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">زمینه فعالیت</label>
                                        <textarea name="description" id="description" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" minlength="2" tabindex="6" oninvalid="setCustomValidity('لطفا زمینه فعالیت را وارد نمایید')" oninput="setCustomValidity('')" required><?php echo  $list['data']['description'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative full-date-picker">
                                        <label for="issuence_date" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تاریخ صدور جواز</label>
                                        <input name="issuence_date" id="issuence_date" type="text" value="<?php echo  $list['data']['issuence_date'] ? convertDate($list['data']['issuence_date']) : '' ?>" class="datePicker mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="7" oninvalid="setCustomValidity('لطفا تاریخ صدور جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative full-date-picker">
                                        <label for="expiration_date" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تاریخ انقضا جواز</label>
                                        <input name="expiration_date" id="expiration_date" type="text" value="<?php echo  $list['data']['expiration_date'] ? convertDate($list['data']['expiration_date']) : '' ?>" class="datePicker mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="8" oninvalid="setCustomValidity('لطفا تاریخ انقضا جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- src="< ?php echo(isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>"  -->
                        <div class="mt-12">
                            <div class="reg-alert-r text-center">تصویر مجوز خود را انتخاب نمایید</div>

                            <div class="max-w-md mx-auto mt-2             docs-buttons modal-body">
                                <div class="shadow rounded-md            img-container upload-msg register-crop">
                                    <img class="width image-crop img-cropper" src="<?php echo  RELA_DIR . 'templates/' . CURRENT_SKIN . '/assets/image/placeholder.png'; ?>" alt="Picture">
                                </div>

                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">

                                        <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                            <span>
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </span>
                                            <span class="mt-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600           btn btn-success btn-sm reg-btn-n">بارگذاری تصویر مجوز</span>
                                        </span>

                                    </label>
                                    <input class="result-crop" type="hidden" name="imageCropped" value="">
                                </div>

                            </div>
                        </div>

                        <button name="step_4" type="submit" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="company_id" type="hidden" value="<?php echo  $list['data']['company_id'] ?>">
                        <input name="step" type="hidden" value="5">
                        <input name="company_type" type="hidden" value="1">
                    </form>

                    <form action="" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="3">
                        <input name="company_type" type="hidden" value="1">

                        <button name="step2" type="submit" id="step1" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600        btn btn-danger btn-sm reg-btn-p">
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
        $('.reg-btn-n').on('click', function() {
            $('.image_name').val($('#img').attr('src'));
        });

        if ($('p.error').text().length != 0) {
            $.iziToastError($('p.error').text(), '.content .izi-container');
        }
    });
</script>