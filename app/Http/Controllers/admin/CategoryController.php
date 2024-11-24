<?php

namespace App\Http\Controllers\admin;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function getcategory(){
            $categories = Category::paginate(5);
            // return view ('categories')->with(compact('categories'));
                return view('admin.categories', ['user' => auth()->user()])->with(compact('categories'));     
    }
    public function addcategory(){
            return view('admin.addcategory', ['user' => auth()->user()]);
    }
    public function getsubcategory(){

            $subcategories =Subcategory::with('category')->paginate(5);
            // dd($subcategories);
            return view('admin.subcategories', ['user' => auth()->user(),'subcat'=>$subcategories]);
        
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
    public function editcategory($id){
         
            if(Auth::check())
            {
                $cat = Category::where('id', $id)->firstOrFail(); 
                return view('admin.editcategory', ['user' => auth()->user(), 'category'=>$cat]);
                // dd($cat);
               
            }
            else{
                return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
            }
            
    }
    public function updatecategory(Request $request,$id)
    {

        $request->validate([
            'cname' => 'required|string|min:3',
            'cimg' => 'image',
        ], [
            'cname.required' => 'We need to know name!',
            'cname.min' => 'Name must be more than 3 characters!',
            'cimg.image' => 'Uploaded file must be an image!',
        ]);
      
        $category = Category::findOrFail($id); 
        if ($request->hasFile('cimg') && $request->file('cimg')->isValid()) { 
            if ($category->image && File::exists(public_path('images/' . $category->image))) { 
                File::delete(public_path('images/' . $category->image));
             }
            $imageName = time() . '.' . $request->file('cimg')->getClientOriginalExtension(); 
            $request->file('cimg')->move(public_path('images'), $imageName); 
            $category->update([ 'name' => $request->cname, 'description' => $request->description, 'image' => $imageName, ]); 
            return redirect()->route('editcategory', $id)->with('success', 'Category updated successfully.'); 
        } 
        else { 
            $category->update([ 'name' => $request->cname, 'description' => $request->description, ]); 
            return redirect()->route('editcategory', $id)->with('success', 'Category updated successfully.'); 
        }

    }
    public function deletecategory($id){
              

            // $cat = Category::where('id', $id)->firstOrFail(); 
            // return view('admin.editcategory', ['user' => auth()->user(), 'category'=>$cat]);
            // dd($id);
            // \Log::info($request->all());
            $category = Category::findOrFail($id);
            File::delete(public_path('images/' . $category->image));
            $category->delete(); 
            // return Redirect::route('deletecategory',$id)->with('success', 'Category deleted successfully.');
            return Redirect::route('categories')->withInput()->with('success', 'Category deleted successfully.');
    }
    public function addsubcategory(){

        $categories = Category::all();
        return view('admin.addsubcategory', ['user' => auth()->user(),'cat'=>$categories]);
    }

    public function addsubcat(request $request){

        $request->validate([
            'cname' => 'required|string|min:3',
            'category' => 'required',
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
            Subcategory::create([
                'category_id' => $request->category,
                'name' => $request->cname,
                'description' => $request->description,
                'image' => $imageName,
            ]);
            return redirect('/addsubcategory')->with('success', 'Subategory Added');
        } else {
            return redirect('/addsubcategory')->with('error', 'Invalid or missing image.');
        }

    }
    public function editsubcategory($id){

            $subcat = Subcategory::where('id', $id)->firstOrFail(); 
            // dd($subcat);
            $categories = Category::all();
            return view('admin.editsubcategory', ['user' => auth()->user(),'cat'=>$categories,'subcat'=>$subcat]);
            // return Redirect::route('editsubcategories',['user' => auth()->user(),'cat'=>$categories])->withInput()->with('success', 'Category deleted successfully.');
    
    }
    public function updatesubcategory(Request $request,$id)
    {
        if(Auth::check())
        {
        $request->validate([
            'cname' => 'required|string|min:3',
            'cimg' => 'image',
        ], [
            'cname.required' => 'We need to know name!',
            'cname.min' => 'Name must be more than 3 characters!',
            'cimg.image' => 'Uploaded file must be an image!',
        ]);
      
        $subcategory = Subcategory::findOrFail($id); 
        if ($request->hasFile('cimg') && $request->file('cimg')->isValid()) { 
            if ($subcategory->image && File::exists(public_path('images/' . $subcategory->image))) { 
                File::delete(public_path('images/' . $subcategory->image));
             }
            $imageName = time() . '.' . $request->file('cimg')->getClientOriginalExtension(); 
            $request->file('cimg')->move(public_path('images'), $imageName); 
            $subcategory->update([ 'name' => $request->cname,'category_id' => $request->category,'description' => $request->description, 'image' => $imageName, ]); 
            return redirect()->route('editsubcategory', $id)->with('success', 'Subcategory updated successfully.'); 
        } 
        else { 
            $subcategory->update([ 'name' => $request->cname,'category_id' => $request->category,'description' => $request->description, ]); 
            return redirect()->route('editsubcategory', $id)->with('success', 'Subcategory updated successfully.'); 
        }
    }
    else{
        return Redirect::route('login')->withInput()->with('error', 'Please Login to access restricted area.');
    }
}
public function deletesubcategory($id){
              

        $subcategory = Subcategory::findOrFail($id);
        File::delete(public_path('images/' . $subcategory->image));
        $subcategory->delete(); 
        // return Redirect::route('deletecategory',$id)->with('success', 'Category deleted successfully.');
        return Redirect::route('subcategories')->withInput()->with('success', 'Subcategory deleted successfully.');
    }
}
