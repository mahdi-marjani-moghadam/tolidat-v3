<div class="row xxsmallSpace"></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="تیتر نمایندگی ها" class="title-pro">نمایندگی</span>
            <button data-position="right" data-intro="اضافه کردن نمایندگی" id="addForm" type="button" class="btn btn-sm pull-left add-btnPro" data-toggle="modal" data-target="#myModal2">
                <i class="fa fa-plus transition bc-color-green1" aria-hidden="true"></i>
                <span class="transition">افزودن نمایندگی</span>
            </button>
        </div>
    </div>
</div>

<div class="row xxsmallSpace"></div>

<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<div class="row companyTable">
    <div class="col-xs-12 col-sm-12 col-md-9 mb-double3 center-block">
        <div class="container-factor center-block whiteBg boxBorder">
            <div class="row xxxsmallSpace"></div>
            <p class="register-date">لیست نمایندگی های کمپانی <?php echo $list['name'] ?></p>
            <hr>
            <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                <div class="col-xs-2 col-sm-3 col-md-3 pull-right mb noPadding">
                    <span>کد</span>
                </div>
                <div class="col-xs-6 col-sm-5 col-md-5 pull-right mb noPadding">
                    <span>نام نمایندگی</span>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 pull-right mb noPadding">
                    <span>وضعیت</span>
                </div>
            </div>
            <?php foreach ($list['request']['list'] as $id => $fields) : ?>
                <div class="col-xs-12 col-sm-12 col-md-12 noPadding representation_item" data-id="<?php echo $fields['Representation_id']; ?>">
                    <div class="col-xs-2 col-sm-3 col-md-3 noPadding pull-right mb">
                        <div class="row xxxsmallSpace"></div>
                        <span class="package-type"><?php echo $fields['company_id'] ?></span>
                    </div>
                    <div class="col-xs-6 col-sm-5 col-md-5 noPadding pull-right mb">
                        <div class="row xxxsmallSpace"></div>
                        <?php echo $fields['name'] ?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 noPadding pull-right mb">
                        <div class="row xxxsmallSpace"></div>
                        <p class="color-red">
                            <?php if ($fields['confirm'] == -1) { ?>
                                <?php echo "رد" ?>
                            <?php } ?>
                        </p>
                        <p class="color-orange">
                            <?php if ($fields['confirm'] == 0) {
                            ?>
                                <?php echo "در حال بررسی" ?>
                            <?php } ?>
                        </p>
                        <p class="color-green">
                            <?php if ($fields['confirm'] == 1) { ?>
                                <?php echo "تایید" ?>
                            <?php } ?>
                        </p>
                    </div>
                    <a class="pull-left trash-panel deleteRepresentation" href="#" data-value="<?php echo $fields['Representation_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </div>
            <?php endforeach; ?>

            <hr>
            <!--separator-->

            <div class="row xxxsmallSpace"></div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-9 center-block mb-double3">
        <div class="container-factor whiteBg center-block boxBorder">
            <div class="row xxxsmallSpace"></div>
            <p class="register-date">لیست کمپانی هایی که درخواست نمایندگی ما را دارند</p>
            <hr>
            <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                <div class="col-xs-2 col-sm-3 col-md-3 pull-right mb noPadding">
                    <span>کد</span>
                </div>
                <div class="col-xs-6 col-sm-5 col-md-5 pull-right mb noPadding">
                    <span>نام نمایندگی</span>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4 pull-right mb noPadding">
                    <span>وضعیت</span>
                </div>
            </div>
            <?php foreach ($list['send']['list'] as $id => $fields) : ?>
                <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                    <div class="col-xs-2 col-sm-3 col-md-3 pull-right mb noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <span class="package-type"><?php echo $fields['representation_company'] ?></span>
                    </div>
                    <div class="col-xs-6 col-sm-5 col-md-5 pull-right mb noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <?php echo $fields['company_name'] ?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 pull-right mb noPadding">
                        <div class="row xxxsmallSpace"></div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 noPadding">
                                <label class="label-question-no"><input type="radio" class="option-input radio center-block confirm" name="<?php echo "confirm_" . $fields['Representation_id']; ?>" value=<?php echo $fields['Representation_id']; ?> <?php if ($fields['confirm'] == 1) echo "checked"; ?>>تایید</label>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 noPadding">
                                <label class="label-question-yes"><input type="radio" class="option-input radio center-block reject" name="<?php echo "confirm_" . $fields['Representation_id']; ?>" value=<?php echo $fields['Representation_id']; ?>>رد</label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr>
            <!--separator-->
            <div class="row xxxsmallSpace"></div>
        </div>
    </div>
</div>

<!--  Modal -->
<div class="holder-modal modal-product modal fade container-floatinglabel" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن نمایندگی</h5>
            </div>
            <div class="modal-body">
                <div class="iziAdd-container"></div>
                <div class="row xxxsmallSpace"></div>
                <form id="addCode" class="form addCode" method="post" data-toggle="validator">
                    <div class="form-group">
                        <label for="representation_name">نام نمایندگی را وارد کنید</label>
                        <input name="representation_name" type="text" class="form-control" id="representation_name" required data-error="لطفا نام نمایندگی را وارد کنید">
                    </div>
                    <div class="row xxsmallSpace"></div>
                    <div class="form-group mb">
                        <label for="representation_company">کد نمایندگی را وارد کنید</label>
                        <input name="representation_company" type="text" class="form-control" id="representation_company" required data-error="لطفا کد نمایندگی را وارد کنید">
                    </div>
                    <div class="row xxxsmallSpace"></div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="addCode" class="btn btn-success btn-sm">تایید</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
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
    var $body = $('body'),
        modal_confirm_code = $('#myModal2');
    $(function() {
        $("#addCode").on("submit", function(e) {
            e.preventDefault();
            var form = $('.form')[0];
            var formData = new FormData(form);
            var representation_company = $("#representation_company").val();
            formData.append("representation_company", representation_company);
            $.ajax({
                url: '/member/representation/add/',
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.iziAdd-container');
                    } else {
                        modal_confirm_code.modal('hide');
                        location.reload();
                    }
                }
            });
        });
        $(".confirm").on("change", function() {
            var $this = $(this);
            var representation_id = $this.val();
            $.post('/member/representation/confirm', {
                id: representation_id
            }, function(data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    $.iziToastSuccess(response.msg, '.content .izi-container');
                } else {
                    $.iziToastError(response.msg);
                }
            });
        });
        $(".reject").on("click", function() {
            var $this = $(this);
            var representation_id = $this.val();
            $.post('/member/representation/reject', {
                id: representation_id
            }, function(data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    $.iziToastSuccess(response.msg, '.content .izi-container');
                } else {
                    $.iziToastError(response.msg, '.content .izi-container');
                }
            });
            location.reload();
        });
        $('.deleteRepresentation').on('click', function() {
            var $this = $(this),
                representation_id = $this.data('value'),
                lastItem = $body.find('.representation_item').length;

            iziToast.question({
                title: "آیا از حذف این آیتم اطمینان دارید؟",
                close: false,
                backgroundColor: '#FFF',
                messageColor: 'red',
                color: 'green',
                icon: 'fa fa-question',
                iconColor: 'gray',
                rtl: true,
                closeOnEscape: false,
                toastOnce: true,
                overlay: true,
                overlayClose: true,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                drag: false,
                timeout: false,
                position: 'center',
                message: lastItem === 1 ? "با حذف کردن این آیتم امتیاز مرتبط با این موضوع از امتیاز کل شما کسر خواهد شد" : "<p></p>",
                buttons: [
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                        $.post('/member/representation/delete', {
                            id: representation_id
                        }, function(response) {
                            var data = $.parseJSON(response);
                            if (data.result == -1) {
                                $.iziToastError(data.message, '.content .izi-container');
                                return;
                            }
                            $.iziToastSuccess(data.message, '.content .izi-container');
                            location.reload();
                        });

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                    }]
                ]
            });
        });
    });
</script>