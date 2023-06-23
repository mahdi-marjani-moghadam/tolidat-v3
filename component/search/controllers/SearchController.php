<?php

require_once ROOT_DIR . 'component/search/model/SearchModel.php';
require_once ROOT_DIR . 'component/search/model/SearchModelDb.php';
include_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
include_once ROOT_DIR . 'component/product/member/model/product.model.php';


class SearchController
{

    public $exportType = 'html';
    public $fileName;

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

    public function showALL($fields)
    {
        // $fields['type'] = 'محصولات';
        if ($fields['type'] == 'محصولات') {
            $this->fileName = 'search.php';
        } else {
            $this->fileName = 'search.result.php';
        }
        $export = array();

        /* —---------------------------------------------------------------------------—
         * Suggesting some phrases according what user typed in the search bar. It
         * —---------------------------------------------------------------------------—
         */
        if (isset($fields['q']) and (trim($fields['q']) != '')) {
            $export['searchSuggestion'] = $this->searchSuggestion($fields);
        }
        // advertise
        include_once ROOT_DIR . '/component/advertise/model/advertise.controller.php';
        $advertise = new advertiseController();

        $result = "";

        /* —---------------------------------------------------------------------------—
         * If there is a category filter in the search query then find all the companies
         * in that category. If there wasn't any company in that category then find
         * some random company. and if there wasn't any category in the search
         * query then find random companies.
         * —---------------------------------------------------------------------------—
         */
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

        /* —---------------------------------------------------------------------------—
         * This section suppose to set searchModel properties with the proper data but
         * in this version it does absolutely nothing. Yeah It is dead code.
         * —---------------------------------------------------------------------------—
         */
        $search = new SearchModel();
        $result = $search->setFields($fields);

        if ($result['result'] == -1) {
            $this->template('', $result['msg']);
            die();
        }

        // if (isset($fields['category']) && $fields['category'] != '0') {
        //     $categoryId = $fields['category'];
        //     $fields['filter']['category_id'] = ','.$fields['category'].',';
        // }

        /* —---------------------------------------------------------------------------—
         * This is the biggest part of the search engine for Tolidat and it gets the
         * proper data due to the تولیدی or محصولات phrase that has been searched.
         * —---------------------------------------------------------------------------—
         */
        if ($fields['type'] == 'تولیدی') {
            $result = $search->getCompany($fields);
            
        } elseif ($fields['type'] == 'محصولات') {
            $result = $search->getProducts($fields);
        } else {
            
            $result = $search->getDefault($fields);
        }
        if ($result['result'] != '1') {
            $this->template('', $result['msg']);
            die();
        }

        //print_r_debug($result);

        /* —---------------------------------------------------------------------------—
         * Creating a site map using breadcrumb component
         * —---------------------------------------------------------------------------—
         */
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('جستجو');
        $export['breadcrumb'] = $breadcrumb->trail();
        
        // dd($export['list']);
       
        $export['list'] = $search->list;
        $export['type'] = $fields['type'];
        $export['q'] = $fields['q'];
        
        $export['recordsCount'] = $search->recordsCount;
        $export['pagination'] = $search->pagination;

        if(isset($export['list']['searchItem']['category'])){

            foreach ($export['list']['searchItem']['category'] as $a => $b){
                $searchTitle .= $export['list']['searchItem']['category'][$a]['title'] .' -';
            }
            $searchTitle = 'جستجوی در '.trim($searchTitle,'-') .' | تولیدات';
        }else{
            $searchTitle = $fields['q'];
            $searchTitle = 'جستجوی  '.trim($searchTitle,'-') .' | تولیدات';
        }


        $export['seo']['title'] = $searchTitle;

        
        $this->template($export, $result['msg']);
        die();
    }

    function searchSuggestion($input)
    {
        $searchArray = explode(' ', $input['q']);

        $result = preg_replace('/[()]/', ' ', $searchArray);;
        $count = count($result);

        for ($i = 0; $i < $count - 1; $i++) {
            $result['value'][] = $result[$i] . ' ' . $result[$i + 1];
            $result['value'][] = $result[$i] . ' ' . $result[$count - 1];
        }

        array_pop($result['value']);

        for ($j = 0; $j < $count; $j++) {
            $result['value'][] .= $result[$j];
        }

        if ($input['type'] == 'تولیدی') {
            $result['type'] = '0';
        } else {
            $result['type'] = '1';
        }

        return $result;
    }

    public function service_getRow($id)
    {
        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/article/' . $list['image'];
        });
        $append['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });
        $append['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });

        return article::getBy_Article_id($id)->appendRelation($append)->getList();

    }

    public function api_getRow($input,$_get)
    {
        $result = $this->service_get($input,$_get);
        Response::json($result, 'get', 200);
    }

    public function service_get($input,$_get)
    {
        include_once ROOT_DIR . 'component/city/model/city.model.php';
        include_once ROOT_DIR . 'component/province/model/province.model.php';
        require_once ROOT_DIR . "component/package/member/model/package.model.php";

        $size = $_get['size'];
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
        $append_top['package_id'] = array('formatter' => function ($list) {
            $st=$list['package_id'];
            if($st==''){
                $st='0';
            }
            return $st;
        });
        $internal['allCategory'] = category::getAll()->keyBy('Category_id')->getList();
        $append_company['category_name'] = array('formatter' => function ($list, $internal) {
            $st = $internal['allCategory']['data'][$list['category']]['Category_id'];
            return $st;
        });

        $internal['allCity'] = city::getAll()->keyBy('City_id')->getList();
        $append_company['city_name'] = array('formatter' => function ($list, $internal) {
            $st = $internal['allCity']['data'][$list['city_id']]['name'];
            return $st;
        });

        $internal['allProvince'] = province::getAll()->keyBy('province_id')->getList();
        $append_company['province_name'] = array('formatter' => function ($list, $internal) {
            $st = $internal['allProvince']['data'][$list['state_id']]['name'];
            return $st;
        });

        $append_company['categories'] = array('formatter' => function ($list) {
            $categoryID = tagToArray($list['category_id'])['export']['list'];
            $parentCategory = tagToArray($list['parent_category_id'])['export']['list'];
            $allCategory = array_merge($parentCategory, $categoryID);
            return category::getBy_Category_id($allCategory)
                ->select('Category_id', 'parent_id', 'title')
                ->getList();
        });
        $companyFields = ['meta_keyword', 'company_name', 'description'];


        $append_company['POST'] = array('formatter' => function ($list, $internal) {
            $st = $_POST;
            return $st;
        });
        $append_SQL_category = new SearchModelDb();

        $input ['limit']['start'] = 0;
        $input ['limit']['length'] = 12;

        if ($input ['type'] == 'company') {
            $input ['type'] = "تولیدی";
        } else if ($input['type'] == "product") {
            $input ['type'] = "محصولات";
            return $result = $this->getAllProduct($input, $append_company, $internal);
        } else {
            $result['result'] = -1;
            $result['errors']['type'][] = 'نوع سرچ باید از company  یا product  باشد';
            return $result;
        }

        foreach ($input['city'] as $key => $value) {
            $input['city'][$key] = $internal['allCity']['data'][$value]['name'];
        }

        $input['city'] = implode(',', $input['city']);

        foreach ($input['province'] as $key => $value) {

            $input['province'][$key] = $internal['allProvince']['data'][$value]['name'];

        }
           $input['province'] = implode(',', $input['province']);
        $input['category'] = implode(',', $input['category']);

        $searchByCategory = $append_SQL_category->apiSearchInDb('company', $companyFields, $input);
        $result = company::query($searchByCategory)
            ->appendRelation($append_company, $internal)
            ->paginate($size)
            ->getList();
        return $result;
    }

    public function api_getAll($input, $_get)
    {
        $result = $this->service_get($input, $_get);
        Response::json($result, 'none', 200);
    }

    public function getAllProduct($input, $append_company, $internal)
    {

        foreach ($input['city'] as $key => $value) {
            $input['city'][$key] = $internal['allCity']['data'][$value]['City_id'];
        }
        $input['city'] = array_filter($input['city'], 'strlen');
        $city = implode(',', $input['city']);

        foreach ($input['province'] as $key => $value) {
            $input['province'][$key] = $internal['allProvince']['data'][$value]['province_id'];
        }
        $input['province'] = array_filter($input['province'], 'strlen');

        $province = implode(",", $input['province']);

        foreach ($input['category'] as $key => $value) {
            $input['category'][$key] = $internal['allCategory']['data'][$value]['Category_id'];
        }
        $category = array_filter($input['category'], 'strlen');

        $query = $this->sql_product($input['q']);
        if (strlen($city) > 0 or strlen($province) > 0) {
            $query .= " and ";
        }
        if (strlen($city) > 0 or strlen($province) > 0) {
            $query .= "(";
        }
        if (strlen($city) > 0) {
            $query .= "`city_id` in (" . $city . ")";
        }
        if (strlen($province) > 0 and strlen($city) > 0) {
            $query .= " or ";
        }
        if (strlen($province) > 0) {
            $query .= "`state_id` in (" . $province . ")";
        }
        if (strlen($city) > 0 or strlen($province) > 0) {
            $query .= ")";
        }

        if (!empty($category)) {
            $query .= " and (";
        }

        if (!empty($category)) {
            foreach ($category as $key => $value) {
                $categoryId = $value;
                $query .= "`category_id` like '%,$categoryId,%' or parent_category_id like '%,$categoryId,%' or ";
            }
        }

        if (!empty($category)) {
            $query = substr($query, 0, -4);
            $query .= ')';
        }
      //  print_r_debug($query);
        $result = c_product::query($query)
            ->appendRelation($append_company, $internal)
            ->getList();
        return $result;
    }

    public function sql_product($q)
    {
        return $q = "SELECT CASE WHEN meta_keyword = '" . $q . "' THEN 1 
        WHEN meta_keyword LIKE '" . $q . "' THEN 2 
        WHEN meta_keyword LIKE '." . $q . ".,%' THEN 3 
        WHEN meta_keyword LIKE  '%," . $q . "' THEN 4 
        WHEN meta_keyword LIKE  '%," . $q . ",%' THEN 5 
        WHEN title = '" . $q . "' THEN 6 
        WHEN title LIKE '" . $q . "' THEN 7 
        WHEN title LIKE '" . $q . "%' THEN 8 
        WHEN title LIKE  '%" . $q . "' THEN 9 
        WHEN title LIKE  '%" . $q . "%' THEN 10 
        WHEN description = '" . $q . "' THEN 11 
        WHEN description LIKE '" . $q . "' THEN 12 
        WHEN description LIKE '" . $q . "%' THEN 13 
        WHEN description LIKE  '%" . $q . "' THEN 14 
        WHEN description LIKE  '%" . $q . "%' THEN 15 
        ELSE  16 END As rnk,`c_product`.* FROM 	c_product WHERE (`meta_keyword` = '" . $q . "' OR
        `meta_keyword` LIKE '" . $q . "' OR
        `meta_keyword` LIKE '" . $q . "%' OR
        `meta_keyword` LIKE '%" . $q . "%' OR
        `title` = '" . $q . "' OR
        `title` LIKE '" . $q . "' OR
        `title` LIKE '" . $q . "%' OR
        `title` LIKE '%" . $q . "%' OR
        `description` = '" . $q . "' OR
        `description` LIKE '" . $q . "' OR
        `description` LIKE '" . $q . "%' OR
        `description` LIKE '%" . $q . "%' ) and status = 1";
    }
}