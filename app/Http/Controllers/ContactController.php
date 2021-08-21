<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Setting;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contactForm(){

        $setting = Setting::first();
        $contact_address = $setting->address;
        $addresses = explode(',', $contact_address);

        return view('pages.contact',compact('addresses'));

    }

    public function contact(Request $request){
        $request->validate([
            'name' => 'required|max:100|min:5',
            'phone' => 'required|regex:/(01)[0-9]{9}/',
            'email' => 'required|email',
            'message' => 'required|min:20|max:1000',
        ]);

        Contact::create($request->all());

        $noti = array(
            'messege' => 'Successfully Sent Message',
            'type' => 'success'
        );


        return back()->with($noti);
            
    }

    // Admin Section    

    public function allContact(){
        $all_contact = Contact::latest()->paginate(10);
        return view('admin.contact.contact',compact('all_contact'));
    }

    public function view($id){
        $message = Contact::find($id);
        if($message->status == null){
            $message->update(['status'=> 1]);
        }
        return view ('admin.contact.view',compact('message'));   
    }

    public function delete($id){
        Contact::find($id)->delete();
        $notification = array(
            'messege' => ' Successfully Delete Message',
            'type' => 'success',
        );

        return back()->with($notification);
    }
}
