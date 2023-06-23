<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش وب سایت تولیدی </a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم وب سایت</h3>
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
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="row bordered-box">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="">موضوع:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="subject" id="subject" value="<?php echo($list['subject']); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-8">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">آدرس وب سایت</label>
                                        <div class="col-xs-12 col-sm-9 pull-right">
                                            <input type="text" class="form-control valid" id="url" name="url" value="<?php echo($list['url']); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right margin-right">
                                        <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                            <input name="action" type="hidden" id="action" value="edit"/>
                                            <input name="company_id" type="hidden" id="company_id" value="<?= $list['company_id'] ?>"/>
                                            <input name="branch_id" type="hidden" id="branch_id" value="<?= $list['branch_id'] ?>"/>
                                            <input name="Websites_id" type="hidden" id="Websites_id" value="<?= $list['Websites_id'] ?>"/>
                                            <i class="fa fa-plus"></i>ویرایش
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