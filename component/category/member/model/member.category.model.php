<?php

class category extends looeic {

    protected $rules = array(
        'title' => 'required*توضیح عکس ضروری است',
        'alt' => 'required*توضیح عکس ضروری است'
    );

    public static function getCategoryTitle($category_id)
    {
        $categoriesId = tagToArray($category_id)['export']['list'];

        $categories = static::getAll()->where('Category_id', 'in', $categoriesId)->get();

        foreach ($categories['export']['list'] as $category) {

            if (is_object($category)) {
                $categoryTitles[] = $category->title;
            }
        }

        return $categoryTitles;
    }


    public static function getCategorySlug($category_id)
    {
        $categoriesId = tagToArray($category_id)['export']['list'];
        $categories = static::getAll()->where('Category_id', 'in', $categoriesId)->get();
        
        foreach ($categories['export']['list'] as $category) {
            
            if (is_object($category)) {
                $categoryArr[] = $category->url;
            }
        }

        return implode(',',$categoryArr);
    }
}

