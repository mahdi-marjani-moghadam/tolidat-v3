<?php


include_once dirname(__FILE__) . '/companyContacts.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/companyAddresses/model/companyAddresses.model.php';
include_once ROOT_DIR . 'component/companyPhones/model/companyPhones.model.php';
include_once ROOT_DIR . 'component/companyEmails/model/companyEmails.model.php';
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.model.php';
include_once ROOT_DIR . 'component/companyWebsites/model/companyWebsites.model.php';
include_once ROOT_DIR . 'component/companyPositions/member/model/companyPosition.model.php';


class contactController
{

    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';

    }


    function template($list = [], $msg='')
    {
        global $messageStack;

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


    public function addContacts($fields)
    {
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $contacts = new c_contacts();

        $contacts->setFields($fields);

        $validate = $contacts->validator();
        unset($validate['msg']);
        if ($validate['result'] == -1) {
            //unset($validate['result']);
            echo json_encode($validate);
            die();
        }
        $result = $contacts->save();
        if ($result['result'] != 1) {
            echo json_encode($result);
            die();
        }
        $result = $this->sendNotification('پیغامی از طرف کاربر برای شما ارسال شده است');
        if ($result['result'] != 1) {
            $result['msg'] = 'عملیات  انجام شد اما اعلان ارسال نشد';
            echo json_encode($result);
            die();
        }
        $result['msg'] = 'پیغام شما ثبت گردید';
        echo json_encode($result);
        die();
    }

    public function deleteContactUs($id)
    {
        $contactUs = contactusModel::find($id);
        if (!is_object($contactUs)) {
            $result['message'] = 'یافت نشد';
            echo json_encode($result);
        }
        $result = $contactUs->delete();
        if ($result != 1) {
            $result['message'] = 'رکورد مورد نظر حذف نشد';
            echo json_encode($result);
        }
        $result['fields'] = $contactUs->fields;
        $result['message'] = 'رکورد مورد نظر حذف شد';
        echo json_encode($result);

    }

    public function sendNotification($msg)
    {
        global $company_info;
        $notification = new adminNotificationController();
        $fields = [
            'from' => $company_info['company_id'],
            'to' => 3,
            'msg' => $msg,
            'messageType' => 1
        ];
        $result = $notification->addNotification($fields);
        return $result;
    }

    public function showList()
    {
        global $company_info;
        $contacts = c_contacts::getBy_company_id($company_info['company_id'])->getList();
        return $contacts['export']['list'];
//        $this->fileName = "member.contactUs.showList.php";
//        $this->template($contacts['export']['list']);
//        die();

    }

    public function showSideBarMenu($id)
    {
        $companyObject = new companyController();

        $export['side'] = $companyObject->sidebarMenu($id);
//        dd($export['side']['branch_list']);
        $this->fileName = "companyContactShow.php";
        $this->template($export);
        die();
    }

    public function getCompanyPhone($id)
    {
        $json = $this->getAddressByid($id);
        echo json_encode($json);
        die();
    }

    public function getAddressByid($id)
    {

        $contact = c_contacts::find($id);
        if (is_object($contact)) {
            $result['result'] = 1;
            $result['fields'] = $contact->fields;
            return $result;
        }
        return $contact;
        die();

    }

    public function service_getRow($id)
    {
        $append['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });

        $company['result'] = 1;
        $company['addresses'] = c_addresses::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->getList();

        $company['phones'] = c_phones::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->getList();

        $company['emails'] = c_emails::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->getList();

        $company['socials'] = c_socials::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->keyBy('social_type_id', 0)->getList();

        $company['websites'] = c_websites::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->getList();

        $company['position'] = c_position::getBy_Company_id_and_branch_id($id, 0)
            ->appendRelation($append)->getList();

        return $company;
    }

    public function api_getRow($id)
    {
        $result = $this->service_getRow($id);
        Response::json($result, 'get', 200);
    }

    public function service_set($input)
    {
        $company = company::find($input['company_id']);
        if (!is_object($company)) {
            $result['result'] = -1;
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            return $result;
        }
        $contact = new c_contacts();
        $input['result'] = 1;
        $contact->setFields($input);
        $contact->date = strftime('%Y-%m-%d %H:%M:%S', time());
        return $contact->save();
    }

    public function api_setRow($input)
    {
        $result = $this->service_set($input);
        Response::json($result, 'none', 200);
    }

}


?>


