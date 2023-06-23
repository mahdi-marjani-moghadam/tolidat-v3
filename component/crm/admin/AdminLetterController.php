<?php

class AdminLetterController
{
    public $exportType = 'html';

    public $fileName;

    protected $letter;

    protected $letterAction;

    /**
     * AdminActionController constructor.
     * @param $letter
     * @param $letterAction
     */
    public function __construct(LetterService $letter, LetterActionService $letterAction)
    {
        $this->letter = $letter;
        $this->letterAction = $letterAction;
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
        $letters = $this->letter->getAllLetters();

        $this->fileName = "admin.crm.letterShowList.php";
        $this->template($letters);
        die();
    }

    public function create()
    {
        $export['actions'] = $this->letterAction->getLetterActions();

        $this->fileName = "admin.crm.letterAddForm.php";
        $this->template($export);
        die();
    }

    public function store($fields)
    {
        if ($this->letter->add($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=letters', 'نامه افزوده شد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=addLetter', 'افزودن نامه با مشکل روبرو شد');
        die();
    }

    public function edit($letter_id)
    {
        $letter = $this->letter->getLetterById($letter_id);
        $export['letter'] = $letter->fields;
        $export['actions'] = $this->letterAction->getLetterActions();
        $export['letter_action'] = $this->letter->actions($letter);

        $this->fileName = "admin.crm.letterEditForm.php";
        $this->template($export);
        die();
    }

    public function update($fields)
    {
        if ($this->letter->update($fields)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=letters', 'نامه ویرایش شد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=editAction&letter_id=' . $fields['letter_id'], 'افزودن نامه با مشکل روبرو شد');
        die();
    }

    public function destroy($letter_id)
    {
        if ($this->letter->disable($letter_id)) {
            redirectPage(RELA_DIR . 'admin/?component=crm&action=letters', 'وضعیت نامه تغییر کرد');
            die();
        }

        redirectPage(RELA_DIR . 'admin/?component=crm&action=letters', 'وضعیت نامه تغییر نکرد');
        die();
    }
}