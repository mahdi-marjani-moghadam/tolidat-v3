<?php
include_once "Xml.php";
include_once "Html.php";

class HomeSitemap
{
    public static function buildXml()
    {
        $xml = new Xml();
        $xml->setLoc($xml->getDomin());
        $xml->setPriority('0.90');
        $homeUrl = $xml->xmlElement();

        return $homeUrl;
    }

    public static function buildHtml()
    {
        $html = new Html();
        $html->setHref($html->getDomin());
        $html->setLink('خانه');
        $homeUrl = $html->htmlElement();

        return $homeUrl;
    }
}
