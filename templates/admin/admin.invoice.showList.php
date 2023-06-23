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
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست فاکتورها </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">

            <h3 class="panel-title rtl">لیست فاکتورها</h3>
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
                        <th>کد کمپانی</th>
                        <th>کد پکیج</th>
                        <th>تاریخ شروع</th>
                        <th>تارخ انقضا</th>
                        <th>تاریخ ثبت نام</th>
                        <th>وضعیت</th>
                        <th>قیمت</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])): ?>
                        <?php foreach ($list['list'] as $id => $fields): ?>
                            <tr>
                                <td><?php echo $fields['Invoice_id']; ?></td>
                                <td><?php echo $fields['company_id']; ?></td>
                                <td><?php echo $fields['package_id']; ?></td>
                                <td><?php echo $fields['startdate'] ? convertDate($fields['startdate']) : ''; ?></td>
                                <td><?php echo $fields['expiredate'] ? convertDate($fields['expiredate']) : ''; ?></td>
                                <td><?php echo $fields['registerdate'] ? convertDate($fields['registerdate']) : ''; ?></td>
                                <td><?php echo $fields['status']; ?></td>
                                <td><?php echo $fields['price']; ?></td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=invoice&action=editInvoice&id=<?php echo $fields['Invoice_id']; ?>">ویرایش</a> <br/>
                                    <a href="<?= RELA_DIR ?>admin/?component=invoice&action=assignInvoice&id=<?php echo $fields['Invoice_id']; ?>">تایید</a>
                                </td>
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
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><input type="text" name="search_9" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
