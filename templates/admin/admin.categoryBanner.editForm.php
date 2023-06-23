<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-tasks"></i> ویرایش بنر دسته بندی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش بنر دسته</h3>
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
                            autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="title">عنوان:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="title" id="title"
                                                autocomplete="off" required="required" value="<?= $list['title'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="subject">توضیحات:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="description" id="description"
                                                autocomplete="off" required="required"
                                                value="<?= $list['description'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="category_id">دسته بندی :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select class="valid" name="category_id" id="category_id">
                                            <?
                                            foreach ($list['category'] as $key => $value) {
                                                ?>
                                                <option <?= ($list['category_id'] == $value['Category_id']) ? ' selected' : ''; ?>
                                                        value="<?= $value['Category_id'] ?>">
                                                    <?= $value['title'] ?>
                                                </option>
                                                <?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="col-md-3">
                            <img src="<?= COMPANY_ADDRESS . "banner/" . $list['image'] ?>"
                                    class="img-responsive img-thumbnail" alt="Responsive image">
                            <h4 style="direction:ltr"><?= $list['image'] ?></h4>
                        </div>
                        <div class="row">
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image" class="" type="file" value="انتخاب فایل"/>
                                        </div>
                                        <div id="preview" style="display:none">
                                            <strong>Selected Thumbnails</strong>
                                            <div id="thumbnails"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right margin-right">
                                        <input name="action" type="hidden" id="action" value="edit"/>
                                        <input name="Category_banner_id" type="hidden" id="action"
                                                value="<?= $list['Category_banner_id']; ?>"/>
                                        <button type="submit" name="update" id="submit"
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