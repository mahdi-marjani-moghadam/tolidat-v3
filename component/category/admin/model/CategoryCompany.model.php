<?php

class CategoryCompany extends looeic
{

    protected $TABLE_NAME = "category_company";
    public $company;


    public function attach($category_id)
    {
        foreach ($category_id as $key => $value) {
            $companyCategory = new CategoryCompany();
            $companyCategory->company_id = $this->company->Company_id;
            $companyCategory->category_id = $value;
            $companyCategory->save();
        }
    }

    public function detach($category_id = [])
    {
        $resultCategory = CategoryCompany::getAll()
            ->where('company_id', '=', $this->company->Company_id)
            ->get();

        $resultCategory = $resultCategory['export']['list'];
        if (count($category_id) == 0) {
            try {
                $sql = "delete from category_company where company_id = " . $this->company->Company_id;
                CategoryCompany::query($sql)->getlist();
            } catch (PDOException $e) {
                get_caller(__FUNCTION__);
                echo $sql;
                echo "Error: " . $e->getMessage() . 'company id:' . $this->company->Company_id;
                dd('');
            }
        } else {
            foreach ($resultCategory as $category) {
                if (in_array($category->category_id, $category_id)) {
                    $category->delete();
                }
            }
        }
    }
}
