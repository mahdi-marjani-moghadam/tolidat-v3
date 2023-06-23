<?php

/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 PM.
 */
include_once dirname(__FILE__) . '/News.php';
include_once ROOT_DIR . 'component/news/admin/model/News.php';
/**
 * Class newsController.
 */
class newsController
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
     * newsController constructor.
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    /**
     * call tempate.
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
                $list['msg'] = $msg;
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
     * show all news.
     *
     * @param $_input
     *
     * @author malekloo,marjani
     * @date 2/24/2015
     *
     * @version 01.01.01
     */
    public function showMore($_input)
    {

        if (!is_numeric($_input)) {
            $msg = 'یافت نشد';
            $this->fileName = 'news.showList.php';
            $this->template('', $msg);
            die();
        }

        $news = new newsModel();
        $result = $news->getNewsById($_input);

        if ($result['result'] != 1) {
            $this->fileName = 'news.showList.php';
            $this->template('', $result['msg']);
            die();
        }

        $export['list'] = $news->fields;

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('رویداد', 'news', true);
        $breadcrumb->add($news->fields['title']);
        $export['breadcrumb'] = $breadcrumb->trail();

        $this->fileName = 'news.showMore.php';
        $this->template($export);
        die();
    }

    /**
     * @param $fields
     *
     * @author malekloo,marjani
     * @date 2/24/2015
     *
     * @version 01.01.01
     */
    public function showAllNews($company_id)
    {
        $news = News::getAll()
            ->where('company_id', '=', $company_id)
            ->getList();
        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('اخبار');
        $export['breadcrumb'] = $breadcrumb->trail();

        $company = company::find($company_id);
        $news['seo'] = array(
            'title' => 'اخبار شرکت ' . $company->company_name . '-تولیدات',
            'meta_keyword' => 'تولیدات',
            'description' => 'تولیدات',
        );

        // dd(1);
        $this->fileName = "news.showAll.php";
        $this->template($news);
        die();
    }

    /**
     * @param $fields
     *
     * @author malekloo,marjani
     * @date 2/24/2015
     *
     * @version 01.01.01
     */
    public function showAllRss()
    {
        $export['list'] = $this->rssRead();

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('رویداد');
        $export['breadcrumb'] = $breadcrumb->trail();

        $export['seo']['title'] = '  اخبار | تولیدات';


        $this->fileName = 'news.showListRss.php';
        $this->template($export);
        die();
    }

    /**
     * @param $_input
     */
    public function rssRead()
    {
       

        // $xml = ('http://mehrnews.com/rss/tp/25');
        $xml = ('https://www.mehrnews.com/rss/tp/25');
        $xmlDoc = new DOMDocument();
        if (is_object($xmlDoc)) {
            $xmlDoc->load($xml);
            $channel = $xmlDoc->getElementsByTagName('channel')->item(0);
            // dd($channel);
            //            $channel = '';
            if (is_object($channel)) {
                $items = $channel->getElementsByTagName('item');
                $fields = array();
                foreach ($items as $key => $value) {
                    $fields[$key]['title'] = $value->getElementsByTagName('title')->item(0)->nodeValue;
                    $fields[$key]['description'] = $value->getElementsByTagName('description')->item(0)->nodeValue;
                    $url_obj = $value->getElementsByTagName('enclosure')->item(0);
                    $attributes = $url_obj->attributes;
                    //            $fields[$key]['image'] =$attributes->item(0)->nodeValue;
                    $fields[$key]['image'] = $value->getElementsByTagName('enclosure')->item(0)->attributes['url']->value;
                    $fields[$key]['link'] = $value->getElementsByTagName('guid')->item(0)->nodeValue;
                }
            } else {
                $fields['title'] = 'no event';
            }
        } else {
            $fields['title'] = 'no event';
        }
        return $fields;
    }
    public function service_getRow($id)
    {

        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/news/' . $list['image'];
        });

        return News::getBy_News_id($id)->appendRelation($append)->getList();
    }
    public function api_getRow($id)
    {
        $result = $this->service_getRow($id);
        Response::json($result, 'get');
    }
    public function service_get($input)
    {
        $size = $input['size'];
        $append['imageUrl'] = array('formatter' => function ($list) {
            $st = STATIC_RELA_DIR . '/images/news/' . $list['image'];
            return $st;
        });

        return News::getAll()->paginate($size)
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
        Response::json($result, 'get', 200);
    }
}
