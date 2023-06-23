<?php
include_once ROOT_DIR . "component/category/member/model/member.category.model.php";
include_once "Xml.php";
include_once "Html.php";

class CategorySitemap
{
    public static function buildXml()
    {
        $categories = category::getAll()->get();

        $categoryUrl = '';
        $xml = new Xml();
        foreach ($categories['export']['list'] as $category) {
            $loc = $xml->getDomin() . "/company/c/" . $category->url;
            $xml->setLoc($loc);
            $categoryUrl .= $xml->xmlElement();
        }

        return $categoryUrl;
    }

    public static function buildHtml()
    {
        $categories = category::getAll()->get();

        $categoryUrl = '';
        $html = new Html();
        foreach ($categories['export']['list'] as $category) {
            $href = $html->getDomin() . "/company/c/" . $category->url;
            $html->setHref($href);
            $html->setLink($category->title);
            $categoryUrl .= $html->htmlElement();
        }

        return $categoryUrl;
    }
}
