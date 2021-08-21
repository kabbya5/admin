<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Wishlist;
use Auth;
use Carbon\Carbon;
class WishlistController extends Controller
{ 

     //show wishlist product
     public function wishlist(){   
        $total_wishlist = Wishlist::where('user_id', Auth::id())->get();   
        $user_id = Auth::id();
        $product = DB::table('wishlists')
                ->join('products','wishlists.product_id','products.id')
                ->select('products.*','wishlists.user_id','wishlists.product_id')
                ->where('wishlists.user_id',$user_id)->paginate(5);
        return view('pages.wishlist',compact('product','total_wishlist'));
    }


    public function addWishList($id){
        $user_id = Auth::id();
        $check = DB::table('wishlists')->where('user_id',$user_id)
                ->where('product_id',$id)->first();   
        $data = array(
            'user_id' =>$user_id,
            'product_id' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        );
        if (Auth::Check()) {    
            if ($check) {
                return \Response::json(['error' => 'Product Already Has on your wishlist']);	 
            }else{
                DB::table('wishlists')->insert($data);
                return response()->json(['success' => 'Product Added on Wishlist Successfully']);
            }                
        }else{
            return \Response::json(['error' => 'At first loing your account']);      
        } 
    } 
    public function delete($id){
        Wishlist::where('product_id',$id)->where('user_id',Auth::id())->delete();
        
        $notification = array(
            'messege' => 'Successfully Delelete Wishlist Data',
            'alert-type' => 'success'
        );
        return Redirect()->route('shop.page')->with($notification);
    }

   
}
