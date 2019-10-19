<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sanpham ;
use App\Danhmuc ;
class SanphamController extends Controller
{
    public function GetThemsanpham(){
        $data['data']=Danhmuc::all();
    	return view('admin.sanpham.themsanpham',$data);
    }
    public function PostThemsanpham(Request $request){
    	
    	$sanpham = new Sanpham;
    	$sanpham->ten_san_pham = $request->tensanpham;
    	$sanpham->ten_khong_dau = str_slug($request->tensanpham);
    	$sanpham->mo_ta = $request->mota;
        $sanpham->khuyen_mai=$request->khuyenmai;
    	$sanpham->gia = $request->gia;
    	$sanpham->id_danh_muc = $request->loai;

    	if($request->hasFile('hinh')){
		    	$img = $request->file('hinh');
				$img_name = str_random(4)."-".$img->getClientOriginalName();
				
				$img->move('upload',$img_name);
				$sanpham->hinh = $img_name;
				}
				

    	$sanpham->save();
    	return redirect()->route('danhsachsanpham');

    }
    public function Getdanhsach(){
    	$data['danhsach'] = Sanpham::all();

    	return view('admin.sanpham.danhsachsanpham',$data);
    }
    public function GetEdit($id){
    	$sanpham['data'] = Sanpham::find($id);
        $sanpham['danhmuc']=Danhmuc::all();
    	return view('admin.sanpham.suasanpham',$sanpham);
    }
    public function PostEdit($id,Request $request){
    	
    	$sanpham = Sanpham::find($id); 
    	$sanpham->ten_san_pham = $request->tensanpham ;
    	$sanpham->gia = $request->gia;
    	$sanpham->id_danh_muc = $request->loai;
    	$sanpham->mo_ta= $request->mota;
        $sanpham->Khuyen_mai=$request->khuyenmai;
    	$sanpham->ten_khong_dau = str_slug($request->tensanpham);

    	if($request->hasFile('hinh')){
		    	$img = $request->file('hinh');
				$img_name = str_random(4)."-".$img->getClientOriginalName();
				
				$img->move('upload',$img_name);
				$sanpham->hinh = $img_name;
				}
				// dd($request->file('hinh'));
		$sanpham->save();
		return redirect()->route('danhsachsanpham');		
    }
    public function Delete($id){
    	$sanpham=Sanpham::find($id);
    	$sanpham->delete();
    	return back();
    }
    public function GetChitietsanpham($id,$ten_khong_dau){
        // dd($id);
        $data['sanpham']=Sanpham::select('sanpham.*','danhmuc.ten_danh_muc')
        ->join('danhmuc','id_danh_muc','danhmuc.id')
        ->where('sanpham.id',$id)->first();
        if(!$data['sanpham']) return abort(404);
        
        return view('nguoidung.sanpham.chitietsanpham',$data);
    }
    public function GetListsanpham($id){
        $danhmuc=Sanpham::where('id_danh_muc',$id)->get();
        $data['danhmuc'] = $danhmuc;
        $data['iddanhmuc']=$id;
        return view('nguoidung.sanpham.danhsachsanpham',$data);

    }
}
