 @php
   $data = \App\Danhmuc::all();
 @endphp
  <!--================ Start Header Menu Area =================-->
	<header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item active"><a class="nav-link" href="{{ route('trangchu') }}">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Category</a>
                <ul class="dropdown-menu">
                  @foreach ($data as $element)
                    <li class="nav-item"><a class="nav-link" href="{{ route('listsanpham',[$element->id,str_slug($element->ten_danh_muc)]) }}">{{ $element->ten_danh_muc }}</a></li>
                  @endforeach
                  
                  
                </ul>
							</li>
              <li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Blog</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                  <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                </ul>
							</li>
							<li class="nav-item submenu dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                  aria-expanded="false">Pages</a>
                <ul class="dropdown-menu">
                  <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
                  <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>
                  <li class="nav-item"><a class="nav-link" href="tracking-order.html">Tracking</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
            </ul>

            <ul class="nav-shop">
              <li class="nav-item form-group ml-sm-auto form-inline " >

                <div class='dropdown '>
                <input type="text" class='form-control mb-1 otimkiem  dropdown-toggle'  data-toggle="dropdown">
                <ul class="dropdown-menu">
                                      <li class=" nav-item mb-1 "><a class="nav-link" href="http://localhost:8000/1/samsung">Samsung</a></li>
                                      <li class="  row nav-item mb-1"><a class="nav-link" href="http://localhost:8000/2/iphone">Iphone</a></li>
                                      <li class="row nav-item mb-1"><a class="nav-link" href="http://localhost:8000/3/xiaomi">Xiaomi</a></li>
                                      <li class="row nav-item mb-1"><a class="nav-link" href="http://localhost:8000/4/xiaomi">Xiaomi</a></li>
                                      <li class="row nav-item mb-1"><a class="nav-link" href="http://localhost:8000/5/viivo">ViIVO</a></li>
                                    
                  
                </ul>
                 <button><i class="ti-search"></i></button>
                </div>
                </li>
                {{-- <button><i class="ti-search"></i></button></li> --}}
              <li class="nav-item"><button class='btngiohang' href={{ route('giohang') }}><i class="ti-shopping-cart"></i><span class="nav-shop__circle"></span></button> </li>
              <li class="nav-item"><a class="button button-header" href="#">Login</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
	<!--================ End Header Menu Area =================-->