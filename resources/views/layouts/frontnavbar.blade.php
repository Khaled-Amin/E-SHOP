<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-gem me-3" aria-hidden="true"style = "margin-left:5px;"></i>
            E-Shop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-just" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">الرئيسية</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('categoryAll') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        التصنيفات
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($getCate as $item)
                            <li><a class="dropdown-item" href="{{url('view-category/' . $item->slug)}}">{{$item->name}}</a></li>
                            <hr class="dropdown-divider">
                        @endforeach

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show.cart') }}">
                        سلة التسوق
                        <sup style="color:#fff;font-size:16px;">
                            <span class="badge badge-pill bg-success cart-count">0</span>
                        </sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wishlist') }}">
                        قائمة الرغبات
                        <sup style="color:#fff;font-size:16px;">
                            <span class="badge badge-pill bg-primary wishlist-count">0</span>
                        </sup>

                    </a>
                </li>
                {{-- <li class="nav-item loggin">
                    <a class="nav-link" href="{{ route('login') }}">دخول</a>
                    <a class="nav-link" href="{{ route('register') }}">تسجيل</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">تسجيل</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">دخول</a>
                </li> --}}
            </ul>
            <div class="dropdown d-flex">
                <div class="nav-item" dir="ltr" style="margin-left:1rem;">
                    <div class="search-bar">
                        <form action="{{url('searchProduct')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="search" id="search_product" name="q" class="form-control" placeholder="ما الذي تبحث عنه؟" required aria-describedby="basic-addon1">
                                <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <button class="btn btn-secondary dropdown-toggle btn-log" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  @if (Auth::check())
                        <span>{{ Auth::user()->name }}</span>
                        {{-- <img src="{{asset('frontend/5087579.png')}}" class="w-100" alt="profile"> --}}
                    @else
                    تسجيل دخول
                  @endif
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @if (Auth::check())
                        <li><a class="dropdown-item mb-2" href="#">بروفايلي</a></li>
                        <li><a class="dropdown-item mb-2" href="{{route('user.oreder')}}">طلباتي</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btun">تسجيل خروج</button>
                            </form>
                        </li>

                  @else
                  <li><a class="nav-link loginBtn" href="{{ route('register') }}">تسجيل</a></li>
                  <li><a class="nav-link loginBtn" href="{{ route('login') }}">دخول</a></li>
                  @endif
                </ul>
              </div>
        </div>
    </div>
</nav>
