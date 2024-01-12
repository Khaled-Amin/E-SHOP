@extends('layouts.front')

@section('title')
    My Cart
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container collection">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Home</a> /
                <a href="{{ url('cart/') }}">Cart</a>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow">
            @if ($getAllCart->count() > 0)
                <div class="card-body">
                    @php $total = 0; @endphp
                    @foreach ($getAllCart as $index => $item)
                        <div class="row mb-5 product_data">
                            <div class="col-md-2 cartWidth">
                                <img src="{{ asset('uploading/' . $item->products->image) }}" height= "80px" width="70px"
                                    alt="Not Found Picture">
                            </div>
                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <h4>{{ $item->products->name }}</h4>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <h4>{{ $item->products->selling_price }}</h4>
                            </div>
                            <div class="col-md-2 cartt">
                                <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                                @php
                                    $getProdQTY = \App\Models\ProductColorSize::where('product_id', $item->prod_id)
                                        ->where('color_id', $item->colorID)
                                        ->where('size_id', $item->sizeID)
                                        ->sum('qty');
                                @endphp

                                {{-- Output the sum --}}
                                {{-- {{ $getProdQTY }} --}}
                                @if ($getProdQTY >= $item->prod_qty)
                                    <label for="Quantity">Quantity</label>
                                    <div class="input-group text-center mb-3">
                                        <button class="input-group-text changeQuantity decrement-btn">-</button>
                                        <input type="text" name="quantity" value="{{ $item->prod_qty }}"
                                            class="form-control text-center qty-input" />
                                        <button class="input-group-text changeQuantity increment-btn">+</button>
                                    </div>
                                    @php $total += ((int)$item->products->selling_price * (int)$item->prod_qty); @endphp
                                @else
                                    <h6>Out of Stock</h6>
                                @endif
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                <button class="btn btn-danger delete-cart-item"><i class="fa fa-trash mx-1"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="card-footer paycheck">
                    <h6>
                        <span>Total Price :{{ $total }}$</span>
                        <a href="{{ url('checkout') }}" class="btn btn-outline-success">Payment Process</a>
                    </h6>

                </div>
            @else
                <div class="card-body text-center">
                    <h2>Your shopping cart <i class="fa fa-shopping-cart"></i> is empty</h2>
                    <br>
                    <h6>What are you waiting for?</h6>
                    <a href="{{ route('categoryAll') }}" class="btn btn-outline-primary text-center">Shopping <i class="fa fa-shopping-cart"></i></a>
                </div>
            @endif
        </div>
    </div>
@endsection
