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
        <li><a class="rtl text-24"><i class="fa fa-file-image-o"></i> لیست آگهی ها </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست آگهی ها </h3>
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
                <a href="<?php echo RELA_DIR ?>admin/?component=companyAdvertise&company_id=<?php echo $list['company_id'] ?>&action=add"
                   class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن آگهی جدید </a>
            </div>
            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>توضیحات</th>
                        <th>تاریخ شروع</th>
                        <th>تاریخ انقضاء</th>
                        <th>تاریخ افزودن</th>
                        <th>کاربر</th>
                        <th>عکس</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list['list'])) : ?>
                        <?php foreach ($list['list'] as $id => $fields): ?>
                            <tr>
                                <td><?php echo $fields['Advertise_id']; ?></td>
                                <td><?php echo $fields['title']; ?></td>
                                <td><?php echo $fields['description']; ?></td>
                                <td><?php echo $fields['startDate'] != '0000-00-00' ? convertDate($fields['startDate']) : ''; ?></td>
                                <td><?php echo $fields['expireDate'] != '0000-00-00' ? convertDate($fields['expireDate']) : ''; ?></td>
                                <td><?php echo $fields['date'] != '0000-00-00' ? convertDate($fields['date']) : ''; ?></td>
                                <td><?php echo !is_numeric($fields['isAdmin']) ? 'کمپانی' : $fields['isAdmin']; ?></td>
                                <td dir="ltr" align="center">
                                    <img height="60px" src="<?= COMPANY_ADDRESS . $fields['company_id'] . '/advertise/' . $fields['image'] ?>"/>
                                </td>
                                <td>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=companyAdvertise&company_id=<?= $list['company_id'] ?>&action=edit&advertise_id=<?php echo $fields['Advertise_id']; ?>">ویرایش</a>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=companyAdvertise&company_id=<?= $list['company_id'] ?>&action=delete&parent_id=<?php echo $fields['parent_id']; ?>">حذف</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="text" name="search_4" class="search_init form-control date"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control date"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control date"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_8" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->



