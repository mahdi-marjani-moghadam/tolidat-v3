<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/licence.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class licenceController
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
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
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
    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000000000100000000000' :
            $company->edit & '1111111111111011111111111';
        $result = $company->save();
        return $result;
    }

    /**
     * add History.
     * @param $fields
     * @return int|mixed
     * @version 01.01.01
     */
    public function addLicence($fields)
    {
        $fields['national_code'] = convertToEnglish($fields['national_code']);
        $fields['licence_number'] = convertToEnglish($fields['licence_number']);
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['isMain'] = 0;
        $fields['branch_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['member_id'];
        $fields['parent_id'] = 0;

        if (!empty($fields['issuence_date']) & !empty($fields['expiration_date'])) {
            $fields['issuence_date'] = convertJToGDate($fields['issuence_date']);
            $fields['expiration_date'] = convertJToGDate($fields['expiration_date']);
        }

        $result = $this->uploadImage($fields['imageCropped']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $licence = new c_licences();
        $licence->setFields($fields);
        $validate = $licence->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }

        $validate = $this->checkLicenceType($fields['licence_type'], $fields['licence_type_name']);
        if ($validate) {
            echo json_encode($validate);
            die();
        }

        if ($fields['licence_type'] == 0) {
            $fields['licence_type'] = $this->addNewLicenceType($fields['licence_type_name']);
            $licence->setFields($fields);
        }

        $result = $licence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $licence->parent_id = $licence->Licence_id;
        $licence->save();

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add Licence');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Licence but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $licence->fields;
        $result['fields']['date'] = convertDate(substr($licence->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/licence/' . $licence->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['licence_type_name'] = $this->getLicenceTypeByID($licence->licence_type);
        $result['result'] = 1;
        $result['msg'] = 'مجوز مورد نظر اضافه شد';
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
    public function editLicence($fields)
    {
        $licence = c_licences::find($fields['Licence_id']);

        $fields['company_id'] = $licence->company_id;
        $fields['editor_id'] = $this->company_info['member_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($licence)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $licence->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $validate = $this->checkLicenceType($fields['licence_type'], $fields['licence_type_name']);
        if ($validate) {
            echo json_encode($validate);
            die();
        }

        if ($fields['licence_type'] == 0) {
            $fields['licence_type'] = $this->addNewLicenceType($fields['licence_type_name']);
        }

        if (!empty($fields['issuence_date']) & !empty($fields['expiration_date'])) {
            $fields['issuence_date'] = convertJToGDate($fields['issuence_date']);
            $fields['expiration_date'] = convertJToGDate($fields['expiration_date']);
        }
        if ($licence->status == 2) {
            $result = $this->addNewAndUpdate($fields, $licence);
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $licence);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $licence
     * @return string
     * @internal param $history
     */
    public function addNewAndUpdate($fields, $licence)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['isMain'] = $licence->isMain;
        $fields['parent_id'] = $licence->parent_id;
        $fields['image'] = $licence->image;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $newLicence = new c_licences();
        $newLicence->setFields($fields);
        $validate = $newLicence->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $newLicence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newLicence->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Old record not update';
            return $result;
        }

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo, Update old logo';
            return $result;
        }
        $result['fields'] = $newLicence->fields;
        $result['fields']['Licence_id_old'] = $licence->Licence_id;
        $result['fields']['date'] = convertDate(substr($newLicence->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/licence/' . $newLicence->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['licence_type_name'] = $this->getLicenceTypeByID($newLicence->licence_type);
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات مجوز مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $licence
     * @return mixed
     * @internal param $history
     */
    public function onlyUpdate($fields, $licence)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isMain'] = $licence->isMain;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/licence/", $licence->image);
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $licence->setFields($fields);
        $validate = $licence->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $licence->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $licence->fields;
        $result['fields']['Licence_id_old'] = $licence->Licence_id;
        $result['fields']['date'] = convertDate(substr($licence->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/licence/' . $licence->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['licence_type_name'] = $this->getLicenceTypeByID($licence->licence_type);
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات مجوز مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $id
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getLicenceByid($id)
    {
        $Licence = c_licences::find($id);
        if (is_object($Licence)) {
            $result['result'] = 1;
            $Licence->issuence_date = convertDate($Licence->issuence_date);
            $Licence->expiration_date = convertDate($Licence->expiration_date);
            $result['fields'] = $Licence->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $Licence->company_id . "/licence/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            $licence_list = licence_list::getBy_status(1)->getList();
            $result['fields']['licence_list'] = $licence_list['export']['list'];

            if (array_search($Licence->licence_type, array_column($licence_list['export']['list'], 'Licence_list_id')) < 0) {
                $result['fields']['licence_type'] = 0;
                $licence_name = licence_list::find($Licence->licence_type);
                $result['fields']['licence_type_name'] = $licence_name->name;
            }
            return $result;
        }
        return $Licence;
    }

    /**
     * @param $id
     */
    public function getAddFormByAjax()
    {
        $licence_list = licence_list::getBy_status(1)->getList();
        $export['licence_list'] = $licence_list['export']['list'];
        echo json_encode($export);
        die();
    }

    /**
     * @param $id
     */
    public function getLicenceByidAjax($id)
    {
        $json = $this->getLicenceByid($id);
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
        $logos = c_licences::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $licence_list = licence_list::getAll()->getList();
        $this->fileName = 'member.licence.showList.php';
        $export['list'] = $logos['export']['list'];
        $export['licence_list'] = $licence_list['export']['list'];
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
    public function deleteLicence($id)
    {
        $licence = c_licences::find($id);

        if (!is_object($licence)) {
            $result['msg'] = 'مجوز مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }
        if ($licence->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'مجوز مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }

        if ($licence->isMain == 1) {
            $result['msg'] = 'مجوز اصلی را نمی توانید حذف کنید';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $result = $this->deleteAll($licence);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($licence->status == 2) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedLicences = c_licences::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedLicences['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['msg'] = 'مجوز مورد نظر حذف گردید';
        $result['fields'] = $licence->fields;
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($licence)
    {
        $licences = c_licences::getBy_parent_id($licence->parent_id)->get();
        foreach ($licences['export']['list'] as $licenc) {
            $licenc->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $licenc->company_id . "/licence/", $licenc->image);
        }
        return;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($licence)
    {
        $licenceMain = c_licences::find($licence->licences_id);

        if (is_object($licenceMain)) {
            $result = $licenceMain->delete();
        }
        return $result;
    }


    /**
     * @param $image
     * @return mixed
     */
    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'licence'
            ];

            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }

        $result['result'] = -1;
        $result['msg'] = "عکس جواز ضروری است";
        return $result;


//        if ($fields['name'] != '') {
//            $type = substr($fields['type'], 0, 5);
//            if ($type == 'image') {
//                $Property = array('type' => 'jpg,png,jpeg',
//                    'new_name' => $fields['name'],
//                    'max_size' => '2048000',
//                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/licence/"
//                );
//                return fileUploader($Property, $fields);
//            }
//        }
//        return null;
    }

    public static function getLicenceList()
    {
        $licence_list = licence_list::getBy_status(1)->getList();
        return $licence_list;
    }

    public static function find($licence_list_id)
    {
        return licence_list::find($licence_list_id);
    }

    public function add($fields)
    {
        $licence = licence_list::getBy_name($fields['name'])->first();
        if (is_object($licence)) {
            return $licence;
        }
        $licence = new licence_list();
        $licence->setFields($fields);
        $result = $licence->save();
        if ($result['result'] == 1) {
            return $licence;
        }
    }

    public function getLicenceTypeByID($licence_list_id)
    {
        $licence_type = licence_list::find($licence_list_id);
        if (is_object($licence_type)) {

            return $licence_type->name;
        }

        return null;
    }

    public function checkLicenceType($licence_type_id, $licence_type_name)
    {
        $licence = licence_list::find($licence_type_id);
        if (is_object($licence)) {
            return;
        }
        if ($licence_type_id == 0) {
            if ($licence_type_name != null) {
                return;
            }
            $result['fields']['result'] = -1;
            $result['fields']['msg'] = "لطفا نوع جواز مربوطه را وارد نمایید";
            return $result;
        }
        $result['fields']['result'] = -1;
        $result['fields']['msg'] = "لطفا نوع جواز را انتخاب نمایید";
        return $result;
    }

    public function addNewLicenceType($licence_type_name)
    {
        $licence_type = new licence_list();
        $licence_type->name = $licence_type_name;
        $licence_type->status = 0;
        $result = $licence_type->save();
        if ($result['result'] == 1) {
            return $licence_type->Licence_list_id;
        }
    }
}
