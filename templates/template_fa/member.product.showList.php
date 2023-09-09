<div class="row xxsmallSpace crop"></div>

<!--container iziToast-->
<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<!--title-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span data-intro="تیتر محصولات" class="title-pro">محصولات/خدمات</span>
            <button data-position="right" data-intro="اضافه کردن محصول" id="addForm" type="button" <?php //echo($list['product_count'] >= $list['all_product_count'] ? 'disabled' : '') 
                                                                                                    ?> class="btn btn-sm pull-left add-btnPro">
                <i class="fa fa-plus transition bc-color-green" aria-hidden="true"></i>
                <span class="transition">افزودن محصول</span>
                <input class="meta_keyword_count" type="hidden" value="<?php echo $list['all_keyword_count'] ?>">
            </button>
        </div>
    </div>
</div>

<!--box dynamic-->
<div class="row xsmallSpace"></div>
<div class="row add-product">
    <?php if (isset($list['list']) && count($list['list'])) : ?>
        <?php foreach ($list['list'] as $id => $fields) : ?>
            <div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-product" data-value="<?php echo  $fields['Product_d_id'] ?>">
                <div data-intro="لیست محصولات" class="contentPro<?php echo ($fields['status'] == 1) ? '' : ' disable' ?> whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                    <h3>
                        <div class="kebabMenu">
                            <a><i class="icon-kebab-menu" aria-hidden="true"></i></a>
                            <ul class="kebab-menu-content roundCorner boxBorder">
                                <li>
                                    <a class="link-edit" data-value="<?php echo  $fields['Product_d_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a>
                                </li>
                                <li>
                                    <a class="link-trash" data-value="<?php echo  $fields['Product_d_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a>
                                </li>
                                <li>
                                    <a class="link-addPicture" data-value="<?php echo  $fields['Product_d_id'] ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i><span> گالری محصول</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo">
                            <img name="image_ajax" class="boxBorder lazy" data-src="<?php echo $fields['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/product/" . $fields['image'] : DEFULT_PRODUCT_ADDRESS ?>" alt="">
                        </div>
                        <span class="title"><?php echo $fields['title'] ?></span>
                        <span class="i-date"><i class="fa fa-calendar"></i><?php echo convertDate(substr($fields['date'], 0, 10)) ?></span>
                    </h3>
                    <div class="text">
                        <p class="brif_description"><?php echo $fields['brif_description'] ?></p>
                        <p class="description"><?php echo $fields['description'] ?> </p>
                        <span class="submit-msg"><?php echo ($fields['status'] == 1) ? '&#10004; تایید شده' : '&#10006; تایید نشده' ?></span>
                    </div>
                    <ul class="content-description">
                        <?php foreach ($fields['gallery'] as $gallery) : ?>
                            <li data-value="<?php echo  $gallery['product_gallery_id'] ?>">
                                <img class="width boxBorder" src="<?php echo (strlen($gallery['image']) > 0 ? COMPANY_ADDRESS . $fields['company_id'] . "/product/gallery/" . $gallery['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
            <?php endforeach; ?><?php else : ?>
            <div class="notRecord">
                <img class="empty-img center-block" src="<?php echo RELA_DIR; ?>templates/template_tailwind/assets/images/empty01.png">
                <p class="empty-text">اطلاعاتی موجود نیست!</p>
            </div>
        <?php endif; ?>
</div>

<!--Modal add-->
<div class="holder-modal modal-product modal fade container-floatinglabel " id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">افزودن محصول</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body" id="mm">
                <div class="iziAdd-container izi-holder" data-izi="iziAdd-container"></div>

                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="addProduct" class="form addProduct" enctype="multipart/form-data" method="post" data-toggle="validator">
                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-12 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title1">عنوان محصول یا خدمات را وارد نمایید</label>
                                <input name="title" type="text" class="form-control" id="title1" required data-error="لطفا عنوان محصول یا خدمات را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="brif_description1"> توضیح مختصر مربوطه را وارد نمایید</label>
                                <input data-minWord="10" name="brif_description" type="text" class="form-control progressText" id="brif_description1" required data-error="لطفا توضیح مختصر را وارد کنید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="description1">توضیح کامل مربوطه را وارد نمایید.</label>
                                <textarea data-minWord="151" name="description" class="description progressText form-control" rows="3" id="description1" required data-error="لطفا توضیح کامل مربوطه را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="priority"> عدد اولویت را وارد نمایید</label>
                                <input name="priority" type="text" class="form-control" id="priority" required data-error="لطفا اولویت محصول یا خدمات را وارد نمایید">
                            </div>


                            <div class="form-group mb">
                                <p class="color-red">تعداد مجاز کلمات کلیدی: <span>4</span> </p>
                                <input name="meta_keyword" type="text" data-error="لطفا کلمه کلیدی را وارد نمایید" placeholder="کلمات کلیدی مرتبط را وارد نمایید. (بعد از هر کلمه دکمه Enter را بزنید.)" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <span class="titr-logo">عکس مورد نظر را انتخاب نمایید</span>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img class="width image-crop img-cropper" src="<?php echo (isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/image/placeholder.png'); ?>" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <input class="result-crop" type="hidden" name="imageCropped" value="">
                                        <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>انتخاب تصویر</span>
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
                                            <div class="modal-footer noPadding pt">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace"></div>

                    <p class="text-center">لطفا تا حداکثر <?php echo $information_company['packageCategoryCount']; ?> دسته بندی مطابق با نوع محصول یا خدمت خود را از قسمت پایین انتخاب نمایید.</p>

                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right profile-editForm">
                            <div class="search-box search-box1 boxBorder categoryContainer key-index">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header>دسته بندی ها<i class="fa fa-bars" aria-hidden="true"></i>
                                        <div class="limit-package">
                                            <p>تعداد دسته های مجاز: <span class="text-danger"><?php echo $information_company['packageCategoryCount']; ?></span></p>
                                            <ul>
                                                <li><?php echo $information_company['packageCategoryCount']; ?></li>
                                                <li>/</li>
                                                <li class="updateAllowedCat">0</li>
                                            </ul>
                                        </div>
                                    </header>
                                </div>
                                <div class="mmenuHolder active full-size">
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها">
                                        <?php echo  $list['categoryAdd']; ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right profile-editForm">
                            <div class="container-view boxBorder">
                                <header>دسته های انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>
                            <input type="hidden" class="maxCanSelected" value="<?php echo $list['packageCompany']['category']; ?>">
                            <input type="hidden" class="selectedCategories" value="">

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                    </div>
                    <div class="addCategory errorHandler text-center text-danger"></div>
                    <div class="modal-footer noPadding pt">
                        <button type="submit" id="add" class="btn btn-success btn-sm">ذخیره مورد جدید</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal Edit-->
<div class="holder-modal modal-product modal fade container-floatinglabel" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title roundCorner" id="myModalLabel">ویرایش محصول</h5>
                <p id="message"></p>
            </div>
            <div class="modal-body">
                <div class="iziEdit-container izi-holder" data-izi="iziEdit-container"></div>
                <!-- separator -->
                <div class="row xxxsmallSpace"></div>

                <form id="editProduct" class="form addProduct" enctype="multipart/form-data" method="post">
                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                            <div class="form-group mb">
                                <label for="title2">عنوان را وارد نمایید</label>
                                <input name="title" type="text" class="form-control" id="title2" required data-error="لطفا عنوان را وارد نمایید">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="brif_description2">لطفا توضیح کوتاه را وارد نمایید</label>
                                <input data-minWord="6" name="brif_description" type="text" class="form-control progressText" rows="3" id="brif_description2">
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="description2">توضیحات را وارد نمایید</label>
                                <textarea data-minWord="6" name="description" class="description form-control progressText" rows="3" id="description2" data-error="لطفا توضیحات را وارد نمایید"></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <input name="meta_keyword" value="" type="text" id="" placeholder="کلمه کلیدی را وارد نمایید" data-role="edittagsinput">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <span class="titr-logo">عکس مورد نظر را ویرایش نمایید</span>
                            <div class="docs-buttons">
                                <div class="img-container upload-msg">
                                    <img name="image_tmp" class="width image-crop img-cropper" src="" alt="Picture">
                                </div>
                                <div class="btn-block mt">
                                    <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImage-edit" title="Upload image file">
                                        <input type="file" class="sr-only" id="inputImage-edit" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                        <input class="result-crop" type="hidden" name="imageCropped" value="">
                                        <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                            <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>ویرایش تصویر</span>
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
                                            <div class="modal-footer noPadding pt">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row xxsmallSpace"></div>

                    <p class="text-center">لطفا تا حداکثر<?php echo $information_company['packageCategoryCount']; ?> دسته بندی مطابق با نوع محصول یا خدمت خود را از قسمت پایین انتخاب نمایید.</p>

                    <div class="row noMargin">
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right profile-editForm">
                            <div class="search-box search-box1 boxBorder categoryContainer">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header>دسته بندی ها<i class="fa fa-bars" aria-hidden="true"></i>
                                        <div class="limit-package">
                                            <p>تعداد دسته های مجاز: <span class="text-danger"><?php echo $information_company['packageCategoryCount']; ?></span></p>
                                            <ul>
                                                <li><?php echo $information_company['packageCategoryCount']; ?></li>
                                                <li>/</li>
                                                <li class="updateAllowedCat">0</li>
                                            </ul>
                                        </div>
                                    </header>
                                </div>
                                <div class="mmenuHolder active full-size">
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها">
                                        <?php echo  $list['categoryEdit']; ?>
                                    </nav>
                                </div>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right profile-editForm">
                            <div class="container-view boxBorder">
                                <header>دسته های انتخاب شده</header>
                                <ul class="selected-category"></ul>
                            </div>
                            <input type="hidden" class="maxCanSelected" value="<?php echo $list['packageCompany']['category']; ?>">
                            <input type="hidden" class="selectedCategories" value="">
                        </div>
                    </div>

                    <div style="text-align: center; color: red" class="editCategory errorHandler"></div>
                    <div class="modal-footer noPadding pt">
                        <input name="Product_d_id" type="hidden">
                        <button type="submit" id="edit" class="btn btn-success btn-sm">ذخیره تغییرات</button>
                        <button type="button" class="btn btn-link text-danger btn-sm" data-dismiss="modal">انصراف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ERROR Modal -->
<div class="modal fade" id="errorModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color: darkred;margin-right: 30px;" class="modal-title"> خطا! </h4>
            </div>
            <div class="modal-body">
                <p style="color: darkred;text-align: center;" class="messageModal"></p>
            </div>
            <div class="modal-footer noPadding pt">
                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal add gallery -->
<div class="holder-modal modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">گالری محصول </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="iziToastAdd-container"></div>

                <form id="addGallery" enctype="multipart/form-data" method="post">
                    <input class="modal-input" type="hidden" name="product_d_id" value="">
                    <div class="content-crop">
                        <div class="docs-buttons">
                            <div class="img-container upload-msg">
                                <img class="width image-crop img-cropper" src="<?php echo (isset($value['image']) ? COMPANY_ADDRESS . $value['Company_id'] . "/logo/" . $value['image'] : '/templates/' . CURRENT_SKIN . '/assets/images/placeholder.png'); ?>" alt="Picture">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 pull-right">
                                    <div class="btn-block mt">
                                        <label class="btn-block btn btn-success uploud-btnProCrop pull-right" for="inputImageGallery" title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImageGallery" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                            <input class="result-crop" type="hidden" name="image" value="">
                                            <span class="docs-tooltip" data-animation="false" title="Import image with Blob URLs">
                                                <span><i class="fa fa-pencil" aria-hidden="true"></i></span> <span>انتخاب تصویر</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 pull-right mb mt">
                                    <button type="submit" id="add" class="btn btn-primary  btn-block addGallery">ذخیره عکس بارگذاری شده</button>
                                </div>
                            </div>


                            <!-- Show the cropped image in modal -->
                            <div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="getCroppedCanvasTitle">Cropped</h5>
                                        </div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer noPadding pt">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="modal-footer mt">
                    <ul class="content-gallery">
                    </ul>
                    <div style="text-align: center; color: red" class="editCategory errorHandler"></div>
                    <button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">انصراف</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!--ajax-->
<script>
    $.iziToastError = function(msg) {
        iziToast.settings({
            onOpen: function(e) {}
        });
        iziToast.show({
            title: 'خطا',
            color: 'red',
            icon: 'fa fa-times-circle',
            iconColor: 'red',
            rtl: true,
            position: 'topCenter',
            timeout: 10000,
            message: msg
        });
    };
    $(function() {
        var $body = $('body');
        var modal_edit = $('#myModal1');
        var modal_add = $('#myModal2');
        var maxTags = $('.meta_keyword_count').val();

        $('[data-role="tagsinput"]').tagsinput({
            maxTags: maxTags
        });

        $('.add-btnPro').on('click', function(e) {
            e.preventDefault();

            modal_add.modal({
                show: true,
                backdrop: 'static'
            });

            $body.find('.container-view ul').html('');
            $('.selectedCategories').val('');

            $('.mm-listview input[type="checkbox"]').prop('checked', false);

            var $obj = {
                mustEmptyArr: true
            };

            $.fillSelectedCategories($obj);
        });

        $(".addProduct").keypress(function(e) {
            if (e.which == 13) {
                var tagName = e.target.tagName.toLowerCase();
                if (tagName !== "textarea") {
                    return false;
                }
            }
        });

        $("#addProduct").on("submit", function(e) {
            e.preventDefault();
            var form = $('.form')[0];
            var formData = new FormData(form);
            var $this = $(this);
            $('.errorHandler').text('');

            $.checkBar($this).then(function() {
                $.httpRequest('/member/product/add/', 'post', formData).then(function(data) {
                    var response = $.parseJSON(data);
                    if (response.fields.result == -1) {
                        if (response.fields.category_Usage) {
                            $('div.editCategory').text(response.fields.msg);
                            return;
                        }
                        $.iziToastError(response.fields.msg, '.iziAdd-container');
                        return;
                    }
                    if (response.fields.result == -1) {
                        $.each(response.fields, function(key, value) {
                            if (value[0].length > 0) {
                                var x = $('#addProduct input[required]');
                                if (x.length == false) {
                                    $('[name="' + key + '"]').parent().append("<div class='errorHandler'>" + value + "</div>");
                                    $('[name="' + key + '"]').siblings('.requiredIcon').empty().text('*')
                                        .end().parent().removeClass('has-success').addClass('has-error');
                                    return;
                                }
                            }
                        });
                    } else {
                        var product_d_id = response.fields.Product_d_id,
                            date = response.fields.date,
                            title = response.fields.title,
                            image_name = response.fields.image,
                            defaltLogo = response.fields.defaltLogo,
                            image = response.fields.img,
                            description = response.fields.description,
                            brif_description = response.fields.brif_description,
                            html = '<div class="col-xs-12 col-sm-6 col-md-4 pull-right mb5 remove-product" data-value="' + product_d_id + '">' +
                            '<div class="contentPro disable whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">' +
                            '<h3>' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit" data-value="' + product_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash" data-value="' + product_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '<li><a class="link-addPicture" data-value="' + product_d_id + '"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>گالری محصول</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<div class="logo"><img name="image_ajax" class="boxBorder" src="' + (image_name != null ? image : defaltLogo) + '"' + ' alt=""></div>' +
                            '<span class="title">' + title + '</span>' +
                            '<span class="i-date"><i class="fa fa-calendar"></i>' + date + '</span>' +
                            '</h3>' +
                            '<div class="text">' +
                            '<p class="brif_description">' + brif_description + '</p>' +
                            '<p class="description">' + description + '</p>' +
                            '<span class="submit-msg">&#10006; تایید نشده</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>';

                        $('.add-product').append(html);
                        $('.notRecord').remove();
                        modal_add.modal('hide');
                        $.iziToastSuccess(response.msg, '.izi-container');
                        emptyModal();
                    }
                });
            });
        });

        $("#editProduct").on("submit", function(e) {
            e.preventDefault();
            var form = $('.form')[1];
            var formData = new FormData(form);
            var $this = $(this);
            $('.errorHandler').text('');

            $.checkBar($this).then(function() {
                $.httpRequest('/member/product/edit/', 'post', formData).then(function(data) {
                    var response = $.parseJSON(data);

                    if (response.result == -1) {
                        if (response.category_Usage) {
                            $('div.editCategory').text(response.msg);
                            return;
                        }
                        $.iziToastError(response.msg, '.iziEdit-container');
                        return;
                    }
                    if (response.fields.result == -1) {
                        $.each(response.fields, function(key, value) {
                            var x = $('#editProduct input[required]');
                            if (x.length == false) {
                                $('[name="' + key + '"]').parent().append("<div class='errorHandler'>" + value + "</div>");
                                $('[name="' + key + '"]').siblings('.requiredIcon').empty().text('*')
                                    .end().parent().removeClass('has-success').addClass('has-error');
                                return;
                            }
                        });
                    } else {
                        var product_d_id = response.fields.Product_d_id;
                        var product_d_id_old = response.fields.Product_d_id_old;
                        var product_d_id_oldest = response.fields.Product_d_id_oldest;
                        var title = response.fields.title;
                        var description = response.fields.brif_description;
                        var date = response.fields.date;
                        var image_name = response.fields.image;
                        var defaltLogo = response.fields.defaltLogo;
                        var image = response.fields.img;

                        $(".remove-product").each(function() {
                            if ($(this).data('value') == product_d_id_old || $(this).data('value') == product_d_id_oldest) {
                                $(this).data('value', product_d_id);
                                $(this).find('.link-trash').data('value', product_d_id);
                                $(this).find('.link-edit').data('value', product_d_id);
                                $(this).find('div.contentPro').addClass('disable');
                                $(this).find('.title').text(title);
                                $(this).find('.brif_description').text(description);
                                $(this).find('.text').find('p').text(description);
                                $(this).find('.i-date').text(date);
                                $(this).find('.submit-msg').html('<span>&#10006;</span> <span>تایید نشده</span>');

                                image_name != '' ?
                                    $(this).find('[name="image_ajax"]').attr('src', image) :
                                    $(this).find('[name="image_ajax"]').attr('src', defaltLogo);
                            }
                        });
                        modal_edit.modal('hide');
                        $.iziToastSuccess(response.msg, '.izi-container');
                    }
                });
            });
        });

        $body.on('click', '.link-edit', function(e) {
            e.preventDefault();
            var $this = $(this);
            var dataID = $(this).data('value');
            $('.errorHandler').text('');
            emptyModal();
            editItem(dataID, $this);
        });

        $body.on('click', '.link-trash', function(e) {
            e.preventDefault();
            var dataID = $(this).data('value'),
                lastItem = $body.find('.remove-product').length;

            iziToast.question({
                title: "آیا از حذف این آیتم اطمینان دارید؟",
                close: false,
                backgroundColor: '#FFF',
                messageColor: 'red',
                color: 'green',
                icon: 'fa fa-question',
                iconColor: 'gray',
                rtl: true,
                closeOnEscape: false,
                toastOnce: true,
                overlay: true,
                overlayClose: true,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                drag: false,
                timeout: false,
                position: 'center',
                message: lastItem === 1 ? "با حذف کردن این آیتم امتیاز مرتبط با این موضوع از امتیاز کل شما کسر خواهد شد" : "<p></p>",
                buttons: [
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                        deleteItem(dataID)

                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                    }]
                ]
            });
        });

        $('nav.menu').each(function() {
            var placeholder = $(this).attr('data-placeholder');
            var title = $(this).attr('data-title');
            $(this).mmenu({
                "searchfield": {
                    "placeholder": placeholder,
                    "noResults": "جستجویی پیدا نشد",
                    "add": true,
                    "search": true,
                    "resultsPanel": true,
                    "showSubPanels": false,
                    "showTextItems": true
                },
                extensions: ['effect-slide-menu', 'pageshadow'],
                searchField: false,
                counters: true,
                navbars: [{
                    position: 'top',
                    content: ['searchfield']
                }],
                navbar: {
                    add: true,
                    title: title,
                    titleLink: "parent"
                }
            }, {
                clone: false,
                offCanvas: {
                    menuWrapperSelector: $(this).parent()
                },
                "searchfield": {
                    "clear": true
                }
            });
        });

        $(".addGallery").on("click", function(e) {
            e.preventDefault();
            var form = $('#addGallery')[0];
            var formData = new FormData(form);
            $('.errorHandler').text('');
            $.httpRequest('/member/product/addGallery/', 'post', formData)
                .then(function(data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.iziToastAdd-container');
                        return;
                    } else {
                        var image = response.data.src,
                            productGalleryId = response.data.product_gallery_id,
                            product_d_id = response.data.product_d_id,
                            html = '<li>' +
                            '<img class="width boxBorder roundCorner" src="' + image + '" alt="Picture">' +
                            '<a data-value="' + productGalleryId + '">' +
                            '<div class="footer-li">' +
                            '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                            '<span>حذف تصویر</span>' +
                            '</div>' +
                            '</a>' +
                            '</li>',
                            li = '<li data-value="' + productGalleryId + '">' +
                            '<img class="width boxBorder" src="' + image + '" alt="Picture">' +
                            '</li>';

                        $('.content-gallery').append(html);
                        $('body').find('div.remove-product[data-value="' + product_d_id + '"]').find('ul.content-description').append(li);
                        GetMaxGallery();

                        $('.notRecord').remove();
                        modal_add.modal('hide');
                        $.iziToastSuccess(response.msg, '.iziToastAdd-container');
                        emptyModal();
                    }
                });
        });

        $body.on('click', '.link-addPicture', function(e) {
            e.preventDefault();
            $('.errorHandler').text('');

            GetMaxGallery();
            $('.content-gallery').empty();

            $.post('/member/product/showGallery/', {
                product_d_id: $(this).data('value')
            }, function(data) {

                var response = $.parseJSON(data);

                var html = '';
                $.each(response.data, function(i, v) {
                    html += '<li>' +
                        '<img class="width boxBorder roundCorner" src="' + v.src + '" alt="Picture">' +
                        '<a data-value="' + v.product_gallery_id + '">' +
                        '<div class="footer-li">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                        '<span>حذف تصویر</span>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
                });

                $('.content-gallery').html(html);
                GetMaxGallery();

                $('#basicModal').modal('show');

            });

            $('#basicModal').find('.modal-input').attr('value', $(this).data('value'));

        });

        $body.on('click', '.content-gallery li a', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var contentGallery = $(this),
                lastItem = $body.find('.content-gallery li').length,
                productGalleryId = $(this).data('value');


            iziToast.question({
                title: "آیا از حذف این آیتم اطمینان دارید؟",
                close: false,
                backgroundColor: '#FFF',
                messageColor: 'red',
                color: 'green',
                icon: 'fa fa-question',
                iconColor: 'gray',
                rtl: true,
                closeOnEscape: false,
                toastOnce: true,
                overlay: true,
                overlayClose: true,
                overlayColor: 'rgba(0, 0, 0, 0.6)',
                drag: false,
                zindex: null,
                timeout: false,
                position: 'center',
                message: lastItem === 1 ? "با حذف کردن این آیتم امتیاز مرتبط با این موضوع از امتیاز کل شما کسر خواهد شد" : "<p></p>",
                buttons: [
                    ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function(instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                        $.post('/member/product/deleteGallery/', {
                            product_gallery_id: productGalleryId
                        }, function(data) {
                            var response = $.parseJSON(data);
                            if (response.result == -1) {
                                $.iziToastError(response.msg, '.iziToastAdd-container');
                                return;
                            } else {
                                contentGallery.parent().remove();
                                $('body').find('ul.content-description li[data-value="' + productGalleryId + '"]').remove();
                                GetMaxGallery();
                                $.iziToastSuccess(response.msg, '.iziToastAdd-container');
                                emptyModal();
                            }
                        });
                    }, true],
                    ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function(instance, toast) {
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');
                    }]
                ]
            });
        });

        $('.addGallery').prop("disabled", true);

        function editItem(dataID, $this) {
            modal_edit.find('input[type="text"], input[type="password"], input[type="number"], input[type="tel"], input[type="url"], textarea').each(function() {
                if ($(this).prop('type') !== 'hidden') {
                    $(this).val("");
                }
            });

            $.post('/member/product/editAjax/', {
                id: dataID
            }, function(data) {
                var result = $.parseJSON(data);
                var fields = result.fields;

                modal_edit.find('input[type="checkbox"]').prop('checked', false);

                $.each(fields, function(key, value) {
                    if (key == 'image_tmp') {
                        modal_edit.find('[name="' + key + '"]').attr('src', value);
                    } else if (key == 'category_id') {
                        var categoryCheckBoxes = modal_edit.find('input[name="category_id[]"]');
                        // var categoriesArray = value.split(',');

                        modal_edit.find('.selectedCategories').val(value);

                        $.each(value.split(','), function(i, v) {
                            modal_edit.find('input[value="' + v + '"]').prop('checked', true);
                        });

                        /*for (var i = 0; i < categoryCheckBoxes.length; i++) {
                            if (categoriesArray.indexOf(categoryCheckBoxes[i].value) != -1) {
                                categoryCheckBoxes[i].checked = true;
                                //var inputObj = modal_edit.find('input[value="' + categoryCheckBoxes[i].value + '"]');
                                //modal_edit.find('.selected-category').html('<li data-id="' + categoryCheckBoxes[i].value + '"><a class="removeCatSelected"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' + inputObj.parent('label').text() + '</li>');
                            }
                        }*/
                    } else {
                        modal_edit.find('[name="' + key + '"]').val(value);
                    }
                });

                // check if some category was selected, append to selectedItems
                $.fillSelectedCategories($obj = {});

                $('[data-role="edittagsinput"]').tagsinput('destroy');
                $('[data-role="edittagsinput"]').tagsinput({
                    maxTags: maxTags
                });

                $('body').find('input[type="text"], input[type="email"], input[type="name"], input[type="password"], textarea').each(function() {
                    if ($(this).val().length != 0) {
                        $(this).parent().addClass('typing');
                    }
                });

                modal_edit.modal({
                    show: true,
                    backdrop: 'static'
                });
            });
        }

        function GetMaxGallery() {
            if ($body.find('.content-gallery li').length >= 5) {
                $('#basicModal').find('#inputImageGallery').prop("disabled", true);
                $('#basicModal').find('.uploud-btnProCrop').css("background-color", '#b3b3b3');
            } else {

                $('#basicModal').find('#inputImageGallery').prop("disabled", false);
                $('#basicModal').find('.uploud-btnProCrop').css("background-color", '#64a903');
            }
        }

        function emptyModal() {
            $('body').find('input[type="text"], input[type="file"], textarea').each(function() {
                $(this).val("");
                $(this).siblings('.requiredIcon').empty().text('*');
                $(this).parent().removeClass('has-success');
            });
            $('#addProduct').find('.bootstrap-tagsinput span').each(function() {
                $(this).remove();
            });

            $('#addProduct').find('label.company-name').find('input[type="checkbox"]').each(function() {
                $(this).attr('checked', false);
                $('ul.selected-category').empty();
            });

            $('#addProduct').find('img.image-crop').each(function() {
                $(this).attr("src", '<?php echo RELA_DIR . "templates/template_tailwind/assets/images/placeholder.png" ?>');
            });
        }

        function deleteItem(dataID) {
            var postData = {
                id: dataID
            };
            $.httpRequest('/member/product/delete/', 'post', postData, false).then(function(data) {
                var response = $.parseJSON(data);

                if (response.result == 1) {
                    var product_d_id = response.fields.Product_d_id;
                    var i = 0;
                    $(".remove-product").each(function() {
                        i++;
                        if ($(this).data('value') == product_d_id) {
                            $(this).remove();
                            $.iziToastSuccess(response.msg, '.izi-container');
                        }
                    });
                    if (i == 1) {
                        var image = "<?php echo RELA_DIR; ?>" + "templates/template_tailwind/assets/images/empty01.png";
                        var html = '<div class="notRecord">' +
                            '<img class="empty-img center-block" src="' + image + '">' +
                            '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                        $('.add-product').append(html);
                    }
                }
            });
        }
    });
</script>