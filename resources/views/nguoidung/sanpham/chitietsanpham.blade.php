@extends('nguoidung.layouts.master')
@section('sitemain')
 <!--================Single Product Area =================-->
  <div class="product_image_area">
    <div class="container">
      <div class="row s_product_inner">
        <div class="col-lg-6">
          <div class="owl-carousel owl-theme s_Product_carousel">
            <div class="single-prd-item">
              <img class="img-fluid" src="../../upload/{{ $sanpham->hinh }}" alt="">
            </div>
            <div class="single-prd-item">
              <img class="img-fluid" src="../../upload/{{ $sanpham->hinh }}" alt="">
            </div>
            <div class="single-prd-item">
              <img class="img-fluid" src="../../upload/{{ $sanpham->hinh }}" alt="">
            </div>
          </div>
        </div>
        <div class="col-lg-5 offset-lg-1">
          <div class="s_product_text">
            <h3>{{ $sanpham->ten_san_pham }}</h3>
            <h2>{{ $sanpham->gia }}</h2>
            <ul class="list">
              <li><a class="active" ><span>Category</span> {{ $sanpham->ten_danh_muc }}</a></li>
              
            </ul>
            <p>{{$sanpham->mo_ta}}</p>
            <div class="product_count">
              <label for="qty">Quantity:</label>
              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
               class="increase items-count" type="button"><i class="ti-angle-left"></i></button>
              <input type="text" name="qty" id="sst" size="2" maxlength="12" value="1" title="Quantity:" class="input-text qty">
              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
               class="reduced items-count" type="button"><i class="ti-angle-right"></i></button>
              <a class="button primary-btn themgiohang"  id='{{ $sanpham->id }}'>Add to Cart</a>               
            </div>
            <div class="card_area d-flex align-items-center">
              <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
              <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->
@endsection