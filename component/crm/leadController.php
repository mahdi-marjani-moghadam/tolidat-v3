<?php

class leadController
{


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




    public function store($fields)
    {
        global $messageStack;
        $fields['phone'] = $fields['mobile'];
        $fields['company_name'] = $fields['name'];
        $fields['company_id'] = 0;
        $fields['company_type'] = 1;
        $fields['status'] = 0;
        $this->lead->addLead($fields);

        /*if (is_object($lead)) {
            $_SESSION['lead_comment'] = $fields['comment'];
            redirectPage(RELA_DIR . 'admin/?component=crm&action=leadComments&lead_id=' . $lead->lead_id);
        }*/

        

        $messageStack->add_session('message', 'درخواست شما ثبت شد', 'success');
        redirectPage(RELA_DIR . '#fast-register', 'درخواست شما ثبت شد');
    }

    public function storeApi($fields)
    {
        $fields['phone'] = $fields['mobile'];
        $fields['company_name'] = $fields['company_name'];
        $fields['company_id'] = 0;
        $fields['company_type'] = $fields['company_type'];
        $fields['status'] = 0;
        return $this->lead->addLead($fields);
    }




}

