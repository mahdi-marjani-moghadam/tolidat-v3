<?php
include_once "SitemapController.php";

global $PARAM;
$controller = new SitemapController();

switch ($PARAM['1']) {
    case "show" :
        $controller->show();
        break;

    case "save" :
        
        $controller->save($PARAM['2']);
        break;

    case "create" :
        $controller->create($PARAM['2']);
        break;
}


