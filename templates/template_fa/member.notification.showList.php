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
            <span class="title-pro">اعلان ها</span>
        </div>
    </div>
</div>

<div class="panel-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <?php foreach ($list as $id => $fields) : ?>
        <div class="row removeNotification">
            <div class="col-xs-12 col-sm-8 col-md-6 center-block">
                <div class="row boxBorder row-circle whiteBg <?php echo  $fields['isRead'] ? "read" : "unread" ?>">
                    <a class="trash-panel deleteNotification" href="#" data-value="<?php echo $fields['Notification_id']; ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <!--<div class="col-xs-12 col-sm-2 col-md-2 pull-right">
                        <img class="boxBorder  roundCornerFull image-notification center-block" src="<?php /*echo DEFULT_LOGO_ADDRESS */ ?>" alt=""/>
                    </div>-->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="massege">
                            <a href="/profile/notification/<?php echo $fields['Notification_id']; ?>"><?php echo $fields['msg']; ?></a>
                        </div>
                        <div class="pull-right color-massage user-type">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <?php
                            if ($fields['messageType'] == 2) {
                                echo "مدیر";
                            } else {
                                echo "تولیدی ";
                            }
                            ?>
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
        $('.deleteNotification').on('click', function() {
            var $this = $(this),
                notification_id = $this.data('value'),
                lastItem = $body.find('.removeNotification').length;

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

                        $.post('/member/notification/delete', {
                            id: notification_id
                        }, function(response) {
                            var data = $.parseJSON(response);
                            if (data.result == -1) {
                                $.iziToastError(data.message, '.izi-container');
                                return;
                            }
                            $.iziToastSuccess(data.message, '.izi-container');
                            $this.parents('.removeNotification').remove();
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