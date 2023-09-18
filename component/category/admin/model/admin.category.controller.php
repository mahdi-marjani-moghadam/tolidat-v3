<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM
 */

include_once(dirname(__FILE__) . "/admin.category.model.php");
include_once ROOT_DIR . "component/category/member/model/member.category.model.php";

/**
 * Class newsController
 */
class adminCategoryController
{
    public $exportType;

    public $fileName;
    private $list;
    public $level = 0;  // other record fields

    public function __construct()
    {
        $this->exportType = 'html';
    }

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

    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->template($msg);
        }
        $news = new adminNewsModel();
        $result = $news->getNewsById($_input);

        if ($result['result'] != 1) {
            die();
        }

        $this->template($news->fields);
        die();
    }

    public function getCategory_option($parent_id = '0')
    {
        $model = new adminCategoryModel();
        $result = $model->getCategoryOption();
    }

    public function getCategory()
    {
        include_once(ROOT_DIR . "component/category/model/category.model.php");
        $category = new categoryModel();

        $result = $category->getCategoryTree();

        $resultCategory = $category->getCategoryUlLiMember($category->list);

        //print_r_debug( $resultCategory);
        if ($resultCategory['result'] == 1) {

            return $resultCategory['export']['list'];
        }

        return;

        $category = new categoryModel();
        $resultCategory = $category->getCategoryUlLi();

        return $resultCategory;


        $category = new adminCategoryModel();
        $resultCategory = $category->getCategoryOption();

        if ($resultCategory['result'] == 1) {
            $result1['category'] = $category->list;

            return $result1;
        }

        return null;
    }

    public function showList()
    {
        $catList = $this->tree_set();
        $this->list = $catList['export']['list'];
        // print_r_debug($catList);
        // print_r_debug($this->list);
        $export['list'] = $this->convert(0, '', '|-- ');
        $export['recordsCount'] = $catList['export']['recordsCount'];

        $this->fileName = 'admin.category.showList.php';
        $this->template($export);
        die();

        //        foreach ($result as $key => $val) {
        //            print_r($val['export'] . '<br/>');
        //        }
        //        //echo "<br/>start<br/>" . $st, "<br/>close<br/>";
        //        print_r($result);
        //
        //
        //        $result = $model->getCategoryTree();
        //        /*
        //         * //ul li sample
        //        $mainMenu=$model->getulli($model->list[$parent_id],1,$model->list);
        //        $mainMenu = "<ul>\n".$mainMenu ."</ul>";
        //        echo '<pre/>';
        //        print_r($mainMenu);*/
        //
        //        $this->fileName = 'admin.news.showList.php';
        //        $this->template('', $result['msg']);
        //        die();
        //
        //        $export['list'] = $model->list;
        //        $export['recordsCount'] = $news->recordsCount;
        //        $this->fileName = 'admin.news.showList.php';
        //
        //
        //        $fields = $result['export']['list'];
        //        $this->listCat = $fields;
        //        $mainMenu = $this->getulli($fields[0]);
        //        $mainMenu = "<ul>\n" . $mainMenu . "</ul>";
        //
        //        return $mainMenu;
        //
        //        //////////////////////////
        //        if ($result['result'] != '1') {
        //            $this->fileName = 'admin.news.showList.php';
        //            $this->template('', $result['msg']);
        //            die();
        //        }
        //        $export['list'] = $news->list;
        //        $export['recordsCount'] = $news->recordsCount;
        //        $this->fileName = 'admin.news.showList.php';
        //        /////////////////////////
        //
        //
        //        //////
        //        if ($result['result'] != '1') {
        //            $this->fileName = 'admin.news.showList.php';
        //            $this->template('', $result['msg']);
        //            die();
        //        }
        //        $export['list'] = $news->list;
        //        $export['recordsCount'] = $news->recordsCount;
        //        $this->fileName = 'admin.news.showList.php';
        //
        //        $this->template($export);
        //        die();
        //        //////
        //
        //
        //        if ($result['result'] != '1') {
        //            die();
        //        }
        //        $export['list'] = $news->list;
        //        $export['recordsCount'] = $news->recordsCount;
        //        $this->fileName = 'admin.news.showList.php';
        //
        //        $this->template($export);
        //        die();
    }

    public function showCategoryAddForm($fields = array(), $msg)
    {

        if (!is_array($fields)) $fields = array();

        $CKEditor = CKEditor();
        $fields['body'] = $CKEditor->editor("body");

        $catList = $this->tree_set();
        $this->list = $catList['export']['list'];
        $fields['category'] = $this->convert(0, '', '|-- ');
        // dd($fields);
        $this->fileName = 'admin.category.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    public function addCategory($fields)
    {
        $category = new category();
        
        $fields['url'] = cleanSlug($fields['url']);
        $category->setFields($fields);
        //check unique url
        $check = (new category)->where('url', '=', $category->url)->first();
        if (is_object($check)) {
            $msg = "این url وجود دارد";
            redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        }



        $result = $category->validator();
        if ($result['result'] != '1') {
            $this->showCategoryAddForm($fields, $result['msg']);
        }

        $category->new_category = '';
        $category->group = 0;
        $category->group_sub = 0;
        $category->status = 1;
        $category->img_name = $this->upload($fields['images']['image-main'], 'main_' . $fields['images']['image-main']['name']);
        $category->image_1 = $this->upload($fields['images']['image-1'], 'ID1_' . $fields['images']['image-1']['name']);
        $category->image_2 = $this->upload($fields['images']['image-2'], 'ID2_' . $fields['images']['image-2']['name']);
        $category->image_3 = $this->upload($fields['images']['image-3'], 'ID3_' . $fields['images']['image-2']['name']);
        $category->image_4 = $this->upload($fields['images']['image-4'], 'ID4_' . $fields['images']['image-2']['name']);
        $result = $category->save();

        if ($result['result'] != '1') {
            $this->showCategoryAddForm($fields, $result['msg']);
        }

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        die();
    }

    public function upload($fields, $new_name)
    {
        if (!empty($fields['name'])) {
            $result = $this->uploadImage($fields, $new_name);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=add", $result['msg']['error']);
            }
            return $result['image_name'];
        }
        return null;
    }


    public function showCategoryEditForm($fields, $msg)
    {



        $category = category::find($fields['Category_id']);

        if (!is_object($category)) {
            $msg = "دسته بندی وجود ندارد";
            redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        }

        $export = $category->fields;

        $catList = $this->tree_set();
        $this->list = $catList['export']['list'];
        $export['category_list'] = $this->convert(0, '', '|-- ');

        $CKEditor = CKEditor();

        $export['body'] = $CKEditor->editor("body", isset($fields['body']) ? $fields['body'] : $export['body']);

        $this->fileName = 'admin.category.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editCategory($fields)
    {
        $category = category::find($fields['Category_id']);

        if (!is_object($category)) {
            $msg = "دسته بندی وجود ندارد";
            redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        }

        $oldUrl = $category->url;
        
        $fields['url'] = cleanSlug($fields['url']);
        
        $category->setFields($fields);

        
        //check unique url
        $check = (new category)->where('url', '=', $category->url)->first();
        if (is_object($check) && $category->url != $oldUrl) {
            $msg = "این url وجود دارد";
            redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        }



        $result = $category->validator();
        if ($result['result'] != '1') {
            $this->showCategoryAddForm($fields, $result['msg']);
        }


        if (!empty($fields['images']['image-main']['name'])) {
            $result = $this->uploadImage($fields['images']['image-main'], 'main_' . $fields['images']['image-main']['name']);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=edit&id=" . $category->Category_id, $result['msg']['error']);
            }
            fileRemover(STATIC_ROOT_DIR . '/images/category/', $category->img_name);
            $category->img_name = $result['image_name'];
        }

        if (!empty($fields['images']['image-1']['name'])) {
            $result = $this->uploadImage($fields['images']['image-1'], 'ID1_' . $fields['images']['image-1']['name']);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=edit&id=" . $category->Category_id, $result['msg']['error']);
            }
            fileRemover(STATIC_ROOT_DIR . '/images/category/', $category->image_1);
            $category->image_1 = $result['image_name'];
        }

        if (!empty($fields['images']['image-2']['name'])) {
            $result = $this->uploadImage($fields['images']['image-2'], 'ID2_' . $fields['images']['image-2']['name']);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=edit&id=" . $category->Category_id, $result['msg']['error']);
            }
            fileRemover(STATIC_ROOT_DIR . '/images/category/', $category->image_2);
            $category->image_2 = $result['image_name'];
        }

        if (!empty($fields['images']['image-3']['name'])) {
            $result = $this->uploadImage($fields['images']['image-3'], 'ID3_' . $fields['images']['image-3']['name']);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=edit&id=" . $category->Category_id, $result['msg']['error']);
            }
            fileRemover(STATIC_ROOT_DIR . '/images/category/', $category->image_3);
            $category->image_3 = $result['image_name'];
        }

        if (!empty($fields['images']['image-4']['name'])) {
            $result = $this->uploadImage($fields['images']['image-4'], 'ID4_' . $fields['images']['image-4']['name']);
            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . "admin/index.php?component=category&action=edit&id=" . $category->Category_id, $result['msg']['error']);
            }
            fileRemover(STATIC_ROOT_DIR . '/images/category/', $category->image_4);
            $category->image_4 = $result['image_name'];
        }
        $category->group = 0;
        $category->group_sub = 0;
        $category->parent_id_copy = 0;

        $result = $category->save();


        if ($result['result'] != 1) {
            $this->showCategoryEditForm($fields, $result['msg']);
        }

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        die();
    }

    public function deleteCategory($id)
    {
        $category = category::find($id);

        if (!is_object($category)) {
            $msg = "دسته بندی وجود ندارد";
            redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        }

        $subCategories = category::getBy_parent_id($category->Category_id)->get();

        if ($subCategories['export']['recordsCount'] > 0) {
            foreach ($subCategories['export']['list'] as $cate) {
                if (is_object($cate)) {
                    $cate->delete();
                }
            }
        }

        $category->delete();
        $msg = 'دسته بندی با موفقیت حذف شد';
        redirectPage(RELA_DIR . "admin/index.php?component=category", $msg);
        die();
    }

    function tree_set()
    {
        return category::getAll()->orderBy('sort', 'ASC')->keyBy('parent_id', 0)->getList();
    }

    public function convert($_input, $temp, $space = '-')
    {
        static $mainMenu = array();

        foreach ($this->list[$_input] as $key => $val) {
            $mainMenu[$val['Category_id']] = $val;
            $mainMenu[$val['Category_id']]['export'] = $temp . $space . $val['title'];
            $mainMenu[$val['Category_id']]['export_en'] = $temp . $space . $val['title_en'];
            $mainMenu[$val['Category_id']]['level'] = $this->level;
            $temp = $temp . '&nbsp;&nbsp;&nbsp;&nbsp;';
            $this->level++;
            if (isset($this->list[$val['Category_id']])) {
                $this->convert($val['Category_id'], $temp, '|-- ');
            }
            $this->level--;
            $len = strlen($space);
            $temp = substr($temp, 0, -24);
        }

        return $mainMenu;
    }

    public static function GetCategoryOption()
    {
        $category = new static();
        $catList = $category->tree_set('');
        $category->list = $catList['export']['list'];
        return $category->convert(0, '', '|-- ');
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function uploadImage($fields, $new_name)
    {
        if ($fields['name'] != '') {
            $type = substr($fields['type'], 0, 5);
            if ($type == 'image') {
                $property = array(
                    'type' => 'jpg,png,jpeg',
                    'new_name' => $new_name,
                    'max_size' => '2048000',
                    'upload_dir' => ROOT_DIR . "statics/images/category/",
                );
                $result_uploader = fileUploader($property, $fields);
                return $result_uploader;
            }
            $result['result'] = -1;
            $result['msg']['error'] = "لطفا عکس انتخاب کنید";
        }
        return $result;
    }

    public function findParentCategory($fields)
    {
        if ($fields['category_id'] != '') {
            $category_id = $fields['category_id'];

            do {
                $categoryResult = adminCategoryModel::getBy_Category_id($category_id)->First();
                $category_id = $categoryResult->parent_id;
                if ($categoryResult->parent_id != 0) {
                    $parent_id[] = $categoryResult->parent_id;
                }
            } while ($categoryResult->parent_id != '0');

            $result['category_parent_id'] = $parent_id;

            return $result;
        }

        return null;
    }
}
