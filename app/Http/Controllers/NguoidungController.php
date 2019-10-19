<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sanpham;
use Hash;
use Auth;


class NguoidungController extends Controller
{
    //
    public function GetTrangchu (){
        dd(Auth::user());
    	$data['trending']=Sanpham::where('khuyen_mai','=',2)->take(8)->get();
    	$data['sale']=Sanpham::where('khuyen_mai','=',1)->take(8)->get();
    	$data['lastnew']=Sanpham::orderby('updated_at','desc')->take(8)->get();
    	return view('nguoidung.layouts.sitemain',$data);

    	
    }
    public function GetLoadmore (Request $request){
    	if($request->page){
    		$skip=$request->page*8;
    		$sanpham=Sanpham::take(8)->skip($skip)->get();
    		return response()->json($sanpham);
    	}
    }

    public function GetDesc(Request $request){
        if(!$request->page){
              $skip=0;  
        } else {
            $skip=$request->page*9;
        }
        
                $sanpham=Sanpham::where('id_danh_muc',$request->iddanhmuc)->orderBy('gia','desc')->take(9)->skip($skip)->get();
                return response()->json($sanpham);
    }
    public function GetAsc(Request $request){
        if(!$request->page){
                $skip=0;  
        } else {
            $skip=$request->page*9;
        }
        
                $sanpham=Sanpham::where('id_danh_muc',$request->iddanhmuc)->orderBy('gia','asc')->take(9)->skip($skip)->get();
                return response()->json($sanpham);
    }

    public function GetDangnhap() {

        return view('nguoidung.taikhoan.dangnhap');
    }

     public function GetDangky() {
        
        return view('nguoidung.taikhoan.dangky');
    }
    public function PostDangnhap(Request $request) {
            $user = User::where('username',$request->name)->where('type','2')->first();
            if(!$user){
                 return back()->with('that-bai','sai tai khoan');
            }
            $check = Hash::check($request->password,$user->password);
              
            if($check){
                return redirect()->route('trangchu')->with('thanh-cong','dang nhap thanh cong');
            } else {
                return back()->with('that-bai','sai mat khau');
            }
    }
    public function PostDangky(Request $request) {
            $user = new User;
            $user->username = $request->name;
            $user->email = $request->email;
            $user->password=   bcrypt($request->password);
            $user->save();
            return back()->with('thanh-cong','Tao thanh cong');


        
    }

}
