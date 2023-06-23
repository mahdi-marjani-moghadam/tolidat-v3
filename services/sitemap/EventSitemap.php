<?php
include_once ROOT_DIR . "component/event/models/Event.php";
include_once "Xml.php";
include_once "Html.php";

class EventSitemap
{
    public static function buildXml()
    {
        $events = Event::getAll()->get();

        $eventUrl = '';
        $xml = new Xml();
        foreach ($events['export']['list'] as $event) {
            $loc = $xml->getDomin() . "/event/" . $event->event_id;
            $xml->setLoc($loc);
            list($date, $time) = explode(" ", $event->date);
            $xml->setLastmod($date, $time);
            $eventUrl .= $xml->xmlElement();
        }

        return $eventUrl;
    }

    public static function buildHtml()
    {
        $events = Event::getAll()->get();

        $eventUrl = '';
        $html = new Html();
        foreach ($events['export']['list'] as $event) {
            $href = $html->getDomin() . "/event/" . $event->event_id;
            $html->setHref($href);
            $html->setLink($event->title);
            $eventUrl .= $html->htmlElement();
        }

        return $eventUrl;
    }
}
