@extends('layouts.front')

@section('title')
    {{$category->name}}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container part-index-product">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a>/
            <a href="{{url('category')}}">Category</a>/
            <a href="{{url('view-category/' . $category->slug)}}">{{$category->name}}</a>
        </h6>

    </div>
</div>

<div class="py-5 prod">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}}</h2>
            <div class="cont_b">
                @foreach ($products as $item)
                <div class="box_product">
                    <div class="img">
                        <img src="{{asset('uploading/'.$item->image)}}" alt="{{$item->name}}">
                    </div>
                    <div class="product-description">
                        @if ($item->trending == '1')
                        <span class="popular">Popular</span>
                        @endif
                        <a href="{{url('category/' . $category->slug . '/' . $item->slug)}}">
                            <h6>{{$item->name}}</h6>
                        </a>
                        <p class="product-price mb-0">
                            <span class="old-price">{{$item->original_price}}</span>
                            {{$item->selling_price}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

