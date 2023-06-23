<?php
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/companyAdvertise/model/Advertise.php';

class MemberAdvertiseController
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
            $company->edit | '0000000000000000000100000' :
            $company->edit & '1111111111111111111011111';
        $result = $company->save();
        return $result;
    }

    /**
     * add History.
     * @param $fields
     * @return int|mixed
     * @version 01.01.01
     */
    public function addAdvertise($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['isMain'] = 0;
        $fields['branch_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['member_id'];
        $fields['parent_id'] = 0;
        

        $result = $this->uploadImage($fields['imageCropped']);
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        if (!empty($fields['startDate']) & !empty($fields['expireDate'])) {
            $fields['startDate'] = convertJToGDate($fields['startDate']);
            $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        }

        $advertise = new c_advertise();
        $advertise->setFields($fields);
        $validate = $advertise->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }

        $result = $advertise->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $advertise->parent_id = $advertise->Advertise_id;
        $advertise->save();

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add Advertise');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Advertise but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $advertise->fields;
        $result['fields']['date'] = convertDate(substr($advertise->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/advertise/' . $advertise->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'آگهی مورد نظر اضافه شد';
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
    public function editAdvertise($fields)
    {

        $advertise = c_advertise::find($fields['Advertise_id']);
        $fields['company_id'] = $advertise->company_id;
        $fields['editor_id'] = $this->company_info['member_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($advertise)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        if ($this->company_info['company_id'] != $advertise->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if (!empty($fields['startDate']) & !empty($fields['expireDate'])) {
            $fields['startDate'] = convertJToGDate($fields['startDate']);
            $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        }
        if ($advertise->status == 2) {
            $result = $this->addNewAndUpdate($fields, $advertise);
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $advertise);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $advertise
     * @return string
     * @internal param $history
     */
    public function addNewAndUpdate($fields, $advertise)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['parent_id'] = $advertise->parent_id;

        $fields['image'] = $advertise->image;
        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }

        $newAdvertise = new c_advertise();
        $newAdvertise->setFields($fields);
        $validate = $newAdvertise->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $newAdvertise->save();
        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newAdvertise->updateAll();

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
        $result['fields'] = $newAdvertise->fields;
        $result['fields']['Advertise_id_old'] = $advertise->Advertise_id;
        $result['fields']['date'] = convertDate(substr($newAdvertise->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/advertise/' . $newAdvertise->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات آگهی مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $advertise
     * @return mixed
     * @internal param $history
     */
    public function onlyUpdate($fields, $advertise)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $advertise->company_id . "/advertise/", $advertise->image);
        }

        $advertise->setFields($fields);
        $validate = $advertise->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }

        $result = $advertise->save();

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
        $result['fields'] = $advertise->fields;
        $result['fields']['Advertise_id_old'] = $advertise->Advertise_id;
        $result['fields']['date'] = convertDate(substr($advertise->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/advertise/' . $advertise->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات آگهی مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $id
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getAdvertiseByid($id)
    {
        $Advertise = c_advertise::find($id);
        if (is_object($Advertise)) {
            $result['result'] = 1;
            $Advertise->startDate = convertDate($Advertise->startDate);
            $Advertise->expireDate = convertDate($Advertise->expireDate);
            $result['fields'] = $Advertise->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $Advertise->company_id . "/advertise/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $Advertise;
    }


    /**
     * @param $id
     */
    public function getAdvertiseByidAjax($id)
    {
        $json = $this->getAdvertiseByid($id);
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
        $advertise = c_advertise::getAll()
        ->where('company_id','=',$this->company_info['company_id'])
        ->where('isActive','=',1)
        ->where('expireDate','>',strftime('%Y-%m-%d %H:%M:%S', time()))
        ->getList();
        $this->fileName = 'member.advertise.showList.php';
        $export['list'] = $advertise['export']['list'];
        $export['recordsCount'] = $advertise['export']['recordsCount'];
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
    public function deleteAdvertise($id)
    {
        $advertise = c_advertise::find($id);
        if (!is_object($advertise)) {
            $result['msg'] = 'آگهی مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }
        if ($advertise->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'آگهی مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }

        $result = $this->deleteAll($advertise);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($advertise->status == 2) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedAdvertise = c_advertise::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedAdvertise['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['msg'] = 'آگهی مورد نظر حذف گردید';
        $result['fields'] = $advertise->fields;
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($advertise)
    {
        $advertises = c_advertise::getBy_parent_id($advertise->parent_id)->get();
        foreach ($advertises['export']['list'] as $licenc) {
            $licenc->delete();
        }
        return;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($advertise)
    {
        $advertiseMain = c_advertise::find($advertise->advertises_id);

        if (is_object($advertiseMain)) {
            $result = $advertiseMain->delete();
        }
        return $result;
    }


    /**
     * @param $fields
     * @return mixed
     */

    public static function getAdvertiseList()
    {
        $graduate = graduate::getBy_status(1)->getList();
        return $graduate;
    }

    public static function find($graduate_id)
    {
        return graduate::find($graduate_id);
    }

    public function add($fields)
    {
        $advertise = graduate::getBy_name($fields['name'])->first();
        if (is_object($advertise)) {
            return $advertise;
        }
        $advertise = new graduate();
        $advertise->setFields($fields);
        $result = $advertise->save();
        if ($result['result'] == 1) {
            return $advertise;
        }
    }
    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'advertise'
            ];
            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
    }


}
