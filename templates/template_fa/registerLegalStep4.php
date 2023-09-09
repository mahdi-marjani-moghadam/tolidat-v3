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
    <div class="col-xs-12 col-sm-12 col-md-12">
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
</div>

<div class="container mx-auto py-8 px-4">
    <section class="noPadding">
        <div class="shadow rounded-md overflow-hidden               boxContainer reg-container">
            <div class="registerPage container-floatinglabel center-block whiteBg boxBorder roundCorner boxContainer relative">

                <div class="flex flex-col-reverse sm:flex-row items-center px-6 py-2 shadow">
                    <span class="block text-center sm:text-justify">اطلاعات درخواستی را با دقت وارد نمایید</span>
                    <a class="justify-items-end mx-auto ml-auto sm:ml-0 mb-2 sm:mb-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                        <div class="badge"><span class="title-badge">مرحله</span> 4 از 7 </div>
                    </a>
                </div>

                <div class="p-6 content">

                    <div class="izi-container"></div>

                    <form action="/register/?step=5" method="post" name="form1" id="form1" role="form">

                        <div>
                            <div class=' flex  justify-center'>

                                <button name="step_4" type="submit" id="test" class=" left-6 mb-5  flex justify-center py-2 px-8 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600           btn btn-success btn-sm reg-btn-n">
                                    اطلاعات مجموعه را بعد از ثبت نام پر میکنم، ادامه ثبت نام </button>
                            </div>
                            <div class="grid grid-cols-12 gap-6">
                                <!-- <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="national_id" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شناسه ملی شرکت</label>
                                        <input name="national_id" type="text" value="< ?php echo $list['data']['national_id'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="national_id" tabindex="4" maxlength="11" oninvalid="setCustomValidity('لطفا شناسه ملی را وارد نمایید')" oninput="setCustomValidity('')" dir="ltr" required>
                                    </div>
                                </div> -->
                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="company_name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام مجموعه</label>
                                        <input name="company_name" type="text" value="<?php echo  $list['data']['company_name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="company_name" maxlength="50" minlength="1" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا نام کامل ثبتی مجموعه خود را وارد نمائید')" oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="registration_number" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره ثبت مجموعه</label>
                                        <input name="registration_number" type="number" value="<?php echo  $list['data']['registration_number'] ?>" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="registration_number" maxlength="50" minlength="1" tabindex="2" oninvalid="setCustomValidity('لطفاشماره ثبت مربوط به مجموعه خود را وارد نمائید')" oninput="setCustomValidity('')" dir="ltr">
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="registration_date" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تاریخ تأسیس مجموعه</label>
                                        <input name="registration_date" type="text" value="<?php echo  $list['data']['registration_date'] ?>" class="datePicker mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="registration_date" maxlength="11" tabindex="3" oninvalid="setCustomValidity('لطفا تاریخ تأسیس مجموعه را انتخاب نمایید')" valid="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="coordinator_name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید</label>
                                        <input name="maneger_name" type="text" value="<?php echo  $list['data']['maneger_name'] ?>" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" id="coordinator_name" tabindex="4" minlength="3" oninvalid="setCustomValidity('نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید')" oninput="setCustomValidity('')">
                                    </div>
                                </div>

                                <div class="col-span-12">
                                    <div class="relative">
                                        <label for="description" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">زمینه فعالیت مجموعه</label>
                                        <textarea name="description" id="description" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" data-error="لطفا فعالیت مجموعه را وارد نمایید" tabindex="5" minlength="2" oninvalid="setCustomValidity('نام کامل ثبتی مدیرعامل مجموعه را وارد نمائید')" oninput="setCustomValidity('')"><?php echo  $list['data']['description'] ?></textarea>
                                    </div>
                                </div>

                                <div class="col-span-12 sm:col-span-6">
                                    <div class="relative">
                                        <label for="personality_type" class="block text-sm text-tolidatColor after:content-['*'] after:ml-0.5 after:text-red-500">نوع شخصیت حقوقی را انتخاب نمایید</label>
                                        <select name="personality_type" id="personality_type" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" tabindex="6" oninvalid="setCustomValidity('لطفا نوع شخصیت حقوقی را انتخاب نمایید')" oninput="setCustomValidity('')">
                                            <option value="">نوع شخصیت حقوقی</option>
                                            <?php foreach ($list['personalityType'] as $personalityType) { ?>
                                                <option value="<?php echo $personalityType['Personality_type_id'] ?>" <?php if ($list['data']['personality_type'] == $personalityType['Personality_type_id']) {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>
                                                    <?php echo $personalityType['type'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex justify-center mt-12">
                                <div class="flex items-center">
                                    <div class="relative flex items-center">

                                        <label for="toggleLicense" class="mr-1 block text-sm font-medium text-gray-700 leading-3">
                                            <input id="toggleLicense" <?php echo ($list['licence'] ? 'checked' : ''); ?> tabindex="7" type="checkbox" class=" px-3">
                                            آیا دارای مجوز می باشید؟
                                        </label>
                                        <span class="text-gray-400 block px-3" data-trigger="hover" data-toggle="popover" title="اگر هر نوع مجوزی دارید تیک بزنید.">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex justify-center mt-8 <?php echo ($list['licence'] ? '' : 'hidden'); ?>" data-toggle="toggleLicense">
                            <div class="shadow rounded-md overflow-hidden w-full max-w-md      container-view">
                                <div class="flex items-center px-4 py-2 shadow bg-gray-50 license-container">
                                    <span class="addedLicense">مجوز ایجاد شده</span>

                                    <?php
                                    if ($list['licence']) {
                                    ?>
                                        <button type="button" class="mr-auto ml-0 flex justify-center py-1 px-3 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600           delete-licence">
                                            حذف مجوز
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" id="open-btn" class="mr-auto ml-0 flex justify-center py-1 px-3 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600           addLicenseCompany">
                                            افزودن مجوز
                                        </button>
                                    <?php } ?>

                                </div>

                                <div class="p-4">
                                    <ul class="selected-category paddingRl ptb">
                                        <?php if ($list['licence']) { ?>
                                            <li class="text-center">

                                                <div class="grid grid-cols-2 gap-6">
                                                    <div class="">
                                                        <img class="roundCorner fullWidth boxBorder" src="<?php echo  $list['licence']['imageCropped']; ?>" alt="">
                                                    </div>
                                                    <div class="">
                                                        <span class="block text-right text-xl font-bold"><?php echo  $list['licence']['name'] . " " . $list['licence']['family']; ?></span>
                                                        <p class="text-right">به شماره جواز <?php echo  $list['licence']['licence_number']; ?></p>
                                                        <a class="delete-licence"><span class="fa fa-trash text-danger"></span></a>
                                                    </div>
                                                </div>

                                            </li>
                                        <?php } else {
                                        ?>
                                            <li class="text-center emptyLabel">هیچ آیتمی موجود نیست</li>
                                        <?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button name="step_4" type="submit" id="test" class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            مرحله بعد
                        </button>
                        <input name="step" type="hidden" value="5">
                        <input name="company_type" type="hidden" value="1">
                    </form>

                    <form action="/register/?step=3" method="post" name="form1" id="form1" role="form" novalidate="novalidate" data-toggle="validator">
                        <input name="step" type="hidden" value="3">
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

<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full px-4 py-8" id="my-modal">
    <div class="shadow rounded-md overflow-hidden max-w-2xl bg-white mx-auto                  holder-modal modal-register modal fade container-floatinglabel crop" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="relative      modal-dialog modal-lg" role="document">

            <div class="flex items-center px-6 py-2 shadow">
                <span class="">افزودن مجوز برای مجموعه</span>
                <p id="message"></p>
            </div>

            <div class="p-6 modal-body">

                <div class="content-izi">
                    <div class="izi-container"></div>
                </div>

                <form class="form" enctype="multipart/form-data" method="post">

                    <div>
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام صاحب جواز</label>
                                    <input name="name" id="name" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="1" autofocus oninvalid="setCustomValidity('لطفا نام صاحب جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="family" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نام خانوادگی صاحب جواز</label>
                                    <input name="family" id="family" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="2" oninvalid="setCustomValidity('لطفا نام خانوادگی صاحب جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="national_code" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">کد ملی صاحب جواز</label>
                                    <input name="national_code" id="national_code" type="text" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="3" pattern="^[0-9۰-۹]{10,}$" maxlength="10" oninvalid="setCustomValidity('لطفا کد ملی صاحب جواز وارد کنید')" oninput="setCustomValidity('')" dir="ltr" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="licence_number" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">شماره جواز</label>
                                    <input name="licence_number" id="licence_number" type="text" class="text-left pl-7 mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="4" oninvalid="setCustomValidity('لطفا شماره جواز را وارد کنید')" oninput="setCustomValidity('')" dir="ltr" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="licence_type" class="block text-sm text-tolidatColor after:content-['*'] after:ml-0.5 after:text-red-500">انتخاب نوع جواز</label>
                                    <select name="licence_type" id="licence_type" class="form-control w-full rounded-none border-r-0 border-t-0 border-l-0 mt-1" tabindex="5" required>
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6" id="div-licence_type">
                                <div class="relative">
                                    <label for="licence_type_name" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">نوع جواز</label>
                                    <input name="licence_type_name" id="licence_type_name" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="6" oninvalid="setCustomValidity('لطفا نوع جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative">
                                    <label for="exporter_refrence" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">مرجع تایید جواز</label>
                                    <input name="exporter_refrence" id="exporter_refrence" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="7" oninvalid="setCustomValidity('لطفا مرجع تأیید جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative full-date-picker">
                                    <label for="issuence_date" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تاریخ صدور جواز</label>
                                    <input name="issuence_date" id="issuence_date" type="text" class="datePicker mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="8" oninvalid="setCustomValidity('لطفا تاریخ صدور جواز را وارد کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12 sm:col-span-6">
                                <div class="relative full-date-picker">
                                    <label for="expiration_date" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">تاریخ انقضا جواز</label>
                                    <input name="expiration_date" id="expiration_date" type="text" class="datePicker mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="9" oninvalid="setCustomValidity('لطفا تاریخ انقضا جواز را انتخاب کنید')" oninput="setCustomValidity('')" required>
                                </div>
                            </div>

                            <div class="col-span-12">
                                <div class="relative">
                                    <label for="description" class="block text-sm font-medium text-gray-700 after:content-['*'] after:ml-0.5 after:text-red-500">زمینه فعالیت</label>
                                    <textarea name="description" id="description" rows="3" type="text" class="mt-1 focus:to-tolidatColor focus:border-tolidatColor focus-visible:ring-2 focus-visible:ring-tolidatColor block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md px-3 py-2                form-control set-font-latin" tabindex="10" oninvalid="setCustomValidity('لطفا زمینه فعالیت را وارد نمایید')" oninput="setCustomValidity('')" required></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-12      modal-body">

                        <div class="reg-alert-r text-center">تصویر جواز خود را انتخاب نمایید</div>

                        <div class="max-w-md mx-auto mt-2             docs-buttons">

                            <div class="shadow rounded-md            img-container upload-msg register-crop">
                                <img class="width image-javaz img-cropper" id="imageLicence" src="<?php echo  RELA_DIR . 'templates/' . CURRENT_SKIN . '/assets/image/placeholder.png'; ?>" alt="Picture">
                            </div>

                            <div class="btn-block mt">
                                <label class="btn-block btn btn-success uploud-btnProCrop pull-right mb" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                    <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                        <span>
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                        <span class="mt-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-400 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600           btn btn-success btn-sm reg-btn-n">انتخاب تصویر</span>
                                    </span>
                                </label>
                                <input class="result-crop" type="hidden" name="imageCropped" value="">
                            </div>

                        </div>

                    </div>

                    <div>
                        <button type="submit" id="addLicence" class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           btn btn-success btn-sm reg-btn-n">
                            ذخیره مجوز
                        </button>

                        <button type="button" id="closeModal" data-dismiss="modal" class="absolute right-32 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-red-300              btn btn-success btn-sm reg-btn-n">
                            انصراف
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 h-14 mt-4 sm:mt-16"></div>
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
    var test = document.getElementById("test");
    test.onclick = function(e) {
        //var data = document.getElementById("registration_date");
        //console.log(data.val);
        // $('[name=registration_date]').val('ali');
        console.log($('[name=registration_date]').val());
        console.log($('[name=registration_date]').validity);

        $('[name=registration_date]').on('change', function(ev) {

            console.log('ali ali');
            console.log(ev);
            //console.log('ali ali', $this.val());
            // $this.valid();  // triggers the validation test
            //$this.val('ali');  // triggers the validation test

            // '$(this)' refers to '$("#datepicker")'
        });
    }





    // Grabs all the Elements by their IDs which we had given them
    let modal = document.getElementById("my-modal");

    let btn = document.getElementById("open-btn");
    let close = document.getElementById("closeModal");

    // let button = document.getElementById("ok-btn");

    // We want the modal to open when the Open button is clicked
    if (btn) {
        btn.onclick = function(e) {
            //e.preventDefault();
            modal.style.display = "block";
        }


        close.onclick = function(e) {
            // e.preventDefault();
            modal.style.display = "none";
        };
    }


    // We want the modal to close when the OK button is clicked
    // button.onclick = function() {
    //     modal.style.display = "none";
    // }

    // The modal will close when the user clicks anywhere outside the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


    $(function() {
        var $body = $('body'),
            // $delLicense = '<a class="btn btn-danger btn-sm pull-right center-block delete-licence" style="margin-top: 7px;">حذف مجوز</a>',
            $delLicense = '<button type="button" class="mr-auto ml-0 flex justify-center py-1 px-3 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600           btn btn-danger btn-sm pull-right center-block delete-licence">حذف مجوز</button>',

            $addLicense = '<button type="button" class="btn btn-primary btn-sm pull-right center-block addLicenseCompany" style="margin-top: 7px;">افزودن مجوز</button>';

        $('body #div-licence_type').hide();
        $('body #licence-type-edit').hide();

        $body.on('change', '#licence_type', function() {
            if ($(this).val() == 0) {
                $('#div-licence_type').show();
            } else {
                $('#div-licence_type').hide();
            }
        });

        var cnt = 0;
        $body.on('click', '.addLicenseCompany', function() {

            $('#licence_type').empty();

            $.post('/register/addLicence/', function(data) {
                var result = $.parseJSON(data);

                $body.find('#licence_type').append('<option value="">نوع جواز را انتخاب نمایید...</option>');

                $.each(result.licence_list, function(key, value) {
                    if (result.licence_prev) {
                        $('#licence_type').append('<option value="' + value.Licence_list_id + '"' + (result.licence_prev.licence_type == value.Licence_list_id ? 'selected' : '') + '>' + value.name + '</option>');
                    } else {
                        $('#licence_type').append('<option value="' + value.Licence_list_id + '">' + value.name + '</option>');
                    }
                });

                $body.find('#licence_type').append('<option value="0">غیره...</option>');

                $.each(result.licence_prev, function(key, value) {
                    $('#myModal3').find('[name="' + key + '"]').val(value);

                    if (key == 'imageCropped') {
                        $('#myModal3').find('[id="imageLicence"]').attr('src', value);
                    }
                });

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="tel"], input[type="password"], textarea').each(function() {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                // $('#myModal3').modal('show');

            });
        });

        $body.on('click', '#addLicence', function() {
            $('.image_name').val($('#img').attr('src'));
            var $this = $(this),
                form = $('.form')[0],
                formData = new FormData(form);

            $this.prop('disabled', true);

            if ($('.iziToast').length) {
                var toast = document.querySelector('.iziToast');
                iziToast.hide(toast);
            }

            $.ajax({
                url: '/register/addLicenceByAjax/',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $this.prop('disabled', false);

                    var response = $.parseJSON(data);
                    if (response.result === -1) {
                        var validationMsg = '';

                        if (response.name !== undefined && response.name.length) {
                            validationMsg += response.name + ' <br> ';
                        }

                        if (response.description !== undefined && response.description.length) {
                            validationMsg += response.description + ' <br> ';
                        }

                        if (response.expiration_date !== undefined && response.expiration_date.length) {
                            validationMsg += response.expiration_date + ' <br> ';
                        }

                        if (response.exporter_refrence !== undefined && response.exporter_refrence.length) {
                            validationMsg += response.exporter_refrence + ' <br> ';
                        }

                        if (response.family !== undefined && response.family.length) {
                            validationMsg += response.family + ' <br> ';
                        }

                        if (response.issuence_date !== undefined && response.issuence_date.length) {
                            validationMsg += response.issuence_date + ' <br> ';
                        }

                        if (response.national_code !== undefined && response.national_code.length) {
                            validationMsg += response.national_code + ' <br> ';
                        }

                        validationMsg += response.msg;

                        $.iziToastError(validationMsg, '.content-izi .izi-container');
                    } else {

                        var html = '<li class="text-center">' +
                            '<div class="row noMargin">' +
                            '<div class="col-xs-4 col-sm-4 col-md-4 pull-right">' +
                            '<img class="roundCorner fullWidth boxBorder" src="' + response.data.imageCropped + '" alt="">' +
                            '</div>' +
                            '<div class="col-xs-8 col-sm-8 col-md-8 pull-right">' +
                            '<h3 class="text-right">' + response.data.name + ' ' + response.data.family + '</h3>' +
                            '<p class="text-right">به شماره جواز ' + response.data.licence_number + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</li>';

                        $('.selected-category').find('.emptyLabel').remove();
                        $('.selected-category').append(html);

                        // $('#myModal3').modal('hide');
                        modal.style.display = "none";

                        $body.find('.addLicenseCompany').remove();
                        $body.find('.license-container').append($delLicense);

                        $.iziToastSuccess(response.msg, '.content .izi-container');
                    }
                }
            });
        });

        if ($('p.error').text().length != 0) {
            // $.iziToastError($('p.error').text(), '.content .izi-container');
        }

        function emptyModal() {
            $('#myModal3').find('input[type="text"], input[type="hidden"], input[type="file"], textarea').each(function() {
                $(this).val("");
                $(this).siblings('.requiredIcon').empty().text('*');
                $(this).parent().removeClass('has-error has-success typing');
            });

            $('#myModal3').find('#imageLicence').attr("src", '<?php echo RELA_DIR . "templates/template_tailwind/assets/images/placeholder.png" ?>');

            $('#myModal3').find('#div-licence_type').hide();
        }

        $body.on('click', '.delete-licence', function() {
            var $this = $(this);

            if (confirm("از حذف مجوز اطمینان دارید")) {

                $.get('/register/deleteLicenceByAjax/', function(data) {
                    var response = $.parseJSON(data);

                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.content .izi-container');
                        return;
                    }

                    /*$.iziToastSuccess(response.msg, '.content .izi-container');
                    $('.show-added-licence').empty();
                    emptyModal();

                    $this.remove();

                    $('.selected-category').html('<li class="text-center emptyLabel">هیچ آیتمی موجود نیست</li>');

                    $body.find('.license-container').prepend($addLicense);*/

                    window.location.reload();
                });
            }
        });

        $body.on('click', '#toggleLicense', function() {
            if ($(this).is(':checked')) {
                $body.find('[data-toggle="toggleLicense"]').removeClass('hidden');
            } else {
                $body.find('[data-toggle="toggleLicense"]').addClass('hidden');
            }
        });

    });
</script>