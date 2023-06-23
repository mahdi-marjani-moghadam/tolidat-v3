<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24">ویرایش پروانه کسب<i class="sidebar-icon fa fa-info"></i></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list)?>
<?php //print_r_debug($list['list']['subject'])?>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl"> فرم پروانه کسب</h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl"
                        data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>
            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->
        <?php if ($msg != null) { ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 alert alert-warning">
                <?= $msg ?>
            </div>
            <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal"
                            novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="subject">عنوان:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="social_type_id" id="subject" data-input="select2">
                                            <option></option>
                                            <?php
                                            foreach ($list['socials'] as $key => $value) {
                                                ?>

                                            <option value="<?= $value['Social_type_id'] ?>" <?= $value['Social_type_id'] == $list['list']['Social_type_id'] ? "selected " : ""; ?>>
                                                <?php echo $value['type'] ?>
                                                </option><?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="url">توضیحات:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="url" id="url"
                                                placeholder="آدرس" required value="<?= $list['list']['url'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="edit"/>
                                    <input name="Socials_id" type="hidden" id="Social_id"
                                            value="<?php echo $list['list']['Socials_id'] ?>"/>
                                    <input name="company_id" type="hidden" id="company_id"
                                            value="<?php echo $list['company_id'] ?>"/>
                                    <input name="branch_id" type="hidden" id="branch_id"
                                            value="<?php echo $list['branch_id'] ?>"/>
                                    <button type="submit" name="submit" id="submit"
                                            class="btn btn-icon btn-success rtl">
                                        <i class="fa fa-plus"></i> ثبت
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
