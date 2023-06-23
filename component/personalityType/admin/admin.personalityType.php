<?php
/**
 * Created by fadeInLeft
 * User: dabaCompany
 * Date: 08-Sep-16
 * Time: 9:23 AM
 */

include_once dirname(__FILE__) . '/model/admin.personalityType.controller.php';

global $admin_info,$PARAM;

$personalityTypeController = new adminPersonalityTypeController();

if (isset($exportType))
{
    $personalityTypeController->exportType = $exportType;
}

switch ($_GET['action'])
{
    case 'addPersonalityType':
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $personalityTypeController->addpersonalityType($_POST);
        }
        else
        {
            $personalityTypeController->showpersonalityTypeAddForm('', '');
        }
        break;

    case 'editPersonalityType':
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $personalityTypeController->editpersonalityType($_POST);
        }
        else
        {
            $input['Personality_list_id']=$_GET['id'];
            $personalityTypeController->showpersonalityTypeEditForm($input, '');
        }
        break;

    case 'deletePersonalityType':

        $input['Personality_list_id'] = $_GET['id'];
        $personalityTypeController->deletepersonalityType($input);

    default:
        $personalityTypeController->showList($fields);
        break;
}
