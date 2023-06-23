<?php
include_once ROOT_DIR . "component/companyContacts/admin/model/admin.companyContactUs.model.php";

class adminContactsController {

    public function deleteAllContactByCompanyId($company_id)
    {
        //delete from main table
        $contacts = adminc_contactsModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($contacts['export']['recordsCount'] > 0) {
            foreach ($contacts['export']['list'] as $contact) {
                $contact->delete();
            }
        }

        return;
    }
}
