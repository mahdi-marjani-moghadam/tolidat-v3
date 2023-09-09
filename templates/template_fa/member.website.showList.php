<div class="row smallSpace"></div>
<div class="row">
    <div class="row xsmallSpace"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title bb-color2 center-block">
            <button type="button" class="btn btn-success btn-sm pull-left add-btnPro" data-toggle="modal"
                    data-target="#myModal2"><i class="fa fa-plus" aria-hidden="true"></i>افزودن وب سایت
            </button>
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title roundCorner" id="myModalLabel">افزودن وب سایت</h4>
                            <p id="message"></p>
                        </div>
                        <div class="modal-body">
                            <form id="addWebsite" class="form" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <div class="form-group">
                                            <input name="subject" type="text" class="form-control" id=""
                                                   placeholder="عنوان را وارد نمایید">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="url" class="form-control" rows="3" id=""
                                                      placeholder="آدرس سایت را وارد نمایید"></textarea>
                                        </div>
                                    </div>
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
            <span class="title-pro bg-color2">وب سایت ها</span>
        </div>
        <!--Modal Edit-->
        <div class="holder-title center-block">
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title roundCorner" id="myModalLabel">ویرایش سایت</h4>
                            <p id="message"></p>
                        </div>
                        <div class="modal-body">
                            <form id="editWebsite" class="form" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <div class="form-group">
                                            <input name="subject" type="text" class="form-control" id=""
                                                   placeholder="عنوان را وارد نمایید">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="url" class="form-control" rows="3" id=""
                                                      placeholder="آدرس سایت را وارد نمایید"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer noPadding pt">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" id="edit" class="btn btn-success btn-sm">ذخیره تغییرات
                                    </button>
                                    <input type="hidden" name="Websites_d_id">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Modal Edit-->
        </div>
    </div>
    <div class="row smallSpace"></div>
    <?php if (isset($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields): ?>
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title">عنوان</div>
                    <div class="profile-value"><?php echo $fields['subject'] ?></div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title">آدرس سایت</div>
                    <div class="profile-value"><?php echo $fields['url'] ?></div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title">افزودن آدرس سایت</div>
                    <div class="profile-value">
                        <i class="fa fa-calendar"></i>
                        <?php echo $fields['date'] ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1 col-md-1 pull-right rtl">
                    <a class="link-trash" data-value="<?php echo  $fields['Websites_d_id'] ?>" href=""> <i
                            class="fa fa-trash-o" aria-hidden="true"></i> </a>
                    <a class="link-edit" data-value="<?php echo  $fields['Websites_d_id'] ?>" href=""> <i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                </div>
            </div>
            <div class="row xxsmallSpace"></div>
            <div class="profile-part-line "></div>
            <div class="row xxsmallSpace"></div>
        <?php endforeach; ?>
    <?php endif; ?>
    <script>
        $(function () {
            var modal_edit = $('#myModal1');
            var modal_add = $('#myModal2');

            $("#addWebsite").on("submit", function (e) {
                e.preventDefault();
                var form = $('.form')[0];
                var formData = new FormData(form);


                $.ajax({
                    url: '/member/companyWebsites/add/',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        alert($.parseJSON(data));
                        modal_add.modal('hide');
                        return false;
                    }
                });
            });

            $("#editWebsite").on("submit", function (e) {
                e.preventDefault();
                var form = $('.form')[1];
                var formData = new FormData(form);

                $.ajax({
                    url: '/member/companyWebsites/edit/',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        /*alert(data); return;*/
                        alert($.parseJSON(data));
                        modal_edit.modal('hide');
                        return false;
                    }
                });
            });

            $('.link-edit').bind('click', function (e) {
                e.preventDefault();

                $(this).find('input, textarea').each(function () {
                    $(this).val("");
                });

                var dataID = $(this).data('value');
                $.post('/member/companyWebsites/editAjax/', {id: dataID}, function (data) {
                    var result = $.parseJSON(data);
                    var fields = result.fields;

                    if (result == '-1') {
                        alert('khapid');
                    }
                    $.each(fields, function (key, value) {
                        modal_edit.find('[name="' + key + '"]').val(value);
                    });
                    modal_edit.modal('show');
                });
            });

            $('.link-trash').bind('click', function (e) {
                e.preventDefault();
                var dataID = $(this).data('value');
                $.post('/member/companyWebsites/delete/', {id: dataID}, function (data) {
                    alert($.parseJSON(data));
                    location.reload();
                });
            });
        });
    </script>