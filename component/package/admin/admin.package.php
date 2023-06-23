<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__).'/model/admin.package.controller.php';

global $admin_info,$PARAM;

$packageController = new adminPackageController();
if (isset($exportType))
{
    $packageController->exportType = $exportType;
}

switch ($_GET['action'])
{
    case 'addPackage':
        checkPermissions('addPackage','package');
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $packageController->addPackage($_POST);
        }
        else
        {
            $packageController->showPackageAddForm('', '');
        }
        break;

    case 'editPackage':
        checkPermissions('editPackage','package');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $packageController->editPackage($_POST);
        }
        else
        {
            $input['Package_id']=$_GET['id'];
            $packageController->showPackageEditForm($input, '');
        }
        break;

    case 'deletePackage':
        checkPermissions('deletePackage','package');
        $input['Package_id'] = $_GET['id'];
        $packageController->deletePackage($input);

    default:
        checkPermissions('showList','package');
        $fields['order']['Package_id'] = 'DESC';
        $packageController->showList($fields);
        break;
}
