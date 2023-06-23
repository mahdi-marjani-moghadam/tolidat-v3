<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> ویرایش کمپانی</a></li>
    </ul><!--/control-nav-->
</div><!-- /content-control -->
<?php //print_r_debug($list)?>
<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-heading bg-white">
            <h3 class="panel-title rtl">جزییات کمپانی</h3>
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

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="company_name">نام کمپانی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                                required value="<?= $list['company_name'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="maneger_name">نام مدیر عامل:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="maneger_name" id="maneger_name"
                                                required value="<?= $list['maneger_name'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="description">توضیحات:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="description" id="description"
                                                required value="<?= $list['description'] ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <!-- state -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="city_id">انتخاب استان:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="state_id" id="province_id" data-input="select2">
                                            <option></option>
                                            <?
                                            foreach ($list['states'] as $province_id => $value) {
                                                ?>
                                            <option
                                                <?= $value['province_id'] == $list['state_id'] ? 'selected' : '' ?>
                                                    value="<?= $value['province_id'] ?>">
                                                <?= $value['name'] ?>
                                                </option><?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- city -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                            for="city_id">انتخاب شهر:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="city_id" id="city_id" data-input="select2"> //complete with Ajax </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="meta_keyword">کلمات کلیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="meta_keyword" id="meta_keyword"
                                                value="<?= $list['meta_keyword'] ?>"
                                                data-error="لطفا کلمه کلیدی را وارد نمایید" data-role="tagsinput">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($list['company_type'] == 1) { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="registration_number">شماره ثبت:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="registration_number"
                                                    id="registration_number" value="<?= $list['registration_number'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                                for="national_id">شناسه ملی:</label>
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input type="text" class="form-control" name="national_id" id="national_id"
                                                    value="<?= $list['national_id'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_name">نام نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_name"
                                                id="coordinator_name" value="<?= $list['memberInfo']['name'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_family">نام خانوادگی نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_family"
                                                id="coordinator_family" value="<?= $list['memberInfo']['family'] ?>">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="coordinator_phone">شماره تلفن نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="coordinator_phone"
                                                id="coordinator_phone" value="<?= $list['memberInfo']['mobile'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="email">ایمیل نماینده واحد تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="email" class="form-control" name="email"
                                                id="coordinator_email" value="<?= $list['memberInfo']['email'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!--                        <div class="row profile-editForm">-->
                        <!--                            <div class="col-xs-12 col-sm-6 col-md-6">-->
                        <!--                                <div class="search-box boxBorder categoryContainer">-->
                        <!--                                    <div class="search-box-header edit-primary-form whiteBg">-->
                        <!--                                        <i class="fa fa-bars" aria-hidden="true"></i>-->
                        <!--                                        <p>دسته بندی ها</p>-->
                        <!--                                    </div>-->
                        <!--                                    <div class="mmenuHolder admin-mmenuHolder active">-->
                        <!--                                        <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها"-->
                        <!--                                             data-title="دسته بندی تولیدی ها">--><? //= $list['category']; ?>
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="col-xs-12 col-sm-6 col-md-6">-->
                        <!--                                <div class="container-view boxBorder">-->
                        <!--                                    <span>دسته های انتخاب شده</span>-->
                        <!--                                    <ul class="selected-category"></ul>-->
                        <!--                                </div>-->
                        <!--                                <input type="hidden" id="maxCanSelected"-->
                        <!--                                       value="--><?php //echo trim($list['packageUsage']['category']); ?><!--">-->
                        <!--                                <input type="hidden" id="selectedCategories"-->
                        <!--                                       value="--><? //= $list['category_id'] ?><!--">-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <div class="row profile-editForm">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="search-box boxBorder categoryContainer">
                                    <div class="search-box-header edit-primary-form whiteBg">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                        <p>دسته بندی ها</p>
                                    </div>
                                    <div class="mmenuHolder admin-mmenuHolder active">
                                        <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها" data-title="دسته بندی تولیدی ها"><?= $list['category']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="container-view boxBorder">
                                    <span>دسته های انتخاب شده</span>
                                    <ul class="selected-category"></ul>
                                </div>
                                <input type="hidden" id="maxCanSelected" value="<?php echo trim($list['packageUsage']['category']); ?>">
                                <input type="hidden" id="selectedCategories" value="<?= $list['category_id'] ?>">
                            </div>
                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <hr>

                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="registration_number">ویدیو :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                       <textarea class="form-control" name="video_script" id="video_script" rows="4" cols="50"><?= $list['video_script'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="form-group">

                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="xImagePath"> کاتالوگ :</label>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-8 pull-right">
                                                <input name="catalog" class="" type="file" value="انتخاب فایل"/>
                                            </div>
                                            <div id="preview" style="display:none">
                                                <strong>Selected Thumbnails</strong>
                                                <div id="thumbnails"></div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($list['catalog'] != '') {
                                            ?>
                                            <a href="<?= COMPANY_ADDRESS . $list['company_id'] . "/catalog/" . $list['catalog'] ?>"
                                                    target="_blank">نمایش کاتالوگ</a>
                                        <?php }
                                        ?>
                                        <div class="checkbox col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <label> <input name="remove_file" type="checkbox"> حذف فایل </label>
                                        </div
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="status">وضعیت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="status" id="status">
                                            <option
                                                    value="1" <?= ($list['status'] == 1) ? 'selected="selected"' : ''; ?>>
                                                فعال
                                            </option>
                                            <option
                                                    value="0" <?= ($list['status'] == 0) ? 'selected="selected"' : ''; ?>>
                                                در غیرفعال
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="priority">اولویت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="priority" id="priority">
                                            <option
                                                    value="1" <?= ($list['priority'] == '1') ? 'selected="selected"' : ''; ?>>
                                                1
                                            </option>
                                            <option
                                                    value="0" <?= ($list['priority'] == '0') ? 'selected="selected"' : ''; ?>>
                                                0
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                            for="process">عملیات:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="process" id="process">
                                            <option value="0" selected></option>
                                            <option value="1">تایید</option>
                                            <option value="-1">رد</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <p class="pull-right">
                                    <input name="action" type="hidden" id="action" value="edit"/>
                                    <input name="draft_id" type="hidden" id="draft_id"
                                            value="<?= $list['Company_d_id'] ?>"/>
                                    <input name="showStatus" type="hidden" id="Company_id"
                                            value="<?= $list['showStatus'] ?>"/>
                                    <input name="city" type="hidden" id="city"
                                            value="<?= $list['city_id'] ?>"/>

                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl"><i class="fa fa-plus"></i> ثبت
                                    </button>
                                    <a id="goBack" onclick="backTo()"
                                            class="btn btn-icon btn-primary rtl">بازگشت</a>
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
    $(document).ready(function () {

        var p = document.getElementById("province_id");
        var province = p.options[p.selectedIndex].value;
        var city = $("#city").val();

        cityAjax(province, city);
        function cityAjax(province_id, city_id) {
            $.ajax({
                url: "<?php echo RELA_DIR . 'admin/?component=company&action=getCityAjax'?>",
                data: {province_id: province_id, city_id: city_id},
                method: 'post',

                success: function (result) {
                    $('#city_id').html(result);
                    $("#city_id").select2();
                },
                error: function (result, status) {
                    console.log('error: ' + status);
                }
            });
        }


        $("#province_id").on("change", function () {
            cityAjax($("#province_id").val(), city);
        });

    });

</script>
