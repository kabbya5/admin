<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use App\Models\Product;

class WelcomeController extends Controller
{
    public function index(){
        //Main sliders
        $sliders = DB::table('products')
                ->join('brands','products.brand_id','brands.id')
                ->join('categories','products.category_id','categories.id')
                ->select('products.*','brands.brand_name','categories.name')
                ->where('main_slider',1)->where('status',1)->orderBy('id','DESC')->limit(6)->get(); 

        // Futured section

        $futureds = DB::table('products')->where('status',1)->orderby('id','DESC')->limit(9)->get();
        $trends = DB::table('products')->where('status',1)->where('trend',1)->orderBy('id','DESC')->limit(9)->get();
        $bests = DB::table('products')->where('status',1)->where('best_rated',1)->orderBy('id','DESC')->limit(9)->get();
        //Deal of this month
        $hots = DB::table('products')
                ->join('brands','products.brand_id','brands.id')
                ->select('products.*','brands.brand_name')
                ->where('products.status',1)->where('products.hot_deal',1)->orderBy('id','DESC')->limit(20)->get();
        
        //Mid slider Hot and New

        $mid_slider = DB::table('products')
                        ->join('brands','products.brand_id','brands.id')
                        ->select('products.*','brands.brand_name')
                        ->where('status',1)->where('mid_slide',1)->orderBy('id',"DESC")->limit(6)->get();

        // Brand 
        $brands = Brand::all();

        // print section
        $print = Product::where('status',1)->where('print',1)->latest()->limit(15)->get();


        return view('welcome',compact(
              'sliders',
              'futureds',
              'trends',
              'bests',
              'hots',
              'mid_slider',
              'brands',
              'print',
        ));
    }
  
}
