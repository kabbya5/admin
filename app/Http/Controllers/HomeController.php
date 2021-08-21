<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Order;
use Image;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $auth_id = Auth::id();

        $orders = Order::where('user_id', $auth_id)->latest()->paginate(6);

        return view('home',compact('orders'));

    }


    public function changePassword(){
        return view('auth.passwords.changepassword');
    }

    public function updatePassword(Request $request)
    {
    $password=Auth::user()->password;
    $oldpass=$request->oldpass;
    $newpass=$request->password;
    $confirm=$request->password_confirmation;
    if (Hash::check($oldpass,$password)) {
        if ($newpass === $confirm) {
            $user=User::find(Auth::id());
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::logout();  
            
            $notification=array(
            'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
            'alert-type'=>'success'
            );
            return Redirect()->route('login')->with($notification); 
           }else
           {
                $notification=array(
                'messege'=>'New password and Confirm Password not matched!',
                'alert-type'=>'error'
                );
                return Redirect()->back()->with($notification);
            }     
        }
        else{
        $notification=array(
            'messege'=>'Old Password not matched!',
            'alert-type'=>'error'
        );
        return Redirect()->back()->with($notification);
        }

    }

    public function storeProfileImage(Request $request){
        $request->validate([
        
            'profile_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|'
        ]);
        $data = array();
        $img = $request->file('profile_img');
        $user = User::find(Auth::id());
        $old_img = $user->profile_img;

        if($old_img){
            unlink($old_img);
            $img_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('media/user/'.$img_name));
            $data['profile_img'] = 'media/user/'.$img_name;
            User::find(Auth::id())->update($data);
        }else{
            $img_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(300,300)->save(public_path('media/user/'.$img_name));
            $data['profile_img'] = 'media/user/'.$img_name;
            User::find(Auth::id())->update($data);
        }


        
        
        
       
        $notification = array(
            'messege' => ' Successfully Image Added',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function editProfile(){
        $user = User::find(Auth::id());
        return view('auth.edit_profile',compact('user'));
    }

    public function updateProfile(Request $request,User $user){

        $request->validate([
            'name' => 'required|min:5|max:100',
            'username' => 'required|unique:users,id|min:5|max:150',           'phone' => 'required|numeric', 
            
        ]);


        $user = User::find(Auth::id());
        $user->update($request->all());

        $notification = array(
            'messege' => ' Successfully Update',
            'alert-type' => 'success'
        );

        return redirect()->route('home')->with($notification);

    }

    public function logout(){
        Auth::logout();
        $notification = array(
            'messege' => ' Successfully Logout',
            'alert-type' => 'success'
        );
        return redirect()->route('welcome.page')->with($notification);
    }
}
