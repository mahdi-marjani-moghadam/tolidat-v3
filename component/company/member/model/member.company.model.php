<?php

class company extends looeic
{

    public function updatePackageStatus($id)
    {
        $company = company::find($id);
        if (is_object($company)) {
            $company->package_status = 3;
            $company->save();

            // Update company_d
            $company_d = company_d::getBy_company_id_and_isActive($company->Company_id, 1)->first();
            if (is_object($company_d)) {
                $company_d->package_status = 3;
                $company_d->save();
                return true;
            }
            return false;
        }
        return false;
    }

    public static function setDataToApi()
    {

        $append_company = array('formatter' => function ($list, $internal) {

            $list['rate'] = $list['priority'];

            $list['refresh_date'] = convertDate($list['refresh_date']);
            if (trim($list['image']) == '') {
                $list['logoUrl'] = DEFULT_LOGO_ADDRESS;
            } else {
                $list['logoUrl'] = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            }

            $list['videoUrl'] = videoUrl($list['video_script']);


            if ($list['catalog'] == '') {
                $list['catalogUrl'] = '';
            }
            $list['catalogUrl'] = COMPANY_ADDRESS . $list['Company_id'] . '/catalog/' . $list['catalog'];


            if ($list['company_type'] == 1) {
                $list['company_type_name'] = 'حقوقی';
            } else {
                $list['company_type_name'] = 'حقیقی';
            }

            $package_name = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($package_name == '') {
                $list['package_type'] = 'رایگان';
            } else {
                $list['package_type'] = $package_name;
            }

            if ($list['package_id'] == '') {
                $list['package_id'] = '0';
            }

            return $list;
        });
        return $append_company;
    }

    public static function setDataToApiOLD()
    {
        $append_company['rate'] = array('formatter' => function ($list) {
            $st = $list['priority'];
            return $st;
        });
        $append_company['refresh_date'] = array('formatter' => function ($list) {
            return convertDate($list['refresh_date']);
        });
        $append_company['logoUrl'] = array('formatter' => function ($list) {
            if (trim($list['image']) == '') {
                return DEFULT_LOGO_ADDRESS;
            }
            $st = STATIC_RELA_DIR . '/images/company/' . $list['Company_id'] . '/logo/' . $list['image'];
            return $st;
        });

        $append_company['videoUrl'] = array('formatter' => function ($list) {

            $st = "https://www.aparat.com/v/hKGMP";
            return $st;
        });

        $append_company['catalogUrl'] = array('formatter' => function ($list) {
            if ($list['catalog'] == '') {
                return '';
            }
            return COMPANY_ADDRESS . $list['Company_id'] . '/catalog/' . $list['catalog'];
        });
        $append_company['company_type_name'] = array('formatter' => function ($list) {
            if ($list['company_type'] == 1) {
                $st = 'حقوقی';
            } else {
                $st = 'حقیقی';
            }
            return $st;
        });

        $append_company['package_type'] = array('formatter' => function ($list, $internal) {
            $st = $internal['packageList']['data'][$list['package_id']]['packagetype'];
            if ($st == '') {
                $st = 'رایگان';
            }
            return $st;
        });

        $append_company['package_id'] = array('formatter' => function ($list) {
            $st = $list['package_id'];
            if ($st == '') {
                $st = '0';
            }
            return $st;
        });
        return $append_company;

    }

}

class send_token extends looeic
{

}

class category_company extends looeic{}