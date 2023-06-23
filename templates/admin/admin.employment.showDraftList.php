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
        // Apply the search
    });
</script>

<?php //print_r_debug($list['list']); ?>

<div class="content-control">
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>لیست  فرصت های شغلی</a></li>
    </ul>
</div>
<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست  فرصت های شغلی</h3>
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
            <div class="table-responsive table-responsive-datatables">
                <div class="row smallSpace"></div>
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>مخاطب پست الکترونیک</th>
                        <th>حدقل دستمزد</th>
                        <th>حداکثر دستمزد</th>
                        <th>مهارت</th>
                        <th>سابقه ها</th>
                        <th>تاریخ</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])) { ?>
                        <?php foreach ($list['list'] as $id => $fields) { ?>
                            <tr>
                                <td><?php echo $fields['Employment_id']; ?></td>
                                <td><?php echo $fields['title']; ?></td>
                                <td><?php echo $fields['contactEmail']; ?></td>
                                <td><?php echo $fields['minSallary']; ?></td>
                                <td><?php echo $fields['maxSallary']; ?></td>
                                <td><?php echo $fields['skill']; ?></td>
                                <td><?php echo $fields['history']; ?></td>
                                <td><?php echo $fields['date']; ?></td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=employment&action=editDraftEmployment&id=<?php echo $fields['Employment_id']; ?>">بررسی</a>
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
                    <th><input type="text" name="search_9" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>