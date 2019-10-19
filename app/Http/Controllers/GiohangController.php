<?php

namespace App\Http\Controllers;
use Session;
use App\Sanpham;
use Illuminate\Http\Request;

class GiohangController extends Controller
{
    public function GetGiohang(){
          // Session::forget('giohang'); 
    	$giohang=Session::get('giohang');
        // $tongtien=0;
        // dd($giohang);
    	$sanpham= [];
    	if(empty($giohang)){
    		return redirect()->route('trangchu');
    	}
    	foreach ($giohang as  $value) {
    		$sanpham[]=[
               'sanpham' =>Sanpham::find($value['id']),
               'sl'=>$value['sl'],

        ];
        // $tongtien+=$value['gia']*$value['sl'];

    	}
    	$data['giohang']=$sanpham;
        // $data['sum'] = $tongtien;
        // dd($data['giohang']);
    	return view('nguoidung.giohang.giohang',$data);
    }
    public function ThemGiohang(Request $request){
        // Session::forget('giohang'); die();
    	if ($request->id) {
    		$giohang=Session::get('giohang');
            // dd($giohang);
            if(count($giohang)>0){
            foreach ($giohang as $key => $value) {
                if($request->id==$value['id']){
                    $giohang[$key] = [
                        'id'=>$value['id'],
                        'sl'=>$value['sl']+1,
                        'gia'=>$request->gia,];
                        Session::put('giohang',$giohang);
                        return Session::get('giohang');
                       }

            }
            }
    		$giohang[] = [
                'id'=>$request->id,
                'sl'=>1,
                'gia'=>$request->gia,
            ]  ;
            

    		
    		Session::put('giohang',$giohang);
            return Session::get('giohang');
    	}
    }
    public function XoaGiohang(Request $request){
    	// $key=$request->key;
    	// if(!$key){
    	// 	$key=0;
    	// }

    	// if($request->key){
    		
    	// }
    	$giohang = Session::get('giohang');
    		// print_r($giohang); echo "<br>";
            foreach ($giohang as $key => $value) {
              if($value['id']==$request->key)
                unset($giohang[$key]);
            }
    		
    		Session::put('giohang',$giohang);
    		// $giohang = Session::get('giohang');
    		// print_r($giohang); die();
    }

    public function GetTonggiohang(){
    	$giohang=Session::get('giohang');
    	return count($giohang);
    }

    public function Tongtien(){
        $data=Session::get('giohang');
        $sum=0;
        foreach ($data as $value) {
           $sum+=$value['gia']*$value['sl'];
        }
        return $sum;
    }
    
   
}
