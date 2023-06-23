<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.log.model.php");

/**
 * Class registerController
 */
class adminLogController
{
    public $exportType;
    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';
    }

    function template($list = [], $msg='')
    {
        global $messageStack;
        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
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

    public function AddLog($input = '', $msg='')
    {
        global $admin_info;
        $input['admin_id'] = $admin_info['admin_id'];

        $logObject = new adminLogModel();
        $logObject->company_id = $input['company_id'];
        $logObject->admin_id = $input['admin_id'];
        $logObject->action = $input['action'];
        $logObject->text = $input['text'];
        $logObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $logObject->save();

    }

    public function getLog($input = '')
    {
        include_once ROOT_DIR . "component/crm/model/LetterLogs.php";
        $logs = LetterLogs::getAll()
            ->select('letter_logs.*', 'letters.type as letter_type',
                'letter_actions.action as letter_action',
                'admin.name as admin_name', 'admin.family as admin_family')
            ->where('letter_logs.company_id', '=', $input['Company_id'])

            ->leftJoin('letters', 'letter_logs.letter_id', '=', 'letters.letter_id')
            ->leftJoin('letter_actions', 'letter_logs.action_id', '=', 'letter_actions.letter_action_id')
            ->leftJoin('admin', 'letter_logs.admin_id', '=', 'admin.admin_id')
            ->limit(10)
            ->orderBy('letter_log_id', 'DESC')
            ->getList();

        return $logs;
    }


}

?>
