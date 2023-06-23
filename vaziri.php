<?php

include_once ROOT_DIR . "component/category/member/model/member.category.model.php";
include_once ROOT_DIR . "component/register/model/register.model.php";

// برای اون کمپانی هایی که در فیلد category_id آن پدرها ذخیره نشده اند. پدرها را پیدا کرده و در فیلد parent_category_id ذخیره میکند.

$categories = category::getAll()->select('Category_id', 'parent_id')->where('parent_id', '!=', 0)->getList()['export']['list'];

$sql = "SELECT Company_id, category_id, parent_category_id FROM company WHERE parent_category_id IS NULL";
$companies = company::getAll()->query($sql)->get()['export']['list'];

$sql1 = "SELECT Company_d_id, category_id, parent_category_id FROM company_d WHERE parent_category_id IS NULL";
$companiess = company_d::getAll()->query($sql1)->get()['export']['list'];

foreach ($companies as $company) {
    $companyCategoryArr = explode(',', $company->category_id);
    $catID = array();
    foreach ($categories as $category) {
        if (in_array($category['Category_id'], $companyCategoryArr) & !in_array($category['parent_id'], $catID)) {
            $catID[] = $category['parent_id'];
        }
    }
    if (!empty($catID)) {
        $catID = "," . implode($catID, ',') . ",";
        $company->parent_category_id = $catID;
        $company->save();
    }
}

foreach ($companiess as $company) {
    $companyCategoryArr = explode(',', $company->category_id);
    $catID = array();
    foreach ($categories as $category) {
        if (in_array($category['Category_id'], $companyCategoryArr) & !in_array($category['parent_id'], $catID)) {
            $catID[] = $category['parent_id'];
        }
    }
    if (!empty($catID)) {
        $catID = "," . implode($catID, ',') . ",";
        $company->parent_category_id = $catID;
        $company->save();
    }
}

die();

// برای اون کمپانی هایی که در فیلد category_id آن پدرها ذخیره شده است. پدرها را از فیلد category_id حذف کرده و در فیلد parent_category_id ذخیره میکند.

$categories = category::getAll()->select('Category_id')->where('parent_id', '=', 0)->getList()['export']['list'];
$companies = company::getAll()->select('Company_id', 'category_id')->get()['export']['list'];
$companiess = company_d::getAll()->select('Company_d_id', 'category_id')->get()['export']['list'];


foreach ($companies as $company) {
    $companyCategoryArr = explode(',', $company->category_id);
    $catID = "";
    $catDelete = "";
    foreach ($categories as $category) {
        if (in_array($category['Category_id'], $companyCategoryArr)) {
            $catID .= "," . $category['Category_id'];
            $catDelete = "," . $category['Category_id'];
            $company->category_id = str_replace($catDelete, '', $company->category_id);
        }
    }
    if ($catID != "") {
        $catID .= ",";
        $company->parent_category_id = $catID;
    }
    $company->save();
}

foreach ($companiess as $company) {
    $companyCategoryArr = explode(',', $company->category_id);
    $catID = "";
    $catDelete = "";
    foreach ($categories as $category) {
        if (in_array($category['Category_id'], $companyCategoryArr)) {
            $catID .= "," . $category['Category_id'];
            $catDelete = "," . $category['Category_id'];
            $company->category_id = str_replace($catDelete, '', $company->category_id);
        }
    }
    if ($catID != "") {
        $catID .= ",";
        $company->parent_category_id = $catID;
    }
    $company->save();
}

die();

// تبدبل حروف عربی به حروف فارسی در جدول کمپانی و کمپانی درفت

ini_set('memory_limit', '51200M');
include_once ROOT_DIR . "component/register/model/register.model.php";


$companies = company::getAll()->get();
$companiess = company_d::getAll()->get();
//die('a');
foreach ($companies['export']['list'] as $company) {
    $company->company_name = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->company_name);
    $company->meta_description = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->meta_description);
    $company->description = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->description);
    $company->save();
}

foreach ($companiess['export']['list'] as $company) {
    $company->company_name = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->company_name);
    $company->meta_description = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->meta_description);
    $company->description = str_replace(array('ي', 'ك'), array('ی', 'ک'), $company->description);
    $company->save();
}

die('finish');


?>

<?php
echo phpinfo();
die();

$xml = ('http://mehrnews.com/rss/tp/25');
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$channel = $xmlDoc->getElementsByTagName('channel')->item(0);
$items = $channel->getElementsByTagName('item');
$fields = array();
foreach ($items as $key => $value) {
    echo "<pre>";
    print_r($value->getElementsByTagName('enclosure')->item(0)->attributes[0]->nodeValue);
    echo "</pre>";
    die();
    $fields[$key]['title'] = $value->getElementsByTagName('title')->item(0)->nodeValue;
    $fields[$key]['description'] = $value->getElementsByTagName('description')->item(0)->nodeValue;
    $fields[$key]['image'] = $value->getElementsByTagName('enclosure')->item(0)->attributes[0]->nodeValue;
    $fields[$key]['link'] = $value->getElementsByTagName('guid')->item(0)->nodeValue;
}
echo "<pre>";
print_r($fields);
echo "</pre>";
die();

?>


