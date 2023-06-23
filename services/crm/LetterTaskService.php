<?php
include_once ROOT_DIR . "component/crm/model/LetterTasks.php";
include_once ROOT_DIR . "component/crm/model/LeadTask.php";

class LetterTaskService
{

    public function getTaskCount()
    {
        global $admin_info;

        $letterTask = LetterTasks::getAll()
            ->where('assign_to', '=', $admin_info['admin_id'])
            ->where('status', '=', 0)
            ->getList()['export']['recordsCount'];

        $leadTask = LeadTask::getAll()
            ->where('assign_to', '=', $admin_info['admin_id'])
            ->where('status', '=', 0)
            ->getList()['export']['recordsCount'];

        $result['total'] = $letterTask + $leadTask;
        $result['log'] = $letterTask;
        $result['lead'] = $leadTask;

        return $result;
    }

    public function checkTask($task_id)
    {
        global $admin_info;

        $task = $this->getLetterTaskById($task_id);

        if ($task->assign_to != $admin_info['admin_id']) {
            return $result = [
                'result' => -1,
                'msg' => "فقط تسک های مربوط به خود را میتوانید پیگیری کنید"
            ];
        }

        /*if ($task->status == 1) {
            return $result = [
                'result' => -1,
                'msg' => 'این تسک قبلا پیگیری شده است'
            ];
        }*/

        return $task;
    }

    public static function getLetterTasksByLogIds($logIds)
    {
        return LetterTasks::getAll()
            ->select('letter_tasks.*', 'admin.name as assign_name', 'admin.family as assign_family')
            ->leftJoin('admin', 'letter_tasks.assign_to', '=', 'admin.Admin_id')
            ->where('log_id', 'in', $logIds)
            ->getList()['export']['list'];
    }

    public function getLetterTaskById($task_id)
    {
        return LetterTasks::find($task_id);
    }

    public function getTasks($searchFields,  $admin_id = null)
    {
        $tasks = LetterTasks::getAll()
            ->select('letter_tasks.*', 'admin.name', 'admin.family', 'letter_logs.description',
                'letter_logs.company_id', 'letters.type', 'company.company_name', 'letter_logs.group_id')
            ->leftJoin('admin', 'admin.admin_id', '=', 'letter_tasks.assign_to')
            ->leftJoin('letter_logs', 'letter_logs.letter_log_id', '=', 'letter_tasks.log_id')
            ->leftJoin('letters', 'letters.letter_id', '=', 'letter_logs.letter_id')
            ->leftJoin('company', 'company.Company_id', '=', 'letter_logs.company_id');

        if (!is_null($admin_id)) {
            $tasks->where('letter_tasks.assign_to', '=', $admin_id);
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'company_name') {
                    $tasks->where('company.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'company_id') {
                    $tasks->where('company.' . $filter, '=', convertToEnglish($value));
                } else if ($filter == 'group_id') {
                    $tasks->where('letter_logs.' . $filter, '=', convertToEnglish($value));
                } else if ($filter == 'type') {
                    $tasks->where('letters.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'name') {
                    $tasks->where('admin.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'tracking_date') {
                    $tasks->where('letter_tasks.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'date') {
                    $tasks->where('letter_tasks.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'description') {
                    $tasks->where('letter_logs.' . $filter, 'like', '%' . $value . '%');
                } else {
                    $tasks->where('letter_tasks.' . $filter, '=', $value);
                }
            }
        }

        $objClone = clone $tasks;
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'name') {
                    $tasks->orderBy('admin.' . $filter, $value);
                } else if ($filter == 'company_name' | $filter == 'company_id'){
                    $tasks->orderBy('company.' . $filter, $value);
                } else if ($filter == 'group_id'){
                    $tasks->orderBy('letter_logs.' . $filter, $value);
                } else if ($filter == 'type'){
                    $tasks->orderBy('letters.' . $filter, $value);
                } else {
                    $tasks->orderBy('letter_tasks.' . $filter, $value);
                }
            }
        } else {
            $tasks->orderBy('letter_tasks.status', 'ASC');
            $tasks->orderBy('letter_tasks.letter_task_id', 'DESC');
        }

        $tasks->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
//        $c = $tasks->getList(); dd($tasks);

        $result['tasks'] = $tasks->getList();
        $result['totalRecord'] = $totalRecord;

        return $result;
    }

    public function add($fields, $log_id)
    {
        $task = new LetterTasks();
        $task->log_id = $log_id;
        $task->assign_to = $fields['assign_to'];
        $task->tracking_date = convertJToGDate($fields['tracking_date']);
        $task->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $task->status = 0;
        $task->save();

        return $task;
    }

    public function update($task)
    {
        $task->status = 1;
        $task->save();

        return $task;
    }
}