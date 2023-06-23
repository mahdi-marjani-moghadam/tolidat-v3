<?php
/**
 * Created by PhpStorm.
 * User: bahadovic
 * Date: 6/14/2022
 * Time: 11:21 AM.
 */
include_once dirname(__FILE__) . '/survey.model.php';
include_once ROOT_DIR . "component/article/model/article.model.php";
include_once ROOT_DIR . 'component/notification/admin/model/admin.notification.controller.php';

include_once ROOT_DIR . 'component/company/model/company.controller.php';

/**
 * Class surveyController.
 */
class surveyController
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

    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * add survey.
     * @param $fields
     * @author bahadovic
     * @date 6/14/2022
     *
     *
     */
    public function add($fields)
    {
        $survey = new survey();

        $validate= $survey->getBy_user_email($fields['user_email'])->where('type_id', '=',$fields['type_id'] )->getlist();

        if($validate['export']['recordsCount'] >= 1){
            $result['result'] = -1;
            $result['msg'] = 'با این ایمیل قبلا نظر داده شده است';
            return $result;
            // echo json_encode($result);
        }
        $fields['date'] = strftime('%Y-%m-%d ', time());

        $survey->setFields($fields);
        $validate = $survey->validator();

        if ($validate['result'] == -1) {
            return $validate;

            // echo json_encode($validate);
            // die();
        }
        $result = $survey->save();


        if ($result['result'] == -1) {
            $result['msg'] = 'ذخیره نشد به پشتیبانی اطلاع دهید';
            return $result;
            // echo json_encode($result);
        }

        $article = article::getBy_Article_id($fields['type_id']);
        $article->rate_number++;
        $article->rate = $article->rate + $fields['rate'];
        $article->save();

        $result = $this->sendNotification('Add survey');

        if ($_SERVER['HTTP_HOST'] == 'tolidat.ir') {
            @sendSMS(OPERATOR,'یک نظر برای کمپانی ثبت شد.');
        }
        if ($result['result'] == -1) {
            $result['msg'] = 'ذخیره شد ولی به ادمین اطلاع داده نشد';
            return $result;

            // echo json_encode($result);

        }
        $result['msg'] = 'نظر شما ذخیره شد و بعد از تایید اعمال میشود';
        // echo json_encode($result);
        return $result;

    }

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
     * rate for survey by user.
     * @param $id $rate
     * @author bahadovic
     * @date 6/14/2022
     */
    public function likeOrDislike($id,$status)
    {

        $survey= survey::find($id);

        if (!is_object($survey)) {
            $result['msg'] = 'این نظر وجود ندارد';
            return $result;
        }

        if ($status == 1){
            $survey->like++;
        }elseif ($status == -1){
            $survey->dis_like++;
        }

         $survey->save();


    }


    public function showAll($company_id)
    {

        $company = company::find($company_id);

        if (!is_object($company)) {
            redirectPage(RELA_DIR . '404');
        }
        $companyObject = new companyController();

        // get company
        $id = $company_id;

        $export['side'] = $companyObject->sidebarMenu($id);
        // get company


        

        $category = category::getAll()->keyBy('Category_id')->getList()['export']['list'];

        foreach ($export['products'] as $key => $value) {
            $category_id = tagToArray($value['category_id'])['export']['list']['1'];
            $export['products'][$key]['category_name'] = $category[$category_id]['title'];
        }

        $export['msg'] = 'در این صفحه نظرات و پیشنهادت کمپانی ' . $company->company_name . ' قابل مشاهده است';
        $export['seo'] = array(
            'title' => 'نظرات و پیشنهادات شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => empty($company->description) ? $export['msg'] : minimizeText($company->description, 500, '...'),
        );


        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $reqReferer = urldecode($_SERVER['HTTP_REFERER']);
        $reqRefererArray = explode('/', urldecode($_SERVER['HTTP_REFERER']));

        $searchIndex = array_search('search', $reqRefererArray);

        if ($searchIndex) {

            $qIndex = array_search('q', $reqRefererArray);
            if ($qIndex) {
                $breadcrumb->add('جستجو : ' . $reqRefererArray[$qIndex + 1], $reqReferer, true);
            } else {
                $breadcrumb->add('جستجو', $reqReferer, true);
            }
            $breadcrumb->add($company->fields['company_name'] . ' ', 'company/Detail/' . $company->fields['Company_id'] . '/' . $company->fields['company_name'], true);
            unset($_SESSION['companyBreadcrumb']);
            $_SESSION['companyBreadcrumb'] = serialize($breadcrumb);
            $breadcrumb->pop();
        } else {
            unset($_SESSION['companyBreadcrumb']);
            // get company categories
            $categoryResult = categoryModelDb::getCategoryByIdString($company->category_id);
            // $categories = $categoryResult['export']['list'];
            // dd($categoryResult);
            foreach ($categoryResult as $key => $value) {
                $breadcrumb->add($value['title'] . ' ', 'company/type/تولیدی/category/' . $value['Category_id'], true);
            }
        }



        // breadcrumb

        $breadcrumb->add($company->company_name, 'company/Detail/' . $company->Company_id . '/' . cleanUrl($company->company_name), true);
        $breadcrumb->add('محصولات/خدمات');
        $export['breadcrumb'] = $breadcrumb->trail();
        $this->fileName = "survey.showCompany.php";
        $this->template($export);
        die();

    }

    /**
     * call template.
     *
     * @param string $list
     * @param $msg
     *
     * @return string
     */
    public function template($list = [], $msg = '')
    {
        // global $conn, $lang;

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
}

