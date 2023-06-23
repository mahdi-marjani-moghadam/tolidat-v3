<style>
    li.select2-search-choice div {
        margin-right: 15px;
    }
</style>
<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24">ویرایش نوع اکشن اصلی<i class="sidebar-icon fa fa-info"></i></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش نوع اکشن اصلی </h3>
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
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row" id="history-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="action">نوع اکشن اصلی:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="type" id="action"
                                                   placeholder=" نوع اکشن اصلی " required value="<?= $list['letter']['type'] ?>"></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="action">انتخاب نحوه ارسال:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select name="letter_action[]" multiple="multiple" class="letter-action" id="letter_action">
                                                <?php foreach ($list['actions'] as $action) : ?>
                                                    <option value="<?= $action['letter_action_id'] ?>"
                                                    <?= $action['letter_action_id'] == $list ?>>
                                                        <?= $action['action'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- -->
                <div class="row xsmallSpace hidden-xs"></div>
                <div class="row">
                    <div class="col-md-10">
                        <p class="pull-left">
                            <input type="hidden" name="letter_id" value="<?= $list['letter']['letter_id'] ?>">
                            <button type="submit" name="submit" id="submit" class="btn btn-icon btn-success rtl">
                                <i class="fa fa-plus"></i>ثبت
                            </button>
                            <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                        </p>
                    </div>
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