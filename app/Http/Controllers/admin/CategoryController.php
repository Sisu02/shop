<?php

namespace App\Http\Controllers\admin;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function getcategory(){
        if(Auth::check())
        {
        $categories = Category::all();
        // return view ('categories')->with(compact('categories'));
            return view('admin.categories', ['user' => auth()->user()])->with(compact('categories'));
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
        
    }
    public function addcategory(){
        if(Auth::check())
        {
            return view('admin.addcategory', ['user' => auth()->user()]);
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
    }
    public function getsubcategory(){
        if(Auth::check())
        {
            return view('admin.subcategories', ['user' => auth()->user()]);
        }
        else{
            return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
        }
        
    }
    public function addcate(Request $request)
    {
        $request->validate([
            'cname' => 'required|string|min:3',
            'cimg' => 'required|image',
        ], [
            'cname.required' => 'We need to know name!',
            'cname.min' => 'Name must be more than 3 characters!',
            'cimg.required' => 'Please upload an image!',
            'cimg.image' => 'Uploaded file must be an image!',
        ]);
    

        if ($request->hasFile('cimg') && $request->file('cimg')->isValid()) {
            $imageName = time() . '.' . $request->file('cimg')->getClientOriginalExtension();
            $request->file('cimg')->move(public_path('images'), $imageName);
            Category::create([
                'name' => $request->cname,
                'description' => $request->description,
                'image' => $imageName,
            ]);
            return redirect('/addcategory')->with('success', 'Category Added');
        } else {
            return redirect('/addcategory')->with('error', 'Invalid or missing image.');
        }

    }
    
}
