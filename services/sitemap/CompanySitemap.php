<?php
include_once ROOT_DIR . "component/company/member/model/member.company.model.php";
include_once "Xml.php";
include_once "Html.php";

class CompanySitemap
{
    public static function buildXml()
    {
        $allCompany = company::getAll();
        
        $companies = $allCompany->get();
        $companyUrl = '';
        $xml = new Xml();
        foreach ($companies['export']['list'] as $company) {
            $loc = $xml->getDomin() . "/company/Detail/" . $company->Company_id . "/" . cleanUrl($company->company_name);
            $xml->setLoc($loc);
            list($date, $time) = explode(" ", $company->refresh_date);
            $xml->setLastmod($date, $time);
            $companyUrl .= $xml->xmlElement();
        }

        return $companyUrl;
    }

    public static function buildHtml()
    {
        $companies = company::getAll()->get();

        $companyUrl = '';
        $html = new Html();
        foreach ($companies['export']['list'] as $company) {
            $href = $html->getDomin() . "/company/Detail/" . $company->Company_id . "/" . cleanUrl($company->company_name);
            $html->setHref($href);
            $html->setLink($company->company_name);
            $companyUrl .= $html->htmlElement();
        }

        return $companyUrl;
    }

}
