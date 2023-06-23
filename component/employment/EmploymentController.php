<?php

include_once ROOT_DIR . 'component/employment/model/Employment.php';
include_once ROOT_DIR . 'component/company/model/company.controller.php';

/**
 * Created by PhpStorm.
 * User: Shabihi
 * Date: 11/6/2017
 * Time: 11:25 AM
 */
class  EmploymentController
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

        $export['side'] = $companyObject->sidebarMenu($id);
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('فرصت های شغلی');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['employments'] = $employments['export']['list'];
        $company = company::find($company_id);
        $export['seo'] = array(
            'title' => 'فرصت های شغلی شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );

        $this->fileName = 'employment.showAll.php';
        $this->template($export);
        die();
    }

    public function show($employment_id)
    {
        $employment = Employment::getAll()
            ->leftJoin('graduate', 'c_employment.graduate_id', '=', 'graduate.Graduate_id')
            ->where('Employment_id', '=', $employment_id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();
        if ($employment['export']['recordsCount'] <= 0) {
            redirectPage(RELA_DIR . '404');
        }
        $companyObject = new companyController();
        $company = company::find($employment['export']['list']['0']['company_id']);

        $export['side'] = $companyObject->sidebarMenu($company->Company_id);

        $export['seo'] = array(
            'title' => $employment['export']['list']['0']['title'] . '- ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );

        $this->fileName = "employment.showDetail.php";
        $export['employment'] = $employment['export']['list']['0'];
        $this->template($export);
        die();
    }
}
