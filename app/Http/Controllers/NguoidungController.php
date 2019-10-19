<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sanpham;

class NguoidungController extends Controller
{
    //
    public function GetTrangchu (){
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
}
