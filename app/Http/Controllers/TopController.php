<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();
        return view('top')->with("categories", $categories);
    }
}
