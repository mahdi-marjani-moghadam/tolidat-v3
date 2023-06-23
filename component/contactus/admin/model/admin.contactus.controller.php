<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__).'/admin.contactus.model.php';

class adminContactUsController
{

    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg='')
    {

        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';
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
        if (!is_numeric($_input))
        {
            $msg = 'یافت نشد';
            $this->showList('', $msg);
            die();
        }
        $model=admincontactusModel::find($_input);

        if (!is_object($model))
        {
            $msg = $model['msg'];
            $this->showList('', $msg);
            die();
        }
        $this->fileName = "admin.contactus.showMore.php";
        $this->template($model->fields);
        die();
    }
    public function showList($fields,$msg='')
    {
        $contactUs = new admincontactusModel();
        $result =$contactUs->getByFilter($fields);
        if ($result['result'] != '1') {
                $this->fileName = 'admin.contactus.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];
        $this->fileName = 'admin.contactus.showList.php';
        $this->template($export,$msg);
        die();
    }

    public function showContactUsAddForm($fields, $msg)
    {
        $this->fileName = 'admin.contactus.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    public function addContactUs($fields)
    {
        $contactUs = new admincontactusModel();
        $result =$contactUs->setFields($fields);
        $contactUs->save();
        if ($result['result'] == -1) {
            return $result;
        }
        if ($result['result'] != '1') {
            $this->showContactUsAddForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=contactus', $msg);
        die();
    }

    public function showContactUsEditForm($fields, $msg)
    {
        $contactUs=admincontactusModel::find($fields['Contact_id']);
        if(!is_object($contactUs))
        {
            $msg = 'صفحه مورد نظر یافت نشد';
            redirectPage(RELA_DIR.'admin/index.php?component=contactus', $msg);
        }
        $export = $contactUs->fields;
        $this->fileName = 'admin.contactus.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editContactUs($fields)
    {
        $ContactUs=admincontactusModel::find($fields['Contact_id']);
        $ContactUs->setFields($fields);
        $ContactUs->save();
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR.'admin/index.php?component=contactus', $msg);
        die();
    }

    public function deleteContactUs($fields)
    {
        $ContactUs=admincontactusModel::find($fields['Contact_id']);
        $result=$ContactUs->delete();
        if ($result['result'] != '1') {
            $this->showContactUsEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR.'admin/index.php?component=contactus', $msg);
        die();
    }
}
