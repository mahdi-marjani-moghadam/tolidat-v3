<?php
/**
 * Created by PhpStorm.
 * User: marjani
 * Date: 4/03/2016
 * Time: 4:24 PM
 */

require_once ROOT_DIR . "component/company/admin/model/admin.companyDraft.model.php";
include_once ROOT_DIR . 'component/company/member/model/member.company.model.php';
require_once ROOT_DIR . "component/company/admin/model/admin.company.model.php";
require_once ROOT_DIR . "component/product/admin/model/admin.product.model.php";
include_once ROOT_DIR . "component/article/admin/model/Article.php";
include_once dirname(__FILE__) . "/admin.index.model.php";
include_once ROOT_DIR . "component/news/admin/model/News.php";

class adminIndexController
{
    public $exportType = 'html';
    public $fileName;
    public $companyModel;

    public function __construct()
    {
        $this->companyModel = new admincompanyModel();
    }

    function template($list = [], $msg='')
    {
        switch ($this->exportType) {
            case 'html':

                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php";
                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php";
                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php";
                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php";
                include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php";
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

    public function showList()
    {

        global $admin_info;

        $export['company_count']                = $this->companyModel->countCompanies();
        $export['lockedCompanies_count']        = $this->getLockedCompaniesNumber();
        $export['wikiCompanies_count']          = $this->getWikiCompaniesNumber();
        $export['noneFreeCompanies_count']      = $this->getnoneFreeCompaniesNumber();
        $export['NewRegisteredCompanies_count'] = $this->NewRegisteredCompaniesNumber();
        $export['products_count']               = $this->getProductsNumber();
        $export['article_count']                = $this->getAllArticles();
        $export['news_count']                   = $this->getAllNews();
        $export['admin_name']                   = $admin_info['name'] . ' ' . $admin_info['family'];

        $this->fileName = 'admin.index.php';
        $this->template($export);
        die();
    }

    /**
     * Get and returns the Locked Companies count
     * from the admin company controller.
     *
     * @return int
     */
    private function getLockedCompaniesNumber()
    {
        $list = $this->companyModel->getLockedCompanies();
        return count($list);
    }

    /**
     * Get and returns the Wiki Companies count
     * from the admin company controller.
     *
     * @return int
     */
    private function getWikiCompaniesNumber()
    {
        $list = admincompany_dModel::getWikiCompanies();
        return count($list);
    }

    /**
     * Get and returns the None Free Companies count
     * from the admin company controller.
     *
     * @return int
     */
    private function getNoneFreeCompaniesNumber()
    {
        $list = $this->companyModel->getNoneFreeCompanies();
        return count($list);
    }

    /**
     * Get and returns the New Registered Companies count
     * from the admin company controller.
     *
     * @return int
     */
    private function NewRegisteredCompaniesNumber()
    {
        $list = $this->companyModel->getNewRegisteredCompanies();
        return count($list);
    }

    private function getProductsNumber()
    {
        $products = adminc_productModel::getAll()->getList();

        return count($products['export']['list']);
    }

    private function getAllArticles()
    {
        $article = Article::getAll()->getList();

        return count($article['export']['list']);
    }

    private function getAllNews()
    {
        $article = News::getAll()->getList();

        return count($article['export']['list']);
    }

}
