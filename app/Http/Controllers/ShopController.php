<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderDetails;
use Carbon\Carbon; 
use DB;

class ShopController extends Controller
{

    public function bestRated(){
        $rated_product = Product::where('status', 1)->where('best_rated',1)->latest()->paginate(25);

        $topsales = DB::table('order_details')
        ->leftJoin('products','products.id','order_details.product_id')
        ->select('products.id','products.product_name','products.product_code','products.slug','products.selling_price', 'products.discount_price','products.main_img',
        'products.product_quantity','order_details.product_id',
             DB::raw('SUM(order_details.quantity) as total'))
        ->groupBy('products.id','order_details.product_id','products.product_name','products.slug','products.product_code','products.selling_price', 'products.discount_price','products.main_img','products.product_quantity')
        ->orderBy('total','desc')
        ->paginate(10);

        return view('pages.shop.rated_product', compact('rated_product','topsales'));
    }

    public function brandProduct($id){
        $brand = Brand::find($id);

        $product = DB::table('products')->where('brand_id',$id)->get();

        $total_product = $product->count();

        $products = DB::table('products')->where('brand_id',$id)->where('status',1)->paginate(25);
        $categories = DB::table('products')->where('brand_id',$id)->select('category_id')->groupBy('category_id')->get();

        return view('pages.shop.brand_product',compact('products','categories','brand','total_product'));

    }
    public function feauturedProduct(){

        $product = Product::where('status',1)->get();
        $total_product = $product->count();
        $products = Product::where('status', 1)->latest()->paginate(15);
        $like_product =  Product::where('status', 1)->orderBy('view','desc')->paginate(15);
        return view('pages.shop.shop_page', compact('products','like_product','total_product'));
    }
    public function trendProducts(){
        $trend_product = Product::where('status', 1)->where('trend',1)->latest()->paginate(20);
        $topsales = DB::table('order_details')
        ->leftJoin('products','products.id','order_details.product_id')
        ->select('products.id','products.product_name','products.product_code','products.slug','products.selling_price', 'products.discount_price','products.main_img',
        'products.product_quantity','order_details.product_id',
             DB::raw('SUM(order_details.quantity) as total'))
        ->groupBy('products.id','order_details.product_id','products.product_name','products.slug','products.product_code','products.selling_price', 'products.discount_price','products.main_img','products.product_quantity')
        ->orderBy('total','desc')
        ->paginate(10);

        return view('pages.shop.deal_product', compact('trend_product','topsales'));
    }
    public function dealProducts(){
        $deal_product = Product::where('status', 1)->where('hot_deal',1)->latest()->paginate(25);
        $topsales = DB::table('order_details')
        ->leftJoin('products','products.id','order_details.product_id')
        ->select('products.id','products.product_name','products.product_code','products.slug','products.selling_price', 'products.discount_price','products.main_img',
        'products.product_quantity','order_details.product_id',
        
             DB::raw('SUM(order_details.quantity) as total'))
        ->groupBy('products.id','order_details.product_id','products.product_name','products.slug','products.product_code','products.selling_price', 'products.discount_price','products.main_img','products.product_quantity')
        ->orderBy('total','desc')->whereMonth('order_details.created_at', Carbon::now()->month)
        ->paginate(10);
        
        return view('pages.shop.hot_deal', compact('deal_product','topsales'));
    }
}
