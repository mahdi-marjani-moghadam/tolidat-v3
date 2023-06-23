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


<script>

    function test($id) {

        var address=$id+"-id";
        $.ajax({
            url: "<?php echo RELA_DIR;?>admin/?component=notification&action=showMSG",
            data: {id : $id},
            method: 'post',
            success: function (result) {
                if(result == '1'){
                    $('#'+address).text("خوانده شده");
                    alert(result);
                }
            },
            error: function (result, status) {
                console.log('error: ' + status);
            }
        });


    }


</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i>اعلان های دریافتی من</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->

<div class="content-body">

    <!-- separator -->
    <div class="xsmallSpace"></div>

    <div id="panel-1" class="panel panel-default border-blue">
        <div class="panel-heading bg-blue">
            <h3 class="panel-title rtl">اعلان های دریافتی من</h3>
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
            <div class="row smallSpace"></div>

            <div class="table-responsive table-responsive-datatables">

                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>پیغام</th>
                        <th>تاریخ</th>
                        <th>فرستنده</th>
                        <th>وضعیت</th>
                        <th>اکشن</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $list['list'] = $list['export']['list'];
                    $cn = 1;
                    if (isset($list['list'])) {
                        foreach ($list['list'] as $id => $fields) {
                            ?>
                            <tr>
                                <td><?php echo $fields['Notification_id']; ?></td>
                                <td><p onclick="test(<?php echo $fields['Notification_id']; ?>);"  ><?php echo $fields['msg']; ?></p></td>
                                <td><?php echo $fields['date']; ?></td>
                                <td><?php if($fields['from'] == 1 || $fields['from'] == 3) {
                                        echo "مدیر";
                                    } else {
                                        echo "کاربر";
                                    } ?>
                                </td>
                                <td><p id="<?php echo $fields['Notification_id']?>-id"><?php $fields['isRead'] ? print "خوانده شده" : print "خوانده نشده" ?></p></td>
                                <td><?php echo $fields['action']; ?></td>
                                <td>
<!--                                    <a href="--><?//= RELA_DIR ?><!--admin/?component=notification&action=editNotification&id=--><?php //echo $fields['Notification_id']; ?><!--">ویرایش</a>-->
                                    <a href="<?php echo  RELA_DIR ?>admin/?component=notification&action=deleteNotification&id=<?php echo $fields['Notification_id']; ?>">حذف</a>
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
                    </tfoot>
                </table>
            </div>
        </div>
            <div class="panel-footer clearfix">

            </div>
    </div>
</div><!--/content-body -->



