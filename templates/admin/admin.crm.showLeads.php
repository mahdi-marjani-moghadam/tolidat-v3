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
            "ajax": "<?=RELA_DIR?>admin/?component=crm&action=filterLead&status=<?=$list['status'] . $list['admin_id'] ?>",
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

        $('#addLead').on('submit', function (e) {
            if ($('#action').val() == 2 & $('#admin').val() == 0) {
                e.preventDefault();
                $.iziToastError('مدیر مربوطه را انتخاب کنید');
            }

            if ($('#action').val() == 2 & $('#tracking_date').val().length == 0) {
                e.preventDefault();
                $.iziToastError('تاریخ پیگیری را مشخص کنید');
            }
        });

    });

</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست لید ها</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست لید ها</h3>
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
            <div class="col-md-6 center-block">
                <h4 class="text-center" style="color: blueviolet;"><?= $list['lead-msg'] ?></h4>
                <form id="addLead" method="post" role="form" data-validate="form" novalidate="novalidate"
                      enctype="multipart/form-data">
                    <div class="col-md-6 form-group pull-right">
                        <label for="company_name">نام شرکت :</label>
                        <input required class="col-md-12" type="text" name="company_name" id="company_name">
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="name">نام فرد :</label>
                        <input class="col-md-12" type="text" name="name" id="name">
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="mobile">شماره موبایل :</label>
                        <input class="col-md-12" type="text" name="mobile" id="mobile">
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="phone">شماره ثابت :</label>
                        <input class="col-md-12" type="text" name="phone" id="phone">
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="company_type">نوع کمپانی :</label>
                        <select name="company_type" id="company_type">
                            <option value="1">حقوقی</option>
                            <option value="2">حقیقی</option>
                        </select>
                    </div>

                    <div class="col-md-12 form-group pull-right">
                        <label for="comment">توضیحات :</label>
                        <textarea class="col-md-12" name="comment" id="comment" cols="60" rows="5" required></textarea>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="action">عملیات :</label>
                        <select name="action" id="action">
                            <option value="1">اتمام</option>
                            <option value="2">ادامه دارد</option>
                        </select>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="admin">ارجاع به :</label>
                        <select name="assign_to" id="admin">
                            <option value="0">مدیر موردنظر را انتخاب کنید...</option>
                            <?php foreach ($list['admins'] as $action) : ?>
                                <option value="<?= $action['admin_id'] ?>"><?= $action['name'] . " " . $action['family'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 form-group pull-right">
                        <label for="tracking_date">تاریخ پیگیری :</label>
                        <input class="col-md-12 date" name="tracking_date" id="tracking_date" style="line-height: 2"
                               placeholder="۱۳۹۷/۰۱/۰۱">
                    </div>

                    <div class="col-md-6 form-group pull-left">
                        <input class="col-md-6 btn btn-success pull-left" type="submit" value="ذخیره"
                               style="margin-top: 40px">
                    </div>
                </form>
            </div>

            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام مدیر</th>
                        <th>کد شرکت</th>
                        <th>نام شرکت</th>
                        <th>نوع شرکت</th>
                        <th width="15%">آخرین کامنت</th>
                        <th width="15%">تاریخ آخرین کامنت</th>
                        <th width="15%">تاریخ ایجاد لید</th>
                        <th>اتمام/ادامه دارد</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th>
                        <select name="search_5" class="search_init form-control" id="company_type">
                            <option value="">همه</option>
                            <option value="1">حقوقی</option>
                            <option value="2">حقیقی</option>
                        </select>
                    </th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control date"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control date"/></th>
                    <th>
                        <select name="search_9" class="search_init form-control" id="status">
                            <option value="">همه</option>
                            <option value="1">اتمام</option>
                            <option value="2">ادامه دار</option>
                        </select>
                    </th>
                    <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>


<div class="modal fade" id="moveLeadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title roundCorner" id="myModalLabel">برای انتقال لید کد کمپانی را وارد کنید</h4>
            </div>
            <div class="modal-body">
                <form class="form" enctype="multipart/form-data" method="post">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                            <div class="form-group">
                                <input style="direction: ltr" name="company" type="text" class="form-control" id="company">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer noPadding pt">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">بستن</button>
                        <button type="button" id="moveLead" class="btn btn-success btn-sm">انتقال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $body = $('body');
        var lead_id = 0;
        var moveLeadModal = $('#moveLeadModal');

        $body.on('click', '.moveLead', function () {
            lead_id = $(this).data('id');
            moveLeadModal.modal('show');
        });

        $body.on('click', '#moveLead', function () {
            var company_id = $('#company').val();

            $.get('/admin/?component=crm&action=moveLead', {company_id: company_id, lead_id: lead_id}, function (data) {
                var response = $.parseJSON(data);

                if (response.result == -1) {
                    $.iziToastError(response.msg);
                } else {
                    $.iziToastSuccess((response.msg));
                    moveLeadModal.modal('hide');
                }
            });

        });
    });
</script>
