<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        $subcats = DB::table('sub_categories')
                    ->join('categories','sub_categories.category_id','categories.id')
                    ->select('sub_categories.*','categories.name')
                    ->orderBy('category_id','DESC')->get();
        
        return view ('admin.subcat.index',compact('subcats','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_name' => 'required|unique:sub_categories|max:150',
            'category_id' => 'required',
        ]);
    
        SubCategory::create($request->all());

        $notification=array(
            'messege'=>'Sub Category Add Successfully',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification);   
        
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
        $subcat = DB::table('sub_categories')->where('id',$id)->first();
        $categories = DB::table('categories')->get();
        return view('admin.subcat.update',compact('categories','subcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'category_name' => 'required|unique:sub_categories,id|max:150',
            'category_id' => 'required',
        ]);

        SubCategory::find($id)->update($request->all());

        $notification=array(
            'messege'=>'Sub Category Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('sub_categories')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('sub_categories')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Sub Category Delete Successfully',
            'alert-type'=>'success'
        ); 
        return Redirect()->back()->with($notification); 
    }
}
