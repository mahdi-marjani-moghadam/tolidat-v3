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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>لیست مجوز های تولیدی</a></li>
    </ul>
</div>
<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست مجوز های تولیدی</h3>
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
                <div class="pull-right">
                    <a href="<?= RELA_DIR ?>admin/?component=licence&company_id=<?php echo $list['company_id']; ?>&action=add" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن مجوز جدید</a>
                </div>
                <div class="row smallSpace"></div>
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام صاحب جواز</th>
                        <th>نام خانوادگی صاحب جواز</th>
                        <th>کد ملی صاحب جواز</th>
                        <th>مرجع تایید جواز</th>
                        <th>فعالیت جواز</th>
                        <th>تاریخ صدور جواز</th>
                        <th>تاریخ انقضا جواز</th>
                        <th>تصویر</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])) { ?>
                        <?php foreach ($list['list'] as $id => $fields) { ?>
                            <tr>
                                <td><?php echo $fields['Licence_id']; ?></td>
                                <td><?php echo $fields['name']; ?></td>
                                <td><?php echo $fields['family']; ?></td>
                                <td><?php echo $fields['national_code']; ?></td>
                                <td><?php echo $fields['exporter_refrence']; ?></td>
                                <td><?php echo $fields['description']; ?></td>
                                <td><?php echo convertDate($fields['issuence_date']); ?></td>
                                <td><?php echo convertDate($fields['expiration_date']); ?></td>
                                <td dir="ltr" align="center">
                                    <img height="60px" src="<?= COMPANY_ADDRESS . $fields['company_id'] . "/licence/" . $fields['image'] ?>"/>
                                </td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=licence&action=edit&id=<?php echo $fields['Licence_id']; ?>">ویرایش</a>
                                    <br/>
                                    <a href="<?= RELA_DIR ?>admin/?component=licence&action=deleteLicence&licence_id=<?php echo $fields['Licence_id']; ?>">حذف</a>
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
                    <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>