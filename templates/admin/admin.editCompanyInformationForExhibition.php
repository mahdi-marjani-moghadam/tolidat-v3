<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش کمپانی</a></li>
    </ul><!--/control-nav-->
    <?php //print_r_debug($list)?>
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
                    <form action="<?= RELA_DIR . 'admin/?component=company&action=printCompanyInformationExhibition&id='.$list['company']['Company_id'].'&branch_id=0' ?>" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="company_name">نام کمپانی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name" required value="<?= $list['company']['company_name'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-2 pull-right control-label rtl" for="description">توضیحات:</label>
                                    <div class="col-xs-12 col-sm-10 pull-right">
                                        <textarea type="text" class="form-control" name="description" id="description" required rows="6"><?= $list['company']['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="company_name">نام مدیر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="maneger_name" id="maneger_name" required value="<?= $list['company']['maneger_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="description">تاریخ بروزرسانی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control date" name="refresh_date" id="refresh_date" required value="<?/*= convertDate($list['company']['refresh_date']) */?>">
                                    </div>
                                </div>
                            </div>-->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-6">
                                                <div class="form-group">
                                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                            for="licence">نمایشگاه:</label>
                                                    <div class="col-xs-12 col-sm-8 pull-right">

                                                        <?
                                                        //print_r_debug($list['exhibition'])
                                                        ?>

                                                        <select name="exhibition_name" id="exhibition_name" data-input="select2">
                                                            <?
                                                            foreach ($list['exhibition'] as $key => $value) {
                                                                ?>
                                                            <option
                                                                    value="<?= $value['id'] ?>"
                                                                <?= ($value['id'] == DEFAULT_EXHIBITION) ? "selected" : '' ?>>

                                                                <?= $value['name'] ?>
                                                                </option><?
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="licence_box" class="col-xs-12 col-sm-12 col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($list['company']['company_type'] == 1) : ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="registration_number">شماره ثبت:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="registration_number" id="registration_number" value="<?= $list['company']['registration_number'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="national_id">شناسه ملی:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="national_id" id="national_id" value="<?= $list['company']['national_id'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <input type="submit" class="col-md-6 btn btn-success" value="چاپ">
                                        <a href="<?=RELA_DIR . 'admin/?component=company&action=printCompanyInformationExhibition' ?>" class="col-md-6 btn btn-danger">بازگشت</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        var $body = $('body'),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

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
