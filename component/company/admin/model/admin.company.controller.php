<?php

/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/admin.company.model.php';
include_once dirname(__FILE__) . '/admin.companyDraft.model.php';
include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhones.controller.php';

include_once ROOT_DIR . 'component/log/admin/model/admin.log.controller.php';
include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.company.model.php';
include_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsites.controller.php';
include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhones.model.php';
include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhonesDraft.model.php';
include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.model.php';
include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddressesDraft.model.php';
include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.model.php';
include_once ROOT_DIR . 'component/onlinePayment/admin/model/admin.onlinePayment.controller.php';
include_once ROOT_DIR . 'component/editorMember/admin/model/admin.editorMember.controller.php';
require_once ROOT_DIR . 'component/emailEngine/admin/Controllers/EmailEngineController.php';
require_once ROOT_DIR . 'component/register/model/register.model.php';
require_once ROOT_DIR . 'component/companyBanner/admin/model/admin.companyBannerDraft.model.php';
require_once ROOT_DIR . 'component/honour/admin/model/admin.honourDraft.model.php';
require_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsitesDraft.model.php';
require_once ROOT_DIR . 'component/businessLicence/admin/model/admin.businessLicenceDraft.model.php';
require_once ROOT_DIR . 'component/companyCommercialName/admin/model/admin.companyCommercialNameDraft.model.php';
require_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmailsDraft.model.php';
require_once ROOT_DIR . 'component/history/admin/model/admin.historyDraft.model.php';
require_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogoDraft.model.php';
require_once ROOT_DIR . 'component/companyNews/admin/model/admin.companyNewsDraft.model.php';
require_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmails.model.php';
require_once ROOT_DIR . 'component/product/admin/model/admin.productDraft.model.php';
require_once ROOT_DIR . 'component/companySocials/admin/model/admin.companySocialsDraft.model.php';
require_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
require_once ROOT_DIR . 'component/login/model/login.model.php';
require_once ROOT_DIR . 'component/editorMember/model/editorMember.model.php';

include_once ROOT_DIR . 'component/companyAddresses/member/model/companyAddresses.controller.php';
include_once ROOT_DIR . 'component/companyPhones/member/model/companyPhones.controller.php';
include_once ROOT_DIR . 'component/certification/member/model/certification.controller.php';
include_once ROOT_DIR . 'component/businessLicence/member/model/businessLicence.controller.php';
include_once ROOT_DIR . 'component/companyBanner/member/model/companyBanner.controller.php';
include_once ROOT_DIR . 'component/companyCommercialName/member/model/companyCommercialName.controller.php';
include_once ROOT_DIR . 'component/companyEmails/member/model/companyEmails.controller.php';
include_once ROOT_DIR . 'component/companyWebsites/member/model/companyWebsites.controller.php';
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.controller.php';
include_once ROOT_DIR . 'component/companyLogo/member/model/companyLogo.controller.php';
include_once ROOT_DIR . 'component/companyNews/member/model/companyNews.controller.php';
include_once ROOT_DIR . 'component/history/member/model/history.controller.php';
include_once ROOT_DIR . 'component/honour/member/model/honour.controller.php';
include_once ROOT_DIR . 'component/licence/member/model/licence.controller.php';
include_once ROOT_DIR . 'component/product/member/model/member.product.controller.php';
include_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogo.model.php';
include_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogoDraft.model.php';
include_once ROOT_DIR . 'component/Services/CompanyService.php';
include_once ROOT_DIR . 'component/invoice/admin/model/admin.invoice.model.php';
include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.model.php';
include_once ROOT_DIR . 'services/compareRealWithDraftCompany/Compare.php';
//include_once ROOT_DIR . "component/onlinePayment/admin/admin.onlinePayment.php";
include_once ROOT_DIR . 'component/onlinePayment/admin/model/admin.onlinePayment.model.php';

/**
 * Class registerController.
 */
class adminCompanyController
{
    /**
     * Contains file type.
     *
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     *
     * @var
     */
    public $fileName;

    private $companyService;

    public function __construct()
    {
        $this->exportType = 'html';
        $this->company = new admincompanyModel();
    }

    public function template($list = [], $msg = '', $showAll = 1)
    {
        global $messageStack, $admin_info;

        switch ($this->exportType) {
            case 'html':
                if ($showAll == 0) {
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                    break;
                }
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_start.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_header.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_rightMenu_admin.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_footer.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/template_end.php';
                break;

            case 'json':
                echo json_encode($list);
                break;

            case 'array':
                return $list;
                break;

            case 'serialize':
                echo serialize($list);
                break;

            default:
                break;
        }
    }

    public function showCompanyAddForm($fields, $msg)
    {
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';

        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax();
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }
        $export['company_type'] = $fields;

        if ($fields == 1) {
            $this->fileName = 'admin.companyLegal.addForm.S1.php';
        } else {
            $this->fileName = 'admin.companyReal.addForm.S1.php';
        }

        $this->template($export, $msg);
        die();
    }

    public function checkLegalCompany($input)
    {
        $result['result'] = '';
        $export = [];
        $export['company_type'] = $input['company_type'];
        $export['national_id'] = $input['national_id'];

        $this->fileName = 'admin.companyLegal.addForm.S2.php';

        //------> Check Company
        $packageStatus = ['3', '4'];
        $companyResult = admincompanyModel::getBy_company_type_and_national_id_and_package_status($input['company_type'], $input['national_id'], $packageStatus)->getList();
        if ($companyResult['export']['recordsCount'] > 0) {
            if ($companyResult['export']['recordsCount'] > 0) {
                $msg = 'این کمپانی قبلا در سایت ثبت شده است';
                redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            }
        }

        $companyResult = admincompanyModel::getBy_company_type_and_national_id_and_package_status_and_status('1', $input['national_id'], '1', '1')->getList();
        if ($companyResult['export']['recordsCount'] > 0) {
            $export['companyInfo'] = $companyResult['export']['list']['0'];
            $phoneResult = adminc_phonesModel::getBy_company_id($companyResult['export']['list']['0']['Company_id'])->getList();
            if ($phoneResult['export']['recordsCount'] > 0) {
                $export['phoneInfo'] = $phoneResult['export']['list']['0'];
            }

            $addressResult = adminc_addressesModel::getBy_company_id($companyResult['export']['list']['0']['Company_id'])->getList();
            if ($addressResult['export']['recordsCount'] > 0) {
                $export['addressInfo'] = $addressResult['export']['list']['0'];
            }

            $emailResult = adminc_emailsModel::getBy_company_id($companyResult['export']['list']['0']['Company_id'])->getList();
            if ($emailResult['export']['recordsCount'] > 0) {
                $export['emailInfo'] = $emailResult['export']['list']['0'];
            }

            $websiteResult = adminc_websitesModel::getBy_company_id($companyResult['export']['list']['0']['Company_id'])->getList();
            if ($websiteResult['export']['recordsCount'] > 0) {
                $export['websiteInfo'] = $websiteResult['export']['list']['0'];
            }

            $LicenceResult = adminc_licencesModel::getBy_company_id_and_status_and_isMain($companyResult['export']['list']['0']['Company_id'], '1', '1')->getList();
            if ($LicenceResult['export']['recordsCount'] > 0) {
                $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            }
        }

        //------> Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax();
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive($companyResult['export']['list']['0']['Company_id'], '1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['licenceInfo']['issuence_date'] = convertDate($export['licenceInfo']['issuence_date']);
            $export['licenceInfo']['expiration_date'] = convertDate($export['licenceInfo']['expiration_date']);
        }

        //------> Get All Category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //------> Get All State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $province = new adminStateModel();
        $resultProvince = $province->getStates();
        if ($resultProvince['result'] == 1) {
            $export['provinces'] = $province->list;
        }

        //------> Get All City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //------> Get All PersonalityType
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityList'] = $resultPersonalityType['export']['list'];
        }

        $this->template($export, $msg);
        die();
    }

    public function checkRealCompany($input)
    {
        $result['result'] = '';
        $export = [];
        $export['company_type'] = $input['company_type'];
        $export['licence_type'] = $input['licence_type'];

        if ($input['licence_type'] == '0') {
            // غیره
            $export['licenceTypeName'] = $input['licenceTypeName'];
        } else {
            $export['licenceTypeName'] = '';
        }

        $export['licence_number'] = $input['licence_number'];
        $this->fileName = 'admin.companyReal.addForm.S2.php';

        //------> غیره
        if ($input['licence_type'] == '0') {
            $LicenceListResult = adminlicence_listModel::getBy_name($input['licenceTypeName'])->getList();
            if ($LicenceListResult['export']['recordsCount'] > 0) {
                $input['licence_type'] = $LicenceListResult['export']['list']['0']['Licence_list_id'];
            }
        }

        // Exist licence
        $LicenceResult = adminc_licencesModel::getBy_licence_number_and_licence_type_and_isMain($input['licence_number'], $input['licence_type'], '1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $packageStatus = ['3', '4'];

            $companyResult = admincompanyModel::getBy_Company_id_and_company_type_and_package_status($LicenceResult['export']['list'][0]['company_id'], $input['company_type'], $packageStatus)->getList();
            if ($companyResult['export']['recordsCount'] > 0) {
                $msg = 'این کمپانی قبلا در سایت ثبت شده است';
                redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            }

            // کمپانی با این اطلاعات
            $companyResult = admincompanyModel::getBy_Company_id_and_company_type_and_package_status_and_status($LicenceResult['export']['list']['0']['company_id'], $input['company_type'], '1', '1')->getList();
            if ($companyResult['export']['recordsCount'] > 0) {
                $export['companyInfo'] = $companyResult['export']['list'][0];

                $phoneResult = adminc_phonesModel::getBy_company_id($export['companyInfo']['Company_id'])->getList();
                if ($phoneResult['export']['recordsCount'] > 0) {
                    $export['phoneInfo'] = $phoneResult['export']['list'][0];
                }

                $emailResult = adminc_emailsModel::getBy_company_id($export['companyInfo']['Company_id'])->getList();
                if ($emailResult['export']['recordsCount'] > 0) {
                    $export['emailInfo'] = $emailResult['export']['list'][0];
                }

                $websiteResult = adminc_websitesModel::getBy_company_id($export['companyInfo']['0']['Company_id'])->getList();
                if ($websiteResult['export']['recordsCount'] > 0) {
                    $export['websiteInfo'] = $websiteResult['export']['list']['0'];
                }
                $addressResult = adminc_addressesModel::getBy_company_id($export['companyInfo']['0']['Company_id'])->getList();
                if ($addressResult['export']['recordsCount'] > 0) {
                    $export['addressInfo'] = $addressResult['export']['list']['0'];
                }

                $LicenceResult = adminc_licencesModel::getBy_company_id_and_status_and_isMain($export['companyInfo']['0']['Company_id'], '1', '1')->getList();
                if ($LicenceResult['export']['recordsCount'] > 0) {
                    $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
                }
            }
        }

        //-------> category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //-------> cities
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //-------> provinces
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $province = new adminStateModel();
        $resultProvince = $province->getStates();
        if ($resultProvince['result'] == 1) {
            $export['provinces'] = $province->list;
        }

        //-------> personalityList
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityList = $personalityType->getPersonalityType();
        if ($resultPersonalityList['result'] == 1) {
            $export['personalityList'] = $resultPersonalityList['export']['list'];
        }

        $this->template($export, $msg);
        die();
    }

    public function addCompany($input, $files)
    {
        global $admin_info;

        $editor_id = $admin_info['admin_id'];
        $company = '';
        $licenceKey = '';
        $isMain = '';

        //        if (!isset($input['category_id'])) {
        //            $msg = "خطا در عملیات دسته بندی انتخاب نشده است";
        //            redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        //        }

        //        if((!isset($input['licenceImage'])) & ($input['company_id']=='2')){
        //            $msg = "تصوبر جواز موجود نیست.";
        //            redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        //        }

        if ($input['company_type'] == '1') {
            // legal company
            $isMain = '0';
        } else {
            // real company
            $isMain = '1';
        }

        if ($input['company_type'] == 1) {
            $packageStatus = ['3', '4'];
            $result = admincompanyModel::getBy_company_type_and_national_id_and_package_status($input['company_type'], $input['national_id'], $packageStatus)->getList();
            if ($result['export']['recordsCount'] > 0) {
                $msg = 'این کمپانی قبلا به صورت تجاری در سایت ثبت شده است';
                redirectPage(RELA_DIR . 'admin/?component=company', $msg);
            }
        }

        if ($input['company_type'] == 2) {
            $input['maneger_name'] = $input['name'] . ' ' . $input['family'];
            //$LicenceResult = adminlicence_listModel::getBy_licence_number_and_licence_type($input['licence_number'], $input['licence_type'])->getList();
            $LicenceResult = adminc_licencesModel::getBy_licence_number_and_licence_type($input['licence_number'], $input['licence_type'])->getList();
            if ($LicenceResult['export']['recordsCount'] > 0) {
                $packageStatus = ['3', '4'];
                $companyResult = admincompanyModel::getBy_Company_id_and_company_type_and_package_status_ismain($LicenceResult['export']['list']['0']['Company_id'], $input['company_type'], $packageStatus)->getList();
                if ($companyResult['export']['recordsCount'] > 0) {
                    $msg = 'این کمپانی قبلا به صورت تجاری در سایت ثبت شده است';
                    redirectPage(RELA_DIR . 'admin/?component=company', $msg);
                }
            }
        }

        if ($input['company_type'] == 2 and trim($input['licenceImage']) == '') {
            $msg = 'تصویر جواز در سایت بارگزاری نشده است';
            redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        }

        if ($input['registration_date'] == null or $input['registration_date'] == '') {
            $msg = 'تاریخ وارد نشده است ';
            redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        }

        if (strlen($input['national_id']) > 11) {
            $input['national_id'] = substr($input['national_id'], 11);
            // $msg = "کد ملی وارد شده طولانی است ";
            // redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        }

        //---->Convert dataFetchAll for Insert

        $input['category_id'] = ',' . $input['category_id']['0'] . ',';
        $input['register_date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $input['editor_id'] = $editor_id;
        $input['edit'] = '0000000000000000000000000';
        $input['package_status'] = 1;
        $input['new_register'] = 1;
        $input['national_id'] = convertToEnglish($input['national_id']);
        $input['registration_number'] = convertToEnglish($input['registration_number']);

        //---->Add to Main
        $companyObject = admincompanyModel::find($input['company_id']);
        if (!is_object($companyObject)) {
            $companyObject = new admincompanyModel();
        }
        $input['registration_date'] = convertJToGDate($input['registration_date']);

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($input);
        $input['parent_category_id'] = $result['parent_category_id'];
        $input['category_id'] = $result['category_id'];

        $companyObject->setFields($input);
        //dd($companyObject);
        $companyObject->parent_id;
        $companyObject->status = -1;
        $companyObject->refresh_date = date('Y-m-d');
        $companyObject->old_priority = 0;
        $companyObject->state_id = $companyObject->state_id == '' ? 0 : $companyObject->state_id;

        $companyObject->save();

        //---->Add to Company_d
        $companyDraftObject = new admincompany_dModel();
        $companyDraftObject->setFields($input);
        $companyDraftObject->company_id = $companyObject->Company_id;
        $companyDraftObject->editor_id = 1;
        $companyDraftObject->isActive = 1;
        $companyDraftObject->isAdmin = 1;
        $companyDraftObject->status = -1;
        $companyDraftObject->refresh_date = date('Y-m-d');
        $companyDraftObject->old_priority = 0;
        $companyDraftObject->admin_description = '';
        $companyDraftObject->save();

        //---->Add to phone_d Table
        $phoneDraftObject = new adminc_phones_dModel();
        $phoneDraftObject->subject = 'مرکزی';
        $phoneDraftObject->number = convertToEnglish($input['phone']);
        $phoneDraftObject->code = convertToEnglish($input['code']);
        $phoneDraftObject->company_id = $companyObject->Company_id;
        $phoneDraftObject->company_d_id = $companyDraftObject->Company_d_id;
        $phoneDraftObject->phones_id = 0;
        $phoneDraftObject->reference_type = $input['reference_type'];
        $phoneDraftObject->reference_value = $input['reference_value'];
        $phoneDraftObject->editor_id = 1;
        $phoneDraftObject->isActive = 1;
        $phoneDraftObject->isAdmin = 1;
        $phoneDraftObject->isMain = 1;
        $phoneDraftObject->status = -1;
        $phoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $phoneDraftObject->branch_id = 0;
        $phoneDraftObject->admin_description = '';
        $phoneDraftObject->save();

        //---->Add to website_d Table
        $phoneDraftObject = new admincompany_websitesController();
        $input['status'] = -1;
        $input['isActive'] = 1;
        $input['company_id'] = $companyObject->Company_id;
        $phoneDraftObject->addWebsiteToDraft($input);

        //---->Add to Address_d Table
        $addressDraftObject = new adminc_addresses_dModel();
        $addressDraftObject->subject = 'مرکزی';
        $addressDraftObject->address = $input['address'];
        $addressDraftObject->postal_code = $input['postal_code'];
        $addressDraftObject->company_id = $companyObject->Company_id;
        $addressDraftObject->company_d_id = $companyDraftObject->Company_d_id;
        $addressDraftObject->addresses_id = 0;
        $addressDraftObject->editor_id = 1;
        $addressDraftObject->isMain = 1;
        $addressDraftObject->isActive = 1;
        $addressDraftObject->isAdmin = 1;
        $addressDraftObject->status = -1;
        $addressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $addressDraftObject->branch_id = 0;
        $addressDraftObject->admin_description = '';
        $addressDraftObject->save();

        //---->Add to Email_d Table
        $emailDraftObject = new adminc_emails_dModel();
        $emailDraftObject->subject = 'مرکزی';
        $emailDraftObject->email = $input['email'];
        $emailDraftObject->company_id = $companyObject->Company_id;
        $emailDraftObject->emails_id = 0;
        $emailDraftObject->editor_id = 1;
        $emailDraftObject->isMain = 1;
        $emailDraftObject->isActive = 1;
        $emailDraftObject->isAdmin = 1;
        $emailDraftObject->status = -1;
        $emailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $emailDraftObject->company_d_id = 0;
        $emailDraftObject->branch_id = 0;
        $emailDraftObject->admin_description = '';

        $emailDraftObject->save();

        //---->Add to logo
        if (!empty($input['logoImage'])) {
            $uploader = new Uploader();
            $property = ['image' => $input['logoImage'], 'company_id' => $input['company_id'], 'folder_name' => 'logo'];
            $sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];
            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];

            //---->Save Logo image
            $newLogoObject = new adminc_logo_dModel();
            $newLogoObject->image = $fields['image'];
            $newLogoObject->company_id = $companyObject->Company_id;
            $newLogoObject->status = -1;
            $newLogoObject->isActive = 1;
            $newLogoObject->isAdmin = 1;
            $newLogoObject->logo_id = 0;
            $newLogoObject->editor_id = $editor_id;
            $newLogoObject->admin_description = '';
            $newLogoObject->title = '';
            $newLogoObject->description = '';
            $newLogoObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLogoObject->save();
        }

        //----> Add to EditorMember
        $editor = [];
        $editor['name'] = $input['editor_name'];
        $editor['family'] = $input['editor_family'];
        $editor['phone'] = $input['editor_phone'];
        $editor['company_id'] = $companyDraftObject->company_id;
        $editor['company_d_id'] = $companyDraftObject->Company_d_id;
        $editorMember = new adminEditorMemberController();
        $editorMember->addMember($editor);

        if (trim($input['licence_type']) != '') {
            if ($input['licence_type'] == '0') {
                $licenceResult = adminlicence_listModel::getBy_name(trim($input['licenceTypeName']))->getList();
                if ($licenceResult['export']['recordsCount'] > 0) {
                    $licenceKey = $licenceResult['export']['list']['0']['Licence_list_id'];
                } else {
                    //---->Add to licence-list Table
                    $licenceListObject = new adminlicence_listModel();
                    $licenceListObject->status = 0;
                    $licenceListObject->name = $input['licenceTypeName'];
                    $licenceListObject->save();
                    $licenceKey = $licenceListObject->Licence_list_id;
                }
            } else {
                $licenceKey = $input['licence_type'];
            }

            //---->Save Licence Image
            if (!empty($input['licenceImage'])) {
                $uploader = new Uploader();
                $property = ['image' => $input['licenceImage'], 'company_id' => $input['company_id'], 'folder_name' => 'licence'];
                //$sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];
                $result = $uploader->cropAndCompressImage($property, $sizes);
                $licenceImage = $result['image'];
            }

            //---->Add to licence Table
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->licence_number = $input['licence_number'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->national_code = $input['national_code'];
            $newLicenceObject->licence_type = $licenceKey;
            $newLicenceObject->issuence_date = convertJToGDate($input['issuence_date']);
            $newLicenceObject->expiration_date = ($input['expiration_date'] != '') ? convertJToGDate($input['expiration_date']) : date('Y-m-d');
            $newLicenceObject->exporter_refrence = $input['exporter_refrence'];
            $newLicenceObject->description = $input['description'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->company_id = $companyObject->Company_id;
            $newLicenceObject->company_d_id = $companyDraftObject->Company_d_id;
            $newLicenceObject->name = $input['name'];
            $newLicenceObject->family = $input['family'];
            $newLicenceObject->status = -1;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->image = $licenceImage;
            $newLicenceObject->isMain = $isMain;
            $newLicenceObject->parent_id = 0;
            $newLicenceObject->admin_description = '';

            //            //---->Save Licence image
            //            $field['image'] = '';
            //            $field['status'] = '1';
            //            $fields['Banner_id'] = '';
            //            $file['name'] = $files['name'];
            //            $file['type'] = $files['type'];
            //            $file['tmp_name'] = $files['tmp_name'];
            //            $file['error'] = $files['error'];
            //            $file['size'] = $files['size'];
            //            $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $companyObject->Company_id . "/licence/");
            //
            //            $result_uploader = fileUploader($Property, $file);
            //            $field['image'] = $result_uploader['image_name'];

            $newLicenceObject->image = $licenceImage;

            $newLicenceObject->save();

            $newLicenceObject->parent_id = $newLicenceObject->Licence_id;
            $newLicenceObject->save();
        }

        calculateScoreCompany($companyObject->Company_id);
        $msg = 'ثبت نام با موفقیت انجام شد.';
        redirectPage(RELA_DIR . 'admin/?component=company&action=showNewCompany', $msg);
        die();
    }

    public function editLegalCompany($input, $files)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $category = '';
        $metaKeyWord = '';
        $metaDescription = '';
        if ($input['company_type'] == '1') {
            $isMain = '0';
        } else {
            $isMain = '1';
        }

        //------> Check Company
        $companyObject = admincompanyModel::find($input['company_id']);
        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }
        $companyResult = admincompanyModel::getBy_national_id_and_not_company_id(convertToEnglish($input['national_id']), $input['company_id'])->first();

        if (is_object($companyResult)) {
            $msg = 'کمپانی با شناسه ملی مشابه وجود دارد.';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        //------> convert variable
        if ($companyObject->package_status == 4) {
            $category = implode(',', $input['category_id']);
            $metaKeyWord = $input['meta_keyword'];
            $memberEmail = $input['email'];
            $memberMobile = $input['mobile'];
            $memberName = $input['memberName'];
            $memberFamily = $input['memberFamily'];
        } else {
            $category = arrayToTag($input['category_id'])['export']['list'];
            $metaKeyWord = '';
        }

        $registration_date = convertJToGDate($input['registration_date']);

        //------> Add Catalog
        if (isset($files['catalog'])) {
            if ($input['remove-file'] == 'on') {
                $input['catalog'] = '';
            } else {
                if ($files['catalog'] != '') {
                    $Property = ['type' => 'jpg,png,jpeg,pdf', 'new_name' => $files['catalog']['name'], 'max_size' => '20971520', 'upload_dir' => COMPANY_ADDRESS_ROOT . $input['company_id'] . '/catalog/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];
                    $result_uploader = fileUploader($Property, $files['catalog']);
                    $input['catalog'] = $result_uploader['image_name'];
                } else {
                    $input['catalog'] = $companyObject->image;
                }
            }
        }

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($input);
        $input['parent_category_id'] = $result['parent_category_id'];
        $input['category_id'] = $result['category_id'];

        //----> update Company Table
        $companyObject->setFields($input);
        $companyObject->category_id = $category;
        $companyObject->registration_date = $registration_date;
        $companyObject->registration_number = convertToEnglish($input['registration_number']);
        $companyObject->national_id = convertToEnglish($input['national_id']);
        $companyObject->status = 1;
        $companyObject->meta_keyword = $metaKeyWord;
        $companyObject->meta_description = $input['meta_description'];
        $companyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $companyObject->save();

        //-------------------------------------
        $companyObject->category()->detach();

        $categoryArray = tagToArray($input['category_id'])['export']['list'];
        $parentCategoryArray = tagToArray($input['parent_category_id'])['export']['list'];
        $mainArray = array_merge($categoryArray, $parentCategoryArray);
        $companyObject->category()->attach($mainArray);

        //-------------------------------------

        //------> update Company_d Table
        $companyDraftObject = admincompany_dModel::getBy_company_id_and_isActive_and_status($input['company_id'], '1', '1')->first();
        if (is_object($companyDraftObject)) {
            $companyDraftObject->isActive = 0;
            $companyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyDraftObject->priority = $companyDraftObject->priority == '' ? 0 : $companyDraftObject->priority;
            $companyDraftObject->save();
        }

        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($companyObject->fields);

        $newCompanyDraftObject->company_id = $companyObject->Company_id;
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->category_id = $category;
        $newCompanyDraftObject->meta_keyword = $metaKeyWord;
        $newCompanyDraftObject->meta_description = $input['meta_description'];
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->registration_date = $registration_date != '' ? $registration_date : date('Y-m-d H:i:s');
        $newCompanyDraftObject->registration_number = convertToEnglish($input['registration_number']);
        $newCompanyDraftObject->national_id = convertToEnglish($input['national_id']);
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->personality_type = ($newCompanyDraftObject->personality_type == '') ? 0 : $newCompanyDraftObject->personality_type;
        if ($newCompanyDraftObject->state_id == '') {
            $newCompanyDraftObject->state_id = 0;
        }
        $newCompanyDraftObject->save();

        //------> Add to log
        $input['action'] = 1;
        $log = new adminLogController();
        $log->AddLog($input);

        if ($companyObject->package_status == '1') {
            //------> process in phone Table
            $phoneObject = adminc_phonesModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($phoneObject)) {
                $phoneObject = new adminc_phonesModel();
            }
            //---->update c_phone Table
            $phoneObject->subject = 'مرکزی';
            $phoneObject->company_id = $input['company_id'];
            $phoneObject->number = $input['phone'];
            $phoneObject->state = '';
            $phoneObject->code = $input['code'];
            $phoneObject->value = '';
            $phoneObject->status = '1';
            $phoneObject->isMain = '1';
            $phoneObject->reference_value = $input['reference_value'];
            $phoneObject->reference_type = $input['reference_type'];
            $phoneObject->save();

            //---->update c_phone_d Table
            $phoneDraftObject = adminc_phones_dModel::getBy_phones_id_and_company_id_and_status_and_isActive($phoneObject->Phones_id, $input['company_id'], '1', '1')->first();
            if (is_object($phoneDraftObject)) {
                $phoneDraftObject->isActive = '0';
                $phoneDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $phoneDraftObject->save();
            }

            //---->add to c_phone_d Table
            $newPhoneDraftObject = new adminc_phones_dModel();
            $newPhoneDraftObject->setFields($phoneObject->fields);
            $newPhoneDraftObject->subject = 'مرکزی';
            $newPhoneDraftObject->company_id = $input['company_id'];
            $newPhoneDraftObject->phones_id = $phoneObject->Phones_id;
            $newPhoneDraftObject->value = '';
            $newPhoneDraftObject->state = '';
            $newPhoneDraftObject->code = $phoneObject->code;
            $newPhoneDraftObject->editor_id = $editor_id;
            $newPhoneDraftObject->isActive = 1;
            $newPhoneDraftObject->isMain = $phoneObject->isMain;
            $newPhoneDraftObject->isAdmin = 1;
            $newPhoneDraftObject->status = 1;
            $newPhoneDraftObject->reference_value = $input['reference_value'];
            $newPhoneDraftObject->reference_type = $input['reference_type'];
            $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newPhoneDraftObject->company_d_id = $newPhoneDraftObject->company_d_id == '' ? 0 : $newPhoneDraftObject->company_d_id; // todo: to be fix
            $newPhoneDraftObject->admin_description = '';

            $newPhoneDraftObject->save();

            //------> process in WebSite
            $webSiteObject = adminc_websitesModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($webSiteObject)) {
                $webSiteObject = new adminc_websitesModel();
            }

            //---->update c_WebSite Table
            $webSiteObject->subject = 'وب سایت';
            $webSiteObject->company_id = $input['company_id'];
            $webSiteObject->url = $input['url'];
            $webSiteObject->isMain = 1;
            $webSiteObject->branch_id = 0;
            $webSiteObject->save();

            //---->update c_WebSite_d Table
            $webSiteDraftObject = adminc_websites_dModel::getBy_websites_id_and_company_id_and_status_and_isActive($webSiteObject->Websites_id, $input['company_id'], '1', '1')->first();
            if (is_object($webSiteDraftObject)) {
                $webSiteDraftObject->isActive = '0';
                $webSiteDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $webSiteDraftObject->save();
            }

            //---->add to c_WebSite_d Table
            $newWebSiteDraftObject = new adminc_websites_dModel();
            $newWebSiteDraftObject->setFields($webSiteObject->fields);
            $newWebSiteDraftObject->subject = 'وب سایت';
            $newWebSiteDraftObject->company_id = $input['company_id'];
            $newWebSiteDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newWebSiteDraftObject->websites_id = $webSiteObject->Websites_id;
            $newWebSiteDraftObject->editor_id = $editor_id;
            $newWebSiteDraftObject->isActive = 1;
            $newWebSiteDraftObject->isMain = $webSiteObject->isMain;
            $newWebSiteDraftObject->isAdmin = 1;
            $newWebSiteDraftObject->status = 1;
            $newWebSiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newWebSiteDraftObject->save();

            //------> process in email
            $emailObject = adminc_emailsModel::getBy_company_id($input['company_id'])->first();

            if (is_object($emailObject)) {
                //---->update c_email Table
                $emailObject->subject = 'ایمیل';
                $emailObject->company_id = $input['company_id'];
                $emailObject->email = $input['email'];
                $emailObject->isMain = 1;
                $emailObject->save();

                //---->update c_email_d Table
                $emailDraftObject = adminc_emails_dModel::getBy_emails_id_and_company_id_and_status_and_isActive($emailObject->Emails_id, $input['company_id'], '1', '1')->first();
                if (is_object($emailDraftObject)) {
                    $emailDraftObject->isActive = '0';
                    $emailDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                    $emailDraftObject->save();
                }

                //---->add to c_email_d Table
                $newEmailDraftObject = new adminc_emails_dModel();
                $newEmailDraftObject->setFields($emailObject->fields);
                $newEmailDraftObject->subject = 'ایمیل';
                $newEmailDraftObject->company_id = $input['company_id'];
                $newEmailDraftObject->websites_id = $emailObject->Emails_id;
                $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
                $newEmailDraftObject->editor_id = $editor_id;
                $newEmailDraftObject->isActive = 1;
                $newEmailDraftObject->isMain = $emailObject->isMain;
                $newEmailDraftObject->isAdmin = 1;
                $newEmailDraftObject->status = 1;
                $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
                $newEmailDraftObject->admin_description = '';

                $newEmailDraftObject->save();
            } else {
                $emailObject = new adminc_emailsModel();
                $emailObject->subject = 'ایمیل';
                $emailObject->company_id = $input['company_id'];
                $emailObject->email = $input['email'];
                $emailObject->isMain = 1;
                $emailObject->branch_id = 0;
                $emailObject->save();

                //---->add to c_email_d Table
                $newEmailDraftObject = new adminc_emails_dModel();
                $newEmailDraftObject->setFields($emailObject->fields);
                $newEmailDraftObject->subject = 'ایمیل';
                $newEmailDraftObject->company_id = $input['company_id'];
                $newEmailDraftObject->websites_id = $emailObject->Emails_id;
                $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
                $newEmailDraftObject->editor_id = $editor_id;
                $newEmailDraftObject->isActive = 1;
                $newEmailDraftObject->isMain = $emailObject->isMain;
                $newEmailDraftObject->isAdmin = 1;
                $newEmailDraftObject->status = 1;
                $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
                $newEmailDraftObject->admin_description = '';
                $newEmailDraftObject->save();
            }

            //------> process in address

            $addressObject = adminc_addressesModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($addressObject)) {
                $addressObject = new adminc_addressesModel();
                $addressObject->company_id = $input['company_id']; // marjani
                $addressObject->branch_id = 0; // marjani
                $addressObject->subject = ' '; // marjani
            }

            $addressObject->address = $input['address'];
            $addressObject->isMain = '1';
            $addressObject->status = '1';
            $addressObject->save();

            //---->update to c_addresses_d Table
            $addressDraftObject = adminc_addresses_dModel::getBy_addresses_id_and_company_id_and_status_and_isActive($addressObject->Addresses_id, $input['company_id'], '1', '1')->first();
            if (is_object($addressDraftObject)) {
                $addressDraftObject->isActive = '0';
                $addressDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $addressDraftObject->save();
            }
            //---->add to addresses_d Table
            $newAddressDraftObject = new adminc_addresses_dModel();
            $newAddressDraftObject->setFields($addressObject->fields);
            $newAddressDraftObject->company_id = $input['company_id'];
            $newAddressDraftObject->addresses_id = $addressObject->Addresses_id;
            $newAddressDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newAddressDraftObject->refresh_date = '';
            $newAddressDraftObject->editor_id = $editor_id;
            $newAddressDraftObject->isActive = 1;
            $newAddressDraftObject->isMain = $addressObject->isMain;
            $newAddressDraftObject->isAdmin = 1;
            $newAddressDraftObject->status = 1;
            $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newAddressDraftObject->admin_description = '';
            $newAddressDraftObject->save();
        } else {
            $memberObject = adminMembersModel::getBy_company_id($companyObject->Company_id)->first();
            if (is_object($memberObject)) {
                $memberObject->name = $memberName;
                $memberObject->family = $memberFamily;
                $memberObject->email = $memberEmail;
                $memberObject->mobile = $memberMobile;
                $memberObject->save();
            }
        }

        if (trim($input['licence_type']) != '') {
            if ($input['licence_type'] == '0') {
                $licenceResult = adminlicence_listModel::getBy_name(trim($input['licenceTypeName']))->getList();
                if ($licenceResult['export']['recordsCount'] > 0) {
                    $licenceKey = $licenceResult['export']['list']['0']['Licence_list_id'];
                } else {
                    //---->Add to licence-list Table
                    $licenceListObject = new adminlicence_listModel();
                    $licenceListObject->status = 0;
                    $licenceListObject->name = $input['licenceTypeName'];
                    $licenceListObject->save();
                    $licenceKey = $licenceListObject->Licence_list_id;
                }
            } else {
                $licenceKey = $input['licence_type'];
            }

            //------> Edit Previous Licence
            $previousLicenceObject = adminc_licencesModel::getBy_company_id_and_status_and_isActive($input['company_id'], 1, 1)->first();
            if (is_object($previousLicenceObject)) {
                $previousLicenceObject->status = 1;
                $previousLicenceObject->isActive = 0;
                $previousLicenceObject->save();
            }

            //---->Add to licence Table
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->licence_number = $input['licence_number'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->national_code = $input['national_code'];
            $newLicenceObject->licence_type = $licenceKey;
            $newLicenceObject->issuence_date = convertJToGDate($input['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($input['expiration_date']);
            $newLicenceObject->exporter_refrence = $input['exporter_refrence'];
            $newLicenceObject->description = $input['licence_description'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->company_id = $companyObject->Company_id;
            $newLicenceObject->name = $input['name'];
            $newLicenceObject->family = $input['family'];
            $newLicenceObject->status = -1;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = $isMain;

            //---->Save Licence image
            $field['image'] = '';
            $field['status'] = '1';
            $fields['Banner_id'] = '';
            $file['name'] = $files['name'];
            $file['type'] = $files['type'];
            $file['tmp_name'] = $files['tmp_name'];
            $file['error'] = $files['error'];
            $file['size'] = $files['size'];
            $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $companyObject->Company_id . '/licence/'];

            $result_uploader = fileUploader($Property, $file);
            $field['image'] = $result_uploader['image_name'];

            $newLicenceObject->image = $field['image'];
            $newLicenceObject->save();

            $newLicenceObject->parent_id = $newLicenceObject->Licence_id;
            $newLicenceObject->save();
        }

        //------> member Update
        if ($newCompanyDraftObject->package_status == 1) {
            $draftCompanyId = $companyDraftObject->Company_d_id;
            $memberObject = new adminEditorMemberController();
            $memberObject = $memberObject->getMemberInformationById($draftCompanyId);

            if (is_array($memberObject)) {
                $memberObject = new adminEditorMemberModel();
            }

            $memberObject->family = $input['editor_family'];
            $memberObject->name = $input['editor_name'];
            $memberObject->phone = $input['editor_phone'];
            $memberObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            // $memberObject->company_id = $companyDraftObject->company_id; // marjani
            $memberObject->company_id = $companyObject->Company_id;
            $memberObject->save();
        } else {
            $resultObject = members::getBy_company_id($companyObject->Company_id)->first();
            if (is_object($resultObject)) {
                $resultObject->name = $input['memberName'];
                $resultObject->family = $input['memberFamily'];
                $resultObject->email = $input['email'];
                $resultObject->mobile = $input['mobile'];
                $resultObject->save();
            }
        }

        $this->unlockCompany($newCompanyDraftObject->company_id);

        // send email compare company
        $compare = new Compare();
        $compare->compareRealAndDraft($newCompanyDraftObject->company_id);

        calculateScoreCompany($input['company_id']);
        return;
    }

    public function editRealCompany($input, $files)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];

        $companyObject = admincompanyModel::find($input['company_id']);
        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        //------> convert variable
        if ($companyObject->package_status == 4) {
            $category = implode(',', $input['category_id']);
            $metaKeyWord = $input['meta_keyword'];
            $memberEmail = $input['email'];
            $memberMobile = $input['mobile'];
            $memberName = $input['memberName'];
            $memberFamily = $input['memberFamily'];
        } else {
            $category = arrayToTag($input['category_id'])['export']['list'];
            $metaKeyWord = '';
        }

        //------> Add to log
        $input['action'] = 1;
        $log = new adminLogController();
        $log->AddLog($input);

        //------> Add Catalog
        if (isset($files['catalog'])) {
            if ($input['remove-file'] == 'on') {
                $input['catalog'] = '';
            } else {
                if ($files['catalog'] != '') {
                    $Property = ['type' => 'jpg,png,jpeg,pdf', 'new_name' => $files['catalog']['name'], 'max_size' => '8388608', 'upload_dir' => COMPANY_ADDRESS_ROOT . $input['company_id'] . '/catalog/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];
                    $result_uploader = fileUploader($Property, $files['catalog']);
                    $input['catalog'] = $result_uploader['image_name'];
                } else {
                    $input['catalog'] = $companyObject->image;
                }
            }
        }

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($input);
        $input['parent_category_id'] = $result['parent_category_id'];
        $input['category_id'] = $result['category_id'];
        //----> update Company Table
        $companyObject->setFields($input);
        //$companyObject->category_id = $category;

        $companyObject->status = 1;
        $companyObject->isActive = 0;
        $companyObject->meta_keyword = $metaKeyWord;
        $companyObject->meta_description = $input['meta_description'];
        $companyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $companyObject->save();

        //-------------------------------------
        $companyObject->category()->detach();

        $categoryArray = tagToArray($input['category_id'])['export']['list'];
        $parentCategoryArray = tagToArray($input['parent_category_id'])['export']['list'];
        $mainArray = array_merge($categoryArray, $parentCategoryArray);
        $companyObject->category()->attach($mainArray);

        //-------------------------------------

        //------> update Company_d Table
        $companyDraftObject = admincompany_dModel::getBy_company_id_and_isActive_and_status($input['company_id'], '1', '1')->first();
        if (is_object($companyDraftObject)) {
            $companyDraftObject->editor_id = $editor_id;
            $companyDraftObject->isActive = 0;
            $companyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyDraftObject->save();
        }

        //------> insert to Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($companyObject->fields);
        $newCompanyDraftObject->company_id = $companyObject->Company_id;
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->category_id = $category;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->status = 1;

        $newCompanyDraftObject->save();

        if ($companyObject->package_status == '1') {
            //------> process in phone
            $phoneObject = adminc_phonesModel::getBy_company_id($input['company_id'])->first();

            if (!is_object($phoneObject)) {
                $phoneObject = new adminc_phonesModel();
            }

            //---->update c_phone Table
            $phoneObject->subject = 'مرکزی';
            $phoneObject->code = $input['code'];
            $phoneObject->company_id = $input['company_id'];
            $phoneObject->number = $input['phone'];
            $phoneObject->reference_type = $input['reference_type'];
            $phoneObject->reference_value = $input['reference_value'];
            $phoneObject->status = '1';
            $phoneObject->state = '';
            $phoneObject->value = '';
            $phoneObject->isMain = '1';
            $phoneObject->save();

            //---->update c_phone_d Table
            $phoneDraftObject = adminc_phones_dModel::getBy_phones_id_and_company_id_and_status_and_isActive($phoneObject->Phones_id, $input['company_id'], '1', '1')->first();

            if (is_object($phoneDraftObject)) {
                $phoneDraftObject->isActive = '0';
                $phoneDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $phoneDraftObject->save();
            }

            //---->add to c_phone_d Table
            $newPhoneDraftObject = new adminc_phones_dModel();
            $newPhoneDraftObject->setFields($phoneObject->fields);
            $newPhoneDraftObject->subject = 'مرکزی';
            $newPhoneDraftObject->company_id = $input['company_id'];
            $newPhoneDraftObject->phones_id = $phoneObject->Phones_id;
            $newPhoneDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newPhoneDraftObject->editor_id = $editor_id;
            $newPhoneDraftObject->code = $phoneObject->code;
            $newPhoneDraftObject->isMain = $phoneDraftObject->isMain;
            $newPhoneDraftObject->isActive = 1;
            $newPhoneDraftObject->isAdmin = 1;
            $newPhoneDraftObject->status = 1;
            $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newPhoneDraftObject->admin_description = $newPhoneDraftObject->admin_description == '' ? '' : $newPhoneDraftObject->admin_description;
            $newPhoneDraftObject->save();

            //------> process in WebSite
            $webSiteObject = adminc_websitesModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($webSiteObject)) {
                $webSiteObject = new adminc_websitesModel();
            }

            //---->update c_WebSite Table
            $webSiteObject->subject = 'وب سایت';
            $webSiteObject->company_id = $input['company_id'];
            $webSiteObject->url = $input['url'];
            $webSiteObject->isMain = 1;
            $webSiteObject->save();

            //---->update c_WebSite_d Table
            $webSiteDraftObject = adminc_websites_dModel::getBy_websites_id_and_company_id_and_status_and_isActive($webSiteObject->Websites_id, $input['company_id'], '1', '1')->first();
            if (is_object($webSiteDraftObject)) {
                $webSiteDraftObject->isActive = '0';
                $webSiteDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $webSiteDraftObject->save();
            }

            //---->add to c_WebSite_d Table
            $newWebSiteDraftObject = new adminc_websites_dModel();
            $newWebSiteDraftObject->setFields($webSiteObject->fields);
            $newWebSiteDraftObject->subject = 'وب سایت';
            $newWebSiteDraftObject->company_id = $input['company_id'];
            $newWebSiteDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newWebSiteDraftObject->websites_id = $webSiteObject->Websites_id;
            $newWebSiteDraftObject->editor_id = $editor_id;
            $newWebSiteDraftObject->isActive = 1;
            $newWebSiteDraftObject->isMain = $webSiteObject->isMain;
            $newWebSiteDraftObject->isAdmin = 1;
            $newWebSiteDraftObject->status = 1;
            $newWebSiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newWebSiteDraftObject->save();

            //------> process in email
            $emailObject = adminc_emailsModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($emailObject)) {
                $emailObject = new adminc_emailsModel();
            }
            //---->update c_email Table
            $emailObject->subject = 'ایمیل';
            $emailObject->company_id = $input['company_id'];
            $emailObject->email = $input['email'];
            $emailObject->isMain = 1;
            $emailObject->save();

            //---->update c_email_d Table
            $emailDraftObject = adminc_emails_dModel::getBy_emails_id_and_company_id_and_status_and_isActive($emailObject->Emails_id, $input['company_id'], '1', '1')->first();
            if (is_object($emailDraftObject)) {
                $emailDraftObject->isActive = '0';
                $emailDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $emailDraftObject->save();
            }

            //---->add to c_email_d Table
            $newEmailDraftObject = new adminc_emails_dModel();
            $newEmailDraftObject->setFields($emailObject->fields);
            $newEmailDraftObject->subject = 'ایمیل';
            $newEmailDraftObject->company_id = $input['company_id'];
            $newEmailDraftObject->websites_id = $emailObject->Emails_id;
            $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newEmailDraftObject->editor_id = $editor_id;
            $newEmailDraftObject->isActive = 1;
            $newEmailDraftObject->isMain = $emailObject->isMain;
            $newEmailDraftObject->isAdmin = 1;
            $newEmailDraftObject->status = 1;
            $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newEmailDraftObject->admin_description = $newEmailDraftObject->admin_description == '' ? '' : $newEmailDraftObject->admin_description;
            $newEmailDraftObject->save();

            //------> process in address
            $addressObject = adminc_addressesModel::getBy_company_id($input['company_id'])->first();
            if (!is_object($addressObject)) {
                $addressObject = new adminc_addressesModel();
            }

            $addressObject->address = $input['address'];
            $addressObject->status = '1';
            $addressObject->save();

            //---->update to c_addresses_d Table
            $addressDraftObject = adminc_addresses_dModel::getBy_addresses_id_and_company_id_and_status_and_isActive($addressObject->Addresses_id, $input['company_id'], '1', '1')->first();
            if (is_object($addressDraftObject)) {
                $addressDraftObject->isActive = '0';
                $addressDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
                $addressDraftObject->save();
            }
            //---->add to addresses_d Table
            $newAddressDraftObject = new adminc_addresses_dModel();
            $newAddressDraftObject->setFields($addressObject->fields);
            $newAddressDraftObject->company_id = $input['company_id'];
            $newAddressDraftObject->addresses_id = $addressObject->Addresses_id;
            $newAddressDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newAddressDraftObject->isMain = $addressDraftObject->isMain;
            $newAddressDraftObject->refresh_date = '';
            $newAddressDraftObject->editor_id = $editor_id;
            $newAddressDraftObject->isActive = 1;
            $newAddressDraftObject->isAdmin = 1;
            $newAddressDraftObject->status = 1;
            $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newAddressDraftObject->save();

            ////------> Logo Process

            $mainLogo = adminc_logoModel::getBy_company_id($input['company_id'])->first();
            $draftLogo = adminc_logo_dModel::getBy_company_id_and_status_and_isActive($input['company_id'], 1, 1)->first();

            if (isset($input['remove_Logo']) or $input['remove_Logo'] == 'on') {
                //------> Remove Main Logo
                if (is_object($mainLogo)) {
                    $mainLogo->delete();
                }

                //------> Disable Draft Logo
                if (is_object($draftLogo)) {
                    $draftLogo->isActive = 0;
                    $draftLogo->save();
                }
            } else {
                if (trim($input['logoImage']) != '') {
                    $uploader = new Uploader();
                    $property = ['image' => $input['logoImage'], 'company_id' => $input['company_id'], 'folder_name' => 'logo'];
                    $sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];
                    $result = $uploader->cropAndCompressImage($property, $sizes);
                    $imageLogo = $result['image'];

                    //---->Save Logo in Logo Table
                    if (!is_object($mainLogo)) {
                        $mainLogo = new adminc_logoModel();
                    }

                    $mainLogo->image = $imageLogo;
                    $mainLogo->status = 1;
                    $mainLogo->isActive = 1;
                    $mainLogo->editor_id = $editor_id;
                    $mainLogo->date = strftime('%Y-%m-%d %H:%M:%S', time());
                    $mainLogo->isAdmin = 1;
                    $mainLogo->save();

                    //------> Edit Draft Logo
                    if (is_object($draftLogo)) {
                        $draftLogo->status = 1;
                        $draftLogo->isActive = 0;
                        $draftLogo->save();
                    }

                    //------> Add new Draft Logo
                    $newDraftLogoObject = new adminc_logo_dModel();
                    $newDraftLogoObject->image = $imageLogo;
                    $newDraftLogoObject->company_id = $mainLogo->Company_id;
                    $newDraftLogoObject->logo_id = $mainLogo->Logo_id;
                    $newDraftLogoObject->status = 1;
                    $newDraftLogoObject->isActive = 1;
                    $newDraftLogoObject->editor_id = $editor_id;
                    $newDraftLogoObject->isAdmin = 1;
                    $newDraftLogoObject->isAdmin = 1;
                    $newDraftLogoObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
                    $newDraftLogoObject->save();
                }
            }

            //------> Add to Licence List
            $licenceKey = '';

            if ($input['licence_type'] == '0') {
                $licenceResult = adminlicence_listModel::getBy_name(trim($input['licenceTypeName']))->getList();
                if ($licenceResult['export']['recordsCount'] > 0) {
                    $licenceKey = $licenceResult['export']['list']['0']['Licence_list_id'];
                } else {
                    //---->Add to licence-list Table
                    $licenceListObject = new adminlicence_listModel();
                    $licenceListObject->status = 1;
                    $licenceListObject->name = $input['licenceTypeName'];
                    $licenceListObject->save();
                    $licenceKey = $licenceListObject->Licence_list_id;
                }
            } else {
                $licenceKey = $input['licence_type'];
            }

            //---->Update licence Table
            $licenceObject = adminc_licencesModel::getBy_company_id_and_isActive_and_status($input['company_id'], '1', '1')->first();
            if (is_object($licenceObject)) {
                $licenceObject->isActive = 0;
                $licenceObject->save();
            }

            //------> find Main Licence
            $mainLicenceObject = adminc_licencesModel::getBy_company_id_and_isMain_and_status($input['company_id'], 1, 2)->first();

            //------>Upload Licence Image
            if (trim($input['licenceImage']) != '') {
                $uploader = new Uploader();
                $result = $uploader->cropAndCompressImage(['image' => $input['licenceImage'], 'company_id' => $input['company_id'], 'folder_name' => 'licence']);
                $imageName = $result['image'];
            } else {
                $imageName = $mainLicenceObject->image;
            }

            //---->Add to licence Table
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->licence_number = $input['licence_number'];
            $newLicenceObject->national_code = $input['national_code'];
            $newLicenceObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->licence_type = $licenceKey;
            $newLicenceObject->issuence_date = convertJToGDate($input['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($input['expiration_date']);
            $newLicenceObject->exporter_refrence = $input['exporter_refrence'];
            $newLicenceObject->description = $input['issuence_description'];
            $newLicenceObject->company_id = $companyObject->Company_id;
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->name = $input['name'];
            $newLicenceObject->family = $input['family'];
            $newLicenceObject->status = 2;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = 1;
            $newLicenceObject->parent_id = $mainLicenceObject->parent_id;
            $newLicenceObject->image = $imageName;
            $newLicenceObject->save();

            //------> Edit Previous Licence
            $previousLicenceObject = adminc_licencesModel::getBy_company_id_and_parent_id_and_status($input['company_id'], $mainLicenceObject->parent_id, 2)->first();
            if (is_object($previousLicenceObject)) {
                $previousLicenceObject->status = 1;
                $previousLicenceObject->isActive = 0;
                $previousLicenceObject->save();
            }
        }

        //------> member Update
        if ($newCompanyDraftObject->package_status == 1) {
            $draftCompanyId = $companyDraftObject->Company_d_id;
            $memberObject = new adminEditorMemberController();
            $memberObject = $memberObject->getMemberInformationById($draftCompanyId);
            if (is_array($memberObject)) {
                $memberObject = new adminEditorMemberModel();
            }

            $memberObject->family = $input['editor_family'];
            $memberObject->name = $input['editor_name'];
            $memberObject->phone = $input['editor_phone'];
            $memberObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $memberObject->save();
        } else {
            $resultObject = members::getBy_company_id($companyObject->Company_id)->first();
            $resultObject->name = $input['memberName'];
            $resultObject->family = $input['memberFamily'];
            $resultObject->email = $input['email'];
            $resultObject->mobile = $input['mobile'];
            $resultObject->save();
        }

        $this->unlockCompany($newCompanyDraftObject->company_id);

        // send email compare company
        $compare = new Compare();
        $compare->compareRealAndDraft($newCompanyDraftObject->company_id);

        calculateScoreCompany($input['company_id']);

        return;
    }

    public function editCompany($input, $files)
    {
        if (isset($input['process'])) {
            $this->check($input, $files);
        }
        if ($input['company_type'] == '1') {
            $this->editLegalCompany($input, $files);
        } else {
            $this->editRealCompany($input, $files);
        }

        $msg = 'ویرایش با موفقیت انجام شد.';
        redirectPage(RELA_DIR . 'admin/?component=company', $msg);
        die();
    }

    public function showList($msg = '')
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.company.showList.php';
        $this->template($export);
        die();
    }

    public function getCompanyById($company_id)
    {
        $companyResult = admincompanyModel::find($company_id);
        return $companyResult;
    }

    public function getExhibition($id = 0)
    {
        $list[1]['id'] = 1;
        $list[1]['name'] = ' گل، گیاه';
        $list[2]['id'] = 2;
        $list[2]['name'] = 'مبلمان شهری';

        if ($id != 0) {
            return $list[$id];
        }

        return $list;
    }

    public function printCompanyInformationExhibition($input)
    {
        $companyObject = $this->getCompanyById($input['company_id']);
        $result['company'] = $companyObject->fields;
        if (isset($input['fields'])) {
            $result = $this->setEditedFields($result, $input);
        }

        $result['exhibition_name'] = $this->getExhibition($input['fields']['exhibition_name']);
        include_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmails.controller.php';
        $emailObject = new admincompany_EmailsController();
        $result['email'] = $emailObject->getEmailByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.controller.php';
        $addressObject = new admincompany_addressesController();
        $result['address'] = $addressObject->getAddressByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsites.controller.php';
        $websiteObject = new admincompany_websitesController();
        $result['websites'] = $websiteObject->getWebsiteByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhones.controller.php';
        $phoneObject = new admincompany_phonesController();
        $result['phone'] = $phoneObject->getPhoneByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companySocials/admin/model/admin.companySocials.controller.php';
        $socialObject = new adminCompanySocialController();
        $result['social'] = $socialObject->getSocialByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyPositions/admin/model/admin.companyPosition.controller.php';
        $positionObject = new positionController();
        $result['position'] = $positionObject->getPositionByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/product/admin/model/admin.product.controller.php';
        $productObject = new adminProductController();
        $result['product'] = $productObject->getProductByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/branch/admin/model/admin.branch.controller.php';
        $branchObject = new branchController();
        $result['branch'] = $branchObject->getAllByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyCommercialName/admin/model/admin.companyCommercialName.controller.php';
        $commercialNameObject = new admincompany_commercial_nameController();
        $result['commercialName'] = $commercialNameObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAdvertise/admin/AdminAdvertiseController.php';
        $advertiseObject = new AdminAdvertiseController();
        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAdvertise/admin/AdminAdvertiseController.php';
        $advertiseObject = new AdminAdvertiseController();
        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogo.controller.php';
        $logoObject = new admincompany_logoController();
        $result['logo'] = $logoObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyBanner/admin/model/admin.companyBanner.controller.php';
        $bannerObject = new admincompany_bannerController();
        $result['banner'] = $bannerObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyNews/admin/model/admin.companyNews.controller.php';
        $newsObject = new admincompany_newsController();
        $result['news'] = $newsObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/honour/admin/model/admin.honour.controller.php';
        $honourObject = new adminHonourController();
        $result['honour'] = $honourObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licenceObject = new adminlicenceController();
        $result['licence'] = $licenceObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/employment/admin/AdminEmploymentController.php';
        $employmentObject = new AdminEmploymentController();
        $result['employment'] = $employmentObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/representation/member/model/representation.controller.php';
        $representationObject = new representationController();
        $result['representation'] = $representationObject->getByCompanyId($input['company_id']);
        $result['typePaper'] = 'ن';

        if ($companyObject->package_status == '4') {
            include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';
            $memberObject = new adminLoginController();
            $resultObject = $memberObject->getMemberObject($result['company']['Company_id']);
            $result['memberInfo']['name'] = $resultObject->name;
            $result['memberInfo']['family'] = $resultObject->family;
            $result['memberInfo']['email'] = $resultObject->email;
            $result['memberInfo']['mobile'] = $resultObject->mobile;
        } elseif ($companyObject->package_status == '1') {
            include_once ROOT_DIR . 'component/editorMember/admin/model/admin.editorMember.controller.php';
            $memberObject = new adminEditorMemberController();
            $resultMember = $memberObject->getMemberInformationByCompanyId($result['company']['Company_id']);
            $result['memberInfo']['name'] = $resultMember->name;
            $result['memberInfo']['family'] = $resultMember->family;
            $result['memberInfo']['mobile'] = $resultMember->phone;
        } else {
            $result['memberInfo'] = '';
        }
        $export['list'] = $result;
        $this->fileName = 'admin.printCompanyExhibition.php';
        $this->template($export, $msg);
        die();

        //        include_once ROOT_DIR . 'component/representation/member/';
        //        $advertiseObject = new AdminAdvertiseController();
        //        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        print_r_debug($result);

        return $result;
    }

    public function printCompanyInformation($input)
    {
        $companyObject = $this->getCompanyById($input['company_id']);
        $result['company'] = $companyObject->fields;

        if (isset($input['fields'])) {
            $result = $this->setEditedFields($result, $input);
        }

        include_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmails.controller.php';
        $emailObject = new admincompany_EmailsController();
        $result['email'] = $emailObject->getEmailByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.controller.php';
        $addressObject = new admincompany_addressesController();
        $result['address'] = $addressObject->getAddressByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsites.controller.php';
        $websiteObject = new admincompany_websitesController();
        $result['websites'] = $websiteObject->getWebsiteByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhones.controller.php';
        $phoneObject = new admincompany_phonesController();
        $result['phone'] = $phoneObject->getPhoneByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companySocials/admin/model/admin.companySocials.controller.php';
        $socialObject = new adminCompanySocialController();
        $result['social'] = $socialObject->getSocialByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyPositions/admin/model/admin.companyPosition.controller.php';
        $positionObject = new positionController();
        $result['position'] = $positionObject->getPositionByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/product/admin/model/admin.product.controller.php';
        $productObject = new adminProductController();
        $result['product'] = $productObject->getProductByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/branch/admin/model/admin.branch.controller.php';
        $branchObject = new branchController();
        $result['branch'] = $branchObject->getAllByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyCommercialName/admin/model/admin.companyCommercialName.controller.php';
        $commercialNameObject = new admincompany_commercial_nameController();
        $result['commercialName'] = $commercialNameObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAdvertise/admin/AdminAdvertiseController.php';
        $advertiseObject = new AdminAdvertiseController();
        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyAdvertise/admin/AdminAdvertiseController.php';
        $advertiseObject = new AdminAdvertiseController();
        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogo.controller.php';
        $logoObject = new admincompany_logoController();
        $result['logo'] = $logoObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyBanner/admin/model/admin.companyBanner.controller.php';
        $bannerObject = new admincompany_bannerController();
        $result['banner'] = $bannerObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/companyNews/admin/model/admin.companyNews.controller.php';
        $newsObject = new admincompany_newsController();
        $result['news'] = $newsObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/honour/admin/model/admin.honour.controller.php';
        $honourObject = new adminHonourController();
        $result['honour'] = $honourObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licenceObject = new adminlicenceController();
        $result['licence'] = $licenceObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/employment/admin/AdminEmploymentController.php';
        $employmentObject = new AdminEmploymentController();
        $result['employment'] = $employmentObject->getByCompanyId($input['company_id']);

        include_once ROOT_DIR . 'component/representation/member/model/representation.controller.php';
        $representationObject = new representationController();
        $result['representation'] = $representationObject->getByCompanyId($input['company_id']);
        $result['typePaper'] = 'ب';

        if ($companyObject->package_status == '4') {
            include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';
            $memberObject = new adminLoginController();
            $resultObject = $memberObject->getMemberObject($result['company']['Company_id']);
            $result['memberInfo']['name'] = $resultObject->name;
            $result['memberInfo']['family'] = $resultObject->family;
            $result['memberInfo']['email'] = $resultObject->email;
            $result['memberInfo']['mobile'] = $resultObject->mobile;
        } elseif ($companyObject->package_status == '1') {
            include_once ROOT_DIR . 'component/editorMember/admin/model/admin.editorMember.controller.php';
            $memberObject = new adminEditorMemberController();
            $resultMember = $memberObject->getMemberInformationByCompanyId($result['company']['Company_id']);
            $result['memberInfo']['name'] = $resultMember->name;
            $result['memberInfo']['family'] = $resultMember->family;
            $result['memberInfo']['mobile'] = $resultMember->phone;
        } else {
            $result['memberInfo'] = '';
        }

        $export['list'] = $result;
        $this->fileName = 'admin.printCompanyInformation.php';
        $this->template($export, $msg);
        die();

        //        include_once ROOT_DIR . 'component/representation/member/';
        //        $advertiseObject = new AdminAdvertiseController();
        //        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        print_r_debug($result);

        return $result;
    }

    public function printAddress($input)
    {
        $companyArrayId = tagToArray($input['company_id'])['export']['list'];
        foreach ($companyArrayId as $key => $compId) {
            $companyObject = $this->getCompanyById($compId);
            $result['company'] = $companyObject->fields;

            include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.controller.php';
            $result['address'] = adminc_addressesModel::getBy_company_id_and_isMain($compId, 1)->getList()['export']['list'];

            include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhones.controller.php';
            $result['phone'] = adminc_phonesModel::getBy_company_id_and_isMain($compId, 1)->getList()['export']['list'];

            if ($companyObject->package_status == '4') {
                include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';
                $memberObject = new adminLoginController();
                $resultObject = $memberObject->getMemberObject($result['company']['Company_id']);
                $result['memberInfo']['name'] = $resultObject->name;
                $result['memberInfo']['family'] = $resultObject->family;
                $result['memberInfo']['email'] = $resultObject->email;
                $result['memberInfo']['mobile'] = $resultObject->mobile;
            } elseif ($companyObject->package_status == '1') {
                include_once ROOT_DIR . 'component/editorMember/admin/model/admin.editorMember.controller.php';
                $memberObject = new adminEditorMemberController();
                $resultMember = $memberObject->getMemberInformationByCompanyId($result['company']['Company_id']);
                $result['memberInfo']['name'] = $resultMember->name;
                $result['memberInfo']['family'] = $resultMember->family;
                $result['memberInfo']['mobile'] = $resultMember->phone;
            } else {
                $result['memberInfo'] = '';
            }

            $compnayList[$compId] = $result;
            unset($result);
        }

        $this->fileName = 'admin.printAddress.php';
        $this->template($compnayList, $msg);
        die();

        //        include_once ROOT_DIR . 'component/representation/member/';
        //        $advertiseObject = new AdminAdvertiseController();
        //        $result['advertise'] = $advertiseObject->getByCompanyId($input['company_id']);

        print_r_debug($result);

        return $result;
    }

    public function editCompanyInformationForPrint($company_id)
    {
        $companyObject = $this->getCompanyById($company_id);
        $company = $companyObject->fields;

        $this->fileName = 'admin.editCompanyInformationForPrint.php';
        $this->template($company);
        die();
    }

    public function editCompanyInformationForExhibition($company_id)
    {
        $companyObject = $this->getCompanyById($company_id['company_id']);
        $company = $companyObject->fields;

        $list['company'] = $company;
        $list['exhibition'] = $this->getExhibition();

        $this->fileName = 'admin.editCompanyInformationForExhibition.php';
        $this->template($list);
        die();
    }

    public function setEditedFields($result, $input)
    {
        $result['company']['company_name'] = $input['fields']['company_name'];
        $result['company']['description'] = $input['fields']['description'];
        $result['company']['maneger_name'] = $input['fields']['maneger_name'];
        $result['company']['refresh_date'] = convertJToGDate($input['fields']['refresh_date']);
        $result['company']['registration_number'] = $input['fields']['registration_number'];
        $result['company']['national_id'] = $input['fields']['national_id'];

        return $result;
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function search($fields)
    {
        $company = new admincompanyModel();
        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'company_type', 'dt' => $i++], ['db' => 'coordinator_family', 'dt' => $i++], ['db' => 'package_status', 'dt' => $i++], ['db' => 'expiredate', 'dt' => $i++], ['db' => 'status', 'dt' => $i++], ['db' => 'editor_id', 'dt' => $i++], ['db' => 'refresh_date', 'dt' => $i++], ['db' => 'logo_image', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();
        //$result = $company->getCompany($searchFields);

        ///////////////////////////////////////////////////////////////////////

        $query = $company->getQuery();
        // dd($query);

        if (isset($searchFields['filter']['refresh_date'])) {
            $searchFields['filter']['refresh_date'] = convertJToGDate($searchFields['filter']['refresh_date']);
        }

        if (isset($searchFields['filter']['expiredate'])) {
            $searchFields['filter']['expiredate'] = convertJToGDate($searchFields['filter']['expiredate']);
        }

        $result = $company->getByFilter($searchFields, $query);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($result['result'] != '1') {
            $this->fileName = 'admin.company.showRegisterNewCompany.php';
            $this->template('', $result['msg']);
            die();
        }

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id = "" class="company_phone">';

                if ($list['company_type'] == '1') {
                    $st .= $list['company_type'] = 'حقوقی';
                } elseif ($list['company_type'] == '2') {
                    $st .= $list['company_type'] = 'حقیقی';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['4'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="" class="company_phone">';
                if ($list['package_status'] == '1') {
                    $st .= $list['package_status'] = 'رایگان';
                } elseif ($list['package_status'] == '4') {
                    $st .= $list['package_status'] = 'تجاری';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['5'] = [
            'formatter' => function ($list) {
                if ($list['package_status'] == '4') {
                    $st = $list['expiredate'] ? convertDate($list['expiredate']) : '0000/00/00';
                }

                return $st;
            },
        ];

        $other['6'] = [
            'formatter' => function ($list) {
                if ($list['status'] == 1) {
                    $st = 'فعال';
                } elseif ($list['status'] == 0) {
                    $st = 'غیر فعال';
                }

                return $st;
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                $st = $list['editor_id'];

                return $st;
            },
        ];

        $other['8'] = [
            'formatter' => function ($list) {
                if ($list['refresh_date'] != '') {
                    $st = $list['refresh_date'] ? convertDate($list['refresh_date']) : '0000/00/00';
                }

                return $st;
            },
        ];

        $other['9'] = [
            'formatter' => function ($list) {
                if (strlen($list['image']) > 0) {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="">
                    <img src="' .
                        COMPANY_ADDRESS .
                        $list['Company_id'] .
                        '/logo/' .
                        $list['image'] .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                } else {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="">
                    <img src="' .
                        DEFULT_LOGO_ADDRESS .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                }

                return $st;
            },
        ];

        $internalVariable['showstatus'] = $fields['status'];
        $other['10'] = [
            formatter => function ($list, $internal) {
                $st = 'a' . $list['showstatus'];
                global $admin_info;
                $member_id = $admin_info['admin_id'];
                if ($list['lock'] != '0' and $list['lock'] != '') {
                    $st = '<span  class="glyphicon glyphicon-lock " style="color:red" aria-hidden="true"></span>';
                } else {
                    if (/*$list['package_status'] == '4'*/true) {
                        $st =
                            '<div class="btn-group">

                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=edit&id=' .
                            $list['Company_id'] .
                            '&showStatus=' .
                            $internal['showstatus'] .
                            '">ویرایش</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=delete&id=' .
                            $list['Company_id'] .
                            '">حذف</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=sendNewPass&id=' .
                            $list['Company_id'] .
                            '">ارسال نام کاربری و کلمه عبور</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=editUserPass&id=' .
                            $list['Company_id'] .
                            '">تغییر نام کاربری و کلمه عبور</a></li>
                            <li><a target="_blank" href="' .
                            RELA_DIR .
                            'admin/?component=login&action=loginAs&id=' .
                            $list['Company_id'] .
                            '">ورود به کمپانی</li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=product&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=history&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">سوابق</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyCommercialName&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">نام تجاری</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=honour&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">افتخارات</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyNews&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">اخبار</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=branch&company_id=' .
                            $list['Company_id'] .
                            '">شعبه و نمایندگی</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyAdvertise&action=showList&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">آگهی ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=employment&action=showList&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">فرصت های شغلی</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyAddresses&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyPhones&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyEmails&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">پست الکترونیک</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyWebsites&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">وب سایت ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companySocials&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">شبکه های اجتماعی</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=licence&action=addLicence&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">مجوزها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyBanner&action=add&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">بنر</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyLogo&action=add&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">لوگو</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=showCompanyDifference&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">مقایسه اطلاعات</a></li>
                          </ul>
                        </div>';
                    } else {
                        $st =
                            '
                          
                          <div class="btn-group">

                          
                          
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          
                          <ul class="dropdown-menu">
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=edit&id=' .
                            $list['Company_id'] .
                            '&showStatus=' .
                            $internal['showstatus'] .
                            '">ویرایش</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=delete&id=' .
                            $list['Company_id'] .
                            '">حذف</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=product&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyAddresses&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyPhones&company_id=' .
                            $list['Company_id'] .
                            '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=licence&action=addLicence&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">مجوزها</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=companyLogo&action=add&id=' .
                            $list['Company_id'] .
                            '">لوگو</a></li>
                            <li><a href="' .
                            RELA_DIR .
                            'admin/?component=company&action=showCompanyDifference&id=' .
                            $list['Company_id'] .
                            '&branch_id=0">مقایسه اطلاعات</a></li>
                          </ul>
                        </div>';
                    }
                }
                $st .=
                    '<br>
                    <a class="btn btn-default" href="' .
                    RELA_DIR .
                    'admin/?component=company&action=printCompanyInformation&id=' .
                    $list['Company_id'] .
                    '&branch_id=0" target="_blank">
                        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                    </a>';
                return $st;
            },
        ];
        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function searchExpire($fields)
    {
        /*echo '<pre/>';
        print_r($fields);
        die();*/

        $company = new adminCompanyModel();

        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'coordinator_name', 'dt' => $i++], ['db' => 'coordinator_family', 'dt' => $i++], ['db' => 'phone_number', 'dt' => $i++], ['db' => 'refresh_date', 'dt' => $i++], ['db' => 'expiredate', 'dt' => $i++], ['db' => 'email', 'dt' => $i++], ['db' => 'url', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();

        $date = date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD));

        //$searchFields['where'] = 'where .". packageusage.expiredate ."< ' . "'$date'";
        //$searchFields['where'] = "where  packageusage.expiredate  < company.refresh_date";

        $query = $company->getQuery('expire');
        $result = $company->getByFilter($searchFields, $query);
        //$result = $company->getCompany($searchFields);

        if ($result['result'] != '1') {
            $this->fileName = 'admin.company.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];
        $other['4'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">' . $list['phone_number'] . '</div>';

                return $st;
            },
        ];

        $other['5'] = [
            'formatter' => function ($list) {
                $st = convertDate($list['refresh_date']);

                return $st;
            },
        ];

        $other['6'] = [
            'formatter' => function ($list) {
                $st = convertDate(date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD, strtotime($list['refresh_date']))));

                return $st;
            },
        ];

        //        $other['7'] = array(
        //            'formatter' => function ($list) {
        //                if ($list['status'] == 1) {
        //                    $st = 'فعال';
        //                } else {
        //                    $st = 'غیر فعال';
        //                }
        //                return $st;
        //            }
        //        );

        $internalVariable['showstatus'] = $fields['status'];
        $other[$i - 1] = [
            formatter => function ($list, $internal) {
                $st = 'a' . $list['showstatus'];
                $st =
                    '<a href="' .
                    RELA_DIR .
                    'admin/?component=company&action=edit&id=' .
                    $list['Company_id'] .
                    '&showStatus=' .
                    $internal['showstatus'] .
                    '">ویرایش</a> <br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=product&id=' .
                    $list['Company_id'] .
                    '">لیست محصولات</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=honour&id=' .
                    $list['Company_id'] .
                    '">لیست افتخارات</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=licence&id=' .
                    $list['Company_id'] .
                    '">لیست مجوز ها</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=company&action=delete&id=' .
                    $list['Company_id'] .
                    $list['company_name'] .
                    '">حذف</a>';
                // return $st;
            },
        ];
        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function searchUnverified($fields)
    {
        /*echo '<pre/>';
        print_r($fields);
        die();*/

        $company = new adminCompanyModel();

        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'phone_number', 'dt' => $i++], ['db' => 'city_name', 'dt' => $i++], ['db' => 'address_address', 'dt' => $i++], ['db' => 'email_email', 'dt' => $i++], ['db' => 'website_url', 'dt' => $i++], ['db' => 'status', 'dt' => $i++], ['db' => 'logo', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();

        //$date = date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD));
        //$searchFields['where'] = 'where refresh_date < '."'$date'";
        $searchFields['where'] = " WHERE  status = '0' ";
        $result = $company->getCompany($searchFields);
        if ($result['result'] != '1') {
            $this->fileName = 'admin.company.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $list['list'] = $company->list;
        $list['paging'] = $company->recordsCount;

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">' . $list['phone_number'] . '</div>';

                return $st;
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                if ($list['status'] == 1) {
                    $st = 'فعال';
                } else {
                    $st = 'غیر فعال';
                }

                return $st;
            },
        ];
        $internalVariable['showstatus'] = $fields['status'];
        $other[$i - 1] = [
            formatter => function ($list, $internal) {
                $st = 'a' . $list['showstatus'];
                $st =
                    '<a href="' .
                    RELA_DIR .
                    'admin/?component=company&action=edit&id=' .
                    $list['Company_id'] .
                    '&showStatus=' .
                    $internal['showstatus'] .
                    '">ویرایش</a> <br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=product&id=' .
                    $list['Company_id'] .
                    '">لیست محصولات</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=honour&id=' .
                    $list['Company_id'] .
                    '">لیست افتخارات</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=licence&id=' .
                    $list['Company_id'] .
                    '">لیست مجوز ها</a><br/>
                        <a href="' .
                    RELA_DIR .
                    'admin/?component=company&action=delete&id=' .
                    $list['Company_id'] .
                    $list['company_name'] .
                    '">حذف</a>';

                return $st;
            },
        ];
        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function showExpiredList($msg = '')
    {
        $export['status'] = 'expired';
        $this->fileName = 'admin.company.showExpireList.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author malekloo
     * @date 3/6/2015
     *
     * @version 01.01.01
     */
    public function showUnverifiedList($msg = '')
    {
        $export['status'] = 'unverified';
        $this->fileName = 'admin.company.showUnverifiedList.php';
        $this->template($export);
        die();
    }

    /**
     * importCompanies.
     *
     * @return redirectPage
     */
    public function updateCity()
    {
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';

        $cityList = adminCityModelDb::getAll()['export']['list'];

        foreach ($cityList as $key => $fields) {
            $province_id = $fields['province_id'];

            echo $province_id;

            $conn = dbConn::getConnection();

            $sql =
                "
                UPDATE company
                  SET
                    `state_id`             =   '" .
                $fields['province_id'] .
                "'
                    WHERE city_id = '" .
                $fields['City_id'] .
                "'
                    ";

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            if (!$stmt) {
                $result['result'] = -1;
                $result['Number'] = 1;
                $result['msg'] = $conn->errorInfo();

                return $result;
            }

            $city_id = $fields['City_id'];
            $province_id = $fields['province_id'];
            echo $province_id;
            //echo '<br/>';
            //echo '<br/>$city_id<br/>';
            //echo $city_id;
        }
        die();
    }

    public function importCompanies()
    {
        include_once dirname(__FILE__) . '/admin.company.model.db.php';
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.db.php';
        $xml = STATIC_ROOT_DIR . '/xml/companies.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);

        $ws = $wb->getElementsByTagName('Worksheet')->item(0);
        $table = $ws->getElementsByTagName('Table')->item(0);
        $row = $table->getElementsByTagName('Row');
        $i = 1;

        foreach ($row as $rowkey => $rowValue) {
            $fields = [];
            $cell = $rowValue->getElementsByTagName('Cell');
            $fields['Company_id'] = $i;
            $fields['company_name'] = $cell[19]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['meta_description'] = $cell[16]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['description'] = $cell[16]->getElementsByTagName('Data')[0]->nodeValue;

            $g1 = $cell[6]->getElementsByTagName('Data')[0]->nodeValue;
            $g1s = $cell[5]->getElementsByTagName('Data')[0]->nodeValue;
            $g2 = $cell[4]->getElementsByTagName('Data')[0]->nodeValue;
            $g2s = $cell[3]->getElementsByTagName('Data')[0]->nodeValue;
            $g3 = $cell[2]->getElementsByTagName('Data')[0]->nodeValue;
            $g3s = $cell[1]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['category_list'] = '';
            if ($g1 != '{-}') {
                $fieldsArray = explode(',', $fields['category_list']);
                if (!array_search($g1 * 100, $fieldsArray)) {
                    $fields['category_list'] .= ',' . $g1 * 100;
                }
                if (!array_search($g1 * 100 + $g1s, $fieldsArray)) {
                    $fields['category_list'] .= ',' . ($g1 * 100 + $g1s);
                }
            }
            if ($g2 != '{-}') {
                $fieldsArray = explode(',', $fields['category_list']);
                if (!array_search($g2 * 100, $fieldsArray)) {
                    $fields['category_list'] .= ',' . $g2 * 100;
                }
                if (!array_search($g2 * 100 + $g2s, $fieldsArray)) {
                    $fields['category_list'] .= ',' . ($g2 * 100 + $g2s);
                }
            }
            if ($g3 != '{-}') {
                $fieldsArray = explode(',', $fields['category_list']);
                if (!array_search($g3 * 100, $fieldsArray)) {
                    $fields['category_list'] .= ',' . $g3 * 100;
                }
                if (!array_search($g3 * 100 + $g3s, $fieldsArray)) {
                    $fields['category_list'] .= ',' . ($g3 * 100 + $g3s);
                }
            }
            $fields['category_list'] = $fields['category_list'] . ',';

            $city_name = $cell[13]->getElementsByTagName('Data')[0]->nodeValue;
            $city_id = adminCityModelDb::getCityByName($city_name)['City_id'];
            if ($city_id == '') {
                $fieldsCity = ['city_name' => $city_name];
                //$resultInsetCity = adminCityModelDb::insert($fieldsCity);
                //$city_id = $resultInsetCity['export']['insert_id'];
            }
            $fields['city_id'] = $city_id;

            $result = adminCompanyModelDb::insert2($fields);

            // phone 1
            $code = $cell[21]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[22]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[23]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsPhone['company_id'] = $i;
                $fieldsPhone['subject'] = 'تلفن 1';
                $fieldsPhone['number'] = $number;
                if ($until != '{-}') {
                    $fieldsPhone['state'] = 'الی';
                    $fieldsPhone['value'] = $until;
                } else {
                    $fieldsPhone['state'] = 'سایر';
                    $fieldsPhone['value'] = '';
                }
                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsPhone);
                //$result = adminCompanyModelDb::insertToPhones2($fieldsPhone);
            }
            // end phone 1

            // phone 2
            $code = $cell[24]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[25]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[26]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsPhone['company_id'] = $i;
                $fieldsPhone['subject'] = 'تلفن 2';
                $fieldsPhone['number'] = $number;
                if ($until != '{-}') {
                    $fieldsPhone['state'] = 'الی';
                    $fieldsPhone['value'] = $until;
                } else {
                    $fieldsPhone['state'] = 'سایر';
                    $fieldsPhone['value'] = '';
                }

                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsPhone);

                //$result = adminCompanyModelDb::insertToPhones2($fieldsPhone);
            }
            // end phone 2

            // phone 3
            $code = $cell[27]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[28]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[29]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsPhone['company_id'] = $i;
                $fieldsPhone['subject'] = 'تلفن 3';
                $fieldsPhone['number'] = $number;
                if ($until != '{-}') {
                    $fieldsPhone['state'] = 'الی';
                    $fieldsPhone['value'] = $until;
                } else {
                    $fieldsPhone['state'] = 'سایر';
                    $fieldsPhone['value'] = '';
                }
                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsPhone);
                // $result = adminCompanyModelDb::insertToPhones2($fieldsPhone);
            }
            // end phone 3

            // phone 4
            $code = $cell[30]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[31]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[32]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsPhone['company_id'] = $i;
                $fieldsPhone['subject'] = 'تلفن 4';
                $fieldsPhone['number'] = $number;
                if ($until != '{-}') {
                    $fieldsPhone['state'] = 'الی';
                    $fieldsPhone['value'] = $until;
                } else {
                    $fieldsPhone['state'] = 'سایر';
                    $fieldsPhone['value'] = '';
                }
                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsPhone);
                //$result = adminCompanyModelDb::insertToPhones2($fieldsPhone);
            }
            // end phone 4

            // fax 1
            $code = $cell[34]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[35]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[36]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsFax['company_id'] = $i;
                $fieldsFax['subject'] = 'فکس 1';
                $fieldsFax['number'] = $number;
                if ($until != '{-}') {
                    $fieldsFax['state'] = 'الی';
                    $fieldsFax['value'] = $until;
                } else {
                    $fieldsFax['state'] = 'سایر';
                    $fieldsFax['value'] = '';
                }
                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsFax);
                //$result = adminCompanyModelDb::insertToPhones2($fieldsFax);
            }
            // end fax 1

            // fax 2
            $code = $cell[37]->getElementsByTagName('Data')[0]->nodeValue;
            $number = $cell[38]->getElementsByTagName('Data')[0]->nodeValue;
            $until = $cell[39]->getElementsByTagName('Data')[0]->nodeValue;
            if ($code != '{-}') {
                $fieldsFax['company_id'] = $i;
                $fieldsFax['subject'] = 'فکس 2';
                $fieldsFax['number'] = $number;
                if ($until != '{-}') {
                    $fieldsFax['state'] = 'الی';
                    $fieldsFax['value'] = $until;
                } else {
                    $fieldsFax['state'] = 'سایر';
                    $fieldsFax['value'] = '';
                }
                $phoneObject = new admincompany_phonesController();
                $phoneObject->addWithoutDraft($fieldsFax);
                //$result = adminCompanyModelDb::insertToPhones2($fieldsFax);
            }
            // end fax 2

            // email
            $email = $cell[12]->getElementsByTagName('Data')[0]->nodeValue;
            if ($email != '{-}') {
                $fieldsEmail['company_id'] = $i;
                $fieldsEmail['subject'] = 'ایمیل';
                $fieldsEmail['email'] = $email;

                $emailObject = new admincompany_phonesController();
                $emailObject->addWithoutDraft($fieldsEmail);
                //$result = adminCompanyModelDb::insertToEmails2($fieldsEmail);
            }
            // end email

            // address
            $address = $cell[14]->getElementsByTagName('Data')[0]->nodeValue;
            if ($address != '{-}') {
                $fieldsAddresses['company_id'] = $i;
                $fieldsAddresses['subject'] = 'آدرس';
                $fieldsAddresses['address'] = $address;

                $addressObject = new admincompany_addressesController();
                $addressObject->addWithoutDraft($fieldsAddresses);

                //$result = adminCompanyModelDb::insertToAddresses2($fieldsAddresses);
            }
            // end address

            // website
            $website = $cell[11]->getElementsByTagName('Data')[0]->nodeValue;
            if ($website != '{-}') {
                $fieldsWebsite['company_id'] = $i;
                $fieldsWebsite['subject'] = 'وب سایت';
                $fieldsWebsite['url'] = $website;

                $websiteObject = new admincompany_websitesController();
                $websiteObject->addWithoutDraft($fieldsWebsite);

                //$result = adminCompanyModelDb::insertToWebsites2($fieldsWebsite);
            }
            // end website

            //if ($i % 10 == 0) {
            ///       echo $i;
            //       echo '<br>';
            //      die();
            //  }
            ++$i;
            //flush();
            //ob_flush();
            //ob_end_clean();
        }

        $msg = 'ایمپورت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    /**
     * importCompanyPhones.
     *
     * @return redirectPage
     */
    public function importCompanyPhones()
    {
        include_once dirname(__FILE__) . '/admin.company.model.db.php';
        $xml = STATIC_ROOT_DIR . '/xml/company-phones.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);
        $ws = $wb->getElementsByTagName('Worksheet')->item(0);
        $table = $ws->getElementsByTagName('Table')->item(0);
        $row = $table->getElementsByTagName('Row');
        $i = 1;
        foreach ($row as $rowkey => $rowValue) {
            $fields = [];
            $cell = $rowValue->getElementsByTagName('Cell');
            $companyId = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['company_id'] = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['number'] = $cell[1]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['state'] = $cell[2]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['value'] = $cell[3]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['subject'] = 'تلفن';
            $result = adminCompanyModelDb::insertToPhones2($fields);

            if ($i % 100 == 0) {
                echo $i;
                echo '<br>';
            }
            ++$i;
            flush();
            ob_flush();
            ob_end_clean();
        }

        $msg = 'ایمپورت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    /**
     * importCompanyEmails.
     *
     * @return redirectPage
     */
    public function importCompanyEmails()
    {
        include_once dirname(__FILE__) . '/admin.company.model.db.php';
        $xml = STATIC_ROOT_DIR . '/xml/company-emails.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);
        $ws = $wb->getElementsByTagName('Worksheet')->item(0);
        $table = $ws->getElementsByTagName('Table')->item(0);
        $row = $table->getElementsByTagName('Row');
        $i = 1;
        foreach ($row as $rowkey => $rowValue) {
            ob_start();
            $fields = [];
            $cell = $rowValue->getElementsByTagName('Cell');
            $companyId = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['company_id'] = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['subject'] = 'ایمیل';
            $fields['email'] = $cell[1]->getElementsByTagName('Data')[0]->nodeValue;
            $result = adminCompanyModelDb::insertToEmails2($fields);

            echo $i;
            // if($i % 100 == 0){
            //     echo "<br>";
            // }
            ++$i;
            flush();
            ob_flush();
            ob_end_clean();
        }

        $msg = 'ایمپورت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    /**
     * importCompanyAddresses.
     *
     * @return redirectPage
     */
    public function importCompanyAddresses()
    {
        include_once dirname(__FILE__) . '/admin.company.model.db.php';
        $xml = STATIC_ROOT_DIR . '/xml/company-addresses.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);
        $ws = $wb->getElementsByTagName('Worksheet')->item(0);
        $table = $ws->getElementsByTagName('Table')->item(0);
        $row = $table->getElementsByTagName('Row');
        $i = 1;
        foreach ($row as $rowkey => $rowValue) {
            $fields = [];
            $cell = $rowValue->getElementsByTagName('Cell');
            $companyId = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['company_id'] = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['subject'] = 'آدرس';
            $fields['address'] = $cell[1]->getElementsByTagName('Data')[0]->nodeValue;
            $result = adminCompanyModelDb::insertToAddresses2($fields);

            if ($i % 100 == 0) {
                echo $i;
                echo '<br>';
            }
            ++$i;
            flush();
            ob_flush();
            ob_end_clean();
        }

        $msg = 'ایمپورت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    /**
     * importCompanyWebsites.
     *
     * @return redirectPage
     */
    public function importCompanyWebsites()
    {
        include_once dirname(__FILE__) . '/admin.company.model.db.php';
        $xml = STATIC_ROOT_DIR . '/xml/company-websites.xml';
        $xmlDoc = new DOMDocument();
        $xmlDoc->load($xml);
        $wb = $xmlDoc->getElementsByTagName('Workbook')->item(0);
        $ws = $wb->getElementsByTagName('Worksheet')->item(0);
        $table = $ws->getElementsByTagName('Table')->item(0);
        $row = $table->getElementsByTagName('Row');
        $i = 1;
        foreach ($row as $rowkey => $rowValue) {
            $fields = [];
            $cell = $rowValue->getElementsByTagName('Cell');
            $companyId = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['company_id'] = $cell[0]->getElementsByTagName('Data')[0]->nodeValue;
            $fields['subject'] = 'وب سایت';
            $fields['url'] = $cell[1]->getElementsByTagName('Data')[0]->nodeValue;
            $result = adminCompanyModelDb::insertToWebsites2($fields);

            if ($i % 100 == 0) {
                echo $i;
                echo '<br>';
            }
            ++$i;
            flush();
            ob_flush();
            ob_end_clean();
        }

        $msg = 'ایمپورت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    /**
     * delete deleteCompany by company_id.
     *
     * @param $company_id
     *
     * @author malekloo
     * @date 2/24/2015
     *
     * @version 01.01.01
     */
    public function deleteCompany($company_id)
    {
        $company = adminCompanyModel::find($company_id);

        if (!is_object($company)) {
            $msg = 'رکورد مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        //------> delete Phones
        $companyPhones = new admincompany_phonesController();
        $result['phone'] = $companyPhones->deleteWithCompanyId($company_id);

        //------> delete Email
        include_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmails.controller.php';
        $companyEmails = new admincompany_EmailsController();
        $result['email'] = $companyEmails->deleteWithCompanyId($company_id);

        //------> delete address
        include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.controller.php';
        $companyAddresses = new admincompany_addressesController();
        $result['address'] = $companyAddresses->deleteWithCompanyId($company_id);

        //------> delete website
        include_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsites.controller.php';
        $companyWebsites = new admincompany_websitesController();
        $result['website'] = $companyWebsites->deleteWithCompanyId($company_id);

        //------> delete Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licenceObject = new adminlicenceController();
        $result['licence'] = $licenceObject->deleteWithCompanyId($company_id);

        //        //------> delete Licence
        //        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        //        $licenceObject = new adminlicenceController();
        //        $result['licence'] = $licenceObject->delete($company_id);

        $company->delete();

        include_once ROOT_DIR . '/component/product/admin/model/admin.product.model.php';
        $product = new adminc_productModel();
        $result = $product->getProductByCompanyId($id);

        if ($result['export']['recordsCount'] > 0) {
            $msg = 'توجه : ابتدا محصولات این کمپانی را حذف تنایید.';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $result = $company->delete();

        if ($result['result'] != '1') {
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        die();
    }

    public function call($fields)
    {
        include_once dirname(__FILE__) . '/php-ami-class.php';
        $conn = new AstMan();
        $ret = $conn->clickToCall($fields['number']);
        die();
    }

    public function getCompanyphone($input)
    {
        $company_id = $input['company_id'];
        include_once dirname(__FILE__) . '/admin.company.model.php';
        $model = new adminCompanyModel();
        $result = $model->getCompanyphoneAll($company_id);
        $phone = '';
        foreach ($result['export']['list'] as $key => $value) {
            $phone .= '<h4><a class="btn btn-default company_allphone label label-default" href="#" role="button" data-myphonenumber="' . $value . '" data-mycompanyid="' . $company_id . '"><span class="glyphicon glyphicon-phone-alt"></span></a><span>' . $value . '</span></h4>';
        }
        echo $phone;
        //json_encode($result);
        die();
    }

    public function getCityAjax($input)
    {
        $province_id = $input['province_id'];
        include_once ROOT_DIR . '/component/city/admin/model/admin.city.model.php';
        $model = new adminCityModel();
        $result = $model->getCitiesByprovinceID($province_id);

        $option = '';
        if ($input['city_id'] != 0) {
            foreach ($result['export']['list'] as $key => $value) {
                if ($value['City_id'] == $input['city_id']) {
                    $select = 'selected';
                } else {
                    $select = '';
                }
                $option .= '<option id= ' . $input['city_id'] . ' value = ' . $value['City_id'] . ' ' . $select . '>' . $value['name'] . '</option>';
            }
        } else {
            foreach ($result['export']['list'] as $key => $value) {
                $option .= '<option value = ' . $value['City_id'] . '>' . $value['name'] . '</option>';
            }
        }

        echo $option;
        die();
    }

    public function getTypeAjax($input)
    {
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $province = new adminStateModel();
        $resultProvince = $province->getStates();
        if ($resultProvince['result'] == 1) {
            $export['provinces'] = $province->list;
        }

        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax();
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        include_once ROOT_DIR . 'component/personalityList/admin/model/admin.personalityList.controller.php';
        $personalityList = new adminpersonality_listController();
        $resultPersonalityList = $personalityList->getPersonalityList();
        if ($resultPersonalityList['result'] == 1) {
            $export['personalityList'] = $resultPersonalityList['export']['list'];
        }

        //        ob_start();
        if ($input == '1') {
            $this->fileName = 'admin.company.addFormHoghoghi.s1.php';
            $this->template($export, '', 0);
        } else {
            $this->fileName = 'admin.company.addFormHaghighi.s1.php';
            $this->template($export, '', 0);
        }

        die();
    }

    public function getCompanyInfoAjax($input)
    {
        $member = adminmembersModel::getBy_company_id($input['company_id'])->get();

        ///print_r_debug($member);

        if ($member['export']['recordsCount'] <= 0) {
            $msg = 'خطا در عملیات!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $member = $member['export']['list']['0'];

        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $province = new adminStateModel();
        $resultProvince = $province->getStates();
        if ($resultProvince['result'] == 1) {
            $export['provinces'] = $province->list;
        }

        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax();
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        include_once ROOT_DIR . 'component/personalityList/admin/model/admin.personalityList.controller.php';
        $personalityList = new adminpersonality_listController();
        $resultPersonalityList = $personalityList->getPersonalityList();
        if ($resultPersonalityList['result'] == 1) {
            $export['personalityList'] = $resultPersonalityList['export']['list'];
        }

        //        ob_start();
        if ($input == '1') {
            $this->fileName = 'admin.company.addFormHoghoghi.s1.php';
            $this->template($export, '', 0);
        } else {
            $this->fileName = 'admin.company.addFormHaghighi.s1.php';
            $this->template($export, '', 0);
        }

        die();
    }

    public function showCompanyBlock($fields = '', $msg = '')
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.company.showCompanyBlock.php';
        $this->template($export);
        die();
    }

    //    public function showBannerAddForm($fields, $msg)
    //    {
    //
    //        $companyBanner = admincompanyModel::find($fields['company_id']);
    //        if (is_object($companyBanner)) {
    //            $export = $companyBanner->fields;
    //            $this->fileName = 'admin.companyBanner.addForm.php';
    //            $this->template($export, $msg);
    //            die();
    //        } else {
    //            $msg = 'عملیات با موفقیت انجام نشد';
    //            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    //            die();
    //        }
    //    }
    //
    //    public function addBanner($fields, $files)
    //    {
    //        $companyBanner = admincompanyModel::find($fields['company_id']);
    //        if (is_object($companyBanner)) {
    //
    //            if ($fields['remove_image'] == 'on') {
    //                fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/banner/", $companyBanner->banner);
    //                $companyBanner->banner = '';
    //                $companyBanner->save();
    //            } else {
    //                if ($files['name'] != '') {
    //                    $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $files['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/banner/", 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => '',);
    //
    //
    //                    fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/banner/", $companyBanner->fields['banner']);
    //                    $result_uploader = fileUploader($Property, $files);
    //                    $companyBanner->banner = $result_uploader['image_name'];
    //                    $companyBanner->save();
    //                } else {
    //                    $field['image'] = $companyBanner->fields['banner'];
    //                    $companyBanner->banner = $companyBanner->fields['banner'];
    //                    //$companyLogo->setFields($field);
    //                    $companyBanner->save();
    //                    $msg = 'عملیات با موفقیت انجام شد';
    //                }
    //            }
    //        } else {
    //            $msg = 'عملیات با موفقیت انجام نشد';
    //        }
    //        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    //        die();
    //    }
    //
    //    public function showLogoAddForm($fields, $msg)
    //    {
    //
    //        $companyLogo = admincompanyModel::find($fields['company_id']);
    //        if (is_object($companyLogo)) {
    //            $export = $companyLogo->fields;
    //            $this->fileName = 'admin.companyLogo.addForm.php';
    //            $this->template($export, $msg);
    //            die();
    //        } else {
    //            $msg = 'عملیات با موفقیت انجام نشد';
    //            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    //            die();
    //        }
    //    }
    //
    //    public function addLogo($fields, $files)
    //    {
    //        $companyLogo = admincompanyModel::find($fields['company_id']);
    //        if (is_object($companyLogo)) {
    //            if ($fields['remove_image'] == 'on') {
    //                fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", $companyLogo->logo);
    //                $companyLogo->logo = '';
    //                $companyLogo->save();
    //            } else {
    //                if ($files['name'] != '') {
    //                    $Property = array('type' => 'jpg,png,jpeg', 'new_name' => $files['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => '',);
    //
    //                    fileRemover(COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/logo/", $companyLogo->fields['logo']);
    //                    $result_uploader = fileUploader($Property, $files);
    //                    $companyLogo->logo = $result_uploader['image_name'];
    //                    $companyLogo->save();
    //                } else {
    //                    $field['image'] = $companyLogo->fields['logo'];
    //                    $companyLogo->logo = $companyLogo->fields['logo'];
    //                    //$companyLogo->setFields($field);
    //                    $companyLogo->save();
    //                    $msg = 'عملیات با موفقیت انجام شد';
    //                }
    //            }
    //        } else {
    //            $msg = 'عملیات با موفقیت انجام نشد';
    //        }
    //        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    //        die();
    //    }

    public function showUserPassEditForm($fields, $msg = '')
    {
        $companyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($companyObject)) {
            $msg = 'کمپانی مورد نظر یافت نشد!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        if ($companyObject->package_status <= 1) {
            $msg = 'کمپانی مورد نظر به صورت رایگان ثبت شده است.';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        $member = adminmembersModel::getBy_company_id($fields['company_id'])->get();

        if ($member['export']['recordsCount'] <= 0) {
            $msg = 'خطا در عملیات!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }
        $member = $member['export']['list']['0'];

        $export['company_id'] = $fields['company_id'];
        $export['username'] = $member->username;
        $this->fileName = 'admin.companyUserPass.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editUserPass($fields)
    {
        $companyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($companyObject)) {
            $msg = 'رکورد اصلی یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        $result = $this->checkUsername($fields);
        if ($result == 1) {
            $msg = 'نام کاربری تکراری می باشد';
            $this->fileName = 'admin.companyUserPass.editForm.php';
            $this->template($fields, $msg);
            die();
        }

        if (trim($fields['password']) == '' || trim($fields['username']) == '') {
            $msg = 'اطلاعات به صورت کامل وارد نشده است';
            $this->fileName = 'admin.companyUserPass.editForm.php';
            $this->template($fields, $msg);
            die();
        }

        $member = adminmembersModel::getBy_company_id($fields['company_id'])->get();

        if ($member['export']['recordsCount'] <= 0) {
            $msg = 'خطا در عملیات!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        $member = $member['export']['list']['0'];

        if (trim($fields['password']) != '') {
            $member->password = md5($fields['password']);
        }

        $member->username = $fields['username'];
        $member->save();

        $path = ROOT_DIR . 'templates/' . CURRENT_SKIN . '/admin.sendPassForm.php';

        $contacts = ['email' => $companyObject->email, 'subject' => 'ارسال نام کاربری', 'body' => ['path' => $path, 'data' => compact('fields')]];

        $result = EmailEngineController::forceSend($contacts);

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        die();
    }

    public function checkUsername($input)
    {
        $companyObject = adminmembersModel::getBy_username_and_not_username_and_not_company_id($input['username'], '', $input['company_id'])->getList();
        $result = '';
        if ($companyObject['export']['recordsCount'] != 0) {
            $result = 1;
        } else {
            $result = 0;
        }

        return $result;
    }

    /* -----------------------------------------------------------------------
     * --------------------------- show Draft Item --------------------------
     * -----------------------------------------------------------------------
     */

    public function showDraftCompany()
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.companyDraft.showList.php';
        $this->template($export);
        die();
    }

    public function findDraftItem($input, $id)
    {
        $item = [
            ['product', 'showDraftProduct', 'محصولات'],
            ['certification', 'showDraftCertification', 'گواهی ها'],
            ['honour', 'showDraftHonour', 'افتخارات'],
            ['businessLicence', 'showDraftBusinessLicence', 'پروانه کسب'],
            ['history', 'showDraftHistory', 'سوابق'],
            ['companyNews', 'showDraftCompanyNews', 'اخبار'],
            ['companyAddresses', 'showDraftCompanyAddress', 'آدرس'],
            ['companyPhones', 'showDraftCompanyPhone', 'تلفن'],
            ['companyEmails', 'showDraftCompanyEmail', 'ایمیل'],
            ['companyWebsites', 'showDraftCompanyWebsite', 'وب سایت'],
            ['companyBanner', 'showDraftCompanyBanner', 'بنر'],
            ['companyLogo', 'showDraftCompanyLogo', 'لوگو'],
            ['companyCommercialName', 'showDraftCompanyCommercialName', 'نام تجاری'],
            ['licence', 'showDraftLicence', 'مجوز'],
            ['companySocials', 'showDraftCompanySocials', 'شبکه های اجتماعی'],
            ['company', 'editDraft', 'کمپانی'],
            ['branch', 'showDraftBranch', 'شعبه'],
            ['branch', 'showDraftBranch', 'شعبه'],
            ['employment', 'showDraftList', ' فرصت های شغلی'],
            ['companyAdvertise', 'showDraftCompanyAdvertise', 'آگهی '],
            ['product', 'showDraftGalleryProduct', 'گالری محصول'],
        ];

        $s = '<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">';
        for ($i = 0; $i < 21; $i++) {
            if ($input[$i] != 0) {
                $s .= '<li> <a href="' . RELA_DIR . 'admin/?component=' . $item[$i][0] . '&action=' . $item[$i][1] . '&id=' . $id . '">' . $item[$i][2] . '</a><li/>';
                //  print_r_debug($s);
            }
        }
        $s .= '</ul></div>';

        return $s;
    }

    public function searchDraft($fields)
    {
        $company = new admincompanyModel();

        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'number', 'dt' => $i++], ['db' => 'city_name', 'dt' => $i++], ['db' => 'address', 'dt' => $i++], ['db' => 'email', 'dt' => $i++], ['db' => 'website_url', 'dt' => $i++], ['db' => 'status', 'dt' => $i++], ['db' => 'logo', 'dt' => $i++], ['db' => 'logo', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();

        //$date = date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD));
        //$searchFields['where'] = 'where refresh_date < '."'$date'";

        $query = $company->getQuery('draft');

        $result = $company->getByFilter($searchFields, $query);

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">' . $list['phone_number'] . '</div>';

                return $st;
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                if ($list['status'] == 1) {
                    $st = 'فعال';
                } else {
                    $st = 'غیر فعال';
                }

                return $st;
            },
        ];

        $other[$i - 2] = [
            'formatter' => function ($list) {
                $st =
                    '<div data-company_id="' .
                    $list['Company_id'] .
                    '" class="company_phone" style="width:150px;padding:5px">
                    <img src="' .
                    COMPANY_ADDRESS .
                    $list['Company_id'] .
                    '/logo/90.90.' .
                    $list['image'] .
                    '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" >
                </div>';

                return $st;
            },
        ];

        $internalVariable['showstatus'] = $fields['status'];
        $other[$i - 1] = [
            'formatter' => function ($list, $internal) {
                $st = $this->findDraftItem($list['edit'], $list['Company_id']);

                return $st;
                // return $list['edit'];
            },
        ];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);

        echo json_encode($export);
        die();
    }

    /* -----------------------------------------------------------------------
     * ---------------------------- Draft Company ---------------------------
     * -----------------------------------------------------------------------
     */

    public function checkDraft($modelName = '', $draft_id = 0)
    {
        $result = $modelName::find($draft_id);
        if (is_object($result)) {
            if ($result->status == 0 and $result->isActive == 1) {
                $result['is_draft'] = 1;
            } else {
                $result['is_draft'] = -1;
            }
        } else {
            $result['is_draft'] = -1;
        }

        return $result;
    }

    public function showCompanyDraftEditForm($fields = '', $msg)
    {
        $showStatus = $fields['showStatus'];
        if (is_array($fields)) {
            $companyObject = admincompany_dModel::getBy_company_id_and_isActive_and_status($fields['Company_id'], 1, -1)->getList();

            //$companyObject->refresh_date = convertDate($companyObject->refresh_date);
            if ($companyObject['export']['recordsCount'] <= 0) {
                $msg = 'رکورد ویرایش شده یافت نشد! ';
                redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
            }

            $export = $companyObject['export']['list']['0'];
            $export['category_id'] = trim($export['category_id'], ',');

            $category = admincompanyModel::tagToArray($companyObject->category_id);
            //$export['category_id'] = tagToArray($companyObject['export']['list']['0']['category_id'])['export']['list'];
            $certification = admincompanyModel::tagToArray($companyObject->certification_id);
            $export['certification_id'] = $certification['export']['list'];
        } else {
            $export = $fields;
        }

        //------> Get Packege Of Company
        $packageUsage = getPackageUsage($fields['Company_id']);
        $export['packageUsage']['category'] = $packageUsage->category;

        //------> Get all Member Information
        include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';
        $memberObject = new adminLoginController();
        $resultObject = $memberObject->getMemberObject($fields['Company_id']);
        $export['memberInfo']['name'] = $resultObject->name;
        $export['memberInfo']['family'] = $resultObject->family;
        $export['memberInfo']['email'] = $resultObject->email;
        $export['memberInfo']['mobile'] = $resultObject->mobile;

        //Get all City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //Get all State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $state = new adminStateModel();
        $resultState = $state->getStates();
        if ($resultState['result'] == 1) {
            $export['states'] = $state->list;
        }

        //------> Get All Category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //Get All Certification
        $export['showStatus'] = $showStatus;
        $this->fileName = 'admin.companyDraft.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editDraft($fields, $file)
    {
        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'admincompany_dModel';
        $mainModel = str_replace('_dModel', 'Model', $draftModel);
        $draft_p_key = ucfirst(str_replace('_dModel', '_d_id', str_replace('admin', '', $draftModel)));
        $draft_f_key = lcfirst(str_replace('_d_id', '_id', $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        //$componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

        //set fields var
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];

        /////////////////////////////////////
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['draftModel'] = $draftModel;
        $fields['files'] = $file;
        $fields['mainModel'] = $mainModel;
        $fields['draft_p_key'] = $draft_p_key;
        $fields['draft_f_key'] = $draft_f_key;
        $fields['main_p_key'] = $main_p_key;

        //find draft record
        $draftObject = $draftModel::find($fields['draft_id']);

        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = 'رکورد ویرایش شده یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } elseif ($fields['process'] == -1) {
            $this->rejectDraft($draftObject, $fields);
        }

        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany');
        die();
    }

    public function acceptDraft($draftObject, $fields)
    {
        $fields[$fields['draft_f_key']] = $draftObject->$fields['main_p_key'];
        $fields['company_id'] = $draftObject->company_id;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['status'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['image'] = '';

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($fields);
        $fields['parent_category_id'] = $result['parent_category_id'];
        $fields['category_id'] = $result['category_id'];

        //------> Add to log
        $fields['action'] = 2;
        $log = new adminLogController();
        $log->AddLog($fields);

        if (isset($fields['files']['name']) and trim($fields['files']['name']) != '') {
            if ($fields['remove-file'] == 'on') {
                $fields['image'] = '';
            } else {
                if ($fields['files']['name'] != '') {
                    $Property = ['type' => 'jpg,png,jpeg,pdf', 'new_name' => $fields['files']['name'], 'max_size' => '8388608', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/catalog/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];
                    $result_uploader = fileUploader($Property, $fields['files']);
                    $fields['catalog'] = $result_uploader['image_name'];
                } else {
                    $fields['catalog'] = $draftObject->image;
                }
            }
        } else {
            $fields['catalog'] = $draftObject->catalog;
        }

        ///draft to Main
        $mainObject = admincompanyModel::find($draftObject->company_id); // when main row is edit

        if (!is_object($mainObject)) {
            $msg = 'رکورد اصلی یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $fields['componentName'] . '&action=showDraft' . ucfirst($fields['componentName']) . '&id=' . $fields['draftModel']->company_id, $msg);
        }

        $mainObject->setFields($fields);
        $mainObject->save();

        //if new record add main save to draft

        $newDraftObject = new admincompany_dModel();
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->company_id = $mainObject->Company_id;
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();

        //------> update Draft
        $draftObject->company_id = $mainObject->Company_id;
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;

        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();

        //------> member Update
        $resultObject = members::getBy_company_id($newDraftObject->company_id)->first();
        $resultObject->name = $fields['coordinator_name'];
        $resultObject->family = $fields['coordinator_family'];
        $resultObject->email = $fields['coordinator_email'];
        $resultObject->mobile = $fields['coordinator_mobile'];
        $resultObject->save();

        // add New Notification
        $notification = new adminNotificationController();
        $Items = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => 'تغییرات مربوط به آدرس شما با موفقیت اعمال شد', 'messageType' => 2];
        $notification->addNotification($Items);

        //change edit field
        $edit = $mainObject->edit;
        $edit[15] = 0;
        $mainObject->edit = $edit;
        $mainObject->save();
    }

    public function rejectDraft($draftObject, $fields)
    {
        //Previous Draft
        if ($draftObject->$fields['draft_f_key'] != 0) {
            $a = 'getBy_' . $fields['draft_f_key'] . '_and_company_id_and_isActive';
            $p_productDraftObject = $fields['draftModel']
                ::$a($draftObject->$fields['draft_f_key'], $draftObject->company_id, 0)
                ->orderBy($fields['draft_p_key'], 'DESC')
                ->first();
            $p_productDraftObject->isActive = 1;
            $p_productDraftObject->status = 1;
            $p_productDraftObject->isAdmin = 1;
            $p_productDraftObject->editor_id = $fields['editor_id'];
            $p_productDraftObject->save();
        }

        //------> Add to log
        $fields['action'] = 2;
        $fields['company_id'] = $draftObject->company_id;
        $log = new adminLogController();
        $log->AddLog($fields);

        //reject Draft
        $draftObject->isActive = -1;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['editor_id'];
        $draftObject->save();

        $notification = new adminNotificationController();
        $fields = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => 'تغییرات مربوط به آدرس شما با موفقیت اعمال نشد', 'messageType' => 2];
        $notification->addNotification($fields);

        //change edit field
        $mainObject = companyModel::find($draftObject->company_id);
        $edit = $mainObject->edit;
        $edit[15] = 0;
        $mainObject->edit = $edit;
        $mainObject->save();
    }

    /* -----------------------------------------------------------------------
     * ----------------------------- New Company ----------------------------
     * -----------------------------------------------------------------------
     */

    public function showNewCompany()
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.companyNew.showList.php';
        $this->template($export);
        die();
    }

    public function searchNewCompany($fields = [])
    {
        $cites = new adminCityModel();
        $cites = $cites->getCitiesByid();

        $company = new admincompanyModel();
        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'image', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'company_type', 'dt' => $i++], ['db' => 'package_status', 'dt' => $i++], ['db' => 'number', 'dt' => $i++], ['db' => 'address', 'dt' => $i++], ['db' => 'register_date', 'dt' => $i++], ['db' => 'tools', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();
        $query = "
        select
            company.*,
            c_phones_d.number,
            c_phones_d.code,
            members.mobile,
            members.name,
            members.family,
            c_logo_d.image
        from company
        left join c_phones_d on c_phones_d.company_id = company.Company_id
        left join members on members.company_id = company.Company_id
        left join c_logo_d on c_logo_d.company_id = company.Company_id
        where new_register = '1' ";
        $result = $company->getByFilter($searchFields, $query);

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];
        $list['cites'] = $cites;
        $list['branch'] = $branch;

        $other['1'] = [
            'formatter' => function ($list) {
                if (strlen($list['image']) > 0) {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="">
                    <img src="' .
                        COMPANY_ADDRESS .
                        $list['Company_id'] .
                        '/logo/' .
                        $list['image'] .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                } else {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="">
                    <img src="' .
                        DEFULT_LOGO_ADDRESS .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                }

                return $st;
            },
        ];

        $other['3'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id = "" class="company_phone">';

                if ($list['company_type'] == '1') {
                    $st .= $list['company_type'] = 'حقوقی';
                } else {
                    $st .= $list['company_type'] = 'حقیقی';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['4'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="" class="company_phone">';
                if ($list['package_status'] == '1') {
                    $st .= $list['package_status'] = 'رایگان';
                } else {
                    $st .= $list['package_status'] = 'تجاری';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['5'] = [
            'formatter' => function ($list) {
                return $list['name'] . ' ' . $list['family'] . ' ' . $list['mobile'] . ' - ' . $list['code'].$list['number'];
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                $st = !empty($list['register_date']) ? convertDate($list['register_date']) : '';

                return $st;
            },
        ];

        $internalVariable['showstatus'] = $fields['status'];
        $other[$i - 1] = [
            'formatter' => function ($list, $internal) {
                if ($list['package_status'] == 2) {
                    $st = "<a class='btn btn-primary' href='" . RELA_DIR . 'admin/?component=company&action=checkNewCompany&id=' . $list['Company_id'] . "'>پرداخت نشده</a>";
                    $st .= "<br><a class='btn btn-warning' href='" . RELA_DIR . 'admin/?component=company&action=sendSMS&id=' . $list['Company_id'] . "'>ارسال پیامک</a>";
                    $st .= "<br><a class='btn btn-danger' href='" . RELA_DIR . 'admin/?component=company&action=delete&id=' . $list['Company_id'] . "'>حذف</a>";
                } else {
                    $st = "<a class='btn btn-info' href='" . RELA_DIR . 'admin/?component=company&action=checkNewCompany&id=' . $list['Company_id'] . "'>بررسی</a>";
                }

                return $st;
            },
        ];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);

        echo json_encode($export);
        die();
    }

    public function showCheckForm($fields)
    {
        $company_id = $fields['company_id'];

        //------> check New Company
        $newCompany = admincompanyModel::getBy_Company_id_and_new_register($company_id, '1')->getList();
        $companyType = $newCompany['export']['list']['0']['company_type'];

        //------> see Link of Old Free Company
        if ($companyType == 1) {
            $companyOld = admincompanyModel::getBy_national_id_and_status($newCompany['export']['list']['0']['national_id'], 1)->first();
        } elseif ($companyType == 2) {
            $companyOld = admincompanyModel::getAll()
                ->leftJoin('adminc_licencesModel', 'admincompanyModel.Company_id', '=', 'adminc_licencesModel.company_id')
                ->where('admincompanyModel.status', '=', '1')
                ->where('adminc_licencesModel.status', '=', '1')
                ->where('adminc_licencesModel.is_active', '=', '2')
                ->first();
        }

        if (is_object($companyOld)) {
            $export['string_link'] = RELA_DIR . 'company/Detail/' . $companyOld->Company_id;
        }

        if ($newCompany['export']['recordsCount'] == 0) {
            //------> check wiki
            $newCompany = admincompany_dModel::getBy_company_id_and_status_and_isActive($company_id, '-1', '1')->getList();
            $companyType = $newCompany['export']['list']['0']['company_type'];
            if ($newCompany['export']['recordsCount'] == 0) {
                $msg = $newCompany['msg'];
                redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
            }
        }

        //Get PackageUsage
        if ($newCompany['export']['list']['0']['package_status'] == 3) {
            $result = $this->getPackage($company_id);
            $export['packageUsage'] = $result['export']['list']['0']['category'];
        } else {
            $export['packageUsage'] = 1;
        }

        //------> Get Company Information
        $export['companyInfo'] = $newCompany['export']['list']['0'];
        $export['companyInfo']['registration_date'] = convertDate($export['companyInfo']['registration_date']);
        $companyCategory = tagToArray($newCompany['export']['list']['0']['category_id'])['export']['list'];
        $export['companyInfo']['category_id'] = $companyCategory['1'];

        //------> Get All Personality Type
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityType'] = $resultPersonalityType['export']['list'];
        }

        //------> Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax('all');
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        //------> Get company Phone Information
        $phoneResult = adminc_phones_dModel::getBy_company_id_and_isActive_and_status($company_id, '1', '-1')->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //------> Get company Phone Information
        $phoneResult = adminc_phones_dModel::getBy_company_id_and_isActive_and_status($company_id, '1', '-1')->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //------> Get company Email Information
        $emailResult = adminc_emails_dModel::getBy_company_id_and_isActive_and_status($company_id, '1', '-1')->getList();
        if ($emailResult['export']['recordsCount'] > 0) {
            $export['emailInfo'] = $emailResult['export']['list']['0'];
        }

        //------> Get company Website Information
        $websiteResult = adminc_websites_dModel::getBy_company_id_and_isActive_and_status($company_id, '1', '-1')->getList();
        if ($websiteResult['export']['recordsCount'] > 0) {
            $export['websiteInfo'] = $websiteResult['export']['list']['0'];
        }

        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive($company_id, '1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['licenceInfo']['issuence_date'] = convertDate($export['licenceInfo']['issuence_date']);
            $export['licenceInfo']['expiration_date'] = convertDate($export['licenceInfo']['expiration_date']);
        }

        //------> Get company Address Information
        $addressResult = adminc_addresses_dModel::getBy_company_id_and_isActive_and_status($company_id, '1', '-1')->getList();
        if ($addressResult['export']['recordsCount'] > 0) {
            $export['addressInfo'] = $addressResult['export']['list']['0'];
        }

        //------> Get PackageUsage
        include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageUsageObject = new adminPackageUsageController();
        $resultPackageUsage = $packageUsageObject->getPackageByCompanyID($company_id);

        //------> Get all City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //------> Get Editor Information
        $resultCompany_d = admincompany_dModel::getBy_company_id($company_id)->first();

        if (is_object($resultCompany_d)) {
            if ($resultCompany_d->package_status == '1') {
                $member = new adminEditorMemberController();
                $resultMember = $member->getMemberInformationById($resultCompany_d->Company_d_id);
                if (is_object($resultMember)) {
                    $export['editorInfo']['name'] = $resultMember->name;
                    $export['editorInfo']['family'] = $resultMember->family;
                    $export['editorInfo']['mobile'] = $resultMember->phone;
                    $export['editorInfo']['company_d_id'] = $resultMember->company_d_id;
                }
            } else {
                include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';
                $memberObject = new adminLoginController();
                $resultMember = $memberObject->getMember($resultCompany_d->company_id);
                $export['editorInfo']['name'] = $resultMember['name'];
                $export['editorInfo']['family'] = $resultMember['family'];
                $export['editorInfo']['mobile'] = $resultMember['mobile'];
            }
        }

        //------> Get all State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $state = new adminStateModel();
        $resultState = $state->getStates();
        if ($resultState['result'] == 1) {
            $export['states'] = $resultState['export']['list'];
        }

        //------> Get All PersonalityType
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityList'] = $resultPersonalityType['export']['list'];
        }

        //        //------> Get Company Phone
        //        include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.companyPhonesDraft.model.php';
        //        $phoneDraftObject = new adminc_phones_dModel();
        //        $resultPhone = $phoneDraftObject::getBy_company_id_and_status_and_isActive($resultCompany_d->company_id, -1, 1)->getList();
        //        if ($resultPersonalityType['result'] == 1) {
        //            $export['personalityList'] = $resultPersonalityType['export']['list'];
        //        }

        // ------------------------   Get company logo ----------------------------- //
        include_once ROOT_DIR . 'component/companyLogo/admin/model/admin.companyLogoDraft.model.php';
        $logo = adminc_logo_dModel::getBy_company_id_and_status_and_isActive($resultCompany_d->company_id, -1, 1)->getList();
        if ($logo['export']['recordsCount'] > 0) {
            $export['logo'] = $logo['export']['list'][0];
        }
        //------> Get all category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        if ($companyType == '1') {
            $this->fileName = 'admin.newCompanyLegal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقوقی';
        } else {
            $this->fileName = 'admin.newCompanyReal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقیقی';
        }

        $this->template($export, $msg);
        die();
    }

    public function check($fields, $file = [])
    {
        //فرم کمپانی های جدید به اینجا میرسه

        global $admin_info;
        $member = '';
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        ////////////////////////////////////

        $newCompanyObject = admincompanyModel::find($fields['company_id']);
        $newDraftCompanyObject = admincompany_dModel::getBy_company_id($fields['company_id'])->first();

        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی جدید یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        if ($newCompanyObject->package_status == '1') {
            $editorMember = new adminEditorMemberController();
            $member = $editorMember->getMemberInformationById($newDraftCompanyObject->Company_d_id, $newDraftCompanyObject->package_status);
        } else {
            $member = adminmembersModel::getBy_company_id($fields['company_id'])->getList();
            if ($member['export']['recordsCount'] <= 0) {
                $msg = 'خطا در عملیات!';
                redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
                die();
            }
        }

        if ($fields['process'] == 1) {
            // درحال بررسی
            $this->checking($fields, $file);
        } elseif ($fields['process'] == 2) {
            // تایید
            $this->acceptNewCompany($fields, $file);
            $msg = 'کمپانی شما با موفقیت ثبت شد.';
            //sendSMS($member->email, $msg);
        } elseif ($fields['process'] == 3) {
            // رد شده
            $this->rejectNewCompany($fields, $file);
            $msg = 'کمپانی شما مورد تایید قرار نگرفت .';
            //sendSMS($member->email, $msg);
        }

        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
    }

    // ------------------------------------Start Edit By Fardin --------------------------------------//
    public function uploadImage($fields)
    {
        $uploader = new Uploader();

        $property = ['image' => $fields['logoImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'logo'];

        $sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];

        return $uploader->cropAndCompressImage($property, $sizes);
    }

    public function addLogoToMainTable($fields)
    {
        $fields['title'] = '';
        $fields['description'] = '';
        $mainLogo = new adminc_logoModel();
        $mainLogo->setFields($fields);
        $result = $mainLogo->save();

        if ($result['result'] != 1) {
            return false;
        }

        return $mainLogo;
    }

    public function addLogoToDraftTable($fields, $mainLogo)
    {
        global $admin_info;
        $fields['logo_id'] = $mainLogo->Logo_id;
        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['isAdmin'] = 1;
        $fields['admin_description'] = '';
        $fields['status'] = 1;
        $fields['isActive'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['title'] = ''; // todo: to be fix
        $fields['description'] = ''; // todo: to be fix

        $draftLogo = new adminc_logo_dModel();
        $draftLogo->setFields($fields);
        $result = $draftLogo->save();

        if ($result['result'] != 1) {
            return false;
        }

        return $draftLogo;
    }

    public function editLogoInDraftTable($companyLogo, $mainLogo)
    {
        $companyLogo->isActive = 0;
        if (is_object($mainLogo)) {
            $companyLogo->logo_id = $mainLogo->Logo_id;
        }
        $companyLogo->status = 1;

        return $companyLogo->save();
    }

    public function disable($companyLogo)
    {
        $companyLogo->isActive = -1;

        return $companyLogo->save();
    }

    public function confirmLogo($fields)
    {
        $companyLogo = $draftLogos = adminc_logo_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], -1, 1)->first();
        if ($fields['remove_image'] == 'on') {
            if (is_object($companyLogo)) {
                $this->disable($companyLogo);
            }
        } elseif (($fields['logoImage'] != '') & ($fields['remove_image'] != 'on')) {
            $result = $this->uploadImage($fields);
            if ($result['result'] == -1 || $result == null) {
                $msg = $result['msg']['error'];
                redirectPage(RELA_DIR . 'admin/?component=company&action=checkNewCompany&id=' . $fields['company_id'], $msg);
            }

            $inputLogo['image'] = $result['image'];
            $inputLogo['company_id'] = $fields['company_id'];
            if (is_object($companyLogo)) {
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->editLogoInDraftTable($companyLogo, $mainLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            } else {
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            }
        } elseif (($fields['companyLogo']['name'] == '') & ($fields['remove_image'] != 'on')) {
            if (is_object($companyLogo)) {
                $inputLogo['image'] = $companyLogo->image;
                $inputLogo['company_id'] = $fields['company_id'];
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->editLogoInDraftTable($companyLogo, $mainLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            }
        }

        return;
    }

    // ------------------------------------End Edit By Fardin --------------------------------------//

    public function acceptNewCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = '';

        $this->confirmLogo($fields);

        //------> find newCompany
        $newCompanyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی جدید یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }
        $fields['package_status'] = $newCompanyObject->fields['package_status'];

        if (isset($fields['registration_date'])) {
            $fields['registration_date'] = convertJToGDate($fields['registration_date']);
        }

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($fields);
        $fields['parent_category_id'] = $result['parent_category_id'];
        $fields['category_id'] = $result['category_id'];

        //------> select Type of Company
        if ($newCompanyObject->fields['package_status'] == '1') {
            if ($newCompanyObject->fields['company_type'] == '1') {
                $this->acceptFreeLegalCompany($fields, $file);
            } else {
                $this->acceptFreeRealCompany($fields, $file);
            }

            $msg = "سلام ثبت نام شما در مرجع اطلاعات تولیدات تایید گردید.
شما می توانید جهت استفاده از سایر امکانات پروفایل خود و نمایش بهتر در موتورهای جستجو، یکی از پکیج های تجاری را خریداری نمایید.
با تشکر
www.tolidat.ir/c/{$fields['company_id']}";

            sendSMS($fields['editor_mobile'], $msg);
        } elseif ($newCompanyObject->fields['package_status'] == '3') {
            if ($newCompanyObject->fields['company_type'] == '1') {
                $this->acceptLegalCompany($fields, $file);
            } else {
                $this->acceptRealCompany($fields, $file);
            }

            $msg = "سلام، ثبت نام شما در مرجع اطلاعات تولیدات تایید گردید.
جهت کسب رتبه بالاتر و استفاده از امکانات SEO اطلاعات خود را در قسمت پروفایل پر نمایید.
با تشکر
www.tolidat.ir/c/{$fields['company_id']}";

            sendSMS($fields['editor_mobile'], $msg);
        } else {
            $msg = 'خطا در عملیات ! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        //------> Edit Field
        $companyObject = admincompanyModel::find($fields['company_id']);

        $licenceObject = c_licences::getAll()
            ->where('company_id', '=', $companyObject->Company_id)
            ->first();

        if (is_object($companyObject)) {
            if ($companyObject->company_type == '1' and is_object($licenceObject)) {
                $companyObject->edit = '0000000000000100000000000';
            } else {
                $companyObject->edit = '0000000000000000000000000';
            }

            if ($companyObject->package_id == '') {
                $companyObject->package_id = 0;
            }

            if ($companyObject->confirm_date == '') {
                $companyObject->confirm_date = date('Y-m-d H:i:s');
            }

            if ($companyObject->lock == '') {
                $companyObject->lock = 0;
            }

            if ($companyObject->priority == '') {
                $companyObject->priority = 0;
            }

            $companyObject->save();
            // dd(1);
            //-------------------------------------
            $companyObject->category()->detach();

            $categoryArray = tagToArray($companyObject->category_id)['export']['list'];
            $parentCategoryArray = tagToArray($companyObject->parent_category_id)['export']['list'];
            $mainArray = array_merge($categoryArray, $parentCategoryArray);
            $companyObject->category()->attach($mainArray);
            //-------------------------------------
        }

        calculateScoreCompany($fields['company_id']);

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
    }

    public function acceptFreeLegalCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> Delete Previous Company From Company Table
        $previousCompanyObject = admincompanyModel::getBy_national_id_and_status($fields['national_id'], 1)->first();
        if (is_object($previousCompanyObject)) {
            $companyId = $previousCompanyObject->Company_id;
            $previousCompanyObject->delete();
        }
        // dd($fields);

        //------> Edit Company Table For Accept New Company
        $newCompanyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($newCompanyObject)) {
            $newCompanyObject->setFields($fields);
            $newCompanyObject->editor_id = $editor_id;
            /* $newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];*/
            $newCompanyObject->isAdmin = 1;
            $newCompanyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->status = 1;
            $newCompanyObject->new_register = '0';
            $newCompanyObject->registration_number = convertToEnglish($fields['registration_number']);
            $newCompanyObject->national_id = convertToEnglish($fields['national_id']);
            $newCompanyObject->state_id = 0;
            $newCompanyObject->package_id = 0;
            $newCompanyObject->lock = ($newCompanyObject->lock == '') ? 0 : $newCompanyObject->lock;
            $newCompanyObject->save();
        }

        //------> Edit Company_d Table for previous Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id($companyId)->get();
        if (is_object($previousCompanyDraftObject)) {
            foreach ($previousCompanyDraftObject as $object) {
                $object->isActive = '0';
                $object->save();
            }
        }

        //------> Edit Company_d Table for New Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($newCompanyObject->Company_id, '-1', '1', '1')->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->editor_id = $editor_id;
            /*$previousCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $previousCompanyDraftObject->isAdmin = 1;
            $previousCompanyDraftObject->isActive = 0;
            $previousCompanyDraftObject->status = 1;
            $previousCompanyDraftObject->package_status = $packageStatus;
            $previousCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $previousCompanyDraftObject->priority = 1;
            $previousCompanyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        /*$newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyObject->registration_number = convertToEnglish($fields['registration_number']);
        $newCompanyObject->national_id = convertToEnglish($fields['national_id']);
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->register_date = $previousCompanyDraftObject->register_date ?? strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->state_id = 0;
        $newCompanyDraftObject->personality_type = $newCompanyDraftObject->personality_type != '' ? $newCompanyDraftObject->personality_type : 1;
        $newCompanyDraftObject->old_priority = 0;
        // dd($previousCompanyDraftObject);
        $newCompanyDraftObject->save();

        ////------> Phone
        //------> Delete previous Company from c_phones Table
        $previousPhoneObject = adminc_phonesModel::getBy_company_id($companyId)->first();
        if (is_object($previousPhoneObject)) {
            $previousPhoneObject->delete();
        }

        //------> Insert New Company in c_phones Table
        $newPhoneObject = new adminc_phonesModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = convertToEnglish($fields['phone']);
        $newPhoneObject->code = convertToEnglish($fields['code']);
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->branch_id = 0;
        $newPhoneObject->save();

        //------> Edit c_phones_d previousPhone Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id($companyId)->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Edit c_phones_d Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->editor_id = $editor_id;
            $previousPhoneDraftObject->phones_id = $newPhoneObject->Phones_id;
            $previousPhoneDraftObject->isAdmin = 1;
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->status = 1;

            $previousPhoneDraftObject->save();
        }

        // dd(1);

        //------> Insert in c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = convertToEnglish($fields['phone']);
        $newPhoneDraftObject->code = convertToEnglish($fields['code']);
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->phones_id = $newPhoneObject->Phones_id;
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 1;
        $newPhoneDraftObject->isAdmin = 1;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->branch_id = 0;
        $newPhoneDraftObject->admin_description = '';

        $newPhoneDraftObject->save();

        ////------> email
        //------> Delete previous Company from c_emails Table
        $previousEmailObject = adminc_emailsModel::getBy_company_id($companyId)->first();
        if (is_object($previousEmailObject)) {
            $previousEmailObject->delete();
        }

        //------> Insert New Company in c_email Table
        $newEmailObject = new adminc_emailsModel();
        $newEmailObject->editor_id = $editor_id;
        $newEmailObject->company_id = $fields['company_id'];
        $newEmailObject->email = $fields['email'];
        $newEmailObject->subject = 'مرکزی';
        $newEmailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailObject->status = 1;
        $newEmailObject->isMain = 1;
        $newEmailObject->branch_id = 0;

        $newEmailObject->save();

        //------> Edit c_emails_d Table
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->editor_id = $editor_id;
            $previousEmailDraftObject->emails_id = $newEmailObject->Emails_id;
            $previousEmailDraftObject->isAdmin = 1;
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->company_id = $fields['company_id'];
            $previousEmailDraftObject->save();
        }

        //------> Insert in c_emails_d Table
        $newEmailDraftObject = new adminc_emails_dModel();
        $newEmailDraftObject->editor_id = $editor_id;

        $newEmailDraftObject->email = $fields['email'];
        $newEmailDraftObject->company_id = $fields['company_id'];
        $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newEmailDraftObject->subject = 'مرکزی';
        $newEmailDraftObject->emails_id = $newEmailObject->Emails_id;
        $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailDraftObject->status = 1;
        $newEmailDraftObject->isAdmin = 1;
        $newEmailDraftObject->isActive = 1;
        $newEmailDraftObject->isMain = 1;
        $newEmailDraftObject->branch_id = 0;
        $newEmailDraftObject->admin_description = '';
        $newEmailDraftObject->save();

        ////------> website
        //------> Delete previous Company from c_websites Table
        $previousWebsiteObject = adminc_websitesModel::getBy_company_id($companyId)->first();
        if (is_object($previousWebsiteObject)) {
            $previousWebsiteObject->delete();
        }

        //------> Insert New Company in c_website Table
        $newWebsiteObject = new adminc_websitesModel();
        $newWebsiteObject->editor_id = $editor_id;
        $newWebsiteObject->company_id = $fields['company_id'];
        $newWebsiteObject->url = $fields['url'];
        $newWebsiteObject->subject = 'مرکزی';
        $newWebsiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteObject->status = 1;
        $newWebsiteObject->isMain = 1;
        $newWebsiteObject->branch_id = 0;
        $newWebsiteObject->save();

        //------> Edit c_websites_d Table
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->editor_id = $editor_id;
            $previousWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
            $previousWebsiteDraftObject->isAdmin = 1;
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->status = 1;
            $previousWebsiteDraftObject->save();
        }

        //------> Insert in c_websites_d Table
        $newWebsiteDraftObject = new adminc_websites_dModel();
        $newWebsiteDraftObject->editor_id = $editor_id;
        $newWebsiteDraftObject->url = $fields['url'];
        $newWebsiteDraftObject->company_id = $fields['company_id'];
        $newWebsiteDraftObject->subject = 'مرکزی';
        $newWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
        $newWebsiteDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newWebsiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteDraftObject->status = 1;
        $newWebsiteDraftObject->isAdmin = 1;
        $newWebsiteDraftObject->isActive = 1;
        $newWebsiteDraftObject->isMain = 1;
        $newWebsiteDraftObject->branch_id = 0;
        $newWebsiteDraftObject->save();

        ////------> Address
        //------> Delete previous Address from c_addresses Table
        $previousAddressObject = adminc_addressesModel::getBy_company_id($companyId)->first();
        if (is_object($previousAddressObject)) {
            $previousAddressObject->delete();
        }

        //------> Insert New address in c_addresses Table
        $newAddressObject = new adminc_addressesModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->branch_id = 0;
        $newAddressObject->save();

        //------> Edit c_addresses_d Table previous address
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id_and_isActive($companyId, '1')->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->save();
        }

        //------> Edit c_addresses_d Table
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->editor_id = $editor_id;
            $previousAddressDraftObject->addresses_id = $newAddressObject->Addresses_id;
            $previousAddressDraftObject->isAdmin = 1;
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->status = 1;
            $previousAddressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = $newAddressObject->Addresses_id;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 1;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->branch_id = 0;
        $newAddressDraftObject->admin_description = '';
        $newAddressDraftObject->save();

        $companyLogo = $draftLogos = adminc_logo_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], -1, 1)->first();
        if ($fields['remove_image'] == 'on') {
            if (is_object($companyLogo)) {
                $this->disable($companyLogo);
            }
        } elseif (($fields['logoImage'] != '') & ($fields['remove_image'] != 'on')) {
            $result = $this->uploadImage($fields);
            if ($result['result'] == -1 || $result == null) {
                $msg = $result['msg']['error'];
                redirectPage(RELA_DIR . 'admin/?component=company&action=checkNewCompany&id=' . $fields['company_id'], $msg);
            }

            $inputLogo['image'] = $result['image'];
            $inputLogo['company_id'] = $fields['company_id'];
            if (is_object($companyLogo)) {
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->editLogoInDraftTable($companyLogo, $mainLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            } else {
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            }
        } elseif (($fields['companyLogo']['name'] == '') & ($fields['remove_image'] != 'on')) {
            if (is_object($companyLogo)) {
                $inputLogo['image'] = $companyLogo->image;
                $inputLogo['company_id'] = $fields['company_id'];
                $mainLogo = $this->addLogoToMainTable($inputLogo);
                $this->editLogoInDraftTable($companyLogo, $mainLogo);
                $this->addLogoToDraftTable($inputLogo, $mainLogo);
            }
        }

        //------> add memeber
        $memberObject = adminEditorMemberModel::getBy_company_d_id($previousCompanyDraftObject->Company_d_id)->first();
        if (!is_object($memberObject)) {
            $memberObject = new adminEditorMemberModel();
        }
        $memberObject->name = $fields['editor_name'];
        $memberObject->family = $fields['editor_family'];
        $memberObject->phone = $fields['editor_mobile'];
        $memberObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $memberObject->company_id = ($memberObject->company_id == '') ? $newCompanyObject->Company_id : $memberObject->company_id;
        $memberObject->save();

        return;
    }

    public function acceptFreeRealCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> Delete Previous Company From Company Table
        $licenceObject = adminc_licencesModel::getBy_licence_type_and_licence_number_and_status_and_isActive($fields['licence_type'], $fields['licence_number'], '1', '1')->first();
        if (is_object($licenceObject)) {
            $previousCompanyId = $licenceObject->company_id;
            $licenceObject->delete();
        }

        //------> Delete Previous Company from company Table
        $previousCompanyObject = admincompanyModel::getBy_Company_id($previousCompanyId)->first();
        if (is_object($previousCompanyObject)) {
            $previousCompanyObject->delete();
        }

        //------> Edit Previous Company from company Table
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($companyObject)) {
            if ($companyObject->package_id == '') {
                $companyObject->package_id = 0;
            }
            $companyObject->isActive = '0';
            $companyObject->confirm_date = $companyObject->confirm_date == '' ? date('Y-m-d H:i:s') : $companyObject->confirm_date;
            $companyObject->lock = ($companyObject->lock == '') ? 0 : $companyObject->lock;
            $companyObject->save();
        }

        //------> Edit Company Table For Accept New Company
        $newCompanyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($newCompanyObject)) {
            $newCompanyObject->setFields($fields);
            $newCompanyObject->editor_id = $editor_id;
            /* $newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];*/
            $newCompanyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->isAdmin = 1;
            $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->status = 1;
            $newCompanyObject->new_register = '0';

            if (substr_count($newCompanyObject->registration_date, '-' == 4)) {
                $newCompanyObject->registration_date = date('Y-m-d H:i:s');
            }
            $newCompanyObject->registration_date = $newCompanyObject->registration_date != '' ? $newCompanyObject->registration_date : date('Y-m-d H:i:s');

            $newCompanyObject->save();
        }

        //------> Edit Company_d Table for previous Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id($previousCompanyId)->get();
        if (is_object($previousCompanyDraftObject)) {
            foreach ($previousCompanyDraftObject as $object) {
                $object->isActive = '0';
                $object->save();
            }
        }

        //------> Edit Company_d Table for New Company
        $companyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($companyDraftObject)) {
            $companyDraftObject->editor_id = $editor_id;
            /* $companyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $companyDraftObject->isAdmin = 1;
            $companyDraftObject->isActive = 0;
            $companyDraftObject->status = 1;
            $companyDraftObject->package_status = $packageStatus;
            $companyDraftObject->registration_date = date('Y-m-d H:i:s');
            $companyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyDraftObject->priority = isset($companyDraftObject->priority) ? $companyDraftObject->priority : 1;
            $companyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        /*  $newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->registration_date = date('Y-m-d H:i:s'); //$companyDraftObject->register_date;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->old_priority = 0;
        $newCompanyDraftObject->save();

        ////------> Phone
        //------> Delete previous Company from c_phones Table
        $previousPhoneObject = adminc_phonesModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousPhoneObject)) {
            $previousPhoneObject->delete();
        }

        //------> Insert New Company in c_phones Table
        $newPhoneObject = new adminc_phonesModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = convertToEnglish($fields['phone']);
        $newPhoneObject->code = convertToEnglish($fields['code']);
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->branch_id = $newPhoneObject->branch_id == '' ? 0 : $newPhoneObject->branch_id;
        $newPhoneObject->save();

        //------> Edit c_phones_d previousPhone Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Edit c_phones_d Table
        $phoneDraftObject = adminc_phones_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($phoneDraftObject)) {
            $phoneDraftObject->editor_id = $editor_id;
            $phoneDraftObject->phones_id = $newPhoneObject->Phones_id;
            $phoneDraftObject->isAdmin = 1;
            $phoneDraftObject->isActive = 0;
            $phoneDraftObject->status = 1;
            $phoneDraftObject->save();
        }

        //------> Insert in c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = convertToEnglish($fields['phone']);
        $newPhoneDraftObject->code = convertToEnglish($fields['code']);
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->phones_id = $newPhoneObject->Phones_id;
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 1;
        $newPhoneDraftObject->isAdmin = 1;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->branch_id = $newPhoneDraftObject->branch_id == '' ? 0 : $newPhoneDraftObject->branch_id;
        $newPhoneDraftObject->admin_description = $newPhoneDraftObject->admin_description == '' ? '' : $newPhoneDraftObject->admin_description;

        $newPhoneDraftObject->save();

        ////------> email
        //------> Delete previous Company from c_emails Table
        $previousEmailObject = adminc_emailsModel::getBy_company_id($companyId)->first();
        if (is_object($previousEmailObject)) {
            $previousEmailObject->delete();
        }

        //------> Insert New Company in c_email Table
        $newEmailObject = new adminc_emailsModel();
        $newEmailObject->editor_id = $editor_id;
        $newEmailObject->company_id = $fields['company_id'];
        $newEmailObject->email = $fields['email'];
        $newEmailObject->subject = 'مرکزی';
        $newEmailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailObject->status = 1;
        $newEmailObject->isMain = 1;
        $newEmailObject->branch_id = $newEmailObject->branch_id == '' ? 0 : $newEmailObject->branch_id;

        $newEmailObject->save();

        //------> Edit c_emails_d previousEmail Table
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id($companyId)->first();
        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->save();
        }

        //------> Edit c_emails_d Table
        // $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first(); // marjani

        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->editor_id = $editor_id;
            // $previousEmailDraftObject->emails_id = $newPhoneObject->Emails_id;
            $previousEmailDraftObject->emails_id = $newPhoneObject->Emails_id == '' ? 0 : $newPhoneObject->Emails_id; // marjani
            $previousEmailDraftObject->isAdmin = 1;
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->save();
        }

        //------> Insert in c_emails_d Table
        $newEmailDraftObject = new adminc_emails_dModel();
        $newEmailDraftObject->editor_id = $editor_id;
        $newEmailDraftObject->email = $fields['email'];
        $newEmailDraftObject->company_id = $fields['company_id'];
        $newEmailDraftObject->subject = 'مرکزی';
        $newEmailDraftObject->emails_id = $newEmailObject->Emails_id;
        $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailDraftObject->status = 1;
        $newEmailDraftObject->isAdmin = 1;
        $newEmailDraftObject->isActive = 1;
        $newEmailDraftObject->isMain = 1;
        $newEmailDraftObject->company_d_id = $fields['company_id']; // marjani
        $newEmailDraftObject->branch_id = $newEmailDraftObject->branch_id == '' ? 0 : $newEmailDraftObject->branch_id; // marjani
        $newEmailDraftObject->admin_description = $newEmailDraftObject->admin_description == '' ? '' : $newEmailDraftObject->admin_description;
        $newEmailDraftObject->save();

        ////------> Logo Process
        $mainLogo = adminc_logoModel::getBy_company_id($fields['company_id'])->first();
        $draftLogo = adminc_logo_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], 1, 1)->first(); // marjani

        if (isset($fields['remove_Logo']) or $fields['remove_Logo'] == 'on') {
            //------> Remove Main Logo
            if (is_object($mainLogo)) {
                $mainLogo->delete();
            }

            //------> Disable Draft Logo
            if (is_object($draftLogo)) {
                $draftLogo->isActive = 0;
                $draftLogo->save();
            }
        } else {
            if (trim($fields['logoImage']) != '') {
                $uploader = new Uploader();
                $property = ['image' => $fields['logoImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'logo'];
                $sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];
                $result = $uploader->cropAndCompressImage($property, $sizes);
                $imageLogo = $result['image'];

                //---->Save Logo in Logo Table
                if (!is_object($mainLogo)) {
                    $mainLogo = new adminc_logoModel();
                }

                $mainLogo->image = $imageLogo;
                $mainLogo->company_id = $fields['company_id'];
                $mainLogo->status = 1;
                $mainLogo->isActive = 1;
                $mainLogo->editor = $editor_id;
                $mainLogo->isAdmin = 1;
                $mainLogo->save();

                //------> Edit Draft Logo
                if (is_object($draftLogo)) {
                    $draftLogo->status = 1;
                    $draftLogo->isActive = 0;
                    $draftLogo->save();
                }

                //------> Add new Draft Logo
                $newDraftLogoObject = new adminc_logo_dModel();
                $newDraftLogoObject->image = $imageLogo;
                $newDraftLogoObject->company_id = $fields['company_id'];
                $newDraftLogoObject->status = 1;
                $newDraftLogoObject->isActive = 1;
                $newDraftLogoObject->editor = $editor_id;
                $newDraftLogoObject->isAdmin = 1;
                $newDraftLogoObject->logo_id = $newDraftLogoObject->logo_id == '' ? 0 : $newDraftLogoObject->logo_id;
                $newDraftLogoObject->save();
            }
        }

        ////------> website
        //------> Delete previous Company from c_websites Table
        $previousWebsiteObject = adminc_websitesModel::getBy_company_id($companyId)->first();
        if (is_object($previousWebsiteObject)) {
            $previousWebsiteObject->delete();
        }

        //------> Insert New Company in c_website Table
        $newWebsiteObject = new adminc_websitesModel();
        $newWebsiteObject->editor_id = $editor_id;
        $newWebsiteObject->company_id = $fields['company_id'];
        $newWebsiteObject->url = $fields['url'];
        $newWebsiteObject->subject = 'مرکزی';
        $newWebsiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteObject->status = 1;
        $newWebsiteObject->isMain = 1;
        $newWebsiteObject->branch_id = $newWebsiteObject->branch_id == '' ? 0 : $newWebsiteObject->branch_id; // marjani

        $newWebsiteObject->save();

        //------> Edit c_websites_d previousEmail Table
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id($companyId)->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->save();
        }

        //------> Edit c_websites_d Table
        // $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->editor_id = $editor_id;
            $previousWebsiteDraftObject->emails_id = $newWebsiteObject->Websites_id;
            $previousWebsiteDraftObject->isAdmin = 1;
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->status = 1;
            $previousWebsiteDraftObject->save();
        }

        //------> Insert in c_websites_d Table
        $newWebsiteDraftObject = new adminc_websites_dModel();
        $newWebsiteDraftObject->editor_id = $editor_id;
        $newWebsiteDraftObject->url = $fields['url'];
        $newWebsiteDraftObject->company_id = $fields['company_id'];
        $newWebsiteDraftObject->company_d_id = $newWebsiteDraftObject->company_d_id == '' ? $fields['company_id'] : $newWebsiteDraftObject->company_d_id;
        $newWebsiteDraftObject->subject = 'مرکزی';
        $newWebsiteDraftObject->websites_id = $newEmailObject->Websites_id == '' ? 0 : $newEmailObject->Websites_id;
        $newWebsiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteDraftObject->status = 1;
        $newWebsiteDraftObject->isAdmin = 1;
        $newWebsiteDraftObject->isActive = 1;
        $newWebsiteDraftObject->isMain = 1;
        $newWebsiteDraftObject->isMain = 1;
        $newWebsiteDraftObject->branch_id = $newWebsiteDraftObject->branch_id == '' ? 0 : $newWebsiteDraftObject->branch_id; // marjani

        $newWebsiteDraftObject->save();

        ////------> Address
        //------> Delete previous Address from c_addresses Table
        $previousAddressObject = adminc_addressesModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousAddressObject)) {
            $previousAddressObject->delete();
        }

        //------> Insert New address in c_addresses Table
        $newAddressObject = new adminc_addressesModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->branch_id = $newAddressObject->branch_id == '' ? 0 : $newAddressObject->branch_id; // marjani

        $newAddressObject->save();

        //------> Edit c_addresses_d Table previous address
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->save();
        }

        //------> Edit c_addresses_d Table
        $addressDraftObject = adminc_addresses_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($addressDraftObject)) {
            $addressDraftObject->editor_id = $editor_id;
            $addressDraftObject->addresses_id = $newAddressObject->Addresses_id;
            $addressDraftObject->isAdmin = 1;
            $addressDraftObject->isActive = 0;
            $addressDraftObject->status = 1;
            $addressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = $newAddressObject->Addresses_id;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 1;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->branch_id = $newAddressDraftObject->branch_id == '' ? 0 : $newAddressDraftObject->branch_id; // marjani
        $newAddressDraftObject->admin_description = $newAddressDraftObject->admin_description == '' ? '' : $newAddressDraftObject->admin_description;

        $newAddressDraftObject->save();

        //------> Edit Previous Licence
        $previousLicenceObject = adminc_licencesModel::getBy_company_id($companyId)->first();
        if (is_object($previousLicenceObject)) {
            $previousLicenceObject->status = 1;
            $previousLicenceObject->isActive = 0;
            $previousLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 1;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 1;
                $LicenceObject->isActive = 0;
                $LicenceObject->isMain = 1;
                $LicenceObject->save();
            }

            if (trim($fields['licenceImage']) == '') {
                $imageName = $LicenceObject->image;
            } else {
                $uploader = new Uploader();
                $result = $uploader->cropAndCompressImage(['image' => $fields['licenceImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'licence']);
                $imageName = $result['image'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = $LicenceObject->parent_id;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = $imageName;
            $newLicenceObject->issuence_date = convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 2;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = 1;
            $newLicenceObject->admin_description = $newLicenceObject->admin_description == '' ? '' : $newLicenceObject->admin_description;
            $newLicenceObject->parent_id = $newLicenceObject->parent_id == '' ? 0 : $newLicenceObject->parent_id;

            $newLicenceObject->save();
        }

        //------> add memeber
        $memberObject = adminEditorMemberModel::getBy_company_d_id($previousCompanyDraftObject->Company_d_id)->first();
        if (!is_object($memberObject)) {
            $memberObject = new adminEditorMemberModel();
        }
        $memberObject->name = $fields['editor_name'];
        $memberObject->family = $fields['editor_family'];
        $memberObject->phone = $fields['editor_mobile'];
        $memberObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $memberObject->company_id = $memberObject->company_id == '' ? $newCompanyDraftObject->Company_d_id : $memberObject->company_id;
        $memberObject->save();

        return;
    }

    public function acceptLegalCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> Edit Company Table For Accept New Company
        $newCompanyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        $this->deleteAfterAccept($newCompanyObject);

        if (is_object($newCompanyObject)) {
            $fields['registration_date'] = convertJToGDate($fields['registration_date']);
            $newCompanyObject->setFields($fields);
            $newCompanyObject->editor_id = $editor_id; /*
             $newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];*/
            $newCompanyObject->isAdmin = 1;
            $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->registration_number = convertToEnglish($fields['registration_number']);
            $newCompanyObject->national_id = convertToEnglish($fields['national_id']);
            $newCompanyObject->status = 1;
            $newCompanyObject->package_status = 4;
            $newCompanyObject->new_register = '0';
            $newCompanyObject->save();
        }

        //------> Edit Company_d Table for New Company
        $companyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($companyDraftObject)) {
            $companyDraftObject->registration_date = convertJToGDate($companyDraftObject->registration_date);

            $companyDraftObject->editor_id = $editor_id;
            /* $companyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $companyDraftObject->isAdmin = 1;
            $companyDraftObject->isActive = 0;
            $companyDraftObject->status = 1;
            $companyDraftObject->package_status = $packageStatus;
            $companyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        /* $newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->register_date = $companyDraftObject->register_date;
        $newCompanyDraftObject->package_status = 4;
        $newCompanyDraftObject->registration_number = convertToEnglish($fields['registration_number']);
        $newCompanyDraftObject->national_id = convertToEnglish($fields['national_id']);
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->save();

        //------> Insert New Company in c_phones Table
        $newPhoneObject = new adminc_phonesModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = convertToEnglish($fields['phone']);
        $newPhoneObject->code = convertToEnglish($fields['code']);
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->save();

        //------> Edit c_phones_d Table
        $phoneDraftObject = adminc_phones_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($phoneDraftObject)) {
            $phoneDraftObject->editor_id = $editor_id;
            $phoneDraftObject->phones_id = $newPhoneObject->Phones_id;
            $phoneDraftObject->isAdmin = 1;
            $phoneDraftObject->isActive = 0;
            $phoneDraftObject->status = 1;
            $phoneDraftObject->save();
        }

        //------> Insert in c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = convertToEnglish($fields['phone']);
        $newPhoneDraftObject->code = convertToEnglish($fields['code']);
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->phones_id = $newPhoneObject->Phones_id;
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 1;
        $newPhoneDraftObject->isAdmin = 1;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->save();

        ////------> email
        //------> Insert New Company in c_email Table
        $newEmailObject = new adminc_emailsModel();
        $newEmailObject->editor_id = $editor_id;
        $newEmailObject->company_id = $fields['company_id'];
        $newEmailObject->email = $fields['email'];
        $newEmailObject->subject = 'مرکزی';
        $newEmailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailObject->status = 1;
        $newEmailObject->isMain = 1;
        $newEmailObject->save();

        //------> Edit c_emails_d Table
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        //        print_r_debug($previousEmailDraftObject);
        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->editor_id = $editor_id;
            $previousEmailDraftObject->emails_id = $newPhoneObject->Emails_id;
            $previousEmailDraftObject->isAdmin = 1;
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->save();
        }

        //------> Insert in c_emails_d Table
        $newEmailDraftObject = new adminc_emails_dModel();
        $newEmailDraftObject->editor_id = $editor_id;
        $newEmailDraftObject->email = $fields['email'];
        $newEmailDraftObject->company_id = $fields['company_id'];
        $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newEmailDraftObject->subject = 'مرکزی';
        $newEmailDraftObject->emails_id = $newEmailObject->Emails_id;
        $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailDraftObject->status = 1;
        $newEmailDraftObject->isAdmin = 1;
        $newEmailDraftObject->isActive = 1;
        $newEmailDraftObject->isMain = 1;
        $newEmailDraftObject->save();

        ////------> website
        //------> Insert New Company in c_website Table
        $newWebsiteObject = new adminc_websitesModel();
        $newWebsiteObject->editor_id = $editor_id;
        $newWebsiteObject->company_id = $fields['company_id'];
        $newWebsiteObject->url = $fields['url'];
        $newWebsiteObject->subject = 'مرکزی';
        $newWebsiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteObject->status = 1;
        $newWebsiteObject->isMain = 1;
        $newWebsiteObject->save();

        //------> Edit c_websites_d Table
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->editor_id = $editor_id;
            $previousWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
            $previousWebsiteDraftObject->isAdmin = 1;
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->status = 1;
            $previousWebsiteDraftObject->save();
        }

        //------> Insert in c_websites_d Table
        $newWebsiteDraftObject = new adminc_websites_dModel();
        $newWebsiteDraftObject->editor_id = $editor_id;
        $newWebsiteDraftObject->url = $fields['url'];
        $newWebsiteDraftObject->company_id = $fields['company_id'];
        $newWebsiteDraftObject->subject = 'مرکزی';
        $newWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
        $newWebsiteDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newWebsiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteDraftObject->status = 1;
        $newWebsiteDraftObject->isAdmin = 1;
        $newWebsiteDraftObject->isActive = 1;
        $newWebsiteDraftObject->isMain = 1;
        $newWebsiteDraftObject->save();

        //------> Address
        //------> Insert New address in c_addresses Table
        $newAddressObject = new adminc_addressesModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->save();

        //------> Edit c_addresses_d Table
        $addressDraftObject = adminc_addresses_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($addressDraftObject)) {
            $addressDraftObject->editor_id = $editor_id;
            $addressDraftObject->addresses_id = $newAddressObject->Addresses_id;
            $addressDraftObject->isAdmin = 1;
            $addressDraftObject->isActive = 0;
            $addressDraftObject->status = 1;
            $addressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = $newAddressObject->Addresses_id;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 1;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->save();

        $invoiceObject = adminonline_paymentModel::getBy_company_id($newAddressDraftObject->company_id)->first();
        if (is_object($invoiceObject)) {
            $invoice = new adminOnlinePaymentController();
            $resultInvoice = $invoice->invoiceAssignForm($invoiceObject->Invoice_id);
        }

        calculateScoreCompany($newCompanyObject->Company_id);
    }

    public function acceptRealCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> Delete Previous Company From Company Table
        $licenceObject = adminc_licencesModel::getBy_licence_type_and_licence_number_and_status_and_isActive($fields['licence_type'], $fields['licence_number'], '1', '1')->first();
        if (is_object($licenceObject)) {
            $previousCompanyId = $licenceObject->company_id;
            $licenceObject->delete();
        }

        //------> Delete Previous Company from company Table
        $previousCompanyObject = admincompanyModel::getBy_Company_id($previousCompanyId)->first();
        if (is_object($previousCompanyObject)) {
            $previousCompanyObject->delete();
        }

        //------> Edit Previous Company from company Table
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        $this->deleteAfterAccept($companyObject);
        if (is_object($companyObject)) {
            $companyObject->isActive = '0';
            $companyObject->save();
        }

        //------> Edit Company Table For Accept New Company
        $newCompanyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($newCompanyObject)) {
            $newCompanyObject->setFields($fields);
            $newCompanyObject->editor_id = $editor_id;
            /*$newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];*/
            $newCompanyObject->isAdmin = 1;
            $newCompanyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newCompanyObject->status = 1;
            $newCompanyObject->new_register = '0';
            $newCompanyObject->package_status = 4;
            $newCompanyObject->save();
        }

        //------> Edit Company_d Table for previous Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id($previousCompanyId)->get();
        if (is_object($previousCompanyDraftObject)) {
            foreach ($previousCompanyDraftObject as $object) {
                $object->isActive = '0';
                $object->save();
            }
        }

        //------> Edit Company_d Table for New Company
        $companyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($companyDraftObject)) {
            $companyDraftObject->editor_id = $editor_id;
            /*$companyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $companyDraftObject->isAdmin = 1;
            $companyDraftObject->isActive = 0;
            $companyDraftObject->status = 1;
            $companyDraftObject->package_status = $packageStatus;
            $companyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        /*$newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->register_date = $companyDraftObject->register_date;
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->package_status = 4;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->save();

        ////------> Phone
        //------> Delete previous Company from c_phones Table
        $previousPhoneObject = adminc_phonesModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousPhoneObject)) {
            $previousPhoneObject->delete();
        }

        //------> Insert New Company in c_phones Table
        $newPhoneObject = new adminc_phonesModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = convertToEnglish($fields['phone']);
        $newPhoneObject->code = convertToEnglish($fields['code']);
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->save();

        //------> Edit c_phones_d previousPhone Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Edit c_phones_d Table
        $phoneDraftObject = adminc_phones_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($phoneDraftObject)) {
            $phoneDraftObject->editor_id = $editor_id;
            $phoneDraftObject->phones_id = $newPhoneObject->Phones_id;
            $phoneDraftObject->isAdmin = 1;
            $phoneDraftObject->isActive = 0;
            $phoneDraftObject->status = 1;
            $phoneDraftObject->save();
        }

        //------> Insert in c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = convertToEnglish($fields['phone']);
        $newPhoneDraftObject->code = convertToEnglish($fields['code']);
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->phones_id = $newPhoneObject->Phones_id;
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 1;
        $newPhoneDraftObject->isAdmin = 1;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->save();

        ////------> Address
        //------> Delete previous Address from c_addresses Table
        $previousAddressObject = adminc_addressesModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousAddressObject)) {
            $previousAddressObject->delete();
        }

        //------> Insert New address in c_addresses Table
        $newAddressObject = new adminc_addressesModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->save();

        //------> Edit c_addresses_d Table previous address
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id($previousCompanyId)->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->save();
        }

        //------> Edit c_addresses_d Table
        $addressDraftObject = adminc_addresses_dModel::getBy_company_id_and_status_and_isActive_and_isMain($fields['company_id'], '-1', '1', '1')->first();
        if (is_object($addressDraftObject)) {
            $addressDraftObject->editor_id = $editor_id;
            $addressDraftObject->addresses_id = $newAddressObject->Addresses_id;
            $addressDraftObject->isAdmin = 1;
            $addressDraftObject->isActive = 0;
            $addressDraftObject->status = 1;
            $addressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = $newAddressObject->Addresses_id;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 1;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->save();

        ////------> email
        //------> Insert New Company in c_email Table
        $newEmailObject = new adminc_emailsModel();
        $newEmailObject->editor_id = $editor_id;
        $newEmailObject->company_id = $fields['company_id'];
        $newEmailObject->email = $fields['email'];
        $newEmailObject->subject = 'مرکزی';
        $newEmailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailObject->status = 1;
        $newEmailObject->isMain = 1;
        $newEmailObject->save();

        //------> Edit c_emails_d Table
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        //        print_r_debug($previousEmailDraftObject);
        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->editor_id = $editor_id;
            $previousEmailDraftObject->emails_id = $newPhoneObject->Emails_id;
            $previousEmailDraftObject->isAdmin = 1;
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->save();
        }

        //------> Insert in c_emails_d Table
        $newEmailDraftObject = new adminc_emails_dModel();
        $newEmailDraftObject->editor_id = $editor_id;
        $newEmailDraftObject->email = $fields['email'];
        $newEmailDraftObject->company_id = $fields['company_id'];
        $newEmailDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newEmailDraftObject->subject = 'مرکزی';
        $newEmailDraftObject->emails_id = $newEmailObject->Emails_id;
        $newEmailDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailDraftObject->status = 1;
        $newEmailDraftObject->isAdmin = 1;
        $newEmailDraftObject->isActive = 1;
        $newEmailDraftObject->isMain = 1;
        $newEmailDraftObject->save();

        ////------> website
        //------> Insert New Company in c_website Table
        $newWebsiteObject = new adminc_websitesModel();
        $newWebsiteObject->editor_id = $editor_id;
        $newWebsiteObject->company_id = $fields['company_id'];
        $newWebsiteObject->url = $fields['url'];
        $newWebsiteObject->subject = 'مرکزی';
        $newWebsiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteObject->status = 1;
        $newWebsiteObject->isMain = 1;
        $newWebsiteObject->save();

        //------> Edit c_websites_d Table
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '-1', '1')->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->editor_id = $editor_id;
            $previousWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
            $previousWebsiteDraftObject->isAdmin = 1;
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->status = 1;
            $previousWebsiteDraftObject->save();
        }

        //------> Insert in c_websites_d Table
        $newWebsiteDraftObject = new adminc_websites_dModel();
        $newWebsiteDraftObject->editor_id = $editor_id;
        $newWebsiteDraftObject->url = $fields['url'];
        $newWebsiteDraftObject->company_id = $fields['company_id'];
        $newWebsiteDraftObject->subject = 'مرکزی';
        $newWebsiteDraftObject->websites_id = $newWebsiteObject->Websites_id;
        $newWebsiteDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newWebsiteDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteDraftObject->status = 1;
        $newWebsiteDraftObject->isAdmin = 1;
        $newWebsiteDraftObject->isActive = 1;
        $newWebsiteDraftObject->isMain = 1;
        $newWebsiteDraftObject->save();

        //------> Edit Previous Licence
        $previousLicenceObject = adminc_licencesModel::getBy_company_id($companyId)->first();
        if (is_object($previousLicenceObject)) {
            $previousLicenceObject->status = 1;
            $previousLicenceObject->isActive = 0;
            $previousLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 1;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 1;
                $LicenceObject->isActive = 0;
                $LicenceObject->isMain = 1;
                $LicenceObject->save();
            }

            //---->Add to logo
            if (!empty($input['licenceImage'])) {
                $uploader = new Uploader();
                $property = ['image' => $input['licenceImage'], 'company_id' => $input['company_id'], 'folder_name' => 'licence'];
                //$sizes = ['size1' => ['width' => '122', 'height' => '125'], 'size2' => ['width' => '140', 'height' => '140'], 'size3' => ['width' => '150', 'height' => '150']];
                // $result = $uploader->cropAndCompressImage($property, $sizes);

                $result = $uploader->cropAndCompressImage($property);
                $licenceImage = $result['image'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = $LicenceObject->parent_id;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = $licenceImage;
            $newLicenceObject->issuence_date = convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 2;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = 1;
            $newLicenceObject->save();
        }

        $invoiceObject = adminonline_paymentModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($invoiceObject)) {
            $invoice = new adminOnlinePaymentController();
            $resultInvoice = $invoice->invoiceAssignForm($invoiceObject->Invoice_id);
        }

        calculateScoreCompany($newCompanyObject->Company_id);
    }

    public function rejectNewCompany($fields)
    {
        if (($fields['package_status'] == '3') & ($fields['package_status'] == '4')) {
            $this->check($fields);
        }

        //------> Delete Record of company Table
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($companyObject)) {
            $companyObject->delete();
        }

        //------> Delete Record of company_d Table
        $companyDraftObject = admincompany_dModel::getBy_company_id($fields['company_id'])->get();
        if ($companyDraftObject['export']['recordsCount'] > 0) {
            foreach ($companyDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_phones_d Table
        $phonesDraftObject = adminc_phones_dModel::getBy_company_id($fields['company_id'])->get();
        if ($phonesDraftObject['export']['recordsCount'] > 0) {
            foreach ($phonesDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_addresses_d Table
        $addressesDraftObject = adminc_addresses_dModel::getBy_company_id($fields['company_id'])->get();
        if ($addressesDraftObject['export']['recordsCount'] > 0) {
            foreach ($addressesDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_addresses_d Table
        $licencesObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->get();
        if ($licencesObject['export']['recordsCount'] > 0) {
            foreach ($licencesObject['export']['list'] as $key => $value) {
                fileRemover(COMPANY_ADDRESS_ROOT . $value->company_id . '/licence/', $value->image);
                $value->delete();
            }
        }
    }

    // در لیست کمپانی جدید اگه در حال بررسی رو بزنید
    public function checking($fields, $file = [])
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];

        //------> find newCompany
        $newCompanyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی جدید یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        //------> Edit company Table
        if (isset($fields['registration_date'])) {
            $fields['registration_date'] = convertJToGDate($fields['registration_date']);
        }
        $newCompanyObject->setFields($fields);
        /* $newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyObject->editor_id = $editor_id;
        $newCompanyObject->isAdmin = 1;
        $newCompanyObject->isActive = 1;
        $newCompanyObject->status = 0;
        $newCompanyObject->new_register = '1';
        $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyObject->save();

        //------> Edit previous company in company_d Table
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->editor_id = $editor_id;
            $previousCompanyDraftObject->status = 0;
            $previousCompanyDraftObject->isActive = 0;
            $previousCompanyDraftObject->save();
        }

        //------> Insert into company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->setFields($fields);
        /* $newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 0;
        $newCompanyDraftObject->new_register = '1';
        $newCompanyDraftObject->package_status = $previousCompanyDraftObject->package_status;
        $newCompanyDraftObject->register_date = $previousCompanyDraftObject->register_date;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time()); // todo: to be fixe
        $newCompanyDraftObject->old_priority = 0; // todo: to be fixe
        $newCompanyDraftObject->save();

        //------> Edit c_phones_d Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id_and_isActive($newCompanyObject->Company_id, '1')->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->editor_id = $editor_id;
            $previousPhoneDraftObject->status = 0;
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Insert c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = $fields['phone'];
        $newPhoneDraftObject->code = $fields['code'];
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 0;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->phones_id = 0;
        $newPhoneDraftObject->branch_id = 0;
        $newPhoneDraftObject->isAdmin = ($newPhoneDraftObject->isAdmin == '') ? 0 : $newPhoneDraftObject->isAdmin;
        $newPhoneDraftObject->admin_description = ($newPhoneDraftObject->admin_description == '') ? '' : $newPhoneDraftObject->admin_description;
        $newPhoneDraftObject->save();

        //------> Edit c_addresses_d Table
        $newAddressDraftObject = adminc_addresses_dModel::getBy_company_id_and_isActive($newCompanyObject->Company_id, '1')->first();
        if (is_object($newAddressDraftObject)) {
            $newAddressDraftObject->editor_id = $editor_id;
            $newAddressDraftObject->status = 0;
            $newAddressDraftObject->isActive = 0;
            $newAddressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->company_d_id = $newCompanyDraftObject->Company_d_id;
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = 0;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 0;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->branch_id = 0;
        $newAddressDraftObject->admin_description = ($newAddressDraftObject->admin_description == '') ? '' : $newAddressDraftObject->admin_description;
        $newAddressDraftObject->addresses = ($newAddressDraftObject->addresses == '') ? '' : $newAddressDraftObject->addresses;
        $newAddressDraftObject->save();

        //------> Edit Previous Licence in c_licences Table
        $newLicenceObject = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], '1')->first();
        if (is_object($newLicenceObject)) {
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->status = 0;
            $newLicenceObject->isActive = 0;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 0;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], '1')->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 0;
                $LicenceObject->isActive = 0;
                //$LicenceObject->isMain = 0;
                $LicenceObject->save();
            }

            if (trim($file['name']) == '') {
                $imageName = $LicenceObject->image;
            } else {
                $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/lecence/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];

                $result_uploader = fileUploader($Property, $file);
                $imageName = $result_uploader['image_name'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->company_d_id = $newCompanyDraftObject->Company_d_id;
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = ($LicenceObject->parent_id == '') ? 0 : $LicenceObject->parent_id;
            $newLicenceObject->name = ($LicenceObject->name == '') ? '' : $LicenceObject->name;
            $newLicenceObject->family = ($LicenceObject->family == '') ? '' : $LicenceObject->family;
            $newLicenceObject->licence_number = ($LicenceObject->licence_number == '') ? 0 : $LicenceObject->licence_number;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = ($imageName == '') ? '' : $imageName;
            $newLicenceObject->issuence_date = ($fields['issuence_date'] == '')? date('Y-md') : convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 0;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = ($newLicenceObject->isMain == '') ? 1 : $newLicenceObject->isMain;
            $newLicenceObject->national_code = ($LicenceObject->national_code == '') ? 0 : $LicenceObject->national_code;
            $newLicenceObject->licence_type = ($LicenceObject->licence_type == '') ? 0 : $LicenceObject->licence_type;
            $newLicenceObject->description = ($LicenceObject->description == '') ? 0 : $LicenceObject->description;
            $newLicenceObject->admin_description = ($LicenceObject->admin_description == '') ? 0 : $LicenceObject->admin_description;
            $newLicenceObject->save();
        }

        //------> Edit Members Table
        $newMemberObject = adminMembersModel::getBy_company_id($newCompanyObject->Company_id)->first();
        if (is_object($newMemberObject)) {
            //$newMemberObject->editor_id = $editor_id;
            $newMemberObject->status = 0;
            $newMemberObject->save();
        }
        $msg = 'عملیات با موفقیت انجام شد ';
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
    }

    private function createPass($member)
    {
        $length = 8;
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        $data['username'] = $member->username;
        $data['password'] = $result;

        return $data;
    }

    public function sendNewPass($id)
    {
        $companyObject = admincompanyModel::find($id);
        if (!is_object($companyObject)) {
            $msg = 'خطا در عملیات!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $member = adminmembersModel::getBy_company_id($id)->get();
        if ($member['export']['recordsCount'] <= 0) {
            $msg = 'خطا در عملیات!';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        $member = $member['export']['list']['0'];

        //create username & password
        $data = $this->createPass($member);

        $member->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $member->username = $data['username'];
        $member->password = md5($data['password']);
        $member->save();

        sendSMS($member->mobile, '');

        //------> send email
        $path = ROOT_DIR . 'templates/' . CURRENT_SKIN . '/admin.sendPassForm.php';
        $contacts = ['email' => $member->email, 'subject' => 'ارسال نام کاربری', 'body' => ['path' => $path, 'data' => compact('data')]];

        $result = EmailEngineController::forceSend($contacts);

        //        $this->sendMail($member->email, $data);
        $msg = 'عملیات با موفقیت انجام شد' . $data['password'];
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
    }

    public function sendMail($email, $code)
    {
        include_once ROOT_DIR . '/model/mail.class.php';
        $mail = new clsEmail();
        $data['password'] = $code['password'];
        $data['username'] = $code['username'];

        $path = ROOT_DIR . 'templates/' . CURRENT_SKIN . '/admin.sendPassForm.php';

        $contacts = ['email' => $email, 'subject' => 'ارسال نام کاربری', 'body' => ['path' => $path, 'data' => compact('data')]];

        $result = EmailEngineController::forceSend($contacts);

        $inputList['code'] = $code;
        $inputList['title'] = 'نام کاربری و رمز عبور';
        $inputList['footer'] = RELA_DIR;
        $mail->variable = $inputList;
        $body = $mail->parse(ROOT_DIR . 'templates/' . CURRENT_SKIN . '/sendPass.php');

        //  sendmail($email, 'نام کاربری و رمز عبور', $body);

        return;
    }

    /* -----------------------------------------------------------------------
     * -------------------------- delete's --------------------------
     * -----------------------------------------------------------------------
     */

    public function deleteAll($company_id)
    {
        $result = c_phones_d::query("delete from c_phones_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_addresses_d::query("delete from c_addresses_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_banner_d::query("delete from c_banner_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_business_licence_d::query("delete from c_business_licence_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_certification_d::query("delete from c_certification_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_commercial_name_d::query("delete from c_commercial_name_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_emails_d::query("delete from c_emails_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_history_d::query("delete from c_history_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_honour_d::query("delete from c_honour_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_licences_d::query("delete from c_licences_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_logo_d::query("delete from c_logo_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_news_d::query("delete from c_news_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_product_d::query("delete from c_product_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_socials_d::query("delete from c_socials_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
        $result = c_websites_d::query("delete from c_websites_d where company_id = $company_id ")->getList();
        if ($result['result'] != 1) {
        }
    }

    public function deleteAfterAccept($companyObject)
    {
        $companyId = $companyObject->Company_id;
        $nationalId = $companyObject->national_id;

        if ($companyObject->company_type == '1') {
            $companyResult = admincompanyModel::getBy_national_id_and_not_Company_id($nationalId, $companyId)->getList();

            if ($companyResult['export']['recordsCount'] > 0) {
                foreach ($companyResult['export']['list'] as $key => $value) {
                    $result = adminc_phonesModel::query("delete from c_phones where company_id ='" . $value['Company_id'] . "'")->getList();
                    $result = adminc_phones_dModel::query("delete from c_phones_d where company_id ='" . $value['Company_id'] . "'")->getList();
                    $result = adminc_licencesModel::query("delete from c_licences where company_id ='" . $value['Company_id'] . "'")->getList();
                }
            }
        } else {
            $licenceObject = adminc_licencesModel::getBy_company_id($companyId)->first();
            $licenceResult = adminc_licencesModel::getBy_national_code_and_licence_number_and_licence_type_and_not_company_id($licenceObject->national_code, $licenceObject->licence_number, $licenceObject->licence_type, $companyId)->getList();
            if ($licenceResult['export']['recordsCount'] > 0) {
                foreach ($licenceResult['export']['list'] as $key => $value) {
                    $result = adminc_phonesModel::query("delete from c_phones where company_id ='" . $value['company_id'] . "'")->getList();
                    $result = adminc_phones_dModel::query("delete from c_phones_d where company_id ='" . $value['company_id'] . "'")->getList();
                    $result = adminc_licencesModel::query("delete from c_licences where company_id ='" . $value['company_id'] . "'")->getList();
                }
            }
        }

        $result = admincompanyModel::query("delete from company where national_id = $nationalId  and Company_id <> $companyId")->getList();
        $result = admincompany_dModel::query("delete from company_d where national_id = $nationalId  and company_id <> $companyId")->getList();
    }

    /* -----------------------------------------------------------------------
     * -------------------------------- Wiki --------------------------------
     * -----------------------------------------------------------------------
     */

    public function checkWiki($fields, $file)
    {
        global $admin_info;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        ////////////////////////////////////

        $newCompanyObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive_and_new_register($fields['company_d_id'], -1, 1, 0)->first();

        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی ویکی یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        if ($fields['company_type'] == 1) {
            $this->acceptWikiFreeLegalCompany($fields);
        } elseif ($fields['company_type'] == 2) {
            $this->acceptWikiFreeRealCompany($fields, $file);
        }
        calculateScoreCompany($newCompanyObject->company_id);
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki');
    }

    public function acceptWikiFreeLegalCompany($fields, $file = [])
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> Delete Previous Company From Company Table
        $companyDraftObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive_and_new_register($fields['company_d_id'], -1, 1, 0)->first();
        if (is_object($companyDraftObject)) {
            $fields['company_id'] = $companyDraftObject->company_id;
        }

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($fields);
        $fields['parent_category_id'] = $result['parent_category_id'];
        $fields['category_id'] = $result['category_id'];

        //------> Edit Company Table For Accept New Company
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();

        if (is_object($companyObject)) {
            $companyObject->setFields($fields);
            $companyObject->editor_id = $editor_id;
            //$companyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];
            $companyObject->isAdmin = 1;
            $companyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyObject->register_date = convertDate($fields['register_date']);
            $companyObject->status = 1;
            $companyObject->new_register = '0';
            $companyObject->package_status = '1';
            $companyObject->isActive = '0';
            $companyObject->save();
        }
        //print_r_debug($companyObject);

        //------> Edit Company_d Table for previous Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive($fields['company_d_id'], '1', '1')->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->isActive = '0';
            $previousCompanyDraftObject->package_status = '1';
            $previousCompanyDraftObject->register_date = convertDate($fields['register_date']);
            $previousCompanyDraftObject->save();
        }

        //------> Edit Company_d Table for New Company
        $previousCompanyDraftObject = adminCompany_dModel::getBy_Company_d_id_and_status_and_isActive_and_new_register($fields['company_d_id'], '-1', '1', '0')->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->editor_id = $editor_id;
            /*$previousCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $previousCompanyDraftObject->isAdmin = 1;
            $previousCompanyDraftObject->isActive = 0;
            $previousCompanyDraftObject->package_status = '1';
            $previousCompanyDraftObject->status = 1;
            $previousCompanyDraftObject->package_status = $packageStatus;
            $previousCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $previousCompanyDraftObject->confirm_date = $companyObject->register_date;
            $previousCompanyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        //$newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->package_status = '1';
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->register_date = $companyObject->register_date;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->save();

        //------> Add to log
        $fields['action'] = 3;
        $log = new adminLogController();
        $log->AddLog($fields);

        ////------> Phone
        //------> Edit Company from c_phones Table
        $phoneObject = adminc_phonesModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($phoneObject)) {
            $phoneObject->editor_id = $editor_id;
            $phoneObject->number = $fields['phone'];
            $phoneObject->code = $fields['code'];
            $phoneObject->company_id = $fields['company_id'];
            $phoneObject->subject = 'مرکزی';
            $phoneObject->reference_type = $fields['reference_type'];
            $phoneObject->reference_value = $fields['reference_value'];
            $phoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $phoneObject->status = 1;
            $phoneObject->isMain = 1;
            $phoneObject->save();
        }

        //------> Edit previous Company from c_phones_d Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->editor_id = $editor_id;
            $previousPhoneDraftObject->status = 1;
            $previousPhoneDraftObject->isMain = 1;
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Edit Company from c_phones_d Table
        $phoneDraftObject = adminc_phones_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($phoneDraftObject)) {
            $phoneDraftObject->editor_id = $editor_id;
            $phoneDraftObject->status = 1;
            $phoneDraftObject->isMain = 1;
            $phoneDraftObject->isActive = 0;
            $phoneDraftObject->phones_id = $phoneObject->Phones_id;
            $phoneDraftObject->save();
        }

        //------> Insert New Company in c_phones_d Table
        $newPhoneObject = new adminc_phones_dModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = $fields['phone'];
        $newPhoneObject->code = $fields['code'];
        $newPhoneObject->phones_id = $phoneObject->Phones_id;
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->company_d_id = $fields['company_d_id'];
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isActive = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->save();

        ////------> Website
        //------> Edit Company from c_websites Table
        $websiteObject = adminc_websitesModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($websiteObject)) {
            $websiteObject->editor_id = $editor_id;
            $websiteObject->url = $fields['url'];
            $websiteObject->company_id = $fields['company_id'];
            $websiteObject->subject = 'مرکزی';
            $websiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $websiteObject->status = 1;
            $websiteObject->isMain = 1;
            $websiteObject->save();
        }

        //------> Edit previous Company from c_websites_d Table
        $previousWebsiteDraftObject = adminc_websites_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousWebsiteDraftObject)) {
            $previousWebsiteDraftObject->editor_id = $editor_id;
            $previousWebsiteDraftObject->status = 1;
            $previousWebsiteDraftObject->isMain = 1;
            $previousWebsiteDraftObject->isActive = 0;
            $previousWebsiteDraftObject->save();
        }

        //------> Edit Company from c_websites_d Table
        $websiteDraftObject = adminc_websites_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($websiteDraftObject)) {
            $websiteDraftObject->editor_id = $editor_id;
            $websiteDraftObject->status = 1;
            $websiteDraftObject->isMain = 1;
            $websiteDraftObject->isActive = 0;
            $websiteDraftObject->websites_id = $websiteObject->Websites_id;
            $websiteDraftObject->save();
        }

        //------> Insert New Company in c_websites_d Table
        $newWebsiteObject = new adminc_websites_dModel();
        $newWebsiteObject->editor_id = $editor_id;
        $newWebsiteObject->url = $fields['url'];
        $newWebsiteObject->websites_id = $websiteObject->Websites_id;
        $newWebsiteObject->company_id = $fields['company_id'];
        $newWebsiteObject->company_d_id = $fields['company_d_id'];
        $newWebsiteObject->subject = 'مرکزی';
        $newWebsiteObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newWebsiteObject->status = 1;
        $newWebsiteObject->isActive = 1;
        $newWebsiteObject->isMain = 1;
        $newWebsiteObject->save();

        ////------> Email
        //------> Edit Company from c_emails Table
        $emailObject = adminc_emailsModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($emailObject)) {
            $emailObject->editor_id = $editor_id;
            $emailObject->email = $fields['email'];
            $emailObject->company_id = $fields['company_id'];
            $emailObject->subject = 'مرکزی';
            $emailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $emailObject->status = 1;
            $emailObject->isMain = 1;
            $emailObject->save();
        }

        //------> Edit previous Company from c_emails_d Table
        $previousEmailDraftObject = adminc_emails_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousEmailDraftObject)) {
            $previousEmailDraftObject->editor_id = $editor_id;
            $previousEmailDraftObject->status = 1;
            $previousEmailDraftObject->isMain = 1;
            $previousEmailDraftObject->isActive = 0;
            $previousEmailDraftObject->save();
        }

        //------> Edit Company from c_emails_d Table
        $emailDraftObject = adminc_emails_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($emailDraftObject)) {
            $emailDraftObject->editor_id = $editor_id;
            $emailDraftObject->status = 1;
            $emailDraftObject->isMain = 1;
            $emailDraftObject->isActive = 0;
            $emailDraftObject->emails_id = $emailObject->Emails_id;
            $emailDraftObject->save();
        }

        //------> Insert New Company in c_emails_d Table
        $newEmailObject = new adminc_emails_dModel();
        $newEmailObject->editor_id = $editor_id;
        $newEmailObject->email = $fields['email'];
        $newEmailObject->emails_id = $emailObject->Emails_id;
        $newEmailObject->company_id = $fields['company_id'];
        $newEmailObject->company_d_id = $fields['company_d_id'];
        $newEmailObject->subject = 'مرکزی';
        $newEmailObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newEmailObject->status = 1;
        $newEmailObject->isActive = 1;
        $newEmailObject->isMain = 1;
        $newEmailObject->isAdmin = 1;
        $newEmailObject->save();

        ////------> Address
        //------> Edit Company from c_addresses Table
        $addressObject = adminc_addressesModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($addressObject)) {
            $addressObject->editor_id = $editor_id;
            $addressObject->address = $fields['address'];
            $addressObject->postal_code = $fields['postal_code'];
            $addressObject->subject = 'مرکزی';
            $addressObject->status = 1;
            $addressObject->isMain = 1;
            $addressObject->save();
        }

        //------> Edit previous Company from c_addresses_d Table
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->editor_id = $editor_id;
            $previousAddressDraftObject->addresses_id = $addressObject->Addresses_id;
            $previousAddressDraftObject->status = 1;
            $previousAddressDraftObject->isMain = 1;
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->save();
        }

        //------> Edit Company from c_addresses_d Table
        $addressDraftObject = adminc_addresses_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($phoneDraftObject)) {
            $addressDraftObject->editor_id = $editor_id;
            $addressDraftObject->addresses_id = $addressObject->Addresses_id;
            $addressDraftObject->status = 1;
            $addressDraftObject->isMain = 1;
            $addressDraftObject->isActive = 0;
            $addressDraftObject->save();
        }

        //------> Insert New record in c_addresses_d Table
        $newAddressObject = new adminc_addresses_dModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->postal_code = $fields['postal_code'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->addresses_id = $addressObject->Addresses_id;
        $newAddressObject->company_d_id = $fields['company_d_id'];
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isAdmin = 1;
        $newAddressObject->isActive = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->save();

        //------> Edit Previous Licence
        $previousLicenceObject = adminc_licencesModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '1', '1')->first();
        if (is_object($previousLicenceObject)) {
            $previousLicenceObject->status = 1;
            $previousLicenceObject->isActive = 0;
            $previousLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 1;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 1;
                $LicenceObject->isActive = 0;
                $LicenceObject->isMain = 0;
                $LicenceObject->save();
            }

            if (trim($file['name']) == '') {
                $imageName = $LicenceObject->image;
            } else {
                $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/licence/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];

                $result_uploader = fileUploader($Property, $file);
                $imageName = $result_uploader['image_name'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->company_d_id = $fields['company_d_id'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = $LicenceObject->parent_id;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = $imageName;
            $newLicenceObject->issuence_date = convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 1;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = 0;
            $newLicenceObject->save();
        }
    }

    public function acceptWikiFreeRealCompany($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];
        $packageStatus = $fields['package_status'];
        $companyId = '';

        //------> get parent_id and category_id
        $result = $this->getParentIdCategory($fields);

        $fields['parent_category_id'] = $result['parent_category_id'];
        $fields['category_id'] = $result['category_id'];

        //------> Delete Previous Company From Company Table
        $companyDraftObject = admincompany_dModel::getBy_Company_d_id($fields['company_d_id'], 1)->first();
        if (is_object($companyDraftObject)) {
            $fields['company_id'] = $companyDraftObject->company_id;
        }

        //------> Edit Company Table For Accept New Company
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($companyObject)) {
            $companyObject->setFields($fields);
            $companyObject->editor_id = $editor_id;
            /*$companyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];*/
            $companyObject->isAdmin = 1;
            $companyObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $companyObject->status = 1;
            $companyObject->new_register = '0';
            $companyObject->package_status = '1';
            $companyObject->isActive = '0';
            $companyObject->save();
        }

        //------> Edit Company_d Table for previous Company
        $previousCompanyDraftObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive($fields['company_d_id'], '1', '1')->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->isActive = '0';
            $previousCompanyDraftObject->save();
        }

        //------> Edit Company_d Table for New Company
        $previousCompanyDraftObject = adminCompany_dModel::getBy_Company_d_id_and_status_and_isActive_and_new_register($fields['company_d_id'], '-1', '1', '0')->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->editor_id = $editor_id;
            /*$previousCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
            $previousCompanyDraftObject->isAdmin = 1;
            $previousCompanyDraftObject->isActive = 0;
            $previousCompanyDraftObject->status = 1;
            $previousCompanyDraftObject->package_status = $packageStatus;
            $previousCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
            $previousCompanyDraftObject->save();
        }

        //------> Insert in Company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->setFields($fields);
        /*$newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 1;
        $newCompanyDraftObject->package_status = $packageStatus;
        $newCompanyDraftObject->new_register = '0';
        $newCompanyDraftObject->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->register_date = $previousCompanyDraftObject->register_date;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->save();

        //------> Add to log
        $fields['action'] = 3;
        $log = new adminLogController();
        $log->AddLog($fields);

        ////------> Phone
        //------> Edit Company from c_phones Table
        $phoneObject = adminc_phonesModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($phoneObject)) {
            $phoneObject->editor_id = $editor_id;
            $phoneObject->number = $fields['phone'];
            $phoneObject->code = $fields['code'];
            $phoneObject->company_id = $fields['company_id'];
            $phoneObject->subject = 'مرکزی';
            $phoneObject->reference_type = $fields['reference_type'];
            $phoneObject->reference_value = $fields['reference_value'];
            $phoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $phoneObject->status = 1;
            $phoneObject->isMain = 1;
            $phoneObject->save();
        }

        //------> Edit previous Company from c_phones_d Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->editor_id = $editor_id;
            $previousPhoneDraftObject->status = 1;
            $previousPhoneDraftObject->isMain = 1;
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Edit Company from c_phones_d Table
        $phoneDraftObject = adminc_phones_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($phoneDraftObject)) {
            $phoneDraftObject->editor_id = $editor_id;
            $phoneDraftObject->status = 1;
            $phoneDraftObject->isMain = 1;
            $phoneDraftObject->isActive = 0;
            $phoneDraftObject->phones_id = $phoneObject->Phones_id;
            $phoneDraftObject->save();
        }

        //------> Insert New Company in c_phones_d Table
        $newPhoneObject = new adminc_phones_dModel();
        $newPhoneObject->editor_id = $editor_id;
        $newPhoneObject->number = $fields['phone'];
        $newPhoneObject->code = $fields['code'];
        $newPhoneObject->phones_id = $phoneObject->Phones_id;
        $newPhoneObject->company_id = $fields['company_id'];
        $newPhoneObject->company_d_id = $fields['company_d_id'];
        $newPhoneObject->subject = 'مرکزی';
        $newPhoneObject->reference_type = $fields['reference_type'];
        $newPhoneObject->reference_value = $fields['reference_value'];
        $newPhoneObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneObject->status = 1;
        $newPhoneObject->isActive = 1;
        $newPhoneObject->isMain = 1;
        $newPhoneObject->save();

        ////------> Address
        //------> Edit Company from c_addresses Table
        $addressObject = adminc_addressesModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($addressObject)) {
            $addressObject->editor_id = $editor_id;
            $addressObject->address = $fields['address'];
            $addressObject->subject = 'مرکزی';
            $addressObject->status = 1;
            $addressObject->isMain = 1;
            $addressObject->save();
        }

        //------> Edit previous Company from c_addresses_d Table
        $previousAddressDraftObject = adminc_addresses_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousAddressDraftObject)) {
            $previousAddressDraftObject->editor_id = $editor_id;
            $previousAddressDraftObject->status = 1;
            $previousAddressDraftObject->isMain = 1;
            $previousAddressDraftObject->isActive = 0;
            $previousAddressDraftObject->save();
        }

        //------> Edit Company from c_addresses_d Table
        $addressDraftObject = adminc_addresses_dModel::getBy_Company_d_id($fields['company_d_id'])->first();
        if (is_object($phoneDraftObject)) {
            $addressDraftObject->editor_id = $editor_id;
            $addressDraftObject->status = 1;
            $addressDraftObject->isMain = 1;
            $addressDraftObject->isActive = 0;
            $addressDraftObject->save();
        }

        //------> Insert New Company in c_addresses_d Table
        $newAddressObject = new adminc_addresses_dModel();
        $newAddressObject->editor_id = $editor_id;
        $newAddressObject->address = $fields['address'];
        $newAddressObject->company_id = $fields['company_id'];
        $newAddressObject->company_d_id = $fields['company_d_id'];
        $newAddressObject->subject = 'مرکزی';
        $newAddressObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressObject->status = 1;
        $newAddressObject->isAdmin = 1;
        $newAddressObject->isActive = 1;
        $newAddressObject->isMain = 1;
        $newAddressObject->save();

        //------> Edit Previous Licence
        $previousLicenceObject = adminc_licencesModel::getBy_company_id_and_status_and_isActive($fields['company_id'], '1', '1')->first();
        if (is_object($previousLicenceObject)) {
            $previousLicenceObject->status = 1;
            $previousLicenceObject->isActive = 0;
            $previousLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 1;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 1;
                $LicenceObject->isActive = 0;
                $LicenceObject->isMain = 0;
                $LicenceObject->save();
            }

            if (trim($file['name']) == '') {
                $imageName = $LicenceObject->image;
            } else {
                $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/licence/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];

                $result_uploader = fileUploader($Property, $file);
                $imageName = $result_uploader['image_name'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->company_d_id = $fields['company_d_id'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = $LicenceObject->parent_id;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = $imageName;
            $newLicenceObject->issuence_date = convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 1;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->isMain = 0;
            $newLicenceObject->save();
        }
    }

    public function showWiki()
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.companyWiki.showList.php';
        $this->template($export);
        die();
    }

    public function showWikiPreviousVersionForm($fields)
    {
        //------> check wiki
        $wikiObj = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive($fields['company_d_id'], '-1', '1')->first();
        if (!is_object($wikiObj)) {
            $msg = $wikiObj['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $msg);
        }
        $company_d_id = $wikiObj->Company_d_id;
        $company_id = $wikiObj->company_id;
        $company_type = $wikiObj->company_type;
        $status = ['-1', '0'];

        $wikiObject = admincompanyModel::getBy_Company_id_and_status($company_id, '1')->first();
        if (!is_object($wikiObject)) {
            $msg = $wikiObject['msg'];
            redirectPage($wikiObject . 'admin/index.php?component=company&action=showWiki', $msg);
        }
        //------> Get Company Information
        $export['companyInfo'] = $wikiObject->fields;
        $export['companyInfo']['register_date'] = convertDate($wikiObject->register_date);
        $companyCategory = tagToArray($wikiObject->category_id)['export']['list'];
        $export['companyInfo']['category_id'] = $companyCategory['1'];

        //------> Get All Personality Type
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityType'] = $resultPersonalityType['export']['list'];
        }

        //------> Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax('all');
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        //------> Get  Wiki Phone Information
        $phoneResult = adminc_phonesModel::getBy_company_id_and_isMain($company_id, '1')->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //------> Get  Wiki Email Information
        $emailResult = adminc_emailsModel::getBy_company_id_and_branch_id($company_id, '0')->getList();
        if ($emailResult['export']['recordsCount'] > 0) {
            $export['emailInfo'] = $emailResult['export']['list']['0'];
        }

        //------> Get  Wiki WebSite Information
        $websiteResult = adminc_websitesModel::getBy_company_id_and_branch_id($company_id, '0')->getList();
        if ($websiteResult['export']['recordsCount'] > 0) {
            $export['websiteInfo'] = $websiteResult['export']['list']['0'];
        }

        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive_and_status($company_id, '1', '2')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['licenceInfo']['issuence_date'] = convertDate($export['licenceInfo']['issuence_date']);
            $export['licenceInfo']['expiration_date'] = convertDate($export['licenceInfo']['expiration_date']);
        }

        //------> Get company Address Information
        $addressResult = adminc_addressesModel::getBy_company_id_and_isMain($company_id, '1')->getList();
        if ($addressResult['export']['recordsCount'] > 0) {
            $export['addressInfo'] = $addressResult['export']['list']['0'];
        }

        //------> Get PackageUsage
        include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageUsageObject = new adminPackageUsageController();
        $resultPackageUsage = $packageUsageObject->getPackageByCompanyID($company_id);

        //------> Get all category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //------> Get all City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //------> Get all State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $state = new adminStateModel();
        $resultState = $state->getStates();
        if ($resultState['result'] == 1) {
            $export['states'] = $resultState['export']['list'];
        }

        //------> Get All PersonalityType
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityList'] = $resultPersonalityType['export']['list'];
        }

        if ($company_type == '1') {
            $this->fileName = 'admin.wikiCompanyLegal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقوقی';
        } else {
            $this->fileName = 'admin.wikiCompanyReal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقیقی';
        }

        $this->template($export, $msg);
        die();
    }

    public function checkWikiPreviousVersion($fields, $file)
    {
        global $admin_info;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        ////////////////////////////////////

        $newCompanyObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive_and_new_register($fields['company_d_id'], -1, 1, 0)->first();

        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی ویکی یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        if ($fields['company_type'] == 1) {
            $this->acceptWikiFreeLegalCompany($fields);
        } elseif ($fields['company_type'] == 2) {
            $this->acceptWikiFreeRealCompany($fields, $file);
        }
        calculateScoreCompany($newCompanyObject->company_id);
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $msg);
    }

    public function searchWiki()
    {
        $company = new admincompanyModel();

        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_d_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'number', 'dt' => $i++], ['db' => 'city_name', 'dt' => $i++], ['db' => 'address', 'dt' => $i++], ['db' => 'email', 'dt' => $i++], ['db' => 'website_url', 'dt' => $i++], ['db' => 'logo', 'dt' => $i++], ['db' => 'logo', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        //$convert->input = $fields;
        $convert->columns = $columns;
        $searchFields = $convert->convertInput();

        //$date = date('Y-m-d', strtotime(COMPANY_EXPIRE_PERIOD));
        //$searchFields['where'] = 'where refresh_date < '."'$date'";

        $query = $company->getQuery('wiki');
        $result = $company->getByFilter($searchFields, $query);
        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="' . $list['Company_id'] . '" class="company_phone">' . $list['phone_number'] . '</div>';

                return $st;
            },
        ];

        $other[$i - 2] = [
            'formatter' => function ($list) {
                if (strlen($list['image']) > 0) {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        COMPANY_ADDRESS .
                        $list['Company_id'] .
                        '/logo/' .
                        $list['image'] .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                } else {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        DEFULT_LOGO_ADDRESS .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                }

                return $st;
            },
        ];

        //$internalVariable['showstatus'] = $fields['status'];
        $other[$i - 1] = [
            formatter => function ($list, $internal) {
                $st = "<a href='" . RELA_DIR . 'admin/?component=company&action=checkWikiCompany&id=' . $list['Company_d_id'] . "'>بررسی ویکی</a>";
                return $st;
            },
        ];

        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function showCheckWikiForm($fields)
    {
        //------> check wiki
        $wikiObject = admincompany_dModel::getBy_Company_d_id_and_status_and_isActive($fields['company_d_id'], '-1', '1')->first();
        if (!is_object($wikiObject)) {
            $msg = $wikiObject['msg'];
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showWiki', $msg);
        }

        $company_d_id = $wikiObject->Company_d_id;
        $company_id = $wikiObject->company_id;
        $company_type = $wikiObject->company_type;
        $status = ['-1', '0'];

        //------> Get Company Information
        $export['companyInfo'] = $wikiObject->fields;
        $export['companyInfo']['register_date'] = convertDate($wikiObject->register_date);
        $companyCategory = tagToArray($wikiObject->category_id)['export']['list'];
        $export['companyInfo']['category_id'] = $companyCategory['1'];

        //------> Get All Personality Type
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityType'] = $resultPersonalityType['export']['list'];
        }

        //------> Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax('all');
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        //------> Get  Wiki Phone Information
        $phoneResult = adminc_phones_dModel::getBy_company_d_id_and_isActive_and_status($company_d_id, '1', '-1')->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //------> Get  Wiki Email Information
        $emailResult = adminc_emails_dModel::getBy_company_d_id_and_isActive_and_status($company_d_id, '1', '-1')->getList();
        if ($emailResult['export']['recordsCount'] > 0) {
            $export['emailInfo'] = $emailResult['export']['list']['0'];
        }
        //------> Get  Wiki WebSite Information
        $websiteResult = adminc_websites_dModel::getBy_company_d_id_and_isActive_and_status($company_d_id, '1', '-1')->getList();
        if ($websiteResult['export']['recordsCount'] > 0) {
            $export['websiteInfo'] = $websiteResult['export']['list']['0'];
        }

        $LicenceResult = adminc_licencesModel::getBy_company_d_id_and_isActive_and_status($company_d_id, '1', '-1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['licenceInfo']['issuence_date'] = convertDate($export['licenceInfo']['issuence_date']);
            $export['licenceInfo']['expiration_date'] = convertDate($export['licenceInfo']['expiration_date']);
        }

        //------> Get company Address Information
        $addressResult = adminc_addresses_dModel::getBy_company_d_id_and_isActive_and_status($company_d_id, '1', '-1')->getList();
        if ($addressResult['export']['recordsCount'] > 0) {
            $export['addressInfo'] = $addressResult['export']['list']['0'];
        }

        //------> Get PackageUsage
        include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageUsageObject = new adminPackageUsageController();
        $resultPackageUsage = $packageUsageObject->getPackageByCompanyID($company_id);

        //------> Get all category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //------> Get all City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //------> Get all State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $state = new adminStateModel();
        $resultState = $state->getStates();
        if ($resultState['result'] == 1) {
            $export['states'] = $resultState['export']['list'];
        }

        //------> Get All PersonalityType
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityList'] = $resultPersonalityType['export']['list'];
        }

        //------> Get Company Phone
        include_once ROOT_DIR . 'component/companyPhones/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityList'] = $resultPersonalityType['export']['list'];
        }

        // -------------------------------------------->
        $fields['company_id'] = $export['companyInfo']['company_id'];

        // ------> Get CompanyData

        $companyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        if ($companyObject->company_type == '1' and $companyObject->package_status == '1') {
            $this->fileName = 'admin.companyLegalFree.editForm.php';
        } elseif ($companyObject->company_type == '2' and $companyObject->package_status == '1') {
            $this->fileName = 'admin.companyRealFree.editForm.php';
        }

        //Get all Member Information
        include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';

        if ($companyObject->package_status == '4') {
            $memberObject = new adminLoginController();
            $resultObject = $memberObject->getMemberObject($fields['Company_id']);
            $export['companyData']['memberInfo']['name'] = $resultObject->name;
            $export['companyData']['memberInfo']['family'] = $resultObject->family;
            $export['companyData']['memberInfo']['email'] = $resultObject->email;
            $export['companyData']['memberInfo']['mobile'] = $resultObject->mobile;
        } else {
            //------> get Company_d_id
            $companyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($companyObject->Company_id, 1, 1, 0)->first();

            $memberObject = new adminEditorMemberController();
            $resultMember = $memberObject->getMemberInformationById($companyDraftObject->Company_d_id);

            $export['companyData']['editorInfo']['editor_name'] = $resultMember->name;
            $export['companyData']['editorInfo']['editor_family'] = $resultMember->family;
            $export['companyData']['editorInfo']['editor_phone'] = $resultMember->phone;
        }

        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive($fields['Company_id'], '1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['companyData']['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['companyData']['licenceInfo']['issuence_date'] = convertDate($export['companyData']['licenceInfo']['issuence_date']);
            $export['companyData']['licenceInfo']['expiration_date'] = convertDate($export['companyData']['licenceInfo']['expiration_date']);
        }

        //        //Get all category
        //        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        //        $category = new adminCategoryController();
        //        $resultCategory = $category->getCategory();
        //        $export['category'] = $resultCategory;

        //Get all Log
        $log = new adminLogController();
        $resultLog = $log->getLog($fields);
        $export['companyData']['logInfo'] = $resultLog['export']['list'];

        //        //Get all City
        //        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        //        $city = new adminCityModel();
        //        $resultCity = $city->getCities();
        //        if ($resultCity['result'] == 1) {
        //            $export['cities'] = $city->list;
        //        }

        //        //Get all State
        //        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        //        $state = new adminStateModel();
        //        $resultState = $state->getStates();
        //        if ($resultState['result'] == 1) {
        //            $exportt['states'] = $resultState['export']['list'];
        //        }

        //        //Get All personalityType
        //        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        //        $personalityType = new adminPersonalityTypeController();
        //        $resultPersonalityType = $personalityType->getPersonalityType();
        //        if ($resultPersonalityType['result'] == 1) {
        //            $export["companyData"]['personalityType'] = $resultPersonalityType['export']['list'];
        //        }

        //Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax('notAll');
        if ($resultLicence['result'] == 1) {
            $export['companyData']['licence'] = $resultLicence['export']['list'];
        }

        //Get phone
        $phoneResult = adminc_phonesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['companyData']['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //Get licences
        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], '1')->getList();

        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['companyData']['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['companyData']['licenceInfo']['issuence_date'] = convertDate($export['companyData']['licenceInfo']['issuence_date']);
            $export['companyData']['licenceInfo']['expiration_date'] = convertDate($export['companyData']['licenceInfo']['expiration_date']);
        }

        //Get addresses
        $addressResult = adminc_addressesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($addressResult['export']['recordsCount'] > 0) {
            $export['companyData']['addressInfo'] = $addressResult['export']['list']['0'];
        }

        //Get websites
        $websiteResult = adminc_websitesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($websiteResult['export']['recordsCount'] > 0) {
            $export['companyData']['websiteInfo'] = $websiteResult['export']['list']['0'];
        }

        //Get Emails
        $emailResult = adminc_emailsModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($emailResult['export']['recordsCount'] > 0) {
            $export['companyData']['emailInfo'] = $emailResult['export']['list']['0'];
        }

        //Get Logo
        $logoResult = adminc_logoModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($logoResult['export']['recordsCount'] > 0) {
            $export['companyData']['logoInfo'] = $logoResult['export']['list']['0'];
        }

        //Get PackageUsage
        include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageUsageObject = new adminPackageUsageController();
        $resultPackageUsage = $packageUsageObject->getPackageByCompanyID($companyObject->Company_id);

        if (is_object($resultPackageUsage)) {
            $export['companyData']['packageUsage'] = $resultPackageUsage->fields;
        }

        $showStatus = $fields['showStatus'];
        $export['companyData']['companyInfo'] = $companyObject->fields;
        if ($companyObject->registration_date != '0000-00-00 00:00:00') {
            $export['companyData']['companyInfo']['registration_date'] = convertDate($companyObject->registration_date);
        }
        $export['companyData']['companyInfo']['category_id'] = trim($companyObject->category_id, ',');
        $export['companyData']['showStatus'] = $showStatus;

        //$export['showStatus'] = $showStatus;

        if ($company_type == '1') {
            $this->fileName = 'admin.wikiCompanyLegal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقوقی';
        } else {
            $this->fileName = 'admin.wikiCompanyReal.editForm.php';
            $export['formTitle'] = 'صفحه تایید کمپانی حقیقی';
        }

        $this->template($export, $msg);
        die();
    }

    public function findWikiItem($input, $id)
    {
        $item = [['companyAddresses', 'showWikiCompanyAddress', 'آدرس'], ['companyPhones', 'showWikiCompanyPhone', 'تلفن'], ['companyPhones', 'showWikiCompanyPhone', 'تلفن']];
        $s = '';
        for ($i = 0; $i < 2; $i++) {
            if ($input[$i] != 0) {
                $s .=
                    '<a href="' .
                    RELA_DIR .
                    'admin/?component=' .
                    $item[$i][0] .
                    '&action=' .
                    $item[$i][1] .
                    '&id=' .
                    $id .
                    '">' .
                    $item[$i][2] .
                    '</a>
               <br/>';
            }
        }

        return $s;
    }

    public function rejectWikiCompany($fields)
    {
        if (($fields['package_status'] == '3') & ($fields['package_status'] == '4')) {
            $this->check($fields);
        }

        //------> Delete Record of company Table
        $companyObject = admincompanyModel::getBy_Company_id($fields['company_id'])->first();
        if (is_object($companyObject)) {
            $companyObject->delete();
        }

        //------> Delete Record of company_d Table
        $companyDraftObject = admincompany_dModel::getBy_company_id($fields['company_id'])->get();
        if ($companyDraftObject['export']['recordsCount'] > 0) {
            foreach ($companyDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_phones_d Table
        $phonesDraftObject = adminc_phones_dModel::getBy_company_id($fields['company_id'])->get();
        if ($phonesDraftObject['export']['recordsCount'] > 0) {
            foreach ($phonesDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_addresses_d Table
        $addressesDraftObject = adminc_addresses_dModel::getBy_company_id($fields['company_id'])->get();
        if ($addressesDraftObject['export']['recordsCount'] > 0) {
            foreach ($addressesDraftObject['export']['list'] as $key => $value) {
                $value->delete();
            }
        }

        //------> Delete Record of c_addresses_d Table
        $licencesObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->get();
        if ($licencesObject['export']['recordsCount'] > 0) {
            foreach ($licencesObject['export']['list'] as $key => $value) {
                fileRemover(COMPANY_ADDRESS_ROOT . $value->company_id . '/licence/', $value->image);
                $value->delete();
            }
        }
    }

    public function checkingWiki($fields, $file)
    {
        global $admin_info;
        $editor_id = $admin_info['admin_id'];

        //------> find newCompany
        $newCompanyObject = admincompanyModel::find($fields['company_id']);
        if (!is_object($newCompanyObject)) {
            $msg = 'تولیدی جدید یافت نشد! ';
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
        }

        //------> Edit company Table
        $newCompanyObject->setFields($fields);
        /*  $newCompanyObject->category_id = arrayToTag($fields['category_id'])['export']['list'];;*/
        $newCompanyObject->editor_id = $editor_id;
        $newCompanyObject->isAdmin = 1;
        $newCompanyObject->isActive = 1;
        $newCompanyObject->status = 0;
        $newCompanyObject->new_register = '1';
        $newCompanyObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyObject->save();

        //------> Edit previous company in company_d Table
        $previousCompanyDraftObject = admincompany_dModel::getBy_company_id($fields['company_id'])->first();
        if (is_object($previousCompanyDraftObject)) {
            $previousCompanyDraftObject->editor_id = $editor_id;
            $previousCompanyDraftObject->status = 0;
            $previousCompanyDraftObject->isActive = 0;
            $previousCompanyDraftObject->save();
        }

        //------> Insert into company_d Table
        $newCompanyDraftObject = new admincompany_dModel();
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->setFields($fields);
        $newCompanyDraftObject->category_id = arrayToTag($fields['category_id'])['export']['list'];
        $newCompanyDraftObject->editor_id = $editor_id;
        $newCompanyDraftObject->isAdmin = 1;
        $newCompanyDraftObject->isActive = 1;
        $newCompanyDraftObject->status = 0;
        $newCompanyDraftObject->new_register = '1';
        $newCompanyDraftObject->package_status = $previousCompanyDraftObject->package_status;
        $newCompanyDraftObject->register_date = $previousCompanyDraftObject->register_date;
        $newCompanyDraftObject->confirm_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newCompanyDraftObject->save();

        //------> Edit c_phones_d Table
        $previousPhoneDraftObject = adminc_phones_dModel::getBy_company_id_and_isActive($newCompanyObject->Company_id, '1')->first();
        if (is_object($previousPhoneDraftObject)) {
            $previousPhoneDraftObject->editor_id = $editor_id;
            $previousPhoneDraftObject->status = 0;
            $previousPhoneDraftObject->isActive = 0;
            $previousPhoneDraftObject->save();
        }

        //------> Insert c_phones_d Table
        $newPhoneDraftObject = new adminc_phones_dModel();
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->editor_id = $editor_id;
        $newPhoneDraftObject->number = $fields['phone'];
        $newPhoneDraftObject->company_id = $fields['company_id'];
        $newPhoneDraftObject->subject = 'مرکزی';
        $newPhoneDraftObject->reference_type = $fields['reference_type'];
        $newPhoneDraftObject->reference_value = $fields['reference_value'];
        $newPhoneDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newPhoneDraftObject->status = 0;
        $newPhoneDraftObject->isActive = 1;
        $newPhoneDraftObject->isMain = 1;
        $newPhoneDraftObject->save();

        //------> Edit c_addresses_d Table
        $newAddressDraftObject = adminc_addresses_dModel::getBy_company_id_and_isActive($newCompanyObject->Company_id, '1')->first();
        if (is_object($newAddressDraftObject)) {
            $newAddressDraftObject->editor_id = $editor_id;
            $newAddressDraftObject->status = 0;
            $newAddressDraftObject->isActive = 0;
            $newAddressDraftObject->save();
        }

        //------> Insert in c_addresses_d Table
        $newAddressDraftObject = new adminc_addresses_dModel();
        $newAddressDraftObject->editor_id = $editor_id;
        $newAddressDraftObject->address = $fields['address'];
        $newAddressDraftObject->company_id = $fields['company_id'];
        $newAddressDraftObject->subject = 'مرکزی';
        $newAddressDraftObject->addresses_id = 0;
        $newAddressDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newAddressDraftObject->status = 0;
        $newAddressDraftObject->isAdmin = 1;
        $newAddressDraftObject->isMain = 1;
        $newAddressDraftObject->isActive = 1;
        $newAddressDraftObject->save();

        //------> Edit Previous Licence in c_licences Table
        $newLicenceObject = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], '1')->first();
        if (is_object($newLicenceObject)) {
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->status = 0;
            $newLicenceObject->isActive = 0;
            $newLicenceObject->save();
        }

        if (isset($fields['remove_licence']) or $fields['remove_licence'] == 'on') {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id($fields['company_id'])->first();
            if (is_object($LicenceObject)) {
                fileRemover(COMPANY_ADDRESS_ROOT . $LicenceObject->company_id . '/licence/', $LicenceObject->image);
                $LicenceObject->status = 0;
                $LicenceObject->isMain = 0;
                $LicenceObject->isActive = 0;
                $LicenceObject->save();
            }
        } else {
            //------> Edit Licence
            $LicenceObject = adminc_licencesModel::getBy_company_id_and_isActive($fields['company_id'], '1')->first();
            if (is_object($LicenceObject)) {
                $LicenceObject->status = 0;
                $LicenceObject->isActive = 0;
                //$LicenceObject->isMain = 0;
                $LicenceObject->save();
            }

            if (trim($file['name']) == '') {
                $imageName = $LicenceObject->image;
            } else {
                $Property = ['type' => 'jpg,png,jpeg', 'new_name' => $file['name'], 'max_size' => '2048000', 'upload_dir' => COMPANY_ADDRESS_ROOT . $fields['company_id'] . '/lecence/', 'height' => '', 'wight' => '', 'error_msg' => '', 'success_msg' => ''];

                $result_uploader = fileUploader($Property, $file);
                $imageName = $result_uploader['image_name'];
            }

            //------> Add new Record
            $newLicenceObject = new adminc_licencesModel();
            $newLicenceObject->setFields($fields);
            $newLicenceObject->company_id = $fields['company_id'];
            $newLicenceObject->editor_id = $editor_id;
            $newLicenceObject->branch_id = 0;
            $newLicenceObject->parent_id = $LicenceObject->parent_id;
            $newLicenceObject->description = $fields['licence_description'];
            $newLicenceObject->image = $imageName;
            $newLicenceObject->issuence_date = convertJToGDate($fields['issuence_date']);
            $newLicenceObject->expiration_date = convertJToGDate($fields['expiration_date']);
            $newLicenceObject->exporter_refrence = $fields['exporter_refrence'];
            $newLicenceObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $newLicenceObject->status = 0;
            $newLicenceObject->isActive = 1;
            $newLicenceObject->isAdmin = 1;
            $newLicenceObject->save();
        }

        //------> Edit Members Table
        $newMemberObject = adminMembersModel::getBy_company_id($newCompanyObject->Company_id)->first();
        if (is_object($newMemberObject)) {
            //$newMemberObject->editor_id = $editor_id;
            $newMemberObject->status = 0;
            $newMemberObject->save();
        }
        $msg = 'عملیات با موفقیت انجام شد ';
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showNewCompany', $msg);
    }

    /* -----------------------------------------------------------------------
     * -------------- This part will use for all the companies --------------
     * -----------------------------------------------------------------------
     */

    /**
     * Display a companies properties difference between
     * current data and the last edited one.
     *
     * @var $companyId
     * */
    public function showDifference($companyId)
    {
        if (!empty($companyId)) {
            $realCompany = $this->getRealOrDraftCompanyInformation($companyId, 1, 1);

            $draftCompany = $this->getRealOrDraftCompanyInformation($companyId, 1, 0);

            if ($realCompany != false && $draftCompany != false) {
                $companyDifference = $this->compareCompaniesDifference($realCompany, $draftCompany);
                $data['companyList']['realCompany'] = $realCompany;
                $data['companyList']['draftCompany'] = $draftCompany;
                $data['companyList']['companyDifference'] = $companyDifference;
            } else {
                $data['errMessage'] = 'اطلاعاتی برای نمایش دادن نیست';
            }

            view('admin.company.difference', compact('data'));
        } else {
            view('404');
        }
    }

    /**
     * get the company that has been edited and have the last valid data
     * or the company that has the newest unvalidated data according to
     * their status and isActive value, for example if the status and
     * the isActive both set to 1 then it is the RealCompany and if
     * the status is set to 1 and isActive is set to 0 then its is
     * is the DraftCompany.
     *
     * @param $companyId
     * @param $status
     * @param $isActive
     * @return array
     */
    public function getRealOrDraftCompanyInformation($companyId, $status, $isActive)
    {
        $company['company'] = $this->getRealOrDraftCompany($companyId, $status, $isActive);
        $company['personality_type'] = $this->getRealOrDraftCompanyPersonalityType($companyId, $status, $isActive);
        $company['editor'] = $this->getRealOrDraftEditorName($companyId, $status, $isActive);
        $company['category'] = $this->getRealOrDraftCategory($company['company']);
        $company['addresses'] = $this->getRealOrDraftCompanyAddress($companyId, $status, $isActive);
        $company['banner'] = $this->getRealOrDraftCompanyBanner($companyId, $status, $isActive);
        $company['phones'] = $this->getRealOrDraftCompanyPhones($companyId, $status, $isActive);
        $company['logo'] = $this->getRealOrDraftCompanyLogo($companyId, $status, $isActive);
        $company['city'] = $this->getRealOrDraftCompanyCities($companyId, $status, $isActive);
        $company['licence'] = $this->getRealOrDraftCompanyLicence($company['company'], $isActive);
        //        $company['honour'] = $this->getRealOrDraftCompanyHonour($companyId, $status, $isActive);
        //        $company['webSites'] = $this->getRealOrDraftCompanyWebSites($companyId, $status, $isActive);
        //        $company['businessLicence'] = $this->getRealOrDraftCompanyBusinessLicence($companyId, $status, $isActive);
        //        $company['commercialName'] = $this->getRealOrDraftCompanyCommercialName($companyId, $status, $isActive);
        //        $company['emails'] = $this->getRealOrDraftCompanyEmails($companyId, $status, $isActive);
        //        $company['history'] = $this->getRealOrDraftCompanyHistory($companyId, $status, $isActive);
        //        $company['news'] = $this->getRealOrDraftCompanyNews($companyId, $status, $isActive);
        //        $company['products'] = $this->getRealOrDraftCompanyProducts($companyId, $status, $isActive);
        //        $company['socials'] = $this->getRealOrDraftCompanySocials($companyId, $status, $isActive);

        return $company;
    }

    public function getRealOrDraftCategory($company)
    {
        $categories = tagToArray($company['category_id'])['export']['list'];

        foreach ($categories as $category) {
            $cate = category::find($category);
            $categoriesTitle[] = $cate->title;
        }

        return implode(',', $categoriesTitle);
    }

    public function getRealOrDraftEditorName($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->leftJoin('admin', 'company_d.editor_id', '=', 'admin.admin_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return false;
        } else {
            return $company['export']['list'][0];
        }
    }

    private function getRealOrDraftCompany($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();
        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    public function getRealOrDraftCompanyLicence($company, $isActive)
    {
        include_once ROOT_DIR . 'component/licence/member/model/licence.model.php';

        if (($company['company_type'] == 2) & ($isActive == 1)) {
            $licence = c_licences::getAll()
                ->leftJoin('licence_list', 'licence_list.Licence_list_id', '=', 'c_licences.licence_type')
                ->where('c_licences.company_id', '=', $company['company_id'])
                ->where('c_licences.status', '=', 2)
                ->where('c_licences.isMain', '=', 1)
                ->where('c_licences.isAdmin', '=', 1)
                ->select('c_licences.*', 'licence_list.name as licence_type')
                ->getList();
        }

        if (($company['company_type'] == 2) & ($isActive == 0)) {
            $licence = c_licences::getAll()
                ->leftJoin('licence_list', 'c_licences.licence_type', '=', 'licence_list.Licence_list_id')
                ->where('c_licences.company_id', '=', $company['company_id'])
                ->where('c_licences.status', '=', 1)
                ->where('c_licences.isMain', '=', 1)
                ->where('c_licences.isAdmin', '=', 1)
                ->orderBy($company['company_id'], 'DESC')
                ->select('c_licences.*', 'licence_list.name as licence_type')
                ->getList();
        }

        if ($licence['export']['recordsCount'] > 0) {
            return $licence['export']['list'][0];
        }

        return null;
    }

    private function getRealOrDraftCompanyPersonalityType($companyId, $status, $isActive)
    {
        $company = adminpersonality_typeModel::getAll()
            ->select('personality_type.type')
            ->leftJoin('company_d', 'company_d.personality_type', '=', 'personality_type.Personality_type_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return ['type' => 'حقیقی'];
        } else {
            return $company['export']['list'][0];
        }
    }

    private function getRealOrDraftCompanyAddress($companyId, $status, $isActive)
    {
        $company = adminc_addresses_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->where('isMain', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyBanner($companyId, $status, $isActive)
    {
        $company = adminc_banner_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyPhones($companyId, $status, $isActive)
    {
        $company = adminc_phones_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->where('isMain', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyHonour($companyId, $status, $isActive)
    {
        $company = adminc_honour_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyWebSites($companyId, $status, $isActive)
    {
        $company = adminc_websites_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyBusinessLicence($companyId, $status, $isActive)
    {
        $company = adminc_business_licence_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyCommercialName($companyId, $status, $isActive)
    {
        $company = adminc_commercial_name_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyEmails($companyId, $status, $isActive)
    {
        $company = adminc_emails_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyHistory($companyId, $status, $isActive)
    {
        $company = adminc_history_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyLogo($companyId, $status, $isActive)
    {
        $company = adminc_logo_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyNews($companyId, $status, $isActive)
    {
        $company = adminc_news_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyProducts($companyId, $status, $isActive)
    {
        $company = adminc_product_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanySocials($companyId, $status, $isActive)
    {
        $company = adminc_socials_dModel::getAll()
            ->where('company_id', '=', $companyId)
            ->where('status', '=', $status)
            ->where('isActive', '=', $isActive)
            ->where('isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->first();

        if (!is_object($company)) {
            return false;
        } else {
            return $company->fields;
        }
    }

    private function getRealOrDraftCompanyCities($companyId, $status, $isActive)
    {
        $company = admincompany_dModel::getAll()
            ->select('city.name as city', 'province.name as state')
            ->leftJoin('city', 'company_d.city_id', '=', 'city.City_id')
            ->leftJoin('province', 'company_d.state_id', '=', 'province.Province_id')
            ->where('company_d.company_id', '=', $companyId)
            ->where('company_d.status', '=', $status)
            ->where('company_d.isActive', '=', $isActive)
            ->where('company_d.isAdmin', '=', 1)
            ->orderBy($companyId, 'DESC')
            ->getList();

        if ($company['export']['recordsCount'] <= 0) {
            return false;
        } else {
            return $company['export']['list'][0];
        }
    }

    private function compareCompaniesDifference($realCompany, $draftCompany)
    {
        $realComNDraftComDiff = $realCompany;
        array_diff_assoc($realComNDraftComDiff, $draftCompany);

        return $realComNDraftComDiff;
    }

    public static function getAllCompanies()
    {
        $companyObject = new company();
        $companyList = $companyObject->join('c_emails')->on('c_emails.company_id', '=', 'company.company_id');

        if (!is_object($companyList)) {
            return 0;
        } else {
            return $companyList->getList();
        }
    }

    public function searchLock($fields)
    {
        $company = new admincompanyModel();
        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'company_type', 'dt' => $i++], ['db' => 'coordinator_family', 'dt' => $i++], ['db' => 'package_status', 'dt' => $i++], ['db' => 'expiredate', 'dt' => $i++], ['db' => 'status', 'dt' => $i++], ['db' => 'lock', 'dt' => $i++], ['db' => 'refresh_date', 'dt' => $i++], ['db' => 'logo_image', 'dt' => $i++], ['db' => 'logo_image', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();
        //print_r_debug($searchFields);
        //$result = $company->getCompany($searchFields);

        ///////////////////////////////////////////////////////////////////////
        $lock = 'lock';
        $query = $company->getQuery($lock);

        $result = $company->getByFilter($searchFields, $query);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($result['result'] != 1) {
            $this->fileName = 'admin.company.showCompanyBlock.php';
            $this->template($result['export']['list'], $result['msg']);
            die();
        }

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '';

                if ($list['company_type'] == '1') {
                    $st .= $list['company_type'] = 'حقوقی';
                } else {
                    $st .= $list['company_type'] = 'حقیقی';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['4'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="" class="company_phone">';
                if ($list['package_status'] == '1') {
                    $st .= $list['package_status'] = 'رایگان';
                } else {
                    $st .= $list['package_status'] = 'تجاری';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['5'] = [
            'formatter' => function ($list) {
                if ($list['package_status'] == '4') {
                    $st = convertDate($list['expiredate']);
                }

                return $st;
            },
        ];

        $other['6'] = [
            'formatter' => function ($list) {
                if ($list['status'] == 1) {
                    $st = 'فعال';
                } else {
                    $st = 'غیر فعال';
                }

                return $st;
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                $st = $list['editor_id'];

                return $st;
            },
        ];

        $other['8'] = [
            'formatter' => function ($list) {
                $st = convertDate($list['refresh_date']);

                return $st;
            },
        ];

        $other['9'] = [
            'formatter' => function ($list) {
                if (strlen($list['image']) > 0) {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        COMPANY_ADDRESS .
                        $list['Company_id'] .
                        '/logo/' .
                        $list['image'] .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                } else {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        DEFULT_LOGO_ADDRESS .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                }

                return $st;
            },
        ];

        $internalVariable['showstatus'] = $fields['status'];
        $other['10'] = [
            'formatter' => function ($list, $internal) {
                $st = 'a' . $list['showstatus'];
                if ($list['package_status'] == '4') {
                    $st =
                        '<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=edit&id=' .
                        $list['Company_id'] .
                        '&showStatus=' .
                        $internal['showstatus'] .
                        '">ویرایش</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=delete&id=' .
                        $list['Company_id'] .
                        '">حذف</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=sendNewPass&id=' .
                        $list['Company_id'] .
                        '">ارسال نام کاربری و کلمه عبور</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=editUserPass&id=' .
                        $list['Company_id'] .
                        '">تغییر نام کاربری و کلمه عبور</a></li>
                            <li><a target="_blank" href="' .
                        RELA_DIR .
                        'admin/?component=login&action=loginAs&id=' .
                        $list['Company_id'] .
                        '">ورود به کمپانی</li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=product&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=history&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">سوابق</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyCommercialName&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">نام تجاری</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=honour&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">افتخارات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyNews&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">اخبار</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=branch&company_id=' .
                        $list['Company_id'] .
                        '">شعبه و نمایندگی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAdvertise&action=showList&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آگهی ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=employment&action=showList&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">فرصت های شغلی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAddresses&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyPhones&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyEmails&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">پست الکترونیک</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyWebsites&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">وب سایت ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companySocials&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">شبکه های اجتماعی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=licence&action=addLicence&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">مجوزها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyBanner&action=add&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">بنر</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyLogo&action=add&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">لوگو</a></li>
                          </ul>
                        </div>';
                    //
                } else {
                    $st =
                        '<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=edit&id=' .
                        $list['Company_id'] .
                        '&showStatus=' .
                        $internal['showstatus'] .
                        '">ویرایش</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=delete&id=' .
                        $list['Company_id'] .
                        '">حذف</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=product&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyLogo&action=add&id=' .
                        $list['Company_id'] .
                        '  ">لوگو</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAddresses&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyPhones&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=licence&action=addLicence&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">مجوزها</a></li>
                          </ul>
                        </div>';
                }

                return $st;
            },
        ];
        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function searchLockById($fields)
    {
        $company = new admincompanyModel();
        include_once ROOT_DIR . 'model/datatable.converter.php';

        $i = 0;

        $columns = [['db' => 'Company_id', 'dt' => $i++], ['db' => 'company_name', 'dt' => $i++], ['db' => 'company_type', 'dt' => $i++], ['db' => 'coordinator_family', 'dt' => $i++], ['db' => 'package_status', 'dt' => $i++], ['db' => 'expiredate', 'dt' => $i++], ['db' => 'status', 'dt' => $i++], ['db' => 'lock', 'dt' => $i++], ['db' => 'refresh_date', 'dt' => $i++]];

        $convert = new convertDatatableIO();
        $convert->input = $fields;
        $convert->columns = $columns;

        $searchFields = $convert->convertInput();

        //$result = $company->getCompany($searchFields);

        ///////////////////////////////////////////////////////////////////////
        $lock = 'lockById';
        $query = $company->getQuery($lock);

        $result = $company->getByFilter($searchFields, $query);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        if ($result['result'] != 1) {
            $this->fileName = 'admin.company.showCompanyBlock.php';
            $this->template($result['export']['list'], $result['msg']);
            die();
        }

        $list['list'] = $result['export']['list'];
        $list['paging'] = $result['export']['recordsCount'];

        $other['2'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id = "" class="company_phone">';

                if ($list['company_type'] == '1') {
                    $st .= $list['company_type'] = 'حقوقی';
                } else {
                    $st .= $list['company_type'] = 'حقیقی';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['4'] = [
            'formatter' => function ($list) {
                $st = '<div data-company_id="" class="company_phone">';
                if ($list['package_status'] == '1') {
                    $st .= $list['package_status'] = 'رایگان';
                } else {
                    $st .= $list['package_status'] = 'تجاری';
                }

                $st .= '</div>';

                return $st;
            },
        ];

        $other['5'] = [
            'formatter' => function ($list) {
                if ($list['package_status'] == '4') {
                    $st = convertDate($list['expiredate']);
                }

                return $st;
            },
        ];
        $other['6'] = [
            'formatter' => function ($list) {
                if ($list['status'] == 1) {
                    $st = 'فعال';
                } else {
                    $st = 'غیر فعال';
                }

                return $st;
            },
        ];

        $other['7'] = [
            'formatter' => function ($list) {
                $st = $list['editor_id'];

                return $st;
            },
        ];

        $other['8'] = [
            'formatter' => function ($list) {
                $st = convertDate($list['refresh_date']);

                return $st;
            },
        ];

        $other['9'] = [
            'formatter' => function ($list) {
                if (strlen($list['image']) > 0) {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        COMPANY_ADDRESS .
                        $list['Company_id'] .
                        '/logo/' .
                        $list['image'] .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                } else {
                    $st =
                        '<div data-company_id="' .
                        $list['Company_id'] .
                        '" class="company_phone">
                    <img src="' .
                        DEFULT_LOGO_ADDRESS .
                        '" class="img-responsive img-thumbnail" alt="محل نمایش لوگو" style="width:70px">
                </div>';
                }

                return $st;
            },
        ];

        $internalVariable['showstatus'] = $fields['status'];
        $other['10'] = [
            'formatter' => function ($list, $internal) {
                $st = 'a' . $list['showstatus'];
                if ($list['package_status'] == '4') {
                    $st =
                        '<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=edit&id=' .
                        $list['Company_id'] .
                        '&showStatus=' .
                        $internal['showstatus'] .
                        '">ویرایش</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=delete&id=' .
                        $list['Company_id'] .
                        '">حذف</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=sendNewPass&id=' .
                        $list['Company_id'] .
                        '">ارسال نام کاربری و کلمه عبور</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=editUserPass&id=' .
                        $list['Company_id'] .
                        '">تغییر نام کاربری و کلمه عبور</a></li>
                            <li><a target="_blank" href="' .
                        RELA_DIR .
                        'admin/?component=login&action=loginAs&id=' .
                        $list['Company_id'] .
                        '">ورود به کمپانی</li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=product&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=history&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">سوابق</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyCommercialName&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">نام تجاری</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=honour&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">افتخارات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyNews&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">اخبار</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=branch&company_id=' .
                        $list['Company_id'] .
                        '">شعبه و نمایندگی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAdvertise&action=showList&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آگهی ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=employment&action=showList&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">فرصت های شغلی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAddresses&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyPhones&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyEmails&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">پست الکترونیک</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyWebsites&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">وب سایت ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companySocials&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">شبکه های اجتماعی</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=licence&action=addLicence&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">مجوزها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyBanner&action=add&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">بنر</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyLogo&action=add&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">لوگو</a></li>
                          </ul>
                        </div>';
                } else {
                    $st =
                        '<div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=edit&id=' .
                        $list['Company_id'] .
                        '&showStatus=' .
                        $internal['showstatus'] .
                        '">ویرایش</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=company&action=delete&id=' .
                        $list['Company_id'] .
                        '">حذف</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=product&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">محصولات</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyAddresses&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">آدرس ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=companyPhones&company_id=' .
                        $list['Company_id'] .
                        '&branch_id=0">تلفن ها</a></li>
                            <li><a href="' .
                        RELA_DIR .
                        'admin/?component=licence&action=addLicence&id=' .
                        $list['Company_id'] .
                        '&branch_id=0">مجوزها</a></li>
                          </ul>
                        </div>';
                }

                return $st;
            },
        ];
        $export = $convert->convertOutput($list, $columns, $other, $internalVariable);
        echo json_encode($export);
        die();
    }

    public function showLockById($input = '', $msg = '')
    {
        $export['status'] = 'showAll';
        $this->fileName = 'admin.companylock.showList.php';
        $this->template($export);
        die();
    }

    public function showCompanyEditForm($fields = '', $msg)
    {
        $export = [];
        if (isset($fields['newCompany']) and $fields['newCompany'] == '1') {
            $companyObject = admincompanyModel::find($fields['company_id']);
            $export['newCompany'] = '1';
            $export['actionForm'] = 'action="?component=company&action=edit"';
        } else {
            $companyObject = admincompanyModel::find($fields['Company_id']);
            $export['action'] = '';
        }

        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        if ($companyObject->company_type == '1' and $companyObject->package_status == '1') {
            $this->fileName = 'admin.companyLegalFree.editForm.php';
        } elseif ($companyObject->company_type == '2' and $companyObject->package_status == '1') {
            $this->fileName = 'admin.companyRealFree.editForm.php';
        }

        if ($companyObject->company_type == '1' and $companyObject->package_status == '4') {
            $this->fileName = 'admin.companyLegal.editForm.php';
        } elseif ($companyObject->company_type == '2' and $companyObject->package_status == '4') {
            $this->fileName = 'admin.companyReal.editForm.php';
        }

        //Get all Member Information
        include_once ROOT_DIR . 'component/login/admin/model/admin.login.controller.php';

        if ($companyObject->package_status == '4') {
            $memberObject = new adminLoginController();
            $resultObject = $memberObject->getMemberObject($fields['Company_id']);
            $export['memberInfo']['name'] = $resultObject->name;
            $export['memberInfo']['family'] = $resultObject->family;
            $export['memberInfo']['email'] = $resultObject->email;
            $export['memberInfo']['mobile'] = $resultObject->mobile;
        } else {
            //------> get Company_d_id
            $companyDraftObject = admincompany_dModel::getBy_company_id_and_status_and_isActive_and_new_register($companyObject->Company_id, 1, 1, 0)->first();

            $memberObject = new adminEditorMemberController();
            $resultMember = $memberObject->getMemberInformationById($companyDraftObject->Company_d_id);

            $export['editorInfo']['editor_name'] = $resultMember->name;
            $export['editorInfo']['editor_family'] = $resultMember->family;
            $export['editorInfo']['editor_phone'] = $resultMember->phone;
        }

        $LicenceResult = adminc_licencesModel::getBy_company_id_and_isActive($fields['Company_id'], '1')->getList();
        if ($LicenceResult['export']['recordsCount'] > 0) {
            $export['licenceInfo'] = $LicenceResult['export']['list']['0'];
            $export['licenceInfo']['issuence_date'] = convertDate($export['licenceInfo']['issuence_date']);
            $export['licenceInfo']['expiration_date'] = convertDate($export['licenceInfo']['expiration_date']);
        }

        //Get all category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $export['category'] = $resultCategory;

        //Get all Log
        $log = new adminLogController();
        $resultLog = $log->getLog($fields);
        $export['logInfo'] = $resultLog['export']['list'];

        //Get all City
        include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }

        //Get all State
        include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
        $state = new adminStateModel();
        $resultState = $state->getStates();
        if ($resultState['result'] == 1) {
            $export['states'] = $resultState['export']['list'];
        }

        //Get All personalityType
        include_once ROOT_DIR . 'component/personalityType/admin/model/admin.personalityType.controller.php';
        $personalityType = new adminPersonalityTypeController();
        $resultPersonalityType = $personalityType->getPersonalityType();
        if ($resultPersonalityType['result'] == 1) {
            $export['personalityType'] = $resultPersonalityType['export']['list'];
        }

        //Get All Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $resultLicence = $licence->getLicenceAjax('notAll');
        if ($resultLicence['result'] == 1) {
            $export['licence'] = $resultLicence['export']['list'];
        }

        //Get phone
        $phoneResult = adminc_phonesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($phoneResult['export']['recordsCount'] > 0) {
            $export['phoneInfo'] = $phoneResult['export']['list']['0'];
        }

        //Get addresses
        $addressResult = adminc_addressesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($addressResult['export']['recordsCount'] > 0) {
            $export['addressInfo'] = $addressResult['export']['list']['0'];
        }

        //Get websites
        $websiteResult = adminc_websitesModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($websiteResult['export']['recordsCount'] > 0) {
            $export['websiteInfo'] = $websiteResult['export']['list']['0'];
        }

        //Get Emails
        $emailResult = adminc_emailsModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($emailResult['export']['recordsCount'] > 0) {
            $export['emailInfo'] = $emailResult['export']['list']['0'];
        }

        //Get Logo
        $logoResult = adminc_logoModel::getBy_company_id($companyObject->Company_id)->getList();
        if ($logoResult['export']['recordsCount'] > 0) {
            $export['logoInfo'] = $logoResult['export']['list']['0'];
        }

        //Get PackageUsage
        include_once ROOT_DIR . 'component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageUsageObject = new adminPackageUsageController();
        $resultPackageUsage = $packageUsageObject->getPackageByCompanyID($companyObject->Company_id);

        if (is_object($resultPackageUsage)) {
            $export['packageUsage'] = $resultPackageUsage->fields;
        }

        $showStatus = $fields['showStatus'];
        $export['companyInfo'] = $companyObject->fields;
        if ($companyObject->registration_date != '0000-00-00 00:00:00') {
            $export['companyInfo']['registration_date'] = convertDate($companyObject->registration_date);
        }
        $export['companyInfo']['category_id'] = trim($companyObject->category_id, ',');
        $export['showStatus'] = $showStatus;

        // marjani
        // $this->lockCompany($export['companyInfo']);

        $this->template($export, $msg);
        die();
    }

    public function lockCompany($input)
    {
        global $admin_info;
        $member_id = $admin_info['admin_id'];
        $companyObject = admincompanyModel::find($input['Company_id']);

        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $companyObject->lock = $member_id;
        $companyObject->save();
        $result['result'] = 1;

        return $result;
    }

    public function unlockCompany($company_id)
    {
        $companyObject = admincompanyModel::find($company_id);
        if (!is_object($companyObject)) {
            $msg = 'تولیدی مورد نظر در پایگاه داده وجود ندارد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        }

        $companyObject->lock = '0';
        $companyObject->save();
        $result['result'] = 1;

        return $result;
    }

    public function getData($company_id)
    {
        $company = new adminCompanyController();
        $realCompany = $company->getRealOrDraftCompanyInformation($company_id, 1, 1);
        $draftCompany = $company->getRealOrDraftCompanyInformation($company_id, 1, 0);
        $companyList['realCompany'] = $realCompany;
        $companyList['draftCompany'] = $draftCompany;

        return $companyList;
    }

    public function categoryEdit()
    {
        $parentCategory = category::getBy_parent_id('0')->getList();
        $parentCategory = $parentCategory['export']['list'];

        $companyResult = admincompanyModel::getAll()->getList();
        $companyResult = $companyResult['export']['list'];

        foreach ($companyResult as $key => $value) {
            $categoryResult = tagToArray($value['category_id']);
            $categoryResult = $categoryResult['export']['list'];

            // print_r_debug($parentCategory);
            $input[$value['Company_id']]['0'] = $categoryResult;
            for ($i = 0; $i <= count($parentCategory); $i++) {
                for ($j = 0; $j <= count($categoryResult); $j++) {
                    if ($parentCategory[$i]['Category_id'] == $categoryResult[$j]) {
                        $correctCategory[] = $categoryResult[$j];
                        unset($categoryResult[$j]);
                    }
                }
            }

            $input[$value['Company_id']]['1'] = $correctCategory;
            $input[$value['Company_id']]['2'] = $categoryResult;

            $this->companyNewCategoryEdit($input);
            $correctCategory = '';
        }

        //        print_r_debug($input);
        return 1;
    }

    /**
     * this method get category find for parent id
     *
     * @param input
     * @return array
     * @Email m.sakhamanesh@googlemail.com
     * @date 2017/10/14
     * @author vahed and sakhamanesh
     */
    public function getParentIdCategory($input)
    {
        if (empty($input)) {
            return false;
        }

        if (is_array($input['category_id'])) {
            $categories = $input['category_id'];
        } else {
            $categories = explode(',', trim($input['category_id'], ','));
        }

        $categories = array_filter($categories, 'strlen');

        if (count($categories) == 0) {
            return false;
        }

        require_once ROOT_DIR . 'component/category/member/model/member.category.model.php';
        $parentCategoryArray = [];

        foreach ($categories as $key => $category) {
            $categoryObj = category::find($category);
            $grandFatherCategory = category::find($categoryObj->parent_id);
            if (!in_array($categoryObj->parent_id, $parentCategoryArray)) {
                $parentCategoryArray[] = $categoryObj->parent_id;
            }
            if (!in_array($grandFatherCategory->parent_id, $parentCategoryArray)) {
                $parentCategoryArray[] = $grandFatherCategory->parent_id;
            }
        }
        $parentCategoryArray['parent_category_id'] = arrayToTag($parentCategoryArray)['export']['list'];
        $parentCategoryArray['category_id'] = arrayToTag($categories)['export']['list'];
        return $parentCategoryArray;

        /*
                foreach ($categories as $key => $category) {
                    $companyObject = category::find($category);
                    $result['parent_category_id'][] = $companyObject->parent_id;
                    $result['category_id'][] = $category;
                }


                $result['parent_category_id'] = array_unique($result['parent_category_id']);

                $result['parent_category_id'] = arrayToTag($result['parent_category_id'])['export']['list'];

                $result['category_id'] = arrayToTag($result['category_id'])['export']['list'];
                print_r_debug($result);

                return $result;*/
    }

    public function getPackage($company_id)
    {
        $packageResult = adminInvoiceModel::getAll()
            ->leftJoin('package', 'invoice.package_id', '=', 'package.Package_id')
            ->where('invoice.company_id', '=', $company_id)
            ->getList();

        return $packageResult;
    }

    public function deleteCompanyWithAllInformation($company_id)
    {
        $company = adminCompanyModel::find($company_id);
        if (!is_object($company)) {
            $msg = 'رکورد مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
            die();
        }

        //------> delete Phones
        $phone = new admincompany_phonesController();
        $phone->deleteAllPhoneByCompanyId($company_id);

        //------> delete Email
        include_once ROOT_DIR . 'component/companyEmails/admin/model/admin.companyEmails.controller.php';
        $email = new admincompany_EmailsController();
        $email->deleteAllEmailByCompanyId($company_id);

        //------> delete address
        include_once ROOT_DIR . 'component/companyAddresses/admin/model/admin.companyAddresses.controller.php';
        $address = new admincompany_addressesController();
        $address->deleteAllAddressByCompanyId($company_id);

        //------> delete website
        include_once ROOT_DIR . 'component/companyWebsites/admin/model/admin.companyWebsites.controller.php';
        $website = new admincompany_websitesController();
        $website->deleteAllWebsiteByCompanyId($company_id);

        //------> delete Licence
        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $licence = new adminlicenceController();
        $licence->deleteAllLicenceByCompanyId($company_id);

        //------> delete product
        include_once ROOT_DIR . '/component/product/admin/model/admin.product.controller.php';
        $product = new adminProductController();
        $product->deleteAllProductByCompanyId($company_id);

        //------> delete banner
        include_once ROOT_DIR . '/component/companyBanner/admin/model/admin.companyBanner.controller.php';
        $banner = new admincompany_bannerController();
        $banner->deleteAllBannerByCompanyId($company_id);

        //------> delete branch
        include_once ROOT_DIR . '/component/branch/admin/model/admin.branch.controller.php';
        $branch = new branchController();
        $branch->deleteAllBranchByCompanyId($company_id);

        //------> delete business_licence
        include_once ROOT_DIR . '/component/businessLicence/admin/model/admin.businessLicence.controller.php';
        $businessLicence = new adminBusinessLicenceController();
        $businessLicence->deleteAllBusinessLicenceByCompanyId($company_id);

        //------> delete certification
        include_once ROOT_DIR . '/component/certification/admin/model/admin.certification.controller.php';
        $certification = new adminCertificationController();
        $certification->deleteAllCertificationByCompanyId($company_id);

        //------> delete commercial_name
        include_once ROOT_DIR . '/component/companyCommercialName/admin/model/admin.companyCommercialName.controller.php';
        $commercialName = new admincompany_commercial_nameController();
        $commercialName->deleteAllCommercialNameByCompanyId($company_id);

        //------> delete contacts
        include_once ROOT_DIR . '/component/companyContacts/admin/model/admin.companyContactUs.controller.php';
        $contact = new adminContactsController();
        $contact->deleteAllContactByCompanyId($company_id);

        //------> delete employment
        include_once ROOT_DIR . '/component/employment/admin/AdminEmploymentController.php';
        $employment = new AdminEmploymentController();
        $employment->deleteAllEmploymentByCompanyId($company_id);

        //------> delete history
        include_once ROOT_DIR . '/component/history/admin/model/admin.history.controller.php';
        $history = new adminHistoryController();
        $history->deleteAllHistoryByCompanyId($company_id);

        //------> delete honour
        include_once ROOT_DIR . '/component/honour/admin/model/admin.honour.controller.php';
        $honour = new adminHonourController();
        $honour->deleteAllHonourByCompanyId($company_id);

        //------> delete logo
        include_once ROOT_DIR . '/component/companyLogo/admin/model/admin.companyLogo.controller.php';
        $logo = new admincompany_logoController();
        $logo->deleteAllLogoByCompanyId($company_id);

        //------> delete news
        include_once ROOT_DIR . '/component/companyNews/admin/model/admin.companyNews.controller.php';
        $news = new admincompany_newsController();
        $news->deleteAllNewsByCompanyId($company_id);

        //------> delete position
        include_once ROOT_DIR . '/component/companyPositions/admin/model/admin.companyPosition.controller.php';
        $position = new positionController();
        $position->deleteAllPositionByCompanyId($company_id);

        //------> delete representation
        include_once ROOT_DIR . '/component/representation/member/model/representation.controller.php';
        $representation = new representationController();
        $representation->deleteAllRepresentationByCompanyId($company_id);

        //------> delete social
        include_once ROOT_DIR . '/component/companySocials/admin/model/admin.companySocials.controller.php';
        $social = new adminCompanySocialController();
        $social->deleteAllSocialByCompanyId($company_id);

        //------> delete editor_member
        include_once ROOT_DIR . '/component/editorMember/admin/model/admin.editorMember.controller.php';
        $editor = new adminEditorMemberController();
        $editor->deleteAllEditorMemebrByCompanyId($company_id);

        //------> delete packageUsage
        include_once ROOT_DIR . '/component/packageUsage/admin/model/admin.packageUsage.controller.php';
        $packageusage = new adminPackageUsageController();
        $packageusage->deleteAllPackageUsageByCompanyId($company_id);

        //------> delete member
        include_once ROOT_DIR . '/component/login/model/login.controller.php';
        $member = new loginController();
        $member->deleteAllMemberByCompanyId($company_id);

        //------> delete invoice
        include_once ROOT_DIR . '/component/invoice/admin/model/admin.invoice.controller.php';
        $invoice = new adminInvoiceController();
        $invoice->deleteAllInvoiceByCompanyId($company_id);

        //------> delete company_d
        $company_ds = admincompany_dModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($company_ds['export']['recordsCount'] > 0) {
            foreach ($company_ds['export']['list'] as $company_d) {
                $company_d->delete();
            }
        }

        //-------------------------------------

        $company->category()->detach();

        //-------------------------------------
        //------> delete company
        $company->delete();

        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'admin/index.php?component=company', $msg);
        die();
    }

    public function convertToEnglish()
    {
        $resultCompany = admincompanyModel::getAll()->get();
        foreach ($resultCompany['export']['list'] as $key => $value) {
            $value->registration_number = $this->convertToEnglish($value->registration_number);
            $value->national_id = $this->convertToEnglish($value->national_id);
            $value->save();
        }
    }

    public function sendSMS($company_id)
    {
        $msg = "سلام، لطفا جهت تکمیل ثبت نام نسبت به پراخت فاکتور اقدام فرمایید.
با تشکر
مرجع اطلاعات تولیدات
www.tolidat.ir";

        $user = members::getAll()
            ->where('company_id', '=', $company_id)
            ->first();

        if (is_object($user)) {
            sendSMS($user->mobile, $msg);
        }

        redirectPage(RELA_DIR . 'admin/?component=company&action=showNewCompany', 'sms ارسال شد');
    }

    public function showDetail($company_id)
    {
        $company = new admincompanyModel();

        $result = $company->getCompanyById($company_id);

        $export = $result['export']['list'];

        $packageUsage = packageusage::getAll()
            ->where('company_id', '=', $company_id)
            ->first();
        if (is_object($packageUsage)) {
            $export['packageusage'] = $packageUsage;
        }
        // dd($packageUsage);

        // $fields['appendWhere'] = " WHERE  `company`.`Company_id` = '".$company_id."'";

        // $result = $company->getCompany($fields);

        $this->fileName = 'admin.company.showDetail.php';

        $this->template($export);
        die();
    }

    public function checkNationalIdCount($nationalId)
    {
        global $messageStack;
        if (strlen($nationalId) > 11) {
            return false;
        } elseif (strlen($nationalId) <= 11) {
            return true;
        }
    }
}
