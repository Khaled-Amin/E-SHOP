@extends('admin.layout.admin_master')

@section('title')
    المستخدمون
@endsection

@section('content')


@include('admin.layout.sidebar')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    @include('admin.layout.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row backgroundW p-4 m-3">
            <div class="container">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" role="alert">
                        <strong style="color:#fff;">{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width:10px !important; height:10px !important; color:#000;line-height:10px;"><i class="fa-sharp fa-solid fa-xmark"></i></button>
                    </div>
                @endif
            </div>
            <div class="container">

                <div class="form-group btn-create">
                    <h4>تفاصيل المستخدم</h4>
                    <a href="{{ route('users') }}" class="btn btn-success">رجوع</a>
                </div><br><br><hr>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label for="">الاسم الأول</label>
                                    <div class="p-2 border">{{$users->name}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">الاسم الأخير</label>
                                    <div class="p-2 border">{{$users->lname}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">بريد إلكتروني</label>
                                    <div class="p-2 border">{{$users->email}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">هاتف</label>
                                    <div class="p-2 border">{{$users->phone}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">العنوان1</label>
                                    <div class="p-2 border">{{$users->address1}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">العنوان2</label>
                                    <div class="p-2 border">{{$users->address2}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">المدينة</label>
                                    <div class="p-2 border">{{$users->city}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">الولاية</label>
                                    <div class="p-2 border">{{$users->state}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">الدولة</label>
                                    <div class="p-2 border">{{$users->country}}</div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="">رمز البريدي</label>
                                    <div class="p-2 border">{{$users->pincode}}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


