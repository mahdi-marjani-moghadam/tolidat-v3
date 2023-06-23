<?php


include_once dirname(__FILE__) . '/banner.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';


class BannerController
{

    public $exportType;


    public $fileName;


    public function __construct()
    {
        $this->exportType = 'html';

    }


    function template($list = [], $msg)
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

    public function updateCompany($id)
    {
        $company = company::find($id);
        $company->edit = $company->edit | '00000000001000';
        $result = $company->save();
        return $result;
    }
    public function addBanner($fields, $files)
    {
        $banner = new c_banner_d();
        $field['title'] = $fields['title'];
        $field['description'] = $fields['description'];
        $field['isActive'] = 1;
        $field['isAdmin'] = 0;
        $field['status'] = 1;
        $field['editor_id'] = $fields['editor_id'];
        $field['company_id'] = $fields['company_id'];

        if ($files['name'] != '') {
            $file['name'] = $files['name'];
            $file['type'] = $files['type'];
            $file['tmp_name'] = $files['tmp_name'];
            $file['error'] = $files['error'];
            $file['size'] = $files['size'];
            $Property = array('type' => 'jpg,png,jpeg',
                'new_name' => $files['name'],
                'max_size' => '2048000',
                'upload_dir' => COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/",
                'height' => '',
                'wight' => '',
                'error_msg' => '',
                'success_msg' => '',
            );

        }

        $result_uploader = fileUploader($Property, $file);
        $field['image'] = $result_uploader['image_name'];
        $banner->setFields($field);

        $validate = $banner->validator();

        if ($validate['result'] != 1) {

            print_r_debug($validate);
        }

        $result = $banner->save();

        if ($result['result'] != 1) {
            print_r_debug($result);

        }
        $result = $this->updateCompany($fields['editor_id']);

        if ($result['result'] == -1) {
            print_r_debug('کمپانی مورد نظر آپدیت نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';
        $result = $this->sendNotification($msg);
        if ($result['result'] != 1) {
            print_r_debug('عملیات  انجام شد اما اعلان ارسال نشد');

        }
        redirectPage(RELA_DIR . 'banner', $msg);
        die();

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

    public function showBannerAddForm($fields, $msg)
    {
        $this->fileName = 'banner.addForm.php';
        $this->template($fields, $msg);
        die();
    }


    public function editBanner($fields, $files)
    {
        global $company_info;
        $fields['editor_id'] = $company_info['company_id'];
        $fields['company_id'] = $company_info['company_id'];
        $fields['status'] = 1;
        $fields['isActive'] = 1;

        $banner = c_banner_d::find($fields['Banner_d_id']);

        if (!is_object($banner)) {
            print_r_debug('عملیات انجام نشد');
        }

        if ($fields['editor_id'] != $banner->editor_id & $fields['isActive'] != 1) {

            print_r_debug('کمپانی مورد نظر یافت نشد');
        }

        if ($banner->status != 1) {
            $this->UpdateNewBanner($fields, $banner, $files);
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'banner', $msg);
        }

        $this->addAndUpdateNewBanner($fields, $banner, $files);
        $msg = 'عملیات با موفقیت انجام شد';
        redirectPage(RELA_DIR . 'banner', $msg);

    }

    public function UpdateNewBanner($fields, $banner, $files)
    {
        if (trim($fields['title']) != '') {

            $field['title'] = $fields['title'];
            $field['description'] = $fields['description'];
            $field['editor_id'] = $fields['editor_id'];
            $field['isActive'] = 1;
            $field['image'] = '';
            $field['status'] = 1;
            if ($fields['remove_image'] == 'on') {
                fileRemover(COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/", $banner->image);

            }
            if ($files['name'] != '') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $files['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/",
                    'height' => '',
                    'wight' => '',
                    'error_msg' => '',
                    'success_msg' => '',
                );
                fileRemover(COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/", $banner->image);
                $result_uploader = fileUploader($Property, $files);
                $field['image'] = $result_uploader['image_name'];
            } else {
                $field['image'] = $banner->fields['image'];
            }
        }
        $banner->setFields($field);
        $validate = $banner->validator();

        if ($validate['result'] != 1) {
            print_r_debug('اطلاعات به درستی وارد نشده است');
        }
        $result = $banner->save();

        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';

        $result = $this->sendNotification($msg);
        if ($result['result'] != 1) {
            print_r_debug('عملیات  انجام شد اما اعلان ارسال نشد');

        }

    }


    public function addAndUpdateNewBanner($fields, $banner, $files)
    {

        $field['isActive'] = 1;
        $field['Banner_d_id'] = $banner->Banner_d_id;
        $newBanner = new c_banner_d();
        if (trim($fields['title']) != '') {
            $field['title'] = $fields['title'];
            $field['description'] = $fields['description'];
            $field['editor_id'] = $fields['editor_id'];
            $field['isActive'] = 1;
            $field['image'] = '';


            if ($fields['remove_image'] == 'on') {
                fileRemover(COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/", $banner->image);

            }
            if ($files['name'] != '') {
                $Property = array('type' => 'jpg,png,jpeg',
                    'new_name' => $files['name'],
                    'max_size' => '2048000',
                    'upload_dir' => COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/",
                    'height' => '',
                    'wight' => '',
                    'error_msg' => '',
                    'success_msg' => '',
                );
                fileRemover(COMPANY_ADDRESS_ROOT . $field['editor_id'] . "/banner/", $banner->image);
                $result_uploader = fileUploader($Property, $files);
                $field['image'] = $result_uploader['image_name'];
            } else {
                $field['image'] = $banner->fields['image'];
            }
        }
        $newBanner->setFields($field);

        $validate = $newBanner->validator();
        if ($validate['result'] != 1) {
            print_r_debug('اطلاعات به درستی وارد نشده است');

        }
        $result = $newBanner->save();

        if ($result['result'] != 1) {
            print_r_debug('اطلاعات ذخیره نشد');
        }
        $banner->isActive = 0;
        $result = $banner->save();

        if ($result['result'] != 1) {
            print_r_debug('اطلاعات به درستی ذخیره نشد');
        }
        $msg = 'عملیات با موفقیت انجام شد';

        $result = $this->sendNotification($msg);

        if ($result['result'] != 1) {
            print_r_debug('عملیات  انجام شد اما اعلان ارسال نشد');

        }

    }

    public function showBannerEditForm($fields, $msg)
    {

        $result = c_banner_d::find($fields);
        if (is_object($result)) {
            $export['banner'] = $result->fields;
            $this->fileName = 'banner.editForm.php';
            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . 'banner', $msg);
        }


    }

    public function showList($fields)
    {

        global $company_info;
        $banner = new c_banner_d();

        $result = $banner::getBy_editor_id($company_info['company_id'])->getList();

        if ($result['result'] != '1') {

            $this->fileName = 'banner.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $export['editor_id'] = $fields['editor_id'];
        $this->fileName = 'banner.showList.php';

        $this->template($export);
        die();
    }

    public function deleteBanner($id)
    {
        $banner = c_banner_d::find($id);
        $company_id = $banner->fields['editor_id'];
        if (is_object($banner)) {
            fileRemover(COMPANY_ADDRESS_ROOT . $banner->fields['editor_id'] . "/banner/", $banner->fields['image']);
            $result = $banner->delete();
            if ($result['result'] != '1') {
                $this->showBannerEditForm($id, $result['msg']);
            }
            $msg = 'عملیات با موفقیت انجام شد';
            redirectPage(RELA_DIR . 'banner', $msg);
            die();
        } else {
            $msg = 'عملیات با موفقیت انجام نشد';
            redirectPage(RELA_DIR . 'banner', $msg);
            die();
        }
    }


}


?>


