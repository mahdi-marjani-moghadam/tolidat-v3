<?php

class notification extends looeic
{

    public static function updateAll($notification_id)
    {
        $fields['isRead'] = 1;
        $where = 'Notification_id < ' . $notification_id;
        self::update($fields, $where);
    }
    
}
