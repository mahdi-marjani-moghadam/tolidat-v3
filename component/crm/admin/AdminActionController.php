<?php


class AdminActionController
{
    public $exportType = 'html';

    public $fileName;

    protected $letterAction;

    /**
     * AdminActionController constructor.
     * @param $letterAction
     */
    public function __construct(LetterActionService $letterAction)
    {
        $this->letterAction = $letterAction;
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

    public function getActionById($action_id)
    {
        $action = $this->letterAction->getActionById($action_id);

        echo json_encode($action);
        die();
    }

    public function getActionsByLetterId($letter_id)
    {
        $action = $this->letterAction->getActionsByLetterId($letter_id);

        echo json_encode($action);
        die();
    }

    public function index()
    {
        $actions = $this->letterAction->getAllLetterActions();

        $this->fileName = "admin.crm.actionShowList.php";
        $this->template($actions);
        die();
    }

    public function create()
    {
        $this->fileName = "admin.crm.actionAddForm.php";
        $this->template();
        die();
    }

    public function store($fields)
    {
        if ($this->letterAction->add($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=actions', 'اکشن افزوده شد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=addAction', 'افزودن اکشن با مشکل روبرو شد');
        die();
    }

    public function edit($action_id)
    {
        $action = $this->letterAction->getActionById($action_id);

        $this->fileName = "admin.crm.actionEditForm.php";
        $this->template($action);
        die();
    }

    public function update($fields)
    {
        if ($this->letterAction->update($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=actions', 'اکشن ویرایش شد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=editAction&action_id=' . $fields['letter_action_id'], 'افزودن اکشن با مشکل روبرو شد');
        die();
    }

    public function destroy($action_id)
    {
        if ($this->letterAction->disable($action_id)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=actions', 'وضعیت اکشن تغییر کرد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=actions', 'وضعیت اکشن تغییر نکرد');
        die();
    }
}