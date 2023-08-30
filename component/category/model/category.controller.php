<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once dirname(__FILE__) . '/category.model.php';
require_once ROOT_DIR . "component/category/member/model/member.category.model.php";
require_once ROOT_DIR . "component/package/member/model/package.model.php";
require_once ROOT_DIR . "component/product/member/model/product.model.php";
require_once ROOT_DIR . "component/category/member/model/member.category.model.php";

/**
 * Class newsController.
 */
class categoryController
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
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param string $list
     * @param $msg
     *
     * @return string
     */
    public function template($list = array(), $msg = '')
    {
        // global $conn, $lang;

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
     * @param $_input
     */
    public function showMore($_input)
    {

        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->template($msg);
        }
        $news = new adminNewsModel();
        $result = $news->getNewsById($_input);

        if ($result['result'] != 1) {
            die();
        }

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('دسته بندی');
        $breadcrumb->add($news['list']['title']);
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->template($news->fields);
        die();
    }

    public function getCategory_option($parent_id = '0')
    {
        $model = new adminCategoryModel();
        $result = $model->getCategoryOption();
    }

    /**
     * @param $fields
     */
    public function showList($parent_id = '0')
    {

        $model = new categoryModel();

        /*
         * sample1
         * $result=$model->getCategoryOption(0,'--');

        foreach ($result as $key => $val)
        {
            print_r($val['export'].'<br/>');
        }
        die();
        print_r($result);
        //end sample1
        */

        //ul li sample
        $parent_id = '0';
        $result = $model->getCategoryUlLi();
        echo $result['export']['list'];
        die();

        $this->fileName = 'admin.news.showList.php';
        $this->template('', $result['msg']);
        die();

        $export['list'] = $model->list;
        $export['recordsCount'] = $news->recordsCount;
        $this->fileName = 'admin.news.showList.php';

        $fields = $result['export']['list'];
        $this->listCat = $fields;
        $mainMenu = $this->getulli($fields[0]);
        $mainMenu = "<ul>\n" . $mainMenu . '</ul>';

        return $mainMenu;

        //////////////////////////
        if ($result['result'] != '1') {
            $this->fileName = 'admin.news.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $news->list;
        $export['recordsCount'] = $news->recordsCount;
        $this->fileName = 'admin.news.showList.php';
        /////////////////////////

        //////
        if ($result['result'] != '1') {
            $this->fileName = 'admin.news.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $news->list;
        $export['recordsCount'] = $news->recordsCount;
        $this->fileName = 'admin.news.showList.php';

        $this->template($export);
        die();
        //////

        if ($result['result'] != '1') {
            die();
        }
        $export['list'] = $news->list;
        $export['recordsCount'] = $news->recordsCount;

        $this->fileName = 'admin.news.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showNewsAddForm($fields, $msg)
    {
        $this->fileName = 'admin.news.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * @param $fields
     *
     * @return mixed
     */
    public function addNews($fields)
    {
        $news = new adminNewsModel();

        $result = $news->setFields($fields);

        if ($result['result'] == -1) {
            return $result;
        }
        $result = $news->add();

        if ($result['result'] != '1') {
            $this->showNewsAddForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showNewsEditForm($fields, $msg)
    {
        $news = new adminNewsModel();

        if (!validator::required($fields['News_id']) and !validator::Numeric($fields['News_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        }
        $result = $news->getNewsById($fields['News_id']);

        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        }

        $export = $news->fields;

        $this->fileName = 'admin.news.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editNews($fields)
    {
        $news = new adminNewsModel();

        if (!validator::required($fields['News_id']) and !validator::Numeric($fields['News_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        }
        $result = $news->getNewsById($fields['News_id']);
        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        }

        $result = $news->setFields($fields);

        if ($result['result'] != 1) {
            $this->showNewsEditForm($fields, $result['msg']);
        }

        $result = $news->edit();

        if ($result['result'] != '1') {
            $this->showNewsEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=news', $msg);
        die();
    }

    public function index($category_id = 0)
    {
        if (!isset($category_id)) {
            $this->showLevelOneCategory();
        } else {

            $this->showLevelTwoCategory($category_id);
        }
    }


    public function showLevelOneCategory()
    {
        $result['topLayer'] = true;
        $result['buttonTitle'] = "نمایش زیردسته های این دسته بندی";
        $link = "category/all/";

        $result['category'] = $this->getCategory(0);
        $result = $this->getCompanies($result, $link);

        //breadcrumb
        global $breadcrumb;
        $breadcrumb->add('دسته بندی ها');
        $result['breadcrumb'] = $breadcrumb->trail();
        $result['seo']['title'] = 'دسته بندی ها | تولیدات';
        // Show Template
        $this->showTemplate($result);
    }

    public function showLevelTwoCategory($category_id)
    {
        include_once ROOT_DIR . 'component/categoryBanner/member/model/categoryBanner.model.php';
        $cat = category::find($category_id);
        $catBanner = category_banner::getBy_category_id($category_id)->first();
        $result = array();
        $result['catBanner'] = $catBanner;
        $result['cat'] = $cat;

        $result['topLayer'] = false;
        $result['buttonTitle'] = "نمایش تولیدکننده های این دسته بندی";
        // $link = "company/type/تولیدی/category/";
        $link = "company/c/";


        $result['categoryLevelTwo'] = $this->getCategory($category_id);
        $result = $this->getCompanies($result, $link);
        // dd($result['categoryLevelTwo']);

        //breadcrumb
        global $breadcrumb;
        $breadcrumb->add('دسته بندی ها', "category/all", true);
        $breadcrumb->add($cat->title);
        $result['breadcrumb'] = $breadcrumb->trail();

        $result['seo']['title'] = $cat->title . ' | تولیدات';
        // dd($result['category']);
        // Show Template
        $this->showTemplate($result);
    }

    public function getCompany($catStr)
    {
        $res = company::getAll()
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->leftJoin('province', 'company.state_id', '=', 'province.province_id')
            ->where('company.parent_category_id', 'like', $catStr)
            ->where('company.status', '=', 1)
            ->select('company.*', 'c_logo.*', 'province.name as province_name')
            ->orderBy('company.refresh_date', 'DESC')
            ->limit(3)->getList();

        // echo 'companyu '.$res['export']['recordsCount'].'<br>';
        // dd($res);

        if ($res['export']['recordsCount'] > 0) {
            return $res['export']['list'];
        }

        return false;
    }

    public function getCategory($category_id)
    {
        return category::getAll()
            ->where('parent_id', '=', $category_id)
            ->getList()['export']['list'];
    }

    public function getCompanies($result, $link)
    {
        $i = 0;
        $categories = (isset($result['categoryLevelTwo'])) ? $result['categoryLevelTwo'] : $result['category'];
        $name = (isset($result['categoryLevelTwo'])) ? 'categoryLevelTwo' : 'category';


        // dd($categories);
        foreach ($categories as $category) {

            $result[$name][$i]['link'] = $link;
            $catStr = "%," . $category['Category_id'] . ",%";

            // echo $catStr.'<br>';
            // echo $category['title'].'<br>';

            if ($companies = $this->getCompany($catStr)) {
                $result['company'][$category['Category_id']] = $companies;
            } else {
                unset($result[$name][$i]);
            }

            // echo '<br>';
            $i++;
        }

        // dd(1);
        // dd(array_keys($result));

        foreach ($result['company'] as $category_id => $companies) {
            foreach ($companies as $key => $company) {
                $result['company'][$category_id][$key]['product_count'] = c_product::getProductCount($company['Company_id']);
                /*$result['company'][$category_id][$key]['category_name'] = category::getCategoryName($company['category_id']);*/
                $package = new package();
                $result['company'][$category_id][$key]['package_name'] = $package->getCompanyPackage($company['Company_id'])['packagetype'];
                $result['company'][$category_id][$key]['package_class'] = package::getPackageClass($result['company'][$category_id][$key]['package_name']);
            }
        }

        return $result;
    }

    public function showTemplate($result)
    {
        $list['seo']['title'] = $result['seo']['title'];
        // dd($result);
        $this->fileName = "show.category.php";
        $this->template($result);
        die();
    }

    public function service_getIndex($id)
    {

        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/category/' . $list['image'];
        });

        $category = category::getBy_Category_id($id)->appendRelation($append)->getList();

        $subCategory = category::getAll()
            ->where('category.parent_id', '!=', '0')->getList();
    }

    public function api_getIndex($id)
    {
        $result = $this->service_getIndex($id);
        Response::json($result, 'get');
    }

    public function companyByCategory($parent_id = 0)
    {
        $result = $this->service_getRow($parent_id);
        if ($result['recordsCount'] == 0) {
            return $result;
        }

        $append_company['logoURl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });
        $append_company['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });
        $append_company['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $internal['packageList'] = package::getAll()->keyBy('Package_id')->getList();
        $append_company['package_type'] = array('formatter' => function ($list, $internal) {
            $st = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($st == '') {
                $st = 'رایگان';
            }
            return $st;
        });
        $append_company['package_id'] = array('formatter' => function ($list) {
            $st = $list['package_id'];
            if ($st == '') {
                $st = '0';
            }
            return $st;
        });
        $result['data']['0']['companies'] = company::getAll()
            ->select('company.*', 'packageusage.package_id', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->leftJoin('packageusage', 'company.Company_id', '=', 'packageusage.company_id');
        if ($parent_id <> 0) {
            $result['data']['0']['companies']
                ->where('company.category_id', 'like', '%,' . $parent_id . ',%')
                ->OrWhere('company.parent_category_id', 'like', '%,' . $parent_id . ',%');
        }

        $result['data']['0']['companies'] = $result['data']['0']['companies']->orderBy('priority', 'DESC')
            ->appendRelation($append_company, $internal)
            ->paginate()
            ->getList();
        //$result['data']['0']['subCategory'] = $this->service_get($parent_id);
        return $result;
    }


    public function getCatByParent_id($parent_id = 0)
    {
        $result = $this->service_getRow($parent_id);
        if ($result['recordsCount'] == 0) {
            return $result;
        }

        $append_company['logoURl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });
        $append_company['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });
        $append_company['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $internal['packageList'] = package::getAll()->keyBy('Package_id')->getList();
        $append_company['package_type'] = array('formatter' => function ($list, $internal) {
            $st = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($st == '') {
                $st = 'رایگان';
            }
            return $st;
        });
        $append_company['package_id'] = array('formatter' => function ($list) {
            $st = $list['package_id'];
            if ($st == '') {
                $st = '0';
            }
            return $st;
        });
        $result['data']['0']['companies'] = company::getAll()
            ->select('company.*', 'packageusage.package_id', 'c_logo.image')
            ->leftJoin('c_logo', 'company.Company_id', '=', 'c_logo.company_id')
            ->leftJoin('packageusage', 'company.Company_id', '=', 'packageusage.company_id');
        if ($parent_id <> 0) {
            $result['data']['0']['companies']
                ->where('company.category_id', 'like', '%,' . $parent_id . ',%')
                ->OrWhere('company.parent_category_id', 'like', '%,' . $parent_id . ',%');
        }

        $result['data']['0']['companies'] = $result['data']['0']['companies']->orderBy('priority', 'DESC')
            ->appendRelation($append_company, $internal)
            ->paginate()
            ->getList();
        $result['data']['0']['subCategory'] = $this->service_get($parent_id);
        return $result;
    }

    public function service_getRow($id = 0)
    {
        $append['imageUrl'] = array('formatter' => function ($list) {
            $st = '';
            if (trim($list['img_name']) != '') {
                $st = STATIC_RELA_DIR . '/images/category/' . $list['img_name'];
            }
            return $st;
        });



        return category::getAll()
            ->select('Category_id', 'parent_id', 'title', 'img_name')
            ->where('Category_id', '=', $id)
            ->appendRelation($append)
            ->getList();
    }

    public function service_get($parent_id = 0)
    {
        $append['imageUrl'] = array('formatter' => function ($list) {
            $st = '';
            if (trim($list['img_name']) != '') {
                $st = STATIC_RELA_DIR . '/images/category/' . $list['img_name'];
            }
            return $st;
        });
        $append['hasChild'] = array('formatter' => function ($list) {

            $st = 0;
            $result = category::getAll()
                ->select('Category_id')
                ->where('parent_id', '=', $list['Category_id'])
                ->getList();
            if ($result['recordsCount'] > 0) {
                $st = 1;
            }
            return $st;
        });
        return category::getAll()
            ->select('Category_id', 'parent_id', 'title', 'img_name')
            ->where('parent_id', '=', $parent_id)
            ->appendRelation($append)
            ->getList();
    }

    public function api_getCatByParent_id($input)
    {
        $result = $this->getCatByParent_id($input);
        Response::json($result, 'get', 200);
    }
    public function api_companyByCategory($input)
    {
        $result = $this->companyByCategory($input);
        Response::json($result, 'get', 200);
    }
    public function api_getAll($input)
    {
        $result = $this->service_get($input);
        Response::json($result, 'get', 200);
    }


    // check category artoiicle with crm
    public function check()
    {
        $c = (new category)
            ->select('category.title', 'category.Category_id', 'count(article.Article_id)')
            ->leftJoin('article', 'article.category_id', '=', 'category.Category_id')
            ->groupBy('category.Category_id')
            ->getList();

        echo json_encode($c['export']['list']);
        die();
    }
}
