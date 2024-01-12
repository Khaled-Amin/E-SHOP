@extends('admin.layout.admin_master')

@section('title')
     طلبات
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
                    <h4>طلبات قديمة</h4>
                    <a href="{{url('admin/orders')}}" class="btn btn-warning" style="float:left;">طلبات جديدة</a>
                </div><br><br>
            </div>


            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>رقم التتبع</th>
                            <th>السعر الكلي</th>
                            <th>الحالة</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $item)
                            <tr>
                                <td>{{$item->tracking_no}}</td>
                                <td>{{$item->total_price}}</td>
                                <td>{{$item->status == '0' ? 'معلق' : 'مكتمل'}}</td>
                                <td>
                                    <a href="{{route('show.orders' ,  $item->id)}}" class="btn btn-primary">عرض</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align:center;">لايوجد بيانات لعرضها</td>
                            </tr>
                    @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>



@endsection
