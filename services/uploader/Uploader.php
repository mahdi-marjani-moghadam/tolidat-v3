<?php
include_once "Cropper.php";
include_once "Compress.php";

class Uploader
{
    public function cropAndCompressImage($property, $sizes = null)
    {
        $cropper = new Cropper();
        $result = $cropper->cropImage($property);
        $destination = $this->getDestination($property);
        $file = $destination . "/" . $result['image'];
        
        if (isset($sizes)) {
            $compress = new Compress();
            $compress->resize($file, $destination, $sizes);
        }
        
        return $result;
    }

    public function getDestination($property)
    {
        if (isset($property['destination'])) {
            $property['destination'] = rtrim($property['destination'], '/');
            $destination = $property['destination'];
        } elseif (isset($property['company_id'])) {
            $destination = IMAGES_ROOT_DIR . "company/" . $property['company_id'] . "/" . $property['folder_name'];
        } else {
            $destination = IMAGES_ROOT_DIR . $property['folder_name'];
        }

        return $destination;
    }

    public function resizeUploadedImages()
    {
        include_once ROOT_DIR . "component/product/member/model/product.model.php";
        include_once ROOT_DIR . "component/companyLogo/member/model/companyLogo.model.php";
        include_once ROOT_DIR . "component/event/models/Event.php";
        include_once ROOT_DIR . "component/article/model/article.model.php";
        include_once ROOT_DIR . "component/companyBanner/member/model/companyBanner.model.php";
        include_once ROOT_DIR . "component/event/models/EventGallery.php";
        include_once ROOT_DIR . "component/history/model/history.model.php";
        include_once ROOT_DIR . "component/companyCommercialName/model/companyCommercialName.model.php";
        include_once ROOT_DIR . "component/licence/model/Licence.php";
        include_once ROOT_DIR . "component/honour/model/honour.model.php";
        include_once ROOT_DIR . "component/companyNews/model/companyNews.model.php";
        include_once ROOT_DIR . "component/companyAdvertise/model/Advertise.php";

        $compress = new Compress();

        $productSize = [
            'size1' => ['width' => 100, 'height' => 100],
            'size2' => ['width' => 90, 'height' => 90],
            'size3' => ['width' => 150, 'height' => 150],
            'size4' => ['width' => 200, 'height' => 200]
        ];

        $logoSize = [
            'size1' => ['width' => 122, 'height' => 125],
            'size2' => ['width' => 140, 'height' => 140],
            'size3' => ['width' => 150, 'height' => 150]
        ];

        $eventSize = [
            'size1' => ['width' => 90, 'height' => 90]
        ];

        $articlSize = [
            'size1' => ['width' => 90, 'height' => 90]
        ];

        $bannerSize = [
            'size1' => ['width' => 1260, 'height' => 210]
        ];

        $eventSize = [
            'size1' => ['width' => 650, 'height' => 366],
            'size2' => ['width' => 217, 'height' => 145],
            'size2' => ['width' => 1300, 'height' => 732]
        ];

        $otherSize = [
            'size1' => ['width' => 90, 'height' => 90]
        ];

        /*$companies = company::getAll()->get();

        foreach ($companies['export']['list'] as $company) {
           $products = c_product::getAll()->where('company_id', '=', $company->Company_id)->get();

            foreach ($products['export']['list'] as $product) {
                $productImage = COMPANY_ADDRESS_ROOT . $company->Company_id . "/product/" . $product->image;
                $productDestination = COMPANY_ADDRESS_ROOT . $company->Company_id . "/product/";

                if (! strpos($product->image, 'tmp') & ! strpos($product->image, 'jpg')) {
                    $compress->resize($productImage, $productDestination, $productSize, 9);
                } else {
                    $compress->resize($productImage, $productDestination, $productSize, 100);
                }
            }

            $logos = c_logo::getAll()->where('company_id', '=', $company->Company_id)->get();

            foreach ($logos['export']['list'] as $logo) {
                $logoImage = COMPANY_ADDRESS_ROOT . $company->Company_id . "/logo/" . $logo->image;
                $logoDestination = COMPANY_ADDRESS_ROOT . $company->Company_id . "/logo/";

                if (!strpos($logo->image, 'tmp') & !strpos($logo->image, 'jpg')) {
                    $compress->resize($logoImage, $logoDestination, $logoSize, 9);
                } else {
                    $compress->resize($logoImage, $logoDestination, $logoSize, 100);
                }
            }

            $banners = c_banner::getAll()->where('company_id', '=', $company->Company_id)->get();

            foreach ($banners['export']['list'] as $banner) {
                $bannerImage = COMPANY_ADDRESS_ROOT . $company->Company_id . "/banner/" . $banner->image;
                $bannerDestination = COMPANY_ADDRESS_ROOT . $company->Company_id . "/banner/";

                if (!strpos($banner->image, 'tmp') & !strpos($banner->image, 'jpg')) {
                    $compress->resize($bannerImage, $bannerDestination, $bannerSize, 9);
                } else {
                    $compress->resize($bannerImage, $bannerDestination, $bannerSize, 100);
                }
            }
        }

        $events = Event::getAll()->get();

        foreach ($events['export']['list'] as $event) {
            $eventImage = EVENT_ADDRESS . $event->icon;
            $eventDestination = EVENT_ADDRESS;

            if (!strpos($event->icon, 'tmp') & !strpos($event->icon, 'jpg')) {
                $compress->resize($eventImage, $eventDestination, $eventSize, 9);
            } else {
                $compress->resize($eventImage, $eventDestination, $eventSize, 100);
            }
        }

        $articls = article::getAll()->get();

        foreach ($articls['export']['list'] as $articl) {
            $articlImage = IMAGES_ROOT_DIR . "article/" . $articl->image;
            $articlDestination = IMAGES_ROOT_DIR . "article/";

            if (!strpos($articl->image, 'tmp') & !strpos($articl->image, 'jpg')) {
                $compress->resize($articlImage, $articlDestination, $articlSize, 9);
            } else {
                $compress->resize($articlImage, $articlDestination, $articlSize, 100);
            }
        }*/

        /*$logos = c_logo::getAll()->where('image', '<>' , '')->get();

        foreach ($logos['export']['list'] as $logo) {
            $logoImage = COMPANY_ADDRESS_ROOT . $logo->company_id . "/logo/" . $logo->image;
            $logoDestination = COMPANY_ADDRESS_ROOT . $logo->company_id . "/logo/";

            echo $logo->company_id . "<br>";

            if (!strpos($logo->image, 'tmp') & !strpos($logo->image, 'jpg')) {
                $compress->resize($logoImage, $logoDestination, $logoSize, 7);
            } else {
                $compress->resize($logoImage, $logoDestination, $logoSize, 80);
            }
        }*/

        /*$logo = c_logo::find(81);
        $logoImage = COMPANY_ADDRESS_ROOT . "21129/logo/" . $logo->image;
        $logoDestination = COMPANY_ADDRESS_ROOT . "21129/logo/";
        $compress->resize($logoImage, $logoDestination, $logoSize, 8);

        $logo = c_logo::find(117);
        $logoImage = COMPANY_ADDRESS_ROOT . "21155/logo/" . $logo->image;
        $logoDestination = COMPANY_ADDRESS_ROOT . "21155/logo/";
        $compress->resize($logoImage, $logoDestination, $logoSize, 8);

        $logo = c_logo::find(265);
        $logoImage = COMPANY_ADDRESS_ROOT . "21243/logo/" . $logo->image;
        $logoDestination = COMPANY_ADDRESS_ROOT . "21243/logo/";
        $compress->resize($logoImage, $logoDestination, $logoSize, 8);*/

        /*$events = EventGallery::getAll()->get();

        foreach ($events['export']['list'] as $event) {
            $eventImage = EVENT_ADDRESS . $event->event_id . "/" . $event->image;
            $eventDestination = EVENT_ADDRESS . $event->event_id . "/";
            $compress->resize($eventImage, $eventDestination, $eventSize, 100);
        }*/

        $models = [
            'history' => 'History',
            'commercialName' => 'CommercialName',
            'licence' => 'Licence',
            'honour' => 'Honour',
            'news' => 'News',
            'advertise' => 'c_advertise'
        ];

        foreach ($models as $key => $model) {
            echo $key.'<br/>';
            $items = $model::getAll()->get()['export']['list'];
            foreach ($items as $item) {
                echo '<pre/>';
                print_r($item);
                echo '<br/>';
                if (strlen(trim($item->image)) > 0) {
                    $image = COMPANY_ADDRESS_ROOT . $item->company_id . "/".$key."/" . $item->image;
                    $destination = COMPANY_ADDRESS_ROOT . $item->company_id . "/".$key."/";
                    $compress->resize($image, $destination, $otherSize);
                }
            }
        }

    }
}
