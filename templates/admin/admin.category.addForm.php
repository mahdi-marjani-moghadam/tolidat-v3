<!-- <script type="text/javascript" src="../common/ckfinder/ckfinder.js"></script> -->
<script type="text/javascript">
    // function BrowseServer(startupPath, functionData) {
    //     var finder = new CKFinder();
    //     finder.basePath = '../';
    //     finder.startupPath = startupPath;
    //     finder.selectActionFunction = SetFileField;
    //     finder.selectActionData = functionData;

    //     finder.popup();
    // }

    function SetFileField(fileUrl, data) {
        document.getElementById(data["selectActionData"]).value = fileUrl;
    }

    function ShowThumbnails(fileUrl, data) {
        // this = CKFinderAPI
        var sFileName = this.getSelectedFile().name;
        document.getElementById('thumbnails').innerHTML +=
            '<div class="thumb">' +
            '<img src="' + fileUrl + '" />' +
            '<div class="caption">' +
            '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
            '</div>' +
            '</div>';

        document.getElementById('preview').style.display = "";
        // It is not required to return any value.
        // When false is returned, CKFinder will not close automatically.
        return false;
    }
</script>

<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-tasks"></i> افزودن دسته بندی جدید</a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم دسته بندی</h3>
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
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="title" id="title" autocomplete="off" required="required" value="<?php echo $list['title'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="parent_id">دسته بندی والد:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select class="valid" name="parent_id" id="parent_id">
                                            <option value="0">والد ندارد</option>
                                            <?php
                                            foreach ($list['category'] as $category_id => $value) {
                                            ?>
                                                <option <?php echo $value['Category_id'] == $list['parent_id'] ? 'selected' : '' ?> value="<?php echo  $value['Category_id'] ?>">
                                                    <?php echo  $value['export'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="alt">توضیح عکس:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="alt" id="alt" autocomplete="off" value="<?php echo  $list['alt'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="url">آدرس اینترنتی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin ltr" required name="url" id="url" autocomplete="off" value="<?php echo  $list['url'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="sort">ترتیب:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="sort" id="sort" autocomplete="off" placeholder="sort" value="<?php echo  $list['sort'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_keyword">کلمات کلیدی:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <textarea name="meta_keyword" class="form-control fullFix" id="meta_keyword" autocomplete="off" placeholder="meta_keyword"><?php echo  $list['meta_keyword'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <h4>عکس اصلی :</h4>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image-main" class="" type="file" value="انتخاب فایل" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4>عکس 1 : 140 * 213.33 :</h4>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image-1" class="" type="file" value="انتخاب فایل" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4>عکس 2 : 140 * 446.67 :</h4>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image-2" class="" type="file" value="انتخاب فایل" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4>عکس 3 : 300 * 213.33 :</h4>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image-3" class="" type="file" value="انتخاب فایل" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4>عکس 4 : 300 * 446.67 :</h4>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image-4" class="" type="file" value="انتخاب فایل" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                                <p>
                                    <label for="body">متن رویداد :</label>
                                    <?php echo $list['body'] ?>
                                </p>

                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pull-right margin-right">
                                        <input name="action" type="hidden" id="action" value="add" />
                                        <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                            <i class="fa fa-plus"></i> ثبت
                                        </button>
                                        <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>