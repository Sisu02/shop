<?php

namespace App\Http\Controllers\admin;
use App\Models\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class CouponController extends Controller
{
    public function index(){
        $coupons=Coupon::paginate(5);
        return view('admin.coupons',['user' => auth()->user(),'coupon'=>$coupons]);
    }
    public function addcoupon(){
        return view('admin.addcoupon',['user' => auth()->user()]);
    }
    public function couponset(request $request){
        $request->validate([
            'cname'=>'required|min:3|alpha_dash',
            'description'=>'required',
            'coupon_type'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'coupon_type'=>'required',
        ],[
            'cname.required'=>'Name field cannot be empty',
            'cname.alpha_dash'=>'Name field space not allowed',
            'cname.min'=>'Name field more than 3 alphabet',
            'description.required'=>'Description field cannot be empty',
            'coupon_type.required'=>'Type field cannot be empty',
            'sdate.required'=>'Type field cannot be empty',
            'edate.required'=>'Type field cannot be empty',
        ]);
        // dd($request);
        // $amount=0;
        if($request->coupon_type=="flat"){
            $amount=$request->famount;
        }
        else if($request->coupon_type=="percentage"){
            $amount=$request->pamount; 
        }
        Coupon::create([
            'name'=>$request->cname,
            'description'=>$request->description,
            'type'=>$request->coupon_type,
            'amount'=>$amount,
            'price'=>$request->price,
            'start_date'=>$request->sdate,
            'end_date'=>$request->edate,
        ]);
        return redirect('/addcoupons')->with('success', 'Coupon added successful');
    }
    public function editcoupon(request $request,$id){
        $get_coupon=Coupon::where('id',$id)->FirstorFail();
        // dd($get_coupon);
        return view('admin.editcoupon',['user' => auth()->user(),'coupon'=>$get_coupon]);
    }
    public function updatecoupon(request $request,$id){
        $request->validate([
            'cname'=>'required|min:3|alpha_dash',
            'description'=>'required',
            'coupon_type'=>'required',
            'sdate'=>'required',
            'edate'=>'required',
            'coupon_type'=>'required',
        ],[
            'cname.required'=>'Name field cannot be empty',
            'cname.alpha_dash'=>'Name field space not allowed',
            'cname.min'=>'Name field more than 3 alphabet',
            'description.required'=>'Description field cannot be empty',
            'coupon_type.required'=>'Type field cannot be empty',
            'sdate.required'=>'Type field cannot be empty',
            'edate.required'=>'Type field cannot be empty',
        ]);
        // dd($request);
        if($request->coupon_type=="flat"){
            $amount=$request->famount;
        }
        else if($request->coupon_type=="percentage"){
            $amount=$request->pamount; 
        }
        $coupon=Coupon::where('id',$id)->FirstorFail();
        $coupon->update([
            'name'=>$request->cname,
            'description'=>$request->description,
            'type'=>$request->coupon_type,
            'amount'=>$amount,
            'price'=>$request->price,
            'start_date'=>$request->sdate,
            'end_date'=>$request->edate,
        ]);
        return redirect()->route('editcoupon', $id)->with('success', 'Coupon updated successfully.'); 

    }
    public function deletecoupon($id){          
        $coupon = Coupon::findOrFail($id);
        $coupon->delete(); 
        return Redirect::route('coupons')->withInput()->with('success', 'Coupon deleted successfully.');
    }
    
}
