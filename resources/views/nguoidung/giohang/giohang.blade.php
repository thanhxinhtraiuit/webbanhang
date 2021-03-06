@extends('nguoidung.layouts.master')
@section('sitemain')
 <!--================Cart Area =================-->
  <section class="cart_area">
      <div class="container">
          <div class="cart_inner">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Product</th>
                              <th scope="col">Price</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">#</th>
                          </tr>
                      </thead>
                      <tbody>

                        @foreach ($giohang as   $key=> $element)
                           <tr>
                              <td>
                                  <div class="media">
                                      <div class="d-flex">
                                          <img height='150px' src="../upload/{{ $element['sanpham']->hinh }}" alt="">
                                      </div>
                                      <div class="media-body">
                                          <p>{{ $element['sanpham']->ten_san_pham }}</p>
                                      </div>
                                  </div>
                              </td>
                              <td>
                                  <h5> {{ number_format($element['sanpham']->gia) }} </h5>
                              </td>
                              <td>
                                  <div class="product_count">
                                      <input type="text" name="qty" id="sst" maxlength="12" value="{{ $element['sl'] }}" title="Quantity:"
                                          class="input-text qty">
                                      <button
                                          class="increase items-count" type="button">&nbsp;+</button>
                                      <button
                                          class="reduced items-count" type="button"> &nbsp;-</button>
                                  </div>
                              </td>
                              <td>
                                  <h5><button class="button xoagiohang" id={{ $element['sanpham']->id }}>Xoa</button></h5>
                              </td>
                          </tr>
                        @endforeach
                         
                        
                          <tr class="bottom_button">
                              <td>
                                  <a class="button" href="#">Update Cart</a>
                              </td>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="cupon_text d-flex align-items-center">
                                      <input type="text" placeholder="Coupon Code">
                                        <button class='btn btn-primary addcoupon'> Ap Dung</button>
                                      <a class="button" href="#">Have a Coupon?</a>
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <td>

                              </td>
                              <td>

                              </td>
                              <td>
                                  <h5>Subtotal</h5>
                              </td>
                              <td>
                                  <h5 id='tongtien'>0</h5>
                              </td>
                          </tr>
                          <tr class="shipping_area">
                              <td class="d-none d-md-block">

                              </td>
                              <td>

                              </td>
                              <td>
                              {{--     <h5>Shipping</h5>
                              </td>
                              <td>
                                  <div class="shipping_box">
                                      <ul class="list">
                                          <li><a href="#">Flat Rate: $5.00</a></li>
                                          <li><a href="#">Free Shipping</a></li>
                                          <li><a href="#">Flat Rate: $10.00</a></li>
                                          <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                      </ul>
                                      <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                      <select class="shipping_select">
                                          <option value="1">Bangladesh</option>
                                          <option value="2">India</option>
                                          <option value="4">Pakistan</option>
                                      </select>
                                      <select class="shipping_select">
                                          <option value="1">Select a State</option>
                                          <option value="2">Select a State</option>
                                          <option value="4">Select a State</option>
                                      </select>
                                      <input type="text" placeholder="Postcode/Zipcode">
                                      <a class="gray_btn" href="#">Update Details</a>
                                  </div>
                              </td> --}}
                          </tr>
                          <tr class="out_button_area">
                              <td class="d-none-l">

                              </td>
                              <td class="">

                              </td>
                              <td>

                              </td>
                              <td>
                                  <div class="checkout_btn_inner d-flex align-items-center">
                                      <a class="gray_btn" href="#">Continue Shopping</a>
                                      <a class="primary-btn ml-2" href="{{ route('donhang') }}">Proceed to checkout</a>
                                  </div>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </section>
  <!--================End Cart Area =================-->
@endsection