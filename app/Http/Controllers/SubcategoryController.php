<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function fetchByCategoryId(Request $request)
    {

        // var_dump($request);
        $subcategories = Subcategory::where('category_id', $request->category_id)->get();

        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    public function store(Request $request)
    {
        $sub = new Subcategory();
        $sub->name = $request->name;
        $sub->slug = Str::slug($request->name);
        $sub->category_id = $request->category_id;
        $sub->save();

        return redirect()->back()->with('success', 'SubCategory Created');
    }
}
