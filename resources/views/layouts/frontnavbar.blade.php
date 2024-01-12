<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-gem me-3" aria-hidden="true"style = "margin-left:5px;"></i>
            CountryBoot
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-just" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('categoryAll') }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
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
                        Cart
                        <sup style="color:#fff;font-size:16px;">
                            <span class="badge badge-pill bg-success cart-count">0</span>
                        </sup>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wishlist') }}">
                        Wishlist
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
            <div class="dropdown d-flex align-items-center listDrop">
                <div class="nav-item" dir="ltr" style="margin-left:1rem;">
                    <div class="search-bar">
                        <form action="{{url('searchProduct')}}" method="POST" class="mb-0">
                            @csrf
                            <div class="input-group">
                                <input type="search" id="search_product" name="q" class="form-control" placeholder="Search products" required aria-describedby="basic-addon1">
                                <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                @if (Auth::check())
                    <button class="btn btn-secondary dropdown-toggle btn-log mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                              <span>{{ Auth::user()->name }}</span>
                              {{-- <img src="{{asset('frontend/5087579.png')}}" class="w-100" alt="profile"> --}}
                    </button>
                    <ul class="dropdown-menu align-items-center listingDrop" aria-labelledby="dropdownMenuButton1">

                            <li><a class="dropdown-item mb-2" href="{{route('user.oreder')}}"><i class="fa-solid fa-box me-1"></i>Orders</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btun"><i class="fa-solid fa-right-from-bracket mx-1"></i>Logout</button>
                                </form>
                            </li>
                      {{-- <li><a class="nav-link loginBtn" href="{{ route('register') }}">تسجيل</a></li>
                      <li><a class="nav-link loginBtn" href="{{ route('login') }}">دخول</a></li> --}}
                    </ul>
                @else
                    <a href="{{ route('login') }}" class="btn btn-secondary btnLogin mx-2">
                        Log in
                    </a>
                @endif
              </div>
        </div>
    </div>
</nav>
