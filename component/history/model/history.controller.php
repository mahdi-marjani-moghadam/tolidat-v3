<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once ROOT_DIR . 'component/history/member/model/history.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

include_once ROOT_DIR . 'component/company/model/company.controller.php';

/**
 * Class registerController.
 */
class historyController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
     * @var
     */
    public $fileName;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     */
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
    public function showAllHistory($company_id)
    {
        $company = company::find($company_id);
        $companyObject =new companyController();
        $id = $company_id;

        $export['side']= $companyObject->sidebarMenu($id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }

       /* $histories = c_history::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();*/
        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('سوابق و مشتریان ما');
        $export['breadcrumb'] = $breadcrumb->trail();
        //$export['histories'] = $histories['export']['list'];

        $company = company::find($company_id);
        $export['msg'] = 'در این صفحه سوابق و مشتریان کمپانی ' . $company->company_name . ' قابل مشاهده است';
        $export['seo'] = array(
            'title' => 'سوابق و مشتریان شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => empty($company->description) ? $export['msg'] :minimizeText($company->description, 500, '...'),
        );
        $this->fileName = "history.showAll.php";
        $this->template($export);
        die();
    }

}

