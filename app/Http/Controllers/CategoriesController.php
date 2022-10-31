<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;


class CategoriesController extends Controller
{
    public function edit(Request $request)
    {
        return view('categories.edit');
    }

    public function create(CategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->category_name();
        $category->save();
        return redirect()->route('top');
    }
}
