@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Them Coupon</h1>

          </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Nhập thông tin mã Coupon</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form action=""method='post'  enctype="multipart/form-data">
                    @csrf
                    <div class='form-group'>Mã Coupon</label>
                    <input type="text" name='code' class='form-control'>
                    <label for="">Value</label>
                    <input type="number" name='value' class='form-control'>
                    
                    <label for="">Loại : 1 - Ngàn đồng : 2 - %</label>
                    <input type="number" name='type' class='form-control'>

                    <label for="">Số Lượng</label>
                    <input type="number" name='soluong' class='form-control'>

                    <label for="">hạn sử dụng</label>
                    <input type="date" name='hansudung' class='form-control'>
                    
                    <br>
                    <input type="submit" value="Them" class ='btn btn-primary'>
                    </div>


                  </form>


                </div>
              </div>
            </div>

 
        </div>
        <!-- /.container-fluid -->
@endsection