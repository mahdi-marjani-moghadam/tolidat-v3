<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li>
            <a class="rtl text-24"><i class="sidebar-icon fa fa-newspaper-o"></i> افزودن رویداد جدید</a>
        </li>
    </ul><!--/control-nav-->

</div><!-- /content-control -->

<div class="content-body">

    <div id="panel-tablesorter" class="panel panel-warning">

        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم رویداد</h3>
            <div class="panel-actions">

                <button data-expand="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="تمام صفحه">
                    <i class="fa fa-expand"></i>
                </button>

                <button data-collapse="#panel-tablesorter" title="" class="btn-panel rtl" data-original-title="باز و بسته شدن">
                    <i class="fa fa-caret-down"></i>
                </button>

            </div><!-- /panel-actions -->
        </div><!-- /panel-heading -->

        <?php if (isset($message)) { ?>

            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>
                    <?php foreach ($message as $msg) { echo $msg; } ?>
                </strong>
            </div>

            <?php } ?>

        <div class="panel-body">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8  center-block noPadding">

                    <form name="queue" id="queue" data-validate="form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        <!-------------------------- Title & Meta-Description Section -------------------------->

                        <div class="row">

                            <!-------------------------- Title Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="title">عنوان :</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="title" id="title" required value="<?= $event['title'] ?>">
                                    </div>

                                </div>
                            </div>

                            <!-------------------------- KeyWord Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_keyword">کلمات کلیدی:</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input class="form-control" name="meta_keyword" id="meta_keyword" value="<?= $event['meta_keyword'] ?>" data-error="لطفا کلمه کلیدی را وارد نمایید" data-role="tagsinput">
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <!-------------------------- Date & Meta-Description Section -------------------------->

                        <div class="row">

                            <!-------------------------- Date Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="date">تاریخ :</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input class="form-control date" name="date" id="date" value="<?= $event['date'] ?>">
                                    </div>

                                </div>
                            </div>

                            <!-------------------------- Category Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="category">دسته بندی :</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="category" id="category" disabled>
                                            <?php foreach ($event['category'] as $key => $category) { ?>
                                                <option value="<?= $key ?>"> <?= $category ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <!-------------------------- Image & brief_description Section -------------------------->

                        <div class="row">

                            <!-------------------------- Meta-Description Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_description"> توضیحات کلیدی :</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <textarea class="form-control" name="meta_description" id="meta_description" required><?= $event['meta_description'] ?></textarea>
                                    </div>

                                </div>
                            </div>

                            <!-------------------------- brief_description Section -------------------------->

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="brief_description"> مختصر توضیحات :</label>

                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <textarea class="form-control" name="brief_description" id="brief_description" cols="15" required><?= $event['brief_description'] ?></textarea>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-------------------------- Body and Image Section -------------------------->

                        <div class="row">

                            <!-------------------------- Image Section -------------------------->

                        <!--    <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="xImagePath">تصویر :</label>

                                    <div class="input-group">
                                        <input class="btn btn-info" name="icon" id="icon" type="file" value="انتخاب فایل" required>
                                    </div>

                                    <br>

                                    <img src="<?/*= $event['image-path'] */?>" alt="<?/*= $event['name'] */?>" id="icon-preview" style="width: 100%; height: 70%;">

                                    <br>

                                    <div id="icon-name" class="form-control" style="direction:ltr; text-align:center; font-family: 'Times New Roman'; font-size: 1.5em">
                                        <?/*= $event['image'] */?>
                                    </div>

                                </div>

                            </div>-->
                            <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                                <p>
                                    <label for="body">متن رویداد :</label>
                                    <?= $event['body'] ?>
                                </p>

                            </div>

                            <label class="col-xs-12 col-sm-4 col-md-12 pull-right control-label rtl" for="editor_phone">تصویر آیکن:</label>
                            <div class="col-xs-12 col-sm-12 col-md-4 noPadding">

                                <div class="docs-buttons">
                                    <div class="img-container upload-msg">
                                        <img class="image-crop" src="<?= RELA_DIR . 'templates/template_fa/assets/images/placeholder.png'; ?>" alt="Picture">
                                    </div>
                                    <div class="btn-block mt">
                                        <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                            <input type="file" class="sr-only " id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                            <input class="result-crop" type="hidden" name="eventImage" value="">
                                            <span class="docs-tooltip pull-right" data-animation="false" title="Import image with Blob URLs">
                                    <span><i class="fa fa-pencil"
                                             aria-hidden="true"></i></i></span><span> بارگذاری تصویر</span>
                                </span> </label>
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                    </button>
                                                    <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-------------------------- Body Section -------------------------->



                        </div>

                        <hr>

                        <!-------------------------- Gallery Section -------------------------->

                        <div class="col-xs-12 col-sm-12 col-md-12 noPadding">
                            <div class="row">
                                <div id="gallery-container">

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-2 pull-right">
                                <div class="form-group width2">
                                    <a href="#" id="add-image" class="btn btn-sm btn-block btn-info">
                                        <i class="fa fa-plus"> افزودن عکس گالری </i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <!-------------------------- Input Section -------------------------->

                        <input type="submit" class="btn btn-success" name="action" id="action" value="store">
                        <a id="goBack" onclick="backTo()" class="btn btn-icon btn-primary rtl">بازگشت</a>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function(){

        $('#category').select2();

        var cnt = 1;
        $('#add-image').on('click',function(e){
            e.preventDefault();
            var defaultImage = "<?= RELA_DIR ?>" + "templates\\images\\logo1.png";

            var row =
                '<div class="row">'+
                '<div class="row col-xs-12 col-sm-12 col-md-12 noMargin">' +
                    '<div class="col-xs-12 col-sm-12 col-md-4 noPadding">' +
                        '<div class="docs-buttons cropper-parent">' +
                            '<div class="img-container upload-msg">' +
                                '<img class="image-crop1" src="'+defaultImage+'" alt="Picture">' +
                            '</div>' +
                            '<div class="btn-block mt">' +
                                '<label class="btn-block btn btn-success uploud-btnProCrop pull-right mb" for="input'+cnt+'" title="Upload image file">' +
                                    '<input type="file" class="sr-only uploadImg" id="input'+cnt+'" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">' +
                                    '<input class="result-crop1" type="hidden" name="gallery'+cnt+'" value="">' +
            '<span class="docs-tooltip pull-right" data-animation="false" title="Import image with Blob URLs">' +
            '<span><i class="fa fa-pencil" aria-hidden="true"></i></i></span><span> بارگذاری تصویر</span></span>' +
            '</label>' +
            '</div>' +
                            '<div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">' +
                                '<div class="modal-dialog">' +
                                    '<div class="modal-content">' +
                                        '<div class="modal-header">' +
                                            '<h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>' +
                                        '</div>' +
                                        '<div class="modal-body"></div>' +
                                        '<div class="modal-footer">' +
                                            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' +
                                            '<a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-12 col-sm-5 col-md-5">' +
                        '<div class="form-group">' +
                            '<label class="col-xs-12 col-sm-3 pull-right control-label rtl" for="">توضیحات</label>' +
                            '<div class="col-xs-12 col-sm-9 pull-right">' +
                                '<textarea class="form-control" name="description'+cnt+'" id="description" cols="15" required></textarea>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +

                    '<div class="col-xs-12 col-sm-2 col-md-2">' +
                        '<div class="form-group">' +
                            '<div class="col-xs-12 col-sm-12 pull-right">' +
                                '<a href="#" class="btn btn-sm btn-block btn-danger" id="remove-image">' +
                                    '<i class="fa fa-trash"></i>' +
                                '</a>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
            '</div>';


            $('#gallery-container').append(row);

            cnt++;
        });

        /* Removing the Image Tag*/

        $(document).on('click','#remove-image',function(e){
            e.preventDefault();
            var length = $('#gallery-container .row').length;

            if(length > 0) {
                $(this).parent().parent().parent().parent('.row').remove();
            }

        });

        /*
        * ---------------------------------------------------------------------------------
        *  -------------------- Load Gallery Images Before Uploaded ---------------------
        * ---------------------------------------------------------------------------------
        */
        $(document).on("change", "#gallery", function(){

            var selectorThis = $(this);
            var files = !!this.files ? this.files : [];

            // Check if File is selected, or no FileReader support
            if (!files.length || !window.FileReader) return;

            //  Allow only image upload
            if (/^image/.test( files[0].type)){
                // Create instance of the FileReader
                var ReaderObj = new FileReader();
                // read the file uploaded
                ReaderObj.readAsDataURL(files[0]);
                // set uploaded image data as background of div
                ReaderObj.onloadend = function(){
                    selectorThis.parent().parent().parent().find('#gallery-preview').attr('src', this.result);
                }
            } else {
                alert("Upload an image");
            }
        });


        /*
        * --------------------------------------------------------------------------------
        *  -------------------------- Load Icon Before Upload ---------------------------
        * --------------------------------------------------------------------------------
        */
        $("#icon").on("change", function(){

            var files = !!this.files ? this.files : [];

            if (!files.length || !window.FileReader) return; // Check if File is selected, or no FileReader support

            //  Allow only image upload
            if (/^image/.test( files[0].type)){
                // Create instance of the FileReader
                var ReaderObj = new FileReader();
                // read the file uploaded
                ReaderObj.readAsDataURL(files[0]);
                // set uploaded image data as background of div
                ReaderObj.onloadend = function(){
                    $('#icon-preview').attr('src', this.result);
                    $('#icon-name').html('');
                    $('#icon-name').append(files[0].name);
                }
            } else {
                alert("Upload an image");
            }
        });

    });
</script>
