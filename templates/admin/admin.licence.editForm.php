<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش مجوز جدید</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list);?>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش مجوزها</h3>
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
                                                        <?= ($list['licence_type'] == $value['Licence_list_id']) ? "selected" : '' ?>> <?= $value['name'] ?>
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
                                                    value="<?= $list['licence_number'] ?>" required>
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
                                                    value="<?= $list['description'] ?>" required>
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
                                                    required value="<?= $list['name'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                                for="family">نام خانوادگی صاحب جواز:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                            <input type="text" class="form-control" name="family" id="family"
                                                    required value="<?= $list['family'] ?>">
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
                                                    value="<?= $list['national_code'] ?>" maxlength="10" minlength="10">
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
                                                    required value="<?= $list['exporter_refrence'] ?>">
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
                                                    value="<?= $list['issuence_date'] ?>">
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
                                                    value="<?= $list['expiration_date'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group Cropper">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl" for="xImagePath">تصویر:</label>
                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                        <div class="docs-buttons">
                                            <div class="img-container upload-msg">
                                                <img class="image-banner width" src="<?= (trim($list['image'])!='')? COMPANY_ADDRESS.$list['company_id']."/licence/".$list['image']:  RELA_DIR . "templates/admin/assets/img/placeholder.png" ?>" alt="Picture">
                                            </div>
                                            <div class="btn-block mt">
                                                <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage-banner" title="Upload image file">
                                                    <input type="file" class="sr-only" id="inputImage-banner" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                    <input class="result-cropBanner" type="hidden" name="licenceImage" value="">
                                                    <span class="docs-tooltip pull-right"  data-animation="false" title="Import image with Blob URLs">
                                                          <span>
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </span>
                                                        <span> بارگذاری تصویر</span>
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
                                <div class="checkbox">
                                    <label> <input name="remove_image" type="checkbox"> حذف تصویر </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="edit"/>
                                    <input name="Licence_id" type="hidden" id="Licence_id" value="<?= $list['Licence_id'] ?>"/>
                                    <input name="company_id" type="hidden" id="company_id" value="<?= $list['company_id'] ?>"/>
                                    <button type="submit" name="submit" id="submit" class="btn btn-icon btn-success rtl">
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

<script>
    $(function () {

        $(function () {
            var $dataX = $('#dataX');
            var $dataY = $('#dataY');
            var $dataHeight = $('#dataHeight');
            var $dataWidth = $('#dataWidth');
            var $dataRotate = $('#dataRotate');
            var $dataScaleX = $('#dataScaleX');
            var $dataScaleY = $('#dataScaleY');

            var options = {
                width: 150,
                height: 150,
                restore: false,
                aspectRatio: 1 / 1,
                crop: function (e) {
                    $dataX.val(Math.round(e.x));
                    $dataY.val(Math.round(e.y));
                    $dataHeight.val(Math.round(e.height));
                    $dataWidth.val(Math.round(e.width));
                    $dataRotate.val(e.rotate);
                    $dataScaleX.val(e.scaleX);
                    $dataScaleY.val(e.scaleY);
                }
            };
            var cropperBanner = $('.image-banner'); // banner


            function readURL(input, cropInstance) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.img-container .image-banner').attr('src', e.target.result);
                        cropInstance.cropper('destroy');
                        cropInstance.cropper(options);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }



            $("#inputImage-banner").change(function () {
                readURL(this, cropperBanner);
            });


            cropperBanner.on('cropend', function (e) {
                var result = cropperBanner.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
            });


            cropperBanner.on('zoom', function (e) {
                var result = cropperBanner.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
            });


            cropperBanner.on('ready', function (e) {
                var result = cropperBanner.cropper('getCroppedCanvas', {fillColor: '#fff'});
                $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
            });

            /*      $('.upload-result-banner').on('click', function (e) {
             var image = $('.result-cropBanner').val();
             var modal_banner = $('#myModal-banner');
             $.post('/member/companyBanner/edit/', {image: image}, function (data) {
             var response = $.parseJSON(data);

             if (response.result == -1) {
             $.iziToastError(response.msg);
             return;
             } else {
             $('.my-imgcrop-banner').attr('src', response.image);
             }
             $('.image-banner').attr('src', '');
             modal_banner.modal('hide');
             });
             });*/

        });
    });

</script>














