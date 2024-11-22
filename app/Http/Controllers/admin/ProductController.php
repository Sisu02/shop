<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function getproducts(){
        if(Auth::check())
        {
            return view('admin.products', ['user' => auth()->user()]);
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
    }
    public function addproducts(){
        if(Auth::check())
        {
            $categories = Category::all();
            return view('admin.addproducts', ['user' => auth()->user(),'cat'=>$categories]);
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
    }
    public function getSubcategories($categoryId) { 
        $subcategories = Subcategory::where('category_id', $categoryId)->get(); 
        return response()->json(['subcategories' => $subcategories]); 
    }
    public function addproduct(request $request){
        // dd($request);
        if ($request->hasFile('f_image')){
            // echo "true";
            $file=$request->hasFile('f_image');
            $image = time().'.'.$file->getClientOriginalExtension();
            echo $image;
        }
    }
}
