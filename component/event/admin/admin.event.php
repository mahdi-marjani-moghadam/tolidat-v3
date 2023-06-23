<?php

require_once __DIR__ . "/../models/Event.php";
require_once __DIR__ . "/../models/EventGallery.php";
require_once __DIR__ . "/../controllers/EventController.php";
require_once ROOT_DIR . "services/event/EventService.php";

$eventController = new EventController(new Event, new EventGallery, new EventService);
//dd($_POST);
$eventService = new EventService;
$post = $eventService->manageRequest($_POST, $_GET);
switch($_GET['action']) {

    case 'create':
        if (isset($post['action']) & $post['action'] == 'store') {
            $eventController->store($post);
        } else {
            $eventController->create($fileName = 'admin.event.addForm');
        }
        break;
    case 'edit':
        if (isset($post['action']) & $post['action'] == 'update') {
            $eventController->update($post);
        } else {
            $eventController->edit($_GET['id'], $fileName = 'admin.event.editForm');
        }
        break;

    case 'destroy':
        $eventController->destroy($_GET['id']);
        break;

    default:
        $eventController->index('admin.event.showList');
    break;
}
