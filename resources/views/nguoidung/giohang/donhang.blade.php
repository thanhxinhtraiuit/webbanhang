@extends('nguoidung.layouts.master')
@section('sitemain')
  <!--================Checkout Area =================-->
  <section class="checkout_area section-margin--small">
    <div class="container">
        
     
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Chọn Tỉnh </h3>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        @csrf
                        
                        <div class="col-md-12 form-group p_star ">

                            <select class="country_select tinh " name="tinh">
                                @foreach ($tinh as $element)
                                    <option id="{{ $element['Id'] }}" value="{{ $element['Title'] }}">{{ $element['Title'] }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                         <div class="col-md-12 form-group p_star" id='huyen' >
                           
                                
                            
                        </div>
                         <div class="col-md-12 form-group p_star" id='xa'>
                        
                        </div>

                        <div class="col-md-12 form-group p_star">
                            <label for="">Địa chỉ chi tiết</label>
                            <input type="text" class="form-control"  name="diachi">

                            <label for="">Họ Tên</label>
                             <input type="text" class="form-control"  name="ten">

                            <label for="">Số Điện Thoại</label>
                             <input type="number" class="form-control"  name="sdt">

                            <label for="">Email</label>
                             <input type="email" class="form-control"  name="email">


                        </div>
                        
                    
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li><a href="#"><h4>Product <span>Total</span></h4></a></li>
                            @foreach ($giohang as $element)
                                <li><a href="#">{{ $element['sanpham']->ten_san_pham }}<span class="middle">x {{ $element['sl'] }}</span> <span class="last">{{number_format( $element['sanpham']->gia*$element['sl']) }}</span></a></li>
                            @endforeach
                            
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Subtotal <span>{{ number_format($tongtien) }}</span></a></li>
                            <li><a href="#">Shipping <span>{{ number_format('30000') }}</span></a></li>
                            <li><a href="#">Total <span>{{  number_format($tongtien-30000) }}</span></a></li>
                        </ul>
                        <div class="payment_item">
                            <div class="radion_btn">
                                <input type="radio" id="f-option5" name="selector">
                                <label for="f-option5">Check payments</label>
                                <div class="check"></div>
                            </div>
                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County,
                                Store Postcode.</p>
                        </div>
                        <div class="payment_item active">
                            <div class="radion_btn">
                                <input type="radio" id="f-option6" name="selector">
                                <label for="f-option6">Paypal </label>
                                <img src="img/product/card.jpg" alt="">
                                <div class="check"></div>
                            </div>
                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                account.</p>
                        </div>
                        <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">I’ve read and accept the </label>
                            <a href="#">terms & conditions*</a>
                        </div>
                        <div class="text-center">
                          <input type="submit" name="" class="button button-paypal" value="Mua"> 
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!--================End Checkout Area =================-->
@endsection
