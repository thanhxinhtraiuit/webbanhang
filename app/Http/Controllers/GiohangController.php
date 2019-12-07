<?php

namespace App\Http\Controllers;
use Session;
use App\Sanpham;
use App\GioHang;
use Auth;
use Illuminate\Http\Request;

class GiohangController extends Controller
{

    public function GetGiohang(){
          // Session::forget('giohang'); 
        $sanpham=null;
    	if(!Auth::check()){

        $sanpham=$this->GetGiohangSS(); 

        }else {

        $sanpham=$this->GetGiohangDB();
            
        }
         $data['giohang']=$sanpham;
//echo($sanpham);die;
         if(!$sanpham){
             //dd('abc');
            return redirect()->route('trangchu');
         }

        return view('nguoidung.giohang.giohang',$data);

    }
    
    public function GetGiohangDB(){
        $giohang = GioHang::where('id_nguoi_dung',Auth::user()->id)->get();
        // echo $giohang;die;
        if(empty($giohang)){
             return false;
        }
        $sanpham= [];
        foreach ($giohang as  $value) {
            
            $sanpham[]=[
               'sanpham' =>Sanpham::find($value->id_san_pham),
               'sl'=>$value->so_luong,

        ];
        
     
        
    }
         return $sanpham;
    }
    private function GetGiohangSS(){
        $giohang=Session::get('giohang');
      // dd($giohang);die;
        $sanpham= [];
        if(empty($giohang)){

            return false;
        }
        foreach ($giohang as  $value) {
            $sanpham[]=[
               'sanpham' =>Sanpham::find($value['id']),
               'sl'=>$value['sl'],

        ];
   

        }
         return $sanpham;
    }
    public function ThemGiohang(Request $request){
        // Session::forget('giohang'); die();
        if (!Auth::check()){
            $this->ThemGioHangSS($request->id,$request->gia);
    	}
        else {
            $this->ThemGioHangDB($request->id,$request->gia);
        }
    }
    public function ThemGioHangDB($id,$gia){
            $giohang = GioHang::where('id_nguoi_dung',Auth::user()->id)
            ->where('id_san_pham',$id)
            ->first();
            if($giohang){
                $giohang->so_luong=$giohang->so_luong+1;
                $giohang->save();
            }else {
                $giohang=new GioHang;
                $giohang->id_san_pham=$id;
                $giohang->id_nguoi_dung=Auth::user()->id;
                $giohang->gia=$gia;
                $giohang->so_luong=1;
                $giohang->save();
            }


    }
    public function ThemGioHangSS($id,$gia){
        if ($id) {
            $giohang=Session::get('giohang');
            // dd($giohang);
            if(count($giohang)>0){
            foreach ($giohang as $key => $value) {
                if($id==$value['id']){
                    $giohang[$key] = [
                        'id'=>$value['id'],
                        'sl'=>$value['sl']+1,
                        'gia'=>$gia,];
                        Session::put('giohang',$giohang);
                        return Session::get('giohang');
                       }

            }
            }
            $giohang[] = [
                'id'=>$id,
                'sl'=>1,
                'gia'=>$gia,
            ]  ;
            

            
            Session::put('giohang',$giohang);
            return Session::get('giohang');
            }

    }

    public function XoaGiohang(Request $request){
        if(!Auth::check()){
    	$giohang = Session::get('giohang');
    		// print_r($giohang); echo "<br>";
            foreach ($giohang as $key => $value) {
              if($value['id']==$request->key)
                unset($giohang[$key]);
            }
    		
    		Session::put('giohang',$giohang);
    	}else {
           $giohang=GioHang::where('id_nguoi_dung',Auth::user()->id)
           ->where('id_san_pham',$request->key)
           ->first();

           $giohang->delete();  
        }
    }

    public function GetTonggiohang(){
        if(!Auth::check()){
    	$giohang=Session::get('giohang');
    	return count($giohang);
        }else {
            $giohang=GioHang::where('id_nguoi_dung',Auth::user()->id)->count();
            return $giohang;
        }
    }

    public function Tongtien(){
        if(!Auth::check()){
        $data=Session::get('giohang');
        $sum=0;
        foreach ($data as $value) {
           $sum+=$value['gia']*$value['sl'];
        }
        return $sum;
        }else {
            $sum=0;
            $giohang=GioHang::where('id_nguoi_dung',Auth::user()->id)->get();
            foreach ($giohang as $value) {
                $sum+=$value->gia*$value->so_luong;
            }
            return $sum;
        }
    }
    
   
}
