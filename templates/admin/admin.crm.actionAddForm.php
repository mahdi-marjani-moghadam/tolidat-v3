<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24">افزودن نحوه ارسال<i class="sidebar-icon fa fa-info"></i></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم نحوه ارسال </h3>
            <div class="panel-actions">
                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>
                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
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
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row" id="history-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="action">نحوه ارسال:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="action" id="action"
                                                   placeholder=" نحوه ارسال " required value=""></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="message">پیام:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <textarea name="message" class="form-control" id="message"
                                                      placeholder="پیام" required="required" rows="10" cols="20"></textarea>
                                        </div>
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
