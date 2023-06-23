<script type="text/javascript" src="../common/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
    function BrowseServer(startupPath, functionData) {
        var finder = new CKFinder();
        finder.basePath = '../';
        finder.startupPath = startupPath;
        finder.selectActionFunction = SetFileField;
        finder.selectActionData = functionData;

        finder.popup();
    }
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
        <li><a class="rtl text-24">فرم لگو<i class="sidebar-icon fa fa-info"></i></a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">لوگو</h3><br>
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
                <div class="form-group">
                    <div id="preview" style="display:none">
                        <strong>Selected Thumbnails</strong>
                        <div id="thumbnails"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <!--  uploader-->
                        <div class="col-xs-12 col-sm-12 col-md-3 pull-right">
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img class="image-crop" src="<?php echo RELA_DIR . "templates/admin/assets/img/placeholder.png" ?>" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <input class="result-crop" type="hidden" name="companyLogo" value="">
                                        <span class="docs-tooltip pull-right"  data-animation="false" title="Import image with Blob URLs">
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></i></span><span> بارگذاری تصویر</span>
                                        </span>
                                    </label>
                                </div>
                                <!-- Show the cropped image in modal -->
                                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                            </div>
                                            <div class="modal-body"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end uploader-->
                        <div class="row" id="companyLogo-container">
                            <div class="row noMargin">
                                <div class="checkbox">
                                    <label> <input name="remove_image" type="checkbox"> حذف تصویر </label>
                                </div>
                                <div class="row xsmallSpace hidden-xs"></div>
                                <div class="col-md-3">
                                    <img src="<?= COMPANY_ADDRESS . $list['company_id'] . "/logo/" . ($list['image']); ?>" class="img-responsive img-thumbnail" alt="Responsive image">
                                    <h4 style="direction:ltr"><?= $list['image'] ?></h4>
                                </div>
                                <div class="row xsmallSpace hidden-xs"></div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs "></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="add"/>
                                    <input name="company_id" type="hidden" id="company_id" value="<?= $list['company_id'] ?>"/>
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

