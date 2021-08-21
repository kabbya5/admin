<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:categories|min:3|max:150',
            'category_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|'
        ]);
        $category = new Category;  
        $category->name =  $request->name; 
        $img = $request->file('category_logo');

        if($img){
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/category/'.$img_name));
            $category->category_logo = 'media/category/'.$img_name;                                          
        }

        $update = $category->save();
        $notification = array(
            'messege' => ' Successfully Category Added',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function edit($id)
    {   
        $category = Category::find($id);
        return view('admin.category.update',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {   
        
        $validateData = $request->validate([
            'name' => 'required|unique:categories,id|min:3|max:150',
            'category_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|'
        ]);


        $old_logo = $request->old_logo; 

        $category->name =  $request->input('name'); 
         
        $img = $request->file('category_logo');
     
        if($img && $old_logo){
            unlink($old_logo);
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/category/'.$img_name));
            $category->category_logo = 'media/category/'.$img_name;

            
        }elseif ($img){
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/category/'.$img_name));
            $category->category_logo = 'media/category/'.$img_name;  
        }

        $update = $category->update();
                                 
           
        if($update){
            $notification = array(
                'messege' => ' Successfully Category  Update',
                'alert-type' => 'success'
            );

         
            return redirect()->route('categories')->with($notification);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
   
      $category = Category::find($id);
      if($category->category_logo){
        $img = $category->category_logo;
        unlink($img);
      }
     
      $deletLogo = $category->delete();
        $notification = array(
            'messege' => ' Category Deleted', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}

