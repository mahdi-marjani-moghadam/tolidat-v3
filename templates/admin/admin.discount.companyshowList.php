<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        // DataTable
        var table = $('#example').DataTable();
        console.log(table);
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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>لیست کمپانی های تخفیف خورده</a></li>
    </ul>
</div>

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست کمپانی هایی که از تخفیف استفاده کرده اند</h3>
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
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره کمپانی</th>
                        <th>نام کمپانی</th>
                        <th>شماره کد تخفیف</th>
                        <th>کد تخفیف</th>
                        <th>درصد تخفیف</th>
                        <th>مبلغ تخفیف (ریال)</th>
                        <th>نوع تخفیف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])) { ?>
                        <?php foreach ($list['list'] as $id => $fields) { ?>
                            <tr>
                                <td><?php echo $id+1 ?></td>
                                <td><?php echo $fields['Company_id']; ?></td>
                                <td><?php echo $fields['company_name']; ?></td>
                                <td><?php echo $fields['Discount_code_id']; ?></td>
                                <td><?php echo $fields['code']; ?></td>
                                <td><?php echo $fields['percent']; ?></td>
                                <td><?php echo $fields['price'] - $fields['total_price']; ?></td>
                                <td><?php echo($fields['type'] == 1 ? "مخصوص یک نفر" : "همگانی"); ?></td>
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
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>
