<link rel="stylesheet"
        href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>

<style type="text/css">
    .betaVersion {
        color: #ff660c;
    }
</style>

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
            <span data-intro=" در این قسمت هرگونه آگهی اعم از آگهی تولید و ... را درج نمایید."
                    class="title-pro">ثبت آگهی</span> <span class="betaVersion">(نسخه آزمایشی)</span>
            <button data-intro="اضافه کردن آگهی" type="button" class="i-add btn btn-sm pull-left add-btnPro"
                    data-toggle="modal" data-target="#myModal2" data-backdrop="static">
                <i class="fa fa-plus transition bc-color-yellow1" aria-hidden="true"></i>
                <span class="transition">افزودن آگهی</span>
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-advertise">
    <?php if (isset($list['list']) && count($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields): ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-honour" data-value="<?= $fields['Advertise_id'] ?>">
                <div data-intro="لیست آگهی ها" class="contentPro<?php echo ($fields['status'] == 2) ? '' : ' disable' ?> whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content roundCorner boxBorder">
                                <li>
                                    <a class="link-edit" data-value="<?= $fields['Advertise_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                </li>
                                <li>
                                    <a class="link-trash" data-value="<?= $fields['Advertise_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo">
                            <img name="image_ajax" class="boxBorder lazy" data-src="<?php echo($fields['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/advertise/" . $fields['image'] : DEFULT_LOGO_ADDRESS) ?>" alt="">
                        </div>
                        <span class="title"><?php echo $fields['title'] ?></span>
                        <span class="i-date"><i class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p><?php echo $fields['description'] ?></p>
                        <span class="submit-msg"><?php echo ($fields['status'] == 2) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notRecord">
            <img class="empty-img center-block"
                    src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png">
            <p class="empty-text">اطلاعاتی موجود نیست!</p>
        </div>
    <?php endif; ?>
</div>

<!--Modal add-->
<div class="holder-modal modal-honour modal-advertise modal fade container-floatinglabel" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">درج آگهی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAdd-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addAdvertise" class="form" enctype="multipart/form-data" method="post" data-toggle="validator" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title">عنوان</label>
                                <input data-minWord="6" name="title" type="text" class="form-control progressText" id="title" required data-error="لطفا نام عنوان خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="description">توضیحات</label>
                                <textarea  data-minWord="6" name="description" class="form-control progressText" rows="3" id="description" data-error="لطفا توضیحات را وارد نمایید" required></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb full-date-picker">
                                <label for="startDate">تاریخ شروع</label> <input name="startDate" type="text"
                                        class="form-control datePicker" id="startDate" required
                                        data-error="لطفا تاریخ شروع خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb full-date-picker">
                                <label for="expireDate">تاریخ انقضا </label> <input name="expireDate" type="text"
                                        class="form-control datePicker" id="expireDate" required
                                        data-error="لطفا تاریخ انقضا خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block">
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img class="width image-crop img-cropper" src="<?= DEFULT_LOGO_ADDRESS ?>" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <input class="result-crop" type="hidden" name="imageCropped" value="">
                                        <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>انتخاب تصویر</span>
                                        </span>
                                    </label>
                                </div>
                                <!-- Show the cropped image in modal -->
                                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                            </div>
                                            <div class="modal-body"></div>
                                            <div class="modal-footer noPadding pt">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- separatoe -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="add" class="btn btn-success btn-sm">ذخیره مورد جدید</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Edit-->
<div class="holder-modal modal-honour modal-advertise modal fade container-floatinglabel" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش آگهی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editAdvertise" class="form" enctype="multipart/form-data" method="post" data-toggle="validator" novalidate="novalidate">
                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title">عنوان</label>
                                <input data-minWord="6" name="title" type="text" class="form-control rtl progressText" id="title" required data-error="لطفا نام عنوان خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="description">توضیحات</label>
                                <textarea data-minWord="6" name="description" class="form-control rtl progressText" rows="3"
                                          id="description"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb full-date-picker">
                                <label for="startDate">تاریخ شروع</label>
                                <input name="startDate" type="text" class="form-control datePicker " id="startDate" required data-error="لطفا تاریخ شروع خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb full-date-picker">
                                <label for="expireDate">تاریخ انقضا </label>
                                <input name="expireDate" type="text" class="form-control datePicker" id="expireDate" required data-error="لطفا تاریخ انقضا خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 center-block">
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img name="image_tmp" class="width image-crop img-cropper" src="" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage-edit" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage-edit" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <input class="result-crop" type="hidden" name="imageCropped" value="">
                                        <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>ویرایش تصویر</span>
                                        </span> </label>
                                </div>
                                <!-- Show the cropped image in modal -->
                                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                            </div>
                                            <div class="modal-body"></div>
                                            <div class="modal-footer noPadding pt">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <input name="Advertise_id" id="Advertise_id" type="hidden">
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="add" class="btn btn-success btn-sm">ذخیره ویرایش اطلاعات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $body = $('body'),
            modal_edit = $('#myModal1'),
            modal_add = $('#myModal2');

        $("#addAdvertise").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[0];
            var formData = new FormData(form);
            var $this = $(this);

            $('.errorHandler').text('');

            $.checkBar($this).then(function() {
                $.httpRequest('/member/companyAdvertise/add/', 'post', formData)
                    .then(function (data) {
                        var response = $.parseJSON(data);
                        if (response.result == -1) {
                            $.iziToastError(response.msg, '.iziAdd-container');
                            return;
                        }
                        if (response.fields.result == -1) {
                            $.iziToastError(response.fields.msg, '.iziAdd-container');
                            return;
                        } else {
                            var advertise_id = response.fields.Advertise_id,
                                date = response.fields.date,
                                title = response.fields.title,
                                description = response.fields.description,
                                image = response.fields.img,
                                image_name = response.fields.image,
                                defaltLogo = response.fields.defaltLogo,
                                html =
                                    '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-honour a" data-value="' + advertise_id + '">' +
                                    '<div data-intro="لیست آگهی ها" class="contentPro disable whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">' +
                                    '<h3>' +
                                    '<div class="kebabMenu">' +
                                    '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                                    '<ul class="kebab-menu-content roundCorner boxBorder">' +
                                    '<li><a class="link-edit" data-value="' + advertise_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                                    '<li><a class="link-trash" data-value="' + advertise_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '<div class="logo">' +
                                    '<img name="image_ajax" class="boxBorder lazy" src="' + (image_name != null ? image : defaltLogo) + '"' + ' alt="">' +
                                    '</div>' +
                                    '<span class="title">' + title + '</span>' +
                                    '<span class="i-date"><i class="fa fa-calendar"></i>' + date + '</span>' +
                                    '</h3>' +
                                    '<div class="text">' +
                                    '<p>' + description + '</p>' +
                                    '<span class="submit-msg">&#10006; تایید نشده</span>' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                            $('.add-advertise').append(html);
                            $('.notRecord').remove();
                            emptyFields($('#addAdvertise'));
                            modal_add.modal('hide');
                            $.iziToastSuccess(response.msg, '.content .izi-container');
                        }
                    });
            });
        });

        $('.i-add').on('click', function (e) {
            emptyFields($('#addAdvertise'));
            $('.more-employment').removeClass('active');
            modal_add.find('select').empty();
            e.preventDefault();
            $('.errorHandler').text('');
        });

        $("#editAdvertise").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[1];
            var formData = new FormData(form);
            var $this = $(this);

            $('.errorHandler').text('');

            $.checkBar($this).then(function() {
                $.httpRequest('/member/companyAdvertise/edit/', 'post', formData)
                    .then(function (data) {
                        var response = $.parseJSON(data);
                        if (response.fields.result == -1) {
                            $.iziToastError(response.fields.msg, '.iziEdit-container');
                        } else {
                            var advertise_id = response.fields.Advertise_id,
                                advertise_id_old = response.fields.Advertise_id_old,
                                date = response.fields.date,
                                title = response.fields.title,
                                image = response.fields.img,
                                image_name = response.fields.image,
                                description = response.fields.description,
                                defaltLogo = response.fields.defaltLogo;

                            $(".remove-honour").each(function () {
                                if ($(this).data('value') == advertise_id_old) {
                                    $(this).data('value', advertise_id);
                                    $(this).find('.link-trash').data('value', advertise_id);
                                    $(this).find('.link-edit').data('value', advertise_id);
                                    $(this).find('div.contentPro').addClass('disable');
                                    $(this).find('.title').text(title);
                                    $(this).find('.text').find('p').text(description);
                                    $(this).find('.i-date').text(date);
                                    $(this).find('.submit-msg').html('<span>&#10006;</span> <span>تایید نشده</span>');
                                    image_name ? $(this).find('img').attr('src', image) : $(this).find('img').attr('src', defaltLogo)
                                }
                            });
                            modal_edit.modal('hide');

                            $.iziToastSuccess(response.msg, '.content .izi-container');
                        }
                    });
            });
        });


        $body.on('click', '.link-edit', function (e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            editItem(dataID, $this);
        });

        function editItem(dataID) {
            //emptyFields($('#editAdvertise'));

            $.post('/member/companyAdvertise/editAjax/', {id: dataID}, function (data) {
                var result = $.parseJSON(data);
                var fields = result.fields;
                $.each(fields, function (key, value) {
                    if (key == 'image_tmp') {
                        modal_edit.find('[name="' + key + '"]').attr('src', value);
                    } else {
                        modal_edit.find('[name="' + key + '"]').val(value);
                    }
                });
                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function () {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });
                modal_edit.modal({
                    show: true,
                    backdrop: 'static'
                });
            });
        }

        $body.on('click', '.link-trash', function (e) {
            e.preventDefault();
            var dataID = $(this).data('value'),
                lastItem = $body.find('.remove-honour').length;

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
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function (instance, toast) {

                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        deleteItem(dataID)

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ]
            });
        });

        function deleteItem(dataID) {
            var postData = {id: dataID};
            $.httpRequest('/member/companyAdvertise/delete/', 'post', postData, false)
                .then(function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        var advertise_id = response.fields.Advertise_id;
                        var i = 0;
                        $(".remove-honour").each(function () {
                            i++;
                            if ($(this).data('value') == advertise_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.content .izi-container');
                            }
                        });
                        if (i == 1) {
                            var image = "<?php echo RELA_DIR; ?>" + "templates/template_fa/assets/images/empty01.png";
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-advertise').append(html);
                        }
                    }
                });
        }
        function emptyFields($this) {
            var defaultImage="<?php echo DEFULT_LOGO_ADDRESS ?>";
                $this.find('input, textarea').each(function () {
                    $(this).val("");
                });
            $this.find('img').each(function () {
                $(this).attr("src", defaultImage);
            });
            $this.find('select').empty();
        }
    });
</script>
