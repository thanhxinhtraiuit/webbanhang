<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>web ban hang</title>
	<link rel="icon" href="img/Fevicon.png" type="image/png">
  <link rel="stylesheet" href="{{ asset('nguoidung/vendors/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('nguoidung/vendors/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('nguoidung/vendors/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('nguoidung/vendors/nice-select/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('nguoidung/vendors/owl-carousel/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('nguoidung/vendors/owl-carousel/owl.carousel.min.css') }}">

  <link rel="stylesheet" href="{{ asset('nguoidung/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('nguoidung/css/custom.css') }}">
</head>
<body>

   @include('lab.header')
   {{-- @yield('sitemain') --}}
  @include('lab.menu')
   {{-- @include('lab.footer') --}}


  <script src="{{ asset('nguoidung/vendors/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/skrollr.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/nice-select/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/jquery.ajaxchimp.min.js') }}"></script>
  <script src="{{ asset('nguoidung/vendors/mail-script.js') }}"></script>
  <script src="{{ asset('nguoidung/js/main.js') }}"></script>
  <script src="{{ asset('nguoidung/js/giohang.js') }}"></script>

</body>
</html>