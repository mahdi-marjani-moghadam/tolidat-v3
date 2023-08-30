<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {

        // DataTable
        var table = $('#example').DataTable();

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
        ////

        // Apply the search

    } );
</script>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> لیست پکیج ها </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">لیست پکیج ها</h3>
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
                <a href="<?php echo RELA_DIR ?>admin/?component=package&action=addPackage" class="btn btn-primary btn-sm btn-icon text-13"><i class="fa fa-plus"></i>افزودن پکیج  جدید </a>
            </div>

            <!-- separator -->
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>main</th>
                        <th>نوع پکیج</th>
                        <th>ماه</th>
                        <th>تعداد محصول</th>
                        <th>تعداد دسته بندی</th>
                        <th>تعداد کلمات کلیدی</th>
                        <th>زبان</th>
                        <th>قیمت</th>
                        <th>تعداد شعبه</th>
                        <th>تعداد نمایندگی</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $cn = 1;
                    if (isset($list['list']))
                    {
                        foreach ($list['list'] as $id => $fields)
                        {
                            ?>
                            <tr>
                                <td><?php echo $fields['Package_id']; ?></td>
                                <td><?php echo $fields['main']; ?></td>
                                <td><?php echo $fields['packagetype']; ?></td>
                                <td><?php echo $fields['period']; ?></td>
                                <td><?php echo $fields['product']; ?></td>
                                <td><?php echo $fields['category']; ?></td>
                                <td><?php echo $fields['keyword']; ?></td>
                                <td><?php echo $fields['lang']; ?></td>
                                <td><?php echo $fields['price']; ?></td>
                                <td><?php echo $fields['branch']; ?></td>
                                <td><?php echo $fields['representation']; ?></td>
                                <td>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=package&action=editPackage&id=<?php echo $fields['Package_id']; ?>">ویرایش</a>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=package&action=deletePackage&id=<?php echo $fields['Package_id']; ?>">حذف</a>
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
                    <th><input type="text" name="search_4" class="search_init form-control"/></th>
                    <th><input type="text" name="search_5" class="search_init form-control"/></th>
                    <th><input type="text" name="search_6" class="search_init form-control"/></th>
                    <th><input type="text" name="search_7" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_8" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_9" class="search_init form-control"/></th>
                    <th><input type="hidden" name="search_10" class="search_init form-control"/></th>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
