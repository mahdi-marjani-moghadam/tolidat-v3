<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 AM.
 */
include_once ROOT_DIR . '/common/validators.php';

class admincompanyModel extends looeic
{

    protected $TABLE_NAME = 'company';

    protected $rules = [
        'email' => 'required*' . REGISTER_01,
        'registration_number' => 'required*' . REGISTER_01,
        'national_id' => 'required*' . REGISTER_01,
        'coordinator_phone' => 'required*' . REGISTER_01,
    ];

    public function getCompany($fields = '')
    {
        $conn = dbConn::getConnection();
        include_once ROOT_DIR . '/model/db.inc.class.php';
        $condition = DataBase::filterBuilder($fields);
        $length = $condition['length'];
        if ($condition['list']['order'] == '') {
            $condition['list']['order'] = ' ORDER BY `Company_id` ASC ';
        }

        $sql = "SELECT SQL_CALC_FOUND_ROWS
	`t1`.*
FROM
	(
		SELECT
			`company`.*, `c_emails`.`email` AS company_email,
			`city`.`name` AS `city_name`,
			`c_phones`.`number`,
			`c_websites`.`url`,
			`c_addresses`.`address` AS company_address,
			`c_logo`.`image` AS logo_image,
			`packageusage`.`expiredate`
		FROM
			`company`
		LEFT JOIN `c_emails` ON `company`.`Company_id` = `c_emails`.`company_id`
		LEFT JOIN `packageusage` ON `company`.`Company_id` = `packageusage`.`company_id`
		LEFT JOIN `c_logo` ON `company`.`Company_id` = `c_logo`.`company_id`
		LEFT JOIN `c_phones` ON `company`.`Company_id` = `c_phones`.`company_id`
		LEFT JOIN `c_websites` ON `company`.`Company_id` = `c_websites`.`company_id`
		LEFT JOIN `city` ON `company`.`city_id` = `city`.`City_id`
		LEFT JOIN `c_addresses` ON `company`.`Company_id` = `c_addresses`.`company_id`"
            . $fields['appendWhere'] .
            "GROUP BY
			`company`.`Company_id`
	) AS t1"
            . $condition['list']['useWhere'] . $condition['list']['filter'] . $condition['list']['order'] . $condition['list']['limit'];

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

    public static function getCompanyById($id)
    {
        global $lang;
        $conn = dbConn::getConnection();

        $company = admincompanyModel::getBy_Company_id($id)->getList();

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


        $row = $company['export']['list']['0'];

        //['category_id'];

        $export = explode(',', $row['category_id']);
        $export = array_filter($export, 'strlen');
        $result ['export']['list'] = $export;
        $result ['result'] = '1';
        $temp = $result;
        //$temp = self::tagToArray($row['category_id']);
        $row['category_id'] = $temp['export']['list'];

        $export = explode(',', $row['certification_id']);
        $export = array_filter($export, 'strlen');
        $result ['export']['list'] = $export;
        $result ['result'] = '1';
        $temp = $result;

        //$temp = self::tagToArray($row['certification_id']);
        $row['certification_id'] = $temp['export']['list'];


        $result['result'] = 1;
        $result['export']['list'] = $row;

        // global $conn;
        // get company phones
        $sql = "select * from c_phones where `company_id`='$id'";
        
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
            array_push($phones['Company_phones_id'], $row['Phones_id']);
            array_push($phones['subject'], $row['subject']);
            array_push($phones['number'], $row['number']);
            array_push($phones['state'], $row['state']);
            array_push($phones['value'], $row['value']);
        }

        $result['export']['list']['company_phone'] = $phones;

        // get company emails
        $sql = "select * from c_emails where `company_id`='$id'";

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
            array_push($emails['Company_emails_id'], $row['Emails_id']);
            array_push($emails['subject'], $row['subject']);
            array_push($emails['email'], $row['email']);
        }

        $result['export']['list']['company_email'] = $emails;

        // get company addresses
        $sql = "select * from c_addresses where `company_id`='$id'";

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
            array_push($addresses['Company_addresses_id'], $row['Addresses_id']);
            array_push($addresses['subject'], $row['subject']);
            array_push($addresses['address'], $row['address']);
        }

        $result['export']['list']['company_address'] = $addresses;

        // get company websites
        $sql = "select * from c_websites where `company_id`='$id'";

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
            array_push($websites['Company_websites_id'], $row['Websites_id']);
            array_push($websites['subject'], $row['subject']);
            array_push($websites['url'], $row['url']);
        }

        $result['export']['list']['company_website'] = $websites;

        return $result;
    }

    function getQuery($funcName = '')
    {


        global $admin_info;
        $admin_id = $admin_info['admin_id'];
        if ($funcName == 'draft') {
            $appendWhere = " where  `company`.`edit` <> '0000000000000000000000000' and  `company`.`edit` <> '' and `company`.`package_status` ='4' and `company`.`new_register` = '0'";
        } elseif ($funcName == 'wiki') {
            return "select * from company_d where package_status ='1' and `new_register` = '0' and status ='-1' and isActive ='1' order by refresh_date desc";
        } elseif ($funcName == 'expire') {
            $appendWhere = " where  `packageusage`.`expiredate`  < '" . date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD)) . " 00:00:00' ";
        } elseif ($funcName == 'lockById') {
            $appendWhere = " where  `company`.`lock`  = '" . $admin_id . "' ";
        } elseif ($funcName == 'lock') {
            $appendWhere = " where  `company`.`lock`  <> '0' or `company`.`lock`  <> ''";
        } elseif ($funcName == '') {
            $appendWhere = " where  `company`.`new_register`  <> '1' ";;
        }


        $query = "SELECT `company`.*,
                        `company_d`.editor_id AS company_d_editor_id,
                        `c_emails`.`email` AS company_email,
                        `city`.`name` AS `city_name`,
                        `c_phones`.`number`,
                        `c_websites`.`url`,
                        `c_addresses`.`address` as company_address,
                        `packageusage`.`expiredate`,
                        `c_logo`.`image`
                      FROM `company`
                        LEFT JOIN `c_emails` ON `company`.`Company_id` =
                          `c_emails`.`company_id`
                        LEFT JOIN `c_logo` ON `company`.`Company_id` =
                          `c_logo`.`company_id`
                        LEFT JOIN `company_d` ON `company`.`Company_id` =
                          `company_d`.`company_id`
                        LEFT JOIN `packageusage` ON `company`.`Company_id` =
                          `packageusage`.`company_id`
                        LEFT JOIN `c_phones` ON `company`.`Company_id` =
                          `c_phones`.`company_id`
                        LEFT JOIN `c_websites` ON `company`.`Company_id` =
                          `c_websites`.`company_id`
                        LEFT JOIN `city` ON `company`.`city_id` = `city`.`City_id`
                        LEFT JOIN `c_addresses` ON `company`.`Company_id` =
                          `c_addresses`.`company_id`" .
            $appendWhere
            . "GROUP BY `company`.`Company_id` order by company.refresh_date desc";


        return $query;

    }

    public function getLockedCompanies()
    {
        $companyList = static::query('SELECT * FROM `company` WHERE `lock`<> 0')->getList();

        return $companyList['export']['list'];
    }

    public function getNewRegisteredCompanies()
    {
        $companyList = static::query("SELECT * FROM `company` WHERE `new_register`=1")->getList();
        // $companyList = static::getBy_new_register(1)->getList();

        return $companyList['export']['list'];
    }

    public function getNoneFreeCompanies()
    {
        $companyList = static::query("SELECT * FROM `company` WHERE `package_status`=4")->getList();
        // $companyList = static::getBy_package_status(4)->getList();

        return $companyList['export']['list'];
    }

    public function countCompanies()
    {
        $count = static::query( 'SELECT COUNT(`Company_id`) as `count` FROM `company`')->getList();

        return $count['export']['list'][0]['count'];
    }

    public function category()
    {
        include_once ROOT_DIR . 'component/category/admin/model/CategoryCompany.model.php';

        $categoryAttach = new CategoryCompany();
        $categoryAttach->company = $this;

        return $categoryAttach;
    }


}

class adminmembersModel extends looeic {}
