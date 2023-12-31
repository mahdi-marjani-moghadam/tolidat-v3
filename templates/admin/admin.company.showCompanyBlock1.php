<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {
        var $body = $('body'),
            $modal = $('.customMobile'),
            $datePicker = $('.date');

        //	dtatatable
        var dataTable = $('#example');
        var oTable = dataTable.DataTable({
            "processing": true,
            "serverSide": true,
            "sPaginationType": "bs_full",
            "oLanguage": {
                "sProcessing":     "در حال بارگزاری ..."
            },
            "aaSorting": [],

            "ajax": "<?=RELA_DIR?>admin/?component=company&action=searchLock",




        });


        // Apply the search
        //alert($("#search_9").val());
        var timerId;
        oTable.columns().every(function () {
            var that = this;
            $('input , select', this.footer()).on('keyup change', function () {
                var d=this;
                clockStop();
                clockStart();
                function clockStart() {
                    if (timerId) return;
                    timerId = setInterval(update,1200);
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
                //that.search(this.value).draw();
                //clearTimeout(timerId)
            });
        });


        //	dtatatable

        // Apply the search

        //show other phone

        $('#example tbody').on('click', '.company_phone', function () {
            var company_id=$(this).data('company_id');
            $("#loading").show();
            $.ajax({
                url: '<?=RELA_DIR?>admin/?component=company&action=getCompanyPhone',
                type: "POST",
                data: "company_id="+company_id,
                cache: false,
                success: function (data) {

                    $("#loading").hide();
                    $("#allcompanyphone").html(data);
                    $modal.find('.phoneHolder').html('');
                    $modal.find('.phoneHolder').html(data);
                    $modal.modal('show');
                }
            });
        } );

        $('body').on('click', '.company_allphone', function () {
            var company_one_phone=$(this).data('myphonenumber');
            var company_id=$(this).data('mycompanyid');
            call(company_one_phone,company_id);
            //alert(company_id+" => "+company_one_phone);
        } );

        //end show other phone

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

    function call(number,id) {
        var dataString = 'number=' + number;
        $("#loading").show();
        $.ajax({
            url: '<?=RELA_DIR?>admin/?component=company&action=call',
            type: "POST",
            data: dataString,
            cache: false,
            success: function (data) {
                $("#loading").hide();
                if (data == 'yes') {
                    window.location = '<?=RELA_DIR?>admin/?component=company&action=edit&id=' + id;
                } else {

                }
            }
        });
    }
</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>نمایش کمپانی lock شده</a></li>
    </ul>
    <!--/control-nav-->
</div>
<!-- /content-control -->

<div class="content-body">
    <!-- separator -->
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl ">نمایش کمپانی lock شده</h3>
            <div class="panel-actions">
                <button data-expand="#panel-1" title="نمایش" class="btn-panel"><i class="fa fa-expand"></i></button>
                <button data-collapse="#panel-1" title="بازکردن" class="btn-panel"><i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <div class="panel-body">
            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام کمپانی</th>
                            <th>نوع کمپانی</th>
                            <th>نام خانوادگی نماینده</th>
                            <th>بسته</th>
                            <th>تاریخ انقضاء بسته</th>
                            <th>وضعیت</th>
                            <th>کد ویرایش کننده</th>
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
                            <th><input type="text" name="search_4" class="search_init form-control"/></th>
                            <th><select name="search_5" class="search_init " id="search_5">
                                    <option value="">همه</option>
                                    <option value="1">رایگان</option>
                                    <option value="2"></option>
                                </select>
                            </th>
                            <th><input type="text" name="search_6" class="search_init form-control"/></th>
                            <th><select name="search_7" class="search_init " id="search_7">
                                    <option value="">همه</option>
                                    <option value="1">فعال</option>
                                    <option value="0">غیر فعال</option>
                                </select>
                            </th>
                            <th><input type="text" name="search_8" class="search_init form-control"/></th>
                            <th><input type="text" name="search_9" class="search_init form-control date"></th>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
