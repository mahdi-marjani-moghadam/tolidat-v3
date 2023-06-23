<?php


include_once ROOT_DIR . 'component/honour/member/model/honour.model.php';
include_once ROOT_DIR . 'component/company/model/company.controller.php';


class HonourController
{

    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';

    }


    function template($list = [],$msg = '')
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

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }

        $companyObject = new companyController();

        // get company
        $id = $company_id;

        $export['side']= $companyObject->sidebarMenu($id);

        $honours = c_honour::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();

        if ($honours['export']['recordsCount'] <= 0) {
            redirectPage(RELA_DIR . '404');
        }

        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('افتخارات');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['honours'] = $honours['export']['list'];

        $company = company::find($company_id);
        $export['msg'] = 'در این صفحه افتخارات کمپانی ' . $company->company_name . ' قابل مشاهده است';
        $export['seo'] = array(
            'title' => 'افتخارات شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => empty($company->description) ? $export['msg'] :minimizeText($company->description, 500, '...'),
        );
        $this->fileName = 'honour.showAll.php';
        $this->template($export);
        die();
    }


}
