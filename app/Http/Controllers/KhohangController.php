<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sanpham;
use App\inventoryin;
use App\inventoryman;
use App\inventoryout;
class KhohangController extends Controller
{
    public function GetNhaphang() {
    	$data['data'] = Sanpham::all();
    	return view('admin.khohang.nhaphang',$data);
    }
    public function GetXuathang(){
        $data['data'] = Sanpham::all();
        return view('admin.khohang.xuathang',$data);
    }
    public function GetInventoryid($productid){
           $data= inventoryin::where('product_id',$productid )->where('conlai','<>',0)->get();
          
           return $data;

    }
   
    public function capnhatin($inventoryid , $conlai=0){
     
        $inventoryin = inventoryin::where('inventory_id',$inventoryid)->first();
        
        $inventoryin->conlai = $conlai;


        $inventoryin->save();
       
    }

    public function luulay($inventoryid,$soluong,$exportdate){
        $inventoryout = new inventoryout;
        $inventoryout->inventory_id= $inventoryid;
        $inventoryout->quantity= $soluong;
        $inventoryout->export_date= $exportdate;
        $inventoryout->save();

    }

    public function luuman($inventoryid,$instock,$update_date ){
        $inventoryman = new inventoryman;
        $inventoryman->in_stock = $instock;
        $inventoryman->inventory_id = $inventoryid;
        $inventoryman->update_date=$update_date;
        $inventoryman->update_type=2;
        $inventoryman->save();
    }

    public function PostXuathang(Request $request){

        $data = inventoryin::select('in_stock','inventoryin.inventory_id')->where('inventoryin.product_id',$request->productid)
                    ->orderBy('inventoryin.created_at','desc')
                    ->join('inventoryman','inventoryin.inventory_id','inventoryman.inventory_id')
                    ->first();
        $conlay = $request->soluong ;
        
        $list = $this->GetInventoryid($request->productid);

        // echo $data->in_stock;die();
        $instock=$data->in_stock;
         if($data->in_stock<$request->soluong){

            return back()->with('error','So Luong XUat Lon Hon SO luong Trong Kho');

        }
      
            foreach ($list as $value) {

                if ($value->conlai <= $conlay ) {


                    $this->capnhatin($value->inventory_id,0);
                    $this->luulay($value->inventory_id,$value->conlai,$request->ngayxuat);
                    $this->luuman($value->inventory_id,$instock-$value->conlai,$request->ngayxuat);
                    $instock=$instock-$value->conlai;
                    $conlay=$conlay-$value->conlai;
                }
                else {
                    $this->capnhatin($value->inventory_id,$value->conlai-$conlay);
                    $this->luulay($value->inventory_id,$conlay,$request->ngayxuat);
                     $this->luuman($value->inventory_id,$instock-$conlay,$request->ngayxuat);
                    $conlay=0;
                    
                }
                if ($conlay==0) {
                    break;
                }
            }
        
           
      

        die();


      

      
       

        $inventoryman->save();
        $inventoryout->save(); 
            return back()->with('success','luu thanh cong');
                    
    }
    public function PostNhaphang(Request $request){
    	$data = new inventoryin ;
    	$data1 = new inventoryman;
    	$data->product_id = $request->productid;
    	$data->import_date = $request->ngaynhap;
    	$data->quantity = $request->soluong;
        $data->conlai = $request->soluong;
    	$data->save();

    	// echo $data; die();
    	$dataid = inventoryin::where('created_at',$data->created_at)->first();


    	$data1->inventory_id=$dataid->inventory_id;
    	$data1->update_date = $request->ngaynhap;
    	
    	$data1->update_type=1;

    	$datast = inventoryin::select('in_stock','inventoryin.created_at')->where('product_id',$request->productid)
    							->orderBy('inventoryin.created_at','desc')
    							->join('inventoryman','inventoryman.inventory_id','inventoryin.inventory_id')
    							->first();
    	if($datast){
    		$data1->in_stock = $datast->in_stock+$request->soluong;
    	}						
    	else $data1->in_stock=$request->soluong;

    	$data1->save();


    	return redirect()->back();
    }

    

    
}
