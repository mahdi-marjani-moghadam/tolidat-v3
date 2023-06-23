<?php
include_once ROOT_DIR . "component/crm/model/Lead.php";
include_once ROOT_DIR . "component/crm/model/LeadComment.php";

class LeadTaskService
{
    public function getTask($task_id)
    {
        return LeadTask::find($task_id);
    }

    public function getTaskNotAnswered($lead_id)
    {
        return LeadTask::getAll()
            ->where('lead_id', '=', $lead_id)
            ->where('status', '=', 0)
            ->getList()['export'];
    }

    public function updateTaskStatus($task)
    {
        $task->status = 1;

        return $task->save();
    }

    public function getLeadTasks($searchFields, $admin_id = null)
    {
        $tasks = LeadTask::getAll()
            ->select('lead_tasks.*', 'leads.company_name', 'admin.name as admin_name', 'admin.family as admin_family', 'lead_comments.comment')
            ->leftJoin('leads', 'lead_tasks.lead_id', '=', 'leads.lead_id')
            ->leftJoin('admin', 'admin.admin_id', '=', 'lead_tasks.assign_to')
            ->leftJoin('lead_comments', 'lead_comments.lead_comment_id', '=', 'lead_tasks.comment_id');

        if (!is_null($admin_id)) {
            $tasks->where('lead_tasks.assign_to', '=', $admin_id);
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'company_name') {
                    $tasks->where('leads.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'admin_name') {
                    $tasks->whereOpen('admin.name', 'like', '%' . $value . '%');
                    $tasks->orWhereClose('admin.family', 'like', '%' . $value . '%');
                } else if ($filter == 'date') {
                    $tasks->where('lead_tasks.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'comment') {
                    $tasks->where('lead_comments.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'tracking_date') {
                    $tasks->where('lead_tasks.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else {
                    $tasks->where('lead_tasks.' . $filter, '=', convertToEnglish($value));
                }
            }
        }

        $objClone = clone $tasks;
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'tracking_date'){
                    $tasks->orderBy('lead_tasks.tracking_date', $value);
                } else {
                    $tasks->orderBy('lead_tasks.' . $filter, $value);
                }
            }
        } else {
            $tasks->orderBy('lead_tasks.lead_task_id', 'DESC');
        }

        $tasks->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
//        $c = $tasks->getList(); dd($tasks);

        $result['leadTasks'] = $tasks->getList();
        $result['totalRecord'] = $totalRecord;

        return $result;
    }

}