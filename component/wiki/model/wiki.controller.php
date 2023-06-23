<?php
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once ROOT_DIR . 'component/register/model/register.controller.php';
include_once ROOT_DIR . "component/licence/member/model/licence.model.php";
require_once ROOT_DIR . "component/licence/member/model/licence.controller.php";
include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
include_once ROOT_DIR . 'component/product/member/model/member.product.controller.php';
include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
include_once ROOT_DIR . 'component/category/admin/model/admin.category.model.php';
include_once ROOT_DIR . 'component/province/model/province.controller.php';
require_once ROOT_DIR . "/component/blackWhite/model/blackWhite.controller.php";
include_once ROOT_DIR . 'component/editorMember/model/editorMember.model.php';


class wikiController
{
    public $exportType = 'html';

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

    public function updateCompany($id, $licenceEditField = false)
    {
        if ($licenceEditField) {
            $edit = '0000001111010101000000000';
        } else {
            $edit = '0000001111010001000000000';
        }

        $company = company::find($id);
        $company->edit = $company->edit | $edit;
        $result = $company->save();
        return $result;
    }

    public function checkStep($stepForm)
    {
        if (empty($stepForm->sendToken)) {
            $stepForm->setStep(1);
            $stepForm->save();
        }
        return;
    }

    public function getCompany($company_id)
    {
        return company::getAll()
            ->where('Company_id', '=', $company_id)
            ->where('package_status', '=', 1)
            ->first();
    }

    public function getCompanyInformation($stepForm)
    {
        if (isset($stepForm->data['4'])) {
            $data = $stepForm->data['4'];
            $data['province'] = $this->getProvinces($data);
            $data['city'] = $this->getCity($data['province_id']);
        } else {
            $data = $stepForm->data['company'];
            $data['category_id'] = tagToArray($data['category_id'])['export']['list']['1'];
            $data['province_id'] = $data['state_id'];
            $data = $this->getPhoneInformation($data);
            $data = $this->getAddressInformation($data);
            $data = $this->getEmailInformation($data);
            $data = $this->getWebsiteInformation($data);
            $data = $this->getLogo($data);
            $data['province'] = $this->getProvinces($data);
            $data['city'] = $this->getCity($data['province_id']);
        }

        $data['category'] = $this->getCategory($data);
        $data['personality_list'] = $this->getPersonality();
        $data['licence_list'] = $this->getLicenceList();

        if (isset($stepForm->data['licence'])) {
            $data['licence'] = $stepForm->data['licence'];
        } else {
            $licence = $this->getLicenceInformation($data);

            if (!is_null($licence)) {
                $data['licence'] = $licence;
                $stepForm->data['licence'] = $licence;
                $stepForm->save();
            }
        }

        return $data;
    }

    public function getWikiType($stepForm, $input)
    {
        if ($stepForm->data['company']['company_type'] == 2 & $input['step'] == 4) {
            return 'wikiRealStep';
        } else {
            return 'wikiLegalStep';
        }
    }

    public function showStepFianl()
    {
        $this->fileName = 'wikiLegalStep5.php';
        $this->template();
        die();
    }

    public function showTemplate($stepForm, $export)
    {
        $this->fileName = $stepForm->getTemplate();

        if (empty($export)) {
            $export = $stepForm->getData();
        }

        $this->template($export, $export['msg']);
        die();
    }

    public function wiki($input, $company_id)
    {
        $company = $this->getCompany($company_id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . 'company/Detail/' . $company_id);
        }

        if (!empty($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = convertToEnglish($value);
            }
        }

        $stepForm = stepForm::object('wiki', 5);
        $wikiType = $this->getWikiType($stepForm, $input);
        $stepForm->setTemplate($wikiType);
        $stepForm->data['company'] = $company->fields;

        if (isset($input['step'])) {
            if ($input['step'] > $stepForm->getStep()) {
                $stepForm->setData($input);
            }
            $stepForm->setStep($input['step']);
        }
        $stepForm->save();

//        dd($stepForm);
//        dd($input);
//        dd(unserialize($_SESSION['step']));

        switch ($input['step']) {
            case 2 :
                $export = $this->stepTwo($stepForm, $input);
                break;
            case 3 :
                $export = $this->stepThree($stepForm, $input);
                break;
            case 4 :
                $export = $this->stepFour($stepForm, $input);
                break;
            case 5 :
                $export = $this->stepFive($stepForm, $input);
                break;
            default:
                $export = $this->stepOne($stepForm);
                break;
        }

        $this->showTemplate($stepForm, $export);
    }

    public function stepOne($stepForm)
    {
        $stepForm->setStep(1);
        $stepForm->save();
        return;
    }

    public function stepTwo($stepForm, $input)
    {
        if (isset($stepForm->data['1']) & $stepForm->data['1']['approvePrivacy'] != 'on') {
            $stepForm->setStep($input['step'] - 1);
            $stepForm->save();
            $export['validate']['msg'] = 'لطفا گزینه موافقت با شرایط رو فعال کنید';
        }

        return $export;
    }

    public function stepThree($stepForm, $input)
    {
        if (isset($stepForm->data['2'])) {
            $errors = $this->validationStepTwo($stepForm->data['2']);
        }

        if (!empty($errors)) {
            $stepForm->setStep($input['step'] - 1);
            $stepForm->save();
            $export['validate'] = $errors;
        } else {
            $input['wiki'] = 0;
            $input['register'] = 0;
            if (!isset($stepForm->sendToken)) {
                $stepForm->sendToken = $this->sendToken($input);
                $stepForm->save();
            } else {
                $token = decrypt($stepForm->sendToken, 1212) / 5664;
                $register = send_token::find($token);
                if (is_object($register)) {
                    if ($register->phone != $stepForm->data['2']['phone']) {
                        $register->key = $this->generateCode();
                        $register->phone = $stepForm->data['2']['phone'];
                        $register->save();
                        $this->sendTokenTo($input, $register->key);
                    }
                }
            }
        }

        return $export;
    }

    public function stepFour($stepForm, $input)
    {
        $this->checkStep($stepForm);

        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $sendToken = send_token::find($token);

        if ($sendToken->key != strtoupper(convertToEnglish($stepForm->data['3']['token']))) {
            $export['msg'] = "کد فعال سازی اشتباه است";
            $stepForm->setStep($input['step'] - 1);
            $stepForm->setTemplate('wikiLegalStep');
            $stepForm->save();

        } else {
            $export = $this->getCompanyInformation($stepForm);
        }

        return $export;
    }

    public function stepFive($stepForm, $input)
    {
        if ($stepForm->data['company']['company_type'] == 1) {
            $errors = $this->validationLeagalStepFour($input);
        } else {
            $errors = $this->validationRealStepFour($input);
        }

        if (!$errors) {
            $this->editInformation($stepForm);
        } else {
            $stepForm->setStep($input['step'] - 1);
            $stepForm->save();
            $export = $this->getCompanyInformation($stepForm);
            $export['validate'] = $errors;
            return $export;
        }

        session_unset();
        redirectPage(RELA_DIR . 'wiki/final');
    }

    public function editInformation($stepForm)
    {
        $company_id = $stepForm->data['company']['Company_id'];

        $editorMember = $this->addEditorMember($stepForm->data['2']);

        $fields = $stepForm->data['4'];
        $fields['editor_id'] = $editorMember->editor_members_id;
        $fields['company_id'] = $company_id;

        $company_d = $this->addCompany($fields);

        unset($fields);
        $fields['company_id'] = $company_id;
        $fields['company_d_id'] = $company_d->Company_d_id;
        $fields['editor_id'] = $editorMember->editor_members_id;

        $fields['address'] = $stepForm->data['4']['address'];
        $fields['postal_code'] = $stepForm->data['4']['postal_code'];
        $this->addAddresses($fields);

        $fields['number'] = $stepForm->data['4']['number'];
        $fields['code'] = $stepForm->data['4']['code'];
        $this->addPhones($fields);

        if (! empty($stepForm->data['4']['email'])) {
            $fields['email'] = $stepForm->data['4']['email'];
            $this->addEmails($fields);
        }

        if (! empty($stepForm->data['4']['url'])) {
            $fields['url'] = $stepForm->data['4']['url'];
            $this->addWebsites($fields);
        }

        $fields['image'] = $stepForm->data['4']['logo'];
        $this->addLogo($fields);

        $licenceEditField = false;

        if (isset($stepForm->data['licence']) & $stepForm->data['company']['company_type'] == 1) {
            $fields['licence'] = $stepForm->data['licence'];
            $fields['licence']['isMain'] = 0;
            $this->addLicence($fields);
            $licenceEditField = true;
        }

        if ($stepForm->data['company']['company_type'] == 2) {
            $fields['licence'] = $stepForm->data['4'];
            $fields['licence']['isMain'] = 1;
            $this->addLicence($fields);
            $licenceEditField = true;
        }

        $this->updateCompany($stepForm->data['company']['Company_id'], $licenceEditField);

        return;
    }

    public function addCompany($fields)
    {
        $company = company::getBy_company_id_and_status($fields['company_id'], 1)->first();

        $company_d = new company_d();
        $company_d->setFields($company->fields);

        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['parent_category_id'] = $this->getParentCategoryId($fields['category_id']['0']);
        $fields['parent_category_id'] = arrayToTag($fields['parent_category_id'])['export']['list'];
        $fields['category_id'] = "," . $fields['category_id']['0'] . ",";

        $company_d->setFields($fields);
        $company_d->save();

        return $company_d;
    }

    public function addEditorMember($fields)
    {
        $editorMember = new editor_members();
        $editorMember->company_d_id = 0;
        $editorMember->setFields($fields);
        $editorMember->save();

        return $editorMember;
    }

    public function addPhones($fields)
    {
        $mainPhone = c_phones::getAll()
            ->where('company_id', '=', $fields['company_id'])
            ->where('isMain', '=', 1)
            ->where('branch_id', '=', 0)
            ->first();

        if (is_object($mainPhone)) {
            $fields['subject'] = $mainPhone->subject;
            $fields['state'] = $mainPhone->state;
            $fields['value'] = $mainPhone->value;
        } else {
            $fields['subject'] = "آدرس";
            $fields['state'] = '';
            $fields['value'] = 0;
        }

        $fields['phones_id'] = 0;
        $fields['isMain'] = 1;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $newPhones = new c_phones_d();
        $newPhones->setFields($fields);
        $newPhones->save();

        return $newPhones;
    }

    public function addAddresses($fields)
    {
        $mainAddress = c_addresses::getAll()
            ->where('company_id', '=', $fields['company_id'])
            ->where('isMain', '=', 1)
            ->where('branch_id', '=', 0)
            ->first();

        if (is_object($mainAddress)) {
            $fields['subject'] = $mainAddress->subject;
        } else {
            $fields['subject'] = "آدرس";
        }

        $fields['addresses_id'] = 0;
        $fields['isMain'] = 1;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $newAddress = new c_addresses_d();
        $newAddress->setFields($fields);
        $newAddress->save();
    }

    public function addWebsites($fields)
    {
        $mainWebsite = c_websites::getAll()
            ->where('company_id', '=', $fields['company_id'])
            ->where('isMain', '=', 1)
            ->where('branch_id', '=', 0)
            ->first();

        if (is_object($mainWebsite)) {
            $fields['subject'] = $mainWebsite->subject;
        } else {
            $fields['subject'] = "وب سایت";
        }

        $fields['websites_id'] = 0;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $newWebsite = new c_websites_d();
        $newWebsite->setFields($fields);
        $newWebsite->save();

        return $newWebsite;
    }

    public function addEmails($fields)
    {
        $mainEmail = c_emails::getAll()
            ->where('company_id', '=', $fields['company_id'])
            // ->where('isMain', '=', 1)
            ->where('branch_id', '=', 0)
            ->first();

        if (is_object($mainEmail)) {
            $fields['subject'] = $mainEmail->subject;
        } else {
            $fields['subject'] = "ایمیل";
        }

        $fields['emails_id'] = 0;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        $newEmail = new c_emails_d();
        $newEmail->setFields($fields);
        $newEmail->save();

        return $newEmail;
    }

    public function addLogo($fields)
    {
        $fields['logo_id'] = 0;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 0;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (substr($fields['image'], 0, 4) == 'data') {
            $property = [
                'image' => $fields['image'],
                'company_id' => $fields['company_id'],
                'folder_name' => 'logo'
            ];
            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];
            $uploader = new Uploader();
            $result = $uploader->cropAndCompressImage($property, $sizes);

            $fields['image'] = $result['image'];

            $logo = new c_logo_d();
            $logo->setFields($fields);
            $logo->save();

        } else {
            $logo = c_logo::getAll()->where('company_id', '=', $fields['company_id'])->getList();

            if ($logo['export']['recordsCount'] > 0) {
                $fields['image'] = $logo['export']['list']['0']['image'];

                $logo = new c_logo_d();
                $logo->setFields($fields);
                $logo->save();
            }
        }

        return $logo;
    }

    public function addLicence($fields)
    {
        $fields['branch_id'] = 0;
        $fields['status'] = -1;
        $fields['isActive'] = 1;

        $property = [
            'image' => $fields['licence']['imageCropped'],
            'company_id' => $fields['company_id'],
            'folder_name' => 'licence'
        ];
        $sizes = [
            'size1' => ['width' => '90', 'height' => '90']
        ];
        $uploader = new Uploader();
        $result = $uploader->cropAndCompressImage($property, $sizes);

        $fields['image'] = $result['image'];
        $fields['issuence_date'] = convertJToGDate($fields['licence']['issuence_date']);
        $fields['expiration_date'] = convertJToGDate($fields['licence']['expiration_date']);

        if ($fields['licence']['licence_type'] > 0) {
            $fields['licence_type'] = $fields['licence']['licence_type'];
        } else {
            $field['name'] = $fields['licence']['licence_type_name'];
            $field['status'] = 0;
            $licence_list = licenceController::add($field);
            $fields['licence_type'] = $licence_list->Licence_list_id;
        }

        $c_licence = new c_licences();
        $c_licence->setFields($fields['licence']);
        $c_licence->setFields($fields);
        $c_licence->save();

        $c_licence->parent_id = $c_licence->Licence_id;
        $c_licence->save();

        return $c_licence;
    }

    public function getPhoneInformation($data)
    {
        $wikiPhone = c_phones::getBy_company_id_and_isMain($data['Company_id'], 1)->first();

        if (is_object($wikiPhone)) {
            $data['number'] = $wikiPhone->number;
            $data['code'] = $wikiPhone->code;
        }

        return $data;
    }

    public function getAddressInformation($data)
    {
        $wikiAddress = c_addresses::getBy_company_id_and_isMain($data['Company_id'], 1)->first();
        if (is_object($wikiAddress)) {
            $data['address'] = $wikiAddress->address;
            $data['postal_code'] = $wikiAddress->postal_code;
        }

        return $data;
    }

    public function getEmailInformation($data)
    {
        $wikiEmail = c_emails::getBy_company_id_and_branch_id($data['Company_id'], 0)->first();
        if (is_object($wikiEmail)) {
            $data['email'] = $wikiEmail->email;
        }
        return $data;
    }

    public function getWebsiteInformation($data)
    {
        $wikiWebsite = c_websites::getBy_company_id_and_branch_id($data['Company_id'], 0)->first();
        if (is_object($wikiWebsite)) {
            $data['url'] = $wikiWebsite->url;
        }
        return $data;
    }

    public function geCompnayInformation($id)
    {
        $wikiCompnay = company::getBy_company_id($id['id'])->first();
        if (is_object($wikiCompnay)) {
            $result['company_name'] = $wikiCompnay->company_name;
            $result['company_id'] = $wikiCompnay->Company_id;
            $result['company_type'] = $wikiCompnay->company_type;
            $result['registration_number'] = $wikiCompnay->registration_number;
            $result['maneger_name'] = $wikiCompnay->maneger_name;
            $result['national_id'] = $wikiCompnay->national_id;
            $result['description'] = $wikiCompnay->description;
            $result['personality_type'] = $wikiCompnay->personality_type;
            $result['company_type'] = $wikiCompnay->company_type;
            $result['category_id'] = explode(',', $wikiCompnay->category_id)[1];
        }
        return $result;
    }

    public function getLicenceInformation($data)
    {
        $wikiLicence = c_licences::getBy_company_id_and_isMain_and_status($data['Company_id'], 1, 2)->first();

        if (is_object($wikiLicence)) {
            $wikiLicence->image = is_null($wikiLicence->image) ? DEFULT_LOGO_ADDRESS : COMPANY_ADDRESS . $data['Company_id'] . '/licence/' . $wikiLicence->image;
            return $wikiLicence->fields;
        }

        return null;
    }

    public function getPersonality()
    {
        $personality = personalityTypeController::getPersonalityType();

        if (is_array($personality)) {
            return $personality['export']['list'];
        }

        return null;
    }

    public function getLicenceList()
    {
        $licence_list = licenceController::getLicenceList();

        if (is_array($licence_list)) {
            return $licence_list['export']['list'];
        }

        return null;
    }

    public function getLogo($data)
    {
        $wikiLogo = c_logo::getBy_company_id($data['Company_id'])->first();
        if (is_object($wikiLogo)) {
            $data['logo'] = !is_null($wikiLogo->image) ?
                COMPANY_ADDRESS . $data['Company_id'] . '/logo/' . $wikiLogo->image :
                DEFULT_LOGO_ADDRESS;
        } else {
            $data['logo'] = DEFULT_LOGO_ADDRESS;
        }

        return $data;
    }

    public function getCategory()
    {
        include_once(ROOT_DIR . "component/category/model/category.model.php");
        $category = new categoryModel();

        $category->getCategoryTree();
        $resultCategory = $category->getCategoryUlLiMember($category->list);

        if ($resultCategory['result'] == 1) {

            return $resultCategory['export']['list'];
        }

        return;

        $category = new categoryModel();
        $resultCategory = $category->getCategoryUlLi();

        return $resultCategory;


        $category = new adminCategoryModel();
        $resultCategory = $category->getCategoryOption();

        if ($resultCategory['result'] == 1) {
            $result1['category'] = $category->list;

            return $result1;
        }

        return null;
    }

    public function getProvinces()
    {
        $province = province::getAll()->getList();

        return $province['export']['list'];
    }

    public function getCity($province_id)
    {
        $city = city::getAll()
            ->where('province_id', '=', $province_id)
            ->getList();

        return $city['export']['list'];
    }

    public function deleteLicenceByAjax()
    {
        $stepForm = stepForm::object('wiki', 5);

        $licence = c_licences::find($stepForm->data['licence']['Licence_id']);

        if (is_object($licence)) {
            $licence->delete();
        }

        unset($stepForm->data['licence']);
        $stepForm->save();

        $result['result'] = 1;
        $result['msg'] = "مجوز با موفقیت حذف شد";
        echo json_encode($result);
        die();
    }

    public function showLicenceModal()
    {
        $stepForm = stepForm::object('wiki', 5);
        unset($stepForm->data['licence']['image']);
        $licence = licenceController::getLicenceList();
        $export['licence_list'] = $licence['export']['list'];
        if ($stepForm->data['licence']) {
            $export['licence_prev'] = $stepForm->data['licence'];
        }
        echo json_encode($export);
        die();
    }

    public function addLicenceByAjax($fields)
    {
        $errors = $this->validationLicence($fields);

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

        $fields['image'] = $fields['licenceImage'];
        $stepForm = stepForm::object('wiki', 5);
        $stepForm->data['licence'] = $fields;
        $stepForm->save();

        $result['data'] = $fields;
        $result['msg'] = "جواز مورد نظر افزوده شد";

        $result['data']['licence_name'] = $licence->name;
        echo json_encode($result);
        die();
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

    public function sendTokenAgain($stepForm)
    {
        $stepForm = unserialize($stepForm);
        $input = $stepForm->data[2];
        $token = decrypt($stepForm->sendToken, 1212) / 5664;
        $wiki = send_token::find($token);
        if (!is_object($wiki)) {
            $result['msg'] = 'ارسال کد با مشکل مواجه شد دوباره تلاش فرمایید';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($wiki->count >= 10) {
            $result['msg'] = 'ارسال کد فعالسازی ۱۰ بار امکان دارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        $token = $this->generateCode();

        $wiki->key = $token;
        $wiki->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $wiki->count = $wiki->count + 1;
        $result = $wiki->save();

        if ($result['result'] == 1) {
            $result = $this->sendTokenTo($input, $token);
            echo json_encode($result);
            die();
        }
    }

    public function validationStepTwo($input)
    {
        if ($input['phone']) {
            $input['phone'] = convertToEnglish($input['phone']);
        }

        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . MEMBER_01,
            'family' => 'required*' . MEMBER_02,
            'phone' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_10 . '|min_len,5*' . PHONE_11,
        );
        $validator->validate($input, $rules);
        $errors = $validator->get_errors_array();

        // check phone
        $black = new black_whiteController();
        $result = $black->checkPhone($input['phone'], 'register');
        if (!$result) {
            $errors['msg'] = "شماره شما در لیست سیاه قرار گرفته است";
            return $errors;
        }

        return $errors;
    }

    public function validationLeagalStepFour($fields)
    {
        $validator = new GUMP();
        $rules = array(
            'company_name' => 'required*' . REGISTER_08,
            'maneger_name' => 'required*' . REGISTER_09,
            'registration_number' => 'required*' . REGISTRATION_NUMBER_01 . '|numeric*' . REGISTRATION_NUMBER_02,
            'national_id' => 'required*' . NATIONAL_ID_01 . '|numeric*' . NATIONAL_ID_02 . '|max_len,11*' . NATIONAL_ID_03 . '|min_len,11*' . NATIONAL_ID_03,
            'description' => 'required*' . REGISTER_10,
            'address' => 'required*' . ADDRESS_01,
            'code' => 'required*' . PHONE_07 . '|numeric*' . PHONE_08,
            'number' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04,
        );

        $validator->validate($fields, $rules);
        $result = $validator->get_errors_array();

        $personality_type = personalityTypeController::find($fields['personality_type']);
        if (!is_object($personality_type)) {
            if (empty($errors)) {
                $errors['msg'] = "لطفا یکی از نوع شخصیتهای لیست رو انتخاب نمایید";
            }
        }

        if (count($fields['category_id']) > 1) {
            if (empty($result)) {
                $result['msg'] = "هنگام ویکی فقط یک دسته بندی می توانید انتخاب نمایید";
            }
        }

        $province = provinceController::find($fields['province_id']);
        $city = cityController::find($fields['city_id']);

        if (!is_object($province) || !is_object($city)) {
            if (empty($result)) {
                $result['msg'] = "خطا در انتخاب استان و شهرستان";
            }
        }

        return $result;
    }

    public function validationRealStepFour($fields)
    {
        $validator = new GUMP();
        $rules = array(
            'company_name' => 'required*' . REGISTER_08,
            'maneger_name' => 'required*' . REGISTER_09,
            'name' => 'required*' . LICENCE_04,
            'family' => 'required*' . LICENCE_05,
            'description' => 'required*' . LICENCE_07,
            'licence_number' => 'required*' . LICENCE_01,
            'national_code' => 'required*' . LICENCE_06 . '|numeric*' . LICENCE_13 . '|max_len,10*' . LICENCE_14 . '|min_len,10*' . LICENCE_14,
            'issuence_date' => 'required*' . LICENCE_08,
            'expiration_date' => 'required*' . LICENCE_09,
            'exporter_refrence' => 'required*' . LICENCE_12,
            'address' => 'required*' . ADDRESS_01,
            'code' => 'required*' . PHONE_07 . '|numeric*' . PHONE_08,
            'number' => 'required*' . PHONE_01 . '|numeric*' . PHONE_04,

        );
        $validator->validate($fields, $rules);
        $result = $validator->get_errors_array();

        $licence = $this->checkLicenceType($fields['licence_type'], $fields['licence_type_name']);

        if ((!is_object($licence))) {
            if (empty($result)) {
                $result['msg'] = $licence['msg'];
            }
        }

        $province = provinceController::find($fields['province_id']);
        $city = cityController::find($fields['city_id']);

        if (!is_object($province) || !is_object($city)) {
            if (empty($result)) {
                $result['msg'] = "خطا در انتخاب استان و شهرستان";
            }
        }

        if (count($fields['category_id']) > 1) {
            if (empty($result)) {
                $result['msg'] = "هنگام ویکی فقط یک دسته بندی می توانید انتخاب نمایید";
            }
        }

        return $result;
    }

    public function validationLicence($_input)
    {
        if (!empty($_input)) {
            foreach ($_input as $key => $value) {
                $_input[$key] = convertToEnglish($value);
            }
        }

        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . LICENCE_04,
            'family' => 'required*' . LICENCE_05,
            'description' => 'required*' . LICENCE_07,
            'licence_number' => 'required*' . LICENCE_01,
            'national_code' => 'required*' . LICENCE_06 . '|numeric*' . LICENCE_13 . '|max_len,10*' . LICENCE_14 . '|min_len,10*' . LICENCE_14,
            'issuence_date' => 'required*' . LICENCE_08,
            'expiration_date' => 'required*' . LICENCE_09,
            'exporter_refrence' => 'required*' . LICENCE_12
        );
        $validator->validate($_input, $rules);
        $errors = $validator->get_errors_array();

        if (empty($errors) & empty($_input['licenceImage'])) {
            $errors['msg'] = "عکس جواز ضروری است";
        }

        return $errors;
    }

    public function sendToken($input)
    {
        $code = $this->generateCode();

        $token = new send_token();
        $token->company_id = $input['company_id'];
        $token->key = strtoupper($code);
        $token->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $token->phone = $input['phone'];
        $token->name = $input['name'];
        $token->family = $input['family'];
        $token->wiki = $input['wiki'];
        $token->register = $input['register'];
        $token->count = 0;
        $result = $token->save();
        if ($result['result'] == 1) {
            $this->sendTokenTo($input, $code);
            $token = encrypt($token->Id * 5664, 1212);
            return $token;
        }
    }

    public function sendTokenTo($input, $code)
    {
        switch ($input['methodType']) {
            case 0 :
                $this->call($input['phone'], $code);
                return;
            case 1 :
                $code = "کد فعالسازی : " . $code;
                $this->sendSMS($input['phone'], $code);
                return;
        }
    }

    public function call($username, $code)
    {
        call($username, $code);
        return;
    }

    public function sendSMS($username, $code)
    {
        sendSMS($username, $code);
        return;
    }

    public function generateCode()
    {
        return rand(10000, 99999);
    }

    public function getParentCategoryId($category_id)
    {
        $category = category::find($category_id);

        if (! is_object($category)) {
            return null;
        }

        $parents[] = $category->parent_id;

        $category = category::find($category->parent_id);

        if (! is_object($category)) {
            return $parents;
        }

        $parents[] = $category->parent_id;

        return $parents;
    }


    public function getProvince($id)
    {
        $company_id = company::getBy_company_id($id['id'])->first();
        $wiki_fields4 = company::find($company_id->Company_id);


        $cityObject = new cityController();
        $city = $cityObject->getCity($wiki_fields4->state_id);
        $province = new provinceController();
        $provinces = $province->getProvince();

        $export['city_id'] = $wiki_fields4->city_id;
        $export['state_id'] = $wiki_fields4->state_id;
        $export['province'] = $provinces;
        $export['city'] = $city;
        echo json_encode($export);
        die();
    }

    public function addWikiInformation($id)
    {
        $token = (decrypt($_SESSION['wiki_information']['key'], 1212) / 5664);
        $wiki = send_token::find($token);
        $wiki->wiki = 1;
        $wiki->register = 0;

        $wiki->save();
        $editor_member = new editor_members();
        $editor_member->name = $_SESSION['wiki_information']['name'];
        $editor_member->family = $_SESSION['wiki_information']['family'];
        $editor_member->phone = $_SESSION['wiki_information']['phone'];
        $editor_member->company_d_id = $id;
        $editor_member->save();
    }

    public function getcompanyInformationByid($id)
    {
        $result = $this->geCompnayInformation($id);
        $result = $this->getPhoneInformation($result);
        $result = $this->getLicenceInformation($result);
        $result = $this->getAddressInformation($result);
        $result = $this->getEmailInformation($result);
        $result = $this->getWebsiteInformation($result);
        $result = $this->getPersonality($result);
        $result = $this->getLicenceList($result);
        $result = $this->getLogoList($result);
        echo json_encode($result);
        die();
    }

    public function getompanyInformationByidAjax($id)
    {
        $json = $this->getcompanyInformationByid($id);
        echo json_encode($json);
    }

    public function editAllWiki($fields)
    {
        // check phone
        $black = new black_whiteController();
        $result = $black->checkPhone($fields['phone'], 'wiki');
        if (!$result) {
            $result['result'] = -1;
            $result['msg'] = "شماره شما در لیست سیاه قرار گرفته است";
            echo json_encode($result);
            die();
        }
        $result = $this->validationStep1($fields);

        if (!empty($result)) {
            $result['result'] = -1;
            echo json_encode($result);
            die();
        } else {
            $fields['key'] = $this->sendToken($fields);
        }

        $_SESSION['wiki_information'] = $fields;

        $result['result'] = 1;
        echo json_encode($result);
        die();

    }

    public function codeVerification($key)
    {
        $company_type = company::getBy_company_id($key['company_id'])->first();
        $result['company_type'] = $company_type->company_type;
        $token = (decrypt($_SESSION['wiki_information']['key'], 1212) / 5664);
        $wiki = send_token::find($token);
        if ($wiki->key != strtoupper(convertToEnglish($key['key']))) {
            $result['msg'] = 'کد فعالسازی صحیح نیست';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        } else {
            $result['category'] = $this->getCategory($result['company_type']);
            $result['result'] = 1;
            echo json_encode($result);
            die();
        }
    }

    public function getActualInformation($fields)
    {
        $result = $this->validationStep3($fields);

        if (!empty($result)) {
            $result['result'] = -1;
            echo json_encode($result);
            die();
        } else {
            $company_d_id = $this->addCompany($fields);
            $fields['company_d_id'] = $company_d_id;

            $this->addLicence($fields);

            $this->addPhones($fields);

            $this->addAddresses($fields);

            if (!empty($fields['url'])) {
                $this->addWebsites($fields);
            }
            if (!empty($fields['email'])) {
                $this->addEmails($fields);
            }

            $this->addWikiInformation($fields['company_d_id']);

            $this->updateCompany($fields['company_id']);

            $result['result'] = 1;
            echo json_encode($result);
            die();
        }
    }

    public function getLegalInformation($fields)
    {
        $result = $this->validationStep3($fields);
        if (!empty($result)) {
            $result['result'] = -1;
            echo json_encode($result);
        } else {
            $company_d_id = $this->addCompany($fields);
            $fields['company_d_id'] = $company_d_id;

            if ($fields['licence_number'] != '') {
                $this->addLicence($fields);
            }
            $this->addPhones($fields);

            $this->addAddresses($fields);

            if (!empty($fields['url'])) {
                $this->addWebsites($fields);
            }
            if (!empty($fields['email'])) {
                $this->addEmails($fields);
            }

            $this->addWikiInformation($fields['company_d_id']);

            $this->updateCompany($fields['company_id']);

            $result['result'] = 1;
            echo json_encode($result);
            die();
        }
    }
}