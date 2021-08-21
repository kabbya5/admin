<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Cart;
use Response;
use Auth;
use Session;
use App\Models\OrderDetails;
use App\Models\PaymentSetting;
use App\Models\Order;
use App\Models\Shipping;

use Carbon\Carbon;

use \Cviebrock\EloquentSluggable\Services\SlugService;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'verified']);
    }

    public function viewOrder($id){

        $order = Order::join('users','orders.user_id','users.id')
        ->select('orders.*','users.name','users.email')
        ->where('orders.id',$id)->first();

        $shipping = Shipping::where('order_id', $id)->first();

        $details = OrderDetails::join('products','order_details.product_id','products.id')
                    ->select('order_details.*','products.product_code','products.main_img')
                    ->where('order_details.order_id',$id)->get();

        return view('pages.order_details',compact('order','shipping','details'));


    }

    // payment step
    public function orderPage(Request $request){
        $auth_id = Auth::id();
        $payment_setting = PaymentSetting::first();
        $cart = Cart::Content();
        $shipping = Shipping::where('user_id',$auth_id)->first();
        $setting = DB::table('settings')->first();
        $shippingCharge = $setting->shipping_charge;
        $vat = $setting->vat;
        return view('pages.order',compact('cart','shippingCharge','vat','shipping','payment_setting'));
    }

    // Save order
    public function orderCreate(Request $request){

        $setting = DB::table('settings')->first();
        $shippingCharge = $setting->shipping_charge;
        $vat = $setting->vat;

        $cart = Cart::Content();

        // validation  shipping address
        $request->validate([
            
            'fname' => 'required|min:2|max:50',
            'lname' => 'required|min:5|max:50',
            'phone' => 'required',
            'email' => 'required|email|',
            'bkash_number' => 'required|min:3',
            'town' =>  'required',
            'district' => 'required',

        ]);

    
        
        // insert order 
        $random_code = rand();
        $order_code = 'OCBD'.$random_code;


    
        $order = array();
        $order['user_id'] = Auth::id();
        $order['order_code'] = $order_code;
        $order['slug'] = SlugService::createSlug(Order::class, 'slug', $order_code);
        $order['status'] = 0;
        $order['date'] = date('d-m-y');
        $order['month'] = date('F');
        $order['year'] = date('Y');
        $order['created_at'] = Carbon::now();
        $order['updated_at'] = Carbon::now();
       
        
        if (Session::has('coupon')) {

            $order['subtotal'] = $total = round(Session::get('coupon')['finalAmount'] + $vat+ $shippingCharge);
            $order['coupon_name'] = Session::get('coupon')['name'];
            $order['discount']  = Session::get('coupon')['discount'];

        }else{
            $order['subtotal'] = Cart::Subtotal();
        }
        $order_id = Order::insertGetId($order);
    
        //insert shiping      
        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['user_id'] = Auth::id();
        $shipping['fname'] = $request->fname;
        $shipping['lname'] = $request->lname;
        $shipping['phone'] = $request->phone;
        $shipping['email'] = $request->email;
        $shipping['bkash_number'] = $request->bkash_number;
        $shipping['street_address'] = $request->street_address;
        $shipping['town'] = $request->town;
        $shipping['district'] = $request->district;
        $shipping['created_at'] = now();

         Shipping::insert($shipping);
    
        

        // insert order details
        
        foreach ($cart as $row) {
            $details = array(
                'order_id' => $order_id,
                'product_id' => $row->id,
                'product_name' => $row->name,
                'color' => $row->options->color,
                'size' => $row->options->size,
                'quantity' => $row->qty,
                'singleprice' => $row->price,
                'totalprice' => $row->qty*$row->price,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
            OrderDetails::insert($details); 
        }

        Cart::destroy();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $notification=array(
            'messege'=>'Order Process Successfully Done',
            'alert-type'=>'success'
        );

        return redirect()->route('home')->with($notification);
    }

}
