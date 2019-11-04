<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['prefix' => 'admin'], function() {
    Route::get('dashboard', 'DashboardController@GetDashboard');
    Route::get('them-san-pham','SanphamController@GetThemsanpham');
    Route::post('them-san-pham','SanphamController@PostThemsanpham');
    Route::get('danh-sach-san-pham','SanphamController@Getdanhsach')->name('danhsachsanpham');
    Route::get('sua-san-pham/{id}', 'SanphamController@GetEdit');
    Route::post('sua-san-pham/{id}', 'SanphamController@PostEdit');
    Route::get('xoa-san-pham/{id}', 'SanphamController@Delete');

    Route::get('danh-sach-danh-muc', 'DanhmucController@GetDanhsach')->name('danhsachdanhmuc');
    Route::get('them-danh-muc', 'DanhmucController@GetThemdanhmuc');
    Route::post('them-danh-muc', 'DanhmucController@PostThemdanhmuc');
    Route::post('sua-danh-muc/{id}', 'DanhmucController@PostSuadanhmuc');
    Route::get('sua-danh-muc/{id}', 'DanhmucController@GetSuadanhmuc');
    Route::get('xoa-danh-muc/{id}', 'DanhmucController@GetXoadanhmuc');

    Route::get('nhap-hang','KhohangController@GetNhaphang');
    Route::post('nhap-hang','KhohangController@PostNhaphang');
    Route::get('xuat-hang','KhohangController@GetXuathang');
    Route::post('xuat-hang','KhohangController@PostXuathang');
    // Route::get('lay-inventoryid','KhohangController@GetInventoryid')->name('getinventoryid');
    // Route::post('test','KhohangController@test');
    Route::get('danh-sach-coupon','CouponController@GetDanhsach')->name('danhsachcoupon');
    Route::get('them-coupon','CouponController@GetThem')->name('themcoupon');
    Route::post('them-coupon','CouponController@PostThem');

});

// Route::get('trang-chu','NguoidungController@GetTrangchu')->name('trangchu');
Route::get('','NguoidungController@GetTrangchu')->name('trangchu');

Route::get('gio-hang','GiohangController@GetGiohang')->name('giohang');

Route::get('them-gio-hang','GiohangController@ThemGiohang');

Route::get('xoa-gio-hang','GiohangController@XoaGiohang' );

Route::get('tong-gio-hang','GiohangController@GetTonggiohang');

Route::get('chi-tiet-san-pham/{id}/{tenkhongdau}','SanphamController@GetChitietsanpham')->name('chitietsanpham');

Route::get('lab1','LabController@GetIndex');
Route::get('tong-tien','GiohangController@Tongtien');
Route::get('/{id}/{ten}', 'SanphamController@GetListsanpham')->name('listsanpham');

Route::get('load-more','NguoidungController@GetLoadmore')->name('loadmore');


Route::get('xep-giam-dan','NguoidungController@GetDesc')->name('GetDesc');
Route::get('xep-tang-dan','NguoidungController@GetAsc')->name('GetAsc');


Route::get('dang-nhap','NguoidungController@GetDangnhap')->name('dangnhap');
Route::post('dang-nhap','NguoidungController@PostDangnhap');
Route::get('dang-ky','NguoidungController@GetDangky')->name('dangky');
Route::post('dang-ky','NguoidungController@PostDangky');
Route::get('dang-xuat','NguoidungController@GetDangxuat')->name('dangxuat');
Route::get('don-hang','NguoidungController@GetDonhang')->name('donhang');
Route::get('lay-huyen','NguoidungController@GetLayhuyen');
Route::get('lay-xa','NguoidungController@GetLayxa');
