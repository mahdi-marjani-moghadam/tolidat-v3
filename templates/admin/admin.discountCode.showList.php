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
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>تعریف کد تخفیف</a></li>
    </ul>
</div>

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">تعریف کد تخفیف</h3>
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
            <div class="pull-right">
                <a href="<?= RELA_DIR ?>admin/?component=discountCode&action=addDiscountCode" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن تخفیف جدید
                </a>
            </div>
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کد تخفیف</th>
                        <th>نوع کد تخفیف</th>
                        <th>نوع پکیج</th>
                        <th>درصد تخفیف</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ پایان</th>
                        <th>وضعیت</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])) { ?>
                        <?php foreach ($list['list'] as $id => $fields) { ?>
                            <tr>
                                <td><?php echo $fields['Discount_code_id'] ?></td>
                                <td><?php echo $fields['code'] ?></td>
                                <td><?php echo($fields['type'] == 1 ? "مخصوص یک نفر" : "همگانی") ?></td>
                                <td><?php echo($fields['package_id'] == 0 ? "همه پکیج ها" : $fields['packagetype']) ?></td>
                                <td><?php echo $fields['percent'] ?></td>
                                <td><?php echo convertDate($fields['start_date']) ?></td>
                                <td><?php echo convertDate($fields['expire_date']) ?></td>
                                <td><?php echo($fields['status'] == 1 ? "استفاده شده" : "استفاده نشده") ?></td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=discountCode&action=deleteDiscountCode&id=<?php echo $fields['Discount_code_id']; ?>">حذف</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>
