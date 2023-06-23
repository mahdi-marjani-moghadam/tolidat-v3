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
    });

</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i> لیست قوانین و مقررات</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">

    <!-- separator -->
    <div class="xsmallSpace"></div>

    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست قوانین و مقررات</h3>
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
                <a href="<?= RELA_DIR ?>admin/?component=laws&action=addLaws" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i> افزودن قانون جدید</a>
            </div>

            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">

                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>متن قانون</th>
                        <th>تصویر</th>
                        <th>تاریخ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list)): ?>
                        <?php foreach ($list as $id => $fields): ?>
                            <tr>
                                <td><?php echo $fields['Laws_id']; ?></td>
                                <td><?php echo $fields['title']; ?></td>
                                <td><?php echo $fields['text']; ?></td>
                                <td dir="ltr" align="center"><img height="60px" src="<?= COMPANY_ADDRESS . "/" .$fields['image'] ?>"/></td>
                                <td><?php echo convertDate($fields['date']); ?></td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=laws&action=editLaws&id=<?php echo $fields['Laws_id']; ?>">ویرایش</a>
                                    <a href="<?= RELA_DIR ?>admin/?component=laws&action=deleteLaws&id=<?php echo $fields['Laws_id']; ?>">حذف</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">

        </div>
    </div>
</div><!--/content-body -->

