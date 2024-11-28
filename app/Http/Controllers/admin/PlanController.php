<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(){
        return view('admin.plans');
    }
    public function addplans(){
        return view('admin.addplans');
    }
    public function insertplan(request $request){
        dd($request);
    }
}
