<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش کمپانی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">جزییات کمپانی</h3>
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
        <?php if ($msg != null) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal"
                            novalidate="novalidate" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="company_name">نام کمپانی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                                required value="<?= $list['company_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="description">توضیحات:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="description" id="description"
                                                required value="<?= $list['description'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="category_id">انتخاب دسته بندی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="category_id[]" id="category_id" data-input="select2" multiple>
                                            <?
                                            foreach ($list['category'] as $category_id => $value) {
                                                ?>
                                                <option <?php echo in_array($value['Category_id'], $list['category_id']) ? 'selected' : '' ?>
                                                        value="<?= $value['Category_id'] ?>">
                                                    <?= $value['export'] ?>
                                                </option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <!-- state -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="city_id">انتخاب استان:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="state_id" id="province_id" data-input="select2">
                                            <option></option>
                                            <?
                                            foreach ($list['states'] as $province_id => $value) {
                                                ?>
                                            <option
                                                <?= $value['province_id'] == $list['state_id'] ? 'selected' : '' ?>
                                                    value="<?= $value['province_id'] ?>">
                                                <?= $value['name'] ?>
                                                </option><?
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
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="meta_keyword">کلمات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                                value="<?= $list['meta_keyword'] ?>"
                                                data-error="لطفا کلمه کلیدی را وارد نمایید" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="registration_number">شماره ثبت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="registration_number"
                                                id="registration_number" value="<?= $list['registration_number'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="national_id">شناسه ملی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="national_id" id="national_id"
                                                value="<?= $list['national_id'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <!--                            <div class="col-xs-12 col-sm-12 col-md-6">-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"-->
                            <!--                                           for="instagram">آدرس instagram:</label>-->
                            <!--                                    <div class="col-xs-12 col-sm-8 pull-right">-->
                            <!--                                        <input type="text" class="form-control" name="instagram" id="instagram" value="-->
                            <? //= $list['instagram'] ?><!--">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                            <div class="col-xs-12 col-sm-12 col-md-6">-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"-->
                            <!--                                           for="twitter">آدرس twitter:</label>-->
                            <!--                                    <div class="col-xs-12 col-sm-8 pull-right">-->
                            <!--                                        <input type="text" class="form-control" name="twitter" id="twitter" value="-->
                            <? //= $list['twitter'] ?><!--">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <!--                            <div class="col-xs-12 col-sm-12 col-md-6">-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"-->
                            <!--                                           for="telegram">آدرس telegram:</label>-->
                            <!--                                    <div class="col-xs-12 col-sm-8 pull-right">-->
                            <!--                                        <input type="text" class="form-control" name="telegram" id="telegram" value="-->
                            <? //= $list['telegram'] ?><!--">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_name">نام نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_name"
                                                id="coordinator_name" value="<?= $list['coordinator_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_family">نام خانوادگی نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_family"
                                                id="coordinator_family" value="<?= $list['coordinator_family'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_phone">شماره تلفن نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_phone"
                                                id="coordinator_phone" value="<?= $list['coordinator_phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="email">ایمیل نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="email" class="form-control" name="email"
                                                id="email" value="<?= $list['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="status">وضعیت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="status" id="status">
                                            <option
                                                    value="1" <?= ($list['status'] == 1) ? 'selected="selected"' : ''; ?>>
                                                تایید
                                            </option>
                                            <option
                                                    value="0" <?= ($list['status'] == 0) ? 'selected="selected"' : ''; ?>>در انتظار تایید
                                            </option>
                                            <option
                                                    value="-1" <?= ($list['status'] == -1) ? 'selected="selected"' : ''; ?>>
                                                تایید نشده
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="priority">اولویت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="priority" id="priority">
                                            <option
                                                    value="1" <?= ($list['priority'] == '1') ? 'selected="selected"' : ''; ?>>
                                                1
                                            </option>
                                            <option
                                                    value="0" <?= ($list['priority'] == '0') ? 'selected="selected"' : ''; ?>>
                                                0
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--                        </div>-->
                            <!--                        <div class="row xsmallSpace hidden-xs"></div>-->
                            <!--                        <div class="row">-->
                            <!--<div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="xImagePath">تصویر:</label>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-8 pull-right">
                                                <input name="company" class="" type="file" value="انتخاب فایل"  />
                                            </div>
                                            <div id="preview" style="display:none">
                                                <strong>Selected Thumbnails</strong>
                                                <div id="thumbnails"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>-->
                            <!--                            <div class="col-xs-12 col-sm-12 col-md-6">-->
                            <!--                                <div class="form-group">-->
                            <!--                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"-->
                            <!--                                           for="refresh_date">تاریخ </label>-->
                            <!--                                    <div class="col-xs-12 col-sm-8 pull-right">-->
                            <!--                                        <input type="text" class="form-control date" name="refresh_date" id="refresh_date" value="-->
                            <? //= $list['
                            //refresh_date'] ?><!--">-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right">
                                        <input name="action" type="hidden" id="action" value="edit"/>
                                        <input name="Company_id" type="hidden" id="Company_id"
                                                value="<?= $list['Company_id'] ?>"/>
                                        <input name="showStatus" type="hidden" id="Company_id"
                                                value="<?= $list['showStatus'] ?>"/>
                                        <input name="city" type="hidden" id="city"
                                                value="<?= $list['city_id'] ?>"/>
                                        <button type="submit" name="update" id="submit"
                                                class="btn btn-icon btn-success rtl"><i class="fa fa-plus"></i> ثبت
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
    // $("#reference_type option").val("<?= $list['phoneInfo']['reference_type'] ?>").attr("selected", true);


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


        if ("<?= isset($list['licenceInfo']['licence_number'])?>") {
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
