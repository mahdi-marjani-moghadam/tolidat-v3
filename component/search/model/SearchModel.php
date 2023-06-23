<?php

class SearchModel
{
    private $companyFields = ['meta_keyword', 'company_name', 'description'];
    private $productsFields = ['title', 'description'];
    private $recordsCount;
    private $pagination;
    private $result;
    private $fields;
    private $list;

    public function __get($field)
    {
        if ($field == 'result') {
            return $this->result;
        } elseif ($field == 'fields') {
            return $this->fields;
        } elseif ($field == 'list') {
            return $this->list;
        } elseif ($field == 'recordsCount') {
            return $this->recordsCount;
        } elseif ($field == 'pagination') {
            return $this->pagination;
        } else {
            return $this->fields[$field];
        }
    }

    public function setFields($input)
    {
        foreach ($input as $field => $val) {
            $funcName = '__set' . ucfirst($field);
            if (method_exists($this, $funcName)) {
                $result = $this->$funcName($val);
                if ($result['result'] == 1) {
                    $this->fields[$field] = $val;
                } else {
                    return $result;
                }
            }
        }
        $result['result'] = 1;

        return $result;
    }

    public function getDefault($fields)
    {
        $fields['type'] = 'تولیدی';
        $result = $this->getCompany($fields);

        /* -------------------------------------------------------------------------------
        * Creating Pagination
        * -------------------------------------------------------------------------------
        */

        if ($result['result'] != 1) {
            return $result;
        }

        $temp = $result['export'];
        unset($result['export']);
        $result['export']['company'] = $temp;
        $resultPage['company'] = $this->pagination('company');

        if ($resultPage['company']['result'] == 1 && ($fields['type'] == 'تولیدی' || !isset($fields['type']))) {
            $this->pagination['company'] = $resultPage['company']['export']['list'];
        }

        return $result;
    }

    public function getCompany($fields)
    {

        // print_r_debug($fields);
        /* -------------------------------------------------------------------------------
         * Maybe later in the project we add "favorites", "most visited", "top10",
         * "10 Last" or any kind of sorting that makes us to order it.
         * -------------------------------------------------------------------------------
         */
        if (isset($fields['order'])) {
            $order = $fields['order'];
            unset($fields['order']);
            $fields['order']['Company_id'] = $order;
            $fields['order']['rnk'] = $order;
        }

        $result = $this->search('company', $this->companyFields, $fields);

        //dd($result);
        /* -------------------------------------------------------------------------------
         * Creating Pagination
         * -------------------------------------------------------------------------------
         */

        if ($result['result'] == 1) {
            $temp = $result['export'];
            unset($result['export']);
            $result['export']['company'] = $temp;
            $resultPage['company'] = paginationButtom($this->recordsCount['company'], 10);

            if ($resultPage['company']['result'] == 1 && ($fields['type'] == 'تولیدی' || !isset($fields['type']))) {
                $this->pagination['company']['pageCount'] = $resultPage['company']['export']['pageCount'];
                $this->pagination['company']['rowCount'] = $resultPage['company']['export']['rowCount'];
                $this->pagination['company']['list'] = $resultPage['company']['export']['list'];
            }
        }

        return $result;
    }

    public function getProducts($fields)
    {
        if (isset($fields['order'])) {
            $order = $fields['order'];
            unset($fields['order']);
            $fields['order']['Company_products_id'] = $order;
            $fields['order']['rnk'] = $order;
        }

        $result = $this->search('c_product', $this->productsFields, $fields);

        /* -------------------------------------------------------------------------------
         * Creating Pagination
         * -------------------------------------------------------------------------------
         */
        if ($result['result'] == 1) {
            $temp = $result['export'];
            unset($result['export']);
            $result['export']['c_product'] = $temp;
            $resultPage['c_product'] = paginationButtom($this->recordsCount['c_product'], 10);


            if ($resultPage['c_product']['result'] == 1 && ($fields['type'] == 'محصولات' || !isset($fields['type']))) {
                $this->pagination['c_product']['pageCount'] = $resultPage['c_product']['export']['pageCount'];
                $this->pagination['c_product']['rowCount'] = $resultPage['c_product']['export']['rowCount'];
                $this->pagination['c_product']['list'] = $resultPage['c_product']['export']['list'];
            }

        }

        return $result;
    }

    private function search($table, $dbFields, $fields)
    {

        include_once dirname(__FILE__) . '/SearchModelDb.php';

        $search = new SearchModelDb;

        $result = $search->searchInDb($table, $dbFields, $fields);
        /* -------------------------------------------------------------------------------
         * Filling the List property with the values that user filtered through them.
         * For Example: if user choose tehran and mashhad in the Medicine category
         * then we will limit our results due to the selected category and city.
         * -------------------------------------------------------------------------------
         */

        $this->list[$table] = $result['export']['list'];
        $this->list['category'] = $result['export']['category'];
        $this->list['searchCategory'] = $result['export']['searchCategory'];
        $this->list['searchProvince'] = $result['export']['searchProvince'];

        $this->list['category'] = $result['export']['category'];
        $this->list['province'] = $result['export']['province'];
        $this->list['city'] = $this->sortCities($result['export']['city']);
        $this->list['searchItem'] = $result['export']['searchItem'];
        $this->recordsCount[$table] = $result['export']['recordsCount'];


        include_once(ROOT_DIR . "component/category/model/category.model.php");
        $category = new categoryModel();
        
        $resultCategory = $category->getCategoryUlLiSearch($result['export']['searchCategory']);
        if ($resultCategory['result'] == 1) {
            $this->list['searchCategoryUlLi'] = $resultCategory['list'];
        }

        if (($result['export']['recordsCount']) == 0) {
            $result['msg'] = 'رکوردی یافت نشد';
        }




        return $result;
    }

    private function sortCities($cities)
    {
        if (isset($_SESSION['city'])) {
            $city = $_SESSION['city'];
            $newCities = array();
            foreach ($cities as $key => $value) {
                if ($value['name'] == $city) {
                    unset($city);
                    $city = $value;
                    unset($cities[$key]);
                }
            }
            array_push($newCities, $city);
            foreach ($cities as $key => $value) {
                array_push($newCities, $value);
            }

            return $newCities;
        }

        return $cities;
    }

    private function pagination($table)
    {

        $pageCount = ceil($this->recordsCount[$table] / PAGE_SIZE);
        $pagination = array();
        $temp = 1;

        $url_main = substr($_SERVER['REQUEST_URI'], strlen(SUB_FOLDER) + 1);
        $url_main = urldecode($url_main);
        $PARAM = explode('/', $url_main);
        $PARAM = array_filter($PARAM, 'strlen');

        if (array_search('page', $PARAM)) {
            $index_pageSize = array_search('page', $PARAM);
            unset($PARAM[$index_pageSize]);
            unset($PARAM[$index_pageSize + 1]);
            $PARAM = implode('/', $PARAM);
            $PARAM = explode('/', $PARAM);
            $PARAM = array_filter($PARAM, 'strlen');
        }

        for ($i = 1; $i <= $pageCount; ++$i) {
            foreach ($PARAM as $key => $value) {
                $url = '/' . $value;
            }
            $pagination[] = $url . '/page/' . $temp;
            $temp = $temp + 1;
            $url = '';
        }

        $result['result'] = 1;
        $result['export']['list'] = $pagination;

        return $result;
    }
}
