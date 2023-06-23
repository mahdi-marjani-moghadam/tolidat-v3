<?php

class CronjobController
{

    public function run()
    {
        include_once ROOT_DIR . "services/uploader/Uploader.php";

        $uploader = new Uploader();
        $uploader->resizeUploadedImages();

        die('finish');
    }

    public function phpinfo()
    {
        $upload = ini_get('upload_max_filesize');
        $post = ini_get('post_max_size');

        echo 'upload_max_filesize: ' . $upload;
        echo '<br>';
        echo 'post_max_size: ' . $post;
        echo '<br>';

        ini_set('upload_max_filesize', '50M');
        ini_set('post_max_size', '60M');

        $upload = ini_get('upload_max_filesize');
        $post = ini_get('post_max_size');

        echo 'new_upload_max_filesize: ' . $upload;
        echo '<br>';
        echo 'new_post_max_size: ' . $post;
        echo '<br>';

        echo phpinfo();
    }

    public function updatePriorityAllCompany()
    {
        include_once ROOT_DIR . "component/company/member/model/member.company.model.php";
        include_once ROOT_DIR . "component/register/model/register.model.php";
        require_once ROOT_DIR . "model/Rate.php";

        echo "Start:  " . strftime('%Y-%m-%d %H:%M:%S', time()) . '<br>';
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);

        $companies = company::getAll()
//            ->select('priority_details')
//            ->where('refresh_date', '<>', '2017-06-18 14:06:45')
//            ->where('priority', '>=', '50')
            ->where('Company_id', '=', '7066')
            ->orWhere('Company_id', '=', '4119')
            ->orWhere('Company_id', '=', '11779')
//            ->orderBy('priority', 'DESC')
//            ->limit(1)
            ->get();

//        dd($companies['export']['recordsCount']);
//        dd($companies['export']['list']['49']);
//        dd($companies['export']['list']);

        foreach ($companies['export']['list'] as $company) {
            $rate = new Rate($company);
            $rate->calculation();
        }

        echo "Finish:  " . strftime('%Y-%m-%d %H:%M:%S', time());
        die();
    }

    public function createDiscountCode()
    {
        $sql = "INSERT INTO `discount_code` (`Discount_code_id`, `code`, `percent`, `type`, `start_date`, `expire_date`, `status`, `package_id`) VALUES";
        $start_date = convertJToGDate('1396/11/29');
        $expire_date = convertJToGDate('1396/12/7');

        for ($i = 1; $i <= 440; $i = $i + 2) {
            $code = 'B4119' . $i;
            $sql .= " (NULL ,'" . $code . "','" . 100 . "'," . 1 . ",'" . $start_date . "','" . $expire_date . "'," . 0 . "," . 0 . "),";
        }
        $sql = substr($sql, 0, -1);
        $conn = dbConn::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    public function calculateScore($company_id)
    {
        require_once ROOT_DIR . "model/Rate.php";
        $company = company::find($company_id);
//        dd($company);
        if (is_object($company)) {
            $rate = new Rate($company);
            dd(" درصد تکمیل " . $company->company_name . " : " . $rate->calculationScore());
        }
    }

    public function updateCategoryCompany()
    {
        include_once ROOT_DIR . "component/category/member/model/member.category.model.php";

        $categoryIds = [2524, 2525, 4970000, 4980000, 4990000];

        $companies = company::getAll()->where('category_id', 'like', '%2524%')->orWhere('category_id', 'like', '%2525%')->orWhere('category_id', 'like', '%4970000%')->orWhere('category_id', 'like', '%4980000%')->orWhere('category_id', 'like', '%4990000%')->get()['export']['list'];

        $categories = category::getAll()->where('parent_id', '=', 2524)->orWhere('parent_id', '=', 2525)->orWhere('parent_id', '=', 4970000)->orWhere('parent_id', '=', 4980000)->orWhere('parent_id', '=', 4990000)->get()['export']['list'];


        foreach ($companies as $company) {
            $categoryArray = tagToArray($company->category_id)['export']['list'];
            $parentCategoryArray = tagToArray($company->parent_category_id)['export']['list'];

            foreach ($categoryIds as $categoryId) {
                if ($index = array_search($categoryId, $categoryArray)) {
                    foreach ($categories as $category) {
                        if ($categoryArray[$index] == $category->parent_id) {
                            unset($categoryArray[$index]);
                            $parentCategoryArray[] = $category->parent_id;
                            $categoryArray[] = $category->Category_id;
                            $company->parent_category_id = arrayToTag($parentCategoryArray)['export']['list'];
                            $company->category_id = arrayToTag($categoryArray)['export']['list'];
                            $company->save();
                        }
                    }
                }
            }
        }

        dd('Finish');
    }

    public function AddCompanyId()
    {

        include_once ROOT_DIR . "component/editorMember/admin/model/admin.editorMember.model.php";
        include_once ROOT_DIR . "component/company/admin/model/admin.companyDraft.model.php";

        $result = adminEditorMemberModel::getAll()
            ->select('company_d.Company_d_id',
                     'company_d.company_id',
                     'editor_members.editor_members_id')
            ->leftJoin('company_d', 'editor_members.company_d_id', '=', 'company_d.Company_d_id')
            ->getList();


        $result = $result['export']['list'];

        foreach ($result as $key => $value) {
            $resultEditorMember = adminEditorMemberModel::find($value['editor_members_id']);
            if (is_object($resultEditorMember)) {
                $resultEditorMember->company_id = $value['company_id'];
                $resultEditorMember->save();
            }
        }


        print_r_debug('Finish');
    }

    public function editCategoryCompany(){

        ini_set('memory_limit', '3042M'); // or you could use 1G

        include_once ROOT_DIR . "component/company/admin/model/admin.company.model.php";
        include_once ROOT_DIR . "component/company/admin/model/admin.company.controller.php";

        $resultCompany = admincompanyModel::getAll()->get();
        $resultCompany = $resultCompany['export']['list'];

        foreach ($resultCompany as $company){
            $category_id = tagToArray($company->category_id)['export']['list'];
            $parentCategory_id = tagToArray($company->parent_category_id)['export']['list'];
            $mainArray = array_merge($category_id,$parentCategory_id);
            //print_r_debug($mainArray);
            $company->category()->attach($mainArray);
            //$company->category()->detach();
        }

        print_r_debug('Finish');
    }

    public function editCategoryProduct(){

        ini_set('memory_limit', '3024M'); // or you could use 1G

        include_once ROOT_DIR . "component/product/admin/model/admin.product.model.php";

        $resultProduct = adminc_productModel::getAll()->get();
        $resultProduct = $resultProduct['export']['list'];

        foreach ($resultProduct as $product){
            $category_id = tagToArray($product->category_id)['export']['list'];
            $parentCategory_id = tagToArray($product->parent_category_id)['export']['list'];
            $mainArray = array_merge($category_id,$parentCategory_id);

            //$product->category()->attach($mainArray);
            $product->category()->detach();
        }

        print_r_debug('Finish');
    }

}
