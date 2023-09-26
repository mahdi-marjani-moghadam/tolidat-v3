<link rel="stylesheet" href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>

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
            <span data-intro=" در این قسمت هرگونه مجوز اعم از مجوز تولید و ... را درج نمایید." class="title-pro">ثبت مجوز ها</span>
            <button data-intro="اضافه کردن مجوزها" type="button" class="i-add btn btn-sm pull-left add-btnPro" data-toggle="modal" data-target="">
                <i class="fa fa-plus transition bc-color-yellow" aria-hidden="true"></i>
                <span class="transition">افزودن مجوزها</span>
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-licence">
    <?php if (isset($list['list']) && count($list['list'])) : ?>
        <?php foreach ($list['list'] as $id => $fields) : ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-licence" data-value="<?php echo  $fields['Licence_id'] ?>">
                <div data-intro="اضافه کردن مجوزها" class="contentPro<?php echo ($fields['status'] == 2) ? '' : ' disable' ?> whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content roundCorner boxBorder">
                                <li>
                                    <a class="link-edit" data-value="<?php echo  $fields['Licence_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                </li>
                                <li>
                                    <a class="link-trash" data-value="<?php echo  $fields['Licence_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo">
                            <img name="image_ajax" class="boxBorder lazy" data-src="<?php echo $fields['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/licence/" . $fields['image'] : DEFULT_PRODUCT_ADDRESS ?>" alt="">
                        </div>
                        <span class="title">
                            <?php foreach ($list['licence_list'] as $id => $licence_list) : ?>
                                <?php if ($licence_list['Licence_list_id'] == $fields['licence_type']) {
                                    echo $licence_list['name'];
                                } ?>
                            <?php endforeach; ?>
                        </span>
                        <span class="i-date"><i class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p><?php echo $fields['description'] ?></p>
                        <span class="submit-msg"><?php echo ($fields['status'] == 2) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="notRecord">
            <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_fa/assets/images/empty01.png">
            <p class="empty-text">اطلاعاتی موجود نیست!</p>
        </div>
    <?php endif; ?>
</div>

<!--Modal add-->
<div class="holder-modal modal-honour modal-licence modal fade container-floatinglabel" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن مجوزها</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAdd-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addLicence" class="form" enctype="multipart/form-data" method="post" data-toggle="validator" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="name">نام صاحب جواز</label>
                                <input name="name" type="text" class="form-control" id="name" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="national_code">کدملی صاحب جواز</label>
                                <input name="national_code" type="text" class="form-control set-font-latin" id="national_code" required data-error="لطفا نام تجاری خود را وارد نمایید" maxlength="10">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <select name="licence_type" id="licence_type" class="form-control"></select>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb">
                                <label for="family">نام خانوادگی صاحب جواز</label>
                                <input name="family" type="text" class="form-control" id="family" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="licence_number">شماره جواز</label>
                                <input name="licence_number" type="text" class="form-control set-font-latin" id="licence_number" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb" id="div-licence_type">
                                <label for="licence_type_name">نوع جواز</label>
                                <input name="licence_type_name" type="text" class="form-control" id="licence_type_name" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb full-date-picker">
                                <label for="expiration_date">تاریخ انقضا جواز</label>
                                <input name="expiration_date" type="text" class="form-control datePicker set-font-latin" id="expiration_date" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb full-date-picker">
                                <label for="issuence_date">تاریخ صدور جواز</label>
                                <input name="issuence_date" type="text" class="form-control datePicker set-font-latin" id="issuence_date" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="exporter_refrence">مرجع تایید جواز</label>
                                <input name="exporter_refrence" type="text" class="form-control" id="exporter_refrence" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description" class="form-control" rows="3" id="description" required data-error="لطفا زمینه فعالیت خود را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 center-block">
                            <div class="reg-alert-r text-center">تصویر مجوز خود را انتخاب نمایید</div>
                            <div class="row xxxsmallSpace"></div>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img class="width image-crop img-cropper" src="<?php echo (isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                                </div>
                                <label class="btn btn-success btn-block uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                    <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                    <input class="result-crop" type="hidden" name="imageCropped" value="">
                                    <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                        <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>انتخاب تصویر</span>
                                    </span> </label>
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
<div class="holder-modal modal-honour modal-licence modal fade container-floatinglabel" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش مجوزها</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editLicence" class="form" enctype="multipart/form-data" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="name">نام صاحب جواز</label>
                                <input name="name" type="text" class="form-control" id="name" required data-error="لطفا نام تجاری خود را وارد نمایید">
                                <input name="Licence_id" type="hidden">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="national_code">کدملی صاحب جواز</label>
                                <input name="national_code" type="text" class="form-control set-font-latin" id="national_code" required data-error="لطفا نام تجاری خود را وارد نمایید" maxlength="10">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <select name="licence_type" id="licence_type_edit" class="form-control"></select>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb">
                                <label for="family">نام خانوادگی صاحب جواز</label>
                                <input name="family" type="text" class="form-control" id="family" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="licence_number">شماره جواز</label>
                                <input name="licence_number" type="text" class="form-control set-font-latin" id="licence_number" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb" id="licence-type-edit">
                                <label for="licence_type_name">نوع جواز</label>
                                <input name="licence_type_name" type="text" class="form-control" id="licence_type_name" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb full-date-picker">
                                <label for="expiration_date">تاریخ انقضا جواز</label>
                                <input name="expiration_date" type="text" class="datePicker form-control set-font-latin" id="expiration_date" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb full-date-picker">
                                <label for="issuence_date">تاریخ صدور جواز</label>
                                <input name="issuence_date" type="text" class=" datePicker form-control set-font-latin" id="issuence_date" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="exporter_refrence">مرجع تایید جواز</label>
                                <input name="exporter_refrence" type="text" class="form-control" id="exporter_refrence" required data-error="لطفا نام تجاری خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb">
                                <label for="description">زمینه فعالیت</label>
                                <textarea name="description" class="form-control" rows="3" id="description" required data-error="لطفا زمینه فعالیت خود را وارد نمایید"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 center-block">
                            <div class="reg-alert-r text-center">تصویر مجوز خود را انتخاب نمایید</div>
                            <div class="row xxxsmallSpace"></div>
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

                            <div class="row xxxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="edit" class="btn btn-success btn-sm">ذخیره تغییرات</button>
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
    $(function() {
        var $body = $('body'),
            modal_edit = $('#myModal1'),
            modal_add = $('#myModal2');

        $("#addLicence").on("submit", function(e) {
            e.preventDefault();
            var form = $('.form')[0];
            var formData = new FormData(form);

            $('.errorHandler').text('');
            $.httpRequest('/member/licence/add/', 'post', formData)
                .then(function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.iziAdd-container');
                        return;
                    }
                    if (response.fields.result == -1) {
                        $.iziToastError(response.fields.msg, '.iziAdd-container');
                        return;
                    } else {
                        var licence_id = response.fields.Licence_id,
                            date = response.fields.date,
                            title = response.fields.licence_type_name,
                            image = response.fields.img,
                            image_name = response.fields.image,
                            defaltLogo = response.fields.defaltLogo,
                            description = response.fields.description,
                            html = '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-licence" data-value="' + licence_id + '">' +
                            '<div class="contentPro disable whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">' +
                            '<h3>' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit" data-value="' + licence_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash" data-value="' + licence_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<div class="logo"><img name="image_ajax" class="boxBorder" src="' + (image_name != null ? image : defaltLogo) + '"' + ' alt=""></div>' +
                            '<span class="title">' + title + '</span>' +
                            '<span class="i-date"><i class="fa fa-calendar"></i>' + date + '</span>' +
                            '</h3>' +
                            '<div class="text">' +
                            '<p>' + description + '</p>' +
                            '<span class="submit-msg">&#10006; تایید نشده</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $('.add-licence').append(html);
                        $('.notRecord').remove();
                        emptyFields($('#addLicence'));
                        modal_add.modal('hide');
                        $.iziToastSuccess(response.msg, '.izi-container');
                    }
                });
        });

        $('.i-add').on('click', function(e) {
            modal_add.find('select').empty();
            e.preventDefault();
            $('.errorHandler').text('');
            addItem();
        });

        function addItem() {
            $.post('/member/licence/addAjax/', function(data) {
                var result = $.parseJSON(data);
                $('#licence_type').append('<option value="">نوع جواز را انتخاب نمایید...</option>');
                $.each(result.licence_list, function(key, value) {
                    $('#licence_type').append($('<option>', {
                        value: value.Licence_list_id,
                        text: value.name
                    }));
                });
                $('#licence_type').append('<option value="0">غیره...</option>');

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function() {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                modal_add.modal('show');
            });
        }

        $("#editLicence").on("submit", function(e) {
            e.preventDefault();
            var form = $('.form')[1];
            var formData = new FormData(form);

            $('.errorHandler').text('');
            $.httpRequest('/member/licence/edit/', 'post', formData)
                .then(function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.iziEdit-container');
                        return;
                    }
                    if (response.fields.result == -1) {
                        $.iziToastError(response.fields.msg, '.iziEdit-container');
                        return;
                    } else {
                        var licence_id = response.fields.Licence_id,
                            licence_id_old = response.fields.Licence_id_old,
                            date = response.fields.date,
                            title = response.fields.licence_type_name,
                            image = response.fields.img,
                            image_name = response.fields.image,
                            defaltLogo = response.fields.defaltLogo,
                            description = response.fields.description;

                        $(".remove-licence").each(function() {
                            if ($(this).data('value') == licence_id_old) {
                                $(this).data('value', licence_id);
                                $(this).find('.link-trash').data('value', licence_id);
                                $(this).find('.link-edit').data('value', licence_id);
                                $(this).find('div.contentPro').addClass('disable');
                                $(this).find('.title').text(title);
                                $(this).find('.text').find('p').text(description);
                                $(this).find('.i-date').text(date);
                                $(this).find('.submit-msg').html('<span>&#10006;</span> <span>تایید نشده</span>');
                                image_name != '' ?
                                    $(this).find('[name="image_ajax"]').attr('src', image) :
                                    $(this).find('[name="image_ajax"]').attr('src', defaltLogo);
                            }
                        });
                        modal_edit.modal('hide');
                        $.iziToastSuccess(response.msg, '.izi-container');
                    }
                });
        });

        $body.on('click', '.link-edit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            editItem(dataID, $this);
        });

        $body.on('click', '.link-edit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            editItem(dataID, $this);
        });

        function editItem(dataID) {
            emptyFields($('#editLicence'));
            $.post('/member/licence/editAjax/', {
                id: dataID
            }, function(data) {
                var result = $.parseJSON(data);
                var fields = result.fields;
                $.each(fields, function(key, value) {
                    if (key == 'image_tmp') {
                        modal_edit.find('[name="' + key + '"]').attr('src', value);
                    } else {
                        modal_edit.find('[name="' + key + '"]').val(value);
                    }
                });
                $('#licence_type_edit').append('<option value="">نوع جواز را انتخاب نمایید...</option>');
                $.each(fields.licence_list, function(key, value) {
                    $('#licence_type_edit')
                        .append('<option value="' + value.Licence_list_id + '"' + (fields.licence_type == value.Licence_list_id ? 'selected' : '') + '>' + value.name + '</option>');
                });
                $('#licence_type_edit').append('<option value="0">غیره...</option>');
                $('#licence-type-edit').hide();
                if (fields.licence_type == 0) {
                    $('#licence_type_edit').find('option[value = "0"]').attr('selected', 'selected');
                    $('#licence-type-edit').show();
                }

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function() {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                modal_edit.modal('show');
            });
        }

        $body.on('click', '.link-trash', function(e) {
            e.preventDefault();
            var dataID = $(this).data('value'),
                lastItem = $body.find('.remove-licence').length;

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
                        deleteItem(dataID)

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                    }]
                ]
            });
        });

        function deleteItem(dataID) {
            var postData = {
                id: dataID
            };
            $.httpRequest('/member/licence/delete/', 'post', postData, false)
                .then(function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.izi-container');
                    }
                    if (response.result == 1) {
                        var licence_id = response.fields.Licence_id;
                        var i = 0;
                        $(".remove-licence").each(function() {
                            i++;
                            if ($(this).data('value') == licence_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var image = "<?php echo RELA_DIR; ?>" + "templates/template_fa/assets/images/empty01.png";
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-licence').append(html);
                        }
                    }
                });
        }

        function emptyFields($this) {
            $this.find('input, textarea').each(function() {
                $(this).val("");
            });
            $this.find('img').each(function() {
                $(this).attr("src", '<?php echo RELA_DIR . "templates/template_fa/assets/images/placeholder.png" ?>');
            });
            $this.find('select').empty();
        }


        $('body #div-licence_type').hide();
        $('body #licence-type-edit').hide();

        $('#licence_type').on('change', function() {
            if ($(this).val() == 0) {
                $('#div-licence_type').show();
            } else {
                $('#div-licence_type').hide();
            }
        });
        $('#licence_type_edit').on('change', function() {
            if ($(this).val() == 0) {
                $('#licence-type-edit').show();
            } else {
                $('#licence-type-edit').hide();
            }
        });
    });
</script>