<?php

class AdminTaskController
{
    public $exportType = 'html';

    public $fileName;

    protected $letterTask;

    /**
     * AdminTaskController constructor.
     * @param $letterTask
     */
    public function __construct(LetterTaskService $letterTask)
    {
        $this->letterTask = $letterTask;
    }


    public function template($list = [],$msg = '')
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

        $this->fileName = "admin.crm.showTasks.php";
        $this->template($export);
        die();
    }

    public function show($admin_id)
    {
        $export['status'] = 'showAll';
        $export['admin_id'] = '&admin_id=' . $admin_id;

        $this->fileName = "admin.crm.showTasks.php";
        $this->template($export);
        die();
    }

    public function filterTask($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'letter_task_id', 'dt' => $i++],
            ['db' => 'log_id', 'dt' => $i++],
            ['db' => 'group_id', 'dt' => $i++],
            ['db' => 'company_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'type', 'dt' => $i++],
            ['db' => 'description', 'dt' => $i++],
            ['db' => 'name', 'dt' => $i++],
            ['db' => 'tracking_date', 'dt' => $i],
            ['db' => 'date', 'dt' => $i],
            ['db' => 'status', 'dt' => $i],
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $tasks = $this->letterTask->getTasks($searchFields, $fields['admin_id']);

        $list['list'] = $tasks['tasks']['export']['list'];
        $list['paging'] = $tasks['totalRecord'];

        $other['6'] = array('formatter' => function ($list) {
            return "<a href='" . RELA_DIR . "admin/?component=crm&action=logs&company_id=" . $list['company_id'] . "&task_id=" . $list['letter_task_id'] . "'>" . $list['description'] . "</a>";
        });

        $other['7'] = array('formatter' => function ($list) {
            return $list['name'] . " " . $list['family'];
        });

        $other['8'] = array('formatter' => function ($list) {
            $st = $list['tracking_date'] | $list['tracking_date'] != '0000-00-00 00:00:00' ? convertDate($list['tracking_date']) : '0000/00/00';
            return $st;
        });

        $other['9'] = array('formatter' => function ($list) {
            $st = $list['date'] ? convertDate($list['date']) : '0000/00/00';
            return $st;
        });

        $other['10'] = array('formatter' => function ($list) {

            if ($list['status'] == '1') {
                $st = '<i class="fa fa-check-circle" style="font-size: x-large"></i>';
            } else {
                $st = '<i class="fa fa-times-circle" style="font-size: x-large"></i>';
            }

            return $st;
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function showListCompany($fields)
    {
        $export['status'] = 'showAll';
        $export['have_been_value'] = 1;

        if (isset($fields['letter_action'])) {
            foreach ($fields['letter_action'] as $action) {
                $export['letter_action'] .= '&letter_action%5B%5D=' . $action;
                $export['letter_action_id'][] = $action;
            }
        }

        if (isset($fields['have-been'])) {
            $export['have_been'] = '&have-been=' . $fields['have-been'];
            $export['have_been_value'] = $fields['have-been'];
        }

        $export['actions'] = $this->letterAction->getLetterActions();

        $this->fileName = "admin.crm.companyShowList.php";
        $this->template($export);
        die();
    }

}