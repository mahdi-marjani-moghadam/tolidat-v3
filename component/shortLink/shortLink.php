<?php

require "controllers/ShortLinkController.php";

$shortLinkController = new ShortLinkController();

// $url = parse_url($_SERVER['REQUEST_URI']);
// $uri = explode('&', $url['query']);

if (isset($exportType)) {
    $certificationController->exportType = $exportType;
}

switch ($_GET['action']) {
    case 'shortLink':
        $shortLinkController->directToCompanyWiki($_GET['companyId']);
        break;

    default:
        $shortLinkController->Index();
        break;
}
