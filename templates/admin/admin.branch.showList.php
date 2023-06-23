
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
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>branch</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div class="row xsmallSpace"></div>
    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">افزودن شعبه</h3>
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
                <a href="<?php echo RELA_DIR ?>admin/?component=branch&action=addbranch&company_id=<?php echo $list['company_id']; ?>" class="btn btn-primary btn-sm btn-icon text-13">اضافه کردن شعبه :<i class="fa fa-plus"></i></a>
            </div>

            <!-- separator -->
            <div class="row smallSpace"></div>
            <div class="table-responsive table-responsive-datatables">
                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف:</th>
                        <th>شماره کمپانی:</th>
                        <th>نام شعبه:</th>
                        <th>نام مدیر:</th>
                        <th>شهر:</th>
                        <th>عملیات:</th>
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
                                <td><?php echo$fields['Branch_id']; ?></td>
                                <td><?php echo $fields['company_id']; ?></td>
                                <td><?php echo$fields['branch_name']; ?></td>
                                <td><?php echo$fields['maneger_name']; ?></td>
                                <td><?php echo$fields['city_id']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php  RELA_DIR ?>?component=companyPhones&company_id=<?php echo $list['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">تلفن:</a></li>
                                            <li><a href="<?php  RELA_DIR ?>?component=companyAddresses&company_id=<?php echo $fields['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">آدرس:</a></li>
                                            <li><a href="<?php  RELA_DIR ?>?component=companyEmails&company_id=<?php echo $fields['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">پست الکترونیک:</a></li>
                                            <li><a href="<?php  RELA_DIR ?>?component=companyWebsites&company_id=<?php echo $fields['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">وب سایت :</a></li>
                                            <li><a href="<?php  RELA_DIR ?>?component=companySocials&company_id=<?php echo $fields['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">شبکه های اجتماعی:</a></li>
                                            <li><a href="<?php  RELA_DIR ?>?component=companyPositions&action=add&company_id=<?php echo $fields['company_id'];?>&branch_id=<?php echo $fields['parent_id'];?>">موقعیت</a></li>
                                        </ul>
                                    </div>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=branch&action=editbranch&branch_id=<?php echo $fields['Branch_id']; ?>&company_id=<?php echo $fields['company_id'];?>">ویرایش</a>
                                    <a href="<?php echo RELA_DIR ?>admin/?component=branch&action=deletebranch&branch_id=<?php echo $fields['Branch_id']; ?>&company_id=<?php echo $fields['company_id'];?>">حذف</a>
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

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="panel-footer clearfix">
        </div>
    </div>
</div><!--/content-body -->
