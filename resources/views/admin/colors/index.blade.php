@extends('admin.layout.admin_master')

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
                    <h4>ألوان</h4>
                    <a href="{{ route('create.colors') }}" class="btn btn-success">اضافة لون</a>
                </div><br><br>
            </div>


            <div class="table-responsive">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center">id</th>
                            <th scope="col">اسم اللون</th>
                            <th scope="col">رمز</th>
                            <th scope="col">حالة</th>
                            <th scope="col">عمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @isset($colors)
                        @forelse ($colors as $item)
                            <tr>
                                <th scope="row " style="text-align: center">{{$item->id}}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->status == 1 ? 'مفعل' : 'غير مفعل' }}</td>

                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <a href="{{ route('edit.colors', $item->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="col-sm">
                                            <a href="{{ route('destroy.colors', ['id' => $item->id]) }}"
                                                onclick="return confirm('هل انت متأكد تريد حذف هذا اللون ؟')"><i
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


