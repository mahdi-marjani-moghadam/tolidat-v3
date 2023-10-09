<?php

/**
 * Class advertiseController
 */
class adminMemberController extends looeic
{


    public function getMemberInformationByCompanyId($company_id)
    {
        return adminMemberModel::getBy_company_id($company_id)->first();
    }

}
