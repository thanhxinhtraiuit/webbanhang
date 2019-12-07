<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sanpham;
use App\Danhmuc;
use App\GioHang;
use App\Hoadon;
use App\Chitiethoadon;
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

    public function GetLayhuyen(Request $request){
        $data=$this->GetHuyen($request->id);
        return response()->json(['status'=>1,'data'=>$data]);
    }  
    public function GetLayxa(Request $request){
        $data=$this->GetXa($request->id);
        return response()->json(['status'=>1,'data'=>$data]);
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

    public function GetDonhang(){
        if(!Auth::check()){return redirect()->route('dangnhap');}
        $data['tinh']=$this->GetTinh();
        
      
        $data['giohang']=$this->GetGiohangDB();
       
        $data['tongtien']=$this->Tongtien();
        return view('nguoidung.giohang.donhang',$data);
    }

    public function PostDonhang(Request $request){
        $hoadon = new Hoadon;
        $hoadon->id_nguoi_dung=Auth::user()->id;
        $hoadon->tongtien=$this->tongtien()-30000;
        $hoadon->ho_ten=$request->ten;
        $hoadon->sdt =$request->sdt;
        $hoadon->email=$request->email;
        $hoadon->dia_chi=$request->tinh."-".$request->huyen."-".$request->xa."-".$request->diachi;
        $hoadon->save();

        $giohang=$this->GetGiohangDB();

        foreach ($giohang as $value) {
            $chitiethoadon =new Chitiethoadon;
            $chitiethoadon->id_hoa_don=$hoadon->id;
            $chitiethoadon->id_san_pham=$value['sanpham']->id;
            $chitiethoadon->so_luong=$value['sl'];
            $chitiethoadon->tong_tien=$value['sanpham']->gia*$value['sl'];
            $chitiethoadon->save();
        }

        //send mail

        $noidung = null;
        foreach ($giohang as $value) {
             $noidung .= '<tr>
                     <td style="padding-top:5px;padding-bottom:5px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="50%">
                        <div style="color:#3c4043;margin:0px;font-size:12px;line-height:22px;font-weight:normal;font-size:15px;padding-right:10px">
                           '.$value['sanpham']->ten_san_pham.'
                        </div>
                     </td>
                     <td style="padding-top:5px;padding-bottom:5px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="50%">
                        <div style="color:#3c4043;margin:0px;font-size:12px;line-height:22px;font-weight:normal;font-size:15px">
                           '.$value['sl'].'
                        </div>
                     </td>
                  </tr>';
        }
        $noidung .= '<tr>
                     <td style="padding-top:5px;padding-bottom:5px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="50%">
                        <div style="color:#3c4043;margin:0px;font-size:12px;line-height:22px;font-weight:bold;font-size:15px;padding-right:10px">
                           Tổng cộng
                        </div>
                     </td>
                     <td style="padding-top:5px;padding-bottom:5px;font-size:14px;font-family:Helvetica Neue,Arial,sans-serif;color:#3c4043;text-align:left;line-height:1.55em" width="50%">
                        <div style="color:#3c4043;margin:0px;font-size:12px;line-height:22px;font-weight:bold;font-size:15px">
                           '.number_format($hoadon->tongtien).'đ
                        </div>
                     </td>
                  </tr>';

            $contents = \File::get("mau-mail.html");

            $diachi = $hoadon->dia_chi;
            $thoigian = $hoadon->created_at;
            $khoanthanhtoan = number_format($this->tongtien())."đ";
            // $to = "";
             
             $contents=str_replace("{&noidung}", $noidung, $contents);
             $contents=str_replace("{&diachi}", $diachi, $contents);
             $contents=str_replace("{&thoigian}", $thoigian, $contents);
             $contents=str_replace("{&khoanthanhtoan}", $khoanthanhtoan  , $contents);
       

        $guiMail = new GuimailController;
       $a1 =  $guiMail->sendEmail($request->email,$request->ten,"Xac nhan don Hàng",$contents);
        $a2 = $guiMail->sendEmail("thanh147zz@gmail.com","adminpro","Hoá đơn người mua hàng",$contents);

        return "thanh cong $a1 - $a2";
    }


    public function GetGiohangDB(){
        $giohang = GioHang::where('id_nguoi_dung',Auth::user()->id)->get();
        // echo $giohang;die;
        if(empty($giohang)){
            return redirect()->route('trangchu');
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
