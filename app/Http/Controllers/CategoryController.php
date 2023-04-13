<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Subcategory $subcategory)
    {
        $ads = $subcategory->ads;

        return view('ads.index', compact('ads'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->back()->with('success', 'Category Created');
    }

    public function getSubcategories(Request $request)
    {
        $categoryId = $request->input('category_id');

        $subcategories = Subcategory::where('category_id', $categoryId)->get();

        return response()->json($subcategories);
    }
}
