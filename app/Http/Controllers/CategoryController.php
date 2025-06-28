<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create() {
        return view('Category-form');
    }

    public function agg_category(Request $request) {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return $category;
    }
}
