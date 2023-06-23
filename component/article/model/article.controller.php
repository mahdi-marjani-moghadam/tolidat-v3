<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once dirname(__FILE__) . '/article.model.php';
require_once ROOT_DIR . "component/Controller.php";
include_once ROOT_DIR . "component/survey/model/survey.model.php";


/**
 * Class articleController.
 */
class articleController extends Controller
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

    /**
     * articleController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
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

    /**
     * show all article.
     *
     * @param $_input
     *
     * @author marjani
     * @date 2/28/2016
     *
     * @version 01.01.01
     */
    public function showMore($_input)
    {
        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->fileName = 'article.showList.php';
            $this->template('', $msg);
            die();
        }
        $article = new articleModel();
        $result = $article->getArticleById($_input);

        if ($result['result'] != 1) {
            $this->fileName = 'article.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        global $PARAM;
        if (!isset($PARAM[2])) {
            redirectPage(RELA_DIR . "article/" . $article->fields['Article_id'] . "/" . urlencode($article->fields['title']), 'Url fixed');
        }


        $export['list'] = $article->fields;
        //for rating



        $export['list']['rate'] = number_format($export['list']['rate'] / $export['list']['rate_number'], 1, '.', '');
        unset($export['list']['rate_number']);

        // breadcrumb
        global $breadcrumb, $PARAM;

        $breadcrumb->reset();
        $breadcrumb->add('مقالات', 'article', true);
        $breadcrumb->add($article->fields['title']);
        $export['breadcrumb'] = $breadcrumb->trail();

        $export['seo']['title'] = $article->fields['title'] . '   | تولیدات';
        $export['seo']['description'] = $article->fields['meta_description'] . '   | تولیدات';


        // related article
        $resultArticles = article::getBy_category_id($export['list']['category_id'])->orderBy('date', 'DESC')->limit(8)->getList();

        foreach ($resultArticles['export']['list'] as $val => $atr) {
            if ($atr['Article_id'] == $_input) {
                unset($resultArticles['export']['list'][$val]);
            }
        }

        if ($resultArticles['export']['list'] == null) {

            $export['articles_list'] = "مقاله ای یافت نشد";
        } else {
            $export['articles_list'] = $resultArticles['export']['list'];
        }





        // related company
        $rel_com_cat = category_company::getBy_category_id($export['list']['category_id'])->select('company_id')->limit(8)->getList();
        if ($rel_com_cat['export']['recordsCount']) {

            function array_value_recursive($key, array $arr)
            {
                $val = array();
                array_walk_recursive($arr, function ($v, $k) use ($key, &$val) {
                    if ($k == $key) array_push($val, $v);
                });
                return count($val) > 1 ? $val : array_pop($val);
            }
            $company_ids = implode(',', array_value_recursive('company_id', $rel_com_cat['export']['list']));
        }
        $resultCompany = company::getBy_Company_id($company_ids)->limit(8)->getList();
        if ($resultCompany['export']['list'] == null) {

            $export['companies_list'] = "کمپانی یافت نشد";
        } else {
            $export['companies_list'] = $resultCompany['export']['list'];
        }


        // dd($export['companies_list']);



        // type for article


        $comment = survey::getBy_type_id($_input)->where('status', '=', 1)->where('type', '=', 'article')->orderBy('survey_id', 'DESC')->getlist();
        if ($comment['export']['recordsCount'] == 0) {

            $export['comment_list'] = "نظری یافت نشد";
        } else {

            $export['comment_list'] = $comment['export']['list'];
        }

        $this->fileName = 'article.showMore.php';
        //        echo json_encode($export);
        //        die();
        $this->template($export);
        die();
    }

    /**
     * get all article and  show in list.
     *
     * @param $fields
     *
     * @author marjani
     * @date 2/28/2016
     *
     * @version 01.01.01
     */
    public function showALL($fields)
    {
        $article = new articleModel();
        $fields['where'] = "where title  <> '' ";
        // dd($fields);
        $result = $article->getArticle($fields);
        if ($result['result'] != '1') {
            die();
        }
        $export['list'] = $article->list;
        $export['recordsCount'] = $article->recordsCount;
        $export['pagination'] = $article->pagination;



        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('مقالات');
        $export['breadcrumb'] = $breadcrumb->trail();

        $export['seo']['title'] = '  مقالات | تولیدات';

        $this->fileName = 'article.showList.php';
        $this->template($export);
        die();
    }

    public function service_getRow($id)
    {

        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/article/' . $list['image'];
        });
        $append['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });
        $append['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });

        return article::getBy_Article_id($id)->appendRelation($append)->getList();
    }
    public function api_getRow($id)
    {
        $result = $this->service_getRow($id);
        Response::json($result, 'get', 200);
    }

    public function service_get($input)
    {

        $size = $input['size'];
        /* $append['art'] = array('formatter' => function ($list) {
            $st =   article::getBy_Article_id($list['Article_id'])->getList()['data'];
            return $st;
        });*/
        $append['imageUrl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/article/' . $list['image'];
            return $st;
        });

        $append['description'] = array('formatter' => function ($list) {
            return clearHtml($list['description']);
        });
        $append['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });
        /*$append['description'] = array('formatter' => function ($list)
        {

            $text = preg_replace( '/[\x{200B}-\x{200D}]/u', '',$list['description'] );
            return trim(preg_replace('/\s+/', ' ', $text));
        });*/


        return article::getAll()->paginate($size)
            ->appendRelation($append)
            ->getList();

        /*$internal['base_url'] = ROOT_DIR;
        $append['url'] = array('formatter' => function ($row,$internal) {
            $st = $internal['base_url'].$row['id'];
            return $st;
        });

        /*$append['name-family'] = array('formatter' => function ($list) {
            $st = $list['title'].'-'.$list['id'];
            return $st;
        });*/
    }
    public function api_getAll($input)
    {
        $result = $this->service_get($input);
        Response::json($result, 'get');
    }
}
