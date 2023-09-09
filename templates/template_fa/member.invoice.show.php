<div class="row xxsmallSpace"></div>
<div class="row companyTable companyTable2">
    <div class="container-package-factor center-block package-border-gold roundCorner mb-double">
        <div class="header-package-factor <?php echo $list['package_class']; ?>" id="price">
            <span class="factor-type-title">پکیج</span>
            <span class="factor-package-type"><?php echo $list['packagetype']; ?></span>
            <span class="factor-package-price price" <?php echo ($list['percent'] == 0 ? '' : 'style="text-decoration: line-through"') ?>><?php echo number_format($list['price']); ?> ریال</span>
            <span class="package-separator-header center-block"></span>
        </div>
        <?php if ($msg['msg']) : ?>
            <p style="display: none" class="alert alert-danger"><?php echo ($msg['msg'] ? $msg['msg'] : '') ?></p>
        <?php endif; ?>
        <div class="row xxsmallSpace"></div>

        <div class="row background-factor roundCorner">
            <div class="row xxxsmallSpace"></div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <span class="factor-status-title">وضعیت پرداخت<i class="fa <?php echo ($list['status'] == '0' ? 'fa-times' : 'fa-check'); ?>" aria-hidden="true"></i></span>
            </div>
            <div class="row xxxsmallSpace"></div>
            <div class="row xxxsmallSpace hidden-xs"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 noPadding mt mb text-center">
                <div class="col-xs-12 col-sm-4 col-md-4 pull-right noPadding">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span class="">تاریخ شروع:</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                        <?php echo convertDate($list['startdate']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 pull-right noPadding">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <span class="">تاریخ اتمام:</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                        <?php echo convertDate($list['expiredate']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 pull-right noPadding">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                        <span class="">تخفیف:</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb" id="percent">
                        <span><?php echo $list['percent'] ?> درصد</span>
                    </div>
                </div>
            </div>
            <div class="row xxxsmallSpace hidden-xs"></div>
        </div>


        <div class="row xxxsmallSpace"></div>
        <div class="row xxsmallSpace hidden-xs"></div>

        <p class="mb-double3" style="text-align: center">کاربر گرامی در صورت داشتن کد تخفیف آن را در کادر زیر وارد کرده و دکمه اعمال کد را بزنید و سپس عملیات پرداخت را ادامه دهید.</p>
        <div class="col-xs-12 col-sm-6 col-md-6 center-block float-none">
            <div class="discount-container">

            </div>
            <div class="container-set-code mt">
                <!-- <input type="text" name="discount_code" id="discount-code" placeholder="کد پیگیری خود را وارد کنید">
                 <button class="btn-set-code discount-code">اعمال کد</button>-->
                <div class="input-group">
                    <input type="text" name="discount_code" id="discount-code" placeholder="کد تخفیف خود را وارد کنید">
                    <span class="input-group-btn">
                        <button class="btn btn-primary discount-code" type="button">اعمال کد</button>
                    </span>
                </div>
                <!-- /input-group -->
            </div>
        </div>
        <div class="row xxsmallSpace hidden-xs"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 noPadding mt mb">
            <div class="col-xs-12 col-sm-12 col-md-12 center-block float-none" id="total_price">
                <span class="factor-bill-title">مبلغ قابل پرداخت: <?php echo number_format($list['total_price']); ?> ریال</span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <hr>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-double4">
            <a class="btn btn-success factor-btn-payment" href="<?php echo RELA_DIR . "member/invoice/payment/" . $list['Invoice_id']; ?>">پرداخت</a>
            <a class="btn btn-default factor-btn-edit " href="<?php echo RELA_DIR . "member/package/upgrade" ?>">تغییر پکیج</a>
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
                    $.iziToastError(response.msg, '.discount-container');
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
            $.iziToastError($('.alert-danger').text());
        }
    });
</script>