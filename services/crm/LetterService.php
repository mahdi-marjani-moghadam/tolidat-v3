<?php
include_once ROOT_DIR . "component/crm/model/Letters.php";
include_once ROOT_DIR . "component/crm/model/Letter_Action.php";

class LetterService
{

    public function getLetters()
    {
        return Letters::getAll()
            ->where('status', '=', 1)
            ->getList()['export']['list'];
    }

    public function getAllLetters()
    {
        return Letters::getAll()->getList()['export']['list'];
    }

    public function getLetterById($letter_id)
    {
        return Letters::find($letter_id);
    }

    public function actions($letter)
    {
        return $letter->actions();
    }

    public function add($fields)
    {
        $letter = new Letters();
        $letter->type = $fields['type'];
        $letter->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $letter->status = 1;
        $result = $letter->save();

        if ($result['result'] == -1) {
            return false;
        }

        $result = $this->attach($letter->letter_id, $fields['letter_action']);

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function update($fields)
    {
        $letter = $this->getLetterById($fields['letter_id']);
        $this->detach($letter->letter_id);
        $this->attach($letter->letter_id, $fields['letter_action']);

        $letter->setFields($fields);
        $letter->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $result = $letter->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function disable($letter_id)
    {
        $letter = $this->getLetterById($letter_id);

        if (!is_object($letter)) {
            return false;
        }

        $letter->status = $letter->status == 1 ? 0 : 1;
        $result = $letter->save();

        if ($result['result'] == -1) {
            return false;
        }

        return true;
    }

    public function attach($letter_id, $action_ids)
    {
        $sql = "INSERT INTO letter_action (`letter_action_id`, `letter_id`, `action_id`) VALUES ";

        foreach ($action_ids as $action_id) {
            $sql .= "(NULL," .$letter_id. "," .$action_id. "),";
        }
        $sql = substr($sql, 0, -1);

        $result = Letter_Action::query($sql)->get();

        return $result;
    }

    public function detach($letter_id)
    {
        $sql = "DELETE FROM letter_action WHERE letter_id=" . $letter_id;

        $result = Letter_Action::query($sql)->get();

        return $result;
    }

}