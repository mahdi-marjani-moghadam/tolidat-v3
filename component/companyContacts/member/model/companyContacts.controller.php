<?php
/**
 * Created by PhpStorm.
 * User: daba
 * Date: 11/29/2016
 * Time: 3:18 PM
 */
include_once ROOT_DIR . 'component/companyEmails/member/model/companyEmails.controller.php';
include_once ROOT_DIR . 'component/companyPhones/member/model/companyPhones.controller.php';
include_once ROOT_DIR . 'component/companyWebsites/member/model/companyWebsites.controller.php';
include_once ROOT_DIR . 'component/companyAddresses/member/model/companyAddresses.controller.php';
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.controller.php';
include_once ROOT_DIR . 'component/companyContacts/model/companyContacts.controller.php';
include_once ROOT_DIR . 'component/state/admin/model/admin.state.model.php';
include_once ROOT_DIR . 'component/city/admin/model/admin.city.model.php';
include_once ROOT_DIR . 'component/branch/model/branch.controller.php';
include_once ROOT_DIR . "component/personalityType/model/personalityType.model.php";
require ROOT_DIR . "component/personalityType/model/personalityType.controller.php";
include_once ROOT_DIR . 'component/companySocials/member/model/companySocials.controller.php';

/**
 * Class contactsController
 */
class contactsController
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
     * contactsController constructor.
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
    public function template($list = [], $msg = '')
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
     *
     */
    public function showListContacts()
    {
        $contactUs = new contactController();
        $contacts['contactUs'] = $contactUs->showList();
        $this->fileName = 'member.contactUs.showList.php';
        $this->template($contacts['contactUs']);
        die();
    }

    public function deleteContactUs($id)
    {
        $contactUs = c_contacts::find($id);

        if (!is_object($contactUs)) {
            $result['result'] = -1;
            $result['message'] = 'پیام مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        if ($contactUs->company_id != $this->company_info['company_id']) {
            $result['result'] = -1;
            $result['message'] = 'پیام مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        $result = $contactUs->delete();

        if ($result['result'] != 1) {
            $result['result'] = -1;
            $result['message'] = 'پیام مورد نظر حذف نشد';
            echo json_encode($result);
            die();
        }

        $result['message'] = 'پیام مورد نظر حذف شد';
        echo json_encode($result);
        die();
    }

    public function showList($id)
    {
        $contacts['branch_id'] = $id;
        $branchInformation = new branchController();
        $contacts = $branchInformation->branchInformation($id);
//        dd($contacts);
        $this->fileName = 'member.contacts.showList.php';
        $this->template($contacts);
        die();
    }

}







