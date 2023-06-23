<div class="content-control">
    <!--control-nav-->
    <ul class="control-nav pull-right">
        <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i>ویرایش کمپانی حقیقی ویکی</a></li>
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
                          autocomplete="off" novalidate="novalidate" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class=" checkbox">
                                <label> <input name="remove_licence" type="checkbox" id="remove_licence"> حذف جواز:
                                </label>
                            </div>
                        </div>
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
                                                    <option value="<?= $key ?>"
                                                        <?= ($list['licenceInfo']['licence_type'] == $key) ? "selected" : '' ?>> <?= $value['name'] ?>
                                                    </option>
                                                <? } ?>
                                                <option value="0">غیره</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <? foreach ($list['licence'] as $key => $value) {
                                                if ($list['companyData']['licenceInfo']['licence_type'] == $key) {
                                                    echo($value['name']);
                                                } ?>
                                            <? } ?>
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
                                            <input type="text" class="form-control set-font-latin" name="licence_number"
                                                   id="licence_number"
                                                   value="<?= $list['licenceInfo']['licence_number'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['licence_number'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="col-xs-12 col-sm-4  col-md-4 pull-right control-label rtl"
                                               for="licence_description">فعالیت جواز:</label>
                                        <div class="col-xs-12 col-sm-8  col-md-8  pull-right">
                                            <input type="text" class="form-control" name="licence_description"
                                                   id="licence_description"
                                                   value="<?= $list['licenceInfo']['description'] ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['description'] ?>
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
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['name'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['family'] ?>
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
                                            <input type="text" class="form-control set-font-latin" name="national_code"
                                                   id="national_code"
                                                   value="<?= $list['licenceInfo']['national_code'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['national_code'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['exporter_refrence'] ?>
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
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= ($list['companyData']['licenceInfo']['issuence_date']) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['licenceInfo']['expiration_date'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>
                            <div class="row">
                                <div class="col-md-3">
                                    <img
                                            src="<?= COMPANY_ADDRESS . $list['companyInfo']['Company_id'] . "/licence/" . $list['licenceInfo']['image'] ?> "
                                            class="img-responsive img-thumbnail" alt="Responsive image">
                                    <h4 style="direction:ltr"><?= $list['licenceInfo']['image'] ?></h4>
                                </div>
                            </div>
                            <div class="row xsmallSpace hidden-xs"></div>


                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-8 pull-right">
                                            <input name="image" class="" type="file" value="انتخاب فایل"/>
                                        </div>
                                        <div id="preview" style="display:none">
                                            <strong>Selected Thumbnails</strong>
                                            <div id="thumbnails"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="col-xs-12 col-sm-4 pull-right control-label rtl">
                                            <?= $list['companyData']['companyInfo']['national_id'] ?>dddd
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                           for="company_name">نام تولیدی:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="company_name" id="company_name"
                                               required value="<?= $list['companyInfo']['company_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['companyInfo']['company_name'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                           for="description">فعالیت شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="description" id="description"
                                               required value="<?= $list['companyInfo']['description'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['companyInfo']['description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                           for="maneger_name">نام مدیر:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <input type="text" class="form-control" name="maneger_name" id="maneger_name"
                                               required
                                               value="<?= $list['licenceInfo']['name'] . " " . $list['licenceInfo']['family'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['companyInfo']['maneger_name'] ?>
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
                                                <?= $value['province_id'] == $list['companyInfo']['state_id'] ? 'selected' : '' ?>
                                                    value="<?= $value['province_id'] ?>">
                                                <?= $value['name'] ?>
                                                </option><?
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?php
                                        foreach ($list['states'] as $province_id => $value) {
                                            if ($value['province_id'] == $list['companyData']['companyInfo']['state_id']) {
                                                echo($value['name']);
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <!-- city -->
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 col-md-4 pull-right control-label rtl"
                                           for="city_id">انتخاب شهر:</label>
                                    <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                                        <select name="city_id" id="city_id" data-input="select2"> //complete with
                                            Ajax </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        11111
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="code">کد:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="code" id="code"
                                               value="<?= $list['phoneInfo']['code'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['phoneInfo']['code'] ?>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl" for="phone">تلفن
                                        شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control set-font-latin" name="phone" id="phone"
                                               value="<?= $list['phoneInfo']['number'] ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['phoneInfo']['number'] ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="postal_code">کدپستی :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="postal_code"
                                               id="postal_code" value="<?= $list['addressInfo']['postal_code'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['addressInfo']['postal_code'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="address">آدرس شرکت:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="address"
                                               id="address" value="<?= $list['addressInfo']['address'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['addressInfo']['address'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="email">ایمیل:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="email" class="form-control" name="email"
                                               id="email" value="<?= $list['emailInfo']['email'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['emailInfo']['email'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="url">وب سایت :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="url"
                                               id="url" value="<?= $list['websiteInfo']['url'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['websiteInfo']['url'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="reference_type">مرجع تایید تلفن :</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <select name="reference_type" id="reference_type" data-input="select2">
                                            <option
                                                    value="1" <?php echo ($list['phoneInfo']['reference_type'] == '1') ? "selected" : '' ?> >
                                                روزنامه رسمی
                                            </option>
                                            <option
                                                    value="2" <?php echo ($list['phoneInfo']['reference_type'] == '2') ? "selected" : '' ?>>
                                                سایت
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?php if ($list["companyData"]['phoneInfo']['reference_type'] == '1') {
                                            echo("روزنامه رسمی");
                                        } else {
                                            echo("سایت");
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="col-xs-12 col-sm-4 pull-right control-label rtl"
                                           for="reference_value">توضیحات مرجع تایید تلفن:</label>
                                    <div class="col-xs-12 col-sm-8 pull-right">
                                        <input type="text" class="form-control" name="reference_value"
                                               id="reference_value"
                                               value="<?= $list['phoneInfo']['reference_value'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="col-xs-12 pull-right control-label rtl">
                                        <?= $list['companyData']['phoneInfo']['reference_value'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row xsmallSpace hidden-xs"></div>

                        <div class="row profile-editForm">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="search-box boxBorder categoryContainer">
                                    <div class="search-box-header edit-primary-form whiteBg">
                                        <i class="fa fa-bars" aria-hidden="true"></i>
                                        <p>دسته بندی ها</p>
                                        <i class="fa fa-question list-question" aria-hidden="true" data-placement="top"
                                           data-trigger="hover" data-toggle="popover" title=""
                                           data-content="لطفا نام خود را به صورت کامل همراه با پسوند و پیشوند وارد کنید"
                                           data-original-title="نام"></i>
                                    </div>
                                    <div class="mmenuHolder active">
                                        <nav class="menu  mm-opened" data-placeholder="جستجو در دسته بندی ها"
                                             data-title="دسته بندی تولیدی ها"><?= $list['category']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="container-view">
                                    <span>دسته های انتخاب شده</span>
                                    <i class="fa fa-question list-question" aria-hidden="true" data-placement="top"
                                       data-trigger="hover" data-toggle="popover" title=""
                                       data-content="لطفا نام خود را به صورت کامل همراه با پسوند و پیشوند وارد کنید"
                                       data-original-title="نام"></i>
                                    <ul class="selected-category">
                                    </ul>
                                </div>
                                <input type="hidden" id="maxCanSelected" value="1">
                                <input type="hidden" id="selectedCategories"
                                       value="<?= $list['companyInfo']['category_id'] ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class='form-group'>
                                    <label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='process'>عملیات
                                        :</label>
                                    <div class='col-xs-12 col-sm-8 pull-right'>
                                        <select name='process' id='process' data-input='select2'>
                                            <option value='1'>در حال بررسی</option>
                                            <option value='2'>تایید</option>
                                            <option value='3'>رد</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="pull-right">
                                    <button type="submit" name="update" id="submit"
                                            class="btn btn-icon btn-success rtl">
                                        <input name="action" type="hidden" id="action" value="check"/>
                                        <input type="hidden" name="company_type" value="2">
                                        <input type="hidden" name="company_d_id"
                                               value="<?php echo $list['companyInfo']['Company_d_id']; ?>">
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
    //------>state Change
    $(document).ready(function () {
        // Active Licence Description Input
        $("#licence_type").on('change', function () {
            if ($(this).val() == '0') {
                $("#licence_box").html(
                    "<div class='form-group'>" +
                    "<label class='col-xs-12 col-sm-4 pull-right control-label rtl' for='licence_description'>توضیحات جواز:</label>" +
                    "<div class='col-xs-12 col-sm-8 pull-right'>" +
                    "<input type='text' class='form-control' name='licence_description' id='licence_description' value='' required>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );
            } else {
                $("#licence_box").html("");
            }
        });

        // Set Reference_type
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

        // Select City & State with Jquery
        var p = document.getElementById("province_id");
        var province = p.options[p.selectedIndex].value;
        var city = '<?php echo $list['companyInfo']['city_id']?>';

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