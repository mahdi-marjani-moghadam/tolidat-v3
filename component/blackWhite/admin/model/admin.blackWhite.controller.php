<?php
/**
 * Created by fadeInLeft
 * User: dabaCompany
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */
include_once dirname(__FILE__) . '/admin.blackWhite.model.php';

/**
 *
 * Class adminblackWhiteController
 */
class adminblackWhiteController
{
    /**
     * @var string
     */
    public $exportType;
    /**
     * @var
     */
    public $fileName;

    /**
     * adminblackWhiteController constructor.
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @return array
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function template($list = [],$msg = '')
    {


        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';
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
     * show list black_white table
     * @param $fields
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showList($fields)
    {

        $blackWhite = new black_white();
        $result = $blackWhite->getByFilter();

        if ($result['result'] != '1') {
            $this->fileName = 'admin.blackWhite.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];


        $this->fileName = 'admin.blackWhite.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showblackWhiteAddForm($fields, $msg)
    {

        $this->fileName = 'admin.blackWhite.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * insert to table black_white
     * @param $fields
     * @return int|mixed
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function addblackWithe($fields)
    {

        $blackWhite = new black_white();
        $result = $blackWhite->setFields($fields);


        if ($result['result'] == -1) {
            return $result;
        }
        $result = $blackWhite->save();

        if ($result['result'] != '1') {
            $this->showblackWhiteAddForm($fields, $result['msg']);
        }
        $result = 3;
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=blackWhite', $msg);
        die();
    }

    /**
     * show edit form for table black_white
     * @param $fields
     * @param $msg
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showblackWhiteEditForm($fields, $msg)
    {
        $blackWhite = black_white::find($fields['Black_white_id']);
        if (!is_object($blackWhite)) {
            $msg = 'صفحه مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=blackWhite', $msg);
        }
        $export = $blackWhite->fields;
        $this->fileName = 'admin.blackWhite.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * edit to table black_white
     * @param $fields
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function editblackWhite($fields)
    {
        $blackWhite = black_white::find($fields['Black_white_id']);
        $blackWhite->setFields($fields);
        $blackWhite->save();
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=blackWhite', $msg);
        die();

    }

    /**
     * delete to table black_white
     * @param $fields
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function deleteBlackWhite($fields)
    {

        $blackWhite = black_white::find($fields['Black_white_id']);

        $result = $blackWhite->delete();
        if ($result['result'] != '1') {
            $this->showPackageEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=blackWhite',$msg);
        die();
    }

    /**
     * * this method for check phone in black_withe table and send_token
     * for check register and wiki
     * @param $phone
     * @param $action
     * @return mixed
     * @author
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function checkPhone($phone, $action)
    {
        $phone = '09375320230';
        $action = 'register';
        $blackWhiteObj = black_white::getBy_phone($phone)->first();
        /*check record for phone */
        if (!is_object($blackWhiteObj)) {
            $blackWhiteInsert = new black_white();
            $blackWhiteInsert->phone = $phone;
            $blackWhiteInsert->count = 2;
            $blackWhiteInsert->phone_lock = 0;
            $result = $blackWhiteInsert->save();

            if ($result['result'] == -1) {
                return $result;
            }

        }

        if ($blackWhiteObj->phone_lock == 1) {
            die('-1');
        }

        if ($action == "wiki") {
            $sendTokenWiki = send_token::getBy_phone_and_wiki($phone, 1)->getList();

            $chkRecordSendToken = $sendTokenWiki['export']['recordsCount'];

            if ($chkRecordSendToken >= $blackWhiteObj->count) {
                $blackWhiteObj->phone_lock = 1;
                $blackWhiteObj->save();
                die('-1');
            }
            die('1');

        } else if ($action == 'register') {

            $sendTokenWiki = send_token::getBy_phone_and_register($phone, 1)->getList();

            $chkRecordSendToken = $sendTokenWiki['export']['recordsCount'];

            if ($chkRecordSendToken >= $blackWhiteObj->count) {
                $blackWhiteObj->phone_lock = 1;
                $blackWhiteObj->save();
                die('-1');
            }
            die('1');
        }
    }
}
