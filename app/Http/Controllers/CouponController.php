<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends Controller
{
    public function GetDanhsach(){
    	$coupon = Coupon::all();
    	$data['danhsach']=$coupon;
    	return view ('admin.coupon.danhsachcoupon',$data);
    }
    
    public function PostThem(Request $request){
    	$coupon = new Coupon;
    	$coupon->code=$request->code;
    	$coupon->value=$request->value;
    	$coupon->soluong=$request->soluong;
    	$coupon->type=$request->type;
    	$coupon->hansudung=$request->hansudung;
    	$coupon->save();
    	return redirect()->route('themcoupon');
    	
    }
    public function GetThem(){
    	return view('admin.coupon.themcoupon');
    }
}
