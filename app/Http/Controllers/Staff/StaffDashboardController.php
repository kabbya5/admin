<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon; 
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderDetails;
use App\Models\Order;
use DB;
use Auth;

class StaffDashboardController extends Controller
{
    public function index(){

        $now = Carbon::now();
        $currentMonth = $now->format('F');

        //day  data 
        $today_order = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())
        ->whereDate('order_details.created_at',Carbon::today())
        ->get();
        $today_sales = $today_order->count();

        $yesterday_orders = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())
        ->whereDate('order_details.created_at',Carbon::yesterday())->get();

        $yesterday_sales = $yesterday_orders->count();
        //calculation
       
        if($today_sales == 0){
            $todayPerSales= 0.00; 
        }else{
            $todaySalesDiff =   $today_sales - $yesterday_sales;
            $perSalesDiff = ($todaySalesDiff / $today_sales) * 100;
            $todayPerSales = round($perSalesDiff,2);
        }
       
        //week data
        
        $currentWeek = $now->subDays(7);
        $currentWeek_orders = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())
        ->whereDate('order_details.created_at', '>=', $now->week())->get();
        
        $currentWeek_sales = $currentWeek_orders->count();

        $previous_week = strtotime("-1 week +1 day");
        $start_week = strtotime("last sunday midnight",$previous_week);
        $end_week = strtotime("next saturday",$start_week);
        $start_week = date("Y-m-d",$start_week);
        $end_week = date("Y-m-d",$end_week);

        $lastWeek_orders = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())->whereBetween('order_details.created_at',[$start_week, $end_week])->get();

        $lastWeek_sales = $lastWeek_orders->count();

        //calculation
       if(!$currentWeek_sales == 0){

            $weekSalesDiff =   $currentWeek_sales - $lastWeek_sales;
            $weekPerSalesDiff = ($weekSalesDiff/ $currentWeek_sales) * 100;
            $weekPerSales = round($weekPerSalesDiff,2);    
       }else{
        $weekPerSales = 0.00;
       }
      
        //Month data
        $currentMonth_orders = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())
        ->whereMonth('order_details.created_at', $now->month)->get();
        
        $currentMonth_sales = $currentMonth_orders->count();
        $currentMonth_amount = $currentMonth_orders->sum('subtotal');
 
        $lastMonth_orders = OrderDetails::join('products','products.id','order_details.product_id')
        ->select('products.seller_id','order_details.created_at')
        ->where('seller_id', Auth::id())
        ->whereMonth('order_details.created_at', '=', $now->subMonth()->month)->get();
        
        $lastMonth_sales = $lastMonth_orders->count();
        $lastMonth_amount = $lastMonth_orders->sum('subtotal');
 
        //calculation
        if(!$currentMonth_sales == 0){
 
            $monthSalesDiff =   $currentMonth_sales - $lastMonth_sales;
            $monthPerSalesDiff = ($monthSalesDiff/ $currentMonth_sales) * 100;
            $monthPerSales = round($monthPerSalesDiff,2);
           
        }else{
           $monthPerSales = 0.00;
        }

        if(!$currentMonth_amount == 0){
 
             $monthAmountDiff =   $currentMonth_amount - $lastMonth_amount;
             $monthPerSalesDiff = ($monthAmountDiff/ $currentMonth_amount) * 100;
             $monthPerAmount = round($monthPerSalesDiff,2);
            
        }else{
            $monthPerAmount = 0.00;
        }
        
        // Today order  
        
        $today_orders = OrderDetails::join('products','order_details.product_id','products.id')
        ->select('order_details.*','products.product_code','products.main_img','products.slug')
        ->whereDate('order_details.created_at', Carbon::today())->latest()->paginate();

        //top selling item 

        $topsales = DB::table('order_details')
        ->leftJoin('products','products.id','order_details.product_id')
        ->select('products.id','products.product_name','products.product_code','products.slug','products.selling_price', 'products.discount_price','products.main_img','order_details.product_id',
             DB::raw('SUM(order_details.quantity) as total'))
        ->groupBy('products.id','order_details.product_id','products.product_name','products.slug','products.product_code','products.selling_price', 'products.discount_price','products.main_img')
        ->orderBy('total','desc')
        ->paginate(10);

        $products = Product::all();
        $updatePro = Product::where('product_quantity', '<=', 10)->get();

        $users = User::count();
        // resent add user
        $newUsers = User::whereMonth('created_at', Carbon::now()->month)->count();

        $admin = User::where('role_id', 1 )->count();
    
        $seller = User::where('role_id', 2 )->count();
        // resent add user
        $newSeller = User::where('role_id', 2 )->whereMonth('created_at', Carbon::now()->month)->count();

   
        return view('staff.dashboard',compact(
            'currentMonth',
            'today_orders',
            'todayPerSales',
            'currentWeek_orders',
            'weekPerSales',
            'currentMonth_orders',
            'monthPerSales',
            'currentMonth_amount',
            'monthPerAmount',
            'today_orders',
            'topsales',
            'products',
            'updatePro',
            'users',
            'newUsers',
            'admin',
            'seller',
            'newSeller',
        ));
    }
}
