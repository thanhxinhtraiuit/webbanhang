<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Danhmuc;

class DanhmucController extends Controller
{
    public function GetDanhsach(){
    	$data['danhmuc'] = Danhmuc::all();
    	return view('admin.danhmuc.danhsachdanhmuc',$data);
    }

    public function GetThemdanhmuc(){
    	return view('admin.danhmuc.themdanhmuc');
    }
    public function PostThemdanhmuc(Request $request){
    	$danhmuc = new Danhmuc;
    	$danhmuc->ten_danh_muc = $request->tendanhmuc;
    	$danhmuc->save();
    	return redirect()->route('danhsachdanhmuc');
    }
    public function PostSuadanhmuc($id , Request $request){
    	$danhmuc = Danhmuc::find($id);
    	$danhmuc->ten_danh_muc=$request->tendanhmuc;
    	$danhmuc->save();
    	return redirect()->route('danhsachdanhmuc');
    }

    public function GetSuadanhmuc($id ){
    	$danhmuc['danhmuc'] = Danhmuc::find($id);
    	return view('admin.danhmuc.suadanhmuc',$danhmuc);
    }
    public function GetXoadanhmuc($id){
        $danhmuc = Danhmuc::find($id);
        $danhmuc->delete();
        return back();
    }
}
