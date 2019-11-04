<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sanpham;
use App\Danhmuc;
use Hash;
use Auth;
use AuthenticatesUsers;


class NguoidungController extends Controller
{
    //
    // use AuthenticatesUsers;
    public function GetTrangchu (){
        // dd(Auth::user());
    	$data['trending']=Sanpham::where('khuyen_mai','=',1)->take(12)->get();
    	$data['sale']=Sanpham::where('khuyen_mai','=',2)->take(12)->get();
    	$data['lastnew']=Sanpham::orderby('updated_at','desc')->take(16)->get();
        $a = Danhmuc::all();
        $b=[];

        foreach ($a as $value) {
        $sanpham=Sanpham::where('id_danh_muc',$value->id)->first();
         $b[]=[
            'tendanhmuc'=>$value->ten_danh_muc,
            // 'tenkhongdau'=>$value->ten_khong_dau,
            // 'tensanpham'=>$sanpham->ten_san_pham,
            'hinh'=>$sanpham->hinh,
            'iddanhmuc'=>$value->id,
         ]   ;
        }
        $data['slide']=$b;
        // dd($data['sanpham']);
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
            // $check = Hash::check($request->password,$user->password);
            if (Auth::attempt(['username' => $request->name, 'password' => $request->password])) {
    
                return redirect()->route('trangchu')->with('thanh-cong','dang nhap thanh cong');
                    }else {
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
    public function GetDangxuat(){
        Auth::logout();
        return redirect()->route('trangchu');
    }
    public function GetDonhang(){
        $data['tinh']=$this->GetTinh();
        return view('nguoidung.giohang.donhang',$data);
    }
    public function GetLayhuyen(Request $request){
        $data=$this->GetHuyen($request->id);
        return response()->json(['status'=>1,'data'=>$data]);
    }  
    public function GetLayxa(){
        
    }
    public function CallApi($url){
        // $data = array("name" => "Hagrid", "age" => "36");
        // $data_string = json_encode($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json'
        //          );

        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
    public function GetHuyen($b){
       
        if($b){
            $url= "https://thongtindoanhnghiep.co/api/city/".$b."/district";
            $a=$this->CallApi($url);
            $data=json_decode($a,true);
            $c=[];
            foreach ($data as $value) {
                $c[]=[
                'Id'=>$value['ID'],
                'Title'=>$value['Title'],

                ];
            }
          
            return $c;

        }

    }

        public function GetXa($b){
        
        if($b){
            
            $url= "https://thongtindoanhnghiep.co/api/district/".$b."/ward";
            $a=$this->CallApi($url);
            $data=json_decode($a,true);
            $c=[];
            foreach ($data as $value) {
                $c[]=[
                'Id'=>$value['ID'],
                'Title'=>$value['Title'],

                ];
            }
            
            return $c;

        }

    }
    public function GetTinh (){
       $a=$this->CallApi('https://thongtindoanhnghiep.co/api/city');
       $data=json_decode($a,true);
       $data=$data['LtsItem'];
       $b=[];
    
       foreach ($data as $value) {
           $b[]=[
                'Id'=>$value['ID'],
                'Title'=>$value['Title'],
           ];
       }
       return $b;
    }
    public function Test(){
       $a =$this->GetXa();
       // dd($a);
    }
    public function Xoasesstion(){
        session()->flush();
        
    }
}
