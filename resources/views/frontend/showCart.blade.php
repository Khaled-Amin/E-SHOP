@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container collection">
        <h6 class="mb-0">
            <a href="{{url('/')}}">الصفحة الرئيسية</a> /
            <a href="{{url('cart/')}}">سلة</a>
        </h6>
    </div>
</div>

    <div class="container my-5">
        <div class="card shadow">
            @if ($getAllCart->count() > 0)
                <div class="card-body">
                    @php $total = 0; @endphp
                    @foreach ($getAllCart as $item)
                        <div class="row mb-5 product_data">
                        <div class="col-md-2 cartWidth">
                            <img src="{{asset('uploading/' . $item->products->image)}}" height= "80px" width="70px" alt="لا يوجد صورة لعرضها">
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <h4>{{$item->products->name}}</h4>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <h4>{{$item->products->selling_price}}</h4>
                        </div>
                        <div class="col-md-2 cartt">
                            <input type="hidden" value="{{$item->prod_id}}" class="prod_id">
                            @if ($item->products->qty >= $item->prod_qty)
                                <label for="Quantity">الكمية</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input type="text" name="quantity" value="{{$item->prod_qty}}" class="form-control text-center qty-input" />
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                                @php $total += ((int)$item->products->selling_price * (int)$item->prod_qty); @endphp
                                @else
                                <h6>Out of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">
                            <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash"></i>حذف</button>
                        </div>
                        </div>
                    @endforeach
                </div>


                <div class="card-footer paycheck">
                    <h6>
                        <span>Total Price :{{ $total }}$</span>
                        <a href="{{url('checkout')}}" class="btn btn-outline-success">عملية الدفع</a>
                    </h6>

                </div>
            @else
                <div class="card-body text-center">
                    <h2>عربة التسوق <i class="fa fa-shopping-cart"></i>الخاصة بك فارغة</h2>
                    <br>
                    <h6>أيش تنتظر؟</h6>
                    <a href="{{route('categoryAll')}}" class="btn btn-outline-primary text-center">ابدأ التسوق</a>
                </div>
            @endif
        </div>
    </div>
@endsection
