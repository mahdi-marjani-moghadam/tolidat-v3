<style>
    li.select2-search-choice div {
        margin-right: 15px;
    }
</style>
<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        //	datatable
        var dataTable = $('#example');
        var oTable = dataTable.DataTable({
            "processing": true,
            "serverSide": true,
            "sPaginationType": "bs_full",
            "oLanguage": {
                "sProcessing": "در حال بارگذاری ..."
            },
            "aaSorting": [],
            "ajax": "<?php echo RELA_DIR?>admin/?component=crm&action=filterCompany&status=<?php echo $list['status'] . $list['letter_action'] . $list['have_been'] ?>",

        });

        // Apply the search
        var timerId;
        oTable.columns().every(function () {
            var that = this;
            $('input , select', this.footer()).on('keyup change', function () {
                var d = this;
                clockStop();
                clockStart();
                function clockStart() {
                    if (timerId) return;
                    timerId = setInterval(update, 1200);
                }

                function clockStop() {
                    if (!timerId) return;
                    clearInterval(timerId);
                    timerId = null;
                }

                function update() {
                    clockStop();
                    that.search(d.value).draw();
                }

            });
        });

    });

</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> لیست کمپانی ها </a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->

    <div class="row xsmallSpace"></div>

    <div id="panel-1" class="panel panel-default border-blue">

        <div class="panel-heading bg-blue">

            <h3 class="panel-title rtl ">لیست کمپانی ها</h3>

            <div class="panel-actions">

                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>

                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>

        </div>

        <div class="panel-body">
            <div class="col-md-12 center-block">
                <form method="get">
                    <input type="hidden" name="component" value="crm">
                    <input type="hidden" name="action" value="companies">
                    <div class="col-md-5 pull-right">
                        <label class="col-md-4" for="letter_action">اکشن را انتخاب کنید</label>
                        <div class="col-md-8">
                            <select name="letter_action[]" multiple="multiple" class="letter-action" id="letter_action">
                                <?php foreach ($list['actions'] as $action) : ?>
                                    <option value="<?php echo $action['letter_action_id'] ?>">
                                        <?php echo $action['action'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pull-right">
                        <label class="pull-right" for="shod">شده<input value="1" type="radio" name="have-been"
                                                                       id="shod" <?php echo($list['have_been_value'] == 1 ? 'checked' : '') ?>></label>
                        <label class="pull-left" for="nashod">نشده<input value="0" type="radio" name="have-been"
                                                                         id="nashod" <?php echo($list['have_been_value'] == 0 ? 'checked' : '') ?>></label>
                    </div>
                    <div class="col-md-4 pull-right">
                        <input class="col-md-4 btn btn-success" type="submit" value="فیلتر">
                        <a class="col-md-4 btn btn-danger"
                           href="<?php echo RELA_DIR . 'admin//?component=crm&action=companies' ?>">لغو فیلتر</a>
                    </div>
                </form>
            </div>

            <!-- separator -->
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">

                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام کمپانی</th>
                        <th>نوع کمپانی</th>
                        <th>بسته</th>
                        <th>تاریخ انقضاء بسته</th>
                        <th>وضعیت</th>
                        <th>تاریخ ویرایش</th>
                        <th>تصویر</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th><input type="text" name="search_1" class="search_init form-control"/></th>
                        <th><input type="text" name="search_2" class="search_init form-control"/></th>
                        <th><select name="search_3" class="search_init" id="search_3">
                                <option value="">همه</option>
                                <option value="1">حقوقی</option>
                                <option value="2">حقیقی</option>
                            </select>
                        </th>
                        <th><select name="search_5" class="search_init " id="search_5">
                                <option value="">همه</option>
                                <option value="1">رایگان</option>
                                <option value="4">تجاری</option>
                            </select>
                        </th>
                        <th><input type="text" name="search_6" class="search_init form-control date"/></th>
                        <th><select name="search_7" class="search_init " id="search_7">
                                <option value="">همه</option>
                                <option value="1">فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </th>
                        <th><input type="text" name="search_8" class="search_init form-control date"/></th>
                        <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                        <th><input type="hidden" name="search_11" class="search_init form-control"></th>
                    </tr>
                    </tfoot>
                </table>

            </div>

        </div>

        <div class="panel-footer clearfix"></div>

    </div>

</div>
<!--/content-body -->

<div class="modal fade customMobile" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p class="phoneHolder"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $(document).ready(function () {
        var $body = $('body'),
            $toggleSideBar = $('#toggleSideBar'),
            $datePicker = $('.date'),
            $sideBar = $('.side-left');

        $('select').select2();

        $.iziToastSuccess = function (msg) {
            iziToast.show({
                title: 'موفقیت',
                color: 'green',
                icon: 'fa fa-times-circle',
                iconColor: 'green',
                rtl: true,
                position: 'topCenter',
                message: msg
            });
        };

        $.iziToastError = function (msg) {
            iziToast.show({
                title: 'خطا',
                color: 'red',
                icon: 'fa fa-times-circle',
                iconColor: 'red',
                rtl: true,
                position: 'topCenter',
                message: msg
            });
        };

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

        // selecting options from select element
        var action_id = '<?= json_encode($list['letter_action_id']) ?>';
        $.each($.parseJSON(action_id), function (key, value) {
            $('.letter-action').find('option[value="' + value + '"]').attr('selected', true);
        });
    });


</script>