<?php
include_once dirname(__FILE__) . '/laws.model.php';

class lawsController
{

    public $exportType;
    public $fileName;

    /**
     * lawController constructor.
     * @internal param $exportType
     */
    public function __construct()
    {
        $this->exportType = 'html';
    }

    public function template($list = [], $msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/title.inc.php';
                include ROOT_DIR.'templates/'.CURRENT_SKIN."/$this->fileName";
                include ROOT_DIR.'templates/'.CURRENT_SKIN.'/tail.inc.php';
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
    
    
    public function showLaws()
    {
        $laws = laws::getAll()->getList();
        $export['laws'] = $laws['export']['list'];

        // breadcrumb
        global $breadcrumb;
        $breadcrumb->reset();
        $breadcrumb->add('قوانین و مقررات');
        $export['breadcrumb'] = $breadcrumb->trail();

        $export['seo']['title'] = '  قوانین | تولیدات';


        $this->fileName = 'laws.php';
        $this->template($export);
        die();
    }
}
