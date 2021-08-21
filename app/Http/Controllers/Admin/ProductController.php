<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderDetails;
use DB;
use Auth;
use Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;

class ProductController extends Controller
{
    //admin section
    public function allProduct(){
        $products = Product::join('categories','products.category_id','categories.id')
        ->join('brands','products.brand_id','brands.id')
        ->join('users','products.seller_id','users.id')
        ->select('products.*','categories.name','brands.brand_name','users.username')
        ->latest()->paginate(15);		
        return view('admin.product.index',compact('products'));
    }
    public function index() 
    {   
        $products = Product::join('categories','products.category_id','categories.id')
    		->join('brands','products.brand_id','brands.id')
    		->select('products.*','categories.name','brands.brand_name')->where('seller_id',Auth::id())
    		->latest()->paginate(15);		
        return view('common.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('common.product.create',compact('categories','brands'));
    }

    //stock out product
    public function stockManagement(){

        $products = Product::join('categories','products.category_id','categories.id')
        ->join('brands','products.brand_id','brands.id')
        ->select('products.*','categories.name','brands.brand_name')->where('product_quantity', '<=', 10)->latest()->paginate(15);
        return view('common.product.stock_management',compact('products'));
    }

    public function GetSubcat($id){
        $cat = DB::table('sub_categories')->where('category_id',$id)->get();
        return json_encode($cat);
 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'main_img' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_one' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_two' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_three' => 'image|mimes:jpeg,png,jpg,gif,svg|', 
        ]);

        $user_id = Auth::id();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['slug'] = SlugService::createSlug(Product::class, 'slug', $request->product_name);
        $data['product_code'] = $request->product_code;
        $data['seller_id'] = $user_id;
        $data['product_quantity'] = $request->product_quantity;
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        
        $data['product_details'] = $request->product_details;
        $data['social_link'] = $request->social_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slide'] = $request->mid_slide;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        $main_img = $request->main_img;
        $image_one = $request->img_one;
        $image_two = $request->img_two;
        $image_three = $request->img_three;

        

        if ($main_img && $image_one && $image_two && $image_three ) {
            $main_img_name= hexdec(uniqid()).'.'.$main_img->extension();
            Image::make($main_img)->resize(300,300)->save(public_path('/media/product/'.$main_img_name));
            $data['main_img'] = 'media/product/'.$main_img_name;

            $image_one_name = hexdec(uniqid()).'.'.$image_one->extension();
            Image::make($image_one)->resize(300,300)->save(public_path('/media/product/'.$image_one_name));
            $data['img_one'] = 'media/product/'.$image_one_name;
       
            $image_two_name = hexdec(uniqid()).'.'.$image_two->extension();
            Image::make($image_two)->resize(300,300)->save(public_path('/media/product/'.$image_two_name));
            $data['img_two'] = 'media/product/'.$image_two_name;
       
       
            $image_three_name = hexdec(uniqid()).'.'.$image_three->extension();
            Image::make($image_three)->resize(300,300)->save(public_path('media/product/'.$image_three_name));
            $data['img_three'] = 'media/product/'.$image_three_name;
       
         }elseif($main_img && $image_one && $image_two ){
            $main_img_name= hexdec(uniqid()).'.'.$main_img->extension();
            Image::make($main_img)->resize(300,300)->save(public_path('/media/product/'.$main_img_name));
            $data['main_img'] = 'media/product/'.$main_img_name;
           
           
            $image_one_name = hexdec(uniqid()).'.'.$image_one->extension();
            Image::make($image_one)->resize(300,300)->save(public_path('/media/product/'.$image_one_name));
            $data['img_one'] = 'media/product/'.$image_one_name;
       
            $image_two_name = hexdec(uniqid()).'.'.$image_two->extension();
            Image::make($image_two)->resize(300,300)->save(public_path('/media/product/'.$image_two_name));
            $data['img_two'] = 'media/product/'.$image_two_name;

        }

        $product = DB::table('products')->insert($data);

        $notification=array(
            'messege'=>'Product Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }



    public function approve(Product $product){

        $product->update([
            'status' => ($product->status == 1) ? 0 : 1
        ]);
        $notification = array(
            'messege' =>  'Your Comand Successfully Work',
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
        $product = DB::table('products')
    			->join('categories','products.category_id','categories.id')
                ->join('sub_categories','products.subcategory_id','sub_categories.id')
    			->join('brands','products.brand_id','brands.id')
                ->join('users','products.seller_id','users.id')
    			->select('products.*','categories.name','sub_categories.category_name','brands.brand_name','username','email')
                ->where('products.id',$id)->first();
        
        $product_order = OrderDetails::where('product_id',$id)->get();
        $total_earn = $product_order->sum('totalprice');    
        $month = Carbon::now()->format('F');
        $month_orders = OrderDetails::whereMonth('created_at',Carbon::now()->month)
            ->where('product_id',$id)->get();
        $month_earn = $month_orders->sum('totalprice');
        $last_sales = OrderDetails::where('product_id',$id)->latest()->first();
        
        return view('common.product.show',compact(
            'product',
            'product_order',
            'total_earn',
            'month',
            'month_earn',
            'last_sales',
        ));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $subcats = DB::table('sub_categories')->get();
    			
        
        return view('common.product.edit',compact('product','categories','brands','subcats'));
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

        $request->validate([
            'main_img' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_one' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_two' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            'img_three' => 'image|mimes:jpeg,png,jpg,gif,svg|', 
        ]);

        $old_main_img = $request->old_main_img;
        $old_img_one = $request->old_img_one;
        $old_img_two = $request->old_img_two;
        $old_img_three = $request->old_img_three;

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;  
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['social_link'] = $request->social_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slide'] = $request->mid_slide;
        $data['print'] = $request->print;

        $main_img = $request->file('main_img');
        $image_one = $request->file('img_one');
        $image_two = $request->file('img_two');
        $image_three = $request->file('img_three');



        if($main_img){
            unlink($old_main_img);
            $main_img_name= hexdec(uniqid()).'.'.$main_img->getClientOriginalExtension();
            Image::make($main_img)->resize(300,300)->save(public_path('/media/product/'.$main_img_name));
            $data['main_img'] = 'media/product/'.$main_img_name;
            
        }
        if($image_one){
            unlink($old_img_one);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save(public_path('/media/product/'.$image_one_name));
            $data['img_one'] = 'media/product/'.$image_one_name;
       
            
        }
        if($image_two){
            unlink($old_img_two);
            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save(public_path('/media/product/'.$image_two_name));
            $data['img_two'] = 'media/product/'.$image_two_name;

            

        }                 
        if($image_three){
            unlink($old_img_three);
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save(public_path('media/product/'.$image_three_name));
            $data['img_three'] = 'media/product/'.$image_three_name;
        }

        $update = DB::table('products')->where('id',$id)->update($data);

        if ($update) {
            $notification=array(
                'messege'=>'Product Successfully Updated',
                'alert-type'=>'success'
            );
            return redirect()->route('product.auth')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing TO Update',
                'alert-type'=>'success'
            );
            return redirect()->route('product.auth')->with($notification);
    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function product_image_three($id){
        $product = Product::find($id);
        return view ('common.product.image_4_update',compact('product'));
    }
    public function productImageUpdate (Request $request,$id){
        $data = array();
        $image_three = $request->img_three;

        if ($image_three) {
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save(public_path('media/product/'.$image_three_name));
            $data['img_three'] = 'media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);
        }
        $notification = array(
            'messege' => 'Successfully Added',
            'alert-type' => 'success'
        );
        return redirect()->route('all.products')->with($notification);
    }
    
    
    

    public function destroy($id)
    {
        $product = Product::find($id);

        $main_img = $product->main_img;
        $img_one = $product->img_one;
        $img_two = $product->img_two;
        $img_three = $product->img_three;

        if ($main_img && $img_one && $img_two && $img_three ){
            unlink($main_img);
            unlink($img_one);
            unlink($img_two);
            unlink($img_three);

            $deletLogo = $product->delete();

        }elseif($main_img && $img_one && $img_two ){
            unlink($main_img);
            unlink($img_one);
            unlink($img_two); 
            $deletLogo = $product->delete();          
        }else{
            $deletLogo = $product->delete();   
        }

        $notification = array(
            'messege' => 'Successfully Deleted',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
