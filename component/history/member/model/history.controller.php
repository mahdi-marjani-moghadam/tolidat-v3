<?php

include_once dirname(__FILE__) . '/history.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

class historyController
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
     * @var int|mixed
     */
    private $company_info;


    /**
     * historyController constructor.
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
    public function template($list = [], $msg = '')
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
            $company->edit | '0000100000000000000000000' :
            $company->edit & '1111011111111111111111111';
        $result = $company->save();
        return $result;
    }

    /**
     * @param $fields
     */
    public function addHistory($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['history_id'] = 0;
        $result = $this->uploadImage($fields['imageCropped']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $history = new c_history_d();
        $history->setFields($fields);
        $validate = $history->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        $result = $history->save();

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
        $result = $this->sendNotification('Add history');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added history and not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $history->fields;
        $result['fields']['date'] = convertDate(substr($history->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/history/' . $history->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'سابقه مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     */
    public function editHistory($fields)
    {
        $history = c_history_d::find($fields['History_d_id']);
        $fields['history_id'] = $history->history_id;
        $fields['company_id'] = $history->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($history)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $history->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $history_d_id_oldest = 0;
        if ($history->status == 1 && $history->history_id != 0) {
            $history_d_id_oldest = $history->History_d_id;
            $history = c_history_d::getBy_history_id_and_isActive($history->history_id, 1)->first();
        }

        if ($history->status == 1) {
            $result = $this->addNewAndUpdate($fields, $history);
            $result['fields']['History_d_id_oldest'] = $history_d_id_oldest;
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $history);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $history
     * @return mixed
     */
    public function addNewAndUpdate($fields, $history)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['history_id'] = $history->history_id;
        $fields['image'] = $history->image;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $newHistory = new c_history_d();
        $newHistory->setFields($fields);
        $validate = $history->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newHistory->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newHistory->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new history';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add history');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new history, Update old history';
            return $result;
        }
        $result['fields'] = $newHistory->fields;
        $result['fields']['History_d_id_old'] = $history->History_d_id;
        $result['fields']['date'] = convertDate(substr($newHistory->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/history/' . $newHistory->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات سابقه مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $fields
     * @param $history
     * @return mixed
     */
    public function onlyUpdate($fields, $history)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $history->company_id . "/history/", $history->image);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $history->setFields($fields);
        $validate = $history->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $history->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update history');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $history->fields;
        $result['fields']['History_d_id_old'] = $history->History_d_id;
        $result['fields']['date'] = convertDate(substr($history->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/history/' . $history->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات سابقه مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $msg
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
     * @param $id
     * @return mixed
     */
    public function getHistoryByid($id)
    {
        $history_fields = c_history_d::find($id);
        if (is_object($history_fields)) {
            $result['result'] = 1;
            $result['fields'] = $history_fields->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $history_fields->company_id . "/history/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $history_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getHistoryByidAjax($id)
    {
        $json = $this->getHistoryByid($id);
        echo json_encode($json);
        die();
    }

    /**
     *
     */
    public function showList()
    {
        $history = c_history_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $export['list'] = $history['export']['list'];
        $export['recordsCount'] = $history['export']['recordsCount'];
        $this->fileName = "member.history.showList.php";
        $this->template($export);
        die();
    }

    /**
     * @param $id
     */
    public function deleteHistory($id)
    {
        $history = c_history_d::find($id);

        if (!is_object($history)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($history->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($history->history_id == 0) {
            $result = $history->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $history->company_id . "/history/", $history->image);
        } else {
            $result = $this->deleteAll($history);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($history->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedHistory = c_history_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedHistory['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $history->fields;
        $result['msg'] = "سابقه مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();

    }

    /**
     * @param $history
     * @return mixed
     */
    public function deleteAll($history)
    {
        $histories = c_history_d::getBy_history_id($history->history_id)->get();
        foreach ($histories['export']['list'] as $Histor) {
            $result = $Histor->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $Histor->company_id . "/history/", $Histor->image);

            if ($result['result'] == -1) {
                $result['msg'] = 'سوابق مورد نظر حذف نشد';
                return $result;
            }
        }
        $result = $this->deleteMain($history);
        return $result;
    }

    /**
     * @param $history
     * @return mixed
     */
    public function deleteMain($history)
    {
        $historyMain = c_history::find($history->history_id);
        if (is_object($historyMain)) {
            $result = $historyMain->delete();
        }
        return $result;
    }

    /**
     * @param $image
     * @return null
     */
    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'history'
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
//                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/history/"
//                );
//                return fileUploader($Property, $fields);
//            }
//        }
//        return null;
    }
}
