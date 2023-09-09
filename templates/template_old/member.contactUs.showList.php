<!-- separator -->
<?php //print_r_debug($list); ?>
<div class="row xxsmallSpace crop"></div>

<!--container iziToast-->
<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<!--title-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="پیام های کاربران" class="title-pro">پیام های کاربران</span>
        </div>
    </div>
</div>
<!-- separator -->
<div class="panel-body">
    <!-- separator -->
    <div class="row addContacts"></div>
    <?php if (isset($list) && count($list)): ?>
        <?php foreach ($list as $id => $fields): ?>
            <div class="row removeNotification">
                <div class="col-xs-12 col-sm-8 col-md-6 center-block">
                    <div data-intro="پیام های کاربران" class="row row-circle boxBorder whiteBg">
                        <a class="pull-left trash-panel deleteNotification" href="#" data-value="<?php echo $fields['Contacts_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <div class="col-xs-12 col-sm-2 col-md-2 pull-right">
                            <img class="boxBorder  roundCornerFull image-notification center-block" src="<?php echo DEFULT_LOGO_ADDRESS ?>" alt=""/>
                            <div class="pull-right color-massage user-type">
                                <i class="fa fa-user" aria-hidden="true"></i> کاربر
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-10 col-md-10 pull-right">
                            <div class="massege">
                                <a><?php echo $fields['message']; ?></a>
                            </div>
                            <div class="pull-right color-massage">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <?php echo convertDate($fields['date']); ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notRecord">
            <div class="row xsmallSpace hidden-xs"></div>
            <div class="alert alert-success text-center" role="alert">رکوردی موجود نمی باشد.</div>
        </div>
    <?php endif; ?>
</div>
<script>
    $(function () {
        $('.deleteNotification').on('click', function () {
            var $this = $(this);
            var notification_id = $(this).data('value');

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
                message: "<p></p>",
                buttons: [
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        $.post('/member/companyContacts/us/delete/', {id: notification_id}, function (response) {
                            var data = $.parseJSON(response);
                            if (data.result == -1) {
                                $.iziToastError(data.message, '.izi-container');
                                return;
                            }
                            $.iziToastSuccess(data.message, '.izi-container');
                            $this.parents('.removeNotification').remove();
                            if ($('.removeNotification').length < 1) {
                                var html = '<div class="notRecord">' +
                                    '<div class="row xsmallSpace"></div>' +
                                    '<div class="alert alert-success text-center" role="alert">رکوردی موجود نمی باشد.</div>' +
                                    '</div>';
                                $('.addContacts').append(html);
                            }
                        });

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ]
            });
        });
    });
</script>

