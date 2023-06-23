<?php
/*include file */
include_once dirname(__FILE__) . '/admin.branch.model.php';
include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
include_once ROOT_DIR . 'component/province/model/province.controller.php';

/**
 * Class branchController
 */
class branchController
{
    /**
     * branchController constructor.
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . '404');
        }
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }

    public function template($list = [], $msg = '')
    {
        switch ($this->exportType) {
            case 'html':
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

    public function branchInformation()
    {

        $branchs = adminc_branchModel::getBy_company_id($this->company_info['company_id'])->getList();
        $contacts = $branchs['export']['list'];

        foreach ($contacts as $key => $value) {
            $branch[$key]['address'] = c_addresses_d::getBy_company_id_and_branch_id($this->company_info['company_id'], $contacts[$key]['Branch_id'])->getList();
            if ($branch[$key]['address']['export']['recordsCount'] != 0) {
                $contacts[$key]['address'] = $branch[$key]['address']['export']['list'];
            }
            $branch[$key]['phone'] = c_phones_d::getBy_company_id_and_branch_id($this->company_info['company_id'], $contacts[$key]['Branch_id'])->getList();
            if ($branch[$key]['phone']['export']['recordsCount'] != 0) {
                $contacts[$key]['phone'] = $branch[$key]['phone']['export']['list'];
            }
            $branch[$key]['email'] = c_emails_d::getBy_company_id_and_branch_id($this->company_info['company_id'], $contacts[$key]['Branch_id'])->getList();
            if ($branch[$key]['email']['export']['recordsCount'] != 0) {
                $contacts[$key]['email'] = $branch[$key]['email']['export']['list'];
            }
            $branch[$key]['website'] = c_websites_d::getBy_company_id_and_branch_id($this->company_info['company_id'], $contacts[$key]['Branch_id'])->getList();
            if ($branch[$key]['website']['export']['recordsCount'] != 0) {
                $contacts[$key]['website'] = $branch[$key]['website']['export']['list'];
            }
            $branch[$key]['social'] = c_socials_d::getBy_company_id_and_branch_id($this->company_info['company_id'], $contacts[$key]['Branch_id'])->getList();
            if ($branch[$key]['social']['export']['recordsCount'] != 0) {
                $contacts[$key]['social'] = $branch[$key]['social']['export']['list'];
            }
        }

        $this->setBranchInformation();

        return $contacts;
    }

    public function setBranchInformation()
    {
        $province = new adminStateModel();
        $resultProvince = $province->getStates();
        if ($resultProvince['result'] == 1) {
            $export['provinces'] = $province->list;
        }
        $city = new adminCityModel();
        $resultCity = $city->getCities();
        if ($resultCity['result'] == 1) {
            $export['cities'] = $city->list;
        }
        $personality_type = personality_type::getAll()->getList();
        $export['personalityType'] = $personality_type['export']['list'];

        echo json_encode($export);

    }

    public function getProvince()
    {
        $province = new provinceController();
        $provinces = $province->getProvince();
        echo json_encode($provinces);
        die();
    }

    public function checkBranch($branch_id)
    {
        $branch = adminc_branchModel::getBy_parent_id_and_status($branch_id,2)->getList();
        //print_r_debug($branch);
        if ($branch['export']['recordsCount'] <= 0) {
            return false;


        }
        return true;
    }

    public function showList($fields)
    {
        //print_r_debug($fields);
        $result = adminc_branchModel::getBy_status_and_company_id_and_isActive(2,$fields['company_id'],1)->getList();
        //print_r_debug($result);
        if ($result['result'] != '1') {
            $this->fileName = 'admin.branch.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $export['company_id'] = $fields['company_id'];
        $export['branch_id'] = $fields['branch_id'];
        $this->fileName = 'admin.branch.showList.php';
        $this->template($export);
        die();
    }

    public function addBranch($fields)
    {

        $fields['status'] = 2;
        $fields['isActive'] = 1;
        $fields['isAdmin'] = 1;
        $fields['parent_id'] = 0;
        $fields['date'] = date('Y-m-d H:i:s');
        $fields['admin_description'] = '';
        $branch = new adminc_branchModel();
        $result = $branch->setFields($fields);
        if ($result['result'] == -1) {
            return $result;
        }

        $result = $branch->save();
        $branch->parent_id = $branch->Branch_id;
        $branch->save();
        if ($result['result'] != '1') {
            $this->showBranchAddForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=branch&company_id=' . $fields['company_id'], $msg);
        die();

    }

    public function showBranchAddForm($fields, $msg)
    {

        $count = $this->getByCompanyId($fields['company_id'], $fields['branch_id']);
        if (getPackageUsage($fields['company_id']) <= $count['export']['recordsCount']) {
            $msg = "حداکثر تعداد موجود در بسته استفاده است";
            redirectPage(RELA_DIR . "admin/index.php?component=branch", $msg);
        }


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

        $export['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.branch.addForm.php';
        $this->template($export, $msg);
        die();
    }

    public function editBranch($fields)
    {
        $branch = adminc_branchModel::find($fields['branch_id']);
        $branch->isActive = 0;
        $branch->isAdmin = 1;
        $branch->status = 1;
        $branch->save();
        $branch2 = new adminc_branchModel();
        $result = $branch2->setFields($fields);
        if ($result['result'] == -1) {
            return $result;
        }

        $branch2->parent_id = $branch->parent_id;

        $branch2->isActive = 1;
        $branch2->status = 2;
        $branch2->isAdmin = 1;

        $branch2->save();

        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=branch&company_id=' . $fields['company_id'], $msg);
        die();

    }

    public function showBranchEditForm($fields, $msg)
    {
        $branch = adminc_branchModel::find($fields['branch_id']);

        if (!is_object($branch)) {
            $msg = 'صفحه مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/index.php?component=branch', $msg);
        }
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
        $export['branch'] = $branch->fields;

        $export['company_id'] = $fields['company_id'];
        $this->fileName = 'admin.branch.editForm.php';
        $this->template($export, $msg);
        die();
    }

    public function deleteBranch($fields)
    {

        $branch = adminc_branchModel::find($fields['branch_id']);
        $result = $branch->delete();
        if ($result['result'] != '1') {
            $this->showPackageEditForm($fields, $result['msg']);
        }
        $msg = 'عملیات با موفقیت انجام شد';
        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=branch&company_id=' . $fields['company_id'], $msg);
        die();
    }

    public function getByCompanyId($company_id, $branch_id = 0)
    {
        $branch = adminc_branchModel::getBy_Company_id_and_branch_id($company_id, $branch_id)->getList();
        return $branch;
    }

    /**
     * @param $fields
     *
     * @return mixed
     *
     * @author VAHED
     * @date 4/24/2018
     *
     * @version 01.01.01
     */
    public function getAllByCompanyId($company_id)
    {
        $branchResult = adminc_branchModel::getBy_company_id($company_id)->getList();
        return $branchResult;
    }


    //---------------------------------------draft CompanyPhone----------
    public function showDraftBranch($id)
    {
        $branchObject = adminc_branchModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->getList();


        if ($branchObject['export']['recordsCount'] <= 0) {
            if($branchObject['export']['recordsCount']==0)
            {
                $countObject = adminc_branchModel::getBy_status_and_company_id_and_isActive(-1, $id, 1)->getList();

                $item['id'] = $id;
                $item['componentName'] = 'branch';
                $item['countItem'] = $countObject['export']['recordsCount'];
                calculateScoreCompany($id);
                $this->editCompany($item);
                $msg = "هیچ شعبه ای موجود نمی باشد";
                redirectPage(RELA_DIR . "admin/index.php?component=company&action=showDraftCompany", $msg);
            }
            $this->fileName = 'admin.branchDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }

        $export['list'] = $branchObject['export']['list'];
        $this->fileName = 'admin.branchDraft.showList.php';
        $this->template($export);
        die();
    }

    public function editDraftBranchForm($fields)
    {
        $count = $this->getByCompanyId($fields['company_id'], $fields['branch_id']);
        if (getPackageUsage($fields['company_id']) <= $count['export']['recordsCount']) {
            $msg = "حداکثر تعداد موجود در بسته استفاده است";
            redirectPage(RELA_DIR . "admin/index.php?component=branch", $msg);
        }


        $branchObject = adminc_branchModel::find($fields['branch_id']);
        if (is_object($branchObject)) {


            $export['branchInfo'] = $branchObject->fields;


            //Get all State
            include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
            $state = new adminStateModel();
            $resultState = $state->getStates();
            if ($resultState['result'] == 1) {
                $export['provinces'] = $state->list;
            }


            $this->fileName = 'admin.branchDraft.editForm.php';
            $this->template($export);
            die();

        } else {
            $msg = $branchObject['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=branch", $msg);
        }
    }

    public function editDraftBranch($fields)
    {
        global $admin_info;

        $branchObject = adminc_branchModel::find($fields['branch_id']);

        $previousBranchObject = adminc_branchModel::getBy_company_and_parent_id_and_status_and_isActive($branchObject->company_id, $branchObject->parent_id, 1, 1)->first();

        if (is_object($previousBranchObject)) {
            //------> Edit previous Branch
            $previousBranchObject->isActive = 0;
            $previousBranchObject->save();
        }

        //------> Edit Draft Branch
        $branchObject->status = 1;
        $branchObject->isActive = 0;
        $branchObject->isActive = 0;
        $branchObject->save();
        //------> Insert Branch
        $newBranchObject = new adminc_branchModel();
        $newBranchObject->setFields($fields);
        $newBranchObject->parent_id = $branchObject->parent_id;
        $newBranchObject->isAdmin = 1;
        $newBranchObject->company_id = $branchObject->company_id;
        $newBranchObject->status = 2;
        $newBranchObject->isActive = 1;
        $newBranchObject->save();


        //print_r_debug($draftObject);

        $countObject = adminc_branchModel::getBy_status_and_company_id_and_isActive(-1, $branchObject->company_id, 1)->getList();

        $item['id'] = $branchObject->company_id;
        $item['componentName'] = 'branch';
        $item['countItem'] = $countObject['export']['recordsCount'];
        calculateScoreCompany($fields['company_id']);
        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);





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


        ///draft to Main

        if ($draftObject->$fields['draft_f_key'] == 0) {
            $mainObject = new $fields['mainModel'];// when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];

        } else {
            $mainObject = $fields['mainModel']::find($draftObject->$fields['draft_f_key']);// when main row is edit
            if (!is_object($mainObject)) {
                $msg = "رکورد اصلی یافت نشد! ";
                redirectPage(RELA_DIR . 'admin/index.php?component=' . $fields['componentName'] . '&action=showDraft' . ucfirst($fields['componentName']) . '&id=' . $fields['draftModel']->company_id, $msg);
            }
        }

        $mainObject->setFields($fields);
        $mainObject->save();

//if new record add main save to draft

        $newDraftObject = new $fields['draftModel'];
        $newDraftObject->setFields($mainObject->fields);
        $newDraftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();


//update Draft
        if ($draftObject->$fields['draft_f_key'] == 0) {  //if add new object
            $draftObject->$fields['draft_f_key'] = $mainObject->$fields['main_p_key'];
        }
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        //$draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();
        // add New Notification
        $notification = new adminNotificationController();
        $Items = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به تلفن شما با موفقیت اعمال شد",
            'messageType' => 2
        ];
        $notification->addNotification($Items);
    }

    public function rejectDraft($draftObject, $fields)
    {
        //Previous Draft
        if ($draftObject->$fields['draft_f_key'] != 0) {

            $a = "getBy_" . $fields['draft_f_key'] . "_and_company_id_and_isActive";
            $p_productDraftObject = $fields['draftModel']::$a($draftObject->$fields['draft_f_key'], $draftObject->company_id, 0)->orderBy($fields['draft_p_key'], 'DESC')->first();
            $p_productDraftObject->isActive = 1;
            $p_productDraftObject->status = 1;
            $p_productDraftObject->isAdmin = 1;
            $p_productDraftObject->editor_id = $fields['editor_id'];
            $p_productDraftObject->save();
        }
        //reject Draft
        $draftObject->isActive = -1;
        $draftObject->status = 1;
        $draftObject->isAdmin = 1;
        $draftObject->editor_id = $fields['editor_id'];
        $draftObject->save();

        $notification = new adminNotificationController();
        $fields = [
            'from' => $fields['editor_id'],
            'to' => $draftObject->company_id,
            'msg' => "تغییرات مربوط به تلفن شما با موفقیت اعمال نشد",
            'messageType' => 2
        ];
        $notification->addNotification($fields);
    }

    public function editCompany($items)
    {
        //find company information for edit feild 'EDIT'
        include_once(ROOT_DIR . "component/company/admin/model/admin.company.model.php");
        $companyObject = admincompanyModel::find($items['id']);

        if (!is_object($companyObject)) {
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $companyObject['msg']);
            die();
        }

        $item = array("product" => "0",
            "certification" => "1",
            "honour" => "2",
            "businessLicence" => "3",
            "history" => "4",
            "companyNews" => "5",
            "companyAddresses" => "6",
            "companyPhones" => "7",
            "companyEmails" => "8",
            "companyWebsites" => "9",
            "companyBanner" => "10",
            "companyLogo" => "11",
            "companyCommercialName" => "12",
            "licences" => "13",
            "companySocials" => "14",
            "companyPositions" => "15",
            "branch" => "16",
            "wiki" => "17"
        );
        $editField = $companyObject->edit;

        if ($items['countItem'] < 1) {
            $editField[$item[$items["componentName"]]] = 0;
            $companyObject->edit = $editField;
            $companyObject->save();

            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', $msg);
            die();
        }
    }

    public function deleteAllBranchByCompanyId($company_id)
    {
        //delete from main table
        $branchs = adminc_branchModel::getAll()
            ->where('company_id', '=', $company_id)
            ->get();

        if ($branchs['export']['recordsCount'] > 0) {
            foreach ($branchs['export']['list'] as $branch) {
                $branch->delete();
            }
        }

        return;

    }

}

