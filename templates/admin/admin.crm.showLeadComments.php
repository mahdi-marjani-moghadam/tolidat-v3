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
            "ajax": "<?=RELA_DIR?>admin/?component=crm&action=filterLeadComment&status=<?=$list['status'] . $list['lead_id'] ?>",
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

        $('#addComment').on('submit', function (e) {
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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست کامنت های کمپانی <?=$list['lead']['company_name']?></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست کامنت ها</h3>
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
                <div>
                    <div>
                        <span style="font-size: 18px">نام فرد :</span>
                        <span style="font-size: 18px"><?= $list['lead']['name'] ?></span>
                    </div>
                    <div>
                        <span style="font-size: 18px">شماره موبایل :</span>
                        <span style="font-size: 18px"><?= $list['lead']['mobile'] ?></span>
                    </div>
                    <div>
                        <span style="font-size: 18px">نام ثابت :</span>
                        <span style="font-size: 18px"><?= $list['lead']['phone'] ?></span>
                    </div>
                    <div>
                        <span style="font-size: 18px">نوع کمپانی :</span>
                        <span style="font-size: 18px"><?= $list['lead']['company_type'] == 1 ? 'حقوقی' : 'حقیقی' ?></span>
                    </div>
                </div>
                <div class="col-md-6 center-block">
                <h4 class="text-center" style="color: blueviolet;"><?= $list['lead-msg'] ?></h4>
                <form id="addComment" method="post" role="form" data-validate="form" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="col-md-12 form-group pull-right">
                        <label for="comment">کامنت :</label>
                        <textarea class="col-md-12" name="comment" id="comment" cols="60" rows="5" required><?= $_SESSION['lead_comment']; unset($_SESSION['lead_comment']) ?></textarea>
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
                        <input class="col-md-12 date" name="tracking_date" id="tracking_date" style="line-height: 2" placeholder="۱۳۹۷/۰۱/۰۱">
                    </div>

                    <div class="col-md-6 form-group pull-left">
                        <input class="col-md-6 btn btn-success pull-left" type="submit" value="ذخیره">
                    </div>
                </form>
            </div>

            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام مدیر</th>
                        <th>کامنت</th>
                        <th width="20%">تاریخ</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control date"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>