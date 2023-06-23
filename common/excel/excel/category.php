<?php
error_reporting(0);
set_time_limit(0);
//error_reporting(E_ALL);
error_reporting(0);
ini_set('display_errors',0);


$connect = mysqli_connect("localhost", "root", "", "tolidat");
//print_r($connect);
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

    $Category_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $Category_id=$Category_id*10000;
    $old_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
    $code = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());

    if(strlen($old_id)!='')
    {
     $Category_id=$old_id;
    }
    //$id++;
    $cat_name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $parent_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
    $parent_id=$parent_id*10000;


     /*    Category_id
     new_category
     parent_id
     title
     group
     group_sub
     alt
     url
     meta_keyword
     meta_description
     img_name
     status
     sort  */


    /*if($parent_id!='0')
    {
     $parent_id++;
    }*/
    $query = "INSERT INTO category(Category_id,old_id,title,parent_id,code)
 VALUES ('".$Category_id."'
 ,'".$old_id."'
 ,'".$cat_name."'
 , '".$parent_id."'
  , '".$code."'
 )";



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

