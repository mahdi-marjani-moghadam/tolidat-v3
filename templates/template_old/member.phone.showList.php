<div class="row smallSpace"></div>
<div class="row">
    <div class="row xsmallSpace"></div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title bb-color2 center-block">
            <button type="button" class="btn btn-success btn-sm pull-left add-btnPro" data-toggle="modal"
                    data-target="#myModal2"><i class="fa fa-plus" aria-hidden="true"></i>افزودن تلفن
            </button>
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title roundCorner" id="myModalLabel">افزودن تلفن</h4>
                            <p id="message"></p>
                        </div>
                        <div class="modal-body">
                            <form id="addPhone" class="form" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <div class="form-group">
                                            <input name="phone_subject" type="text" class="form-control" id=""
                                                   placeholder="موضوع را وارد نمایید">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="phone_number"
                                                   name="phone_number" value="<?= $list['phone_number'] ?>">
                                            <div class="input-group-addon">+98</div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-8 pull-right">
                                                    <select name="state" class="phone_state">
                                                        <option value="داخلی"
                                                            <?php if ($list['state'] == 'داخلی') echo ' selected'; ?>>داخلی
                                                        </option>
                                                        <option value="الی"
                                                            <?php if ($list['state'] == 'الی') echo ' selected'; ?>>الی
                                                        </option>
                                                        <option value="">
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="phone_value" class="form-control" rows="3" id=""
                                                      placeholder="مقدار را وارد نمایید"></textarea>
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
            <span class="title-pro bg-color2">تلفن ها</span>
        </div>
        <!--Modal Edit-->
        <div class="holder-title center-block">
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title roundCorner" id="myModalLabel">ویرایش تلفن</h4>
                            <p id="message"></p>
                        </div>
                        <div class="modal-body">
                            <form id="editPhone" class="form" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <div class="form-group">
                                            <input name="phone_subject" type="text" class="form-control" id=""
                                                   placeholder="موضوع را وارد نمایید">
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="phone_number"
                                                   name="phone_number" value="<?= $list['phone_number'] ?>">
                                            <div class="input-group-addon">+98</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-8 pull-right">
                                                <select name="phone_state" class="select-phone-state">
                                                    <option
                                                        value="داخلی" <?= ($list['phone_state']) == 1 ? 'selected' : '' ?>>
                                                        داخلی
                                                    </option>
                                                    <option
                                                        value="الی" <?= ($list['phone_state']) == 2 ? 'selected' : '' ?>>
                                                        الی
                                                    </option>
                                                    <option
                                                        value="سایر" <?= ($list['phone_state']) == 3 ? 'selected' : '' ?>>
                                                        سایر
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="phone_value" class="form-control" rows="3" id=""
                                                      placeholder="مقدار را وارد نمایید"></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer noPadding pt">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" id="edit" class="btn btn-success btn-sm">ذخیره تغییرات
                                    </button>
                                    <input type="hidden" name="Phones_d_id">
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
    <? if (isset($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields): ?>
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title">موضوع</div>
                    <div class="profile-value"><?php echo $fields['phone_subject'] ?></div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title"> تلفن</div>
                    <div class="profile-value"><?php echo $fields['phone_number'] ?></div>
                </div>
                <div class="col-xs-12 col-sm-2 col-md-2 pull-right rtl">
                    <div class="profile-title">افزودن تلفن</div>
                    <div class="profile-value">
                        <i class="fa fa-calendar"></i>
                        <?php echo $fields['date'] ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-1 col-md-1 pull-right rtl">
                    <a class="link-trash" data-value="<?= $fields['Phones_d_id'] ?>" href=""> <i
                            class="fa fa-trash-o" aria-hidden="true"></i> </a>
                    <a class="link-edit" data-value="<?= $fields['Phones_d_id'] ?>" href=""> <i
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

            $("#addPhone").on("submit", function (e) {
                e.preventDefault();
                var form = $('.form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: '/member/companyPhones/add/',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        /* alert(data);
                         return;*/
                        alert($.parseJSON(data));
                        modal_add.modal('hide');
                        return false;
                    }
                });
            });

            $("#editPhone").on("submit", function (e) {
                e.preventDefault();
                var form = $('.form')[1];
                var formData = new FormData(form);

                $.ajax({
                    url: '/member/companyPhones/edit/',
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
                $.post('/member/companyPhones/editAjax/', {id: dataID}, function (data) {
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
                $.post('/member/companyPhones/delete/', {id: dataID}, function (data) {
                    alert($.parseJSON(data));
                    location.reload();
                });
            });
        });
    </script>