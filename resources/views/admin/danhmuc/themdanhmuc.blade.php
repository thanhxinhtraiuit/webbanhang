@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Them Danh Muc</h1>

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
                      <label for="">Ten Danh Muc</label>
                    <input type="text" name='tendanhmuc' class='form-control'>
                    
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