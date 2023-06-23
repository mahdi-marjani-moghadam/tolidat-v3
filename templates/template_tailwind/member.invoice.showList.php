<div class="row xxsmallSpace"></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="صورت حساب" class="title-pro">اطلاعات پرداخت</span>
        </div>
    </div>
</div>
<div class="container-fact">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb text-center center-block active-package">
            <?php if ($list['active-package-upgarde']) : ?>
                <a class="single"  href="<?php echo  RELA_DIR . "member/package/upgrade" ?>">
                    <button data-position="right" type="button" class="btn btn-success btn-md bc-color-green btn-block">
                        <span><i class="fa fa-plus transition" aria-hidden="true"></i></span>
                        <span class="transition">ارتقا پکیج</span>
                    </button>
                </a>
            <?php else: ?>
                <button class="btn btn-success btn-md pull-left bc-color-green" disabled>ارتقا پکیج</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php foreach ($list['invoice'] as $key => $fields): ?>
    <div class="row companyTable">
        <div data-intro="صورت حساب" class="container-factor center-block whiteBg boxBorder">
            <div class="row xxxsmallSpace"></div>
            <p class="register-date">تاریخ خرید:<span><?php echo convertDate($fields['date']); ?></span></p>
            <hr>

            <?php if ($msg['msg']): ?>
                <p class="alert alert-success"><?php echo($msg['msg'] ? $msg['msg'] : '') ?></p>
            <?php endif; ?>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <div class="col-xs-12 col-sm-1 col-md-1 pull-right text-center mb">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <span>پکیج</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <span class="package-type"><?php echo $fields['package']['packagetype']; ?></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 pull-right text-center mb">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <span>تاریخ شروع</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <!--separator-->
                        <div class="row xxxsmallSpace"></div>
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?php echo convertDate($fields['start_date']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 pull-right text-center mb">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <span>تاریخ انقضا</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <!--separator-->
                        <div class="row xxxsmallSpace"></div>
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <?php echo convertDate($fields['expire_date']); ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 pull-right text-center mb">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <span>قیمت</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <span><?php echo $fields['price']; ?> ریال </span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right text-center mb">
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <span class="payment-status">وضعیت پرداخت</span>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 pull-right text-center noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <i class="fa <?php echo($fields['status'] == '0' ? 'fa-times' : 'fa-check'); ?>" aria-hidden="true"></i>

                        <?php if ($fields['status'] == '0') : ?>
                            <a href="<?php echo RELA_DIR . "member/invoice/exportation/" . $fields['package_id'] ?>">
                                <button data-position="right" type="button" class="btn btn-success btn-md bc-color-green btn-block" style="margin-top: 1em !important;">
                                    <span class="transition">پرداخت</span>
                                </button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <hr>
            <!--separator-->
            <div class="row xxxsmallSpace"></div>
        </div>
    </div>
    <!--separator-->
    <div class="row xxxsmallSpace"></div>
<?php endforeach; ?>

<!--<div>
    <?php /*if ($list['active-package-upgarde']) : */?>
        <a class="btn btn-primary" href="<?/*= RELA_DIR . "member/package/upgrade" */?>">ارتقا پکیج</a>
    <?php /*else: */?>
        <button class="btn btn-primary" disabled>ارتقا پکیج</button>
    <?php /*endif; */?>
</div>
-->
