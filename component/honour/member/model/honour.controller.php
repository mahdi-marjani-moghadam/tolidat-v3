<?php


include_once dirname(__FILE__) . '/honour.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

class honourController
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


    function template($list = [],$msg = '')
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
            $company->edit | '0010000000000000000000000' :
            $company->edit & '1101111111111111111111111';
        $result = $company->save();
        return $result;
    }

    public function addHonour($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['honour_id'] = 0;
        $fields['admin_description'] = '';
        $result = $this->uploadImage($fields['imageCropped']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $honour = new c_honour_d();
        $honour->setFields($fields);
        $validate = $honour->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $honour->save();

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
        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
            echo json_encode($result);
        }
        $result['fields'] = $honour->fields;
        $result['fields']['date'] = convertDate(substr($honour->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/honour/' . $honour->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'افتخار مورد نظر اضافه شد';
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


    public function editHonour($fields)
    {
        $honour = c_honour_d::find($fields['Honour_d_id']);
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['company_id'] = $honour->company_id;
        $fields['honour_id'] = $honour->honour_id;
        $fields['image'] = $honour->image;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($honour)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        if ($this->company_info['company_id'] != $honour->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $honour_d_id_oldest = 0;
        if ($honour->status == 1 && $honour->honour_id != 0) {
            $honour_d_id_oldest = $honour->Honour_d_id;
            $honour = c_honour_d::getBy_honour_id_and_isActive($honour->honour_id, 1)->first();
        }

        if ($honour->status != 1) {
            $result = $this->UpdateHonour($fields, $honour);
            echo json_encode($result);
            die();
        }

        $result = $this->updateAndAddNewHonour($fields, $honour);
        $result['fields']['Honour_d_id_oldest'] = $honour_d_id_oldest;
        echo json_encode($result);
        die();
    }

    public function UpdateHonour($fields, $honour)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/honour/", $fields['image']);
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $honour->setfields($fields);
        $validate = $honour->validator();

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $honour->save();

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
        $result['fields'] = $honour->fields;
        $result['fields']['Honour_d_id_old'] = $honour->Honour_d_id;
        $result['fields']['date'] = convertDate(substr($honour->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/honour/' . $honour->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات افتخار مورد نظر ویرایش شد';

        return $result;
    }


    public function updateAndAddNewHonour($fields, $honour)
    {
        $fields['Honour_d_id'] = $honour->Honour_d_id;
        $fields['honour_id'] = $honour->honour_id;
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['admin_description'] = '';

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $newHonour = new c_honour_d();
        $newHonour->setFields($fields);

        $validate = $newHonour->validator();

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $newHonour->save();

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات آپدیت نشد';
            return $result;
        }
        $result = $newHonour->updateAll();
        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات افزوده و آپدیت نشد';
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

        $result['fields'] = $newHonour->fields;
        $result['fields']['Honour_d_id_old'] = $honour->Honour_d_id;
        $result['fields']['date'] = convertDate(substr($newHonour->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/honour/' . $newHonour->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات افتخار مورد نظر ویرایش شد';
        return $result;
    }


    public function getHonourByid($id)
    {

        $honour = c_honour_d::find($id);
        if (is_object($honour)) {
            $result['result'] = 1;
            $result['fields'] = $honour->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/honour/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $honour;
        die();
    }

    public function getHonourByidAjax($id)
    {
        $json = $this->getHonourByid($id);
        echo json_encode($json);
        die();


    }

    public function showList()
    {

        $result = c_honour_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $this->fileName = 'member.honour.showList.php';
        $this->template($export);
        die();
    }

    public function deleteHonour($id)
    {
        $honour = c_honour_d::find($id);

        if (!is_object($honour)) {
            $result['msg'] = 'رکورد مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($honour->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        if ($honour->honour_id == 0) {
            $honour->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/honour/", $honour->image);
        } else {
            $result = $result = $this->deleteAll($honour);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        if ($honour->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedHonour = c_honour_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedHonour['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $honour->fields;
        $result['msg'] = "افتخار مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($honour)
    {
        $honour = c_honour_d::getBy_honour_id($honour->honour_id)->get();
        foreach ($honour['export']['list'] as $honour) {
            $result = $honour->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/honour/", $honour->image);
            if ($result['result'] == -1) {
                $result['msg'] = 'مجوز مورد نظر حذف نشد';
                return $result;
            }
        }
        $honourMain = c_honour::find($honour->honour_id);

        if (is_object($honourMain)) {
            $result = $honourMain->delete();
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
                'folder_name' => 'honour'
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
//                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/honour/"
//                );
//                return fileUploader($Property, $fields);
//            }
//        }
//        return null;
    }

}



