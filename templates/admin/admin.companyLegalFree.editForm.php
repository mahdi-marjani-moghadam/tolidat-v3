<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>ویرایش کمپانی حقوقی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش کمپانی رایگان حقوقی</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl"
                        data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?php if ($msg != null) {
            ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?php echo  $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal"
                            autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <ul class="noPadding" style="list-style: none">
                                    <li>
                                        <a href="http://www.rrk.ir/News/NewsList.aspx" target="_blank" style="text-decoration: none"><span class=""
                                            <h4>جست وجو در روزنامه رسمی</h4></a></li>
                                    <li><a href="http://www.ilenc.ir/" target="_blank" style="text-decoration: none">
                                            <h4>جست وجو در سایت اسناد رسمی</h4></a></li>
                                    <li>
                                        <a href="https://www.google.com/search?q=<?php echo  $list['companyInfo']['company_name'] ?>  " target="_blank" style="text-decoration: none">
                                            <h4>جست وجو در سایت گوگل</h4></a></li>
                                </ul>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="editor_name">نام نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="editor_name" id="editor_name"
                                                value="<?php echo  $list['editorInfo']['editor_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="editor_family">نام خانوادگی نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="editor_family" id="editor_family"
                                                value="<?php echo  $list['editorInfo']['editor_family'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="editor_phone">شماره تماس نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="editor_phone" id="editor_phone"
                                                value="<?php echo  $list['editorInfo']['editor_phone'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="national_id">شناسه ملی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="national_id" id="national_id" value="<?php echo  $list['companyInfo']['national_id'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="registration_number">شماره ثبت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="registration_number" id="registration_number" value="<?php echo  $list['companyInfo']['registration_number'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="company_name">نام تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                                required value="<?php echo  $list['companyInfo']['company_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="description">فعالیت شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <textarea rows="4" cols="50" class="form-control" name="description" id="description"
                                                required><?php echo  $list['companyInfo']['description'] ?></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="maneger_name">نام مدیر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="maneger_name"
                                                id="maneger_name"
                                                value="<?php echo  $list['companyInfo']['maneger_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="personality_type">نوع شخصیت حقوقی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="personality_type" id="personality_type" data-input="select2">
                                            <option></option>
                                            <?php 
                                            foreach ($list['personalityType'] as $key => $value) {
                                                ?>
                                            <option
                                                <?php echo  $list['companyInfo']['personality_type'] == $value['Personality_type_id'] ? ' selected ' : '' ?>
                                                    value="<?php echo  $value['Personality_type_id'] ?>">
                                                <?php echo  $value['type'] ?>
                                                </option><?php 
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- state -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="city_id">انتخاب استان:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="state_id" id="province_id" data-input="select2">
                                            <option></option>
                                            <?php
                                            foreach ($list['states'] as $province_id => $value) {
                                                ?>

                                            <option
                                                <?php echo  $value['province_id'] == $list['companyInfo']['state_id'] ? 'selected' : '' ?>
                                                    value="<?php echo  $value['province_id'] ?>">
                                                <?php echo  $value['name'] ?>
                                                </option><?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- city -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="city_id">انتخاب شهر:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="city_id" id="city_id" data-input="select2"> //complete with Ajax </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="code">کد استان:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="code" id="code" value="<?php echo  $list['phoneInfo']['code'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="phone">تلفن شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="phone" id="phone" value="<?php echo  $list['phoneInfo']['number'] ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="registration_date">تاریخ تاسیس تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control date" name="registration_date" id="registration_date" value="<?php echo  $list['companyInfo']['registration_date'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="address">آدرس شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <textarea rows="4" cols="50" class="form-control" name="address" id="address"
                                                required><?php echo  $list['addressInfo']['address'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="reference_type">مرجع تایید تلفن :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="reference_type" id="reference_type" data-input="select2">
                                            <option value="1" <?php echo  $list['phoneInfo']['reference_type'] == '1' ? ' selected' : '' ?> >روزنامه رسمی</option>
                                            <option value="2" <?php echo  $list['phoneInfo']['reference_type'] == '2' ? ' selected' : '' ?> >سایت</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="reference_value">توضیحات مرجع تایید تلفن:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="reference_value" id="reference_value" value="<?php echo  $list['phoneInfo']['reference_value'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="email">ایمیل:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="email" class="form-control" name="email"
                                                id="email" value="<?php echo  $list['emailInfo']['email'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="url">وب سایت :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="url"
                                                id="url" value="<?php echo  $list['websiteInfo']['url'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row profile-editForm">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="search-box boxBorder categoryContainer">
                                    <div class="search-box-header edit-primary-form whiteBg">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                        <p>دسته بندی ها</p>
                                    </div>
                                    <div class="mmenuHolder admin-mmenuHolder active">
                                        <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها"
                                                data-title="دسته بندی تولیدی ها"><?php echo  $list['category']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="container-view boxBorder">
                                    <span>دسته های انتخاب شده</span>
                                    <ul class="selected-category"></ul>
                                </div>

                                <input type="hidden" id="maxCanSelected" value="1">
                                <input type="hidden" id="selectedCategories" value="<?php echo  $list['companyInfo']['category_id'] ?>">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group noMargin">
                                    <textarea id="log" name="text" class="form-control"></textarea>
                                </div>
                                <div class="row xxsmallSpace hidden-xs"></div>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#showLog">نمایش لاگها</button>
                            </div>
                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <?php if ($list['newCompany']) { ?>
                                    <div class='form-group'>
                                        <label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='process'>عملیات:</label>
                                        <div class='col-xs-12 col-sm-8 pull-right'>
                                            <select name='process' id='process' data-input='select2'>
                                                <option value='1'>در حال بررسی</option>
                                                <option value='2'>تایید</option>
                                                <option value='3'>رد</option>
                                            </select>
                                        </div>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="edit"/>
                                        <input type="hidden" name="company_type"
                                                value="<?php echo $list['company_type']; ?>">
                                        <input type="hidden" name="company_type" value="1">
                                        <input type="hidden" name="company_id"
                                                value="<?php echo $list['companyInfo']['Company_id']; ?>">

                                        <i class="fa fa-plus"></i> ثبت
                                    </button>
                                    <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="showLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">لیست لاگها</h4>
            </div>
            <div class="modal-body">

                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                        width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام اپراتور</th>
                        <th>اکشن اصلی</th>
                        <th>نحوه ارسال</th>
                        <th>توضیحات</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($list['logInfo'] as $key => $value) { ?>
                        <tr>
                            <td><?php echo  $value['letter_log_id'] ?></td>
                            <td><?php echo  $value['admin_name'] . " " . $value['admin_family'] ?></td>
                            <td><?php echo  $value['letter_type'] ?></td>
                            <td><?php echo  $value['letter_action'] ?></td>
                            <td><?php echo  $value['description'] ?></td>
                            <td><?php echo  convertDate($value['date']) ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    //------> Set Reference_type
    $("#licence_type").on('change', function () {
        if ($(this).val() === '0') {
            $("#licence_box").html(
                "<div class='form-group'>" +
                "<label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='licenceTypeName'>توضیحات جواز:</label>" +
                "<div class='col-xs-12 col-sm-8 pull-right'>" +
                "<input type='text' class='form-control' name='licenceTypeName' id='licenceTypeName' value='' required>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
        } else {
            $("#licence_box").html("");
        }

    });


    //------> Set Reference_type
    // $("#reference_type option").val("<?php echo  $list['phoneInfo']['reference_type'] ?>").attr("selected", true);


    //------>state Change
    $(document).ready(function () {
        var $body = $('body'),
            windowWidth = $(window).width(),
            windowHeight = $(window).height(),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

        //------> Select City & State with Jquery
        var p = document.getElementById("province_id");
        var province = p.options[p.selectedIndex].value;
        var city = '<?php echo $list['companyInfo']['city_id']?>';

        cityAjax(province, city);
        function cityAjax(province_id, city_id) {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=getCityAjax'?>",
                data: {province_id: province_id, city_id: city_id},
                method: 'post',
                success: function (result) {
                    $('#city_id').html(result);
                    $("#city_id").select2();
                },
                error: function (result, status) {
                    console.log('error: ' + status);
                }
            });
        }

        $("#province_id").on("change", function () {
            cityAjax($("#province_id").val(), city);
        });


        if ("<?php echo  isset($list['licenceInfo']['licence_number'])?>") {
            $.addLicence();
        } else {
            $.removeLicence();
        }


        /* ------ Responsive Menu ------*/
        $toggleSideBar.bind('click', function () {
            $sideBar.toggleClass('active');
        });

        // change input date to persian date picker
        $datePicker.each(function () {
            var $this = $(this);
            $this.persianDatepicker({
                months: ["فروردین ماه", "اردیبهشت ماه", "خرداد ماه", "تیر ماه", "مرداد ماه", "شهریور ماه", "مهر ماه", "آبان ماه", "آذر ماه", "دی ماه", "بهمن ماه", "اسفند ماه"],
                dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
                shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
                persianNumbers: 1,
                formatDate: "YYYY/MM/DD",
                prevArrow: '<i class="fa fa-angle-left"></i>',
                nextArrow: '<i class="fa fa-angle-right"></i>',
                selectableYears: [1410, 1409, 1408, 1407, 1406, 1405, 1404, 1403, 1402, 1401, 1400, 1399, 1398, 1397, 1396, 1395, 1394, 1393, 1392, 1391, 1390, 1389, 1388, 1387, 1386, 1385, 1384, 1383, 1382, 1381, 1380, 1379, 1378, 1377, 1376, 1375, 1374, 1373, 1372, 1371, 1370, 1369, 1368, 1367, 1366, 1365, 1364, 1363, 1362, 1361, 1360, 1359, 1358, 1357, 1356, 1355, 1354, 1353, 1352, 1351, 1350],
            });
        });

        $body.find('.pdp-default').each(function (index) {
            $(this).insertAfter('.date:eq(' + index + ')');
            $('.date:eq(' + index + ')').parent().css('position', 'relative');
        });
    });
</script>
