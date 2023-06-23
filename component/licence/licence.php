<?php

/*class c_product_d extends looeic {

}

class category extends looeic {

}

$products = c_product_d::getAll()->get();

foreach ($products['export']['list'] as $product) {
    $product_categories = tagToArray($product->old_category_id);

    foreach ($product_categories['export']['list'] as $product_category) {
        $category = category::getAll()->where('old_id', '=', $product_category)->get()['export']['list']['0'];
        $grandfatherCategory = category::getAll()->where('Category_id', '=', $category->parent_id)->get()['export']['list']['0'];
        $categoryArray[] = $category->Category_id;

        if (!in_array($category->parent_id, $parentCategoryArray)) {
            $parentCategoryArray[] = $category->parent_id;
        }
        if (!in_array($grandfatherCategory->parent_id, $parentCategoryArray)) {
            $parentCategoryArray[] = $grandfatherCategory->parent_id;
        }
    }

    $categoryString = arrayToTag($categoryArray);
    $parentCategoryString = arrayToTag($parentCategoryArray);
    $product->category_id = $categoryString['export']['list'];
    $product->parent_category_id = $parentCategoryString['export']['list'];
    $product->save();
    unset($categoryArray);
    unset($parentCategoryArray);
}

die('finish update product_d category');*/


/*class c_product extends looeic {

}

class category extends looeic {

}

$products = c_product::getAll()->get();

foreach ($products['export']['list'] as $product) {
    $product_categories = tagToArray($product->old_category_id);

    foreach ($product_categories['export']['list'] as $product_category) {
        $category = category::getAll()->where('old_id', '=', $product_category)->get()['export']['list']['0'];
        $grandfatherCategory = category::getAll()->where('Category_id', '=', $category->parent_id)->get()['export']['list']['0'];
        $categoryArray[] = $category->Category_id;

        if (!in_array($category->parent_id, $parentCategoryArray)) {
            $parentCategoryArray[] = $category->parent_id;
        }
        if (!in_array($grandfatherCategory->parent_id, $parentCategoryArray)) {
            $parentCategoryArray[] = $grandfatherCategory->parent_id;
        }
    }

    $categoryString = arrayToTag($categoryArray);
    $parentCategoryString = arrayToTag($parentCategoryArray);
    $product->category_id = $categoryString['export']['list'];
    $product->parent_category_id = $parentCategoryString['export']['list'];
    $product->save();
    unset($categoryArray);
    unset($parentCategoryArray);
}

die('finish update product category');*/


//class company_d extends looeic {
//
//}
//
//$company = company::getAll()->get();
////dd($company);
//foreach ($company['export']['list'] as $comp) {
//
//    $company_d = company_d::getAll()->where('company_id', '=', $comp->Company_id)->get();
//
//    foreach ($company_d['export']['list'] as $comp_d) {
//        $comp_d->category_id = $comp->category_id;
//        $comp_d->parent_category_id = $comp->parent_category_id;
//
//        $comp_d->save();
//    }
//}
//
//die('finish');


/*class category_khodam extends looeic {

}

class category extends looeic {

}

$category_khodam = category_khodam::getAll()->where('image_1', '<>', '')->get();
foreach ($category_khodam['export']['list'] as $cat_khodam) {
    $category = category::find($cat_khodam->Category_id);
    $category->img_name = $cat_khodam->img_name;
    $category->image_1 = $cat_khodam->image_1;
    $category->image_2 = $cat_khodam->image_2;
    $category->image_3 = $cat_khodam->image_3;
    $category->image_4 = $cat_khodam->image_4;
    $category->save();
}*/

/*class company_d extends looeic {

}

$company = company::getAll()->get();
//dd($company);
foreach ($company['export']['list'] as $comp) {

    $company_d = company_d::getAll()->where('company_id', '=', $comp->Company_id)->get();

    foreach ($company_d['export']['list'] as $comp_d) {
        $comp_d->category_id = $comp->category_id;
        $comp_d->parent_category_id = $comp->parent_category_id;

        $comp_d->save();
    }
}

die('finish');*/

/*class company_ghadim extends looeic
{

}

class company_server extends looeic
{

}*/

/*$company_ghadim = company_ghadim::getAll()->get();

foreach ($company_ghadim['export']['list'] as $comp) {
    $company_server = company_server::find($comp->Company_id);
    if (is_object($company_server)) {
        $company_server->category_id = $comp->category_id;
        $company_server->save();
    }
}

die('finish');*/


/*include_once(dirname(__FILE__) . "/model/licence.controller.php");

global $PARAM;

$licenceController = new licenceController();
if (isset($exportType)) {
    $licenceController->exportType = $exportType;
}

//print_r($PARAM);
//die();
$licenceController->showLicenceDetail($PARAM[2]);*/

include_once ROOT_DIR . "component/category/member/model/member.category.model.php";
include_once ROOT_DIR . "component/register/model/register.model.php";
//
//// برای اون کمپانی هایی که در فیلد category_id آن پدرها ذخیره نشده اند. پدرها را پیدا کرده و در فیلد parent_category_id ذخیره میکند.

//$categories = category::getAll()
//    ->select('Category_id', 'parent_id')
//    ->keyBy('Category_id')
//    ->where('parent_id', '!=', 0)
//    ->getList()['export']['list'];
//
////print_r_debug($categories);
//$sql = "SELECT Company_id, category_id, parent_category_id FROM company ORDER by Company_id DESC limit 500";
//$companies = company::getAll()->query($sql)->get()['export']['list'];
//
//foreach ($companies as $company) {
//    $companyCategoryArr = explode(',', $company->category_id);
//    $catID = array();
//    foreach ($categories as $category) {
//
//        if (in_array($category['Category_id'], $companyCategoryArr) & !in_array($category['parent_id'], $catID)) {
//
//            $catID[] = $category['parent_id'];
//
//            // echo $categories[$category['parent_id']]['parent_id'];
//            if (!in_array($categories[$category['parent_id']]['parent_id'], $catID)) {
//
//                $catID[] = $categories[$category['parent_id']]['parent_id'];
//            }
//        }
//
//    }
//
//    if (!empty($catID)) {
//        $catID = "," . implode($catID, ',') . ",";
//        $company->parent_category_id = $catID;
//        $company->save();
//    }
//}
//dd('end');

//$categories = category::getAll()
//    ->select('Category_id', 'parent_id')
//    ->keyBy('Category_id')
//    ->where('parent_id', '!=', 0)
//    ->getList()['export']['list'];
//
//
//$sql = "SELECT Company_id, category_id, parent_category_id FROM company ORDER by Company_id DESC ";
//$companies = company::getAll()->query($sql)->get()['export']['list'];
//
//foreach ($companies as $company) {
//    $companyCategoryArr = explode(',', $company->category_id);
//    $catID = array();
//    foreach ($categories as $category) {
//
//        if (in_array($category['Category_id'], $companyCategoryArr) & !in_array($category['parent_id'], $catID)) {
//
//            $catID[] = $category['parent_id'];
//
//            // echo $categories[$category['parent_id']]['parent_id'];
//            if (!in_array($categories[$category['parent_id']]['parent_id'], $catID)) {
//
//                $catID[] = $categories[$category['parent_id']]['parent_id'];
//            }
//        }
//
//    }
//
//    if (!empty($catID)) {
//        $catID = "," . implode($catID, ',') . ",";
//        $company->parent_category_id = $catID;
//        $company->save();
//    }
//}
//
//$sql = "SELECT Company_d_id, category_id, parent_category_id FROM company_d ORDER by Company_d_id DESC ";
//$companies = company_d::getAll()->query($sql)->get()['export']['list'];
//
//foreach ($companies as $company) {
//    $companyCategoryArr = explode(',', $company->category_id);
//    $catID = array();
//    foreach ($categories as $category) {
//
//        if (in_array($category['Category_id'], $companyCategoryArr) & !in_array($category['parent_id'], $catID)) {
//
//            $catID[] = $category['parent_id'];
//
//            // echo $categories[$category['parent_id']]['parent_id'];
//            if (!in_array($categories[$category['parent_id']]['parent_id'], $catID)) {
//
//                $catID[] = $categories[$category['parent_id']]['parent_id'];
//            }
//        }
//
//    }
//
//    if (!empty($catID)) {
//        $catID = "," . implode($catID, ',') . ",";
//        $company->parent_category_id = $catID;
//        $company->save();
//    }
//}
//dd('end');

include_once ROOT_DIR . "component/licence/model/licence.controller.php";

global $PARAM;

$licenceController = new licenceController();

if (isset($exportType)) {
    $licenceController->exportType = $exportType;
}

switch ($PARAM['1']) {
    case "all" :
        $licenceController->index($PARAM['2']);
        break;
    case "show" :
        $licenceController->show($PARAM['2']);
        break;
}
