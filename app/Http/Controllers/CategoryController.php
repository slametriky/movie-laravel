<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Actions\SaveCategory;
use App\Actions\UpdateCategory;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\Category\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        return view('categories.index');
    }   

    public function data()
    {
        $products = $this->categoryRepo->data();
        
        return response()->json($products);
    }
    
    public function store(StoreCategoryRequest $request)
    {
        $store = (new SaveCategory(new Category(), $request->all()))->handle();

        return response()->json(['message' => 'success']);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {   
        $update = (new UpdateCategory($category, $request->except(['_method', 'id'])))->handle();
   
        return response()->json(['message' => 'success']);
    }

    public function destroy(Category $category)
    {   
        $delete = $category->delete();

        return response()->json(['message' => 'success']);
    }
}
