<?php
include_once ROOT_DIR . "component/representation/model/Representation.php";
include_once ROOT_DIR . 'component/company/model/company.controller.php';

class RepresentationController
{
    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';

    }


    function template($list = [], $msg ='')
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

       /* $representations = Representation::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();*/

   /*     if ($representations['export']['recordsCount'] <= 0) {
            redirectPage(RELA_DIR . '404');
        }*/
        $companyObject = new companyController();

        // get company
        $id = $company_id;

        $export['side']= $companyObject->sidebarMenu($id);
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('نمایندگی و شعب');
        $export['breadcrumb'] = $breadcrumb->trail();
       // $export['representations'] = $representations['export']['list'];
        $company = company::find($company_id);
        $export['seo'] = array(
            'title' => 'نمایندگی و شعب شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );
        $this->fileName = 'representation.showAll.php';
        $this->template($export);
        die();
    }
}
