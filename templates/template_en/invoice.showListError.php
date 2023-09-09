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

            <h3 class="panel-title rtl" title="لیست فاکتورها">لیست فاکتورها</h3>
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
                    <?
                    if (isset($list)) {
                        ?>
                        <tr>
                            <td><?php echo $list['Invoice_id']; ?></td>
                            <td><?php echo $list['company_id']; ?></td>
                            <td><?php echo $list['package_id']; ?></td>
                            <td><?php echo convertDate($list['startdate']); ?></td>
                            <td><?php echo convertDate($list['expiredate']); ?></td>
                            <td><?php echo convertDate($list['registerdate']); ?></td>
                            <td><?php echo $list['status']; ?></td>
                            <td><?php echo $list['price']; ?></td>
                            <td>
                                <a href="<?php echo RELA_DIR . "member/invoice/edit/" . $list['Invoice_id']; ?>">ویرایش</a>
                                <a href="<?php echo RELA_DIR . "member/invoice/delete/" . $list['Invoice_id']; ?>">حذف</a>
                            </td>

                        </tr>
                        <?

                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_8" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
            <a class = "btn btn-success" href="<?php echo RELA_DIR . "member/invoice/payment/". $list['Invoice_id'];?>">پرداخت</a>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
