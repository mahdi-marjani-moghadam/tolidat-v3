<?php

class Event extends looeic
{
    protected $TABLE_NAME = 'events';

    public function buildEventGalleryQuery($eventId)
    {
        return $this
            ->select('*', 'event_gallery.description as image_description')
            ->leftJoin('event_gallery', 'events.event_id', '=', 'event_gallery.event_id')
            ->orderBy('date')
            ->where('events.event_id', '=', $eventId);

    }

    public function findEventGalleryObject($eventId)
    {
        $eventGallery = $this->buildEventGalleryQuery($eventId)->get('');
        return $eventGallery['export']['list'];
    }

    public function findEventGalleryArray($eventId)
    {
        return $this->buildEventGalleryQuery($eventId)->getList();
    }

    public function findEventGallery($eventId)
    {
        $events = $this->findEventGalleryArray($eventId);

        if ($events['export']['recordsCount'] > 0) {

            $events = $events['export']['list'];

            foreach ($events as $key => $value) {

                $event['event_id'] = $value['event_id'];
                $event['id'] = $value['event_id'];
                $event['title'] = $value['title'];
                $event['meta_keyword'] = $value['meta_keyword'];
                $event['brief_description'] = $value['brief_description'];
                $event['meta_description'] = $value['meta_description'];
                $event['date'] = convertDate($value['date']);
                $event['event_id'] = $value['event_id'];
                $event['description'] = $value['description'];
                $event['icon'] = $value['icon'];
                $event['image_description'][] = $value['image_description'];
                $event['event_gallery_id'][] = $value['event_gallery_id'];
                $event['image'][] = $value['image'];
                $event['body'] = $value['body'];
            }

            return $event;
        }

        return $event['message'] = 'گالری برای این رویداد ثبت نشده است';
    }

    public function findEvent($eventId, $CKEditor)
    {
        $event = Event::find($eventId)->fields;
        $event['body'] = $CKEditor->editor("body", $event['body']);
        $event['date'] = convertDate($event['date']);
        $event['icon_path'] = RELATIVE_EVENT_ADDRESS . $event['icon'];

        return $event;
    }

}