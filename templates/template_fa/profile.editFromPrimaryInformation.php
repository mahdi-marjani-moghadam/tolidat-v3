<?php $information_company = getInformation(); ?>
<div class="row xxsmallSpace"></div>

<div class="row noMargin">
    <div class="content">
        <div class="izi-container"></div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="holder-title center-block">
            <span class="title-pro">ویرایش پروفایل</span>
        </div>
    </div>
</div>
<!--box dynamic-->
<div class="row xsmallSpace"></div>

<div class="row profile-editForm">
    <?php if ($list['validate']) { ?>
        <p class="error"><?php echo $list['validate']['msg'] ?></p>
    <?php } ?>
    <div class="row profile-editForm container-floatinglabel">
        <div class="col-xs-12 col-sm-12 col-md-8 center-block  mb5" data-value="">
            <div class="contentPro contentPro-profile contentPro-honour whiteBg roundCorner boxBorder" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                <h3 title="اطلاعات عمومی">
                    <span class="title">اطلاعات عمومی</span>
                </h3>
                <div class="row xxsmallSpace"></div>
                <div class="text">
                    <form id="editprofile" class="edit-profile" enctype="multipart/form-data" action="/profile/edit" method="POST" data-toggle="validator">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input name="meta_keyword" type="text" id="name" data-error="کلید واژه مورد نظر را تایپ نمایید" placeholder="کلید واژه مورد نظر را تایپ نمایید" value="<?= $list['meta_keyword'] ?>" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb">
                                <label for="company_name">نام شرکت</label>
                                <input class="form-control" data-error="لطفا نام شرکت را وارد نمایید" type="text" name="company_name" id="company_name" value="<?= $list['company_name'] ?>" required>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="maneger_name">نام مدیر</label>
                                <input class="form-control" data-error="لطفا نام مدیر را وارد نمایید" type="text" name="maneger_name" id="maneger_name" value="<?= $list['maneger_name'] ?>" required>
                            </div>

                            <?php if ($list['company_type'] == 1) : ?>
                                <div class="form-group noPadding mb">
                                    <select name="personality_type" id="personality_type" class="form-control">
                                        <option value="0">نوع شخصیت حقوقی را انتخاب نمایید</option>
                                        <?php foreach ($list['personalityType'] as $personalityType) { ?>
                                            <option value="<?php echo $personalityType['Personality_type_id'] ?>" <?php if ($list['personality_type'] == $personalityType['Personality_type_id']) {
                                                echo "selected";
                                            } ?>>
                                                <?php echo $personalityType['type'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <i class="fa fa-angle-down transition"></i>
                                </div>
                            <?php endif; ?>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>


                            <div class="form-group noPadding mb">
                                <select name="state_id" id="state_id" class="form-control">
                                    <option value="0">استان را انتخاب نمایید...</option>
                                    <?php foreach ($list['province'] as $province) { ?>
                                        <option value="<?php echo $province['province_id'] ?>" <?php if ($list['state_id'] == $province['province_id']) {
                                            echo "selected";
                                        } ?>>
                                            <?php echo $province['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>

                            <div class="form-group noPadding mb">
                                <select name="city_id" id="city_id" class="form-control">
                                    <option value="0">شهرستان را انتخاب نمایید...</option>
                                    <?php foreach ($list['city'] as $city) { ?>
                                        <option value="<?php echo $city['City_id'] ?>" <?php if ($list['city_id'] == $city['City_id']) {
                                            echo "selected";
                                        } ?>>
                                            <?php echo $city['name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <i class="fa fa-angle-down transition"></i>
                            </div>

                        </div>
                        <div class="row xxsmallSpace"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="alert alert-warning rtl">
                                <div class="type-package">نوع پکیج:<span><?php echo $information_company['packageType'] ?></span></div>
                                <div class="limit-package">تعداد دسته های مجاز: <span class="updateAllowedCat">0</span><span>/</span><span><?php echo $information_company['packageCategoryCount'] ?></span></div>
                            </div>
                        </div>
                        <div class="row xxsmallSpace"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12">



                        </div>
                        <div class="row xxxsmallSpace"></div>

                        <div class="col-xs-12 col-sm-6 col-md-6 pull-right key-search">
                            <div class="search-box search-box1 boxBorder categoryContainer">
                                <div class="search-box-header edit-primary-form whiteBg">
                                    <header><i class="fa fa-bars" aria-hidden="true"></i>دسته بندی ها</header>
                                </div>
                                <div class="mmenuHolder active">
                                    <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?= $list['category']; ?>
                                </div>
                            </div>

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 pull-left">
                            <div class="container-view boxBorder">
                                <header><i class="fa fa-bars" aria-hidden="true"></i>دسته های انتخاب شده</header>
                                <ul class="selected-category">
                                </ul>
                            </div>
                            <input type="hidden" class="maxCanSelected" value="<?php echo $information_company['packageCategoryCount'] ?>">
                            <input type="hidden" class="selectedCategories" value="<?= $list['category_id']; ?>">

                            <!-- separator -->
                            <div class="row xxxsmallSpace"></div>
                        </div>

                        <div class="row xxsmallSpace"></div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group mb">
                                <label for="description">فعالیت شرکت</label>
                                <textarea data-error="لطفا فعالیت شرکت را شرح دهید" type="text" name="description" id="description" rows="5" required><?= $list['description'] ?></textarea>
                            </div>

                            <!-- separator -->
                            <div class="row xxsmallSpace"></div>

                            <div class="form-group mb">
                                <label for="video_script">اسکریپت ویدیو</label>
                                <textarea class="form-control" data-error="لطفا اسکریپت ویدیو خود را وارد کنید" type="text" name="video_script" id="video_script" rows="5"><?= $list['video_script'] ?></textarea>
                            </div>
                        </div>

                        <!-- separator -->
                        <div class="row xxsmallSpace"></div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label><?= $list['catalog'] ?></label>
                            <?php if ($list['catalog'] != '') : ?>
                                <input type="checkbox" name="deleteCatalog">  حذف کاتالوگ قبلی
                            <?php endif; ?>
                            <label>کاتالوگ خود را آپلود کنید</label>
                            <div class="form-group">
                                <input type="file" name="catalog" data-buttonText="Your label here.">
                            </div>
                        </div>
                        <input name="company_type" type="hidden" value="<?= $list['company_type'] ?>">
                        <input name="Company_d_id" type="hidden" value="<?= $list['Company_d_id'] ?>">
                        <button type="submit" class="submit mb center-block btn-block btn button-default show-more btn-login text-center text-ultralight transition" tabindex="4">
                            ثبت
                        </button>

                        <div class="row xxxsmallSpace"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).load(function() {
            var max_meta_keyword = '<?php echo $list['max_meta_keyword']?>';
            var categoryCheckBoxes = $('input[name="category_id[]"]');
            var category_id = '<?=$list['category_id'];?>';
            var categoriesArray = category_id.split(',');

            categoriesArray = $.map(categoriesArray, function(item) {
                return item !== '' ? item : null
            });

            $.each(categoriesArray, function(i, v) {
                $('.categoryContainer').find('input[value="' + v+ '"]').prop('checked', true);
            });/*

            for (var i = 0; i < categoryCheckBoxes.length; i++) {
                if (categoriesArray.indexOf(categoryCheckBoxes[i].value) != -1) {

                    categoryCheckBoxes[i].checked = true;
                }
            }*/

            $.fillSelectedCategories($obj = {});

            $('[data-role="tagsinput"]').tagsinput({
                maxTags: max_meta_keyword
            });
            $("#editprofile").keypress(function (e) {
                if (e.which == 13) {
                    var tagName = e.target.tagName.toLowerCase();

                    if (tagName !== "textarea") {
                        return false;
                    }
                }
            });

            $('#state_id').on('change', function () {
                var province_id = $(this).val();
                $('#city_id').empty();
                $.post('/city/getCityByProvinceID', {province_id: province_id}, function (data) {
                    var result = $.parseJSON(data);
                    $('#city_id').append('<option value="0">شهرستان را انتخاب نمایید...</option>');
                    $.each(result, function (key, value) {
                        $('#city_id').append($('<option>', {
                            value: value.City_id,
                            text: value.name
                        }));
                    });
                });
            });

            if ($('.error').length) {
                var msg = $('.error').text();
                $.iziToastError(msg, '.izi-container');
            }

        });
    </script>