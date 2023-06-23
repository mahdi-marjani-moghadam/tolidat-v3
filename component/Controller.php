<?php


abstract class Controller
{
    protected $fileName;
    protected $exportType = 'html';

    protected function template($list = [],$msg = '')
    {
        extract($list);
        switch ($this->exportType) {
            case 'html':
                if (CURRENT_SKIN == 'template_fa') {
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/" . "$this->fileName.php";
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
                } elseif (CURRENT_SKIN == 'admin') {
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_start.php";
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_header.php";
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_rightMenu_admin.php";
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/$this->fileName.php";
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_footer.php";
                    include ROOT_DIR . "templates/" . CURRENT_SKIN . "/template_end.php";
                } else {
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/" . "$this->fileName.php";
                    include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/tail.inc.php';
                }

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
        die();
    }

}
