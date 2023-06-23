<?php
include_once ROOT_DIR . "services/sitemap/CategorySitemap.php";
include_once ROOT_DIR . "services/sitemap/CompanySitemap.php";
include_once ROOT_DIR . "services/sitemap/EventSitemap.php";
include_once ROOT_DIR . "services/sitemap/ArticleSitemap.php";
include_once ROOT_DIR . "services/sitemap/ProductSitemap.php";
include_once ROOT_DIR . "services/sitemap/HomeSitemap.php";

class Xml
{
    protected $header = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;
    protected $footer = '</urlset>';
    protected $loc = null;
    protected $lastmod = null;
    protected $changefreq = 'weekly';
    protected $priority = '0.80';
    protected $domin = '';

    public function build()
    {
        $sitemap = HomeSitemap::buildXml();
        // $sitemap .= ProductSitemap::buildXml();
        // $sitemap .= EventSitemap::buildXml();
        $sitemap .= ArticleSitemap::buildXml();
        $sitemap .= CategorySitemap::buildXml();
        // $sitemap .= CompanySitemap::buildXml();

        header("Content-Type: application/xml; charset=utf-8");

        echo $this->getHeader();
        echo $sitemap;
        echo $this->getFooter();
        
        die();
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return string
     */
    public function getFooter()
    {
        return $this->footer;
    }

    public function xmlElement()
    {
        $url = '<url>' . PHP_EOL;

        if (!is_null($this->loc)) {
            $url .= '<loc>' . $this->loc . '</loc>' . PHP_EOL;
        }
        /*if (!is_null($this->lastmod)) {
            $url .= '<lastmod>' . $this->lastmod . '</lastmod>' . PHP_EOL;
        }*/
        $url .= '<changefreq>' . $this->changefreq . '</changefreq>' . PHP_EOL;
        $url .= '<priority>' . $this->priority . '</priority>' . PHP_EOL;
        $url .= '</url>' . PHP_EOL;

        return $url;
    }

    /**
     * @return string
     */
    public function getDomin()
    {
        $this->domin = trim(RELA_DIR, '/');
        return $this->domin;
    }

    /**
     * @return null
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @param null $loc
     */
    public function setLoc($loc)
    {
        $this->loc = htmlspecialchars($loc);
    }

    /**
     * @return null
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param null $lastmod
     */
    public function setLastmod($date, $time)
    {
        $this->lastmod = $date . 'T' . $time . '+00:00';
    }

    /**
     * @return null
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * @param null $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    /**
     * @return null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param null $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}
