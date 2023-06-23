<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */

include_once ROOT_DIR . 'component/company/model/company.controller.php';
/**
 * Class registerController.
 */
class companyNewsController
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

    public function index($company_id)
    {
        $id= $company_id;
        $companyObject = new companyController();
        $export['side']=$companyObject->sidebarMenu($id);
        $company = company::find($company_id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }

        /*$news = c_news::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();*/

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('اخبار و رویدادها');
        $export['breadcrumb'] = $breadcrumb->trail();
        //$export['news'] = $news['export']['list'];

        $company = company::find($company_id);
        $export['seo'] = array(
            'title' => 'اخبار و رویدادهای شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );
        $this->fileName = "news.showAll.php";
        $this->template($export);
        die();
    }

    public function show($news_id)
    {
        include_once ROOT_DIR . 'component/companyNews/member/model/companyNews.model.php';
        $news = News::find($news_id);

        $id= $news->company_id;
        $companyObject = new companyController();
        $export['side']=$companyObject->sidebarMenu($id);
        $company = company::find($company_id);


        
    
        
        if (!is_object($news)) {
            redirectPage(RELA_DIR . '404');
        }

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->fields['Company_id'] . '/' . cleanUrl($company->fields['company_name']), true);
        $breadcrumb->add('خبر : ');
        $breadcrumb->add($news->title);
        $export['breadcrumb'] = $breadcrumb->trail();
        $export['list'] = $news->fields;

        $this->fileName = "news.showMore.php";
        $this->template($export);
        die();
    }
}
