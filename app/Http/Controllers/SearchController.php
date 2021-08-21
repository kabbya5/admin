<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\shipping;
use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\User;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\Validator;
class SearchController extends Controller
{

    // user section

    public function ajaxSearch(Request $request){

        $search = $request->input('product_search');
        $search_products = Product::query()->where('product_name','LIKE',"%".$search."%")
                    ->orWhere('product_code',"LIKE",'%'.$search.'%')->latest()->paginate(15);
       

        return view('pages.search',compact('search_products'));
    }


    // admin section
    public function adminSearch(Request $request)
    {
       $searchResults = (new Search())
            ->registerModel(Product::class, 'product_name')
            ->registerModel(Shipping::class, 'phone','email','fname','order_id','lname','bkash_number')
            ->registerModel(OrderDetails::class, 'order_id')
            ->registerModel(Order::class, 'order_code')
            ->registerModel(User::class, 'username','name')
            ->perform($request->input('query'));

        return view('admin.search', compact('searchResults'));
    }
    
}
