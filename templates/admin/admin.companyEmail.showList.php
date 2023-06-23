
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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>لیست پست الکترونیک تولیدی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست پست الکترونیک تولیدی</h3>
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
                    <a href="<?php echo RELA_DIR ?>admin/?component=companyEmails&branch_id=<?php echo $list['branch_id']; ?>&company_id=<?php echo $list['company_id'];?>&action=add"
                       class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن پست الکترونیک جدید</a>
                </div>
                <div class="row smallSpace"></div>
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>توضیحات</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cn = 1;
                    if (isset($list['list'])) {
                        foreach ($list['list'] as $id => $fields) {
                            ?>
                            <tr>
                                <td><?php echo $fields['Emails_id']; ?></td>
                                <td><?php echo $fields['subject']; ?></td>
                                <td><?php echo $fields['email']; ?></td>
                                <td>
                                    <a href="<?= RELA_DIR ?>admin/?component=companyEmails&action=edit&id=<?= $fields['Emails_id']; ?>&branch_id=<?= $list['branch_id']; ?>&company_id=<?= $list['company_id'];?>">ویرایش</a>
                                    <br/>
                                    <a href="<?= RELA_DIR ?>admin/?component=companyEmails&action=deleteCompanyEmails&id=<?= $fields['Emails_id']; ?>&branch_id=<?= $list['branch_id']; ?>&company_id=<?= $list['company_id'];?>">حذف</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <th><input type="hidden" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>

                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
