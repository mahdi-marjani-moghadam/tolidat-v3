<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM
 */
include_once(dirname(__FILE__) . "/index.model.php");
require_once ROOT_DIR . "/component/package/member/model/package.model.php";
require_once ROOT_DIR . "/component/company/model/company.model.php";
require_once ROOT_DIR . "/model/Rate.php";
include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
include_once ROOT_DIR . 'component/licence/member/model/licence.model.php';
include_once ROOT_DIR . 'component/employment/model/Employment.php';
include_once ROOT_DIR . 'component/companyAdvertise/model/Advertise.php';
include_once ROOT_DIR . 'component/bannerNew/model/bannerNew.php';

include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.controller.php';

class indexController
{
    public $exportType = 'html';
    public $fileName;

    public function template($list = [], $msg = '')
    {
        global $messageStack;
        
        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                print_r_debug($list);
                break;

            case 'serialize':
                echo serialize($list);
                break;

            default:
                break;
        }
    }

    /**
     * show all article
     *
     * @param $_input
     * @author marjani
     * @date 2/28/2016
     * @version 01.01.01
     */
    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->fileName = "article.showList.php";
            $this->template('', $msg);
            die();
        }
        $article = new articleModel;
        $result = $article->getArticleById($_input);

        if ($result['result'] != 1) {
            $this->fileName = "article.showList.php";
            $this->template('', $result['msg']);
            die();
        }
        $this->fileName = "article.showMore.php";
        $this->template($article->fields);
        die();
    }

    /**
     * get all article and  show in list
     *
     * @param $fields
     * @param $msg
     * @author marjani,malekloo
     * @date 2/28/2016
     * @version 01.01.02
     */
    public function showALL($fields, $msg = '')
    {

        // include_once ROOT_DIR . "component/category/member/model/member.category.model.php";
        // include_once ROOT_DIR . "component/bannerExhibition/model/BannerExhibition.php";

        // $categories = category::getAll()->where('parent_id', '=', 0)->orderBy('RAND()')->getList();
        // $export['category_list'] = $categories['export']['list'];

        // $bannerExhibition = BannerExhibition::getAll()->getList();

        // if ($bannerExhibition['export']['recordsCount'] > 0) {
        //     $export['bannerExhibition'] = $bannerExhibition['export']['list'][0];
        // }


        /* -------------------------------------------------------------------------------
         * Use Category Model Function By GetCategoryUlLi
         * -------------------------------------------------------------------------------
         */
        //        include_once ROOT_DIR . "component/category/model/category.model.php" ;
        //        $category = new categoryModel();
        //        $resultCategory = $category->getCategoryArray();
        //
        //        if ($resultCategory['result'] == 1) {
        //            $export['category_list'] = $resultCategory['export']['list'];
        //        }

        /*$resultCategoryList = $category->getCategoryOption();
        if($resultCategoryList['result'] == 1)
        {
            $export['category_dropDown_list'] = $resultCategoryList['export']['list'];
        }*/


        //end use category model func by getCategoryUlLi

        /* -------------------------------------------------------------------------------
         * get category captions
         * -------------------------------------------------------------------------------
         */
        // include_once ROOT_DIR.'component/category/admin/model/admin.category.model.php';
        // $category = new adminCategoryModel();
        //
        // $resultCategory = $category->getCategoryOption();
        // if($resultCategory['result'] == 1)
        // {
        //     $export['categories'] = $category->list;
        // }
        // end get category captions

        /* -------------------------------------------------------------------------------
         * Get Cities
         * -------------------------------------------------------------------------------
         */
        // include_once ROOT_DIR.'component/city/model/city.model.php';
        // $city = new cityModel();
        //
        // $resultCity = $city->getCities();
        // if($resultCity['result'] == 1)
        // {
        //     $export['cities'] = $city->list;
        // }
        // end get category captions

        /* -------------------------------------------------------------------------------
         * Use looiec for get News
         * -------------------------------------------------------------------------------
         */
//        include_once ROOT_DIR . "component/news/model/news.model.php";
//        $resultNews = news::getAll()->orderBy('News_id','desc')->limit(5)->getList();
//        $export['news_list'] = $resultNews['export']['list'];
        

        // OLD CODE for get News
        /*$news = new newsModel();
        $fields['limit']['start'] = 0;
        $fields['limit']['length'] = 10;
        $fields['order']['News_id'] = 'DESC';
        $resultNews = $news->getNews($fields);*/
        // END OLD CODE for get News

        // Use looiec for get Article
        /* include_once(ROOT_DIR . "component/article/model/article.model.php");
         $resultArticles = article::getAll()->getList();
         $export['articles_list'] = $resultArticles['export']['list'];*/

        // Use RSS for get News
        //                include_once(ROOT_DIR."component/news/model/news.controller.php");
        //                $news = new newsController();
        //                $export['news_list'] = $news->rssRead();

        /* -------------------------------------------------------------------------------
         * Get Events
         * -------------------------------------------------------------------------------
         */
        // require_once ROOT_DIR . "component/event/models/Event.php";
        // $resultEvent = Event::getAll()->orderBy('date', 'DESC')->limit(8)->getList();
        // $export['events_list'] = $resultEvent['export']['list'];

        /* -------------------------------------------------------------------------------
         * Use looiec for get Article
         * -------------------------------------------------------------------------------
         */
        include_once ROOT_DIR . "component/article/model/article.model.php";
        $resultArticles = article::getAll()->orderBy('date', 'DESC')->limit(3)->getList();
        $export['articles_list'] = $resultArticles['export']['list'];
        

        
        /* -------------------------------------------------------------------------------
         * End use advertise model func by getAdvertise
         * -------------------------------------------------------------------------------
         */
        // include_once ROOT_DIR . "component/advertise/model/advertise.controller.php";
        // $advertise = new advertiseController();

        // $fields['limit']['start'] = 0;
        // $fields['limit']['length'] = 10;
        // $fields['order']['Advertise_id'] = 'DESC';
        // $resultAdvertise = $advertise->getAdvertiseByType('publicAdvertise');
        // $export['advertise_list'] = $resultAdvertise;

        // unset($fields);

        /* -------------------------------------------------------------------------------
         * Get Banner
         * -------------------------------------------------------------------------------
         */
        // include_once(ROOT_DIR . "component/banner/model/banner.model.php");
        // $banner = new bannerModel();

        // $fields['limit']['start'] = 0;
        // $fields['limit']['length'] = 10;
        // $fields['order']['Banner_id'] = 'DESC';
        // $resultAdvertise = $banner->getBanner($fields);
        // $export['banner_list'] = $resultAdvertise['export']['list'];
        // $export['homePage'] = 1;
        //        print_r_debug($fields);

        // unset($fields);
        ///////////logo
        //        include_once ROOT_DIR . 'component/companyLogo/member/model/companyLogo.model.php';
        //        $resultLogo = c_logo::getBy_company_id($id)->getList();
        //        if ($resultLogo['export']['recordsCount'] > 0) {
        //            $export['logo_list'] = $resultLogo['export']['list'];
        //        }

        /* -------------------------------------------------------------------------------
         * Use Product model func by get Product
         * -------------------------------------------------------------------------------
         */
        // include_once ROOT_DIR . "component/product/model/product.model.php";
        // $product = new productModel();

        // $fields['limit']['start'] = 0;
        // $fields['limit']['length'] = 10;
        // $fields['order']['Company_products_id'] = 'DESC';

        // if (isset($_SESSION['city'])) {
        //     include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';
        //     $cities = adminCityModelDb::getAll()['export']['list'];
        //     $city = $_SESSION['city'];
        //     foreach ($cities as $key => $c) {
        //         if ($city == $c['name']) {
        //             $fields['where'] = " WHERE `city_id` = " . $c['City_id'] . " ";
        //         }
        //     }
        // }

        // $resultProduct = $product->getProduct($fields);
        // $export['product_list'] = $resultProduct['export']['list'];

        // unset($fields);

        /* -------------------------------------------------------------------------------
         * Use company Model func by get company
         * -------------------------------------------------------------------------------
         */
//        include_once ROOT_DIR . "component/company/model/company.model.php";
//        $company = new companyModel();

        // $fields['limit']['start'] = 0;
        // $fields['limit']['length'] = 6;
        // $fields['order']['company_id'] = 'DESC';

        // if (isset($_SESSION['city'])) {
        //     include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';
        //     $cities = adminCityModelDb::getAll()['export']['list'];
        //     $city = $_SESSION['city'];
        //     foreach ($cities as $key => $c) {
        //         if ($city == $c['name']) {
        //             $fields['chose']['city_id'] = $c['City_id'];
        //         }
        //     }
        // }
        /* -------------------
        company count
        ---------------------- */
        $export['registerCount'] = company::getAll()->select("count('*') as count")->getList()['export']['list'][0]['count'];
        $export['productsCount'] = c_product::getAll()->select("count('*') as count")->getList()['export']['list'][0]['count'];
        

        // $resultCompany = $company->getLastCompany($fields);
        // $export['company_list'] = $resultCompany['export']['list'];

        $rate = new Rate();
        // foreach ($export['company_list'] as $key => $company) {
        //     $company = (object)$company;
        //     $export['company_list'][$key]['information'] = $rate->rate($company);
        //     // dd($rate->rate($company));
        // }





        //////////////////////////////higher company/////////////////////////
        //        $higher_company = company ::getAll()
        //            ->leftJoin('c_product' , 'c_product.company_id','=','compnay.Company_id')
        //            ->getList();
        //        print_r_debug($higher_company);
        $export['higher_company'] = company::getAll()
            ->select('company.*,c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->where('package_status', '=', '4')
            ->where('priority', '>=', '40')
            ->orderBy('RAND()')->limit(5)
            ->getList()['export']['list'];
        
        foreach ($export['higher_company'] as $key => $company) {
//            $company_product = c_product::getAll()
//                ->where('status', '=', 1)
//                ->where('company_id', '=', $company['Company_id'])->limit(3)->getList();
            $company = (object)$company;
            $export['higher_company'][$key]['information'] = $rate->rate($company);
//            $export['higher_company'][$key]['company_product'] = $company_product['export']['list'];
        }
        
        // dd($export['higher_company']);

        // unset($fields);
        $export['seo'] = array(
            'title' => 'تولیدات-سایت اجتماعی تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );
        $this->fileName = "index.show.php";
        $this->template($export, $msg);
        die();
    }

    public function showPackageList()
    {
        $packages = package::getAll()->getList();
        if ($packages['export']['recordsCount'] < 1) {
            redirectPage(RELA_DIR . 'member/package');
        }
        foreach ($packages['export']['list'] as $key => $value) {
            switch ($value['packagetype']) {
                case 'برنز':
                    $result[2] = $value;
                    break;
                case 'نقره ای':
                    $result[1] = $value;
                    break;
                case 'طلایی':
                    $result[0] = $value;
                    break;
            }
        }

        $this->fileName = 'pricelistpage.php';
        $this->template($result);
        die();
    }

    public function showAllEvent()
    {
        include_once ROOT_DIR . "component/news/model/news.controller.php";
        $news = new newsController();
        $result = $news->rssRead();
        $date = convertDate(strftime('%Y-%m-%d %H:%M:%S', time()));
        $result['date'] = $date;
        echo json_encode($result);
        die();
    }

    public function getCompanyInformation($id)
    {
        $append_company['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $append_company['logoUrl'] = array('formatter' => function ($list) {
            if (trim($list['image']) == '') {
                return DEFULT_LOGO_ADDRESS;
            }
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });

        $append_company['refresh_date'] = array('formatter' => function ($list) {
            return convertDate($list['refresh_date']);
        });
        $append_company['catalogUrl'] = array('formatter' => function ($list) {
            if ($list['catalog'] == '') {
                return '';
            }
            return COMPANY_ADDRESS . $list['Company_id'] . '/catalog/' . $list['catalog'];
        });
        $append_company['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });

        $export = company::getAll()
            ->select('company.*', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->where('company.Company_id', '=', $id)
            ->andWhere('company.status', '=', '1')
            ->andWhereOpen('company.package_status', '=', '1')
            ->orWhereClose('company.package_status', '=', '4')
            ->andWhere('company.Company_id', '<>', '22415')
            ->andWhere('company.Company_id', '<>', '22417')
            ->andWhere('company.Company_id', '<>', '22419')
            ->andWhere('company.Company_id', '<>', '22421')
            ->orderBy('refresh_date', 'DESC')
            ->appendRelation($append_company)
            ->getList();


        /*if ($company->status == 1 & ($company->package_status == 1 || $company->package_status == 4)) {
            $export['data'] = $company->fields;
        } else {
            $msg = 'شرکت مورد نظر یافت نشد';
            redirectPage(RELA_DIR, $msg);
        }*/
        //get company logo

        // get company products


        $appendProduct['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
        });

        $export['data']['0']['products'] = c_product::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 1)
            ->paginate(3)
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
        // print_r_debug($export);
        // die();

        /*// get company honour
        $resultHonour['data']['honours'] = c_honour::getBy_company_id($id)->getList();
        // get company Employments
        $export['data']['employments'] = Employment::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();

        // get company Advertises
        $export['data']['advertises'] = c_advertise::getAll()
            ->where('company_id', '=', $id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();

        // get company history
        $export['data']['histories'] = c_history::getBy_company_id($id)->getList();

        // get company news
        $export['data']['news'] = c_news::getBy_company_id($id)->getList();
        // get company licence
        $licene_type = new c_licences();
        $export['licences'] = $licene_type->getLicenceByCompanyId($id, 0);

        //get company representation
        $export['data']['representations'] = c_representation::getBy_company_id_and_confirm($id, 1)->getList();

        $export['data']['addresses'] = c_addresses::getBy_company_id_and_isMain($id, 1)->getList();
        $export['data']['phones'] = c_phones::getBy_company_id_and_isMain($id, 1)->getList();
        $export['data']['emails'] = c_emails::getBy_company_id($id)->getList();
        $export['data']['websites'] = c_websites::getBy_company_id($id)->getList();
        print_r_debug($export);
        $socials = c_socials::getAll()
            ->leftJoin('social_type', 'c_socials.social_type_id', '=', 'social_type.Social_type_id')
            ->where('company_id', '=', $id)->getList();

        if ($socials['export']['recordsCount'] > 0) {

            foreach ($socials['export']['list'] as $key => $value) {

                $socials['export']['list'][$key]['type'] = $this->getEnglishTypeSocial($value['type']);
                //$export['socials']= $this->getEnglishTypeSocial($k['type']);
                //$export['socials'] .= $socials['export']['list'];
            }

        }
        return $export;*/
    }


    /*public function showAllNews()
    {
        include_once(ROOT_DIR . "component/news/model/news.controller.php");
        $news = new newsController();
        $result['news'] = $news->rssRead();
        $date = convertDate(strftime('%Y-%m-%d %H:%M:%S', time()));
        $result['date'] = $date;
        echo json_encode($result);
        die();
    }*/
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

    public function api_getIndex($id)
    {
        $result = $this->service_getIndex($id);
        Response::json($result, 'get', 200);
    }

    public function service_get($input)
    {

        //------->Get Top Company
        //$result = array("data","result");
        //$result

        $result['data'] = array();
        $result['result'] = 1;
        $append_top['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $append_top['logoUrl'] = array('formatter' => function ($list) {
            if (trim($list['image']) == '') {
                return DEFULT_LOGO_ADDRESS;
            }
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });
        $internal['packageList'] = package::getAll()->keyBy('Package_id')->getList();
        $append_top['package_type'] = array('formatter' => function ($list, $internal) {
            $st = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($st == '') {
                $st = 'رایگان';
            }
            return $st;
        });
        $append_top['package_id'] = array('formatter' => function ($list) {
            $st = $list['package_id'];
            if ($st == '') {
                $st = '0';
            }
            return $st;
        });


        $append_top['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });
        $append_top['refresh_date'] = array('formatter' => function ($list) {
            return convertDate($list['refresh_date']);
        });
        $append_top['company_product'] = array('formatter' => function ($list) {

            $appendProduct['imageUrl'] = array('formatter' => function ($list) {
                return STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
            });
            $company_product = c_product::getAll()
                ->where('company_id', '=', $list['Company_id'])
                ->where('status', '=', 1)
                ->paginate(3)
                ->appendRelation($appendProduct)
                ->getList();

            return $company_product;
        });
        $append['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });


        /*$appendAll=array('formatter' => function ($list)
        {
            $list['refresh_date']=convertDate($list['refresh_date']);
            $list['mystatus']='1';
            return $list;
        });*/


        $append_banner['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . $list['image'];
        });
        $append_banner['description'] = array('formatter' => function ($list) {
            return $list['brief_description'];
        });


        $result['data']['banner'] = banner::getAll()
            ->orderBy('Banner_id', 'DESC')
            ->appendRelation($append_banner)
            ->getList();

        $result['data']['top_company'] = company::getAll()
            ->select('company.*', 'packageusage.package_id', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->leftJoin('packageusage', 'company.Company_id', '=', 'packageusage.company_id')
            ->where('package_status', '=', '4')
            ->where('priority', '>=', '45')
            ->orderBy('priority', 'DESC')
            ->limit(15)
            //->append($appendAll)
            ->appendRelation($append_top, $internal)
            ->getList();
        //------->Get Top Company END

        //------->Get New Company
        $append_new['logoUrl'] = array('formatter' => function ($list) {
            if (trim($list['image']) == '') {
                return DEFULT_LOGO_ADDRESS;
            }
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });
        $append_new['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $append_new['refresh_date'] = array('formatter' => function ($list) {
            return convertDate($list['refresh_date']);
        });
        $append_new['package_type'] = array('formatter' => function ($list, $internal) {
            $st = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($st == '') {
                $st = 'رایگان';
            }
            return $st;
        });
        $append_new['package_id'] = array('formatter' => function ($list) {
            $st = $list['package_id'];
            if ($st == '') {
                $st = '0';
            }
            return $st;
        });


        $append_new['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });
        $append_new['company_products'] = array('formatter' => function ($list) {

            $appendProduct['imageUrl'] = array('formatter' => function ($list) {
                return STATIC_RELA_DIR . '/images/company/' . $list['company_id'] . '/product/' . $list['image'];
            });

            $company_products = c_product::getAll()
                ->where('company_id', '=', $list['Company_id'])
                ->where('status', '=', 1)
                ->paginate(3)
                ->appendRelation($appendProduct)
                ->getList();
            return $company_products;
        });


        $result['data']['new_companies'] = company::getAll()
            ->select('company.*', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->where('company.status', '=', '1')
            ->andWhereOpen('company.package_status', '=', '1')
            ->orWhereClose('company.package_status', '=', '4')
            ->andWhere('company.Company_id', '<>', '22415')
            ->andWhere('company.Company_id', '<>', '22417')
            ->andWhere('company.Company_id', '<>', '22419')
            ->andWhere('company.Company_id', '<>', '22421')
            ->orderBy('refresh_date', 'DESC')
            ->appendRelation($append_new)
            ->limit(15)
            ->getList();
        return $result;
    }

    public function api_getAll($input)
    {
        $result = $this->service_get($input);
        Response::json($result, 'get', 200);
    }
}
