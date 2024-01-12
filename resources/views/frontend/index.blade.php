@extends('layouts.front')

@section('title')
    @isset($Settings->nameWebsite)
        {{$Settings->nameWebsite}}
    @endisset
@endsection

@section('content')
    @include('layouts.sliderfront')
    <div class="py-5 main">
        <div class="container">
            <h2 class="mb-5">Popular Products</h2>
            <div class="cont_b">
                @foreach ($getProductTrending->take(4) as $getProduct)
                @if ($getProduct->status == '0')
                <div class="box_product">
                    <div class="img">
                        <img src="{{asset('uploading/'.$getProduct->image)}}" alt="">
                    </div>
                    <div class="product-description">
                        @if ($getProduct->trending == '1')
                        <span class="popular">Popular</span>
                        @endif
                        <a href="{{url('category/' . $getProduct->category->slug . '/' . $getProduct->slug)}}">
                            <h6>{{$getProduct->name}}</h6>
                        </a>
                        <p class="product-price mb-0">
                            <span class="old-price">{{$getProduct->original_price}}</span>
                            {{$getProduct->selling_price}}
                        </p>
                        {{-- <!-- Hover Content -->
                        <div class="hover-content">
                            <!-- Add to Cart -->
                            <div class="add-to-cart-btn">
                                <a href="#" class="btn essence-btn">Add to Cart</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
    @if (count($getCate_Trending) > 0)
        @if($statusC->status == '0')
        <div class="py-5 main">
        <div class="container">
            <div class="row">
                <h2>Popular Categories</h2>
                @foreach ($getCate_Trending as $getItem)
                    @if ($getItem->status == '0')
                        <div class="col-md-3 mt-3">
                            <a href="{{route('productBycategory', [$getItem->slug])}}">
                                <div class="card">
                                    <div class="refact">
                                        <img src="{{asset('uploading/'.$getItem->image)}}" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="text-dark">{{$getItem->name}}</h5>
                                        <p class="text-secondary">
                                            {{$getItem->description}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif

                @endforeach
                <div class="div-btnn w-100 d-flex justify-content-center">
                    <a href="{{route('categoryAll')}}" class="btn btn-primary w-auto mt-5 mb-3">More Categories</a>
                </div>
            </div>
        </div>
        </div>
        @endif
    @else
    @endif

@endsection
