<?php
include_once ROOT_DIR . 'component/company/admin/model/admin.companyDraft.model.php';
include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.model.php';
require_once ROOT_DIR . "component/category/member/model/member.category.model.php";
include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.model.php';
include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddressesDraft.model.php';
include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhonesDraft.model.php';
require_once ROOT_DIR . "component/companyBanner/admin/model/admin.companyBannerDraft.model.php";
require_once ROOT_DIR . "component/companyLogo/admin/model/admin.companyLogoDraft.model.php";

/*require_once ROOT_DIR . "component/companyWebsites/admin/model/admin.companyWebsitesDraft.model.php";
require_once ROOT_DIR . "component/businessLicence/admin/model/admin.businessLicenceDraft.model.php";
require_once ROOT_DIR . "component/companyCommercialName/admin/model/admin.companyCommercialNameDraft.model.php";
require_once ROOT_DIR . "component/companyEmails/admin/model/admin.companyEmailsDraft.model.php";
require_once ROOT_DIR . "component/history/admin/model/admin.historyDraft.model.php";
require_once ROOT_DIR . "component/companyNews/admin/model/admin.companyNewsDraft.model.php";
require_once ROOT_DIR . "component/product/admin/model/admin.productDraft.model.php";
require_once ROOT_DIR . "component/companySocials/admin/model/admin.companySocialsDraft.model.php";*/


class Compare
{
    public function compareRealAndDraft($company_id)
    {
        $companyList = $this->getData($company_id);
        $path = ROOT_DIR . 'templates/admin/compareCompanyEmailTemplate.php';
        $contacts = [
            'email' => 'm.malekloo@dabacenter.ir',
            'subject' => 'مقایسه اطلاعات',
            'body' => ['path' => $path,
                'data' => compact('companyList')
            ]
        ];
        return EmailEngineController::forceSend($contacts);
    }

    public function getData($company_id)
    {
        $realCompany = $this->getRealOrDraftCompanyInformation($company_id, 1, 1);
        $draftCompany = $this->getRealOrDraftCompanyInformation($company_id, 1, 0);
        
        $companyList['realCompany'] = $realCompany;
        $companyList['draftCompany'] = $draftCompany;

        return $companyList;
    }

    /**
     * @param $companyId
     * @param $status
     * @param $isActive
     * @return array
     */
    public function getRealOrDraftCompanyInformation($companyId, $status, $isActive)
    {
        $company['company'] = $this->getRealOrDraftCompany($companyId, $status, $isActive);
        $company['personality_type'] = $this->getRealOrDraftCompanyPersonalityType($companyId, $status, $isActive);
        $company['editor'] = $this->getRealOrDraftEditorName($companyId, $status, $isActive);
        $company['category'] = $this->getRealOrDraftCategory($company['company']);
        $company['addresses'] = $this->getRealOrDraftCompanyAddress($companyId, $status, $isActive);
        $company['banner'] = $this->getRealOrDraftCompanyBanner($companyId, $status, $isActive);
        $company['phones'] = $this->getRealOrDraftCompanyPhones($companyId, $status, $isActive);
        $company['logo'] = $this->getRealOrDraftCompanyLogo($companyId, $status, $isActive);
        $company['city'] = $this->getRealOrDraftCompanyCities($companyId, $status, $isActive);
        $company['licence'] = $this->getRealOrDraftCompanyLicence($company['company'], $isActive);
//        $company['honour'] = $this->getRealOrDraftCompanyHonour($companyId, $status, $isActive);
//        $company['webSites'] = $this->getRealOrDraftCompanyWebSites($companyId, $status, $isActive);
//        $company['businessLicence'] = $this->getRealOrDraftCompanyBusinessLicence($companyId, $status, $isActive);
//        $company['commercialName'] = $this->getRealOrDraftCompanyCommercialName($companyId, $status, $isActive);
//        $company['emails'] = $this->getRealOrDraftCompanyEmails($companyId, $status, $isActive);
//        $company['history'] = $this->getRealOrDraftCompanyHistory($companyId, $status, $isActive);
//        $company['news'] = $this->getRealOrDraftCompanyNews($companyId, $status, $isActive);
//        $company['products'] = $this->getRealOrDraftCompanyProducts($companyId, $status, $isActive);
//        $company['socials'] = $this->getRealOrDraftCompanySocials($companyId, $status, $isActive);

        return $company;
    }

    private function getRealOrDraftCompany($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();
            
        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyPersonalityType($companyId, $status, $isActive)
    {
        $company = adminpersonality_typeModel::getAll()
            ->select('personality_type.type')
            ->leftJoin('company_d', 'company_d.personality_type', '=', 'personality_type.Personality_type_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return array('type' => "حقیقی");
        } else {
            return $company['export']['list'][0];
        }
    }

    public function getRealOrDraftCategory($company)
    {
        $categories = tagToArray($company['category_id'])['export']['list'];

        foreach ($categories as $category) {
            $cate = category::find($category);
            $categoriesTitle[] = $cate->title;
        }
        return implode(',', $categoriesTitle);
    }

    public function getRealOrDraftEditorName($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->leftJoin('admin', 'company_d.editor_id', '=', 'admin.admin_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return false;
        } else {
            return $company['export']['list'][0];
        }
    }

    private function getRealOrDraftCompanyAddress($companyId, $status, $isActive)
    {
        $company = adminc_addresses_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->where('isMain', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyBanner($companyId, $status, $isActive)
    {
        $company = adminc_banner_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyPhones($companyId, $status, $isActive)
    {
        $company = adminc_phones_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->where('isMain', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyLogo($companyId, $status, $isActive)
    {
        $company = adminc_logo_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyCities($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->select('city.name as city', 'province.name as state')
            ->leftJoin('city', 'company_d.city_id', '=', 'city.City_id')
            ->leftJoin('province', 'company_d.state_id', '=', 'province.Province_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return false;
        } else {
            return $company['export']['list'][0];
        }
    }

    public function getRealOrDraftCompanyLicence($company, $isActive)
    {
        include_once ROOT_DIR . "component/licence/member/model/licence.model.php";

        if ($company['company_type'] == 2 & $isActive == 1) {
            $licence = c_licences::getAll()
                ->leftJoin('licence_list', 'licence_list.Licence_list_id', '=', 'c_licences.licence_type')
                ->where('c_licences.company_id', '=', $company['company_id'])
                ->where('c_licences.status', '=', 2)
                ->where('c_licences.isMain', '=', 1)
                ->where('c_licences.isAdmin', '=', 1)
                ->select('c_licences.*', 'licence_list.name as licence_type')
                ->getList();
        }

        if ($company['company_type'] == 2 & $isActive == 0) {
            $licence = c_licences::getAll()
                ->leftJoin('licence_list', 'c_licences.licence_type', '=', 'licence_list.Licence_list_id')
                ->where('c_licences.company_id', '=', $company['company_id'])
                ->where('c_licences.status', '=', 1)
                ->where('c_licences.isMain', '=', 1)
                ->where('c_licences.isAdmin', '=', 1)
                ->orderBy('company_id', 'DESC')
                ->select('c_licences.*', 'licence_list.name as licence_type')
                ->getList();
        }

        if ($licence['export']['recordsCount'] > 0) {
            return $licence['export']['list'][0];
        }

        return null;
    }

    private function getRealOrDraftCompanyHonour($companyId, $status, $isActive)
    {
        $company = adminc_honour_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyWebSites($companyId, $status, $isActive)
    {
        $company = adminc_websites_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyBusinessLicence($companyId, $status, $isActive)
    {
        $company = adminc_business_licence_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyCommercialName($companyId, $status, $isActive)
    {
        $company = adminc_commercial_name_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyEmails($companyId, $status, $isActive)
    {
        $company = adminc_emails_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyHistory($companyId, $status, $isActive)
    {
        $company = adminc_history_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyNews($companyId, $status, $isActive)
    {
        $company = adminc_news_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyProducts($companyId, $status, $isActive)
    {
        $company = adminc_product_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanySocials($companyId, $status, $isActive)
    {
        $company = adminc_socials_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy('company_id', 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }
}
