<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> افزودن تلفن جدید</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم تلفن تولیدی</h3>
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
        <?php if ($msg != null) {
            ?>
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
                            <!-- phone container -->
                            <div id="phone-container">
                                <?php foreach ($list['company_phone']['subject'] as $i => $value) { ?>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                        for="phone_subject">موضوع:</label>
                                                <div class="col-xs-12 col-sm-8 pull-right">
                                                    <input type="text" class="form-control"
                                                            name="company_phone[subject][]" id="phone_subject"
                                                            value="<?= $list['company_phone']['subject'][$i] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                        for="phone_number">شماره تلفن</label>
                                                <div class="col-xs-12 col-sm-8 pull-right">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="phone_number"
                                                                name="company_phone[number][]"
                                                                value="<?= $list['company_phone']['number'][$i] ?>">
                                                        <div class="input-group-addon">+98</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-8 pull-right">
                                                    <select name="company_phone[state][]" class="select-phone-state">
                                                        <option
                                                                value="داخلی" <?= ($list['company_phone']['state'][$i]) == 1 ? 'selected' : '' ?>>
                                                            داخلی
                                                        </option>
                                                        <option
                                                                value="الی" <?= ($list['company_phone']['state'][$i]) == 2 ? 'selected' : '' ?>>
                                                            الی
                                                        </option>
                                                        <option value="" >
                                                            سایر
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <div class="form-group">
                                                <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                        for="phone_value">مقدار</label>
                                                <div class="col-xs-12 col-sm-8 pull-right">
                                                    <input type="text" class="form-control" id="phone_value"
                                                            name="company_phone[value][]"
                                                            value="<?= $list['company_phone']['value'][$i] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-1">
                                            <div class="form-group">
                                                <div class="col-xs-12 col-sm-12 pull-right">
                                                    <a href="#"
                                                            class="btn btn-sm btn-block btn-danger btn-remove-phone-container">
                                                        <i class="fa fa-trash"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-2 pull-right">
                                    <div class="form-group width2">
                                        <a href="#" id="btn-add-phone-container" class="btn btn-sm btn-block btn-info">
                                            <i class="fa fa-plus"></i> افزودن شماره تلفن </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right margin-right">
                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="add"/>
                                        <input name="company_id" type="hidden" id="company_id"
                                                value="<?= $list['company_id'] ?>"/>
                                        <input name="branch_id" type="hidden" id="branch_id"
                                                value="<?= $list['branch_id'] ?>"/> <i class="fa fa-plus"></i> ثبت
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















