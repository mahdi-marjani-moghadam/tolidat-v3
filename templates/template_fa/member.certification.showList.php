<!--button-->
<div class="row xxsmallSpace"></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="در صورت داشتن گواهی هایی مانند ISO،استاندارد،تایید کیفیت و ... در این قسمت درج نمایید." class="title-pro">ثبت گواهی ها</span>
            <button data-position="right" data-intro="اضافه کردن گواهی ها" id="addForm" type="button" class="btn btn-sm pull-left add-btnPro" data-toggle="modal" data-target="#myModal2">
                <input type="hidden" class="certification_list_count" value="<?php echo $list['certification_list_count'] ?>">
                <i class="fa fa-plus transition bc-color-darkorange" aria-hidden="true"></i>
                <span class="transition">انتخاب گواهی</span>
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-certification">
    <?php if (isset($list['list']) && count($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields) : ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb remove-certification" data-value="<?php echo  $fields['Certification_d_id'] ?>">
                <div data-intro="لیست گواهی ها" class="contentPro<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> contentPro-cert whiteBg roundCorner" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo ($fields['status'] == 1) ? 'تایید شده' : 'تایید نشده' ?>">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content kebab-menu-content-certification roundCorner boxBorder">
                                <li><a class="link-trash" data-value="<?php echo  $fields['Certification_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>
                            </ul>
                        </div>
                        <div class="logo">
                            <img class="boxBorder lazy" data-src="<?php echo $fields['image'] ? IMAGES_RELA_DIR . "/certification/" . $fields['image'] : DEFULT_LOGO_ADDRESS ?>" alt="">
                        </div>
                        <span class="title"><?php echo $fields['title'] ?></span>
                        <span class="i-date"><i class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p></p>
                        <p><?php echo $fields['description'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notRecord">
            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
            <p class="empty-text">اطلاعاتی موجود نیست!</p>
        </div>
    <?php endif; ?>
</div>

<!--Modal add-->
<div class="holder-modal modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title roundCorner" id="myModalLabel">درج تصویر گواهی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <form id="addCertification" class="form" enctype="multipart/form-data" method="post">
                    <div class="row addCertificate">
                        <!-- add certification with Ajax -->
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن
                        </button>
                        <button type="submit" id="add" class="btn btn-success btn-sm">ذخیره مورد جدید</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--ajax-->
<script>
    $(function () {
        var modal_add = $('#myModal2');
        $("#addForm").on("click", function (e) {
            e.preventDefault();
            $('.addCertificate').empty();
            $.post('/member/certification/formAjax/', function (data) {
                var result = $.parseJSON(data);
                if (result != null) {
                    $.each(result, function (key, item) {
                        $('.addCertificate').append(
                            "<div class='col-xs-12 col-sm-6 col-md-6 pull-right mb3'>" +
                            "<div class='contentPro contentPro-cert contentPro-cert-modal whiteBg roundCorner" + (item.checked == 'on' ? ' checked' : '') + "' data-toggle='tooltip' data-placement='bottom' title='' data-original-title='تایید شده'>" +
                            "<h3>" +
                            "<div class='logo'>" +
                            "<img id='image' class='boxBorder' src='<?php echo RELA_DIR . 'statics/images/certification/'?>" + item.image + "'" + "alt=''>" +
                            "</div>" +
                            "<span id='title' class='title'>" + item.title + "</span>" +
                            "</h3>" +
                            "<div class='text'>" +
                            "<p>" + "</p>" +
                            "<p id='description'>" + item.description + "</p>" +
                            "<input type='hidden' name='Certification_list_id' value='" + item.Certification_list_id + "'>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        );
                    });
                    modal_add.modal('show');
                }
            });
        });

        $('#addForm').hover(function () {
            var certification_list_count = $('.certification_list_count').val();
            var records_count = $('body .add-certification .remove-certification').size();

            if (certification_list_count <= records_count && certification_list_count != '0') {
                $('#addForm').removeAttr('data-toggle');
            } else {
                $('#addForm').attr('data-toggle', 'modal');
            }
        });

        $("#addCertification").on("submit", function (e) {
            e.preventDefault();
            var arr = [];
            var i = 0;
            $('.checked').each(function () {
                var id = $(this).find('input').val();
                arr[i] = id;
                i++;
            });
            $.ajax({
                url: '/member/certification/add/',
                type: 'post',
                cash: false,
                data: {arr: arr},
                success: function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        for (var i = 1; i <= response.count; i++) {

                            var Certification_d_id = response.fields[i]['Certification_d_id'],
                                date = response.fields[i]['date'],
                                title = response.fields[i]['title'],
                                description = response.fields[i]['description'],
                                image = response.fields[i]['image'],
                                html = '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-certification" data-value="' + Certification_d_id + '">' +
                                    '<div class="contentPro disable contentPro-honour whiteBg roundCorner" ' + 'data-toggle="tooltip" data-placement="bottom" title="" ' + 'data-original-title="تایید نشده">' +
                                    '<h3>' +
                                    '<div class="kebabMenu">' +
                                    '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                                    '<ul class="kebab-menu-content kebab-menu-content-certification roundCorner boxBorder">' +
                                    '<li><a class="link-trash" data-value="' + Certification_d_id +'"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '<div class="logo"><img name="image_ajax" class="boxBorder" src="' + image + '" alt=""></div>' +
                                    '<span class="title">' + title + '</span>' +
                                    '<span class="i-date"><i class="fa fa-calendar"></i>' + date + '</span>' +
                                    '</h3>' +
                                    '<div class="text"><p>' + description + '</p></div>' +
                                    '</div>' +
                                    '</div>';

                            $('.add-certification').append(html);
                            $.iziToastSuccess(response.msg);
                        }
                    }
                    modal_add.modal('hide');
                    $('.notRecord').hide();
                }
            });
        });

        $('body').on('click', '.link-trash', function (e) {
            e.preventDefault();
            var dataID = $(this).data('value');
            if (confirm("آیا از حذف این آیتم اطمینان دارید")) {
                deleteItem(dataID);
            }
        });

        function deleteItem(dataID) {
            $.post('/member/certification/delete/', {id: dataID}, function (data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    var certification_d_id = response.fields.Certification_d_id;
                    var i = 0;
                    $(".remove-certification").each(function () {
                        i++;
                        if ($(this).data('value') == certification_d_id) {
                            $(this).remove();
                            $.iziToastSuccess(response.msg);
                        }
                    });
                    if (i == 1) {
                        $('.notRecord').show();
                    }
                }
            });
        }
    });

</script>
