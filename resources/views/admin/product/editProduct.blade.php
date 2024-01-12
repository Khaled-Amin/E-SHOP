@extends('admin.layout.admin_master')

@section('title')
    تعديل المنتج
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">


        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- End Navbar -->

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('all.main.products') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('update.products', $getProduct_Id->id) }}" method="POST" enctype="multipart/form-data">
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
                    <h4>التصنيف:</h4>
                    <select style="width: 200px" class="form-cdontrol" id="countries" name="categor_id">
                        <option value="">أختر التصنيف</option>
                        @foreach ($category as $getCategory)
                            <option value="{{ $getCategory->id }}"
                                {{ $getProduct_Id->cate_id == $getCategory->id ? 'selected' : '' }}>{{ $getCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">اسم المنتج</label>
                    <input type="text" class="form-controll" name="product_name" value="{{ $getProduct_Id->name }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Slug</label>
                    <input type="text" class="form-controll" name="slug" value="{{ $getProduct_Id->slug }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">نبذة مختصرة</label>
                    <input type="text" class="form-controll" name="small_descrip"
                        value="{{ $getProduct_Id->small_description }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">وصف</label>
                    {{-- <input type="text" class="form-controll" name="descrip" value=""> --}}
                    <textarea name="descrip" rows="4" class="ckeditor form-controll">{{ $getProduct_Id->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">السعر الأصلي</label>
                    <input type="text" class="form-controll" name="orig_price"
                        value="{{ $getProduct_Id->original_price }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">السعر المبيع</label>
                    <input type="text" class="form-controll" name="sell_price"
                        value="{{ $getProduct_Id->selling_price }}">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">الكمية الكلية</label>
                    <input type="number" class="form-controll" name="quantity" value="{{ $getProduct_Id->qty }}">
                </div> --}}
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">مصاريف الشحن داخل الدولة</label>
                    <input type="number" class="form-controll" name="shipp_cost" value="{{ $getProduct_Id->shipp_cost }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput13">مصاريف الشحن خارج الدولة</label>
                    <input type="number" class="form-controll" name="shipp_cost_out" value="{{ $getProduct_Id->shipp_cost_out }}">
                </div> --}}
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">ضريبة</label>
                    <input type="number" class="form-controll" name="taxx" value="{{ $getProduct_Id->tax }}">
                </div> --}}
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_title</label>
                    <input type="text" class="form-controll" name="meta_title" value="{{ $getProduct_Id->meta_title }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_keywords</label>
                    <textarea name="meta_keywords" rows="3" class="form-controll">{{ $getProduct_Id->meta_keywords }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_descrip</label>
                    <textarea name="meta_descrip" rows="3" class="form-controll">{{ $getProduct_Id->meta_description }}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label>صورة</label><br>
                    <small>(png, jpg, jpeg, svg, gif, webp)</small>
                    <input type="file" name="photo" class="form-controll @error('photo') is-invalid @enderror">
                    @if ($getProduct_Id->image)
                        <img src="{{ asset('uploading/' . $getProduct_Id->image) }}" class="mb-3 mt-3" width="150px"
                            height="150px" alt="سوف تظهر الصورة هنا">
                    @endif
                </div>
                <div class="form-check form-check-inline">
                    <label for="inlineCheckbox2">
                        <h6>اخفاء</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="status"
                        {{ $getProduct_Id->status == true ? 'checked' : '' }}>

                    <label for="inlineCheckbox2">
                        <h6 style="margin-right:3px;">شائع</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="popular"
                        {{ $getProduct_Id->trending == true ? 'checked' : '' }}>

                </div>
                <hr>
                <h4>قسم اختيار اللون والكمية والمقاسات</h4>
                <hr>
                <div class="col-md-12 mb-3">
                    <label class="mb-0 mt-2">رفع صور موديلات و الألوان للمنتج</label><br>
                    <small>(png, jpg, jpeg, svg, gif, webp)</small>
                    <input type="file" name="albumsphoto[]" class="form-controll @error('albumsphoto') is-invalid @enderror" multiple>
                    @php
                        $getAlbums = explode(',', $getProduct_Id->albums)
                    @endphp
                    @foreach ($getAlbums as $item)
                        <img src="{{ asset('uploadingMultiple/' . $item) }}" class="mb-3 mt-3" width="150px"
                            height="auto" alt="سوف تظهر الصورة هنا">
                    @endforeach
                </div>
                <div class="form-group mb-3">
                    <label>اختر اللون<span style="color: red">*</span></label>
                    <div class="row">
                        @forelse ($colors as $index => $color)
                            <div class="form-check col-md-3 mb-4">
                                <div class="p-2 border">
                                    لون: <input class="form-check-input" type="checkbox"
                                        name="colors[{{ $color->id }}]" value="{{ $color->id }}"
                                        {{ $getProduct_Id->productColorSizes->contains('color_id', $color->id) ? 'checked' : '' }} />
                                    {{ $color->name }}
                                    <br>
                                    <br>
                                    @php
                                        $colorSize = $getProduct_Id->productColorSizes->where('color_id', $color->id)->first();
                                    @endphp
                                    الكمية: <input type="number" class="form-control"
                                        name="colorquantity[{{ $color->id }}]" style="width: 100%;"
                                        value="{{ optional($colorSize)->qty }}" />
                                    @forelse ($sizes as $size)
                                        @php
                                            $sizeChecked = $getProduct_Id->productColorSizes->contains('size_id', $size->id) && $getProduct_Id->productColorSizes->contains('color_id', $color->id);
                                        @endphp
                                        مقاس: <input class="form-check-input mt-2 mb-2" type="checkbox"
                                            name="sizes[{{ $color->id }}][]" value="{{ $size->id }}"
                                            {{ $sizeChecked ? 'checked' : '' }} />
                                        {{ $size->value }}<br>
                                    @empty
                                        <div class="col-md-12">
                                            <h4>لا يوجد مقاسات متوفرة حاليا</h4>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <h4>لا يوجد الوان</h4>
                            </div>
                        @endforelse

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>


            </form>
        </div>
    </main>


@endsection
