@extends('layouts.front')

@section('title', $products->name)

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/add-rating')}}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">قيم ({{ $products->name }})</h5>
                        <button type="button" class="btn-close" style="margin-left:0 !important;" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container collection">
            <h6 class="mb-0">
                <a href="{{ url('category') }}">التصنيفات</a> /
                <a href="{{ url('view-category/' . $products->category->slug) }}">{{ $products->category->name }}</a> /
                <a
                    href="{{ url('category/' . $products->category->slug . '/' . $products->slug) }}">{{ $products->name }}</a>
            </h6>
        </div>
    </div>

    <div class="container mb-5 mt-5">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3 border-right">
                        <img src="{{ asset('uploading/' . $products->image) }}" class="w-100" alt="">
                    </div>
                    <div class="col-md-9">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size:16px;" class="float-end badge bg-danger trending_tag">شائع</label>
                            @endif
                        </h2>


                        <hr>
                        <label class="me-3">قبل: <s>{{ $products->original_price }}</s></label>
                        <label class="fw-bold me-3">الأن:{{ $products->selling_price }}</label>
                        @php
                            $number_rate = number_format($rating_value);
                        @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $number_rate; $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j = $number_rate ; $j < 5;$j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>
                                @if ($ratings->count())
                                ({{ $ratings->count() }}تقييم)
                                @else
                                    لايوجد تقييم
                                @endif
                            </span>
                        </div>
                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In stock</label>
                        @else
                            <label class="badge bg-danger">Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity">الكمية</label>

                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity" value="1" class="form-control qty-input" />
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br />
                                @if ($products->qty > 0)
                                    <button type="button" class="btn btn-primary me-3 addToCartBtn float-start">إضافة الى
                                        عربة التسوق<i class="fa fa-shopping-cart me-2"></i></button>
                                @endif
                                <button type="button" class="btn btn-success me-3 addToWishlist float-start">اضافة الى
                                    قائمة الرغبات<i class="fa fa-heart me-2"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3>الوصف</h3>
                    <p class="mt-3">
                        {!! $products->description !!}
                    </p>
                    <button type="button" class="btn btn-primary" style="width:15%;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        قيم المنتج
                    </button>

                </div>
            </div>
        </div>
    </div>

@endsection
