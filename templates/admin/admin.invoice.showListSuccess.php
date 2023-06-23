<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {

        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every(function () {
            var that = this;

            $('input', this.footer()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
        ////

        // Apply the search

    });
</script>
<?php //print_r_debug($list); ?>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>لیست فاکتورهای پرداخت شده </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">

            <h3 class="panel-title rtl">لیست فاکتورهای پرداخت شده </h3>
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

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                        width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام کمپانی</th>
                        <th>نوع پکیج</th>
                        <th>قیمت پکیج</th>
                        <th>مبلغ قابل پرداخت</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])): ?>
                        <?php foreach ($list['list'] as $id => $fields): ?>
                            <tr>
                                <td><?php echo $fields['Invoice_id']; ?></td>
                                <td><?php echo $fields['company_name']; ?></td>
                                <td><?php echo $fields['packagetype']; ?></td>
                                <td><?php echo $fields['price']; ?></td>
                                <td><?php echo $fields['total_price']; ?></td>
                                <td><?= 'پرداخت شده' ?></td>
                                <td><?= $fields['date'] != '0000-00-00 00:00:00' ? convertDate($fields['date']) : ''; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
