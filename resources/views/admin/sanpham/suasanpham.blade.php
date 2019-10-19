@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Sua San Pham</h1>

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
                  <form action=""method='post'  enctype="multipart/form-data"> 
                    @csrf
                    <div class='form-group'>
                      <label for="">Ten san pham</label>
                    <input type="text" name='tensanpham' class='form-control' value="{{ $data->ten_san_pham }}">

                    <label for="">Gia san pham</label>
                    <input type="text" name='gia' class='form-control' value="{{ $data->gia }}">

                    <label for="">Mo ta</label>
                    <textarea name="mota" id="" cols="30" rows="10" class='form-control'>{{ $data->mo_ta }}
                    </textarea>

                    <label for="">Loai san pham</label>
                         <select class='form-control' name="loai" id="">
                      @foreach ($danhmuc as $element)
                         <option @if ($element->id==$data->id_danh_muc)
                             selected="" 
                         @endif value={{ $element->id }}>
                        {{ $element->ten_danh_muc }}
                      </option>
                      @endforeach
                       </select>
                    <br>
                   
                    <label for=""> Sale : 1 - 50%  2 - 30% </label>
                    <br>
                    <input type="text" name='khuyenmai' value="{{ $data->khuyen_mai }}"> 
                    <br>

                   
                    <br>


                    <label for="">Hinh anh hien tai </label>
                    <br>
                    <img height="300px" src="/../upload/{{ $data->hinh }}" >
                    <br>
                       <label for="">Hinh anh</label>
                    <br>
                    <input type="file" name ='hinh' >
                    <br>
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