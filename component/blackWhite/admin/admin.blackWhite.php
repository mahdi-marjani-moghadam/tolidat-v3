
<?php
/**
 * Created by fadeInLeft
 * User: dabaCompany
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/model/admin.blackWhite.controller.php';
global $admin_info,$PARAM;

$blackWhiteController = new adminblackWhiteController();

if (isset($exportType))
{
    $blackWhiteController->exportType = $exportType;

}

switch ($_GET['action'])
{
    case 'addblackWithe':
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $blackWhiteController->addblackWithe($_POST);
        } else {
            $blackWhiteController->showblackWhiteAddForm('', '');
        }
        break;

    case 'editblackWhite':
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $blackWhiteController->editblackWhite($_POST);
        }
        else
        {
            $input['Black_white_id']=$_GET['id'];
            $blackWhiteController->showblackWhiteEditForm($input, '');
        }
        break;

    case 'deleteblackWhite':
        //checkPermissions('deleteblackWhite','blackWhite');
        $input['Black_white_id'] = $_GET['id'];
        $blackWhiteController->deleteBlackWhite($input);

    default:
        $fields['order']['Black_white_id'] = 'DESC';
        $blackWhiteController->showList($fields);
        break;
}
