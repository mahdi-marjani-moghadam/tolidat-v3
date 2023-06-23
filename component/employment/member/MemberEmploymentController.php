<?php
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/employment/model/Employment.php';

class MemberEmploymentController
{
    /**
     * Contains file type.
     * @var
     */
    public $exportType;

    /**
     * Contains file name.
     * @var
     */
    public $fileName;

    private $company_info;

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
     * @param array $list
     * @param $msg
     * @return array
     */
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

    /**
     * @param $id
     * @return mixed
     */
    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000000000000001000000' :
            $company->edit & '1111111111111111110111111';
        $result = $company->save();
        return $result;
    }

    /**
     * add History.
     * @param $fields
     * @return int|mixed
     * @version 01.01.01
     */
    public function addEmployment($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['isMain'] = 0;
        $fields['branch_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['member_id'];
        $fields['parent_id'] = 0;

        if (!empty($fields['startDate']) & !empty($fields['expireDate'])) {
            $fields['startDate'] = convertJToGDate($fields['startDate']);
            $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        }

        $employment = new Employment();
        $employment->setFields($fields);

        $validate = $employment->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }
        if ($employment->expireDate < strftime('%Y-%m-%d %H:%M:%S', time())) {
            $result['fields']['result'] = -1;
            $result['fields']['msg'] = 'تاریخ انقضا صحیح نمی باشد';
            echo json_encode($result);
            die();
        }
        $employment->maxSallary = str_replace(",", "", $employment->maxSallary);
        $employment->minSallary = str_replace(",", "", $employment->minSallary);

        $result = $employment->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($result);
            die();
        }
        $employment->parent_id = $employment->Employment_id;
        $employment->save();

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add Employment');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added Employment but not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $employment->fields;
        $result['fields']['date'] = convertDate(substr($employment->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/employment/' . $employment->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['employment_type_name'] = $this->getEmploymentTypeByID($employment->employment_type);
        $result['result'] = 1;
        $result['msg'] = 'فرصت شغلی مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/16/2015
     * @version 01.01.01
     */
    public function editEmployment($fields)
    {
        $employment = Employment::find($fields['Employment_id']);
        $fields['company_id'] = $employment->company_id;
        $fields['editor_id'] = $this->company_info['member_id'];

        if (!is_object($employment)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        if ($this->company_info['company_id'] != $employment->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if (!empty($fields['startDate']) & !empty($fields['expireDate'])) {
            $fields['startDate'] = convertJToGDate($fields['startDate']);
            $fields['expireDate'] = convertJToGDate($fields['expireDate']);
        }
        if ($employment->status == 2) {
            $result = $this->addNewAndUpdate($fields, $employment);
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $employment);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $employment
     * @return string
     * @internal param $history
     */
    public function addNewAndUpdate($fields, $employment)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['parent_id'] = $employment->parent_id;
        $newEmployment = new Employment();
        $newEmployment->setFields($fields);
        $validate = $newEmployment->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $newEmployment->maxSallary = str_replace(",", "", $newEmployment->maxSallary);
        $newEmployment->minSallary = str_replace(",", "", $newEmployment->minSallary);

        $result = $newEmployment->save();
        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newEmployment->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Old record not update';
            return $result;
        }

        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new logo, Update old logo';
            return $result;
        }
        $result['fields'] = $newEmployment->fields;
        $result['fields']['Employment_id_old'] = $employment->Employment_id;
        $result['fields']['date'] = convertDate(substr($newEmployment->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/employment/' . $newEmployment->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['employment_type_name'] = $this->getEmploymentTypeByID($newEmployment->employment_type);
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات فرصت شغلی مورد نظر ویرایش شد';
        return $result;
    }


    /**
     * @param $fields
     * @param $employment
     * @return mixed
     * @internal param $history
     */
    public function onlyUpdate($fields, $employment)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;


        $employment->setFields($fields);
        $validate = $employment->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $employment->maxSallary = str_replace(",", "", $employment->maxSallary);
        $employment->minSallary = str_replace(",", "", $employment->minSallary);
        $result = $employment->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update logo');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $employment->fields;
        $result['fields']['Employment_id_old'] = $employment->Employment_id;
        $result['fields']['date'] = convertDate(substr($employment->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/employment/' . $employment->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['fields']['employment_type_name'] = $this->getEmploymentTypeByID($employment->employment_type);
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات فرصت شغلی مورد نظر ویرایش شد';
        return $result;

    }

    /**
     * @param $id
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function getEmploymentByid($id)
    {
        $Employment = Employment::find($id);
        if (is_object($Employment)) {
            $result['result'] = 1;
            $Employment->startDate = convertDate($Employment->startDate);
            $Employment->expireDate = convertDate($Employment->expireDate);
            $result['fields'] = $Employment->fields;
            $graduate = graduate::getAll()->getList();
            $result['fields']['graduate'] = $graduate['export']['list'];
            if ($result['fields']['history'] == '0') {
                $result['fields']['history'] = '';
            }
            if ($result['fields']['graduate_id'] == '0') {
                $result['fields']['graduate_id'] = '';
            }
            if ($result['fields']['minSallary'] != '' or $result['fields']['maxSallary'] != '' or $result['fields']['skill'] != '' or $result['fields']['history'] != '' or $result['fields']['graduate_id'] != '') {
                $result['fields']['more_info'] = 1;
            } else {
                $result['fields']['more_info'] = 0;
            }
            return $result;
        }
        return $Employment;
    }

    public function getAddFormByAjax()
    {
        $licence_list = graduate::getAll()->getList();
        $export['graduate'] = $licence_list['export']['list'];
        echo json_encode($export);
        die();
    }


    /**
     * @param $id
     */
    public function getEmploymentByidAjax($id)
    {
        $json = $this->getEmploymentByid($id);
        echo json_encode($json);
        die();
    }

    /**
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
        return $notification->addNotification($fields);
    }

    /**
     * @param $fields
     * @return mixe
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        $employment = Employment::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('isActive', '=', 1)
            ->where('expireDate', '>', strftime('%Y-%m-%d %H:%M:%S', time()))
            ->getList();

        $graduate = graduate::getAll()->getList();
        $this->fileName = 'member.employment.showList.php';
        $export['list'] = $employment['export']['list'];
        $export['graduate'] = $graduate['export']['list'];
        $export['recordsCount'] = $employment['export']['recordsCount'];
        $this->template($export);
        die();
    }

    /**
     * delete deleteHistory by History_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteEmployment($id)
    {
        $employment = Employment::find($id);
        if (!is_object($employment)) {
            $result['msg'] = 'فرصت شغلی مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }
        if ($employment->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'فرصت شغلی مورد نظر پیدا نشد';
            echo json_encode($result);
            die();
        }

        $result = $this->deleteAll($employment);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($employment->status == 2) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedEmployments = Employment::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedEmployments['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['msg'] = 'فرصت شغلی مورد نظر حذف گردید';
        $result['fields'] = $employment->fields;
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($employment)
    {
        $employments = Employment::getBy_parent_id($employment->parent_id)->get();
        foreach ($employments['export']['list'] as $licenc) {
            $licenc->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $licenc->company_id . "/employment/", $licenc->image);
        }
        return;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($employment)
    {
        $employmentMain = Employment::find($employment->employments_id);

        if (is_object($employmentMain)) {
            $result = $employmentMain->delete();
        }
        return $result;
    }


    /**
     * @param $fields
     * @return mixed
     */

    public static function getEmploymentList()
    {
        $graduate = graduate::getBy_status(1)->getList();
        return $graduate;
    }

    public static function find($graduate_id)
    {
        return graduate::find($graduate_id);
    }

    public function add($fields)
    {
        $employment = graduate::getBy_name($fields['name'])->first();
        if (is_object($employment)) {
            return $employment;
        }
        $employment = new graduate();
        $employment->setFields($fields);
        $result = $employment->save();
        if ($result['result'] == 1) {
            return $employment;
        }
    }

    public function getEmploymentTypeByID($graduate_id)
    {
        $employment_type = graduate::find($graduate_id);
        if (is_object($employment_type)) {

            return $employment_type->name;
        }

        return null;
    }
}
