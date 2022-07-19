<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\MovieApi;
use Illuminate\Http\Request;
use App\Repositories\Category\CategoryRepository;

class HomeController extends Controller
{

    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }
    
    public function index()
    {
        $categories = $this->categoryRepo->data();
        
        return view('home', compact('categories'));
    }

    public function getMovies(Category $category)
    {
        $movies = (new MovieApi())->getMovies($category->api);

        return response()->json($movies);
    }
}
