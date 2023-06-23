<?php

require_once ROOT_DIR . "component/event/models/Event.php";
require_once ROOT_DIR . "component/Controller.php";
require_once ROOT_DIR . "services/uploader/Uploader.php";

class EventController extends Controller
{
    private $event;
    private $eventGallery;
    private $eventService;

    public function __construct(Event $event, EventGallery $eventGallery, EventService $eventService)
    {
        $this->event = $event;
        $this->eventGallery = $eventGallery;
        $this->eventService = $eventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $fileName
     */
    public function index($fileName = 'eventIndex')
    {
        $event = $this->event->getAll()->orderBy('date', 'DESC')->getList();
        $events = $event['export']['list'];
        foreach ($events as $key => $value) {
            $events[$key]['icon'] = RELATIVE_EVENT_ADDRESS . $value['icon'];
            $events[$key]['date'] = convertDate($value['date']);
        }

        $this->fileName = $fileName;
        $this->template(compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $eventId
     * @param string $fileName
     */
    public function show($eventId, $fileName = 'eventShow')
    {
        $event = $this->event->findEventGalleryArray($eventId);
        $event = $this->eventService->reFormat($event);
        $this->fileName = $fileName;
        $this->template(compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $fileName
     *
     */
    public function create($fileName = 'create')
    {
        $CKEditor = CKEditor();
        $event['body'] = $CKEditor->editor("body");
        $this->fileName = $fileName;
        $this->template(compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     */
    public function store($request)
    {
        $result = $this->eventService->UploadEventIcon($request['event']['icon']);

        if ($result['result'] == -1) {
            $event = $request['event'];
            $CKEditor = CKEditor();
            $event['body'] = $CKEditor->editor("body", $event['body']);
            $event['date'] = convertDate($event['date']);
            $this->fileName = 'admin.event.addForm';
            $message[] = $result['msg']['error'] . "<br>" . 'بارگذاری کردن فایل ها با مشکل مواجه شد. حجم عکس حداکثر 2MB و فرمت JPEG, JPG, PNG می تواند باشد. ';
            $this->template(compact('event', 'message'));
        }

        $this->event->setFields($request['event']);
        $this->event->icon = $result['image'];

        $result = $this->event->save();

        if ($result['result'] == -1) {
            $message[] = 'اضافه کردن با مشکل مواجه شد لطفا دوباره تلاش فرمایید';
            $this->fileName = 'admin.event.addForm';
            $this->template(compact('request', 'message'));
        }

        $result = $this->eventService->storeImages($request['gallery'], $this->event->event_id);

        if ($result['result'] == -1) {
            $message[] = $result['msg']['error'] . '<br>' . $result['image_name'];
            $event = $request['event'];
            $CKEditor = CKEditor();
            $event['body'] = $CKEditor->editor("body", $event['body']);
            $event['date'] = convertDate($event['date']);
            $this->fileName = 'admin.event.addForm';
            $this->template(compact('event', 'message'));
        }

        $message = '<h2>' . 'با موفقیت ذخیره شد' . '</h2>';

        redirectPage(RELA_DIR . 'admin/?component=event', $message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $eventId
     * @param string $fileName
     */
    public function edit($eventId, $fileName = 'editEvent')
    {
        $CKEditor = CKEditor();

        $event = Event::find($eventId);

        if (!is_object($event)) {
            redirectPage(RELA_DIR . "admin?component=event", "رویداد موجود نیست");
        }

        $eventGallery = $this->eventService->getEventGallery($event->event_id);

        $event = $event->fields;
        $event['gallery'] = $eventGallery['export']['list'];
        $event['gallery'] = $eventGallery['export']['list'];
        $event['body'] = $CKEditor->editor("body", $event['body']);


        /*$event = $this->event->findEventGallery($eventId);

        if ($event['image'][0] != null) {
            $event['body'] = $CKEditor->editor("body", $event['body']);
            $event['icon_path'] = RELATIVE_EVENT_ADDRESS . $event['icon'];

            foreach ($event['image'] as $key => $image) {
                $event['image_path'][$key] = RELATIVE_EVENT_ADDRESS . $event['id'] . DS . $image;
            }
        } else {
            $event = $this->event->findEvent($eventId, $CKEditor);
        }*/

        $this->fileName = $fileName;
        $this->template(compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $request
     */
    public function update($request)
    {
        if (isset($request['gallery'])) {
            $result = $this->eventService->updateEventGallery($request);
        }

        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . 'admin/?component=event&action=edit&id=' . $request['event']['id'], $result['message']);
        }

        // $result = $this->eventService->updateEvent($request['event']);

        $event = Event::find($request['event']['id']);

        if (is_object($event)) {
            if (!empty($request['event']['icon'])) {
                $uploadImage = $this->eventService->UploadEventIcon($request['event']['icon']);
                if ($uploadImage['result'] == -1) {
                    $message[] = $result['msg']['error'] . "<br>" . 'بارگذاری کردن فایل ها با مشکل مواجه شد. حجم عکس حداکثر 2MB و فرمت JPEG, JPG, PNG می تواند باشد. ';
                    redirectPage(RELA_DIR . 'admin/?component=event&action=edit&id=' . $request['event']['id'], $result['message']);
                }

                unlink(EVENT_ADDRESS . $event->fields['icon']);
                unlink(EVENT_ADDRESS . "90.90." . $event->fields['icon']);


                $event->setFields($request['event']);
                $event->icon = $uploadImage['image'];

                $result = $event->save();
                $result['result'] = 1;
            } else {
                $request['event']['icon'] = $event->icon;
                $event->setFields($request['event']);
                $result = $event->save();
                $result['result'] = 1;
            }

        } else {
            $result['result'] = -1;
            $result['message'] = 'رویداد مورد نظر یافت نشد';
            redirectPage(RELA_DIR . 'admin/?component=event&action=edit&id=' . $request['event']['id'], $result['message']);
        }

        redirectPage(RELA_DIR . 'admin/?component=event', 'با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $eventId
     */
    public function destroy($eventId)
    {
        $eventGalleries = $this->event->findEventGalleryObject($eventId);

        if (is_array($eventGalleries)) {
            foreach ($eventGalleries as $gallery) {
                $link = EVENT_ADDRESS . $gallery->fields['event_id'];
                $result = unlink($link . DS . $gallery->fields['image']);
                rmdir($link);
            }
        }

        $event = Event::find($eventId);

        if (!is_object($event)) {
            redirectPage(RELA_DIR . 'admin/?component=event', 'رویدادی با این مشخصات یافت نشد.');
        }
        $input['component'] = 'event';
        $input['image'] = $event->icon;

        $result = $event->delete();
        removeFiles($input);
        if ($result['result'] == -1) {
            redirectPage(RELA_DIR . 'admin/?component=event', 'قابل حذف نیست با ادمین سایت تماس بگیرید.');
        }

        redirectPage(RELA_DIR . 'admin/?component=event', 'با موفقیت حذف شد');

        /*if ($result) {
            $event = Event::find($eventId);

            if (!is_object($event)) {
                redirectPage(RELA_DIR . 'admin/?component=event', 'رویدادی با این مشخصات یافت نشد.');
            }

            $result = $event->delete();

            if ($result['result'] == -1) {
                redirectPage(RELA_DIR . 'admin/?component=event', 'قابل حذف نیست با ادمین سایت تماس بگیرید.');
            }

            redirectPage(RELA_DIR . 'admin/?component=event', 'با موفقیت حذف شد');
        }

        redirectPage(RELA_DIR . 'admin/?component=event', 'عکس های بارگذاری شده قابل حذف نیستند');*/


    }

    public function reSizeIcon($image = '')
    {
        $file = EVENT_ADDRESS . $image;
        $destination = EVENT_ADDRESS . DS;
        $sizes = [
            'image1' => [
                'width' => 90,
                'height' => 90
            ],
        ];

        $compress = new Compress();
        return $compress->resize($file, $destination, $sizes);

    }

    public function api_getRow($id)
    {
        $result = $this->eventService->service_getRow($id);

        Response::json($result, 'get', 200);
    }

    public function api_getAll($input)
    {
        $result = $this->eventService->service_get($input);
        Response::json($result, 'get');
    }

}

?>
