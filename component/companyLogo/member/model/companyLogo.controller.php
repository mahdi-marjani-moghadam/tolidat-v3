<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/companyLogo.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class logoController
{
    /**
     * Contains file type.
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     * @var
     */
    public $fileName;

    private $company_info;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
    public function template($list = [],$msg = '')
    {
        switch ($this->exportType) {
            case 'html':

                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
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
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        if (is_object($company)) {
            $company->edit = $company->edit | '0000000000010000000000000';
            $result = $company->save();
            return $result;
        }
    }

    /**
     * add History.
     * @param $image
     * @return int|mixed
     * @internal param $_input
     * @author malekloo
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addLogo($image)
    {
        $fields['logo_id'] = 0;
        $fields['status'] = -1;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = $image;

        $logo = new c_logo_d();
        $logo->setFields($fields);
        $result = $logo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added logo but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['msg'] = 'لوگو اضافه شد';
        $result['fields'] = $logo->fields;
        $result['result'] = 1;
        $result['image'] = COMPANY_ADDRESS . $fields['company_id'] . '/logo/' . $fields['image'];
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editLogo($fields)
    {
        $result = $this->uploadImage($fields['image']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $logo = c_logo_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->first();

        if (!is_object($logo)) {
            $this->addLogo($result['image']);
        }

        $fields['logo_id'] = $logo->logo_id;
        $fields['company_id'] = $logo->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = $result['image'];

        if ($logo->status == 1) {
            $result = $this->addNewAndUpdate($fields, $logo);
            echo json_encode($result);
            die();
        }

        $result = $this->onlyUpdate($fields, $logo);
        $result['image'] = COMPANY_ADDRESS . $logo->company_id . '/logo/' . $fields['image'];
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $logo
     * @return string
     * @internal param $history
     */
    public function addNewAndUpdate($fields, $logo)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['logo_id'] = $logo->logo_id;

        $newLogo = new c_logo_d();
        $newLogo->setFields($fields);
        $result = $newLogo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }

        $result = $newLogo->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo, Update old logo';
            return $result;
        }
        $result['fields'] = $newLogo->fields;
        $result['result'] = 1;
        $result['msg'] = 'تغییرات مورد نظر انجام شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $logo
     * @return mixed
     * @internal param $history
     */
    public function onlyUpdate($fields, $logo)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $logo->setFields($fields);
        $result = $logo->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $logo->fields;
        $result['result'] = 1;
        $result['msg'] = 'تغییرات مورد نظر انجام شد';
        return $result;

    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getLogoByid($id)
    {
        $Logo_fields = c_logo_d::find($id);
        if (is_object($Logo_fields)) {
            $result['result'] = 1;
            $result['fields'] = $Logo_fields->fields;
            $result['fields']['image_tmp'] = COMPANY_ADDRESS . $Logo_fields->company_id . "/logo/" . $result['fields']['image'];
            return $result;
        }
        return $Logo_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getLogoByidAjax($id)
    {
        $json = $this->getLogoByid($id);
        echo json_encode($json);
        die();
    }

    /**
     * @return mixed
     */
    public function sendNotification($msg)
    {
        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info['company_id'],
            'to' => 1,
            'msg' => $msg,
            'messageType' => 1
        ];
        return $notification->addNotification($fields);
    }

    /**
     * @param $fields
     * @return mixe
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        $logos = c_logo_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $this->fileName = 'member.logo.showList.php';
        $export['list'] = $logos['export']['list'];
        $export['recordsCount'] = $logos['export']['recordsCount'];
        $this->template($export);
        die();
    }

    /**
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteLogo()
    {
        if (!isset($this->company_info['company_id'])) {
            redirectPage(RELA_DIR . '404');
        }
        $company_id = $this->company_info['company_id'];
        $logos = c_logo_d::getBy_company_id($company_id)->get();
        if ($logos['export']['recordsCount'] > 0) {
            foreach ($logos['export']['list'] as $logo) {
                if (is_object($logo)) {
                    $logo->delete();
                }
            }
        }
        $logo = c_logo::getBy_company_id($company_id)->first();
        if (is_object($logo)) {
            $logo->delete();
        }
        $this->deleteDir(COMPANY_ADDRESS_ROOT . $company_id . "/logo");

        $fields['result'] = 1;
        $fields['msg'] = "لوگو شما با موفقیت حذف شد";
        $fields['src'] = DEFULT_LOGO_ADDRESS;
        echo json_encode($fields);
        die();
    }

    public function deleteDir($dirPath)
    {
        if (is_dir($dirPath)) {
            if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
                $dirPath .= '/';
            }
            array_map('unlink', glob("$dirPath/*.*"));
            rmdir($dirPath);
        }
        return;
    }

    public function deleteAll($logo)
    {
        $logos = c_logo_d::getBy_logo_id($logo->logo_id)->get();
        $input['component'] = "logo";
        foreach ($logos['export']['list'] as $log) {
            $input['image'] = $log->image;
            $log->delete();
            removeFiles($input);
        }
        $result = $this->deleteMain($logo);
        return $result;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($logo)
    {
        $logoMain = c_logo::find($logo->logo_id);
        if (is_object($logoMain)) {
            $result = $logoMain->delete();
        }
        return $result;
    }

    public function getCompanyLogo($company_id)
    {
        $logo = c_logo::getBy_company_id($company_id)->getList();
        if ($logo['export']['recordsCount'] > 0) {

            return $logo['export']['list']['0']['image'];
        }

        return null;
    }

    public function getCompanyLogoDraft($company_id)
    {
        $logo = c_logo_d::getBy_company_id_and_isActive($company_id, 1)->getList();
        if ($logo['export']['recordsCount'] > 0) {

            return $logo['export']['list']['0']['image'];
        }

        return null;
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'logo'
            ];
            $sizes = [
                'size1' => ['width' => 122, 'height' => 125],
                'size2' => ['width' => 140, 'height' => 140],
                'size3' => ['width' => 150, 'height' => 150],
            ];
            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }

        $result['result'] = -1;
        $result['msg'] = "لطفا لوگو را آپلود نمایید";
        return $result;
    }
}
