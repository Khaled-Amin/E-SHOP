<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('panel') }}/assets/images/favicon.png">
    <!--Page title-->
    <title>Admin easy Learning</title>
    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/bootstrap.min.css">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/all.min.css">
    <!-- metis menu -->
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/plugins/metismenu-3.0.4/assets/css/metisMenu.min.css">
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/plugins/metismenu-3.0.4/assets/css/mm-vertical-hover.css">
    <!-- chart -->

    <!-- <link rel="stylesheet" href="assets/plugins/chartjs-bar-chart/chart.css"> -->
    <!--Custom CSS-->
    <link rel="stylesheet" href="{{ asset('panel') }}/assets/css/style.css">
</head>

<body id="page-top">
    <!-- preloader -->
    <div class="preloader">
        <img src="{{ asset('panel') }}/assets/images/preloader.gif" alt="">
    </div>


    <!-- wrapper -->
    <div class="wrapper without_header_sidebar">
        <!-- contnet wrapper -->
        <div class="content_wrapper">
            <!-- page content -->
            <div class="login_page center_container">
                <div class="center_content">
                    {{-- <div class="logo">
                        <img src="{{ asset('panel') }}/assets/images/logo.png" alt="" class="img-fluid">
                    </div> --}}
                    @if (Session::has('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{session::get('error')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width:10px !important; height:10px !important; color:#000;line-height:10px;"><i class="fa-sharp fa-solid fa-xmark"></i></button>
                      </div>
                    @endif
                    <form action="{{route('admin.login')}}" class="d-block" method="post">
                        @csrf
                        <div class="form-group icon_parent">
                            <label for="email">بريد الإلكتروني</label>
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email Address">
                            <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>

                        </div>
                        <div class="form-group icon_parent">
                            <label for="password">كلمة المرور</label>
                            <input type="password" class="form-control" name="password" required placeholder="Password">

                            <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                        </div>
                        {{-- <div class="form-group">
                            <label class="chech_container">تذكرني
                                <input type="checkbox" name="remember" id="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div> --}}
                        <div class="form-group">
                            <a class="registration" href="{{route('admin.register')}}">انشاء حساب جديد</a><br>
                            <a href=" " class="text-white">نسيت كلمة المرور</a>
                            <button type="submit" class="btn btn-blue">دخول</button>
                        </div>
                    </form>
                    <div class="footer">
                        <p>Copyright &copy; 2023 <a href="{{route('login_form')}}">Khaled Amir Amir</a>. All rights
                            reserved.</p>
                    </div>

                </div>
            </div>
        </div>
        <!--/ content wrapper -->
    </div>
    <!--/ wrapper -->



    <!-- jquery -->
    <script src="{{ asset('panel') }}/assets/js/jquery.min.js"></script>
    <!-- popper Min Js -->
    <script src="{{ asset('panel') }}/assets/js/popper.min.js"></script>
    <!-- Bootstrap Min Js -->
    <script src="{{ asset('panel') }}/assets/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- Fontawesome-->
    <script src="{{ asset('panel') }}/assets/js/all.min.js')}}"></script>
    <!-- metis menu -->
    <script src="{{ asset('panel') }}/assets/plugins/metismenu-3.0.4/assets/js/metismenu.js"></script>
    <script src="{{ asset('panel') }}/assets/plugins/metismenu-3.0.4/assets/js/mm-vertical-hover.js"></script>
    <!-- nice scroll bar -->
    <script src="{{ asset('panel') }}/assets/plugins/scrollbar/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('panel') }}/assets/plugins/scrollbar/scroll.active.js"></script>
    <!-- counter -->
    <script src="{{ asset('panel') }}/assets/plugins/counter/js/counter.js"></script>
    <!-- chart -->
    <script src="{{ asset('panel') }}/assets/plugins/chartjs-bar-chart/Chart.min.js"></script>
    <script src="{{ asset('panel') }}/assets/plugins/chartjs-bar-chart/chart.js"></script>
    <!-- pie chart -->
    <script src="{{ asset('panel') }}/assets/plugins/pie_chart/chart.loader.js"></script>
    <script src="{{ asset('panel') }}/assets/plugins/pie_chart/pie.active.js"></script>


    <!-- Main js -->
    <script src="{{ asset('panel') }}/assets/js/main.js"></script>





</body>

</html>
