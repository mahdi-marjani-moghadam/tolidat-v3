<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 *//*
include_once ROOT_DIR . 'component/product/member/model/product.model.php';
include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.controller.php';*/


include_once ROOT_DIR . 'component/company/model/company.model.php';
include_once ROOT_DIR . 'component/company/model/company.controller.php';
include_once ROOT_DIR . 'component/search/model/SearchModel.php';

include_once ROOT_DIR . 'component/companyLogo/member/model/companyLogo.model.php';
include_once ROOT_DIR . 'component/product/member/model/product.model.php';
include_once ROOT_DIR . 'component/certification/member/model/certification.model.php';
include_once ROOT_DIR . 'component/companyBanner/member/model/companyBanner.model.php';
include_once ROOT_DIR . 'component/honour/member/model/honour.model.php';
include_once ROOT_DIR . 'component/businessLicence/member/model/businessLicence.model.php';
include_once ROOT_DIR . 'component/history/member/model/history.model.php';
include_once ROOT_DIR . 'component/companyNews/member/model/companyNews.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.model.php';
include_once ROOT_DIR . 'component/companyAddresses/model/companyAddresses.model.php';
include_once ROOT_DIR . 'component/licence/member/model/licence.model.php';
include_once ROOT_DIR . 'component/companyCommercialName/member/model/companyCommercialName.model.php';
include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
include_once ROOT_DIR . 'component/companyEmails/model/companyEmails.model.php';
include_once ROOT_DIR . 'component/companyWebsites/model/companyWebsites.model.php';
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.model.php';
include_once ROOT_DIR . 'component/representation/member/model/representation.model.php';
include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.controller.php';
include_once ROOT_DIR . 'component/category/model/category.model.php';
include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
include_once ROOT_DIR . 'component/register/model/register.model.php';
include_once ROOT_DIR . "component/packageUsage/member/model/member.packageUsage.model.php";
include_once ROOT_DIR . 'component/category/model/category.model.db.php';
include_once ROOT_DIR . 'component/package/member/model/package.model.php';
include_once ROOT_DIR . 'component/personalityType/model/personalityType.model.php';
include_once ROOT_DIR . 'component/employment/model/Employment.php';
include_once ROOT_DIR . 'component/companyAdvertise/model/Advertise.php';
require_once ROOT_DIR . "/model/Rate.php";
include_once dirname(__FILE__) . '/product.model.php';


/**
 * Class articleController.
 */
class productController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
     * @var
     */
    public $fileName;

    /**
     * articleController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * call template.
     *
     * @param string $list
     * @param $msg
     *
     * @return string
     */
    public function template($list = [], $msg = '')
    {
        // global $conn, $lang;

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
                break;

            case 'json':
                echo json_encode($list);
                break;
            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;
            default:
                break;
        }
    }

    /**
     *  get Product By Company Id.
     *
     * @param $id
     *
     * @author malekloo
     * @date 3/29/2016
     *
     * @version 01.01.01
     */
    public function getProductByCompanyId($id)
    {
        $product = new productModel();
        $result = $product->getProductByCompanyId($id);

        if ($result['result'] != '1') {
            $msg = 'not found';
            redirectPage(RELA_DIR, $msg);
        }

        // // breadcrumb
        // global $breadcrumb;
        // $breadcrumb->reset();
        // $breadcrumb->add('محصولات');
        // $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = 'product.showMore.php';
        $this->template($product->fields);
        die();
    }

    public function showProductDetail($id)
    {
        global $breadcrumb;
        $breadcrumb->reset();

        $product = c_product::find($id);
        if (!is_object($product)) {
            $msg = 'محصول پیدا نشد';
            redirectPage(RELA_DIR, $msg);
        }
        $export['company_id'] = $product->company_id;
        $fields = c_product_lang::translateProduct($product->fields);
        $export['list'] = $fields;
        
        $export['list']['gallery'] = $product->galleries();
        $company = company::find($product->company_id);

        $export['msg'] = 'در این صفحه جزئیات محصول ' . $product->title . ' از کمپانی ' . $company->company_name . ' قابل مشاهده است';
        if (mb_strlen($export['msg'] . $product->brif_description) < 160) {
            $export['brif_description_msg'] = $export['msg'] . '. ' . mb_substr($product->brif_description, 0, (180 - mb_strlen($product->brif_description)));
        } else {
            $export['brif_description_msg'] = $export['msg'];
        }

        if (mb_strlen($export['msg'] . $product->brif_description) < 160) {
            $export['brif_description_msg'] = $export['brif_description_msg'] . (strcmp($product->description, $product->brif_description) ? ('- ' . mb_substr($product->description, 0, (160 - mb_strlen($export['brif_description_msg'])))) : '');
        }
        $export['seo'] = array(
            'title' => $product->title . '- ' . $company->company_name . '- تولیدات',
            'meta_keyword' => strlen($product->meta_keyword) > 0 ? $product->meta_keyword : $product->title . '- تولیدات',
            'description' => mb_strlen($export['brif_description_msg']) > 0 ? $export['brif_description_msg'] : $export['msg'],
        );
        $export['canonical'] = RELA_DIR . 'product/show/' . $id . '/' . cleanUrl($product->title);

        // use category model func by getCategory
        include_once ROOT_DIR . 'component/category/model/category.model.php';
        $category_id = substr($product->category_id, 1, -1);
        $category_id = explode(',', $category_id);
        if (empty($category_id[0])) {
            $category_id = null;
        }
        $category = new categoryModel();
        if (count($category_id) > 0) {
            $resultCategory = $category->getCategory($category_id);
            if ($resultCategory['result'] == 1) {
                $export['category_list'] = $resultCategory['export']['list'];

                // foreach ($resultCategory['export']['list'] as $key => $value) {
                //     $breadcrumb->add($value['title'] . ' ', 'company/type/تولیدی/category/' . $value['Category_id'], true);
                // }
            }
        }


        // Meta keyword
        $export['metaKeyword_list'] = tagToArray($product->meta_keyword)['export']['list'];

        // other products
        $resultOtherProducts = c_product::getBy_company_id_and_not_Product_id($product->fields['company_id'], $id)->getList();
        if ($resultOtherProducts['result'] == 1) {
            $export['other_product_list'] = c_product_lang::translateProduct($resultOtherProducts)['export']['list'];
        }

        // related products
        include_once ROOT_DIR . 'component/product/model/product.model.php';
        $relatedProduct = new Product();
        $resultRelatedProducts = $relatedProduct->getRelatedProducts($product->Product_id, $export['metaKeyword_list']);
        if ($resultRelatedProducts['result'] == 1) {
            $export['related_products_list'] = $resultRelatedProducts['export']['list'];
        }

        // address company
        include_once ROOT_DIR . 'component/companyAddresses/model/companyAddresses.model.php';
        $address = c_addresses::getBy_company_id($product->company_id)->getList();
        $export['address'] = $address['export']['list'];
        // ---------------

        // phone company
        include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
        $phone = c_phones::getBy_company_id($product->company_id)->getList();
        $export['phone'] = $phone['export']['list'];
        // -------------

        // position company
        include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.controller.php';
        $export['position'] = positionController::getCompanyPosition($product->company_id);
        //----------------


        $companyObject = new companyController();

        $export['side'] = $companyObject->sidebarMenu($product->company_id);
        // get company
        // breadcrumb
        $categoryResult = categoryModelDb::getCategoryByIdString($company->category_id);
        // $categories = $categoryResult['export']['list'];
        // dd($categoryResult);
        foreach ($categoryResult as $key => $value) {
            $breadcrumb->add($value['title'] . ' ', 'company/type/تولیدی/category/' . $value['Category_id'], true);
        }

        $breadcrumb->add($company->company_name . ' ', 'company/Detail/' . $product->fields['company_id'] . '/' . cleanUrl($company->company_name), true);
        $breadcrumb->add('محصولات/خدمات', 'product/all/' . $product->fields['company_id'], true);
        $breadcrumb->add($product->fields['title']);
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = 'product.showDetail.php';
        $this->template($export);
        die();
    }

    public function showAllProduct($company_id)
    {
        $company = company::find($company_id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }
        $companyObject = new companyController();

        // get company
        $id = $company_id;

        $export['side'] = $companyObject->sidebarMenu($id);
        // get company


        $products = Product::getAll()
            ->where('company_id', '=', $company_id)
            ->where('status', '=', 1)
            ->getList();
        $export['products'] = $products['export']['list'];

        $category = category::getAll()->keyBy('Category_id')->getList()['export']['list'];

        foreach ($export['products'] as $key => $value) {
            $category_id = tagToArray($value['category_id'])['export']['list']['1'];
            $export['products'][$key]['category_name'] = $category[$category_id]['title'];
        }

        $export['msg'] = 'در این صفحه محصولات کمپانی ' . $company->company_name . ' قابل مشاهده است';
        $export['seo'] = array(
            'title' => 'محصولات شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => empty($company->description) ? $export['msg'] : minimizeText($company->description, 500, '...'),
        );


        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $reqReferer = urldecode($_SERVER['HTTP_REFERER']);
        $reqRefererArray = explode('/', urldecode($_SERVER['HTTP_REFERER']));

        $searchIndex = array_search('search', $reqRefererArray);

        if ($searchIndex) {

            $qIndex = array_search('q', $reqRefererArray);
            if ($qIndex) {
                $breadcrumb->add('جستجو : ' . $reqRefererArray[$qIndex + 1], $reqReferer, true);
            } else {
                $breadcrumb->add('جستجو', $reqReferer, true);
            }
            $breadcrumb->add($company->fields['company_name'] . ' ', 'company/Detail/' . $company->fields['Company_id'] . '/' . $company->fields['company_name'], true);
            unset($_SESSION['companyBreadcrumb']);
            $_SESSION['companyBreadcrumb'] = serialize($breadcrumb);
            $breadcrumb->pop();
        } else {
            unset($_SESSION['companyBreadcrumb']);
            // get company categories
            $categoryResult = categoryModelDb::getCategoryByIdString($company->category_id);
            // $categories = $categoryResult['export']['list'];
            // dd($categoryResult);
            foreach ($categoryResult as $key => $value) {
                $breadcrumb->add($value['title'] . ' ', 'company/type/تولیدی/category/' . $value['Category_id'], true);
            }
        }



        // breadcrumb

        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->Company_id . '/' . cleanUrl($company->company_name), true);
        $breadcrumb->add('Products/Services');
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = "product.showAll.php";
        $this->template($export);
        die();
    }

    public function addContacts($fields)
    {
        include_once ROOT_DIR . 'component/company/model/company.controller.php';
        $company = new companyController();
        $company->addContacts($fields);
    }
    public function getEnglishTypeSocial($type)
    {
        switch ($type) {
            case "گوگل":
                return "google";
            case "تلگرام":
                return "telegram";
            case "اینستاگرام":
                return "instagram";
            case "فیسبوک":
                return "facebook";
            default:
                return null;
        }
    }
    public function service_get($input, $_get)
    {
        $size = $_get['size'];
        $appendProduct['imageUrl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
            return $st;
        });

        $appendProduct['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });

        $appendProduct['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });


        $appendProduct['categories'] = array('formatter' => function ($list) {

            $categoryID = tagToArray($list['category_id'])['export']['list'];
            $parentCategory = tagToArray($list['parent_category_id'])['export']['list'];
            $allCategory = array_merge($parentCategory, $categoryID);
            return category::getBy_Category_id($allCategory)
                ->select('Category_id', 'parent_id', 'title')
                ->getList();
        });
        $export = c_product::getAll()
            ->where('company_id', '=', $input['3'])
            ->where('status',  '=', 1)
            ->appendRelation($appendProduct)
            ->paginate($size)
            ->getList();
        return $export;
    }

    public function api_getAll($input, $_get)
    {
        $result = $this->service_get($input, $_get);
        Response::json($result, 'get');
    }

    public function service_getRow($id)
    {


        $appendProduct['relationProduct'] = array('formatter' => function ($list) {

            $appendRelation['imageUrl'] = array('formatter' => function ($list) {
                $st = STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
                return $st;
            });
            $appendRelation['description'] = array('formatter' => function ($list) {
                return clearHtml($list['description']);
            });
            $appendRelation['date'] = array('formatter' => function ($list) {
                return convertDate($list['date']);
            });
            return product::getBy_company_id($list['company_id'])->limit(10)->appendRelation($appendRelation)->getList();
        });
        $appendProduct['otherProduct'] = array('formatter' => function ($list) {
            $appendRelation['imageUrl'] = array('formatter' => function ($list) {
                $st = STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
                return $st;
            });
            $appendRelation['description'] = array('formatter' => function ($list) {
                return clearHtml($list['description']);
            });
            $appendRelation['date'] = array('formatter' => function ($list) {
                return convertDate($list['date']);
            });
            return product::getBy_company_id($list['company_id'])->limit(10)->appendRelation($appendRelation)->getList();
        });

        $appendProduct['imageUrl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
            return $st;
        });
        $appendProduct['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });
        $appendProduct['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });
        $appendProduct['categories'] = array('formatter' => function ($list) {
            $categoryID = tagToArray($list['category_id'])['export']['list'];
            $parentCategory = tagToArray($list['parent_category_id'])['export']['list'];
            $allCategory = array_merge($parentCategory, $categoryID);
            return category::getBy_Category_id($allCategory)
                ->select('Category_id', 'parent_id', 'title')
                ->getList();
        });

        return product::getBy_Product_id($id)->appendRelation($appendProduct)->getList();
    }
    public function api_getRow($id)
    {
        $result = $this->service_getRow($id);
        Response::json($result, 'get', 200);
    }
}
