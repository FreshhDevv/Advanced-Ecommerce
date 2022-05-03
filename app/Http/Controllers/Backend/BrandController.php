<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brands/'.$name_gen);
        $save_url = 'upload/brands/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_fre' => $request->brand_name_fre,
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_fre' => str_replace(' ','-',$request->brand_name_fre),
            'brand_image' =>$save_url,
        ]);

        $notification = array(
            'message' => 'Brand Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }   //End Method
}
