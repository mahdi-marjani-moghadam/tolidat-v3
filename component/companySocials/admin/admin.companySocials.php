<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/28/2016
 * Time: 9:21 AM.
 */
include_once dirname(__FILE__).'/model/admin.companySocials.controller.php';
global $admin_info,$PARAM;
$companySocialsController = new adminCompanySocialController();
if (isset($exportType)) {
    $companySocialsController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'showMore':
        $companySocialsController->showMore($_GET['id']);
        break;
    case 'add':
        checkPermissions('addCompanySocials','companySocials');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companySocialsController->add($_POST);
        } else {
            $fields['company_id'] = $_GET['company_id'];
            $companySocialsController->showCompanySocialAddForm($fields, '');
        }
        break;
    case 'edit':
        checkPermissions('editCompanySocials','companySocials');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $companySocialsController->edit($_POST);

        } else {
            $input['Socials_id'] = $_GET['id'];
            $companySocialsController->showCompanySocialEditForm($input, '');
        }
        break;
    /**
     * delete WebsiteEditForm
     *
     * @param $fields
     * @param $msg
     * @author 
     * @copyright 2017 The daba Group
     * @method function showCompanyWebsiteEditForm($fields,$msg)
     * @version 1.0.1
     */
    case 'delete':
        checkPermissions('deleteCompanySocials','companySocials');
        $fields['Socials_id'] =$_GET['id'];
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companySocialsController->delete($fields);
        break;

////Draft
    case 'showDraftCompanySocials':
        checkPermissions('showDraftCompanySocials','companySocials');
        $input['company_id']=$_GET['id'];
        $companySocialsController->showDraftCompanySocial($input['company_id']);
        break;

    case 'editDraftCompanySocials':
        checkPermissions('editDraftCompanySocials','companySocials');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $companySocialsController->editDraftCompanySocial($_POST);
        }else{
            $fields['draft_id']=$_GET['id'];
            $companySocialsController->editDraftCompanySocialForm($fields);
        }
        break;

////End Draft
    default:
        checkPermissions('showList','companySocials');
        $fields['company_id'] = $_GET['company_id'];
        $fields['branch_id'] = $_GET['branch_id'];
        $companySocialsController->showList($fields);
        break;
}
