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
        return view('backend.brand.brand_view', compact('brands'));
    }

    public function BrandStore(Request $request)
    {
        $request->validate(
            [
                'brand_name_en' => 'required',
                'brand_name_fre' => 'required',
                'brand_image' => 'required',
            ],
            [
                'brand_name_en.required' => 'The Brand Name English field is required',
                'brand_name_fre.required' => 'The Brand Name French field is required',
            ]
        );
        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
        $save_url = 'upload/brands/' . $name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_fre' => $request->brand_name_fre,
            'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
            'brand_slug_fre' => str_replace(' ', '-', $request->brand_name_fre),
            'brand_image' => $save_url,
        ]);
        $notification = array(
            'message' => 'Brand Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }   //End Method

    public function BrandEdit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function BrandUpdate(Request $request)
    {
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {
            unlink($old_img);
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brands/' . $name_gen);
            $save_url = 'upload/brands/' . $name_gen;

            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_fre' => $request->brand_name_fre,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_fre' => str_replace(' ', '-', $request->brand_name_fre),
                'brand_image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brands')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_fre' => $request->brand_name_fre,
                'brand_slug_en' => strtolower(str_replace(' ', '-', $request->brand_name_en)),
                'brand_slug_fre' =>str_replace(' ', '-', $request->brand_name_fre),
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brands')->with($notification);
        }
    }   //End Method
}
