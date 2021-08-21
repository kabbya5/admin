<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\Brand;
use DB;
use Image;
class BrandController extends Controller
{
    public function index()
    {   
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:3|max:150',
            'brand_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|'
        ]);
        $brand = new Brand;  
        $brand->brand_name =  $request->brand_name; 
        $img = $request->file('brand_logo');

        if($img){
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/brand/'.$img_name));
            $brand->brand_logo = 'media/brand/'.$img_name;                          
        }

        $brand->save();
        
        $notification = array(
            'messege' => ' Successfully Brand Added',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $brand = Brand::find($id);
        return view('admin.brand.update',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Brand $brand)
    {   
        $validateData = $request->validate([
            'brand_name' => 'required|unique:brands,id|min:3|max:150',
            'brand_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|'
        ]);

        $old_logo = $request->old_logo; 
        $brand->brand_name =  $request->input('brand_name'); 
         
        $img = $request->file('brand_logo');

        if($img && $old_logo){
            unlink($old_logo);
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/brand/'.$img_name));
            $brand->brand_logo = 'media/brand/'.$img_name;

            
        }else{
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/brand/'.$img_name));
            $brand->brand_logo = 'media/brand/'.$img_name;       
        }
     
        $brand->update();
        
        $notification = array(
            'messege' => ' Successfully Brand Update',
            'alert-type' => 'success'
        );

        return redirect()->route('brands')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $brand = Brand::find($id);
        if($brand->brand_logo){
            $img = $brand->brand_logo;
            unlink($img);
        }
         
        $deletLogo = $brand->delete();

        $notification = array(
            'messege' => ' Brand Deleted', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}



