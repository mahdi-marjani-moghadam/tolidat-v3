<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__) . "/admin.article.model.php");
include_once(ROOT_DIR . "/services/uploader/Uploader.php");

/**
 * Class articleController
 */
class adminArticleController
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
     *
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * @param string $list
     * @param $msg
     * @return string
     */
    function template($list = [], $msg = '')
    {
        // global $conn, $lang;

        switch ($this->exportType) {
            case 'html':

                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
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

    /**
     * @param $_input
     *
     */
    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->template($msg);
        }
        $article = new adminArticleModel();
        $result = $article->getArticleById($_input);

        if ($result['result'] != 1) {
            die();
        }

        $this->template($article->fields);
        die();
    }


    /**
     * @param $fields
     */
    public function showList($fields)
    {
        $article = new adminArticleModel();
        $fields['order']['Article_id']='DESC';
        $result = $article->getArticle($fields);
        // dd($result);
        foreach ($result['export']['list'] as $key => $value) {
            $result['export']['list'][$key]['image'] = RELA_DIR . 'statics/images/article/' . $value['image'];
            $result['export']['list'][$key]['description'] = readMore($value['description']);

        }
        if ($result['result'] != '1') {
            $this->fileName = 'admin.article.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $article->recordsCount;
        $this->fileName = 'admin.article.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showArticleAddForm($fields, $msg)
    {
        /////// category
        include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
        $category = new adminCategoryModel();

        $resultCategory = $category->getCategoryOption();
        if ($resultCategory['result'] == 1) {
            $fields = array();
            $fields['category'] = $resultCategory['export']['list'];
            // dd($fields['category']);
        }
        //echo "<pre>";print_r($resultCategory);die();
        ///////


        $CKEditor = CKEditor();
        $fields['description'] = $CKEditor->editor("description");


        $this->fileName = 'admin.article.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function addArticle($fields)
    {
        $article = new adminArticleModel();
        $result = $this->uploadImage($fields['companyLogo']);
        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . "admin/index.php?component=article", $result['msg']);
        }

        $fields['image'] = $result['image'];

        $result = $article->setFields($fields);
        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . "admin/index.php?component=article", $result['msg']);
        }
        $result = $article->add();

        if ($result['result'] != '1') {
            $this->showArticleAddForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showArticleEditForm($fields, $msg)
    {

        $article = new adminArticleModel();
        if (!validator::required($fields['Article_id']) and !validator::Numeric($fields['Article_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }
        $result = $article->getArticleById($fields['Article_id']);

        $result['list']['image'] = $result['list']['image'] ?
            RELA_DIR . 'statics/images/article/' . $result['list']['image'] :
            RELA_DIR . "templates/admin/assets/img/placeholder.png";

        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }


        $export = $result['list'];
        /////// category
        include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
        $category = new adminCategoryModel();

        $resultCategory = $category->getCategoryOption();
        if ($resultCategory['result'] == 1) {
            $export['category'] = $category->list;
        }
        //echo "<pre>";print_r($resultCategory);die();
        ///////

        $CKEditor = CKEditor();

        $export['description'] = $CKEditor->editor("description", isset($fields['description']) ? $fields['description'] : $export['description']);
        

        $this->fileName = 'admin.article.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * @param $fields
     */
    public function editArticle($fields)
    {
        $article = new adminArticleModel();

        if (!validator::required($fields['Article_id']) and !validator::Numeric($fields['Article_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }
        $result = $article->getArticleById($fields['Article_id']);

        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }

        if(isset($fields['companyLogo']) and $fields['companyLogo'] != ''){

            $result = $this->uploadImage($fields['companyLogo']);
            
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=article", $result['msg']);
            }
            
            fileRemover(STATIC_ROOT_DIR . "/images/article/", $article->image);
            $fields['image'] = $result['image'];
        }

        $result = $article->setFields($fields);

        if ($result['result'] != 1) {
            $this->showArticleEditForm($fields, $result['msg']);
        }

        $result = $article->edit();

        if ($result['result'] != '1') {
            $this->showArticleEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        die();
    }

    /**
     * delete article by article_id
     *
     * @param $fields
     * @author malekloo,marjani
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteArticle($fields)
    {
        $article = new adminArticleModel();

        if (!validator::required($fields['Article_id']) and !validator::Numeric($fields['Article_id'])) {
            $msg = 'یافت نشد';
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }
        $result = $article->getArticleById($fields['Article_id']);
        if ($result['result'] != '1') {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        }
        $result = $article->setFields($fields);

        if ($result['result'] != 1) {
            $this->showArticleEditForm($fields, $result['msg']);
        }
        $result = $article->delete();
        $input['component'] = 'article';
        $input['image'] = $article->image;
        removeFiles($input);
        if ($result['result'] != '1') {
            $this->showArticleEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . "admin/index.php?component=article", $msg);
        die();
    }

    public function uploadImage($image)
    {
        $uploader = new Uploader();
        $property = [
            'image' => $image,
            'folder_name' => 'article'
        ];
        $sizes = [
            'size1' => ['width' => '90', 'height' => '90']
        ];

        return $uploader->cropAndCompressImage($property, $sizes);

    }
}

?>
