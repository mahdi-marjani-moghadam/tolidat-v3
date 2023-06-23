<?php


include_once dirname(__FILE__) . '/companyCommercialName.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'services/uploader/Uploader.php';

class commercialNameController
{

    public $exportType;


    public $fileName;

    private $company_info;

    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }


    function template($list = [], $msg = '')
    {
        global $messageStack;

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

    public function updateCompany($id, $action = 'enable')
    {

        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000000001000000000000' :
            $company->edit & '1111111111110111111111111';
        $result = $company->save();
        return $result;
    }

    public function addCommercialName($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['commercial_name_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['admin_description'] = ''; 
        $result = $this->uploadImage($fields['imageCropped']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $commercialName = new c_commercial_name_d();
        $commercialName->setFields($fields);
        $validate = $commercialName->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $commercialName->save();


        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            echo json_encode($result);
            die();
        }

        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add website');

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            echo json_encode($result);
        }
        $result['fields'] = $commercialName->fields;
        $result['fields']['date'] = convertDate(substr($commercialName->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/commercialName/' . $commercialName->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'نام تجاری مورد نظر اضافه شد';
        echo json_encode($result);
        die();


    }

    public function sendNotification($msg)
    {

        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info,
            'to' => 3,
            'msg' => $msg,
            'messageType' => 1
        ];
        $result = $notification->addNotification($fields);
        return $result;
    }

    public function showCommercialNameAddForm($fields, $msg)
    {
        $this->fileName = 'commercialName.addForm.php';
        $this->template($fields, $msg);
        die();
    }


    public function editCommercialName($fields)
    {
        $commercialName = c_commercial_name_d::find($fields['Commercial_name_d_id']);
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['company_id'] = $commercialName->company_id;
        $fields['commercial_name_id'] = $commercialName->commercial_name_id;
        $fields['image'] = $commercialName->image;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($commercialName)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        if ($this->company_info['company_id'] != $commercialName->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $commercial_name_d_id_oldest = 0;
        if ($commercialName->status == 1 && $commercialName->commercial_name_id != 0) {
            $commercial_name_d_id_oldest = $commercialName->Commercial_name_d_id;
            $commercialName = c_commercial_name_d::getBy_commercial_name_id_and_isActive($commercialName->commercial_name_id, 1)->first();
        }

        if ($commercialName->status != 1) {
            $result = $this->UpdateCommercialName($fields, $commercialName);
            echo json_encode($result);
            die();
        }

        $result = $this->updateAndAddNewCommercialName($fields, $commercialName);
        $result['fields']['Commercial_name_d_id_oldest'] = $commercial_name_d_id_oldest;
        echo json_encode($result);
        die();
    }

    public function UpdateCommercialName($fields, $commercialName)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/commercialName/", $commercialName->image);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $commercialName->setfields($fields);
        $validate = $commercialName->validator();

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $commercialName->save();

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی آپدیت نشد';
            return $result;
        }
        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
        }
        $result['fields'] = $commercialName->fields;
        $result['fields']['Commercial_name_d_id_old'] = $commercialName->Commercial_name_d_id;
        $result['fields']['date'] = convertDate(substr($commercialName->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/commercialName/' . $commercialName->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات نام تجاری مورد نظر ویرایش شد';
        return $result;

    }


    public function updateAndAddNewCommercialName($fields, $commercialName)
    {
        $fields['Commercial_name_d_id'] = $commercialName->Commercial_name_d_id;
        $fields['commercial_name_id'] = $commercialName->commercial_name_id;
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $newCommercialName = new c_commercial_name_d();
        $newCommercialName->setFields($fields);
        $validate = $newCommercialName->validator();

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $newCommercialName->save();

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات آپدیت نشد';
            return $result;
        }

        $result = $newCommercialName->updateAll();
        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات افزوده شد اما آپدیت نشد';
            return $result;
        }

        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی آپدیت نشد';
            return $result;
        }

        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';

        }

        $result['fields'] = $newCommercialName->fields;
        $result['fields']['Commercial_name_d_id_old'] = $commercialName->Commercial_name_d_id;
        $result['fields']['date'] = convertDate(substr($newCommercialName->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/commercialName/' . $newCommercialName->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات نام تجاری مورد نظر ویرایش شد';
        return $result;
    }


    public function getcommercialNameByid($id)
    {

        $commercialName = c_commercial_name_d::find($id);
        if (is_object($commercialName)) {
            $result['result'] = 1;
            $result['fields'] = $commercialName->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/commercialName/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $commercialName;
        die();
    }

    public function getcommercialNameByidAjax($id)
    {
        $json = $this->getcommercialNameByid($id);
        echo json_encode($json);
        die();


    }

    public function showList()
    {

        $commercialName = new c_commercial_name_d();
        $result = $commercialName::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $this->fileName = 'member.commercialName.showList.php';
        $this->template($export);
        die();
    }

    public function deleteCommercialName($id)
    {
        $commercialName = c_commercial_name_d::find($id);

        if (!is_object($commercialName)) {
            $result['msg'] = 'رکورد مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($commercialName->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($commercialName->commercial_name_id == 0) {
            $result = $commercialName->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/commercialName/", $commercialName->image);
        } else {
            $result = $this->deleteAll($commercialName);

        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($commercialName->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedCommercialName = c_commercial_name_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedCommercialName['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $commercialName->fields;
        $result['msg'] = "نام تجاری مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($commercialName)
    {
        $commercialName = c_commercial_name_d::getBy_commercial_name_id($commercialName->commercial_name_id)->get();
        foreach ($commercialName['export']['list'] as $commercialName) {
            $result = $commercialName->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/commercialName/", $commercialName->image);

            if ($result['result'] == -1) {
                $result['msg'] = 'نام تجاری مورد نظر حذف نشد';
                return $result;
            }
        }
        $commercialNameMain = c_commercial_name::find($commercialName->commercial_name_id);

        if (is_object($commercialNameMain)) {
            $result = $commercialNameMain->delete();
            return $result;
        }
        return $result;
    }

    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'commercialName'
            ];

            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
//        if ($fields['name'] != '') {
//            $type = substr($fields['type'], 0, 5);
//            if ($type == 'image') {
//                $Property = array('type' => 'jpg,png,jpeg',
//                    'new_name' => $fields['name'],
//                    'max_size' => '2048000',
//                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/commercialName/"
//                );
//                return fileUploader($Property, $fields);
//            }
//        }
//        return null;
    }

}




