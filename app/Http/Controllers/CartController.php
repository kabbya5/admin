<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
use Auth;
use Session;
use App\Models\Product;
class CartController extends Controller
{
    public function addCart($id){
        $product = DB::table('products')->where('id',$id)->first();  
        $item = array();  
        $item['id'] = $product->id;
        $item['name'] = $product->product_name;
        $item['qty'] = 1;
        $item['weight'] = 1;
        $item['options']['image'] = $product->main_img;
        $item['options']['color'] = '';
        $item['options']['size'] = '';
        
        if ($product->discount_price == NULL) {
            $item['price'] = $product->selling_price;          
        }else{
            $item['price'] = $product->discount_price;  
        } 
        
        Cart::add($item);
        return \Response::json(['success' => 'Successfully Added on your Cart']); 
      
    }
    public function check(){
    	$content = Cart::content();
    	return response()->json($content);
    }
    //show cart
    public function cartShow(){
    	$contents = Cart::content();
    	return view('pages.cart',compact('contents'));
    }

    //remove cart item
    public function removeCart($rowId){
    	Cart::remove($rowId);
        Session::forget('coupon');
    	$notification=array(
            'messege'=>'Product Remove form Cart',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    //remove cart all

    public function cancleCart(){
        Cart::destroy();
        $notification = array(
            'messege' => 'Cart Destroy SuccessFully',
            'alert-type' => 'error'
        );
        return redirect()->route('welcome.page')->with($notification);

    }

    //update cart
    public function updateCart(Request $request){
        $rowId = $request->productid;
        
    	$qty = $request->qty;
    	Cart::update($rowId,$qty);
        Session::forget('coupon');
    	$notification=array(
            'messege'=>'Product Quantity Updated',
            'alert-type'=>'success'
        );
         return Redirect()->back()->with($notification);
    }
    public function checkout(){   
        if(Auth::check()){
            $cart = Cart::Content();
            $setting = DB::table('settings')->first();
            $shippingCharge = $setting->shipping_charge;
            $vat = $setting->vat;
            return view('pages.checkout',compact('cart','vat','shippingCharge'));
        }else{
            $notification = array(
                'messege' => 'At First Login Your Account',
                 'alert-type' => 'error'
            );
            return redirect('login')->with($notification);
        }
    }
    //apply coupon
    public function applyCoupon(Request $request){
        $coupon = $request->coupon;
        $check = DB::table('coupons')->where('coupon_name',$coupon)->first();
        if($check){
            $amount = $check->discount;
            $persenInAmount = $amount / number_format(100);
            $discount = Cart::Subtotal() * $persenInAmount;
            $finalAmount = Cart::Subtotal() - $discount;
            Session::put('coupon',[
                'name' => $check->coupon_name,
                'couponPersent' =>$amount,
                'discount' => $discount,
                'finalAmount' => $finalAmount,
            ]);
            $notification=array(
                'messege'=>'Successfully Coupon Added',
                'alert-type'=>'success'
            );
            return back()->with($notification);
        }
        else{
            $notification=array(
                'messege'=>'Invalid Coupon',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
    }
    // coppon remove
    public function couponRemove(){
        Session::forget('coupon');
        $notification=array(
            'messege'=>'Successfully Coupon Remove',
            'alert-type'=>'warning'
        );
        return back()->with($notification);
    }



}
