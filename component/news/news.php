<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */
include_once(dirname(__FILE__) . "/model/news.controller.php");

global $admin_info, $PARAM;

$newsController = new newsController();
//
//if (isset($_POST['action']) && $_POST['action'] == 'getNews') {
//    $newsController->exportType = "json";
//    $fields['limit']['start'] = '0';
//    $fields['limit']['length'] = '5';
//    $fields['order']['News_id'] = 'DESC';
//    // $newsController->showALL($fields);
//    $newsController->showAllRss();
//}
//if (isset($exportType)) {
//    $newsController->exportType = $exportType;
//}
//
if (($PARAM[1])=='all') {
    $newsController->showAllNews($PARAM['2']);
} else {
    //
       $fields['filter']['title']='sdf';
    //
    //
       $fields['limit']['start'] = (isset($page)) ? ($page - 1) * PAGE_SIZE : '0';
       $fields['limit']['length'] = PAGE_SIZE;
       $fields['order']['News_id'] = 'DESC';
       
    //    $newsController->showALL($fields);
        $newsController->showAllRss();
    //    die();
    //}
    // $newsController->showMore($PARAM[1]);

}
?>
