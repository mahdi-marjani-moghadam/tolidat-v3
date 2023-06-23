<?php

require_once "controllers/EventController.php";
require_once "models/Event.php";
require_once "models/EventGallery.php";
require_once ROOT_DIR . "services/event/EventService.php";

$eventController = new EventController(new Event, new EventGallery, new EventService);
global $PARAM;
if (isset($PARAM[1])) {
    $eventController->show($PARAM[1]);
} else {
    $eventController->index();
}

