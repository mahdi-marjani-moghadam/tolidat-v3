<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });

    });
</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست لاگ های
                کمپانی <?php echo $list['company']['company_name'] ?></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست لاگ های کمپانی <?php echo $list['company']['company_name'] ?></h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">

            <div class="col-md-6 center-block">
                <h4 class="text-center" style="color: blueviolet;"><?php echo $list['task-msg'] ?></h4>
                <form method="post" role="form" data-validate="form" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="col-md-6 form-group pull-right">
                        <select name="letter" id="letter" required>
                            <option value="">نامه مورد نظر را انتخاب کنید...</option>
                            <?php foreach ($list['letters'] as $letter) : ?>
                                <option value="<?php echo $letter['letter_id'] ?>"><?php echo $letter['type'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <select name="action" id="action" required>
                            <option value="">عمل مورد نظر را انتخاب کنید...</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group pull-right">
                        <label for="description">توضیحات :</label>
                        <textarea class="col-md-12" name="description" id="description" cols="60" rows="5" required></textarea>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="admin">ارجاع به :</label>
                        <select name="assign_to" id="admin">
                            <option value="">مدیر موردنظر را انتخاب کنید...</option>
                            <?php foreach ($list['admins'] as $action) : ?>
                                <option value="<?php echo $action['admin_id'] ?>"><?php echo $action['name'] . " " . $action['family'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="tracking_date">تاریخ پیگیری :</label>
                        <input class="col-md-12 date" name="tracking_date" id="tracking_date" style="line-height: 2" placeholder="۱۳۹۷/۰۱/۰۱">
                    </div>

                    <div class="col-md-6 form-group pull-left">
                        <input type="hidden" value="addLog">
                        <input class="col-md-6 btn btn-success pull-left" type="submit" value="ذخیره">
                    </div>
                </form>
            </div>
            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره دسته</th>
                        <th>اپراتور</th>
                        <th>اکشن</th>
                        <th>نحوه ارسال</th>
                        <th>ارجاع شده به</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                        <th>توضیحات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['logs'])) : ?>
                        <?php foreach ($list['logs'] as $key => $fields) : ?>
                            <tr>
                                <td><?php echo $fields['letter_log_id']; ?></td>
                                <td><?php echo $fields['group_id']; ?></td>
                                <td><?php echo $fields['admin_name'] . ' ' . $fields['admin_family']; ?></td>
                                <td><?php echo $fields['letter_type']; ?></td>
                                <td><?php echo $fields['letter_action']; ?></td>
                                <td><?php echo($fields['assign_name'] ? $fields['assign_name'] . ' ' . $fields['assign_family'] : "ارجاع داده نشده"); ?></td>
                                <td>
                                    <?php if (isset($fields['status']) & $fields['status'] == 1) : ?>
                                        <?php echo "انجام شده" ?>
                                    <?php elseif (isset($fields['status']) & $fields['status'] == 0) : ?>
                                        <?php echo "انجام نشده" ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo convertDate($fields['date']); ?></td>
                                <td><?php echo $fields['description']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><input type="text" name="search_9" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->

<script>
    $(function () {

        $('#letter').on('change', function () {
            var letter_id = $(this).val();
            $.post('/admin/?component=crm&action=getActionsByLetterId', {letter_id: letter_id}, function (data) {
                var actions = $.parseJSON(data);
                $('#action').select2('data', {id: null, text: 'عمل مورد نظر را انتخاب کنید...'});
                $('#action').empty();
                $('#action').select2('close');
                $('#description').empty();
                var html = '<option value="">عمل مورد نظر را انتخاب کنید...</option>'
                $.each(actions, function (key, value) {
                    html += '<option value="'+value.action_id+'">'+value.action+'</option>'
                });
                $('#action').append(html);
            });
        });

        $('#action').on('change', function () {
            var company_name = "<?php echo $list['company']['company_name'] ?>";
            var maneger_name = "<?php echo $list['company']['maneger_name'] ?>";
            var action_id = $(this).val();
            $.get('/admin/?component=crm&action=getActionById', {action_id: action_id}, function (data) {
                var action = $.parseJSON(data);
                if (action.message.length) {
                    var message = action.message.replace('{manager_name}', maneger_name);
                    var message = message.replace('{company_name}', company_name);
                    $('#description').text(message);
                }
            });
        });

        var $datePicker = $('.date');
        var $body = $('body');

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