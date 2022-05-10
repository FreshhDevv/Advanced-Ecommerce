<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CategoryView() 
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_view', compact('categories'));
    }

    public function CategoryStore(Request $request)
    {
        $request->validate(
            [
                'category_name_en' => 'required',
                'category_name_fre' => 'required',
                'category_icon' => 'required',
            ],
            [
                'category_name_en.required' => 'The Category Name English field is required',
                'category_name_fre.required' => 'The Category Name French field is required',
            ]
            );

            Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_fre' => $request->category_name_fre,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_fre' => strtolower(str_replace(' ','-', $request->category_name_fre)),
                'category_icon' => $request->category_icon,
            ]);
            $notification = array(
                'message' => 'Category Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }   //End Method
}
