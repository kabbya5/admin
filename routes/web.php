<?php

use Illuminate\Support\Facades\Route;


//User section
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController ;
use App\Http\Controllers\CommentReplyController ;

use App\Http\Controllers\WelcomeController ;
use App\Http\Controllers\ShopController;

use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;


//staff
use App\Http\Controllers\Staff\StaffDashboardController;

// AdminController
use App\Http\Controllers\Admin\AdmindashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\OtherController;
use App\Models\SubCategory;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserproductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/comment/{product}', [CommentController::class,'store'])->name('comment.store');
Route::post('/comment-reply/{comment}',[CommentReplyController::class,'store'])->name('reply.store');

// User section
Auth::routes(['verify' => true]);
// welcome controller 

Route::get('/',[App\Http\Controllers\WelcomeController ::class,'index'])->name('welcome.page');

// Shop Controller 

Route::get('/brand/product/{id}/{brand_name}/',[ShopController::class,'brandProduct'])->name('brand.products');
Route::get('/shop',[ShopController::class,'feauturedProduct'])->name('shop.page');
Route::get('/best/rated/products/',[ShopController::class,'bestRated'])->name('best.rated');
Route::get('trend/trproducts/',[ShopController::class,'trendProducts'])->name('trand.products');
Route::get('best/deal/trproducts/',[ShopController::class,'dealProducts'])->name('deal.products');


// Home Controller User Profile
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/upload/profile/img/',[HomeController::class,'storeProfileImage'])->name('profileImg.store');
Route::get('/profile/edit',[HomeController::class,'editProfile'])->name('edit.profile');
Route::put('/profile/update',[HomeController::class,'updateProfile'])->name('update.profile');
Route::get('/password-change',[HomeController::class,'changePassword'])->name('password.change');
Route::post('/password-update',[HomeController::class,'updatePassword'])->name('password.update');
Route::get('/user/logout/', [HomeController::class,'logout'])->name('user.logout');


// Contact controller

Route::get('/contact',[ContactController::class,'contactForm'])->name('contact.form');
Route::post('/contact',[ContactController::class,'contact'])->name('contact');

// ADD WISHLIST

Route::get('/add/wishlist/{id}/',[WishlistController::class,'addWishList']);
Route::get('user/wishlist/',[WishlistController::class,'wishlist'])->name('wishlist')->middleware('auth');
Route::get('user/wishlist/delete/{id}',[WishlistController::class,'delete'])->name('wishlist.delete')->middleware('auth');
//Add To Card Cart Controller
Route::get('/add/cart/{id}/',[CartController::class,'addCart']);
Route::get('/cart/show/',[CartController::class,'cartShow'])->name('cart');
Route::get('/check',[CartController::class,'check']);
// update quantity
Route::put('update/cart/item/',[CartController::class,'updateCart'])->name('update.cart');
//remove cart
Route::get('/remove/cart/{rowId}/',[CartController::class,'removeCart']);
Route::get('/cancle/cart',[CartController::class,'cancleCart'])->name('cancle.cart');
//chek out
Route::get('user/checkout/',[CartController::class,'checkout'])->name('user.checkout')->middleware('auth');
//apply coupon
Route::post('user/apply/coupon/',[CartController::class,'applyCoupon'])->name('apply.coupon');
Route::get('coupon/remove/',[CartController::class,'couponRemove'])->name('coupon.remove');

// Order Controller
//Order step
Route::get('orders/{id}/{slug}/',[OrderController::class,'viewOrder']);
Route::get('order/page',[OrderController::class,'OrderPage'])->name('order.page');
Route::post('order/create',[OrderController::class,'orderCreate'])->name('order.create');
Route::put('shipping/update/{id}/',[OrderController::class,'shippingUpdate']);


//Product Section
Route::post('/cart/product/add/{id}/',[UserproductController::class,'addCart'])->middleware('auth');
Route::get('/products/{slug}',[UserproductController::class,'productView'])->name('productView');
//quick view ajax
Route::get('/product/quickview/{id}/',[UserproductController::class,'quickView']);
//shop page
Route::get('/category/products/{id}/{name}/',[UserproductController::class,'catProduct'])->name('cat.products');
Route::get('/subcat/products/{id}/{sub_category}/',[UserproductController::class,'subcatProduct'])->name('subcat.product');

//Search Controller
Route::get('/autocomplete/search/input/',[SearchController::class,'ajaxSearch'])->name('auto.input');

// Sub Seller section
Route::group([
    'prefix' => 'staff',
    'namespace' => 'staff',
    'middleware' => ['auth', 'staff']
], function(){
    Route::get('/dashboard',[StaffdashboardController::class,'index'])->name('staff.dashboard');
});
//  Admin Section
Route::group([
    'prefix' => 'admin',
    'namespace' => 'admin',
    'middleware' => ['auth', 'admin']
], function(){
    Route::get('/dashboard',[AdmindashboardController::class,'index'])->name('admin.dashboard');
    //Add Category 
    Route::get('/categories',[CategoryController::class,'index'])->name('categories');
    Route::get('/create/catagory',[CategoryController::class,'create'])->name('add-category');
    Route::post('/store/catagory',[CategoryController::class,'store'])->name('store.category');
    Route::get('/category/edit/{category}',[CategoryController::class,'edit']);
    Route::put('/category/edit/{category}',[CategoryController::class,'update'])->name('update-category');
    Route::get('/category/delete/{category}/',[CategoryController::class,'destroy']);

    //Sub Category

    Route::get('/sub_categorys',[SubCategoryController::class,'index'])->name('sub_categories');
    Route::post('/store/sub_category',[SubCategoryController::class,'store'])->name('sub_category.store');
    Route::get('/sub_category/edit/{subcategory}',[SubCategoryController::class,'edit']);
    Route::put('/sub_category/edit/{subcategory}',[SubCategoryController::class,'update'])->name('sub_category.update');
    Route::get('/sub_category/delete/{subcategory}/',[SubCategoryController::class,'destroy']);
    Route::delete('/sub_category/delete/{subcategory}',[SubCategoryController ::class,'destroy']);

    
    // Bramd Contrller
    Route::get('/brands',[BrandController::class,'index'])->name('brands');
    Route::get('/create/brand',[BrandController::class,'create'])->name('brand.create');
    Route::post('/store/brand',[BrandController::class,'store'])->name('brand.store');
    Route::get('/brand/edit/{brand}',[BrandController::class,'edit']);
    Route::put('/brand/edit/{brand}',[BrandController::class,'update'])->name('brand.update');
    Route::get('/brand/delete/{brand}/',[BrandController::class,'destroy']);
    Route::delete('/brand/delete/{brand}',[BrandController::class,'destroy']);

    // Coupons Controller 

    Route::get('/coupons',[CouponsController::class,'index'])->name('coupons');
    Route::post('/store/coupon/',[CouponsController::class,'store'])->name('coupon.store');
    Route::get('/coupon/edit/{coupon}/',[CouponsController::class,'edit']);
    Route::put('/coupon/edit/{coupon}/',[CouponsController::class,'update'])->name('coupon.update');
    Route::get('/coupon/delete/{coupon}/',[CouponsController::class,'destroy']);
    Route::delete('/coupon/delete/{coupon}/',[CouponsController ::class,'destroy']);


    // Product Controller for only Admin

    Route::get('/all/products/',[ProductController::class,'allProduct'])->name('all.products');  
    Route::get('/product/{product}/approve/',[ProductController::class,'approve']);

    // UserRole

    Route::get('/users',[UserRoleController::class,'allUsers'])->name('all.users');
    Route::get('/users/view/{id}/',[UserRoleController::class,'userView'])->name('user.view');
    Route::get('/users/products/view/{id}/',[UserRoleController::class,'userProducts'])->name('user.products');
    Route::get('/users/orders/view/{id}/',[UserRoleController::class,'userOrders'])->name('user.orders');

    Route::get('/make/user/{id}/',[UserRoleController::class,'makeUser'])->name('user');
    Route::get('/make/seller/{id}/',[UserRoleController::class,'makeSeller'])->name('seller');
    Route::get('/make/admin/{id}/',[UserRoleController::class,'makeAdmin'])->name('admin');

    // fid all Seller and admin

    Route::get('/all/seller/',[UserRoleController::class,'allSeller'])->name('all.seller');
    Route::get('/all/admin/',[UserRoleController::class,'allAdmin'])->name('all.admin');

    // Contact controller
    Route::get('/all/contact/',[ContactController::class,'allContact'])->name('all.contact');
    Route::get('/message/view/{id}/',[ContactController::Class,'view'])->name('view.message');
    Route::get('/delete/contact/{id}',[ContactController::class,'delete'])->name('delete.message');

    // Search Controller Admin Search
    
    Route::get('/search',[SearchController::class,'adminSearch'])->name('admin.search');


    // Other Controller

    // Setting 

    Route::get('site/setting/' ,[OtherController::class,'setting'])->name('site.setting');
    Route::post('site/setting/create',[OtherController::class,'settingCreate'])->name('setting.create');
    Route::put('site/setting/update/{id}',[OtherController::class,'settingUpdate']);

    //Seo setting
    
    Route::get('/seo/setting/',[OtherController::class,'show'])->name('seo.show');
    Route::post('/seo/create/',[OtherController::class,'create'])->name('seo.create');
    Route::put('/seo/update/{id}/',[OtherController::class,'update'])->name('seo.update');

    // Payment Setting 

    Route::get('/payment/setting/',[OtherController::class,'index'])->name('payment.setting');
    Route::post('/payment/setting/create/',[OtherController::class,'paymentCreate'])->name('payment.create');
    Route::put('/payment/setting/update/{id}/',[OtherController::class,'paymentUpdate']);

    // Order Process // AdminOrderController
    Route::get('/all/order/',[AdminOrderController::class,'allOrder'])->name('all.order');
    Route::get('/padding/order/',[AdminOrderController::class,'newOrder'])->name('new.order');
    Route::get('/accept/order/',[AdminOrderController::class,'accept'])->name('accept.order');
    Route::get('/process/order/',[AdminOrderController::class,'process'])->name('process.order');
    Route::get('/delivery/order/',[AdminOrderController::class,'delivery'])->name('delivery.order');
    Route::get('/cancel/order/',[AdminOrderController::class,'cancel'])->name('cancle.order');

    Route::get('/view/order/{id}',[AdminOrderController::class,'viewOrder'])->name('view.order');

    Route::get('/accept/order/{id}/',[AdminOrderController::class,'acceptOrder']);
    Route::get('/delevery/process/{id}/',[AdminOrderController::class,'processOrder']);
    Route::get('/delevery/done/{id}/',[AdminOrderController::class,'deliveryOrder']);
    Route::get('/cancel/order/{id}/',[AdminOrderController::class,'cancelOrder']);

    //Delete Order

    Route::get('order/delete',[AdminOrderController::class,'deleteOrder'])->name('delete.order');
    Route::get('order/delete/{id}',[AdminOrderController::class,'delete'])->name('order_delete');
});
//  admin and subadmin Section  
Route::group([    
    'middleware' => ['auth','common']
], function(){
    Route::get('/auth/products/all',[ProductController::class,'index'])->name('product.auth');
    Route::get('/admin/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/admin/product/store',[ProductController::class,'store'])->name('store.product');
    Route::get('/admin/product/edit/{slug}/{id}',[ProductController::class,'edit']);
    Route::put('/admin/product/update/{id}',[ProductController::class,'update']);
    
    Route::get('/admin/product/delete/{slug}/{id}',[ProductController::class,'destroy']);
    Route::get('/admin/product/view/{id}',[ProductController::class,'show'])->name('product.view');

    // if image 4 is null and want to add

    Route::get('/admin/image_4/{product}/',[ProductController::class,'product_image_three']);
    Route::put('/admin/image_4/{product}',[ProductController::class,'productImageUpdate']);

    //Stock Management
    
    Route::get('/admin/stock/management/',[ProductController::class,'stockManagement'])->name('stock.management');

});


Route::get('get/subcategory/{id}',[ProductController::class,'GetSubcat']);



