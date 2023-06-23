<?php
include_once ROOT_DIR . "component/article/model/article.model.php";
include_once "Xml.php";
include_once "Html.php";

class ArticleSitemap
{
    public static function buildXml()
    {
        $articles = article::getAll()->get();

        $articleUrl = '';
        $xml = new Xml();
        foreach ($articles['export']['list'] as $article) {
            $loc = $xml->getDomin() . "/article/" . $article->Article_id . '/' . urlencode($article->title);
            $xml->setLoc($loc);
            list($date, $time) = explode(" ", $article->date);
            $xml->setLastmod($date, $time);
            $articleUrl .= $xml->xmlElement();
        }

        return $articleUrl;
    }

    public static function buildHtml()
    {
        $articles = article::getAll()->get();

        $articleUrl = '';
        $html = new Html();
        foreach ($articles['export']['list'] as $article) {
            $href = $html->getDomin() . "/article/" . $article->Article_id;
            $html->setHref($href);
            $html->setLink($article->title);
            $articleUrl .= $html->htmlElement();
        }

        return $articleUrl;
    }
}
