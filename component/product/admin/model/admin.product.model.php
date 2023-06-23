<?php

class adminc_productModel extends looeic
{

    public function findProductsThatHasCompany()
    {
       $result = $this
            ->select('company.Company_id', 'company.city_id', 'company.state_id', 'company.category_id', 'company.parent_category_id', 'c_product.Product_id')
            ->join('company', 'c_product.company_id', '=', 'company.Company_id')
           ->getList();

       return $result['export']['list'];
    }

    public function getAllProducts()
    {
        $companyList = self::getAll()->getList();

        return $companyList['export']['list'];
    }

    public function syncProductWithCompany()
    {
        $productWithCompany = $this->findProductsThatHasCompany();

        foreach ($productWithCompany as $key => $company) {
            $product = static::find($company['Product_id']);
            $product->city_id = $company['city_id'];
            $product->state_id = $company['state_id'];
            $product->category_id = $company['category_id'];
            $product->parent_category_id = $company['parent_category_id'];
            $result [] = $product->save();
        }

        return $result;

    }

    public function category()
    {
        include_once ROOT_DIR . 'component/category/admin/model/CategoryProduct.model.php';

        $categoryAttach = new CategoryProduct();
        $categoryAttach->product = $this;

        return $categoryAttach;
    }

    
}
