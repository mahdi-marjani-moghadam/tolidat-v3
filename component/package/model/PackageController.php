<?php

include_once ROOT_DIR . 'component/package/member/model/package.model.php';
include_once ROOT_DIR . 'component/packageUsage/member/model/member.packageUsage.model.php';

class PackageController
{
    public $exportType;
    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
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

    public static function getAllPackages()
    {
        $packageList = package::getAll()->getList();
        return $packageList['export']['list'];
    }

    public function showAll()
    {

        $package = new package();
        $result['packages'] = $package->getValidPackageList();
        $result['extra_packages'] = $package->getExtraPackage();
        $result['seo']['title'] = 'لیست پکیج ها | تولیدات';
        $this->fileName = 'packageList.php';
        $this->template($result);
        die();
    }

    public function showList()
    {
        global $company_info;
        if (packageusage::packageUsageExist($company_info['company_id'])) {
            redirectPage(RELA_DIR . "profile");
        }

        $package = new package();
        $result['packages'] = $package->getValidPackageList($this->company_info['company_id']);
        $result['extra_packages'] = $package->getExtraPackage();

        $this->fileName = 'pricelistpage.php';
        $this->template($result);
        die();
    }


    public function getPackageType($company_id)
    {
        $model = new package();
        return $model->getCompanyPackage($company_id);
    }
}
