<?php
include_once ROOT_DIR . "component/crm/model/Lead.php";
include_once ROOT_DIR . "component/crm/model/LeadComment.php";
include_once ROOT_DIR . "component/crm/model/LeadTask.php";

class LeadService
{
    public function getLead($lead_id)
    {
        return Lead::find($lead_id);
    }

    public function getLeads($searchFields, $admin_id = null)
    {
        $leads = Lead::getAll()
            ->select('leads.*', 'admin.name as admin_name', 'admin.family as admin_family', 'lead_comments.comment', 'lead_comments.date as date_comment')
            ->leftJoin('admin', 'admin.admin_id', '=', 'leads.admin_id')
            ->leftJoin('(SELECT lead_id, MAX(lead_comment_id) AS latest FROM lead_comments GROUP BY lead_id) AS pp', 'pp.lead_id', '=', 'leads.lead_id')
            ->leftJoin('lead_comments', 'lead_comments.lead_comment_id', '=', 'pp.latest');

        if (!is_null($admin_id)) {
            $leads->where('leads.admin_id', '=', $admin_id);
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'company_name') {
                    $leads->where('leads.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'admin_name') {
                    $leads->whereOpen('admin.name', 'like', '%' . $value . '%');
                    $leads->orWhereClose('admin.family', 'like', '%' . $value . '%');
                } else if ($filter == 'date') {
                    $leads->where('leads.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else if ($filter == 'date_comment') {
                    $leads->where('lead_comments.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else {
                    $leads->where('leads.' . $filter, '=', convertToEnglish($value));
                }
            }
        }

        $objClone = clone $leads;
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                if ($filter == 'date_comment') {
                    $leads->orderBy('lead_comments.date', $value);
                } else {
                    $leads->orderBy('leads.' . $filter, $value);
                }
            }
        } else {
            $leads->orderBy('leads.lead_id', 'DESC');
        }

        $leads->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
        //        $c = $leads->getList(); dd($leads);

        $result['leads'] = $leads->getList();
        $result['totalRecord'] = $totalRecord;

        return $result;
    }

    public function addLead($fields)
    {
        global $admin_info;

        /*$lead = Lead::getAll()
            ->where('company_name', '=', $fields['company_name'])->first();

        if (is_object($lead)) {
            return $lead;
        }*/

        $lead = new Lead();
        
        $lead->company_name = $fields['company_name'];
        $lead->name = $fields['name'];
        $lead->mobile = convertToEnglish($fields['mobile']);
        $lead->phone = convertToEnglish($fields['phone']);
        $lead->company_id = convertToEnglish($fields['company_id']);
        $lead->company_type = convertToEnglish($fields['company_type']);
        $lead->admin_id = (isset($admin_info['admin_id']) ? $admin_info['admin_id'] : 2);
        $lead->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $lead->status = (isset($fields['action']) && is_numeric($fields['action'])) ? $fields['action'] : 0;
        $lead->company_id = $fields['company_id'] ?? 0;
        dd($fields);
        if (isset($fields['fastform'])) {
            $fields['comment'] = ' درخواست از صفحه اصلی سایت قسمت ارتباط سریع';
        }
        if (isset($fields['register'])) {
            $fields['comment'] = '  از صفحه ثبت نام ' . $fields['phone'] . ' ' . $fields['company_name'];
        }
        // dd($fields);
        $result = $lead->save();
        if ($_SERVER['HTTP_HOST'] == 'tolidat.ir') {
            sendSMS(OPERATOR, $fields['comment']);
        }
        if ($result['result'] == 1) {
            $fields['lead_id'] = $lead->lead_id;
            $comment = $this->addComment($fields);
        }

        if ($fields['action'] == 2) {
            $fields['comment_id'] = $comment->lead_comment_id;
            $this->addTask($fields);
        }

        return $lead;
    }

    public function update($fields)
    {
        global $admin_info;

        $lead = $this->getLead($fields['lead_id']);

        if (!is_object($lead)) {
            return false;
        }

        $lead->company_name = $fields['company_name'];
        $lead->name = $fields['name'];
        $lead->mobile = convertToEnglish($fields['mobile']);
        $lead->phone = convertToEnglish($fields['phone']);
        $lead->company_id = convertToEnglish($fields['company_id']);
        $lead->company_type = convertToEnglish($fields['company_type']);
        $lead->admin_id = $admin_info['admin_id'];
        $lead->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $result = $lead->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function delete($fields)
    {
        global $admin_info;
        $lead = $this->getLead($fields['lead_id']);
        if (!is_object($lead)) {
            return false;
        }
        
        $result = $lead->delete();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }


    public function getComments($searchFields, $lead_id, $admin_id = null)
    {
        $comments = LeadComment::getAll()
            ->select('lead_comments.*', 'admin.name as admin_name', 'admin.family as admin_family')
            ->leftJoin('admin', 'admin.admin_id', '=', 'lead_comments.admin_id')
            ->where('lead_comments.lead_id', '=', $lead_id);

        if (!is_null($admin_id)) {
            $comments->where('leads.admin_id', '=', $admin_id);
        }

        if (isset($searchFields['filter'])) {
            foreach ($searchFields['filter'] as $filter => $value) {
                if ($filter == 'comment') {
                    $comments->where('lead_comments.' . $filter, 'like', '%' . $value . '%');
                } else if ($filter == 'admin_name') {
                    $comments->whereOpen('admin.name', 'like', '%' . $value . '%');
                    $comments->orWhereClose('admin.family', 'like', '%' . $value . '%');
                } else if ($filter == 'date') {
                    $comments->where('lead_comments.' . $filter, 'like', '%' . convertJToGDate($value) . '%');
                } else {
                    $comments->where('lead_comments.' . $filter, '=', convertToEnglish($value));
                }
            }
        }

        if (isset($searchFields['order'])) {
            foreach ($searchFields['order'] as $filter => $value) {
                $comments->orderBy('lead_comments.' . $filter, $value);
            }
        } else {
            $comments->orderBy('lead_comments.lead_comment_id', 'DESC');
        }

        $objClone = clone $comments;
        $totalRecord = $objClone->getList()['export']['recordsCount'];

        $comments->limit($searchFields['limit']['start'], $searchFields['limit']['length']);
        //        $c = $comments->getList(); dd($comments);

        $result['comments'] = $comments->getList();
        $result['totalRecord'] = $totalRecord;

        return $result;
    }

    public function addComment($fields)
    {
        global $admin_info;

        $comment = new LeadComment();
        $comment->comment = $fields['comment'];
        $comment->lead_id = $fields['lead_id'];
        $comment->admin_id = $admin_info['admin_id'] ?? 2;
        $comment->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $comment->save();
        // dd($comment);

        return $comment;
    }

    public function addTask($fields)
    {
        $newTask = new LeadTask();
        $newTask->lead_id = $fields['lead_id'];
        $newTask->comment_id = $fields['comment_id'];
        $newTask->assign_to = $fields['assign_to'];
        $newTask->tracking_date = convertJToGDate($fields['tracking_date']);
        $newTask->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newTask->status = 0;
        $newTask->save();

        return $newTask;
    }

    public function leadClose($lead)
    {
        $lead->status = 1;

        return $lead->save();
    }

    public function leadOpen($lead)
    {
        $lead->status = 0;

        return $lead->save();
    }
}
