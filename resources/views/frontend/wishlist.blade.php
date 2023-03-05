@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container collection">
        <h6 class="mb-0">
            <a href="{{url('/')}}">الصفحة الرئيسية</a> /
            <a href="{{url('wishlist')}}">قائمة الرغبات</a>
        </h6>
    </div>
</div>

    <div class="container my-5">
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count())
                    @foreach ($wishlist as $item)
                        <div class="row mb-5 product_data">
                        <div class="col-md-2 cartWidth">
                            <img src="{{asset('uploading/' . $item->products->image)}}" height= "80px" width="70px" alt="لا يوجد صورة لعرضها">
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <h4>{{$item->products->name}}</h4>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <h4>{{$item->products->selling_price}}</h4>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                            @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">الكمية</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="form-control text-center qty-input" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                                @else
                                <h6>Out of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 my-auto d-flex justify-content-center align-items-center">
                            <button class="btn btn-success addToCartBtn btn-sm"><i class="fa fa-shopping-cart m-2"></i>اضف الى سلة</button>
                        </div>
                        <div class="col-md-2 my-auto d-flex justify-content-center align-items-center">
                            <button class="btn btn-danger btn-sm rempve-wishlist-item"><i class="fa fa-trash m-2"></i>حذف</button>
                        </div>
                        </div>
                    @endforeach

                @else
                <div class="text-center">
                    <h2>قائمة الرغبات الخاصة بك فارغة</h2>
                    <br>
                    <h6>أيش تنتظر؟</h6>
                    <a href="{{route('categoryAll')}}" class="btn btn-outline-primary text-center">ابدأ التسوق</a>
                </div>
                @endif
            </div>

        </div>
    </div>
@endsection
