@extends('admin.layout.admin_master')

@section('title')
    انشاء منتج
@endsection

@section('content')
    @include('admin.layout.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        <!-- Navbar -->
        @include('admin.layout.navbar')
        <!-- End Navbar -->
        <div class="row backgroundW p-4 m-3">
            <div class="divBtn">
                <a href="{{url()->previous()}}">رجوع</a>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold"><a href="{{ route('all.main.products') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active" aria-current="page">انشاء</li>
                </ol>
            </nav>
            <form action="{{ route('store.products') }}" method="POST" enctype="multipart/form-data">
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
                    <select style="width: 200px;background-color:#f1f1f1;" class="form-select" name="categor_id">
                        <option value="">أختر التصنيف</option>
                        @foreach ($category as $getCategory)
                            <option value="{{ $getCategory->id }}">{{ $getCategory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">اسم المنتج</label>
                    <input type="text" class="form-controll @error('product_name') is-invalid @enderror" name="product_name" placeholder="اسم المنتج" value="{{ old('product_name') }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Slug</label>
                    <input type="text" class="form-controll @error('slug') is-invalid @enderror" name="slug" value="{{old('slug')}}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">نبذة مختصرة</label>
                    <input type="text" class="form-controll @error('small_descrip') is-invalid @enderror" name="small_descrip" placeholder="وصف" value="{{old('small_descrip')}}" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">وصف</label>
                    {{-- <input type="text" class="form-controll" name="descrip" placeholder="وصف"> --}}
                    <textarea name="descrip" rows="4" class="ckeditor form-controll @error('descrip') is-invalid @enderror">{{old('descrip')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">السعر الأصلي</label>
                    <input type="text" class="form-controll @error('orig_price') is-invalid @enderror" name="orig_price" placeholder="السعر الأصلي" value="{{old('orig_price')}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">السعر المبيع</label>
                    <input type="text" class="form-controll @error('sell_price') is-invalid @enderror" name="sell_price" placeholder="السعر المبيع" value="{{old('sell_price')}}">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">مصاريف الشحن داخل الدولة</label>
                    <input type="number" class="form-controll @error('shipp_cost') is-invalid @enderror" name="shipp_cost" placeholder="مصاريف الشحن" value="{{old('shipp_cost')}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput13">مصاريف الشحن  خارج الدولة</label>
                    <input type="number" class="form-controll @error('shipp_cost_out') is-invalid @enderror" name="shipp_cost_out" placeholder="مصاريف الشحن خارج الدولة" value="{{old('shipp_cost_out')}}">
                </div> --}}

                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">ضريبة</label>
                    <input type="number" class="form-controll @error('taxx') is-invalid @enderror" name="taxx" placeholder="ضريبة" value="{{old('taxx')}}">
                </div> --}}
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_title</label>
                    <input type="text" class="form-controll @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="meta_title" value="{{old('meta_title')}}">
                </div>
                {{-- <div class="form-group">
                    <label for="exampleFormControlInput1">الكمية الكلية</label>
                    <input type="number" class="form-controll @error('quantity') is-invalid @enderror" name="quantity" placeholder="الكمية" value="{{old('quantity')}}">
                </div> --}}
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_keywords</label>
                    <textarea name="meta_keywords" rows="3" class="form-controll @error('meta_keywords') is-invalid @enderror">{{old('meta_keywords')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">meta_descrip</label>
                    <textarea name="meta_descrip" rows="3" class="form-controll @error('meta_descrip') is-invalid @enderror">{{old('meta_descrip')}}</textarea>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="mb-0 mt-2">صورة العرض</label><br>
                    <small>(png, jpg, jpeg, svg, gif, webp)</small>
                    <input type="file" name="photo" class="form-controll @error('photo') is-invalid @enderror">
                </div>
                <div class="form-check form-check-inline">
                    <label for="exampleFormControlTextarea1">
                        <h6>اخفاء</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" name="status">

                    <label for="exampleFormControlTextarea1">
                        <h6 style="margin-right:3px;">شائع</h6>
                    </label>
                    <input class="form-check-input" type="checkbox" name="popular">

                </div>
                <hr>
                <h4>قسم اختيار اللون والكمية والمقاسات</h4>
                <hr>
                <div class="col-md-12 mb-3">
                    <label class="mb-0 mt-2">رفع صور موديلات و الألوان للمنتج</label><br>
                    <small>(png, jpg, jpeg, svg, gif, webp)</small>
                    <input type="file" name="albumsphoto[]" class="form-controll @error('albumsphoto') is-invalid @enderror" multiple>
                </div>
                <div class="form-group mb-3">
                    <label>اختر اللون<span style="color: red">*</span></label>
                    <div class="row">
                        @forelse ($colors as $color)
                            <div class="form-check col-md-3 mb-4">
                                <div class="p-2 border">
                                    لون: <input class="form-check-input" type="checkbox" name="colors[{{$color->id}}]" value="{{$color->id}}" />
                                    {{$color->name}}
                                    <br>
                                    <br>
                                    الكمية: <input type="number" class="form-controll" name="colorquantity[{{$color->id}}]" style="width: 100%;" />
                                    @forelse ($sizes as $size)
                                        مقاس: <input class="form-check-input mt-2 mb-2" type="checkbox" name="sizes[{{$color->id}}][]" value="{{$size->id}}" />
                                        {{$size->value}}<br>
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

                {{-- <div class="form-group mb-3">
                    <label>اختر المقاس<span style="color: red">*</span></label>
                    <div class="row">
                         @forelse ($sizes as $item)
                            <div class="form-check col-md-3 mb-4">
                                <div class="p-2 border">
                                    مقاس: <input class="form-check-input" type="checkbox" name="sizes[{{$item->id}}]" value="{{$item->id}}" />
                                    {{$item->value}}
                                </div>
                            </div>
                         @empty
                            <div class="col-md-12">
                                <h4>لا يوجد مقاسات متوفرة حاليا</h4>
                            </div>
                         @endforelse


                    </div>

                </div> --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>


            </form>
        </div>
    </main>


@endsection

<style>
    .is-invalid{
        border:1px solid red;
    }
</style>
