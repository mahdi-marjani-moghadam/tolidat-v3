<?php
error_reporting(1);
set_time_limit(0);
error_reporting(E_ALL);
error_reporting(1);
ini_set('display_errors', 1);
include_once dirname(__FILE__) . '/companyAddresses.model.php';
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';
include_once ROOT_DIR . 'component/register/model/register.model.php';
include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
include_once ROOT_DIR . 'component/city/model/city.model.php';
include_once ROOT_DIR . 'component/province/model/province.model.php';
require_once ROOT_DIR . "model/Rate.php";

//$connect = mysqli_connect("localhost", "root", "", "tolidat");
//print_r($connect);
//mysqli_set_charset($connect,'utf8');
$output = '';
if (isset($_POST["import"])) {
    $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
    $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
    if (in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
    {
        $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
        include_once ROOT_DIR . 'common/excel/excel/PHPExcel.php'; // Add PHPExcel Library in this code
        $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

        $output .= "<label class='text-success'>با موفقیت ثبت شد</label><br /><table class='table table-bordered'>
  <tr>
	<!--<td>نام دسته بندی</td>
	<td>والد</td>-->
  </tr>";
//        echo '<pre/>';
//        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
//            $highestRow = $worksheet->getHighestRow();
//            for ($row = 2; $row <= $highestRow; $row++) {
//                $output .= "<tr>";
////<------------------------get province----------------------->
//                $province_name = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
//            /*    echo '<pre/><br/>';
//                print_r($province_name);*/
//                $province = province::getBy_name(trim($province_name))->getList()['export']['list']['0']['province_id'];
//                if (($province)=='') {
//                    print_r_debug('استان ' . $province_name . ' وجود ندارد ');
//                }
////<------------------------get city----------------------->
//                $city_name = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
//                $city = city::getBy_name(trim($city_name))->getList()['export']['list']['0']['City_id'];
//                if ($city=='') {
//                    print_r_debug('شهرستان ' . $city_name . ' وجود ندارد');
//                }
//            }
//        }
        echo '<pre/>';

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            for ($row = 2; $row <= $highestRow; $row++) {
                $output .= "<tr>";
//<---------------------add postalCode----------------->
//                $code_posti = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
//                $comp_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
//                $address = c_addresses::getBy_company_id_and_isMain($comp_id, 1)->first();
//                $company_id = $address->company_id;
//            /*    if (is_object($address)) {
//                    $address->postal_code = $code_posti;
//                }*/
//
//                $address_d = c_addresses_d::getBy_company_id_and_isMain_and_isActive($comp_id, 1, 1)->first();
//                if (is_object($address_d)) {
//                    $address_d->postal_code = $code_posti;
//                }
//
//                if (!intval($code_posti) or !intval($company_id) or ($company_id == '17428')) {
//                    continue;
//                }
//                $addresses_id = $address_d->Addresses_id;
//               // $address->save();
//                $address_d->save();


                //<------------------------add company----------------------->
                $company = new company();
                $company->company_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $company->description = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $company->personality_type = 17;
                $company->category_id = ',3490000,';
                $company->isAdmin = 1;
                $company->edit = '0000000000000000000000000';
                $company->status = 1;
                $company->package_id = 0;
                $company->package_status = 1;
                $company->company_type = 1;
                $company->new_register = 0;
                $company->lock = 0;
                $company->parent_category_id = ',3460000,3370000,';
                $company->registration_number = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $company->national_id = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $company->maneger_name = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $province_name = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $province_id = province::getBy_name(trim($province_name))->getList()['export']['list']['0']['province_id'];
                $company->state_id = $province_id;
                $city_name = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $city_id = city::getBy_name(trim($city_name))->getList()['export']['list']['0']['City_id'];
                $company->city_id = $city_id;
                $company->meta_keyword = 'بیمه';
                $company->meta_description = 'بیمه';
                $company->admin_description = '';
                $company->catalog = '';
                $company->video_script = '';
                $company->product_category = '';
                $company->register_date = '2013-03-21 09:19:45';
                $company->registration_date = '2018-06-04 09:19:45';
                $company->refresh_date = '2018-06-08 09:19:45';
                $company->confirm_date = '2018-06-06 09:19:45';
                $company->save();

                echo '<br/>';
                print_r($company->Company_id);
                //<------------------------add company_d(first record)----------------------->
                $company_d = new company_d();
                $company_d->company_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $company_d->description = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $company_d->company_id = $company->Company_id;
                $company_d->personality_type = 17;
                $company_d->category_id = ',3490000,';
                $company_d->isAdmin = 1;
                $company_d->status = 1;
                $company_d->package_id = 0;
                $company_d->package_status = 1;
                $company_d->company_type = 1;
                $company_d->editor_id = 39;
                $company_d->isActive =  0;
                $company_d->new_register = 1;
                $company_d->lock = 0;
                $company_d->parent_category_id = ',3460000,3370000,';
                $company_d->registration_number = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $company_d->national_id = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $company_d->maneger_name = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $province_name = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $province_id = province::getBy_name(trim($province_name))->getList()['export']['list']['0']['province_id'];
                $company_d->state_id = $province_id;
                $city_name = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $city_id = city::getBy_name(trim($city_name))->getList()['export']['list']['0']['City_id'];
                $company_d->city_id = $city_id;
                $company_d->meta_keyword = 'بیمه';
                $company_d->meta_description = 'بیمه';
                $company_d->admin_description = '';
                $company_d->catalog = '';
                $company_d->video_script = '';
                $company_d->product_category = '';
                $company_d->register_date = '2013-03-21 09:19:45';
                $company_d->registration_date = '2018-06-04 09:19:45';
                $company_d->refresh_date = '2018-06-08 09:19:45';
                $company_d->confirm_date = '2018-06-06 09:19:45';
                $company_d->save();
                //<------------------------add company_d(second record)----------------------->
                $companies = new company_d();
                $companies->company_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $companies->description = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $companies->company_id = $company->Company_id;
                $companies->personality_type = 17;
                $companies->category_id = ',3490000,';
                $companies->isAdmin = 1;
                $companies->status = 1;
                $companies->package_id = 0;
                $companies->package_status = 1;
                $companies->company_type = 1;
                $companies->isActive = 1;
                $companies->editor_id = 39;
                $companies->new_register = 0;
                $companies->lock = 0;
                $companies->parent_category_id = ',3460000,3370000,';
                $companies->registration_number = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                $companies->national_id = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                $companies->maneger_name = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                $province_name = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $province_id = province::getBy_name(trim($province_name))->getList()['export']['list']['0']['province_id'];
                $companies->state_id = $province_id;
                $city_name = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $city_id = city::getBy_name(trim($city_name))->getList()['export']['list']['0']['City_id'];
                $companies->city_id = $city_id;
                $companies->meta_keyword = 'بیمه';
                $companies->meta_description = 'بیمه';
                $companies->admin_description = '';
                $companies->catalog = '';
                $companies->video_script = '';
                $companies->product_category = '';
                $companies->register_date = '2013-03-21 09:19:45';
                $companies->registration_date = '2018-06-04 09:19:45';
                $companies->refresh_date = '2018-06-08 09:19:45';
                $companies->confirm_date = '2018-06-06 09:19:45';
                $companies->save();

                //<------------------------add c_phones----------------------->
                $phone = new c_phones();
                $phone->code = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $phone->number = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $phone->branch_id = 0;
                $phone->company_id = $company->Company_id;
                $phone->subject = 'مرکزی';
                $phone->state = '';
                $phone->value = '';
                $phone->reference_value = '';
                $phone->isMain = 1;
                $phone->save();
                //<------------------------add c_phones_d(first record)---------------->
                $phones_d = new c_phones_d();
                $phones_d->code = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $phones_d->number = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $phones_d->phones_id = $phone->Phones_id;
                $phones_d->company_id = $company->Company_id;
                $phones_d->company_d_id = $company_d->Company_d_id;
                $phones_d->branch_id = 0;
                $phones_d->editor_id = 39;
                $phones_d->subject = 'مرکزی';
                $phones_d->state = '';
                $phones_d->value = '';
                $phones_d->reference_value = '';
                $phones_d->isMain = 1;
                $phones_d->isAdmin = 1;
                $phones_d->status = 1;
                $phones_d->isActive = 0;
                $phones_d->date = '2018-06-04 09:19:45';
                $phones_d->save();
                //<------------------------add c_phones_d(second record)---------------->
                $phone_d = new c_phones_d();
                $phone_d->code = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $phone_d->number = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $phone_d->phones_id = $phone->Phones_id;
                $phone_d->company_id = $company->Company_id;
                $phone_d->company_d_id = $companies->Company_d_id;
                $phone_d->branch_id = 0;
                $phone_d->editor_id = 39;
                $phone_d->subject = 'مرکزی';
                $phone_d->isMain = 1;
                $phone_d->state = '';
                $phone_d->value = '';
                $phone_d->reference_value = '';
                $phone_d->isAdmin = 1;
                $phone_d->status = 1;
                $phone_d->isActive = 1;
                $phone_d->date = '2018-06-06 09:19:45';
                $phone_d->save();
                //<------------------------add c_addresses----------------------->
                $address = new c_addresses();
                $address->address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $address->branch_id = 0;
                $address->company_id = $company->Company_id;
                $address->subject = 'مرکزی';
                $address->postal_code = '';
                $address->isMain = 1;
                $address->save();
                //<------------------------add c_addresses_d(first record)---------------->
                $address_d = new c_addresses_d();
                $address_d->address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $address_d->addresses_id = $address->Addresses_id;
                $address_d->company_id = $company->Company_id;
                $address_d->company_d_id = $company_d->Company_d_id;
                $address_d->branch_id = 0;
                $address_d->editor_id = 39;
                $address_d->subject = 'مرکزی';
                $address_d->postal_code = '';
                $address_d->isMain = 1;
                $address_d->isAdmin = 1;
                $address_d->status = 1;
                $address_d->isActive = 0;
                $address_d->date = '2018-06-04 09:19:45';
                $address_d->save();
                //<------------------------add c_addresses_d(second record)---------------->
                $addresses_d = new c_addresses_d();
                $addresses_d->address = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $addresses_d->addresses_id = $address->Addresses_id;
                $addresses_d->company_id = $company->Company_id;
                $addresses_d->company_d_id = $companies->Company_d_id;
                $addresses_d->branch_id = 0;
                $addresses_d->postal_code = '';
                $addresses_d->editor_id = 39;
                $addresses_d->subject = 'مرکزی';
                $addresses_d->isMain = 1;
                $addresses_d->isAdmin = 1;
                $addresses_d->status = 1;
                $addresses_d->isActive = 1;
                $addresses_d->date = '2018-06-06 09:19:45';
                $addresses_d->save();
                $rateaervice = new Rate($company);
                $rate = $rateaervice->calculation();
                $company_d->priority = $company->priority;
                $company_d->priorityDetails = $company->priorityDetails;
                $company_d->save();
                //<------------------------add company_d----------------------->

            }
        }

    } else {
        $output = '<label class="text-danger">فرمت فایل قابل قبول نیست</label>'; //if non excel file then
    }


}
?>

<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 700px;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 5px;
            margin-top: 100px;
        }

    </style>
</head>
<body>
<div class="container box">
    <form method="post" enctype="multipart/form-data">
        <label>انتخاب فایل اکسل (xls,xlsx,csv)</label> <input type="file" name="excel"/> <br/>
        <input type="submit" name="import" class="btn btn-info" value="Import"/>
    </form>
    <br/> <br/>
    <?php
    echo $output;
    ?>
</div>
</body>
</html>

