<?php
include_once ROOT_DIR . 'component/bannerExhibition/model/BannerExhibition.php';

class AdminBannerExhibitionController
{
    public $exportType = 'html';
    protected $fileName;

    public function template($list = [],$msg = '')
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

    public function showList()
    {
        $banner = BannerExhibition::getAll()->getList();

        $this->fileName = 'admin.bannerExhibition.showList.php';
        $this->template($banner['export']['list']['0']);
        die();
    }

    public function showAddForm()
    {
        $this->fileName = 'admin.bannerExhibition.addForm.php';
        $this->template();
        die();
    }

    public function add($fields)
    {
        $banner = BannerExhibition::getAll()->getList();

        if ($banner['export']['recordsCount'] > 0) {
            redirectPage(RELA_DIR . 'admin/?component=bannerExhibition', 'در حال حاضر یک بنر وجود دارد');
        }

        if (empty($fields['image'])) {
            redirectPage(RELA_DIR . 'admin/?component=bannerExhibition&action=addBanner', 'عکس رو انتخاب کنید');
        }

        $result = $this->uploadImage([
            'max_size' => '2048000',
            'upload_dir' => IMAGES_ROOT_DIR . "banner/exhibition/"
        ], $fields['image']);

        if ($result['result'] != 1) {
            redirectPage(RELA_DIR . 'admin/?component=bannerExhibition&action=addBanner', $result['msg']);
        }

        $bannerExhibition = new BannerExhibition();
        $bannerExhibition->image = $result['image'];
        $bannerExhibition->description = $fields['description'];
        $bannerExhibition->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $bannerExhibition->save();

        redirectPage(RELA_DIR . 'admin/?component=bannerExhibition', 'بنر ذخیره شد');
    }

    public function showEditForm($id)
    {
        $banner = BannerExhibition::find($id);

        $this->fileName = 'admin.bannerExhibition.editForm.php';
        $this->template($banner->fields);
        die();
    }

    public function edit($fields)
    {
        $banner = BannerExhibition::find($fields['banner_exhibition_id']);

        if (! is_object($banner)) {
            redirectPage(RELA_DIR . 'admin/?component=bannerExhibition&action=editBanner&id=' . $fields['banner_exhibition_id'], 'بنر وجود ندارد');
        }

        if (!empty($fields['image']) & $fields['image']['error'] == 0) {

            $result = $this->uploadImage([
                'max_size' => '2048000',
                'upload_dir' => IMAGES_ROOT_DIR . "banner/exhibition/"
            ], $fields['image']);

            if ($result['result'] != 1) {
                redirectPage(RELA_DIR . 'admin/?component=bannerExhibition&action=editBanner&id=' . $fields['banner_exhibition_id'], $result['msg']);
            }

            unlink(IMAGES_ROOT_DIR . "banner/exhibition/" . $banner->image);
            $banner->image = $result['image'];
        }

        $banner->description = $fields['description'];
        $banner->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $banner->save();

        redirectPage(RELA_DIR . 'admin/?component=bannerExhibition', 'ویرایش انجام شد');
    }

    public function delete($id)
    {
        $banner = BannerExhibition::find($id);

        if (! is_object($banner)) {
            redirectPage(RELA_DIR . 'admin/?component=bannerExhibition&action=editBanner&id=' . $id, 'بنر وجود ندارد');
        }

        unlink(IMAGES_ROOT_DIR . "banner/exhibition/" . $banner->image);
        $banner->delete();

        redirectPage(RELA_DIR . 'admin/?component=bannerExhibition', 'حذف انجام شد');
    }

    public function uploadImage($input, $file)
    {
        $target_dir = $input['upload_dir'];
        $target_file = $target_dir . basename($file["name"]);
        $result['result'] = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);

        if ($check == false) {
            $result['msg'] = "لطفا یک عکس آپلود کنید";
            $result['result'] = -1;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $result['msg'] = "فایل با این نام وجود دارد";
            $result['result'] = -1;
        }

        // Check file size
        if ($file["size"] > $input['max_size']) {
            $result['msg'] = "سایز عکس بیشتر از ۲ مگابایت است";
            $result['result'] = -1;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $result['msg'] = "باشد JPG, JPEG, PNG & GIF لطفا عکسی با پسوند ";
            $result['result'] = -1;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($result['result'] == -1) {
            return $result;

            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                $result['msg'] = "فایل آپلود شد";
                $result['image'] = basename($file["name"]);
                $result['result'] = 1;
            } else {
                $result['msg'] = "فایل آپلود نشد";
                $result['result'] = -1;
            }
        }

        return $result;
    }
}