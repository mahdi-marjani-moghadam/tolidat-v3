<?php
include_once("func.inc.php");

error_reporting(0);
set_time_limit(0);
//error_reporting(E_ALL);
error_reporting(0);
ini_set('display_errors',0);


$connect = mysqli_connect("localhost", "root", "", "witrin");
mysqli_set_charset($connect,'utf8');
$output = '';
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>با موفقیت ثبت شد</label><br /><table class='table table-bordered'>
  <tr>
	<td>نام دسته بندی</td>
	<td>والد</td>
  </tr>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();

   for($row=1; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    /*print_r($worksheet->getCellByColumnAndRow(0,10)->getValue());
    die();*/

   $fields['id']=$row;
   $fields['member_id']=$row;
   $fields['uniq_ads_id']=$row;

    $fields['ads_cat_id'] = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $fields['ads_cat_id']++;
    $fields['uniq_ads_id']=$fields['id'];
    $fields['product_id']='1';
    $fields['register_date']=date('Y-m-d H:i:s');
    $fields['start_date']=$fields['register_date'];
    $fields['start_ads_date']=$fields['register_date'];
    $fields['expire_date']= date('Y-m-d H:i:s', strtotime("+1 month"));
    $fields['expire_ads_date']= $fields['expire_date'];
    $fields['star']= 0;
    $fields['period']= '1 month';
    $fields['price']= '0';
    $fields['pey_date']=  $fields['start_date'];
    $fields['payment_type']= '';
    $fields['status']=  '30';

    $fields['title']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $fields['brief_description']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $fields['description']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $fields['keywords']='';

    $fields['ceo_name']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());


    $fields['city_id']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());

    if($fields['city_id']=='' or $fields['city_id']=='تهران')
    {
      $fields['city_id']='87';
      $fields['province_id']='8';
    }else{
      $fields['city_id']='';
      $fields['province_id']='';
    }
    $fields['Phone2']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $fields['Phone3']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
    $fields['Phone1']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(10, $row)->getValue());

    $fields['fax']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
    $fields['address']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
    $fields['web_site']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
    $fields['email']= mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
    $fields['product_description']= 'رایگان- یک ماهه';

$sql = "INSERT into ads(

												id
												,member_id
												,ads_cat_id
												,uniq_ads_id
												,product_id
												,agent_code
												,register_date
												,start_date
												,start_ads_date
												,expire_date
												,expire_ads_date
												,star
												,period
												,price
												,pey_date
												,payment_type
												,status
												,title
												,brief_description
												,description
												,keywords
												,city_id
												,Phone1
												,Phone2
												,Phone3
												,ceo_name
												,fax
												,address
												,web_site
												,email
												,product_description
												,province_id

											)
									 values(

												'".handleSql($fields['id'])."'
												,'".handleSql($fields['member_id'])."'
												,'".handleSql($fields['ads_cat_id'])."'
												,'".handleSql($fields['uniq_ads_id'])."'
												,'".handleSql($fields['product_id'])."'
												,'".handleSql($fields['agent_code'])."'
												,'".handleSql($fields['register_date'])."'
												,'".handleSql($fields['start_date'])."'
												,'".handleSql($fields['start_ads_date'])."'
												,'".handleSql($fields['expire_date'])."'
												,'".handleSql($fields['expire_ads_date'])."'
												,'".handleSql($fields['star'])."'
												,'".handleSql($fields['period'])."'
												,'".handleSql($fields['price'])."'
												,'".handleSql($fields['pey_date'])."'
												,'".handleSql($fields['payment_type'])."'
												,'".handleSql($fields['status'])."'
												,'".handleSql($fields['title'])."'
												,'".handleSql($fields['brief_description'])."'
												,'".handleSql($fields['description'])."'
												,'".handleSql($fields['keywords'])."'
												,'".handleSql($fields['city_id'])."'
												,'".handleSql($fields['Phone1'])."'
												,'".handleSql($fields['Phone2'])."'
												,'".handleSql($fields['Phone3'])."'
												,'".handleSql($fields['ceo_name'])."'
												,'".handleSql($fields['fax'])."'
												,'".handleSql($fields['address'])."'
												,'".handleSql($fields['web_site'])."'
												,'".handleSql($fields['email'])."'
												,'".handleSql($fields['product_description'])."'
												,'".handleSql($fields['province_id'])."'
												)";

    //$query = "INSERT INTO ads_cat(id,label,parent_id) VALUES ('".$id."','".$cat_name."', '".$parent_id."')";
    mysqli_query($connect, $sql);
    $password='123456'.$fields['member_id'];
    $email='witreen_'.$fields['member_id'].'@witreen.com';
    $query = "INSERT INTO members(member_id,password,name,mobile,email,register_date,status)
VALUES ('".$fields['member_id']."','".md5($password)."', '".$fields['title']."',
'".$fields['Phone1']."','".$email."', '".$fields['register_date']."','1')";
    mysqli_query($connect, $query);
    $output .= '<td>'.$cat_name.'</td>';
    $output .= '<td>'.$parent_id.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';

 }
 else
 {
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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
   <form method="post" enctype="multipart/form-data">
    <label>انتخاب فایل اکسل (xls,xlsx,csv)</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
 </body>
</html>

