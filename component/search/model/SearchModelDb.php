<?php

include_once ROOT_DIR . '/component/city/admin/model/admin.city.model.db.php';
include_once ROOT_DIR . '/component/province/model/province.model.db.php';
include_once ROOT_DIR . '/component/province/model/province.model.db.php';
include_once ROOT_DIR . '/component/category/model/category.model.db.php';
include_once ROOT_DIR . '/component/category/model/category.model.db.php';
include_once ROOT_DIR . '/component/city/model/city.model.db.php';
include_once ROOT_DIR . '/model/db.inc.class.php';

class SearchModelDb
{

    private function createProvinceAndCityQuery($append_SQL_province, $city, $type)
    {

        if (count($city['export']['list'])) {
            if ($append_SQL_province != '') {
                $append_SQL_province .= ' or ';
            } else {
                $append_SQL_province .= ' and (';
            }

            foreach ($city['export']['list'] as $key => $value) {
                $cityId = $value['City_id'];
                if ($type == 'محصولات') {
                    $append_SQL_province .= " `p`.`city_id` = '$cityId' or ";
                } else {
                    $append_SQL_province .= " `city_id` = '$cityId' or ";
                }
            }

            $append_SQL_province = substr($append_SQL_province, 0, -3);
            $append_SQL_province .= ')';
        } else {

            if ($append_SQL_province != '') {
                $append_SQL_province .= ' )';
            } else {
                $append_SQL_province .= ' ';
            }
        }

        return $append_SQL_province;
    }

    private function createProvinceQuery($province, $type)
    {
        if (count($province['export']['list'])) {
            $append_SQL_province = ' and (';
            foreach ($province['export']['list'] as $key => $value) {
                $provinceId = $value['province_id'];
                if ($type == 'محصولات') {
                    $append_SQL_province .= " `p`.`state_id` = '$provinceId' or ";
                } else {
                    $append_SQL_province .= " `state_id` = '$provinceId' or ";
                }
            }

            $append_SQL_province = substr($append_SQL_province, 0, -3);

        } else {
            $append_SQL_province = '';
        }

        return $append_SQL_province;
    }

    public function createCategoryQuery($category, $type)
    {
        if (count($category) or $category == '0') {
            $append_SQL_category = ' AND (';
            foreach ($category as $key => $value) {
                $categoryId = $value['Category_id'];

                if ($type == 'محصولات') {
                    $append_SQL_category .= " `p`.`category_id` LIKE '%,$categoryId,%' OR `p`.`parent_category_id` like '%,$categoryId,%' OR";
                } else {

                    $append_SQL_category .= " `category_id` LIKE '%,$categoryId,%' OR parent_category_id like '%,$categoryId,%' OR";
                }
            }
            $append_SQL_category = substr($append_SQL_category, 0, -2);
            $append_SQL_category .= ')';

        } else {
            $append_SQL_category = '';
        }

        return $append_SQL_category;
    }

    public function searchInDb($table, $dbField, $fields = '')
    {
        $conn = dbConn::getConnection();

        /* -------------------------------------------------------------------------------
         * Adding Limitation to the results like count of the companies in a page or
         * sorting the companies in order to specific field.
         * -------------------------------------------------------------------------------
         */
        $condition = DataBase::filterBuilder($fields);
        $sqlPre = 'SELECT SQL_CALC_FOUND_ROWS' . PHP_EOL;
        $sqlPre .= ' *' . PHP_EOL;
        $sqlPre .= ' FROM' . PHP_EOL;
        $sqlPre .= ' (';
        $sqlEnd = ') t1';

        /* -------------------------------------------------------------------------------
         * Finding the cities that has been used as a filter in the search.
         * -------------------------------------------------------------------------------
         */
        $city = adminCityModelDb::getCityByNameArray($fields['city']);

        /* -------------------------------------------------------------------------------
         * Finding the Province that has been used as a filter in the search.
         * Created by Hamid ( Don't Panic )!
         * -------------------------------------------------------------------------------
         */
        $province = provinceModelDb::getProvinceByNameArray($fields['province']);

        $append_SQL_province = $this->createProvinceQuery($province, $fields['type']);

        /* -------------------------------------------------------------------------------
         * Adding City filter into the query.
         * -------------------------------------------------------------------------------
         */
        $append_SQL_province = $this->createProvinceAndCityQuery($append_SQL_province, $city, $fields['type']);

        /* -------------------------------------------------------------------------------
         * Finding the Category that has been used as a filter in the search.
         * -------------------------------------------------------------------------------
         */
        $category = categoryModelDb::getCategoryByIdString($fields['category']);

        $searchItem['category'] = $category;
        $searchItem['city'] = $city['export'];
        $searchItem['province'] = $province['export'];

        /* -------------------------------------------------------------------------------
         * Adding Category filter into the query.
         * -------------------------------------------------------------------------------
         */
        //print_r_debug($fields['type']);

        $append_SQL_category = $this->createCategoryQuery($category, $fields['type']);


        /* -------------------------------------------------------------------------------
         * Generating, Running and Fetch Search Query For Category filter.
         * -------------------------------------------------------------------------------
         */

        $data = [
            'table' => $table,
            'fields' => $fields,
            'dbField' => $dbField,
            'append_SQL_category' => $append_SQL_category,
            'append_SQL_province' => '',
            'append_SQL_city' => '',
            'query' => isset($fields['q'])
        ];


        if ($fields['type'] == 'محصولات') {
            $sql = $sqlPre . self::generateProductQuery($data);
        } else {
            $sql = $sqlPre . self::generateCompanyQuery($data);
        }

        $sql .= $sqlEnd;
        //print_r_debug($sql);
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        /* -------------------------------------------------------------------------------
         * Finding all the Province list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        $provinces = provinceModelDb::getProvinces();
        $result['export']['province'] = $provinces['export']['list'];

        /* -------------------------------------------------------------------------------
         * Finding all the Cities list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        $cities = cityModelDb::getCities();
        $result['export']['city'] = $cities['export']['list'];

        $i = 0;
        while ($row = $stmt->fetch()) {

            $i++;
            $id = ucfirst($table) . '_id';
            //Province
            if (!isset($result['export']['searchProvince'][$row['state_id']])) {
                $result['export']['searchProvince'][$row['state_id']] = $result['export']['province'][$row['state_id']];
            }

            $result['export']['searchProvince'][$row['state_id']]['count'] =
                $result['export']['searchProvince'][$row['state_id']]['count'] + 1;

            //City
            if (!isset($result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']])) {
                $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']] =
                    $result['export']['city'][$row['city_id']];
            }

            $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']]['count'] =
                $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']]['count'] + 1;
        }

        /* -------------------------------------------------------------------------------
         * Generating Search Query For Province and city filter.
         * -------------------------------------------------------------------------------
         */
        $data = [
            'table' => $table,
            'fields' => $fields,
            'dbField' => $dbField,
            'append_SQL_category' => '',
            'append_SQL_province' => $append_SQL_province,
            'append_SQL_city' => $append_SQL_city,
            'query' => isset($fields['q'])
        ];

        if ($fields['type'] == 'محصولات') {
            $sql = $sqlPre . self::generateProductQuery($data);
        } else {
            $sql = $sqlPre . self::generateCompanyQuery($data);
        }

        $sql .= $sqlEnd;

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        $rowP['recCount'] = $stmt->rowCount();

        /* -------------------------------------------------------------------------------
         * Finding all the Categories list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        $catIds = [];
        $categories = categoryModelDb::getCategoryAll();
        $result['export']['category'] = $categories['export']['list'];

        while ($row = $stmt->fetch()) {

            $catIdsArray = array_filter(explode(',', $row['category_id']), 'strlen');
            $catParentIdsArray = array_filter(explode(',', $row['parent_category_id']), 'strlen');
            $catId = array_merge($catIdsArray, $catParentIdsArray);

            foreach ($catId as $key1 => $value1) {

                $parent_id = $result['export']['category'][$value1]['parent_id'];

                if (!isset($result['export']['searchCategory'][$parent_id][$value1])) {
                    $result['export']['searchCategory'][$parent_id][$value1] =
                        $result['export']['category'][$value1];
                }

                $result['export']['searchCategory'][$parent_id][$value1]['count'] =
                    $result['export']['searchCategory'][$parent_id][$value1]['count'] + 1;
            }
        }
        /* -------------------------------------------------------------------------------
         * Generating Search Query to add the priority.
         * -------------------------------------------------------------------------------
         */
        unset($result['export']['category'][0]);
        $condition['list']['order'] = ' order by priority DESC ,rnk ASC , refresh_date DESC ';

        $data = [
            'table' => $table,
            'fields' => $fields,
            'dbField' => $dbField,
            'append_SQL_category' => $append_SQL_category,
            'append_SQL_province' => $append_SQL_province,
            'append_SQL_city' => $append_SQL_city,
            'query' => isset($fields['q'])
        ];

        if ($fields['type'] == 'محصولات') {
            $sql = $sqlPre . self::generateProductQuery($data);
        } else {
            $sql = $sqlPre . self::generateCompanyQuery($data);
        }
        $sql .= $sqlEnd;
        $sql .= $condition['list']['order'] . $condition['list']['limit'];
        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
//($sql);
        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $sql = ' SELECT FOUND_ROWS() as recCount ';
        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();

        if ($table == 'company') {
            while ($row = $stmt->fetch()) {
                include_once ROOT_DIR . '/component/company/model/company.model.db.php';
                $id = ucfirst($table) . '_id';
                $list[$row[$id]] = companyModelDb::getCompanyById($row)['list'];
                //$list[$row[$id]] = companyModelDb::getContactInfo($row[$id]);

                $list[$row[$id]]['cityName'] = $result['export']['city'][$list[$row[$id]]['city_id']]['name'];
                // $list[$row[$id]]['category_title'] = $this->getCategoryName($row, $categories['export']['list']);
                $list[$row[$id]]['category_title'] = $this->getCategoryName2($row, $categories['export']['list']);
                
            }
        } else {
            while ($row = $stmt->fetch()) {
                $list[$row['Product_id']] = $row;
            }
        }

        $result['export']['recordsCount'] = $rowP['recCount'];
        $result['result'] = 1;
        $result['export']['list'] = $list;
        $result['export']['searchItem'] = $searchItem;
//        dd($result);
        unset($sql);
        return $result;
    }

    public function apiSearchInDb($table, $dbField, $fields = '')
    {
        $conn = dbConn::getConnection();



        /* -------------------------------------------------------------------------------
         * Adding Limitation to the results like count of the companies in a page or
         * sorting the companies in order to specific field.
         * -------------------------------------------------------------------------------
         */
        //$condition = DataBase::filterBuilder($fields);
        /*$sqlPre = 'SELECT SQL_CALC_FOUND_ROWS' . PHP_EOL;
        $sqlPre .= ' *' . PHP_EOL;
        $sqlPre .= ' FROM' . PHP_EOL;
       //$sqlPre .= ' (';
        //$sqlEnd = ') t1';*/

        /* -------------------------------------------------------------------------------
         * Finding the cities that has been used as a filter in the search.
         * -------------------------------------------------------------------------------
         */
        $city = adminCityModelDb::getCityByNameArray($fields['city']);

        /* -------------------------------------------------------------------------------
         * Finding the Province that has been used as a filter in the search.
         * Created by Hamid ( Don't Panic )!
         * -------------------------------------------------------------------------------
         */

        $province = provinceModelDb::getProvinceByNameArray($fields['province']);

        $append_SQL_province = $this->createProvinceQuery($province, $fields['type']);

        /* -------------------------------------------------------------------------------
         * Adding City filter into the query.
         * -------------------------------------------------------------------------------
         */

        $append_SQL_province = $this->createProvinceAndCityQuery($append_SQL_province, $city, $fields['type']);

        /* -------------------------------------------------------------------------------
         * Finding the Category that has been used as a filter in the search.
         * -------------------------------------------------------------------------------
         */
        $category = categoryModelDb::getCategoryByIdString($fields['category']);

        $searchItem['category'] = $category;
        $searchItem['city'] = $city['export'];
        $searchItem['province'] = $province['export'];

        /* -------------------------------------------------------------------------------
         * Adding Category filter into the query.
         * -------------------------------------------------------------------------------
         */
        //print_r_debug($fields['type']);
        // $fields['type'] = 'تولیدی';

        $append_SQL_category = $this->createCategoryQuery($category, $fields['type']);

        /* -------------------------------------------------------------------------------
         * Generating, Running and Fetch Search Query For Category filter.
         * -------------------------------------------------------------------------------
         */

        $data = [
            'table' => $table,
            'fields' => $fields,
            'dbField' => $dbField,
            'append_SQL_category' => $append_SQL_category,
            'append_SQL_province' => '',
            'append_SQL_city' => '',
            'query' => isset($fields['q'])
        ];


        /* if ($fields['type'] == 'محصولات') {
             $sql = $sqlPre . self::generateProductQuery($data);
         } else {
             $sql = $sqlPre . self::generateCompanyQuery($data);
         }*/

        // $sql .= $sqlEnd;

        /*$stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }*/

        /* -------------------------------------------------------------------------------
         * Finding all the Province list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        //$provinces = provinceModelDb::getProvinces();
        //$result['export']['province'] = $provinces['export']['list'];

        /* -------------------------------------------------------------------------------
         * Finding all the Cities list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        //$cities = cityModelDb::getCities();
        //$result['export']['city'] = $cities['export']['list'];

        $i = 0;
        /*while ($row = $stmt->fetch()) {
            $i++;
            $id = ucfirst($table) . '_id';
            //Province
            if (!isset($result['export']['searchProvince'][$row['state_id']])) {
                $result['export']['searchProvince'][$row['state_id']] = $result['export']['province'][$row['state_id']];
            }

            $result['export']['searchProvince'][$row['state_id']]['count'] =
                $result['export']['searchProvince'][$row['state_id']]['count'] + 1;

            //City
            if (!isset($result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']])) {
                $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']] =
                    $result['export']['city'][$row['city_id']];
            }

            $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']]['count'] =
                $result['export']['searchProvince'][$row['state_id']]['cities'][$row['city_id']]['count'] + 1;
        }*/

        /* -------------------------------------------------------------------------------
         * Generating Search Query For Province and city filter.
         * -------------------------------------------------------------------------------
         */
        /* $data = [
             'table' => $table,
             'fields' => $fields,
             'dbField' => $dbField,
             'append_SQL_category' => '',
             'append_SQL_province' => $append_SQL_province,
             'append_SQL_city' => $append_SQL_city,
             'query' => isset($fields['q'])
         ];

         if ($fields['type'] == 'محصولات') {
             $sql = $sqlPre . self::generateProductQuery($data);
         } else {
             $sql = $sqlPre . self::apiGenerateCompanyQuery($data);
         }*/

        //$sql .= $sqlEnd;

        /*$stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }*/

        // $rowP['recCount'] = $stmt->rowCount();

        /* -------------------------------------------------------------------------------
         * Finding all the Categories list. we need them to loop through them in the
         * search section in the page.
         * -------------------------------------------------------------------------------
         */
        $catIds = [];
        //$categories = categoryModelDb::getCategoryAll();
        //$result['export']['category'] = $categories['export']['list'];

        /*while ($row = $stmt->fetch()) {

            $catIdsArray = array_filter(explode(',', $row['category_id']), 'strlen');
            $catParentIdsArray = array_filter(explode(',', $row['parent_category_id']), 'strlen');
            $catId = array_merge($catIdsArray, $catParentIdsArray);

            foreach ($catId as $key1 => $value1) {

                $parent_id = $result['export']['category'][$value1]['parent_id'];

                if (!isset($result['export']['searchCategory'][$parent_id][$value1])) {
                    $result['export']['searchCategory'][$parent_id][$value1] =
                        $result['export']['category'][$value1];
                }

                $result['export']['searchCategory'][$parent_id][$value1]['count'] =
                    $result['export']['searchCategory'][$parent_id][$value1]['count'] + 1;
            }
        }*/

        /* -------------------------------------------------------------------------------
         * Generating Search Query to add the priority.
         * -------------------------------------------------------------------------------
         */
        unset($result['export']['category'][0]);
        $condition['list']['order'] = 'order by priority DESC ,  rnk ASC ,  refresh_date DESC ';

        $data = [
            'table' => $table,
            'fields' => $fields,
            'dbField' => $dbField,
            'append_SQL_category' => $append_SQL_category,
            'append_SQL_province' => $append_SQL_province,
            'append_SQL_city' => $append_SQL_city,
            'query' => isset($fields['q'])
        ];

        if ($fields['type'] == 'محصولات') {
            $sql = $sqlPre . self::generateProductQuery($data);
        } else {
            $sql = $sqlPre . self::apiGenerateCompanyQuery($data);
        }

        return $sql;

        //$sql .= $sqlEnd;

        // $sql .= $condition['list']['order'] . $condition['list']['limit'];

        //print_r_debug($sql);

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $sql = ' SELECT FOUND_ROWS() as recCount ';
        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();

        if ($table == 'company') {
            while ($row = $stmt->fetch()) {
                include_once ROOT_DIR . '/component/company/model/company.model.db.php';
                $id = ucfirst($table) . '_id';
                $list[$row[$id]] = companyModelDb::getCompanyById($row);

                //$list[$row[$id]] = companyModelDb::getContactInfo($row[$id]);
                $list[$row[$id]]['cityName'] = $result['export']['city'][$list[$row[$id]]['city_id']]['name'];
                $list[$row[$id]]['category_title'] = $this->getCategoryName($row, $categories['export']['list']);
            }
        } else {
            while ($row = $stmt->fetch()) {
                $list[$row['Product_id']] = $row;
            }
        }

        $result['export']['recordsCount'] = $rowP['recCount'];
        $result['result'] = 1;
        $result['export']['list'] = $list;
        $result['export']['searchItem'] = $searchItem;

        //print_r_debug($result);

        unset($sql);
        return $result;
    }

    public static function apiGenerateCompanyQuery($data = [])
    {


        extract($data);

        $sql = 'SELECT SQL_CALC_FOUND_ROWS CASE ';
        $count = 1;
        foreach ($dbField as $k => $Field) {
            if ($Field == 'meta_keyword') {
                $sql .= "WHEN " . $table.".".$Field . " = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE '" . $fields['q'] . ",%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE  '%," . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE  '%," . $fields['q'] . ",%' THEN $count " . PHP_EOL;
            } else {
                $sql .= "WHEN " . $table.".".$Field . " = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE '" . $fields['q'] . "%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE  '%" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $table.".".$Field . " LIKE  '%" . $fields['q'] . "%' THEN $count " . PHP_EOL;
            }
            $count++;
        }

        $sql .= 'ELSE  ' . $count . ' END As rnk,`' . $table . '`.*';
        $sql .= ',packageusage.package_id , c_logo.image ';

        $sql .= " FROM 	" . $table . " 

        left join c_logo on company.Company_id =c_logo.company_id
         left join packageusage on company.Company_id = packageusage.company_id 
        
        WHERE (";

        foreach ($dbField as $k => $dbField) {
            $sql .= $table.".`" . $dbField . "` = '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= $table.".`" . $dbField . "` LIKE '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= $table.".`" . $dbField . "` LIKE '" . $fields['q'] . "%' OR" . PHP_EOL;
            $sql .= $table.".`" . $dbField . "` LIKE '%" . $fields['q'] . "%' OR" . PHP_EOL;

        }

        $sql = substr($sql, 0, -4);
        $sql .= ") ";
        $sql .= " and status = 1 and (package_status=1 or package_status=4) $append_SQL_province $append_SQL_city $append_SQL_category ";
        $sql .= "order by priority DESC ,rnk ASC , refresh_date DESC ";

        return $sql;
    }

    public static function generateCompanyQuery($data = [])
    {
        extract($data);
        $sql = 'SELECT CASE ';
        $count = 1;
        foreach ($dbField as $k => $Field) {
            if ($Field == 'meta_keyword') {
                $sql .= "WHEN " . $Field . " = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE '" . $fields['q'] . ",%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE  '%," . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE  '%," . $fields['q'] . ",%' THEN $count " . PHP_EOL;
            } else {
                $sql .= "WHEN " . $Field . " = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE '" . $fields['q'] . "%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE  '%" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "WHEN " . $Field . " LIKE  '%" . $fields['q'] . "%' THEN $count " . PHP_EOL;
            }
            $count++;
        }
        $sql .= 'ELSE  ' . $count . ' END As rnk,`' . $table . '`.*';
        $sql .= " FROM 	" . $table . " WHERE (";

        foreach ($dbField as $k => $dbField) {
            $sql .= "`" . $dbField . "` = '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= "`" . $dbField . "` LIKE '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= "`" . $dbField . "` LIKE '" . $fields['q'] . "%' OR" . PHP_EOL;
            $sql .= "`" . $dbField . "` LIKE '%" . $fields['q'] . "%' OR" . PHP_EOL;

        }

        $sql = substr($sql, 0, -4);
        $sql .= ") ";
        $sql .= " and status = 1 and (package_status=1 or package_status=4) $append_SQL_province $append_SQL_city $append_SQL_category ORDER BY company.priority DESC ,rnk ASC, company.refresh_date DESC ";

        return $sql;
    }

    private static function generateProductQuery($data = [])
    {
        extract($data);
        $sql = 'SELECT CASE ';
        $count = 1;

        foreach ($dbField as $k => $Field) {
            if ($Field == 'c.meta_keyword') {
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . " = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . " LIKE '" . $fields['q'] . ",%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE  '%," . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE  '%," . $fields['q'] . ",%' THEN $count " . PHP_EOL;
            } else {
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` = '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE '" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE '" . $fields['q'] . "%' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE  '%" . $fields['q'] . "' THEN $count " . PHP_EOL;
                $count++;
                $sql .= "\t" . "WHEN " . '`p`.`' . $Field . "` LIKE  '%" . $fields['q'] . "%' THEN $count " . PHP_EOL;
            }
            $count++;
        }

        $sql .= "\t" . ' ELSE  ' . $count . ' END AS `rnk`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`company_name` AS `company_name`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`description` AS `company.description`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`registration_number` AS `company_registration_number`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`meta_description` AS `company_meta_description`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`meta_keyword` AS `company_meta_keyword`,' . PHP_EOL;
        $sql .= "\t" . ' `c`.`maneger_name` AS `company_manager_name`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`title`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`status`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`company_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`Product_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`category_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`parent_category_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`state_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`city_id`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`brif_description`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`description`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`meta_keyword`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`meta_description`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`image`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`date`,' . PHP_EOL;
        $sql .= "\t" . ' `p`.`priority`' . PHP_EOL;
        $sql .= "\t" . " FROM 	" . $table . ' p';

        $sql .= "\t" . ' LEFT JOIN company c ';
        $sql .= "\t" . ' ON `c`.`Company_id` = `p`.`company_id`';

        $sql .= " WHERE (";

        foreach ($dbField as $k => $dbField) {
            $sql .= "\t" . " `p`.`" . $dbField . "` = '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= "\t" . " `p`.`" . $dbField . "` LIKE '" . $fields['q'] . "' OR" . PHP_EOL;
            $sql .= "\t" . " `p`.`" . $dbField . "` LIKE '" . $fields['q'] . "%' OR" . PHP_EOL;
            $sql .= "\t" . " `p`.`" . $dbField . "` LIKE '%" . $fields['q'] . "%' OR" . PHP_EOL;
        }

        $sql = substr($sql, 0, -4);
        $sql .= " ) ";
        $sql .= " and `p`.`status` = 1" . $append_SQL_province . $append_SQL_city . $append_SQL_category;
        return $sql;
    }

    public function getCategoryName($company, $categories)
    {
        $categoryCompany = trim($company['category_id'], ',');
        $parentCategoryCompany = trim($company['parent_category_id'], ',');
        $categoryCompany = $categoryCompany . ',' . $parentCategoryCompany;
        $categoryCompanyArray = explode(',', $categoryCompany);
        foreach ($categoryCompanyArray as $catCompArr) {
            $category[$catCompArr] = $categories[$catCompArr]['title'];
        }
        return $category;
    }
    public function getCategoryName2($company, $categories)
    {
        $categoryCompany = trim($company['category_id'], ',');
        $parentCategoryCompany = trim($company['parent_category_id'], ',');
        $categoryCompany = $categoryCompany . ',' . $parentCategoryCompany;
        $categoryCompanyArray = explode(',', $categoryCompany);
        foreach ($categoryCompanyArray as $catCompArr) {
            $category[$catCompArr]['title'] = $categories[$catCompArr]['title'];
            $category[$catCompArr]['url'] = $categories[$catCompArr]['url'];
        }
        return $category;
    }

}