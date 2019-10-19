@extends('admin.layouts.master')
@section('content')
      <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Danh Sach Coupon</h1>

          </div>


          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><a class='btn btn-warning' href="../admin/them-coupon">Them Coupon</a></h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body">
                 <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">code</th>
                          <th scope="col">Value</th>
                          <th scope="col">Type: 1 - 000đ || 2 - %</th>
                          <th scope="col">So Luong</th>
                          <th scope="col">Han Su Dung</th>

                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($danhsach as $key=>$element)
                          <tr>
                          <th scope="row">{{ $key+1 }}</th>
                          <td>{{ $element->code }}</td>
                          <td>{{ $element->value }}</td>
                          <td>{{ $element->type }}</td>
                          <td>{{ $element->soluong }}</td>
                          <td>{{ $element->hansudung }}</td>
                          
                          <td>
                            <a class='btn btn-primary' href="/admin/sua-san-pham/{{ $element->id }}">Sua</a>
                             <a class='btn btn-danger' href="/admin/xoa-san-pham/{{ $element->id }}">Xoa</a>
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