<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش آدرس تولیدی </a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم آدرس</h3>
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
                <?php echo $msg ?>
            </div>
        <?php
        }
        ?>
        <div class="panel-body">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-8  center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-1">
                                <div class="form-group">
                                    <select name="isMain">
                                        <option value="1" <?php if ($list['isMain'] == 1) echo "selected" ?>>اصلی</option>
                                        <option value="0" <?php if ($list['isMain'] == 0) echo "selected" ?>>غیر اصلی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="subject">موضوع :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="subject" id="subject" required value="<?php echo $list['subject'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="address">آدرس :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="address" id="address" required value="<?php echo $list['address'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="location">location :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control ltr" name="location" id="location" value="<?php echo $list['location'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right margin-right">
                                    <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="edit" />
                                        <input name="company_id" type="hidden" id="company_id" value="<?php echo $list['company_id'] ?>" />
                                        <input name="branch_id" type="hidden" id="branch_id" value="<?php echo $list['branch_id'] ?>" />
                                        <input name="Addresses_id" type="hidden" id="َAddresses_id" value="<?php echo $list['Addresses_id'] ?>" />
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