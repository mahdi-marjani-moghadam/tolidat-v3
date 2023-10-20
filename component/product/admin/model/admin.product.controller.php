<?php
/**
 * Created by PhpStorm.
 * User: malekloo
 * Date: 3/6/2016
 * Time: 11:21 AM
 */

include_once(dirname(__FILE__) . "/admin.product.model.php");
include_once(dirname(__FILE__) . "/admin.productDraft.model.php");
include_once ROOT_DIR . 'component/company/admin/model/admin.company.controller.php';
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';
include_once(ROOT_DIR . "component/packageUsage/admin/model/admin.packageUsage.model.php");
include_once ROOT_DIR . 'services/uploader/Uploader.php';

/**
 * Class registerController
 */
class adminProductController
{
    /**
     * Contains file type
     * @var
     */
    public $exportType;

    /**
     * Contains file name
     * @var
     */
    public $fileName;

    /**
     * registerController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';

    }

    /**
     * call template
     *
     * @param string $list
     * @param $msg
     * @return string
     */
    function template($list = [], $msg='')
    {
        global $messageStack;
        switch ($this->exportType) {
            case 'html':
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php");
                include(ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php");
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

    public function showProductAddForm($fields, $msg)
    {

        include_once ROOT_DIR . 'component/licence/admin/model/admin.licence.controller.php';
        $count = $this->getByCompanyId($fields['company_id'], $fields['branch_id']);


        $companyObject = admincompanyModel::find($fields['company_id']);


        if ((getPackageUsage($fields['company_id']) <= $count) and ($companyObject->package_status != 1)) {
            $msg = "حداکثر تعداد موجود در بسته استفاده است";
            redirectPage(RELA_DIR . "admin/index.php?component=product", $msg);
        }

        $packageUsage = getPackageUsage($fields['company_id']);
        $fields['maxCategory'] = $packageUsage->category;
        if ($companyObject->package_status == 1) {
            $fields['maxCategory'] = 4;
        }
        $this->fileName = 'admin.product.addForm.php';

        //------> Get All Category
        include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
        $category = new adminCategoryController();
        $resultCategory = $category->getCategory();
        $fields['category'] = $resultCategory;


        $this->template($fields, $msg);
        die();
    }

    public function showProductEditForm($fields, $msg)
    {
        $result = adminc_product_dModel::getBy_product_id_and_isActive_and_status($fields['product_id'], 1, 0)->getList();
        if ($result['export']['recordsCount'] != 0) {
            $msg = "این رکورد قبلا توسط کاربر ویرایش شده است";
            redirectPage(RELA_DIR . "admin/index.php?component=company", $msg);
        }

        $result = adminc_productModel::find($fields['product_id']);
        if (is_object($result)) {

            $export['meta_keyword'] = $result->meta_keyword;
            $export['product'] = $result->fields;


            $packageUsage = getPackageUsage($result->company_id);
            $companyObject = admincompanyModel::find($result->company_id);

            $export['maxCategory'] = $packageUsage->category;

            if ($companyObject->package_status == 1) {
                $export['maxCategory'] = 1;
            }

            include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
            $category = new adminCategoryModel();
            $resultCategory = $category->getCategoryOption();

            if ($resultCategory['result'] == 1) {
                $export['category'] = $category->list;
            }

            //------> Get All Category
            include_once ROOT_DIR . 'component/category/admin/model/admin.category.controller.php';
            $category = new adminCategoryController();
            $resultCategory = $category->getCategory();
            $export['category'] = $resultCategory;

            $this->fileName = 'admin.product.editForm.php';
            $this->template($export, $msg);
            die();
        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=product", $msg);
        }
    }

    public function showList($fields)
    {
        $product = new adminc_productModel();
        $result = $product::getBy_company_id($fields['choose']['company_id'])->getList();
        // dd($fields['choose']['company_id']);
        if ($result['result'] != '1') {
            $this->fileName = 'admin.product.showList.php';
            $this->template('', $result['msg']);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['recordsCount'] = $result['export']['recordsCount'];
        $export['company_id'] = $fields['choose']['company_id'];
        $this->fileName = 'admin.product.showList.php';
        $this->template($export);
        die();
    }

    public function add($fields, $files)
    {
        include_once ROOT_DIR . 'component/category/admin/model/CategoryProduct.model.php';

        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_product_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));


        ////////////////////////////////////Find Company Information
        //------> get parent_id and category_id

        $companyObject = new adminCompanyController();
        $result = $companyObject->getParentIdCategory($fields);

        $input['parent_category_id'] = $result['parent_category_id'];
        $input['category_id'] = $result['category_id'];


        ////////////////////////////////////Find Company Information
        $companyObject = new adminCompanyController();
        $company = $companyObject->getCompanyById($fields['company_id']);
        $fields['city_id'] = $company->city_id;
        $fields['state_id'] = $company->state_id;


        ////////////////////////////////////Add new record
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());
        if (count($fields['category_id']) > 0) {
            $fields['category_id'] = "," . trim(implode(",", $fields['category_id'])) . ",";
        } else {
            $fields['category_id'] = '';
        }
        $fields['image'] = '';
        $fields['status'] = '1';


        if (!empty($fields['productImage'])) {

            $uploader = new Uploader();

            $property = ['image' => $fields['productImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'product'];

            $sizes = [
                'size1' => ['width' => '100', 'height' => '100'],
                'size2' => ['width' => '90', 'height' => '90'],
                'size3' => ['width' => '150', 'height' => '150'],
                'size4' => ['width' => '200', 'height' => '200'],
                'size5' => ['width' => '457', 'height' => '457']
            ];

            $result = $uploader->cropAndCompressImage($property, $sizes);
            $fields['image'] = $result['image'];
        }


        $newMainObject = new $mainModel();
        $newMainObject->setFields($fields);
        $newMainObject->save();

        //-------------------------------------
        $newMainObject->category()->detach();

        $categoryArray = $input['category_id'];
        $parentCategoryArray = $input['parent_category_id'];
        $mainArray = tagToArray(rtrim($categoryArray) . $parentCategoryArray)['export']['list'];
        $newMainObject->category()->attach($mainArray);
        //-------------------------------------
        ////////////////////////////////////Save to Darft
        $newDraftObject = new $draftModel();
        $newDraftObject->setFields($newMainObject->fields);
        $newDraftObject->$draft_f_key = $newMainObject->$main_p_key;
        $newDraftObject->company_id = $newMainObject->company_id;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->status = 1;
        $newDraftObject->editor_id = $editor_id;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->admin_description = '';
        $newDraftObject->save();

        if ($company->package_status != 1) {
            //update package usage product ++
            $package_model = adminpackageusageModel::checkPackageUsage($fields['company_id'], 'add', 'product');
            if (is_object($package_model)) {
                $package_model->save();
                $msg = "محصول با موفقیت اضافه شد.";
                calculateScoreCompany($fields['company_id']);
            } else {
                $msg = $package_model['msg'];
            }
        }

        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function edit($fields, $files)
    {

        
        global $admin_info;
        ////////////////////////////////////
        $editor_id = $admin_info['admin_id'];
        $draftModel = 'adminc_product_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

        ////////////////////////////////////
        $fields['date'] = strftime('%Y-%m-%d %H:%M:%S', time());

//        if (count($fields['category_id']) > 0 ) {
//            $fields['category_id'] = "," . trim(implode(",", $fields['category_id'])) . ",";
//        } else {
//            $fields['category_id'] = '';
//        }
        //print_r_debug($fields['category_id']);
        //$fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        $fields['image'] = '';


        //$fields['category_id']=',1913,';
        //------> get parent_id and category_id
        $companyObject = new adminCompanyController();
        $result = $companyObject->getParentIdCategory($fields);

        $fields['parent_category_id'] = $result['parent_category_id'];
        $fields['category_id'] = $result['category_id'];
//        if (trim($fields['category_id']) != '') {
//            $fields['category_id'] = "," . $fields['category_id'] . ",";
//        }else{
//            $fields['category_id'] = "";
//        }

        ////////////////////////////////////Find Company Information
        $companyObject = new adminCompanyController();
        $company = $companyObject->getCompanyById($fields['company_id']);
        $fields['city_id'] = $company->city_id;
        $fields['state_id'] = $company->state_id;


        ////////////////////////////////////Update Main
        $MainObject = $mainModel::find($fields[$main_p_key]);

        if (is_object($MainObject)) {
            if ($fields['remove_image'] != 'on') {


                if (!empty($fields['productImage'])) {


                    $uploader = new Uploader();

                    $property = ['image' => $fields['productImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'product'];

                    $sizes = [
                        'size1' => ['width' => '100', 'height' => '100'],
                        'size2' => ['width' => '90', 'height' => '90'],
                        'size3' => ['width' => '150', 'height' => '150'],
                        'size4' => ['width' => '200', 'height' => '200'],
                        'size5' => ['width' => '457', 'height' => '457']
                    ];

                    $result = $uploader->cropAndCompressImage($property, $sizes);
                    $fields['image'] = $result['image'];

                } else {
                    $fields['image'] = $MainObject->image;
                }

            } else {
                // $MainObject->delete();
                $fields['image'] = '';

            }

            $MainObject->setFields($fields);
            $MainObject->save();

//-------------------------------------

            $MainObject->category()->detach();
            $categoryArray = $result['category_id'];
            $parentCategoryArray = $result['parent_category_id'];
            $mainArray = array_merge($categoryArray, $parentCategoryArray);
            $MainObject->category()->attach($mainArray);

//-------------------------------------

            ////////////////////////////////////update pervious record of draft
            $getBy = "getBy_" . $draft_f_key . "_and_company_id_and_isActive";
            $perviousDraftObject = $draftModel::$getBy($MainObject->$main_p_key, $MainObject->company_id, 1)->orderBy($draft_p_key, 'DESC')->first();

            if (is_object($perviousDraftObject)) {
                $perviousDraftObject->isActive = 0;
                $perviousDraftObject->isAdmin = 1;
                $perviousDraftObject->status = 1;
                $perviousDraftObject->editor_id = $editor_id;
                $perviousDraftObject->save();
            } else {
                $msg = "رکورد اصلی یافت نشد!";
            }

            ////////////////////////////////////Add new record in draft
            $draftObject = new $draftModel();
            $draftObject->setFields($MainObject->fields);
            $draftObject->$draft_f_key = $MainObject->$main_p_key;
            $draftObject->company_id = $MainObject->company_id;
            $draftObject->isActive = 1;
            $draftObject->isAdmin = 1;
            $draftObject->status = 1;
            $draftObject->editor_id = $editor_id;
            $draftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
            $draftObject->save();
            $msg = "عملیات با موفقیت انجام شد";
        } else {
            $msg = "رکورد اصلی یافت نشد!";
        }

        calculateScoreCompany($fields['company_id']);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $fields['company_id'], $msg);
        die();
    }

    public function delete($id)
    {
        ////////////////////////////////////
        $draftModel = 'adminc_product_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));
        $imageAddress = str_replace("company", "", $componentName);


        ////////////////////////////////////delete Record
        $mainObject = $mainModel::find($id);


        //-------------------------------------

        $mainObject->category()->detach();

//-------------------------------------

        if (is_object($mainObject)) {


            $company_id = $mainObject->company_id;
            $getBy = "getBy_" . $draft_f_key;
            $draftObject = $draftModel::$getBy($mainObject->$main_p_key)->get();
            foreach ($draftObject['export']['list'] as $draftRecord) {
                fileRemover(COMPANY_ADDRESS_ROOT . $draftRecord->company_id . "/" . $imageAddress . "/", $draftRecord->image);
                $draftRecord->delete();
            }
            $mainObject->delete();
            $msg = "محصول با موفقیت حذف گردید.";


            //------> find company
            $companyObject = new adminCompanyController();
            $company = $companyObject->getCompanyById($company_id);

            if ($company->package_status != 1) {
                $package_model = adminpackageusageModel::checkPackageUsage($company_id, 'delete', 'product');
                $package_model->save();
            }
        } else {
            $msg = "رکورد اصلی یافت نشد.";
        }

        calculateScoreCompany($company_id);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&id=' . $company_id, $msg);
        die();
    }

    public function getByCompanyId($company_id, $branch_id = 0)
    {
        $product = adminc_productModel::getBy_company_id_and_branch_id($company_id, $branch_id)->getList();
        return $product;
    }

    public function getProductByCompanyId($company_id)
    {
        $productResult = adminc_productModel::getBy_company_id($company_id)->getList();
        return $productResult;
    }

    public function getProductById($product_id)
    {
        $productResult = adminc_productModel::find($product_id);
        return $productResult;
    }

    //---------------------------------------draft Product----------
    public function showDraftProduct($company_id)
    {
        $result = adminc_product_dModel::getBy_status_and_company_id_and_isActive(-1, $company_id, 1)->orderBy('Product_d_id', 'DESC')->getList();
        if ($result['result'] != 1) {
            $this->fileName = 'admin.productDraft.showList.php';
            $msg = "خطا در عملیات";
            $this->template('', $msg);
            die();
        }
        $export['list'] = $result['export']['list'];
        $export['company_id'] = $company_id;
        $this->fileName = 'admin.productDraft.showList.php';

        $this->template($export);
        die();
    }

    public function editDraftProductForm($fields)
    {
        $count = $this->getByCompanyId($fields['company_id'], $fields['branch_id']);
        if (getPackageUsage($fields['company_id']) <= $count) {
            $msg = "حداکثر تعداد موجود در بسته استفاده است";
            redirectPage(RELA_DIR . "admin/index.php?component=product", $msg);
        }

        $result = adminc_product_dModel::find($fields['draft_id']);

        if (is_object($result)) {
            $export = $result->fields;

            $export['category_id'] = tagToArray($result->category_id)['export']['list'];
            $export['date'] = convertDate($result->date);
            //print_r_debug($export);
            include_once(ROOT_DIR . "component/category/admin/model/admin.category.model.php");
            $category = new adminCategoryModel();
            $resultCategory = $category->getCategoryOption();
            if ($resultCategory['result'] == 1) {
                $export['category'] = $category->list;
            }
            $this->fileName = 'admin.productDraft.editForm.php';
            $export->date = convertJToGDate($fields);

            $this->template($export, $msg);
            die();

        } else {
            $msg = $result['msg'];
            redirectPage(RELA_DIR . "admin/index.php?component=company&action=showDraftCompany", $msg);
        }
    }

    public function editDraftProduct($fields, $files)
    {


        global $admin_info;
        ////////////////////////////////////
        $draftModel = 'adminc_product_dModel';
        $mainModel = str_replace("_dModel", "Model", $draftModel);
        $draft_p_key = ucfirst(str_replace("_dModel", "_d_id", str_replace("adminc_", "", $draftModel)));
        $draft_f_key = lcfirst(str_replace("_d_id", "_id", $draft_p_key));
        $main_p_key = ucfirst($draft_f_key);
        $componentName = str_replace("_dModel", "", str_replace("adminc_", "", $draftModel));

        //set fields var
        $fields['category_id'] = arrayToTag($fields['category_id'])['export']['list'];
        /////////////////////////////////////

        $fields['editor_id'] = $admin_info['admin_id'];
        $fields['files'] = $files;
        $fields['draftModel'] = $draftModel;
        $fields['mainModel'] = $mainModel;
        $fields['draft_p_key'] = $draft_p_key;
        $fields['draft_f_key'] = $draft_f_key;
        $fields['main_p_key'] = $main_p_key;
        $fields['componentName'] = $componentName;


        //find draft record
        $draftObject = $draftModel::find($fields['draft_id']);
        $fields['city_id'] = $draftObject->city_id;
        $fields['state_id'] = $draftObject->state_id;
        $fields['company_id'] = $draftObject->company_id;
        if (!is_object($draftObject)) {
            $msg = "رکورد ویرایش شده یافت نشد! ";
            redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showDraft' . ucfirst($componentName) . '&id=' . $draftModel->company_id, $msg);
        }

        if ($fields['process'] == 1) {
            $this->acceptDraft($draftObject, $fields);
        } else if ($fields['process'] == -1) {
            $this->rejectDraft($draftObject, $fields);
        }
        $countObject = $fields['draftModel']::getBy_status_and_company_id_and_isActive(-1, $draftObject->company_id, 1)->orderBy($fields['draft_p_key'], 'DESC')->getList();
        $item['id'] = $draftObject->company_id;
        $item['componentName'] = $fields['componentName'];
        $item['countItem'] = $countObject['export']['recordsCount'];

        calculateScoreCompany($fields['company_id']);

        $this->editCompany($item);
        redirectPage(RELA_DIR . 'admin/index.php?component=' . $componentName . '&action=showDraft' . ucfirst($componentName) . '&id=' . $draftObject->company_id, $msg);

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

        if ($fields['remove_image'] != 'on') {
            if (!empty($fields['productImage'])) {
                $uploader = new Uploader();

                $property = ['image' => $fields['productImage'], 'company_id' => $fields['company_id'], 'folder_name' => 'product'];

                $sizes = ['size1' => ['width' => '100', 'height' => '100'], 'size2' => ['width' => '90', 'height' => '90'], 'size3' => ['width' => '150', 'height' => '150'], 'size4' => ['width' => '200', 'height' => '200']];

                $result = $uploader->cropAndCompressImage($property, $sizes);
                $fields['image'] = $result['image'];
            } else {
                $fields['image'] = $draftObject->image;
            }

        } else {
            $fields['image'] = '';
        }


        ///draft to Main

        if ($draftObject->product_id == 0) {
            $mainObject = new c_product();// when add new row
            $fields[$fields['draft_f_key']] = $mainObject->$fields['main_p_key'];
        } else {
            $mainObject = c_product::find($draftObject->product_id);// when main row is edit
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
        $newDraftObject->product_id = $mainObject->Product_id;
        $newDraftObject->status = 1;
        $newDraftObject->isActive = 1;
        $newDraftObject->isAdmin = 1;
        $newDraftObject->date = strftime('%Y-%m-%d %H:%M:%S', time());
        $newDraftObject->editor_id = $fields['editor_id'];
        $newDraftObject->save();


//update Draft
        if ($draftObject->product_id == 0) {  //if add new object
            $draftObject->product_id = $mainObject->Product_id;
        }
        $draftObject->isActive = 0;
        $draftObject->status = 1;
        $draftObject->editor_id = $fields['company_id'];
        $draftObject->save();

        $this->updateGalleries($draftObject, $newDraftObject);
        // add New Notification
        $notification = new adminNotificationController();
        $Items = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => "تغییرات محصول شما با موفقیت اعمال شد", 'messageType' => 2];
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
        $fields = ['from' => $fields['editor_id'], 'to' => $draftObject->company_id, 'msg' => "تغییرات محصول شما با موفقیت اعمال نشد", 'messageType' => 2];
        $notification->addNotification($fields);
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
    /**
     * getProductCategory product
     *
     * @param $fields
     * @author
     * @copyright 2017 The daba Group
     * @method function getProductCategory($fields)
     * @version 0.0.1
     */
    public function getProductCategory($fields)
    {
        //print_r_debug($fields);
        $productCategory = adminc_productModel::getBy_company_id($fields['company_id'])->getList();

        $categoryArray = array();
        if ($productCategory['export']['recordsCount'] > 0) {
            $categoryString = '';
            foreach ($productCategory['export']['list'] as $key => $value) {
                $categoryString = $value['category_id'] . ',' . $categoryString;
            }
        }
        $categoryArray = explode(',', $categoryString);
        $categoryArray = array_filter($categoryArray, 'strlen');

        //print_r_debug($categoryArray);

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

        $item = array("product" => "0", "certification" => "1", "honour" => "2", "businessLicence" => "3", "history" => "4", "companyNews" => "5", "companyAddresses" => "6", "companyPhones" => "7", "companyEmails" => "8", "companyWebsites" => "9", "companyBanner" => "10", "companyLogo" => "11", "companyCommercialName" => "12", "licences" => "13", "companySocials" => "14", "companyPositions" => "15", "branch" => "16", "wiki" => "17");
        $editField = $companyObject->edit;

        if ($items['countItem'] < 1) {
            $editField[$item[$items["componentName"]]] = 0;
            $companyObject->edit = $editField;
            $companyObject->save();
            redirectPage(RELA_DIR . 'admin/index.php?component=company&action=showDraftCompany', 'انجام شد ');
            die();
        }
    }

    public function deleteAllProductByCompanyId($company_id)
    {
        //delete from main table
        $products = adminc_productModel::getAll()->where('company_id', '=', $company_id)->get();

        if ($products['export']['recordsCount'] > 0) {
            foreach ($products['export']['list'] as $product) {
                $product->delete();
            }
        }

        //delete from draft table
        $products = adminc_product_dModel::getAll()->where('company_id', '=', $company_id)->get();

        if ($products['export']['recordsCount'] > 0) {
            foreach ($products['export']['list'] as $product) {
                $product->delete();
            }
        }

        return;

    }

    public function showDraftGalleryProduct($company_id)
    {
        $galleries = $this->getGalleries($company_id);

        if ($galleries['export']['recordsCount'] <= 0) {
            redirectPage(RELA_DIR . 'admin/?component=company&action=showDraftCompany', 'گالری برای تایید وجود ندارد');
        }

        $this->fileName = 'admin.galleryProductDraft.showList.php';
        $this->template($galleries['export']['list']);
        die();
    }

    public function editDraftGalleryProductForm($fields)
    {
        $gallery = ProductGallery::find($fields['product_gallery_id']);

        if (!is_object($gallery)) {
            redirectPage(RELA_DIR . 'admin/?component=company&action=showDraftGalleryProduct&id=' . $fields['company_id']);
        }

        $this->fileName = 'admin.galleryProductDraft.editForm.php';
        $export = $gallery->fields;
        $export['company_id'] = $fields['company_id'];
        $this->template($export);
        die();
    }

    public function editDraftGalleryProduct($fields)
    {
        $gallery = ProductGallery::find($fields['product_gallery_id']);

        if (!is_object($gallery)) {
            redirectPage(RELA_DIR . 'admin/?component=company&action=showDraftGalleryProduct&id=' . $fields['company_id']);
        }

        global $admin_info;
        $fields['admin_id'] = $admin_info['admin_id'];
        $fields['parent_id'] = $gallery->parent_id;
        $fields['product_d_id'] = $gallery->product_d_id;
        $fields['product_id'] = $gallery->product_id;
        $fields['image'] = $gallery->image;

        if ($fields['process'] != 1) {
            $result = $this->rejectGallery($fields, $gallery);
        } else {
            $result = $this->confirmGallery($fields, $gallery);
        }

        if (!$result) {
            redirectPage(RELA_DIR . 'admin/?component=product&action=showDraftGalleryProduct&id=' . $fields['company_id'], 'عکس آپلود نشد');
        }

        $galleries = $this->getGalleries($fields['company_id']);

        if ($galleries['export']['recordsCount'] <= 0) {
            $this->updateCompany($fields['company_id']);
            redirectPage(RELA_DIR . 'admin/?component=company&action=showDraftCompany', 'عملیات انجام شد');
        }

        redirectPage(RELA_DIR . 'admin/?component=product&action=showDraftGalleryProduct&id=' . $fields['company_id'], 'عملیات انجام شد');
    }

    public function rejectGallery($fields, $gallery)
    {
        $fields['isActive'] = -1;
        $fields['status'] = 1;

        $this->enablePreviousRecordOfProductGallery($gallery);
        $this->addNewRecordToProductGallery($fields);

        return true;
    }

    public function confirmGallery($fields, $gallery)
    {
        if (!empty($fields['uploadImage'])) {
            $image = $this->uploadImage($fields);

            if ($image['result'] != 1) {
                return false;
            }

            $fields['image'] = $image['image'];
        }

        $fields['isActive'] = 1;
        $fields['status'] = 2;

        $this->disablePreviousRecordOfProductGallery($gallery);
        $this->addNewRecordToProductGallery($fields);

        return true;
    }

    public function getGalleries($company_id)
    {
        return ProductGallery::getAll()
            ->select('product_gallery.*', 'c_product_d.company_id')
            ->leftJoin('c_product_d', 'c_product_d.Product_d_id', '=', 'product_gallery.product_d_id')
            ->where('product_gallery.status', '=', -1)
            ->where('product_gallery.isActive', '=', 1)
            ->where('c_product_d.company_id', '=', $company_id)
            ->getList();
    }

    public function uploadImage($fields)
    {
        $destination = COMPANY_ADDRESS_ROOT . $fields['company_id'] . "/product/gallery";

        $property = [
            'image' => $fields['uploadImage'],
            'destination' => $destination
        ];

        $uploader = new Uploader();
        return $uploader->cropAndCompressImage($property);
    }

    public function addNewRecordToProductGallery($fields)
    {
        $newGallery = new ProductGallery();
        $newGallery->parent_id = $fields['parent_id'];
        $newGallery->product_d_id = $fields['product_d_id'];
        $newGallery->product_id = $fields['product_id'];
        $newGallery->editor_id = $fields['admin_id'];
        $newGallery->image = $fields['image'];
        $newGallery->isActive = $fields['isActive'];
        $newGallery->status = $fields['status'];
        $newGallery->isAdmin = 1;
        $newGallery->admin_description = $fields['admin_description'];
        return $newGallery->save();
    }

    public function enablePreviousRecordOfProductGallery($gallery)
    {
        $gallery->isActive = 0;
        $gallery->status = 1;
        $gallery->save();

        $galleries = ProductGallery::getAll()
            ->where('parent_id', '=', $gallery->parent_id)
            ->where('status', '=', 2)
            ->get();

        if ($galleries['export']['recordsCount'] > 0) {
            foreach ($galleries['export']['list'] as $gallery) {
                $gallery->isActive = 1;
                $gallery->save();
            }
        }

        return true;
    }

    public function disablePreviousRecordOfProductGallery($gallery)
    {
        $gallery->isActive = 0;
        $gallery->status = 1;
        $gallery->save();

        $galleries = ProductGallery::getAll()
            ->where('parent_id', '=', $gallery->parent_id)
            ->where('status', '=', 2)
            ->get();

        if ($galleries['export']['recordsCount'] > 0) {
            foreach ($galleries['export']['list'] as $gallery) {
                $gallery->status = 1;
                $gallery->status = 1;
                $gallery->save();
            }
        }

        return true;
    }

    public function updateCompany($company_id)
    {
        include_once ROOT_DIR . 'component/company/admin/model/admin.company.model.php';

        $company = admincompanyModel::find($company_id);

        if (is_object($company)) {
            $company->edit = $company->edit & '1111111111111111111101111';
            $company->save();
        }

        return true;
    }

}
