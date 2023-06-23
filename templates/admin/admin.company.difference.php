<?php

include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
//ویرایش اطلاعات کمپانی رایگان را می خواهیم در این صفحه نمایش دهیم.
?>
    <meta charset="UTF-8">

    <div class="content-control">
        <!--control-nav-->
        <ul class="control-nav pull-right">
            <li><a class="rtl text-24"><i class="sidebar-icon fa fa-adn"></i> افزودن کمپانی جدید</a></li>
        </ul><!--/control-nav-->
    </div><!-- /content-control -->

    <div class="content-body">
        <div id="panel-tablesorter" class="panel panel-warning">
            <div class="panel-heading bg-white">
                <h3 class="panel-title rtl">فرم کمپانی</h3>

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

            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 center-block">

                        <?php if (isset($errMessage)): ?>
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?= $errMessage ?></strong>
                            </div>
                        <?php endif ?>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>کمپانی قدیمی</th>
                                <th>کمپانی جدید</th>
                            </tr>
                            </thead>


                            <tbody>
                            <tr>
                                <td>نام ویرایش کننده</td>
                                <td><?= $companyList['realCompany']['editor']['username'] ?></td>
                                <td><?= $companyList['realCompany']['editor']['username'] ?></td>
                            </tr>

                            <tr>
                                <th>شناسه ملی</th>
                                <td><?= $companyList['realCompany']['company']['national_id'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['national_id'] ?></td>
                            </tr>

                            <tr>
                                <th>شماره ثبت</th>
                                <td><?= $companyList['realCompany']['company']['registration_number'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['registration_number'] ?></td>
                            </tr>

                            <tr>
                                <th>اسم کمپانی</th>
                                <td><?= $companyList['realCompany']['company']['company_name'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['company_name'] ?></td>
                            </tr>

                            <tr>
                                <th>نوع کمپانی</th>
                                <td><?= $companyList['realCompany']['personality_type']['type'] ?></td>
                                <td><?= $companyList['draftCompany']['personality_type']['type'] ?></td>
                            </tr>

                            <tr>
                                <th>اسم مدیر</th>
                                <td><?= $companyList['realCompany']['company']['maneger_name'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['maneger_name'] ?></td>
                            </tr>

                            <tr>
                                <th>فعالیت شرکت</th>
                                <td><?= $companyList['realCompany']['company']['meta_description'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['meta_description'] ?></td>
                            </tr>

                            <tr>
                                <th>دسته بندی ها</th>
                                <td><?=$companyList['realCompany']['category']?></td>
                                <td><?= $companyList['draftCompany']['category']?></td>
                            </tr>

                            <tr>
                                <th>توضیحات</th>
                                <td><?= $companyList['realCompany']['company']['description'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['description'] ?></td>
                            </tr>

                            <tr>
                                <th>شهر</th>
                                <td><?= $companyList['realCompany']['city']['city_name'] ?></td>
                                <td><?= $companyList['draftCompany']['city']['city_name'] ?></td>
                            </tr>

                            <tr>
                                <th>استان</th>
                                <td><?= $companyList['realCompany']['city']['province_name'] ?></td>
                                <td><?= $companyList['draftCompany']['city']['province_name'] ?></td>
                            </tr>

                            <tr>
                                <th>ایمیل</th>
                                <td><?= $companyList['realCompany']['emails']['email'] ?></td>
                                <td><?= $companyList['draftCompany']['emails']['email'] ?></td>
                            </tr>

                            <tr>
                                <th>تلفن</th>
                                <td><?= $companyList['realCompany']['phones']['number'] ?></td>
                                <td><?= $companyList['draftCompany']['phones']['number'] ?></td>
                            </tr>

                            <tr>
                                <th>آدرس</th>
                                <td><?= $companyList['realCompany']['addresses']['address'] ?></td>
                                <td><?= $companyList['draftCompany']['addresses']['address'] ?></td>
                            </tr>

                            <tr>
                                <th>وب سایت</th>
                                <td><?= $companyList['realCompany']['webSites']['url'] ?></td>
                                <td><?= $companyList['draftCompany']['webSites']['url'] ?></td>
                            </tr>

                            <tr>
                                <th>تاریخ تاسیس</th>
                                <td><?= $companyList['realCompany']['company']['register_date'] ?></td>
                                <td><?= $companyList['draftCompany']['company']['register_date'] ?></td>
                            </tr>

                            <tr>
                                <th>مرجع تایید</th>
                                <td><?= $companyList['realCompany']['phones']['reference_value'] ?></td>
                                <td><?= $companyList['draftCompany']['phones']['reference_value'] ?></td>
                            </tr>

                            <tr>
                                <th>لوگو</th>
                                <td><img src="<?= ROOT_DIR . 'templates/admin/images' . $companyList['realCompany']['logo']['image']?>"></td>
                                <td><img src="<?= ROOT_DIR . 'templates/admin/images' . $companyList['draftCompany']['logo']['image'] ?>"></td>
                            </tr>

                            <tr>
                                <th>محصولات</th>
                                <td><?= $companyList['realCompany']['products']['title'] ?></td>
                                <td><?= $companyList['draftCompany']['products']['title'] ?></td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';

?>