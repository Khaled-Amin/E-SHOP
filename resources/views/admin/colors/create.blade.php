@extends('admin.layout.admin_master')
@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">


        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- End Navbar -->

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('all.main.colors') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{route('store.colors')}}" method="POST">
                @csrf
                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li class="text-danger">
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="form-group">
                    <label for="exampleFormControlInput1">اسم اللون</label>
                    <input type="text" class="form-controll" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">رمز لون</label>
                    <input type="text" class="form-controll" name="code">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">كمية</label>
                    <input type="" class="form-controll" name="qty">
                </div> --}}

                <div class="form-check form-check-inline">
                    <label for="exampleFormControlTextarea1">
                        <h6>متوفر</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" name="status">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>


            </form>
        </div>
    </main>


@endsection
