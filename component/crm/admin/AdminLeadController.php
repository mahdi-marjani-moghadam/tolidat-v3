<?php
include_once ROOT_DIR . "component/company/admin/model/admin.company.model.php";

class AdminLeadController
{
    public $exportType = 'html';

    public $fileName;

    protected $lead;

    protected $leadTask;

    /**
     * AdminLeadController constructor.
     * @param $lead
     */
    public function __construct(LeadService $lead, LeadTaskService $leadTask)
    {
        $this->lead = $lead;
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
        $export['admins'] = $this->getAdmins();

        $this->fileName = "admin.crm.showLeads.php";
        $this->template($export);
        die();
    }

    public function show($admin_id)
    {
        $export['status'] = 'showAll';
        $export['admin_id'] = '&admin_id=' . $admin_id;

        $this->fileName = "admin.crm.showLeads.php";
        $this->template($export);
        die();
    }

    public function filterLead($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'lead_id', 'dt' => $i++],
            ['db' => 'admin_name', 'dt' => $i++],
            ['db' => 'company_id', 'dt' => $i++],
            ['db' => 'company_name', 'dt' => $i++],
            ['db' => 'company_type', 'dt' => $i++],
            ['db' => 'comment', 'dt' => $i++],
            ['db' => 'date_comment', 'dt' => $i++],
            ['db' => 'date', 'dt' => $i],
            ['db' => 'status', 'dt' => $i],
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $leads = $this->lead->getLeads($searchFields, $fields['admin_id']);

        $list['list'] = $leads['leads']['export']['list'];
        $list['paging'] = $leads['totalRecord'];

        $other['1'] = array('formatter' => function ($list) {
            return $list['admin_name'] . " " . $list['admin_family'];
        });

        $other['3'] = array('formatter' => function ($list) {
            $st = '<a href="' . RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id=' . $list['lead_id'] . '">' . $list['company_name'] . '</a>';
            return $st;
        });

        $other['4'] = array('formatter' => function ($list) {
            $st = $list['company_type'] == 1 ? "حقوقی" : "حقیقی";
            return $st;
        });

        $other['6'] = array('formatter' => function ($list) {
            return convertDate($list['date_comment']);
        });

        $other['7'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });

        $other['8'] = array('formatter' => function ($list) {
            $st = $list['status'] == 1 ? "اتمام" : "ادامه دار";
            return $st;
        });

        $other['9'] = array('formatter' => function ($list) {
            $st = '<a href="' . RELA_DIR . 'admin/?component=crm&action=editLead&lead_id=' . $list['lead_id'] . '">ویرایش</a> ';
            $st .= '<a onclick="return confirm(\'Are you sure?\')" href="' . RELA_DIR . 'admin/?component=crm&action=deleteLead&lead_id=' . $list['lead_id'] . '">حذف</a>';

            if ($list['status'] == 1) {
                $st .= '<br><a class="moveLead" data-id="'.$list['lead_id'].'">انتقال لید</a>';
            }


            return $st;
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function store($fields)
    {
        $this->lead->addLead($fields);

        /*if (is_object($lead)) {
            $_SESSION['lead_comment'] = $fields['comment'];
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id=' . $lead->lead_id);
        }*/

        redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید افزوده شد');
    }

    public function edit($lead_id)
    {
        $lead = $this->lead->getLead($lead_id);

        if (! is_object($lead)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید مورد نظر وجود ندارد');
        }

        $this->fileName = "admin.crm.leadEditForm.php";
        $this->template($lead->fields);
        die();
    }

    public function update($fields)
    {
        if (! $this->lead->update($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید ویرایش نشد');
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید ویرایش شد');
    }

    public function delete($fields)
    {
        if (! $this->lead->delete($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید حذف نشد');
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=leads', 'لید حذف شد');
    }

    public function indexComment($lead_id)
    {
        $lead = Lead::getAll()->where('lead_id', '=', $lead_id)->first();
        $export['status'] = 'showAll';
        $export['lead_id'] = '&lead_id=' . $lead_id;

        if (is_object($lead)) {
            $export['lead'] = $lead->fields;
        }

        $export['admins'] = $this->getAdmins();

        $this->fileName = "admin.crm.showLeadComments.php";
        $this->template($export);
        die();
    }

    public function indexCommentTask($lead_id, $task_id)
    {
        global $admin_info;
        $task = $this->leadTask->getTask($task_id);

        if ($task->status == 1) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id=' . $lead_id, 'این تسک انجام شده است');
        }

        if ($task->assign_to != $admin_info['admin_id']) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leadTasks', 'فقط تسک های مربوط به خود را میتوانید پیگیری کنید');
        }

        $export['status'] = 'showAll';
        $export['lead_id'] = '&lead_id=' . $lead_id . '&task_id=' . $task_id;
        $export['admins'] = $this->getAdmins();

        $this->fileName = "admin.crm.showLeadComments.php";
        $this->template($export);
        die();
    }

    public function filterLeadComment($fields)
    {
        $i = 0;
        $columns = [
            ['db' => 'lead_comment_id', 'dt' => $i++],
            ['db' => 'admin_name', 'dt' => $i++],
            ['db' => 'comment', 'dt' => $i++],
            ['db' => 'date', 'dt' => $i],
        ];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        $comments = $this->lead->getComments($searchFields, $fields['lead_id'], $fields['admin_id']);

        $list['list'] = $comments['comments']['export']['list'];
        $list['paging'] = $comments['totalRecord'];

        $other['1'] = array('formatter' => function ($list) {
            return $list['admin_name'] . " " . $list['admin_family'];
        });

        $other['3'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });

        $internalVariable['showstatus'] = $fields['status'];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function storeComment($fields)
    {
        $lead = $this->lead->getLead($fields['lead_id']);
        $tasks = $this->leadTask->getTaskNotAnswered($fields['lead_id']);

        if ($tasks['recordsCount'] > 0 & !isset($fields['task_id'])) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id='. $fields['lead_id'], 'این لید دارای تسک جواب داده نشده است');
        } else if ($tasks['recordsCount'] <= 0 & !isset($fields['task_id'])) {
            $this->lead->leadOpen($lead);
        } else {
            $task = $this->leadTask->getTask($fields['task_id']);
            $this->leadTask->updateTaskStatus($task);
        }

        $comment = $this->lead->addComment($fields);

        if ($fields['action'] == 2) {
            $fields['comment_id'] = $comment->lead_comment_id;
            $fields['lead_id'] = $comment->lead_id;
            $this->lead->addTask($fields);
        } else {
            $this->lead->leadClose($lead);
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id='. $fields['lead_id'], 'کامنت افزوده شد');
    }

    public function moveLead($fields)
    {
        $company = admincompanyModel::find($fields['company_id']);

        if (! is_object($company)) {
            $result['result'] = -1;
            $result['msg'] = 'کمپانی وجود ندارد';
            echo json_encode($result);
            die();
        }

        $comments = LeadComment::getAll()
            ->where('lead_id', '=', $fields['lead_id'])
            ->where('move', '=', 0)
            ->get();

        if ($comments['export']['recordsCount'] > 0) {
            $FirstLog = $this->saveFirstComment($comments['export']['list'], $fields['company_id']);
            unset($comments['export']['list'][key($comments['export']['list'])]);
        }


        foreach ($comments['export']['list'] as $comment) {
            $log  = new LetterLogs();
            $log->group_id = $FirstLog->group_id;
            $log->company_id = $fields['company_id'];
            $log->admin_id = $comment->admin_id;
            $log->letter_id = 9;
            $log->action_id = 11;
            $log->date = $comment->date;
            $log->description = $comment->comment;
            $log->save();

            $comment->move = 1;
            $comment->save();
        }

        $lead = $this->lead->getLead($fields['lead_id']);
        $lead->company_id = $fields['company_id'];
        $lead->save();

        $result['result'] = 1;
        $result['msg'] = 'تمام کامنت ها به لاگ انتقال یافت';
        echo json_encode($result);
        die();
    }

    public function saveFirstComment($comments, $company_id)
    {
        $firstComment = reset($comments);

        $log  = new LetterLogs();
        $log->group = 0;
        $log->company_id = $company_id;
        $log->admin_id = $firstComment->admin_id;
        $log->letter_id = 9;
        $log->action_id = 11;
        $log->date = $firstComment->date;
        $log->description = $firstComment->comment;
        $log->save();

        $log->group_id = $log->letter_log_id;
        $log->save();

        $firstComment->move = 1;
        $firstComment->save();

        return $log;
    }

    public function getAdmins()
    {
        return adminadminModel::getAll()->getList['export']['list'];
    }


}