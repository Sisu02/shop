<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function getproducts(){
        $products=\App\Models\Product::paginate(5);
            return view('admin.products', ['user' => auth()->user(),'allproduct'=>$products]);
    }
    public function addproducts(){

            $categories = Category::all();
            return view('admin.addproducts', ['user' => auth()->user(),'cat'=>$categories]);
    }
    public function getSubcategories($categoryId) { 
        $subcategories = Subcategory::where('category_id', $categoryId)->get(); 
        return response()->json(['subcategories' => $subcategories]); 
    }
    public function addproduct(request $request){
        $request->validate([
            'name' => 'required|min:3',
            'f_image' => 'required|image|mimes:jpeg,png,jpg|max:10000', // Max 10MB
            'gallery_images' => 'required|array', // Ensure it's an array
            'gallery_images.*' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:10000', // Validate each file
        ],
        [
            'f_image.required'=>'Feature image is required',
            'gallery_images.required'=>'Gallery image is required',
        ]);
        $fimgname = null;
        $gallery = [];
        if ($request->hasFile('f_image')) { 
            $file = $request->file('f_image');
            $fimgname = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'),$fimgname);
        }     
        if ($request->hasFile('gallery_images')) {
            $file2 = $request->file('gallery_images');
            foreach ($file2 as $index => $item) {
                $gimgname = time() . '_' . $index . '_' . uniqid() . '.' . $item->getClientOriginalExtension();
                $item->move(public_path('images'), $gimgname);
                $gallery[] = $gimgname;
            }
        }
        $gal_images=implode("|",$gallery);
        // echo  $fimgname."and".$gal_images;

        \App\Models\Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'fimage' => $fimgname,
            'gimage' => $gal_images,
        ]);
        return redirect('/addproducts')->with('success', 'New product Added');
    }
    public function deleteproduct($id){
        $product = \App\Models\Product::findOrFail($id);
        File::delete(public_path('images/' . $product->fimage));
        $product->delete(); 
        if ($product->gimage) {
            $galleryImages = explode('|', $product->gimage); // Split the string into an array
            foreach ($galleryImages as $image) {
                File::delete(public_path('images/' . $image)); // Delete each image
            }
        }
        return Redirect::route('products')->withInput()->with('success', 'Subcategory deleted successfully.');
    }
    public function editproduct($id){
        // dd($id);            
            $product = \App\Models\Product::findOrFail($id);
           $cat_id=$product->category_id;
            $specific_subcat=\App\Models\Subcategory::where('category_id',$cat_id)->get();
            // dd($specific_subcat);
            $categories = Category::all();
            $subcategories = Subcategory::all();
            return view('admin.editproduct', ['user' => auth()->user(),'cat'=>$categories,'subcat'=>$specific_subcat,'current'=>$product]);
    }
    public function updateproduct(request $request,$id){
        $featured=0;
        if($request->f_image){
            $file=$request->f_image;
            $fimgname = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images'),$fimgname);
            $featured= $fimgname;
        }
        else{
            $featured= $request->fimage;
        }

        $arr=$request->gmg;
        // print_r($arr);
        if($request->gallery_images){
            $gfile=$request->gallery_images;
            // $g_array=array[];
            foreach($gfile as $index => $item){
                $gfile= time() . '_' . $index . '_' . uniqid() . '.' . $item->getClientOriginalExtension();
                $item->move(public_path('images'),$gfile);
                $arr[]=$gfile;
            }
            // print_r($arr);
            $newgal=implode('|',$arr);
            // echo $newgal;
        }
        else{
            $newgal=implode('|',$arr);
        }
        $product = Product::findOrFail($id); 
        $product->update([
            'category_id'=>$request->category,
            'subcategory_id'=>$request->subcategory,
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'description'=>$request->description,
            'fimage'=>$featured,
            'gimage'=>$newgal,
        ]);
        return redirect()->route('editproduct', $id)->with('success', 'Product updated successfully.');
        
    }
}
