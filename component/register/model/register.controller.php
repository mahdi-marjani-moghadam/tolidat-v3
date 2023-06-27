<?php

include_once dirname(__FILE__) . '/register.model.php';
include_once dirname(__FILE__) . '/stepForm.php';
include_once ROOT_DIR . 'model/mail.class.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
require_once ROOT_DIR . "component/personalityType/model/personalityType.controller.php";
require_once ROOT_DIR . "component/province/model/province.controller.php";
require_once ROOT_DIR . "component/city/model/city.controller.php";
require_once ROOT_DIR . "component/companyWebsites/model/companyWebsites.model.php";
require_once ROOT_DIR . "component/login/model/login.controller.php";
require_once ROOT_DIR . "component/licence/member/model/licence.controller.php";
require_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
require_once ROOT_DIR . "component/blackWhite/model/blackWhite.controller.php";
require_once ROOT_DIR . "component/index/model/index.controller.php";
require_once ROOT_DIR . "component/editorMember/model/editorMember.model.php";
require_once ROOT_DIR . "component/package/member/model/package.model.php";
require_once ROOT_DIR . "component/invoice/model/Invoice.php";
include_once ROOT_DIR . 'services/uploader/Uploader.php';


/**
 * Class registerController.
 */
class registerController
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

    /**
     * @var int|mixed
     */
    private $company_info;


    /**
     * registerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;

        if ($this->company_info != -1) {
            redirectPage(RELA_DIR . '404');
        }

        $this->exportType = 'html';
    }

    /**
     * @param array|string $list
     * @param $msg
     * @return string
     */
    public function template($list = [], $msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
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

    /**
     * add register.
     * @param $_input
     * @return int|mixed
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function getRegisterType($_input)
    {
        if (empty($_input) || $_input['company_type'] == 1 || $_input['step'] == 1) {
            return 'registerLegalStep';
        } else {
            return 'registerRealStep';
        }
    }

    /**
     * @param $_input
     */
    public function showRegisterForm($_input)
    {
        // dd($_input);
        $_input['company_type'] = $_input['company_type'] ?? 1;
        $_input['step'] = $_input['step'] ?? 2;

        if (!empty($_input)) {
            foreach ($_input as $key => $value) {
                $_input[$key] = convertToEnglish($value);
            }
        }
        $registerType = $this->getRegisterType($_input); // registerLegalStep or registerRealStep

        $stepForm = stepForm::object('step', 7);
        $stepForm->setTemplate($registerType);

        if (isset($_input['step'])) {

            if ($_input['step'] > $stepForm->getStep()) {
                $stepForm->setData($_input);
            }
            $stepForm->setStep($_input['step']);
        }
        // unset($_SESSION['step']);

        $stepForm->save();
        // dd(unserialize($_SESSION['step']));

        //    dd($stepForm);
        // dd($_input);
        // dd($stepForm);
        switch ($_input['step']) {
            case 2:
                // 

                $export = $this->stepTwo($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۲';
                break;

            case 3:
                // send token sms step


                // create lead
                include_once ROOT_DIR . "services/crm/LeadTaskService.php";
                include_once ROOT_DIR . "services/crm/LeadService.php";
                include_once ROOT_DIR . "component/crm/leadController.php";

                $leadController = new leadController(new LeadService(), new LeadTaskService());

                $lead = $leadController->storeApi([
                    'phone' => $stepForm->data[2]['phone'],
                    'mobile' => $stepForm->data[2]['phone'],
                    'company_name' => $stepForm->data[2]['name'] . ' ' . $stepForm->data[2]['family'],
                    'company_type' => $stepForm->data[1]['company_type'],
                    'name' => $stepForm->data[2]['name'],
                    'register' => True
                ]);


                $export = $this->stepThree($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۳';
                break;

            case 4:
                
                // company info ,licence, national_id
                $export = $this->stepFour($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۴';
                break;

            case 5:
                // city, address, phone, site, logo, category
                $export = $this->stepFive($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۵';
                break;

            case 6:
                // package
                $export = $this->stepSix($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۶';
                break;

            case 7:
                // company hr info, company username, password
                $export = $this->stepSeven($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۷';
                break;

            case 8:
                // finish register -> redirect to invoice
                $export = $this->stepEight($stepForm, $_input);
                $export['seo']['title'] = ' ثبت نام، مرحله ۸';
                break;

            default:
                // set step 1 in $stepForm
                $export = $this->stepOne($stepForm);
                $export['seo']['title'] = ' ثبت نام، مرحله اول';
                break;
        }
        // dd($stepForm);
        $this->showTemplate($stepForm, $export);
    }

    public function stepOne($stepForm)
    {
        $stepForm->setStep(1);
        $stepForm->save();
        return;
    }

    public function stepTwo($stepForm, $_input)
    {
        if (isset($stepForm->data['1'])) {
            $errors = $this->validateStepOne($stepForm->data['1']);
        }

        if ($errors['result'] == -1) {
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->setTemplate('registerLegalStep');
            $stepForm->save();
            $export['validate'] = $errors;
        }

        return $export;
    }

    public function stepThree($stepForm, $_input)
    {

        // check and validate step 2
        if (isset($stepForm->data['2'])) {

            if ($stepForm->data['1']['company_type'] == 1) {
                $errors = $this->validateStepTwoLegal($stepForm->data['2']);
            } else {
                $errors = $this->validateStepTwoReal($stepForm->data['2']);
                if (!empty($errors)) {
                    $stepForm->setTemplate('registerRealStep');
                }
            }
        }
        
        // dd($errors);
        if (!empty($errors)) {
            // dd('22222');
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->save();
            $export['validate'] = $errors;
        } else {

            // dd(1);
            $_input['wiki'] = 0;
            $_input['register'] = 0;

            // dd($stepForm->sendToken);
            if (!isset($stepForm->sendToken)) {
                // dd('send token');
                $stepForm->sendToken = $this->sendToken($_input);
                // dd(2);
                $stepForm->save();
            } else {
                $token = decrypt($stepForm->sendToken, 1212) / 5664;
                $register = send_token::find($token);
                // dd($register);
                // send sms when send_token fill
                if (is_object($register)) {
                    // dd($register->phone.' '.$stepForm->data[2]['phone']);
                    if ($register->phone != $stepForm->data[2]['phone']) {
                        $register->key = $this->generateCode();
                        $register->phone = $stepForm->data[2]['phone'];
                        $register->save();
                        $this->sendTokenTo($_input, $register->key);
                    }
                }
            }
        }

        return $export;
    }

    public function stepFour($stepForm, $_input)
    {
        $this->checkStep($stepForm);
        // dd($stepForm->sendToken);

        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $sendToken = send_token::find($token);
        
        $registerType = $this->getRegisterType($_input);
        // dd($sendToken->key.'='.strtoupper(convertToEnglish($stepForm->data['3']['token'])));
        // dd(($stepForm));
        // dd($sendToken->key != strtoupper(convertToEnglish($stepForm->data['3']['token'])));
        if ($sendToken->key != strtoupper(convertToEnglish($stepForm->data['3']['registration_number']))) {

            $export['msg'] = "کد فعال سازی اشتباه است";
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->setTemplate('registerLegalStep');
            $stepForm->save();
        } else if ($registerType == 'registerLegalStep') {
           
            if (!isset($stepForm->data['4'])) {
                $export['data'] = $this->getCompanyInformation($stepForm);
            }

            if (!empty($stepForm->data['licence'])) {
                $export['licence'] = $stepForm->data['licence'];
                $export['licence']['licence_name'] = empty($export['licence']['licence_type_name']) ?
                    $this->getLiceceName($export['licence']['licence_type']) : $export['licence']['licence_type_name'];
            }
            
        } else if ($registerType == 'registerRealStep') {
            if (!isset($stepForm->data['4'])) {
                $export['data'] = $this->getLicenceInformation($stepForm);
            }
        }
        return $export;
    }

    public function stepFive($stepForm, $_input)
    {
        $this->checkStep($stepForm);

        // if (isset($stepForm->data['4'])) {
        //     if ($stepForm->data['1']['company_type'] == 1) {
        //         $errors = $this->validateStepFourLegal($stepForm->data['4']);
        //     } else {
        //         $errors = $this->validateStepFourReal($stepForm->data['4']);
        //         if (!empty($errors)) {
        //             $stepForm->setTemplate('registerRealStep');
        //         }
        //     }
        // }

        
        if (!empty($errors)) {
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->save();
            $export['validate'] = $errors;
        } else {
            if (!isset($stepForm->data['5'])) {
                $export['data'] = $this->getCompanyInformation($stepForm);
                $export['data']['address'] = $this->getAddress($stepForm);
                $phone = $this->getPhone($stepForm);
                $export['data']['phone'] = $phone->number;
                $export['data']['code'] = $phone->code;
                $export['data']['reference_type'] = $phone->reference_type;
                $export['data']['reference_value'] = $phone->reference_value;
            }
        }

        return $export;
    }

    public function stepSix($stepForm, $_input)
    {
        $this->checkStep($stepForm);

        // if (isset($stepForm->data['5'])) {
        //     $errors = $this->validateStepFive($stepForm->data['5']);
        // }

        if (!empty($errors)) {
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->data['5']['image-logo'] = '';
            $stepForm->save();
            $export['validate'] = $errors;
        }

        return $export;
    }

    public function stepSeven($stepForm, $_input)
    {
        $this->checkStep($stepForm);

        if (isset($stepForm->data['6'])) {
            $package_type = $this->validateStepSix($stepForm->data['6']);
        }

        if (is_null($package_type)) {
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->save();
            $export['validate']['msg'] = "اطفا یکی از پکیج ها رو انتخاب کنید";
        }


        if ($package_type == 0 & isset($stepForm->data['6'])) {
            if ($stepForm->data['1']['company_type'] == 1) {

                $company = $this->addToCompany($stepForm);
                $this->addToAddress($stepForm, $company);

                $this->addToPhone($stepForm, $company);

                if (!empty($stepForm->data['5']['website'])) {
                    $this->addToWebsites($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['email'])) {
                    $this->addToEmail($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['imageCropped'])) {
                    $this->addToLogo($stepForm, $company);
                }
                $this->addLicenceForLegal($stepForm, $company);


                $this->addToEditorMember($stepForm, $company);
            } else {
                $company = $this->addToCompany($stepForm);
                $this->addToLicence($stepForm, $company);
                $this->addToAddress($stepForm, $company);
                $this->addToPhone($stepForm, $company);
                if (!empty($stepForm->data['5']['website'])) {
                    $this->addToWebsites($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['email'])) {
                    $this->addToEmail($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['imageCropped'])) {
                    $this->addToLogo($stepForm, $company);
                }
                $this->addToEditorMember($stepForm, $company);
            }

            session_unset();
            $_SESSION['message'] = "ثبت نام با موفقیت انجام شد";
            redirectPage(RELA_DIR . "register/final");
            die();
        }


        return $export;
    }

    public function stepEight($stepForm, $_input)
    {
        $this->checkStep($stepForm);


        // var_dump(array_key_exists(7,$stepForm->data)); die();

        // $stepForm->data['7']['username'] = 'mahdimarjani21';

        // if (array_key_exists(7, $stepForm->data) &&  isset($stepForm->data[7])) {
        //     $errors = $this->validateStepSeven($stepForm->data['7']);
        // }
        
        if (!$errors) {


            if ($stepForm->data['1']['company_type'] == 1) { // Legal

                $company = $this->addToCompany($stepForm);

                $this->addToAddress($stepForm, $company);
                $this->addToPhone($stepForm, $company);
                if (!empty($stepForm->data['5']['website'])) {
                    $this->addToWebsites($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['email'])) {
                    $this->addToEmail($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['imageCropped'])) {
                    $this->addToLogo($stepForm, $company);
                }
                $member = $this->addToMembers($stepForm, $company);
                $this->addToInvoice($stepForm, $company);
                $this->addLicenceForLegal($stepForm, $company);
            } else { // Real

                $company = $this->addToCompany($stepForm);
                $this->addToLicence($stepForm, $company);
                $this->addToAddress($stepForm, $company);
                $this->addToPhone($stepForm, $company);
                if (!empty($stepForm->data['5']['website'])) {
                    $this->addToWebsites($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['email'])) {
                    $this->addToEmail($stepForm, $company);
                }
                if (!empty($stepForm->data['5']['imageCropped'])) {
                    $this->addToLogo($stepForm, $company);
                }
                $member = $this->addToMembers($stepForm, $company);
                $this->addToInvoice($stepForm, $company);
            }
            session_unset();
            $this->login($member);
        } else {
            $stepForm->setStep($_input['step'] - 1);
            $stepForm->save();
            $export['validate'] = $errors;
            return $export;
        }
        
    }

    public function showTemplate($stepForm, $export)
    {

        $this->fileName = $stepForm->getTemplate();

        if ($export['data']['company_id']) {
            $export['data']['registration_date'] = convertDate($export['data']['registration_date']);
        }

        if (empty($export['data'])) {
            $export['data'] = $stepForm->getData();
        }

        $export['personalityType'] = $this->getPersonalityType();
        $export['licenceList'] = $this->getLicenceList();
        $export['province'] = $this->getProvince();
        $export['city'] = $this->getCity($export['data']['state_id']);
        $export['category'] = $this->getCategory();
        $export['logo'] = $this->getLogo($export['data']);
        $export['packages'] = $this->getMainPackage();
        $export['extra_packages'] = $this->getExtraPackage();

        $this->template($export, $export['msg']);
        die();
    }

    /**
     * @param $_input
     * @return mixed
     */
    public function validateStepOne($_input)
    {

        if ($_input['company_type'] != 1 && $_input['company_type'] != 2) {
            $result['msg'] = "لطفا یکی از آیتم ها را انتخاب نمایید";
            $result['result'] = -1;
            return $result;
        }
        $result['result'] = 1;

        return $result;
    }

    /**
     * @param $_input
     */
    public function validateStepTwoLegal($_input)
    {
        // todo: register
        // if ($_input['national_id'] & $_input['phone']) {
        //     $_input['national_id'] = convertToEnglish($_input['national_id']);
        //     $_input['phone'] = convertToEnglish($_input['phone']);
        // }
        if ($_input['phone']) {
            $_input['phone'] = convertToEnglish($_input['phone']);
        }
        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . MEMBER_01,
            'family' => 'required*' . MEMBER_02,
            // 'national_id' => 'required*' . NATIONAL_ID_01 . '|numeric*' . NATIONAL_ID_02 . '|max_len,11*' . NATIONAL_ID_03 . '|min_len,11*' . NATIONAL_ID_03,
            'phone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_10 . '|min_len,5*' . PHONE_11,
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        // check phone
        $black = new black_whiteController();
        $result = $black->checkPhone($_input['phone'], 'register');
        if (!$result) {
            $errors['msg'] = "شماره شما در لیست سیاه قرار گرفته است";
            return $errors;
        }
        // -----------

        // check company
        // $packageStatus = array(3, 4);
        // $company = company_d::getBy_national_id_and_package_status($_input['national_id'], $packageStatus)->getList();
        // if ($company['export']['recordsCount'] >= 1) {
        //     $errors['msg'] = "با این شناسه ملی یک کمپانی قبلا ثبت شده است";
        // }
        // -------------

        return $errors;
    }

    /**
     * @param $_input
     * @return array|null
     */
    public function validateStepTwoReal($_input)
    {
        if ($_input['licence_number'] & $_input['phone']) {
            $_input['licence_number'] = convertToEnglish($_input['licence_number']);
            $_input['phone'] = convertToEnglish($_input['phone']);
        }
        $validator = new GUMP();
        $rules = array(
            'licence_number' => 'required*' . LICENCE_01 . '|numeric*' . LICENCE_02,
            'phone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_10 . '|min_len,5*' . PHONE_11,
        );
        if ($_input['licence_list_id'] == 0) {
            $rules = array(
                'licence_number' => 'required*' . LICENCE_01 . '|numeric*' . LICENCE_02,
                'phone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_10 . '|min_len,5*' . PHONE_11,
                'licence_type' => 'required*' . LICENCE_03
            );
        }
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        $personality_type = licenceController::find($_input['licence_list_id']);
        if (!is_object($personality_type) & $_input['licence_list_id'] != 0) {
            if (empty($errors)) {
                $errors['msg'] = "لطفا یکی از جوازهای لیست رو انتخاب نمایید";
                return $errors;
            }
            $errors['licence_list_id'] = "لطفا یکی از جوازهای لیست رو انتخاب نمایید";
        }

        // check phone
        $black = new black_whiteController();
        $result = $black->checkPhone($_input['phone'], 'register');
        if (!$result) {
            $errors['msg'] = "شماره شما در لیست سیاه قرار گرفته است";
            return $errors;
        }
        // -----------

        // check company
        $packageStatus = array(3, 4);
        $licence = c_licences::getBy_licence_number_and_licence_type($_input['licence_number'], $_input['licence_list_id'])->getList();
        if ($licence['export']['recordsCount'] >= 1) {
            foreach ($licence['export']['list'] as $licence) {
                $company = company::getBy_company_id_and_package_status($licence['company_id'], $packageStatus)->first();
                if (is_object($company)) {
                    $errors['msg'] = "با این شماره جواز یک کمپانی قبلا ثبت شده است";
                }
            }
        }
        // -------------

        return $errors;
    }

    /**
     * @param $_input
     * @return array|mixed|null|void
     */
    public function validateStepFourLegal($_input)
    {
        if ($_input['national_id']) {
            $_input['national_id'] = convertToEnglish($_input['national_id']);
        }
        // check company
        $packageStatus = array(3, 4);
        $company = company_d::getBy_national_id_and_package_status($_input['national_id'], $packageStatus)->getList();
        if ($company['export']['recordsCount'] >= 1) {
            $errors['msg'] = "با این شناسه ملی یک کمپانی قبلا ثبت شده است";
        }
        // -------------


        if ($_input['registration_number']) {
            $_input['registration_number'] = convertToEnglish($_input['registration_number']);
        }
        $validator = new GUMP();
        $rules = array(
            'registration_number' => 'required*' . REGISTRATION_NUMBER_01 . '|numeric*' . REGISTRATION_NUMBER_02,
            'company_name' => 'required*' . REGISTER_08,
            'maneger_name' => 'required*' . REGISTER_09,
            'description' => 'required*' . REGISTER_10,
            'registration_date' => 'required*' . DATE_01,
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        $personality_type = personalityTypeController::find($_input['personality_type']);
        if (!is_object($personality_type)) {
            if (empty($errors)) {
                $errors['msg'] = "لطفا یکی از نوع شخصیتهای لیست رو انتخاب نمایید";
                return $errors;
            }
            $errors['personality_type'] = "لطفا یکی از نوع شخصیتهای لیست رو انتخاب نمایید";
        }

        return $errors;
    }

    /**
     * @param $_input
     * @return array|null
     */
    public function validateStepFourReal($_input)
    {
        if ($_input['national_code']) {
            $_input['national_code'] = convertToEnglish($_input['national_code']);
        }
        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . LICENCE_04,
            'family' => 'required*' . LICENCE_05,
            'national_code' => 'required*' . LICENCE_06 . '|numeric*' . LICENCE_13 . '|max_len,10*' . LICENCE_14 . '|min_len,10*' . LICENCE_14,
            'description' => 'required*' . LICENCE_07,
            'issuence_date' => 'required*' . LICENCE_08,
            'expiration_date' => 'required*' . LICENCE_09,
            'company_name' => 'required*' . LICENCE_11,
            'exporter_refrence' => 'required*' . LICENCE_12
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        if (empty($errors) & empty($_input['imageCropped'])) {
            $errors['msg'] = "عکس جواز ضروری است";
        }

        return $errors;
    }

    /**
     * @param $_input
     * @return array|null
     */
    public function validateStepFive($_input)
    {
        if ($_input['phone'] & $_input['address'] & $_input['code'] & $_input['postal_code']) {
            $_input['phone'] = convertToEnglish($_input['phone']);
            $_input['address'] = convertToEnglish($_input['address']);
            $_input['code'] = convertToEnglish($_input['code']);
            $_input['postal_code'] = convertToEnglish($_input['postal_code']);
        }
        $validator = new GUMP();
        $rules = array(
            'address' => 'required*' . ADDRESS_01,
            'phone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|min_len,2*' . PHONE_03 . '|max_len,10*' . PHONE_03,
            'code' => 'required*' . PHONE_07 . '|numeric*' . PHONE_08 . '|min_len,3*' . PHONE_09,
            'postal_code' => 'required*' . PHONE_12 . '|numeric*' . PHONE_13,
            'email' => 'valid_email*' . EMAIL_01,
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        // if (count($_input['category_id']) > 1 || count($_input['category_id']) < 1) {
        //     if (empty($errors)) {
        //         $errors['msg'] = "هنگام ثبت نام باید یک دسته بندی را انتخاب نمایید";
        //         return $errors;
        //     }
        //     $errors['category_id'] = "هنگام ثبت نام باید یک دسته بندی را انتخاب نمایید";
        // }

        $province = provinceController::find($_input['state_id']);
        $city = cityController::find($_input['city_id']);

        if (!is_object($province) || !is_object($city)) {
            $errors['msg'] = "خطا در انتخاب استان و شهرستان";
            return $errors;
        }

        return $errors;
    }

    /**
     * @param $_input
     * @return bool
     */
    public function validateStepSix($_input)
    {
        $package = package::find($_input['package_type']);

        if (!is_object($package) & $_input['package_type'] != 0) {

            return null;
        }

        return $_input['package_type'];
    }

    /**
     * @param $_input
     * @return array|null
     */
    public function validateStepSeven($_input)
    {
        if ($_input['email'] & $_input['mobile'] & $_input['username'] & $_input['password'] & $_input['retype_password']) {
            $_input['email'] = convertToEnglish($_input['email']);
            $_input['mobile'] = convertToEnglish($_input['mobile']);
            $_input['username'] = convertToEnglish($_input['username']);
            $_input['password'] = convertToEnglish($_input['password']);
            $_input['retype_password'] = convertToEnglish($_input['retype_password']);
        }
        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . MEMBER_01,
            'family' => 'required*' . MEMBER_02,
            'email' => 'required*' . MEMBER_03 . '|valid_email*' . REGISTER_06,
            'mobile' => 'required*' . MEMBER_04 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_03 . '|min_len,11*' . PHONE_03,
            'username' => 'required*' . MEMBER_05,
            'password' => 'required*' . MEMBER_06 . '|min_len,8*' . MEMBER_08,
            'retype_password' => 'required*' . MEMBER_07 . '|min_len,8*' . MEMBER_08,
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        $member = members::getBy_username($_input['username'])->first();
        if (is_object($member)) {
            $errors['msg'] = "این نام کاربری قبلا ثبت شده است";
            return $errors;
        }

        if (strlen(trim($_input['username'])) != mb_strlen(trim($_input['username']), 'utf-8')) {
            $errors['msg'] = "نام کاربری را با حروف انگلیسی یا عدد وارد نمایید";
            return $errors;
        }

        if (!$errors) {
            if ($_input['password'] != $_input['retype_password']) {
                $errors['msg'] = "فیلد رمز عبور با تکرار رمز عبور برابری ندارد";
            }
        }

        return $errors;
    }

    /**
     * @param $input
     * @return array|mixed|null|void
     */
    public function addToCompany($input)
    {
        // from step 8 to here

        $company = null;
        if (isset($input->data['oldCompanyId'])) {
            $company = company::find($input->data['oldCompanyId']);
        }
        $stepForm = unserialize($_SESSION['step']);
        if ($input->data['5']['state_id'] == '')
            $input->data['5']['state_id'] = 0;

        $fields['state_id'] = $input->data['5']['state_id'];

        if ($input->data['5']['city_id'] == '')
            $input->data['5']['city_id'] = 0;

        $fields['city_id'] = $input->data['5']['city_id'];

        $fields['company_type'] = $input->data['1']['company_type'];
        $fields['company_name'] = $input->data['4']['company_name'];
        $fields['maneger_name'] = $input->data['4']['maneger_name'];
        $fields['registration_number'] = $input->data['4']['registration_number'];
        //dd($input->data);
        if ($input->data['5']['city_id'] == '')
            $input->data['4']['personality_type'] = 0;

        $fields['personality_type'] = $input->data['4']['personality_type'];

        $fields['description'] = $input->data['4']['description'];
        $fields['national_id'] = $input->data['2']['national_id'];
        $fields['register_date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['status'] = -1;
        $fields['new_register'] = 1;
        $fields['priority'] = 0;
        $fields['video_script'] = '';
        $fields['catalog'] = '';
        $fields['refresh_date'] = date('Y-m-d');
        $fields['old_priority'] = 0;
        $fields['category_id'] = "," . $input->data['5']['category_id']['0'] . ",";

        $package = package::find($stepForm->data['6']['package_type']);
        $fields['package_status'] = ($package->price == 0 || $package->price == '') ? 1 : 2;

        if ($input->data['4']['issuence_date'] == '') {
            $input->data['4']['issuence_date'] = convertDate(date('Y-m-d H:i:s'));
        }

        $fields['registration_date'] = empty($input->data['4']['registration_date']) ?
            convertJToGDate($input->data['4']['issuence_date']) :
            convertJToGDate($input->data['4']['registration_date']);


        // Save to company table
        if (!is_object($company)) {
            $company = new company();
        }

        $company->setFields($fields);
        //dd($company);
        $company->edit = "0000000000000000000000000";
        $company->personality_type = ($company->personality_type == '') ? 1 : $company->personality_type;
        $result = $company->save();


        if ($result['result'] == -1) {
            return;
        }

        // Save to company_d table
        $company_d = company_d::getAll()
            ->where('company_id', '=', $company->Company_id)
            ->where('status', '=', 1)
            ->where('isActive', '=', 1)
            ->first();

        if (is_object($company_d)) {
            $company_d->isActive = 0;
            $company_d->save();
        }

        $fields['isActive'] = 1;
        $fields['company_id'] = $company->Company_id;
        $company_d = new company_d();
        $company_d->noGuarded();
        $company_d->setFields($fields);
        $company_d->personality_type = ($company_d->personality_type == '') ? 1 : $company_d->personality_type;

        $result = $company_d->save();


        if ($result['result'] == -1) {
            return;
        }

        // Update send_token table
        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $sendToken = send_token::find($token);
        if (is_object($sendToken)) {
            $sendToken->register = 1;
            $sendToken->company_id = $company->Company_id;
            $sendToken->save();
        }

        return $company;
    }

    /**
     * @param $input
     * @param $company
     */
    public function addToLicence($input, $company)
    {
        $fields['company_id'] = $company->Company_id;
        $fields['branch_id'] = 0;
        $fields['licence_number'] = $input->data['2']['licence_number'];
        $fields['name'] = $input->data['4']['name'];
        $fields['family'] = $input->data['4']['family'];
        $fields['national_code'] = $input->data['4']['national_code'];
        $fields['issuence_date'] = convertJToGDate($input->data['4']['issuence_date']);
        $fields['expiration_date'] = convertJToGDate($input->data['4']['expiration_date']);
        $fields['description'] = $input->data['4']['description'];
        $fields['exporter_refrence'] = $input->data['4']['exporter_refrence'];
        $fields['isMain'] = 1;
        $fields['status'] = -1;
        $fields['isActive'] = 1;
        $property = [
            'image' => $input->data['4']['imageCropped'],
            'company_id' => $company->Company_id,
            'folder_name' => 'licence'
        ];
        $sizes = [
            'size1' => ['width' => '90', 'height' => '90']
        ];

        $uploader = new Uploader();
        $result = $uploader->cropAndCompressImage($property, $sizes);
        $fields['image'] = $result['image'];

        if ($input->data['2']['licence_list_id']) {
            $fields['licence_type'] = $input->data['2']['licence_list_id'];
        } else {
            $field['name'] = $input->data['2']['licence_type'];
            $field['status'] = 0;
            $licence_list = licenceController::add($field);
            $fields['licence_type'] = $licence_list->Licence_list_id;
        }

        $c_licence = new c_licences();
        $c_licence->setFields($fields);
        $c_licence->save();

        $c_licence->parent_id = $c_licence->Licence_id;
        $c_licence->save();
        return;
    }

    /**
     * @param $input
     * @param $company
     * @return mixed
     */
    public function addToMembers($input, $company)
    {

        $fields['company_id'] = $company->Company_id;
        $fields['name'] = $input->data['7']['name'];
        $fields['family'] = $input->data['7']['family'];
        $fields['email'] = $input->data['7']['email'];
        $fields['mobile'] = $input->data['7']['mobile'];
        $fields['username'] = strtolower(convertToEnglish($input->data['7']['username']));
        $fields['password'] = md5(convertToEnglish($input->data['7']['password']));
        $fields['status'] = 1;
        $fields['last_login'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $members = new members($fields);
        $result = $members->save();

        if ($result['result'] == 1) {
            $member['username'] = convertToEnglish($input->data['7']['username']);
            $member['password'] = convertToEnglish($input->data['7']['password']);
            $msg = " سلام مشترک محترم آقای/خانم {$fields['family']} اطلاعات ورود به دایرکتوری اطلاعات تولیدات: 
نام کاربری : {$member['username']}
کلمه عبور : {$member['password']}";

            $this->sendSMS($fields['mobile'], $msg);
            // echo 22;
            $this->sendMail($fields['email'], $msg, "ثبت نام در سایت تولیدات", $fields['company_id']);
            return $member;
        }
    }

    public function addToInvoice($stepForm, $company)
    {
        $package = package::find($stepForm->data['6']['package_type']);

        if (!is_object($package)) {
            $result['msg'] = 'این پکیج موجود نیست';
            redirectPage(RELA_DIR . 'member/invoice', $result['msg']);
        }

        //        $fields['startdate'] = strftime('%Y-%m-%d %H:%M:%S', time());
        //        $fields['expiredate'] = date('Y-m-d', strtotime("+1 years", strtotime(substr($fields['startdate'], 0, 10))));
        $fields['package_id'] = $package->Package_id;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $company->Company_id;
        $fields['status'] = ($package->price == 0 || $package->price == '') ? 1 : 0;
        $fields['price'] = $package->price;
        $fields['total_price'] = $package->price;
        $fields['discount_code_id'] = 0;
        $fields['percent'] = 0;
        $fields['invoice_detail'] = serialize($package->fields);
        $fields['type'] = 1;
        $invoice = new invoice();
        $invoice->setFields($fields);
        $result = $invoice->save();

        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . 'member/invoice', 'اطلاعات ذخیره نشد');
        }

        return;
    }

    /**
     * @param $input
     * @param $company
     */
    public function addToAddress($input, $company)
    {
        $company_d = company_d::getBy_company_id($company->Company_id)->first();
        // dd($company_d);

        include_once ROOT_DIR . "component/companyAddresses/model/companyAddresses.model.php";
        $fields['company_id'] = $company->Company_id;
        $fields['addresses_id'] = 0;
        $fields['branch_id'] = 0;
        $fields['subject'] = "آدرس";
        $fields['address'] = $input->data['5']['address'];
        $fields['postal_code'] = $input->data['5']['postal_code'];
        $fields['editor_id'] = 0;
        $fields['isAdmin'] = 0;
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isMain'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_d_id'] = $company_d->Company_d_id;
        $fields['admin_description'] = '';
        $address_d = new c_addresses_d($fields);
        $result = $address_d->save();
        return $result;
    }

    /**
     * @param $input
     * @param $company
     */
    public function addToPhone($input, $company)
    {
        $company_d = company_d::getBy_company_id($company->Company_id)->first();


        require_once ROOT_DIR . "component/companyPhones/model/companyPhones.model.php";
        $fields['company_id'] = $company->Company_id;
        $fields['branch_id'] = 0;
        $fields['subject'] = "تلفن";
        $fields['code'] = $input->data['5']['code'];
        $fields['number'] = $input->data['5']['phone'];
        $fields['state'] = '';
        $fields['value'] = '';
        $fields['phones_id'] = 0;
        $fields['editor_id'] = 0;
        $fields['isAdmin'] = 0;
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isMain'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['reference_type'] = 0;
        $fields['reference_value'] = '';
        $fields['company_d_id'] = $company_d->Company_d_id;
        $fields['admin_description'] = '';

        $phone_d = new c_phones_d($fields);
        $result = $phone_d->save();
        return $result;
    }

    public function addToWebsites($input, $company)
    {
        $websites = c_websites::getBy_company_id($company->Company_id)->first();
        $company_d = company_d::getBy_company_id($company->Company_id)->first();

        $fields['websites_id'] = (int) $websites->Websites_id;
        $fields['company_id'] = $company->Company_id;
        $fields['company_d_id'] = $company_d->Company_d_id;
        $fields['branch_id'] = 0;
        $fields['subject'] = "وب سایت";
        $fields['url'] = $input->data['5']['website'];
        $fields['editor_id'] = 0;
        $fields['isAdmin'] = 0;
        $fields['admin_description'] = '';
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $website_d = new c_websites_d();
        $website_d->setFields($fields);
        $result = $website_d->save();
        return $result;
    }

    public function addToEmail($input, $company)
    {
        $company_d = company_d::getBy_company_id($company->Company_id)->first();

        $fields['company_id'] = $company->Company_id;
        $fields['company_d_id'] = $company_d->Company_d_id;

        $fields['emails_id'] = 0;
        $fields['branch_id'] = 0;
        $fields['subject'] = "ایمیل";
        $fields['email'] = $input->data['5']['email'];
        $fields['editor_id'] = 0;
        $fields['isAdmin'] = 0;
        $fields['admin_description'] = '';
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $email_d = new c_emails_d();
        $email_d->setFields($fields);
        $result = $email_d->save();
        return $result;
    }

    public function addToLogo($input, $company)
    {
        $fields['company_id'] = $company->Company_id;
        $fields['logo_id'] = 0;
        $fields['title'] = "logo";
        $fields['description'] = "logo";
        $fields['editor_id'] = 0;
        $fields['isAdmin'] = 0;
        $fields['admin_description'] = '';
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $property = [
            'image' => $input->data['5']['imageCropped'],
            'company_id' => $company->Company_id,
            'folder_name' => 'logo'
        ];
        $sizes = [
            'size1' => ['width' => 122, 'height' => 125],
            'size2' => ['width' => 140, 'height' => 140],
            'size3' => ['width' => 150, 'height' => 150],
        ];
        $uploader = new Uploader();
        $result = $uploader->cropAndCompressImage($property, $sizes);

        $fields['image'] = $result['image'];

        $logo_d = new c_logo_d();
        $logo_d->setFields($fields);
        $result = $logo_d->save();
        return $result;
    }

    public function addLicence()
    {
        $stepForm = stepForm::object('step', 7);
        unset($stepForm->data['licence']['image']);
        $licence = licenceController::getLicenceList();
        $export['licence_list'] = $licence['export']['list'];
        if ($stepForm->data['licence']) {
            $export['licence_prev'] = $stepForm->data['licence'];
        }
        echo json_encode($export);
        die();
    }

    public function addToEditorMember($input, $company)
    {
        $company_d = company_d::getBy_company_id($company->Company_id)->first();
        // dd($company);
        if (is_object($company_d)) {
            $fields['company_id'] = $company->Company_id;
            $fields['company_d_id'] = $company_d->Company_d_id;
            $fields['name'] = $input->data[2]['name'];
            $fields['family'] = $input->data[2]['family'];
            $fields['phone'] = $input->data[2]['phone'];
            $editorMember = new editor_members();
            $editorMember->setFields($fields);
            $editorMember->save();
        }

        $msg = "سلام، به مرجع اطلاعات تولیدات خوش آمدید.
با تشکر از حضور شما در تولیدات، لطفا در انتظار تایید ثبت نام بمانید‫‬‬. \n <tolidat.ir>";


        $this->sendSMS($fields['phone'], $msg);

        return;
    }

    /**
     * @param $fields
     */
    public function addLicenceByAjax($fields)
    {
        $errors = $this->validateStepFourReal($fields);

        if (!empty($errors)) {
            $errors['result'] = -1;
            echo json_encode($errors);
            die();
        }

        $licence = $this->checkLicenceType($fields['licence_type'], $fields['licence_type_name']);

        if (!is_object($licence)) {
            echo json_encode($licence);
            die();
        }

        $stepForm = stepForm::object('step', 7);
        $stepForm->data['licence'] = $fields;
        $stepForm->save();

        $result['data'] = $fields;
        $result['msg'] = "جواز موزد نظر افزوده شد";

        if (!is_object($licence)) {
            $result['data']['licence_name'] = $licence->name;
            echo json_encode($result);
            die();
        }

        $result['data']['licence_name'] = $licence->name;
        echo json_encode($result);
        die();
    }

    public function deleteLicenceByAjax()
    {
        $stepForm = stepForm::object('step', 7);
        unset($stepForm->data['licence']);
        $stepForm->save();

        $result['result'] = 1;
        $result['msg'] = "مجوز با موفقیت حذف شد";
        echo json_encode($result);
        die();
    }

    /**
     * @param $input
     */
    public function addLicenceForLegal($input, $company)
    {
        if (!isset($input->data['licence'])) {
            return;
        }

        $fields['company_id'] = $company->Company_id;
        $fields['branch_id'] = 0;
        $fields['status'] = -1;
        $fields['isActive'] = 1;
        $fields['parent_id'] = 0;
        $fields['company_d_id'] = 0;
        $fields['editor_id'] = 0;
        $fields['isMain'] = 1;
        $fields['date'] = date('Y-m-d H:i:s');
        $fields['isAdmin'] = 0;
        $fields['admin_description'] = '';

        $property = [
            'image' => $input->data['licence']['imageCropped'],
            'company_id' => $company->Company_id,
            'folder_name' => 'licence'
        ];
        $sizes = [
            'size1' => ['width' => '90', 'height' => '90']
        ];
        $uploader = new Uploader();
        $result = $uploader->cropAndCompressImage($property, $sizes);
        $fields['image'] = $result['image'];

        $fields['issuence_date'] = convertJToGDate($input->data['licence']['issuence_date']);
        $fields['expiration_date'] = convertJToGDate($input->data['licence']['expiration_date']);

        if ($input->data['licence']['licence_type'] > 0) {
            $fields['licence_type'] = $input->data['licence']['licence_type'];
        } else {
            $field['name'] = $input->data['licence']['licence_type_name'];
            $field['status'] = 0;
            $licence_list = licenceController::add($field);
            $fields['licence_type'] = $licence_list->Licence_list_id;
        }

        $c_licence = new c_licences();
        $c_licence->setFields($input->data['licence']);
        $c_licence->setFields($fields);
        $c_licence->save();

        $c_licence->parent_id = $c_licence->Licence_id;
        $c_licence->save();

        $this->updateCompany($company);

        return;
    }

    /**
     * @param $member
     */
    public function login($member)
    {
        $login = new loginController();
        $login->login($member);
    }

    /**
     * @param $input
     * @param $code
     */
    public function sendTokenTo($input, $code)
    {
        // dd($input);
        switch ($input['methodType']) {
            case 0:
                // dd(2);
                $result = $this->call($input['phone'], $code);
                return $result;
            case 1:
                // dd(1);
                $code = "کد فعالسازی شما در تولیدات : " . $code;
                $result = $this->sendSMS($input['phone'], $code);
                return $result;
            case 2:

                $this->sendMail($input['email'], $code, '');
                return;
        }
    }

    /**
     * @param $stepForm
     */
    public function sendTokenAgain($stepForm)
    {
        $stepForm = unserialize($stepForm);
        $input = $stepForm->data[2];
        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $register = send_token::find($token);
        // dd($register);
        if (!is_object($register)) {
            $result['msg'] = 'ارسال کد با مشکل مواجه شد دوباره تلاش فرمایید';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($register->count >= 10) {
            $result['msg'] = 'ارسال کد فعالسازی ۱۰ بار امکان دارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        
        $token = $this->generateCode();

        $register->key = $token;
        $register->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $register->count = $register->count + 1;
        $result = $register->save();
        // dd($result);
        if ($result['result'] == 1) {
            $result = $this->sendTokenTo($input, $token);
            dd($result);
            echo json_encode($result);
            die();
        }
    }

    /**
     * @param $input
     * @return mixed
     * @internal param $_input
     * @internal param $msg
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function sendToken($input)
    {
        $code = $this->generateCode();
        $token = new send_token();
        $token->company_id = 0;
        $token->key = $code;
        $token->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $token->email = '';
        $token->phone = $input['phone'];
        $token->name = $input['name'];
        $token->family = $input['family'];
        $token->wiki = $input['wiki'];
        $token->register = $input['register'];
        $token->count = 0;
        $result = $token->save();
        if ($result['result'] == 1) {
            // dd($result);
            $this->sendTokenTo($input, $code);
            $token = encrypt($token->Id * 5664, 1212);
            return $token;
        }
        return false;
    }

    /**
     * @return string
     */
    public function generateCode()
    {
        return rand(10000, 99999);
    }

    /**
     * @param $username
     * @param $code
     */
    public function call($username, $code)
    {
        // dd(33);
        $result = call($username, $code);
        return $result;
    }

    /**
     * @param $username
     * @param $code
     */
    public function sendSMS($username, $code)
    {
        $result = sendSMS($username, $code);
        return $result;
    }

    /**
     * @param $email
     * @param $msg
     * @param $title
     */
    public function sendMail($email, $msg, $title, $company_id = 1)
    {
        $path = ROOT_DIR . 'templates/' . CURRENT_SKIN . '/mailRegister.php';
        $inputList['code'] = $msg;
        $inputList['title'] = $title;
        $inputList['footer'] = RELA_DIR;
        $variable = $inputList;

        $contacts = [
            'company_id' => (int) $company_id,
            'email' => $email,
            'subject' => $title,
            'body' => ['path' => $path, 'data' => compact('variable')],
        ];
        // echo 'a';
        require_once ROOT_DIR . 'component/emailEngine/admin/Controllers/EmailEngineController.php';
        // echo 'b';
        EmailEngineController::forceSend($contacts);
        // echo 'c';
        return;
    }

    /**
     * @param $stepForm
     * @return bool
     */
    public function checkStep($stepForm)
    {

        if (empty($stepForm->sendToken)) {
            $stepForm->setStep(1);
            $stepForm->save();
        }
        return true;
    }

    /**
     * @param $national_id
     */
    public function getCompanyByAjax($national_id)
    {
        $company = company_d::getBy_national_id_and_isActive($national_id, 1)->getList();
        if ($company['export']['recordsCount'] > 0) {
            echo json_encode($company['export']['list'][0]);
            die();
        }
    }

    /**
     * @return mixed
     */
    public function getLicenceList()
    {
        $licence_list = licenceController::getLicenceList();
        return $licence_list['export']['list'];
    }

    /**
     * @return mixed
     */
    public function getPersonalityType()
    {
        $personality = personalityTypeController::getPersonalityType();
        return $personality['export']['list'];
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getCompanyInformation($input)
    {
        $company_id = $input->data['4']['company_id'];
        if (!$company_id) {
            $national_id = $input->data['2']['national_id'];
            if ($national_id) {
                $company_d = company_d::getBy_national_id_and_status_and_isActive($national_id, 1, 1)->first();
            }
        } else {
            $company_d = company_d::getBy_company_id_and_status_and_isActive($company_id, 1, 1)->first();
        }

        if (is_object($company_d)) {
            //            $company_d->category_id = substr($company_d->category_id, 1, -1);
            $input->data['oldCompanyId'] = $company_d->company_id;
            $input->save();
            return $company_d->fields;
        }

        return null;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getLicenceInformation($input)
    {
        $licence_number = $input->data['2']['licence_number'];
        if ($input->data['2']['licence_list_id'] == 0) {
            $licence_type = $input->data['2']['licence_type'];
            $licence = licence_list::getAll()
                ->where('name', '=', $licence_type)->first();
            $licence_list_id = $licence->Licence_list_id;
        } else {
            $licence_list_id = $input->data['2']['licence_list_id'];
        }
        $c_licence = c_licences::getAll()
            ->where('licence_type', '=', $licence_list_id)
            ->where('licence_number', '=', $licence_number)
            ->where('status', '=', 2)->first()->fields;
        return $c_licence;
    }

    /**
     * @return mixed
     */
    public function getProvince()
    {
        return provinceController::getProvince();
    }

    /**
     * @param $province_id
     * @return mixed
     */
    public function getCity($province_id)
    {
        return cityController::getCity($province_id);
    }

    /**
     * @return mixed|null|void
     */
    public function getCategory()
    {
        $category = new adminCategoryController();
        return $category->getCategory();
    }

    public function getLogo($data)
    {
        if ($data['company_id']) {
            $logo = c_logo_d::getAll()
                ->where('company_id', '=', $data['company_id'])
                ->where('status', '=', 1)
                ->where('isActive', '=', 1)
                ->first();

            if (is_object($logo)) {
                return RELA_DIR . 'statics/images/company/' . $data['company_id'] . '/logo/' . $logo->image;
            }
        }

        return $data['imageCropped'];
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getAddress($input)
    {
        require_once ROOT_DIR . "component/companyAddresses/model/companyAddresses.controller.php";
        $company = $this->getCompanyInformation($input);
        $address = addressController::getAddressByCompanyID($company['company_id']);
        return $address;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function getPhone($input)
    {
        require_once ROOT_DIR . "component/companyPhones/model/companyPhones.controller.php";
        $company = $this->getCompanyInformation($input);
        $phone = phoneController::getPhoneByCompanyID($company['company_id']);
        return $phone;
    }

    public function showRegisterStepFinal()
    {
        $this->fileName = "registerStepFinal.php";
        $this->template();
        die();
    }

    public function getMainPackage()
    {
        $packages = package::getAll()->where('main', '=', 1)->getList();
        if ($packages['export']['recordsCount'] < 1) {
            return false;
        }
        foreach ($packages['export']['list'] as $key => $value) {
            switch ($value['packagetype']) {
                case 'رایگان':
                    $value['englishTitle'] = 'free';
                    $result[0] = $value;
                    break;
                case 'برنز':
                    $value['englishTitle'] = 'bronze';
                    $result[1] = $value;
                    break;
                case 'نقره ای':
                    $value['englishTitle'] = 'silver';
                    $result[2] = $value;
                    break;
                case 'طلایی':
                    $value['englishTitle'] = 'gold';
                    $result[3] = $value;
                    break;
                case 'پلاتینیوم':
                    $value['englishTitle'] = 'platinum';
                    $result[4] = $value;
                    break;
            }
        }
        ksort($result);

        return $result;
    }

    public function getExtraPackage()
    {
        $packages = package::getAll()->where('main', '=', 0)->getList();

        if ($packages['export']['recordsCount'] >= 1) {
            return $packages['export']['list'];
        }

        return false;
    }

    public function checkLicenceType($licence_type_id, $licence_type_name)
    {
        $licence = licence_list::find($licence_type_id);

        if (is_object($licence)) {
            return $licence;
        }

        if ($licence_type_id == 0) {
            if ($licence_type_name != null) {
                $licence_name['name'] = $licence_type_name;
                return (object)$licence_name;
            }
            $result['result'] = -1;
            $result['msg'] = "لطفا نوع جواز مربوطه را وارد نمایید";
            return $result;
        }
        $result['result'] = -1;
        $result['msg'] = "لطفا نوع جواز را انتخاب نمایید";
        return $result;
    }

    public function updateCompany($company)
    {
        $company->edit = $company->edit | '0000000000000100000000000';
        $result = $company->save();
        return $result;
    }

    public function checkCode($code)
    {
        $stepForm = stepForm::object('step', 7);
        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $sendToken = send_token::find($token);

        if ($sendToken->key == strtoupper(convertToEnglish($code))) {
            $result['result'] = 1;
            echo json_encode($result);
        }
    }

    public function getLiceceName($licence_list_id)
    {
        $licence = licence_list::find($licence_list_id);

        if (!is_object($licence)) {
            return null;
        }

        return $licence->name;
    }
}
