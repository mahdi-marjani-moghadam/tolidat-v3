<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/admin.companyPosition.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class positionController
{
    /**
     * Contains file type.
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     * @var
     */
    public $fileName;

    /**
     * @var int|mixed
     */
    private $company_info;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * @param array $list
     * @param $msg
     * @return array
     * @author
     * @copyright 2017 The daba Group
     * @method function template($fields)
     * @version 1.0.1
     *
     */
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

    /**
     * showList Postion
     *
     * @param $fields
     * @author
     * @copyright 2017 The daba Group
     * @method function showPositionAddForm($fields)
     * @version 1.0.1
     */
    public function showPositionAddForm($fields)
    {
        $this->fileName = 'admin.companyPosition.addForm.php';
        $controllerPosition = adminc_positionModel::getBy_company_id_and_branch_id($fields['company_id'], $fields['branch_id'])->getList();

        if ($controllerPosition['result'] != '1') {
            $this->template('', $controllerPosition['msg']);
            die();
        }
        $export['list'] = $controllerPosition['export']['list'];
        $export['company_id'] = $fields['company_id'];
        $export['branch_id'] = $fields['branch_id'];
        $this->template($export);
        die();
    }


    /**
     * addPosition map
     *
     * @param $fields
     * @author
     * @copyright 2017 The daba Group
     * @method function addPosition($fields)
     * @version 1.0.1
     */
    public function addPosition($fields)
    {
        global $admin_info;
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['isActive'] = 1;
        $fields['status'] = 1;
        $fields['isAdmin'] = 1;
        $fields['x'] = $fields['xvalue'];
        $fields['y'] = $fields['yvalue'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $position = adminc_positionModel::getBy_branch_id($fields['branch_id'])->first();
//        print_r_debug($position);
        if (is_object($position)) {
            $position->x = $fields['xvalue'];
            $position->y = $fields['yvalue'];
            $position->save();
        } else {
            $position = new adminc_positionModel();
            $position->setFields($fields);
            $position->save();
        }
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/?component=companyPositions&action=add&company_id=' . $fields['company_id'] . '&branch_id=' . $fields['branch_id'], $msg = 'مکان مورد نظر ذخیره شد');

    }

    public function deleteAllPositionByCompanyId($company_id)
    {
        //delete from main table
        $positions = adminc_positionModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($positions['export']['recordsCount'] > 0) {
            foreach ($positions['export']['list'] as $position) {
                $position->delete();
            }
        }

        return;

    }

    public function getPositionByCompanyId($company_id)
    {
        $positionResult = adminc_positionModel::getBy_company_id_and_status($company_id, 1)->getList();
        return $positionResult;
    }


}
