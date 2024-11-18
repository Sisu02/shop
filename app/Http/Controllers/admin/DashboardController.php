<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{


    public function index()
    {
        if(Auth::check())
        {
            return view('admin.dashboard', ['user' => auth()->user()]);
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
    }
}
