<?php

include_once dirname(__FILE__) . '/model/admin.company.controller.php';

global $admin_info, $PARAM;
$companyController = new adminCompanyController();
if (isset($exportType)) {
    $companyController->exportType = $exportType;
}


switch ($_GET['action']) {
    case 'expired':
        checkPermissions('showExpiredList', 'company');
        $companyController->showExpiredList();
        break;

    case 'unverified':
        checkPermissions('showUnverifiedList', 'company');
        $companyController->showUnverifiedList();
        break;
    case 'checkLegalCompany':
        if ($companyController->checkNationalIdCount($_POST['national_id'])) {
            $companyController->checkLegalCompany($_POST);
        } else {

            redirectPage(RELA_DIR . "admin/?component=company&action=add&type=1", 'تعداد اعداد شناسه ملی نباید بیشتر از 11 باشد ');
        }

        break;
    case 'checkRealCompany':
        $companyController->checkRealCompany($_POST);
        break;
    case 'add':
        checkPermissions('addCompany', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'add') {
            $companyController->addCompany($_POST, $_FILES['companyLicence']);
        } else {
            $companyController->showCompanyAddForm($_GET['type'], '');
        }
        break;

    case 'edit':

        checkPermissions('editCompany', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {

            $companyController->editCompany($_POST, $_FILES);
        } else {
            $input['Company_id'] = $_GET['id'];
            $input['showStatus'] = $_GET['showStatus'];
            $companyController->showCompanyEditForm($input, '');
        }
        break;

    case 'delete':
        checkPermissions('deleteCompany', 'company');
        //        $companyController->deleteCompany($_GET['id']);
        $companyController->deleteCompanyWithAllInformation($_GET['id']);
        break;

    case 'printCompanyInformation':
        if (!empty($_POST)) {
            $input['fields'] = $_POST;
        }
        $input['company_id'] = $_GET['id'];
        $companyController->printCompanyInformation($input);
        break;
    case 'printCompanyInformationExhibition':
        if (!empty($_POST)) {
            $input['fields'] = $_POST;
        }
        $input['company_id'] = $_GET['id'];
        $companyController->printCompanyInformationExhibition($input);
        break;
    case 'editCompanyInformationForExhibition':
        if (!empty($_POST)) {
            $input['fields'] = $_POST;
        }
        $input['company_id'] = $_GET['id'];
        $companyController->editCompanyInformationForExhibition($input);
        break;
    case 'printAddress':
        $input['company_id'] = $_GET['id'];
        $companyController->printAddress($input);
        break;

    case 'editCompanyInformationForPrint':
        $companyController->editCompanyInformationForPrint($_GET['id']);
        break;

    case 'call':
        checkPermissions('call', 'company');
        $companyController->call($_POST);
        break;

    case 'importCompanies':
        // checkPermissions('importCompanies','company');
        $companyController->importCompanies();
        break;

    case 'updateCity':
        checkPermissions('updateCity', 'company');
        $companyController->updateCity();
        break;

    case 'search':
        checkPermissions('search', 'company');
        $companyController->search($_GET);
        break;

    case 'searchExpire':
        checkPermissions('searchExpire', 'company');
        $companyController->searchExpire($_GET);
        break;

    case 'getCompanyPhone':
        checkPermissions('getCompanyphone', 'company');
        $companyController->getCompanyphone($_POST);
        break;

    case 'searchUnverified':
        checkPermissions('searchUnverified', 'company');
        $companyController->searchUnverified($_GET);
        break;

    case 'addLogo':
        checkPermissions('addLogo', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'addLogo') {
            $companyController->addLogo($_POST, $_FILES['companyLogo']);
        } else {
            $fields['company_id'] = $_GET['id'];
            $companyController->showLogoAddForm($fields);
        }
        break;

    case 'addBanner':
        checkPermissions('addBanner', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'addBanner') {
            $companyController->addBanner($_POST, $_FILES['companyBanner']);
        } else {
            $fields['company_id'] = $_GET['id'];
            $companyController->showBannerAddForm($fields);
        }
        break;

    case 'getCityAjax':
        $companyController->getCityAjax($_POST);
        break;

    case 'getTypeAjax':
        $companyController->getTypeAjax($_POST['type']);
        break;

    case 'getCompanyInfoAjax':
        $companyController->getCompanyInfoAjax($_POST['company_id']);
        break;

    case 'checkUsernameAjax':
        $companyController->checkUsernameAjax($_POST);
        break;

    case 'sendNewPass':
        $companyController->sendNewPass($_GET['id']);
        break;

    case 'editUserPass':
        checkPermissions('editUserPass', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyController->editUserPass($_POST);
        } else {
            $fields['company_id'] = $_GET['id'];

            $companyController->showUserPassEditForm($fields);
        }
        break;

        //------> new company
    case 'showNewCompany':
        $companyController->showNewCompany();
        break;

    case 'searchNewCompany':
        $companyController->searchNewCompany($_GET);
        break;

    case 'checkNewCompany':
        checkPermissions('checkNewCompany', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'check') {
            $_POST['companyLogo'] = $_FILES['companyLogo'];
            $companyController->check($_POST, $_FILES['image']);
        } else {
            $input['company_id'] = $_GET['id'];
            $companyController->showCheckForm($input);
        }
        break;

        //------> wiki
    case 'showWiki':
        $companyController->showWiki();
        break;
    case 'checkWikiPreviousVersion':
        if (isset($_POST['action']) & $_POST['action'] == 'check') {
            $companyController->checkWikiPreviousVersion($_POST, $_FILES['image']);
        } else {
            $input['company_d_id'] = $_GET['id'];
            $companyController->showWikiPreviousVersionForm($input);
        }
        break;
    case 'searchWiki':
        $companyController->searchWiki($_GET);
        break;
    case 'checkWikiCompany':
        if (isset($_POST['action']) & $_POST['action'] == 'check') {
            $companyController->checkWiki($_POST, $_FILES['image']);
        } else {
            $input['company_d_id'] = $_GET['id'];
            $companyController->showCheckWikiForm($input);
        }
        break;

        //------> Draft
    case 'showDraftCompany':
        checkPermissions('showDraftCompany', 'company');
        $companyController->showDraftCompany();
        break;

    case 'searchDraft':
        checkPermissions('searchDraft', 'company');
        $companyController->searchDraft($_GET);
        break;

    case 'editDraft':
        // checkPermissions('editCompany', 'company');
        if (isset($_POST['action']) & $_POST['action'] == 'edit') {
            $companyController->editDraft($_POST, $_FILES['catalog']);
        } else {

            $input['Company_id'] = $_GET['id'];
            $input['showStatus'] = $_GET['showStatus'];
            $companyController->showCompanyDraftEditForm($input, '');
        }
        break;

        //------> Import Data in DataBase
    case 'importCompanyPhones':
        checkPermissions('importCompanyPhones', 'company');
        $companyController->importCompanyPhones();
        break;
    case 'importCompanyEmails':
        checkPermissions('importCompanyEmails', 'company');
        $companyController->importCompanyEmails();
        break;
    case 'importCompanyAddresses':
        checkPermissions('importCompanyAddresses', 'company');
        $companyController->importCompanyAddresses();
        break;
    case 'importCompanyWebsites':
        checkPermissions('importCompanyWebsites', 'company');
        $companyController->importCompanyWebsites();
        break;

        //------> Lock
    case 'showBlock':
        $companyController->showCompanyBlock($_GET);
        break;

    case 'searchLock':

        $companyController->searchLock($_GET);
        break;

    case 'showLockById':
        $companyController->showLockById($_GET);
        break;

    case 'searchLockById':
        $companyController->searchLockById($_GET);
        break;

    case 'showCompanyDifference':
        $companyController->showDifference((int)$_GET['id']);
        break;

    case 'convertToEnglish':
        $companyController->convertToEnglish();
        break;

    case 'featch':
        $companyController->a();
        break;

    case 'deFeatch':
        $companyController->deFeatch();
        break;

    case 'sendSMS':
        $companyController->sendSMS($_GET['id']);
        break;

    case 'showDetail':
        $companyController->showDetail($_GET['id']);
        break;

    default:
        checkPermissions('showList', 'company');
        $companyController->showList($msg);
        break;
}
