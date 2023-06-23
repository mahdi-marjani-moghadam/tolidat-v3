<?php
require_once ROOT_DIR . "component/product/member/model/product.model.php";
require_once ROOT_DIR . "component/certification/member/model/certification.model.php";
require_once ROOT_DIR . "component/honour/member/model/honour.model.php";
require_once ROOT_DIR . "component/history/member/model/history.model.php";
require_once ROOT_DIR . "component/companyNews/member/model/companyNews.model.php";
require_once ROOT_DIR . "component/companyEmails/model/companyEmails.model.php";
require_once ROOT_DIR . "component/companySocials/member/model/companySocials.model.php";
require_once ROOT_DIR . "component/companyBanner/member/model/companyBanner.model.php";
require_once ROOT_DIR . "component/companyLogo/member/model/companyLogo.model.php";
require_once ROOT_DIR . "component/branch/model/branch.model.php";
require_once ROOT_DIR . "component/companyPositions/member/model/companyPosition.model.php";
require_once ROOT_DIR . "component/licence/member/model/licence.model.php";
require_once ROOT_DIR . "component/representation/member/model/representation.model.php";
require_once ROOT_DIR . "component/companyCommercialName/member/model/companyCommercialName.model.php";
require_once ROOT_DIR . "component/company/member/model/member.company.model.php";
require_once ROOT_DIR . "component/register/model/register.model.php";
include_once ROOT_DIR . 'component/package/member/model/package.controller.php';
include_once ROOT_DIR . "component/packageUsage/member/model/member.packageUsage.model.php";
include_once ROOT_DIR . 'component/personalityType/model/personalityType.model.php';
include_once ROOT_DIR . "component/companyAddresses/model/companyAddresses.model.php";
require_once ROOT_DIR . "component/companyPhones/model/companyPhones.model.php";
require_once ROOT_DIR . "component/companyWebsites/model/companyWebsites.model.php";
require_once ROOT_DIR . "component/companyWebsites/model/companyWebsites.model.php";
require_once ROOT_DIR . "component/employment/model/Employment.php";
require_once ROOT_DIR . "component/companyAdvertise/model/Advertise.php";


class Rate
{
    protected $scores;
    protected $score;
    protected $company;
    protected $details = array();

    /**
     * Rate constructor.
     * @param $company
     */
    public function __construct($company = '')
    {
        $this->company = $company;
        $this->scores = require ROOT_DIR . 'model/config.rate.php';
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        // update priority test company with value 0
        $testCompanyIds = [22415, 22417, 22419, 22421];
        foreach ($testCompanyIds as $testCompanyId) {
            if ($this->company->Company_id == $testCompanyId) {
                return 0;
            }
        }

        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    public function addDetails($feature, $count, $score, $package_type = 'رایگان')
    {
        $feature = strtolower($feature);
        if ($feature == 'branch' || $feature == 'representation') {
            $feature = 'representation_branch';
        }

        if (
            $feature == 'company_name' or
            $feature == 'maneger_name' or
            $feature == 'company_description' or
            $feature == 'national_id' or
            $feature == 'licence_number' or
            $feature == 'logo' or
            $feature == 'banner' or
            $feature == 'catalog' or
            $feature == 'video_script' or
            $feature == 'keyword'
        ) {
            $this->details['company_information']['persian_name'] = 'اطلاعات مجموعه';
            $this->details['company_information']['totalScore'] += $score;
            $this->details['company_information']['color'] = $this->getColor('company_information');
            $this->details['company_information']['link'] = $this->getLink('company_information');
            $this->details['company_information'][$feature]['count'] = $count;
            $this->details['company_information'][$feature]['score'] = $score;
            $this->details['company_information'][$feature]['persian_name'] = $this->translateFeature($feature);
        } else if (
            $feature == 'addresses' or
            $feature == 'phones' or
            $feature == 'emails' or
            $feature == 'websites' or
            $feature == 'position' or
            $feature == 'socials'
        ) {
            $this->details['contact_information']['persian_name'] = 'اطلاعات تماس';
            $this->details['contact_information']['totalScore'] += $score;
            $this->details['contact_information']['color'] = $this->getColor('contact_information');
            $this->details['contact_information']['link'] = $this->getLink('contact_information');
            $this->details['contact_information'][$feature]['count'] = $count;
            $this->details['contact_information'][$feature]['score'] = $score;
            $this->details['contact_information'][$feature]['persian_name'] = $this->translateFeature($feature);
        } else {
            $this->details[$feature]['totalScore'] = $score;
            $this->details[$feature]['color'] = $this->getColor($feature);
            $this->details[$feature]['link'] = $this->getLink($feature);
            $this->details[$feature]['count'] = $count;
            $this->details[$feature]['score'] = $score;
            $this->details[$feature]['persian_name'] = $this->translateFeature($feature);
        }

        if ($feature == 'package') {
            $this->details[$feature]['package_type'] = $package_type;
        }
    }

    public function translateFeature($feature)
    {
        switch ($feature) {
            case 'product':
                return "محصولات/خدمات";
            case 'addresses':
                return "آدرس";
            case 'phones':
                return "تلفن";
            case 'websites':
                return "وب سایت";
            case 'commercial_name':
                return "نام تجاری";
            case 'news':
                return "اخبار";
            case 'emails':
                return "ایمیل";
            case 'socials':
                return "شبکه اجتماعی";
            case 'banner':
                return "بنر";
            case 'logo':
                return "لوگو";
            case 'licences':
                return "جواز";
            case 'position':
                return "موقعیت مکانی";
            case 'certification':
                return "گواهی یا افتخارات یا سوابق مشتری";
            case 'honour':
                return "افتخارات";
            case 'history':
                return "سوابق و مشتریان ما";
            case 'representation_branch':
                return "نمایندگی و شعب";
            case 'employment':
                return "فرصت های شغلی";
            case 'advertise':
                return "آگهی ها";
            case 'company_name':
                return "اسم شرکت یا مجموعه";
            case 'maneger_name':
                return "نام مدیرعامل";
            case 'company_description':
                return "فعالیت شرکت";
            case 'keyword':
                return "کلمات کلیدی";
            case 'national_id':
                return "شناسه ملی";
            case 'licence_number':
                return "شماره جواز";
            case 'package':
                return "پکیج";
            case 'total_score':
                return 'امتیاز کل';
            case 'catalog':
                return 'کاتالوگ';
            case 'video_script':
                return 'تیزر تبلیغاتی';
            default:
                return '';
        }
    }

    public function getColor($feature)
    {
        switch ($feature) {
            case 'company_information':
                return '#ff660c';
            case 'product':
                return '#53a547';
            case 'history':
                return '#ffa407';
            case 'commercial_name':
                return '#5212f7';
            case 'honour':
                return '#056fe6';
            case 'representation_branch':
                return '#ff660c';
            case 'news':
                return '#da3464';
            case 'advertise':
                return '#bb50ea';
            case 'employment':
                return '#8989BA';
            case 'contact_information':
                return '#ff660c';
            default:
                return '';
        }
    }

    public function getLink($feature)
    {
        switch ($feature) {
            case 'company_information':
                return RELA_DIR . 'company/Detail/' . $this->company->Company_id . '/' . cleanUrl($this->company->company_name);
            case 'product':
                return RELA_DIR . 'product/all/' . $this->company->Company_id;
            case 'history':
                return RELA_DIR . 'history/all/' . $this->company->Company_id;
            case 'commercial_name':
                return RELA_DIR . 'companyCommercialName/all/' . $this->company->Company_id;
            case 'honour':
                return RELA_DIR . 'honour/all/' . $this->company->Company_id;
            case 'representation_branch':
                return RELA_DIR . 'representation/all/' . $this->company->Company_id;
            case 'news':
                return RELA_DIR . 'companyNews/all/' . $this->company->Company_id;
            case 'advertise':
                return RELA_DIR . 'companyAdvertise/all/' . $this->company->Company_id;
            case 'employment':
                return RELA_DIR . 'employment/all/' . $this->company->Company_id;
            case 'contact_information':
                return RELA_DIR . 'companyContacts/' . $this->company->Company_id;
            default:
                return '';
        }
    }

    /**
     * @return mixed
     */
    public function calculation()
    {
        $this->calculationScore();
        // dd(1);

        return $this->updateCompany();
    }

    public function calculationScore()
    {
        // company_information
        $score = $this->calculateScoreCompanyName($this->scores['company_name']);
        $score += $this->calculateScoreManagerName($this->scores['manager_name']);
        $score += $this->calculateScoreCompanyDescription();
        $score += $this->calculateScoreNationalId($this->scores['national_id']);
        $score += $this->calculateScoreLicenceNumber($this->scores['licence_number']);
        $score += $this->calculateScore('c_logo', $this->scores['logo']);
        $score += $this->calculateScore('c_banner', $this->scores['banner']);
        $score += $this->calculateScoreKeyword($this->scores['keyword']);
        $score += $this->calculateScoreCatalog($this->scores['catalog']);
        $score += $this->calculateScoreVideo($this->scores['video_script']);

        // other information
        $score += $this->calculateScoreProduct();
        $score += $this->calculateScore('c_history', $this->scores['history']);
        $score += $this->calculateScore('c_commercial_name', $this->scores['commercial_name']);
        $score += $this->calculateScore('c_honour', $this->scores['honour']);
        $score += $this->calculateScore('c_news', $this->scores['news']);

        if (
            $this->calculateScore('c_branch', $this->scores['branch']) ||
            $this->calculateScore('c_representation', $this->scores['representation'])
        ) {
            $score += $this->scores['branch'];
        }
        $score += $this->calculateScore('c_advertise', $this->scores['advertise']);
        $score += $this->calculateScore('Employment', $this->scores['employment']);

        // contact_information
        $score += $this->calculateScore('c_addresses', $this->scores['address']);
        $score += $this->calculateScore('c_phones', $this->scores['phone']);
        $score += $this->calculateScore('c_emails', $this->scores['email']);
        $score += $this->calculateScore('c_websites', $this->scores['website']);
        $score += $this->calculateScore('c_position', $this->scores['position']);
        $score += $this->calculateScore('c_socials', $this->scores['social']);

        if ($score > 100) {
            $this->setScore(100);
        } else {
            $this->setScore(round($score));
        }

        return $this->getScore();
    }

    /**
     * @param $model
     * @return int
     */
    public function calculateScore($model, $score)
    {
        if ($model == 'c_licences' || $model == 'c_position' || $model == 'c_branch') {
            $count = $model::getBy_company_id_and_status_and_isActive($this->company->Company_id, 2, 1)->getList()['export']['recordsCount'];
        } elseif ($model == 'Employment' || $model == 'c_advertise') {
            $count = $model::getAll()->where('company_id', '=', $this->company->Company_id)->where('status', '=', 2)->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))->getList()['export']['recordsCount'];
        } elseif ($model == 'c_representation') {
            $count = $model::getBy_company_id_and_confirm($this->company->Company_id, 1)->getList()['export']['recordsCount'];
        } else {
            $count = $model::getBy_company_id($this->company->Company_id)->getList()['export']['recordsCount'];
        }

        $feature = $model != 'Employment' ? substr($model, 2) : $model;

        if ($count >= 1) {
            $this->addDetails($feature, $count, $score);
            return $score;
        }

        return 0;
    }

    public function calculateScoreKeyword($score)
    {
        $keyword = explode(',', trim($this->company->meta_keyword));

        if (empty($keyword[0])) {
            return 0;
        }

        $this->addDetails('keyword', count($keyword), $score);
        return $score;
    }

    public function calculateScorePackage()
    {
        $model = new package();
        $package = $model->getCompanyPackage($this->company->Company_id);

        switch ($package['packagetype']) {
            case 'برنز':
                $score = 1;
                break;
            case 'نقره ای':
                $score = 1.02;
                break;
            case 'طلایی':
                $score = 1.05;
                break;
            case 'پلاتینیوم':
                $score = 1.08;
                break;
            default:
                $score = 1;
                break;
        }

        $this->addDetails('package', 1, $score, $package['packagetype']);
        return $score;
    }

    public function getPackage()
    {
        $model = new package();
        $package = $model->getCompanyPackage($this->company->Company_id);

        switch ($package['packagetype']) {
            case 'برنز':
                $score = 15;
                break;
            case 'نقره ای':
                $score = 15;
                break;
            case 'طلایی':
                $score = 20;
                break;
            case 'پلاتینیوم':
                $score = 20;
                break;
            default:
                $score = 10; // free company
                $package['packagetype'] = 'رایگان';
                break;
        }

        $result['score'] = $score;
        $result['packagetype'] = $package['packagetype'];

        return $result;
    }

    public function calculateScoreNationalId($score)
    {
        if ($this->company->company_type == 1 & $this->company->national_id != '') {
            $this->addDetails('national_id', 1, $score);
            return $score;
        }

        return 0;
    }

    public function calculateScoreLicenceNumber($score)
    {
        if ($this->company->company_type == 2) {
            $licence = c_licences::getBy_company_id_and_status_and_isActive_and_isMain($this->company->Company_id, 2, 1, 1)->first();
            if (is_object($licence)) {
                $this->addDetails('licence_number', 1, $score);
                return $score;
            }
        }

        return 0;
    }

    public function calculateScoreProduct()
    {
        $package = $this->getPackage();

        $products = c_product::getAll()->where('company_id', '=', $this->company->Company_id)->getList();

        //        $this->addDetails('package', 1, $package['score'], $package['packagetype']);

        if ($products['export']['recordsCount'] <= 0) {
            return 0;
        }

        $scoreEveryProduct = $package['score'] / $products['export']['recordsCount'];
        $score = 0;

        foreach ($products['export']['list'] as $product) {
            $scoreProduct = $this->checkKeyword($product, $scoreEveryProduct);
            $scoreProduct += $this->checkImage($product, $scoreEveryProduct);
            $scoreProduct += $this->checkDescription($product, $scoreEveryProduct);
            $score += $scoreProduct;
        }

        $this->addDetails('product', $products['export']['recordsCount'], round($score));

        return $score;
    }

    public function checkKeyword($product, $scoreEveryProduct)
    {
        $score = 0;
        $arrayKeyword = tagToArray($product['meta_keyword'])['export']['list'];
        $countArrayKeyword = count($arrayKeyword);

        $rangeScore = $this->getRangeScore($this->scores['product']['keyword'], $countArrayKeyword);

        if ($rangeScore) {
            $score = $rangeScore * $scoreEveryProduct / 100;
        }

        return $score;
    }

    public function checkImage($product, $scoreEveryProduct)
    {
        $score = 0;

        if (!empty($product['image'])) {
            $score = 20 * $scoreEveryProduct / 100;
        }

        return $score;
    }

    public function checkDescription($product, $scoreEveryProduct)
    {
        $score = 0;

        $words = explode(' ', $product['description']);

        $arrayDescription = array_filter($words, function ($var) {
            if ($var != 'و') {
                return $var;
            }
        });

        $countArrayDescription = count($arrayDescription);

        $rangeScore = $this->getRangeScore($this->scores['product']['description'], $countArrayDescription);

        if ($rangeScore) {
            $score = $rangeScore * $scoreEveryProduct / 100;
        }

        return $score;
    }

    public function calculateScoreCompanyDescription()
    {
        $words = explode(' ', $this->company->description);

        $arrayDescription = array_filter($words, function ($var) {
            if ($var != 'و') {
                return $var;
            }
        });
        $countArrayDescription = count($arrayDescription);

        $score = $this->getRangeScore($this->scores['company_description'], $countArrayDescription);

        $this->addDetails('company_description', $countArrayDescription, $score);

        return $score;
    }

    public function calculateScoreCatalog($score)
    {
        if (trim($this->company->catalog) != '') {
            $this->addDetails('catalog', 1, $score);
            return $score;
        }

        return 0;
    }

    public function calculateScoreVideo($score)
    {
        if (trim($this->company->video_script) != '') {
            $this->addDetails('video_script', 1, $score);
            return $score;
        }

        return 0;
    }

    public function getRangeScore($ranges, $count)
    {
        foreach ($ranges as $range) {

            if ($range['max'] == 'end') {
                $condition = $count >= $range['min'];
            } else {
                $condition = $count >= $range['min'] & $count <= $range['max'];
            }

            if ($condition) {
                return $range['score'];
            }
        }

        return 0;
    }

    public function calculateScoreManagerName($score)
    {
        if (trim($this->company->maneger_name) != '') {
            $this->addDetails('maneger_name', 1, $score);
            return $score;
        }

        return 0;
    }

    public function calculateScoreCompanyName($score)
    {
        if (trim($this->company->company_name) != '') {
            $this->addDetails('company_name', 1, $score);
            return $score;
        }

        return 0;
    }

    public function updateCompany()
    {
        //        $this->company->priority = $this->getScore();
        //        $this->company->priorityDetails = json_encode($this->details, JSON_UNESCAPED_UNICODE);
        $this->company->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());
        $this->company->priority = $this->getScore();
        $this->company->priority_details = json_encode($this->details, JSON_UNESCAPED_UNICODE);
        $this->company->package_id = 0;
        $this->company->confirm_date = date('Y-m-d');
        $this->company->lock = 0;
        $this->company->personality_type = 1;

        if (!is_numeric($this->company->city_id)) {
            $this->company->city_id = 0;
        }
        $result = $this->company->save();



        if ($result['result'] != 1) {
            return $result;
        }

        $company_d = company_d::getAll()
            ->where('company_id', '=', $this->company->Company_id)
            ->where('status', '=', 1)
            ->where('isActive', '=', 1)
            ->get()['export']['list'][0];

        if (is_object($company_d)) {
            //            $company_d->priority = $this->getScore();
            //            $company_d->priorityDetails = json_encode($this->details, JSON_UNESCAPED_UNICODE);
            $company_d->refresh_date = strftime('%Y-%m-%d %H:%M:%S', time());

            $company_d->priority = $this->getScore();
            $company_d->priority_details = json_encode($this->details, JSON_UNESCAPED_UNICODE);
            if ($company_d->city_id == '')
                $company_d->city_id = 0;
            $company_d->personality_type = ($company_d->personality_type == '') ? 1 : $company_d->personality_type;
            $company_d->register_date = ($company_d->register_date == '') ? date('Y-m-d H:i:s') : $company_d->register_date; //$companyDraftObject->register_date;

            $result = $company_d->save();
        }


        return $result;
    }

    public function rate($company)
    {
        // get package type
        $packageUsage = packageusage::getBy_company_id($company->Company_id)->first();
        if (!is_object($packageUsage)) {
            $export['package_type'] = 'ندارد';
        }
        if (is_object($packageUsage)) {
            $package = package::find($packageUsage->package_id);
            if (is_object($package)) {
                $export['package_type'] = $package->packagetype;
                if ($package->packagetype == "برنز") {
                    $export['package_class'] = "package-bronze";
                } elseif ($package->packagetype == "نقره ای") {
                    $export['package_class'] = "package-silver";
                } elseif ($package->packagetype == "طلایی") {
                    $export['package_class'] = "package-gold";
                } elseif ($package->packagetype == "پلاتینیوم") {
                    $export['package_class'] = "package-platinum";
                }
            }
        }

        // get personality type
        if ($company->company_type == 1) {
            $export['personality_type'] = 'حقوقی';
        } else {
            $export['personality_type'] = 'حقیقی';
        }
        /*$personalityType = personality_type::find($company->personality_type);
        if (!is_object($personalityType)) {
            if ($company->company_type == 1) {
                $export['personality_type'] = 'حقوقی';
            }
            if ($company->company_type == 2) {
                $export['personality_type'] = 'حقیقی';
            } else {
                $export['personality_type'] = 'حقوقی';
            }
        }
        if (is_object($personalityType)) {
            $export['personality_type'] = $personalityType->type;
        }*/

        $products = c_product::getBy_company_id($company->Company_id)->getList();
        $export['product_count'] = $products['export']['recordsCount'];

        return $export;
    }
}
