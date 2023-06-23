<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i> افزودن کمپانی حقیقی</a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list) 
?>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم مرحله اول ثبت نام حقیقی</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->
        <?php if ($msg != null) {
        ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?php echo  $msg ?>
            </div>
        <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post" action="<?php echo  RELA_DIR ?>admin/?component=company&action=checkRealCompany">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="licence">نوع جواز:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="licence_type" id="licence_type" data-input="select2">
                                            <option></option>
                                            <?php
                                            foreach ($list['licence'] as $key => $value) {
                                            ?>
                                                <option value="<?php echo  $value['Licence_list_id'] ?>" <?php if($value['Licence_list_id']==1) echo 'selected'?>  >
                                                    <?php echo  $value['name'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                            <option value="0">غیره</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="licence_box" class="col-xs-12 col-sm-12 col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="licence_number">شماره جواز:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="licence_number" id="licence_number" value="<?php echo  $list['licence_number'] ?>" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <button type="submit" name="btnCheck" id="btnCheck" class="btn btn-icon btn-success rtl">
                                        <i class="glyphicon glyphicon-search "></i> بررسی
                                    </button>
                                    <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                                </p>
                                <input type="hidden" name="company_type" value="<?php echo $list['company_type']; ?>">
                                <input type="hidden" name="action" value="checkCompany">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#licence_type").on('change', function() {
        if ($(this).val() == '0') {
            $("#licence_box").html(
                "<div class='form-group'>" +
                "<label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='licenceTypeName'>توضیحات جواز:</label>" +
                "<div class='col-xs-12 col-sm-8 pull-right'>" +
                "<input type='text' class='form-control' name='licenceTypeName' id='licenceTypeName' value='' required>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
        } else {
            $("#licence_box").html("");
        }

    });
</script>