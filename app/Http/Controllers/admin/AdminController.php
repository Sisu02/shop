<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function register(){
           return view('register');
    }
    public function registeruser(request $request){
        $request->validate([
            'password' => 'min:6',
            'cpassword' => 'required_with:password|same:password|min:6'
        ], [
            'f_name.required'=> 'Your First Name is Required', // custom message
            'f_name.min'=> 'First Name Should be Minimum of 8 Character', // custom message
            'l_name.required'=> 'Your Last Name is Required' // custom message
           ]);
            // dd($request);
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }
    public function login(){
            return view('login');
    }
    public function checklogin(request $request){
                // dd($request);
                $cred=$request->only('email','password');
                if (Auth::attempt($cred)) {
                    return redirect('/dashboard')->with('success', 'Login Success');
                    }
                    return back()->with('error', 'Email or Password incorrect');
    }
    public function logout(){
        Auth::logout();
        return redirect('/login');
}

}
