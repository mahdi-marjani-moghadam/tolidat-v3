<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once dirname(__FILE__) . '/company.model.php';
include_once ROOT_DIR . 'component/article/model/article.model.php';
include_once ROOT_DIR . 'component/search/model/SearchModel.php';
include_once ROOT_DIR . "component/company/model/company.model.php";
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
include_once ROOT_DIR . 'component/city/model/City.php';
include_once ROOT_DIR . 'component/province/model/province.model.php';
require_once ROOT_DIR . "/model/Rate.php";

include_once ROOT_DIR . "component/survey/model/survey.model.php";


/**
 * Class articleController.
 */
class companyController
{
    /**
     * Contains file type.
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
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
                // echo 'aa';die('f');
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
     * Gets a 10 digit number and convert the first 6 number to *
     *
     * @param $tenDigitNumber
     */
    public function showLastFourDigit(&$tenDigitNumber)
    {
        if (!empty($tenDigitNumber)) {
            $replacement = '******';
            $length = 6;
            $tenDigitNumber = substr_replace($tenDigitNumber, $replacement, 0, $length);
        } else {
            $tenDigitNumber = ' - ';
        }
    }

    /**
     * show all article.
     * @param $_input
     * @author marjani
     * @date 2/28/2016
     * @version 01.01.01
     */
    public function showDetail($id, $shortLink = false)
    {
        // get company
        $company = company::find($id);

        if ($shortLink == true) {
            header('location:' . RELA_DIR . 'company/Detail/' . $id . '/' . cleanUrl($company->company_name));
        }


        $export['side'] = $this->sidebarMenu($id);
        //        dd($export['side']);
        $export['seo'] = $export['side']['seo'];
        unset($export['side']['seo']);
        $export['canonical'] = $export['side']['canonical'];
        unset($export['side']['canonical']);
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
            $breadcrumb->add($company->fields['company_name'], 'company/Detail/' . $company->fields['Company_id'] . '/' . $company->fields['company_name'], true);
            $export['breadcrumb'] = $breadcrumb->trail();

            // unset($_SESSION['companyBreadcrumb']);
            //$_SESSION['companyBreadcrumb'] = serialize($breadcrumb);
            // $breadcrumb->pop();
        } else {
            unset($_SESSION['companyBreadcrumb']);
            // get company categories
            $categoryResult = categoryModelDb::getCategoryByIdString($company->category_id);
            // $categories = $categoryResult['export']['list'];
            // dd($categoryResult);
            foreach ($categoryResult as $key => $value) {
                $breadcrumb->add($value['title'], 'company/c/' . $value['url'], true);
            }
            // dd($breadcrumb);
            //  print_r_debug($export['side']['list']['company_name']);
            $breadcrumb->add($export['side']['list']['company_name']);
            $export['breadcrumb'] = $breadcrumb->trail();
        }


        $this->fileName = 'company.showDetail.php';
        $this->template($export);
        die();
    }

    /**
     * get all article and  show in list.
     * @param $fields
     * @author marjani
     * @date 2/28/2016
     * @version 01.01.01
     */
    public function showALL($fields)
    {

        $search = new SearchModel();
        $company = new companyModel();
        $category = new categoryModel();
        $result = $search->setFields($fields);

        $this->fileName = 'company.showList.php'; //

        if ($result['result'] == -1) {
            $this->template('', $result['msg']);
            die();
        }

        // if (isset($fields['category']) && $fields['category'] != '0') {
        //     $categoryId = $fields['category'];
        //     $fields['filter']['category_id'] = ','.$fields['category'].',';
        // }
        include_once ROOT_DIR . 'component/search/controllers/SearchController.php';

        // if (isset($fields['q']) and (trim($fields['q']) != '')) {
        //     $export['searchSuggestion'] = (new SearchController)->searchSuggestion($fields);
        // }
        // dd($export['searchSuggestion']);

        $result = $search->getCompany($fields);
        // dd($search);
        if ($result['result'] != '1') {
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $search->list;
        // dd($export['list']['searchItem']);
        //print_r_debug($search->pagination);
        $export['type'] = $fields['type'];
        // $export['q'] = $search->q;
        $export['q'] = $fields['q'];
        $export['c'] = $fields['c'];
        $export['province'] = $fields['province'];
        $export['city'] = $fields['city'];
        $export['recordsCount'] = $search->recordsCount;
        $export['pagination'] = $search->pagination;

        if ($company->recordsCount == '0') {
            $msg = 'رکوردی یافت نشد.';
        }

        // advertise
        include_once ROOT_DIR . '/component/advertise/model/advertise.controller.php';
        $advertise = new advertiseController();
        $result = "";
        if (isset($fields['category'])) {
            $category_id = tagToArray($fields['category']);
            $result = $advertise->getAdvertiseByCategoryId($category_id);

            if ($result['result'] != 1) {
                $result = $advertise->randomAdverb();
            }
            $export['advertise_list'] = $result['export']['list'];
        } else {

            $result = $advertise->randomAdverb();
            $export['advertise_list'] = $result;
        }


        // article
        include_once ROOT_DIR . '/component/article/model/article.model.php';
        $article = new articleModel();
        $result = $article->getArticleByCategoryId($fields['category']);

        $export['article_list'] = $result['export']['list'];
        //----------

        // last company
        $lastCompany = new companyModel();
        $companies = $lastCompany->getLastCompany($fields);
        $export['lastCompany_list'] = $companies['export']['list'];
        //-------------

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        //        $resultCategoryParents = $category->getCategoryParents($fields['category']);
        //        if ($resultCategoryParents['result'] == 1) {
        //            foreach ($category->list as $key => $value) {
        //                $breadcrumb->add($value['title'], 'company/' . $value['Category_id'] . '/1', true);
        //            }
        //        }
        $breadcrumb->add('کمپانی ها', RELA_DIR . 'company', true);
        if ($fields['c']) $breadcrumb->add($fields['c'], RELA_DIR . 'company/c/' . $fields['c'], true);
        if ($fields['province'] || $fields['city']) $breadcrumb->add(($fields['province'] ?? '') . ($fields['city'] ?? ''));
        if ($fields['q']) $breadcrumb->add($fields['q']);

        $export['breadcrumb'] = $breadcrumb->trail();

        $export['seo']['title'] =  ((isset($fields['q'])) ? $fields['q'] . ' در ' : '')
            . ($export['list']['searchItem']['category'][0]['title'] ?? 'تمام کمپانی ها')
            .  ((isset($fields['province'])) ? ' استان ' . $fields['province'] : '')
            .  ((isset($fields['city'])) ? ' شهر ' . $fields['city'] : '')
            . ' | تولیدات';
        $export['seo']['description'] = $export['list']['searchItem']['category'][0]['meta_description'];

        //survey-------------------
        // type for category

        if (count($export['list']['searchItem']['category']) == 1) {
            $comment = survey::getBy_type_id($export['list']['searchItem']['category'][0]['Category_id'])->where('status', '=', 1)->where('type', '=', 'category')->orderBy('survey_id', 'DESC')->getlist();
            if ($comment['export']['recordsCount'] == 0) {

                $export['comment_list'] = "نظری یافت نشد";
            } else {

                $export['comment_list'] = $comment['export']['list'];
            }

            //article-------------------

            $resultArticles = article::getBy_category_id($export['list']['searchItem']['category'][0]['Category_id'])->orderBy('date', 'DESC')->limit(8)->getList();


            if ($resultArticles['export']['recordsCount'] == 0) {

                $export['articles_list'] = "مقاله ای یافت نشد";
            } else {
                $export['articles_list'] = $resultArticles['export']['list'];
            }
        }



        $this->fileName = 'company.showList.php';
        $this->template($export, $msg);
        die();
    }

    public function addContacts($fields)
    {
        include_once(ROOT_DIR . "/component/companyContacts/model/companyContacts.controller.php");
        $contact = new contactController();
        $contact->addContacts($fields);
    }

    public function getCompanyAddress($address_id)
    {
        include_once(ROOT_DIR . "/component/companyAddresses/member/model/companyAddresses.controller.php");
        $address = new addressController();
        echo json_encode($address->getCompanyAddressWiki($address_id));
        die();
    }

    public function getCompanyPhone($phone_id)
    {
        include_once(ROOT_DIR . "/component/companyPhones/member/model/companyPhones.controller.php");
        $phones = new phoneController();
        echo json_encode($phones->getCompanyPhoneWiki($phone_id));
        die();
    }

    public function eidtCompanyAddress($fields)
    {
        include_once(ROOT_DIR . "/component/companyAddresses/member/model/companyAddresses.controller.php");
        $address = new addressController();
        $address->editCompanyAddressWiki($fields);
    }

    public function eidtCompanyPhone($fields)
    {
        include_once(ROOT_DIR . "/component/companyPhones/member/model/companyPhones.controller.php");
        $phones = new phoneController();
        $phones->editCompanyPhoneWiki($fields);
    }

    public function showALLFeature($company_id, $feature)
    {
        if ($feature == "commercialName") {
            $feature = "commercial_name";
        }
        $feature = $feature != "Employment" ? "c_" . $feature : $feature;

        if ($feature == "c_licence") {

            $features = $feature::getBy_company_id_and_status_and_isActive($company_id, 2, 1)->getList();
        } elseif ($feature == "Employment") {
            $features = Employment::getAll()
                ->leftJoin('graduate', 'c_employment.graduate_id', '=', 'graduate.Graduate_id')
                ->where('company_id', '=', $company_id)
                ->where('status', '=', 2)
                ->where('isActive', '=', 1)
                ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
                ->getList();
        } elseif ($feature == "c_certification") {
            $certification = new c_certification();
            $features = $certification->getCertification($company_id);
        } else {
            $features = $feature::getBy_company_id($company_id)->getList();

            foreach ($features['export']['list'] as $key => $value) {
                $category = category::find(explode(',', $value['category_id'])[1]);
                $features['export']['list'][$key]['category_name'] = $category->title;
            }
        }

        if ($feature == "c_commercial_name") {
            $features['export']['folder_name'] = "commercialName";
        } else if ($feature == "Employment") {
            $features['export']['folder_name'] = "employment";
        } else {
            $features['export']['folder_name'] = substr($feature, 2);
        }

        $export['export'] = $features['export'];

        // breadcrumb

        $company = company::find($company_id);
        if (!is_object($company)) {
            redirectPage(RELA_DIR);
        }

        global $breadcrumb;
        $breadcrumb->reset();
        //        $reqReferer = urldecode($_SERVER['HTTP_REFERER']);
        //        $reqRefererArray = explode('/', $reqReferer);
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('محصولات');
        $export['breadcrumb'] = $breadcrumb->trail();
        // End breadcrumb
        $this->fileName = "company.showAllFeature.php";
        $this->template($export);
        die();
    }

    public function suggest($field)
    {
        $q = $field['value'];
        //print_r_debug($q);
        // $sql = "
        //       SELECT
        //           CASE 
        //         WHEN `category`.`title` = '$q' THEN 1
        //         WHEN `category`.`title` LIKE '$q' THEN 2
        //         WHEN `category`.`title` LIKE '$q%' THEN  3
        //         WHEN `category`.`title` LIKE '%$q' THEN 4
        //         WHEN `category`.`title` LIKE '%$q%' THEN 5  
        //         ELSE 6 END AS `rnk`,
        //           `category`.*
        //         FROM
        //           `category`
        //         WHERE
        //         `category`.`title` = '$q' OR
        //         `category`.`title`  LIKE '$q' OR
        //         `category`.`title` LIKE '$q%' OR
        //         `category`.`title`  LIKE '%$q' OR
        //         `category`.`title`  LIKE '%$q%'
        //            ORDER BY rnk ASC 
        //              LIMIT 10 
        //              ";

        // $company = company::query($sql)->getList();
        // foreach ($company['export']['list'] as $list) {
        //     $found[] = array(
        //         "value" => $list['title'],
        //         "type" => 1,
        //         "id" => $list['Category_id']

        //     );
        // }
        $company['export']['recordsCount'] = 0;
        if ($company['export']['recordsCount'] < 10) {


            $limit = 10 - $company['export']['recordsCount'];
            $sql = "
              SELECT
                  CASE
                WHEN `company`.`company_name` = '$q' THEN 1
                WHEN `company`.`company_name` LIKE '$q' THEN 2
                WHEN `company`.`company_name` LIKE '$q%' THEN  3
                WHEN `company`.`company_name` LIKE '%$q' THEN 4
                WHEN `company`.`company_name` LIKE '%$q%' THEN 5

                WHEN`company`.`meta_keyword` = '$q' THEN 6
                WHEN `company`.`meta_keyword` LIKE '$q' THEN 7
                WHEN `company`.`meta_keyword` LIKE '$q,%' THEN 8
                WHEN `company`.`meta_keyword` LIKE '%,$q' THEN 9
                WHEN `company`.`meta_keyword` LIKE '%,$q,%' THEN 10
                WHEN `company`.`description` = '$q' THEN 11
                WHEN `company`.`description` LIKE '$q' THEN 12
                WHEN `company`.`description` LIKE '$q%' THEN 13
                WHEN `company`.`description` LIKE '%$q' THEN 14
                WHEN `company`.`description` LIKE '%$q%' THEN 15
                ELSE 16 END AS `rnk`,
                  `company`.*
                FROM
                  `company`
                WHERE
                (
                      `company`.`company_name` = '$q' or 
                 `company`.`company_name` LIKE '$q' or 
                 `company`.`company_name` LIKE '$q%' or  
                 `company`.`company_name` LIKE '%$q' or 
                 `company`.`company_name` LIKE '%$q%' or 

                `company`.`meta_keyword` = '$q' or 
                 `company`.`meta_keyword` LIKE '$q' or 
                 `company`.`meta_keyword` LIKE '$q,%' or 
                 `company`.`meta_keyword` LIKE '%,$q' or 
                 `company`.`meta_keyword` LIKE '%,$q,%' or 
                 `company`.`description` = '$q' or 
                 `company`.`description` LIKE '$q' or 
                 `company`.`description` LIKE '$q%' or 
                 `company`.`description` LIKE '%$q' or 
                 `company`.`description` LIKE '%$q%'  
                  
                    ) AND
                  `company`.`status` = 1
                       ORDER BY rnk ASC 
                         LIMIT $limit

                     ";

            //print_r_debug($sql);
            $company = company::query($sql)->getList();
            foreach ($company['export']['list'] as $list) {
                $found[] = array(
                    "value" => $list['company_name'],
                    "type" => 2,

                );
            }
        }
        //print_r_debug($found);
        echo json_encode($found);
        die();
    }


    public function sidebarMenu($id)
    {
        $company = company::find($id);


        if (!is_object($company)) {
            $msg = 'شرکت مورد نظر یافت نشد';
            redirectPage(RELA_DIR, $msg);
        }

        // get city
        $city = City::find($company->city_id);
        if (is_object($city)) {
            $export['city'] = $city->name;
        }


        // get province
        $province = province::find($company->state_id);
        if (is_object($province)) {
            $export['province'] = $province->name;
        }
        // canonical seo
        $export['canonical'] = RELA_DIR . 'company/Detail/' . $id . '/' . cleanUrl($company->company_name);

        if ($company->status == 1 & ($company->package_status == 1 || $company->package_status == 4)) {
            $export['list'] = $company->fields;
        } else {
            $msg = 'شرکت مورد نظر یافت نشد';
            redirectPage(RELA_DIR, $msg);
        }
        $state = province::find($company->state_id);
        $export['state'] = '- دفتر مرکزی: ' . $state->name;

        $export['msg'] = 'در این صفحه محصولات، اطلاعات تماس و دیگر اطلاعات شرکت ' . $company->company_name . ' قابل مشاهده است';
        if (mb_strlen($export['msg'] . $company->brif_description) < 140) {
            $export['brif_description_msg'] = $export['msg'] . ' ' . mb_substr($company->brif_description, 0, (180 - mb_strlen($company->brif_description)));
        } else {
            $export['brif_description_msg'] = $export['msg'];
        }

        if (mb_strlen($export['msg'] . $company->brif_description) < 160) {
            $export['brif_description_msg'] = $export['brif_description_msg'] . (strcmp($company->description, $company->brif_description) ? ('-' . mb_substr($company->description, 0, (160 - mb_strlen($export['brif_description_msg'])))) : '');
        }
        $export['seo'] = array(
            'title' => $company->company_name . '- تولیدات',
            'description' => mb_strlen($export['brif_description_msg']) > 0 ? $export['brif_description_msg'] . $export['state'] : $export['msg'] . $export['state'],
            'meta_keyword' => strlen($company->meta_keyword) > 0 ? $company->meta_keyword : $company->company_name . '- تولیدات',
        );
        $export['company_id'] = $id;

        //get phone main
        $phone = c_phones::getBy_company_id_and_isMain($company->Company_id, 1)->getList();

        $export['list']['phone_main'] = $phone['export']['list'][0]['number'];
        //print_r_debug($export);

        //get package type
        $rate = new Rate();
        $export['rate'] = $rate->rate($company);
        // get related companies
        $relateCompany = new companyModel();
        $resultRelatedCompanies = $relateCompany->getRelatedCompanies($id);

        if ($resultRelatedCompanies['result'] == 1) {
            $export['related_companies_list'] = $resultRelatedCompanies['export']['list'];
        }

        //use category model func by getCategoryUlLi
        /*$category = new categoryModel();
        $resultCategory = $category->getCategoryUlLi();
        if ($resultCategory['result'] == 1) {
            $export['category_list'] = $resultCategory['export']['list'];
        }*/

        //get company type
        $export['company_type'] = $company->company_type;

        //get company logo
        $resultLogo = c_logo::getBy_company_id($id)->orderBy('Logo_id', 'desc')->getList();
        if ($resultLogo['export']['recordsCount'] > 0) {
            $export['logo_list'] = $resultLogo['export']['list'];
        }

        // get company products
        $resultProduct = c_product::getBy_company_id($id)->where('status', '=', 1)->limit(3)->getList();
        if ($resultProduct['export']['recordsCount'] > 0) {
            $export['product_list'] = $resultProduct['export']['list'];
        }
        foreach ($export['product_list'] as $key => $value) {
            $category = category::find(explode(',', $value['category_id'])[1]);
            $export['product_list'][$key]['category_name'] = $category->title;
        }
        // get company certification
        $certification = new c_certification();
        $resultCertification = $certification->getCertification($id);
        if ($resultCertification['export']['recordsCount'] > 0) {
            $export['certification_list'] = $resultCertification['export']['list'];
        }

        if ($company->company_type == 2) {
            // get licence information
            $licence = (new c_licences())->getLicenceByCompanyId($company->Company_id);
            $export['licence'] = $licence['export']['list'][0];
        }
        // get company banner
        $resultBanner = c_banner::getBy_company_id($id)->orderBy('Banner_id', 'desc')->getList();
        $categoryID = tagToArray($company->category_id)['export']['list'];
        $parentCategory = tagToArray($company->parent_category_id)['export']['list'];

        $categories = category::getBy_Category_id(array_merge($parentCategory, $categoryID))->getList()['export']['list'];

        //dd($parentCategoryList);
        if ($resultBanner['export']['recordsCount'] > 0) {
            if (file_exists(COMPANY_ADDRESS_ROOT . $id . '/banner/1260.210.' . $resultBanner['export']['list'][0]['image'])) {
                $export['banner_list'] = COMPANY_ADDRESS . $id . '/banner/1260.210.' . $resultBanner['export']['list'][0]['image'];
            } else {
                $export['banner_list'] = '/templates/' . CURRENT_SKIN . '/assets/image/placeholder1.png';
            }


            $export['homePage'] = 0;
        } else {
            foreach ($categories as $item) {
                if ($item['parent_id'] == 0) {
                    $grandfatherCategory[] = $item;
                }
            }

            $random = rand(0, count($grandfatherCategory) - 1);
            $image = category_banner::getBy_category_id($grandfatherCategory[$random]['Category_id'])->getList()['export']['list']['0']['image'];
            if (file_exists(IMAGES_ROOT_DIR . 'category_banner/' . $image)) {
                $export['banner_list'] = IMAGES_RELA_DIR . 'category_banner/' . $image;
            } else {
                $export['banner_list'] = '/templates/' . CURRENT_SKIN . '/assets/image/placeholder1.png';
            }
        }

        // get meta key_word
        $meta_keyword = tagToArray($company->meta_keyword)['export']['list'];
        $i = 1;
        foreach ($meta_keyword as $keyword) {
            $export['meta_keyword'][$i]['keyword'] = $keyword;
            $export['meta_keyword'][$i]['link'] = RELA_DIR . "search/type/تولیدی/q/" . $keyword;
            $i++;
        }

        //        /*foreach ($categories as $category) {
        //            $export['meta_keyword'][$i]['keyword'] = $category['title'];
        //            $export['meta_keyword'][$i]['link'] = RELA_DIR . "search/type/تولیدی/category/" . $category['Category_id'];
        //            $i++;
        //        }*/

        //get categorey

        $parentCategoryList = category::getBy_Category_id(tagToArray($company->parent_category_id)['export']['list'])->getList()['export']['list'];
        foreach ($parentCategoryList as $category) {
            $export['category_title'][$category['Category_id']]['title'] = $category['title'];
            $export['category_title'][$category['Category_id']]['Category_id'] = $category['Category_id'];
        }
        //print_r_debug($export);
        // get company honour
        $resultHonour = c_honour::getBy_company_id($id)->getList();
        $export['honour_list'] = $resultHonour['export']['list'];


        // get company Employments
        $resultEmployment = Employment::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();
        if ($resultEmployment['export']['recordsCount'] > 0) {
            $export['employment_list'] = $resultEmployment['export']['list'];
        }


        // get company Advertises
        $resultAdvertise = c_advertise::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();
        $export['advertise_list'] = $resultAdvertise['export']['list'];
        $count = count($export['employment_list']) + count($export['advertise_list']);
        $export['count'] = $count;

        // get company history
        $resultHistory = c_history::getBy_company_id($id)->getList();
        $export['history_list'] = $resultHistory['export']['list'];

        // get company news
        $resultNews = c_news::getBy_company_id($id)->getList();
        if ($resultNews['export']['recordsCount'] > 0) {
            $export['news_list'] = $resultNews['export']['list'];
        }

        // get company companyCommercialName
        $resultCompanyCommercialName = c_commercial_name::getBy_company_id($id)->getList();
        $export['commercialName_list'] = $resultCompanyCommercialName['export']['list'];

        // get company licence
        $licene_type = new c_licences();
        $export['licence_list'] = $licene_type->getLicenceByCompanyId($id, 0)['export']['list'];

        //get company representation
        $resultRepresentation = c_representation::getBy_company_id_and_confirm($id, 1)->getList();
        $export['representation_list'] = $resultRepresentation['export']['list'];
        // get branch company
        $branch_main = company::getBy_company_id_and_status($id, 1)->getList();
        $branchs['export']['list'][0] = $branch_main['export']['list'][0];
        $branchs['export']['list'][0]['Branch_id'] = 0;
        $branchs['export']['list'][0]['branch_name'] = "مرکزی";

        $branch = c_branch::getBy_company_id_and_status($id, 2)->getList();
        $export['branch'] = $branch;
        foreach ($branch['export']['list'] as $b) {
            $branchs['export']['list'][] = $b;
        }
        // print_r_debug($id);
        $addresses = c_addresses::getBy_company_id($id)->getList();
        if ($company->package_status == 1) {
            $phones = c_phones::getBy_company_id($id)->first();
            if (is_object($phones)) {
                $phone['export']['list']['0'] = $phones->fields;
                $phones = $phone;
            }
        } else {
            $phones = c_phones::getBy_company_id($id)->getList();
        }
        $emails = c_emails::getBy_company_id($id)->getList();
        $websites = c_websites::getBy_company_id($id)->getList();
        $positions = positionController::getCompanyPosition($id);
        // $export['position'] = $positions[0];

        $socials = c_socials::getAll()
            ->leftJoin('social_type', 'c_socials.social_type_id', '=', 'social_type.Social_type_id')
            ->where('company_id', '=', $id)->getList();

        if ($socials['export']['recordsCount'] > 0) {

            foreach ($socials['export']['list'] as $key => $value) {

                $socials['export']['list'][$key]['type'] = $this->getEnglishTypeSocial($value['type']);
                $socials['export']['list'][$key]['url'] = $this->checkSocialUrl($value['url'], $this->getEnglishTypeSocial($value['type']));
                //$export['socials']= $this->getEnglishTypeSocial($k['type']);
                //$export['socials'] .= $socials['export']['list'];
            }
        }

        $export['socials'] = $socials['export']['list'];

        foreach ($branchs['export']['list'] as $branch) {
            $export['branch_list'][$branch['Branch_id']] = $branch;

            foreach ($addresses['export']['list'] as $address) {
                if ($branch['parent_id'] == $address['branch_id']) {
                    $export['branch_list'][$branch['Branch_id']]['addresses'][$address['Addresses_id']] = $address;
                }
                if ($address['branch_id'] == 0) {
                    $export['branch_list'][0]['addresses'][$address['Addresses_id']] = $address;
                }
            }
            foreach ($phones['export']['list'] as $phone) {
                if ($branch['parent_id'] == $phone['branch_id']) {
                    $export['branch_list'][$branch['Branch_id']]['phones'][$phone['Phones_id']] = $phone;
                }
                if ($phone['branch_id'] == 0) {
                    $export['branch_list'][0]['phones'][$phone['Phones_id']] = $phone;
                }
            }
            foreach ($emails['export']['list'] as $email) {
                if ($branch['parent_id'] == $email['branch_id']) {
                    $export['branch_list'][$branch['Branch_id']]['emails'][$email['Emails_id']] = $email;
                }
                if ($email['branch_id'] == 0) {
                    $export['branch_list'][0]['emails'][$email['Emails_id']] = $email;
                }
            }

            foreach ($positions as $position) {

                if ($branch['parent_id'] == $position['branch_id']) {
                    $export['branch_list'][$branch['Branch_id']]['position'][$position['Position_id']] = $position;
                }
                if ($position['branch_id'] == 0) {
                    $export['branch_list'][0]['position'][$position['Position_id']] = $position;
                }
            }

            foreach ($websites['export']['list'] as $website) {
                if ($branch['parent_id'] == $website['branch_id']) {
                    $export['branch_list'][$branch['Branch_id']]['websites'][$website['Websites_id']] = $website;
                }
                if ($website['branch_id'] == 0) {
                    $export['branch_list'][0]['websites'][$website['Websites_id']] = $website;
                }
            }
        }



        $survey = survey::getAll()
            ->where('type_id', '=', $id)
            ->where('type', '=', "company")
            ->where('status', '=', 1)
            ->getList();
        $export['comment_list'] = $survey['export']['list'];

        return $export;
    }

    public function getCompanyInformation($id)
    {
        $internal['packageList'] = package::getAll()->keyBy('Package_id')->getList();
        $append = company::setDataToApi();
        /*$append = array('formatter' => function ($list) {

            $list['videoUrl']='aa';
            $list['image']= $list['refresh_date'].'nn';

            //$st = "https://www.aparat.com/v/hKGMP";
            return $list;
        });*/
        $export = company::getAll()
            ->select('company.*', 'packageusage.package_id', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->leftJoin('packageusage', 'company.Company_id', '=', 'packageusage.company_id')
            ->where('company.Company_id', '=', $id)
            ->andWhere('company.status', '=', '1')
            ->andWhereOpen('company.package_status', '=', '1')
            ->orWhereClose('company.package_status', '=', '4')
            ->andWhere('company.Company_id', '<>', '22415')
            ->andWhere('company.Company_id', '<>', '22417')
            ->andWhere('company.Company_id', '<>', '22419')
            ->andWhere('company.Company_id', '<>', '22421')
            ->orderBy('refresh_date', 'DESC')
            ->append($append, $internal)
            ->getList();

        $appendProduct['imageUrl'] = array('formatter' => function ($list) {
            if (trim($list['image']) == '') {
                return DEFULT_LOGO_ADDRESS;
            }
            return STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
        });

        $appendProduct['categories'] = array('formatter' => function ($list) {
            $categoryID = tagToArray($list['category_id'])['export']['list'];
            $parentCategory = tagToArray($list['parent_category_id'])['export']['list'];
            $allCategory = array_merge($parentCategory, $categoryID);
            return category::getBy_Category_id($allCategory)
                ->select('Category_id', 'parent_id', 'title')
                ->getList();
        });
        $appendProduct['gallery'] = array('formatter' => function ($list) {

            $result['data'] = array();
            $result['result'] = 1;
            $result['recordsCount'] = 0;
            return $result;
        });
        $export['data']['0']['products'] = c_product::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 1)
            ->paginate(10)
            ->appendRelation($appendProduct)
            ->getList();
        // get company banner
        $internal['id'] = $id;

        $appendBanner['imageUrl'] = array('formatter' => function ($list, $internal) {
            return COMPANY_ADDRESS . $internal['id'] . '/banner/1260.210.' . $list['image'];
        });
        $export['data']['0']['banner'] = c_banner::getBy_company_id($id)
            ->select('image')
            ->orderBy('Banner_id', 'desc')
            ->appendRelation($appendBanner, $internal)
            ->getList();
        $categoryID = tagToArray($export['data']['0']['category_id'])['export']['list'];
        $parentCategory = tagToArray($export['data']['0']['parent_category_id'])['export']['list'];
        $allCategory = array_merge($parentCategory, $categoryID);

        $export['data']['0']['categories'] = category::getBy_Category_id($allCategory)
            ->select('Category_id', 'parent_id', 'title')
            ->getList();

        if ($export['data']['0']['banner']['recordsCount'] == 0) {
            $appendBanner['imageUrl'] = array('formatter' => function ($list) {
                return IMAGES_RELA_DIR . 'category_banner/' . $list['image'];
            });
            $export['data']['0']['banner'] = category_banner::getAll()
                ->select('image')
                ->where('Category_id', 'in', $allCategory)
                ->orderBy('RAND()')
                ->appendRelation($appendBanner)
                ->limit(1)
                ->getList();
        }
        return $export;
    }

    public function service_getIndex($id)
    {
        $companyInformation = $this->getCompanyInformation($id);

        /*$append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/company/' . $list['image'];
        });
        $append['description'] = array('formatter' => function ($list)
        {
            return clearHtml( $list['description']);
        });*/
        return $companyInformation;
    }

    public function api_getCompany($id)
    {
        $result = $this->service_getIndex($id);
        Response::json($result, 'get', 200);
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

    public function checkSocialUrl($url, $type)
    {
        $arrayUrl = explode('/', $url);
        $http = "http://";

        switch ($type) {
            case "google":
                $name = trim(end($arrayUrl));
                $url = $http . "plus.google.com/" . $name;
                break;

            case "telegram":

                $name = ltrim(end($arrayUrl), '@');
                $url = $http . "t.me/" . $name;
                break;

            case "instagram":
                $name = trim(end($arrayUrl));

                $url = $http . "instagram.com/" . $name;
                break;

            case "facebook":
                $name = trim(end($arrayUrl));
                $url = $http . "facebook.com/" . $name;
                break;
        }

        return $url;
    }

    function newCompany()
    {
        $result = company::getAll()
            ->where('status', '=', -1)
            ->andWhere('DATE(registration_date)', '>=', 'CURDATE()')
            ->getList();
        
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result['export']['list']);
        die();
    }
}
