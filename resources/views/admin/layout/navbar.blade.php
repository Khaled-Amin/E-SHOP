<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                <li class="breadcrumb-item text-sm ps-2">
                    <a class="opacity-5 text-dark" href="javascript:void(0);">
                        لوحة التحكم
                    </a>
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0">CountryBoot</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
            <ul class="navbar-nav me-auto ms-0 justify-content-end">
                @if (Auth::guard('admin')->check())
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ route('admin.logout') }}" class="nav-link text-body font-weight-bold px-0 logout">
                        <span class="d-sm-inline d-none">تسجيل خروج</span>
                    </a>

                </li>
                @endif
                <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
