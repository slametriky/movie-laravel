<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryInterface;

class CategoryRepository implements CategoryInterface 
{
    public function data(){

        $categories = Category::all();

        return $categories;
    }    

}


