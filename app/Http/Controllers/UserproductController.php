<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use App\Models\Category;
use App\Models\Product;
use Session;

class UserproductController extends Controller
{
    public function productView($slug){

        //view count
        $key = 'product'.$slug;
        if(!Session::has($key)){
            Product::where('slug',$slug)->increment('view');
            Session::put($key,1);
        }

        $product =Product::where('products.slug',$slug)->first();

        $color = $product->product_color;
        $product_color = explode(',', $color);
        
        $size = $product->product_size;
        $product_size = explode(',', $size);
        
        $brand = DB::table('products')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','brands.brand_name','brands.id')
            ->where('products.slug',$slug)->first();
        

        $productcat = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->select('products.*','categories.name','categories.id')
            ->where('products.slug',$slug)->first();

        $productsubcat = DB::table('products')
            ->join('sub_categories','products.subcategory_id','sub_categories.id')
            ->select('products.*','sub_categories.category_name','sub_categories.id')
            ->where('products.slug',$slug)->first();

        //related product
        $related_products = Product::join('sub_categories','products.subcategory_id','sub_categories.id')
            ->select('products.*','sub_categories.category_name','sub_categories.id','products.id')
            ->where('subcategory_id', $product->subcategory_id)
            ->where('products.slug', '!=', $slug)
            ->orderBy('view','desc')
            ->limit(5)->get();
  
        return view('pages.product_details',compact(
            'product',
            'product_color',
            'product_size',
            'brand',
            'productcat',
            'productsubcat',
            'related_products'

        ));
    }


    public function quickView($id){
        $product = Product::find($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);
        
        $size = $product->product_size;
        $product_size = explode(',', $size);
        
        $brand = DB::table('products')
            ->join('brands','products.brand_id','brands.id')
            ->select('products.*','brands.brand_name')
            ->where('products.id',$id)->first();
        $productcat = DB::table('products')
            ->join('categories','products.category_id','categories.id')
            ->select('products.*','categories.name')
            ->where('products.id',$id)->first();

        $productsubcat = DB::table('products')
            ->join('sub_categories','products.subcategory_id','sub_categories.id')
            ->select('products.*','sub_categories.category_name')
            ->where('products.id',$id)->first();

        return response()->json([
            $product,
            $product_color,
            $product_size,
            $brand,
            $productcat,
            $productsubcat,
        ]);
    }

    public function AddCart(Request $request,$id){
        $product = DB::table('products')->where('id',$id)->first();
       
         $data = array();
            $data['id'] = $product->id;
            $data['name'] = $product->product_name;
            $data['qty'] = $request->qty;
            $data['weight'] = 1;
            $data['options']['image'] = $product->main_img;
            $data['options']['color'] = $request->color;
            $data['options']['size'] = $request->size;
        if ($product->discount_price == NULL) {
            $data['price'] = $product->selling_price;
        }else{
            $data['price'] = $product->discount_price;        
        } 

        Cart::add($data);   
        $notification = array(
            'messege' => 'Product Successfully Added',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function catProduct($id){

        $cat = Category::find($id);

        $product = DB::table('products')->where('category_id',$id)->get();

        $total_product = $product->count();

        $products = DB::table('products')->where('category_id',$id)->paginate(25);
        $brands = DB::table('products')->where('category_id',$id)->select('brand_id')->groupBy('brand_id')->get();

        return view('pages.category_product',compact('products','brands','cat','total_product'));
    }
    public function subcatProduct($id){
        $products = DB::table('products')->where('subcategory_id',$id)->paginate(3);
        $brands = DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
        return view('pages.subcategory_product',compact('products','brands'));
    }
}
