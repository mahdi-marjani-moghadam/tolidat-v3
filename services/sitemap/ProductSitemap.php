<?php
include_once ROOT_DIR . "component/product/model/product.model.php";
include_once "Xml.php";
include_once "Html.php";

class ProductSitemap
{
    public static function buildXml()
    {
        $products = Product::getAll()->get();

        $productUrl = '';
        $xml = new Xml();
        foreach ($products['export']['list'] as $product) {
            $loc = $xml->getDomin() . "/product/show/" . $product->Product_id . "/" . cleanUrl($product->title);
            $xml->setLoc($loc);
            list($date, $time) = explode(" ", $product->date);
            $xml->setLastmod($date, $time);
            $productUrl .= $xml->xmlElement();
        }

        return $productUrl;
    }

    public static function buildHtml()
    {
        $products = Product::getAll()->get();

        $productUrl = '';
        $html = new Html();
        foreach ($products['export']['list'] as $product) {
            $href = $html->getDomin() . "/product/show/" . $product->Product_id . "/" . cleanUrl($product->title);
            $html->setHref($href);
            $html->setLink($product->title);
            $productUrl .= $html->htmlElement();
        }

        return $productUrl;
    }
}
