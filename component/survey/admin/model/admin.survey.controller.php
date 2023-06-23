<?php
/**
 * Created by PhpStorm.
 * User: bahadovic
 * Date: 6/14/2022
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.survey.model.php");
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

/**
 * Class adminSurveyController
 */
class adminSurveyController
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
     * registerController constructor.
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
    function template($list = [], $msg = '')
    {

        global $messageStack;
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
     * add survey.
     * @param $id
     * @author bahadovic
     * @date 6/14/2022
     */
    public function accept($id)
    {

        $survey= admin_surveyModel::find($id);
        if (!is_object($survey)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
            die();
        }

        $survey->status = 1;
        $survey->save();

        $this->showList();
        die();

    }


    public function delete($id)
    {

        $survey= admin_surveyModel::find($id);
        if (!is_object($survey)) {
            $result['msg'] = 'Not found';
            print_r_debug($result);
            die();
        }

        $survey->delete();

        $this->showList();
        die();

    }

    public function showList()
    {

        $export = admin_surveyModel::getAll()->orderBy('survey_id', 'desc')->getList();

        $this->fileName = 'admin.survey.showList.php';
        $this->template($export['export']);
        die();

    }



}


