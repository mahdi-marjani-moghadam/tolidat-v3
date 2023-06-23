<?php
include_once ROOT_DIR . "services/sitemap/CategorySitemap.php";
include_once ROOT_DIR . "services/sitemap/CompanySitemap.php";
include_once ROOT_DIR . "services/sitemap/EventSitemap.php";
include_once ROOT_DIR . "services/sitemap/ArticleSitemap.php";
include_once ROOT_DIR . "services/sitemap/ProductSitemap.php";

class Html
{
    protected $href = null;

    protected $link = null;

    protected $domin = "https://tolidat.ir";

    /**
     * @return string
     */
    public function getDomin()
    {
        return $this->domin;
    }


    /**
     * @return null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param null $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    public function build()
    {
//        $sitemap = ProductSitemap::buildHtml();
//        $sitemap .= EventSitemap::buildHtml();
//        $sitemap .= ArticleSitemap::buildHtml();
        $sitemap .= CategorySitemap::buildHtml();
//        $sitemap .= CompanySitemap::buildHtml();

        echo $sitemap;
        die();
    }

    public function htmlElement()
    {
        if (!is_null($this->href) & ! is_null($this->link)) {
            $url = '<a href="'. $this->href .'">' . $this->link . '</a><br>' . PHP_EOL;
        }

        return $url;
    }

    /**
     * @return null
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param null $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }
}
