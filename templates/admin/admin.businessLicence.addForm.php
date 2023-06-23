<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24">افزودن پروانه کسب</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم پروانه کسب </h3><br>
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
                        <div class="row" id="businessLicence-container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="title" id="title"
                                                    placeholder=" عنوان " required value=""></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">توضیحات:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <textarea name="description" class="form-control" id="description"
                                                    placeholder="توضیحات" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row xsmallSpace hidden-xs"></div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <div class="row noMargin">
                                                <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl" for="xImagePath">تصویر:</label>
                                                <div class="col-xs-12 col-sm-12 col-md-8">
                                                    <div class="docs-buttons">
                                                        <div class="img-container upload-msg">
                                                            <img class="image-crop" src="<?php echo RELA_DIR . "templates/admin/assets/img/placeholder.png" ?>" alt="Picture">
                                                        </div>
                                                        <div class="btn-block mt">
                                                            <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                                                <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                                <input class="result-crop" type="hidden" name="businessImage" value="">
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
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row noMargin">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="add"/>
                                    <input name="company_id" type="hidden" id="company_id"
                                            value="<?= $list['company_id'] ?>"/>
                                    <button type="submit" name="submit" id="submit"
                                            class="btn btn-icon btn-success rtl">
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
