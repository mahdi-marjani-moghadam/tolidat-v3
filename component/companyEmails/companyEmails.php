<?php

include_once(dirname(__FILE__). "/model/companyEmails.controller.php");
global $admin_info,$PARAM;
global $company_info;
$emailController = new emailController();
if(isset($exportType))
{
    $emailController->exportType=$exportType;
}
switch ($PARAM[1])
{
    case 'add':
        $_POST['isActive'] = 1;
        $_POST['draftStatus'] = 1;
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['company_id'] = $company_info['company_id'];
        $_POST['email_subject'] = "email";
        $_POST['email_email'] = "Daba";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (isset($_POST['action']) && $_POST['action']=='add' )
        {
            $emailController->addEmail($_POST);
        }
        else
        {

            $emailController->showEmailAddForm($_POST);
        }
        break;
    case 'edit':

        $_POST['Emails_d_id'] = $PARAM[2];
        $_POST['editor_id'] = $company_info['company_id'];
        $_POST['company_id'] = $company_info['company_id'];
        $_POST['email_subject'] = "mail";
        $_POST['email_email'] = "Daba1";
        $_POST['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if(isset($_POST['action']) & $_POST['action']=='edit')
        {
            $emailController->editEmail($_POST);
        }
        else
        {
            $emailController->showEmailEditForm($_POST);
        }
        break;
    case 'deleteEmail':
        $emailController->deleteEmail($PARAM[3]);
        break;
    default:
   
        $fields['editor_id']=$company_info['company_id'];
        $emailController->showList($fields);
        break;
}

?>