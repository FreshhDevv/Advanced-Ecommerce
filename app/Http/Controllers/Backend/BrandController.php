<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function BrandView()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_fre' => 'required',
            'brand_image' => 'required',
        ],
        [
            'brand_name_en.required' => 'The Brand Name English field is required',
            'brand_name_fre.required' => 'The Brand Name French field is required',
        ]);
    }   //End Method
}
