<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\PaymentSetting;
use App\Models\Setting;
use Image;

class OtherController extends Controller
{

    // site settign

    public function setting(){
        $setting = Setting::first();
        return view('admin.siteSetting.index',compact('setting'));
    }
    public function settingCreate(Request $request){
        $request->validate([
            'vat'   => 'required',
            'shipping_charge'   => 'required',
            'name'   => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'address'   => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|',
            

        ]);
        $setting = new Setting;  
        $setting->vat =  $request->vat; 
        $setting->shipping_charge =  $request->shipping_charge; 
        $setting->name =  $request->name; 
        $setting->email =  $request->email; 
        $setting->phone =  $request->phone; 
        $setting->phone2 =  $request->phone2; 
        $setting->address =  $request->address; 
        $setting->facebook_url =  $request->facebook_url;

        $img = $request->file('logo');

        if($img){
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/setting/'.$img_name));
            $setting->logo = 'media/setting/'.$img_name;                                          
        }

        $update = $setting->save();
        
        $notification = array(
            'messege' => " Successfully Site Setting Create",
            'type'   => " success",
        );
        return back()->with($notification);
    }

    public function settingUpdate(Request $request, $id){
        $request->validate([
            'vat'   => 'required',
            'shipping_charge'   => 'required',
            'name'   => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'address'   => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|',

        ]);

        $setting = Setting::find($id);

        $old_logo = $request->old_logo; 

        $setting->vat =  $request->vat; 
        $setting->shipping_charge =  $request->shipping_charge; 
        $setting->name =  $request->name; 
        $setting->email =  $request->email; 
        $setting->phone =  $request->phone; 
        $setting->phone2 =  $request->phone2; 
        $setting->address =  $request->address; 
        $setting->facebook_url =  $request->facebook_url;
        
        $img = $request->file('logo');

        if($img && $old_logo){
            unlink($old_logo);
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/setting/'.$img_name));
            $setting->logo = 'media/setting/'.$img_name;      
        }elseif($img){
            $img_name= date('dmy_H_s_i').'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('/media/setting/'.$img_name));
            $setting->logo = 'media/setting/'.$img_name; 
        }
        $setting->update();
        
        $notification = array(
            'messege' => " Successfully Site Setting Updated",
            'type'   => " success",
        );

        return back()->with($notification);
    }
    
    
    // Seo Setting 
    public function show(){
        $seo = Seo::first();
        return view('admin.seo_setting.index',compact('seo'));
    }
    public function create(Request $request){
        $request->validate([
            'meta_title' => 'required',
            'meta_author' => 'required',
            'meta_tag'   => 'required',
            'meta_description' => 'required',
        ]);
        Seo::create($request->all());
        $notification = array(
            'messege' => " Successfully seo Added",
            'type'   => " success",
        );

        return back()->with($notification);
    }
    public function update(Request $request,$id){
        $request->validate([
            'meta_title' => 'required',
            'meta_author' => 'required',
            'meta_tag'   => 'required',
            'meta_description' => 'required',
        ]);
        Seo::find($id)->update($request->all());
        $notification = array(
            'messege' => " Successfully SEO Update",
            'type'   => " success",
        );

        return back()->with($notification);
    }
    // payment setting
    public function index(){
        $payment_setting = PaymentSetting::first();
        return view('admin.payment_setting.index',compact('payment_setting'));
    }
    public function paymentCreate(Request $request){
        $request->validate([
            'pnumber_one' => 'required|regex:/(01)[0-9]{9}/',
            'pnumber_text'   => 'required',
            'anumber' => 'required|regex:/(01)[0-9]{9}/',
            'anumber_text' => 'required',
        ]);
        PaymentSetting::create($request->all());
        $notification = array(
            'messege' => " Successfully SEO Update",
            'type'   => " success",
        );

        return back()->with($notification);
    }
    public function paymentEdit($id){
        $payment_setting = PaymentSetting::find($id);
        return view('admin.payment_setting.update',compact('payment_setting'));
    }
    public function PaymentUpdate(Request $request,$id){
        $request->validate([
            'pnumber_one' => 'required|regex:/(01)[0-9]{9}/',
            'pnumber_text'   => 'required',
            'anumber' => 'required|regex:/(01)[0-9]{9}/',
            'anumber_text' => 'required',
        ]);
        PaymentSetting::find($id)->update($request->all());
        $notification = array(
            'messege' => " Successfully Payment Setting Update",
            'type'   => " success",
        );

        return back()->with($notification);
    }
    public function paymentDestroy($id){
        PaymentSetting::find($id)->delete();
        $notification = array(
            'messege' => " Successfully Payment Setting Delete",
            'type'   => " success",
        );

        return back()->with($notification);
    }
}
