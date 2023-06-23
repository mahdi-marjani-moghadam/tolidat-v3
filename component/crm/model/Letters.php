<?php
include_once ROOT_DIR . "component/crm/model/Letter_Action.php";

class Letters extends looeic
{
    public $TABLE_NAME = 'letters';

    public function actions()
    {
        $actions = Letter_Action::getAll()
//            ->leftJoin('letter_actions', 'letter_actions.letter_action_id', '=', 'letter_action.action_id')
            ->where('letter_id', '=', $this->letter_id)
            ->getList();

        return $actions['export']['list'];
    }
}