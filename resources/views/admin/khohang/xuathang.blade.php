@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Xuất Hàng</h1>

          </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <form action=""method='post'  enctype="multipart/form-data" id='danhsachsp'>
                    @csrf
                    <div class='form-group'>
                   
                    <label for="">Loai san pham</label>
                    <select class='form-control' name="productid"  id='slid' >
                      @foreach ($data as $element)
                         <option url={{ asset('getinventoryid') }} value={{ $element->id }} >
                        {{ $element->ten_san_pham }}
                      </option>
                      @endforeach
                      
                    </select>



                    {{-- <input type="text" name='mota'> --}}
                  {{--   <input type="text" name='loai' class='form-control'> --}}
                    <label for="">So Luong</label>
                    <input type="number" name='soluong' class='form-control'>
                    <label for="">Ngày Xuất</label>
                    <input type="date" name='ngayxuat' class='form-control'>
                    
                    

                    <br>
                    <input type="submit" value="Update" class ='btn btn-primary'>
                    </div>


                  </form>


                </div>
              </div>
            </div>

 
        </div>
        <!-- /.container-fluid -->
@endsection