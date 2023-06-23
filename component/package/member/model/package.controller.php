<?php

include_once ROOT_DIR . "component/package/member/model/package.model.php";

class memberPackageController
{
    public $exportType;
    public $fileName;
    private $company_info;

    public function __construct()
    {
        global $company_info;

        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }

        $this->company_info = $company_info;
        $this->exportType = 'html';
    }

    public function template($list = [], $msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;
            default:
                break;
        }
    }

    public function showPackageList()
    {
        $packageUsage = packageusage::getAll()->where('company_id', '=', $this->company_info['company_id'])->first();
        if (!is_object($packageUsage)) {
            redirectPage(RELA_DIR . "profile");
        }

        $package = new package();
        $result['valid'] = $package->getValidPackageList($this->company_info['company_id']);
        $result['invalid'] = $package->getInvalidalidPackageList($this->company_info['company_id']);

        if (!$result) {
            redirectPage(RELA_DIR . "member/invoice/invoices", "شما آخرین پکیج را خریداری کرده اید");
        }

        $this->fileName = 'member.package.showList.php';
        $this->template($result);
        die();
    }
}
