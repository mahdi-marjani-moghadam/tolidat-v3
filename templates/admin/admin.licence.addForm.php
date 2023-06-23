<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> افزودن مجوز جدید</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list); ?>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم افزودن مجوز</h3>
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
                        <div id="LicenceBox">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="licence">نوع جواز:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <select name="licence_type" id="licence_type" data-input="select2">
                                                <option></option>
                                                <? foreach ($list['licence'] as $key => $value) { ?>
                                                    <option value="<?= $value['Licence_list_id'] ?>"
                                                        <?= ($list['licenceInfo']['licence_type'] == $value['Licence_list_id']) ? "selected" : '' ?>> <?= $value['name'] ?>
                                                    </option>
                                                <? } ?>
                                                <option value="0">غیره</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="licence_box" class="col-xs-12 col-sm-12 col-md-6">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4  col-md-4 pull-right control-label rtl"
                                                for="licence_number">شماره جواز:</label>
                                        <div class="col-xs-12 col-sm-8  col-md-8  pull-right">
                                            <input type="text" class="form-control" name="licence_number"
                                                    id="licence_number"
                                                    value="<?= $list['licenceInfo']['licence_number'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4  col-md-4 pull-right control-label rtl"
                                                for="description">فعالیت جواز:</label>
                                        <div class="col-xs-12 col-sm-8  col-md-8  pull-right">
                                            <input type="text" class="form-control" name="description"
                                                    id="description"
                                                    value="<?= $list['licenceInfo']['description'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                                for="name">نام صاحب جواز:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                            <input type="text" class="form-control" name="name" id="name"
                                                    required value="<?= $list['licenceInfo']['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                                for="family">نام خانوادگی صاحب جواز:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                            <input type="text" class="form-control" name="family" id="family"
                                                    required value="<?= $list['licenceInfo']['family'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="national_code">کد ملی صاحب جواز:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="national_code"
                                                    id="national_code"
                                                    value="<?= $list['licenceInfo']['national_code'] ?>" maxlength="10" minlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                                for="exporter_refrence">مرجع تایید جواز:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                            <input type="text" class="form-control" name="exporter_refrence"
                                                    id="exporter_refrence"
                                                    required value="<?= $list['licenceInfo']['exporter_refrence'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="issuence_date">تاریخ صدور جواز:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control date" name="issuence_date"
                                                    id="issuence_date"
                                                    value="<?= $list['licenceInfo']['issuence_date'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="expiration_date">تاریخ انقضا جواز:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control date" name="expiration_date"
                                                    id="expiration_date"
                                                    value="<?= $list['licenceInfo']['expiration_date'] ?>">
                                        </div>
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
                                                            <input class="result-crop" type="hidden" name="licenceImage" value="">
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
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right margin-right">
                                    <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="add"/>
                                        <input name="Licence_id" id="Licence_id" type="hidden" value="<?= $list['Licence_id'] ?>"/>
                                        <input name="company_id" type="hidden" id="company_id" value="<?= $list['company_id'] ?>"/>
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
<script>
    $("#licence_type").on('change', function () {
        if ($(this).val() == '0') {
            $("#licence_box").html(
                "<div class='form-group'>" +
                "<label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='licenceTypeName'>توضیحات جواز:</label>" +
                "<div class='col-xs-12 col-sm-8 pull-right'>" +
                "<input type='text' class='form-control' name='licenceTypeName' id='licenceTypeName' value='' required>" +
                "</div>" +
                "</div>" +
                "</div>"
            );
        } else {
            $("#licence_box").html("");
        }

    });
</script>















