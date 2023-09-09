<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/iziToast.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/validator.min.js"></script>
<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/font-awesome.min.css" xmlns="http://www.w3.org/1999/html">

<style>
    .companyTable .fa {
        color: #ff660c;
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
            <a class="container-destination"><span>فاکتور</span></a>
        </div>
    </div>
</div>

<div class="container mx-auto py-8 px-4">
    <div class="shadow rounded-md overflow-hidden             row companyTable companyTable2">
        <div class="container-package-factor center-block package-border-gold roundCorner mb-double relative">

            <div class="flex items-center px-6 py-2 shadow          header-package-factor <?php echo $list['package_class']; ?>" id="price">
                <span class="">پکیج <?php echo $list['packagetype']; ?></span>

                <div class="justify-items-end mx-auto ml-0 border-2 rounded-3xl border-tolidatColor px-2        container-badge" href="#">
                    <!-- <div class="badge"><span class="title-badge">مرحله</span> 6 از 6 </div> -->

                    <span class="factor-package-price price" <?php echo ($list['percent'] == 0 ? '' : 'style="text-decoration: line-through"') ?>><?php echo number_format($list['price']); ?> ریال</span>
                    <span class="package-separator-header center-block"></span>
                </div>
            </div>

            <div class="p-4">
                <?php if ($msg['msg']) : ?>
                    <p style="display: none" class="alert alert-danger"><?php echo ($msg['msg'] ? $msg['msg'] : '') ?></p>
                <?php endif; ?>

                <div class="content-msg"></div>

                <div class="bg-gray-200 py-8 rounded-md         row background-factor roundCorner">

                    <div class="">
                        <span class="text-center w-full block font-bold text-xl          factor-status-title">
                            وضعیت پرداخت
                            <i class="px-1 fa <?php echo ($list['status'] == '0' ? 'fa-times' : 'fa-check'); ?>" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="flex flex-col sm:flex-row text-center mt-8">

                        <div class="w-full sm:w-1/2">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="">اعتبار پکیج: <?php echo $list['period'];?> ماهه</span>
                        </div>

                        <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            <span class="">تخفیف: <span><?php echo $list['percent'] ?> درصد</span> </span>
                        </div>

                    </div>

                </div>

                <div class="mt-12 text-gray-500">
                    <p class="mb-double3" style="text-align: center">کاربر گرامی در صورت داشتن کد تخفیف آن را در کادر زیر وارد کرده و دکمه اعمال کد را بزنید و سپس عملیات پرداخت را ادامه دهید.</p>
                </div>

                <div class="mt-4">
                    <div class="container-set-code max-w-md mx-auto">
                        <div class="input-group">
                            <div class="flex flex-wrap items-stretch w-full mb-4 relative " dir="ltr">
                                <div class="flex -mr-px">
                                    <span class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm        input-group-btn">
                                        <button class="btn btn-default discount-code" type="button">اعمال کد</button>
                                    </span>
                                </div>
                                <input type="text" name="discount_code" id="discount-code" placeholder="کد تخفیف خود را وارد کنید" class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 md:mt-16 flex  flex-col sm:flex-row items-center justify-center" id="total_price">
                    <span class="text-center font-bold text-xl                 factor-bill-title">مبلغ قابل پرداخت: </span>
                    <span class="text-center font-bold text-xl                 factor-bill-title"><?php echo number_format($list['total_price']); ?> ریال</span>

                </div>

                <div class="">
                    <a class="absolute right-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-400 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600                       factor-btn-edit " href="<?php echo RELA_DIR . "package" ?>">تغییر پکیج</a>

                    <a class="absolute left-6 bottom-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600           factor-btn-payment" href="<?php echo RELA_DIR . "invoice/payment/" . $list['Invoice_id']; ?>">پرداخت</a>
                </div>
            </div>

            <div class="bg-gray-50 h-14 mt-4 md:mt-16"></div>
        </div>
    </div>
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
        $('.discount-code').on('click', function() {
            var btn_apply_discount = $(this);
            var discount_code = $('#discount-code').val();
            btn_apply_discount.attr('disabled', 'disabled');
            $('#discount-code').val('');

            $.post('/discountCode/discount', {
                'discount_code': discount_code
            }, function(data) {
                var response = $.parseJSON(data);

                if (response.result == -1) {
                    $.iziToastError(response.msg, '.content-msg');
                    btn_apply_discount.removeAttr('disabled');
                    return false;
                } else {
                    $('#percent').find('span').text(response.percent + ' درصد');
                    $('#total_price').find('span').text('مبلغ قابل پرداخت: ' + response.total_price + ' ریال');
                    $('#price').find('span.price').css('text-decoration', 'line-through');
                    btn_apply_discount.removeAttr('disabled');
                }

            });
        });

        if ($('.alert-danger').length) {
            $.iziToastError($('.alert-danger').text(), '.content-msg');
        }
    });
</script>