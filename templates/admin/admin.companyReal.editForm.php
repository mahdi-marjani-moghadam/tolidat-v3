-<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-archive"></i>ویرایش کمپانی حقیقی </a></li>
    </ul>
    <!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list) 
?>


<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">فرم ویرایش کمپانی حقیقی تجاری </h3>
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
                <div class="col-xs-12 col-sm-12 col-md-8 center-block">
                    <form name="queue" id="queue" role="form" data-validate="form" class="form-horizontal" autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="memberName">نام نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="memberName" id="memberName" value="<?php echo  $list['memberInfo']['name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="memberFamily">نام خانوادگی نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="memberFamily" id="memberFamily" value="<?php echo  $list['memberInfo']['family'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="email">ایمیل نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo  $list['memberInfo']['email'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="mobile">شماره موبایل نماینده:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo  $list['memberInfo']['mobile'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="company_name">نام تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name" value="<?php echo  $list['companyInfo']['company_name'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div id="personality_box" class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="description">زمینه فعالیت تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <textarea rows="4" cols="50" class="form-control" name="description" id="description" required><?php echo  $list['companyInfo']['description'] ?></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="maneger_name">نام مدیر:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="maneger_name" id="maneger_name" value="<?php echo  $list['companyInfo']['maneger_name'] ?>" data-error="لطفا نام مدیر را وارد نمایید">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- state -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl" for="city_id">انتخاب استان:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="state_id" id="province_id" data-input="select2">
                                            <option></option>
                                            <?php
                                            foreach ($list['states'] as $province_id => $value) {
                                            ?>
                                                <option <?php echo  $value['province_id'] == $list['companyInfo']['state_id'] ? 'selected' : '' ?> value="<?php echo  $value['province_id'] ?>">
                                                    <?php echo  $value['name'] ?>
                                                </option><?php
                                                        }
                                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- city -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl" for="city_id">انتخاب شهر:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="city_id" id="city_id" data-input="select2"> //complete with Ajax </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_keyword">کلمات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="<?php echo  $list['companyInfo']['meta_keyword'] ?>" data-error="لطفا کلمه کلیدی را وارد نمایید" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="meta_keyword">توضیحات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_description" id="meta_description" value="<?php echo  $list['companyInfo']['meta_description'] ?>" data-error="لطفا توضیحات کلیدی را وارد نمایید">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label class="pull-right control-label rtl" for="xImagePath">کاتالوگ:</label> <br>
                                <div class="form-group noMargin">
                                    <div class="checkbox">
                                        <label><input name="remove_file" type="checkbox"> حذف کاتالوگ </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row xsmallSpace hidden-xs"></div>
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input name="catalog" class="" type="file" value="انتخاب فایل" />
                                    </div>
                                    <div id="preview" style="display:none">
                                        <strong>Selected Thumbnails</strong>
                                        <div id="thumbnails"></div>
                                    </div>
                                </div>
                                <div><?php if (trim($list['companyInfo']['catalog']) != '') {

                                            echo "<a href='" . COMPANY_ADDRESS . $list['companyInfo']['Company_id'] . "/catalog/" . $list['companyInfo']['catalog'] . "'>" . $list['companyInfo']['catalog'] . "</a>";
                                        }
                                        ?>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <!--  Video  -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="box-container2">
                                    <label class="pull-right control-label rtl" for="registration_number">ویدیو:</label>
                                </div>
                                <textarea class="form-control" name="video_script" id="video_script" rows="4" cols="50"><?php echo  $list['companyInfo']['video_script'] ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row profile-editForm">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="search-box boxBorder categoryContainer">
                                    <div class="search-box-header edit-primary-form whiteBg">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                        <p>دسته بندی ها</p>
                                    </div>
                                    <div class="mmenuHolder admin-mmenuHolder active">
                                        <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?php echo  $list['category']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="container-view boxBorder">
                                    <span>دسته های انتخاب شده</span>
                                    <ul class="selected-category"></ul>
                                </div>
                                <input type="hidden" id="maxCanSelected" value="<?php echo trim($list['packageUsage']['category']); ?>">
                                <input type="hidden" id="selectedCategories" value="<?php echo $list['companyInfo']['category_id'] ?>">
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group noMargin">
                                    <textarea class="form-control" id="log" name="text"></textarea>
                                </div>
                                <div class="row xxsmallSpace hidden-xs"></div>
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#showLog">نمایش لاگها</button>
                            </div>
                        </div>
                        <div class="row xsmallSpace hidden-xs"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <button type="submit" name="update" id="submit" class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="edit" />
                                        <input type="hidden" name="licence_description" value="<?php echo $list['licence_description']; ?>">
                                        <input type="hidden" name="company_id" value="<?php echo $list['companyInfo']['Company_id']; ?>">
                                        <input type="hidden" name="company_type" value="2"> <i class="fa fa-plus"></i> ثبت
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

<!-- Modal -->
<div class="modal fade" id="showLog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">لیست لاگها</h4>
            </div>
            <div class="modal-body">

                <table id="example" class="companyTable table table-striped table-bordered rtl" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام اپراتور</th>
                            <th>اکشن اصلی</th>
                            <th>نحوه ارسال</th>
                            <th>توضیحات</th>
                            <th>تاریخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list['logInfo'] as $key => $value) { ?>
                            <tr>
                                <td><?php echo  $value['letter_log_id'] ?></td>
                                <td><?php echo  $value['admin_name'] . " " . $value['admin_family'] ?></td>
                                <td><?php echo  $value['letter_type'] ?></td>
                                <td><?php echo  $value['letter_action'] ?></td>
                                <td><?php echo  $value['description'] ?></td>
                                <td><?php echo  convertDate($value['date']) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    console.log($('.mmenuHolder').html());
    //------> Set Reference_type
    $("#licence_type").on('change', function() {
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
    //------> Set Reference_type
    // $("#reference_type option").val("<?php // echo  $list['phoneInfo']['reference_type'] 
                                        ?>").attr("selected", true);
</script>
<script src='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.4.1/mapbox-gl.css' rel='stylesheet' />
<div id='map' style='width: 400px; height: 300px;'></div>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiaC12YWhlZCIsImEiOiJjazEwZXZzMHIwMG1xM2dveTI2ampjbWM1In0.7_OaoDPA8e7nI26vPoIG9Q';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11'
    });
</script>
<script>
    //------>state Change
    $(document).ready(function() {
        //------> Select City & State with Jquery
        var p = document.getElementById("province_id");
        var province = p.options[p.selectedIndex].value;
        var city = '<?php echo $list['companyInfo']['city_id'] ?>';

        cityAjax(province, city);

        function cityAjax(province_id, city_id) {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=getCityAjax' ?>",
                data: {
                    province_id: province_id,
                    city_id: city_id
                },
                method: 'post',
                success: function(result) {
                    $('#city_id').html(result);
                    $("#city_id").select2();
                },
                error: function(result, status) {
                    console.log('error: ' + status);
                }
            });
        }

        $("#province_id").on("change", function() {
            cityAjax($("#province_id").val(), city);
        });


        if ("<?php echo  isset($list['licenceInfo']['licence_number']) ?>") {
            $.addLicence();
        } else {
            $.removeLicence();
        }
    });
</script>
<script>
    $(function() {
        var $dataX = $('#dataX');
        var $dataY = $('#dataY');
        var $dataHeight = $('#dataHeight');
        var $dataWidth = $('#dataWidth');
        var $dataRotate = $('#dataRotate');
        var $dataScaleX = $('#dataScaleX');
        var $dataScaleY = $('#dataScaleY');

        var options = {
            width: 1024,
            height: 576,
            restore: false,
            aspectRatio: 16 / 9,
            crop: function(e) {
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

                reader.onload = function(e) {
                    $('.img-container .image-banner').attr('src', e.target.result);
                    cropInstance.cropper('destroy');
                    cropInstance.cropper(options);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        
        $('#myModal-banner').on('show.bs.modal', function(e) {
            cropperBanner.cropper('destroy');
        });

        $('#myModal-banner').on('shown.bs.modal', function(e) {
            cropperBanner = cropperBanner.cropper(options);
            $('.img-container img').attr('src', baseURL + 'templates/template_fa/assets/images/placeholder1.png');
        });


        $("#inputImage-banner").change(function() {
            readURL(this, cropperBanner);
        });


        cropperBanner.on('cropend', function(e) {
            var result = cropperBanner.cropper('getCroppedCanvas', {
                fillColor: '#fff'
            });
            $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
        });


        cropperBanner.on('zoom', function(e) {
            var result = cropperBanner.cropper('getCroppedCanvas', {
                fillColor: '#fff'
            });
            $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
        });


        cropperBanner.on('ready', function(e) {
            var result = cropperBanner.cropper('getCroppedCanvas', {
                fillColor: '#fff'
            });
            $('.result-cropBanner').val(result.toDataURL('image/jpeg'));
        });

        $('.upload-result-banner').on('click', function(e) {
            var image = $('.result-cropBanner').val();
            var modal_banner = $('#myModal-banner');
            $.post('/member/companyBanner/edit/', {
                image: image
            }, function(data) {
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
        });

    });
</script>