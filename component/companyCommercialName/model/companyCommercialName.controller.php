<?php


include_once ROOT_DIR . 'component/companyCommercialName/model/companyCommercialName.model.php';
include_once ROOT_DIR . 'component/company/model/company.controller.php';


class commercialNameController
{

    public $exportType;

    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';

    }

    function template($list = [], $msg = '')
    {
        global $messageStack;

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

    public function index($company_id)
    {
        $company = company::find($company_id);
        $companyObject =new companyController();
        $id = $company_id;

        $export['side']= $companyObject->sidebarMenu($id);


        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }

    /*    $commercialNames = CommercialName::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();*/
        

        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('نام تجاری');
        $export['breadcrumb'] = $breadcrumb->trail();
       // $export['commercialNames'] = $commercialNames['export']['list'];
        $company = company::find($company_id);
        $export['msg'] = 'در این صفحه نام تجاری کمپانی ' . $company->company_name . ' قابل مشاهده است';
        $export['seo'] = array(
            'title' => 'نام تجاری شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => empty($company->description) ? $export['msg'] :minimizeText($company->description, 500, '...'),
        );
        $this->fileName = 'commercialName.showAll.php';
        $this->template($export);
        die();
    }

}
