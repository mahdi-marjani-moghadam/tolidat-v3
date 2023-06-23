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


<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl"> لیست اکشن های اصلی<?php echo $list['company_name'] ?></h3>
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
            <a class="btn btn-primary btn-sm btn-icon text-13" href="<?php echo RELA_DIR . 'admin/?component=crm&action=addLetter'?>"><i class="fa fa-plus"></i>افزودن اکشن اصلی</a>
            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نوع اکشن اصلی</th>
                        <th>تاریخ</th>
                        <th>وضعیت</th>
                        <th>ابزار</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($list)) :?>
                        <?php foreach ($list as $key => $fields) : ?>
                            <tr>
                                <td><?php echo $fields['letter_id']; ?></td>
                                <td><?php echo $fields['type']; ?></td>
                                <td><?php echo convertDate($fields['date']); ?></td>
                                <td>
                                    <?php if ($fields['status'] == 1) : ?>
                                        <i class="fa fa-check-circle" style="font-size: x-large"></i>
                                    <?php elseif ($fields['status'] == 0) : ?>
                                        <i class="fa fa-times-circle" style="font-size: x-large"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo RELA_DIR . 'admin/?component=crm&action=editLetter&letter_id=' . $fields['letter_id'] ?>">ویرایش</a>
                                    <a href="<?php echo RELA_DIR . 'admin/?component=crm&action=disableLetter&letter_id=' . $fields['letter_id'] ?>">فعال/غیرفعال</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <th><input type="text" name="search_1" class="search_init form-control"/></th>
                    <th><input type="text" name="search_2" class="search_init form-control"/></th>
                    <th><input type="text" name="search_3" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_4" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_5" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div>