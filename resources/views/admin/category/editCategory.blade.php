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
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('all.main.categories') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('update.categories', $getCategory_Id->id) }}" method="POST"
                enctype="multipart/form-data">
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
                    <label for="exampleFormControlInput1">اسم التصنيف</label>
                    <input type="text" class="form-controll" name="category_name"
                        value="{{ $getCategory_Id->name }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Slug</label>
                    <input type="text" class="form-controll" name="slug" value="{{ $getCategory_Id->slug }}">
                </div>


                <div class="form-group">
                    <label for="exampleFormControlInput1">وصف</label>
                    <input type="text" class="form-controll" name="descrip"
                        value="{{ $getCategory_Id->description }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_title</label>
                    <input type="text" class="form-controll" name="meta_title"
                        value="{{ $getCategory_Id->meta_title }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_keywords</label>
                    <textarea name="meta_keywords" rows="3" class="form-controll">{{ $getCategory_Id->meta_keywords }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_descrip</label>
                    <textarea name="meta_descrip" rows="3" class="form-controll">{{ $getCategory_Id->meta_descrip }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="exampleFormControlInput1">صورة (550*1350)</label>
                    <input type="file" name="photo" class="form-controll">
                </div>
                @if ($getCategory_Id->image)
                    <img src="{{ asset('uploading/' . $getCategory_Id->image) }}" width="150px" height="100px"
                        alt="Category Image">
                @endif
                <br><br>
                <div class="form-check form-check-inline">
                    <label for="exampleFormControlTextarea1">
                        <h6>إخفاء</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" name="status"
                        {{ $getCategory_Id->status == '1' ? 'checked' : '' }}>

                    <label for="exampleFormControlTextarea1">
                        <h6 style="margin-right:3px;">شائع</h6>
                    </label>
                    <input class="form-check-input mb-5" type="checkbox" name="popular"
                        {{ $getCategory_Id->popular == '1' ? 'checked' : '' }}>

                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>


            </form>
        </div>
    </main>


@endsection
