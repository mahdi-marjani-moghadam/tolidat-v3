<?php
include_once ROOT_DIR . "component/companyAdvertise/model/Advertise.php";
include_once ROOT_DIR . 'component/company/model/company.controller.php';

class AdvertiseController
{

    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     * articleController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * call template
     *
     * @param string $list
     * @param $msg
     * @return string
     */
    function template($list = [],$msg = '')
    {
        // global $conn, $lang;

        switch ($this->exportType) {
            case 'html':

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/title.inc.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/tail.inc.php");
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

        //print_r_debug($export['advertise_list']);
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('آگهی ها');
        $export['breadcrumb'] = $breadcrumb->trail();
        //$export['advertises'] = $licences['export']['list'];
        $export['seo'] = array(
            'title' => 'آگهی های شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );
//        print_r_debug($export['employment_list']);
        $this->fileName = 'advertise.showAll.php';
        $this->template($export);
        die();
    }

    public function show($advertise_id)
    {
        $advertise = c_advertise::getAll()
            ->where('Advertise_id', '=', $advertise_id)
            ->where('status', '=', 2)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();
        if ($advertise['export']['recordsCount'] <= 0) {
            redirectPage(RELA_DIR . '404');
        }
        $company = company::find($advertise['export']['list']['0']['company_id']);

        $companyObject = new companyController();
        $export['side'] = $companyObject->sidebarMenu($company->Company_id);

        $export['seo'] = array(
            'title' => $advertise['export']['list']['0']['title'] . '-' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );
        $this->fileName = "advertise.showDetail.php";
        $export['advertise'] = $advertise['export']['list']['0'];
        $this->template($export);
        die();
    }
}
