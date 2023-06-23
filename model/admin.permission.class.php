<?php
class clsPermissionsPage
{
    private $_action;
    private $_startPoint;
    private $_scriptName;
    private $_index;
    private $_base;

//******************************************
    function __construct($index, $base, $scriptName = '')
    {
        $this->_setPoint($index, $base);
        if (strlen($scriptName) == 0) {
            $this->_scriptName = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);
        } else {
            $this->_scriptName = $scriptName;
        }
    }

//******************************************
    public function __get($field)
    {
        if ($field == 'action') {
            return $this->_action;
        }
    }

//******************************************
    function __call($method, $args)
    {
        $method = '_' . $method;

        if (method_exists($this, $method)) {
            switch ($method) :
                case "_addAction" :
                    return $this->$method($args[0]);
                    break;
                case "_check" :
                    return $this->$method($args);
                    break;
                case "_getPointAction" :
                    return $this->$method($args[0]);
                    break;


            endswitch;
        }

    }

//******************************************
    private function _setPoint($index, $base)
    {

        $this->_index = $index;
        $this->_base = $base;
        $this->_startPoint = ($index - 1) * $base + 1;
    }

//*****************************************
    private function _setAction($args)
    {
        $this->_action[$args['action']]['action'] = $args['action'];//_setActionAction($args['action']);
        $this->_action[$args['action']]['code'] = $args['code'];//_setActioncode($args['code']);
        $this->_action[$args['action']]['label'] = $args['label'];    //_setActionlabel($args['label']);

    }

//******************************************
    private function _addAction($args)
    {
        $this->_setAction($args);
        $return['result'] = 1;
        $return['msgNo'] = 1;
        $return['msg'] = "Permission Added Successfully";

        return ($return);

    }

//******************************************
    private function _getPointAction($args)
    {

        return ($this->_startPoint + $this->_action[$args]['code'] - 1);

    }


//******************************************
    private function _check($args)
    {

        $action = $args[0];
        $code = $args[1];
        //echo '<pre/>';
        //print_r($args);
        if (isset($this->_action[$action])) {
            //$this->_action[$action]['code'].'<br/>';
            if ($code[$this->_startPoint + ($this->_action[$action]['code']) - 2] == 1) {

                $return['result'] = 1;
                $return['msgNo'] = 2;
                $return['msg'] = "";
                return ($return);
            } else {
                $return['result'] = -1;
                $return['msgNo'] = 3;
                $return['msg'] = "You Dont Have Permission To Access This " . $action;
                return ($return);


            }
        }


    }

//******************************************

}

//******************************************
function getAllPermisssion()
{
    $len = COUNT_PERMISSION;

    //******************** article **********************//
    $PagePermission['article'] = new clsPermissionsPage(1, $len);
    $PagePermission['article']->addAction(array('action' => 'addArticle', 'code' => 1, 'label' => PERMISSION_01));//addArticle
    $PagePermission['article']->addAction(array('action' => 'editArticle', 'code' => 2, 'label' => PERMISSION_02));//editArticle
    $PagePermission['article']->addAction(array('action' => 'deleteArticle', 'code' => 3, 'label' => PERMISSION_03));//deleteArticle
    $PagePermission['article']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));//showListArticle

    //******************** advertise **********************//
    $PagePermission['advertise'] = new clsPermissionsPage(2, $len);
    $PagePermission['advertise']->addAction(array('action' => 'addAdvertise', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['advertise']->addAction(array('action' => 'editAdvertise', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['advertise']->addAction(array('action' => 'deleteAdvertise', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['advertise']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));

    //******************** banner **********************//
    $PagePermission['banner'] = new clsPermissionsPage(3, $len);
    $PagePermission['banner']->addAction(array('action' => 'addBanner', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['banner']->addAction(array('action' => 'editBanner', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['banner']->addAction(array('action' => 'deleteBanner', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['banner']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));

    //******************** businessLicence **********************//
    $PagePermission['businessLicence'] = new clsPermissionsPage(4, $len);
    $PagePermission['businessLicence']->addAction(array('action' => 'addBusinessLicence', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['businessLicence']->addAction(array('action' => 'editBusinessLicence', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['businessLicence']->addAction(array('action' => 'deleteBusinessLicence', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['businessLicence']->addAction(array('action' => 'editDraftBusinessLicence', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['businessLicence']->addAction(array('action' => 'showDraftBusinessLicence', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['businessLicence']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** category **********************//
    $PagePermission['category'] = new clsPermissionsPage(5, $len);
    $PagePermission['category']->addAction(array('action' => 'addCategory', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['category']->addAction(array('action' => 'editCategory', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['category']->addAction(array('action' => 'deleteCategory', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['category']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));

//******************** certification **********************//
    $PagePermission['certification'] = new clsPermissionsPage(6, $len);
    $PagePermission['certification']->addAction(array('action' => 'addCertification', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['certification']->addAction(array('action' => 'editCertification', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['certification']->addAction(array('action' => 'deleteCertification', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['certification']->addAction(array('action' => 'addCompanyCertification', 'code' => 4, 'label' => PERMISSION_07));
    $PagePermission['certification']->addAction(array('action' => 'editCompanyCertification', 'code' => 5, 'label' => PERMISSION_08));
    $PagePermission['certification']->addAction(array('action' => 'deleteCompanyCertification', 'code' => 6, 'label' => PERMISSION_09));
    $PagePermission['certification']->addAction(array('action' => 'showCompanyCertification', 'code' => 7, 'label' => PERMISSION_10));
    $PagePermission['certification']->addAction(array('action' => 'editDraftCertification', 'code' => 8, 'label' => PERMISSION_05));
    $PagePermission['certification']->addAction(array('action' => 'showDraftCertification', 'code' => 9, 'label' => PERMISSION_06));
    $PagePermission['certification']->addAction(array('action' => 'showList', 'code' => 10, 'label' => PERMISSION_04));

    //******************** company **********************//
    $PagePermission['company'] = new clsPermissionsPage(7, $len);
    $PagePermission['company']->addAction(array('action' => 'showExpiredList', 'code' => 1, 'label' => PERMISSION_11));
    $PagePermission['company']->addAction(array('action' => 'showUnverifiedList', 'code' => 2, 'label' => PERMISSION_12));
    $PagePermission['company']->addAction(array('action' => 'addCompany', 'code' => 3, 'label' => PERMISSION_01));
    $PagePermission['company']->addAction(array('action' => 'editCompany', 'code' => 4, 'label' => PERMISSION_02));
    $PagePermission['company']->addAction(array('action' => 'deleteCompany', 'code' => 5, 'label' => PERMISSION_03));
    $PagePermission['company']->addAction(array('action' => 'call', 'code' => 6, 'label' => PERMISSION_06));
    $PagePermission['company']->addAction(array('action' => 'importCompanies', 'code' => 7, 'label' => PERMISSION_13));
    $PagePermission['company']->addAction(array('action' => 'updateCity', 'code' => 8, 'label' => PERMISSION_14));
    $PagePermission['company']->addAction(array('action' => 'importCompanyPhones', 'code' => 9, 'label' => PERMISSION_15));
    $PagePermission['company']->addAction(array('action' => 'importCompanyEmails', 'code' => 10, 'label' => PERMISSION_16));
    $PagePermission['company']->addAction(array('action' => 'importCompanyAddresses', 'code' => 11, 'label' => PERMISSION_17));
    $PagePermission['company']->addAction(array('action' => 'importCompanyWebsites', 'code' => 12, 'label' => PERMISSION_18));
    $PagePermission['company']->addAction(array('action' => 'search', 'code' => 13, 'label' => PERMISSION_19));
    $PagePermission['company']->addAction(array('action' => 'searchExpire', 'code' => 14, 'label' => PERMISSION_20));
    $PagePermission['company']->addAction(array('action' => 'searchUnverified', 'code' => 15, 'label' => PERMISSION_21));
    $PagePermission['company']->addAction(array('action' => 'getCompanyphone', 'code' => 16, 'label' => PERMISSION_22));
    $PagePermission['company']->addAction(array('action' => 'addLogo', 'code' => 17, 'label' => PERMISSION_23));
    $PagePermission['company']->addAction(array('action' => 'addBanner', 'code' => 18, 'label' => PERMISSION_24));
    $PagePermission['company']->addAction(array('action' => 'showDraftCompany', 'code' => 19, 'label' => PERMISSION_06));
    $PagePermission['company']->addAction(array('action' => 'searchDraft', 'code' => 20, 'label' => PERMISSION_25));
    $PagePermission['company']->addAction(array('action' => 'showList', 'code' => 21, 'label' => PERMISSION_04));
    $PagePermission['company']->addAction(array('action' => 'editUserPass', 'code' => 22, 'label' => PERMISSION_26));
    $PagePermission['company']->addAction(array('action' => 'checkNewCompany', 'code' => 23, 'label' => PERMISSION_30));

    //******************** companyAddresses **********************//
    $PagePermission['companyAddresses'] = new clsPermissionsPage(8, $len);
    $PagePermission['companyAddresses']->addAction(array('action' => 'addCompanyAddresses', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyAddresses']->addAction(array('action' => 'editCompanyAddresses', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyAddresses']->addAction(array('action' => 'deleteCompanyAddresses', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyAddresses']->addAction(array('action' => 'editDraftCompanyAddress', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyAddresses']->addAction(array('action' => 'showDraftCompanyAddress', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyAddresses']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companyBanner **********************//
    $PagePermission['companyBanner'] = new clsPermissionsPage(9, $len);
    $PagePermission['companyBanner']->addAction(array('action' => 'addCompanyBanner', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyBanner']->addAction(array('action' => 'editCompanyBanner', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyBanner']->addAction(array('action' => 'deleteCompanyBanner', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyBanner']->addAction(array('action' => 'editDraftCompanyBanner', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyBanner']->addAction(array('action' => 'showDraftCompanyBanner', 'code' => 5, 'label' => PERMISSION_06));

    //******************** companyCommercialName **********************//
    $PagePermission['companyCommercialName'] = new clsPermissionsPage(10, $len);
    $PagePermission['companyCommercialName']->addAction(array('action' => 'addCompanyCommercialName', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyCommercialName']->addAction(array('action' => 'editCompanyCommercialName', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyCommercialName']->addAction(array('action' => 'deleteCompanyCommercialName', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyCommercialName']->addAction(array('action' => 'editDraftCompanyCommercialName', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyCommercialName']->addAction(array('action' => 'showDraftCompanyCommercialName', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyCommercialName']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

//******************** companyEmails **********************//
    $PagePermission['companyEmails'] = new clsPermissionsPage(11, $len);
    $PagePermission['companyEmails']->addAction(array('action' => 'addCompanyEmails', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyEmails']->addAction(array('action' => 'editCompanyEmails', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyEmails']->addAction(array('action' => 'deleteCompanyEmails', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyEmails']->addAction(array('action' => 'editDraftCompanyEmail', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyEmails']->addAction(array('action' => 'showDraftCompanyEmail', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyEmails']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companyLogo **********************//
    $PagePermission['companyLogo'] = new clsPermissionsPage(12, $len);
    $PagePermission['companyLogo']->addAction(array('action' => 'addCompanyLogo', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyLogo']->addAction(array('action' => 'editCompanyLogo', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyLogo']->addAction(array('action' => 'deleteCompanyLogo', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyLogo']->addAction(array('action' => 'editDraftCompanyLogo', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyLogo']->addAction(array('action' => 'showDraftCompanyLogo', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyLogo']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companyNews **********************//
    $PagePermission['companyNews'] = new clsPermissionsPage(13, $len);
    $PagePermission['companyNews']->addAction(array('action' => 'addCompanyNews', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyNews']->addAction(array('action' => 'editCompanyNews', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyNews']->addAction(array('action' => 'deleteCompanyNews', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyNews']->addAction(array('action' => 'editDraftCompanyNews', 'code' => 5, 'label' => PERMISSION_05));
    $PagePermission['companyNews']->addAction(array('action' => 'showDraftCompanyNews', 'code' => 4, 'label' => PERMISSION_06));
    $PagePermission['companyNews']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companyPhones **********************//
    $PagePermission['companyPhones'] = new clsPermissionsPage(14, $len);
    $PagePermission['companyPhones']->addAction(array('action' => 'addCompanyPhones', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyPhones']->addAction(array('action' => 'editCompanyPhones', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyPhones']->addAction(array('action' => 'deleteCompanyPhones', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyPhones']->addAction(array('action' => 'editDraftCompanyPhones', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyPhones']->addAction(array('action' => 'showDraftCompanyPhones', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyPhones']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companyWebsites **********************//
    $PagePermission['companyWebsites'] = new clsPermissionsPage(15, $len);
    $PagePermission['companyWebsites']->addAction(array('action' => 'addCompanyWebsites', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companyWebsites']->addAction(array('action' => 'editCompanyWebsites', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companyWebsites']->addAction(array('action' => 'deleteCompanyWebsites', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companyWebsites']->addAction(array('action' => 'editDraftCompanyWebsites', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companyWebsites']->addAction(array('action' => 'showDraftCompanyWebsites', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companyWebsites']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** companySocials **********************//
    $PagePermission['companySocials'] = new clsPermissionsPage(16, $len);
    $PagePermission['companySocials']->addAction(array('action' => 'addCompanySocials', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['companySocials']->addAction(array('action' => 'editCompanySocials', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['companySocials']->addAction(array('action' => 'deleteCompanySocials', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['companySocials']->addAction(array('action' => 'editDraftCompanySocials', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['companySocials']->addAction(array('action' => 'showDraftCompanySocials', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['companySocials']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));


    //******************** history **********************//
    $PagePermission['history'] = new clsPermissionsPage(17, $len);
    $PagePermission['history']->addAction(array('action' => 'addHistory', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['history']->addAction(array('action' => 'editHistory', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['history']->addAction(array('action' => 'deleteHistory', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['history']->addAction(array('action' => 'editDraftHistory', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['history']->addAction(array('action' => 'showDraftHistory', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['history']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** honour **********************//
    $PagePermission['honour'] = new clsPermissionsPage(18, $len);
    $PagePermission['honour']->addAction(array('action' => 'addHonour', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['honour']->addAction(array('action' => 'editHonour', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['honour']->addAction(array('action' => 'deleteHonour', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['honour']->addAction(array('action' => 'editDraftHonour', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['honour']->addAction(array('action' => 'showDraftHonour', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['honour']->addAction(array('action' => 'showList', 'code' => 5, 'label' => PERMISSION_04));

    //******************** invoice **********************//
    $PagePermission['invoice'] = new clsPermissionsPage(19, $len);
    $PagePermission['invoice']->addAction(array('action' => 'editInvoice', 'code' => 1, 'label' => PERMISSION_02));
    $PagePermission['invoice']->addAction(array('action' => 'showList', 'code' => 2, 'label' => PERMISSION_04));

    //******************** licence **********************//
    $PagePermission['licence'] = new clsPermissionsPage(20, $len);
    $PagePermission['licence']->addAction(array('action' => 'addLicence', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['licence']->addAction(array('action' => 'editLicence', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['licence']->addAction(array('action' => 'deleteLicence', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['licence']->addAction(array('action' => 'editDraftLicence', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['licence']->addAction(array('action' => 'showDraftLicence', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['licence']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** package **********************//
    $PagePermission['package'] = new clsPermissionsPage(21, $len);
    $PagePermission['package']->addAction(array('action' => 'addPackage', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['package']->addAction(array('action' => 'editPackage', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['package']->addAction(array('action' => 'deletePackage', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['package']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));

//******************** packageUsage **********************//
    $PagePermission['packageUsage'] = new clsPermissionsPage(22, $len);
    $PagePermission['packageUsage']->addAction(array('action' => 'editPackageUsage', 'code' => 1, 'label' => PERMISSION_02));
    $PagePermission['packageUsage']->addAction(array('action' => 'showList', 'code' => 2, 'label' => PERMISSION_04));

    //******************** product **********************//
    $PagePermission['product'] = new clsPermissionsPage(23, $len);
    $PagePermission['product']->addAction(array('action' => 'addProduct', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['product']->addAction(array('action' => 'editProduct', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['product']->addAction(array('action' => 'deleteProduct', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['product']->addAction(array('action' => 'editDraftProduct', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['product']->addAction(array('action' => 'showDraftProduct', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['product']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    //******************** admin **********************//
    $PagePermission['admin'] = new clsPermissionsPage(24, $len);
    $PagePermission['admin']->addAction(array('action' => 'addAdmin', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['admin']->addAction(array('action' => 'editAdmin', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['admin']->addAction(array('action' => 'showSetTask', 'code' => 3, 'label' => PERMISSION_27));
    $PagePermission['admin']->addAction(array('action' => 'deleteAdmin', 'code' => 4, 'label' => PERMISSION_03));
    $PagePermission['admin']->addAction(array('action' => 'showList', 'code' => 5, 'label' => PERMISSION_04));
    //******************** categoryBanner **********************//
    $PagePermission['categoryBanner'] = new clsPermissionsPage(25, $len);
    $PagePermission['categoryBanner']->addAction(array('action' => 'addCategoryBanner', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['categoryBanner']->addAction(array('action' => 'editCategoryBanner', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['categoryBanner']->addAction(array('action' => 'deleteCategoryBanner', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['categoryBanner']->addAction(array('action' => 'showList', 'code' => 4, 'label' => PERMISSION_04));

    //******************** categoryBanner **********************//
    $PagePermission['crm'] = new clsPermissionsPage(26, $len);
    $PagePermission['crm']->addAction(array('action' => 'tasks', 'code' => 1, 'label' => PERMISSION_28));
    $PagePermission['crm']->addAction(array('action' => 'allLogs', 'code' => 2, 'label' => PERMISSION_29));

    //******************** employment **********************//
    $PagePermission['employment'] = new clsPermissionsPage(27, $len);
    $PagePermission['employment']->addAction(array('action' => 'addEmployment', 'code' => 1, 'label' => PERMISSION_01));
    $PagePermission['employment']->addAction(array('action' => 'editEmployment', 'code' => 2, 'label' => PERMISSION_02));
    $PagePermission['employment']->addAction(array('action' => 'deleteEmployment', 'code' => 3, 'label' => PERMISSION_03));
    $PagePermission['employment']->addAction(array('action' => 'editDraftEmployment', 'code' => 4, 'label' => PERMISSION_05));
    $PagePermission['employment']->addAction(array('action' => 'showDraftList', 'code' => 5, 'label' => PERMISSION_06));
    $PagePermission['employment']->addAction(array('action' => 'showList', 'code' => 6, 'label' => PERMISSION_04));

    return ($PagePermission);


    //******************************************

}