<?php
include_once dirname(__FILE__) . '/admin.laws.model.php';

class adminLawsController
{
    public $exportType;

    public $fileName;

    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg)
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

    public function showList()
    {
        $laws = adminLawsModel::getAll()->getList();
        $this->fileName = 'admin.laws.showList.php';
        $this->template($laws['export']['list']);
        die();
    }

    public function showAddForm()
    {
        $this->fileName = 'admin.laws.addForm.php';
        $this->template();
        die();
    }

    public function addLaws($fields)
    {
        $fields['image'] = $this->uploadImage($fields['image']);
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $law = new adminLawsModel();
        $law->setFields($fields);
        $result = $law->save();

        if ($result['result'] != -1) {
            redirectPage(RELA_DIR . 'admin/?component=laws');
            die();
        }
        redirectPage(RELA_DIR . 'admin/?component=laws&action=addLaws');
        die();
    }

    public function showEditForm($law_id)
    {
        $law = adminLawsModel::find($law_id);
        if (is_object($law)) {
            $this->fileName = 'admin.laws.editForm.php';
            $this->template($law->fields);
            die();
        }
        redirectPage(RELA_DIR . 'admin/?component=laws');
    }

    public function editLaws($fields)
    {
        if ($fields['image']['name'] != '') {
            fileRemover(COMPANY_ADDRESS_ROOT, $fields['img']);
            $fields['image'] = $this->uploadImage($fields['image']);
        } else {
            $fields['image'] = $fields['img'];
        }
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $law = adminLawsModel::find($fields['Laws_id']);
        if (!is_object($law)) {
            redirectPage(RELA_DIR . 'admin/?component=laws&action=editLaws');
        }
        $law->setFields($fields);
        $result = $law->save();

        if ($result['result'] != -1) {
            redirectPage(RELA_DIR . 'admin/?component=laws');
            die();
        }
        redirectPage(RELA_DIR . 'admin/?component=laws&action=editLaws');
        die();
    }

    public function deleteLaws($law_id)
    {
        $law = adminLawsModel::find($law_id);
        if (!is_object($law)) {
            redirectPage(RELA_DIR . 'admin/?component=laws');
        }
        $law->delete();
        fileRemover(COMPANY_ADDRESS_ROOT, $law->image);
        redirectPage(RELA_DIR . 'admin/?component=laws');
    }

    public function uploadImage($fields)
    {
        if ($fields['name'] != '') {
            $type = substr($fields['type'], 0, 5);
            if ($type == 'image') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $fields['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT
                );
                $result_uploader = fileUploader($Property, $fields);
                return $result_uploader['image_name'];
            }
        }
        return null;
    }
}
