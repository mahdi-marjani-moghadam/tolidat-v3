<?php


include_once dirname(__FILE__) . '/product.model.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once(ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.model.php");
include_once ROOT_DIR . 'component/company/member/model/company.model.php';
include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
include_once(ROOT_DIR . "component/package/member/model/package.model.php");
include_once(ROOT_DIR . "component/category/member/model/member.category.model.php");
include_once(ROOT_DIR . "component/product/member/model/ProductGallery.php");
include_once(ROOT_DIR . "services/uploader/Uploader.php");
require_once ROOT_DIR . "services/Keyword/Keyword.php";


class memberProductController
{

    public $exportType;


    public $fileName;

    private $company_info;


    public function __construct()
    {
        global $company_info;
        if ($company_info == -1) {
            redirectPage(RELA_DIR . 'login');
        }
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

    public function updateCompany($id, $action = 'enable')
    {
        $company = company::find($id);

        $company->edit = $action == 'enable' ?

            $company->edit | '1000000000000000000000000' :
            $company->edit & '0111111111111111111111111';

        $result = $company->save();
        return $result;
    }

    public function updateGalleryEditFieldInCompany($company_id, $action)
    {
        $company = company::find($company_id);
        $company->edit = $action == 'enable' ?
            $company->edit | '0000000000000000000010000' :
            $company->edit & '1111111111111111111101111';
        $result = $company->save();
        return $result;
    }

    public function addProduct($fields)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;
        $fields['isAdmin'] = 0;
        $fields['product_id'] = 0;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        $fields['company_id'] = $this->company_info['company_id'];
        $fields['editor_id'] = $this->company_info['company_id'];

        $company_info = company::find($fields['company_id']);
        $fields['city_id'] = $company_info->city_id;
        $fields['state_id'] = $company_info->state_id;

        if ($fields['imageCropped']) {
            $result = $this->uploadImage($fields['imageCropped'], $fields['company_id']);
        }

        if ($result['result'] == -1) {



            echo json_encode($result);
            die();
        }
        $fields['image'] = $result['image'];

        $product = new c_product_d();
        $product->setFields($fields);
        $product->category_id = ',' . implode(',', $fields['category_id']) . ',';
 
        $validate = $product->validator();
        if ($validate['result'] == -1) {
            $result['fields'] = $validate;
            echo json_encode($result);
            die();
        }

        $package_model = adminpackageusageModel::checkPackageUsage($fields['company_id'], 'add', 'product');

        if (!is_object($package_model)) {
            echo json_encode($package_model);
            die();
        }

        $keywords = tagToArray($fields['meta_keyword'])['export']['list'];
        $keyword = new Keyword($keywords);
        $result = $keyword->checkKeyword($package_model);

        if ($result['result'] == -1) {
            $result['msg'] = $result['error']['msg'];
            echo json_encode($result);
            die();
        }

        $result = $product->save();

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            echo json_encode($result);
            die();
        }

        //update package usage product ++
        $package_model->save();

        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی مورد نظر آپدیت نشد';
            echo json_encode($result);
            die();
        }
        $msg = 'عملیات افزودن محصول با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        $result['fields'] = $product->fields;
        $result['fields']['max_meta_keyword'] = $package_model->keyword;
        $result['fields']['date'] = convertDate(substr($product->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/product/' . $product->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'محصول مورد نظر اضافه شد';
        echo json_encode($result);
        die();
    }

    public function sendNotification($msg)
    {

        $notification = new adminNotificationController();
        $fields = [
            'from' => $this->company_info['company_id'],
            'to' => 3,
            'msg' => $msg,
            'messageType' => 1
        ];
        $result = $notification->addNotification($fields);
        return $result;
    }

    public function editProduct($fields)
    {
        $product = c_product_d::find($fields['Product_d_id']);
        $fields['editor_id'] = $this->company_info['company_id'];
        $fields['company_id'] = $product->company_id;
        $fields['product_id'] = $product->product_id;
        $fields['image'] = $product->image;
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

        if (!is_object($product)) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }
        if ($this->company_info['company_id'] != $product->company_id) {
            $result['msg'] = 'آیتم مورد نظر وجود ندارد';
            $result['result'] = -1;
            echo json_encode($result);
            die();
        }

        $product_d_id_oldest = 0;
        if ($product->status == 1 && $product->product_id != 0) {
            $product_d_id_oldest = $product->Product_d_id;

            $product = c_product_d::getBy_product_id_and_isActive($product->product_id, 1)->first();
        }

        if ($product->status != 1) {
            $result = $this->UpdateProduct($fields, $product);
            echo json_encode($result);
            die();
        }

        $result = $this->updateAndAddNewProduct($fields, $product);
        $result['fields']['Product_d_id_oldest'] = $product_d_id_oldest;
        echo json_encode($result);
        die();
    }

    public function UpdateProduct($fields, $product)
    {
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped'], $fields['company_id']);
            $fields['image'] = $result['image'];
            fileRemover(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/product/", $product->image);
        }
        if ($result['result'] == -1) {
            $result['msg'] = "حجم عکس مورد نظر باید حداکثر ۲ مگابایت باشد";
            echo json_encode($result);
            die();
        }

        $product->setfields($fields);
        $product->category_id = implode(',', $fields['category_id']);
        $validate = $product->validator();

        foreach ($fields['category_id'] as $category) {
            $category = category::getBy_Category_id_or_parent_id($category, $category)->getList();
            if ($category['export']['recordsCount'] != 1) {
                $validate['msg'] = "خطا در تعداد دسته بندی";
                $validate['result'] = -1;
                return $validate;
            }
        }

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }
        $package_model = adminpackageusageModel::checkPackageUsage($fields, 'edit');

        if (!is_object($package_model)) {
            return $package_model;
        }

        $keywords = tagToArray($fields['meta_keyword'])['export']['list'];
        $keyword = new Keyword($keywords);
        $result = $keyword->checkKeyword($package_model);

        if ($result['result'] == -1) {
            $result['msg'] = $result['error']['msg'];
            echo json_encode($result);
            die();
        }

        $result = $product->save();

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات ذخیره نشد';
            return $result;
        }
        //update package usage product ++
        $package_model->save();
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی آپدیت نشد';
            return $result;
        }
        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        $result['fields'] = $product->fields;
        $result['fields']['Product_d_id_old'] = $product->Product_d_id;
        $result['fields']['max_meta_keyword'] = $package_model->keyword;
        $result['fields']['date'] = convertDate(substr($product->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/product/' . $product->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات محصول مورد نظر ویرایش شد';
        return $result;

    }

    public function updateAndAddNewProduct($fields, $product)
    {
        $fields['Product_d_id'] = $product->Product_d_id;
        $fields['product_id'] = $product->product_id;
        $fields['isActive'] = 1;
        $fields['status'] = -1;

        if (!empty($fields['imageCropped'])) {
            $result = $this->uploadImage($fields['imageCropped'], $fields['company_id']);
            $fields['image'] = $result['image'];
        }
        if ($result['result'] == -1) {
            $result['msg'] = "حجم عکس مورد نظر باید حداکثر ۲ مگابایت باشد";
            echo json_encode($result);
            die();
        }

        $newProduct = new c_product_d();
        $newProduct->setFields($fields);
        $newProduct->category_id = implode(',', $fields['category_id']);

        $validate = $newProduct->validator();

        foreach ($fields['category_id'] as $category) {
            $category = category::getBy_Category_id_or_parent_id($category, $category)->getList();
            if ($category['export']['recordsCount'] != 1) {
                $validate['msg'] = "خطا در تعداد دسته بندی";
                $validate['result'] = -1;
                return $validate;
            }
        }

        if ($validate['result'] != 1) {
            $result['fields'] = $validate;
            return $result;
        }

        $package_model = adminpackageusageModel::checkPackageUsage($fields, 'edit');
        if (!is_object($package_model)) {
            echo json_encode($package_model);
            die();
        }
        $result = $newProduct->save();

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات آپدیت نشد';
            return $result;
        }

        $result = $newProduct->updateAll();
        $this->updateGalleries($product, $newProduct);

        if ($result['result'] != 1) {
            $result['msg'] = 'اطلاعات افزوده شد اما آپدیت نشد';
            return $result;
        }

        $package_model->save();
        $result = $this->updateCompany($fields['company_id']);

        if ($result['result'] == -1) {
            $result['msg'] = 'کمپانی آپدیت نشد';
            return $result;
        }

        $msg = 'عملیات ویرایش نام تجاری با موفقیت انجام شد';
        $result = $this->sendNotification($msg);

        if ($result['result'] == -1) {
            $result['msg'] = 'اطلاعات ذخیره شد اما اعلان ارسال نشد';
        }

        $result['fields'] = $newProduct->fields;
        $result['fields']['Product_d_id_old'] = $product->Product_d_id;
        $result['fields']['max_meta_keyword'] = $package_model->keyword;
        $result['fields']['date'] = convertDate(substr($newProduct->date, 0, 10));
        $result['fields']['img'] = COMPANY_ADDRESS . $this->company_info['company_id'] . '/product/' . $newProduct->image;
        $result['fields']['defaltLogo'] = DEFULT_LOGO_ADDRESS;
        $result['result'] = 1;
        $result['msg'] = 'اطلاعات محصول مورد نظر ویرایش شد';
        return $result;
    }

    public function updateGalleries($oldProductObj, $newProductObj)
    {
        $galleries = ProductGallery::getAll()
            ->where('product_d_id', '=', $oldProductObj->Product_d_id)
            ->get();

        if ($galleries['export']['recordsCount'] > 0) {
            foreach ($galleries['export']['list'] as $gallery) {
                $gallery->product_d_id = $newProductObj->Product_d_id;
                $gallery->product_id = $newProductObj->product_id;
                $gallery->save();
            }
        }

        return;
    }

    public function getProductByid($id)
    {
        $product = c_product_d::find($id);
        if (is_object($product)) {
            $result['result'] = 1;
            $result['fields'] = $product->fields;
            $result['fields']['image_tmp'] = $result['fields']['image'] ? COMPANY_ADDRESS . $this->company_info['company_id'] . "/product/" . $result['fields']['image'] : DEFULT_LOGO_ADDRESS;
            return $result;
        }
        return $product;
    }

    public function getProductByidAjax($id)
    {
        $json = $this->getProductByid($id);
        echo json_encode($json);
        die();


    }

    public function showList()
    {
        $products = c_product_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('isActive', '=', 1)
            ->getList();

        foreach ($products['export']['list'] as $product) {
            $product_d_id[] = $product['Product_d_id'];
        }

        $galleries = ProductGallery::getAll()
            ->where('product_d_id', 'in', $product_d_id)
            ->where('isActive', '=', 1)
            ->getList();


        foreach ($products['export']['list'] as $product) {
            $result[$product['Product_d_id']] = $product;
            foreach ($galleries['export']['list'] as $gallery) {
                if ($product['Product_d_id'] == $gallery['product_d_id']) {
                    $product['gallery'][$gallery['product_gallery_id']] = $gallery;
                    $result[$product['Product_d_id']] = $product;
                }
            }
        }

        $export['categoryAdd'] = $this->getCategory('_');
        $export['categoryEdit'] = $this->getCategory('-');
        $export['list'] = $result;
        $packageCompany = $this->getPackage();
        $export['packageCompany'] = $packageCompany;
        $export['product_count'] = $products['export']['recordsCount'];
        $export['all_product_count'] = $packageCompany['product'];
        $export['all_keyword_count'] = $packageCompany['keyword'];
        $this->fileName = 'member.product.showList.php';
        $this->template($export);
        die();
    }

    public function getPackage()
    {
        $package = new package();
        return $package->getCompanyPackage($this->company_info['company_id']);

    }

    public function getCategory($action)
    {
        include_once(ROOT_DIR . "component/category/model/category.model.php");

        $category = new categoryModel();
        $category->setAction($action);
        $category::$mainList = '';
        $category::$mainMenu = '';
        $result = $category->getCategoryTree();
        $resultCategory = $category->getCategoryUlLiMember($category->list);

        if ($resultCategory['result'] == 1) {
            return $resultCategory['export']['list'];
        }

        return;

        /*$category = new categoryModel();
        $resultCategory = $category->getCategoryUlLi();

        return $resultCategory;


        $category = new adminCategoryModel();
        $resultCategory = $category->getCategoryOption();

        if ($resultCategory['result'] == 1) {
            $result1['category'] = $category->list;
            return $result1;
        }
        return null;*/
    }

    public function deleteProduct($id)
    {
        $product = c_product_d::find($id);

        if (!is_object($product)) {
            $result['msg'] = 'محصول مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        if ($product->company_id != $this->company_info['company_id']) {
            $result['msg'] = 'کمپانی مورد نظر یافت نشد';
            echo json_encode($result);
            die();
        }

        $fields['company_id'] = $product->company_id;
        $package_model = adminpackageusageModel::checkPackageUsage($fields['company_id'], 'delete', 'product');

        if (!is_object($package_model)) {
            echo json_encode($package_model);
            die();
        }
        $package_model->save();
        $input['component'] = "product";
        $input['company_id'] = $product->company_id;
        $input['image'] = $product->image;
        if ($product->product_id == 0) {
            $result = $product->delete();
            removeFiles($input);
        } else {
            $result = $this->deleteAll($product);
        }

        if ($result['result'] == -1) {
            echo json_encode($result);
            die();
        }

        if ($product->status == 1) {
            calculateScoreCompany($this->company_info['company_id']);
        }

        $unconfirmedProducts = c_product_d::getAll()
            ->where('company_id', '=', $this->company_info['company_id'])
            ->where('status', '=', -1)
            ->where('isActive', '=', 1)
            ->getList();

        if ($unconfirmedProducts['export']['recordsCount'] <= 0) {
            $this->updateCompany($this->company_info['company_id'], 'disable');
        }

        $result['fields'] = $product->fields;
        $result['msg'] = "محصول مورد نظر حذف گردید";
        $result['result'] = 1;
        echo json_encode($result);
        die();
    }

    public function deleteAll($product)
    {
        $product = c_product_d::getBy_product_id($product->product_id)->get();
        foreach ($product['export']['list'] as $product) {
            $result = $product->delete();
            removeFiles($product->image);

            if ($result['result'] == -1) {
                $result['msg'] = 'محصول مورد نظر حذف نشد';
                return $result;
            }
        }
        $productMain = c_product::find($product->product_id);

        if (is_object($productMain)) {
            $result = $productMain->delete();
            return $result;
        }
        return $result;
    }

    public function uploadImage($image, $company_id)
    {
        $uploader = new Uploader();
        $property = [
            'image' => $image,
            'company_id' => $company_id,
            'folder_name' => 'product'
        ];
        $sizes = [
            'size1' => ['width' => '100', 'height' => '100'],
            'size2' => ['width' => '90', 'height' => '90'],
            'size3' => ['width' => '150', 'height' => '150'],
            'size4' => ['width' => '200', 'height' => '200'],
            'size5' => ['width' => '457', 'height' => '457']
        ];


        return $uploader->cropAndCompressImage($property, $sizes);
    }

    /*public function updateProductGallery($fields)
    {
        $fields['product_id'] = 1;
        $fields['gallery12'] = 'ddsddfdsfdfsfdsf';
        $fields['delete12'] = 'on';
        $fields['gallery2'] = 'rewrwerwerwerewq';
        $fields['gallery3'] = 'vcvvxvxvxvxvxvxv';
        $fields['gallery4'] = '';
        $fields['delete4'] = 'on';

        $fields = $this->manageRequest($fields);

        $destination = COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/product/" . $fields['product_id'];

        foreach ($fields['gallery'] as $key => $value) {
            dd($value);
            $gallery = ProductGallery::getAll()
                ->where('product_gallery_id', '=', $key)
                ->where('product_id', '=', $fields['product_id'])
                ->first();

            if (!is_object($gallery)) {
                $result = $this->addProductGallery($value, $fields['product_id'], $destination);
                if ($result['result'] == -1) {
                    $result['message'] = "گالری اضافه نشد";
                }
            } elseif (isset($value['delete'])) {
                $this->deleteImagesFromGallery($gallery);
                $result = $gallery->delete();
            } else {
                if (!empty($value['image'])) {
                    $this->deleteImagesFromGallery($gallery);
                    $result = $this->uploadGalleryImage($value['image'], $destination);
                    $gallery->image = $result['image'];
                }

                $gallery->save();
            }
        }

        return $result;

    }*/

    public function deleteImagesFromGallery($gallery)
    {
        unlink(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/product/gallery/" . $gallery->image);
//        unlink(COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/product/" . $gallery->product_id . DS . "650.366." . $gallery->image);
    }


    public function showProductGallery($fields)
    {
        $product = c_product_d::getAll()
            ->where('Product_d_id', '=', $fields['product_d_id'])
            ->where('isActive', '=', 1)
            ->where('company_id', '=', $this->company_info['company_id'])
            ->first();

        if (!is_object($product)) {
            $response['result'] = -1;
            $response['msg'] = "محصول مورد نظر یافت نشد";
            echo json_encode($response);
            die();
        }

        $response['data'] = $product->galleries();

        echo json_encode($response);
        die();
    }

    public function addProductGallery($fields)
    {
        $product = c_product_d::getAll()
            ->where('Product_d_id', '=', $fields['product_d_id'])
            ->where('isActive', '=', 1)
            ->where('company_id', '=', $this->company_info['company_id'])
            ->first();

        if (!is_object($product)) {
            $response['result'] = -1;
            $response['msg'] = "محصول مورد نظر یافت نشد";
            echo json_encode($response);
            die();
        }

        $destination = COMPANY_ADDRESS_ROOT . $this->company_info['company_id'] . "/product/gallery";
        $image = $this->uploadGalleryImage($fields['image'], $destination);

        if ($image['result'] != 1) {
            $response['result'] = -1;
            $response['msg'] = "آپلود عکس گالری با خطا مواجه شد";
            echo json_encode($response);
            die();
        }

        $product_gallery = $this->addRecordToProductGallery($product, $image['image']);

        if (!is_object($product_gallery)) {
            $response['result'] = -1;
            $response['msg'] = "بارگذاری عکس گالری با خطا مواجه شد";
            echo json_encode($response);
            die();
        }

        $response = [
            'result' => 1,
            'msg' => 'بارگذاری عکس گالری باموفقیت انجام شد',
            'data' => [
                'product_d_id' => $product_gallery->product_d_id,
                'product_gallery_id' => $product_gallery->product_gallery_id,
                'image' => $product_gallery->image,
                'src' => COMPANY_ADDRESS . $this->company_info['company_id'] . "/product/gallery" . DS . $product_gallery->image,
            ]
        ];

        $this->updateGalleryEditFieldInCompany($this->company_info['company_id'], 'enable');

        echo json_encode($response);
        die();

    }

    public function addRecordToProductGallery($product, $image)
    {
        $product_gallery = new ProductGallery();
        $product_gallery->product_d_id = $product->Product_d_id;
        $product_gallery->product_id = $product->product_id;
        $product_gallery->editor_id = $product->company_id;
        $product_gallery->image = $image;
        $product_gallery->status = -1;
        $product_gallery->isActive = 1;
        $product_gallery->isAdmin = 1;
        $product_gallery->admin_description = null;
        $product_gallery->save();
        $product_gallery->parent_id = $product_gallery->product_gallery_id;
        $result = $product_gallery->save();

        if ($result['result'] == 1) {
            return $product_gallery;
        }
    }

    public function deleteProductGallery($fields)
    {
        /*$productGallery = ProductGallery::getAll()
            ->leftJoin('c_product_d', 'product_gallery.product_d_id', '=', 'c_product_d.Product_d_id')
            ->where('product_gallery.product_gallery_id', '=', $fields['product_gallery_id'])
            ->where('c_product_d.isActive', '=', 1)
            ->where('c_product_d.company_id', '=', $this->company_info['company_id'])
            ->first();*/

        $productGallery = ProductGallery::find($fields['product_gallery_id']);

        if (!is_object($productGallery)) {
            $response['result'] = -1;
            $response['msg'] = "عکس گالری مورد نظر یافت نشد";
            echo json_encode($response);
            die();
        }

        $product = c_product_d::getAll()
            ->where('Product_d_id', '=', $productGallery->product_d_id)
            ->where('isActive', '=', 1)
            ->where('c_product_d.company_id', '=', $this->company_info['company_id'])
            ->first();

        if (!is_object($product)) {
            $response['result'] = -1;
            $response['msg'] = "عکس گالری مورد نظر یافت نشد";
            echo json_encode($response);
            die();
        }

        $result = $this->deleteGallery($productGallery);

        if ($result['result'] != 1) {
            $result['msg'] = "حذف عکس گالری با خطا مواجه شد";
            echo json_encode($result);
            die();
        }

        $response = [
            'result' => 1,
            'msg' => 'حذف عکس گالری باموفقیت حذف شد',
        ];

        $galleries = ProductGallery::getAll()->where('status', '=', -1)->where('isActive', '=', 1)->getList();

        if ($galleries['export']['recordsCount'] <= 0) {
            $this->updateGalleryEditFieldInCompany($this->company_info['company_id'], 'disable');
        }

        echo json_encode($response);
        die();
    }

    public function deleteGallery($productGallery)
    {
        /*$sql = "DELETE FROM product_gallery WHERE parent_id = " . $productGallery->parent_id;
        $result = ProductGallery::query($sql)->get();*/

        $productGalleries = ProductGallery::getAll()
            ->where('parent_id', '=', $productGallery->parent_id)
            ->get();

        foreach ($productGalleries['export']['list'] as $productGallery) {
            if (is_object($productGallery)) {
                $this->deleteImagesFromGallery($productGallery);
                $result = $productGallery->delete();
            }
        }

        return $result;
    }

    /*public function manageRequest($fields)
    {
        foreach ($fields as $key => $value) {
            if (is_numeric(strpos($key, 'gallery'))) {
                $cnt = substr($key, 7) ? substr($key, 7) : 0;
                $fields['gallery'][$cnt]['image'] = $value;
                !$fields['delete' . $cnt] ?: $fields['gallery'][$cnt]['delete'] = $fields['delete' . $cnt];
                unset($fields[$key], $fields['delete' . $cnt]);
            }
        }

        return $fields;
    }*/

    public function uploadGalleryImage($image, $destination)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'destination' => $destination
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property);
        }
    }
}


