<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="76x76" href="@isset($Settings) {{asset('uploading/' . $Settings->meta_image)}}@endisset">
    <link rel="icon" type="image/png" href="@isset($Settings) {{asset('uploading/' . $Settings->favicon)}}@endisset">
    <meta name="description" content="@isset($Settings){{$Settings->Description}}@endisset">
    <meta name="keywords" content="@isset($Settings){{$Settings->Keywords}}@endisset">
    <meta name="author" content="Khaled Amin">
    <meta property="og:title" content="@isset($Settings){{$Settings->nameWebsite}}@endisset">
    <meta property="og:description" content="@isset($Settings){{$Settings->Description}}@endisset">
    @isset($Settings)<meta property="og:image" content="{{asset('uploading/' . $Settings->meta_image)}}">
    @endisset
    <meta property="og:url" content="">
    @isset($Settings)
<link rel="icon" type="image/x-icon" href="{{asset('uploading/' . $Settings->favicon)}}">
    @endisset
    <title>
        @yield('title')
    </title>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <!-- Exzoom -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/exzoom/jquery.exzoom.css') }}">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/asw.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ecomm.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.theme.default.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css') }}/style-front.css">
</head>

<body dir="ltr">

    <div class="whatsapp">
        <a href="https://api.whatsapp.com/send?phone=201100670775" target="_blank">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>

    @include('layouts.frontnavbar')
    <div class="content">
        @yield('content')
    </div>


     <!-- Footer -->
     <footer class="text-center text-lg-start bg-dark text-muted">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom container">
          <!-- Left -->
          <div class="me-5 d-none d-lg-block" dir="rtl">
            <span class="text-white">:Connect with us on social networks</span>
          </div>
          <!-- Left -->

          <!-- Right -->
          <div dir="rtl">
            <a href="javascript:void(0);" class="me-4 text-reset">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="javascript:void(0);" class="me-4 text-reset">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="javascript:void(0);" class="me-4 text-reset">
              <i class="fab fa-google"></i>
            </a>
            <a href="javascript:void(0);" class="me-4 text-reset">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="javascript:void(0);" class="me-4 text-reset">
              <i class="fab fa-linkedin"></i>
            </a>
            {{-- <a href="" class="me-4 text-reset">
              <i class="fab fa-github"></i>
            </a> --}}
          </div>
          <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="linkss">
          <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3" dir="ltr">
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-6 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                  <i class="fas fa-gem me-3"></i>COUNTRYBOOT
                </h6>
                <p class="text-end text-white">@isset($Settings){!! $Settings->Description !!}@endisset</p>
              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                  Categories
                </h6>
                @isset($categories)
                @foreach ($categories as $item)
                    <p>
                      <a href="{{route('productBycategory', [$item->slug])}}" class="text-reset">{{$item->name}}</a>
                    </p>
                @endforeach
                @endisset
              </div>
              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 link-i-icon text-white">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
                <p><i class="fas fa-home me-3"></i>Egypt, Cairo</p>
                <p><i class="fas fa-envelope me-3"></i>Hosamsaied@hotmail.com</p>
                <p><i class="fas fa-phone me-3"></i>+20 1100670775</p>
              </div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05); color:#fff;">
            © 2024 All rights reserved

          <!-- Created By: Khaled Amir Amin, email:khaledamiramin@gmail.com -->
          </div>
        <!-- Copyright -->
      </footer>
      <!-- Footer -->

    {{-- <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-3.6.1.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/checkout.js') }}"></script>
    <script src="{{ asset('frontend/assets/exzoom/jquery.exzoom.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>

          var availableTags = [];
          $.ajax({
            type:"GET",
            url:"/product-list",
            success:function(response){
                // console.log(response);
                startAutoComplete(response);
            }
          });

          function startAutoComplete(availableTags){
            $( "#search_product" ).autocomplete({
            source: availableTags
          });
          }


        </script>
        @yield('script')

        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('success'))
        <script>
            swal("{{ session('success') }}");
        </script> @endif

    {{-- @yield('scripts') --}}

</body>
</html>
<style>
    .whatsapp {
    position: fixed;
    z-index: 9999999;
    right: 36px;
    bottom: 45px;
    padding: 10px 15px;
    background-color: #1fc41f;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}
.whatsapp a i {
    color: #FFF;
    font-size: 42px;
}
    .listDrop{
        left: auto !important;
    }
    .dropdown-menu[data-bs-popper]{
        /* left: auto !important; */
        right: 0 !important;
    }
    p span{
        color: #fff;
    }
    @font-face {
       font-family: Font;
       src: url({{ asset('frontend/assets/4_F4.ttf') }});
    }
   </style>
