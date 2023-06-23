<?php
require_once "admin.notification.model.php";

/**
 * Class adminNotificationController
 */
class adminNotificationController
{
    public $exportType = 'html';

    public $fileName;

    public function template($list = [], $msg='')
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

    public function showAllRecive()
    {
        $messageType = [1, 3];
        $result = adminNotificationModel::getBy_messageType($messageType)->getList();
        $this->fileName = "admin.notification.showList.php";
        $this->template($result);
        die();
    }

    public function showRecive()
    {
        global $admin_info;
        $admin_id = $admin_info['admin_id'];
        $result = adminNotificationModel::getBy_to($admin_id)->getList();
        $this->fileName = "admin.notification.showList.php";
        $this->template($result);
        die();
    }

    public function showAllUnread()
    {
        $messageType = [1, 3];
        $result = adminNotificationModel::getBy_messageType_and_isRead($messageType, 0)->getList();
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
    public function showMSG($id)
    {
        $notification = adminnotificationModel::find($id);
        print_r_debug($notification);
        die();
        if (is_object($notification)) {
            if ($notification->isRead == 0) {
                //echo $notification->msg;
                $notification->isRead = 1;
                $result=$notification->save();

            }
        }
        
        if ($result['result'] == '1') {
            $data = "1";
        }else{
            $data = "-1";
        }
        echo $data;
        die();


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
        global $admin_info,$member;
        
        if (!empty($fields)) {
            $notification = new adminNotificationModel();
            $notification->from = $admin_info['admin_id'] ?? 0;
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
        }
    }

    /**
     * @param $input
     */
    public function deleteNotification($input)
    {
        $notification = adminNotificationModel::find($input['notification_id']);
        $result = $notification->delete();
        if ($result['result'] == 1) {
            $msg = "با موفقیت حذف شد";
            redirectPage(RELA_DIR . 'admin/index.php?component=notification&action=showAllRecive', $msg);
        }
    }
}