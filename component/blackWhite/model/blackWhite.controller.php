<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
include_once dirname(__FILE__) . '/blackWhite.model.php';

/**
 * Class black_whiteController
 */
class black_whiteController
{
    /**
     * @var
     */
    public $exportType;
    /**
     * @var
     */
    public $fileName;

    /**
     * @param $phone
     * @return int|mixed
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function addblackWithe($phone)
    {

        $blackWhiteInsert = new black_white();
        $blackWhiteInsert->phone = $phone;
        $blackWhiteInsert->count = 10;
        $blackWhiteInsert->phone_lock = 0;
        $result = $blackWhiteInsert->save();

        if ($result['result'] == -1) {
            return $result;
        }
        return $blackWhiteInsert;

    }

    /**
     * @param $fields
     *
     */
    public function editPackage($fields)
    {
        $Package = adminpackageModel::find($fields['Package_id']);
        $Package->setFields($fields);
        $Package->save();
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=package', $msg);
        die();
    }

    /**
     * this method for check phone in black_withe table and send_token
     * for check register and wiki
     * @param $phone
     * @param $action
     * @@author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function checkPhone($phone, $action)
    {
        $blackWhiteObj = black_white::getBy_phone($phone)->first();

        /*check record for phone */
        if (!is_object($blackWhiteObj)) {
            $blackWhiteObj = $this->addblackWithe($phone);
            if (!is_object($blackWhiteObj)) {
                return true;
            }
        }

        if ($blackWhiteObj->phone_lock == 1) {
            return false;
        }

        if ($action == "wiki") {
            $sendTokenWiki = send_token::getBy_phone_and_wiki($phone, 1)->getList();

            $chkRecordSendToken = $sendTokenWiki['export']['recordsCount'];

            if ($chkRecordSendToken >= $blackWhiteObj->count) {
                $blackWhiteObj->phone_lock = 1;
                $blackWhiteObj->save();
                return false;
            }
            return true;

        } else if ($action == 'register') {

            $sendTokenWiki = send_token::getBy_phone_and_register($phone, 1)->getList();

            $chkRecordSendToken = $sendTokenWiki['export']['recordsCount'];

            if ($chkRecordSendToken >= $blackWhiteObj->count) {
                $blackWhiteObj->phone_lock = 1;
                $blackWhiteObj->save();
                return false;
            }
            return true;
        }
    }
}
