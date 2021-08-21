<?php

namespace App\Providers;
use View;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('category',Category::all());
        View::share('setting',Setting::first());
        $setting = Setting::first();
        $contact_address = $setting->address;
        View::share('addresses',explode(',', $contact_address));


        //addmin section
        $new_message = Contact::where('status',0)->get();
        View::share('new_message',$new_message);
        
        $new_orders = Order::where('view', 0)->get();
        View::share('new_orders',$new_orders);

    }
}
