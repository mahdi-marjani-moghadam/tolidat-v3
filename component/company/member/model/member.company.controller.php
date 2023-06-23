<?php
include_once dirname(__FILE__) . '/member.company.model.php';
include_once ROOT_DIR . '/component/register/model/register.model.php';

/**
 * Created by PhpStorm.
 * User: daba
 * Date: 11/29/2016
 * Time: 2:35 PM
 */
class memberCompanyController
{
    public function getCompanyDraftById($company_id)
    {
        $companyObject = company_d::getBy_company_id_and_isActive($company_id, 1)->first();
        if (is_object($companyObject)) {
            return $companyObject;
        }
        return null;
    }
    public static function getCompanyById($company_id)
    {
        $companyObject = company::getBy_Company_id($company_id)->first();
        if (is_object($companyObject)) {
            return $companyObject;
        }
        return null;
    }

    public function setRefreshDate($company_id)
    {
        $company = company::find($company_id);
        $company->refresh_date = (strftime('%Y-%m-%d  %H:%M:%S', time()));
        $result = $company->save();
        return $result;
    }
}
