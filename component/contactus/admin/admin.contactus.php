<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__).'/model/admin.contactus.controller.php';

global $admin_info,$PARAM;

$contactUsController = new adminContactUsController();

if (isset($exportType))
{
    $contactUsController->exportType = $exportType;
}

switch ($_GET['action'])
{


    case 'showMore':
        $contactUsController->showMore($_GET['id']);
        break;

    case 'addContactUs':
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $contactUsController->addContactUs($_POST);
        }
        else
        {
            $contactUsController->showContactUsAddForm('', '');
        }
        break;

    case 'editContactUs':
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $contactUsController->editContactUs($_POST);
        }
        else
        {
            $input['Contact_id']=$_GET['id'];
            $ContactUsController->showContactUsEditForm($input, '');
        }
        break;

    case 'deleteContactUs':
        $input['Contact_id'] = $_GET['id'];
        $contactUsController->deleteContactUs($input);

    default:
    
        $fields['order']['Contact_id'] = 'desc';
        $contactUsController->showList($fields);
        break;
}
