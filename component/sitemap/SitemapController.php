<?php
include_once ROOT_DIR . "services/sitemap/Xml.php";
include_once ROOT_DIR . "services/sitemap/Html.php";

class SitemapController
{
    protected $filename;

    public $exportType = "html";

    public function template($list = [],$msg = '')
    {
        switch ($this->exportType) {
            case 'html':
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . '/title.inc.php';
                include ROOT_DIR . 'templates/' . CURRENT_SKIN . "/$this->filename";
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

    public function show()
    {
        $this->filename = "sitemap.php";
        $this->template();
        die();
    }

    public function save($type)
    {
        
        if ($type == "xml") {
            $xml = new Xml();
            $xml->build();
        }

        if ($type == "html") {
            $html = new Html();
            $html->build();
        }
    }

    public function create($type)
    {
        ini_set('memory_limit', '512M');
        
        if ($type == "xml") {
            if (file_exists(ROOT_DIR . 'sitemap.xml')) {
                unlink(ROOT_DIR . 'sitemap.xml');
            }
            
            $handle = fopen(ROOT_DIR . 'sitemap.xml', 'w');
            
        }

        if ($type == "html") {
            if (file_exists(ROOT_DIR . 'templates/' . CURRENT_SKIN . '/sitemap.php')) {
                unlink(ROOT_DIR . 'templates/' . CURRENT_SKIN . '/sitemap.php');
            }

            $handle = fopen(ROOT_DIR . 'templates/' . CURRENT_SKIN . '/sitemap.php', 'w');
        }

        fwrite($handle, file_get_contents(RELA_DIR . "sitemap/save/" . $type));
        fclose($handle);
        redirectPage(RELA_DIR . "admin", "فایل آپدیت شد");
    }
}
