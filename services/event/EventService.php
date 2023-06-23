<?php

require_once ROOT_DIR . "component/event/models/Event.php";
require_once ROOT_DIR . "component/event/models/EventGallery.php";
require_once ROOT_DIR . "services/uploader/Compress.php";

class EventService
{
    private $event;
    private $eventGallery;

    public function __construct()
    {
        $this->eventGallery = new EventGallery;
        $this->event = new Event;
    }

    public function deleteImagesFromGallery($gallery)
    {
        unlink(EVENT_ADDRESS . $gallery->event_id . DS . $gallery->image);
        unlink(EVENT_ADDRESS . $gallery->event_id . DS . "650.366." . $gallery->image);
        unlink(EVENT_ADDRESS . $gallery->event_id . DS . "217.145." . $gallery->image);
        unlink(EVENT_ADDRESS . $gallery->event_id . DS . "1300.732." . $gallery->image);

//        foreach ($imagesId as $mustDelete) {
//            $image = EventGallery::find($mustDelete);
//
//            if (is_object($image)) {
//                unlink(EVENT_ADDRESS . $image->fields['event_id'] . DS . $image->fields['image']);
//                unlink(EVENT_ADDRESS . $image->fields['event_id'] . DS . "650.366." . $image->fields['image']);
//                unlink(EVENT_ADDRESS . $image->fields['event_id'] . DS . "217.145." . $image->fields['image']);
//                unlink(EVENT_ADDRESS . $image->fields['event_id'] . DS . "1300.732." . $image->fields['image']);
//                $image->delete();
//                $result['result'] = 1;
//
//            } else {
//                $result['result'] = -1;
//            }
//        }
//
//        return $result;
    }

    public function updateEventGallery($request)
    {
        foreach ($request['gallery'] as $key => $value) {

            $gallery = EventGallery::getAll()
                ->where('event_gallery_id', '=', $key)
                ->where('event_id', '=', $request['event']['id'])
                ->first();

            if (!is_object($gallery)) {
                $result = $this->addEventGallery($value, $request['event']['id']);
                if ($result['result'] == -1) {
                    $result['message'] = "گالری اضافه نشد";
                }
            } elseif (isset($value['delete'])) {
                $this->deleteImagesFromGallery($gallery);
                $result = $gallery->delete();
            } else {
                if (!empty($value['image'])) {
                    $this->deleteImagesFromGallery($gallery);
                    $result = $this->uploadGalleryImage($value['image'], EVENT_ADDRESS . $gallery->event_id . DS);
                    $gallery->image = $result['image'];
                }

                $gallery->description = $value['description'];
                $gallery->save();
            }
        }

        return $result;

//        $this->deleteImagesFromGallery($request['delete']);
//
//        $result = $this->storeImages($request['gallery'], $request['event']['id']);
//
//        if ($result['result'] == 1) {
//            $result['message'] = 'Deleted and Inserted Successfully';
//            return $result;
//        }
//
//        $result['message'] = 'Couldnt Delete or Insert Some Files';
//        return $result;
    }

    public function addEventGallery($value, $event_id)
    {
        $this->eventGallery = new EventGallery;

        $result = $this->uploadGalleryImage($value['image'], EVENT_ADDRESS . $event_id . DS);

        if ($result['result'] != -1) {
            $this->eventGallery->event_id = $event_id;
            $this->eventGallery->image = $result['image'];
            $this->eventGallery->description = $value['description'];
            $result = $this->eventGallery->save();
        }

        return $result;
    }

    public function updateEvent($request)
    {
        $event = Event::find($request['id']);

        if (is_object($event)) {

            if (is_array($request['icon'])) {
                unlink(EVENT_ADDRESS . $event->fields['icon']);
                $uploadImage = $this->UploadEventIcon($request['icon']);
                $event->setFields($request);
                $event->icon = $uploadImage['image_name'];

                $result = $event->save();
                $result['result'] = 1;
            } else {
                $event->setFields($request);
                $result = $event->save();
                $result['result'] = 1;
            }

        } else {
            $result['result'] = -1;
            $result['message'] = 'رویداد مورد نظر یافت نشد';
        }

        return $result;
    }

    public function getGalleryArray()
    {
        $gallery = EventGallery::getAll()->getList();

        return $gallery['export']['list'];
    }

    public function manageRequest($post, $get)
    {
        foreach ($post as $key => $value) {
            if (is_numeric(strpos($key, 'gallery'))) {
                $cnt = substr($key, 7) ? substr($key, 7) : 0;
                $post['gallery'][$cnt]['image'] = $value;
                $post['gallery'][$cnt]['description'] = $post['description' . $cnt];
                !$post['delete' . $cnt] ?: $post['gallery'][$cnt]['delete'] = $post['delete' . $cnt];
                unset($post[$key], $post['description' . $cnt], $post['delete' . $cnt]);
            }
        }

        $post['event']['id'] = $get['id'];
        $post['event']['icon'] = $post['eventImage'];
        $post['event']['title'] = $post['title'];
        $post['event']['brief_description'] = $post['brief_description'];
        $post['event']['meta_description'] = $post['meta_description'];
        $post['event']['meta_keyword'] = $post['meta_keyword'];
        $post['event']['date'] = convertJToGDate($post['date']);
        $post['event']['body'] = $post['body'];

        unset(
            $post['id'],
            $post['title'],
            $post['brief_description'],
            $post['meta_description'],
            $post['meta_keyword'],
            $post['date'],
            $post['icon'],
            $post['body']
        );

        return $post;
    }

    protected function changeFormat($input)
    {
        $rows = count($input);
        $columns = count($input['name']);

        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $columns; $j++) {
                $output[$j]['name'] = $input['name'][$j];
                $output[$j]['type'] = $input['type'][$j];
                $output[$j]['tmp_name'] = $input['tmp_name'][$j];
                $output[$j]['error'] = $input['error'][$j];
                $output[$j]['size'] = $input['size'][$j];
                $output[$j]['description'] = $input['description'][$j];
            }
        }

        return $output;
    }

    public function storeImages($files, $eventId)
    {
        foreach ($files as $key => $value) {

            $this->eventGallery = new EventGallery;

            $result = $this->uploadGalleryImage($value['image'], EVENT_ADDRESS . $eventId . DS);
            if ($result['result'] != -1) {
                $this->eventGallery->event_id = $eventId;
                $this->eventGallery->image = $result['image'];
                $this->eventGallery->description = $value['description'];
                $result = $this->eventGallery->save();

                if ($result['result'] != -1) {
                    $result['message'] = 'با موفقیت ذخیره شد';
                    $result['result'] = 1;
                } else {
                    $result['message'] = 'ذخیره نشد، با ادمین سایت تماس بگیرید';
                    $result['result'] = -1;
                }

            } else {
                $result['message'] = 'فایل ها قابل بارگذاری روی سرور نیستند، با ادمین سایت تماس بگیرید';
                $result['result'] = -1;
            }

        }

        return $result;

    }

    public function UploadEventIcon($image)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'folder_name' => 'event'
            ];

            $sizes = [
                'image1' => ['width' => 90, 'height' => 90],
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
    }

    public function UploadGalleryImage($image, $destination)
    {
        if (!empty($image)) {
            $property = [
                'image' => $image,
                'destination' => $destination
            ];

            $sizes = [
                'image1' => [
                    'width' => 650,
                    'height' => 366
                ],
                'image2' => [
                    'width' => 217,
                    'height' => 145
                ],
                'image3' => [
                    'width' => 1300,
                    'height' => 732
                ]
            ];

            $uploader = new Uploader();
            return $uploader->cropAndCompressImage($property, $sizes);
        }
    }

    public function reFormat($eventsGallery)
    {
        if ($eventsGallery['export']['recordsCount'] > 0) {

            $events = $eventsGallery['export']['list'];

            foreach ($events as $key => $value) {

                $event['event_id'] = $value['event_id'];
                $event['id'] = $value['event_id'];
                $event['title'] = $value['title'];
                $event['meta_keyword'] = explode('،', $value['meta_keyword']);
                $event['brief_description'] = $value['brief_description'];
                $event['meta_description'] = $value['meta_description'];
                $event['date'] = convertDate($value['date']);
                $event['event_id'] = $value['event_id'];
                $event['description'] = $value['description'];
                $event['icon'] = RELATIVE_EVENT_ADDRESS . $value['event_id'] . DS . $value['icon'];
                $event['body'] = $value['body'];
                $event['gallery'][$key]['image_description'] = $value['image_description'];
                $event['gallery'][$key]['event_gallery_id'] = $value['event_gallery_id'];
                $event['gallery'][$key]['image'] = $value['image'];
                $event['gallery'][$key]['image_path'] = RELATIVE_EVENT_ADDRESS . $event['event_id'] . "/" . "217.145." . $value['image'];
                $event['gallery'][$key]['image_path_crop'] = RELATIVE_EVENT_ADDRESS . $event['event_id'] . "/" . "650.366." . $value['image'];
            }

            return $event;
        }
    }

    public function reSizeGallery($eventId, $image = '')
    {
        $file = EVENT_ADDRESS . $eventId . "/" . $image;
        $destination = EVENT_ADDRESS . $eventId . "/";
        $sizes = [
            'image1' => [
                'width' => 650,
                'height' => 366
            ],
            'image2' => [
                'width' => 217,
                'height' => 145
            ],
            'image3' => [
                'width' => 1300,
                'height' => 732
            ]
        ];

        $compress = new Compress();
        return $compress->resize($file, $destination, $sizes);

    }


    public function service_getRow($id)
    {

        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/event/' . $list['icon'];
        });

        $append['body'] = array('formatter' => function ($list) {
            return clearHtml($list['body']);
        });

        $append['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });

        $appendGallery['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/event/' . $list['event_id'] . '/' . $list['image'];
        });

        $gallery = EventGallery::getBy_event_id($id)->appendRelation($appendGallery)->getList();


        $event = event::getBy_event_id($id)->appendRelation($append)->getList();

        if ($event['recordsCount'] != 0) {
            $event['data']['0']['gallery'] = $gallery;
        }

        return $event;

    }


    public function service_get($input)
    {

        $size = $input['size'];

        $append['imageUrl'] = array('formatter' => function ($list) {
            return STATIC_RELA_DIR . '/images/event/' . $list['icon'];
        });

        $append['body'] = array('formatter' => function ($list) {
            return clearHtml($list['body']);
        });
        $append['date'] = array('formatter' => function ($list) {
            return convertDate($list['date']);
        });


        $append['gallery'] = array('formatter' => function ($list) {
            $appendGallery['imageUrl'] = array('formatter' => function ($list) {
                return STATIC_RELA_DIR . '/images/event/' . $list['event_id'] . '/' . $list['image'];
            });
            return EventGallery::getBy_event_id($list['event_id'])->appendRelation($appendGallery)->getList();
        });


        return event::getAll()->paginate($size)
            ->appendRelation($append)
            ->getList();


    }

    public function getEventGallery($event_id)
    {
        return EventGallery::getAll()
            ->where('event_id', '=', $event_id)
            ->getList();
    }


}
