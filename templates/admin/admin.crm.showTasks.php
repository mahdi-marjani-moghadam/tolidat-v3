<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        //	datatable
        var dataTable = $('#example');

        var oTable = dataTable.DataTable({
            /*data:[
                ['1', '1', '1', '1', '1', '1', '1', '1', '1', '1','1'],
                ['1', '1', '1', '1', '1', '1', '1', '1', '1', '1','1']
            ],*/
            "processing": true,
            "serverSide": true,
            "sPaginationType": "bs_full",
            "oLanguage": {
                "sProcessing": "در حال بارگذاری ..."
            },
            "aaSorting": [],
            "ajax": "<?=RELA_DIR?>admin/?component=crm&action=filterTask&status=<?=$list['status'] . $list['admin_id'] ?>",
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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست تسک ها</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست تسک ها</h3>
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
            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره لاگ</th>
                        <th>شماره دسته</th>
                        <th>شماره کمپانی</th>
                        <th>نام کمپانی</th>
                        <th>نوع اکشن</th>
                        <th>توضیحات</th>
                        <th>مدیر پیگیری</th>
                        <th width="15%">تاریخ پیگیری</th>
                        <th width="15%">تاریخ</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><input type="text" name="search_9" class="search_init form-control date"/></th>
                    <th><input type="text" name="search_10" class="search_init form-control date"/></th>
                    <th>
                        <select name="search_11" class="search_init form-control" id="status">
                            <option value="">همه</option>
                            <option value="1">انجام شده</option>
                            <option value="0">انجام نشده</option>
                        </select>
                    </th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>

<script>

    $(function () {

    });

</script>