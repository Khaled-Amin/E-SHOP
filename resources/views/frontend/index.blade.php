@extends('layouts.front')

@section('title')
    E-SHOP
@endsection

@section('content')
    @include('layouts.sliderfront')
    <div class="py-5 main">
        <div class="container">
            <div class="row">
                <h2>منتجات مميزة</h2>
                @foreach ($getProductTrending as $getProduct)
                @if ($getProduct->status == '0')
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <a href="{{url('category/' . $getProduct->category->slug . '/' . $getProduct->slug)}}" class="refactone">
                                <img src="{{asset('uploading/'.$getProduct->image)}}" class="w-100" height="180px" alt="">
                            </a>
                                <div class="card-body">
                                    <h5>{{$getProduct->name}}</h5>
                                    <span class="float-start ">{{$getProduct->selling_price}}</span>
                                    <span class="float-end color-font-prod-feature"><s>{{$getProduct->original_price}}</s></span>
                                </div>

                        </div>
                    </div>
                @endif

                @endforeach
            </div>
        </div>
    </div>
    @if (count($getCate_Trending) > 0)
    <div class="py-5 main">
        <div class="container">
            <div class="row">
                <h2>تصنيفات الشائعة</h2>
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
                    <a href="{{route('categoryAll')}}" class="btn btn-primary w-25 mt-5 mb-3">عرض التصنيفات</a>
                </div>
            </div>
        </div>
    </div>
    @else
    @endif

@endsection
