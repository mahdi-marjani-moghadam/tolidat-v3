<?php
include_once dirname(__FILE__) . '/branch.model.php';
include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
include_once ROOT_DIR . 'component/city/model/city.controller.php';
include_once ROOT_DIR . 'component/province/model/province.controller.php';
include_once ROOT_DIR . 'component/companyAddresses/member/model/companyAddresses.controller.php';
include_once ROOT_DIR . 'component/companyPhones/member/model/companyPhones.controller.php';
include_once ROOT_DIR . 'component/companyEmails/member/model/companyEmails.controller.php';
include_once ROOT_DIR . 'component/companyWebsites/member/model/companyWebsites.controller.php';
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.controller.php';
include_once(ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.model.php");
include_once ROOT_DIR . 'component/branch/model/branch.model.php';
include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.model.php';

class branchController
{

    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }

    public function template($list = [],$msg = '')
    {
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

    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0000000100000000100000000';
        $result = $company->save();
        return $result;
    }

    public function addBranch($fields)
    {
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['parent_id'] = 0;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['isActive'] = 1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());


        $package_model = adminpackageusageModel::checkPackageUsage($fields['company_id'], 'add', 'branch');

        if (!is_object($package_model)) {
            echo json_encode($package_model);
            die();
        }
        $branch = new c_branch();
        $branch->setFields($fields);
        $branch->save();

        $branch->parent_id = $branch->Branch_id;
        $branch->save();

        $result = $this->updateCompany($fields['company_id']);
        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        //update package usage branch
        $package_model->save();
        $package_model->result = 1;
        echo json_encode($package_model);
        die();

    }

    public function branchInformation()
    {

        $mainBranch = $this->getMainBranchInformation();

        $company = company::find($this->company_info['company_id']);
        $branchs = c_branch::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();

        $contacts = $branchs['export']['list'];

        foreach ($contacts as $key => $value) {

            $branchs_id = c_branch::find($contacts[$key]['Branch_id']);
            if ($company->package_status == 4) {
                $branch[$key]['address'] = c_addresses_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();

                if ($branch[$key]['address']['export']['recordsCount'] != 0) {
                    $contacts[$key]['address'] = $branch[$key]['address']['export']['list'];
                }
                $branch[$key]['phone'] = c_phones_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();
                if ($branch[$key]['phone']['export']['recordsCount'] != 0) {
                    $contacts[$key]['phone'] = $branch[$key]['phone']['export']['list'];
                }
            }

            $branch[$key]['email'] = c_emails_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();
            if ($branch[$key]['email']['export']['recordsCount'] != 0) {
                $contacts[$key]['email'] = $branch[$key]['email']['export']['list'];
            }

            $branch[$key]['website'] = c_websites_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();
            if ($branch[$key]['website']['export']['recordsCount'] != 0) {
                $contacts[$key]['website'] = $branch[$key]['website']['export']['list'];
            }

            $branch[$key]['position'] = c_position::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();
            if ($branch[$key]['position']['export']['recordsCount'] != 0) {
                $contacts[$key]['position'] = $branch[$key]['position']['export']['list']['0'];
            }

            $branch[$key]['social'] = c_socials_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], $branchs_id->parent_id, 1)->getList();
            if ($branch[$key]['social']['export']['recordsCount'] != 0) {
                $contacts[$key]['social'] = $branch[$key]['social']['export']['list'];
                $i= 0;
                    foreach ($contacts[$key]['social'] as $fields => $value) {
                        $social_type = social_type::find($value['social_type_id']);
                        $contacts[$key]['social'][$i++]['social_type_id'] = $social_type->type;
                    }
            }
        }
        if (!count($contacts)) {
            return $mainBranch;
        }

        return array_merge($mainBranch, $contacts);

    }


    public function getMainBranchInformation()
    {
        $company = company::find($this->company_info['company_id']);
        if ($company->package_status == 4) {
            $branch[0]['address'] = c_addresses_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
            if ($branch[0]['address']['export']['recordsCount'] != 0) {
                $contacts[0]['address'] = $branch[0]['address']['export']['list'];
            }
            $branch[0]['phone'] = c_phones_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
            if ($branch[0]['phone']['export']['recordsCount'] != 0) {
                $contacts[0]['phone'] = $branch[0]['phone']['export']['list'];
            }
        }
        $branch[0]['email'] = c_emails_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
        if ($branch[0]['email']['export']['recordsCount'] != 0) {
            $contacts[0]['email'] = $branch[0]['email']['export']['list'];
        }

        $branch[0]['position'] = c_position::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
        if ($branch[0]['position']['export']['recordsCount'] != 0) {
            $contacts[0]['position'] = $branch[0]['position']['export']['list']['0'];
        }

        $branch[0]['website'] = c_websites_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
        if ($branch[0]['website']['export']['recordsCount'] != 0) {
            $contacts[0]['website'] = $branch[0]['website']['export']['list'];
        }
        $branch[0]['social'] = c_socials_d::getBy_company_id_and_branch_id_and_isActive($this->company_info['company_id'], 0, 1)->getList();
        if ($branch[0]['social']['export']['recordsCount'] != 0) {
            $contacts[0]['social'] = $branch[0]['social']['export']['list'];
            $i= 0;
            foreach ($contacts[0]['social'] as $fields => $value) {
                $social_type = social_type::find($value['social_type_id']);
                $contacts[0]['social'][$i++]['social_type_id'] = $social_type->type;
            }
        }
        $contacts[0]['branch_name'] = "دفتر مرکزی";
        $contacts[0]['Branch_id'] = "0";
        $contacts[0]['socials'] = social_type::getAll()->getList()['export']['list'];
        return $contacts;
    }

    public function editBranch($fields)
    {

        $branch = c_branch::find($fields['Branch_id']);
        $branch->branch_name = $fields['branch_name'];
        $branch->state_id = $fields['state_id'];
        $branch->city_id = $fields['city_id'];
        $branch->maneger_name = $fields['maneger_name'];
        $branch->date = strftime('%Y-%m-%d %H:%M:%S', time());
        if (!is_object($branch)) {
            $result['msg'] = 'شعبه مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $branch->company_id) {
            $result['msg'] = 'کمپانی مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($branch->status != -1) {
            $this->UpdateAndAddNewBranch($branch->fields);
            echo json_encode($branch);
            die();
        }
        if ($branch->status == -1) {
            $branch->setFields($branch->fields);
            $branch->save();
            $result = $this->updateCompany($branch->company_id);
            if ($result['result'] == -1) {
                $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
                echo json_encode($result);
                die();
            }
            echo json_encode($branch);
            die();
        }
    }

    public function UpdateAndAddNewBranch($branch)
    {
        $newBranch = new c_branch();
        $newBranch->setFields($branch);
        $newBranch->status = -1;
        $newBranch->isActive = 1;

        $newBranch->save();
        $newBranch->updateAll();
        $result = $this->updateCompany($newBranch->company_id);
        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $newBranch->fields;
        return $result;
    }

    public function getBranchByid($id)
    {
        $branch = c_branch::find($id);
        if (is_object($branch)) {
            $province = new provinceController();
            $result['provinces'] = $province->getProvince();
            $cityObject = new cityController();
            $city = $cityObject->getCity($branch->state_id);
            $result['city'] = $city;
            $result['result'] = 1;
            $result['fields'] = $branch->fields;
            return $result;
        }
        return $branch;
        die();
    }

    public function getBranchByidAjax($id)
    {
        $json = $this->getBranchByid($id['Branch_id']);
        echo json_encode($json);
        die();
    }

    public function getProvince($id)
    {
        $branch = c_branch::find($id['id']);
        $province = new provinceController();
        $provinces = $province->getProvince();
        $export['province'] = $provinces;
        echo json_encode($branch->state_id);
        die();
    }

    public function deleteBranch($id)
    {
        $branch = c_branch::find($id['id']);

        if (!is_object($branch)) {
            $result['msg'] = 'رکورد مورد نظر یافت نشد';

            echo json_encode($result);
            die();
        }
        if ($branch->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        $result = $result = $this->deleteAll($branch);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $package_model = adminpackageusageModel::checkPackageUsage($branch->company_id, 'delete', 'branch');

        if (!is_object($package_model)) {
            echo json_encode($package_model);
            die();
        }
        //update package usage branch
        $package_model->save();

        if ($branch->status == 1) {
            calculateScoreCompany($branch->company_id);
        }
        $result['fields'] = $branch->fields;
        $result['msg'] = "شعبه مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($branch)
    {
        $branch = c_branch::getBy_parent_id($branch->parent_id)->get();

        foreach ($branch['export']['list'] as $branch) {
            $result = $branch->delete();
            if ($result['result'] == -1) {
                $result['msg'] = 'شعبه مورد نظر حذف نشد';
                return $result;
            }

            $addresses = c_addresses_d::getBy_company_id_and_branch_id_and_isMain($branch->company_id, $branch->Branch_id, 0)->get();
            foreach ($addresses['export']['list'] as $address) {
                $result = $address->delete();
                if ($result['result'] == -1) {
                    $result['msg'] = 'آدرس مورد نظر حذف نشد';
                    return $result;
                }
            }

            $phones = c_phones_d::getBy_company_id_and_branch_id_and_isMain($branch->company_id, $branch->Branch_id, 0)->get();
            foreach ($phones['export']['list'] as $phone) {
                $result = $phone->delete();
                if ($result['result'] == -1) {
                    $result['msg'] = 'تلفن مورد نظر حذف نشد';
                    return $result;
                }
            }
            $emails = c_emails_d::getBy_company_id_and_branch_id($branch->company_id, $branch->Branch_id)->get();
            foreach ($emails['export']['list'] as $email) {
                $result = $email->delete();
                if ($result['result'] == -1) {
                    $result['msg'] = 'ایمیل مورد نظر حذف نشد';
                    return $result;
                }
            }
            $websites = c_websites_d::getBy_company_id_and_branch_id($branch->company_id, $branch->Branch_id)->get();
            foreach ($websites['export']['list'] as $website) {
                $result = $website->delete();
                if ($result['result'] == -1) {
                    $result['msg'] = 'وب سایت مورد نظر حذف نشد';
                    return $result;
                }
            }
            $socials = c_socials_d::getBy_company_id_and_branch_id($branch->company_id, $branch->Branch_id)->get();
            foreach ($socials['export']['list'] as $social) {
                $result = $social->delete();
                if ($result['result'] == -1) {
                    $result['msg'] = 'شبکه اجتماعی مورد نظر حذف نشد';
                    return $result;
                }
            }
        }
    }

}

