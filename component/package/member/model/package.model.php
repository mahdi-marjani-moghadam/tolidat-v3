<?php
include_once ROOT_DIR . "component/packageUsage/member/model/member.packageUsage.model.php";

class package extends looeic
{
    public function getCompanyPackage($company_id)
    {
        $packageUsage = packageusage::getAll()->where('company_id', '=', $company_id)->first();
        if (is_object($packageUsage)) {
            $package = package::getAll()
                ->leftJoin('packageusage', 'package.Package_id', '=', 'packageusage.package_id')
                ->where('company_id', '=', $company_id)
                ->getList();
        } else {
            $package = package::getAll()
                ->leftJoin('invoice', 'package.Package_id', '=', 'invoice.package_id')
                ->where('company_id', '=', $company_id)
                ->getList();
        }

        if ($package['export']['recordsCount'] > 0) {
            return $package['export']['list'][0];
        }
    }

    public static function getAllPackages()
    {
        $packageList = package::getAll()->where('main', '=', 1)->getList();
        return $packageList['export']['list'];
    }

    public function getValidPackageList($company_id = null)
    {
        $packages = self::getAllPackages();
        $companyPackage[] = $this->getCompanyPackage($company_id);
        $companyPackageNumber = $this->getPackageNumber($companyPackage);


        // dd($company_id,false);

        
        $result = $this->getPackageNumber($packages);       
        $result = array_slice($result, array_keys($companyPackageNumber)[0]);
        return $this->getPackageNumber($result);
    }

    public function getInvalidalidPackageList($company_id)
    {
        $packages = self::getAllPackages();
        $companyPackage[] = $this->getCompanyPackage($company_id);
        $companyPackageNumber = $this->getPackageNumber($companyPackage);
        $result = $this->getPackageNumber($packages);
        $result = array_slice($result, 0, array_keys($companyPackageNumber)[0]);
        return $this->getPackageNumber($result);
    }

    public function getPackageNumber($packages)
    {
        foreach ($packages as $key => $value) {
            switch ($value['packagetype']) {
                case 'رایگان':
                    $value['englishTitle'] = 'free';
                    $result[0] = $value;
                    break;
                case 'برنز' :
                    $value['englishTitle'] = 'bronze';
                    $result[1] = $value;
                    break;
                case 'نقره ای' :
                    $value['englishTitle'] = 'silver';
                    $result[2] = $value;
                    break;
                case 'طلایی' :
                    $value['englishTitle'] = 'gold';
                    $result[3] = $value;
                    break;
                case 'پلاتینیوم' :
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

    public static function getPackageClass($packageType)
    {
        switch ($packageType) {
            case "برنز" :
                return "package-bronze";
            case "نقره ای" :
                return "package-silver";
            case "طلایی" :
                return "package-gold";
            case  "پلاتینیوم" :
                return "package-platinum";
            default :
                return "package-extra";
        }
    }

    public function validPackage($company_id)
    {
        return in_array($this->Package_id, array_keys($this->getValidPackageList($company_id)));
    }

    public function getPackagePrice($company_id)
    {
        $companyPackage = $this->getCompanyPackage($company_id);
        $pricePreviousPackageInDay = $companyPackage['price'] / 365;
        $priceCurrentPackageInDay = $this->price / 365;
        $date1 = new DateTime(strftime('%Y-%m-%d %H:%M:%S', time()));
        $date2 = new DateTime($companyPackage['expiredate']);
        $diff = $date2->diff($date1)->format("%a");

        $pricePreviousPackage = $pricePreviousPackageInDay * $diff;
        $priceCurrentPackage = $priceCurrentPackageInDay * $diff;

        return floor($priceCurrentPackage - $pricePreviousPackage);
    }
}
