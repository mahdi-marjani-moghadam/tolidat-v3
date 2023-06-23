<?php
include_once(dirname(__FILE__) . "/admin.advertise.model.php");
include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");

/**
 * Class advertiseController
 */
class adminAdvertiseController
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
     * @param array $list
     * @param $msg
     * @return array
     */
    function template($list = [], $msg ='')
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
     * @param $fields
     */
    public function showList($type)
    {

        $result = adminAdvertiseModel::getBy_type($type['type'])->getList();
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['recordsCount'];
        $this->fileName = 'admin.companyAdvertise.showList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showAdvertiseAddForm()
    {
        $category = new adminCategoryModel();
        $resultCategory = $category->getCategoryOption();
        if ($resultCategory['result'] == 1) {
            $fields['category'] = $category->list;
        }
        $this->fileName = 'admin.advertise.addForm.php';
        $this->template($fields);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function addAdvertise($fields)
    {
        $fields['category_id'] = implode($fields['category_id'], ',');
        $newAdvertise = new adminAdvertiseModel();
        $newAdvertise->setFields($fields);
        $validate = $newAdvertise->validator();

        if ($validate['result'] != 1) {
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."&action=addAdvertise", $validate);
            die();
        }
        $result = $newAdvertise->save();

        if ($result['result'] != 1) {
            $msg = "عملیات ذخیره سازی با مشکل مواجه شد";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."&action=addAdvertise", $msg);
            die();
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
        die();
    }

    /**
     * @param $fields
     * @param $msg
     */
    public function showAdvertiseEditForm($fields, $advertise_id)
    {
        $advertise = adminAdvertiseModel::find($advertise_id);
        if (!is_object($advertise)) {
            $msg = "تبلیغاتی با این مشخصات موجود نیست";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
            die();
        }
        $export = $advertise->fields;
        $export['category_id'] = explode(',', $advertise->category_id);
        $category = new adminCategoryModel();
        $resultCategory = $category->getCategoryOption();
        if ($resultCategory['result'] == 1) {
            $export['category'] = $category->list;
        }
        $this->fileName = 'admin.advertise.editForm.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     */
    public function editAdvertise($fields)
    {
        $advertise = adminAdvertiseModel::find($fields['Advertise_id']);

        if (!is_object($advertise)) {
            $msg = "تبلیغاتی با این مشخصات موجود نیست";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
            die();
        }
        $fields['category_id'] = implode($fields['category_id'], ',');
        $advertise->setFields($fields);
        $validate = $advertise->validator();

        if ($validate['result'] != 1) {
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."&action=addAdvertise", $validate);
            die();
        }
        $result = $advertise->save();

        if ($result['result'] != 1) {
            $msg = "عملیات ذخیره سازی با مشکل مواجه شد";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."&action=addAdvertise", $msg);
            die();
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
        die();
    }

    /**
     * delete advertise by advertise_id
     *
     * @param $fields
     * @author marjani
     * @date 3/06/2015
     * @version 01.01.01
     */
    public function deleteAdvertise($fields, $advertise_id)
    {
        $advertise = adminAdvertiseModel::find($advertise_id);

        if (!is_object($advertise)) {
            $msg = "تبلیغاتی با این مشخصات موجود نیست";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
            die();
        }
        $result = $advertise->delete();

        if ($result['result'] != 1) {
            $msg = "عملیات حذف با مشکل مواجه شد";
            redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
            die();
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . "admin/?component=advertise&type=".$fields['type']."", $msg);
        die();
    }
}