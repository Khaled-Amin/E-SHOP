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
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('all.main.shipping') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{route('update.shipping', $shipp->id)}}" method="POST">
                @csrf
                @method('PUT')
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
                    <label for="exampleFormControlInput1">مكان الشحن</label>
                    <input type="text" class="form-controll" name="name" value="{{$shipp->name}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">السعر</label>
                    <input type="text" class="form-controll" name="price" value="{{$shipp->price}}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>


            </form>
        </div>
    </main>


@endsection
