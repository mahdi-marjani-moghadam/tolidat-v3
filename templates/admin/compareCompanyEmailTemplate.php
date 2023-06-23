<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
    <style type="text/css">

        * {
            padding: 0;
            margin: 0;
        }

        table {
            text-align: center;
            border-spacing: 0;
            border-collapse: collapse;
            border-top: #000000 solid 1px;
            border-left: #000000 solid 1px;
        }

        table td {
            border-right: #000000 solid 1px;
            border-bottom: #000000 solid 1px;
            padding: 10px 15px 10px 15px;
            font-size: 15px;
            font-weight: bold;
            color: #8546d2;
        }

        table th {
            border-right: #000000 solid 1px;
            border-bottom: #000000 solid 1px;
            padding: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .even {
            background-color: #eeeeee;
        }

        .odd {
            background-color: #dddddd;
        }
    </style>
</head>

<body style="
width: 100%;
height: 100%;
font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
background: #d2d2d2;
margin: 0;
padding: 0;
color: #000000;
direction:rtl;
">

<div class="content-body">
    <div id="panel-tablesorter" class="panel panel-warning">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 center-block">

                    <table class="table table-striped"
                            style="direction: rtl;width: 100%; height: 100%;">
                        <thead>
                        <tr>
                            <th colspan="3" style="background: rgb(48,80,50) ;border-bottom: #F8A025 solid 5px;">
                                <div style="width: 100%;margin: 0 auto;">
                                    <div style="width: 100%;margin: 0 auto;	color:#FFF;	font-size:18px;">
                                        <div style="padding: 10px 12px;">
                                            <div style="text-align:center; font-weight:bold">
                                                تولیدات دایرکتوری مشاغل
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </th>
                        </tr>
                        <tr class="odd">
                            <th></th>
                            <th>کمپانی قدیمی</th>
                            <th>کمپانی جدید</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr class="even" <?php echo($companyList['draftCompany']['editor']['username'] != $companyList['realCompany']['editor']['username'] ? "style='background-color: yellow'" : '') ?>>
                            <th>نام ویرایش کننده</th>
                            <td><?= $companyList['draftCompany']['editor']['username'] ?></td>
                            <td><?= $companyList['realCompany']['editor']['username'] ?></td>
                        </tr>

                        <?php if (empty($companyList['draftCompany']['licence'])) : ?>
                            <tr class="odd" <?php echo($companyList['draftCompany']['company']['national_id'] != $companyList['realCompany']['company']['national_id'] ? "style='background-color: yellow'" : '') ?>>
                                <th>شناسه ملی</th>
                                <td><?= $companyList['draftCompany']['company']['national_id'] ?></td>
                                <td><?= $companyList['realCompany']['company']['national_id'] ?></td>
                            </tr>
                        <?php else: ?>
                            <tr class="odd" <?php echo($companyList['draftCompany']['licence']['licence_number'] != $companyList['realCompany']['licence']['licence_number'] ? "style='background-color: yellow'" : '') ?>>
                                <th>شماره جواز</th>
                                <td><?= $companyList['draftCompany']['licence']['licence_number'] ?></td>
                                <td><?= $companyList['realCompany']['licence']['licence_number'] ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if (empty($companyList['draftCompany']['licence'])) : ?>
                            <tr class="even" <?php echo($companyList['draftCompany']['company']['registration_number'] != $companyList['realCompany']['company']['registration_number'] ? "style='background-color: yellow'" : '') ?>>
                                <th>شماره ثبت</th>
                                <td><?= $companyList['draftCompany']['company']['registration_number'] ?></td>
                                <td><?= $companyList['realCompany']['company']['registration_number'] ?></td>
                            </tr>
                        <?php else: ?>
                            <tr class="even" <?php echo($companyList['draftCompany']['licence']['licence_type'] != $companyList['realCompany']['licence']['licence_type'] ? "style='background-color: yellow'" : '') ?>>
                                <th>نوع جواز</th>
                                <td><?= $companyList['draftCompany']['licence']['licence_type'] ?></td>
                                <td><?= $companyList['realCompany']['licence']['licence_type'] ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr class="odd" <?php echo($companyList['draftCompany']['company']['company_name'] != $companyList['realCompany']['company']['company_name'] ? "style='background-color: yellow'" : '') ?>>
                            <th>اسم کمپانی</th>
                            <td><?= $companyList['draftCompany']['company']['company_name'] ?></td>
                            <td><?= $companyList['realCompany']['company']['company_name'] ?></td>
                        </tr>

                        <tr class="even" <?php echo($companyList['draftCompany']['personality_type']['type'] != $companyList['realCompany']['personality_type']['type'] ? "style='background-color: yellow'" : '') ?>>
                            <th>نوع کمپانی</th>
                            <td><?= $companyList['draftCompany']['personality_type']['type'] ?></td>
                            <td><?= $companyList['realCompany']['personality_type']['type'] ?></td>
                        </tr>

                        <tr class="odd" <?php echo($companyList['draftCompany']['company']['maneger_name'] != $companyList['realCompany']['company']['maneger_name'] ? "style='background-color: yellow'" : '') ?>>
                            <th>اسم مدیر</th>
                            <td><?= $companyList['draftCompany']['company']['maneger_name'] ?></td>
                            <td><?= $companyList['realCompany']['company']['maneger_name'] ?></td>
                        </tr>

                        <tr class="even" <?php echo($companyList['draftCompany']['company']['meta_description'] != $companyList['realCompany']['company']['meta_description'] ? "style='background-color: yellow'" : '') ?>>
                            <th>توضیحات مختصر</th>
                            <td><?= $companyList['draftCompany']['company']['meta_description'] ?></td>
                            <td><?= $companyList['realCompany']['company']['meta_description'] ?></td>
                        </tr>

                        <tr class="odd" <?php echo(convertDate($companyList['draftCompany']['company']['register_date']) != convertDate($companyList['realCompany']['company']['register_date']) ? "style='background-color: yellow'" : '') ?>>
                            <th>تاریخ تاسیس</th>
                            <td><?= convertDate($companyList['draftCompany']['company']['register_date']) ?></td>
                            <td><?= convertDate($companyList['realCompany']['company']['register_date']) ?></td>
                        </tr>

                        <tr class="even" <?php echo($companyList['draftCompany']['company']['description'] != $companyList['realCompany']['company']['description'] ? "style='background-color: yellow'" : '') ?>>
                            <th>توضیحات</th>
                            <td><?= $companyList['draftCompany']['company']['description'] ?></td>
                            <td><?= $companyList['realCompany']['company']['description'] ?></td>
                        </tr>

                        <tr class="odd" <?php echo($companyList['draftCompany']['category'] != $companyList['realCompany']['category'] ? "style='background-color: yellow'" : '') ?>>
                            <th>دسته بندی ها</th>
                            <td><?= $companyList['draftCompany']['category'] ?></td>
                            <td><?= $companyList['realCompany']['category'] ?></td>
                        </tr>

                        <tr class="even" <?php echo($companyList['draftCompany']['city']['state'] != $companyList['realCompany']['city']['state'] ? "style='background-color: yellow'" : '') ?>>
                            <th>استان</th>
                            <td><?= $companyList['draftCompany']['city']['state'] ?></td>
                            <td><?= $companyList['realCompany']['city']['state'] ?></td>
                        </tr>

                        <tr class="odd" <?php echo($companyList['draftCompany']['city']['city'] != $companyList['realCompany']['city']['city'] ? "style='background-color: yellow'" : '') ?>>
                            <th>شهر</th>
                            <td><?= $companyList['draftCompany']['city']['city'] ?></td>
                            <td><?= $companyList['realCompany']['city']['city'] ?></td>
                        </tr>

                        <tr class="even" <?php echo($companyList['draftCompany']['phones']['number'] != $companyList['realCompany']['phones']['number'] ? "style='background-color: yellow'" : '') ?>>
                            <th>تلفن</th>
                            <td><?= $companyList['draftCompany']['phones']['number'] ?></td>
                            <td><?= $companyList['realCompany']['phones']['number'] ?></td>
                        </tr>

                        <tr class="odd" <?php echo($companyList['draftCompany']['addresses']['address'] != $companyList['realCompany']['addresses']['address'] ? "style='background-color: yellow'" : '') ?>>
                            <th>آدرس</th>
                            <td><?= $companyList['draftCompany']['addresses']['address'] ?></td>
                            <td><?= $companyList['realCompany']['addresses']['address'] ?></td>
                        </tr>

                        <tr class="odd">
                            <th>بنر</th>
                            <td>
                                <img width="500" src="<?= COMPANY_ADDRESS . $companyList['draftCompany']['company']['company_id'] . '/banner/' . $companyList['draftCompany']['banner']['image'] ?>">
                            </td>
                            <td>
                                <img width="500" src="<?= COMPANY_ADDRESS . $companyList['realCompany']['company']['company_id'] . '/banner/' . $companyList['realCompany']['banner']['image'] ?>">
                            </td>
                        </tr>

                        <tr class="odd">
                            <th>لوگو</th>
                            <td>
                                <img width="150" src="<?= COMPANY_ADDRESS . $companyList['draftCompany']['company']['company_id'] . '/logo/' . $companyList['draftCompany']['logo']['image'] ?>">
                            </td>
                            <td>
                                <img width="150" src="<?= COMPANY_ADDRESS . $companyList['realCompany']['company']['company_id'] . '/logo/' . $companyList['realCompany']['logo']['image'] ?>">
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


