<?php
include_once ROOT_DIR . "component/crm/model/LetterActions.php";
include_once ROOT_DIR . "component/crm/model/Letter_Action.php";

class LetterActionService
{
    public function getLetterActions()
    {
        return LetterActions::getAll()
            ->where('status', '=', 1)
            ->getList()['export']['list'];
    }

    public function getAllLetterActions()
    {
        return LetterActions::getAll()->getList()['export']['list'];
    }

    public function getActionById($action_id)
    {
        $action = LetterActions::find($action_id);

        if (is_object($action)) {

            return $action->fields;
        }

        return null;
    }

    public function getActionsByLetterId($letter_id)
    {
        return LetterActions::getAll()
            ->leftJoin('letter_action', 'letter_actions.letter_action_id', '=', 'letter_action.action_id')
            ->where('letter_action.letter_id', '=', $letter_id)
            ->getList()['export']['list'];
    }

    public function add($fields)
    {
        $action = new LetterActions();
        $action->setFields($fields);
        $action->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $action->status = 1;
        $result = $action->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function update($fields)
    {
        $action = LetterActions::find($fields['letter_action_id']);
        $action->setFields($fields);
        $action->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $result = $action->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function disable($action_id)
    {
        $action = LetterActions::find($action_id);

        if (!is_object($action)) {
            return false;
        }

        $action->status = $action->status == 1 ? 0 : 1;
        $result = $action->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }
}