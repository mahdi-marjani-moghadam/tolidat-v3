<?php

class AdminLeadTaskController
{
    public $exportType = 'html';

    public $fileName;

    protected $leadTask;

    /**
     * AdminLeadTaskController constructor.
     * @param $leadTask
     */
    public function __construct(LeadTaskService $leadTask)
    {
        $this->leadTask = $leadTask;
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

        $this->fileName = "admin.crm.showLeadTasks.php";
        $this->template($export);
        die();
    }

    public function show($admin_id)
    {
        $export['status'] = 'showAll';
        $export['admin_id'] = '&admin_id=' . $admin_id;

        $this->fileName = "admin.crm.showLeadTasks.php";
        $this->template($export);
        die();
    }

    public function filterTask($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'lead_task_id', 'dt' => $i++],
            ['db' => 'lead_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'comment', 'dt' => $i++],
            ['db' => 'admin_name', 'dt' => $i++],
            ['db' => 'tracking_date', 'dt' => $i],
            ['db' => 'date', 'dt' => $i],
            ['db' => 'status', 'dt' => $i],
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $tasks = $this->leadTask->getLeadTasks($searchFields, $fields['admin_id']);
        $list['list'] = $tasks['leadTasks']['export']['list'];
        $list['paging'] = $tasks['totalRecord'];

        $other['3'] = array('formatter' => function ($list) {
            return '<a href="' . RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id=' . $list['lead_id'] . '&task_id=' . $list['lead_task_id'] . '">' . $list['comment'] . '</a>';
        });

        $other['4'] = array('formatter' => function ($list) {
            return $list['admin_name'] . " " . $list['admin_family'];
        });

        $other['5'] = array('formatter' => function ($list) {
            $st = $list['tracking_date'] ? convertDate($list['tracking_date']) : '0000/00/00';
            return $st;
        });

        $other['6'] = array('formatter' => function ($list) {
            $st = $list['date'] ? convertDate($list['date']) : '0000/00/00';
            return $st;
        });

        $other['7'] = array('formatter' => function ($list) {

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

}