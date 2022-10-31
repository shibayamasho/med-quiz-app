<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class QuizzesController extends Controller
{
    public function edit(Request $request, Category $categoryModel)
    {
        $categories = $categoryModel->getCategories();
        return view('quizzes.edit')->with("categories", $categories);
    }
}
