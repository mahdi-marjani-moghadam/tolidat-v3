<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:33 AM.
 */
class companyModelDb
{
    public static function getCompanyById($row)
    {
//        //global $lang;
//        $conn = dbConn::getConnection();
//        $sql = "SELECT
//                    *
//                FROM
//                    company
//                WHERE
//                    Company_id= '$id' and status='1' ";
//
//        $stmt = $conn->prepare($sql);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt) {
//            $result['result'] = -1;
//            $result['Number'] = 1;
//            $result['msg'] = $conn->errorInfo();
//
//            return $result;
//        }
//
//        if (!$stmt->rowCount()) {
//            $result['result'] = -1;
//            $result['no'] = 1;
//            $result['msg'] = 'This Record was Not Found';
//
//            return $result;
//        }
//
//        $row = $stmt->fetch();
        $row = self::getCompanyContactInfo($row['Company_id'], $row);

        $result['result'] = 1;
        $result['list'] = $row;

        return $result;
    }

    public static function getCompanyByCategoryId($id)
    {
        $conn = dbConn::getConnection();
        $sql = "SELECT SQL_CALC_FOUND_ROWS
                *
                FROM
                    article
                WHERE
                    category_id in ($id)";

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        if (!$stmt->rowCount()) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';

            return $result;
        }

        $sql = ' SELECT FOUND_ROWS() as recCount ';

        $stmTp = $conn->prepare($sql);
        $stmTp->setFetchMode(PDO::FETCH_ASSOC);
        $stmTp->execute();
        $rowP = $stmTp->fetch();

        $result['export']['recordsCount'] = $rowP['recCount'];

        while ($row = $stmt->fetch()) {
            // $row1 = self::getCompanyContactInfo($id,$row);
            $list[$row['Article_id']] = $row;
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }

    public function getCompany($fields = '')
    {
        $conn = dbConn::getConnection();

        include_once ROOT_DIR . '/model/db.inc.class.php';

        $condition = DataBase::filterBuilder($fields);

        $sql = "SELECT company.*, c_logo.image FROM company LEFT JOIN c_logo ON company.Company_id = c_logo.company_id WHERE  status='1'";
        if (isset($fields['condition']['city_id'])) {
            $sql .= ' AND city_id = ' . $fields['condition']['city_id'];
        }
        if (isset($fields['condition']['category_id'])) {
            $sql .= ' AND (';
            $categories = explode(',', $fields['condition']['category_id']);
            foreach ($categories as $key => $value) {
                $sql .= "category_id like '%," . $value . ",%' or ";
            }
            $sql = substr($sql, 0, -3);
            $sql .= ') ';
        }
        //print_r_debug($condition['list']['order']);
        $sql .= $condition['list']['order'] . $condition['list']['limit'];
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

        $result['export']['recordsCount'] = $rowP['recCount'];

        while ($row = $stmt->fetch()) {
            $list[$row['Company_id']] = $row;
        }
        $result['result'] = 1;
        $result['export']['list'] = $list;
        //print_r_debug($result);
        return $result;
    }
    public static function getLastCompany($fields = '')
    {
        $conn = dbConn::getConnection();

        include_once ROOT_DIR.'/model/db.inc.class.php';

        $condition = DataBase::filterBuilder($fields);
        $appendSql = "WHERE  company.status='1' AND (company.package_status='1' OR company.package_status='4') AND company.Company_id<>'22415' AND company.Company_id<>'22417' AND company.Company_id<>'22419' AND company.Company_id<>'22421'";

        if ($condition['list']['WHERE'] != '') {
            $appendSql = $appendSql.' and ';
            $condition['list']['filter'] = '('.$condition['list']['filter'].')';
        }

        $sql = 'SELECT SQL_CALC_FOUND_ROWS
                 company.*, c_logo.image
    		     FROM company LEFT JOIN c_logo ON company.Company_id = c_logo.company_id '.$appendSql;
        if (isset($fields['chose']['city_id'])) {
            $sql .= ' AND company.city_id = '.$fields['chose']['city_id'];
        }
        $sql .= 'ORDER BY `refresh_date` DESC '. $condition['list']['limit'];
        
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

        $result['export']['recordsCount'] = $rowP['recCount'];

        while ($row = $stmt->fetch()) {
            $list[$row['Company_id']] = $row;
        }
        $result['result'] = 1;
        $result['export']['list'] = $list;
        return $result;
    }

    /**
     * @author vaziry
     */
    public static function getRelatedCompanies($id)
    {
        $company = self::getCompanyById($id);
        $keywords = explode(',', $company['list']['meta_keyword']);
        $conn = dbConn::getConnection();

        $sql = "SELECT SQL_CALC_FOUND_ROWS company.*, c_logo.image 
                FROM company 
                LEFT JOIN c_logo ON company.Company_id = c_logo.company_id 
                WHERE status = 1 AND company.Company_id !=" . $id . " AND(";

        foreach ($keywords as $key => $value) {
            if ($value != '') {
                $sql .= " meta_keyword like '%$value%' or";

            }
        }
        $sql = substr($sql, 0, -3);
        $sql .= ')';
        $sqlLow = $sql . " AND (priority != '1' or priority is null) ";
        $sqlHigh = $sql . " AND priority = '1' ";

        $stmt = $conn->prepare($sqlHigh);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        //  if high priority companies are less than 10
        if ($stmt->rowCount() < RELATED_COMPANY_COUNT) {
            // get limit of low priority companies
            $limit = RELATED_COMPANY_COUNT - $stmt->rowCount();
            // ---

            // get high priority companies
            $stmt = $conn->prepare($sqlHigh);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $list[$row['Company_id']] = $row;
            }
            // ---

            // get low priority companies random
            $stmt = $conn->prepare($sqlLow);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $listTmp[$row['Company_id']] = $row;
            }
            if (count($listTmp) >= $limit) {
                $randList = array_rand($listTmp, $limit);
            } else {
                $randList = array_rand($listTmp, count($listTmp));
            }
            if (count($randList) > 1) {
                foreach ($randList as $key => $value) {
                    $list[$value] = $listTmp[$value];
                }
            } elseif (count($randList) == 1) {
                $list[$randList] = $listTmp[$randList];
            }
            // ---
        } else {
            $stmt = $conn->prepare($sqlHigh);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $list[$row['Company_id']] = $row;
            }
        }

        $result['result'] = 1;
        $result['export']['list'] = $list;
        return $result;
    }

    public static function getArticleEasy()
    {
        //global $lang;

        $conn = dbConn::getConnection();
        $sql = "SELECT
                    *
                FROM
                    article
                   ORDER BY 'date' DESC ";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $list = $stmt->fetchAll();
        $result['result'] = 1;
        $result['export']['list'] = $list;

        return $result;
    }

    public static function getContactInfo($company_id)
    {

        //print_r_debug($id);
        include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
        include_once ROOT_DIR . 'component/companyEmails/model/companyEmails.model.php';
        include_once ROOT_DIR . 'component/companyWebsites/model/companyWebsites.model.php';



        $phone = c_phones::getBy_company_id_and_isMain($company_id, 1)->first()->fields;
        //$export['list']['phone_main'] = $phone['export']['list'][0]['number'];
        //print_r_debug($phone);

        $row['company_phone'] = $phone;

        //$list[$row['Company_id']] = $row;
        // get company emails
//        $sql1 = "select * from company_emails where `company_id`='$company_id'";
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $emails = [
//            'Company_emails_id' => [],
//            'subject' => [],
//            'email' => [],
//        ];
//
//        while ($row1 = $stmt1->fetch()) {
//            array_push($emails['Company_emails_id'], $row1['Company_emails_id']);
//            array_push($emails['subject'], $row1['email_subject']);
//            array_push($emails['email'], $row1['email_email']);
//        }
//
//        $row['company_email'] = $emails;
//        $list[$row['Company_id']] = $row;
//
//        // get company addresses
//        $sql1 = "select * from company_addresses where `company_id`='$id'";
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $addresses = [
//            'Company_addresses_id' => [],
//            'subject' => [],
//            'address' => [],
//        ];
//
//        while ($row1 = $stmt1->fetch()) {
//            array_push($addresses['Company_addresses_id'], $row1['Company_addresses_id']);
//            array_push($addresses['subject'], $row1['address_subject']);
//            array_push($addresses['address'], $row1['address_address']);
//        }
//
//        $row['company_address'] = $addresses;
//        $list[$row['Company_id']] = $row;
//        // get company websites
//        $sql1 = "select * from company_websites where `company_id`='$id'";
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $websites = [
//            'Company_websites_id' => [],
//            'subject' => [],
//            'url' => [],
//        ];
//
//        while ($row1 = $stmt1->fetch()) {
//            array_push($websites['Company_websites_id'], $row1['Company_websites_id']);
//            array_push($websites['subject'], $row1['website_subject']);
//            array_push($websites['url'], $row1['website_url']);
//        }
//
//        $row['company_website'] = $websites;
//
//        include_once ROOT_DIR . '/component/company/model/company.controller.php';
//        $companyController = new companyController();
//        $object = (object) $row;
//        //print_r_debug($object);
//
//        $row['rate']=$companyController->rate($object);


        //print_r_debug($row);
        return $row;

    }


    private static function getCompanyContactInfo($id, $row)
    {
        $conn = dbConn::getConnection();



        $sql1 = "select * from c_logo where `company_id`='$id'  ";

        //die($sql1);

        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $stmt1->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt1) {
            $result1['result'] = -1;
            $result1['Number'] = 1;
            $result1['msg'] = $conn->errorInfo();

            return $result1;
        }

        $logo = [
            'Logo_id' => [],
            'title' => [],
            'image' => [],
            'company_id' => []
        ];

        $row1 = $stmt1->fetch();

        array_push($logo['Logo_id'], $row1['Logo_id']);
        array_push($logo['company_id'], $row1['company_id']);
        array_push($logo['title'], $row1['title']);
        array_push($logo['image'], $row1['image']);
        $row['logo'] = $logo;





//        // get company phones
//        $sql1 = "select * from c_phones where `company_id`='$id' and `isMain`='1' and `branch_id`='0' ";
//
//        //die($sql1);
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $phones = [
//            'Company_phones_id' => [],
//            'subject' => [],
//            'number' => [],
//            'state' => [],
//            'value' => [],
//        ];
//
//        $row1 = $stmt1->fetch();
//        array_push($phones['Company_phones_id'], $row1['Phones_id']);
//        array_push($phones['subject'], $row1['subject']);
//        array_push($phones['number'], $row1['number']);
//        array_push($phones['state'], $row1['state']);
//        array_push($phones['value'], $row1['value']);
//
//
//        $row['company_phone'] = $phones;
//        $list[$row['Company_id']] = $row;
//        // get company emails
//        $sql1 = "select * from c_emails where `company_id`='$id' and `branch_id`='0' ";
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $emails = [
//            'Company_emails_id' => [],
//            'subject' => [],
//            'email' => [],
//        ];
//
//        $row1 = $stmt1->fetch();
//        array_push($emails['Company_emails_id'], $row1['Emails_id']);
//        array_push($emails['subject'], $row1['subject']);
//        array_push($emails['email'], $row1['email']);
//
//
//        $row['company_email'] = $emails;
//        $list[$row['Company_id']] = $row;
//
//        // get company addresses
//        /*$sql1 = "select * from company_addresses where `company_id`='$id'";
//
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $addresses = [
//            'Company_addresses_id' => [],
//            'subject' => [],
//            'address' => [],
//        ];
//
//        while ($row1 = $stmt1->fetch()) {
//            array_push($addresses['Company_addresses_id'], $row1['Company_addresses_id']);
//            array_push($addresses['subject'], $row1['address_subject']);
//            array_push($addresses['address'], $row1['address_address']);
//        }
//
//        $row['company_address'] = $addresses;*/
//        $list[$row['Company_id']] = $row;
//        // get company websites
//        $sql1 = "select * from c_websites where `company_id`='$id' and `branch_id`='0' ";
//
//       // die($sql1);
//        $stmt1 = $conn->prepare($sql1);
//        $stmt1->execute();
//        $stmt1->setFetchMode(PDO::FETCH_ASSOC);
//
//        if (!$stmt1) {
//            $result1['result'] = -1;
//            $result1['Number'] = 1;
//            $result1['msg'] = $conn->errorInfo();
//
//            return $result1;
//        }
//
//        $websites = [
//            'Company_websites_id' => [],
//            'subject' => [],
//            'url' => [],
//        ];
//
//        $row1 = $stmt1->fetch();
//        array_push($websites['Company_websites_id'], $row1['Websites_id']);
//        array_push($websites['subject'], $row1['subject']);
//        array_push($websites['url'], $row1['url']);
//        $row['company_website'] = $websites;

        include_once ROOT_DIR . '/component/company/model/company.controller.php';
        $rate = new Rate();
        $object = (object) $row;
        $row['rate']=$rate->rate($object);

        return $row;
    }
}
