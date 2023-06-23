<?php
include_once("../server.inc.php");
include_once(ROOT_DIR . "common/db.inc.php");
include_once(ROOT_DIR . "common/init.inc.php");
include_once(ROOT_DIR . "common/func.inc.php");
include_once(ROOT_DIR . "model/db.inc.class.php");
include_once(ROOT_DIR . "model/admin_invoice.p.php");

global $admin_info;
/*if ($admin_info == -1)
{
    header("location:".RELA_DIR."login.php");
    die();
}*/

$member = new admin_invoice_presentation();

switch ($_GET['action'])
{
    case 'calc':
    {
		print_r($_SERVER);
        
		print_r($_POST);
		die();
        break;
    }
    case 'add':
    {
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $member->add($_POST);
        }
        else
        {
            $member->addForm('', '');
        }
        break;
    }
	

    case 'editPrice':
    {
        if (isset($_POST['action']) & $_POST['action'] == 'update')
        {
            //echo '<pre/>';
            //print_r($_POST);
            //die();

            $member->editPrice($_POST);
        }
        else
        {
            $input['member_id']=$_GET['member_id'];
            $member->editFormPrice($input, '');
        }
        break;
    }
    case 'edit':
    {
        if (isset($_POST['action']) & $_POST['action'] == 'update')
        {
            $member->edit($_POST);
        }
        else
        {
            $input['member_id']=$_GET['member_id'];
            $member->editForm($input, '');
        }
        break;
    }
    case 'addCode':
    {
        if (isset($_POST['action']) & $_POST['action'] == 'add')
        {
            $product->addCode($_POST);
        }
        else
        {

            $fields['product_id']=$_GET['product_id'];
            $product->addFormCode($fields, '');
        }
        break;
    }
    case 'editCode':
    {
        if (isset($_POST['action']) & $_POST['action'] == 'update')
        {
            $product->editCode($_POST);
        }
        else
        {
            $input['product_code_id']=$_GET['code_id'];
            $product->editFormCode($input, '');
        }
        break;
    }

    case 'deleteCompany':
        if(isset($_GET['id']))
        {
            $Company->deleteCompanies($_GET['id']);
        }
        break;

    case 'trashCompany':
        if(isset($_GET['id']))
        {
            $Company->trashCompanies($_GET['id']);
        }
        break;

    case 'recycleCompany':
        if(isset($_GET['id']))
        {
            $Company->recycleCompanies($_GET['id']);
        }
        break;

    case 'searchCode':
        $product->searchCode($_GET);
        break;
    case 'showCode':
        $product->showAllCode($_GET['product_id']);
        break;

    case 'showDetail':
        $member->showDetail($_GET['invoice_id']);
        break;

    case 'search':
        $member->search($_GET);
        break;
    default:
        $member->showAllInvoice("");
        break;
}
