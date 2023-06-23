<?php
include_once ROOT_DIR . "component/crm/model/LetterLogs.php";
include_once ROOT_DIR . "services/crm/LetterTaskService.php";

class LetterLogService
{
    public function getLog($log_id)
    {
        return LetterLogs::find($log_id);
    }

    public function getLetterLogs($company_id)
    {
        $logs = LetterLogs::getAll()
            ->select('letter_logs.*', 'letters.type as letter_type',
                'letter_actions.action as letter_action',
                'A.name as admin_name', 'A.family as admin_family',
                'B.name as assign_name', 'B.family as assign_family',
                'letter_tasks.status')
            ->where('letter_logs.company_id', '=', $company_id)

            ->leftJoin('letters', 'letter_logs.letter_id', '=', 'letters.letter_id')
            ->leftJoin('letter_actions', 'letter_logs.action_id', '=', 'letter_actions.letter_action_id')
            ->leftJoin('admin A', 'letter_logs.admin_id', '=', 'A.admin_id')
            ->leftJoin('letter_tasks', 'letter_logs.letter_log_id', '=', 'letter_tasks.log_id')
            ->leftJoin('admin B', 'letter_tasks.assign_to', '=', 'B.admin_id')
            ->getList()['export']['list'];

//        dd($logs);
        return $logs;
    }

    public function getLogs($searchFields,  $admin_id = null)
    {
        $logs = LetterLogs::getAll()
            ->select('letter_logs.*', 'letters.type', 'letter_actions.action',
                'A.name as admin_name', 'A.family as admin_family',
                'B.name as assign_name', 'B.family as assign_family',
                'letter_tasks.status', 'company.company_name')

            ->leftJoin('letters', 'letter_logs.letter_id', '=', 'letters.letter_id')
            ->leftJoin('letter_actions', 'letter_logs.action_id', '=', 'letter_actions.letter_action_id')
            ->leftJoin('admin A', 'letter_logs.admin_id', '=', 'A.admin_id')
            ->leftJoin('letter_tasks', 'letter_logs.letter_log_id', '=', 'letter_tasks.log_id')
            ->leftJoin('admin B', 'letter_tasks.assign_to', '=', 'B.admin_id')
            ->leftJoin('company', 'company.Company_id', '=', 'letter_logs.company_id');

        if (!is_null($admin_id)) {
            $logs->where('letter_logs.admin_id', '=', $admin_id);
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'company_name') {
                    $logs->where('company.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'company_id') {
                    $logs->where('company.' . $filter, '=', convertToEnglish($value));
                } else if ($filter == 'type') {
                    $logs->where('letters.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'action') {
                    $logs->where('letter_actions.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'name') {
                    $logs->whereOpen('A.name', 'like', '%' . $value . '%');
                    $logs->orWhereClose('A.family', 'like', '%' . $value . '%');
                } else if ($filter == 'name_assign') {
                    $logs->whereOpen('B.name', 'like', '%' . $value . '%');
                    $logs->orWhereClose('B.family', 'like', '%' . $value . '%');
                } else if ($filter == 'date') {
                    $logs->where('letter_logs.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'description') {
                    $logs->where('letter_logs.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'status') {
                    $logs->where('letter_tasks.' . $filter, '=', $value);
                } else {
                    $logs->where('letter_logs.' . $filter, '=', convertToEnglish($value));
                }
            }
        }

        $objClone = clone $logs;
        $objClone->limit(200);
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'name' or $filter == 'name_assign') {
                    $logs->orderBy('admin.' . $filter, $value);
                } else if ($filter == 'company_name' | $filter == 'company_id'){
                    $logs->orderBy('company.' . $filter, $value);
                } else if ($filter == 'action'){
                    $logs->orderBy('letter_actions.' . $filter, $value);
                } else if ($filter == 'type'){
                    $logs->orderBy('letters.' . $filter, $value);
                } else if ($filter == 'status'){
                    $logs->orderBy('letter_tasks.' . $filter, $value);
                } else {
                    $logs->orderBy('letter_logs.' . $filter, convertToEnglish($value));
                }
            }
        } else {
            $logs->orderBy('letter_logs.letter_log_id', 'DESC');
        }

        $logs->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
//        $c = $logs->getList(); dd($logs);

        $result['logs'] = $logs->getList();
        $result['totalRecord'] = $totalRecord;

        return $result;
    }

    public function getCompanyIdsByAction_id($action_id)
    {
        ini_set('memory_limit', -1);

        $sql = 'SELECT company_id FROM (SELECT GROUP_CONCAT(action_id, ",") as group_acion_id, company_id 
                  FROM letter_logs GROUP BY(company_id) HAVING ';

        foreach ($action_id as $action) {
            $sql .= ' (group_acion_id LIKE "' . $action . ',%" OR  group_acion_id LIKE "%,' . $action . ',%") AND';
        }

        $sql = substr($sql, 0, -3);
        $sql .= ') T';

        $logs = LetterLogs::query($sql)->getList();

        $companyIds = [0];
        foreach ($logs['export']['list'] as $value) {
            $companyIds[] = $value['company_id'];
        }

        return $companyIds;


        //  getCompanyIds with Foreach method
        /*$logs = LetterLogs::getAll()
            ->where('action_id', 'in', $action_id)
            ->getList();

        foreach ($logs['export']['list'] as $log) {
            $result[$log['company_id']][$log['action_id']] = $log['action_id'];
        }

        $companyIds = [0];
        foreach ($result as $key => $value) {
            if (count($value) == count($action_id)) {
                $companyIds[] = $key;
            }
        }*/
    }

    public function add($fields)
    {
        $log = new LetterLogs();
        // dd($fields);
        $log->group_id = 0;
        $log->company_id = $fields['company_id'];
        $log->admin_id = $fields['admin_id'];
        $log->letter_id = $fields['letter'];
        $log->action_id = $fields['action'];
        $log->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $log->description = $fields['description'];
        $log->save();

        return $log;
    }

    public function update($log, $task = null)
    {
        if (!is_null($task)) {
            $oldLog = LetterLogs::find($task->log_id);
            $log->group_id = $oldLog->group_id;
            $log->save();

            return $log;
        }

        $log->group_id = $log->letter_log_id;
        $log->save();

        return $log;
    }
}