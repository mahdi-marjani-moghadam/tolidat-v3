<?php

class CategoryProduct extends looeic {
    protected $TABLE_NAME = "category_product";

    public $product;

    public function attach($category_id)
    {

        foreach ($category_id as $key => $value) {
            $productCategory = new CategoryProduct();
            $productCategory->company_id = $this->product->company_id;
            $productCategory->product_id = $this->product->Product_id;
            $productCategory->category_id = $value;
            $productCategory->save();
        }

    }

    public function detach($category_id = [])
    {


        $resultCategory = CategoryProduct::getAll()
            ->where('product_id', '=', $this->product->Product_id)
            ->get();

        $resultCategory = $resultCategory['export']['list'];
        if (count($category_id ) == 0) {
            $sql = "delete from category_product where product_id = " . $this->product->Product_id ;
            CategoryProduct::query($sql)->getlist();

        } else {
            foreach ($resultCategory as $category) {
                if (in_array($category->category_id, $category_id)) {
                    $category->delete();
                }
            }
        }

    }


}