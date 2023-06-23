<?php
$connect = mysqli_connect("localhost", "root", "", "excel");
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
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $cat_name = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $parent_id = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $query = "INSERT INTO cat(cat_name,parent_id) VALUES ('".$cat_name."', '".$parent_id."')";
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

