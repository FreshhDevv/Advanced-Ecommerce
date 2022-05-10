<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

            $image = $request->file('category_icon');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/categories/' . $name_gen);
            $save_url = 'upload/categories/' . $name_gen;

            Category::insert([
                'category_name_en' => $request->category_name_en,
                'category_name_fre' => $request->category_name_fre,
                'category_slug_en' => strtolower(str_replace(' ', '-', $request->category_name_en)),
                'category_slug_fre' => strtolower(str_replace(' ','-', $request->category_name_fre)),
                'category_icon' => $save_url,
            ]);
            $notification = array(
                'message' => 'Category Added Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }   //End Method
}
