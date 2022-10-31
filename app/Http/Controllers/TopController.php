<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TopController extends Controller
{
    public function index(Request $request, Category $categoryModel)
    {
        $categories = $categoryModel->getCategories();
        return view('top')->with("categories", $categories);
    }
}
