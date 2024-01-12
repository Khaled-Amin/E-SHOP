<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ url('/') }}">
            <img src="{{ asset('dashboard/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold text-white" style="font-size: 18px;">CountryBoot</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div dir="rtl" class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                    </div>
                    <span class="nav-link-text me-1">الرئيسية</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.sittings') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">settings</i>
                    </div>
                    <span class="nav-link-text me-1">الاعدادات العامة</span>
                </a>
            </li>
            {{-- <li class="nav-item">
            <a class="nav-link " href="{{route('slider.main')}}">
                <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons-round opacity-10">view_in_ar</i>
                </div>
                <span class="nav-link-text me-1">سلايدر</span>
            </a>
        </li> --}}


            <li class="nav-item" id="nb">
                <a class="nav-link " href="{{ route('all.main.categories') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">category</i>
                    </div>
                    <span class="nav-link-text me-1">التصنيفات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('products') ? 'active' : '' }}"
                    href="{{ route('all.main.products') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">shop</i>
                    </div>
                    <span class="nav-link-text me-1">المنتجات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all.main.colors') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">category</i>
                    </div>
                    <span class="nav-link-text me-1">الألوان</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all.main.sizes') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">category</i>
                    </div>
                    <span class="nav-link-text me-1">المقاسات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all.main.orders') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">content_paste</i>
                    </div>
                    <span class="nav-link-text me-1">الطلبات</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all.main.shipping') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">content_paste</i>
                    </div>
                    <span class="nav-link-text me-1">قسم مصاريف الشحن</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/users') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">person</i>
                    </div>
                    <span class="nav-link-text me-1">المستخدمين</span>
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons-round opacity-10">logout</i>
                    </div>
                    <span class="nav-link-text me-1">تسجيل الخروج</span>
                </a>
            </li>
            {{-- <li class="nav-item">
            <a class="nav-link " href="#">
                <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons-round opacity-10">table_view</i>
                </div>
                <span class="nav-link-text me-1">المواقع</span>
            </a>
        </li> --}}
            {{-- <li class="nav-item">
            <a class="nav-link " href="#">
                <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons-round opacity-10">table_view</i>
                </div>
                <span class="nav-link-text me-1">قائمة الانتظار</span>
            </a>
        </li> --}}
        </ul>
    </div>

</aside>
