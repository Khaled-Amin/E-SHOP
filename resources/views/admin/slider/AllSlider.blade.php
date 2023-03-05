@extends('admin.layout.admin_master')

@section('title')
    سلايدر
@endsection

@section('content')

@include('admin.layout.sidebar')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">

                <h6 class="font-weight-bolder mb-0">سلايدر</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

                <ul class="navbar-nav me-auto ms-0 justify-content-end">

                    <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown ps-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    {{-- <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-white" role="alert">
                {{ $message }}
            </div>
        @endif
    </div> --}}

    @if (count($errors) > 0)

        <ul>
            @foreach ($errors->all() as $item)
                <li class="text-danger">
                    {{ $item }}
                </li>
            @endforeach
        </ul>

    @endif

    <div class="row backgroundW p-4 m-3">
        <div class="container">
            <div class="form-group btn-create">
                <h4>سلايدر</h4>
                <a href="{{route('create.slider')}}" class="btn btn-success">اضافة سلايدر</a>
            </div><br><br>

            {{-- <div class="btn-group">
                <label for="">تصفية:</label>
                <button class="dropdown-toggle tgle" id="bbb" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">

                    @isset($country_namess)
                    {{$country_namess->country_name}}
                    @endisset
                </button>

                <div class="dropdown-menu">
                    <ul class="listt" id ="drop_list">
                        <a class="text-decoration-none text-dark mb-1"
                            href="{{ route('categories.main') }}">
                            <li id="eee" style="text-align: right; background-color: #fff;"> --- رئيسية ---</li>
                        </a>
                        @foreach ($country_names as $get_country)
                        <a class="text-decoration-none text-dark mb-1"
                                href="{{route('getCateCount' , [$get_country->id])}}" >
                        <li id="eee" style="text-align: right">
                                {{$get_country->country_name}}

                            </li></a>
                        @endforeach

                    </ul>

                </div>

            </div> --}}
        </div>


        <div class="table-responsive">

            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">id</th>
                        <th scope="col">صور سلايدر</th>
                        <th scope="col">عمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @isset($allSlider)
                        @forelse ($allSlider as $item)
                                <tr>
                                    <th scope="row " style="text-align: center">{{$item->id}}</th>
                                    {{-- <td>{{$item->user->name}}</td> --}}
                                    <td>
                                        <img src="{{asset('uploading/'.$item->slider_pic)}}" width="100" alt="">
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a href="{{ route('edit.slider', $item->id) }}"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                            </div>
                                            <div class="col-sm">
                                                <a href="{{ route('destroy.slider', ['id' => $item->id]) }}"><i
                                                        class="fa-solid fa-trash-can"></i></a>


                                            </div>
                                        </div>


                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">لايوجد بيانات لعرضها</td>
                                </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>
    </div>

</main>

<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" style="background-color: #42424a">
        <i class="material-icons py-2" style="color:#fff">settings</i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3">
            <div class="float-end">
                <h5 class="mt-3 mb-0">الاعدادات</h5>
            </div>
            <div class="float-start mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">تغيير الألوان</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-end">
                    <span class="badge filter bg-gradient-primary active" data-color="primary"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger"
                        onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">نوع القائمة الجانبية</h6>
                <p class="text-sm">اختر اثنين مختلفين في اللون.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark"
                    onclick="sidebarType(this)">Dark</button>
                <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent"
                    onclick="sidebarType(this)">Transparent</button>
                <button class="btn bg-gradient-dark px-3 mb-2 me-2" data-class="bg-white"
                    onclick="sidebarType(this)">White</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3 d-flex">
                <h6 class="mb-0">Navbar Fixed</h6>
                <div class="form-check form-switch me-auto my-auto">
                    <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
            </div>
            <hr class="horizontal dark my-3">
            <div class="mt-2 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch me-auto my-auto">
                    <input class="form-check-input mt-1 float-end me-auto" type="checkbox" id="dark-version"
                        onclick="darkMode(this)">
                </div>
            </div>
            <hr class="horizontal dark my-sm-4">
        </div>
    </div>
</div>



@endsection
