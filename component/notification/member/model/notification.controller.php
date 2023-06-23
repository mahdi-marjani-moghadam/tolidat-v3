<?php

require_once "notification.model.php";

class notificationController
{

    public $exportType = 'html';

    public $fileName;

    private $company_info;

    /**
     * notificationController constructor.
     * @internal param $company_info
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
    }


    /**
     * get all company notification unread
     * @param $company_id
     */
    public static function getAllUnread($company_id)
    {
        $messageType = [2, 4];
        $result = notification::getBy_to_and_messageType_and_isRead($company_id, $messageType, 0)->orderBy('Notification_id', 'DESC')->limit(10)->getList();
        $last_key = end(array_keys($result['export']['list']));
        if ($result['export']['recordsCount'] > 0) {
            notification::updateAll($result['export']['list'][$last_key]['Notification_id']);
        }
        return $result;
    }

    /**
     * @param $company_id
     * @return
     * @internal param $fields
     */
    public function getAllRecive($company_id)
    {
        $messageType = [2, 4];
        $result = notification::getBy_to_and_messageType($company_id, $messageType)->getList();
        return $result;
    }

    /**
     * @param $id
     * @internal param $input
     */
    public function deleteNotification($id)
    {
        $notification = notification::find($id);

        if (!is_object($notification)) {
            $result['result'] = -1;
            $result['message'] = "اعلان مورد نظر یافت نشد";
            echo json_encode($result);
            die();
        }

        if ($notification->to != $this->company_info['company_id']) {
            $result['result'] = -1;
            $result['message'] = 'اعلان مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }
        $result = $notification->delete();

        if ($result['result'] != 1) {
            $result['result'] = -1;
            $result['message'] = "اعلان مورد نظر حذف نشد دوباره تلاش نمایید";
            echo json_encode($result);
            die();
        }

        $result['message'] = "اعلان مورد نظر حذف شد";
        echo json_encode($result);
        die();
    }

    /**
     * @param $input
     */
    public function showRecive()
    {
        global $admin_info;
        $admin_id = $admin_info['admin_id'];
        $result = adminNotificationModel::getBy_to($admin_id)->getList();
        $this->fileName = "admin.notification.showList.php";
        $this->template($result);
        die();
    }


    public function isRead($id)
    {
        $notification = adminNotificationModel::find($id);
        if (is_object($notification)) {
            $notification->isRead = 1;
            $notification->save();
            $return['result'] = 1;
            return $return;
        }
        $return['result'] = -1;
        $return['msg'] = "notification not found";
        return $return;
    }

    /**
     * @param $id
     */
    public static function showMSG($id)
    {
        $notification = adminNotificationModel::find($id);
        if (is_object($notification)) {
            $notification->isRead = 1;
            $notification->save();
            return ;
        }
    }

    public static function getNotificationById($id, $company_id)
    {
        $result = notification::getBy_Notification_id_and_to($id, $company_id)->getList();
        static::showMSG($id);
        return $result['export'];
    }

    /**
     *
     */
    public function showNotificationAddForm()
    {
        global $admin_info;
        $fields = $admin_info;
        $this->fileName = "admin.notification.addForm.php";
        $this->template($fields);
        die();
    }

    /**
     * @param $fields
     */
    public function addNotification($fields)
    {
        if (!empty($fields)) {
            $notification = new adminNotificationModel();
            $notification->from = $fields['from'];
            $notification->to = $fields['to'];
            $notification->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $notification->isRead = 0;
            $notification->msg = $fields['msg'];
            $notification->action = '';
            $notification->messageType = $fields['messageType'];
            $result = $notification->save();
            return $result;
        }
    }

    /**
     * @param $input
     */
    public function showNotificationEditForm($input)
    {
        echo "edit form";
        print_r_debug($input);
    }

    /**
     * @param $fields
     */
    public function editNotification($fields)
    {
        $fields = [1, 5, '2016-10-12', 1, 'hello world', '', 3];
        $notification = adminNotificationModel::find(10);
        if ($notification->isRead == 0) {
            $notification->setFields($fields);
            $result = $notification->save();
            print_r_debug($result);
        }
        print_r_debug('error');
    }


}
