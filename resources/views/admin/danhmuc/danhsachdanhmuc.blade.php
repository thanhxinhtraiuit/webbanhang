@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Sach Danh Muc</h1>

          </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><a class='btn btn-warning' href="../admin/them-danh-muc">Them Danh Muc</a></h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                 <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Ten Danh Muc</th>
                
                          <th scope="col">Thao Tac</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($danhmuc as $element)
                          <tr>
                          <th scope="row">{{ $element->id }}</th>
                          <td>{{ $element->ten_danh_muc }}</td>
                          
                          <td>
                            <a class='btn btn-primary' href="/admin/sua-danh-muc/{{ $element->id }}">Sua</a>
                             <a class='btn btn-danger' href="/admin/xoa-danh-muc/{{ $element->id }}">Xoa</a>
                          </td>
                        </tr>
                        @endforeach
                        
                       
                      </tbody>
                    </table>
                  

                </div>
              </div>
            </div>

 
        </div>
        <!-- /.container-fluid -->
@endsection