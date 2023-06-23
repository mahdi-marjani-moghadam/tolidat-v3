<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 AM.
 */
include_once ROOT_DIR.'/common/validators.php';
class admincompany_dModel extends looeic
{

    public function getCompany($fields = '')
    {
        $conn = dbConn::getConnection();
        include_once ROOT_DIR.'/model/db.inc.class.php';
        $condition = DataBase::filterBuilder($fields);
        $length=$condition['length'];
        if($condition['list']['order'] =='')
        {
            $condition['list']['order']= ' ORDER BY `Company_id` ASC ';
        }

        $sql="
                select
                SQL_CALC_FOUND_ROWS
                `t1`.* FROM
                 (
                    SELECT `company`.*,
                        `company_emails`.`email_email`,
                        `city`.`name` AS `city_name`,
                        `company_phones`.`phone_number`,
                        `company_websites`.`website_url`,
                        `company_addresses`.`address_address`
                      FROM `company`
                        LEFT JOIN `company_emails` ON `company`.`Company_id` =
                          `company_emails`.`company_id`
                        LEFT JOIN `company_phones` ON `company`.`Company_id` =
                          `company_phones`.`company_id`
                        LEFT JOIN `company_websites` ON `company`.`Company_id` =
                          `company_websites`.`company_id`
                        LEFT JOIN `city` ON `company`.`city_id` = `city`.`City_id`
                        LEFT JOIN `company_addresses` ON `company`.`Company_id` =
                          `company_addresses`.`company_id`".
            $fields['where']
            ."GROUP BY `company`.`Company_id`
                  ) as t1 "
            .$condition['list']['useWhere'].$condition['list']['filter'].$condition['list']['order'].$condition['list']['limit'];

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
        $row_count = $stmTp->fetch();
        $result['export']['recordsCount'] = $row_count['recCount'];


        while ($row = $stmt->fetch()) {
            $temp = self::tagToArray($row['category_id']);
            $row['category_id'] = $temp['export']['list'];
            $list[$row['Company_id']] = $row;

            //$temp = self::tagToArray($row['certification_id']);
            //$row['certification_id'] = $temp['export']['list'];

            $list[$row['Company_id']] = $row;

        }

        $result['result'] = 1;
        $result['export']['list'] = $list;
        return $result;
    }

    public static function getWikiCompanies()
    {
        $companyList = static::getBy_package_status_and_new_register_and_status_and_isActive(1, 0, -1, 1)
            ->getList();

        return $companyList['export']['list'];
    }

    public static function getCompanyById($id)
    {
        //global $lang;
        $company = admincompanyModel::getBy_Company_id($id)->getList();
        //print_r_debug($company);

        //print_r_debug($result);
//        $conn = dbConn::getConnection();
//        $sql = "SELECT
//                    *
//                FROM
//                    company
//                WHERE
//                    Company_id= '$id'";
//
//        $stmt = $conn->prepare($sql);
//        $stmt->execute();
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($company['result'] != 1) {
            $result['result'] = -1;
            $result['Number'] = 1;
            //$result['msg'] = $conn->errorInfo();
            return $result;
        }

        if ($company['export']['recordsCount'] < 1) {
            $result['result'] = -1;
            $result['no'] = 1;
            $result['msg'] = 'This Record was Not Found';
            return $result;
        }

//        if (!$stmt->rowCount()) {
//            $result['result'] = -1;
//            $result['no'] = 1;
//            $result['msg'] = 'This Record was Not Found';
//
//            return $result;
//        }
        //print_r_debug("sss");


        $row = $company['export']['list']['0'];

        //['category_id'];

        $export = explode(',', $row['category_id']);
        $export = array_filter($export, 'strlen');
        $result ['export']['list'] = $export;
        $result ['result'] = '1';
        $temp =  $result;
        //$temp = self::tagToArray($row['category_id']);
        $row['category_id'] = $temp['export']['list'];

        $export = explode(',', $row['certification_id']);
        $export = array_filter($export, 'strlen');
        $result ['export']['list'] = $export;
        $result ['result'] = '1';
        $temp =  $result;

        //$temp = self::tagToArray($row['certification_id']);
        $row['certification_id'] = $temp['export']['list'];



        $result['result'] = 1;
        $result['export']['list'] = $row;



        // get company phones
        $sql = "select * from company_phones where `company_id`='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $phones = [
            'Company_phones_id' => [],
            'subject' => [],
            'number' => [],
            'state' => [],
            'value' => [],
        ];

        while ($row = $stmt->fetch()) {
            array_push($phones['Company_phones_id'], $row['Company_phones_id']);
            array_push($phones['subject'], $row['phone_subject']);
            array_push($phones['number'], $row['phone_number']);
            array_push($phones['state'], $row['phone_state']);
            array_push($phones['value'], $row['phone_value']);
        }

        $result['export']['list']['company_phone'] = $phones;

        // get company emails
        $sql = "select * from company_emails where `company_id`='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $emails = [
            'Company_emails_id' => [],
            'subject' => [],
            'email' => [],
        ];

        while ($row = $stmt->fetch()) {
            array_push($emails['Company_emails_id'], $row['Company_emails_id']);
            array_push($emails['subject'], $row['email_subject']);
            array_push($emails['email'], $row['email_email']);
        }

        $result['export']['list']['company_email'] = $emails;

        // get company addresses
        $sql = "select * from company_addresses where `company_id`='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();

            return $result;
        }

        $addresses = [
            'Company_addresses_id' => [],
            'subject' => [],
            'address' => [],
        ];

        while ($row = $stmt->fetch()) {
            array_push($addresses['Company_addresses_id'], $row['Company_addresses_id']);
            array_push($addresses['subject'], $row['address_subject']);
            array_push($addresses['address'], $row['address_address']);
        }

        $result['export']['list']['company_address'] = $addresses;

        // get company websites
        $sql = "select * from company_websites where `company_id`='$id'";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if (!$stmt) {
            $result['result'] = -1;
            $result['Number'] = 1;
            $result['msg'] = $conn->errorInfo();
            return $result;
        }

        $websites = [
            'Company_websites_id' => [],
            'subject' => [],
            'url' => [],
        ];

        while ($row = $stmt->fetch()) {
            array_push($websites['Company_websites_id'], $row['Company_websites_id']);
            array_push($websites['subject'], $row['website_subject']);
            array_push($websites['url'], $row['website_url']);
        }

        $result['export']['list']['company_website'] = $websites;

        return $result;
    }

    public static function arrayToTag($input)
    {
        $export = '';
        if (count($input) > 0) {
            $export = implode(',', $input);
            $export = ','.$export.',';
        }
        $result ['export']['list'] = $export;
        $result['result'] = '1';

        return $result;
    }

    public static function tagToArray($input)
    {
        $export = explode(',', $input);
        $export = array_filter($export, 'strlen');
        $result ['export']['list'] = $export;
        $result['result'] = '1';

        return $result;
    }


}
