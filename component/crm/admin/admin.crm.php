<?php
ini_set('display_errors', 1);

include_once dirname(__FILE__) . '/AdminCrmController.php';
include_once dirname(__FILE__) . '/AdminActionController.php';
include_once dirname(__FILE__) . '/AdminLetterController.php';
include_once dirname(__FILE__) . '/AdminLetterLogController.php';
include_once dirname(__FILE__) . '/AdminTaskController.php';
include_once dirname(__FILE__) . '/AdminLeadTaskController.php';
include_once dirname(__FILE__) . '/AdminLeadController.php';
include_once ROOT_DIR . "services/crm/LetterService.php";
include_once ROOT_DIR . "services/crm/LetterActionService.php";
include_once ROOT_DIR . "services/crm/LetterLogService.php";
include_once ROOT_DIR . "services/crm/LetterTaskService.php";
include_once ROOT_DIR . "services/crm/LeadTaskService.php";
include_once ROOT_DIR . "services/crm/LeadService.php";

global $admin_info, $PARAM;

$controller = new AdminCrmController(
    new LetterService(),
    new LetterActionService(),
    new LetterLogService(),
    new LetterTaskService()
);

$logController = new AdminLetterLogController(
    new LetterService(),
    new LetterActionService(),
    new LetterLogService(),
    new LetterTaskService()
);

$actionController = new AdminActionController(new LetterActionService());

$letterController = new AdminLetterController(new LetterService(), new LetterActionService());

$taskController = new AdminTaskController(new LetterTaskService());

$leadTaskController = new AdminLeadTaskController(new LeadTaskService());

$leadController = new AdminLeadController(new LeadService(), new LeadTaskService());


if (isset($exportType)) {
    $controller->exportType = $exportType;
}
switch ($_GET['action']) {

    case 'companies' :
        $controller->showListCompany($_GET);
        break;

    case 'filterCompany' :
        $controller->filterCompany($_GET);
        break;
}

// Log Route

switch ($_GET['action']) {

    case 'logs' :
        if (!empty($_POST)) {
            $_POST['admin_id'] = $admin_info['admin_id'];
            $logController->store($_POST);
        } else {
            $logController->show($_GET);
        }
        break;

    case 'allLogs' :
        checkPermissions('allLogs', 'crm');
        $logController->index();
        break;

    case 'allLogByAdmin' :
        $logController->indexByAdmin($admin_info['admin_id']);
        break;

    case 'filterLog' :
        $logController->filterLog($_GET);
        break;
}

// Task Route

switch ($_GET['action']) {

    case 'tasks' :
        checkPermissions('tasks', 'crm');
        $taskController->index();
        break;

    case 'task' :
        $taskController->show($admin_info['admin_id']);
        break;

    case 'filterTask' :
        $taskController->filterTask($_GET);
        break;
}

//  Action Route

switch ($_GET['action']) {

    case 'getActionById' :
        $actionController->getActionById($_GET['action_id']);
        break;

    case 'getActionsByLetterId' :
        $actionController->getActionsByLetterId($_POST['letter_id']);
        break;

    case 'actions' :
        $actionController->index();
        break;

    case 'addAction' :
        if (!empty($_POST)) {
            $actionController->store($_POST);
        } else {
            $actionController->create();
        }
        break;

    case 'editAction' :
        if (!empty($_POST)) {
            $actionController->update($_POST);
        } else {
            $actionController->edit($_GET['action_id']);
        }
        break;

    case 'disableAction' :
        $actionController->destroy($_GET['action_id']);
        break;
}

//  Letter Route

switch ($_GET['action']) {

    case 'letters' :
        $letterController->index();
        break;

    case 'addLetter' :
        if (!empty($_POST)) {
            $letterController->store($_POST);
        } else {
            $letterController->create();
        }
        break;

    case 'editLetter' :
        if (!empty($_POST)) {
            $letterController->update($_POST);
        } else {
            $letterController->edit($_GET['letter_id']);
        }
        break;

    case 'disableLetter' :
        $letterController->destroy($_GET['letter_id']);
        break;
}

// Lead Routes

switch ($_GET['action']) {

    case 'filterLead' :
        $leadController->filterLead($_GET);
        break;

    case 'leads' :
        if (!empty($_POST)) {
            $leadController->store($_POST);
        } else {
            $leadController->index();
        }
        break;

    case 'editLead' :
        if (!empty($_POST)) {
            $_POST['lead_id'] = $_GET['lead_id'];
            $leadController->update($_POST);
        } else {
            $leadController->edit($_GET['lead_id']);
        }
        break;

    case 'filterLeadComment' :
        $leadController->filterLeadComment($_GET);
        break;

    case 'leadComments' :
        if (!empty($_POST)) {
            $_POST['lead_id'] = $_GET['lead_id'];
            $_POST['task_id'] = $_GET['task_id'];
            $leadController->storeComment($_POST);
        } else if (isset($_GET['task_id'])){
            $leadController->indexCommentTask($_GET['lead_id'], $_GET['task_id']);
        } else {
            $leadController->indexComment($_GET['lead_id']);
        }
        break;

    case 'moveLead' :
        $leadController->moveLead($_GET);
        break;
}

// Lead Task Route
switch ($_GET['action']) {

    case 'leadTasks' :
        checkPermissions('tasks', 'crm');
        $leadTaskController->index();
        break;

    case 'leadTask' :
        $leadTaskController->show($admin_info['admin_id']);
        break;

    case 'filterLeadTask' :
        $leadTaskController->filterTask($_GET);
        break;
}


