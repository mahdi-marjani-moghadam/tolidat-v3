<?php

class AdminLetterLogController
{
    public $exportType = 'html';

    public $fileName;

    protected $letterLog;

    protected $letterTask;

    protected $letter;

    protected $letterAction;

    /**
     * AdminLetterLogController constructor.
     * @param $letterLog
     * @param $letterTask
     * @param $letter
     * @param $letterAction
     */
    public function __construct(LetterService $letter, LetterActionService $letterAction, LetterLogService $letterLog, LetterTaskService $letterTask)
    {
        $this->letter = $letter;
        $this->letterAction = $letterAction;
        $this->letterLog = $letterLog;
        $this->letterTask = $letterTask;
    }


    public function template($list = [])
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

    public function index()
    {
        $export['status'] = 'showAll';

        $this->fileName = "admin.crm.logShowAllList.php";
        $this->template($export);
        die();
    }

    public function indexByAdmin($admin_id)
    {
        $export['status'] = 'showAll';
        $export['admin_id'] = '&admin_id=' . $admin_id;

        $this->fileName = "admin.crm.logShowAllList.php";
        $this->template($export);
        die();
    }

    public function show($fields)
    {
        $company = admincompanyModel::find($fields['company_id']);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . "admin/?component=crm&action=companies", "کمپانی یافت نشد");
        }

        if (! isset($_GET['task'])) {
            unset($_SESSION['task-msg']);
        }

        if (isset($fields['task_id'])) {
            $task = $this->letterTask->checkTask($_GET['task_id']);

            if (!is_object($task)) {
                redirectPage(RELA_DIR . "admin/?component=crm&action=task", $task['msg']);
                die();
            }

            if ($task->status == 1) {
                $_SESSION['task-msg'] = "این تسک قبلا پیگیری شده است";
                redirectPage(RELA_DIR . "admin/?component=crm&action=logs&company_id=" . $company->Company_id . "&task");
                die();
            }

            $log = $this->letterLog->getLog($task->log_id);
            $_SESSION['task-msg'] = "پیگیری تسک شماره : {$task->letter_task_id}" . " شماره دسته : {$log->group_id}";
        }

        $export['company'] = $company->fields;
        $export['logs'] = $this->letterLog->getLetterLogs($fields['company_id']);
        $export['actions'] = $this->letterAction->getLetterActions();
        $export['admins'] = $this->getAdmins();
        $export['letters'] = $this->letter->getLetters();
        $export['task-msg'] = $_SESSION['task-msg'];

        $this->fileName = "admin.crm.logShowList.php";
        $this->template($export);
        die();
    }

    public function filterLog($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'letter_log_id', 'dt' => $i++],
            ['db' => 'group_id', 'dt' => $i++],
            ['db' => 'company_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'name', 'dt' => $i++],
            ['db' => 'type', 'dt' => $i++],
            ['db' => 'action', 'dt' => $i++],
            ['db' => 'name_assign', 'dt' => $i++],
            ['db' => 'status', 'dt' => $i++],
            ['db' => 'date', 'dt' => $i],
            ['db' => 'description', 'dt' => $i++],
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $tasks = $this->letterLog->getLogs($searchFields, $fields['admin_id']);

        $list['list'] = $tasks['logs']['export']['list'];
        $list['paging'] = $tasks['totalRecord'];

        $other['4'] = array('formatter' => function ($list) {
            return $list['admin_name'] . " " . $list['admin_family'];
        });

        $other['7'] = array('formatter' => function ($list) {
            return $list['assign_name'] . " " . $list['assign_family'];
        });

        $other['8'] = array('formatter' => function ($list) {
            if ($list['status'] == '1') {
                $st = '<i class="fa fa-check-circle" style="font-size: x-large"></i>';
            } else if ($list['status'] == '0') {
                $st = '<i class="fa fa-times-circle" style="font-size: x-large"></i>';
            } else {
                $st = '';
            }

            return $st;
        });

        $other['9'] = array('formatter' => function ($list) {
            $st = $list['date'] ? convertDate($list['date']) : '0000/00/00';
            return $st;
        });

        $other['10'] = array('formatter' => function ($list) {
            return $list['description'];
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function store($fields)
    {
        $fields['company_id'] = $_GET['company_id'];

        if (isset($_GET['task_id'])) {
            $task = $this->letterTask->checkTask($_GET['task_id']);
            
            if (!is_object($task)) {
                redirectPage(RELA_DIR . "admin/?component=crm&action=task", $task['msg']);
                die();
            }

            $log = $this->letterLog->add($fields);
            $this->letterLog->update($log, $task);
            $this->letterTask->update($task);
        } else {
            $log = $this->letterLog->add($fields);
            $this->letterLog->update($log);
        }

        if (!empty($fields['assign_to'])) {
            $this->letterTask->add($fields, $log->letter_log_id);
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=logs&company_id=' . $fields['company_id'], "ذخیره عملیات انجام شد");
        die();
    }

    public function getAdmins()
    {
        return adminadminModel::getAll()->getList['export']['list'];
    }
}