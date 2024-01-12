@extends('admin.layout.admin_master')

@section('title')
    المنتجات
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
                    <h4>المنتجات</h4>
                    <a href="{{ route('create.products') }}" class="btn btn-success">اضف منتج</a>
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

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">id</th>
                            <th scope="col">التصنيف</th>
                            <th scope="col">اسم المنتج</th>
                            {{-- <th scope="col">نبذة</th> --}}
                            <th scope="col">السعر الأصلي</th>
                            <th scope="col">السعر المبيع</th>
                            {{-- <th scope="col">حالة الظهور</th> --}}
                            {{-- <th scope="col">أولوية الظهور</th> --}}
                            <th scope="col">صورة</th>
                            <th scope="col">عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @isset($products)
                        @forelse ($products as $item)
                            <tr>
                                <th style="text-align: center">{{$item->id}}</th>
                                <th style="text-align: center">{{$item->category->name}}</th>
                                {{-- <td>{{$item->user->name}}</td> --}}
                                <td>{{ $item->name }}</td>
                                {{-- <td>{{$item->small_description}}</td> --}}
                                {{-- <td>{!! $item->description !!}</td> --}}
                                <td>{{ $item->original_price }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>
                                    <img src="{{asset('uploading/' . $item->image)}}" alt="Image here" class="img-cate">
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{ route('edit.products', $item->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm">
                                            <a href="{{ route('destroy.products', ['id' => $item->id]) }}" onclick="return confirm('هل انت متأكد تريد حذف المنتج ؟');"><i
                                                    class="fa-solid fa-trash-can"></i></a>


                                        </div>
                                    </div>


                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align:center;">لايوجد بيانات لعرضها</td>
                            </tr>
                        @endforelse
                        @endisset

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@endsection


