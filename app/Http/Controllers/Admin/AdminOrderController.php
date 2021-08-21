<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class AdminOrderController extends Controller
{

    public function allOrder(){
        $orders = Order::latest()->paginate(5);
        return view('admin.order.all_order',compact('orders'));
    }
    public function newOrder(){
        $orders = Order::where('status', 0)->paginate(10);
        return view('admin.order.new_order',compact('orders'));
    }
    public function accept(){
        $orders = Order::where('status',1)->get();
        return view('admin.order.accept_order',compact('orders'));
    }
    public function process(){
        $orders = Order::where('status',2)->get();
        return view('admin.order.process_order',compact('orders'));
    }
    public function delivery(){
        $orders = Order::where('status',3)->get();
        return view('admin.order.delivery_order',compact('orders'));
    }
    public function cancel(){
        $orders = Order::where('status',4)->get();
        return view('admin.order.cancle_order',compact('orders'));
    }

    public function viewOrder($id){

        $order = Order::join('users','orders.user_id','users.id')
                    ->select('orders.*','users.name','users.email')
                    ->where('orders.id',$id)->first();
                    
        $order->update(['view' => 1]);
        
        $shipping = Shipping::where('order_id', $id)->first();

        $details = OrderDetails::join('products','order_details.product_id','products.id')
                                ->select('order_details.*','products.product_code','products.main_img')
                                ->where('order_details.order_id',$id)->get();
            
        return view('admin.order.order_detail',compact('order','shipping','details'));

    }

    public function acceptOrder($id){
        Order::find($id)->update(['status' => 1]);
        $notification = array(
            'messege' => " Order Accept Done",
            'type'   => " success",
        );

        return Redirect()->back()->with($notification);
    }
    
    public function processOrder($id){
        Order::find($id)->update(['status' => 2]);
        $notification = array(
            'messege' => " Order process Done",
            'type'   => " success",
        );

        return Redirect()->back()->with($notification);
    }
    public function deliveryOrder($id){

        $product = OrderDetails::where('order_id',$id)->get();
        foreach($product as  $item){
            Product::where('id',$item->product_id)
            ->update(['product_quantity' => DB::raw('product_quantity-'.$item->quantity)]); 
        }
        Order::find($id)->update(['status' => 3]);
        $notification = array(
            'messege' => " Order Delivery Done",
            'type'   => " success",
        );

        return Redirect()->back()->with($notification);
    } 
    public function cancelOrder($id){
        Order::find($id)->update(['status' => 4]);
        $notification = array(
            'messege' => " Order Cancel Done",
            'type'   => " success",
        );

        return Redirect()->back()->with($notification);
    } 



    // Delete order after 1 years
    public function deleteOrder(){
        $orders = Order::paginate(6);
        return view('admin.order.order_delete',compact('orders'));
    }
    public function delete ($id){
        $delete_order = Order::find($id);
        $delete_order->delete();
        $order_detalils_delete = OrderDetails::where('order_id',$id)->get();
        foreach($order_detalils_delete as $delete){
            $delete->delete();
        }
        Shipping::where('order_id',$id)->delete();
        $notification = array(
            'messege' => " Order Delete Done",
            'type'   => " success",
        );

        return Redirect()->back()->with($notification);
        
    }
}
