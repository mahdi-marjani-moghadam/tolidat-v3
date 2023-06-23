<?php

include_once(dirname(__FILE__). "/model/companyPhones.controller.php");
global $admin_info,$PARAM;
global $company_info;
$phoneController = new phoneController();
if(isset($exportType))
{
    $phoneController->exportType=$exportType;
}

switch ($PARAM[1])
{
    case 'add':
        $_POST['isActive'] = 1;
        $_POST['draftStatus'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['company_id'] = $company_info['company_id'];
        $_POST['phone_subject'] = "phone";
        $_POST['phone_number'] = "Daba";
        $_POST['phone_state'] = 1;
        $_POST['phone_value'] = 2;
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (isset($_POST['action']) && $_POST['action']=='add' )
        {
            $phoneController->addPhone($_POST);
        }
        else
        {

            $phoneController->showPhoneAddForm($_POST);
        }
        break;
    case 'edit':
     
        $_POST['Phones_d_id'] = $PARAM[2];
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['company_id'] = $company_info['company_id'];
        $_POST['phone_subject'] = "phone1";
        $_POST['phone_phone'] = "Daba1";
        $_POST['phone_state'] = 3;
        $_POST['phone_value'] = 4;
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            print_r_debug($_POST);
            $phoneController->editPhone($_POST);
        }
        else
        {
            $phoneController->showPhoneEditForm($_POST);
        }
        break;
    case 'deletePhone':
        $phoneController->deletePhone($PARAM[3]);
        break;
    default:
   
        $fields['editor_id']=$company_info['company_id'];
        $phoneController->showList($fields);
        break;
}

?>