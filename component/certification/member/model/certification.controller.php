<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/certification.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class certificationController
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
     * @var int|string
     */
    public $company_info;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR. 'login');
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

    /**
     * @param $id
     * @return mixed
     */
    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '0100000000000000000000000';
        $result = $company->save();
        return $result;
    }

    /**
     * add Certification.
     * @param $_input
     * @return int|mixed
     * @author marjani
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addCertification($fields)
    {
        $i = 1;
        foreach ($fields as $field) {
            $certification = certification_list::find($field);
            if (!is_object($certification)) {
                $result['msg'] = 'لطفا یکی از گواهی های لیست را انتخاب نمایید';
                echo json_encode($result);
                die();
            }
            $certificat = c_certification_d::getBy_company_id_and_certification_list_id_and_isActive($this->company_info['company_id'],$field, 1)->getList();
            if ($certificat['export']['recordsCount'] >= 1) {
                $result['msg'] = 'این گواهی را قبلا اضافه کرده اید.';
                echo json_encode($result);
                die();
            }
            $certificate['isActive'] = 1;
            $certificate['status'] = -1;
            $certificate['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
            $certificate['company_id'] = $this->company_info['company_id'];
            $certificate['editor_id'] = $this->company_info['company_id'];
            $certificate['certification_list_id'] = $field;

            $certification = new c_certification_d();
            $certification->setFields($certificate);
            $result = $certification->save();

            if ($result['result'] == -1) {
                $result['msg'] = 'not save';
                echo json_encode($result);
                die();
            }

            $resultJoin[$i] = $certification->getCertificationById($this->company_info['company_id'], $certification->Certification_d_id);
            $resultJoin[$i]['date'] = convertDate(substr($resultJoin[$i]['date'], 0, 10));
            $resultJoin[$i]['image'] = IMAGES_RELA_DIR . 'certification/' . $resultJoin[$i]['image'];
            $i++;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('Add certification');
        if ($result['result'] == -1) {
            $result['msg'] = 'Added Certification and not sended notification';
            echo json_encode($result);
            die();
        }
        $result['fields'] = $resultJoin;
        $result['result'] = 1;
        $result['msg'] = 'گواهی مورد نظر اضافه شد';
        $result['count'] = count($result['fields']);
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
    public function editCertification($fields)
    {
        $certification = certification_list::find($fields['certification_list_id']);
        if (!is_object($certification)) {
            $result['msg'] = 'لطفا یکی از گواهی های لیست را انتخاب نمایید';
            echo json_encode($result);
            die();
        }
        $certificate = c_certification_d::getBy_company_id_and_certification_list_id_and_isActive($this->company_info['company_id'], $fields['certification_list_id'], 1)->getList();

        if ($certificate['export']['recordsCount'] >= 1) {
            echo json_encode($result['msg'] = 'این گواهی را قبلا اضافه کرده اید.');
            die();
        }
        $certification = c_certification_d::find($fields['Certification_d_id']);

        if (!is_object($certification)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        $fields['certification_id'] = $certification->certification_id;
        $fields['company_id'] = $certification->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if ($this->company_info['company_id'] != $certification->company_id | $certification->isActive != 1) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($certification->status == 1) {
            $result = $this->addNewAndUpdate($fields, $certification);
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $certification);
        echo json_encode($result);
        die();
    }

    /**
     * @param $fields
     * @param $businessLicence
     * @return array|mixed|null
     */
    public function addNewAndUpdate($fields, $certification)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['certification_id'] = $certification->certification_id;
        $fields['image'] = $certification->image;

        $newCertification = new c_certification_d();
        $newCertification->setFields($fields);
        $result = $newCertification->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newCertification->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new certification';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add certification');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new certification, Update old certification';
            return $result;
        }
        $result['fields'] = $newCertification->fields;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات گواهی مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $fields
     * @param $businessLicence
     * @return mixed
     */
    public function onlyUpdate($fields, $certification)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        $certification->setFields($fields);
        $result = $certification->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($this->company_info['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update certification');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $certification->fields;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات گواهی مورد نظر ویرایش شد';
        return $result;

    }

    public function getAllCertificationByAjax()
    {
        
        $certification = c_certification_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        foreach ($certification['export']['list'] as $key => $value) {
            $certification_list_id[] = $value['certification_list_id'];
        }
        $certifications = certification_list::getBy_not_Certification_list_id($certification_list_id)->getList();
        $certifications = $certifications['export']['list'];
        echo json_encode($certifications);
        die();

        /*$countAllChecked = $certification['export']['recordsCount'];
        $certification = $certification['export']['list'];
        $countAll = $certifications['export']['recordsCount'];
        for ($i = 0; $i < $countAll; $i++) {
            for ($j = 0; $j < $countAllChecked; $j++) {
                if ($certification[$j]['certification_list_id'] == $certifications[$i]['Certification_list_id']) {
                    $certifications[$i]['checked'] = 'on';
                }
            }
        }*/

    }

    /**
     * @param $fields
     * @return mixed
     * @author malekloo
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        $certification_list = certification_list::getAll()->getList();
        $certification_list_count = $certification_list['export']['recordsCount'];
        $model = new c_certification_d();
        $export = $model->getCertification($this->company_info['company_id']);
        $export['export']['certification_list_count'] = $certification_list_count;
        $this->fileName = "member.certification.showList.php";
        $this->template($export['export']);
        die();
    }

    /**
     * delete deleteCertification by certification_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteCertification($id)
    {
        $certification = c_certification_d::find($id);

        if (!is_object($certification)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }
        if ($certification->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($certification->certification_id == 0) {
            $result = $certification->delete();
        } else {
            $result = $this->deleteAll($certification);
        }
        if ($result['result'] == -1) {
            $result['msg'] = "گواهی مورد نظر حذف نگردید";
            echo json_encode($result);
            die();
        }
        if ($certification->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $result['fields'] = $certification->fields;
        $result['msg'] = "گواهی مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteAll($certification)
    {
        $certifications = c_certification_d::getBy_certification_id($certification->certification_id)->get();
        foreach ($certifications['export']['list'] as $certificate) {
            $certificate->delete();
        }
        $result = $this->deleteMain($certification);
        return $result;
    }

    /**
     * @param $certification
     * @return mixed
     */
    public function deleteMain($certification)
    {
        $certificationMain = c_certification::find($certification->certification_id);
        if (is_object($certificationMain)) {
            $result = $certificationMain->delete();
        }
        return $result;
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function uploadImage($fields)
    {
        $file['name'] = $fields['img']['name'];
        $file['type'] = $fields['img']['type'];
        $file['tmp_name'] = $fields['img']['tmp_name'];
        $file['error'] = $fields['img']['error'];
        $file['size'] = $fields['img']['size'];
        $Property = array('type' => 'jpg,png,jpeg',
            'new_name' => $file['name'],
            'max_size' => '2048000',
            'upload_dir' => COMPANY_ADDRESS_ROOT . "/certification/"
        );
        $result_uploader = fileUploader($Property, $file);
        return $result_uploader['image_name'];
    }
}
