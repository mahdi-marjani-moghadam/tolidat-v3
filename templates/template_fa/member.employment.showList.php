<link rel="stylesheet"
      href="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/css/persianDatepicker-default.min.css">
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/persianDatepicker.min.js"></script>
<script src="<?php echo RELA_DIR . 'templates/' . CURRENT_SKIN; ?>/assets/js/simple.money.format.js"></script>

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
            <span data-intro=" در این قسمت هرگونه فرصت شغلی اعم از فرصت شغلی تولید و ... را درج نمایید."
                  class="title-pro">فرصت های شغلی</span> <span class="betaVersion">(نسخه آزمایشی)</span>
            <button data-intro="اضافه کردن فرصت شغلی" type="button" class="i-add btn btn-sm pull-left add-btnPro"
                    data-toggle="modal" data-target="#myModal2">
                <i class="fa fa-plus transition bc-color-yellow2" aria-hidden="true"></i>
                <span class="transition">افزودن فرصت شغلی </span>
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-employment">
    <?php if (isset($list['list']) && count($list['list'])): ?>
        <?php foreach ($list['list'] as $id => $fields): ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-employment"
                 data-value="<?= $fields['Employment_id'] ?>">
                <div data-intro="اضافه کردن فرصت شغلی" class="contentPro<?php echo ($fields['status'] == 2) ? '' : ' disable' ?> whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content roundCorner boxBorder">
                                <li><a class="link-edit" data-value="<?= $fields['Employment_id'] ?>"><i
                                                class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                </li>
                                <li><a class="link-trash" data-value="<?= $fields['Employment_id'] ?>"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>
                            </ul>
                        </div>
                        <span class="title"><?php echo $fields['title'] ?></span>
                        <span class="i-date"><i class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p><?php echo $fields['description'] ?> </p>
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
<div class="holder-modal modal-honour modal-employment modal fade container-floatinglabel" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">درج فرصت شغلی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziAdd-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addEmployment" class="form employment" enctype="multipart/form-data" method="post" data-toggle="validator" novalidate="novalidate">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title">عنوان</label>
                                <input name="title" type="text" class="form-control" tabindex="1" id="title" required data-error="لطفا نام عنوان خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="description">توضیحات</label>
                                <textarea name="description" class="form-control" id="description" tabindex="2" data-error="لطفا توضیحات را وارد نمایید" required></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb full-date-picker">
                                <label for="startDate">تاریخ شروع</label>
                                <input name="startDate" type="text" class="form-control datePicker set-font-latin" tabindex="3" id="startDate" required data-error="لطفا تاریخ شروع خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb full-date-picker">
                                <label for="expireDate">تاریخ انقضا </label>
                                <input name="expireDate" type="text" class="form-control datePicker set-font-latin" tabindex="4" id="expireDate" required data-error="لطفا تاریخ انقضا خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 col-sm-4 col-md-4 pull-right">
                            <div class="form-group mb">
                                <label for="contactPhone">شماره تماس</label>
                                <input name="contactPhone" type="text" class="form-control" pattern="^[0-9]{3,}$" tabindex="5" maxlength="11" id="contactPhone" required data-error="لطفا شماره تماس خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 pull-right">
                            <div class="form-group has-error">
                                <label for="code">کد شهر</label>
                                <input name="code" id="code" type="text" class="form-control set-font-latin" tabindex="6" maxlength="3" max="999" pattern="^[0-9]{3,3}$" data-error="۳ رقم وارد شود" required autocomplete="off">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb">
                                <label for="contactEmail">ایمیل</label>
                                <input name="contactEmail" type="email" class="form-control text-left ltr" tabindex="7" id="contactEmail" required data-error="لطفا ایمیل خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right information-more">
                            <label for="checkbox">اطلاعات بیشتر
                                <input type="checkbox" name="checkbox" id="checkbox" tabindex="7" class="information-checkbox">
                            </label>
                        </div>
                    </div>
                    <div class="more-employment">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb has-feedback center-block">
                                    <select name="graduate_id" class="graduate_id form-control" tabindex="8"></select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb">
                                    <label for="history">سابقه</label>
                                    <input name="history" type="text" tabindex="9" class="form-control" id="history"
                                           data-error="لطفا سابقه خود را وارد نمایید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                                <div class="form-group mb">
                                    <label for="minSallary">حداقل حقوق</label>
                                    <input name="minSallary" type="text" tabindex="10" class="form-control money" id="minSallary"
                                           data-error="لطفا حداقل حقوق خود را وارد نمایید" pattern="^[0-9]{3,}$">
                                    <span class="currency-span">تومان</span>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb">
                                    <label for="maxSallary"> حداکثر حقوق</label>
                                    <input name="maxSallary" type="text" tabindex="11" class="form-control money" id="maxSallary"
                                           data-error="لطفا حداکثر حقوق خود را وارد نمایید" pattern="^[0-9]{3,}$">
                                    <span class="currency-span">تومان</span>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                                <div class="form-group mb">
                                    <input name="skill"
                                           type="text"
                                           data-error="لطفا مهارت خود را وارد نمایید"
                                           placeholder="مهارت خود را وارد نمایید. (بعد از هر کلمه دکمه Enter را بزنید.)"
                                           data-role="tagsinput"
                                           tabindex="8"
                                           id="skill">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
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
<div class="holder-modal modal-honour modal-employment modal fade container-floatinglabel" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش فرصت شغلی</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editEmployment" class="form employment" enctype="multipart/form-data" method="post" data-toggle="validator" novalidate="novalidate">
                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title">عنوان</label>
                                <input data-minWord="6" name="title" type="text" class="form-control progressText" id="title" required tabindex="1"
                                       data-error="لطفا نام عنوان خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb">
                                <label for="description">توضیحات</label>
                                <textarea data-minWord="6" name="description" class="form-control progressText" tabindex="2"
                                          id="description"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb full-date-picker">
                                <label for="startDate">تاریخ شروع</label>
                                <input name="startDate" type="text"
                                       class="form-control datePicker set-font-latin" id="startDate" required
                                       tabindex="3"
                                       data-error="لطفا تاریخ شروع خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb full-date-picker">
                                <label for="expireDate">تاریخ انقضا </label>
                                <input name="expireDate" type="text"
                                       tabindex="4"
                                       class="form-control datePicker set-font-latin" id="expireDate" required
                                       data-error="لطفا تاریخ انقضا خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 col-sm-4 col-md-4 pull-right">
                            <div class="form-group mb">
                                <label for="contactPhone">شماره تماس</label>
                                <input name="contactPhone" type="text" pattern="^[0-9]{3,}$" maxlength="8" class="form-control" id="contactPhone"
                                       required
                                       tabindex="5"
                                       data-error="لطفا شماره تماس خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-4 col-sm-2 col-md-2 pull-right">
                            <div class="form-group has-error">
                                <label for="code">کد شهر</label>
                                <input name="code" id="code" type="text" class="form-control set-font-latin" tabindex="6" maxlength="3" max="999" pattern="^[0-9]{3,3}$" data-error="۳ رقم وارد شود" required="" autocomplete="off">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="form-group mb">
                                <label for="contactEmail">ایمیل</label>
                                <input name="contactEmail" type="email" class="form-control text-left ltr"
                                       id="contactEmail"
                                       tabindex="6"
                                       required
                                       data-error="لطفا ایمیل خود را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>
                        </div>
                    </div>
                    <input name="Employment_id" type="hidden">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right mb information-more">
                            <!--<a id="moreInformation" class="btn btn-success btn-sm">اطلاعات بیشتر</a>-->
                            <label for="checkbox1">اطلاعات بیشتر
                                <input type="checkbox" name="checkbox" id="checkbox1" tabindex="6" class="information-checkbox">
                            </label>
                        </div>
                    </div>
                    <div class="more-employment more-employment-edit">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb has-feedback center-block">
                                    <select name="graduate_id" class="graduate_id form-control" tabindex="7"></select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb">
                                    <label for="history">سابقه</label>
                                    <input name="history" type="text" class="form-control" tabindex="9" id="history"
                                           data-error="لطفا سابقه خود را وارد نمایید">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                                <div class="form-group mb">
                                    <label for="minSallary">حداقل حقوق</label>
                                    <input name="minSallary" type="text" class="form-control money" tabindex="10" id="minSallary"
                                           data-error="لطفا حداقل حقوق خود را وارد نمایید" pattern="^[0-9]{3,}$">
                                    <span class="currency-span">تومان</span>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                                <div class="form-group mb">
                                    <label for="maxSallary"> حداکثر حقوق</label>
                                    <input name="maxSallary" type="text" class="form-control money" tabindex="11" id="maxSallary"
                                           data-error="لطفا حداکثر حقوق خود را وارد نمایید" pattern="^[0-9]{3,}$">
                                    <span class="currency-span">تومان</span>
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                                <div class="form-group mb">
                                    <input name="skill"
                                           type="text"
                                           tabindex="8"
                                           id="skill"
                                           data-error="لطفا مهارت خود را وارد نمایید"
                                           placeholder="مهارت خود را وارد نمایید. (بعد از هر کلمه دکمه Enter را بزنید.)"
                                           data-role="tagsinput">
                                </div>

                                <!-- separator -->
                                <div class="row xxsmallSpace"></div>

                                <input type="hidden" name="more_info" id="more_info" value="">
                            </div>
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

<script>
    $(function () {
        var $body = $('body'),
            modal_edit = $('#myModal1'),
            modal_add = $('#myModal2');


        $("#addEmployment").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[0];
            var $this = $(this);
            var formData = new FormData(form);

            $('.errorHandler').text('');
            $.checkBar($this).then(function() {
                $.httpRequest('/member/employment/add/', 'post', formData)
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
                            var employment_id = response.fields.Employment_id,
                                date = response.fields.date,
                                title = response.fields.title,
                                description = response.fields.description,
                                html = '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-employment" data-value="'+employment_id+'">' +
                                    '<div data-intro="اضافه کردن فرصت شغلی" class="contentPro disable whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">' +
                                    '<h3>' +
                                    '<div class="kebabMenu">' +
                                    '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                                    '<ul class="kebab-menu-content roundCorner boxBorder">' +
                                    '<li>' +
                                    '<a class="link-edit" data-value="'+employment_id+'">' +
                                    '<i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span>' +
                                    '</a>' +
                                    '</li>' +
                                    '<li>' +
                                    '<a class="link-trash" data-value="'+employment_id+'">' +
                                    '<i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>' +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '<span class="title">'+title+'</span>' +
                                    '<span class="i-date"><i class="fa fa-calendar"></i>'+date+'</span>' +
                                    '</h3>' +
                                    '<div class="text">' +
                                    '<p>'+description+'</p>' +
                                    '<span class="submit-msg">&#10006; تایید نشده</span>' +

                                    '</div>' +
                                    '</div>' +
                                    '</div>';

                            $('.add-employment').append(html);
                            $('.notRecord').remove();
                            emptyFields($('#addEmployment'));
                            modal_add.modal('hide');
                            $.iziToastSuccess(response.msg, '.content .izi-container');
                        }

                });
            });

        });

        $('.i-add').on('click', function (e) {
            emptyFields($('#addEmployment'));
            $('.more-employment').removeClass('active');
            modal_add.find('select').empty();
            e.preventDefault();
            $('.errorHandler').text('');
            addItem();

            addInformationMore();
        });

        function addInformationMore() {
            var $moreEmployment = $('.more-employment');
            $moreEmployment.find('input,select').prop('disabled', true);
        }

        function addItem() {
            $.post('/member/employment/addAjax/', function (data) {
                var result = $.parseJSON(data);
                $('.graduate_id').append('<option value="">نوع تحصیلات خود را انتخاب نمایید...</option>');
                $.each(result.graduate, function (key, value) {
                    $('.graduate_id').append($('<option>', {
                        value: value.Graduate_id,
                        text: value.name
                    }));
                });
                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function () {
                    if ($(this).val().length !== 0) {
                        $(this).parent().addClass('typing');
                    }
                });
                modal_add.modal('show');
            });
        }

        $("#editEmployment").on("submit", function (e) {
            e.preventDefault();
            var form = $('.form')[1];
            var $this = $(this);
            var formData = new FormData(form);

            $('.errorHandler').text('');
            $.checkBar($this).then(function() {
                $.httpRequest('/member/employment/edit/', 'post', formData)
                    .then(function (data) {
                        var response = $.parseJSON(data);
                        console.log(response);
                        if (response.fields.result == -1) {
                            $.iziToastError(response.fields.msg, '.iziEdit-container');
                            return;
                        } else {
                            var employment_id = response.fields.Employment_id,
                                employment_id_old = response.fields.Employment_id_old,
                                date = response.fields.date,
                                title = response.fields.title,
                                description = response.fields.description;
                            $(".remove-employment").each(function () {
                                if ($(this).data('value') == employment_id_old) {
                                    $(this).data('value', employment_id);
                                    $(this).find('.link-trash').data('value', employment_id);
                                    $(this).find('.link-edit').data('value', employment_id);
                                    $(this).find('div.contentPro').addClass('disable');
                                    $(this).find('.title').text(title);
                                    $(this).find('.text').find('p').text(description);
                                    $(this).find('.i-date').text(date);
                                    $(this).find('.submit-msg').html('<span>&#10006;</span> <span>تایید نشده</span>');
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
            emptyFields($('#editEmployment'));
            $.post('/member/employment/editAjax/', {id: dataID}, function (data) {
                var result = $.parseJSON(data),
                    fields = result.fields,
                    $moreEmployment = $('.more-employment');
                $.each(fields, function (key, value) {
                    if (key == 'image_tmp') {
                        modal_edit.find('[name="' + key + '"]').attr('src', value);
                    } else {
                        console.log(fields);
                        modal_edit.find('[name="' + key + '"]').val(value);
                    }
                });

                console.log(result);

                if (fields.more_info == 1) {
                    $('.information-more .information-checkbox').prop('checked',true);
                    $moreEmployment.find('input,select').prop('disabled', false);
                } else {
                    $('.information-more .information-checkbox').prop('checked', false);
                    $moreEmployment.find('input,select').prop('disabled', true);
                }

                $('.graduate_id').append('<option value="">نوع تحصیلات خود را انتخاب نمایید...</option>');
                $.each(fields.graduate, function (key, value) {
                    $('.graduate_id').append($('<option>', {
                        value: value.Graduate_id,
                        text: value.name
                    }));
                });
                $('.graduate_id').find('option[value="' + fields.graduate_id + '"]').attr('selected', 'selected');

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function () {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                $('.money').simpleMoneyFormat();
                modal_edit.modal('show');
            });
        }

        $body.on('click', '.link-trash', function (e) {
            e.preventDefault();

            var dataID = $(this).data('value'),
                lastItem = $body.find('.remove-employment').length;

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
            $.httpRequest('/member/employment/delete/', 'post', postData, false)
                .then(function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        var employment_id = response.fields.Employment_id;
                        var i = 0;
                        $(".remove-employment").each(function () {
                            i++;
                            if ($(this).data('value') == employment_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.content .izi-container');
                            }
                        });
                        if (i == 1) {
                            var image = "<?php echo RELA_DIR; ?>" + "templates/template_fa/assets/images/empty01.png";
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-employment').append(html);
                        }
                    }
                });
        }

        function emptyFields($this) {
            $this.find('input, textarea').each(function () {
                $(this).val("");
            });
            $this.find('img').each(function () {
                $(this).attr("src", '<?php echo RELA_DIR . "templates/template_fa/assets/images/placeholder.png" ?>');
            });
            $this.find('select').empty();
        }

        $(".employment").keypress(function (e) {
            if (e.which == 13) {
                var tagName = e.target.tagName.toLowerCase();
                if (tagName !== "textarea") {
                    return false;
                }
            }
        });

        $('.information-more .information-checkbox').on('change', function() {
            var $moreEmployment = $('.more-employment');

            if ($(this).is(':checked')) {
                $moreEmployment.find('input,select').prop('disabled', false);
            } else {
                $moreEmployment.find('input,select').prop('disabled', true);
            }
        });

        $('.money').simpleMoneyFormat();
    });
</script>