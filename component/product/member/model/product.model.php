<?php
require_once ROOT_DIR . "component/product/member/model/ProductGallery.php";

class c_product extends looeic
{
    public static function getProductCount($company_id)
    {
        $product = c_product::getAll()->where('company_id', '=', $company_id)->getList();
        return $product['export']['recordsCount'];
    }

    public function galleries()
    {
        $productGalleries = ProductGallery::getAll()
            ->where('product_id', '=', $this->Product_id)
            ->where('status', '=', 2)
            ->where('isActive', '=', 1)
            ->get();

        foreach ($productGalleries['export']['list'] as $ProductGallery) {
            $response[$ProductGallery->product_gallery_id]['product_d_id'] = $ProductGallery->product_d_id;
            $response[$ProductGallery->product_gallery_id]['product_gallery_id'] = $ProductGallery->product_gallery_id;
            $response[$ProductGallery->product_gallery_id]['image'] = $ProductGallery->image;
            $response[$ProductGallery->product_gallery_id]['src'] = COMPANY_ADDRESS . $this->company_id . "/product/gallery" . DS . $ProductGallery->image;
        }

        return $response;
    }
}

class c_product_d extends looeic
{
    protected $rules = array(
        'title' => 'required*' . PRODUCT_01,
        'brif_description' => 'required*' . PRODUCT_02,
    );

    public function updateAll()
    {
        $fields['isActive'] = 0;
        $where = '`product_id`=' . $this->product_id . ' AND Product_d_id < ' . $this->Product_d_id . ' AND `company_id` = ' . $this->company_id . ' AND `isActive` <> -1';
        $result = self::update($fields, $where);
        return $result;
    }

    public function galleries()
    {
        $productGalleries = ProductGallery::getAll()
            ->where('product_d_id', '=', $this->Product_d_id)
            ->where('isActive', '=', 1)
            ->get();

        foreach ($productGalleries['export']['list'] as $ProductGallery) {
            $response[$ProductGallery->product_gallery_id]['product_d_id'] = $ProductGallery->product_d_id;
            $response[$ProductGallery->product_gallery_id]['product_gallery_id'] = $ProductGallery->product_gallery_id;
            $response[$ProductGallery->product_gallery_id]['image'] = $ProductGallery->image;
            $response[$ProductGallery->product_gallery_id]['src'] = COMPANY_ADDRESS . $this->company_id . "/product/gallery" . DS . $ProductGallery->image;
        }

        return $response;
    }
}


class c_product_lang extends looeic
{
    protected $rules = array(
        'title' => 'required*' . PRODUCT_01,
        'brif_description' => 'required*' . PRODUCT_02,
    );

    public static function translateProduct($product)
    {
        global $lang;

        if (array_key_first($product) != 'Product_id') {
            if($product['export']['recordsCount'] > 0){
                foreach ($product['export']['list'] as $k => &$p) {
                    $p = self::translateProduct($p);
                }
            }
            return $product;
        }

        $product_lang = c_product_lang::getAll()
            ->where('c_product_id', '=', $product['Product_id'])
            ->andWhere('lang', '=', $lang)
            ->first();
        if (is_object($product_lang)) {
            $product['title_' . $lang] = $product_lang->title;
            $product['brief_description_' . $lang] = $product_lang->brief_description;
            $product['description_' . $lang] = $product_lang->description;
            $product['meta_keyword_' . $lang] = $product_lang->meta_keyword;
            $product['meta_description_' . $lang] = $product_lang->meta_description;
            return $product;
        }
        return $product;
    }
}
