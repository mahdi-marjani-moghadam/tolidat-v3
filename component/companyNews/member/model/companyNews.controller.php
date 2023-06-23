<?php

include_once dirname(__FILE__) . '/companyNews.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once ROOT_DIR . 'component/company/member/model/company.model.php';

/**
 * Class registerController.
 */
class companyNewsController
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
    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000010000000000000000000' :
            $company->edit & '1111101111111111111111111';
        $result = $company->save();
        return $result;
    }

    /**
     * add Certification.
     * @param $fields
     * @return int|mixed
     * @date 2/27/2015
     * @version 01.01.01
     */
    public function addNews($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['news_id'] = 0;
        $result = $this->uploadImage($fields['imageCropped']);

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $news = new c_news_d();
        $news->setFields($fields);
        $validate = $news->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }

        $result = $news->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'not save';
            echo json_encode($validate);
            die();
        }

        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            echo json_encode($validate);
            die();
        }
        $result = $this->sendNotification('Add news');

        if ($result['result'] == -1) {
            $result['msg'] = 'Added news and not sended notification';
            echo json_encode($validate);
            die();
        }
        $result['fields'] = $news->fields;
        $result['fields']['date'] = convertDate(substr($news->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/news/' . $news->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'خبر مورد نظر اضافه شد';
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
    public function editNews($fields)
    {
        $companyNews = c_news_d::find($fields['News_d_id']);
        $fields['news_id'] = $companyNews->news_id;
        $fields['company_id'] = $companyNews->company_id;
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($companyNews)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($fields['company_id'] != $companyNews->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $news_d_id_oldest = 0;
        if ($companyNews->status == 1 && $companyNews->news_id != 0) {
            $news_d_id_oldest = $companyNews->News_d_id;
            $companyNews = c_news_d::getBy_news_id_and_isActive($companyNews->news_id, 1)->first();
        }

        if ($companyNews->status == 1) {
            $result = $this->addNewAndUpdate($fields, $companyNews);
            $result['fields']['News_d_id_oldest'] = $news_d_id_oldest;
            echo json_encode($result);
            die();
        }
        $result = $this->onlyUpdate($fields, $companyNews);
        echo json_encode($result);
        die();
    }


    /**
     * @param $fields
     * @param $companyNews
     * @return array|mixed|null
     */
    public function addNewAndUpdate($fields, $companyNews)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['news_id'] = $companyNews->news_id;
        $fields['image'] = $companyNews->image;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $newNews = new c_news_d();
        $newNews->setFields($fields);
        $validate = $newNews->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $newNews->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $newNews->updateAll();

        if ($result['result'] == -1) {
            $result['msg'] = 'Old record not update';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Add companyNews');

        if ($result['result'] == -1) {
            $result['msg'] = 'Add new companyNews, Update old companyNews';
            return $result;
        }
        $result['fields'] = $newNews->fields;
        $result['fields']['News_d_id_old'] = $companyNews->News_d_id;
        $result['fields']['date'] = convertDate(substr($newNews->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/news/' . $newNews->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات خبر مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $fields
     * @param $companyNews
     * @return mixed
     */
    public function onlyUpdate($fields, $companyNews)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $companyNews->company_id . "/news/", $companyNews->image);
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        $companyNews->setFields($fields);
        $validate = $companyNews->validator();

        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            return $result;
        }
        $result = $companyNews->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'Unupdated';
            return $result;
        }
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'not update company';
            return $result;
        }
        $result = $this->sendNotification('Update certification');

        if ($result['result'] == -1) {
            $result['msg'] = 'Not send notification';
            return $result;
        }
        $result['fields'] = $companyNews->fields;
        $result['fields']['News_d_id_old'] = $companyNews->News_d_id;
        $result['fields']['date'] = convertDate(substr($companyNews->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/news/' . $companyNews->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات خبر مورد نظر ویرایش شد';
        return $result;
    }

    /**
     * @param $id
     * @return mixed
     * @version 01.01.01
     */
    public function getNewsByid($id)
    {
        $news_fields = c_news_d::find($id);
        if (is_object($news_fields)) {
            $result['result'] = 1;
            $result['fields'] = $news_fields->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $news_fields->company_id . "/news/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $news_fields;
        die();
    }

    /**
     * @param $id
     */
    public function getNewsByidAjax($id)
    {
        $json = $this->getNewsByid($id);
        echo json_encode($json);
        die();
    }

    /**
     * @return mixed
     * @date 3/6/2015
     * @version 01.01.01
     */
    public function showList()
    {
        $companyNews = c_news_d::getBy_company_id_and_isActive($this->company_info['company_id'], 1)->getList();
        $export['list'] = $companyNews['export']['list'];
        $export['recordsCount'] = $companyNews['export']['recordsCount'];
        $this->fileName = "member.news.showList.php";
        $this->template($export);
        die();
    }

    /**
     * delete deleteCertification by certification_id.
     * @param $id
     * @author malekloo
     * @date 2/24/2015
     * @version 01.01.01
     */
    public function deleteNews($id)
    {
        $companyNews = c_news_d::find($id);
        if (!is_object($companyNews)) {
            $result['msg'] = 'Not found';
            echo json_encode($result);
            die();
        }

        if ($companyNews->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'Is not relevant to you';
            echo json_encode($result);
            die();
        }
        if ($companyNews->news_id == 0) {
            $result = $companyNews->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $companyNews->company_id . "/news/", $companyNews->image);
        } else {
            $result = $this->deleteAll($companyNews);
        }
        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($companyNews->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedNews = c_news_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedNews['export']['recordsCount'] <= 0){
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $companyNews->fields;
        $result['msg'] = 'خبر مورد نظر حذف گردید';
        echo json_encode($result);
        die();

    }

    public function deleteAll($companyNews)
    {
        $news = c_news_d::getBy_news_id($companyNews->news_id)->get();
        foreach ($news['export']['list'] as $new) {
            $new->delete();
            fileRemover(COMPANY_ADDRESS_ROOT . $new->company_id . "/news/", $new->image);
        }
        $result = $this->deleteMain($companyNews);
        return $result;
    }

    /**
     * @param $companyNews
     * @return mixed
     * @internal param $certification
     */
    public function deleteMain($companyNews)
    {
        $newsMain = c_news::find($companyNews->news_id);
        if (is_object($newsMain)) {
            $result = $newsMain->delete();
        }
        return $result;
    }

    /**
     * @param $fields
     * @return mixed
     */
    public function uploadImage($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'company_id' => $this->company_info['company_id'],
                'folder_name' => 'news'
            ];
            $sizes = [
                'size1' => ['width' => '90', 'height' => '90']
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }

//        if ($fields['name'] != '') {
//            $type = substr($fields['type'], 0, 5);
//            if ($type == 'image') {
//                $Property = array('type' => 'jpg,png,jpeg',
//                    'new_name' => $fields['name'],
//                    'max_size' => '2048000',
//                    'upload_dir' => COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/news/"
//                );
//                return fileUploader($Property, $fields);
//            }
//        }
//        return null;
    }
}
