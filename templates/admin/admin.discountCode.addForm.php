<div class="content-control">
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> افزودن تخفیف جدید</a></li>
    </ul>
</div>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم افزودن تخفیف </h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post">
                    <div class="row xsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="precode">پیشوند کد تخفیف :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control set-font-latin" name="precode" id="precode" autocomplete="off" required value="<?= $list['precode'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="start_date">تاریخ شروع :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control date set-font-latin" name="start_date" id="start_date" autocomplete="off" required value="<?= $list['start_date'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="lang">نوع کد :</label>
                                <select class="col-xs-12 col-sm-8 pull-right" name="discount_type" id="discount_type">
                                    <option value="1">مخصوص یک نفر</option>
                                    <option value="2">همگانی</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="expire_date">تاریخ انقضا :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control date set-font-latin" name="expire_date" id="expire_date" autocomplete="off" required value="<?= $list['expire_date'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="percent">درصد تخفیف :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control set-font-latin" name="percent" id="percent" autocomplete="off" required value="<?= $list['percent'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group count">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="count">تعداد :</label>
                                <div class="col-xs-12 col-sm-8 pull-right">
                                    <input type="text" class="form-control set-font-latin" name="count" id="count" autocomplete="off" required value="<?= $list['count'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="lang">اعمال روی پکیج :</label>
                                <select class="col-xs-12 col-sm-8 pull-right" name="package_id" id="package_id">
                                    <option value="0">همه پکیج ها</option>
                                    <?php foreach ($list['packages'] as $package) : ?>
                                        <option value="<?= $package['Package_id'] ?>"><?= $package['packagetype'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row xsmallSpace hidden-xs"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pull-left">
                                <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                    <input name="action" type="hidden" id="action" value="add"/>
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
<script>
    $(function () {
        // change input date to persian date picker
        var $datePicker = $('.date'), $body = $('body');
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

        // Hide count field : if selected discount type 2
        $('#discount_type').on('change', function () {
            if ($(this).val() == 2) {
                $('.count').hide();
            } else {
                $('.count').show();
            }
        });

    });
</script>
