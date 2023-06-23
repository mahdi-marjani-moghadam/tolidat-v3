<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/certification.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/certification/model/certification.model.php';

/**
 * Class registerController.
 */
class certificationController
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
    public function template($list = [],$msg = '')
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

    public function showAllCertification($company_id)
    {
        $company = company::find($company_id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }

        $certifications = Certification::getAll()
            ->leftJoin('certification_list', 'certification_list.Certification_list_id', '=', 'c_certification.certification_list_id')
            ->where('company_id', '=', $company_id)
            ->getList();

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('گواهی ها');
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['certifications'] = $certifications['export']['list'];

        $company = company::find($company_id);
        $export['seo'] = array(
            'title' => 'گواهی های شرکت ' . $company->company_name . '- تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );

        $this->fileName = "certification.showAll.php";
        $this->template($export);
        die();
    }
}
