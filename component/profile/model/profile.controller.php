<?php

include_once ROOT_DIR . "component/notification/member/model/notification.controller.php";
include_once ROOT_DIR . "component/companyLogo/member/model/companyLogo.controller.php";
include_once ROOT_DIR . "component/companyBanner/member/model/companyBanner.controller.php";
include_once ROOT_DIR . "component/invoice/InvoiceController.php";
include_once ROOT_DIR . "component/package/member/model/package.controller.php";
include_once ROOT_DIR . 'component/company/member/model/member.company.controller.php';
include_once ROOT_DIR . "component/register/model/register.model.php";
include_once ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.controller.php";
include_once ROOT_DIR . "component/packageUsage/member/model/member.packageUsage.model.php";
include_once ROOT_DIR . "component/category/member/model/member.category.model.php";
include_once ROOT_DIR . "component/personalityType/model/personalityType.model.php";
require ROOT_DIR . "component/personalityType/model/personalityType.controller.php";
require ROOT_DIR . "component/province/model/province.controller.php";
require ROOT_DIR . "component/city/model/city.controller.php";
include_once ROOT_DIR . "component/register/model/register.model.php";
require_once ROOT_DIR . "component/onlinePayment/model/member.onlinePayment.controller.php";
require_once ROOT_DIR . "services/Keyword/Keyword.php";


/**
 * Class registerController.
 */
class profileController
{

    /**
     * @var string
     */
    public $exportType;
    /**
     * Contains file name.
     * @var
     */
    public $fileName;
    /**
     * @var int|mixed
     */
    public $company_info;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';
    }

    /**
     * call template.
     * @param array|string $list
     * @param string $msg
     * @return string
     */
    public function template($list = [], $msg = '')
    {
//        print_r_debug($list);
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->fileName";
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/profile.tail.inc.php';
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
     * @param $msg
     */
    public function showProfileForm($msg = '')
    {
        
        if (!isset($this->company_info['company_id'])) {
            redirectPage(RELA_DIR . 'login');
        }
        $invoice = new InvoiceController();
        $companyInvoice = $invoice->getInvoice($this->company_info['company_id']);
        
        

        if (!is_object($companyInvoice)) {
            redirectPage(RELA_DIR . 'package','Not exist invoice!');
        }
        
        if ($companyInvoice->status == 0) {
            redirectPage(RELA_DIR . 'invoice/show/' . $companyInvoice->Invoice_id,'Status package is deActive!');
        }

        $packageUsage = packageusage::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->first();

        if (!is_object($packageUsage)) {
            redirectPage(RELA_DIR . "profile/successPayment","پکیج فعال ندارید");
        }

        $company = new memberCompanyController();
        $companyObject = $company->getCompanyDraftById($this->company_info['company_id']);

        if (is_object($companyObject)) {
            $member = members::getBy_company_id($companyObject->company_id)->getList();
            $categoryString = rtrim($companyObject->category_id, ',') . $companyObject->parent_category_id;
            $categories = category::getCategoryTitle($categoryString);
        }

        $province = provinceController::find($companyObject->state_id);
        $city = cityController::find($companyObject->city_id);
        $export = array_merge($companyObject->fields, $member['export']['list']['0']);
        $export['category'] = $categories;
        $export['expire_date'] = $packageUsage->expiredate;

        if (is_object($province)) {
            $export['province'] = $province->name;
        }

        if (is_object($city)) {
            $export['city'] = $city->name;
        }

        $this->fileName = 'profile.showList.php';
        $this->template($export, $msg);
        die();
    }

    public function showSuccessTemplate($result = '')
    {
        $this->fileName = "showSuccessPayment.php";
        $this->template($result);
        die();
    }

    /**
     *
     */
    public function getAllNotification()
    {
        $notification = notificationController::getAllRecive($this->company_info['company_id']);
        $this->fileName = 'member.notification.showList.php';
        $this->template($notification['export']['list']);
        die();
    }

    /**
     * @param $id
     */
    public function readNotification($id)
    {
        $notification = notificationController::getNotificationById($id, $this->company_info['company_id']);
        if ($notification['recordsCount'] >= 1) {
            $this->fileName = 'member.notification.read.php';
            $this->template($notification['list']);
            die();
        }
        $this->fileName = 'profile.showList.php';
        $this->template();
        die();
    }

    /**
     * @param $export
     */
    public function showEditFormPrimaryInformation($export = '')
    {
        include_once(ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.model.php");
        $companyObject = new memberCompanyController();
        $company = $companyObject->getCompanyDraftById($this->company_info['company_id']);
        $packageUsage = adminPackageUsageController::getPackageByCompanyID($this->company_info['company_id']);

        if ($export == '') {
            $export = $company->fields;
            //$export['category_id'] = substr($company->category_id, 1, -1);
        }
        $export['category_count'] = explode(',', $export['category_id']);
        if (empty($export['category_count']['0'])) {
            $export['category_count'] = null;
        }
        $export['category_count'] = count($export['category_count']);
        $export['max_meta_keyword'] = $packageUsage->keyword;
        $export['category'] = $this->getCategory();
        $export['province'] = provinceController::getProvince();
        $export['city'] = cityController::getCity($export['state_id']);

        // get personality_type list
        $personality_type = personality_type::getAll()->getList();
        $export['personalityType'] = $personality_type['export']['list'];
        //--------------------------
        if (is_object($company)) {
            $this->fileName = 'profile.editFromPrimaryInformation.php';
            $this->template($export);
            die();
        }
    }

    /**
     * @return mixed|null|void
     */
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

    }


    /**
     * @param $fields
     */
    public function editPrimaryInformation($fields)
    {
        // validate inputs
        $errors = $this->validateFields($fields);

        if ($errors) {
            $fields['validate'] = $errors;
            $this->showEditFormPrimaryInformation($fields);
        }

        // find company from company_d table
        $company_d = company_d::getBy_Company_d_id_and_company_id_and_isActive($fields['Company_d_id'], $this->company_info['company_id'], 1)->first();
        if (!is_object($company_d)) {
            $fields['validate']['msg'] = "این تولیدی وجود ندارد";
            $fields = $fields;
            $this->showEditFormPrimaryInformation($fields);
        }

        // get count meta_keyword & category count
        $metakeywordArray = explode(',', $fields['meta_keyword']);
        if (empty($metakeywordArray[0])) {
            $metakeywordCount = 0;
        } else {
            $metakeywordCount = count($metakeywordArray);
        }
        $categoryCount = count($fields['category_id']);

        // set fields
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['member_id'] = $this->company_info['member_id'];
        $fields['status'] = -1;
        $fields['isActive'] = 1;
        $fields['national_id'] = $company_d->national_id;
        $fields['registration_number'] = $company_d->registration_number;
        $fields['refresh_date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['category_id'] = implode(',', $fields['category_id']);
        $fields['category_id'] = $categoryCount >= 1 ? ',' . $fields['category_id'] . ',' : '';
        $fields['meta_keyword'] = $fields['meta_keyword'];
        $fields['video_script'] = $fields['video_script'];

        if ($fields['catalog']['name'] != '' & $fields['catalog']['error'] == 0) {
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/catalog/", $company_d->catalog);
            $fields['catalog'] = $this->uploadCatalog($fields['catalog']);
        } elseif (isset($fields['deleteCatalog'])) {
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/catalog/", $company_d->catalog);
            $fields['catalog'] = null;
        } else {
            $fields['catalog'] = $company_d->catalog;
        }

        // Update company_d table
        if ($company_d->status == -1) {
            $this->updateCompanyDraft($fields, $company_d);
        } else {
            $this->addCompanyDraft($fields, $company_d);
        }

        $result = $this->updateCompany($company_d->company_id);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی آپدیت نشد';
            return $result;
        }

        // Update packageUsage table
        $packageUsage = packageusage::getBy_company_id($this->company_info['company_id'])->first();
        if (is_object($packageUsage)) {
            $packageUsage->keyword_Usage = $metakeywordCount;
            $packageUsage->category_Usage = $categoryCount;
            $packageUsage->save();
        }

        redirectPage(RELA_DIR . "profile", "اطلاعات با موفقیت ویرایش شد");
    }

    /**
     * @param $fields
     * @param $company_d
     * @return mixed
     */
    public function updateCompanyDraft($fields, $company_d)
    {
        $company_d->setFields($fields);
        $result = $company_d->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'تغییرات مورد نظر انجام نشد';
            return $result;
        }

        $this->sendNotification('Update business Licence');
        $result['message'] = 'تغییرات مورد نظر انجام شد';

        return $result;
    }

    /**
     * @param $fields
     * @return array|mixed|null
     */
    public function addCompanyDraft($fields, $company_d)
    {
        $company_d_new = new company_d();
        $company_d_new->setFields($company_d->fields);
        $company_d_new->setFields($fields);

        $result = $company_d_new->save();

        if ($result['result'] == -1) {
            $result['msg'] = "ذخیره اطلاعات با مشگل مواجه شد";
            return $result;
        }

        $company_d_new->updateAll();
        $this->sendNotification('Edit primary information');
        $result['message'] = 'تغییرات مورد نظر انجام شد';

        return $result;
    }

    public function validateFields($fields)
    {
        $company = company::find($this->company_info['company_id']);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . "login");
        }

        $category_id = tagToArray($fields['category_id'])['export']['list'];
        $validator = new GUMP();
        $rules = array(
            'company_name' => 'required*' . REGISTER_08,
            'maneger_name' => 'required*' . REGISTER_09,
            'description' => 'required*' . REGISTER_10,
        );
        $validator->validate($fields, $rules);
        $errors = $validator->get_errors_array();

        if (!empty($errors)) {
            return $errors;
        }

        if ($company->company_type == 1) {
            $personality_type = personalityTypeController::find($fields['personality_type']);
            if (!is_object($personality_type)) {
                $errors['msg'] = "لطفا یکی از نوع شخصیتهای لیست را انتخاب نمایید";
                return $errors;
            }
        }

        $province = provinceController::find($fields['state_id']);
        $city = cityController::find($fields['city_id']);

        if (!is_object($province) || !is_object($city)) {
            $errors['msg'] = "خطا در انتخاب استان و شهرستان";
            return $errors;
        }

        if ($fields['catalog']['size'] > 20971520) {
            $errors['msg'] = "حجم کاتالوگ نباید بیشتر از ۲۰ مگابایت باشد";
            return $errors;
        }

        if ($errors) {
            return $errors;
        }

        $errors = $this->checkCount($fields, $category_id);

        return $errors;
    }

    /**
     * @param $validate
     * @param $fields
     * @param $category_id
     * @return mixed
     */
    public function checkCount($fields, $category_id)
    {
        $packageUsage = adminPackageUsageController::getPackageByCompanyID($this->company_info['company_id']);

        if (is_object($packageUsage)) {
            $keywords = tagToArray($fields['meta_keyword'])['export']['list'];
            $countCategory = count(explode(',', $fields['category_id']));

            $keyword = new Keyword($keywords);
            $result = $keyword->checkKeyword($packageUsage);

            if ($result['result'] == -1) {
                return $result['error'];
            }

            if ($countCategory > $packageUsage->category) {
                $errors['category'] = "خطا در تعداد دسته بندی";
            }
        }

        foreach ($category_id as $category) {
            $category = category::getBy_Category_id_or_parent_id($category, $category)->getList();
            if ($category['export']['recordsCount'] != 1) {
                $errors['category'] = "خطا در تعداد دسته بندی";
            }
        }

        return $errors;
    }

    /**
     * @param $validate
     * @param $fields
     * @return mixed
     */
    public function checkEmail($validate, $fields)
    {
        $company_draft = company_d::getBy_email_and_not_company_id_and_not_email($fields['email'], $this->company_info['company_id'], '')->first();

        if (is_object($company_draft)) {
            $validate['email'][0] = "این ایمیل قبلا ثبت شده است";
            $validate['result'] = -1;
        }

        return $validate;
    }

    /**
     * @param $fields
     */
    public function showEditFormPassword($fields = array())
    {
        $member = members::getBy_company_id($this->company_info['company_id'])->getList();

        if (!$fields) {
            $export = $member['export']['list']['0'];
        } else {
            $export = array_merge($member['export']['list']['0'], $fields);
        }

        $this->fileName = 'profile.editFromPassword.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     */
    public function editPassword($fields)
    {
        $errors = $this->validateMember($fields);

        if ($errors) {
            $fields['msg'] = $errors['msg'];
            $this->showEditFormPassword($fields);
        }
        $member = members::getBy_company_id($this->company_info['company_id'])->get();

        if ($member['export']['recordsCount'] < 1) {
            $fields['msg'] = "کمپانی وجود ندارد";
            $this->showEditFormPassword();
        }
        $member = $member['export']['list']['0'];

        if ($member->password != md5($fields['password'])) {
            $fields['msg'] = "رمز عبور اشتباه است";
            $this->showEditFormPassword($fields);
        }

        if (empty($fields['newPassword'])) {
            $fields['msg'] = "لطفا رمز عبور جدید را وارد نمایید";
            $this->showEditFormPassword($fields);
        }

        if ($fields['newPassword'] != $fields['reNewPassword']) {
            $fields['msg'] = "رمز عبور جدید با تکرار رمز برابر نیست";
            $this->showEditFormPassword($fields);
        }

        $member->name = $fields['name'];
        $member->family = $fields['family'];
        $member->email = $fields['email'];
        $member->mobile = $fields['mobile'];
        $member->password = md5($fields['newPassword']);
        $result = $member->save();

        if ($result['result'] == -1) {
            $fields['msg'] = "با عرض پوزش تغییر رمز انجام نشد لطفا مجددا اقدام فرمایید";
            $this->showEditFormPassword($fields);
        }
        $msg = 'تغییر رمز با موفقیت انجام شد';
        $this->showProfileForm($msg);
    }

    public function validateMember($input)
    {
        $validator = new GUMP();
        $rules = array(
            'name' => 'required*' . MEMBER_01,
            'family' => 'required*' . MEMBER_02,
            'email' => 'required*' . MEMBER_03 . '|valid_email*' . REGISTER_06,
            'mobile' => 'required*' . MEMBER_04 . '|numeric*' . PHONE_04 . '|max_len,11*' . PHONE_03 . '|min_len,11*' . PHONE_03,
            'newPassword' => 'required*' . MEMBER_06 . '|min_len,8*' . MEMBER_08,
            'reNewPassword' => 'required*' . MEMBER_07 . '|min_len,8*' . MEMBER_08,
        );
        $validator->validate($input, $rules);
        $errors = $validator->get_errors_array();

        return $errors;
    }

    /**
     * @param $msg
     * @return mixed
     */
    public function sendNotification($msg)
    {
        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info['company_id'],
            'to' => 1,
            'msg' => $msg,
            'messageType' => 1
        ];
        $result = $notification->addNotification($fields);
        return $result;
    }

    public function uploadCatalog($fields)
    {
        if ($fields['name'] != '' & $fields['error'] == 0) {
            $typeImg = substr($fields['type'], 0, 5);
            $typePdf = substr($fields['type'], 12, 3);
            if ($typeImg == 'image' || $typePdf == 'pdf') {

                $Property = array('type' => 'jpg,png,jpeg,pdf',
                    'new_name' => $fields['name'],
                    'max_size' => '20971520',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/catalog/"
                );

                $result_uploader = fileUploader($Property, $fields);
                return $result_uploader['image_name'];
            }
        }
        return null;
    }

    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0000000000000001000000000';
        $result = $company->save();
        return $result;
    }

}
