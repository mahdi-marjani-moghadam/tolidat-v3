<?php
/**
 * Created by fadeInLeft
 * User: dabaCompany
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/admin.personalityType.model.php';

/**
 * Class personality_typeController
 */
class adminPersonalityTypeController
{
    
    /**
     * @var string
     */
    public $exportType;


    /**
     * @var
     */
    public $fileName;


    /**
     * personality_typeController constructor.
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @return array
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function template($list = [],$msg = '')
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

    /**
     * @param $fields
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showList($fields)
    {
        $pesonalityList = new personality_type();
        $result = $pesonalityList->getByFilter();
        if ($result['result'] != '1') {
            $this->fileName = 'admin.personalityType.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] =  $result['export']['recordsCount'];
        $this->fileName = 'admin.personalityType.showList.php';
        $this->template($export);
        die();
    }

    /**
     * show to table personality_type
     * @param $fields
     * @param $msg
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showpersonalityTypeAddForm($fields, $msg)
    {
        $this->fileName = 'admin.personalityType.addForm.php';
        $this->template($fields, $msg);
        die();
    }

    /**
     * insert to table personality_type
     * @param $fields
     * @return mixed
     */
    public function addpersonalityType($fields)
    {

        $personalityType = new personality_type();
        $result  = $personalityType->setFields($fields);

        if ($result['result'] == -1) {
            return $result;
        }
        $result=$personalityType->save();
        if ($result['result'] != '1') {
            $this->showpersonalityTypeAddForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=personalityType', $msg);
        die();
    }

    /**
     * show to table personality_type
     * @param $fields
     * @param $msg
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function showpersonalityTypeEditForm($fields, $msg)
    {
        $personalityType = personality_type::find($fields['Personality_list_id']);

        if(!is_object($personalityType))
        {
            $msg = 'صفحه مورد نظر یافت نشد';
            redirectPage(RELA_DIR.'admin/index.php?component=personalityType', $msg);
        }
        $export = $personalityType->fields;
        $this->fileName = 'admin.personalityType.editForm.php';
        $this->template($export, $msg);
        die();
    }

    /**
     * edit to table personality_type
     * @param $fields
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function editpersonalityType($fields)
    {
        $personalityType = personality_type::find($fields['Personality_type_id']);

        $personalityType->setFields($fields);
        $personalityType->save();
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR.'admin/index.php?component=personalityType', $msg);
        die();
    }

    /**
     * delete to table personality_type
     * @param $fields
     * @author 
     * @copyright 2016-2017 The daba Group
     * @version 0.0.1
     */
    public function deletepersonalityType($fields)
    {

        $personalityType = personality_type::find($fields['Personality_list_id']);
        $result = $personalityType->delete();

        if ($result['result'] != '1') {
            $this->showpersonalityTypeEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';

        redirectPage(RELA_DIR.'admin/index.php?component=personalityType', $msg);
        die();
    }
    
    public static function getPersonalityType()
    {
        $personalityType=adminpersonality_typeModel::getAll()->getList();
        return $personalityType;
    }

    public static function find($personality_type_id) {
        return personality_type::find($personality_type_id);
    }
}
