<?php

require_once ROOT_DIR . "component/company/member/model/member.company.model.php";

class ShortLinkController
{
    public $exportType;
    public $fileName = 'html';

    public function __construct()
    {
        $this->fileName = 'html';
    }

    public function template($message = '')
    {
        include ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php";
        include ROOT_DIR . "templates/" . CURRENT_SKIN . "/{$this->fileName}.php";
        include ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php";
    }

    /**
     * To Show The Main Page For Short Link
     */
    public function Index()
    {
        $this->fileName = 'shortLink';
        $this->template();
    }

    /**
     * Get a company_id and if the Company get found then
     * he redirect the user to the edit wiki page
     *
     * @param $companyId
     */
    public function directToCompanyWiki($companyId)
    {
        $company = company::find($companyId);

        if (! is_object($company)) {
            redirectPage(RELA_DIR, "There is no such company");
        }

        if ($company->package_status == 1) {
            // .../company/Detail/1/اذین/#/id=73738383636373
            $url = RELA_DIR . "company/Detail/{$company->Company_id}/{$company->company_name}/#/id=73738383636373";
            echo "<script>
                 window.open('{$url}', '_newtab');
             </script>";

            redirectPage(RELA_DIR . "shortLink");
        } else {
            $message = 'این کمپانی پولی میباشد و کمپانی های پولی قابل ویکی شدن نمی باشند.';
            $this->fileName = 'shortLink';
            $this->template($message);
        }

    }

}