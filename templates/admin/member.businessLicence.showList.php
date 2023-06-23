<!--button-->
<div class="row xxsmallSpace"></div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span class="title-pro">پروانه کسب</span>
            <button type="button" class="btn btn-sm pull-left add-btnPro" data-toggle="modal" data-target="#myModal2">
                <i class="fa fa-plus transition bc-color-aqua" aria-hidden="true"></i>
                <span class="transition">افزودن پروانه کسب</span>
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-businessLicence">
    <?php if (isset($list['list']) && count($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields): ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-businessLicence"
                 data-value="<?= $fields['Business_licence_d_id'] ?>">
                <div
                    class="contentPro<?php echo($fields['status'] == 0 ? ' disable' : '') ?> contentPro-businessLicence whiteBg roundCorner"
                    data-toggle="tooltip" data-placement="bottom" title=""
                    data-original-title="<?php echo($fields['status'] == 0 ? 'تایید نشده' : 'تایید شده') ?>">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content roundCorner boxBorder">
                                <li><a class="link-edit" data-value="<?= $fields['Business_licence_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>
                                <li><a class="link-trash" data-value="<?= $fields['Business_licence_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>
                            </ul>
                        </div>
                        <div class="logo">
                            <img name="image_ajax" class="boxBorder"
                                 src="<?php echo COMPANY_ADDRESS . $this->company_info['company_id'] . "/businessLicence/" . $fields['image'] ?>"
                                 alt="">
                        </div>
                        <span class="title"><?php echo $fields['title'] ?></span>
                        <span class="i-date"><i
                                class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p><?php echo $fields['description'] ?> </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="notRecord">
            <div class="row xsmallSpace"></div>
            <div class="alert alert-success text-center" role="alert">رکوردی موجود نمی باشد.</div>
        </div>
    <?php endif; ?>
</div>

<!--Modal add-->
<div class="holder-modal modal-businessLicence modal fade" id="myModal2" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن پروانه کسب</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <form id="addBusinessLicence" class="form" enctype="multipart/form-data" method="post"
                      data-toggle="validator">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <input name="title" type="text" class="form-control" id="" required
                                       data-error="لطفا عنوان را وارد نمایید" placeholder="عنوان را وارد نمایید">
                                <div class="errorHandler"></div>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="3" id="" required
                                          data-error="لطفا توضیحات را وارد نمایید"
                                          placeholder="توضیحات را وارد نمایید"></textarea>
                                <div class="errorHandler"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <a class="logoNew roundCorner">
                                <img id="img" name="image" class="boxBorder roundCorner " src="">
                                <label for="upload">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <input name="image" class="uploadFile" type="file" id="upload">
                                </label>
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
                        <button type="submit" id="add" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal Edit-->
<div class="holder-modal modal-businessLicence modal fade" id="myModal1" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش پروانه کسب</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <form id="editBusinessLicence" class="form" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group">
                                <input name="title" type="text" class="form-control" id=""
                                       placeholder="عنوان را وارد نمایید">
                                <div class="errorHandler"></div>
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" rows="3" id=""
                                          placeholder="توضیحات را وارد نمایید"></textarea>
                                <div class="errorHandler"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <a class="logoNew roundCorner">
                                <img id="image_tmp" name="image_tmp" class="boxBorder roundCorner " src="">
                                <label for="upload1">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    <input name="image_tmp" class="uploadFile" type="file" id="upload1">
                                </label>
                            </a>
                        </div>
                        <input name="Business_licence_d_id" type="hidden">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
                        <button type="submit" id="edit" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--ajax-->
<script>
    $(function () {
        var modal_edit = $('#myModal1');
        var modal_add = $('#myModal2');

        $("#addBusinessLicence").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[0];
            var formData = new FormData(form);
            $('.errorHandler').text('');
            $.ajax({
                url: '/member/businessLicence/add/',
                type: 'post',
                data: formData,
                cash: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var response = $.parseJSON(data);
                    if (response.fields.result == -1) {
                        $.each(response.fields, function (key, value) {
                            if (key == 'title') {
                                if (value[0].length > 0) {
                                    $('input').siblings('.modal-body .errorHandler').text(value[0]);
                                }
                            }
                            if (key == 'description') {
                                if (value[0].length > 0) {
                                    $('textarea').siblings('.modal-body .errorHandler').text(value[0]);
                                }
                            }
                        });
                    } else {
                        var business_licence_d_id = response.fields.Business_licence_d_id,
                            date = response.fields.date,
                            title = response.fields.title,
                            image = response.fields.img,
                            image_name = response.fields.image,
                            defaltLogo = response.fields.defaltLogo,
                            description = response.fields['description'],
                            html = '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-businessLicence" data-value="' + business_licence_d_id + '">' +
                                '<div class="contentPro disable contentPro-honour whiteBg roundCorner" ' + 'data-toggle="tooltip" data-placement="bottom" title="" ' + 'data-original-title="تایید نشده">' +
                                '<h3>' +
                                '<div class="kebabMenu">' +
                                '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                                '<ul class="kebab-menu-content roundCorner boxBorder">' +
                                '<li><a class="link-edit" data-value="' + business_licence_d_id +'"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                                '<li><a class="link-trash" data-value="' + business_licence_d_id +'"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                                '</ul>' +
                                '</div>' +
                                '<div class="logo"><img name="image_ajax" class="boxBorder" src="' + (image_name != "" ? image : defaltLogo) + '"' + ' alt=""></div>"' +
                                '<span class="title">' + title + '</span>' +
                                '<span class="i-date"><i class="fa fa-calendar"></i>' + date + '</span>' +
                                '</h3>' +
                                '<div class="text"><p>' + description + '</p></div>' +
                                '</div>' +
                                '</div>';
                        $('.add-businessLicence').append(html);
                        $('.notRecord').remove();
                        $('#addBusinessLicence').find('input, textarea').each(function () {
                            $(this).val("");
                        });
                        $('#addBusinessLicence').find('img').each(function () {
                            $(this).attr("src", '<?php echo RELA_DIR . "templates/template_fa/assets/images/placeholder.png" ?>');
                        });
                        modal_add.modal('hide');
                    }
                }
            });
        });

        $("#editBusinessLicence").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[1];
            var formData = new FormData(form);

            $('.errorHandler').text('');

            $.ajax({
                url: '/member/businessLicence/edit/',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    var response = $.parseJSON(data);

                    if (response.fields.result == -1) {
                        $.each(response.fields, function (key, value) {
                            if (key == 'title') {
                                if (value[0].length > 0) {
                                    $('input').siblings('.modal-body .errorHandler').text(value[0]);
                                }
                            }
                            if (key == 'description') {
                                if (value[0].length > 0) {
                                    $('textarea').siblings('.modal-body .errorHandler').text(value[0]);
                                }
                            }
                        });
                    } else {
                        var businessLicence_d_id = response.fields.Business_licence_d_id;
                        var title = response.fields.title;
                        var description = response.fields.description;
                        var date = response.fields.date;
                        var image = response.fields.img;
                        var image_name = response.fields.image;
                        var defaltLogo = response.fields.defaltLogo;
                        console.log(image);
                        $(".remove-businessLicence").each(function () {
                            if ($(this).data('value') == businessLicence_d_id) {
                                $(this).find('.title').text(title);
                                $(this).find('.text').text(description);
                                $(this).find('.i-date').text(date);
                                image_name != '' ?
                                    $(this).find('[name="image_ajax"]').attr('src', image) :
                                    $(this).find('[name="image_ajax"]').attr('src', defaltLogo);
                            }
                        });
                        modal_edit.modal('hide');
                    }
                }
            });
        });

        $('.link-edit').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            editItem(dataID, $this);
        });

        $('body').on('click', '.link-edit', function (e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            editItem(dataID, $this);
        });

        function editItem(dataID, $this) {
            $this.find('input, textarea').each(function () {
                $this.val("");
            });
            $this.find('img').each(function () {
                $this.attr("src", "");
            });

            $.post('/member/businessLicence/editAjax/', {id: dataID}, function (data) {
                var result = $.parseJSON(data);
                var fields = result.fields;

                $.each(fields, function (key, value) {
                    if (key == 'image_tmp') {
                        modal_edit.find('[name="' + key + '"]').attr('src', value);
                    } else {
                        modal_edit.find('[name="' + key + '"]').val(value);
                    }
                });
                modal_edit.modal('show');
            });
        }

        $('.link-trash').on('click', function (e) {
            e.preventDefault();
            var dataID = $(this).data('value');
            deleteItem(dataID);
        });

        $('body').on('click', '.link-trash', function (e) {
            e.preventDefault();
            var dataID = $(this).data('value');
            deleteItem(dataID);
        });

        function deleteItem(dataID) {
            $.post('/member/businessLicence/delete/', {id: dataID}, function (data) {
                var response = $.parseJSON(data);
                if (response.result == 1) {
                    var businessLicence_d_id = response.fields.Business_licence_d_id;
                    var i = 0;
                    $(".remove-businessLicence").each(function () {
                        i++;
                        if ($(this).data('value') == businessLicence_d_id) {
                            $(this).remove();
                        }
                    });
                    console.log(i);
                    if (i == 1) {
                        var html = '<div class="notRecord">' +
                            '<div class="row xsmallSpace"></div>' +
                            '<div class="alert alert-success text-center" role="alert">رکوردی موجود نمی باشد.</div>' +
                            '</div>';
                        $('.add-businessLicence').append(html);
                    }
                }
            });
        }
    });
</script>
