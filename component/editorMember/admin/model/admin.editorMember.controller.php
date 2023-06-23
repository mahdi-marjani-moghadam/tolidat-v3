<?php
include_once(dirname(__FILE__) . "/admin.editorMember.model.php");
include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");

/**
 * Class advertiseController
 */
class adminEditorMemberController
{


    public function addMember($input)
    {
        
        $editorObject = new adminEditorMemberModel();
        $editorObject->setFields($input);

        $result = $editorObject->save();

        return $result;
    }

    public function getMemberInformationById($company_d_id)
    {
        $result = '';
        $result = adminEditorMemberModel::getBy_company_d_id($company_d_id)->first();
        return $result;
    }

    public function getMemberInformationByCompanyId($company_id)
    {
        $result = '';
        $result = admincompany_dModel::getBy_company_id_and_status_and_isActive($company_id, 1, 1)->first();
        $result = adminEditorMemberModel::getBy_company_d_id($result->Company_d_id)->first();
        if (!(is_object($result))) {
            return 0;
        }
        return $result;
    }

    public function deleteAllEditorMemebrByCompanyId($company_id)
    {
        $company_ds = admincompany_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($company_ds['export']['recordsCount'] > 0) {
            foreach ($company_ds['export']['list'] as $company_d) {
                $company_d_id[] = $company_d->Company_d_id;
            }
        }
        //delete from main table
        $editors = adminEditorMemberModel::getAll()
            ->where('company_d_id', 'in', $company_d_id)
            ->get();

        if ($editors['export']['recordsCount'] > 0) {
            foreach ($editors['export']['list'] as $editor) {
                $editor->delete();
            }
        }

        return;

    }
}
