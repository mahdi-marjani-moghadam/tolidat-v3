<?php


include_once dirname(__FILE__) . '/categoryBanner.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.controller.php';


class categoryBannerController
{
    public $exportType;


    public $fileName;

    private $company_info;

    public function __construct()
    {
        global $company_info;
        $this->company_info = $company_info;
        $this->exportType = 'html';

    }

    function template($list = [],$msg = '')
    {
        global $messageStack;

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

    public function getCategoryBanner($category_id)
    {
        $banner = category_banner::getBy_category_id($category_id['export']['list'])->first();
        return $banner;
    }


}


?>


