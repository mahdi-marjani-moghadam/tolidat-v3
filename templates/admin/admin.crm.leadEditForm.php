<style>
    li.select2-search-choice div {
        margin-right: 15px;
    }
</style>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24">ویرایش لید<i class="sidebar-icon fa fa-info"></i></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش لید </h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form method="post" role="form" data-validate="form" novalidate="novalidate" enctype="multipart/form-data">
                        <div class="col-md-6 form-group pull-right">
                            <label for="company_name">نام شرکت :</label>
                            <input class="col-md-12" type="text" name="company_name" id="company_name" value="<?=$list['company_name']?>">
                        </div>

                        <div class="col-md-6 form-group pull-right">
                            <label for="name">نام فرد :</label>
                            <input class="col-md-12" type="text" name="name" id="name" value="<?=$list['name']?>">
                        </div>

                        <div class="col-md-6 form-group pull-right">
                            <label for="mobile">شماره موبایل :</label>
                            <input class="col-md-12" type="text" name="mobile" id="mobile" value="<?=$list['mobile']?>">
                        </div>

                        <div class="col-md-6 form-group pull-right">
                            <label for="phone">شماره ثابت :</label>
                            <input class="col-md-12" type="text" name="phone" id="phone" value="<?=$list['phone']?>">
                        </div>

                        <div class="col-md-6 form-group pull-right">
                            <label for="company_type">نوع کمپانی :</label>
                            <select name="company_type" id="company_type">
                                <option value="1" <?php echo ($list['company_type'] == 1 ? 'selected' : '')?>">حقوقی</option>
                                <option value="2" <?php echo ($list['company_type'] == 2 ? 'selected' : '')?>>حقیقی</option>
                            </select>
                        </div>

                        <div class="col-md-6 form-group pull-left">
                            <input class="col-md-6 btn btn-success pull-left" type="submit" value="ذخیره">
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
</div>

<script>
    $(function () {
        // selecting options from select element
        var action_id = '<?= json_encode($list['letter_action']) ?>';
        $.each($.parseJSON(action_id), function (key, value) {
            $('.letter-action').find('option[value="' + value.action_id + '"]').attr('selected', true);
        });
    });
</script>