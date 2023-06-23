<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 05-Oct-16
 * Time: 9:49 AM
 */


include_once dirname(__FILE__).'/model/admin.businessLicence.controller.php';
global $admin_info,$PARAM;
$businessLicenceController = new adminBusinessLicenceController();

if (isset($exportType))
{
    $businessLicenceController->exportType = $exportType;
}

switch ($_GET['action'])
{
    case 'addBusinessLicence':
        checkPermissions('addBusinessLicence','businessLicence');
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $businessLicenceController->add($_POST,$_FILES['businessLicence']);
        }
        else
        {
            $businessLicenceController->showBusinessLicenceAddForm($_GET['company_id'], '');
        }
        break;

    case 'editBusinessLicence':
        checkPermissions('editBusinessLicence','businessLicence');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $businessLicenceController->edit($_POST,$_FILES['businessLicence']);
        }
        else
        {
            $input['business_licence_id']=$_GET['id'];
            $businessLicenceController->showBusinessLicenceEditForm( $input, '');
        }
        break;
    case 'deleteBusinessLicence':
        checkPermissions('deleteBusinessLicence','businessLicence');
        $businessLicenceController->delete($_GET['id']);

//// draft
    case 'showDraftBusinessLicence':
        checkPermissions('showDraftBusinessLicence','businessLicence');
        $input['company_id']=$_GET['id'];
        $businessLicenceController->showDraftBusinessLicence($input['company_id']);
        break;
    case 'editDraftBusinessLicence':
        checkPermissions('editDraftBusinessLicence','businessLicence');
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $businessLicenceController->editDraftBusinessLicence($_POST,$_FILES['businessLicence']);
        }else{
            $fields['draft_id']=$_GET['id'];
            $businessLicenceController->editDraftBusinessLicenceForm($fields);
        }
        break;
////End Draft
    default:
        checkPermissions('showList','businessLicence');
        $fields['company_id'] = $_GET['id'];
        $businessLicenceController->showList($fields);
        break;
}
